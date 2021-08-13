<?php
$Notes_id = strval($_GET['Notes']);
$filter = ['_id'=>new \MongoDB\BSON\ObjectId($Notes_id)];
$query = new MongoDB\Driver\Query($filter);
$cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.OL_Notes',$query);
foreach ($cursor as $document)
{
    $Subject_id = strval($document->Subject_id);
    $Note_sort = strval($document->Note_sort);
    $filter = ['_id'=>new \MongoDB\BSON\ObjectId($Subject_id)];
    $query = new MongoDB\Driver\Query($filter);
    $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.SchoolsSubject',$query);
    foreach ($cursor as $document1)
    {
        $SubjectName = $document1->SubjectName;
    }
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
.gradient-custom {
  /* fallback for old browsers */
  background: #30cfd0;

  /* Chrome 10-25, Safari 5.1-6 */
  background: -webkit-linear-gradient(to left, rgba(48, 207, 208, 0.5), rgba(51, 8, 103, 0.5));

  /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
  background: linear-gradient(to left, rgba(48, 207, 208, 0.5), rgba(51, 8, 103, 0.5))
}
</style>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
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
					<h5 class="text-white font-weight-bold my-1 mr-5">Add Survey</h5>
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
<div class="d-flex flex-column-fluid">
    <div class="container">
        <div class="col-lg-12">
            <div class="card card-custom gutter-b example example-compact">
                <form class="form" name="add_survey_return_notes" action="index.php?page=ol_notes&id=<?= $Notes_id; ?>&slot=<?= $Note_sort; ?>" method="post">
                    <div class="card-body">
                    <p id="demo"></p>
                        <div class="checkbox-inline">
                            <h2>Adding a New Survey
                                <a type="button" data-bs-html="true" data-bs-toggle="popover" title="" data-bs-content='
                                <p>The survey activity module provides a number of verified survey instruments that have been found useful in assessing and stimulating learning in online environments. A teacher can use these to gather data from their students that will help them learn about their class and reflect on their own teaching.</p>
                                <p>Note that these survey tools are pre-populated with questions. Teachers who wish to create their own survey should use the feedback activity module.</p>'>
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
                                            <label class="d-inline word-break" for="title">Name</label>
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
                                            <label class="d-inline word-break" for="title">Survey Type</label>
                                            <div class="ml-1 ml-md-auto d-flex align-items-center align-self-start">
                                                <i class="icon fa fa-exclamation-circle text-danger fa-fw " title="Required" aria-label="Required"></i>
                                                <a type="button" data-bs-html="true" data-bs-toggle="popover" title="" data-bs-content='<p>There are 3 available survey types:</p>
                                                    <ul><li>Attitudes to Thinking and Learning Survey (ATTLS) - For measuring the extent to which a person is a connected knower (tends to find learning more enjoyable, and is often more cooperative, congenial and more willing to build on the ideas of others) or a separate knower (tends to take a more critical and argumentative stance to learning)</li>
                                                    <li>Critical incidents survey</li>
                                                    <li>Constructivist On-line Learning Environment Survey (COLLES) - For monitoring the extent to which the interactive capacity of the World Wide Web may be exploited for engaging students in dynamic learning practices</li>
                                                    </ul>'>
                                                    <i class="icon fa fa-question-circle text-success fa-fw " title="Help with max number of upload" aria-label="Help with max number of upload"></i>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <select class="form-control" name="type" aria-required="true" aria-invalid="false" data-rule="url" required>
                                                <option disabled selected>CHOOSE...</option>
                                                <option value="4">ATTLS (20 ITEM VERSION)</option>
                                                <option value="5">CRITICAL INCIDENTS</option>
                                                <option value="1">COLLES (ACTUAL)</option>
                                                <option value="2">COLLES (PREFFERED & ACTUAL)</option>
                                                <option value="3">COLLES (PREFFERED)</option>
                                            </select>
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
                                            <textarea class="survey" name="description"></textarea>
                                        </div>
                                    </div>
                                <!-- end::body -->
                                </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingTwo">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                    <div class="d-flex">
                                            <label class="d-inline word-break" for="id_name" style="color:#0f6fc5;">COMMON MODULE SETTING</label>
                                            <div class="ml-1 d-flex align-items-center align-self-start">
                                                <a type="button" data-bs-html="true" data-bs-toggle="popover" title="" data-bs-content='<p>Overall feedback is text that is shown after a assignment has been attempted. By specifying additional grade boundaries (as a percentage or as a number), the text shown can depend on the grade obtained.</p>'>
                                                    <i class="icon fa fa-question-circle text-success fa-fw" title="Help with Overall feedback" aria-label="Help with Overall feedback"></i>
                                                </a>
                                            </div>
                                        </div>
                                </button>
                                </h2>
                                <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                <!-- begin::body -->
                                    <div class="form-group row ">
                                        <div class="col-md-3 col-form-label d-flex pb-0 pr-md-0">
                                            <label class="d-inline word-break" for="title">Availability</label>
                                            <div class="ml-1 ml-md-auto d-flex align-items-center align-self-start">
                                                <a type="button" data-bs-html="true" data-bs-toggle="popover" title="" data-bs-content='<p>If the availability is set to Show on course page, the activity or resource is available to students (subject to any access restrictions which may be set).</p>
                                                    <p>If the availability is set to Hide from students, the activity or resource is only available to users with permission to view hidden activities (by default, users with the role of teacher or non-editing teacher).</p>'>
                                                    <i class="icon fa fa-question-circle text-success fa-fw " title="Help with max number of upload" aria-label="Help with max number of upload"></i>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <select class="form-control" name="availability">
                                                <option value="SHOW" selected>Show on subject page</option>
                                                <option value="HIDE">Hide from students</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row" id="idnumber">
                                        <div class="col-md-3 col-form-label d-flex pb-0 pr-md-0">
                                            <label class="d-inline word-break" for="title">ID Number</label>
                                            <div class="ml-1 ml-md-auto d-flex align-items-center align-self-start">
                                                <a type="button" data-bs-html="true" data-bs-toggle="popover" title="" data-bs-content='
                                                    <p>Setting an ID number provides a way of identifying the activity or resource for purposes such as grade calculation or custom reporting. Otherwise the field may be left blank.</p>
                                                    <p>For gradable activities, the ID number can also be set in the gradebook, though it can only be edited on the activity settings page.</p>'>
                                                    <i class="icon fa fa-question-circle text-success fa-fw " title="Help with max number of upload" aria-label="Help with max number of upload"></i>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <input type="text" class="form-control" name="idnumber">
                                        </div>
                                    </div>
                                <!-- end::body -->
                                </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingThree">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                    <p style="color:#0f6fc5;">ACTIVITY COMPLETION</p>
                                </button>
                                </h2>
                                <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                <!-- begin::body -->
                                    <div class="form-group row ">
                                        <div class="col-md-3 col-form-label d-flex pb-0 pr-md-0">
                                            <label class="d-inline word-break" for="title">Completion tracking</label>
                                            <div class="ml-1 ml-md-auto d-flex align-items-center align-self-start">
                                                <a type="button" data-bs-html="true" data-bs-toggle="popover" title="" data-bs-content='<p>If the availability is set to Show on course page, the activity or resource is available to students (subject to any access restrictions which may be set).</p>
                                                    <p>If the availability is set to Hide from students, the activity or resource is only available to users with permission to view hidden activities (by default, users with the role of teacher or non-editing teacher).</p>'>
                                                    <i class="icon fa fa-question-circle text-success fa-fw " title="Help with max number of upload" aria-label="Help with max number of upload"></i>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <select class="form-control" name="tracking" id="tracking" onchange="Selecttracking(this.value);">
                                                <option value="NONE">Do not indicate any activity completion</option>
                                                <option value="MANUALMARK" selected>Student can manually mark the activity as completed</option>
                                                <option value="AUTOMARK">Show the activity as complete when the require are met</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div id="requireview" style="display:none;">
                                    <div class="form-group row">
                                        <div class="col-md-3 col-form-label d-flex pb-0 pr-md-0">
                                            <label class="d-inline word-break" for="title">Require view</label>
                                        </div>
                                        <div class="col-lg-6">
                                            <label class="checkbox checkbox-success mt-3"><input type="checkbox" id="view" name="view"/>
                                                <span> </span> 
                                                Student must view this activity to complete it
                                            </label>
                                        </div>
                                    </div>
                                    </div>
                                    <div id="expectcompleted" style="display:none;">
                                    <div class="form-group row">
                                        <div class="col-md-3 col-form-label d-flex pb-0 pr-md-0">
                                            <label class="d-inline word-break" for="title">Expect completed on</label>
                                            <div class="ml-1 ml-md-auto d-flex align-items-center align-self-start">
                                                <a type="button" data-bs-html="true" data-bs-toggle="popover" title="" data-bs-content='
                                                    <p>This setting specifies the date when the activity is expected to be completed.</p>'>
                                                    <i class="icon fa fa-question-circle text-success fa-fw " title="Help with max number of upload" aria-label="Help with max number of upload"></i>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <input type="datetime-local" class="form-control" name="expectcompleted" placeholder="Select date" id="kt_datepicker">
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
                                <input type="hidden" class="col-sm-12 col-form-label text-sm-right" name="Notes_id" value="<?php echo $Notes_id; ?>">
                                <input type="hidden" class="col-sm-12 col-form-label text-sm-right" name="Subject_id" value="<?php echo $Subject_id; ?>">
                            </div>
                            <div class="col-lg-6 text-lg-right">
                                <button type="submit" href="" class="btn btn-success mr-2" name="add_survey_return_notes">Save and return to the notes</button>
                                <!-- <button type="submit" class="btn btn-success mr-2" name="addsurvey">Save and display</button> -->
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
  selector: '.survey',
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
      },
      url: function(node) {
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

//activity completion
function Selecttracking() {
    var tracking = document.getElementById("tracking").value;
    var box1 = document.getElementById("expectcompleted");
    var box2 = document.getElementById("requireview");
    if(tracking == "MANUALMARK")
    {
    box1.style.display = "block";
    box2.style.display = "none";
    }
    else if(tracking == "AUTOMARK")
    {
    box1.style.display = "block";
    box2.style.display = "block";
    }
    else
    {
    box1.style.display = "none";
    box2.style.display = "none";
    }
    
}
Selecttracking(); 

</script>