<?php
//Add timetablelist
if (isset($_POST['add_timetable']))
{
  $school_id = $_SESSION["loggeduser_school_id"];
  $class_id = $_POST['class_id'];
  $teacher_id = $_POST['teacher_id'];
  $subject_id = $_POST['subject_id'];
  $date_start = $_POST['date_start'];
  $date_end = $_POST['date_end'];
  $repeat = $_POST['repeat'];

  $check = 0;
  $filter = ['Class_id' => $class_id, 'Teacher_id'=>$teacher_id,'Subject_id'=> $subject_id];
  $query = new MongoDB\Driver\Query($filter);
  $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.TimeTable',$query);
  foreach ($cursor as $document)
  {
    $check = 1;
  }
  if($check == 0)
  {
    $bulk = new MongoDB\Driver\BulkWrite(['ordered' => TRUE]);
    $bulk->insert
    ([
      'School_id'=>$school_id,
      'Class_id'=>$class_id,
      'Teacher_id'=>$teacher_id,
      'Subject_id'=>$subject_id,
      'Start'=>new MongoDB\BSON\UTCDateTime(new DateTime($date_start)),
      'End'=>new MongoDB\BSON\UTCDateTime(new DateTime($date_end)),
      'Repeat'=>$repeat,
      'Status'=>'ACTIVE'
    ]);
    $writeConcern = new MongoDB\Driver\WriteConcern(MongoDB\Driver\WriteConcern::MAJORITY, 1000);
    $result = $GoNGetzDatabase->executeBulkWrite('GoNGetzSmartSchool.TimeTable', $bulk, $writeConcern);
  
    $filter = ['Class_id' => $class_id, 'Teacher_id'=>$teacher_id,'Subject_id'=> $subject_id];
    $query = new MongoDB\Driver\Query($filter);
    $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.TimeTable',$query);
    foreach ($cursor as $document)
    {
      $timetable_id = strval($document->_id);
    }
  
    $bulk = new MongoDB\Driver\BulkWrite(['ordered' => TRUE]);
    $bulk->insert([
      'School_id'=>$school_id,
      'Timetable_id'=>$timetable_id,
      'Class_id'=>$class_id,
      'Subject_id'=>$subject_id,
      'Teacher_id'=>$teacher_id 
      ]);
    $writeConcern = new MongoDB\Driver\WriteConcern(MongoDB\Driver\WriteConcern::MAJORITY, 1000);
    $result = $GoNGetzDatabase->executeBulkWrite('GoNGetzSmartSchool.ClassroomSubjectRel', $bulk, $writeConcern);
  }
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
  $bulk->update(['_id' => new \MongoDB\BSON\ObjectID($timetable_id)],
                ['$set' => 
                  [
                    'Class_id'=>$class_id,
                    'Teacher_id'=>$teacher_id,
                    'Subject_id'=>$subject_id,
                    'Start'=>new MongoDB\BSON\UTCDateTime(new DateTime($date_start)),
                    'End'=>new MongoDB\BSON\UTCDateTime(new DateTime($date_end)),
                    'Repeat'=>$repeat
                  ]
                ],
                ['multi'=> TRUE]
                );
  $writeConcern = new MongoDB\Driver\WriteConcern(MongoDB\Driver\WriteConcern::MAJORITY, 1000);
  $result = $GoNGetzDatabase->executeBulkWrite('GoNGetzSmartSchool.TimeTable', $bulk, $writeConcern);

  $bulk = new MongoDB\Driver\BulkWrite(['ordered' => TRUE]);
  $bulk->update(['Timetable_id'=> $timetable_id],
                ['$set' => 
                  [
                    'Class_id'=>$class_id,
                    'Teacher_id'=>$teacher_id,
                    'Subject_id'=>$subject_id
                  ]
                ],
                ['multi'=> TRUE]
                );
  $writeConcern = new MongoDB\Driver\WriteConcern(MongoDB\Driver\WriteConcern::MAJORITY, 1000);
  $result = $GoNGetzDatabase->executeBulkWrite('GoNGetzSmartSchool.ClassroomSubjectRel', $bulk, $writeConcern);
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