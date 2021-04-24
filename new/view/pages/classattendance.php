<?php
//avoid put any gap in this page.Error behaviour due to gap.
?>
<style>
.highlight td {
background:red;
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

					<?php
					$uri = $_SERVER['REQUEST_URI'];
					$protocol = ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
					$query = $_SERVER['QUERY_STRING'];
					//echo $query; // Outputs: Query String

					?> 
					<h5 class="text-dark font-weight-bold my-1 mr-5">Dashboard</h5>
					<!--end::Page Title-->
					<!--begin::Breadcrumb-->
					<ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
						<li class="breadcrumb-item text-muted">
							<a href="index.php?<?php echo $query; ?>" class="text-muted">Dashboard</a>
						</li>
						<li class="breadcrumb-item text-muted">
							<a href="index.php?<?php echo $query; ?>" class="text-muted">none</a>
						</li>
					</ul>
					<!--end::Breadcrumb-->
				</div>
				<!--end::Page Heading-->
			</div>
			<!--end::Info-->
			<!--begin::Toolbar-->
			<div class="d-flex align-items-center">
            <div class="card-toolbar" style="text-align:right;">
                        <!--begin::Dropdown-->
                        <div class="dropdown dropdown-inline mr-2">
                        <button type="button" class="btn btn-light-primary font-weight-bolder dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
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
                            <ul class="navi flex-column navi-hover py-2">
                                <li class="dropdown-item">Choose an option:</li>
                                <?php 
                                $filter = ['SchoolID'=>$_SESSION["loggeduser_schoolID"],];
                                $query = new MongoDB\Driver\Query($filter);
                                $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Classrooms',$query);
                                foreach ($cursor as $document)
                                {
                                    $classid = strval($document->_id);
                                    $ClassName = strval($document->ClassName);
                                    $ClassCategory = strval($document->ClassCategory);
                                    ?>
                                    <li class="dropdown-item">
                                        <a href="index.php?page=classattendance&id=<?php echo $classid; ?>" class="navi-link">
                                            <span class="navi-icon">
                                                <i class="la la-user"></i>
                                            </span>
                                            <span class="navi-text"><?php echo $ClassCategory." ".$ClassName; ?></span>
                                        </a>
                                    </li>
                                    <?php 
                                } 
                                ?>
                            </ul>
                            <!--end::Navigation-->
                        </div>
                        <!--end::Dropdown Menu-->
                    </div>
                    <!--end::Dropdown-->
                    <!--begin::Dropdown-->
                    <div class="dropdown dropdown-inline mr-2">
                            <button type="button" class="btn btn-light-primary font-weight-bolder dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="svg-icon svg-icon-md">
                                <!--begin::Svg Icon | path:assets/media/svg/icons/Design/PenAndRuller.svg-->
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                        <rect x="0" y="0" width="24" height="24"></rect>
                                        <path d="M3,16 L5,16 C5.55228475,16 6,15.5522847 6,15 C6,14.4477153 5.55228475,14 5,14 L3,14 L3,12 L5,12 C5.55228475,12 6,11.5522847 6,11 C6,10.4477153 5.55228475,10 5,10 L3,10 L3,8 L5,8 C5.55228475,8 6,7.55228475 6,7 C6,6.44771525 5.55228475,6 5,6 L3,6 L3,4 C3,3.44771525 3.44771525,3 4,3 L10,3 C10.5522847,3 11,3.44771525 11,4 L11,19 C11,19.5522847 10.5522847,20 10,20 L4,20 C3.44771525,20 3,19.5522847 3,19 L3,16 Z" fill="#000000" opacity="0.3"></path>
                                        <path d="M16,3 L19,3 C20.1045695,3 21,3.8954305 21,5 L21,15.2485298 C21,15.7329761 20.8241635,16.200956 20.5051534,16.565539 L17.8762883,19.5699562 C17.6944473,19.7777745 17.378566,19.7988332 17.1707477,19.6169922 C17.1540423,19.602375 17.1383289,19.5866616 17.1237117,19.5699562 L14.4948466,16.565539 C14.1758365,16.200956 14,15.7329761 14,15.2485298 L14,5 C14,3.8954305 14.8954305,3 16,3 Z" fill="#000000"></path>
                                    </g>
                                </svg>
                                <!--end::Svg Icon-->
                            </span>Export</button>
                            <!--begin::Dropdown Menu-->
                            <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
                                <!--begin::Navigation-->
                                <ul class="navi flex-column navi-hover py-2">
                                    <li class="navi-header font-weight-bolder text-uppercase font-size-sm text-primary pb-2">Choose an option:</li>
                                    <li class="navi-item">
                                        <a href="#" class="navi-link">
                                            <span class="navi-icon">
                                                <i class="la la-print"></i>
                                            </span>
                                            <span class="navi-text">Print</span>
                                        </a>
                                    </li>
                                    <li class="navi-item">
                                        <a href="#" class="navi-link">
                                            <span class="navi-icon">
                                                <i class="la la-copy"></i>
                                            </span>
                                            <span class="navi-text">Copy</span>
                                        </a>
                                    </li>
                                    <li class="navi-item">
                                        <a href="#" class="navi-link">
                                            <span class="navi-icon">
                                                <i class="la la-file-excel-o"></i>
                                            </span>
                                            <span class="navi-text">Excel</span>
                                        </a>
                                    </li>
                                    <li class="navi-item">
                                        <a href="#" class="navi-link">
                                            <span class="navi-icon">
                                                <i class="la la-file-text-o"></i>
                                            </span>
                                            <span class="navi-text">CSV</span>
                                        </a>
                                    </li>
                                    <li class="navi-item">
                                        <a href="#" class="navi-link">
                                            <span class="navi-icon">
                                                <i class="la la-file-pdf-o"></i>
                                            </span>
                                            <span class="navi-text">PDF</span>
                                        </a>
                                    </li>
                                </ul>
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
    <div><br><br><br><h1 style="color:#696969; text-align:center">Class - Attendance</h1></div><br>
    <?php
}
else
{
    ?>
    <div><br><br><br><h1 style="color:#696969; text-align:center">Class - Attendance</h1></div><br>
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
        </div>         
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
         filename: "attendanceclass.xls"
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
