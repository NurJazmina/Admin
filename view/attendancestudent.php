<?php
$id = new \MongoDB\BSON\ObjectId($_GET['id']);
$filter = ['_id'=>$id];
$query = new MongoDB\Driver\Query($filter);
$cursor = $GoNGetzDatabase->executeQuery('GoNGetz.Consumer',$query);

foreach ($cursor as $document)
{
$ConsumerFName = ($document->ConsumerFName);
$ConsumerLName = ($document->ConsumerLName);
$vardate = new MongoDB\BSON\UTCDateTime((new DateTime('now'))->getTimestamp()*1000);
$date = $vardate->toDateTime()->setTimezone(new \DateTimeZone(date_default_timezone_get()));
?>   
<div class="myDiv" style="color:#696969;text-align:center"><br><br><br><h1>Attendance Student : <?php echo $ConsumerFName; echo " "; echo $ConsumerLName;?></h1></div><br>
<table class="table table-bordered">
  <thead class="table-light">
    <tr>
      <th scope="col">Date</th>
      <th scope="col">IN / OUT</th>
    </tr>
  </thead>
  <tbody>
    <td>  
      <table>
        <?php
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
<?php
}
?>

  
  
