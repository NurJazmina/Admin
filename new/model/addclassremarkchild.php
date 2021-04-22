<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include '../connections/db.php';

if (isset($_POST['AddClassRemarkChildFormSubmit'])) {
  session_start();
  $varremarkid = $_POST['txtremarkid'];
  $varclassid = $_POST['txtclassid'];
  $vartxtconsumerremark = $_POST['txtconsumerRemark'];
  $varstaffid = strval($_SESSION["loggeduser_id"]);
  $varschoolid = strval($_SESSION["loggeduser_schoolID"]);
  $varconsumerremarkdate = new MongoDB\BSON\UTCDateTime((new DateTime('now'))->getTimestamp()*1000);

  $filter = ['_id'=>new \MongoDB\BSON\ObjectId($varremarkid)];
  $query = new MongoDB\Driver\Query($filter);
  $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.ClassRemarks',$query);
  foreach ($cursor as $document)
  {
    $varClassRemarksStatus = ($document->ClassRemarksStatus);
  }
  $bulk = new MongoDB\Driver\BulkWrite(['ordered'=>true]);
  $bulk->insert([
    'SubRemarks'=>$varremarkid,
    'Class_id'=>$varclassid,
    'ClassRemarksDetails'=>$vartxtconsumerremark,
    'ClassRemarksStaff_id'=>$varstaffid,
    'school_id'=>$varschoolid,
    'ClassRemarksDate'=>$varconsumerremarkdate,
    'ClassRemarksStatus'=>$varClassRemarksStatus]);

  $writeConcern = new MongoDB\Driver\WriteConcern(MongoDB\Driver\WriteConcern::MAJORITY, 1000);
  try
  {
    $result =$GoNGetzDatabase->executeBulkWrite('GoNGetzSmartSchool.ClassRemarks', $bulk, $writeConcern);
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
header ('location: ../index.php?page=classdetail&id=' . $varclassid);
}
?>
