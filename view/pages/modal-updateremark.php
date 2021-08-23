<form name="UpdatedepartmentRemark" action="model/updatedepartmentremark.php" method="post">
  <div class="modal fade" id="Updatedepartmentremark" tabindex="-1" aria-labelledby="UpdatedepartmentModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Status Remark</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <p>Are you sure you want to change this status?</p>
          <input type="hidden" class="form-control" name="id">
          <!--Change Status-->
          <div class="form-group row">
            <label class="col-sm-2 col-form-label">Status</label>
            <div class="col-sm-10">
              <select class="form-control" name="status">
                <option value="ACTIVE">ACTIVE</option>
                <option value="PENDING">PENDING</option>
                <option value="COMPLETED">COMPLETED</option>
              </select>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button"  class="btn btn-light btn-sm" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-success btn-sm" name="UpdatedepartmentRemark">Confirm</button>
        </div>
    </div>
  </div>
</form>

<form name="UpdateStaffRemark" action="model/updatestaffremark.php" method="post">
  <div class="modal fade" id="UpdateStaffremark" tabindex="-1" aria-labelledby="UpdateStaffModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h1>Status Remark</h1>
        </div>
        <div class="modal-body">
          <p>Are you sure you want to change this status?</p>
          <input type="hidden" class="form-control" name="id">
          <!--Change Status-->
          <div class="form-group row">
            <label class="col-sm-2 col-form-label">Status</label>
            <div class="col-sm-10">
              <select class="form-control" name="status">
                <option value="ACTIVE">ACTIVE</option>
                <option value="PENDING">PENDING</option>
                <option value="COMPLETED">COMPLETED</option>
              </select>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button"  class="btn btn-light btn-sm" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-success btn-sm" name="UpdateStaffRemark">Confirm</button>
        </div>
    </div>
  </div>
</form>

<form name="UpdateStudentRemark" action="model/updatestudentremark.php" method="post">
  <div class="modal fade" id="Updatestudentremark" tabindex="-1" aria-labelledby="UpdateStudentModalLabel" aria-hidden="true">
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
            <label class="col-sm-2 col-form-label">Status</label>
            <div class="col-sm-10">
              <select class="form-control" name="status">
                <option value="ACTIVE">ACTIVE</option>
                <option value="PENDING">PENDING</option>
                <option value="COMPLETED">COMPLETED</option>
              </select>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button"  class="btn btn-light btn-sm" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-success btn-sm" name="UpdateStudentRemark">Confirm</button>
        </div>
    </div>
  </div>
</form>

<form name="UpdateParentRemark" action="model/updateparentremark.php" method="post">
  <div class="modal fade" id="UpdateParentremark" tabindex="-1" aria-labelledby="UpdateParentModalLabel" aria-hidden="true">
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
            <label class="col-sm-2 col-form-label">Status</label>
            <div class="col-sm-10">
              <select class="form-control" name="status">
                <option value="ACTIVE">ACTIVE</option>
                <option value="PENDING">PENDING</option>
                <option value="COMPLETED">COMPLETED</option>
              </select>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button"  class="btn btn-light btn-sm" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-success btn-sm" name="UpdateParentRemark">Confirm</button>
        </div>
    </div>
  </div>
</form>

<form name="UpdateclassRemark" action="model/updateclassremark.php" method="post">
  <div class="modal fade" id="UpdateClassremark" tabindex="-1" aria-labelledby="UpdateclassModalLabel" aria-hidden="true">
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
            <label class="col-sm-2 col-form-label">Status</label>
            <div class="col-sm-10">
              <select class="form-control" name="status">
                <option value="ACTIVE">ACTIVE</option>
                <option value="PENDING">PENDING</option>
                <option value="COMPLETED">COMPLETED</option>
              </select>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button"  class="btn btn-light btn-sm" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-success btn-sm" name="UpdateclassRemark">Confirm</button>
        </div>
    </div>
  </div>
</form>

<form name="UpdatesubjectRemark" action="model/updatesubjectremark.php" method="post">
  <div class="modal fade" id="Updatesubjectremark" tabindex="-1" aria-labelledby="UpdatesubjectModalLabel" aria-hidden="true">
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
            <label class="col-sm-2 col-form-label">Status</label>
            <div class="col-sm-10">
              <select class="form-control" name="status">
                <option value="ACTIVE">ACTIVE</option>
                <option value="PENDING">PENDING</option>
                <option value="COMPLETED">COMPLETED</option>
              </select>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button"  class="btn btn-light btn-sm" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-success btn-sm" name="UpdatesubjectRemark">Confirm</button>
        </div>
    </div>
  </div>
</form>

