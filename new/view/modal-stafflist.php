<form id="AddStaffFormSubmit" name="AddStaffFormSubmit" action="index.php?page=recheckstafflist" method="post">
  <div class="modal fade" id="recheckaddstaff" tabindex="-1" aria-labelledby="AddStaffModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="AddStaffModalLabel">Add Staff</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <!--Add staff-->
          <div class="form-group row">
            <label for="txtteacherclass" class="col-sm-2 col-form-label">Staff</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="staticStaffNo" name="txtConsumerIDNo" >
            </div>
          </div>
          <!--Add department-->
          <div class="form-group row">
            <label for="txtStaffdepartment" class="col-sm-2 col-form-label">Department</label>
            <div class="col-sm-10">
              <select class="form-control" id="txtStaffdepartment" name="txtStaffdepartment" onchange="SelecttxtStaffdepartment(this.value);">
                <?php
                $filter = ['School_id'=>$_SESSION["loggeduser_schoolID"]];
                $query = new MongoDB\Driver\Query($filter);
                $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.SchoolsDepartment',$query);
                foreach ($cursor as $document)
                {
                  $id = strval($document->_id);
                  $DepartmentName = strval($document->DepartmentName);
                  ?>
                  <option value="<?=$DepartmentName?>"><?=$DepartmentName?></option>
                  <?php
                }
                ?>
              </select>
            </div>
          </div>
          <div id="teacherbox">
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
          </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-secondary" name="AddStaffFormSubmit">Re-Checking</button>
        </div>
        </div>
      </div>
    </div>
  </div>
</form>
<script>
    function SelecttxtStaffdepartment() {
      var d = document.getElementById("txtStaffdepartment").value;
      var dTypeA = document.getElementById("teacherbox");
      if(d == "TEACHER")
        dTypeA.style.display = "block";
      else
        dTypeA.style.display = "none";
    }
    SelecttxtStaffdepartment();
</script>

<br><br><form id="EditStaffFormSubmit"  name="EditStaffFormSubmit" action="index.php?page=recheckstafflist" method="post">
  <div class="modal fade" id="recheckeditstaff" tabindex="-1" aria-labelledby="EditStaffModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="EditStaffModalLabel">Edit Teacher</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <input type="hidden" class="form-control" name="teacherid">
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
          <button type="submit" class="btn btn-secondary" name="EditStaffFormSubmit">Edit</button>
        </div>
    </div>
  </div>
</div>
</form>

<br><br><form name="StatusStaffFormSubmit" action="index.php?page=stafflist" method="post">
  <div class="modal fade" id="StatusStaffModal" tabindex="-1" aria-labelledby="StatusStaffModalLabel" aria-hidden="true">
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
          <button type="submit" class="btn btn-secondary" name="StatusStaffFormSubmit">Confirm</button>
        </div>
    </div>
  </div>
</div>
</form>
