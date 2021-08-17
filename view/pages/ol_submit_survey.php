<?php
include 'model/survey.php';
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
    content: "Manually Mark";
    position: absolute;
    left: 45%;
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
					<h5 class="text-white font-weight-bold my-1 mr-5">Survey</h5>
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
                    <div class="card-toolbar">

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
            $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.OL_Survey',$query);
            foreach ($cursor as $document)
            {
                $Survey_id =strval($document->_id);
                $type = $document->type;
                $Title = $document->Title;
                $Created_date = $document->Created_date;
                $Availability = $document->Availability;

                $Created_date_utc = new MongoDB\BSON\UTCDateTime(strval($Created_date));
                $Created_date_timezone = $Created_date_utc->toDateTime()->setTimezone(new \DateTimeZone(date_default_timezone_get()));
                //Monday, 19 February 2018, 1:00 AM
                $Created_date = date_format($Created_date_timezone,"l, d F Y, h:i")." PM";

                ?>
                <h3 class="text-dark-600 mb-8">SURVEY : <?php echo $Title; ?></h3>

                <div class="bg-diagonal bg-diagonal-gray bg-diagonal-r-lightgray rounded text-white p-8 mb-10">
                    <div class="row">
                        <div class="col-sm-2 text-left"><h6>Created date </h6></div>
                        <div class="col-sm-10 text-left"><h6><?php echo ": ".$Created_date; ?></h6></div>
                    </div>
                </div>

                <?php
                if (!isset($_GET['action']) && empty($_GET['action']))
                {
                    $total = 0;
                    $total_submission = 0;
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

                            $filter2 = ['Created_by'=>$consumer_id,'Survey_id'=>$Survey_id];
                            $query2 = new MongoDB\Driver\Query($filter2);
                            $cursor2 = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.OL_Survey_Answer',$query2);

                            foreach ($cursor2 as $document2)
                            {
                                $total_submission = $total_submission + 1;
                            }
                        }
                    }
                    ?>
                    <h3 class="text-dark-600 mb-8">GRADING SUMMARY</h3>
                    <table class="table table-hover table-borderless">
                        <tbody>
                            <tr class="bg-gray-300 text-dark-50">
                                <th class="col-6">Hidden from students</th>
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
                                <th class="col-6">Participants</th>
                                <td><?php echo $total; ?></td>
                            </tr>
                            <tr class="bg-gray-300 text-dark-50">
                                <th class="col-6">Submitted</th>
                                <td><?php echo $total_submission; ?></td>
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
                                                        <a href="index.php?page=ol_submit_survey&id=<?= $Survey_id ?>&action=grading&list_submission=<?php echo "xls"; ?>" class="navi-link">
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
                                    <th scope="col">Answer</th>
                                    <th scope="col">Chart</th>
                                    </tr>
                                </thead>
                                <tbody class="text-secondary">
                                <?php
                                $total = 0;
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
                                        $filter2 = ['Created_by'=>$consumer_id,'Survey_id'=>$Survey_id];
                                        $query2 = new MongoDB\Driver\Query($filter2);
                                        $cursor2 = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.OL_Survey_Answer',$query2);

                                        foreach ($cursor2 as $document2)
                                        {
                                            $total = $total + 1;
                                            $Answer_id = strval($document2->_id);
                                            $Answer_Created_by = $document2->Created_by;
                                            $Created_date = $document2->Created_date;
                                            $Survey_ans = $document2->Survey_ans;
                                            $Total_Answer = count((array)$Survey_ans);
                                            ?>
                                            <td>
                                                <div class="bg-warning text-white text-center"><?php echo "submitted"; ?></div>   
                                            </td>
                                            <?php
                                            if ($type == '5')
                                            {
                                            ?>
                                            <td>
                                            <form name="detail" action="index.php?page=ol_submit_survey&id=<?= $Survey_id ?>&action=survey5" method="post">
                                                <input type="hidden" name="survey_answer_id" value="<?= $Answer_id; ?>"></input>
                                                <button type="submit" class="btn btn-sm btn-light flaticon2-list-1" name="detail"></button>
                                            </form>
                                            </td>
                                            <td>
                                                <button class="btn btn-light btn-sm font-weight-bolder" disabled>
                                                <span class="svg-icon svg-icon-primary svg-icon-2x">
                                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                        <rect x="0" y="0" width="24" height="24"/>
                                                        <rect fill="#000000" opacity="0.3" x="13" y="4" width="3" height="16" rx="1.5"/>
                                                        <rect fill="#000000" x="8" y="9" width="3" height="11" rx="1.5"/>
                                                        <rect fill="#000000" x="18" y="11" width="3" height="9" rx="1.5"/>
                                                        <rect fill="#000000" x="3" y="13" width="3" height="7" rx="1.5"/>
                                                    </g>
                                                </svg>
                                                </span>Student Grades</button>
                                            </td>
                                            <?php
                                            }
                                            else
                                            {
                                            ?>
                                            <td>
                                                <form name="detail" action="index.php?page=ol_submit_survey&id=<?= $Survey_id ?>&action=survey" method="post">
                                                    <input type="hidden" name="survey_answer_id" value="<?= $Answer_id; ?>"></input>
                                                    <button type="submit" class="btn btn-sm btn-light flaticon2-list-1" name="detail"></button>
                                                </form>
                                            </td>
                                            <td>
                                            <?php
                                            if($type == 2)
                                            {
                                                ?>
                                                <form name="myForm">
                                                    <a class="btn btn-light btn-sm font-weight-bolder" onclick="myFunction2()">
                                                    <span class="svg-icon svg-icon-primary svg-icon-2x">
                                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                            <rect x="0" y="0" width="24" height="24"/>
                                                            <rect fill="#000000" opacity="0.3" x="13" y="4" width="3" height="16" rx="1.5"/>
                                                            <rect fill="#000000" x="8" y="9" width="3" height="11" rx="1.5"/>
                                                            <rect fill="#000000" x="18" y="11" width="3" height="9" rx="1.5"/>
                                                            <rect fill="#000000" x="3" y="13" width="3" height="7" rx="1.5"/>
                                                        </g>
                                                    </svg>
                                                    </span>Student Grades</a>
                                                    <?php
                                                    for ($i = 0; $i < $Total_Answer; $i++)
                                                    {
                                                        $Q = $Survey_ans[$i]->Q;
                                                        ?>
                                                        <input type="hidden" name="q<?= $i; ?>" value="<?= $Q; ?>">
                                                        <?php
                                                    }
                                                    ?>
                                                    <input type="hidden" name="student" value="<?= $Consumer_FName; ?>">
                                                </form>
                                                <?php
                                            }
                                            elseif($type == 1 || $type == 3)
                                            {
                                                ?>
                                                <form name="myForm">
                                                    <a class="btn btn-light btn-sm font-weight-bolder" onclick="myFunction3()">
                                                    <span class="svg-icon svg-icon-primary svg-icon-2x">
                                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                            <rect x="0" y="0" width="24" height="24"/>
                                                            <rect fill="#000000" opacity="0.3" x="13" y="4" width="3" height="16" rx="1.5"/>
                                                            <rect fill="#000000" x="8" y="9" width="3" height="11" rx="1.5"/>
                                                            <rect fill="#000000" x="18" y="11" width="3" height="9" rx="1.5"/>
                                                            <rect fill="#000000" x="3" y="13" width="3" height="7" rx="1.5"/>
                                                        </g>
                                                    </svg>
                                                    </span>Student Grades</a>
                                                    <?php
                                                    for ($i = 0; $i < $Total_Answer; $i++)
                                                    {
                                                        $Q = $Survey_ans[$i]->Q;
                                                        ?>
                                                        <input type="hidden" name="q<?= $i; ?>" value="<?= $Q; ?>">
                                                        <?php
                                                    }
                                                    ?>
                                                    <input type="hidden" name="student" value="<?= $Consumer_FName; ?>">
                                                </form>
                                                <?php
                                            }
                                            elseif($type == 4)
                                            {
                                                ?>
                                                <form name="myForm">
                                                    <a class="btn btn-light btn-sm font-weight-bolder" onclick="myFunction4()">
                                                    <span class="svg-icon svg-icon-primary svg-icon-2x">
                                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                            <rect x="0" y="0" width="24" height="24"/>
                                                            <rect fill="#000000" opacity="0.3" x="13" y="4" width="3" height="16" rx="1.5"/>
                                                            <rect fill="#000000" x="8" y="9" width="3" height="11" rx="1.5"/>
                                                            <rect fill="#000000" x="18" y="11" width="3" height="9" rx="1.5"/>
                                                            <rect fill="#000000" x="3" y="13" width="3" height="7" rx="1.5"/>
                                                        </g>
                                                    </svg>
                                                    </span>Student Grades</a>
                                                    <?php
                                                    for ($i = 0; $i < $Total_Answer; $i++)
                                                    {
                                                        $Q = $Survey_ans[$i]->Q;
                                                        ?>
                                                        <input type="hidden" name="q<?= $i; ?>" value="<?= $Q; ?>">
                                                        <?php
                                                    }
                                                    ?>
                                                    <input type="hidden" name="student" value="<?= $Consumer_FName; ?>">
                                                </form>
                                                <?php
                                            }
                                            ?>
                                            </td>
                                            <?php
                                            }
                                        } 
                                        ?>
                                    <?php 
                                    }
                                    if($Answer_Created_by == '')
                                    {
                                        ?>
                                        <td>
                                            <div class="bg-danger text-white text-center"><?php echo "No submission"; ?></div>
                                        </td>
                                        <td>
                                            <button type="submit" class="btn btn-sm btn-light flaticon2-list-1" disabled></button>
                                        </td>
                                        <td>
                                            <button class="btn btn-light btn-sm font-weight-bolder" disabled>
                                            <span class="svg-icon svg-icon-primary svg-icon-2x">
                                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                    <rect x="0" y="0" width="24" height="24"/>
                                                    <rect fill="#000000" opacity="0.3" x="13" y="4" width="3" height="16" rx="1.5"/>
                                                    <rect fill="#000000" x="8" y="9" width="3" height="11" rx="1.5"/>
                                                    <rect fill="#000000" x="18" y="11" width="3" height="9" rx="1.5"/>
                                                    <rect fill="#000000" x="3" y="13" width="3" height="7" rx="1.5"/>
                                                </g>
                                            </svg>
                                            </span>Student Grades</button>
                                        </td>
                                        <?php
                                    } 
                                    ?>
                                    </tr>
                                    <?php
                                }
                                ?>
                                </tbody>
                                </table>
                                </div>
                                <div class="row">
                                    <div class="col-2"></div>
                                    <div class="col-8"> 
                                        <canvas id="myChart"></canvas>
                                    </div>
                                    <div class="col-2"></div>
                                </div>
                                <!--end: Datatable-->
                            </div>
                        </div>
                    <?php
                    }
                    elseif($action == 'survey')
                    {
                        $survey_answer_id = $_POST['survey_answer_id'];

                        $filter = ['_id'=>new \MongoDB\BSON\ObjectId($survey_answer_id)];
                        $query = new MongoDB\Driver\Query($filter);
                        $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.OL_Survey_Answer',$query);

                        foreach ($cursor as $document3)
                        {
                            $Survey_ans = strval($document3->_id);
                            $Survey_Answer = $document3->Survey_ans;
                            $Total_Answer = count((array)$Survey_Answer);
                        }
                        ?>
                        <div class="content d-flex flex-column flex-column-fluid">
                            <div class="card card-custom gutter-b px-5">
                                <div class="card-body">
                                    <div class="row">
                                        <?php
                                        for ($i = 0; $i < $Total_Answer; $i++)
                                        {
                                            $Q[$i]= $Survey_Answer[$i]->Q;
                                            echo $Q[$i];
                                        }
                                        ?>
                                        <!-- <div>
                                            <canvas id="myChart"></canvas>
                                        </div>
                                        
                                        <script>
                                        const labels = [
                                        'January',
                                        'February',
                                        'March',
                                        'April',
                                        'May',
                                        'June',
                                        ];
                                        const data = {
                                            labels: labels,
                                            datasets: [{
                                            label: 'My First dataset',
                                            backgroundColor: 'rgb(255, 99, 132)',
                                            borderColor: 'rgb(255, 99, 132)',
                                            data: [0, 10, 5, 2, 20, 30, 45],
                                            }]
                                        };

                                        const config = {
                                        type: 'line',
                                        data,
                                        options: {}
                                        };

                                        var myChart = new Chart(
                                            document.getElementById('myChart'),
                                            config
                                        );
                                        </script> -->
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                    elseif($action == 'survey5')
                    {
                        $survey_answer_id = $_POST['survey_answer_id'];

                        $filter = ['_id'=>new \MongoDB\BSON\ObjectId($survey_answer_id)];
                        $query = new MongoDB\Driver\Query($filter);
                        $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.OL_Survey_Answer',$query);

                        foreach ($cursor as $document3)
                        {
                            $Survey_ans = strval($document3->_id);
                            $Survey_Answer = $document3->Survey_ans;
                            $Total_Answer = count((array)$Survey_Answer);
                            $Q0 = $Survey_Answer[0]->Q;
                            $Q1 = $Survey_Answer[1]->Q;
                            $Q2 = $Survey_Answer[2]->Q;
                            $Q3 = $Survey_Answer[3]->Q;
                            $Q4 = $Survey_Answer[4]->Q;
                        }
                        ?>
                        <div class="content d-flex flex-column flex-column-fluid">
                            <div class="card card-custom gutter-b px-5">
                                <div class="card-body">
                                    <div class="row">
                                        <p><b>While thinking about recent events in this class, answer the questions below. All questions are required and must be answered.</b></p>
                                        <ol class="mt-10 mb-3">
                                            <div class="form-group row ">
                                                <div class="col-md-3 col-form-label d-flex pb-0 pr-md-0">
                                                    <li>At what moment in class were you most engaged as a learner?</li>
                                                </div>
                                                <a href=""><?= $Q0 ?></a>
                                            </div>
                                            <div class="form-group row ">
                                                <div class="col-md-3 col-form-label d-flex pb-0 pr-md-0">
                                                    <li>At what moment in class were you most distanced as a learner?</li>
                                                </div>
                                                <a href=""><?= $Q1 ?></a>
                                            </div>
                                            <div class="form-group row ">
                                                <div class="col-md-3 col-form-label d-flex pb-0 pr-md-0">
                                                    <li>What action from anyone in the forums did you find most affirming or helpful?</li>
                                                </div>
                                                <a href=""><?= $Q2 ?></a>
                                            </div>
                                            <div class="form-group row ">
                                                <div class="col-md-3 col-form-label d-flex pb-0 pr-md-0">
                                                    <li>What action from anyone in the forums did you find most puzzling or confusing?</li>
                                                </div>
                                                <a href=""><?= $Q3 ?></a>
                                            </div>
                                            <div class="form-group row ">
                                                <div class="col-md-3 col-form-label d-flex pb-0 pr-md-0">
                                                    <li>What event surprised you most?</li>
                                                </div>
                                                <a href=""><?= $Q4 ?></a>
                                            </div>
                                        </ol>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                }
                if($_SESSION["loggeduser_ACCESS"] == 'TEACHER')
                {
                    ?>
                    <div class="card-footer">
                        <div class="row">
                            <div class="col-lg-12 text-center">
                                <a href="index.php?page=ol_survey&id=<?php echo $Survey_id; ?>" type="button" class="btn btn-sm text-white" style="background-color:#7e8299;">Preview survey now</a>
                                <a href="index.php?page=ol_submit_survey&id=<?php echo $Survey_id; ?>&action=grading"><button type="button" class="btn btn-sm btn-secondary">View all submission</button></a>
                            </div>
                        </div>
                    </div>
                    <?php
                } 
                elseif($_SESSION["loggeduser_ACCESS"] == 'STUDENT')
                {
                    ?>
                    <div class="card-footer">
                        <div class="row">
                            <div class="col-lg-12 text-center">
                                <a href="index.php?page=ol_survey&id=<?php echo $Survey_id; ?>" type="button" class="btn btn-sm text-white">Survey Attempts</a>
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
<?php include ('view/pages/ol_modal-grade.php'); ?>
<script>
function myFunction2() {
    var student = document.forms["myForm"]["student"].value;

    var k = 'q';
    for (let count = 0; count < 49; count++) {
        var question = document.forms["myForm"]["q"+count].value;
        eval('var ' + k + count + '= ' + question + ';');
    }
    
    const labels = 
    [
        'Q1','Q2','Q3','Q4','Q5','Q6','Q7','Q8','Q9','Q10',
        'Q11','Q12','Q13','Q14','Q15','Q16','Q17','Q18','Q19',
        'Q20','Q21','Q22','Q23','Q24','Q25','Q26','Q27','Q28','Q29',
        'Q30','Q31','Q32','Q33','Q34','Q35','Q36','Q37','Q38','Q39',
        'Q40','Q41','Q42','Q43','Q44','Q45','Q46','Q47','Q48','Q49'
    ];

    const data = {
    labels: labels,
    datasets: [
    {
        label: student,
        backgroundColor: 'rgba(75, 192, 192, 0.2)',
        borderColor: 'rgb(75, 192, 192)',
        data: 
        [
            q0,q1,q2,q3,q4,q5,q6,q7,q8,q9,q10,
            q11,q12,q13,q14,q15,q16,q17,q18,q19,q20,
            q21,q22,q23,q24,q25,q26,q27,q28,q29,
            q30,q31,q32,q33,q34,q35,q36,q37,q38,q39,
            q40,q41,q42,q43,q44,q45,q46,q47,q48
        ],
    }]
    };

    const config = {
    type: 'line',
    data,
    options: {}
    };

    var myChart = new Chart(
        document.getElementById('myChart'),
        config
    );

}
function myFunction3() {
    var student = document.forms["myForm"]["student"].value;

    var k = 'q';
    for (let count = 0; count < 25; count++) {
        var question = document.forms["myForm"]["q"+count].value;
        eval('var ' + k + count + '= ' + question + ';');
    }
    
    const labels = 
    [
        'Q1','Q2','Q3','Q4','Q5','Q6','Q7','Q8','Q9',
        'Q10','Q11','Q12','Q13','Q14','Q15','Q16','Q17','Q18','Q19',
        'Q20','Q21','Q22','Q23','Q24','Q25'
    ];
    const data = {
    labels: labels,
    datasets: [
    {
        label: student,
        backgroundColor: 'rgba(75, 192, 192, 0.2)',
        borderColor: 'rgb(75, 192, 192)',
        data: 
        [
            q0,q1,q2,q3,q4,q5,q6,q7,q8,q9,q10,
            q11,q12,q13,q14,q15,q16,q17,q18,q19,
            q20,q21,q22,q23,q24
        ],
    }]
    };

    const config = {
    type: 'line',
    data,
    options: {}
    };

    var myChart = new Chart(
        document.getElementById('myChart'),
        config
    );

}
function myFunction4() {
    var student = document.forms["myForm"]["student"].value;

    var k = 'q';
    for (let count = 0; count < 20; count++) {
        var question = document.forms["myForm"]["q"+count].value;
        eval('var ' + k + count + '= ' + question + ';');
    }
    
    const labels = 
    [
        'Q1','Q2','Q3','Q4','Q5','Q6','Q7','Q8','Q9','Q10',
        'Q11','Q12','Q13','Q14','Q15','Q16','Q17','Q18','Q19','Q20'
    ];
    const data = {
    labels: labels,
    datasets: [
    {
        label: student,
        backgroundColor: 'rgba(75, 192, 192, 0.2)',
        borderColor: 'rgb(75, 192, 192)',
        data: 
        [
            q0,q1,q2,q3,q4,q5,q6,q7,q8,q9,q10,
            q11,q12,q13,q14,q15,q16,q17,q18,q19
        ],
    }]
    };

    const config = {
    type: 'line',
    data,
    options: {}
    };

    var myChart = new Chart(
        document.getElementById('myChart'),
        config
    );

}
</script>