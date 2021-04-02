<?php
if (!isset($_GET['id']) && empty($_GET['id']))
{
    ?>
    <div class="table-responsive">
    <div class="row">
    <div class="col-md-1 section-1-box wow fadeInUp"></div>
    <div class="col-md-10 section-1-box wow fadeInUp"><br><br><br>
        <div class="table-responsive" style="text-align: center;">
        <table id="attendance" class="table table-bordered ">
        <thead class="table-light">
            <tr>
            <th scope="col" style="color:#696969; text-align:center">Staff ID</th>
            <th scope="col" style="color:#696969; text-align:center">Staff Name</th>
            <th scope="col" style="color:#696969; text-align:center">Date</th>
            <th scope="col" style="color:#696969; text-align:center">IN | OUT</th>
            </tr>
        </thead>
        <tbody>
        <?php
        $filter = ['SchoolID'=>$_SESSION["loggeduser_schoolID"]];
        $query = new MongoDB\Driver\Query($filter);
        $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Staff',$query);
        foreach ($cursor as $document)
        {
        $ConsumerID = strval($document->ConsumerID);

        $filter = ['_id'=>new \MongoDB\BSON\ObjectId($ConsumerID)];
        $query = new MongoDB\Driver\Query($filter);
        $cursor = $GoNGetzDatabase->executeQuery('GoNGetz.Consumer',$query);
        foreach ($cursor as $document)
        {
        $_SESSION["staffremarkid"] = strval($document->_id);
        $ConsumerFName = ($document->ConsumerFName);
        $ConsumerLName = ($document->ConsumerLName);
        $ConsumerIDNo = ($document->ConsumerIDNo);
        $consumerid = strval($document->_id);
        $varnow = date("d-m-Y");
        /**
        * @todo Red for blank
        * @body Buatkan kalau tak ada data, background barisan penama warna #FF0000. Sama juga dengan student dan class room
        */
        ?>
        <tr>
            <td style="text-align:center"><?php echo $ConsumerIDNo; ?></td>
            <td style="text-align:center"><?php echo $ConsumerFName." ".$ConsumerLName; ?></td>
            <td style="text-align:center"><?php echo $varnow."<br>"; ?></td>
            <td style="text-align:center">
        <?php
        $Cards_id ='';
        $filter1 = ['Consumer_id'=>$consumerid];
        $query1 = new MongoDB\Driver\Query($filter1);
        $cursor1 = $GoNGetzDatabase->executeQuery('GoNGetz.Cards',$query1);
        foreach ($cursor1 as $document1)
        {
        $Cards_id = strval($document1->Cards_id);
        }

        $to_date = new MongoDB\BSON\UTCDateTime((new DateTime('now'))->getTimestamp()*1000);
        $varcount = 0;
        $filterA = ['CardID'=>$Cards_id, 'AttendanceDate' => ['$gte' => $to_date]];
        $queryA = new MongoDB\Driver\Query($filterA);
        $cursorA = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Attendance',$queryA);
        $varcounting = 0;
        foreach ($cursorA as $documentA)
        {
        $varcounting = $varcounting +1;
        if ($varcounting % 2){
            $displayinout = "In: ";
        } else {
            $displayinout = " | Out: ";
        }
        $AttendanceDate = ($documentA->AttendanceDate);
        if (!isset($datecapture) && empty($datecapture)) {
            $datecapture = $AttendanceDate;
        }
        $utcdatetime = new MongoDB\BSON\UTCDateTime(strval($AttendanceDate));
        $AttendanceDate = $utcdatetime->toDateTime()->setTimezone(new \DateTimeZone(date_default_timezone_get()));
        if ($datecapture!=$AttendanceDate) {
        echo $displayinout . date_format($AttendanceDate,"H:i:sa");
        }
        }
        ?>
        </td>
        </tr>
        <?php
        }
    }
?>
</tbody>
</table>
<button type="button" class="btn btn-success"><a href="index.php?page=exportstaffattendance&attendance=<?php echo "xls"; ?>" tabindex="-1" data-type="alpha" style="color:#FFFFFF; text-decoration: none;">EXPORT ATTENDANCE TO XLS</a></button>
</div>
</div>
<div class="col-md-1 section-1-box wow fadeInUp"></div>
</div>
</div>
<?php
if (!isset($_GET['attendance']) && empty($_GET['attendance']))
{

}
else
{
$attendance = ($_GET['attendance']);
?>
<script>
  $(document).ready(function () {
     $("#attendance").table2excel({
         filename: "attendancestaff.xls"
     });
  });
   
 </script>
<?php
}
}
else
{
    $id = new \MongoDB\BSON\ObjectId($_GET['id']);
    $filter = ['_id'=>$id];
    $query = new MongoDB\Driver\Query($filter);
    $cursor = $GoNGetzDatabase->executeQuery('GoNGetz.Consumer',$query);
    foreach ($cursor as $document){
      $_SESSION["staffremarkid"] = strval($document->_id);
      $ConsumerFName = ($document->ConsumerFName);
      $ConsumerLName = ($document->ConsumerLName);
      $ConsumerIDNo = ($document->ConsumerIDNo);
    }
    ?>
    <div class="table-responsive">
    <div class="row">
    <div class="col-md-1 section-1-box wow fadeInUp"></div>
    <div class="col-md-10 section-1-box wow fadeInUp"><br><br><br>

        <div class="table-responsive" style="text-align: center;">
        <button type="button" style="font-size:15px width:25%" class="btn btn-success"><a href="index.php?page=exportstaffattendance&id=<?php echo $_GET['id']; ?>&attendance=<?php echo "xls"; ?>" tabindex="-1" data-type="alpha" style="color:#FFFFFF; text-decoration: none;">EXPORT ATTENDANCE TO XLS</a></button>
        <table id="attendance" class="table table-bordered ">
        <thead class="table-light">
            <tr>
            <th scope="col" style="color:#696969; text-align:center">Staff ID</th>
            <th scope="col" style="color:#696969; text-align:center">Staff Name</th>
            <th scope="col" style="color:#696969; text-align:center">Date</th>
            <th scope="col" style="color:#696969; text-align:center">IN | OUT</th>
            </tr>
        </thead>
        <tbody>
        <tr>
            <td style="text-align:center"><?php echo "<br>".$ConsumerIDNo; ?></td>
            <td style="text-align:center"><?php echo "<br>".$ConsumerFName." ".$ConsumerLName; ?></td>
            <td style="text-align:center">
        <?php
        $Cards_id='';
        $filter1 = ['Consumer_id'=>$_GET['id']];
        $query1 = new MongoDB\Driver\Query($filter1);
        $cursor1 = $GoNGetzDatabase->executeQuery('GoNGetz.Cards',$query1);
        foreach ($cursor1 as $document1)
        {
        $Cards_id = strval($document1->Cards_id);
        }
        /*
        check date
        $convert = $from_date->toDateTime()->setTimezone(new \DateTimeZone(date_default_timezone_get()));
        echo "<br>to_date: ".$to_date."<br>";
        echo "from_date: ".$from_date."<br>";
        $display = date_format($convert,"d/m/Y");
        echo $display;
        */
        $to_date = new MongoDB\BSON\UTCDateTime((new DateTime('now'))->getTimestamp()*1000);
        $from_date = new MongoDB\BSON\UTCDateTime((new DateTime('now -1 month'))->getTimestamp()*1000);

        $filter2 = ['CardID'=>$Cards_id ,'AttendanceDate' => ['$gte' => $from_date,'$lte' => $to_date]];
        $query2 = new MongoDB\Driver\Query($filter2);
        $cursor2 = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Attendance',$query2);
        $varcounting = 0;
        
        foreach ($cursor2 as $document2)
        {
          $AttendanceDate = ($document2->AttendanceDate);
          $utcdatetime = new MongoDB\BSON\UTCDateTime(strval($AttendanceDate));
          $AttendanceDate = $utcdatetime->toDateTime()->setTimezone(new \DateTimeZone(date_default_timezone_get()));
          $varcounting = $varcounting +1;
          if ($varcounting % 2)
          {
          } 
          else 
          {
            echo "<br>".date_format($AttendanceDate,"d-m-Y");
          }
        }
        ?>
        </td>
        <td style="text-align:center">
        <?php
        $filterA = ['CardID'=>$Cards_id ,'AttendanceDate' => ['$gte' => $from_date,'$lte' => $to_date]];
        $queryA = new MongoDB\Driver\Query($filterA);
        $cursorA = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Attendance',$queryA);
        $varcounting = 0;
        
        foreach ($cursorA as $documentA)
        {
        $varcounting = $varcounting +1;
        if ($varcounting % 2){
            $displayinout = "<br>In: ";
        } else {
            $displayinout = " | Out: ";
        }
        $AttendanceDate = ($documentA->AttendanceDate);
        if (!isset($datecapture) && empty($datecapture)) {
            $datecapture = $AttendanceDate;
        }
        $utcdatetime = new MongoDB\BSON\UTCDateTime(strval($AttendanceDate));
        $AttendanceDate = $utcdatetime->toDateTime()->setTimezone(new \DateTimeZone(date_default_timezone_get()));
        if ($datecapture!=$AttendanceDate) {
        echo $displayinout .date_format($AttendanceDate,"H:i:sa");
        }
        }
        ?>
        </td>
        </tr>
   </tbody>
   </table>
   </div>
   </div>
   <div class="col-md-1 section-1-box wow fadeInUp"></div>
   </div>
   </div>
<?php
if (!isset($_GET['attendance']) && empty($_GET['attendance']))
{

}
else
{
$attendance = ($_GET['attendance']);
?>
<script>
  $(document).ready(function () {
     $("#attendance").table2excel({
         filename: "attendancestaff.xls"
     });
  });
   
 </script>
<?php
}
}
