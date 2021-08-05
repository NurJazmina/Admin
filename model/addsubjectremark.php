<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include '../connections/db.php';

if (isset($_POST['AddSubjectRemarkFormSubmit'])) {
  
  session_start();
  $subjectid = $_POST['txtsubjectid'];
  $subjectremark = $_POST['txtsubjectRemark'];
  $staffid = strval($_SESSION["loggeduser_id"]);
  $schoolid = strval($_SESSION["loggeduser_schoolID"]);
  $subjectremarkdate = new MongoDB\BSON\UTCDateTime((new DateTime('now'))->getTimestamp()*1000);

  $bulk = new MongoDB\Driver\BulkWrite(['ordered'=>true]);
  $bulk->insert([
    'SubRemarks'=>'0',
    'Subject_id'=>$subjectid,
    'SubjectRemarksDetails'=>$subjectremark,
    'SubjectRemarksStaff_id'=>$staffid,
    'school_id'=>$schoolid,
    'SubjectRemarksDate'=>$subjectremarkdate,
    'SubjectRemarksStatus'=>'ACTIVE']);
  $writeConcern = new MongoDB\Driver\WriteConcern(MongoDB\Driver\WriteConcern::MAJORITY, 1000);

  try 
  {
    $result = $GoNGetzDatabase->executeBulkWrite('GoNGetzSmartSchool.SubjectRemarks', $bulk, $writeConcern);
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
header ('location: ../index.php?page=subjectdetail&id=' . $subjectid);
}
?>