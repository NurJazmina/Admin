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
                                    <input type="radio" name="Information" value="It contains inappropriate content"/>
                                    <span></span>
                                    It contains inappropriate content
                                </label>
                                <label class="radio radio-outline radio-success">
                                    <input type="radio" name="Information" value="It contains factually incorrect content"/>
                                    <span></span>
                                    It contains factually incorrect content
                                </label>
                                <label class="radio radio-outline radio-success">
                                    <input type="radio" name="Information" value="Other"/>
                                    <span></span>
                                    Other
                                </label>
                            </div>
                        </div>
                        <label class="mt-6 mb-3">Is there a particular question you'd like to report?</label>
                        <select class="form-control selectpicker" name="Question_number" style="width: 100%;" required>
                            <option selected disabled value="">select question to report</option>
                            <?php
                            for ($i = 0; $i < $Total_Question; $i++)
                            {
                                $Question = $document->Quiz[$i]->Question;
                                $post = substr($Question, 0, 70);
                                $questionwrap = $post."...";
                                ?>
                                <option class="bg-hover-secondary" value="<?= $i ?>"><?= $Question ?></option>
                                <?php
                            }
                            ?>
                        </select>
                        <labels class="mt-6 mb-3">Please provide additional details</labels>
                        <textarea class="quiz mx-5" name="Description"></textarea>
                    </div>
                </div>
                <div class="modal-footer mx-3">
                    <input type="hidden" name="Created_by" value="<?php echo $Created_by; ?>">
                    <input type="hidden" name="Quiz_id" value="<?php echo $Quiz_id; ?>">
                    <button type="submit" class="btn btn-outline-success btn-sm btn-block" name="reportquiz" onclick="sweetalert2()">Submit</button>
                </div>
            </div>
        </div>
    </div>
</form>
<script>
//submit
function sweetalert2() {
    Swal.fire({
    icon: 'success',
    title: 'Email was sent !'
    })
}
</script>
