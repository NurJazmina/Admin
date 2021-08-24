<form id="AddDepartment" name="AddDepartment" action="index.php?page=departmentlist" method="post">
  <div class="modal fade" id="AddDepartmentModal" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Add Department</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
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
          <button type="button" class="btn btn-light btn-sm" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-success btn-sm" name="AddDepartment">Save changes</button>
        </div>
      </div>
    </div>
  </div>
</form>

<form id="EditDepartment"  name="EditDepartment" action="index.php?page=departmentlist" method="post">
  <div class="modal fade" id="EditDepartmentModal" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Edit Department</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <input type="hidden" class="form-control" name="department_id">
          <div class="form-group row">
            <label class="col-sm-3 col-form-label">Department</label>
            <div class="col-sm-9">
              <input type="text" class="form-control" name="department_name" oninput="let p=this.selectionStart;this.value=this.value.toUpperCase();this.setSelectionRange(p, p);"> 
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button"  class="btn btn-light btn-sm" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-success btn-sm" name="EditDepartment">Confirm</button>
        </div>
      </div>
    </div>
  </div>
</form>

<form id="DeleteDepartment"  name="DeleteDepartment" action="index.php?page=departmentlist" method="post">
  <div class="modal fade" id="DeleteDepartmentModal" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Delete Department</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <p>Are you sure you want to delete this Department?</p>
          <input type="hidden" class="form-control" name="department_id">
        </div>
        <div class="modal-footer">
          <button type="button"  class="btn btn-light btn-sm" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-success btn-sm" name="DeleteDepartment">Confirm</button>
        </div>
      </div>
    </div>
  </div>
</form>