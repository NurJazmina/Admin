<?php include ('model/addquiz.php'); ?>
<style>
.btn-link:hover {
    color: #0a477e;
    text-decoration: underline;
    text-decoration-line: underline;
    text-decoration-thickness: initial;
    text-decoration-style: initial;
    text-decoration-color: initial;
}
</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script> 
<script language="javascript">
localStorage.i = Number(1);

function myevent(action)
{
    var i = Number(localStorage.i);
    var div = document.createElement('div');

    if(action.id == "add")
    {
        localStorage.i = Number(localStorage.i) + Number(1);
        var id = i;
        div.id = id;
    
        div.innerHTML = 
        '<div class="card">'+
            '<div class="card-body">'+
            '<h5 align="left">QUESTION '+id+'</h5>'+
                '<div class="form-group row">'+
                    '<label for="questiontype" class="col-sm-2 col-form-label text-sm-right">TYPE</label>'+
                    '<div class="col-sm-10">'+
                        '<select class="form-control" id="type'+id+'" name="Type'+id+'" required>'+
                            '<option>CHOOSE YOUR TYPE</option>'+
                            '<option value="OBJECTIVE">OBJECTIVE</option>'+
                            '<option value="SUBJECTIVE">SUBJECTIVE</option>'+
                        '</select>'+
                    '</div>'+
                '</div>'+
                '<div class="OBJECTIVE box">'+
                    '<div class="form-group row">'+
                        '<label class="col-sm-2 col-form-label text-sm-right">QUESTIONS</label>'+
                        '<div class="col-sm-10">'+
                            '<textarea class="quiz" name="Question'+id+'"></textarea>'+
                        '</div>'+
                    '</div>'+
                    '<div class="form-group row">'+
                        '<label  class="col-sm-2 col-form-label text-sm-right">OPTION A</label>'+
                        '<div class="col-sm-10">'+
                            '<input class="form-control" type="text" id="Option_A" name="Option_A'+id+'">'+
                        '</div>'+
                        ' <label  class="col-sm-2 col-form-label text-sm-right">OPTION B</label>'+
                        '<div class="col-sm-10">'+
                            '<input class="form-control" type="text" id="Option_B" name="Option_B'+id+'">'+
                        '</div>'+
                        '<label  class="col-sm-2 col-form-label text-sm-right">OPTION C</label>'+
                        '<div class="col-sm-10">'+
                            '<input class="form-control" type="text" id="Option_C" name="Option_C'+id+'">'+
                        '</div>'+
                        '<label  class="col-sm-2 col-form-label text-sm-right">OPTION D</label>'+
                        '<div class="col-sm-10">'+
                            '<input class="form-control" type="text" id="Option_D" name="Option_D'+id+'">'+
                        '</div>'+
                    '</div>'+
                    '<div class="form-group row">'+
                    '<label for="questiontype" class="col-sm-2 col-form-label text-sm-right">ANSWER</label>'+
                        '<div class="col-sm-10">'+
                            '<select class="form-control" id="Answer" name="Answer'+id+'" >'+
                                '<option value="Option_A" >A</option>'+
                                '<option value="Option_B" >B</option>'+
                                '<option value="Option_C" >C</option>'+
                                '<option value="Option_D" >D</option>'+
                            '</select>'+
                        '</div>'+
                    '</div>'+
                    '<div class="form-group row">'+
                        '<label class="col-sm-2 col-form-label text-sm-right" for="Mark">TOTAL MARK</label>'+
                        '<div class="col-sm-10">'+
                            '<input type="number" class="form-control" id="Mark" name="Mark'+id+'" min="0" max="100">'+
                        '</div>'+
                    '</div>'+
                '</div>'+
                '<div class="SUBJECTIVE box">'+
                    '<div class="form-group row">'+
                        '<label class="col-sm-2 col-form-label text-sm-right">QUESTIONS</label>'+
                        '<div class="col-sm-10">'+
                            '<textarea class="quiz" name="Question'+id+'"></textarea>'+
                        '</div>'+
                    '</div>'+
                    '<div class="form-group row">'+
                        '<label class="col-sm-2 col-form-label text-sm-right">ANSWER</label>'+
                        '<div class="col-sm-10">'+
                            '<input type="text" class="form-control" id="Answer" name="Answer'+id+'" size="200">'+
                        '</div>'+
                    '</div>'+
                    '<div class="form-group row">'+
                        '<label class="col-sm-2 col-form-label text-sm-right" for="quantity">TOTAL MARK</label>'+
                        '<div class="col-sm-10">'+
                            '<input type="number" class="form-control" id="quantity" name="Mark'+id+'" min="0" max="100">'+
                        '</div>'+
                    '</div>'+
                    '<input class="form-control" type="hidden" id="Option_A" name="Option_A'+id+'">'+
                    '<input class="form-control" type="hidden" id="Option_A" name="Option_B'+id+'">'+
                    '<input class="form-control" type="hidden" id="Option_A" name="Option_C'+id+'">'+
                    '<input class="form-control" type="hidden" id="Option_A" name="Option_D'+id+'">'+
                '</div>'+
                '<input type="hidden" class="form-control" name="Total_question" value="'+id+'" >'+
            '</div><div class="separator separator-dashed my-10"></div>'+
            '<div class="row"><div class="col" align="right">'+
            '<button type="submit" id='+id+' class="btn btn-sm" onclick="myevent(this)" value="Delete" /><i class="flaticon-delete icon-md"></i></button>'+
            '</div></div><br>'+
        '</div><br>';

        document.getElementById('AddDel').appendChild(div);
        $(document).ready(function() {
        $("select").change(function() {
            var type = $(this).val();
            if (type == "OBJECTIVE") 
            {
                $(".box").not(".OBJECTIVE").hide();
                $(".OBJECTIVE").show();
            } 
            else if (type == "SUBJECTIVE") 
            {
                $(".box").not(".SUBJECTIVE").hide();
                $(".SUBJECTIVE").show();
            }  
            else 
            {
            $(".box").hide();
            }
        });


        });
    }
    else
    {
        var element = document.getElementById(action.id);
        element.parentNode.removeChild(element);
    }
    tinymce.init({
    selector: '.quiz',
    menubar:false,
    statusbar: false,
    toolbar: false,
    height:50,
    });
}
</script>
<br>
<div class="d-flex flex-column-fluid">
    <div class="container">
        <div class="col-lg-12">
            <div class="card card-custom gutter-b example example-compact">
                <form class="form" id="addquiz" name="addquiz" action="index.php?page=addquiz" method="post">
                    <div class="card-body">
                        <div class="checkbox-inline">
                            <h2>Adding a new Quiz
                            <a type="button" data-bs-toggle="popover" title="" data-bs-content='
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
                        <a data-toggle="collapse" href="#collapseTwo,#collapseThree,#collapseFour,#collapseFive,#collapseSix,#collapseSeven" ...>
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
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingOne">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                    <p style="color:#0f6fc5;">GENERAL</p>
                                </button>
                                </h2>
                                <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                <!-- begin::body -->
                                    <div class="form-group row ">
                                        <div class="col-md-3 col-form-label d-flex pb-0 pr-md-0">
                                            <label class="d-inline word-break">Name</label>
                                            <div class="ml-1 ml-md-auto d-flex align-items-center align-self-start">
                                                <i class="icon fa fa-exclamation-circle text-danger fa-fw " title="Required" aria-label="Required"></i>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <input type="text" class="form-control" name="title" required>
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
                                                <a type="button" data-bs-toggle="popover" title="" data-bs-content='<p>Students can only start their attempt(s) after the open time and they must complete their attempts before the close time.</p>'>
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
                                                <a type="button" data-bs-toggle="popover" title="" data-bs-content='<p>If enabled, the time limit is stated on the initial quiz page and a countdown timer is displayed in the quiz navigation block.</p>'>
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
                                                <a type="button" data-bs-toggle="popover" title="" data-bs-content='<p>This setting controls what happens if a student fails to submit their quiz attempt before the time expires. If the student is actively working on the quiz at the time, then the countdown timer will always automatically submit the attempt for them, but if they have logged out, then this setting controls what happens.</p>'>
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
                                                <a type="button" data-bs-toggle="popover" title="" data-bs-content='<p>If enabled, the parts making up each question will be randomly shuffled each time a student attempts the quiz, provided the option is also enabled in the question settings. This setting only applies to questions that have multiple parts, such as multiple choice or matching questions.</p>'>
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
                                                <a type="button" data-bs-toggle="popover" title="" data-bs-content='<p>Overall feedback is text that is shown after a quiz has been attempted. By specifying additional grade boundaries (as a percentage or as a number), the text shown can depend on the grade obtained.</p>'>
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
                                                <a type="button" data-bs-toggle="popover" title="" data-bs-content='<p>If the availability is set to Show on course page, the activity or resource is available to students (subject to any access restrictions which may be set).</p>
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
                                                <a type="button" data-bs-toggle="popover" title="" data-bs-content='<p>Setting an ID number provides a way of identifying the activity or resource for purposes such as grade calculation or custom reporting. Otherwise the field may be left blank.</p>
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
                                                <a type="button" data-bs-toggle="popover" title="" data-bs-content='<p>This setting has 3 options:</p>
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
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSeven" aria-expanded="false" aria-controls="collapseNine">
                                    <p style="color:#0f6fc5;">QUESTIONS</p>
                                </button>
                                </h2>
                                <div id="collapseSeven" class="accordion-collapse collapse" aria-labelledby="headingSeven" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                <!-- begin::body -->
                                <div class="mt-5" id="AddDel" align="left">
                                    <input type="button" class="btn btn-success btn-sm" id="add" onclick="myevent(this)" value="Add Question" data-toggle="tooltip" title="Add more question!"/>
                                    <div class="separator separator-dashed my-10"></div>
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
                                <input type="hidden" class="col-sm-12 col-form-label text-sm-right" name="Subject_id" value="<?php echo "3"; ?>">
                            </div>
                            <div class="col-lg-6 text-lg-right">
                                <button type="submit" class="btn btn-success mr-2" name="addquiz">Save and return to the subject</button>
                                <button type="submit" class="btn btn-success mr-2">Save and display</button>
                                <button type="reset" class="btn btn-secondary">Reset</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" src='https://cdn.tiny.cloud/1/jwc9s2y5k97422slkhbv6eu2eqwbwl2skj9npskngzqtsrhq/tinymce/4/tinymce.min.js' referrerpolicy="origin"></script>
<script>
tinymce.init({
  selector: '.quiz',
  menubar:false,
  statusbar: false,
  toolbar: false,
  height:50,
});

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