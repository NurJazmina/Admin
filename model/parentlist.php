<?php
//Add parent
if (isset($_POST['submitaddparent']))
{
  //add parent
  $varschoolID = strval($_SESSION["loggeduser_schoolID"]);
  $varConsumerIDNo = $_POST['txtConsumerIDNo'];
  $filter = ['ConsumerIDNo'=>$varConsumerIDNo];
  $query = new MongoDB\Driver\Query($filter);
  $cursor = $GoNGetzDatabase->executeQuery('GoNGetz.Consumer',$query);

  foreach ($cursor as $document)
  {
  $ID = strval($document->_id);
  $ConsumerFName = strval($document->ConsumerFName);
  $varParentRegDate = new MongoDB\BSON\UTCDateTime((new DateTime('now'))->getTimestamp()*1000);
  $bulk = new MongoDB\Driver\BulkWrite(['ordered' => TRUE]);
  $bulk->insert(['ConsumerID'=>$ID,'Schools_id'=> $varschoolID,'ParentStatus'=> "ACTIVE",'ParentAddDate'=>$varParentRegDate]);
  $writeConcern = new MongoDB\Driver\WriteConcern(MongoDB\Driver\WriteConcern::MAJORITY, 1000);
  try
  {
    $result = $GoNGetzDatabase->executeBulkWrite('GoNGetzSmartSchool.Parents', $bulk, $writeConcern);
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
  //add student
  $varConsumerIDNoChild = $_POST['txtConsumerIDNoChild'];
  $varstudentclass = $_POST['txtstudentclass'];
  $filter = ['ConsumerIDNo'=>$varConsumerIDNoChild];
  $query = new MongoDB\Driver\Query($filter);
  $cursor = $GoNGetzDatabase->executeQuery('GoNGetz.Consumer',$query);
  foreach ($cursor as $document)
  {
  $studentID = strval($document->_id);
  $bulk = new MongoDB\Driver\BulkWrite(['ordered' => TRUE]);
  $bulk->insert(['Consumer_id'=>$studentID,'Schools_id'=> $varschoolID,'Class_id'=>$varstudentclass,'StudentsStatus'=>"ACTIVE"]);
  $writeConcern = new MongoDB\Driver\WriteConcern(MongoDB\Driver\WriteConcern::MAJORITY, 1000);
  try
  {
    $result =$GoNGetzDatabase->executeBulkWrite('GoNGetzSmartSchool.Students', $bulk, $writeConcern);
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
  //add relation
  $varrelation = $_POST['txtrelation'];
  $filter = ['ConsumerIDNo'=>$varConsumerIDNo];
  $query = new MongoDB\Driver\Query($filter);
  $cursor =$GoNGetzDatabase->executeQuery('GoNGetz.Consumer',$query);
  foreach ($cursor as $document)
  {
  $Parentid = strval($document->_id);
  $filter1 = ['ConsumerID'=>$Parentid];
  $query1 = new MongoDB\Driver\Query($filter1);
  $cursor1 =$GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Parents',$query1);
  foreach ($cursor1 as $document1)
  {
  $parentid = strval($document1->_id);
  }
  }
  $filter = ['ConsumerIDNo'=>$varConsumerIDNoChild];
  $query = new MongoDB\Driver\Query($filter);
  $cursor =$GoNGetzDatabase->executeQuery('GoNGetz.Consumer',$query);
  foreach ($cursor as $document)
  {
  $childid = strval($document->_id);
  $filter1 = ['Consumer_id'=>$childid];
  $query1 = new MongoDB\Driver\Query($filter1);
  $cursor1 =$GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Students',$query1);
  foreach ($cursor1 as $document1)
  {
  $studentid = strval($document1->_id);
  }
  }
  $bulk1 = new MongoDB\Driver\BulkWrite(['ordered' => TRUE]);
  $bulk1->insert(['ParentID'=>$parentid,'StudentID'=>$studentid,'ParentStudentRelation'=>$varrelation,'Schools_id'=>$varschoolID,'ParentStudentRelationStatus'=>'ACTIVE']);
  $writeConcern = new MongoDB\Driver\WriteConcern(MongoDB\Driver\WriteConcern::MAJORITY, 1000);
  try
  {
    $result =$GoNGetzDatabase->executeBulkWrite('GoNGetzSmartSchool.ParentStudentRel', $bulk1, $writeConcern);
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

//Edit parent
if (isset($_POST['submiteditparent']))
{
  $varschoolID = strval($_SESSION["loggeduser_schoolID"]);
  $varparentid = $_POST['txtparentid'];
  $varstudentid = $_POST['txtstudentid'];
  $varrelation = $_POST['txtrelation'];
  $varstudentclass = $_POST['txtstudentclass'];
  $bulk = new MongoDB\Driver\BulkWrite(['ordered' => TRUE]);
  $bulk->insert(['ParentID'=>$varparentid,'StudentID'=>$varstudentid,'ParentStudentRelation'=>$varrelation,'Schools_id'=>$varschoolID,'ParentStudentRelationStatus'=>'ACTIVE']);
  $writeConcern = new MongoDB\Driver\WriteConcern(MongoDB\Driver\WriteConcern::MAJORITY, 1000);
  try
  {
    $result =$GoNGetzDatabase->executeBulkWrite('GoNGetzSmartSchool.ParentStudentRel', $bulk, $writeConcern);
  }
  catch (MongoDB\Driver\Exception\BulkWriteException $e)
  {
    $result = $e->getWriteResult();
    $_SESSION["loggeduser_schoolName"] = $varschoolname;
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

    //add student
    $bulk = new MongoDB\Driver\BulkWrite(['ordered' => TRUE]);
    $bulk->insert(['Consumer_id'=>$varstudentid,'Schools_id'=> $varschoolID,'Class_id'=>$varstudentclass,'StudentsStatus'=>"ACTIVE"]);
    $writeConcern = new MongoDB\Driver\WriteConcern(MongoDB\Driver\WriteConcern::MAJORITY, 1000);
    try
    {
      $result =$GoNGetzDatabase->executeBulkWrite('GoNGetzSmartSchool.Students', $bulk, $writeConcern);
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

//De/activate parent 
if (isset($_POST['StatusParentFormSubmit']))
{
  $varparentid = $_POST['txtparentid'];
  $varparentStatus = $_POST['txtparentStatus'];
  $varConsumerRemarksDetails = $_POST['txtConsumerRemarksDetails'];

  $filter = ['_id'=>new \MongoDB\BSON\ObjectID($varparentid)];
  $query = new MongoDB\Driver\Query($filter);
  $cursor =$GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Parents',$query);
  foreach ($cursor as $document)
  {
    $consumerid = strval($document->ConsumerID);
  }
  $bulk = new MongoDB\Driver\BulkWrite(['ordered' => TRUE]);
  $bulk->update(['_id' => new \MongoDB\BSON\ObjectID($varparentid)],
                ['$set' => ['ParentStatus'=>$varparentStatus]],
                ['upsert' => TRUE]
               );
  $writeConcern = new MongoDB\Driver\WriteConcern(MongoDB\Driver\WriteConcern::MAJORITY, 1000);
  try
  {
    $result =$GoNGetzDatabase->executeBulkWrite('GoNGetzSmartSchool.Parents', $bulk, $writeConcern);
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
  $varstaffid = strval($_SESSION["loggeduser_id"]);
  $varschoolid = strval($_SESSION["loggeduser_schoolID"]);
  $varconsumerremarkdate = new MongoDB\BSON\UTCDateTime((new DateTime('now'))->getTimestamp()*1000);
  $bulk = new MongoDB\Driver\BulkWrite(['ordered'=>true]);
  $bulk->insert([
    'SubRemarks'=>'0',
    'Consumer_id'=>$consumerid,
    'ConsumerRemarksDetails'=>$varConsumerRemarksDetails,
    'ConsumerRemarksStaff_id'=>$varstaffid,
    'school_id'=>$varschoolid,
    'ConsumerRemarksDate'=>$varconsumerremarkdate,
    'ConsumerRemarksStatus'=>'ACTIVE']);
  $writeConcern = new MongoDB\Driver\WriteConcern(MongoDB\Driver\WriteConcern::MAJORITY, 1000);
  try
  {
    $result = $GoNGetzDatabase->executeBulkWrite('GoNGetzSmartSchool.ParentRemarks', $bulk, $writeConcern);
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
  printf("Matched: %d\n", $result->getMatchedCount());
  printf("Deactivate %d document(s)\n", $result->getModifiedCount());
}

//List parent
  if (isset($_GET['paging']) && !empty($_GET['paging']))
  {
    $datapaging = ($_GET['paging']*50);
    $pagingprevious = $_GET['paging']-1;
    $pagingnext = $_GET['paging']+1;
  } else
  {
    $datapaging = 0;
  }
  if (!isset($_POST['searchname']) && empty($_POST['searchname']))
  {
    $filter = ['Schools_id'=>$_SESSION["loggeduser_schoolID"]];
    $option = ['limit'=>50,'skip'=>$datapaging,'sort' => ['_id' => -1]];
    $query = new MongoDB\Driver\Query($filter,$option);
    $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Parents',$query);
  }
  else
  {
    $IDnumber = ($_POST['IDnumber']);
    $filter = [NULL];
    $query = new MongoDB\Driver\Query($filter);
    $cursor = $GoNGetzDatabase->executeQuery('GoNGetz.Consumer',$query);
    foreach ($cursor as $document)
    {
      $idx = strval($document->_id);
      $ConsumerIDNox = strval($document->ConsumerIDNo);
      $ConsumerFNamex = strval($document->ConsumerFName);
      if ($ConsumerIDNox==$IDnumber || $ConsumerFNamex==$IDnumber)
      {
        $filter = ['Schools_id'=>$_SESSION["loggeduser_schoolID"], 'ConsumerID'=>$idx];
        $query = new MongoDB\Driver\Query($filter);
        $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Parents',$query);
      }
    }
  }
?>