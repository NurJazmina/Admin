<?php
$_SESSION["title"] = "Staff";
?>
<?php include 'view/partials/_subheader/subheader-v1.php'; ?>
<?php
//avoid put any gap in this page.Error behaviour due to gap.
?>
<style>
.highlight td {
background:white;
}
</style>
<?php
if (!isset($_GET['id']) && empty($_GET['id']))
{
    ?>
    <div class="row">
    <div class="col-md-1 section-1-box wow fadeInUp"></div>
    <div class="col-md-10 section-1-box wow fadeInUp"><br><br><br>
        <div class="table-responsive">
        <table id="attendance" class="table table-bordered" style="text-align: center;">
        <thead class="table-light">
            <tr>
            <th scope="col" style="color:#696969; text-align:center">Staff ID</th>
            <th scope="col" style="color:#696969; text-align:center">Staff Name</th>
            <th scope="col" style="color:#696969; text-align:center">Date</th>
            <th scope="col" style="color:#696969; text-align:center">IN</th>
            <th scope="col" style="color:#696969; text-align:center">OUT</th>
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
        ?>
        <tr>
            <td><?php echo $ConsumerIDNo; ?></td>
            <td><?php echo $ConsumerFName." ".$ConsumerLName; ?></td>
        <?php
        $Cards_id ='';
        $filter1 = ['Consumer_id'=>$consumerid];
        $query1 = new MongoDB\Driver\Query($filter1);
        $cursor1 = $GoNGetzDatabase->executeQuery('GoNGetz.Cards',$query1);
        foreach ($cursor1 as $document1)
        {
        $Cards_id = strval($document1->Cards_id);
        }
        $varnow = date("d-m-Y");
        $today = new MongoDB\BSON\UTCDateTime((new DateTime($varnow))->getTimestamp()*1000);
        ?>
        <td><?php echo $varnow."<br>"; ?></td>
        <td><?php
        $varcounting = 0;
        $filterA = ['CardID'=>$Cards_id ,'AttendanceDate' => ['$gte' => $today]];
        $optionA = ['sort' => ['_id' => 1]];
        $queryA = new MongoDB\Driver\Query($filterA,$optionA);
        $cursorA = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Attendance',$queryA);
        foreach ($cursorA as $documentA)
        {
            $AttendanceDate = ($documentA->AttendanceDate);
            $utcdatetime = new MongoDB\BSON\UTCDateTime(strval($AttendanceDate));
            $AttendanceDate = $utcdatetime->toDateTime()->setTimezone(new \DateTimeZone(date_default_timezone_get()));
            $varcounting = $varcounting +1;
        if ($varcounting % 2)
        {
        echo date_format($AttendanceDate,"H:i:s")."<br>";
        } 
        else
        {
        }
        }
        ?></td>
        <td><?php
        $varcounting = 0;
        $filterA = ['CardID'=>$Cards_id ,'AttendanceDate' => ['$gte' => $today]];
        $optionA = ['sort' => ['_id' => 1]];
        $queryA = new MongoDB\Driver\Query($filterA,$optionA);
        $cursorA = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Attendance',$queryA);
        foreach ($cursorA as $documentA)
        {
            $AttendanceDate = ($documentA->AttendanceDate);
            $utcdatetime = new MongoDB\BSON\UTCDateTime(strval($AttendanceDate));
            $AttendanceDate = $utcdatetime->toDateTime()->setTimezone(new \DateTimeZone(date_default_timezone_get()));
            $varcounting = $varcounting +1;

        if ($varcounting % 2)
        {
        } 
        else
        {
            echo date_format($AttendanceDate,"H:i:s")."<br>";
        }
        }
        ?></td>
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
?>
<script type="text/javascript">
var rows = document.querySelectorAll('tr');

[...rows].forEach((r) => {
if (r.querySelectorAll('td:empty').length > 0) {
r.classList.add('highlight');
}
})
</script>
<?php
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
    <div class="row">
    <div class="col-md-1 section-1-box wow fadeInUp"></div>
    <div class="col-md-10 section-1-box wow fadeInUp"><br><br><br>
        <div class="table-responsive">
        <table id="attendance" class="table table-bordered" style="text-align: center;">
        <thead class="table-light">
            <tr>
            <th scope="col" style="color:#696969; text-align:center">Staff ID</th>
            <th scope="col" style="color:#696969; text-align:center">Staff Name</th>
            <th scope="col" style="color:#696969; text-align:center">Date</th>
            <th scope="col" style="color:#696969; text-align:center">IN</th>
            <th scope="col" style="color:#696969; text-align:center">OUT</th>
            </tr>
        </thead>
        <tbody>
        <tr style="text-align:center">
            <td><?php echo $ConsumerIDNo; ?></td>
            <td><?php echo $ConsumerFName." ".$ConsumerLName; ?></td>
            <td><?php
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
            echo date_format($AttendanceDate,"d-m-Y")."<br>";
          }
        }
        ?></td>
        <td><?php
        $varcounting = 0;
        $filterA = ['CardID'=>$Cards_id ,'AttendanceDate' => ['$gte' => $from_date,'$lte' => $to_date]];
        $optionA = ['sort' => ['_id' => 1]];
        $queryA = new MongoDB\Driver\Query($filterA,$optionA);
        $cursorA = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Attendance',$queryA);
        foreach ($cursorA as $documentA)
        {
            $AttendanceDate = ($documentA->AttendanceDate);
            $utcdatetime = new MongoDB\BSON\UTCDateTime(strval($AttendanceDate));
            $AttendanceDate = $utcdatetime->toDateTime()->setTimezone(new \DateTimeZone(date_default_timezone_get()));
            $varcounting = $varcounting +1;
        if ($varcounting % 2)
        {echo date_format($AttendanceDate,"H:i:s")."<br>";} 
        else
        {}
        }
        ?></td>
        <td><?php
        $varcounting = 0;
        $filterA = ['CardID'=>$Cards_id ,'AttendanceDate' => ['$gte' => $from_date,'$lte' => $to_date]];
        $optionA = ['sort' => ['_id' => 1]];
        $queryA = new MongoDB\Driver\Query($filterA,$optionA);
        $cursorA = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Attendance',$queryA);
        foreach ($cursorA as $documentA)
        {
            $AttendanceDate = ($documentA->AttendanceDate);
            $utcdatetime = new MongoDB\BSON\UTCDateTime(strval($AttendanceDate));
            $AttendanceDate = $utcdatetime->toDateTime()->setTimezone(new \DateTimeZone(date_default_timezone_get()));
            $varcounting = $varcounting +1;
        if ($varcounting % 2)
        {
        } 
        else
        {
        echo date_format($AttendanceDate,"H:i:s")."<br>";
        }
        ?>
        <?php
        }
        ?></td>
        </tr>
   </tbody>
   </table>
   <button type="button" style="font-size:15px width:25%" class="btn btn-success"><a href="index.php?page=exportstaffattendance&id=<?php echo $_GET['id']; ?>&attendance=<?php echo "xls"; ?>" tabindex="-1" data-type="alpha" style="color:#FFFFFF; text-decoration: none;">EXPORT ATTENDANCE TO XLS</a></button>
   </div>
   </div>
   <div class="col-md-1 section-1-box wow fadeInUp"></div>
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
?>
<script type="text/javascript">
var rows = document.querySelectorAll('tr');

[...rows].forEach((r) => {
if (r.querySelectorAll('td:empty').length > 0) {
r.classList.add('highlight');
}
})
</script>
<?php
}
?>
