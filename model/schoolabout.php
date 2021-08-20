<?php
if (isset($_POST['EditSchoolFormSubmit']))
{
  $varSchoolsPhoneNo = $_POST['txtSchoolsPhoneNo'];
  $varschoolid = $_SESSION["loggeduser_schoolID"];
  $bulk = new MongoDB\Driver\BulkWrite(['ordered' => TRUE]);
  $bulk->update(['_id' => new \MongoDB\BSON\ObjectID($varschoolid)],
                ['$set' => ['SchoolsPhoneNo'=>$varSchoolsPhoneNo]],
                ['upsert' => TRUE]
               );
  $writeConcern = new MongoDB\Driver\WriteConcern(MongoDB\Driver\WriteConcern::MAJORITY, 1000);
  try
  {
    $result = $GoNGetzDatabase->executeBulkWrite('GoNGetzSmartSchool.Schools', $bulk, $writeConcern);
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
  printf("Matched: %d\n", $result->getMatchedCount());
  printf("Updated  %d document(s)\n", $result->getModifiedCount());
}

$filter = ['SchoolID'=>$_SESSION["loggeduser_schoolID"], 'StaffLevel'=>'1'];
$query = new MongoDB\Driver\Query($filter);
$cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Staff',$query);
$totalstaff = 0;
foreach ($cursor as $document)
{
  $totalstaff = $totalstaff + 1;
}
$_SESSION["totalstaff"] = $totalstaff;


$filter = ['SchoolID'=>$_SESSION["loggeduser_schoolID"], 'StaffLevel'=>'0'];
$query = new MongoDB\Driver\Query($filter);
$cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Staff',$query);
$totalteacher= 0;
foreach ($cursor as $document)
{
  $totalteacher= $totalteacher + 1;
}
$_SESSION["totalteacher"] = $totalteacher;


$filter = ['Schools_id' => $_SESSION["loggeduser_schoolID"]];
$query = new MongoDB\Driver\Query($filter);
$cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Students',$query);
$totalstudent = 0;
foreach ($cursor as $document)
{
 $varStudentsSchoolId = strval($document->Schools_id);
 $totalstudent = $totalstudent+ 1;
}
$_SESSION["totalstudent"] = $totalstudent;


$filter = ['Schools_id'=>$_SESSION["loggeduser_schoolID"]];
$query = new MongoDB\Driver\Query($filter);
$cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.ParentStudentRel',$query);
$totalparent = 0;
foreach ($cursor as $document)
{
 $ParentID = array($document->ParentID);
}
$_SESSION["totalparent"] = $totalparent;


$filter = ['_id'=>new \MongoDB\BSON\ObjectId($_SESSION["loggeduser_schoolID"])];
$query = new MongoDB\Driver\Query($filter);
$cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Schools',$query);
foreach ($cursor as $document)
{
 $SchoolsPhoneNo =($document->SchoolsPhoneNo);
}