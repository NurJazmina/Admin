<form name="Add_staff" action="index.php?page=modal-recheck_staff" method="post">
  <div class="modal fade"  id="add_staff" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Add Staff</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="form-group row">
                <label class="col-sm-3 col-form-label">Staff ID</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" name="consumer_idno" oninput="let p=this.selectionStart;this.value=this.value.toUpperCase();this.setSelectionRange(p, p);" required>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-3 col-form-label">Department</label>
                <div class="col-sm-9">
                  <select class="form-control" name="department_id">
                    <?php
                    $filter = ['School_id'=>$_SESSION["loggeduser_schoolID"]];
                    $query = new MongoDB\Driver\Query($filter);
                    $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.SchoolsDepartment',$query);
                    foreach ($cursor as $document)
                    {
                      $id = strval($document->_id);
                      $DepartmentName = strval($document->DepartmentName);
                      ?>
                      <option value="<?=$id?>"><?=$DepartmentName?></option>
                      <?php
                    }
                    ?>
                  </select>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-3 col-form-label">Staff Level</label>
                <div class="col-sm-9">
                  <select class="form-control" name="staff_level" id="staff_level" onchange="select_staff_level(this.value);">
                    <option value="1">STAFF</option>
                    <option value="0">TEACHER</option>
                  </select>
                </div>
            </div>
            <div id="teacher_box">
              <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Class category</label>
                  <div class="col-sm-9">
                    <select class="form-control" name="class_category">
                      <option value="" selected>NULL</option>
                      <option value="1">1</option>
                      <option value="3">3</option>
                      <option value="3">3</option>
                      <option value="4">4</option>
                      <option value="5">5</option>
                      <option value="6">6</option>
                    </select>
                  </div>
              </div>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-light btn-hover-success btn-sm" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-success btn-hover-light btn-sm" name="Add_staff">Confirm</button>
        </div>
        </div>
    </div>
  </div>
</form>
<script>
  function select_staff_level() {
    var staff_level = document.getElementById("staff_level").value;
    var teacher = document.getElementById("teacher_box");
    if(staff_level == "0")
      teacher.style.display = "block";
    else
      teacher.style.display = "none";
  }
  select_staff_level();
</script>

<form id="Edit_staff" name="Edit_staff" action="index.php?page=modal-recheck_staff" method="post">
  <div class="modal fade" id="edit_staff" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Edit Teacher</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <input type="hidden" class="form-control" name="consumer_id">
          <div class="form-group row">
            <label class="col-sm-3 col-form-label">Class Category</label>
            <div class="col-sm-9">
              <select class="form-control" name="class_category">
                <option value="1">1</option>
                <option value="3">3</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
                <option value="6">6</option>
              </select>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button"  class="btn btn-light btn-hover-success btn-sm" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-success btn-hover-light btn-sm" name="Edit_staff">Edit</button>
        </div>
      </div>
    </div>
  </div>
</form>

<form name="Status_staff" action="index.php?page=stafflist" method="post">
  <div class="modal fade" id="status_staff" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5>Account Activation/Deactivation</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <p>Are you sure you want to active/deactive this account?</p>
          <input type="hidden" class="form-control" name="staff_id">
          <!--Change Status-->
          <div class="form-group row">
            <label class="col-sm-3 col-form-label">Status</label>
            <div class="col-sm-9">
              <select class="form-control" name="status">
                <option value="ACTIVE">ACTIVATE</option>
                <option value="INACTIVE">DEACTIVATE</option>
              </select>
            </div>
          </div>
          <!--Reason-->
          <div class="form-group row">
            <label class="col-sm-3 col-form-label">Reason</label>
            <div class="col-sm-9">
              <input type="text" class="form-control" name="detail" required>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button"  class="btn btn-light btn-hover-success btn-sm" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-success btn-hover-light btn-sm" name="Status_staff">Confirm</button>
        </div>
    </div>
  </div>
</div>
</form>
