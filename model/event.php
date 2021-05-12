<?php
if (isset($_POST['AddNews'])) {

  $vartitle = $_POST['txttitle'];
  $varaccess = $_POST['txtaccess'];
  $EventVenue = $_POST['txtschoolEventVenue'];
  $EventAddress = $_POST['txtschoolEventAddress'];
  $EventLocation = $_POST['txtschoolEventLocation'];
  $varstaffid = strval($_SESSION["loggeduser_id"]);
  $varschoolid = strval($_SESSION["loggeduser_schoolID"]);
  $EventDateStart = $_POST['txtSchoolEventDateStart'];
  $EventDateEnd = $_POST['txtSchoolEventDateEnd'];

  $bulk = new MongoDB\Driver\BulkWrite(['ordered'=>true]);
  $bulk->insert([
    'school_id'=>$varschoolid,
    'EventStaff_id'=>$varstaffid,
    'EventTitle'=>$vartitle,
    'EventVenue'=>$EventVenue,
    'EventAddress' =>$EventAddress,
    'EventLocation'=>$EventLocation,
    'EventDateStart'=>new MongoDB\BSON\UTCDateTime(new DateTime($EventDateStart)),
    'EventDateEnd'=>new MongoDB\BSON\UTCDateTime(new DateTime($EventDateEnd)),
    'EventAccess'=>$varaccess,
    'EventStatus'=>'ACTIVE']);

  $writeConcern = new MongoDB\Driver\WriteConcern(MongoDB\Driver\WriteConcern::MAJORITY, 1000);
  try
  {
    $result =$GoNGetzDatabase->executeBulkWrite('GoNGetzSmartSchool.SchoolEvent', $bulk, $writeConcern);
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
}
