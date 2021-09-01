<?php
$_SESSION["title"] = "Department";
include 'view/partials/_subheader/subheader-v1.php'; 
?>
<form name="add_department" action="index.php?page=departmentlist" method="post">
  <div id="AddDepartmentModal">
    <div class="modal-dialog modal-lg modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Add Department</h5>
        </div>
        <div class="modal-body">
          <div class="form-group row">
            <label class="col-sm-2 col-form-label">Department</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="department_name" oninput="let p=this.selectionStart;this.value=this.value.toUpperCase();this.setSelectionRange(p, p);">
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-success btn-sm" name="add_department">Save changes</button>
        </div>
    </div>
  </div>
</form>