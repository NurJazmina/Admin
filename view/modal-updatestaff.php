<br><br><form name="UpdateStaffFormSubmit" action="index.php?page=stafflist" method="post">
  <div class="modal fade" id="UpdateStaffModal" tabindex="-1" aria-labelledby="UpdateStaffModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h1>Account Activation/Deactivation</h1>
        </div>
        <div class="modal-body">
          <p>Are you sure you want to active/deactive this account?</p>
          <input type="hidden" class="form-control" name="txtstaffid">
          <!--Change Status-->
          <div class="form-group row">
            <label for="txtStaffdepartment" class="col-sm-2 col-form-label">Status</label>
            <div class="col-sm-10">
              <select class="form-control" name="txtStaffStatus" >
                <option value="ACTIVE">ACTIVATE</option>
                <option value="INACTIVE">DEACTIVATE</option>
              </select>
            </div>
          </div>
          <!--Reason-->
          <div class="form-group row">
            <label for="staticStaffNo" class="col-sm-2 col-form-label">Reason</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="staticStaffNo" name="txtConsumerRemarksDetails" required>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button"  class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-secondary" name="UpdateStaffFormSubmit">Confirm</button>
        </div>
    </div>
  </div>
</div>
</form>
