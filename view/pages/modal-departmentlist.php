<form name="add_department" action="index.php?page=departmentlist" method="post">
  <div class="modal fade" id="add_department" aria-hidden="true">
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
          <button type="submit" class="btn btn-success btn-sm" name="add_department">Save changes</button>
        </div>
      </div>
    </div>
  </div>
</form>

<form  name="edit_department" action="index.php?page=departmentlist" method="post">
  <div class="modal fade" id="edit_department" aria-hidden="true">
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
          <button type="submit" class="btn btn-success btn-sm" name="edit_department">Confirm</button>
        </div>
      </div>
    </div>
  </div>
</form>

<form  name="delete_department" action="index.php?page=departmentlist" method="post">
  <div class="modal fade" id="delete_department" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Delete Department</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <a>To delete the&nbsp;&nbsp;<i class="flaticon-warning-sign icon-md text-danger"></i>&nbsp;&nbsp;<b>department</b> type your <b>password</b>.</a><br>
          <input type="hidden" class="form-control" name="department_id">
          <input type="password" class="form-control" name="password" placeholder="Password">
        </div>
        <div class="modal-footer">
          <button type="button"  class="btn btn-light btn-sm" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-success btn-sm" name="delete_department">Delete</button>
        </div>
      </div>
    </div>
  </div>
</form>