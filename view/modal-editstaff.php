<br><br><form id="EditStaffFormSubmit"  name="EditStaffFormSubmit" action="index.php?page=editstaff" method="post">
  <div class="modal fade" id="recheckeditstaff" tabindex="-1" aria-labelledby="EditStaffModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="EditStaffModalLabel">Edit Teacher</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <input type="text" class="form-control" name="teacherid">
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
