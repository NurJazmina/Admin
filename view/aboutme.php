<!-- selection-->
<br><br><br><div class="nav justify-content-center">
  <a class="nav-link" id="v-pills-profile-tab"  data-bs-toggle="pill" href="#v-pills-profile" role="tab" aria-controls="v-pills-profile" aria-selected="true"><h5 style="font-weight:normal; color:darkslategray; text-decoration:none;">PROFILE</h5></a>
  <h5 style="font-weight:normal; color:darkslategray"></h5>
  <a class="nav-link" id="v-pills-attendance-tab" data-bs-toggle="pill" href="#v-pills-attendance" role="tab" aria-controls="v-pills-attendance" aria-selected="false"><h5 style="font-weight:normal; color:darkslategray; text-decoration:none;">ATTENDANCE</h5></a>
  <h5 style="font-weight:normal; color:darkslategray"></h5>
  <a class="nav-link" id="v-pills-remark-tab" data-bs-toggle="pill" href="#v-pills-remark" role="tab" aria-controls="v-pills-remark" aria-selected="false"><h5 style="font-weight:normal; color:darkslategray; text-decoration:none;">REMARKS</h5></a>
  <h5 style="font-weight:normal; color:darkslategray"></h5>
</div>
<div class="tab-content" id="v-pills-tabContent">
<!--tab all profile -->
<div class="tab-pane fade show active" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
<div class="myDiv" style="color:#696969;text-align:center"><br><h1>About Me</h1></div>
<table class="table table-bordered">
  <thead class="table-light">
  </thead>
  <tbody>
    <tr>
      <th scope="row" class="table-secondary">Name</th>
      <td class="table-secondary"><?php echo $_SESSION["loggeduser_consumerFName"]," ",$_SESSION["loggeduser_consumerLName"] ?></td>
    </tr>
    <tr>
    <th scope="row">ID Type</th>
    <td><?php echo $_SESSION["loggeduser_consumerIDType"] ?></td>
    </tr>
    <tr>
       <th scope="row">ID Number</th>
        <td><?php echo $_SESSION["loggeduser_consumerIDNo"] ?></td>
    </tr>
    <tr>
      <th scope="row">Email</th>
    <td><?php echo $_SESSION["loggeduser_consumerEmail"] ?></td>
    </tr>
    <tr>
      <th scope="row">Phone Number</th>
      <td><?php echo $_SESSION["loggeduser_consumerPhone"] ?></td>
    </tr>
    <tr>
      <th scope="row">Address</th>
      <td><?php echo $_SESSION["loggeduser_consumerAddress"] ?></td>
    </tr>
    <tr>
       <th scope="row">Status</th>
       <td><?php echo $_SESSION["loggeduser_consumerStatus"] ?></td>
    </tr>
    <tr>
      <th scope="row">Update</th>
      <td>
        <button type="button"  class="btn btn-success" data-bs-toggle="modal" data-bs-target="#EditDetailModal">
         <i class="fa fa-edit" style="font-size:20px"></i>
        </button>
      </td>
    </tr>
  </tbody>
</table>
</div>
<!--end tab -->

<!--tab by attendance -->
<?php
$vardate = new MongoDB\BSON\UTCDateTime((new DateTime('now'))->getTimestamp()*1000);
$date = $vardate->toDateTime()->setTimezone(new \DateTimeZone(date_default_timezone_get()));
?>
<div class="tab-pane fade" id="v-pills-attendance" role="tabpanel" aria-labelledby="v-pills-attendance-tab">
<div class="myDiv" style="color:#696969;text-align:center"><br><br><br><h1>Attendance</h1></div><br>
<table class="table table-bordered">
 <thead class="table-light">
    <tr>
    <th scope="col"><?php echo $_SESSION["loggeduser_consumerFName"]," ",$_SESSION["loggeduser_consumerLName"] ?></th>
    </tr>
    </thead>
 <tbody>
    <tr>
    <td>
<table>
<?php
$Cards_id='';
$filter = ['_id'=>new \MongoDB\BSON\ObjectId($_SESSION["loggeduser_id"])];
$query = new MongoDB\Driver\Query($filter);
$cursor = $GoNGetzDatabase->executeQuery('GoNGetz.Consumer',$query);

foreach ($cursor as $document)
{
  $consumerid = strval($document->_id);
  $filter1 = ['Consumer_id'=>$consumerid];
  $query1 = new MongoDB\Driver\Query($filter1);
  $cursor1 = $GoNGetzDatabase->executeQuery('GoNGetz.Cards',$query1);

  foreach ($cursor1 as $document1)
  {
    $Cards_id = strval($document1->Cards_id);
    $varcount = 0;
    $filterA = ['CardID'=>$Cards_id];
    $optionA = ['sort' => ['_id' => -1]];
    $queryA = new MongoDB\Driver\Query($filterA,$optionA);
    $cursorA = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Attendance',$queryA);
    foreach ($cursorA as $documentA)
    {
      $AttendanceDate = new MongoDB\BSON\UTCDateTime(strval($documentA->AttendanceDate));
      $attendance = $AttendanceDate->toDateTime()->setTimezone(new \DateTimeZone(date_default_timezone_get()));
      $today = date_format($date,"d/m/Y");
      $attendancetoday = date_format($attendance,"d/m/Y");
      //value is odd=out
      if ($varcount % 2)
      {
        do
        {
          ?>
          <td style="text-align:right;">OUT</td>
          <td><i class="fas fa-arrow-circle-right"></i></td>
          <td><?php echo date_format($attendance,"H:i"); ?></td>
          <td></td>
        </tr>
        <?php
        $varcount = $varcount + 1;
        }
      while ($varcount <='0');
      }
      //value is even=in
      else
      {
        do
        {
        ?>
        <tr>
          <td><?php echo date_format($attendance,"d/m/Y"); ?></td>
        </tr>
        <tr>
          <td style="text-align:right;">IN</td>
          <td><i class="fas fa-arrow-circle-right"></i></td>
          <td><?php echo date_format($attendance,"H:i"); ?></td>
          <td>|</td>
        <?php
        $varcount = $varcount + 1;
        }
      while ($varcount <='0');
      }
    }
  }
}
?>
</tr>
</table>
<br>
    </td>
  </tr>
  </tbody>
  </table>
 </div>
<!-- end tab -->

<!--tab by exam schedule -->
<div class="tab-pane fade" id="v-pills-remark" role="tabpanel" aria-labelledby="v-pills-remark-tab">
<div class="myDiv" style="color:#696969;text-align:center"><br><br><br><h1>REMARKS</h1></div><br>
  <table class="table table-bordered">
    <thead class="table-light">
    </thead>
    <tbody>
      <tr>
        <th scope="row" class="table-secondary">Name</th>
        <td class="table-secondary"><?php echo $_SESSION["loggeduser_consumerFName"]," ",$_SESSION["loggeduser_consumerLName"] ?></td>
      </tr>
      <tr>
        <th scope="row">Date</th>
        <td><?php ?></td>
      </tr>
    </tbody>
  </table>
 </div>
<!-- end tab -->
</div>
</div>
