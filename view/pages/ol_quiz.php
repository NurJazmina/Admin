<?php
include ('model/quiz.php');
include ('model/share.php');
include ('model/report.php');

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
<style>
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
    content: "answer choices";
    position: absolute;
    left: 6%;
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
                <span class="text-white-50 font-weight-bold" id="kt_subheader_total"></span>
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
<div id="AddExerciseModal" aria-labelledby="AddExerciseModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                <?php
                $filter = ['_id'=>new \MongoDB\BSON\ObjectId($_GET['id'])];
                $query = new MongoDB\Driver\Query($filter);
                $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.OL_Quiz',$query);
                foreach ($cursor as $document)
                {
                    $Quiz_id = $document->_id;
                    $Subject_id = $document->Subject_id;
                    $Title = $document->Title;
                    $Description = $document->Description;
                    $Created_by = $document->Created_by;
                    $Created_date = $document->Created_date;
                    $Timelimit = $document->Timelimit;
                    $Timeunit = $document->Timeunit;
                    $Timeexpired = $document->Timeexpired;
                    $Attempt = $document->Attempt;

                    $Total_Question = $document->Total_Question;

                    $Created_date = new MongoDB\BSON\UTCDateTime(strval($Created_date));
                    $Created_date = $Created_date->toDateTime()->setTimezone(new \DateTimeZone(date_default_timezone_get()));
                    $Created_date = date_format($Created_date,"Y-m-d\TH:i:s");
                    $Created_date = new MongoDB\BSON\UTCDateTime((new DateTime($Created_date))->getTimestamp());
                
                    $nowtime = time();
                    $time = strval($Created_date);

                    $filter = ['_id'=>new \MongoDB\BSON\ObjectId($Subject_id)];
                    $query = new MongoDB\Driver\Query($filter);
                    $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.SchoolsSubject',$query);
                    foreach ($cursor as $document1)
                    {
                        $SubjectName = $document1->SubjectName;
                        $Class_category = $document1->Class_category;
                    }

                    $filter = ['_id'=>new \MongoDB\BSON\ObjectId($Created_by)];
                    $query = new MongoDB\Driver\Query($filter);
                    $cursor = $GoNGetzDatabase->executeQuery('GoNGetz.Consumer',$query);
                    foreach ($cursor as $document2)
                    {
                        $CreatedEmail = "";
                        $CreatedEmail = ($document2->ConsumerEmail);
                    }
                    ?>
                    <div class="row">
                        <div class="col-md-8 checkbox-inline"> 
                            <div>
                                <button class="btn btn-sm btn-light"><img src="image/logogongetz.png" style="opacity:0.7; width:90px; height:90px; display:block; position:relative;"></button>
                            </div>
                            <div class="mx-5">
                                <p class="text-muted font-weight-bold mb-5">QUIZ</p>
                                <h4 class="mb-4"><?php echo $Title; ?></h4>
                                <div>
                                    <small class="text-muted"><i class="fas fa-user-graduate icon-s mx-2"></i>Category <?php echo $Class_category; ?></small>
                                    <small class="dot text-muted mx-2"></small>
                                    <small class="text-muted"><?php echo $SubjectName; ?></small>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 text-right">
                            <button type="button" class="btn btn-sm btn-light" data-bs-toggle="modal" data-bs-target="#report" data-bs-whatever="<?php echo $Created_by; ?>">
                                <a data-bs-toggle="tooltip" data-bs-placement="bottom" title="Report an issue"><i class="fas fa-exclamation-triangle icon-md"></i></a>    
                            </button>
                            <!-- <button type="button" class="btn btn-sm btn-light" data-bs-toggle="modal" data-bs-target="#report" data-bs-whatever="<?php echo $Created_by; ?>">
                                <a data-bs-toggle="tooltip" data-bs-placement="bottom" title="Copy and edit"><i class="flaticon-doc icon-md"></i></a>
                            </button> -->
                            <button type="button" class="btn btn-sm btn-light" onclick="window.print()">
                                <a data-bs-toggle="tooltip" data-bs-placement="bottom" title="Print"><i class="flaticon2-fax icon-md"></i></a>
                            </button>
                        </div>
                    </div>
                    <div class="row mt-5">
                        <div class="col-md-6 checkbox-inline">
                            <a href="index.php?page=staffdetail&id=<?php echo $Created_by; ?>" class="d-flex align-items-center">
                                <?php
                                $filter = ['_id'=>new \MongoDB\BSON\ObjectId($Created_by)];
                                $query = new MongoDB\Driver\Query($filter);
                                $cursor = $GoNGetzDatabase->executeQuery('GoNGetz.Consumer',$query);
                                foreach ($cursor as $document3)
                                {
                                    $ConsumerFName = $document3->ConsumerFName;
                                    $name = $ConsumerFName;
                                    $firstCharacter = $name[0];
                                }
                                ?>
                                <button class="btn btn-light rounded-circle"><?php echo $firstCharacter; ?></button>
                                <div class="col">
                                    <div class="row"><small class="text-muted font-weight-bold mr-1"><?php echo " ".time_elapsed($nowtime-$time)." ago\n";  ?></small></div>
                                    <div class="row"><small class="text-dark-75 font-weight-bold">by <?php echo $ConsumerFName; ?></small></div>
                                </div>
                            </a>
                        </div>
                        <div class="col-md-6 text-right">
                            <button class="btn btn-sm btn-light"><i class="fas fa-folder-open"></i>save</button>
                            <button class="btn btn-sm btn-light"><i class="fas fa-heartbeat"></i> 1</button>
                            <button class="btn btn-sm btn-light" data-bs-toggle="modal" data-bs-target="#share"><i class="flaticon2-reply"></i>share</button>
                        </div>
                    </div>
                    <?php
                }
                ?>
            </div>
        </div>
    </div>
    <?php
    for ($i = 0; $i < $Total_Question; $i++)
    {
        $Type = $document->Quiz[$i]->Type;
        $Question = $document->Quiz[$i]->Question;
        $Option_A = $document->Quiz[$i]->Option_A;
        $Option_B = $document->Quiz[$i]->Option_B;
        $Option_C = $document->Quiz[$i]->Option_C;
        $Option_D = $document->Quiz[$i]->Option_D;
        $Answer = $document->Quiz[$i]->Answer;
        $Mark = $document->Quiz[$i]->Mark;

        $Qi = $i + 1;
        if ($Type == "OBJECTIVE")
        {
        ?>
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <button class="btn btn-sm btn-outline-secondary rounded-pill" id="objective">Question <?php echo " ".$Qi ?> : Objective</button> 
                    <div class="row mx-0 mt-1">
                        <label class="col-lg-12 col-form-label text-lg-left"><h5><?php echo $Question; ?></h5></label>
                    </div>
                    <div class="separator separator-solid"></div>
                    <div class="row">
                        <div class="radio-inline">
                            <div class="col mb-2">
                                <label class="radio radio-outline radio-success">
                                    <input type="radio" name="radio<?= $i ?>"/>
                                    <span></span>
                                    <?php echo $Option_A; ?>
                                </label>
                            </div>
                            <div class="col">
                                <label class="radio radio-outline radio-success">
                                    <input type="radio" name="radio<?= $i ?>"/>
                                    <span></span>
                                    <?php echo $Option_B; ?>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="radio-inline">
                            <div class="col">
                                <label class="radio radio-outline radio-success">
                                    <input type="radio" name="radio<?= $i ?>"/>
                                    <span></span>
                                    <?php echo $Option_C; ?>
                                </label>
                            </div>
                            <div class="col">
                                <label class="radio radio-outline radio-success">
                                    <input type="radio" name="radio<?= $i ?>"/>
                                    <span></span>
                                    <?php echo $Option_D; ?>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
        }
        elseif($Type == "SUBJECTIVE")
        {
        ?>
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <button class="btn btn-sm btn-outline-secondary rounded-pill" id="objective">Question <?php echo " ".$Qi ?> : Subjective</button>
                    <div class="row mx-0 mt-1">
                        <label class="col-lg-12 col-form-label text-lg-left"><h5><?php echo $Question; ?></h5></label>
                    </div>
                    <div class="separator separator-solid"></div>
                    <textarea class="quiz" name="q<?php echo $i; ?>" ></textarea>
                </div>
            </div>
        </div>
        <?php
        }
    }
    ?>
     <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body text-right">
                <button type="reset" class="btn btn-secondary btn-sm">reset</button>
                <button type="submit" class="btn btn-success btn-sm" name="reportquiz">Submit</button>
            </div>
        </div>
    </div>
</div>
<?php 
include ('view/pages/ol_modal-report.php'); 
include ('view/pages/ol_modal-share.php'); 
?>
<script type="text/javascript" src='https://cdn.tiny.cloud/1/jwc9s2y5k97422slkhbv6eu2eqwbwl2skj9npskngzqtsrhq/tinymce/4/tinymce.min.js' referrerpolicy="origin"></script>
<script>
tinymce.init({
  selector: '.quiz',
  menubar:false,
  statusbar: false,
  toolbar: false,
  height:100,
});
</script>