<?php
$_SESSION["title"] = "Online learning";
?>
<?php include 'view/partials/_subheader/subheader-v1.php'; ?>

<html>
    <body>
    <form id="AddNotesSubmit" name="AddNotesSubmit" action="index.php?page=onlinelearning" method="post">
        <div id="AddNotesModal" tabindex="-1" aria-labelledby="AddNotesModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="AddNotesModalLabel">New Notes</h5> 
                    </div>
                    <div class="modal-body">
                    <div class="form-group row">
                        <div class="form-group">
                            <label for="AddNewNotes">Add new notes: </label>
                                <textarea class="form-control rounded-0" id="AddNewNotes" rows="10"></textarea>
                        </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" name="AddNotesSubmit" onclick="alert('New notes added!')">Add</button>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
    </body>
</html>
