<?php
if (isset($_POST['AddParentRemarkFormSubmit'])) {
  
  session_start();
  
  $varconsumersid = $_POST['txtconsumerid'];
  $vartxtconsumerremark = $_POST['txtconsumerRemark'];
  $varstaffid = strval($_SESSION["loggeduser_id"]);
  $varconsumerremarkactive = "ACTIVE";
  $varschoolid = strval($_SESSION["loggeduser_schoolID"]);
  $varconsumerremarkdate = new MongoDB\BSON\UTCDateTime((new DateTime('now'))->getTimestamp()*1000);
  
  $GoNGetzSmartSchoolFrontEndConnectionString="mongodb://admin:TempPassword@124.217.235.244:27017/gngoffice?authSource=admin";
  $GoNGetzFrontEnd = new MongoDB\Driver\Manager($GoNGetzSmartSchoolFrontEndConnectionString);
  $bulk = new MongoDB\Driver\BulkWrite(['ordered'=>true]);
  $bulk->insert(['Consumer_id'=>$varconsumersid,'ConsumerRemarksDetails'=>$vartxtconsumerremark,'ConsumerRemarksStaff_id'=>$varstaffid ,'school_id'=>$varschoolid, 'ConsumerRemarksDate'=>$varconsumerremarkdate, 'ConsumerRemarksStatus'=>$varconsumerremarkactive]);
  
  $GoNGetzFrontEnd = new MongoDB\Driver\Manager($GoNGetzSmartSchoolFrontEndConnectionString);
  $writeConcern = new MongoDB\Driver\WriteConcern(MongoDB\Driver\WriteConcern::MAJORITY, 1000);

  try 
  {
    $result = $GoNGetzFrontEnd->executeBulkWrite('GoNGetzSmartSchool.ParentRemarks', $bulk, $writeConcern);
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
  header ('location: ../index.php?page=parentdetail&id=' . $varconsumersid);
}
?>