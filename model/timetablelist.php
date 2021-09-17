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
  $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.ClassroomSubjectRel',$query);
  foreach ($cursor as $document)
  {
    $check = 1;
  }
  if($check == 0)
  {
    $bulk = new MongoDB\Driver\BulkWrite(['ordered' => TRUE]);
    $bulk->insert([
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
    $result = $GoNGetzDatabase->executeBulkWrite('GoNGetzSmartSchool.ClassroomSubjectRel', $bulk, $writeConcern);
  }
}

//Edit timetable
if (isset($_POST['edit_timetable']))
{
  $class_rel_id = $_POST['class_rel_id'];
  $class_id = $_POST['class_id'];
  $teacher_id = $_POST['teacher_id'];
  $subject_id = $_POST['subject_id'];
  $date_start = $_POST['date_start'];
  $date_end = $_POST['date_end'];
  $repeat = $_POST['repeat'];
  $status = $_POST['status'];

    $bulk = new MongoDB\Driver\BulkWrite(['ordered' => TRUE]);
    $bulk->update(['_id' => new \MongoDB\BSON\ObjectID($class_rel_id)],
    ['$set' => 
      [
        'Class_id'=>$class_id,
        'Teacher_id'=>$teacher_id,
        'Subject_id'=>$subject_id,
        'Start'=>new MongoDB\BSON\UTCDateTime(new DateTime($date_start)),
        'End'=>new MongoDB\BSON\UTCDateTime(new DateTime($date_end)),
        'Repeat'=>$repeat,
        'Status'=>$status
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
  $class_rel_id = $_POST['class_rel_id'];
  $password = $_POST['password'];
  $password_hash = $_SESSION["loggeduser_ConsumerPassword"];

  if (password_verify($password, $password_hash))
  {
    //database relation
    $bulk = new MongoDB\Driver\BulkWrite;
    $bulk->delete(['_id'=>new \MongoDB\BSON\ObjectID($class_rel_id)], ['limit' => 1]);
    $writeConcern = new MongoDB\Driver\WriteConcern(MongoDB\Driver\WriteConcern::MAJORITY, 1000);
    $result = $GoNGetzDatabase->executeBulkWrite('GoNGetzSmartSchool.ClassroomSubjectRel', $bulk, $writeConcern);
  }
}
?>