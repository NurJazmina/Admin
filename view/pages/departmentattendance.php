<!-- avoid put any gap in this page.Error behaviour due to gap. -->
<style>
.highlight td.default 
{
background:#ff8795;
color:#ffff ;
border-color:#ffff;
}
</style>
<!--begin::Content-->
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
	<!--begin::Subheader-->
	<div class="subheader py-2 py-lg-6 subheader-solid" id="kt_subheader">
		<div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
			<!--begin::Info-->
			<div class="d-flex align-items-center flex-wrap mr-1">
				<!--begin::Page Heading-->
				<div class="d-flex align-items-baseline flex-wrap mr-5">
					<!--begin::Page Title-->
					<h5 class="text-dark font-weight-bold my-1 mr-5">Department</h5>
					<!--end::Page Title-->
				</div>
				<!--end::Page Heading-->
			</div>
			<!--end::Info-->
			<!--begin::Toolbar-->
			<div class="d-flex align-items-center">
                <div class="card-toolbar text-right">
                    <!--begin::Dropdown-->
                    <div class="dropdown dropdown-inline mr-2">
                        <button class="btn btn-light-danger btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="svg-icon svg-icon-md">
                                <!--begin::Svg Icon | path:assets/media/svg/icons/Design/PenAndRuller.svg-->
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                        <rect x="0" y="0" width="24" height="24"/>
                                        <path d="M7,3 L17,3 C19.209139,3 21,4.790861 21,7 C21,9.209139 19.209139,11 17,11 L7,11 C4.790861,11 3,9.209139 3,7 C3,4.790861 4.790861,3 7,3 Z M7,9 C8.1045695,9 9,8.1045695 9,7 C9,5.8954305 8.1045695,5 7,5 C5.8954305,5 5,5.8954305 5,7 C5,8.1045695 5.8954305,9 7,9 Z" fill="#000000"/>
                                        <path d="M7,13 L17,13 C19.209139,13 21,14.790861 21,17 C21,19.209139 19.209139,21 17,21 L7,21 C4.790861,21 3,19.209139 3,17 C3,14.790861 4.790861,13 7,13 Z M17,19 C18.1045695,19 19,18.1045695 19,17 C19,15.8954305 18.1045695,15 17,15 C15.8954305,15 15,15.8954305 15,17 C15,18.1045695 15.8954305,19 17,19 Z" fill="#000000" opacity="0.3"/>
                                    </g>
                                </svg>
                            </span>Sort By
                        </button>
                        <!--begin::Dropdown Menu-->
                        <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
                            <!--begin::Navigation-->
                            <li class="dropdown-item">Choose an option:</li>
                            <?php 
                            $filter = ['School_id'=>$_SESSION["loggeduser_schoolID"]];
                            $query = new MongoDB\Driver\Query($filter);
                            $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.SchoolsDepartment',$query);

                            foreach ($cursor as $document)
                            {
                                $Departmentid = ($document->_id);
                                $DepartmentName = ($document->DepartmentName);
                                ?>
                                <li class="dropdown-item">
                                    <a href="index.php?page=departmentattendance&id=<?= $Departmentid; ?>" class="navi-link"><?= $DepartmentName; ?></a>
                                </li>
                                <?php 
                            } 
                            ?>
                            <!--end::Navigation-->
                        </div>
                        <!--end::Dropdown Menu-->
                    </div>
                    <!--end::Dropdown-->
                </div>
			</div>
			<!--end::Toolbar-->
		</div>
	</div>
	<!--end::Subheader-->
<?php
if (!isset($_GET['id']) && empty($_GET['id']))
{
    $filter = [null];
    $query = new MongoDB\Driver\Query($filter);
    $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.SchoolsDepartment',$query);
  
    foreach ($cursor as $document)
    {
      $Department_id = strval($document->_id);
      $DepartmentName = ($document->DepartmentName);
    }
    ?>
    <div class="text-center m-5"><h1>Department - Attendance</h1></div>
    <div class="row">
        <div class="col-1"></div>
        <div class="col-10">
            <div class="card">
            <div class="card-body text-right">
                <a href="index.php?page=departmentattendance&id=<?= $Department_id; ?>&attendance=xls" class="btn btn-danger btn-hover-light btn-sm mb-3 mx-3">EXPORT ATTENDANCE TO XLS</a>
                <table id="attendance" class="table table-bordered text-left shadow p-3 mb-5 rounded">
                <thead class="bg-white text-danger">
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
                $filter = ['SchoolID'=>$_SESSION["loggeduser_schoolID"],'Staffdepartment'=>$Department_id];
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
                        $ConsumerFName = $document->ConsumerFName;
                        $ConsumerLName = $document->ConsumerLName;
                        $ConsumerIDNo = $document->ConsumerIDNo;
                        $consumerid = strval($document->_id);
                        $varnow = date("d-m-Y");
                        ?>
                        <tr>
                            <td class="default"><?= $ConsumerIDNo; ?></td>
                            <td class="default"><?= $ConsumerFName." ".$ConsumerLName; ?></td>
                            <?php
                            $Cards_id ='';
                            $filter = ['Consumer_id'=>$consumerid];
                            $query = new MongoDB\Driver\Query($filter);
                            $cursor = $GoNGetzDatabase->executeQuery('GoNGetz.Cards',$query);
                            foreach ($cursor as $document1)
                            {
                                $Cards_id = strval($document1->Cards_id);
                            }
                            $varnow = date("d-m-Y");
                            $today = new MongoDB\BSON\UTCDateTime((new DateTime($varnow))->getTimestamp()*1000);
                            ?>
                            <td class="default"><?= $varnow."<br>"; ?></td>
                            <td class="default"><?php
                            $varcounting = 0;
                            $filter = ['CardID'=>$Cards_id ,'AttendanceDate' => ['$gte' => $today]];
                            $option = ['sort' => ['_id' => 1]];
                            $query = new MongoDB\Driver\Query($filter,$option);
                            $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Attendance',$query);
                            foreach ($cursor as $documentA)
                            {
                                $AttendanceDate = ($documentA->AttendanceDate);
                                $utcdatetime = new MongoDB\BSON\UTCDateTime(strval($AttendanceDate));
                                $AttendanceDate = $utcdatetime->toDateTime()->setTimezone(new \DateTimeZone(date_default_timezone_get()));
                                $varcounting = $varcounting +1;
                                if ($varcounting % 2){
                                echo date_format($AttendanceDate,"H:i:s")."<br>";}
                            }
                            ?></td>
                            <td class="default"><?php
                            $varcounting = 0;
                            $filter = ['CardID'=>$Cards_id ,'AttendanceDate' => ['$gte' => $today]];
                            $option = ['sort' => ['_id' => 1]];
                            $query = new MongoDB\Driver\Query($filter,$option);
                            $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Attendance',$query);
                            foreach ($cursor as $documentA)
                            {
                                $AttendanceDate = ($documentA->AttendanceDate);
                                $utcdatetime = new MongoDB\BSON\UTCDateTime(strval($AttendanceDate));
                                $AttendanceDate = $utcdatetime->toDateTime()->setTimezone(new \DateTimeZone(date_default_timezone_get()));
                                $varcounting = $varcounting +1;
                                if ($varcounting % 2){
                                }
                                else{
                                    echo date_format($AttendanceDate,"H:i:s")."<br>";}
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
                            filename: "attendancedepartment.xls"
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
        </div>
        <div class="col-1"></div>
    </div>
    <?php
}
else
{
    ?>
    <div class="text-center m-5"><h1>Department - Attendance</h1></div>
    <div class="row">
        <div class="col-1"></div>
        <div class="col-10">
            <div class="card">
                <div class="card-body text-right">
                    <a href="index.php?page=departmentattendance&id=<?= $_GET['id']; ?>&attendance=xls" class="btn btn-danger btn-hover-light btn-sm mb-3 mx-3">EXPORT ATTENDANCE TO XLS</a>
                    <table id="attendance" class="table table-bordered text-left shadow p-3 mb-5 rounded">
                        <thead class="bg-white text-danger">
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
                        $filter = ['SchoolID'=>$_SESSION["loggeduser_schoolID"],'Staffdepartment'=>$_GET['id']];
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
                                <td class="default"><?= $ConsumerIDNo; ?></td>
                                <td class="default"><?= $ConsumerFName." ".$ConsumerLName; ?></td>
                                <?php
                                $Cards_id ='';
                                $filter = ['Consumer_id'=>$consumerid];
                                $query = new MongoDB\Driver\Query($filter);
                                $cursor = $GoNGetzDatabase->executeQuery('GoNGetz.Cards',$query);
                                foreach ($cursor as $document1)
                                {
                                    $Cards_id = strval($document1->Cards_id);
                                }
                                $varnow = date("d-m-Y");
                                $today = new MongoDB\BSON\UTCDateTime((new DateTime($varnow))->getTimestamp()*1000);
                                ?>
                                <td class="default"><?= $varnow."<br>"; ?></td>
                                <td class="default"><?php
                                $varcounting = 0;
                                $filter = ['CardID'=>$Cards_id ,'AttendanceDate' => ['$gte' => $today]];
                                $option = ['sort' => ['_id' => 1]];
                                $query = new MongoDB\Driver\Query($filter,$option);
                                $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Attendance',$query);
                                foreach ($cursor as $documentA)
                                {
                                    $AttendanceDate = ($documentA->AttendanceDate);
                                    $utcdatetime = new MongoDB\BSON\UTCDateTime(strval($AttendanceDate));
                                    $AttendanceDate = $utcdatetime->toDateTime()->setTimezone(new \DateTimeZone(date_default_timezone_get()));
                                    $varcounting = $varcounting +1;
                                    if ($varcounting % 2){
                                    echo date_format($AttendanceDate,"H:i:s")."<br>";}
                                }
                                ?></td>
                                <td class="default"><?php
                                $varcounting = 0;
                                $filter = ['CardID'=>$Cards_id ,'AttendanceDate' => ['$gte' => $today]];
                                $option = ['sort' => ['_id' => 1]];
                                $query = new MongoDB\Driver\Query($filter,$option);
                                $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Attendance',$query);
                                foreach ($cursor as $documentA)
                                {
                                    $AttendanceDate = ($documentA->AttendanceDate);
                                    $utcdatetime = new MongoDB\BSON\UTCDateTime(strval($AttendanceDate));
                                    $AttendanceDate = $utcdatetime->toDateTime()->setTimezone(new \DateTimeZone(date_default_timezone_get()));
                                    $varcounting = $varcounting +1;
                                    if ($varcounting % 2){
                                    }
                                    else{
                                        echo date_format($AttendanceDate,"H:i:s")."<br>";}
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
                                filename: "attendancedepartment.xls"
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
        </div>
        <div class="col-1"></div>
    </div>
    <?php
}
