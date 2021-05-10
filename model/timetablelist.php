<?php
//Add timetablelist
if (isset($_POST['submitaddtimetable']))
{
  $varschoolid =  strval($_SESSION["loggeduser_schoolID"]);
  $varclassid = $_POST['txtclassid'];
  $varteacherid = $_POST['txtteacherid'];
  $varsubject = $_POST['txtsubject'];
  $varTimetableStart= $_POST['txtTimetableStart'];
  $varTimetableEnd= $_POST['txtTimetableEnd'];
  $varTimetableWeeklyRepeat= $_POST['txtTimetableWeeklyRepeat'];
  $varTimetableStatus= $_POST['txtTimetableStatus'];
  $bulk = new MongoDB\Driver\BulkWrite(['ordered'=>true]);
  $bulk->insert([
    'School_id'=>$varschoolid,
    'Classroom_id'=>$varclassid,
    'Teachers_id'=>$varteacherid,
    'TimetableSubject'=>$varsubject,
    'TimetableStart'=>new MongoDB\BSON\UTCDateTime(new DateTime($varTimetableStart)),
    'TimetableEnd'=>new MongoDB\BSON\UTCDateTime(new DateTime($varTimetableEnd)),
    'TimetableWeeklyRepeat'=>$varTimetableWeeklyRepeat,
    'TimetableStatus'=>$varTimetableStatus,]);
  $writeConcern = new MongoDB\Driver\WriteConcern(MongoDB\Driver\WriteConcern::MAJORITY, 1000);
  try {
    $result = $GoNGetzDatabase->executeBulkWrite('GoNGetzSmartSchool.TimeTable', $bulk, $writeConcern);
  }
  catch (MongoDB\Driver\Exception\BulkWriteException $e) {
    $result = $e->getWriteResult();
    // Check if the write concern could not be fulfilled
    if ($writeConcernError = $result->getWriteConcernError()) {
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
  catch (MongoDB\Driver\Exception\Exception $e) {
    printf("Other error: %s\n", $e->getMessage());
    exit;
  }
  printf("Inserted %d document(s)\n", $result->getInsertedCount());
  printf("Updated  %d document(s)\n", $result->getModifiedCount());
}

//Edit timetable
if (isset($_POST['submitedittimetable']))
{
  $varschoolid =  strval($_SESSION["loggeduser_schoolID"]);
  $vartimetableid = $_POST['txttimetableid'];
  $varclassid = $_POST['txtclassid'];
  $varteacherid = $_POST['txtteacherid'];
  $varsubject = $_POST['txtsubject'];
  $varTimetableStart= $_POST['txtTimetableStart'];
  $varTimetableEnd= $_POST['txtTimetableEnd'];
  $varTimetableWeeklyRepeat= $_POST['txtTimetableWeeklyRepeat'];
  $bulk = new MongoDB\Driver\BulkWrite(['ordered' => TRUE]);
  $bulk->update( ['_id' => new \MongoDB\BSON\ObjectID($vartimetableid)],
                ['$set' => ['School_id'=>$varschoolid,
                'Classroom_id'=>$varclassid,
                'Teachers_id'=>$varteacherid,
                'TimetableSubject'=>$varsubject,
                'TimetableStart'=>new MongoDB\BSON\UTCDateTime(new DateTime($varTimetableStart)),
                'TimetableEnd'=>new MongoDB\BSON\UTCDateTime(new DateTime($varTimetableEnd)),
                'TimetableWeeklyRepeat'=>$varTimetableWeeklyRepeat,
                'TimetableStatus'=>'ACTIVE']],
                ['upsert' => TRUE]
               );
  $writeConcern = new MongoDB\Driver\WriteConcern(MongoDB\Driver\WriteConcern::MAJORITY, 1000);
  try
  {
    $result = $GoNGetzDatabase->executeBulkWrite('GoNGetzSmartSchool.TimeTable', $bulk, $writeConcern);
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
    foreach ($result->getWriteErrors() as $writeError)
    {
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
}

//Delete timetable
if (isset($_POST['DeleteTimetableFormSubmit']))
{
  $vartimetableid = $_POST['txttimetableid'];
  $bulk = new MongoDB\Driver\BulkWrite;
  $bulk->delete(['_id'=>new \MongoDB\BSON\ObjectID($vartimetableid)], ['limit' => 1]);
  $writeConcern = new MongoDB\Driver\WriteConcern(MongoDB\Driver\WriteConcern::MAJORITY, 1000);
  try
  {
    $result = $GoNGetzDatabase->executeBulkWrite('GoNGetzSmartSchool.TimeTable', $bulk, $writeConcern);
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
    foreach ($result->getWriteErrors() as $writeError)
    {
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
}
?>