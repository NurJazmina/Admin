<?php
if (isset($_POST['AddNews'])) {

  $vartitle = $_POST['txttitle'];
  $varaccess = $_POST['txtaccess'];
  $varschoolEventVenue = $_POST['txtschoolEventVenue'];
  $varschoolEventLocation = $_POST['txtschoolEventLocation'];
  $varstaffid = strval($_SESSION["loggeduser_id"]);
  $varschoolid = strval($_SESSION["loggeduser_schoolID"]);
  $varSchoolEventDateStart = $_POST['txtSchoolEventDateStart'];
  $varSchoolEventDateEnd = $_POST['txtSchoolEventDateEnd'];

  $bulk = new MongoDB\Driver\BulkWrite(['ordered'=>true]);
  $bulk->insert([
    'school_id'=>$varschoolid,
    'SchoolEventStaff_id'=>$varstaffid,
    'schoolEventTitle'=>$vartitle,
    'schoolEventVenue'=>$varschoolEventVenue,
    'schoolEventLocation'=>$varschoolEventLocation,
    'SchoolEventDateStart'=>new MongoDB\BSON\UTCDateTime(new DateTime($varSchoolEventDateStart)),
    'SchoolEventDateEnd'=>new MongoDB\BSON\UTCDateTime(new DateTime($varSchoolEventDateEnd)),
    'SchoolEventAccess'=>$varaccess,
    'SchoolEventStatus'=>'ACTIVE']);

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

$groupid = new \MongoDB\BSON\ObjectId($_SESSION["loggeduser_ConsumerGroup_id"]);
$filter2 = ['_id' => $groupid];
$query2 = new MongoDB\Driver\Query($filter2);
$cursor2 = $GoNGetzDatabase->executeQuery('GoNGetz.ConsumerGroup', $query2);
foreach ($cursor2 as $document2)
{
    $ConsumerGroupName = strval($document2->ConsumerGroupName);
}

