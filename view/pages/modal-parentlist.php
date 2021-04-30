<form id="AddParentFormSubmit" name="AddParentFormSubmit" action="index.php?page=modal-recheckparentlist" method="post">
  <div class="modal fade" id="recheckaddparent" tabindex="-1" aria-labelledby="AddParentModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="AddParentModalLabel">Add Parent</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="form-group row">
            <label for="staticStaffNo" class="col-sm-2 col-form-label">MyKad Parent</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="staticStaffNo" name="txtConsumerIDNo">
            </div>
          </div>
          <div class="form-group row">
            <label for="staticStaffNo" class="col-sm-2 col-form-label">MyKad Child</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="staticStaffNo" name="txtConsumerIDNoChild">
            </div>
          </div> 
          <div class="form-group row">
            <label for="txtclasscategory" class="col-sm-2 col-form-label">Class</label>
            <div class="col-sm-10">
              <select class="form-control" id="sltStatus" name="txtClasscategory" >
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
                <option value="6">6</option>
              </select>
            </div>
          </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-secondary" name="AddParentFormSubmit">Re-Checking</button>
        </div>
        </div>
      </div>
    </div>
  </div>
</form>

<form id="EditParentFormSubmit" name="EditParentFormSubmit" action="index.php?page=modal-recheckparentlist" method="post">
  <div class="modal fade" id="RecheckEditParent" tabindex="-1" aria-labelledby="EditParentModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="EditParentModalLabel">Edit Parent</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <input type="hidden" class="form-control" name="txtConsumerIDNo">
          <div class="form-group row">
            <label for="staticStaffNo" class="col-sm-2 col-form-label">ID Child</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="staticStaffNo" name="txtConsumerIDNoChild">
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button"  class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-secondary" name="EditParentFormSubmit">Edit</button>
        </div>
    </div>
  </div>
</div>
</form>

<br><br><form name="StatusParentFormSubmit" action="index.php?page=parentlist" method="post">
  <div class="modal fade" id="StatusParentModal" tabindex="-1" aria-labelledby="StatusParentModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h1>Account Activation/Deactivation</h1>
        </div>
        <div class="modal-body">
          <p>Are you sure you want to active/deactive this account?</p>
          <input type="hidden" class="form-control" name="txtparentid">
          <!--Change Status-->
          <div class="form-group row">
            <label for="txtStaffdepartment" class="col-sm-2 col-form-label">Status</label>
            <div class="col-sm-10">
              <select class="form-control" name="txtparentStatus" >
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
          <button type="submit" class="btn btn-secondary" name="StatusParentFormSubmit">Confirm</button>
        </div>
    </div>
  </div>
</div>
</form>