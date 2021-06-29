<?php
include 'model/assignment.php';
function time_elapsed($date){
	$bit = array(
		//' year'      => $date  / 31556926 % 12,
		' week'      => $date  / 604800 % 52,
		' day'       => $date  / 86400 % 7,
		' hour'      => $date  / 3600 % 24,
		//' minute'    => $date  / 60 % 60,
		//' second'    => $date  % 60
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
					<h5 class="text-dark font-weight-bold my-1 mr-5">ASSIGNMENT</h5>
					<!--end::Page Title-->
				</div>
                <!--begin::Separator-->
                <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-5 bg-gray-200"></div>
                <!--end::Separator-->
                <!--begin::Detail-->
                <div class="d-flex align-items-center" id="kt_subheader_search">
                <span class="text-dark-50 font-weight-bold" id="kt_subheader_total">Submission</span>
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
<div class="content d-flex flex-column flex-column-fluid">
    <div class="card card-custom gutter-b px-5">
        <div class="card-body">
            <?php
            $Notes_id = $_GET['Notes'];
            $filter = ['Notes_id'=>$Notes_id];
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
                        <div class="col-sm-4 text-left"><h6><?php echo ": ".$Submitfrom; ?></h6></div>
                    </div>
                    <div class="row">
                        <div class="col-sm-2 text-left"><h6>Closed </h6></div>
                        <div class="col-sm-4 text-left"><h6><?php echo ": ".$Duedate; ?></h6></div>
                    </div>
                    <div class="row">
                        <div class="col-sm-2 text-left"><h6>Cut off date </h6></div>
                        <div class="col-sm-4 text-left"><h6><?php echo ": ".$Cutoffdate; ?></h6></div>
                    </div>
                </div>

                <div class="separator separator-dashed my-10"></div>

                <h3 class="text-dark-600 mb-8">GRADING SUMMARY</h3>
                <table class="table">
                    <tbody>
                        <tr class="bg-gray-300 text-dark-50">
                            <th scope="row">Hidden from students</th>
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
                        </tr>
                        <tr class="text-dark-50">
                            <th scope="row">Participants</th>
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
                        </tr>
                        <tr class="bg-gray-300 text-dark-50">
                            <th scope="row" >Submitted</th>
                            <td>2</td>
                        </tr>
                        <tr class="text-dark-50">
                            <th scope="row" >Needs grading</th>
                            <td>1</td>
                        </tr>
                        <tr class="bg-gray-300 text-dark-50">
                            <th scope="row" >Time remaining</th>
                            <td>
                            <?php
                            $due = date_format($Duetimezone,"Y-m-d\TH:i:s");
                            $due = new MongoDB\BSON\UTCDateTime((new DateTime($due))->getTimestamp());

                            $now = time();
                            $due = strval($due);

                            if ($due >= $now)
                            {
                                echo " ".time_elapsed($due-$now)." \n";  
                            }
                            else
                            {
                                ?> Assignment is due <?php
                            }
                            ?>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <?php
            }
            ?>
        </div>
    </div>
</div>