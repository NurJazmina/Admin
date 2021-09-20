<form  name="edit_calendar" action="index.php?page=personal_calendar" method="post">
  <div class="modal fade" id="edit_calendar">
    <div class="modal-dialog modal-md modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Edit Calendar</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <input type="hidden" name="calendar_id">
            <div class="form-group row">
                <label class="col-sm-3 col-form-label">Title</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control form-control-sm" name="title" oninput="let p=this.selectionStart;this.value=this.value.toUpperCase();this.setSelectionRange(p, p);" placeholder="Enter new to do" required>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-3 col-form-label">Detail</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control form-control-sm" name="detail" placeholder="description" required>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-3 col-form-label">Venue</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control form-control-sm" name="venue" placeholder="Location" required>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-3 col-form-label">Color</label>
                <div class="col-sm-9">
                    <select class="form-control form-control-sm" name="color" required>
                        <option value="yellow" selected>Yellow</option>
                        <option value="green">Green</option>
                        <option value="blue">Blue</option>
                        <option value="red">Red</option>
                        <option value="red">Mint</option>
                        <option value="indigo">Indigo</option>
                        <option value="frozen">Frozen</option>
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-3 col-form-label">Date Start</label>
                <div class="col-sm-9">
                    <input type="datetime-local" class="form-control form-control-sm" name="date_start" placeholder="Select date" value="<?= $default_date; ?>" required>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-3 col-form-label">Date End</label>
                <div class="col-sm-9">
                    <input type="datetime-local" class="form-control form-control-sm" name="date_end" placeholder="Select date" value="<?= $default_date; ?>" required>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button"  class="btn btn-light btn-sm" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-success btn-sm" name="edit_calendar">Edit</button>
        </div>
      </div>
    </div>
  </div>
</form>

<form name="delete_calendar" action="index.php?page=classroomlist" method="post">
  <div class="modal fade" id="delete_calendar">
    <div class="modal-dialog modal-md modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5>Delete Account</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <a>To delete the&nbsp;&nbsp;<i class="flaticon-warning-sign icon-md text-danger"></i>&nbsp;&nbsp;<b>Calendar</b> type your <b>password</b>.</a><br>
          <input type="hidden" name="calendar_id">
          <input type="password" class="form-control" name="password" placeholder="Password">
        </div>
        <div class="modal-footer">
          <button type="button"  class="btn btn-light btn-sm" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-success btn-sm" name="delete_calendar">Confirm</button>
        </div>
      </div>
    </div>
  </div>
</form>   