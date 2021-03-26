<form id="DeleteDepartmentFormSubmit"  name="DeleteDepartmentFormSubmit" action="index.php?page=departmentlist" method="post">
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
