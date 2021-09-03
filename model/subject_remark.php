<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include '../connections/db.php';

if (isset($_POST['add_remark'])) 
{
  session_start();
  $subject_id = $_POST['subject_id'];
  $remark = $_POST['remark'];
  $staff_id = strval($_SESSION["loggeduser_id"]);
  $school_id = $_SESSION["loggeduser_school_id"];

  $date = new MongoDB\BSON\UTCDateTime((new DateTime('now'))->getTimestamp()*1000);

  $bulk = new MongoDB\Driver\BulkWrite(['ordered'=>true]);
  $bulk->insert([
    'SubRemarks'=>'0',
    'School_id'=>$school_id,
    'Subject_id'=>$subject_id,
    'Staff_id'=>$staff_id,
    'Details'=>$remark,
    'Date'=>$date,
    'Status'=>'ACTIVE']);
  $writeConcern = new MongoDB\Driver\WriteConcern(MongoDB\Driver\WriteConcern::MAJORITY, 1000);
  try 
  {
    $result = $GoNGetzDatabase->executeBulkWrite('GoNGetzSmartSchool.Subject_Remarks', $bulk, $writeConcern);
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
  printf("Inserted %d document(s)\n", $result->getInsertedCount());
  header ('location: ../index.php?page=subjectdetail&id='.$subject_id);
}

if (isset($_POST['add_remark_child'])) 
{
  session_start();
  $subject_id = $_POST['subject_id'];
  $remark_id = $_POST['remark_id'];
  $remark = $_POST['remark'];
  $staffid = $_SESSION["loggeduser_id"];
  $school_id = $_SESSION["loggeduser_school_id"];
  $date = new MongoDB\BSON\UTCDateTime((new DateTime('now'))->getTimestamp()*1000);

  $filter = ['_id'=>new \MongoDB\BSON\ObjectId($remark_id)];
  $query = new MongoDB\Driver\Query($filter);
  $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Subject_Remarks',$query);
  foreach ($cursor as $document)
  {
    $status = ($document->Status);
  }

  $bulk = new MongoDB\Driver\BulkWrite(['ordered'=>true]);
  $bulk->insert([
    'SubRemarks'=>$remark_id,
    'School_id'=>$school_id,
    'Subject_id'=>$subject_id,
    'Staff_id'=>$staffid,
    'Details'=>$remark,
    'Date'=>$date,
    'Status'=>$status ]);

  $writeConcern = new MongoDB\Driver\WriteConcern(MongoDB\Driver\WriteConcern::MAJORITY, 1000);
  try
  {
    $result =$GoNGetzDatabase->executeBulkWrite('GoNGetzSmartSchool.Subject_Remarks', $bulk, $writeConcern);
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
  printf("Inserted %d document(s)\n", $result->getInsertedCount());
  printf("Updated  %d document(s)\n", $result->getModifiedCount());
  header ('location: ../index.php?page=subjectdetail&id='.$subject_id);
}

if (isset($_POST['update_subject_remark'])) 
{
  session_start();
  $subject_id = $_SESSION["subject_id"];
  $remark_id = $_POST['remark_id'];
  $status = $_POST['status'];
  
  $bulk = new MongoDB\Driver\BulkWrite(['ordered' => TRUE]);
  $bulk->update(['_id'=> new \MongoDB\BSON\ObjectID($remark_id)],
                ['$set' => ['Status'=>$status]],
                ['multi' => TRUE,'upsert' => TRUE]
               );
   $writeConcern = new MongoDB\Driver\WriteConcern(MongoDB\Driver\WriteConcern::MAJORITY, 1000);
   try
   {
     $result = $GoNGetzDatabase->executeBulkWrite('GoNGetzSmartSchool.Subject_Remarks',$bulk,$writeConcern);
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
  $bulk->update(['SubRemarks'=>$remark_id],
                ['$set' => ['Status'=>$status]],
                ['multi' => TRUE,'upsert' => TRUE]
               );
   $writeConcern = new MongoDB\Driver\WriteConcern(MongoDB\Driver\WriteConcern::MAJORITY, 1000);
   try
   {
     $result = $GoNGetzDatabase->executeBulkWrite('GoNGetzSmartSchool.Subject_Remarks',$bulk,$writeConcern);
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
   header ('location: ../index.php?page=subjectdetail&id='.$subject_id);
}
?>