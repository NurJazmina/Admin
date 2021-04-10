<form id="AddDepartmentFormSubmit" name="AddDepartmentFormSubmit" action="model/updatedepartmentlist.php" method="post">
  <div class="modal fade" id="AddDepartmentModal" tabindex="-1" aria-labelledby="AddDepartmentModalLabel" aria-hidden="true">
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
          <button type="submit" class="btn btn-secondary" name="AddDepartmentFormSubmit">Save changes</button>
        </div>
    </div>
  </div>
</div>
</form>

<form id="EditDepartmentFormSubmit"  name="EditDepartmentFormSubmit" action="model/updatedepartmentlist.php" method="post">
  <div class="modal fade" id="EditDepartmentModal" tabindex="-1" aria-labelledby="EditDepartmentModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h1>Edit Department</h1>
        </div>
        <div class="modal-body">
          <input type="hidden" class="form-control" name="txtdepartmentid">
          <div class="form-group row">
            <label for="staticStaffNo" class="col-sm-3 col-form-label">Department Name</label>
            <div class="col-sm-9">
              <input type="text" class="form-control" name="txtdepartmentname" oninput="let p=this.selectionStart;this.value=this.value.toUpperCase();this.setSelectionRange(p, p);"> 
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button"  class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-secondary" name="EditDepartmentFormSubmit">Confirm</button>
        </div>
    </div>
  </div>
</div>
</form>

<form id="DeleteDepartmentFormSubmit"  name="DeleteDepartmentFormSubmit" action="model/updatedepartmentlist.php" method="post">
  <div class="modal fade" id="DeleteDepartmentModal" tabindex="-1" aria-labelledby="DeleteDepartmentModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h1>Delete Department</h1>
        </div>
        <div class="modal-body">
          <p>Are you sure you want to delete this Department?</p>
          <input type="hidden" class="form-control" name="txtdepartmentid">
        </div>
        <div class="modal-footer">
          <button type="button"  class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-secondary" name="DeleteDepartmentFormSubmit">Confirm</button>
        </div>
    </div>
  </div>
</div>
</form>
