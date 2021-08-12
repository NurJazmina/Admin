<?php
include 'model/quiz.php';
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
<style>
@media print {
.noprint {
    visibility: hidden;
}
}
.dot {
  height: 5px;
  width: 5px;
  background-color: #7E8299;
  border-radius: 50%;
  display: inline-block;
}
.separator {
    width: 100%;
    border-bottom: solid 1px;
    position: relative;
    margin: 30px 0px;
}

.separator::before {
    content: "Manually mark : subjective questions";
    position: absolute;
    left: 40%;
    top: -10px;
    background-color: #fff;
    padding: 0px 10px;
}
</style>
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
	<!--begin::Subheader-->
	<div class="subheader py-2 py-lg-6 subheader-solid gradient-custom" id="kt_subheader">
		<div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
			<!--begin::Info-->
			<div class="d-flex align-items-center flex-wrap mr-1">
				<!--begin::Page Heading-->
				<div class="d-flex align-items-baseline flex-wrap mr-5">
					<!--begin::Page Title-->
					<h5 class="text-white font-weight-bold my-1 mr-5">Quiz</h5>
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
<div class="content d-flex flex-column flex-column-fluid">
    <div class="card card-custom gutter-b px-5">
        <div class="card-body">
            <?php
            $filter = ['_id'=>new \MongoDB\BSON\ObjectId($_GET['id'])];
            $query = new MongoDB\Driver\Query($filter);
            $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.OL_Quiz',$query);
            foreach ($cursor as $document)
            {
                $Quiz_id = strval($document->_id);
                $Title = $document->Title;
                $DateOpen = $document->DateOpen;
                $DateClose = $document->DateClose;
                $Availability = $document->Availability;
                $Shuffle = $document->Shuffle;

                $DateOpen = new MongoDB\BSON\UTCDateTime(strval($DateOpen));
                $DateOpenzone = $DateOpen->toDateTime()->setTimezone(new \DateTimeZone(date_default_timezone_get()));
                //Monday, 19 February 2018, 1:00 AM
                $DateOpen = date_format($DateOpenzone,"l, d F Y, h:i")." PM";

                $DateCloseutc = new MongoDB\BSON\UTCDateTime(strval($DateClose));
                $DateClosezone = $DateCloseutc->toDateTime()->setTimezone(new \DateTimeZone(date_default_timezone_get()));
                //Monday, 19 February 2018, 1:00 AM
                $DateClosedate = date_format($DateClosezone,"l, d F Y, h:i")." PM";

                $Quiz = $document->Quiz;
                $Total_Question = count((array)$Quiz);
                $totalmark = 0;
                $objective_mark = 0;
                $subjective_mark = 0;

                for ($i = 0; $i < $Total_Question; $i++)
                {
                    $id = $Quiz[$i]->id;
                    $Type = $Quiz[$i]->Type;
                    $Question = $Quiz[$i]->Question;
                    $Option_A = $Quiz[$i]->Option_A;
                    $Option_B = $Quiz[$i]->Option_B;
                    $Option_C = $Quiz[$i]->Option_C;
                    $Option_D = $Quiz[$i]->Option_D;
                    $Answer = $Quiz[$i]->Answer;
                    $Mark = $Quiz[$i]->Mark;
                    $totalmark += $Mark;
                    
                    if($Type == 'OBJECTIVE')
                    {
                        $Mark = $Quiz[$i]->Mark;
                        $objective_mark += $Mark;
                    }
                    elseif($Type == 'SUBJECTIVE')
                    {
                        $Mark = $Quiz[$i]->Mark;
                        $subjective_mark += $Mark;
                    }
                }
               
                ?>
                <h3 class="text-dark-600 mb-8"> QUIZ : <?php echo $Title; ?></h3>

                <div class="bg-diagonal bg-diagonal-gray bg-diagonal-r-lightgray rounded text-white py-2 px-4 mb-10">
                    <div class="row">
                        <div class="col-sm-2 text-left"><h6>Opened </h6></div>
                        <div class="col-sm-10 text-left"><h6><?php echo ": ".$DateOpen; ?></h6></div>
                    </div>
                    <div class="row">
                        <div class="col-sm-2 text-left"><h6>Closed </h6></div>
                        <div class="col-sm-10 text-left"><h6><?php echo ": ".$DateClosedate; ?></h6></div>
                    </div>
                </div>

                <?php
                if (!isset($_GET['action']) && empty($_GET['action']))
                {
                    $total = 0;
                    $total_submission = 0;
                    $not_graded = 0;
                    $graded = 0;
                    $filter = ['Class_id'=>$_SESSION["loggeduser_ClassID"]];
                    $query = new MongoDB\Driver\Query($filter);
                    $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Students',$query);

                    foreach ($cursor as $document)
                    {
                        $Consumer_id = $document->Consumer_id;
                        $total = $total + 1;
                        $filter1 = ['_id'=>new \MongoDB\BSON\ObjectId($Consumer_id)];
                        $query1 = new MongoDB\Driver\Query($filter1);
                        $cursor1 = $GoNGetzDatabase->executeQuery('GoNGetz.Consumer',$query1);
                            
                        foreach ($cursor1 as $document1)
                        {
                            $consumer_id = strval($document1->_id);

                            $filter2 = ['Created_by'=>$consumer_id,'Quiz_id'=>$Quiz_id];
                            $query2 = new MongoDB\Driver\Query($filter2);
                            $cursor2 = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.OL_Quiz_Answer',$query2);

                            foreach ($cursor2 as $document2)
                            {
                                $total_submission = $total_submission + 1;

                                $Quiz_Answer = $document2->Quiz;
                                $Total_Answer = count((array)$Quiz_Answer);
                                $sub_mark = 0;
                                
                                //0 subjective question
                                $subjective = 0;

                                for ($i = 0; $i < $Total_Question; $i++)
                                {
                                    $Type = $Quiz[$i]->Type;
                                    if($Type == 'SUBJECTIVE')
                                    {
                                        $subjective = 1;
                                        $id = $Quiz[$i]->id;

                                        $Mark_ans = $Quiz_Answer[$id]->Mark;
                                        $sub_mark += $Mark_ans;
                                    }
                                }
                                if($subjective == 1 && $sub_mark == 0)
                                {
                                    $not_graded = $not_graded + 1;
                                }
                                elseif($subjective == 0 && $sub_mark == 0)
                                {
                                    $not_graded = 0;
                                }
                                else
                                {
                                    $graded = $graded + 1;
                                }
                            }
                        }
                    }
                    ?>
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
                                <th>Shuffle</th>
                                <td><?php echo $Shuffle; ?></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr class="bg-gray-300 text-dark-50">
                                <th>Participants</th>
                                <td><?php echo $total; ?></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr class="text-dark-50">
                                <th>Submitted</th>
                                <td><?php echo $total_submission; ?></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr class="bg-gray-300 text-dark-50">
                                <th>Needs grading</th>
                                <td><?php echo $not_graded; ?></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr class="text-dark-50">
                                <th>Time remaining</th>
                                <td>
                                <?php
                                $due = date_format($DateClosezone,"Y-m-d\TH:i:s");
                                $due = new MongoDB\BSON\UTCDateTime((new DateTime($due))->getTimestamp());

                                $now = time();
                                $due = strval($due);

                                if ($due >= $now)
                                {
                                    echo " ".time_elapsed($due-$now)." \n";  
                                }
                                else
                                {
                                    ?> Quiz is due <?php
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
                }
                else
                {
                    $action = $_GET['action'];
                    if($action == 'grading')
                    {
                        ?>
                        <!--begin::Card-->
                        <div class="card card-custom shadow p-3 mb-5 bg-white rounded">
                            <div class="card-body">
                                <!--begin::Search Form-->
                                <div class="mb-7">
                                    <div class="noprint text-right">
                                        <!--begin::Dropdown-->
                                        <div class="dropdown dropdown-inline mr-2">
                                            <button type="button" class="btn btn-light font-weight-bolder dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
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
                                                    <li class="navi-header font-weight-bolder text-uppercase font-size-sm text-secondary pb-2">Choose an option:</li>
                                                    <li class="navi-item">
                                                        <a type="button" class="navi-link" onclick="window.print()">
                                                            <span class="navi-icon">
                                                                <i class="la la-print"></i>
                                                            </span>
                                                            <span class="navi-text">Print</span>
                                                        </a>
                                                    </li>
                                                    <li class="navi-item">
                                                        <a href="index.php?page=ol_submit_quiz&id=<?= $Quiz_id ?>&action=grading&list_submission=<?php echo "xls"; ?>" class="navi-link">
                                                            <span class="navi-icon">
                                                                <i class="la la-file-excel-o"></i>
                                                            </span>
                                                            <span class="navi-text">Excel</span>
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
                                <!--end::Search Form-->
                                <!--begin: Datatable-->
                                <table id="list" class="table table-borderless" style="background-color: #7e8299 !important;">
                                <thead class="text-white text-center">
                                    <tr>
                                    <th scope="col">Name</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Grade</th>
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
                                        ?>
                                        <tr bgcolor="white" class="text-center">
                                        <td><?php echo $Consumer_FName; ?></td>
                                        <?php

                                        $Answer_Created_by = '';
                                        $Mark = 0;
                                        $File_submission = 'null';

                                        $due = date_format($DateClosezone,"Y-m-d\TH:i:s");
                                        $due = new MongoDB\BSON\UTCDateTime((new DateTime($due))->getTimestamp());
                                    
                                        $now = time();
                                        $due = strval($due);
                                        $time_elapsed = 0;

                                        $filter2 = ['Created_by'=>$consumer_id,'Quiz_id'=>$Quiz_id];
                                        $query2 = new MongoDB\Driver\Query($filter2);
                                        $cursor2 = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.OL_Quiz_Answer',$query2);

                                        foreach ($cursor2 as $document2)
                                        {
                                            $Answer_id = strval($document2->_id);
                                            $Answer_Created_by = $document2->Created_by;
                                            $Created_date = $document2->Created_date;

                                            $Submit = new MongoDB\BSON\UTCDateTime(strval($Created_date));
                                            $Submit = $Submit->toDateTime()->setTimezone(new \DateTimeZone(date_default_timezone_get()));
                                            $Submit = date_format($Submit,"Y-m-d\TH:i:s");
                                            $Submit = new MongoDB\BSON\UTCDateTime((new DateTime($Submit))->getTimestamp());
                
                                            $Submit = strval($Submit);
                                            $now = time();
                                            $due = strval($due);

                                            $Quiz_Answer = $document2->Quiz;
                                            $Total_Answer = count((array)$Quiz_Answer);
                                            $total_mark = 0;

                                            for ($i = 0; $i < $Total_Answer; $i++)
                                            {
                                                $Mark_ans = $Quiz_Answer[$i]->Mark;
                                                $total_mark += $Mark_ans;
                                            }

                                            //before due
                                            if($due >= $now)
                                            {
                                                ?>
                                                <td>
                                                <div class="row">
                                                    <div class="col-sm-1"></div>
                                                    <div class="col-sm-3">
                                                        <div class="bg-warning text-white text-center"><?php echo "submitted for grading"; ?></div>
                                                    </div>
                                                    <div class="col-sm text-left">
                                                        <a style="color:green;"><?php echo "Quiz was submitted :".time_elapsed($due-$Submit)." before due \n"; ?></a>
                                                    </div>
                                                </div>
                                                </td>
                                                <td>
                                                    <button class="btn btn-outline-warning btn-sm rounded-pill btn-hover-outline-white btn-block">
                                                    <?= $total_mark; ?> / <?=  $totalmark ?>
                                                    </button>
                                                </td>
                                                <td>
                                                <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#EditCommentQuiz" data-bs-whatever="<?php echo $Answer_id; ?>">
                                                    <i  class="fa fa-edit"></i>
                                                </button>
                                                </td>
                                                <?php
                                            }       
                                            //after due   
                                            else
                                            {
                                                //overdue
                                                if($due <= $Submit)
                                                {
                                                    ?>
                                                    <td>
                                                    <div class="row">
                                                        <div class="col-sm-1"></div>
                                                        <div class="col-sm-3">
                                                            <div class="bg-warning text-white text-center"><?php echo "submitted for grading"; ?></div>
                                                        </div>
                                                        <div class="col-sm text-left">
                                                            <a style="color:red;"><?php echo "Quiz was submitted : ".time_elapsed($Submit-$due)." late \n"; ?></a>
                                                        </div>
                                                    </div>
                                                    </td>
                                                    <td>
                                                        <button class="btn btn-outline-warning btn-sm rounded-pill btn-hover-outline-white btn-block">
                                                        <?= $total_mark; ?> / <?=  $totalmark ?>
                                                        </button>
                                                    </td>
                                                    <td>
                                                    <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#EditCommentQuiz" data-bs-whatever="<?php echo $Answer_id; ?>">
                                                        <i  class="fa fa-edit"></i>
                                                    </button>
                                                    </td>
                                                    <?php
                                                }
                                                else
                                                {
                                                    ?>
                                                    <td>
                                                    <div class="row">
                                                        <div class="col-sm-1"></div>
                                                        <div class="col-sm-3">
                                                            <div class="bg-warning text-white text-center"><?php echo "submitted for grading"; ?></div>
                                                        </div>
                                                        <div class="col-sm text-left">
                                                        <a style="color:green;"><?php echo "Quiz was submitted :".time_elapsed($due-$Submit)." before due \n"; ?></a>
                                                        </div>
                                                    </div>
                                                    </td>
                                                    <td>
                                                        <button class="btn btn-outline-warning btn-sm rounded-pill btn-hover-outline-white btn-block">
                                                        <?= $total_mark; ?> / <?=  $totalmark ?>
                                                        </button>
                                                    </td>
                                                    <td>
                                                    <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#EditCommentQuiz" data-bs-whatever="<?php echo $Answer_id; ?>">
                                                        <i  class="fa fa-edit"></i>
                                                    </button>
                                                    </td>
                                                    <?php
                                                }
                                            }      
                                        }
                                        if($Answer_Created_by == '')
                                        {
                                            //before due
                                            if($due >= $now)
                                            {
                                                ?>
                                                <td>
                                                <div class="row">
                                                    <div class="col-sm-1"></div>
                                                    <div class="col-sm-3">
                                                        <div class="bg-danger text-white text-center"><?php echo "No submission"; ?></div>
                                                    </div>
                                                    <div class="col-sm text-left">
                                                        <a style="color:green;"><?php echo "Quiz not due yet :";  echo " ".time_elapsed($due-$now)." left \n"; ?></a>
                                                    </div>
                                                </div>
                                                </td>
                                                <td>
                                                    <button class="btn btn-outline-danger btn-sm rounded-pill btn-hover-outline-white btn-block">
                                                    0 / <?=  $totalmark ?>
                                                    </button>
                                                </td>
                                                <td>
                                                <button type="button" class="btn" disabled>
                                                    <i  class="fa fa-edit"></i>
                                                </button>
                                                </td>
                                                <?php
                                            }       
                                            //after due   
                                            else
                                            {
                                                ?>
                                                <td>
                                                <div class="row">
                                                    <div class="col-sm-1"></div>
                                                    <div class="col-sm-3">
                                                        <div class="bg-danger text-white text-center"><?php echo "No submission"; ?></div>
                                                    </div>
                                                    <div class="col-sm text-left">
                                                        <a style="color:red;"><?php echo "Quiz is overdue :";  echo " ".time_elapsed($now-$due)." ago \n"; ?></a>
                                                    </div>
                                                </div>
                                                </td>
                                                <td>
                                                    <button class="btn btn-outline-danger btn-sm rounded-pill btn-hover-outline-white btn-block">
                                                    0 / <?=  $totalmark ?>
                                                    </button>
                                                </td>
                                                <td>
                                                <button type="button" class="btn" disabled>
                                                    <i  class="fa fa-edit"></i>
                                                </button>
                                                </td>
                                                <?php
                                            }    
                                        }  
                                        ?>
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
                    <?php
                    }
                    elseif ($action == 'grader')
                    {
                        ?>
                        <!--begin::Card-->
                        <div class="card card-custom shadow p-3 mb-10 bg-white rounded">
                            <?php
                            $filter = ['Class_id'=>$_SESSION["loggeduser_ClassID"]];
                            $query = new MongoDB\Driver\Query($filter);
                            $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Students',$query);

                            foreach ($cursor as $document)
                            {
                                $Consumer_id = $document->Consumer_id;
                            }
                            ?>
                            <div class="row">
                                <div class="col-sm-10"></div>
                                <div class="col-sm-2 text-right">
                                    <button class="btn btn-secondary font-weight-bolder btn-sm mb-2" type="button" data-bs-toggle="dropdown">Change User &nbsp; <i class="fas fa-sort"></i></button>
                                    <ul class="dropdown-menu">
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
                                            }
                                            ?>
                                            <li class="dropdown-item"><a class="text-secondary text-hover-primary" href="index.php?page=ol_submit_quiz&id=<?php echo $Quiz_id; ?>&action=grader&user=<?php echo $Consumer_id; ?>"><?php echo $Consumer_FName." ".$Consumer_LName; ?></a></li>
                                            <?php
                                        }
                                        ?>
                                    </ul>
                                </div>
                            </div>
                            <?php

                            if (!isset($_GET['user']) && empty($_GET['user']))
                            {
                                $filter1 = ['_id'=>new \MongoDB\BSON\ObjectId($Consumer_id)];
                                $query1 = new MongoDB\Driver\Query($filter1);
                                $cursor1 = $GoNGetzDatabase->executeQuery('GoNGetz.Consumer',$query1);
                            }
                            else
                            {
                                $Consumer_id = ($_GET['user']);
                                $filter1 = ['_id'=>new \MongoDB\BSON\ObjectId($Consumer_id)];
                                $query1 = new MongoDB\Driver\Query($filter1);
                                $cursor1 = $GoNGetzDatabase->executeQuery('GoNGetz.Consumer',$query1);
                            }
                                
                            foreach ($cursor1 as $document1)
                            {
                                $consumer_id = strval($document1->_id);
                                $Consumer_FName = $document1->ConsumerFName;
                                $Consumer_LName = $document1->ConsumerLName;
                                $ConsumerIDNo = $document1->ConsumerIDNo;
                                $ConsumerAddress = $document1->ConsumerAddress;
                                $ConsumerPhone = $document1->ConsumerPhone;
                               
                                ?>
                                    <div class="mx-10 mb-3">
                                        <h5><b><?php echo $Consumer_FName." ".$Consumer_LName."<br>"; ?></b></h5>
                                        <?php
                                        echo $ConsumerIDNo."<br>";
                                        echo $ConsumerPhone."<br>";
                                        echo $ConsumerAddress."<br>";
                                        ?>
                                    </div>
                                    <?php
                                    $Answer_Created_by = '';
                                    $Mark = 0;
                                    $File_submission = 'null';

                                    $due = date_format($DateClosezone,"Y-m-d\TH:i:s");
                                    $due = new MongoDB\BSON\UTCDateTime((new DateTime($due))->getTimestamp());
                                
                                    $now = time();
                                    $due = strval($due);
                                    $time_elapsed = 0;

                                    $filter2 = ['Created_by'=>$consumer_id,'Quiz_id'=>$Quiz_id];
                                    $query2 = new MongoDB\Driver\Query($filter2);
                                    $cursor2 = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.OL_Quiz_Answer',$query2);

                                    foreach ($cursor2 as $document2)
                                    {
                                        $Answer_id = strval($document2->_id);
                                        $Answer_Created_by = $document2->Created_by;
                                        $Created_date = $document2->Created_date;
                                        $Comment = $document2->Comment;

                                        $Created_date = new MongoDB\BSON\UTCDateTime(strval($Created_date));
                                        $Created_date = $Created_date->toDateTime()->setTimezone(new \DateTimeZone(date_default_timezone_get()));

                                        $Submit_dateformat = date_format($Created_date,"D, d F, h:i");
                                        $Created_date = date_format($Created_date,"Y-m-d\TH:i:s");
                                        $Created_date = new MongoDB\BSON\UTCDateTime((new DateTime($Created_date))->getTimestamp());

                                        $Submitfrom = date_format($DateOpenzone,"D, d F, h:i");
                                        $Duedate = date_format($DateClosezone,"D, d F, h:i");
            
                                        $Created_date = strval($Created_date);
                                        $now = time();
                                        $due = strval($due);
                                        $Quiz_Answer = $document2->Quiz;
                                        $Total_Answer = count((array)$Quiz_Answer);
                                        $objective_ans_mark = 0;
                                        $subjective_ans_mark = 0;

                                        //0 subjective question
                                        $subjective = 0;
                        
                                        for ($i = 0; $i < $Total_Question; $i++)
                                        {
                                            $Type = $Quiz[$i]->Type;
                                            $id = $Quiz[$i]->id;

                                            if($Type == 'OBJECTIVE')
                                            {
                                                $Mark_ans = $Quiz_Answer[$id]->Mark;
                                                $objective_ans_mark += $Mark_ans;
                                            }
                                            elseif($Type == 'SUBJECTIVE')
                                            {
                                                $subjective = 1;
                                                $Mark_ans = $Quiz_Answer[$id]->Mark;
                                                $subjective_ans_mark += $Mark_ans;
                                            }
                                            $Total_ans_mark = $objective_ans_mark + $subjective_ans_mark;
                                        }
                                        
                                        ?>
                                        <br>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="mx-10 mb-3">
                                                    <a class="btn btn-sm btn-circle btn-outline-success"><b>Submission Timeline</b></a>
                                                    <!--begin::Timeline-->
                                                    <div class="timeline timeline-6 mt-3 mx-3">
                                                        <!--begin::Item-->
                                                        <div class="timeline-item align-items-start">
                                                            <!--begin::Label-->
                                                            <div class="timeline-label font-weight-bolder text-dark-75 font-size-lg"><b><?php echo $Submitfrom; ?></b></div>
                                                            <!--end::Label-->
                                                            <!--begin::Badge-->
                                                            <div class="timeline-badge">
                                                                <i class="fa fa-genderless text-success icon-xl"></i>
                                                            </div>
                                                            <!--end::Badge-->
                                                            <!--begin::Content-->
                                                            <div class="timeline-content d-flex">
                                                                <span class="font-weight-bolder text-dark-75 pl-3 font-size-lg">Opened Date</span>
                                                            </div>
                                                            <!--end::Content-->
                                                        </div>
                                                        <!--end::Item-->
                                                        <?php
                                                        if($due >= $Created_date)
                                                        {
                                                        ?>
                                                        <!--begin::Item-->
                                                        <div class="timeline-item align-items-start">
                                                            <!--begin::Label-->
                                                            <div class="timeline-label font-weight-bolder text-dark-75 font-size-lg"><b><?php echo $Submit_dateformat; ?></b></div>
                                                            <!--end::Label-->
                                                            <!--begin::Badge-->
                                                            <div class="timeline-badge">
                                                                <i class="fa fa-genderless text-warning icon-xl"></i>
                                                            </div>
                                                            <!--end::Badge-->
                                                            <!--begin::Desc-->
                                                            <div class="timeline-content font-weight-bolder font-size-lg text-dark-75 pl-3">Quiz Submission : 
                                                            <a href="#" class="text-primary">file</a></div>
                                                            <!--end::Desc-->
                                                        </div>
                                                        <!--end::Item-->
                                                        <?php
                                                        }
                                                        ?>
                                                        <!--begin::Item-->
                                                        <div class="timeline-item align-items-start">
                                                            <!--begin::Label-->
                                                            <div class="timeline-label font-weight-bolder text-dark-75 font-size-lg"><b><?php echo $Duedate; ?></b></div>
                                                            <!--end::Label-->
                                                            <!--begin::Badge-->
                                                            <div class="timeline-badge">
                                                                <i class="fa fa-genderless text-success icon-xl"></i>
                                                            </div>
                                                            <!--end::Badge-->
                                                            <!--begin::Desc-->
                                                            <div class="timeline-content font-weight-bolder text-dark-75 pl-3 font-size-lg">Closed Date</div>
                                                            <!--end::Desc-->
                                                        </div>
                                                        <!--end::Item-->
                                                        <?php
                                                        if($due <= $Created_date)
                                                        {
                                                        ?>
                                                        <!--begin::Item-->
                                                        <div class="timeline-item align-items-start">
                                                            <!--begin::Label-->
                                                            <div class="timeline-label font-weight-bolder text-dark-75 font-size-lg"><b><?php echo $Submit_dateformat; ?></b></div>
                                                            <!--end::Label-->
                                                            <!--begin::Badge-->
                                                            <div class="timeline-badge">
                                                                <i class="fa fa-genderless text-danger icon-xl"></i>
                                                            </div>
                                                            <!--end::Badge-->
                                                            <!--begin::Desc-->
                                                            <div class="timeline-content font-weight-bolder font-size-lg text-dark-75 pl-3">Quiz Submission : 
                                                            &nbsp; <a href="#" class="text-primary">file</a>&nbsp; <span class="label label-md font-weight-bold label-pill label-inline label-danger">overdue</span>
                                                            </div>
                                                            <!--end::Desc-->
                                                        </div>
                                                        <!--end::Item-->
                                                        <?php
                                                        }
                                                        ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <a class="btn btn-sm btn-circle btn-outline-success"><b>Grade</b></a>
                                                <div class="row mx-0 mt-3 text-primary">
                                                    <div class="col-sm-2">
                                                        <b>Total Mark</b>
                                                    </div>
                                                    <div class="col-sm">
                                                        <b>:</b>
                                                        <b><?php echo $Total_ans_mark; ?> / <?=  $totalmark ?></b>
                                                    </div>
                                                </div>
                                                <div class="row mx-0 mt-3">
                                                    <div class="col-sm-2">
                                                        <b>Objective</b>
                                                    </div>
                                                    <div class="col-sm">
                                                        <div class="checkbox-inline">
                                                            <b>:</b>&nbsp;
                                                            <b><?php echo $objective_ans_mark; ?> / <?=  $objective_mark ?></b>&nbsp; &nbsp;
                                                            <span class="label label-md font-weight-bold label-pill label-inline label-primary">
                                                           graded   
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <?php
                                                if ($subjective == 1)
                                                {
                                                    ?>
                                                    <div class="row mx-0 mt-3">
                                                        <div class="col-sm-2">
                                                            <b>Subjective</b>
                                                        </div>
                                                        <div class="col-sm">
                                                            <div class="checkbox-inline">
                                                                <b>:</b>&nbsp;
                                                                <b><?php echo $subjective_ans_mark; ?> / <?=  $subjective_mark ?></b>&nbsp; &nbsp;
                                                                <span class="label label-md font-weight-bold label-pill label-inline label-primary">
                                                                <?php
                                                                if ($subjective_ans_mark == 0)
                                                                {
                                                                    echo "not graded";
                                                                }
                                                                else
                                                                {
                                                                    echo "graded";
                                                                }
                                                                ?>
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <?php
                                                }
                                                ?>
                                                <div class="row mx-0 mt-3">
                                                    <div class="col-sm-2">
                                                        <b>Comments</b>
                                                    </div>
                                                    <div class="col-sm">
                                                        <div class="checkbox-inline">
                                                            <b>:</b>&nbsp;
                                                            <b><?php echo $Comment; ?></b>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="separator separator-solid my-5"></div>
                                        <div class="mx-6 mb-3">
                                            <form name="GradeSubjective" action="" method="post">
                                                <div class="modal-body">
                                                    <input type="hidden" name="answer_id" value="<?php echo $Answer_id; ?>">
                                                    <?php
                                                    for ($i = 0; $i < $Total_Question; $i++)
                                                    {
                                                        $Type = $Quiz[$i]->Type;
                                                        $Question = $Quiz[$i]->Question;
                                                        $Answer = $Quiz[$i]->Answer;
                                                        
                                                        if ($Type == "SUBJECTIVE")
                                                        {
                                                            $id = $Quiz[$i]->id;
                                                            $Mark_subjective = $Quiz[$i]->Mark;

                                                            $Answer2 = $Quiz_Answer[$id]->Answer; 
                                                            $Mark2 = $Quiz_Answer[$i]->Mark;
                                                            ?>
                                                            <div class="row mb-5 p-5 border">
                                                                <div class="col-sm">
                                                                    <div class="row">
                                                                        <div class="col-2">
                                                                            <label class="align-items-baseline">Question <?php echo $id; ?></label>
                                                                        </div>
                                                                        <div class="col">
                                                                            <label align="justify"><?php echo $Question; ?></label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-2">
                                                                            <label>Answer Key</label>
                                                                        </div>
                                                                        <div class="col">
                                                                            <label align="justify"><?php echo $Answer; ?></label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-2">
                                                                            <label class="text-primary"><b>Answer</b></label>
                                                                        </div>
                                                                        <div class="col">
                                                                            <label class="text-primary" align="justify"><b><?php echo $Answer2; ?></b></label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-2">
                                                                            <label>Mark</label>
                                                                        </div>
                                                                        <div class="col">
                                                                            <input class="form-control" type="number" name="ans<?= $id  ?>" min="0" max="<?=  $Mark_subjective ?>" placeholder="  Mark out of <?php echo $Mark_subjective; ?>">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm"></div>
                                                            </div>
                                                            <?php
                                                        }
                                                    }
                                                    ?>
                                                    <div class="row mb-5">
                                                        <div class="col-sm">
                                                            <label>Feedback Comments</label>
                                                            <textarea class="grade" name="Comment"></textarea>
                                                        </div>
                                                        <div class="col-sm"></div>  
                                                    </div>
                                                    <div class="row mb-5">
                                                        <div class="col-sm ">
                                                            <input type="hidden" name="quiz_id" value="<?php echo $Quiz_id; ?>">
                                                            <button type="reset" class="btn btn-secondary btn-sm">Reset</button>
                                                            <button type="submit" name="GradeSubjective" class="btn btn-success btn-sm">Submit</button>
                                                        </div>  
                                                        <div class="col-sm"></div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                        <?php
                                    }
                                    ?>
                                <?php
                            }
                            ?>
                        </div>
                        <!--end::Card-->
                        <?php
                    }
                }
                ?>
                <?php
                if($_SESSION["loggeduser_ACCESS"] == 'TEACHER')
                {
                    ?>
                    <div class="card-footer">
                        <div class="row">
                            <div class="col-lg-12 text-center">
                                <a href="index.php?page=ol_quiz&id=<?php echo $Quiz_id; ?>" type="button" class="btn btn-sm text-white" style="background-color:#7e8299;">Quiz Attempts</a>
                                <a href="index.php?page=ol_submit_quiz&id=<?php echo $Quiz_id; ?>&action=grading"><button type="button" class="btn btn-sm btn-secondary">View all submission</button></a>
                                <a href="index.php?page=ol_submit_quiz&id=<?php echo $Quiz_id; ?>&action=grader"><button type="button" class="btn btn-sm text-white" style="background-color:#7e8299;">Grade</button></a>
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
                                <a href="index.php?page=ol_quiz&id=<?php echo $Quiz_id; ?>" type="button" class="btn btn-sm text-white">Quiz Attempts</a>
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
include ('view/pages/ol_modal-grade.php'); 
?>