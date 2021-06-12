<?php
if (isset($_POST['submitaddclass']))
{
  $varschoolID = strval($_SESSION["loggeduser_schoolID"]);
  $varClasscategory = $_POST['txtClasscategory'];
  $varClassName = $_POST['txtclassname'];
  $varConsumerIDNo = $_POST['txtConsumerIDNo'];
  $varconsumerid = $_POST['txtconsumerid'];
  $bulk = new MongoDB\Driver\BulkWrite(['ordered' => TRUE]);
  $bulk->insert(['SchoolID'=>$varschoolID,'ClassCategory'=> $varClasscategory,'ClassName'=>$varClassName]);
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
  $filter = ['SchoolID' => $_SESSION["loggeduser_schoolID"], 'ClassCategory'=>$varClasscategory ,'ClassName'=> $varClassName];
  $query = new MongoDB\Driver\Query($filter);
  $cursor = $GoNGetzSmartSchoolFrontEnd->executeQuery('GoNGetzSmartSchool.Classrooms',$query);

  foreach ($cursor as $document)
  {
    $idclass = strval($document->_id);
  }

  //insert class id into our staff database
  $bulk = new MongoDB\Driver\BulkWrite(['ordered' => TRUE]);
  $bulk->update(['ConsumerID'=> $varconsumerid],
                ['$set' => ['ClassID'=> $idclass]],
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


//Edit Class
if (isset($_POST['submiteditclass']))
{
  $varclassid = $_POST['txtclassid'];
  $varclassname = $_POST['txtclassname'];
  $varclasscategory = $_POST['txtclasscategory'];
  $schoolid = strval($_SESSION["loggeduser_schoolID"]);

  $bulk = new MongoDB\Driver\BulkWrite(['ordered' => TRUE]);
  $bulk->delete(['Class_id'=> $varclassid]);
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

  $number = $_POST['txtnumber'];
  for ($x = 1; $x <= $number; $x++)
  { 
    $varteacher[$x] = $_POST['teacher'.$x];
    $varsubject[$x] = $_POST['subject'.$x];

    $bulk = new MongoDB\Driver\BulkWrite(['ordered' => TRUE]);
    $bulk->insert([
      'Class_id'=>$varclassid,
      'School_id'=>$schoolid,
      'Subject_id'=>$varsubject[$x],
      'Teacher_id'=>$varteacher[$x] 
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


//Delete Class
if (isset($_POST['DeleteclassFormSubmit']))
{
  $varclassid = $_POST['txtclassid'];
  $bulk = new MongoDB\Driver\BulkWrite;
  $bulk->delete(['_id'=> new \MongoDB\BSON\ObjectID($varclassid)], ['limit' => 1]);
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