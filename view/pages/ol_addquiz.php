<?php
include ('model/quiz.php');
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<?php
if (isset($_POST['recheckquiz']))
{
  $schoolID = strval($_SESSION["loggeduser_schoolID"]);
  $Subject_id = $_POST['Subject_id'];
  $totalobj = $_POST['totalobj'];
  $totalsub = $_POST['totalsub'];
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
					<h5 class="text-white font-weight-bold my-1 mr-5">Add Quiz</h5>
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
<div class="d-flex flex-column-fluid">
    <div class="container">
        <div class="col-lg-12">
            <div class="card card-custom gutter-b example example-compact">
                <form class="form" id="addquiz" name="addquiz" action="#" method="post">
                    <div class="card-body">
                    <p id="demo"></p>
                        <div class="checkbox-inline">
                            <h2>Adding a New Quiz
                            <a type="button" data-bs-html="true" data-bs-toggle="popover" title="" data-bs-content='
                            <p>The quiz activity enables a teacher to create quizzes comprising questions of various types, including multiple choice, matching, short-answer and numerical.</p>
                            <p>The teacher can allow the quiz to be attempted multiple times, with the questions shuffled or randomly selected from the question bank. A time limit may be set.</p>

                            <p>Each attempt is marked automatically, with the exception of essay questions, and the grade is recorded in the gradebook.</p>

                            <p>The teacher can choose when and if hints, feedback and correct answers are shown to students.</p>

                            <p>Quizzes may be used</p>

                            <ul><li>As course exams</li>
                            <li>As mini tests for reading assignments or at the end of a topic</li>
                            <li>As exam practice using questions from past exams</li>
                            <li>To deliver immediate feedback about performance</li>
                            <li>For self-assessment</li>
                            </ul>'>
                            <i class="icon fa fa-question-circle text-success fa-fw " title="Help with Quiz" aria-label="Help with Quiz"></i></a></h2>
                        </div>
                        <div align="right">
                        <a data-toggle="collapse" href="#collapseOne,#collapseTwo,#collapseThree,#collapseFour,#collapseFive,#collapseSix,#collapseSeven" ...>
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
                                            <label class="d-inline word-break" for="title" >Name</label>
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
                                            <textarea class="quiz" name="description"></textarea>
                                        </div>
                                    </div>
                                <!-- end::body -->
                                </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingTwo">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                    <p style="color:#0f6fc5;">TIMING</p>
                                </button>
                                </h2>
                                <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                <!-- begin::body -->
                                    <div class="form-group row">
                                        <div class="col-md-3 col-form-label d-flex pb-0 pr-md-0">
                                            <label class="d-inline word-break">Open the quiz</label>
                                            <div class="ml-1 ml-md-auto d-flex align-items-center align-self-start">
                                                <a type="button" data-bs-html="true" data-bs-toggle="popover" title="" data-bs-content='<p>Students can only start their attempt(s) after the open time and they must complete their attempts before the close time.</p>'>
                                                    <i class="icon fa fa-question-circle text-success fa-fw " title="Help with open and close dates" aria-label="Help with open and close dates"></i>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class='input-group' id='kt_daterangepicker_4'>
                                                <input type="datetime-local" class="form-control" name="DateOpen" placeholder="Select date" id="kt_datepicker">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-3 col-form-label d-flex pb-0 pr-md-0">Closed the quiz</label>
                                        <div class="col-md-6">
                                            <div class='input-group' id='kt_daterangepicker_4'>
                                                <input type="datetime-local" class="form-control" name="DateClose" placeholder="Select date" id="kt_datepicker">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-md-3 col-form-label d-flex pb-0 pr-md-0">
                                            <label class="d-inline word-break">Time limit</label>
                                            <div class="ml-1 ml-md-auto d-flex align-items-center align-self-start">
                                                <a type="button" data-bs-html="true" data-bs-toggle="popover" title="" data-bs-content='<p>If enabled, the time limit is stated on the initial quiz page and a countdown timer is displayed in the quiz navigation block.</p>'>
                                                    <i class="icon fa fa-question-circle text-success fa-fw " title="Help with Time limit" aria-label="Help with Time limit"></i>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <input type="number" class="form-control" name="timeunit">
                                        </div>
                                        <div class="col-md-3">
                                            <select class="custom-select" name="timelimit" id="id_timelimit_timeunit">
                                                <option value="604800">weeks</option>
                                                <option value="86400">days</option>
                                                <option value="3600">hours</option>
                                                <option value="60" selected="">minutes</option>
                                                <option value="1">seconds</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-md-3 col-form-label d-flex pb-0 pr-md-0">
                                            <label class="d-inline word-break " for="id_name">When time expired</label>
                                            <div class="ml-1 ml-md-auto d-flex align-items-center align-self-start">
                                                <a type="button" data-bs-html="true" data-bs-toggle="popover" title="" data-bs-content='<p>This setting controls what happens if a student fails to submit their quiz attempt before the time expires. If the student is actively working on the quiz at the time, then the countdown timer will always automatically submit the attempt for them, but if they have logged out, then this setting controls what happens.</p>'>
                                                    <i class="icon fa fa-question-circle text-success fa-fw " title="Help with When time expires" aria-label="Help with When time expires"></i>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <select class="form-control" id="kt_bootstrap_select" name="timeexpired">
                                                <option value="autosubmit">Open attempts are submitted automatically</option>
                                                <option value="graceperiod">There is a grace period when open attempts can be submitted, but no more questions answered</option>
                                                <option value="autoabandon" selected>Attempts must be submitted before time expires, or they are not counted</option>
                                            </select>
                                        </div>
                                    </div>
                                <!-- end::body -->
                                </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingThree">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                    <p style="color:#0f6fc5;">ATTEMPT</p>
                                </button>
                                </h2>
                                <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                <!-- begin::body -->
                                    <div class="form-group row">
                                        <label class="col-md-3 col-form-label d-flex pb-0 pr-md-0">Attempt allowed</label>
                                        <div class="col-md-6">
                                            <select class="form-control" name="attempt">
                                                <option value="unlimited" selected>unlimited</option>
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                                <option value="4">4</option>
                                                <option value="5">5</option>
                                            </select>
                                        </div>
                                    </div>
                                <!-- end::body -->
                                </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingFour">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                    <p style="color:#0f6fc5;">QUESTION BEHAVIOR</p>
                                </button>
                                </h2>
                                <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                <!-- begin::body -->
                                    <div class="form-group row">
                                        <div class="col-md-3 col-form-label d-flex pb-0 pr-md-0">
                                            <label class="d-inline word-break">Shuffle within question</label>
                                            <div class="ml-1 ml-md-auto d-flex align-items-center align-self-start">
                                                <a type="button" data-bs-html="true" data-bs-toggle="popover" title="" data-bs-content='<p>If enabled, the parts making up each question will be randomly shuffled each time a student attempts the quiz, provided the option is also enabled in the question settings. This setting only applies to questions that have multiple parts, such as multiple choice or matching questions.</p>'>
                                                    <i class="icon fa fa-question-circle text-success fa-fw " title="Help with Shuffle within questions" aria-label="Help with Shuffle within questions"></i>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <select class="form-control" name="shuffle">
                                                <option value="YES">Yes</option>
                                                <option value="NO" selected>No</option>
                                            </select>
                                        </div>
                                    </div>
                                <!-- end::body -->
                                </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingFive">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                                    <div class="d-flex">
                                            <label class="d-inline word-break" for="id_name" style="color:#0f6fc5;">OVERALL FEEDBACK</label>
                                            <div class="ml-1 d-flex align-items-center align-self-start">
                                                <a type="button" data-bs-html="true" data-bs-toggle="popover" title="" data-bs-content='<p>Overall feedback is text that is shown after a quiz has been attempted. By specifying additional grade boundaries (as a percentage or as a number), the text shown can depend on the grade obtained.</p>'>
                                                    <i class="icon fa fa-question-circle text-success fa-fw" title="Help with Overall feedback" aria-label="Help with Overall feedback"></i>
                                                </a>
                                            </div>
                                        </div>
                                </button>
                                </h2>
                                <div id="collapseFive" class="accordion-collapse collapse" aria-labelledby="headingFive" data-bs-parent="#accordionExample">
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
                                            <textarea class="quiz" name="feedback100"></textarea>
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
                                            <textarea class="quiz" name="feedback0"></textarea>
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
                                <h2 class="accordion-header" id="headingSix">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSix" aria-expanded="false" aria-controls="collapseSix">
                                    <p style="color:#0f6fc5;">COMMON MODULE SETTING</p>
                                </button>
                                </h2>
                                <div id="collapseSix" class="accordion-collapse collapse" aria-labelledby="headingSix" data-bs-parent="#accordionExample">
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
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingSeven">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSeven" aria-expanded="false" aria-controls="collapseSix">
                                    <p style="color:#0f6fc5;">QUESTIONS</p>
                                </button>
                                </h2>
                                <div id="collapseSeven" class="accordion-collapse collapse" aria-labelledby="headingSeven" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                <!-- begin::body -->
                                <?php 
                                $total = $totalsub + $totalobj;

                                if ($totalobj != 0)
                                {
                                    for ($i=1; $i<=$totalobj; $i++)
                                    {
                                    ?>
                                    <div class="OBJECTIVE box">
                                        <h5 align="center">QUESTIONS <?php echo $i; ?> : OBJECTIVE </h5>
                                        <div class="form-group row">
                                            <div class="col-md-3 col-form-label d-flex pb-0 pr-md-0">
                                                <label for="questiontype" class="d-inline word-break">Question</label>
                                            </div>
                                            <div class="col-md-6">
                                                <textarea class="quiz" name="Question<?php echo $i; ?>"></textarea>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label  class="col-md-3 col-form-label d-flex pb-0 pr-md-0">Option A</label>
                                            <div class="col-md-6">
                                                <input class="form-control" type="text" id="Option_A" name="Option_A<?php echo $i; ?>">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label  class="col-md-3 col-form-label d-flex pb-0 pr-md-0">Option B</label>
                                            <div class="col-md-6">
                                                <input class="form-control" type="text" id="Option_B" name="Option_B<?php echo $i; ?>">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label  class="col-md-3 col-form-label d-flex pb-0 pr-md-0">Option C</label>
                                            <div class="col-md-6">
                                                <input class="form-control" type="text" id="Option_C" name="Option_C<?php echo $i; ?>">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label  class="col-md-3 col-form-label d-flex pb-0 pr-md-0">Option D</label>
                                            <div class="col-md-6">
                                                <input class="form-control" type="text" id="Option_D" name="Option_D<?php echo $i; ?>">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="questiontype" class="col-md-3 col-form-label d-flex pb-0 pr-md-0">Answer</label>
                                            <div class="col-md-6">
                                                <select class="form-control" id="Answer" name="Answer<?php echo $i; ?>" >
                                                    <option value="Option_A" >A</option>
                                                    <option value="Option_B" >B</option>
                                                    <option value="Option_C" >C</option>
                                                    <option value="Option_D" >D</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3 col-form-label d-flex pb-0 pr-md-0" for="Mark">Total mark</label>
                                            <div class="col-md-6">
                                                <input type="number" class="form-control" id="Mark" name="Mark<?php echo $i; ?>" min="0" max="100">
                                            </div>
                                        </div>
                                        <input class="form-control" type="hidden" name="Type<?php echo $i; ?>" value="OBJECTIVE">
                                    </div>
                                    <div class="separator separator-dashed my-10"></div>
                                    <?php
                                    }
                                }
                                
                                if ($totalsub != 0)
                                {
                                    for ($i=$totalobj+1; $i<=$total; $i++)
                                    {
                                    ?>
                                    <div class="SUBJECTIVE box">
                                        <h5 align="center">QUESTIONS <?php echo $i; ?>: SUBJECTIVE </h5>
                                        <div class="form-group row">
                                            <div class="col-md-3 col-form-label d-flex pb-0 pr-md-0">
                                                <label for="questiontype" class="d-inline word-break">Question</label>
                                            </div>
                                            <div class="col-md-6">
                                                <textarea class="quiz" name="Question<?php echo $i; ?>"></textarea>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="questiontype" class="col-md-3 col-form-label d-flex pb-0 pr-md-0">Answer</label>
                                            <div class="col-md-6">
                                                <textarea class="quiz" name="Answer<?php echo $i; ?>"></textarea>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3 col-form-label d-flex pb-0 pr-md-0" for="Mark">Total mark</label>
                                            <div class="col-md-6">
                                                <input type="number" class="form-control" id="Mark" name="Mark<?php echo $i; ?>" min="0" max="100">
                                            </div>
                                        </div>
                                        <input class="form-control" type="hidden" name="Type<?php echo $i; ?>" value="SUBJECTIVE">
                                        <input class="form-control" type="hidden" name="Option_A<?php echo $i; ?>" value="">
                                        <input class="form-control" type="hidden" name="Option_B<?php echo $i; ?>" value="">
                                        <input class="form-control" type="hidden" name="Option_C<?php echo $i; ?>" value="">
                                        <input class="form-control" type="hidden" name="Option_D<?php echo $i; ?>" value="">
                                    </div>
                                    <div class="separator separator-dashed my-10"></div>
                                    <?php
                                    }
                                }
                                ?>
                                <!-- end::body -->
                                </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="row">
                            <div class="col-lg-6">
                                <input type="hidden" class="col-sm-12 col-form-label text-sm-right" name="Subject_id" value="<?php echo "3"; ?>">
                                <input type="hidden" class="col-sm-12 col-form-label text-sm-right" name="Notes_id" value="<?php echo "2"; ?>">
                                <input class="form-control" type="hidden" name="totalquiz" value="<?php echo $total; ?>">
                            </div>
                            <div class="col-lg-6 text-lg-right">
                                <button type="submit" href="#focus" class="btn btn-success mr-2" name="addquiz" onclick="myFunction()">Save and return to the subject</button>
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
<?php
}
?>
<script type="text/javascript" src='https://cdn.tiny.cloud/1/jwc9s2y5k97422slkhbv6eu2eqwbwl2skj9npskngzqtsrhq/tinymce/4/tinymce.min.js' referrerpolicy="origin"></script>
<script>
tinymce.init({
  selector: '.quiz',
  menubar:false,
  statusbar: false,
  toolbar: false,
  height:50,
});

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

$(function () {
  $('[data-bs-toggle="popover"]').popover()
})

function Selectgroupmode() {
    var group = document.getElementById("groupmode").value;
    var box = document.getElementById("groupbox");
    if(group == "SEPARATE" || group == "HIDE")
    box.style.display = "block";
    else
    box.style.display = "none";
}
Selectgroupmode();
</script>