<?php
$_SESSION["title"] = "Department";
//avoid put any gap in this page.Error behaviour due to gap.
?>
<style>
.highlight td {
background:#FFE2E5;
color:#F64E60 ;
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
					<h5 class="text-dark font-weight-bold my-1 mr-5"><?php echo $_SESSION["title"]; ?></h5>
					<!--end::Page Title-->
				</div>
				<!--end::Page Heading-->
			</div>
			<!--end::Info-->
			<!--begin::Toolbar-->
			<div class="d-flex align-items-center">
            <div class="card-toolbar" style="text-align:right;">
                        <!--begin::Dropdown-->
                        <div class="dropdown dropdown-inline mr-2">
                        <button type="button" class="btn btn-light-success font-weight-bolder dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="svg-icon svg-icon-md">
                            <!--begin::Svg Icon | path:assets/media/svg/icons/Design/PenAndRuller.svg-->
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <rect x="0" y="0" width="24" height="24"/>
                                    <path d="M7,3 L17,3 C19.209139,3 21,4.790861 21,7 C21,9.209139 19.209139,11 17,11 L7,11 C4.790861,11 3,9.209139 3,7 C3,4.790861 4.790861,3 7,3 Z M7,9 C8.1045695,9 9,8.1045695 9,7 C9,5.8954305 8.1045695,5 7,5 C5.8954305,5 5,5.8954305 5,7 C5,8.1045695 5.8954305,9 7,9 Z" fill="#000000"/>
                                    <path d="M7,13 L17,13 C19.209139,13 21,14.790861 21,17 C21,19.209139 19.209139,21 17,21 L7,21 C4.790861,21 3,19.209139 3,17 C3,14.790861 4.790861,13 7,13 Z M17,19 C18.1045695,19 19,18.1045695 19,17 C19,15.8954305 18.1045695,15 17,15 C15.8954305,15 15,15.8954305 15,17 C15,18.1045695 15.8954305,19 17,19 Z" fill="#000000" opacity="0.3"/>
                                </g>
                            </svg><!--end::Svg Icon--></span>
                            <!--end::Svg Icon-->
                        </span>Sort By</button>
                        <!--begin::Dropdown Menu-->
                        <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right" style="width:250%;">
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
                                            <a href="index.php?page=departmentattendance&id=<?php echo $Departmentid; ?>" class="navi-link">
                                                <span class="navi-icon">
                                                    <i class="la la-user"></i>
                                                </span>
                                                <span class="navi-text"><?php echo $DepartmentName; ?></span>
                                            </a>
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
    ?>
    <div><br><br><br><h1 style="color:#696969; text-align:center">Department - Attendance</h1></div><br>
    <?php
}
else
{
    ?>
    <div><br><br><br><h1 style="color:#696969; text-align:center">Department - Attendance</h1></div><br>
    <div class="row">
    <div class="col-md-1 section-1-box wow fadeInUp"></div>
    <div class="col-md-10 section-1-box wow fadeInUp">
        <div class="row">
        <div class="col-md- section-1-box wow fadeInUp">
        <div class="card">
        <div class="card-body">
        <div class="table-responsive">
                    <table id="attendance" class="table table-bordered" style="color:#ffffff; text-align: center;">
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
                    <button type="button" style="font-size:15px width:25%" class="btn btn-success"><a href="index.php?page=departmentattendance&id=<?php echo $_GET['id']; ?>&attendance=<?php echo "xls"; ?>" tabindex="-1" data-type="alpha" style="color:#FFFFFF; text-decoration: none;">EXPORT ATTENDANCE TO XLS</a></button>
                </div>             
        </div>
        </div>         
        </div>
    </div>    
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
