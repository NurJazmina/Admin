<?php
$_SESSION["title"] = "Staff";
include 'view/partials/_subheader/subheader-v1.php'; 
?>
<form name="recheck_add_staff" action="index.php?page=modal-recheck_staff" method="post">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
          <h5 class="modal-title">Add Staff</h5>
      </div>
      <div class="modal-body">
          <div class="form-group">
              <div class="alert alert-light-primary staff_level-none mb-15" role="alert">
                  <div class="alert-icon">
                      <i class="la la-warning"></i>
                  </div>
                  <div class="alert-text font-weight-bold">
                      Oh snap! Change a few things up and try submitting again.
                  </div>
                  <div class="alert-close">
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span><i class="ki ki-close "></i></span>
                      </button>
                  </div>
              </div>
          </div>
          <div class="form-group row">
              <label class="col-sm-2 col-form-label">Staff ID</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" name="consumer_idno" oninput="let p=this.selectionStart;this.value=this.value.toUpperCase();this.setSelectionRange(p, p);" required>
              </div>
          </div>
          <div class="form-group row">
              <label class="col-sm-2 col-form-label">Department</label>
              <div class="col-sm-10">
                <select class="form-control" name="department_id">
                  <?php
                  $filter = ['School_id'=>$_SESSION["loggeduser_schoolID"]];
                  $query = new MongoDB\Driver\Query($filter);
                  $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.SchoolsDepartment',$query);
                  foreach ($cursor as $document)
                  {
                    $id = strval($document->_id);
                    $DepartmentName = $document->DepartmentName;
                    ?>
                    <option value="<?=$id?>"><?=$DepartmentName?></option>
                    <?php
                  }
                  ?>
                </select>
              </div>
          </div>
          <div class="form-group row">
              <label class="col-sm-2 col-form-label">Staff Level</label>
              <div class="col-sm-10">
                <select class="form-control" name="staff_level" id="staff_level" onchange="select_staff_level(this.value);">
                  <option value="1">STAFF</option>
                  <option value="0">TEACHER</option>
                </select>
              </div>
          </div>
          <div id="teacher_box">
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Class category</label>
                <div class="col-sm-10">
                  <select class="form-control" name="class_category">
                    <option value="" selected>NULL</option>
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
      </div>
      <div class="modal-footer">
          <button type="reset"  class="btn btn-light btn-hover-success btn-sm">Cancel</button>
          <button type="submit" class="btn btn-success btn-hover-light btn-sm" name="recheck_add_staff">Confirm</button>
      </div>
    </div>
  </div>
</form>
<script>
function select_staff_level() {
  var staff_level = document.getElementById("staff_level").value;
  var teacher_box = document.getElementById("teacher_box");
  if(staff_level == "0")
    teacher_box.style.display = "block";
  else
    teacher_box.style.display = "none";
}
select_staff_level();
</script>