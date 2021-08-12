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
/* tooltip link */

.tip {
	display: inline-block;
	cursor: pointer;
}

/* tooltip content */

.tooltip h2 {
	white-space: nowrap;
}

/* demo styles */

.container {
	padding-top: 150px;
}
.append {
	margin-left: 1em;
}
li {
	font-size: 18px;
	margin-bottom: 20px;
}
</style>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
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
<div class="card card-custom overflow-hidden position-relative mb-8">
        <form class="form" name="recheckquiz" action="index.php?page=ol_addquiz" method="post">
            <div class="card-body">
            <div class="row justify-content-around">
                    <div class="col-sm-6 border shadow p-3 mb-5 bg-white rounded">
                        <div class="card-body">
                            <h5 align="center" class="mb-10">TOTAL QUESTIONS</h5>
                            <div class="form-group row">
                                <div class="col-sm-3"></div>
                                <div class="col-md-3 col-form-label d-flex pb-0 pr-md-0">
                                    <label class="d-inline word-break">Objective Questions</label>
                                    <div class="ml-1 ml-md-auto d-flex align-items-center align-self-start">
                                        <a type="button" data-bs-toggle="popover" data-bs-html="true" title="" data-bs-content='<p>You will not be able to make any changes after submitting.</p>'>
                                            <i class="icon fa fa-question-circle text-success fa-fw " title="Help with total quiz" aria-label="Help with total quiz"></i>
                                        </a>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <input type="number" class="form-control" onkeyup="if(this.value<0){this.value= this.value * -1}" name="totalobj" min="0" max="20" value="0">
                                </div>
                                <div class="col-sm-3"></div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-3"></div>
                                <div class="col-md-3 col-form-label d-flex pb-0 pr-md-0">
                                    <label class="d-inline word-break">Subjective Questions</label>
                                    <div class="ml-1 ml-md-auto d-flex align-items-center align-self-start">
                                        <a type="button" data-bs-toggle="popover" data-bs-html="true" title="" data-bs-content='<p>You will not be able to make any changes after submitting.</p>'>
                                            <i class="icon fa fa-question-circle text-success fa-fw " title="Help with total quiz" aria-label="Help with total quiz"></i>
                                        </a>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <input type="number" class="form-control" onkeyup="if(this.value<0){this.value= this.value * -1}" name="totalsub" min="0" max="20" value="0">
                                </div>
                                <div class="col-sm-3"></div>
                            </div>
                            <div class="separator separator-dashed my-10"></div>
                            <div class="row">
                            <div class="col-lg-8 text-lg-right">
                                <input type="hidden" class="col-sm-12 col-form-label text-sm-right" name="Notes_id" value="<?php echo $Notes_id; ?>">
                                <input type="hidden" class="col-sm-12 col-form-label text-sm-right" name="Subject_id" value="<?php echo $Subject_id; ?>">
                                <input type="hidden" class="col-sm-12 col-form-label text-sm-right" name="Note_sort" value="<?php echo $Note_sort; ?>">
                                <button type="submit" class="btn btn-success mr-2" name="recheckquiz">Submit</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </div>
        </form>
</div>            
<script>
  var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
  var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
    return new bootstrap.Tooltip(tooltipTriggerEl)
  })
</script>