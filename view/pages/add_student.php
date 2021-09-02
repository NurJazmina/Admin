<?php
$_SESSION["title"] = "Student";
include 'view/partials/_subheader/subheader-v1.php'; 
?>
<form name="recheck_add_student" action="index.php?page=modal-recheck_student" method="post">
  <div id="add_student">
    <div class="modal-dialog modal-lg modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Add Student</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="form-group row">
              <label class="col-sm-3 col-form-label">Parent ID</label>
              <div class="col-sm-9">
                <input type="text" class="form-control" name="parent_idno" oninput="let p=this.selectionStart;this.value=this.value.toUpperCase();this.setSelectionRange(p, p);" required>
              </div>
          </div>
          <div class="form-group row">
              <label class="col-sm-3 col-form-label">Child ID</label>
              <div class="col-sm-9">
                <input type="text" class="form-control" name="student_idno" oninput="let p=this.selectionStart;this.value=this.value.toUpperCase();this.setSelectionRange(p, p);" required>
              </div>
          </div>
          <div class="form-group row">
              <label class="col-sm-3 col-form-label">Class Category</label>
              <div class="col-sm-9">
                <select class="form-control" name="class_category">
                    <option value="1">1</option>
                    <option value="3">3</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                    <option value="6">6</option>
                </select>
              </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-light btn-hover-success btn-sm" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-success btn-hover-light btn-sm" name="recheck_add_student">Confirm</button>
        </div>
        </div>
    </div>
  </div>
</form>