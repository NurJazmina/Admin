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
 $totalstudent = $totalstudent+ 1;
}
$_SESSION["totalstudent"] = $totalstudent;

$filter = ['Schools_id'=>$_SESSION["loggeduser_schoolID"]];
$query = new MongoDB\Driver\Query($filter);
$cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Parents',$query);
$totalparent = 0;
foreach ($cursor as $document)
{
  $totalparent = $totalparent + 1;
}
$_SESSION["totalparent"] = $totalparent;
