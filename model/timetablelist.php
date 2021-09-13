<?php
//Add timetablelist
if (isset($_POST['add_timetable']))
{
  $class_id = $_POST['class_id'];
  $teacher_id = $_POST['teacher_id'];
  $subject_id = $_POST['subject_id'];
  $date_start= $_POST['date_start'];
  $date_end= $_POST['date_end'];
  $repeat = $_POST['repeat'];
  $status= $_POST['status'];
  $bulk = new MongoDB\Driver\BulkWrite(['ordered'=>true]);
  $bulk->insert([
    'School_id'=>$_SESSION["loggeduser_school_id"],
    'Classroom_id'=>$class_id,
    'Teachers_id'=>$teacher_id,
    'Subject_id'=>$subject_id,
    'Start'=>new MongoDB\BSON\UTCDateTime(new DateTime($date_start)),
    'End'=>new MongoDB\BSON\UTCDateTime(new DateTime($date_end)),
    'Repeat'=>$repeat ,
    'Status'=>$status,]);
  $writeConcern = new MongoDB\Driver\WriteConcern(MongoDB\Driver\WriteConcern::MAJORITY, 1000);
  try 
  {
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
if (isset($_POST['edit_timetable']))
{
  $timetable_id = $_POST['timetable_id'];
  $class_id = $_POST['class_id'];
  $teacher_id = $_POST['teacher_id'];
  $subject_id = $_POST['subject_id'];
  $date_start= $_POST['date_start'];
  $date_end= $_POST['date_end'];
  $repeat = $_POST['repeat'];
  $bulk = new MongoDB\Driver\BulkWrite(['ordered' => TRUE]);
  $bulk->update( ['_id' => new \MongoDB\BSON\ObjectID($timetable_id)],
                ['$set' => 
                [
                  'Classroom_id'=>$class_id,
                  'Teachers_id'=>$teacher_id,
                  'Subject'=>$subject_id,
                  'Start'=>new MongoDB\BSON\UTCDateTime(new DateTime($date_start)),
                  'End'=>new MongoDB\BSON\UTCDateTime(new DateTime($date_end)),
                  'Repeat'=>$repeat ,
                  'Status'=>'ACTIVE']
                ],
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
if (isset($_POST['delete_timetable']))
{
  $timetable_id = $_POST['timetable_id'];
  $password = $_POST['password'];
  $password_hash = $_SESSION["loggeduser_ConsumerPassword"];

  if (password_verify($password, $password_hash))
  {
    $bulk = new MongoDB\Driver\BulkWrite;
    $bulk->delete(['_id'=>new \MongoDB\BSON\ObjectID($timetable_id)], ['limit' => 1]);
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
}
?>