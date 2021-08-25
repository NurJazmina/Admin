<?php
if (isset($_POST['submitaddclass']))
{
  $school_id = strval($_SESSION["loggeduser_schoolID"]);
  $class_category = $_POST['class_category'];
  $class_name = $_POST['class_name'];
  $consumer_id = $_POST['consumer_id'];

  $bulk = new MongoDB\Driver\BulkWrite(['ordered' => TRUE]);
  $bulk->insert([
                'SchoolID'=>$school_id,
                'ClassCategory'=> $class_category,
                'ClassName'=>$class_name
              ]);
  $writeConcern = new MongoDB\Driver\WriteConcern(MongoDB\Driver\WriteConcern::MAJORITY, 1000);
  try
  {
    $result = $GoNGetzDatabase->executeBulkWrite('GoNGetzSmartSchool.Classrooms', $bulk, $writeConcern);
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
  //call back class id
  $filter = ['SchoolID' => $school_id, 'ClassCategory'=>$class_category,'ClassName'=> $class_name];
  $query = new MongoDB\Driver\Query($filter);
  $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Classrooms',$query);
  foreach ($cursor as $document)
  {
    $class_id = strval($document->_id);
  }
  //insert class id into our staff database
  $bulk = new MongoDB\Driver\BulkWrite(['ordered' => TRUE]);
  $bulk->update(['ConsumerID'=> $consumer_id],
                ['$set' => ['ClassID'=> $class_id]],
                ['upsert' => TRUE]
               );
  $writeConcern = new MongoDB\Driver\WriteConcern(MongoDB\Driver\WriteConcern::MAJORITY, 1000);
  try
  {
    $result =$GoNGetzDatabase->executeBulkWrite('GoNGetzSmartSchool.Staff', $bulk, $writeConcern);
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

if (isset($_POST['submiteditclass']))
{
  $class_id = $_POST['class_id'];
  $class_name = $_POST['class_name'];
  $class_category = $_POST['class_category'];
  $school_id = $_SESSION["loggeduser_schoolID"];

  $bulk = new MongoDB\Driver\BulkWrite(['ordered' => TRUE]);
  $bulk->delete(['Class_id'=> $class_id]);
  $writeConcern = new MongoDB\Driver\WriteConcern(MongoDB\Driver\WriteConcern::MAJORITY, 1000);
  try
  {
    $result = $GoNGetzDatabase->executeBulkWrite('GoNGetzSmartSchool.ClassroomSubjectRel', $bulk, $writeConcern);
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

  $number = $_POST['number'];
  for ($x = 1; $x <= $number; $x++)
  { 
    $teacher[$x] = $_POST['teacher'.$x];
    $subject[$x] = $_POST['subject'.$x];

    $bulk = new MongoDB\Driver\BulkWrite(['ordered' => TRUE]);
    $bulk->insert([
      'Class_id'=>$class_id,
      'School_id'=>$school_id,
      'Subject_id'=>$subject[$x],
      'Teacher_id'=>$teacher[$x] 
      ]);
    $writeConcern = new MongoDB\Driver\WriteConcern(MongoDB\Driver\WriteConcern::MAJORITY, 1000);

    try
    {
      $result = $GoNGetzDatabase->executeBulkWrite('GoNGetzSmartSchool.ClassroomSubjectRel', $bulk, $writeConcern);
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

if (isset($_POST['Deleteclass']))
{
  $class_id = $_POST['class_id'];

  $bulk = new MongoDB\Driver\BulkWrite;
  $bulk->delete(['_id'=> new \MongoDB\BSON\ObjectID($class_id)], ['limit' => 1]);
  $writeConcern = new MongoDB\Driver\WriteConcern(MongoDB\Driver\WriteConcern::MAJORITY, 1000);
  $result = $GoNGetzDatabase->executeBulkWrite('GoNGetzSmartSchool.Classrooms', $bulk, $writeConcern);

  $bulk = new MongoDB\Driver\BulkWrite;
  $bulk->delete(['Class_id'=> $class_id]);
  $writeConcern = new MongoDB\Driver\WriteConcern(MongoDB\Driver\WriteConcern::MAJORITY, 1000);
  $result = $GoNGetzDatabase->executeBulkWrite('GoNGetzSmartSchool.ClassroomSubjectRel', $bulk, $writeConcern);

  $bulk = new MongoDB\Driver\BulkWrite;
  $bulk->update(['ClassID'=> $class_id],
                ['$set' => ['ClassID'=> '']],
                ['upsert' => TRUE]
                );
  $writeConcern = new MongoDB\Driver\WriteConcern(MongoDB\Driver\WriteConcern::MAJORITY, 1000);
  $result = $GoNGetzDatabase->executeBulkWrite('GoNGetzSmartSchool.Staff', $bulk, $writeConcern);

}

if (isset($_GET['paging']) && !empty($_GET['paging']))
{
  $datapaging = ($_GET['paging']*50);
  $pagingprevious = $_GET['paging']-1;
  $pagingnext = $_GET['paging']+1;
}
else
{
  $datapaging = 0;
  $pagingnext = 1;
  $pagingprevious = 0;
}

if (!isset($_POST['searchclass']) && empty($_POST['searchclass']))
{
  if (!isset($_GET['level']) && empty($_GET['level']))
  {
    $filter = ['SchoolID' => $_SESSION["loggeduser_schoolID"]];
    $option = ['limit'=>50,'skip'=>$datapaging,'sort' => ['_id' => -1]];
    $query = new MongoDB\Driver\Query($filter,$option);
    $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Classrooms',$query);
  }
  else
  {
    $sort = ($_GET['level']);
    $filter = ['SchoolID' => $_SESSION["loggeduser_schoolID"],
              'ClassCategory'=>$sort
              ];
    $option = ['limit'=>50,'skip'=>$datapaging,'sort' => ['_id' => -1]];
    $query = new MongoDB\Driver\Query($filter,$option);
    $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Classrooms',$query);
  }
}
else
{
  $classname = ($_POST['classname']);
  $filter = ['SchoolID' => $_SESSION["loggeduser_schoolID"],'ClassName'=>$classname];
  $query = new MongoDB\Driver\Query($filter);
  $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Classrooms',$query);
}
?>