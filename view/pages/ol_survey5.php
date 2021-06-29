<?php
include 'model/survey.php';
?>
<style>
   input[type='radio']:checked:after {
        width: 15px;
        height: 15px;
        border-radius: 15px;
        top: -2px;
        left: -1px;
        position: relative;
        background-color: #04ada5;
        content: '';
        display: inline-block;
        visibility: visible;
        border: 2px solid white;
    }
</style>
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
					<h5 class="text-dark font-weight-bold my-1 mr-5">Survey</h5>
					<!--end::Page Title-->
				</div>
                <!--begin::Separator-->
                <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-5 bg-gray-200"></div>
                <!--end::Separator-->
                <!--begin::Detail-->
                <div class="d-flex align-items-center" id="kt_subheader_search">
                <span class="text-dark-50 font-weight-bold" id="kt_subheader_total">CRITICAL INCIDENT</span>
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
<div class="content d-flex flex-column flex-column-fluid">
    <div class="card card-custom gutter-b px-5">
        <div class="card-body">
            <div class="row">
                <form action="#" id="surveyform1" name="surveyform5" method="post">
                    <div>
                        <p><b>While thinking about recent events in this class, answer the questions below. All questions are required and must be answered.</b></p>
                        <ol class="mt-10 mb-3">
                            <div class="form-group row ">
                                <div class="col-md-3 col-form-label d-flex pb-0 pr-md-0">
                                    <li>At what moment in class were you most engaged as a learner?</li>
                                </div>

                                <div class="col-md-6">
                                    <textarea class="survey5" name="question1"></textarea>
                                </div>
                            </div>
                            <div class="form-group row ">
                                <div class="col-md-3 col-form-label d-flex pb-0 pr-md-0">
                                    <li>At what moment in class were you most distanced as a learner?</li>
                                </div>

                                <div class="col-md-6">
                                    <textarea class="survey5" name="question2"></textarea>
                                </div>
                            </div>
                            <div class="form-group row ">
                                <div class="col-md-3 col-form-label d-flex pb-0 pr-md-0">
                                    <li>What action from anyone in the forums did you find most affirming or helpful?</li>
                                </div>

                                <div class="col-md-6">
                                    <textarea class="survey5" name="question3"></textarea>
                                </div>
                            </div>
                            <div class="form-group row ">
                                <div class="col-md-3 col-form-label d-flex pb-0 pr-md-0">
                                    <li>What action from anyone in the forums did you find most puzzling or confusing?</li>
                                </div>

                                <div class="col-md-6">
                                    <textarea class="survey5" name="question4"></textarea>
                                </div>
                            </div>
                            <div class="form-group row ">
                                <div class="col-md-3 col-form-label d-flex pb-0 pr-md-0">
                                    <li>What event surprised you most?</li>
                                </div>

                                <div class="col-md-6">
                                    <textarea class="survey5" name="question5"></textarea>
                                </div>
                            </div>
                        </ol>
                    </div>
                    <div class="separator separator-dashed my-10"></div>
                    <div class="row">
                        <div class="col-lg-6 ml-lg-auto">
                            <button type="reset"  class="btn btn-secondary">Reset</button>
                            <button type="submit" class="btn btn-success" name="AddNews">Confirm</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" src='https://cdn.tiny.cloud/1/jwc9s2y5k97422slkhbv6eu2eqwbwl2skj9npskngzqtsrhq/tinymce/4/tinymce.min.js' referrerpolicy="origin"></script>
<script>
//custom tinymce
tinymce.init({
  selector: '.survey5',
  menubar:false,
  statusbar: false,
  toolbar: false,
  height:50,
  width:500,
});
</script>
