<?php
$_SESSION["title"] = "Online learning";
include 'view/partials/_subheader/subheader-v1.php'; 
?>

        (If the teacher wants to edit then the teacher must select the subject first > edit page optional subjective/objective > save) <br>
        (If objective questions, must set with the correct answers too, while subjective, just leave with with the text area)
    <br><br>
    <form id="AddNewExercise" name="AddNewExercise" action="index.php?page=onlinelearning" method="post">
        <div id="AddExerciseModal" tabindex="-1" aria-labelledby="AddExerciseModalLabel" aria-hidden="true">

            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="AddExerciseModalLabel">New Exercise/Quiz</h5> 
                    </div>

                    <div class="modal-body">
                        <div class="form-group row">
                                <label class="col-lg-2 col-form-label text-lg-left"><h5>Selection:</h5></label>
                                <div class="col-lg-6">
                                    <select class="form-control" id="questionType" style="height: auto;" name="access" required>
                                    <option value="Objective">Objective</option>
                                    <option value="Subjective">Subjective</option>
                                    </select>
                                </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="objective">Objective</h5> 
                    </div>
                    <div class="modal-body">
                    <div class="form-group row">
                            <label class="col-lg-2 col-form-label text-lg-left"><h5>Title:</h5></label>
                            <div class="col-lg-8">
                                <input name="title" type="text" class="form-control" id="mcqQuestion" placeholder="Enter your title here" name="txttitle" size="200" oninput="let p=this.selectionStart;this.value=this.value.toUpperCase();this.setSelectionRange(p, p);">   
                            </div>
                    </div>
                        <div class="form-group row">
                        
                        <!-- test -->
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary">Add</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="subjective">Subjective</h5> 
                    </div>
                    <div class="modal-body">
                    <div class="form-group row">
                            <label class="col-lg-2 col-form-label text-lg-left"><h5>Title:</h5></label>
                            <div class="col-lg-8">
                                <input name="title" type="text" class="form-control" id="subjectiveQuestion" placeholder="Enter your title here" name="txttitle" size="200" oninput="let p=this.selectionStart;this.value=this.value.toUpperCase();this.setSelectionRange(p, p);">   
                            </div>
                    </div>
                    <div class="form-group row">
                            <label for="AddNewExercises">Question goes here:</label><br><br>

                    </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary">Add</button>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </form>

<!-- <div class="form-group row">
                            <label for="AddNewExercises">Question goes here:</label><br><br>
                                    <textarea class="form-control rounded-0" id="AddNewExercises" rows="3"></textarea>
                    </div> -->