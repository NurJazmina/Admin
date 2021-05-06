<?php
if (isset($_POST['AddForums'])) {

$title = $_POST['title'];
$type = $_POST['type'];
$topic = $_POST['topic'];
$detail = $_POST['detail'];
$staffid = strval($_SESSION["loggeduser_id"]);
$schoolid = strval($_SESSION["loggeduser_schoolID"]);
$Date = new MongoDB\BSON\UTCDateTime((new DateTime('now'))->getTimestamp()*1000);

if ($type == 'SCHOOL' && $topic == 'GENERAL')
{
    $forum = '1';
}
elseif ($type == 'SCHOOL' && $topic == 'PROPOSAL')
{
    $forum = '2';
}
elseif ($type == 'SCHOOL' && $topic == 'INFO')
{
    $forum = '3';
}
elseif ($type == 'PUBLIC' && $topic == 'GENERAL')
{
    $forum = '4';
}
elseif ($type == 'PUBLIC' && $topic == 'PROPOSAL')
{
    $forum = '5';
}
else
{
    $forum = '6';
}

$bulk = new MongoDB\Driver\BulkWrite(['ordered'=>true]);
$bulk->insert([
  'school_id'=>$schoolid,
  'Consumer_id'=>$staffid,
  'Forum'=>$forum,
  'ForumTitle'=>$title,
  'ForumDetails'=>$detail,
  'ForumDate'=>$Date,
  'ForumStatus'=>'ACTIVE']);
$writeConcern = new MongoDB\Driver\WriteConcern(MongoDB\Driver\WriteConcern::MAJORITY, 1000);
try
{
  $result =$GoNGetzDatabase->executeBulkWrite('GoNGetzSmartSchool.SchoolForum', $bulk, $writeConcern);
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