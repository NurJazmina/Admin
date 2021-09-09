<!doctype html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

		<!-- begin::Bootstrap CSS -->
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
		<!-- end::Bootstrap CSS -->

        <style>
            .card {
            position: relative;
            display: flex;
            flex-direction: column;
            min-width: 0;
            word-wrap: break-word;
            background-color: #ffffff;
            background-clip: border-box;
            border: 1px solid #EBEDF3;
            border-radius: 0.42rem;
            }

            .card-body {
            flex: 1 1 auto;
            min-height: 1px;
            padding: 2.25rem;
            }

            .form-group {
            margin-bottom: 1rem; 
            }

            .text-left {
            text-align: left !important;
            }

            .text-right {
            text-align: right !important;
            }
            .col-sm-3 {
                flex: 0 0 25%;
                max-width: 25%;
            }

            .col-sm-6 {
                flex: 0 0 50%;
                max-width: 50%;
            }

            .bg-white {
            background-color: #ffffff !important;
            }

            .text-success {
            color: #1BC5BD !important;
            }

            .btn-success {
            color: #ffffff;
            background-color: #1BC5BD;
            border-color: #1BC5BD;
            box-shadow: none;
            }
            .btn-success:hover {
            color: #ffffff;
            background-color: #16a39d;
            border-color: #159892;
            }
            .btn-light:hover {
            color: #181C32;
            background-color: #dae3ec;
            border-color: #d1dde8;
            }
            .highlight td.default 
            {
            background:#ff8795;
            color:#ffff ;
            border-color:#ffff;
            }
        </style>
    </head>
    <body>
        <?php
        $GoNGetzConnectionString="mongodb://admin:TempPassword@51.79.173.45:27017/gngoffice?authSource=admin";
        $GoNGetzDatabase = new MongoDB\Driver\Manager($GoNGetzConnectionString);
        if (isset($_POST['date']))
        {
            $date = $_POST['date'];
            $school = $_POST['school'];
        }
        ?>
        <div class="card">
            <div class="card-body">
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
                <?php
                $filter = ['SchoolID'=>$school];
                $query = new MongoDB\Driver\Query($filter);
                $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Staff',$query);
                foreach ($cursor as $document)
                {
                    $ConsumerID = $document->ConsumerID;

                    $filter = ['_id'=>new \MongoDB\BSON\ObjectId($ConsumerID)];
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
            </div>
        </div>
    </body>
</html>
