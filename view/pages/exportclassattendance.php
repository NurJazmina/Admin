<?php
//avoid put any gap in this page.Error behaviour due to gap.
?>
<style>
.highlight td {
background:#FFE2E5;
color:#F64E60 ;
}
</style>
<?php
if (!isset($_GET['id']) && empty($_GET['id']))
{
}
else
{
    ?>
    <div class="row">
    <div class="col-md-1 section-1-box wow fadeInUp"></div>
    <div class="col-md-12 section-1-box wow fadeInUp"><br><br><br>
        <div class="table-responsive">
        <table id="attendance" class="table table-bordered" style="text-align: center;">
        <thead class="table-light">
            <tr>
            <th scope="col" style="color:#696969; text-align:center">Student ID</th>
            <th scope="col" style="color:#696969; text-align:center">Student Name</th>
            <th scope="col" style="color:#696969; text-align:center">Date</th>
            <th scope="col" style="color:#696969; text-align:center">IN</th>
            <th scope="col" style="color:#696969; text-align:center">OUT</th>
            </tr>
        </thead>
        <tbody>
        <?php
        $filter = ['Schools_id' => $_SESSION["loggeduser_schoolID"],'Class_id'=>$_GET['id']];
        $query = new MongoDB\Driver\Query($filter);
        $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Students',$query);
        foreach ($cursor as $document)
        {
        $Consumer_id = strval($document->Consumer_id);
        $filter = ['_id'=>new \MongoDB\BSON\ObjectId($Consumer_id)];
        $query = new MongoDB\Driver\Query($filter);
        $cursor = $GoNGetzDatabase->executeQuery('GoNGetz.Consumer',$query);
        foreach ($cursor as $document)
        {
        $_SESSION["studentremarkid"] = strval($document->_id);
        $ConsumerFName = ($document->ConsumerFName);
        $ConsumerLName = ($document->ConsumerLName);
        $ConsumerIDNo = ($document->ConsumerIDNo);
        $consumerid = strval($document->_id);
        $varnow = date("d-m-Y");
        ?>
        <tr style="text-align:center">
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
<button type="button" style="font-size:15px width:25%" class="btn btn-success"><a href="index.php?page=exportclassattendance&id=<?php echo $_GET['id']; ?>&attendance=<?php echo "xls"; ?>" tabindex="-1" data-type="alpha" style="color:#FFFFFF; text-decoration: none;">EXPORT ATTENDANCE TO XLS</a></button>
</div>
</div>
<div class="col-md-1 section-1-box wow fadeInUp"></div>
<?php
}
?>