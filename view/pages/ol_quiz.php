<?php
include ('model/quiz.php');
include ('model/share.php');
include ('model/report.php');
include ('model/save.php');

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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
<script>
$(document).ready(function() {

    var toggleText = $("#ip").val();
    var name = $("#loguser-id").val();
    var url_likes = $("#url-likes").val();
    var check = $("#check").val();

    if ($("#ip").val() == '0') 
    {
       toggleText = $("#ip").val();
       $("#test").html(check);
       $("#ip").val('1');
    }

    $("#ipclear").click(function() {

            if  ($("#ip").val() == '1') 
            {
                toggleText = $("#ip").val();

                $.post("model/likes.php", {
                like: '1',
                Consumer_id: name,
                url_likes: url_likes
                },
                function(data, status){
                    $("#test").html(data);
                },
                );
                $("#ip").val('2');
                $("#ip").prop("disabled", false);
                $(this).removeClass('btn-light').addClass('btn-success');
            }
            else if ($("#ip").val() == '2') 
            {
                $("#ip").val(toggleText);

                $.post("model/likes.php", {
                like: '0',
                Consumer_id: name,
                url_likes: url_likes
                }, 
                function(data, status){
                    $("#test").html(data);
                });
                $("#ip").val('1');
                $("#ip").prop("disabled", false);
                $(this).removeClass('btn-success').addClass('btn-light');
            }
        });

});
</script>
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
                $URL = "$_SERVER[REQUEST_URI]";
                $filter = ['_id'=>new \MongoDB\BSON\ObjectId($_GET['id'])];
                $query = new MongoDB\Driver\Query($filter);
                $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.OL_Quiz',$query);
                foreach ($cursor as $document)
                {
                    $_id = $document->_id;
                    $Subject_id = $document->Subject_id;
                    $Title = $document->Title;
                    $Description = $document->Description;
                    $Created_by = $document->Created_by;
                    $Created_date = $document->Created_date;
                    $Timelimit = $document->Timelimit;
                    $Timeunit = $document->Timeunit;
                    $Timeexpired = $document->Timeexpired;
                    $Attempt = $document->Attempt;
                    $Shuffle = $document->Shuffle;

                    $Quiz = $document->Quiz;
                    $Total_Question = count((array)$Quiz);

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
                            <button class="btn btn-sm btn-light" data-bs-toggle="modal" data-bs-target="#save"><i class="fas fa-folder-open"></i>save</button>

                            <!-- begin::like/unlike -->
                            <?php
                            $URL_LIKES = "$_SERVER[REQUEST_URI]";
                            $havedata = 0;
                            $total_likes = 0;
                            $filter = ['url'=> $URL_LIKES];
                            $query = new MongoDB\Driver\Query($filter);
                            $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Likes',$query);
                            foreach ($cursor as $document4)
                            {
                                $Consumer = $document4->Consumer;
                                $total_likes = count((array)$Consumer);
                            }

                            $filter = ['url'=> $URL_LIKES, 'Consumer.Consumer_id'=> $_SESSION["loggeduser_id"]];
                            $query = new MongoDB\Driver\Query($filter);
                            $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Likes',$query);
                            foreach ($cursor as $document5)
                            {
                                $havedata = 1;
                                $Consumer = $document5->Consumer;
                                $total_likes = count((array)$Consumer);
                            }
                            ?>
                            <input type="hidden" id="ip" value="0">
                            <input type="hidden" id="loguser-id" value="<?php echo $_SESSION["loggeduser_id"]; ?>">
                            <input type="hidden" id="url-likes" value="<?php echo $URL_LIKES; ?>">
                            <input type="hidden" id="check" value="<?php echo $total_likes;?>">
                            <?php 
                            if ($havedata==0) 
                            {
                                ?>
                                <button type="button" class="btn btn-sm btn-light" id="ipclear">
                                    <i class="fas fa-heartbeat"></i>
                                    <a id="test"></a>
                                </button>
                                <?php
                            } 
                            else 
                            {
                                ?>
                                <button type="button" class="btn btn-sm btn-success" id="ipclear">
                                    <i class="fas fa-heartbeat"></i>
                                    <a id="test"></a>
                                </button>
                                <?php
                            }
                            ?>
                            <!-- end::like/unlike -->

                            <button class="btn btn-sm btn-light" data-bs-toggle="modal" data-bs-target="#share"><i class="flaticon2-reply"></i>share</button>
                        </div>
                    </div>
                    <?php
                }
                ?>
            </div>
        </div>
    </div>
    <form name="answer" action="#" method="post">
        <?php
        if ($Shuffle == "Yes")
        {
            shuffle($Quiz);
        }
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

            if ($Type == "OBJECTIVE")
            {
            ?>
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-body">
                        <button class="btn btn-sm btn-outline-secondary rounded-pill" id="objective">Question <?php echo " ".$i ?> : Objective</button> 
                        <div class="row mx-0 mt-1">
                            <label class="col-lg-12 col-form-label" align="justify"><h5><?php echo $Question; ?></h5></label>
                        </div>
                        <div class="separator separator-solid"></div>
                        <div class="row">
                            <div class="radio-inline">
                                <div class="col mb-2">
                                    <label class="radio radio-outline radio-success">
                                        <input type="radio" name="ans<?= $id ?>" value="A">
                                        <span></span>
                                        <?php echo $Option_A; ?>
                                    </label>
                                </div>
                                <div class="col">
                                    <label class="radio radio-outline radio-success">
                                        <input type="radio" name="ans<?= $id ?>" value="B">
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
                                        <input type="radio" name="ans<?= $id ?>" value="C">
                                        <span></span>
                                        <?php echo $Option_C; ?>
                                    </label>
                                </div>
                                <div class="col">
                                    <label class="radio radio-outline radio-success">
                                        <input type="radio" name="ans<?= $id ?>" value="D">
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
                        <button class="btn btn-sm btn-outline-secondary rounded-pill" id="objective">Question <?php echo " ".$i ?> : Subjective</button>
                        <div class="row mx-0 mt-1">
                            <label class="col-lg-12 col-form-label" align="justify"><h5><?php echo $Question; ?></h5></label>
                        </div>
                        <div class="separator separator-solid"></div>
                        <textarea class="quiz" name="ans<?= $id ?>" ></textarea>
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
                    <input type="hidden" name="id" value="<?= $_id; ?>">
                    <input type="hidden" name="Total_Question" value="<?= $Total_Question; ?>">
                    <button type="reset" class="btn btn-secondary btn-sm">reset</button>
                    <button type="submit" class="btn btn-success btn-sm" name="answer">Submit</button>
                </div>
            </div>
        </div>
    </form>
</div>
<?php 
include ('view/pages/ol_modal-report.php'); 
include ('view/pages/ol_modal-share.php'); 
include ('view/pages/ol_modal-save.php'); 
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