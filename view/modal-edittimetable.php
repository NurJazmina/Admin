
<form id="EditTimetableFormSubmit"  name="EditTimetableFormSubmit"  action="index.php?page=edittimetable" method="post">
  <div class="modal fade" id="recheckedittimetable" tabindex="-1" aria-labelledby="EditTimetableModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="EditTimetableModalLabel">Edit Timetable</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="form-group row">
            <label for="staticStaffNo" class="col-sm-2 col-form-label">Class Category</label>
            <div class="col-sm-10">
              <input type="hidden" id="staticStaffNo" name="txttimetableid">
              <select class="form-control" id="sltStatus" name="txtcategory" >
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
          <button type="submit" class="btn btn-secondary" name="EditTimetableFormSubmit">Edit</button>
        </div>
    </div>
  </div>
</div>
</form>   
