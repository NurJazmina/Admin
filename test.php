<?php
$GoNGetzConnectionString="mongodb://admin:TempPassword@51.79.173.45:27017/gngoffice?authSource=admin";
$GoNGetzDatabase = new MongoDB\Driver\Manager($GoNGetzConnectionString);
if (isset($_POST['date']))
{
    $date = $_POST['date'];
    $school = $_POST['school'];
}
?>
<table id="attendance" class="table table-bordered text-left shadow p-3 mb-5 rounded">
    <thead class="bg-white text-success">
        <tr>
            <th>Staff ID</th>
            <th>Staff Name</th>
            <th>Date</th>
            <th>IN</th>
            <th>OUT</th>
        </tr>
    </thead>
    <tbody>
        <?phP
        $filter = ['_id'=>new \MongoDB\BSON\ObjectId('6045970942672b20204b6092')];
        $query = new MongoDB\Driver\Query($filter);
        $cursor = $GoNGetzDatabase->executeQuery('GoNGetz.Consumer',$query);
        foreach ($cursor as $document)
        {
            $consumer_id = strval($document->_id);
            $ConsumerFName = $document->ConsumerFName;
            $ConsumerLName = $document->ConsumerLName;
            $ConsumerIDNo = $document->ConsumerIDNo;
            ?>
            <tr>
                <td class="default"><?= $ConsumerIDNo; ?></td>
                <td class="default"><?= $ConsumerFName." ".$ConsumerLName; ?></td>
                <?php
                $Cards_id ='';
                $filter = ['Consumer_id'=>$consumer_id];
                $query = new MongoDB\Driver\Query($filter);
                $cursor = $GoNGetzDatabase->executeQuery('GoNGetz.Cards',$query);
                foreach ($cursor as $document1)
                {
                    $Cards_id = strval($document1->Cards_id);
                }
                ?>
                <td class="default"><?= $date."<br>"; ?></td>
                <td class="default"><?php
                $varcounting = 0;
                $mongo_date = new MongoDB\BSON\UTCDateTime((new DateTime($date))->getTimestamp()*1000);
                
                $filter = ['CardID'=>$Cards_id ,'AttendanceDate' => ['$gte' => $mongo_date]];
                $option = ['sort' => ['_id' => 1]];
                $query = new MongoDB\Driver\Query($filter,$option);
                $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Attendance',$query);
                foreach ($cursor as $document)
                {
                    $date = strval($document->AttendanceDate);
                    $date = new MongoDB\BSON\UTCDateTime($date);
                    $date = $date->toDateTime()->setTimezone(new \DateTimeZone(date_default_timezone_get()));

                    $varcounting = $varcounting +1;
                    if ($varcounting % 2){
                    echo date_format($date,"H:i:s")."<br>";}
                }
                ?></td>
                <td class="default"><?php
                $varcounting = 0;
                $filter = ['CardID'=>$Cards_id ,'AttendanceDate' => ['$gte' => $mongo_date]];
                $option = ['sort' => ['_id' => 1]];
                $query = new MongoDB\Driver\Query($filter,$option);
                $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Attendance',$query);
                foreach ($cursor as $document)
                {
                echo "asd";
                    $date = strval($document->AttendanceDate);
                    $date = new MongoDB\BSON\UTCDateTime($date);
                    $date = $date->toDateTime()->setTimezone(new \DateTimeZone(date_default_timezone_get()));

                    $varcounting = $varcounting +1;
                    if ($varcounting % 2){
                    }
                    else{
                        echo date_format($date,"H:i:s")."<br>";}
                }
                ?></td>
            </tr>
            <?php
        }
        ?>
    </tbody>
</table>
<?php
if (isset($_GET['attendance']) && !empty($_GET['attendance']))
{
    $attendance = ($_GET['attendance']);
    ?>
    <script>
    $(document).ready(function () {
        $("#attendance").table2excel({
            filename: "staff_attendance.xls"
        });
    });
    </script>
    <?php
}?>
<script type="text/javascript">
var rows = document.querySelectorAll('tr');
[...rows].forEach((r) => {
if (r.querySelectorAll('td:empty').length > 0) {
r.classList.add('highlight');
}
})
</script>