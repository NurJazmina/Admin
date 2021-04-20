<br><br><form name="UpdatedepartmentRemarkFormSubmit" action="model/updatedepartmentremark.php" method="post">
  <div class="modal fade" id="Updatedepartmentremark" tabindex="-1" aria-labelledby="UpdatedepartmentModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h1>Status Remark</h1>
        </div>
        <div class="modal-body">
          <p>Are you sure you want to change this status?</p>
          <input type="hidden" class="form-control" name="txtremarkid">
          <!--Change Status-->
          <div class="form-group row">
            <label for="staticStaffNo"  class="col-sm-2 col-form-label">Status</label>
            <div class="col-sm-10">
              <select class="form-control" id="staticStaffNo" name="txtdepartmentRemarksStatus">
                <option value="ACTIVE">ACTIVE</option>
                <option value="PENDING">PENDING</option>
                <option value="COMPLETED">COMPLETED</option>
              </select>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button"  class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-secondary" name="UpdatedepartmentRemarkFormSubmit">Confirm</button>
        </div>
    </div>
  </div>
</div>
</form>
