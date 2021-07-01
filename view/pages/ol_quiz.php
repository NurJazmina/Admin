<?php
//$Subject_id = ($_GET['subject']);
//$Quiz_id = ($_GET['id']);
$Subject_id = "60d5a6ec4eec695a083d5bd2";
include ('model/quiz.php');
$filter = ['_id'=>new \MongoDB\BSON\ObjectId($Subject_id)];
$query = new MongoDB\Driver\Query($filter);
$cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.SchoolsSubject',$query);
foreach ($cursor as $document)
{
    $SubjectName = $document->SubjectName;
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
                    <h5 class="text-dark font-weight-bold my-1 mr-5">Quiz</h5>
                    <!--end::Page Title-->
                </div>
                <!--begin::Separator-->
                <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-5 bg-gray-200"></div>
                <!--end::Separator-->
                <!--begin::Detail-->
                <div class="d-flex align-items-center" id="kt_subheader_search">
                <span class="text-dark-50 font-weight-bold" id="kt_subheader_total"><?php echo $SubjectName; ?></span>
                </div>
                <!--end::Detail-->
                <!--end::Page Heading-->
            </div>
            <!--end::Info-->
    </div>
</div>
<!--end::Subheader-->
        <div id="AddExerciseModal" tabindex="-1" aria-labelledby="AddExerciseModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="form-group row">
                        <?php
                        $filter = ['_id'=>new \MongoDB\BSON\ObjectId("60d5a6ec4eec695a083d5bd2")];
                        $query = new MongoDB\Driver\Query($filter);
                        $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.OL_Quiz',$query);
                        foreach ($cursor as $document)
                        {
                            $Quiz_id = $document->_id;
                            $Title = $document->Title;
                            $Description = $document->Description;
                            $Created_by = $document->Created_by;
                            $Created_date = $document->Created_date;
                            $Timelimit = $document->Timelimit;
                            $Timeunit = $document->Timeunit;
                            $Total_Question = $document->Total_Question;
                            ?>
                            <h4><?php echo $Title; ?></h4>
                            <label class="col-lg-2 col-form-label text-lg-left"><h5>Selection:</h5></label>
                            <div class="col-lg-6">
                            </div>
                            <?php
                        }
                        ?>
                        </div>
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