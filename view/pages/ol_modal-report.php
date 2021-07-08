<style>
.dropdown,
.dropdown-toggle,
.dropdown-menu,
.dropdown-item {
	width: 100%;	
}

a {
  white-space: nowrap;
  overflow: hidden;
  text-overflow: ellipsis;
}
</style>
<form name="reportquiz" action="" method="post">
    <div class="modal fade" id="report" tabindex="-1" aria-labelledby="EditSchoolModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header mx-3">
                    <h5 class="modal-title">Report this quiz</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body mx-3">
                    <div class="row">
                        <label>What's wrong with this quiz?</label>
                        <div class="radio-inline">
                            <div class="col">
                                <label class="radio radio-outline radio-success">
                                    <input type="radio" name="radio_1" value="It contains inappropriate content"/>
                                    <span></span>
                                    It contains inappropriate content
                                </label>
                                <label class="radio radio-outline radio-success">
                                    <input type="radio" name="radio_1" value="It contains factually incorrect content"/>
                                    <span></span>
                                    It contains factually incorrect content
                                </label>
                                <label class="radio radio-outline radio-success">
                                    <input type="radio" name="radio_1" value="Other"/>
                                    <span></span>
                                    Other
                                </label>
                            </div>
                        </div>
                        <label class="mt-6 mb-3">Is there a particular question you'd like to report?</label>
                        <button class="btn btn-sm btn-outline-secondary" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                            select question to report
                            <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                        <?php
                        for ($i = 0; $i < $Total_Question; $i++)
                        {
                            $Question = $document->Quiz[$i]->Question;
                            ?>
                            <li class="dropdown-item" value="<?= $i ?>"><a><?= $Question?></a></li>
                            <?php
                        }
                        ?>
                        </ul>
                        <labels class="mt-6 mb-3">Please provide additional details</labels>
                        <textarea class="quiz mx-5"></textarea>
                    </div>
                </div>
                <div class="modal-footer mx-3">
                    <input type="hidden" name="Created_by" value="<?php echo $Created_by; ?>">
                    <input type="hidden" name="Quiz_id" value="<?php echo $Quiz_id; ?>">
                    <input type="hidden" name="Report_by" value="<?php echo $_SESSION["loggeduser_id"]; ?>">
                    <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-sm btn-success" name="reportquiz">Submit</button>
                </div>
            </div>
        </div>
    </div>
</form>