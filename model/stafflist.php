<?php
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
  
  if (!isset($_POST['searchstaff']) && empty($_POST['searchstaff']))
  {
    //sorting by category
    if (!isset($_GET['level']) && empty($_GET['level']))
    {
    $filter = ['SchoolID'=>$_SESSION["loggeduser_schoolID"]];
    $option = ['limit'=>50,'skip'=>$datapaging,'sort' => ['_id' => -1]];
    $query = new MongoDB\Driver\Query($filter,$option);
    $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Staff',$query);
    }
    else
    {
    $sort = ($_GET['level']);
    $filter = ['SchoolID'=>$_SESSION["loggeduser_schoolID"],
              'StaffLevel'=>$sort];
    $option = ['limit'=>50,'skip'=>$datapaging,'sort' => ['_id' => -1]];
    $query = new MongoDB\Driver\Query($filter,$option);
    $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Staff',$query);
    }
  }
  else
  {
    //search using name/id number
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
        $filter = ['SchoolID'=>$_SESSION["loggeduser_schoolID"], 'ConsumerID'=>$idx];
        $query = new MongoDB\Driver\Query($filter);
        $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Staff',$query);

      }
    }
  }
?>
<?php


//Add school staff
if (isset($_POST['submitaddstaff']))
{

  $varschoolID = strval($_SESSION["loggeduser_schoolID"]);
  $varConsumerIDNo = $_POST['txtConsumerIDNo'];
  $varStaffdepartment = strval($_SESSION["departmentid"]);
  $varDepartmentName = strval($_SESSION["DepartmentName"]);
  $varStaffstatus = $_POST['txtStaffstatus'];
  $varteacherclass = $_POST['txtteacherclass'];

  $filter = ['ConsumerIDNo'=>$varConsumerIDNo];
  $query = new MongoDB\Driver\Query($filter);
  $cursor = $GoNGetzDatabase->executeQuery('GoNGetz.Consumer',$query);
  foreach ($cursor as $document)
  {
  $ID = strval($document->_id);
  $ConsumerFName = strval($document->ConsumerFName);
  $bulk = new MongoDB\Driver\BulkWrite(['ordered' => TRUE]);
  if ($varDepartmentName !== "TEACHER")
  {
    $bulk->insert([
      'ConsumerID'=>$ID,
      'SchoolID'=> $varschoolID,
      'ClassID'=> "",
      'StaffLevel'=>"1",
      'Staffdepartment'=> $varStaffdepartment,
      'StaffStatus'=>$varStaffstatus]);
  }
  else
  {
    $bulk->insert([
      'ConsumerID'=>$ID,
      'SchoolID'=> $varschoolID,
      'ClassID'=> $varteacherclass,
      'StaffLevel'=>"0",
      'Staffdepartment'=> $varStaffdepartment,
      'StaffStatus'=>$varStaffstatus]);
  }
  $writeConcern = new MongoDB\Driver\WriteConcern(MongoDB\Driver\WriteConcern::MAJORITY, 1000);
  try
  {
    $result=$GoNGetzDatabase->executeBulkWrite('GoNGetzSmartSchool.Staff', $bulk, $writeConcern);
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
  printf("Matched: %d\n", $result->getMatchedCount());
  printf("Updated  %d document(s)\n", $result->getModifiedCount());
  }
}

//Edit school staff
if (isset($_POST['submiteditstaff']))
{

  $Teacherclass = $_POST['txtteacherclass'];
  $Classcategory = $_POST['txtClasscategory'];
  $Teacherid= $_POST['teacherid'];
  $bulk = new MongoDB\Driver\BulkWrite(['ordered' => TRUE]);
  $bulk->update(['ConsumerID'=> $Teacherid],
                ['$set' => ['ClassID'=>$Teacherclass]],
                ['upsert' => TRUE]
               );
  $writeConcern = new MongoDB\Driver\WriteConcern(MongoDB\Driver\WriteConcern::MAJORITY, 1000);

  try
  {
    $result=$GoNGetzDatabase->executeBulkWrite('GoNGetzSmartSchool.Staff', $bulk, $writeConcern);
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
  printf("Matched: %d\n", $result->getMatchedCount());
  printf("Updated  %d document(s)\n", $result->getModifiedCount());
}

//Change status school staff
if (isset($_POST['StatusStaffFormSubmit']))
{

  $varstaffid = $_POST['txtstaffid'];
  $varStaffStatus = $_POST['txtStaffStatus'];
  $varConsumerRemarksDetails = $_POST['txtConsumerRemarksDetails'];

  $bulk = new MongoDB\Driver\BulkWrite(['ordered' => TRUE]);
  $bulk->update(['ConsumerID'=>$varstaffid],
                ['$set' => ['StaffStatus'=>$varStaffStatus]],
                ['upsert' => TRUE]
               );
  $writeConcern = new MongoDB\Driver\WriteConcern(MongoDB\Driver\WriteConcern::MAJORITY, 1000);
  $result =$GoNGetzDatabase->executeBulkWrite('GoNGetzSmartSchool.Staff', $bulk, $writeConcern);

  $varstaffremark = strval($_SESSION["loggeduser_id"]);
  $varschoolid = strval($_SESSION["loggeduser_schoolID"]);
  $varconsumerremarkdate = new MongoDB\BSON\UTCDateTime((new DateTime('now'))->getTimestamp()*1000);

  $bulk1 = new MongoDB\Driver\BulkWrite(['ordered'=>true]);
  $bulk1->insert([
    'SubRemarks'=>'0',
    'Consumer_id'=>$varstaffid,
    'ConsumerRemarksDetails'=>$varConsumerRemarksDetails,
    'ConsumerRemarksStaff_id'=>$varstaffremark,
    'school_id'=>$varschoolid,
    'ConsumerRemarksDate'=>$varconsumerremarkdate,
    'ConsumerRemarksStatus'=>'ACTIVE']);

  $writeConcern = new MongoDB\Driver\WriteConcern(MongoDB\Driver\WriteConcern::MAJORITY, 1000);
  try
  {
    $result =$GoNGetzDatabase->executeBulkWrite('GoNGetzSmartSchool.StaffRemarks', $bulk1, $writeConcern);
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
  printf("Matched: %d\n", $result->getMatchedCount());
  printf("Update %d document(s)\n", $result->getModifiedCount());
}
?>
