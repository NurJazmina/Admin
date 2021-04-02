<?php
if (!isset($_GET['id']) && empty($_GET['id']))
{
    ?>
    <div class="row">
    <div class="col-md-2 section-1-box wow fadeInUp"></div>
    <div class="col-md-8 section-1-box wow fadeInUp"><br><br><br>
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
        $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Students',$query);
        foreach ($cursor as $document)
        {
        $Consumer_id = strval($document->Consumer_id);

        $filter = ['_id'=>new \MongoDB\BSON\ObjectId($Consumer_id)];
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
            <td><?php echo $varnow."<br>"; ?></td>
            <td>
        <?php
        $filter1 = ['Consumer_id'=>$consumerid];
        $query1 = new MongoDB\Driver\Query($filter1);
        $cursor1 = $GoNGetzDatabase->executeQuery('GoNGetz.Cards',$query1);
        foreach ($cursor1 as $document1)
        {
        $Cards_id = strval($document1->Cards_id);
        }

        $today = new MongoDB\BSON\UTCDateTime((new DateTime($varnow))->getTimestamp()*1000);
        $varcount = 0;
        $filterA = ['CardID'=>$Cards_id, 'AttendanceDate' => ['$gte' => $today]];
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
        echo $displayinout . date_format($AttendanceDate,"h:i:sa");
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
</div>
<div class="col-md-2 section-1-box wow fadeInUp"></div>
<script>
  
 $(document).ready(function () {
    $("#attendance").table2excel({
        filename: "attendancestaff.xls"
    });
 });
  
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
    <div class="col-md-3 section-1-box wow fadeInUp"></div>
    <div class="col-md-6 section-1-box wow fadeInUp"><br><br><br>
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
            <td><?php echo $ConsumerIDNo; ?></td>
            <td><?php echo $ConsumerFName." ".$ConsumerLName; ?></td>
            <td><?php  ?></td>
            <td>  
            <table>
                <?php
                $vardate = new MongoDB\BSON\UTCDateTime((new DateTime('now'))->getTimestamp()*1000);
                $date = $vardate->toDateTime()->setTimezone(new \DateTimeZone(date_default_timezone_get()));
                $varcount = 0; 
                $filterA = ['CardID'=>'1000000000000000'];
                $queryA = new MongoDB\Driver\Query($filterA);
                $cursorA =$GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Attendance',$queryA);
                foreach ($cursorA as $documentA)
                {
                $AttendanceDate = new MongoDB\BSON\UTCDateTime(strval($documentA->AttendanceDate));
                $attendance = $AttendanceDate->toDateTime()->setTimezone(new \DateTimeZone(date_default_timezone_get()));
                $today = date_format($date,"d/m/Y");
                $attendancetoday = date_format($attendance,"d/m/Y");
                ?>
                <?php
                //value is odd=out
                if ($varcount % 2) 
                {
                    do 
                    {
                    ?>
                    <td style="text-align:right;">OUT</td>
                    <td><i class="fas fa-arrow-circle-right"></i></td>
                    <td><?php echo date_format($attendance,"H:i"); ?></td>    
                    <td><?php echo date_format($attendance,"d/m/Y"); ?></td>
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
                ?>
                </tr>
            </table>
            <br>
            </td>
        </tbody>
        </table>
    </div>
    <div class="col-md-3 section-1-box wow fadeInUp"></div>
    </div>
<script>
  $(document).ready(function () {
     $("#attendance").table2excel({
         filename: "attendancestaff.xls"
     });
  });
   
 </script>
<?php
}
