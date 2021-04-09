<?php
$filter = ['SchoolID'=>$_SESSION["loggeduser_schoolID"], 'StaffLevel'=>'1'];
$query = new MongoDB\Driver\Query($filter);
$cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Staff',$query);
$totalstaff = 0;
foreach ($cursor as $document)
{
  $totalstaff = $totalstaff + 1;
}
$_SESSION["totalstaff"] = $totalstaff;
?>

<?php
$filter = ['SchoolID'=>$_SESSION["loggeduser_schoolID"], 'StaffLevel'=>'0'];
$query = new MongoDB\Driver\Query($filter);
$cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Staff',$query);
$totalteacher= 0;
foreach ($cursor as $document)
{
  $totalteacher= $totalteacher + 1;
}
$_SESSION["totalteacher"] = $totalteacher;
?>

<?php
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
?>

<?php
$filter = ['Schools_id'=>$_SESSION["loggeduser_schoolID"]];
$query = new MongoDB\Driver\Query($filter);
$cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.ParentStudentRel',$query);
$totalparent = 0;
foreach ($cursor as $document)
{
 $ParentID = array($document->ParentID);
}
$_SESSION["totalparent"] = $totalparent;
?>

<?php
$filter = ['_id'=>new \MongoDB\BSON\ObjectId($_SESSION["loggeduser_schoolID"])];
$query = new MongoDB\Driver\Query($filter);
$cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Schools',$query);
foreach ($cursor as $document)
{
 $SchoolsPhoneNo =($document->SchoolsPhoneNo);
}