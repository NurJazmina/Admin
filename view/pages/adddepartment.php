<?php
$_SESSION["title"] = "Department";
?>
<?php include 'view/partials/_subheader/subheader-v1.php'; ?>

<form id="AddDepartmentFormSubmit" name="AddDepartmentFormSubmit" action="index.php?page=departmentlist" method="post">
  <div id="AddDepartmentModal" tabindex="-1" aria-labelledby="AddDepartmentModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="AddDepartmentModalLabel">Add Department</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="form-group row">
            <label for="staticStaffNo" class="col-sm-2 col-form-label">New Department</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="staticStaffNo" name="txtdepartment" oninput="let p=this.selectionStart;this.value=this.value.toUpperCase();this.setSelectionRange(p, p);">
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-success" name="AddDepartmentFormSubmit">Save changes</button>
        </div>
    </div>
  </div>
</div>
</form>