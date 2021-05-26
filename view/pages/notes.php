<?php
$_SESSION["title"] = "Online learning";
include 'view/partials/_subheader/subheader-v1.php'; 
?>

    <form id="AddNotesSubmit" name="AddNotesSubmit" action="index.php?page=onlinelearning" method="post">
        <div id="AddNotesModal" tabindex="-1" aria-labelledby="AddNotesModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="AddNotesModalLabel">New Notes</h5> 
                    </div>
                    <div class="modal-body">
                        <div class="form-group row">
                        <label class="col-lg-2 col-form-label text-lg-left">Title</label>
                            <div class="col-lg-12">
                                <input name="title" type="text" class="form-control" name="txttitle" size="200" oninput="let p=this.selectionStart;this.value=this.value.toUpperCase();this.setSelectionRange(p, p);" required>   
                            </div>
                            <div class="form-group">
                                <label for="AddNewNotes">Add new notes:</label>
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
