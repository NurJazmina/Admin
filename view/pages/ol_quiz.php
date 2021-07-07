<?php
include ('model/quiz.php');

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
<div id="AddExerciseModal" tabindex="-1" aria-labelledby="AddExerciseModalLabel" aria-hidden="true">
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
                    ?>
                    <div class="row">
                        <div class="col-md-2"> 
                            <button class="btn btn-light"><i class="fab la-hotjar icon-7x"></i></button>
                        </div>
                        <div class="col-md-7">
                            <span class="new-tag hidden" aria-label="New"><h4><?php echo $Title; ?></h4></span>
                            <div class="mt-6">
                                <span><i class="fas fa-graduation-cap icon-s mx-2"></i>Category <?php echo $Class_category; ?></span>
                                <span class="dot mx-2"></span>
                                <span><i class="flaticon2-open-text-book icon-s mx-2"></i></i><?php echo $SubjectName; ?></span>
                            </div>
                        </div>
                        <div class="col-md-3 text-right">
                            <a href="#" class="btn btn-light rounded-circle">
                                <i class="fas fa-exclamation-triangle icon-md"></i>
                            </a>
                            <a href="#" class="btn btn-light rounded-circle">
                                <i class="flaticon-doc icon-md"></i>
                            </a>
                            <a href="#" class="btn btn-light rounded-circle">
                                <i class="flaticon2-fax icon-md"></i>
                            </a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-9 mt-3">
                            <a href="index.php?page=staffdetail&id=<?php echo $Created_by; ?>" class="d-flex align-items-center">
                                <?php
                                $filter = ['_id'=>new \MongoDB\BSON\ObjectId($Created_by)];
                                $query = new MongoDB\Driver\Query($filter);
                                $cursor = $GoNGetzDatabase->executeQuery('GoNGetz.Consumer',$query);
                                foreach ($cursor as $document2)
                                {
                                    $ConsumerFName = $document2->ConsumerFName;
                                    $name = $ConsumerFName;
                                    $firstCharacter = $name[0];
                                }
                                ?>
                                <span class="symbol symbol-lg-35 symbol-25 symbol-light">
                                    <span class="symbol-label symbol-secondary font-size-h5 font-weight-bold" ><?php echo $firstCharacter; ?></span>
                                </span>
                                <div class="col">
                                    <div class="row"><span class="text-muted font-weight-bold mr-1"><?php echo " ".time_elapsed($nowtime-$time)." ago\n";  ?></span></div>
                                    <div class="row"><span class="text-dark-75 font-weight-bold">by <?php echo $ConsumerFName; ?></span></div>
                                </div>
                            </a>
                        </div>
                        <div class="col-md-3 text-right">
                            <button class="btn btn-sm btn-light"><i class="fas fa-folder-open"></i>save</button>
                            <button class="btn btn-sm btn-light"><i class="fas fa-heartbeat"></i> 1</button>
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
        if ($Type == "OBJECTIVE")
        {
        ?>
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="objective">Objective</h5> 
                </div>
                <div class="modal-body">
                    <div class="form-group row">
                        <label class="col-lg-12 col-form-label text-lg-left"><h5>Question <?php echo $i." : ".$Question; ?></h5></label>
                    </div>
                </div>
                <div class="modal-footer">
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
                <div class="modal-header">
                    <h5 class="modal-title" id="subjective">Subjective</h5> 
                </div>
                <div class="modal-body">
                    <div class="form-group row">
                        <label class="col-lg-12 col-form-label text-lg-left"><h5>Question <?php echo $i." : ".$Question; ?></h5></label>
                    </div>
                </div>
                <div class="modal-footer">
                    <textarea class="quiz" name="q<?php echo $i; ?>" ></textarea>
                </div>
            </div>
        </div>
        <?php
        }
    }
    ?>
</div>
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