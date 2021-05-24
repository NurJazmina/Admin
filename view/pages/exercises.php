<?php
$_SESSION["title"] = "Online learning";
?>
<?php include 'view/partials/_subheader/subheader-v1.php'; ?>

<html>
    <body>
        (If the teacher wants to edit then the teacher must select the subject first > edit page optional subjective/objective > save) <br>
        (If objective questions, must set with the correct answers too, while subjective, just leave with with the text area)
    <br><br>
    <html>
    <body>
    <form id="AddNewExercise" name="AddNewExercise" action="index.php?page=onlinelearning" method="post">
        <div id="AddExerciseModal" tabindex="-1" aria-labelledby="AddExerciseModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="AddExerciseModalLabel">New Exercise</h5> 
                    </div>
                    <div class="modal-body">
                    <div class="form-group row">
                    <div class="form-group">
                        <label for="AddNewExercises">Add new exercises: </label>
                            <textarea class="form-control rounded-0" id="AddNewExercises" rows="10"></textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" name="AddExerciseSubmit" onclick="alert('Questions added!')">Add</button>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
    </body>
</html>
   
