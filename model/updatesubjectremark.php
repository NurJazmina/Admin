<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include '../connections/db.php';

if (isset($_POST['UpdatesubjectRemarkFormSubmit'])) {
  session_start();
  $id = strval($_SESSION["subjectremarkid"]);
  $remarkid = $_POST['txtremarkid'];
  $subjectRemarksStatus = $_POST['txtsubjectRemarksStatus'];
  $bulk = new MongoDB\Driver\BulkWrite(['ordered' => TRUE]);
  $bulk->update(['_id'=> new \MongoDB\BSON\ObjectID($remarkid)],
                ['$set' => ['SubjectRemarksStatus'=>$subjectRemarksStatus]],
                ['multi' => TRUE,'upsert' => TRUE]
               );
   $writeConcern = new MongoDB\Driver\WriteConcern(MongoDB\Driver\WriteConcern::MAJORITY, 1000);
   try
   {
     $result = $GoNGetzDatabase->executeBulkWrite('GoNGetzSmartSchool.SubjectRemarks',$bulk,$writeConcern);
   }
   catch (MongoDB\Driver\Exception\BulkWriteException $e)
   {
     $result = $e->getWriteResult();
     // Check if the write concern could not be fulfilled
     if ($writeConcernError = $result->getWriteConcernError())
     {
         printf("%s (%d): %s\n",
             $writeConcernError->getMessage(),
             $writeConcernError->getCode(),
             var_export($writeConcernError->getInfo(), true)
         );
     }
     // Check if any write operations did not complete at all
     foreach ($result->getWriteErrors() as $writeError) {
         printf("Operation#%d: %s (%d)\n",
             $writeError->getIndex(),
             $writeError->getMessage(),
             $writeError->getCode()
         );
     }
   }
   catch (MongoDB\Driver\Exception\Exception $e)
   {
     printf("Other error: %s\n", $e->getMessage());
     exit;
   }

  $bulk = new MongoDB\Driver\BulkWrite(['ordered' => TRUE]);
  $bulk->update(['SubRemarks'=>$remarkid],
                ['$set' => ['SubjectRemarksStatus'=>$subjectRemarksStatus]],
                ['multi' => TRUE,'upsert' => TRUE]
               );
   $writeConcern = new MongoDB\Driver\WriteConcern(MongoDB\Driver\WriteConcern::MAJORITY, 1000);
   try
   {
     $result = $GoNGetzDatabase->executeBulkWrite('GoNGetzSmartSchool.SubjectRemarks',$bulk,$writeConcern);
   }
   catch (MongoDB\Driver\Exception\BulkWriteException $e)
   {
     $result = $e->getWriteResult();
     // Check if the write concern could not be fulfilled
     if ($writeConcernError = $result->getWriteConcernError())
     {
         printf("%s (%d): %s\n",
          $writeConcernError->getMessage(),
          $writeConcernError->getCode(),
          var_export($writeConcernError->getInfo(), true)
         );
     }
     // Check if any write operations did not complete at all
     foreach ($result->getWriteErrors() as $writeError) {
         printf("Operation#%d: %s (%d)\n",
          $writeError->getIndex(),
          $writeError->getMessage(),
          $writeError->getCode()
         );
     }
   }
   catch (MongoDB\Driver\Exception\Exception $e)
   {
     printf("Other error: %s\n", $e->getMessage());
     exit;
   }
   header ('location: ../index.php?page=subjectdetail&id=' . $id);
}
?>
