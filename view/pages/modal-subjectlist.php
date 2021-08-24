<form id="AddSubject" name="AddSubject" action="index.php?page=subjectlist" method="post">
  <div class="modal fade" id="AddSubjectModal" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Add Subject</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="form-group row">
            <label class="col-sm-2 col-form-label">New Subject</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="subject_name" oninput="let p=this.selectionStart;this.value=this.value.toUpperCase();this.setSelectionRange(p, p);">
            </div>
          </div>
          <div class="form-group row">
              <label for="txtclasscategory" class="col-sm-2 col-form-label">Class</label>
              <div class="col-sm-10">
                <select class="form-control" id="sltStatus" name="class_category">
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
          <button type="button" class="btn btn-light btn-sm" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-success btn-sm" name="AddSubject">Save changes</button>
        </div>
      </div>
    </div>
  </div>
</form>

<form id="EditSubject"  name="EditSubject" action="index.php?page=subjectlist" method="post">
  <div class="modal fade" id="EditSubjectModal" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Edit Subject</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <input type="hidden" class="form-control" name="subject_id">
          <div class="form-group row">
            <label for="staticStaffNo" class="col-sm-3 col-form-label">Subject</label>
            <div class="col-sm-9">
              <input type="text" class="form-control" name="subject_name" oninput="let p=this.selectionStart;this.value=this.value.toUpperCase();this.setSelectionRange(p, p);">
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button class="btn btn-light btn-sm" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-success btn-sm" name="EditSubject">Confirm</button>
        </div>
      </div>
    </div>
  </div>
</form>

<form id="DeleteSubject" name="DeleteSubject" action="index.php?page=subjectlist" method="post">
  <div class="modal fade" id="DeleteSubjectModal" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Delete Subject</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
        <div class="modal-body">
          <p>Are you sure you want to delete this Subject?</p>
          <input type="hidden" class="form-control" name="subject_id">
        </div>
        <div class="modal-footer">
          <button class="btn btn-light btn-sm" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-success btn-sm" name="DeleteSubject">Confirm</button>
        </div>
      </div>
    </div>
  </div>
</form>   