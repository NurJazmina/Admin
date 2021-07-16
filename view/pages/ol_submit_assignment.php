<?php
include 'model/assignment.php';
function time_elapsed($date){
	$bit = array(
		//' year'      => $date  / 31556926 % 12,
		' week'      => $date  / 604800 % 52,
		' day'       => $date  / 86400 % 7,
		' hour'      => $date  / 3600 % 24,
		' minute'    => $date  / 60 % 60,
		' second'    => $date  % 60
		);
	foreach($bit as $k => $v){
		if($v > 1)$ret[] = $v . $k . 's';
		if($v == 1)$ret[] = $v . $k;
		}
	array_splice($ret, count($ret)-1, 0, '');
	$ret[] = '';

	return join(' ', $ret);
}

?>
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
	<!--begin::Subheader-->
	<div class="subheader py-2 py-lg-6 subheader-solid gradient-custom" id="kt_subheader">
		<div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
			<!--begin::Info-->
			<div class="d-flex align-items-center flex-wrap mr-1">
				<!--begin::Page Heading-->
				<div class="d-flex align-items-baseline flex-wrap mr-5">
					<!--begin::Page Title-->
					<h5 class="text-white font-weight-bold my-1 mr-5">Assignment</h5>
					<!--end::Page Title-->
				</div>
                <!--begin::Separator-->
                <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-5 bg-gray-200"></div>
                <!--end::Separator-->
                <!--begin::Detail-->
                <div class="d-flex align-items-center" id="kt_subheader_search">
                <span class="text-white-50 font-weight-bold" id="kt_subheader_total">Submission</span>
                </div>
                <!--end::Detail-->
				<!--end::Page Heading-->
			</div>
			<!--end::Info-->
			<!--begin::Toolbar-->
			<div class="d-flex align-items-center">
            <div class="col-12 col-sm-12 col-sm-12">
                <div class="col-12 col-sm-12 col-lg-12 text-right">
                    <div class="row">
                    </div>
                </div>
            </div>
		</div>
		<!--end::Toolbar-->
	</div>
</div>
<!--end::Subheader-->
<?php
if (!isset($_GET['action']) && empty($_GET['action']))
{
?>
<div class="content d-flex flex-column flex-column-fluid">
    <div class="card card-custom gutter-b px-5">
        <div class="card-body">
            <?php
            $filter = ['_id'=>new \MongoDB\BSON\ObjectId($_GET['id'])];
            $query = new MongoDB\Driver\Query($filter);
            $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.OL_Assignment',$query);
            foreach ($cursor as $document)
            {
                $Assignment_id = $document->_id;
                $Title = $document->Title;
                $Submitfrom = $document->Submitfrom;
                $Duedate = $document->Duedate;
                $Cutoffdate = $document->Cutoffdate;
                $reminder = $document->reminder;
                $Availability = $document->Availability;

                $Submitfrom = new MongoDB\BSON\UTCDateTime(strval($Submitfrom));
                $Submitfrom = $Submitfrom->toDateTime()->setTimezone(new \DateTimeZone(date_default_timezone_get()));
                //Monday, 19 February 2018, 1:00 AM
                $Submitfrom = date_format($Submitfrom,"l, d F Y, h:i")." PM";

                $Dueutc = new MongoDB\BSON\UTCDateTime(strval($Duedate));
                $Duetimezone = $Dueutc->toDateTime()->setTimezone(new \DateTimeZone(date_default_timezone_get()));
                //Monday, 19 February 2018, 1:00 AM
                $Duedate = date_format($Duetimezone,"l, d F Y, h:i")." PM";

                $Cutoffdate = new MongoDB\BSON\UTCDateTime(strval($Cutoffdate));
                $Cutoffdate = $Cutoffdate->toDateTime()->setTimezone(new \DateTimeZone(date_default_timezone_get()));
                //Monday, 19 February 2018, 1:00 AM
                $Cutoffdate = date_format($Cutoffdate,"l, d F Y, h:i")." PM";
                ?>
                <h3 class="text-dark-600 mb-8">ASSIGNMENT : <?php echo $Title; ?></h3>

                <div class="bg-diagonal bg-diagonal-gray bg-diagonal-r-lightgray rounded text-white py-2 px-4">
                    <div class="row">
                        <div class="col-sm-2 text-left"><h6>Opened </h6></div>
                        <div class="col-sm-10 text-left"><h6><?php echo ": ".$Submitfrom; ?></h6></div>
                    </div>
                    <div class="row">
                        <div class="col-sm-2 text-left"><h6>Closed </h6></div>
                        <div class="col-sm-10 text-left"><h6><?php echo ": ".$Duedate; ?></h6></div>
                    </div>
                    <div class="row">
                        <div class="col-sm-2 text-left"><h6>Cut off date </h6></div>
                        <div class="col-sm-10 text-left"><h6><?php echo ": ".$Cutoffdate; ?></h6></div>
                    </div>
                </div>

                <div class="separator separator-dashed my-10"></div>

                <h3 class="text-dark-600 mb-8">GRADING SUMMARY</h3>
                <table class="table table-hover table-borderless">
                    <tbody>
                        <tr class="bg-gray-300 text-dark-50">
                            <th>Hidden from students</th>
                            <td><?php
                            if($Availability == 'SHOW')
                            {
                                echo "No";
                            }
                            else
                            {
                                echo "Yes";
                            }
                             ?></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr class="text-dark-50">
                            <th>Participants</th>
                            <td>
                            <?php
                            $total_student = 0;
                            $filter = ['Subject_id'=>$Subject_id];
                            $query = new MongoDB\Driver\Query($filter);
                            $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.ClassroomSubjectRel',$query);
                            foreach ($cursor as $document)
                            {
                                $Class_id = $document->Class_id;

                                $filter = ['Class_id'=>$Class_id ];
                                $query = new MongoDB\Driver\Query($filter);
                                $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Students',$query);
                                foreach ($cursor as $document)
                                {
                                    $total_student = $total_student + 1;
                                }
                                $total= $total_student;
                                echo $total;
                            }
                            ?>
                            </td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr class="bg-gray-300 text-dark-50">
                            <th>Submitted</th>
                            <td>2</td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr class="text-dark-50">
                            <th>Needs grading</th>
                            <td>1</td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr class="bg-gray-300 text-dark-50">
                            <th>Time remaining</th>
                            <td>
                            <?php
                            $due = date_format($Duetimezone,"Y-m-d\TH:i:s");
                            $due = new MongoDB\BSON\UTCDateTime((new DateTime($due))->getTimestamp());

                            $Submit = time();
                            $due = strval($due);

                            if ($due >= $Submit)
                            {
                                echo " ".time_elapsed($due-$Submit)." \n";  
                            }
                            else
                            {
                                ?> Assignment is due <?php
                            }
                            ?>
                            </td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                    </tbody>
                </table>
                <?php

                if($_SESSION["loggeduser_ACCESS"] == 'TEACHER')
                {
                    ?>
                    <div class="card-footer">
                        <div class="row">
                            <div class="col-lg-12 text-center">
                                <input type="hidden" name="id" value="<?= $_id; ?>">
                                <a href="index.php?page=ol_submit_assignment&id=60dace7aad9ff4564463d482&action=grading"><button type="button" class="btn btn-sm btn-secondary">View all submission</button></a>
                                <a href="index.php?page=ol_submit_assignment&id=60dace7aad9ff4564463d482&action=grader"><button type="button" class="btn btn-sm text-white mr-2" name="grade" style="background-color:#7e8299;">Grade</button></a>
                            </div>
                        </div>
                    </div>
                    <?php
                } 
                elseif($_SESSION["loggeduser_ConsumerGroup_id"] == '6018c32b10184a751c102eb6') //student
                {
                    ?>
                    <div class="card-footer">
                        <div class="row">
                            <div class="col-lg-12 text-center">
                                <input type="hidden" name="id" value="<?= $_id; ?>">
                                <button type="button" class="btn btn-sm text-white mr-2" name="submission" style="background-color:#7e8299;">Add submission</button>
                            </div>
                        </div>
                    </div>
                    <?php
                }
            }
            ?>
        </div>
    </div>
</div>
<?php
}
else
{
    $action = $_GET['action'];

    if($action == 'grading')
    {
        ?>
        <div class="content d-flex flex-column flex-column-fluid">
            <div class="card card-custom gutter-b px-5">
                <div class="card-body">
                    <?php
                    $filter = ['_id'=>new \MongoDB\BSON\ObjectId($_GET['id'])];
                    $query = new MongoDB\Driver\Query($filter);
                    $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.OL_Assignment',$query);
                    foreach ($cursor as $document)
                    {
                        $Assignment_id = $document->_id;
                        $Title = $document->Title;
                        $Submitfrom = $document->Submitfrom;
                        $Duedate = $document->Duedate;
                        $Cutoffdate = $document->Cutoffdate;
                        $reminder = $document->reminder;
                        $Availability = $document->Availability;
                        $Subject_id = $document->Subject_id;

                        $Submitfrom = new MongoDB\BSON\UTCDateTime(strval($Submitfrom));
                        $Submitfrom = $Submitfrom->toDateTime()->setTimezone(new \DateTimeZone(date_default_timezone_get()));
                        //Monday, 19 February 2018, 1:00 AM
                        $Submitfrom = date_format($Submitfrom,"l, d F Y, h:i")." PM";

                        $Dueutc = new MongoDB\BSON\UTCDateTime(strval($Duedate));
                        $Duetimezone = $Dueutc->toDateTime()->setTimezone(new \DateTimeZone(date_default_timezone_get()));
                        //Monday, 19 February 2018, 1:00 AM
                        $Duedate = date_format($Duetimezone,"l, d F Y, h:i")." PM";

                        $Cutoffdate = new MongoDB\BSON\UTCDateTime(strval($Cutoffdate));
                        $Cutoffdate = $Cutoffdate->toDateTime()->setTimezone(new \DateTimeZone(date_default_timezone_get()));
                        //Monday, 19 February 2018, 1:00 AM
                        $Cutoffdate = date_format($Cutoffdate,"l, d F Y, h:i")." PM";
                        ?>
                        <h3 class="text-dark-600 mb-8">ASSIGNMENT : <?php echo $Title; ?></h3>

                        <div class="bg-diagonal bg-diagonal-gray bg-diagonal-r-lightgray rounded text-white py-2 px-4">
                            <div class="row">
                                <div class="col-sm-2 text-left"><h6>Opened </h6></div>
                                <div class="col-sm-10 text-left"><h6><?php echo ": ".$Submitfrom; ?></h6></div>
                            </div>
                            <div class="row">
                                <div class="col-sm-2 text-left"><h6>Closed </h6></div>
                                <div class="col-sm-10 text-left"><h6><?php echo ": ".$Duedate; ?></h6></div>
                            </div>
                            <div class="row">
                                <div class="col-sm-2 text-left"><h6>Cut off date </h6></div>
                                <div class="col-sm-10 text-left"><h6><?php echo ": ".$Cutoffdate; ?></h6></div>
                            </div>
                        </div>

                        <div class="separator separator-dashed my-10 mb-10"></div>

                            <!--begin::Card-->
                            <div class="card card-custom">
                                <div class="card-header flex-wrap border-0 pt-6 pb-0">
                                    <div class="card-title">
                                        <h3 class="card-label">Local Datasource
                                        <span class="text-muted pt-2 font-size-sm d-block">Javascript array as data source</span></h3>
                                    </div>
                                    <div class="card-toolbar">
                                        <!--begin::Dropdown-->
                                        <div class="dropdown dropdown-inline mr-2">
                                            <button type="button" class="btn btn-light-success font-weight-bolder dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <span class="svg-icon svg-icon-md">
                                                <!--begin::Svg Icon | path:assets/media/svg/icons/Design/PenAndRuller.svg-->
                                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                        <rect x="0" y="0" width="24" height="24" />
                                                        <path d="M3,16 L5,16 C5.55228475,16 6,15.5522847 6,15 C6,14.4477153 5.55228475,14 5,14 L3,14 L3,12 L5,12 C5.55228475,12 6,11.5522847 6,11 C6,10.4477153 5.55228475,10 5,10 L3,10 L3,8 L5,8 C5.55228475,8 6,7.55228475 6,7 C6,6.44771525 5.55228475,6 5,6 L3,6 L3,4 C3,3.44771525 3.44771525,3 4,3 L10,3 C10.5522847,3 11,3.44771525 11,4 L11,19 C11,19.5522847 10.5522847,20 10,20 L4,20 C3.44771525,20 3,19.5522847 3,19 L3,16 Z" fill="#000000" opacity="0.3" />
                                                        <path d="M16,3 L19,3 C20.1045695,3 21,3.8954305 21,5 L21,15.2485298 C21,15.7329761 20.8241635,16.200956 20.5051534,16.565539 L17.8762883,19.5699562 C17.6944473,19.7777745 17.378566,19.7988332 17.1707477,19.6169922 C17.1540423,19.602375 17.1383289,19.5866616 17.1237117,19.5699562 L14.4948466,16.565539 C14.1758365,16.200956 14,15.7329761 14,15.2485298 L14,5 C14,3.8954305 14.8954305,3 16,3 Z" fill="#000000" />
                                                    </g>
                                                </svg>
                                                <!--end::Svg Icon-->
                                            </span>Export</button>
                                            <!--begin::Dropdown Menu-->
                                            <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
                                                <!--begin::Navigation-->
                                                <ul class="navi flex-column navi-hover py-2">
                                                    <li class="navi-header font-weight-bolder text-uppercase font-size-sm text-success pb-2">Choose an option:</li>
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
                                        <!--begin::Button-->
                                        <a href="#" class="btn btn-success font-weight-bolder">
                                        <span class="svg-icon svg-icon-md">
                                            <!--begin::Svg Icon | path:assets/media/svg/icons/Design/Flatten.svg-->
                                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                    <rect x="0" y="0" width="24" height="24" />
                                                    <circle fill="#000000" cx="9" cy="15" r="6" />
                                                    <path d="M8.8012943,7.00241953 C9.83837775,5.20768121 11.7781543,4 14,4 C17.3137085,4 20,6.6862915 20,10 C20,12.2218457 18.7923188,14.1616223 16.9975805,15.1987057 C16.9991904,15.1326658 17,15.0664274 17,15 C17,10.581722 13.418278,7 9,7 C8.93357256,7 8.86733422,7.00080962 8.8012943,7.00241953 Z" fill="#000000" opacity="0.3" />
                                                </g>
                                            </svg>
                                            <!--end::Svg Icon-->
                                        </span>New Record</a>
                                        <!--end::Button-->
                                    </div>
                                </div>
                                <div class="card-body">
                                    <!--begin::Search Form-->
                                    <div class="mb-7">
                                        <div class="row align-items-center">
                                            <div class="col-lg-9 col-xl-8">
                                                <div class="row align-items-center">
                                                    <div class="col-md-4 my-2 my-md-0">
                                                        <div class="input-icon">
                                                            <input type="text" class="form-control" placeholder="Search..." id="kt_datatable_search_query" />
                                                            <span>
                                                                <i class="flaticon2-search-1 text-muted"></i>
                                                            </span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4 my-2 my-md-0">
                                                        <div class="d-flex align-items-center">
                                                            <label class="mr-3 mb-0 d-none d-md-block">Status:</label>
                                                            <select class="form-control" id="kt_datatable_search_status">
                                                                <option value="">All</option>
                                                                <option value="1">Pending</option>
                                                                <option value="2">Delivered</option>
                                                                <option value="3">Canceled</option>
                                                                <option value="4">Success</option>
                                                                <option value="5">Info</option>
                                                                <option value="6">Danger</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4 my-2 my-md-0">
                                                        <div class="d-flex align-items-center">
                                                            <label class="mr-3 mb-0 d-none d-md-block">Type:</label>
                                                            <select class="form-control" id="kt_datatable_search_type">
                                                                <option value="">All</option>
                                                                <option value="1">Online</option>
                                                                <option value="2">Retail</option>
                                                                <option value="3">Direct</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-3 col-xl-4 mt-5 mt-lg-0">
                                                <a href="#" class="btn btn-light-success px-6 font-weight-bold">Search</a>
                                            </div>
                                        </div>
                                    </div>
                                    <!--end::Search Form-->
                                    <!--begin: Datatable-->
                                    <table id="submission" class="table table-borderless" style="background-color: #7e8299 !important;">
                                    <thead class="text-white">
                                        <tr>
                                        <th scope="col">Name</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Grade</th>
                                        <th scope="col">File submissions</th>
                                        <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody class="text-secondary">
                                    <?php
                                    $filter = ['Class_id'=>$_SESSION["loggeduser_ClassID"]];
                                    $query = new MongoDB\Driver\Query($filter);
                                    $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Students',$query);

                                    foreach ($cursor as $document)
                                    {
                                        $Consumer_id = $document->Consumer_id;

                                        $filter1 = ['_id'=>new \MongoDB\BSON\ObjectId($Consumer_id)];
                                        $query1 = new MongoDB\Driver\Query($filter1);
                                        $cursor1 = $GoNGetzDatabase->executeQuery('GoNGetz.Consumer',$query1);

                                        foreach ($cursor1 as $document1)
                                        {
                                            $consumer_id = strval($document1->_id);
                                            $Consumer_FName = $document1->ConsumerFName;
                                            $Consumer_LName = $document1->ConsumerLName;

                                            $Answer_Created_by = '';
                                            $Mark = 0;
                                            $File_submission = 'null';
                                            $filter2 = ['Created_by'=>$consumer_id];
                                            $query2 = new MongoDB\Driver\Query($filter2);
                                            $cursor2 = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.OL_Assignment_Answer',$query2);

                                            foreach ($cursor2 as $document2)
                                            {
                                                $Answer_Created_by = $document2->Created_by;
                                                $Created_date = $document2->Created_date;
                                                $Mark = $document2->Mark;
                                                $File_submission = $document2->File_submission;
                                            }
                                            
                                                ?>
                                                <tr bgcolor="white">
                                                    <td><?php echo $Consumer_FName; ?></td>
                                                    <?php
                                                    $Submit = new MongoDB\BSON\UTCDateTime(strval($Created_date));
                                                    $Submit = $Submit->toDateTime()->setTimezone(new \DateTimeZone(date_default_timezone_get()));
                                                    $Submit = date_format($Submit,"Y-m-d\TH:i:s");
                                                    $Submit = new MongoDB\BSON\UTCDateTime((new DateTime($Submit))->getTimestamp());

                                                    $due = date_format($Duetimezone,"Y-m-d\TH:i:s");
                                                    $due = new MongoDB\BSON\UTCDateTime((new DateTime($due))->getTimestamp());
                        
                                                    $Submit = strval($Submit);
                                                    $due = strval($due);
                        
                                                    //overdue and not submitted
                                                    if ($due <= $Submit && $Answer_Created_by == '')
                                                    {
                                                        ?>
                                                        <td>
                                                        <div class="row">
                                                            <div class="col-sm-6">
                                                                <div class="bg-danger text-white text-center"><?php echo "No submission"; ?></div>
                                                            </div>
                                                            <div class="col-sm">
                                                                <a style="color:red;"><?php echo "Assignment is overdue :";  echo " ".time_elapsed($Submit-$due)." ago \n"; ?></a>
                                                            </div>
                                                        </div>
                                                        </td>
                                                        <td><?= $Mark; ?></td>
                                                        <td><?= $File_submission; ?></td>
                                                        <?php
                                                    }
                                                    //not submitted
                                                    elseif($due >= $Submit && $Answer_Created_by == '')
                                                    {
                                                        ?>
                                                        <td>
                                                        <div class="row">
                                                            <div class="col-sm">
                                                                <div class="bg-danger text-white text-center"><?php echo "No submission"; ?></div>
                                                            </div>
                                                        </div>
                                                        </td>
                                                        <td><?= $Mark; ?></td>
                                                        <td><?= $File_submission; ?></td>
                                                        <?php
                                                    }
                                                    //overdue and submitted
                                                    elseif($due <= $Submit && $Answer_Created_by !== '')
                                                    {
                                                        ?>
                                                        <td>
                                                        <div class="row">
                                                            <div class="col-sm-6">
                                                                <div class="bg-warning text-white text-center"><?php echo "submitted for grading"; ?></div>
                                                            </div>
                                                            <div class="col-sm">
                                                                <a style="color:red;"><?php echo "Assignment was submitted :".time_elapsed($Submit-$due)." late \n"; ?></a>
                                                            </div>
                                                        </div>
                                                        </td>
                                                        <td><?= $Mark; ?></td>
                                                        <td><?= $File_submission; ?></td>
                                                        <?php
                                                    }
                                                    //submitted
                                                    elseif($due >= $Submit && $Answer_Created_by !== '')
                                                    {
                                                        ?>
                                                        <td>
                                                        <div class="row">
                                                            <div class="col-sm-6">
                                                                <div class="bg-warning text-white text-center"><?php echo "submitted for grading"; ?></div>
                                                            </div>
                                                            <div class="col-sm">
                                                                <a style="color:green;"><?php echo "Assignment was submitted :".time_elapsed($due-$Submit)." before due \n"; ?></a>
                                                            </div>
                                                        </div>
                                                        </td>
                                                        <td><?= $Mark; ?></td>
                                                        <td><?= $File_submission; ?></td>
                                                        <?php
                                                    }
                                                    ?>
                                                    <td>
                                                    <button type="button" class="btn btn-sm btn-light" data-bs-toggle="modal" data-bs-target="#EditGrade" data-bs-whatever="<?php echo $consumer_id; ?>">
                                                        <i  class="fa fa-edit"></i>
                                                    </button>
                                                    </td>
                                                </tr>
                                                <?php
                                        }
                                        
                                    }
                                    ?>
                                    </tbody>
                                    </table>
                                 </div>
                                    <!--end: Datatable-->
                                </div>
                            </div>
                            <!--end::Card-->
                        <?php
                    }
                    ?>
                </div>
            </div>
        </div>
        <?php
    }
    elseif($action == 'grader')
    {
        echo "grader";
    }
}
?>
<?php include ('view/pages/ol_modal-grade.php'); ?>
