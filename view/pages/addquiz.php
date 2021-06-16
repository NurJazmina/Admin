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
                        '<select class="form-control" id="type'+id+'" name="Type" required>'+
                            '<option>CHOOSE YOUR TYPE</option>'+
                            '<option value="OBJECTIVE">OBJECTIVE</option>'+
                            '<option value="SUBJECTIVE">SUBJECTIVE</option>'+
                        '</select>'+
                    '</div>'+
                '</div>'+
                '<div class="OBJECTIVE box_'+id+'" id="Quiz">'+
                    '<div class="form-group row">'+
                        '<label  class="col-sm-2 col-form-label text-sm-right">OPTION A</label>'+
                        '<div class="col-sm-10">'+
                            '<input class="form-control" type="text" id="Option_A" name="Option_A">'+
                        '</div>'+
                        ' <label  class="col-sm-2 col-form-label text-sm-right">OPTION B</label>'+
                        '<div class="col-sm-10">'+
                            '<input class="form-control" type="text" id="Option_B" name="Option_B">'+
                        '</div>'+
                        '<label  class="col-sm-2 col-form-label text-sm-right">OPTION C</label>'+
                        '<div class="col-sm-10">'+
                            '<input class="form-control" type="text" id="Option_C" name="Option_C">'+
                        '</div>'+
                        '<label  class="col-sm-2 col-form-label text-sm-right">OPTION D</label>'+
                        '<div class="col-sm-10">'+
                            '<input class="form-control" type="text" id="Option_D" name="Option_D">'+
                        '</div>'+
                    '</div>'+
                    '<div class="form-group row">'+
                    '<label for="questiontype" class="col-sm-2 col-form-label text-sm-right">ANSWER</label>'+
                        '<div class="col-sm-10">'+
                            '<select class="form-control" id="Answer" name="Answer" >'+
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
                            '<input type="number" class="form-control" id="Mark" name="Mark" min="0" max="100">'+
                        '</div>'+
                    '</div>'+
                '</div>'+
                '<div class="SUBJECTIVE box_'+id+'" id="Quiz">'+
                    '<div class="form-group row">'+
                        '<label class="col-sm-2 col-form-label text-sm-right">SUBJECTIVE</label>'+
                        '<div class="col-sm-10">'+
                            '<input type="text" class="form-control" id="Answer" name="Answer" size="200">'+
                        '</div>'+
                    '</div>'+
                    '<div class="form-group row">'+
                        '<label class="col-sm-2 col-form-label text-sm-right" for="quantity">TOTAL MARK</label>'+
                        '<div class="col-sm-10">'+
                            '<input type="number" class="form-control" id="quantity" name="Mark" min="0" max="100">'+
                        '</div>'+
                    '</div>'+
                '</div>'+
            '</div><div class="separator separator-dashed my-10"></div>'+
            '<div class="row"><div class="col" align="right">'+
            '<button type="submit" id='+id+' class="btn btn-sm" onclick="myevent(this)" value="Delete" /><i class="flaticon-delete icon-md"></i></button>'+
            '</div></div><br>'+
        '</div><br>';

        document.getElementById('AddDel').appendChild(div);
        $(document).ready(function(){
        $("#type"+id).change(function(){
            $(this).find("option:selected").each(function(){
                var optionValue = $(this).attr("value");
                if(optionValue){
                    $(".box_"+id).not("." + optionValue).hide();
                    $("." + optionValue).show();
                } else{
                    $(".box_"+id).hide();
                }
            });
        }).change();
        });
    }
    else
    {
        var element = document.getElementById(action.id);
        element.parentNode.removeChild(element);
    }
    
}
</script>
<br>
<div class="d-flex flex-column-fluid">
    <div class="container">
        <div class="col-lg-12">
            <div class="card card-custom gutter-b example example-compact">
                <form class="form" name="addquiz" action="index.php?page=addquiz" method="post">
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
                            <i class="icon fa fa-question-circle text-info fa-fw " title="Help with Quiz" aria-label="Help with Quiz"></i></a></h2>
                        </div>
                        <div align="right">
                        <a data-toggle="collapse" href="#collapseTwo,#collapseThree,#collapseFour,#collapseFive,#collapseSix,#collapseSeven" ...>
                            Expand / Collapse
                            <span class="svg-icon svg-icon-primary svg-icon-2x"><!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\themes\metronic\theme\html\demo1\dist/../src/media/svg/icons\Navigation\Angle-down.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <polygon points="0 0 24 0 24 24 0 24"/>
                                    <path d="M6.70710678,15.7071068 C6.31658249,16.0976311 5.68341751,16.0976311 5.29289322,15.7071068 C4.90236893,15.3165825 4.90236893,14.6834175 5.29289322,14.2928932 L11.2928932,8.29289322 C11.6714722,7.91431428 12.2810586,7.90106866 12.6757246,8.26284586 L18.6757246,13.7628459 C19.0828436,14.1360383 19.1103465,14.7686056 18.7371541,15.1757246 C18.3639617,15.5828436 17.7313944,15.6103465 17.3242754,15.2371541 L12.0300757,10.3841378 L6.70710678,15.7071068 Z" fill="#000000" fill-rule="nonzero" transform="translate(12.000003, 11.999999) rotate(-180.000000) translate(-12.000003, -11.999999) "/>
                                </g>
                            </svg><!--end::Svg Icon--></span>
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
                                            <label class="d-inline word-break " for="id_name">Name</label>
                                            <div class="ml-1 ml-md-auto d-flex align-items-center align-self-start">
                                                <i class="icon fa fa-exclamation-circle text-danger fa-fw " title="Required" aria-label="Required"></i>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <input type="text" class="form-control " name="name" required>
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
                                        <label class="col-md-3 col-form-label d-flex pb-0 pr-md-0">Open the quiz</label>
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
                                        <label class="col-md-3 col-form-label d-flex pb-0 pr-md-0">Time limit</label>
                                        <div class="col-md-3">
                                            <input type="number" class="form-control" name="timeunit">
                                        </div>
                                        <div class="col-md-3">
                                            <select class="custom-select" name="timelimit[timeunit]" id="id_timelimit_timeunit">
                                                <option value="604800">weeks</option>
                                                <option value="86400">days</option>
                                                <option value="3600">hours</option>
                                                <option value="60" selected="">minutes</option>
                                                <option value="1">seconds</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-3 col-form-label d-flex pb-0 pr-md-0">When time expired</label>
                                        <div class="col-md-6">
                                            <select class="form-control" id="kt_bootstrap_select" name="timeexpired">
                                                <option value="autosubmit" selected>Open attempts are submitted automatically</option>
                                                <option value="graceperiod">There is a grace period when open attempts can be submitted, but no more questions answered</option>
                                                <option value="autoabandon">Attempts must be submitted before time expires, or they are not counted</option>
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
                                        <label class="col-md-3 col-form-label d-flex pb-0 pr-md-0">Shuffle within question</label>
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
                                    <p style="color:#0f6fc5;">OVERALL FEEDBACK</p>
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
                                        <label class="col-md-3 col-form-label d-flex pb-0 pr-md-0">Availability</label>
                                        <div class="col-md-6">
                                            <select class="form-control" name="availability">
                                                <option value="SHOW" selected>Show on subject page</option>
                                                <option value="HIDE">Hide from student</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row ">
                                        <div class="col-md-3 col-form-label d-flex pb-0 pr-md-0">
                                            <label class="d-inline word-break " for="id_name">ID Number</label>
                                        </div>
                                        <div class="col-lg-6">
                                            <input type="text" class="form-control" name="idnumber">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-3 col-form-label d-flex pb-0 pr-md-0" for="groupmode">Group Mode</label>
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
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseNine" aria-expanded="false" aria-controls="collapseNine">
                                    <p style="color:#0f6fc5;">QUESTIONS</p>
                                </button>
                                </h2>
                                <div id="collapseNine" class="accordion-collapse collapse" aria-labelledby="headingSeven" data-bs-parent="#accordionExample">
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
                                <input type="hidden" class="col-sm-12 col-form-label text-sm-right" id="Total_question" name="Total_question" value="<?php echo "3"; ?>">
                                <input type="hidden" class="col-sm-12 col-form-label text-sm-right" name="Subject_id" value="<?php echo "3"; ?>">
                                
                                <button type="submit" class="btn btn-success mr-2">Submit </button>
                                <button type="reset" class="btn btn-secondary">Cancel</button>
                            </div>
                            <div class="col-lg-6 text-lg-right">
                                <button type="reset" class="btn btn-danger">Delete</button>
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