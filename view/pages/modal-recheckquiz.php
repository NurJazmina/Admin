<?php
$_SESSION["title"] = "Add Quiz";
include 'view/partials/_subheader/subheader-v1.php'; 
?>
<div class="d-flex flex-column-fluid">
    <div class="container">
            <div class="card card-custom gutter-b example example-compact">
                <form class="form" id="recheckquiz" name="recheckquiz" action="index.php?page=addquiz" method="post">
                    <div class="card-body">
                    <div class="row">
                        <div class="col-sm"></div>
                            <div class="col-sm border">
                                <div class="card-body">
                                    <h5 align="center">TOTAL QUESTIONS</h5>
                                    <div class="form-group row">
                                        <div class="col-md-6 col-form-label d-flex pb-0 pr-md-0">
                                            <label class="d-inline word-break">Objective Questions</label>
                                            <div class="ml-1 ml-md-auto d-flex align-items-center align-self-start">
                                                <a type="button" data-bs-toggle="popover" title="" data-bs-content='<p>You will not be able to make any changes after submitting.</p>'>
                                                    <i class="icon fa fa-question-circle text-success fa-fw " title="Help with total quiz" aria-label="Help with total quiz"></i>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="number" class="form-control" onkeyup="if(this.value<0){this.value= this.value * -1}" name="totalobj" min="0" max="20" value="0">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-md-6 col-form-label d-flex pb-0 pr-md-0">
                                            <label class="d-inline word-break">Subjective Questions</label>
                                            <div class="ml-1 ml-md-auto d-flex align-items-center align-self-start">
                                                <a type="button" data-bs-toggle="popover" title="" data-bs-content='<p>You will not be able to make any changes after submitting.</p>'>
                                                    <i class="icon fa fa-question-circle text-success fa-fw " title="Help with total quiz" aria-label="Help with total quiz"></i>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="number" class="form-control" onkeyup="if(this.value<0){this.value= this.value * -1}" name="totalsub" min="0" max="20" value="0">
                                        </div>
                                    </div>
                                    <div class="separator separator-dashed my-10"></div>
                                    <div class="row">
                                    <div class="col-lg-6">
                                        <input type="hidden" class="col-sm-12 col-form-label text-sm-right" name="Subject_id" value="<?php echo "3"; ?>">
                                    </div>
                                    <div class="col-lg-6 text-lg-right">
                                        <button type="submit" class="btn btn-success mr-2" name="recheckquiz">Submit</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm"></div>
                    </div>
                    </div>
                </form>
            </div>
    </div>
</div>            