<?php
$_SESSION["title"] = "Add Quiz";
include 'view/partials/_subheader/subheader-v1.php'; 
$Subject_id = $_GET['Subject'];
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
<div class="card card-custom overflow-hidden position-relative mb-8">
        <form class="form" id="recheckquiz" name="recheckquiz" action="index.php?page=ol_addquiz" method="post">
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
                                <input type="hidden" class="col-sm-12 col-form-label text-sm-right" name="Subject_id" value="<?php echo "3"; ?>">
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