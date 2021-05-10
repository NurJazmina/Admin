<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include '../connections/db.php';

if (isset($_POST['AddDepartmentRemarkChildFormSubmit'])) {
  session_start();
  $id = strval ($_SESSION["departmentremarkid"] );
  $varremarkid = $_POST['txtremarkid'];
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
    'department_id'=>$id,
    'departmentRemarksDetails'=>$vartxtconsumerremark,
    'departmentRemarksStaff_id'=>$varstaffid,
    'school_id'=>$varschoolid,
    'departmentRemarksDate'=>$varconsumerremarkdate,
    'departmentRemarksStatus'=>'ACTIVE']);

  $writeConcern = new MongoDB\Driver\WriteConcern(MongoDB\Driver\WriteConcern::MAJORITY, 1000);
  try
  {
    $result =$GoNGetzDatabase->executeBulkWrite('GoNGetzSmartSchool.DepartmentRemarks', $bulk, $writeConcern);
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
header ('location: ../index.php?page=departmentdetail&id=' . $id);
}
?>
