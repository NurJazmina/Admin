<form id="AddStudentFormSubmit" name="AddStudentFormSubmit" action="index.php?page=modal-recheckstudentlist" method="post">
  <div class="modal fade" id="recheckaddstudent" tabindex="-1" aria-labelledby="AddStudentModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="AddStudentModalLabel">Add Student</h5>
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
          <button type="submit" class="btn btn-secondary" name="AddStudentFormSubmit">Re-Checking</button>
        </div>
        </div>
      </div>
    </div>
  </div>
</form>

<br><br><form id="EditStudentFormSubmit" name="EditStudentFormSubmit" action="index.php?page=modal-recheckstudentlist" method="post">
  <div class="modal fade" id="recheckeditstudent" tabindex="-1" aria-labelledby="EditStudentModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="EditStudentModalLabel">Edit Staff</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <input type="hidden" class="form-control" name="studentid">
          <div class="form-group row">
            <label for="staticStaffNo" class="col-sm-2 col-form-label">Class Category</label>
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
        </div>
        <div class="modal-footer">
          <button type="button"  class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-secondary" name="EditStudentFormSubmit">Edit</button>
        </div>
    </div>
  </div>
</div>
</form>

<br><br><form name="StatusStudentFormSubmit" action="index.php?page=studentlist" method="post">
  <div class="modal fade" id="StatusStudentModal" tabindex="-1" aria-labelledby="StatusStudentodalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h1>Account Activation/Deactivation</h1>
        </div>
        <div class="modal-body">
          <p>Are you sure you want to active/deactive this account?</p>
          <input type="hidden" class="form-control" name="txtstudentid">
          <!--Change Status-->
          <div class="form-group row">
            <label for="txtStaffdepartment" class="col-sm-2 col-form-label">Status</label>
            <div class="col-sm-10">
              <select class="form-control" name="txtStudentStatus" >
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
          <button type="submit" class="btn btn-secondary" name="StatusStudentFormSubmit">Confirm</button>
        </div>
    </div>
  </div>
</div>
</form>
