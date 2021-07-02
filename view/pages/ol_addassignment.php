<?php
include ('model/assignment.php');
$Subject_id = $_GET['Subject'];
$filter = ['_id'=>new \MongoDB\BSON\ObjectId($Subject_id)];
$query = new MongoDB\Driver\Query($filter);
$cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.SchoolsSubject',$query);
foreach ($cursor as $document)
{
    $SubjectName = $document->SubjectName;
}
?>
<style>
.btn-link:hover {
    color: #0a477e;
    text-decoration: underline;
    text-decoration-line: underline;
    text-decoration-thickness: initial;
    text-decoration-style: initial;
    text-decoration-color: initial;
}

input[aria-invalid='false'] {
  border: 1px solid #3fc4bc;
}
input[aria-invalid='true'] {
  border: 1px solid #F64E60;
}

.error {
  display: none;
  color: #F64E60;
  font-weight: bold;
  p {
    margin: 0;
  }
}

.info {
  background: #ccc;
  padding: 20px;
  h2 {
    margin: 0 10px;
  }
  code {
    font-size: 18px;
    font-weight: bold;
  }
}

html {
  scroll-behavior: smooth;
}
</style>
<!--begin::Content-->
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
	<!--begin::Subheader-->
	<div class="subheader py-2 py-lg-6 subheader-solid gradient-custom" id="kt_subheader">
		<div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
			<!--begin::Info-->
			<div class="d-flex align-items-center flex-wrap mr-1">
				<!--begin::Page Heading-->
				<div class="d-flex align-items-baseline flex-wrap mr-5">
					<!--begin::Page Title-->
					<h5 class="text-white font-weight-bold my-1 mr-5">Add Assignment</h5>
					<!--end::Page Title-->
				</div>
                <!--begin::Separator-->
                <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-5 bg-gray-200"></div>
                <!--end::Separator-->
                <!--begin::Detail-->
                <div class="d-flex align-items-center" id="kt_subheader_search">
                <span class="text-white-50 font-weight-bold" id="kt_subheader_total"><?php echo $SubjectName; ?></span>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script>

//hide and display box
$(document).ready(function(){

  $('#textsubmit').hide();
  $('#filesubmit1').hide();
  $('#filesubmit2').hide();
  $('#filesubmit3').hide();

  $('#onlinetext').on('change', function () {
    var count = 0;
                $('#onlinetext').each(function(){
                  if($(this).prop('checked')) {
                    count++;
                    return;
                  }
                  
                })
                if(count > 0) {
                  $('#textsubmit').show();
                }
    else {
       $('#textsubmit').hide();
    }
    });

  $('#files').on('change', function () {
    var count = 0;
                $('#files').each(function(){
                  if($(this).prop('checked')) {
                    count++;
                    return;
                  }
                  
                })
                if(count > 0) {
                  $('#filesubmit1').show();
                  $('#filesubmit2').show();
                  $('#filesubmit3').show();
                }
    else {
       $('#filesubmit1').hide();
       $('#filesubmit2').hide();
       $('#filesubmit3').hide();
    }
    });


   });
</script>
<?php
$Submitfrom = new MongoDB\BSON\UTCDateTime((new DateTime('now'))->getTimestamp()*1000);
$Submitfrom = $Submitfrom->toDateTime()->setTimezone(new \DateTimeZone(date_default_timezone_get()));
$Submitfrom = date_format($Submitfrom,"Y-m-d\TH:i:s");

$Due = new MongoDB\BSON\UTCDateTime((new DateTime('now +1 week'))->getTimestamp()*1000);
$Due = $Due->toDateTime()->setTimezone(new \DateTimeZone(date_default_timezone_get()));
$Due = date_format($Due,"Y-m-d\TH:i:s");

//echo $Due;
?>
<div class="d-flex flex-column-fluid">
    <div class="container">
        <div class="col-lg-12">
            <div class="card card-custom gutter-b example example-compact">
                <form class="form" id="addassignment" name="addassignment" action="#" method="post">
                    <div class="card-body">
                    <p id="demo"></p>
                        <div class="checkbox-inline">
                            <h2>Adding a New Assignment
                            <a type="button" data-bs-html="true" data-bs-toggle="popover" title="" data-bs-content='
                            <p>
                                The assignment activity module enables a teacher to communicate tasks, collect work and provide grades and feedback.
                            </p>
                            <p>
                                Students can submit any digital content (files), such as word-processed documents, spreadsheets, images, or audio and video clips. 
                                Alternatively, or in addition, the assignment may require students to type text directly into the text editor. 
                                An assignment can also be used to remind students of real-world assignments they need to complete offline, 
                                such as art work, and thus not require any digital content. 
                                Students can submit work individually or as a member of a group.
                            </p>
                            <p>
                                When reviewing assignments, teachers can leave feedback comments and upload files, 
                                such as marked-up student submissions, documents with comments or spoken audio feedback. 
                                Assignments can be graded using a numerical or custom scale or an advanced grading method such as a rubric. 
                                Final grades are recorded in the gradebook.
                            </p>'>
                            <i class="icon fa fa-question-circle text-success fa-fw " title="Help with Quiz" aria-label="Help with Quiz"></i></a></h2>
                        </div>
                        <div align="right">
                        <a data-toggle="collapse" href="#collapseOne,#collapseTwo,#collapseThree,#collapseFour,#collapseFive" ...>
                            Expand / Collapse
                            <span class="svg-icon svg-icon-primary svg-icon-2x">
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                        <polygon points="0 0 24 0 24 24 0 24"/>
                                        <path d="M6.70710678,15.7071068 C6.31658249,16.0976311 5.68341751,16.0976311 5.29289322,15.7071068 C4.90236893,15.3165825 4.90236893,14.6834175 5.29289322,14.2928932 L11.2928932,8.29289322 C11.6714722,7.91431428 12.2810586,7.90106866 12.6757246,8.26284586 L18.6757246,13.7628459 C19.0828436,14.1360383 19.1103465,14.7686056 18.7371541,15.1757246 C18.3639617,15.5828436 17.7313944,15.6103465 17.3242754,15.2371541 L12.0300757,10.3841378 L6.70710678,15.7071068 Z" fill="#000000" fill-rule="nonzero" transform="translate(12.000003, 11.999999) rotate(-180.000000) translate(-12.000003, -11.999999) "/>
                                    </g>
                                </svg>
                            </span>
                        </a>
                        </div>
                        <div class="accordion" id="accordionExample">
                            <div class="accordion-item" id="focus">
                                <h2 class="accordion-header" id="headingOne" class="headingOne">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                                    <p style="color:#0f6fc5;">GENERAL</p>
                                </button>
                                </h2>
                                <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                <!-- begin::body -->
                                    <div class="form-group row ">
                                        <div class="col-md-3 col-form-label d-flex pb-0 pr-md-0">
                                            <label class="d-inline word-break" for="title">Assignment name</label>
                                            <div class="ml-1 ml-md-auto d-flex align-items-center align-self-start">
                                                <i class="icon fa fa-exclamation-circle text-danger fa-fw " title="Required" aria-label="Required"></i>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <input type="text" class="form-control" name="title" id="title" aria-required="true" aria-invalid="false" data-rule="title" required>
                                            <div class="error" id="titleErrorMessage" aria-hidden="true" role="alert" tabindex="1">
                                                <p> - You must supply a value here !</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row ">
                                        <div class="col-md-3 col-form-label d-flex pb-0 pr-md-0">
                                            <label class="d-inline word-break " for="id_name">Description</label>
                                        </div>
                                        <div class="col-md-6">
                                            <textarea class="assignment" name="description"></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group row ">
                                        <div class="col-md-3 col-form-label d-flex pb-0 pr-md-0">
                                            <label class="d-inline word-break " for="id_name">Additional files</label>
                                            <div class="ml-1 ml-md-auto d-flex align-items-center align-self-start">
                                                <a type="button" data-bs-html="true" data-bs-toggle="popover" title="" data-bs-content='<p>Additional files for use in the assignment, such as answer templates, may be added. Download links for the files will then be displayed on the assignment page under the description.</p>'>
                                                    <i class="icon fa fa-question-circle text-success fa-fw " title="Help with additional files" aria-label="Help with additional files"></i>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <!-- begin::add drop files -->
                                            <div id="drag-drop-area"></div>
                                            <!-- end::add drop files -->
                                        </div>
                                    </div>
                                <!-- end::body -->
                                </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingTwo">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                    <p style="color:#0f6fc5;">AVAILABILITY</p>
                                </button>
                                </h2>
                                <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                <!-- begin::body -->
                                    <div class="form-group row">
                                        <div class="col-md-3 col-form-label d-flex pb-0 pr-md-0">
                                            <label class="d-inline word-break">Allow submission from</label>
                                            <div class="ml-1 ml-md-auto d-flex align-items-center align-self-start">
                                                <a type="button" data-bs-html="true" data-bs-toggle="popover" title="" data-bs-content='<p>If enabled, students will not be able to submit before this date. If disabled, students will be able to start submitting right away.</p>'>
                                                    <i class="icon fa fa-question-circle text-success fa-fw " title="Help with allow submission" aria-label="Help with allow submission"></i>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class='input-group' id='kt_daterangepicker_4'>
                                                <input type="datetime-local" class="form-control" name="Submitfrom" placeholder="Select date" id="kt_datepicker" value="<?php echo $Submitfrom; ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-md-3 col-form-label d-flex pb-0 pr-md-0">
                                            <label class="d-inline word-break " for="id_name">Due date</label>
                                            <div class="ml-1 ml-md-auto d-flex align-items-center align-self-start">
                                                <a type="button" data-bs-html="true" data-bs-toggle="popover" title="" data-bs-content='<p>This is when the assignment is due. Submissions will still be allowed after this date, but any assignments submitted after this date will be marked as late. Set an assignment cut-off date to prevent submissions after a certain date.</p>'>
                                                    <i class="icon fa fa-question-circle text-success fa-fw " title="Help with due date" aria-label="Help with due date"></i>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class='input-group' id='kt_daterangepicker_4'>
                                                <input type="datetime-local" class="form-control" name="Duedate" placeholder="Select date" id="kt_datepicker" value="<?php echo $Due; ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-md-3 col-form-label d-flex pb-0 pr-md-0">
                                            <label class="d-inline word-break " for="id_name">Cut off date</label>
                                            <div class="ml-1 ml-md-auto d-flex align-items-center align-self-start">
                                                <a type="button" data-bs-html="true" data-bs-toggle="popover" title="" data-bs-content='<p>If set, the assignment will not accept submissions after this date without an extension.</p>'>
                                                    <i class="icon fa fa-question-circle text-success fa-fw " title="Help with cut off date" aria-label="Help with cut off date"></i>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class='input-group' id='kt_daterangepicker_4'>
                                                <input type="datetime-local" class="form-control" name="Cutoffdate" placeholder="Select date" id="kt_datepicker" value="<?php echo $Due; ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-md-3 col-form-label d-flex pb-0 pr-md-0">
                                            <label class="d-inline word-break " for="id_name">Remind me to grade by</label>
                                            <div class="ml-1 ml-md-auto d-flex align-items-center align-self-start">
                                                <a type="button" data-bs-html="true" data-bs-toggle="popover" title="" data-bs-content='<p>The expected date that marking of the submissions should be completed by. This date is used to prioritise dashboard notifications for teachers.</p>'>
                                                    <i class="icon fa fa-question-circle text-success fa-fw " title="Help with remind to grade" aria-label="Help with remind to grade"></i>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class='input-group' id='kt_daterangepicker_4'>
                                                <input type="datetime-local" class="form-control" name="reminder" placeholder="Select date" id="kt_datepicker" value="<?php echo $Due; ?>">
                                            </div>
                                        </div>
                                    </div>
                                <!-- end::body -->
                                </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingThree">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                    <p style="color:#0f6fc5;">SUBMISSION TYPE</p>
                                </button>
                                </h2>
                                <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                <!-- begin::body -->
                                    <div class="form-group row">
                                        <div class="col-md-3 col-form-label d-flex pb-0 pr-md-0">
                                            <label class="d-inline word-break">Submission type</label>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="row">
                                                <div class="col-sm checkbox-inline">
                                                    <label class="checkbox checkbox-success mt-3"><input type="checkbox" id="onlinetext" name="onlinetext"/>
                                                    <span> </span> 
                                                    Online text
                                                    <a type="button" data-bs-html="true" data-bs-toggle="popover" title="" data-bs-content='<p>If enabled, students are able to type rich text directly into an editor field for their submission.</p>'>
                                                        <i class="icon fa fa-question-circle text-success fa-fw " title="Help with online text" aria-label="Help with online text"></i>
                                                    </a>
                                                    </label>
                                                </div>
                                                <div class="col-sm checkbox-inline">
                                                    <label class="checkbox checkbox-success mt-3"><input type="checkbox" id="files" name="files"/>
                                                    <span> </span> 
                                                    File submission
                                                    <a type="button" data-bs-html="true" data-bs-toggle="popover" title="" data-bs-content='<p>If enabled, students are able to upload one or more files as their submission.</p>'>
                                                        <i class="icon fa fa-question-circle text-success fa-fw " title="Help with file submission" aria-label="Help with file submission"></i>
                                                    </a>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row" id="textsubmit">
                                        <div class="col-md-3 col-form-label d-flex pb-0 pr-md-0">
                                            <label class="d-inline word-break">Word limit</label>
                                            <div class="ml-1 ml-md-auto d-flex align-items-center align-self-start">
                                                <a type="button" data-bs-html="true" data-bs-toggle="popover" title="" data-bs-content='<p>If online text submissions are enabled, this is the maximum number of words that each student will be allowed to submit.</p>'>
                                                    <i class="icon fa fa-question-circle text-success fa-fw " title="Help with Shuffle within questions" aria-label="Help with Shuffle within questions"></i>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="number" class="form-control " name="wordlimit">
                                        </div>
                                    </div>
                                    <div class="form-group row" id="filesubmit1">
                                        <div class="col-md-3 col-form-label d-flex pb-0 pr-md-0">
                                            <label class="d-inline word-break">Max number of uploaded file</label>
                                            <div class="ml-1 ml-md-auto d-flex align-items-center align-self-start">
                                                <a type="button" data-bs-html="true" data-bs-toggle="popover" title="" data-bs-content='<p>If file submissions are enabled, each student will be able to upload up to this number of files for their submission.</p>'>
                                                    <i class="icon fa fa-question-circle text-success fa-fw " title="Help with max number of upload" aria-label="Help with max number of upload"></i>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <select class="form-control" name="maxnumberfile">
                                                <option value="1" selected>1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                                <option value="4">4</option>
                                                <option value="5">5</option>
                                                <option value="6">6</option>
                                                <option value="7">7</option>
                                                <option value="8">8</option>
                                                <option value="9">9</option>
                                                <option value="10">10</option>
                                                <option value="11">11</option>
                                                <option value="12">12</option>
                                                <option value="13">13</option>
                                                <option value="14">14</option>
                                                <option value="15">15</option>
                                                <option value="16">16</option>
                                                <option value="17">17</option>
                                                <option value="18">18</option>
                                                <option value="19">19</option>
                                                <option value="20">20</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row" id="filesubmit2">
                                        <div class="col-md-3 col-form-label d-flex pb-0 pr-md-0">
                                            <label class="d-inline word-break">Max submission size</label>
                                            <div class="ml-1 ml-md-auto d-flex align-items-center align-self-start">
                                                <a type="button" data-bs-html="true" data-bs-toggle="popover" title="" data-bs-content='<p>Files uploaded by students may be up to this size.</p>'>
                                                    <i class="icon fa fa-question-circle text-success fa-fw " title="Help with max submission size" aria-label="Help with max submission size"></i>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                        <select class="form-control" name="maxsizebytes">
                                                <option value="0" selected>Activity upload limit (1MB)</option>
                                                <option value="1048576" selected>1MB</option>
                                                <option value="512000">500KB</option>
                                                <option value="102400">100KB</option>
                                                <option value="51200">50KB</option>
                                                <option value="10240">10KB</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row" id="filesubmit3">
                                        <div class="col-md-3 col-form-label d-flex pb-0 pr-md-0">
                                            <label class="d-inline word-break">Accepted file types</label>
                                            <div class="ml-1 ml-md-auto d-flex align-items-center align-self-start">
                                                <a type="button" data-bs-html="true" data-bs-toggle="popover" title="" data-bs-content='<p>Accepted file types can be restricted by entering a list of file extensions. If the field is left empty, then all file types are allowed.</p>'>
                                                    <i class="icon fa fa-question-circle text-success fa-fw " title="Help with accepted files" aria-label="Help with accepted files"></i>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <input type="text" class="form-control" name="filetypes">
                                        </div>
                                        <div class="col-md-1">
                                            <span data-filetypesbrowser="id_assignsubmission_file_filetypes" id="">
                                                <input type="button" class="btn btn-secondary" data-filetypeswidget="browsertrigger" value="Choose" id="">
                                            </span>
                                        </div>
                                        <div class="col-md-1">
                                            <div data-filetypesdescriptions="id_assignsubmission_file_filetypes">
                                                <div class="form-filetypes-descriptions w-100">
                                                    <p>No selection</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <!-- end::body -->
                                </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingFour">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                    <div class="d-flex">
                                            <label class="d-inline word-break" for="id_name" style="color:#0f6fc5;">OVERALL FEEDBACK</label>
                                            <div class="ml-1 d-flex align-items-center align-self-start">
                                                <a type="button" data-bs-html="true" data-bs-toggle="popover" title="" data-bs-content='<p>Overall feedback is text that is shown after a assignment has been attempted. By specifying additional grade boundaries (as a percentage or as a number), the text shown can depend on the grade obtained.</p>'>
                                                    <i class="icon fa fa-question-circle text-success fa-fw" title="Help with Overall feedback" aria-label="Help with Overall feedback"></i>
                                                </a>
                                            </div>
                                        </div>
                                </button>
                                </h2>
                                <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                <!-- begin::body -->
                                    <div class="form-group row ">
                                        <div class="col-md-3 col-form-label d-flex pb-0 pr-md-0">
                                            <label class="d-inline word-break " for="id_name">Grade Boundary</label>
                                        </div>
                                        <div class="col-lg-1">
                                            <input class="form-control " name="grade" value="100%" disabled>
                                        </div>
                                    </div>
                                    <div class="form-group row ">
                                        <div class="col-md-3 col-form-label d-flex pb-0 pr-md-0">
                                            <label class="d-inline word-break " for="id_name">Feedback</label>
                                        </div>
                                        <div class="col-md-6">
                                            <textarea class="assignment" name="feedback100"></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group row ">
                                        <div class="col-md-3 col-form-label d-flex pb-0 pr-md-0">
                                            <label class="d-inline word-break " for="id_name">Grade Boundary</label>
                                        </div>
                                        <div class="col-lg-1">
                                            <input type="number" class="form-control " name="grade">
                                        </div>
                                    </div>
                                    <div class="form-group row ">
                                        <div class="col-md-3 col-form-label d-flex pb-0 pr-md-0">
                                            <label class="d-inline word-break " for="id_name">Feedback</label>
                                        </div>
                                        <div class="col-md-6">
                                            <textarea class="assignment" name="feedback0"></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group row ">
                                        <div class="col-md-3 col-form-label d-flex pb-0 pr-md-0">
                                            <label class="d-inline word-break " for="id_name">Grade Boundary</label>
                                        </div>
                                        <div class="col-lg-1">
                                            <input class="form-control " name="grade" value="0%" disabled>
                                        </div>
                                    </div>
                                <!-- end::body -->
                                </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingFive">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                                    <p style="color:#0f6fc5;">COMMON MODULE SETTING</p>
                                </button>
                                </h2>
                                <div id="collapseFive" class="accordion-collapse collapse" aria-labelledby="headingFive" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                <!-- begin::body -->
                                    <div class="form-group row">
                                        <div class="col-md-3 col-form-label d-flex pb-0 pr-md-0">
                                            <label class="d-inline word-break" >Availability</label>
                                            <div class="ml-1 ml-md-auto d-flex align-items-center align-self-start">
                                                <a type="button" data-bs-html="true" data-bs-toggle="popover" title="" data-bs-content='<p>If the availability is set to Show on course page, the activity or resource is available to students (subject to any access restrictions which may be set).</p>
                                                <p>If the availability is set to Hide from students, the activity or resource is only available to users with permission to view hidden activities (by default, users with the role of teacher or non-editing teacher).</p>'>
                                                    <i class="icon fa fa-question-circle text-success fa-fw " title="Help with Availability" aria-label="Help with Availability"></i>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <select class="form-control" name="availability">
                                                <option value="SHOW" selected>Show on subject page</option>
                                                <option value="HIDE">Hide from student</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row ">
                                        <div class="col-md-3 col-form-label d-flex pb-0 pr-md-0">
                                            <label class="d-inline word-break" >ID Number</label>
                                            <div class="ml-1 ml-md-auto d-flex align-items-center align-self-start">
                                                <a type="button" data-bs-html="true" data-bs-toggle="popover" title="" data-bs-content='<p>Setting an ID number provides a way of identifying the activity or resource for purposes such as grade calculation or custom reporting. Otherwise the field may be left blank.</p>
                                                <p>For gradable activities, the ID number can also be set in the gradebook, though it can only be edited on the activity settings page.</p>'>
                                                    <i class="icon fa fa-question-circle text-success fa-fw " title="Help with ID number" aria-label="Help with ID number"></i>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <input type="text" class="form-control" name="idnumber">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-md-3 col-form-label d-flex pb-0 pr-md-0">
                                            <label class="d-inline word-break " for="groupmode">Group Mode</label>
                                            <div class="ml-1 ml-md-auto d-flex align-items-center align-self-start">
                                                <a type="button" data-bs-html="true" data-bs-toggle="popover" title="" data-bs-content='<p>This setting has 3 options:</p>
                                                    <ul><li>No groups</li>
                                                    <li>Separate groups - Each group member can only see their own group, others are invisible</li>
                                                    <li>Visible groups - Each group member works in their own group, but can also see other groups</li>
                                                    </ul><p>The group mode defined at course level is the default mode for all activities within the course. Each activity that supports groups can also define its own group mode, though if the group mode is forced at course level, the group mode setting for each activity is ignored.</p>'>                                     
                                                    <i class="icon fa fa-question-circle text-success fa-fw " title="Help with Group mode" aria-label="Help with Group mode"></i>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <select class="form-control" name="groupmode" id="groupmode" onchange="Selectgroupmode(this.value);">
                                                <option value="NO" selected>No group</option>
                                                <option value="SEPARATE">Separate Group</option>
                                                <option value="HIDE">Hide Group</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div id="groupbox" style="display:none;">
                                    <div class="form-group row">
                                        <label class="col-md-3 col-form-label d-flex pb-0 pr-md-0">Group</label>
                                        <div class="col-md-6">
                                            <select class="form-control" name="group">
                                                <option value=""></option>
                                            </select>
                                        </div>
                                    </div>
                                    </div>
                                <!-- end::body -->
                                </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="row">
                            <div class="col-lg-6">
                                <input type="hidden" class="col-sm-12 col-form-label text-sm-right" name="Notes_id" value="<?php echo "2"; ?>">
                            </div>
                            <div class="col-lg-6 text-lg-right">
                                <button type="submit" href="#focus" class="btn btn-success mr-2" name="addassignment" onclick="myFunction()">Save and return to the subject</button>
                                <button type="submit" class="btn btn-success mr-2" onclick="myFunction()">Save and display</button>
                                <button type="reset"  class="btn btn-secondary">Reset</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script src="https://releases.transloadit.com/uppy/v1.29.1/uppy.min.js"></script>
<script type="text/javascript" src='https://cdn.tiny.cloud/1/jwc9s2y5k97422slkhbv6eu2eqwbwl2skj9npskngzqtsrhq/tinymce/4/tinymce.min.js' referrerpolicy="origin"></script>
<script>

//custom tinymce
tinymce.init({
  selector: '.assignment',
  menubar:false,
  statusbar: false,
  toolbar: false,
  height:50,
});

//invalid input
(function(win, undefined) {
 $(function() {
    var rules = {
      email: function(node) {
        var inputText = node.value,
		inputRegex = /^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/;
		return inputRegex.test(inputText);
      },
      title: function(node) {
        var inputText = node.value,
		inputRegex = /^\s*[a-zA-Z0-9,\s]+\s*$/;
		return inputRegex.test(inputText);
      }
    };
    
    function onFocusOut() {
      validate(this);
    }
    
    function validate(node) { 
     var valid = isValid(node),
         $error = $(node).next('.error'); 
      
      if (valid) 
      {
        $(node).attr('aria-invalid', false);
        $error
          .attr('aria-hidden', true)
          .hide();
        $(node).attr('aria-describedby', '');
      } 
      else 
      {
        $(node).attr('aria-invalid', true);
        $error
          .attr('aria-hidden', false)
          .show();
        $(node).attr('aria-describedby', $error.attr('id'));
      }
    }
    
    function isValid(node) {
      return rules[node.dataset.rule](node);
    }
    
    $('[aria-invalid]').on('focusout', onFocusOut);
  });
}(window));

//popover
$(function () {
  $('[data-bs-toggle="popover"]').popover()
})

//groupclass
function Selectgroupmode() {
    var group = document.getElementById("groupmode").value;
    var box = document.getElementById("groupbox");
    if(group == "SEPARATE" || group == "HIDE")
    box.style.display = "block";
    else
    box.style.display = "none";
}
Selectgroupmode();

//fileupload
var uppy = Uppy.Core
    ({
    debug: true,
    autoProceed: false,
    restrictions: {
        maxFileSize: 1000000,
        maxNumberOfFiles: 3,
        minNumberOfFiles: 1,
        allowedFileTypes: ['image/*', 'video/*']
    }
    })
    .use(Uppy.Dashboard, {
      inline: true,
      width: 750,
      height: 400,
      theme: 'light',
      note: 'Images and video only, 2–3 files, up to 1 MB',
      metaFields: [
        { id: 'name', name: 'Name', placeholder: 'file name' },
        { id: 'caption', name: 'Caption', placeholder: 'describe what the image is about' }
        ],
      target: '#drag-drop-area'
    })
    .use(Uppy.Tus, {endpoint: 'https://tusd.tusdemo.net/files/'})

  uppy.on('file-added', (file) => {
    console.log('Added file', file)
  })

  uppy.on('complete', (result) => {
    console.log('Upload complete! We’ve uploaded these files:', result.successful)
  })

  uppy.on('upload-success', (file, response) => {
  console.log(file.name, response.uploadURL)
  })

</script>