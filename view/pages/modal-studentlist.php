<form name="recheck_add_student" action="index.php?page=modal-recheck_student" method="post">
  <div class="modal fade" id="add_student">
    <div class="modal-dialog modal-md modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Add Student</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="form-group row">
              <label class="col-sm-3 col-form-label">Parent ID</label>
              <div class="col-sm-9">
                <input type="text" class="form-control" name="parent_idno" oninput="let p=this.selectionStart;this.value=this.value.toUpperCase();this.setSelectionRange(p, p);" required>
              </div>
          </div>
          <div class="form-group row">
              <label class="col-sm-3 col-form-label">Child ID</label>
              <div class="col-sm-9">
                <input type="text" class="form-control" name="student_idno" oninput="let p=this.selectionStart;this.value=this.value.toUpperCase();this.setSelectionRange(p, p);" required>
              </div>
          </div>
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
          <button type="button" class="btn btn-light btn-hover-success btn-sm" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-success btn-hover-light btn-sm" name="recheck_add_student">Confirm</button>
        </div>
        </div>
    </div>
  </div>
</form>

<form name="recheck_edit_student" action="index.php?page=modal-recheck_student" method="post">
  <div class="modal fade" id="edit_student" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Edit Student</h5>
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
          <button type="submit" class="btn btn-success btn-hover-light btn-sm" name="recheck_edit_student">Edit</button>
        </div>
      </div>
    </div>
  </div>
</form>

<form name="status_student" action="index.php?page=studentlist" method="post">
  <div class="modal fade" id="status_student" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="text-danger"><i class="flaticon2-information icon-md text-danger"></i>&nbsp;&nbsp;Account Activation/Deactivation</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <p>Are you sure you want to active/deactive this account?</p>
          <input type="hidden" class="form-control" name="student_consumer_id">
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
          <button type="submit" class="btn btn-success btn-hover-light btn-sm" name="status_student">Confirm</button>
        </div>
      </div>
    </div>
  </div>
</form>


<form name="status_parent" action="index.php?page=parentlist" method="post">
  <div class="modal fade" id="status_parent" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="text-danger"><i class="flaticon2-information icon-md text-danger"></i>&nbsp;&nbsp;Account Activation/Deactivation</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <p>Are you sure you want to active/deactive this account?</p>
          <input type="hidden" class="form-control" name="parent_consumer_id">
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
          <button type="submit" class="btn btn-success btn-hover-light btn-sm" name="status_parent">Confirm</button>
        </div>
      </div>
    </div>
  </div>
</form>