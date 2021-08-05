<?php
include ('model/url.php');
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
					<h5 class="text-white font-weight-bold my-1 mr-5">Add Quiz</h5>
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
                <form class="form" id="addurl" name="addurl" action="#" method="post">
                    <div class="card-body">
                    <p id="demo"></p>
                        <div class="checkbox-inline">
                            <h2>Adding a New URL
                            <a type="button" data-bs-html="true" data-bs-toggle="popover" title="" data-bs-content='
                            <p>The URL module enables a teacher to provide a web link as a course resource. Anything that is freely available online, such as documents or images, can be linked to; the URL doesn’t have to be the home page of a website. The URL of a particular web page may be copied and pasted or a teacher can use the file picker and choose a link from a repository such as Flickr, YouTube or Wikimedia (depending upon which repositories are enabled for the site).</p>
                            <p>There are a number of display options for the URL, such as embedded or opening in a new window and advanced options for passing information, such as a students name, to the URL if required.</p>
                            <p>Note that URLs can also be added to any other resource or activity type through the text editor.</p>'>
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
                                            <label class="d-inline word-break" for="title">External URL</label>
                                            <div class="ml-1 ml-md-auto d-flex align-items-center align-self-start">
                                                <i class="icon fa fa-exclamation-circle text-danger fa-fw " title="Required" aria-label="Required"></i>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <input type="text" class="form-control" name="url" id="url" aria-required="true" aria-invalid="false" data-rule="url" required>
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
                                <!-- end::body -->
                                </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingTwo">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                    <p style="color:#0f6fc5;">APPEARANCE</p>
                                </button>
                                </h2>
                                <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                <!-- begin::body -->
                                    <div class="form-group row" id="filesubmit1">
                                        <div class="col-md-3 col-form-label d-flex pb-0 pr-md-0">
                                            <label class="d-inline word-break">Display</label>
                                            <div class="ml-1 ml-md-auto d-flex align-items-center align-self-start">
                                                <a type="button" data-bs-html="true" data-bs-toggle="popover" title="" data-bs-content='<p>This setting, together with the URL file type and whether the browser allows embedding, determines how the URL is displayed. Options may include:</p>
                                                    <ul><li>Automatic - The best display option for the URL is selected automatically</li>
                                                    <li>Embed - The URL is displayed within the page below the navigation bar together with the URL description and any blocks</li>
                                                    <li>Open - Only the URL is displayed in the browser window</li>
                                                    <li>In pop-up - The URL is displayed in a new browser window without menus or an address bar</li>
                                                    <li>In frame - The URL is displayed within a frame below the navigation bar and URL description</li>
                                                    <li>New window - The URL is displayed in a new browser window with menus and an address bar</li>
                                                    </ul>'>
                                                    <i class="icon fa fa-question-circle text-success fa-fw " title="Help with max number of upload" aria-label="Help with max number of upload"></i>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <select class="form-control" name="display">
                                                <option value="AUTOMATIC" selected>AUTOMATIC</option>
                                                <option value="EMBED">EMBED</option>
                                                <option value="OPEN">OPEN</option>
                                                <option value="IN POP UP">IN POP UP</option>
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
                                    <p style="color:#0f6fc5;">URL VARIABLE</p>
                                </button>
                                </h2>
                                <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                <!-- begin::body -->
                                    <div class="form-group row">
                                        <div class="col-md-3 col-form-label d-flex pb-0 pr-md-0"></div>
                                        <div class="col-md-6">
                                            This section allows you to pass internal information as part of the URL. This is useful if the URL is an interactive web page that takes parameters, and you want to pass something like the name of the current user, for example. Enter the name of the URL's parameter in the text box then select the corresponding site variable.
                                        </div>
                                    </div>
                                    <div class="form-group row" id="textsubmit">
                                        <div class="col-md-3 col-form-label d-flex pb-0 pr-md-0">
                                            <label class="d-inline word-break"> & parameter = variable </label>
                                        </div>
                                        <div class="col-md-3">
                                            <input type="number" class="form-control " name="parameter_0">
                                        </div>
                                        <div class="col-md-3">
                                            <select class="form-control" name="variable_0" id="id_variable_0">
                                                <option value="">Choose a variable...</option>
                                                <optgroup label="Subject">
                                                <option value="subjectid">id</option>
                                                <option value="subjectfullname">Subject full name</option>
                                                <option value="subjectshortname">Subject short name</option>
                                                <option value="subjectidnumber">Subject ID number</option>
                                                <option value="subjectsummary">Summary</option>
                                                <option value="subjectformat">Format</option>
                                                </optgroup>
                                                <optgroup label="URL">
                                                <option value="urlinstance">id</option>
                                                <option value="urlcmid">cmid</option>
                                                <option value="urlname">Name</option>
                                                <option value="urlidnumber">ID number</option>
                                                </optgroup>
                                                <optgroup label="Miscellaneous">
                                                <option value="sitename">Full site name</option>
                                                <option value="serverurl">Server URL</option>
                                                <option value="currenttime">Time</option>
                                                <option value="lang">Language</option>
                                                </optgroup>
                                                <optgroup label="User">
                                                <option value="userid">id</option>
                                                <option value="userusername">Username</option>
                                                <option value="useridnumber">ID number</option>
                                                <option value="userfirstname">First name</option>
                                                <option value="userlastname">Surname</option>
                                                <option value="userfullname">User full name</option>
                                                <option value="useremail">Email address</option>
                                                <option value="userphone1">Phone</option>
                                                <option value="userphone2">Mobile phone</option>
                                                <option value="userinstitution">Institution</option>
                                                <option value="userdepartment">Department</option>
                                                <option value="useraddress">Address</option>
                                                <option value="usercity">City/town</option>
                                                <option value="usertimezone">Timezone</option>
                                                </optgroup>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row" id="textsubmit">
                                        <div class="col-md-3 col-form-label d-flex pb-0 pr-md-0">
                                            <label class="d-inline word-break"> & parameter = variable </label>
                                        </div>
                                        <div class="col-md-3">
                                            <input type="number" class="form-control " name="parameter_1">
                                        </div>
                                        <div class="col-md-3">
                                            <select class="form-control" name="variable_1" id="id_variable_1">
                                                <option value="">Choose a variable...</option>
                                                <optgroup label="Subject">
                                                <option value="subjectid">id</option>
                                                <option value="subjectfullname">Subject full name</option>
                                                <option value="subjectshortname">Subject short name</option>
                                                <option value="subjectidnumber">Subject ID number</option>
                                                <option value="subjectsummary">Summary</option>
                                                <option value="subjectformat">Format</option>
                                                </optgroup>
                                                <optgroup label="URL">
                                                <option value="urlinstance">id</option>
                                                <option value="urlcmid">cmid</option>
                                                <option value="urlname">Name</option>
                                                <option value="urlidnumber">ID number</option>
                                                </optgroup>
                                                <optgroup label="Miscellaneous">
                                                <option value="sitename">Full site name</option>
                                                <option value="serverurl">Server URL</option>
                                                <option value="currenttime">Time</option>
                                                <option value="lang">Language</option>
                                                </optgroup>
                                                <optgroup label="User">
                                                <option value="userid">id</option>
                                                <option value="userusername">Username</option>
                                                <option value="useridnumber">ID number</option>
                                                <option value="userfirstname">First name</option>
                                                <option value="userlastname">Surname</option>
                                                <option value="userfullname">User full name</option>
                                                <option value="useremail">Email address</option>
                                                <option value="userphone1">Phone</option>
                                                <option value="userphone2">Mobile phone</option>
                                                <option value="userinstitution">Institution</option>
                                                <option value="userdepartment">Department</option>
                                                <option value="useraddress">Address</option>
                                                <option value="usercity">City/town</option>
                                                <option value="usertimezone">Timezone</option>
                                                </optgroup>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row" id="textsubmit">
                                        <div class="col-md-3 col-form-label d-flex pb-0 pr-md-0">
                                            <label class="d-inline word-break"> & parameter = variable </label>
                                        </div>
                                        <div class="col-md-3">
                                            <input type="number" class="form-control " name="parameter_2">
                                        </div>
                                        <div class="col-md-3">
                                            <select class="form-control" name="variable_2" id="id_variable_2">
                                                <option value="">Choose a variable...</option>
                                                <optgroup label="Subject">
                                                <option value="subjectid">id</option>
                                                <option value="subjectfullname">Subject full name</option>
                                                <option value="subjectshortname">Subject short name</option>
                                                <option value="subjectidnumber">Subject ID number</option>
                                                <option value="subjectsummary">Summary</option>
                                                <option value="subjectformat">Format</option>
                                                </optgroup>
                                                <optgroup label="URL">
                                                <option value="urlinstance">id</option>
                                                <option value="urlcmid">cmid</option>
                                                <option value="urlname">Name</option>
                                                <option value="urlidnumber">ID number</option>
                                                </optgroup>
                                                <optgroup label="Miscellaneous">
                                                <option value="sitename">Full site name</option>
                                                <option value="serverurl">Server URL</option>
                                                <option value="currenttime">Time</option>
                                                <option value="lang">Language</option>
                                                </optgroup>
                                                <optgroup label="User">
                                                <option value="userid">id</option>
                                                <option value="userusername">Username</option>
                                                <option value="useridnumber">ID number</option>
                                                <option value="userfirstname">First name</option>
                                                <option value="userlastname">Surname</option>
                                                <option value="userfullname">User full name</option>
                                                <option value="useremail">Email address</option>
                                                <option value="userphone1">Phone</option>
                                                <option value="userphone2">Mobile phone</option>
                                                <option value="userinstitution">Institution</option>
                                                <option value="userdepartment">Department</option>
                                                <option value="useraddress">Address</option>
                                                <option value="usercity">City/town</option>
                                                <option value="usertimezone">Timezone</option>
                                                </optgroup>
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
                                <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour" data-bs-parent="#accordionExample">
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
                                <h2 class="accordion-header" id="headingFive">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                                    <p style="color:#0f6fc5;">ACTIVITY COMPLETION</p>
                                </button>
                                </h2>
                                <div id="collapseFive" class="accordion-collapse collapse" aria-labelledby="headingFive" data-bs-parent="#accordionExample">
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
                                <input type="hidden" class="col-sm-12 col-form-label text-sm-right" name="Subject_id" value="<?php echo "3"; ?>">
                                <input type="hidden" class="col-sm-12 col-form-label text-sm-right" name="Notes_id" value="<?php echo "2"; ?>">
                            </div>
                            <div class="col-lg-6 text-lg-right">
                                <button type="submit" href="" class="btn btn-success mr-2" name="addurl" onclick="myFunction()">Save and return to the subject</button>
                                <button type="submit" class="btn btn-success mr-2" name="addurl" onclick="myFunction()">Save and display</button>
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

</script>