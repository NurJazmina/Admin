<form id="AddSubjectFormSubmit" name="AddSubjectFormSubmit" action="index.php?page=subjectlist" method="post">
  <div class="modal fade" id="AddSubjectModal" tabindex="-1" aria-labelledby="AddSubjectModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="AddSubjectModalLabel">Add Subject</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="form-group row">
            <label for="staticStaffNo" class="col-sm-2 col-form-label">New Subject</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="staticStaffNo" name="txtsubject" oninput="let p=this.selectionStart;this.value=this.value.toUpperCase();this.setSelectionRange(p, p);">
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-secondary" name="AddSubjectFormSubmit">Save changes</button>
        </div>
    </div>
  </div>
</div>
</form>

<form id="EditSubjectFormSubmit"  name="EditSubjectFormSubmit" action="index.php?page=subjectlist" method="post">
  <div class="modal fade" id="EditSubjectModal" tabindex="-1" aria-labelledby="EditsubjectModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h1>Edit Subject</h1>
        </div>
        <div class="modal-body">
          <input type="hidden" class="form-control" name="txtsubjectid">
          <div class="form-group row">
            <label for="staticStaffNo" class="col-sm-3 col-form-label">Subject</label>
            <div class="col-sm-9">
              <input type="text" class="form-control" name="txtsubjectname" oninput="let p=this.selectionStart;this.value=this.value.toUpperCase();this.setSelectionRange(p, p);">
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button"  class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-secondary" name="EditSubjectFormSubmit">Confirm</button>
        </div>
    </div>
  </div>
</div>
</form>

<form id="DeleteSubjectFormSubmit"  name="DeleteSubjectFormSubmit" action="index.php?page=subjectlist" method="post">
  <div class="modal fade" id="DeleteSubjectModal" tabindex="-1" aria-labelledby="DeleteSubjectModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h1>Delete Subject</h1>
        </div>
        <div class="modal-body">
          <p>Are you sure you want to delete this Subject?</p>
          <input type="hidden" class="form-control" name="txtsubjectid">
        </div>
        <div class="modal-footer">
          <button type="button"  class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-secondary" name="DeleteSubjectFormSubmit">Confirm</button>
        </div>
    </div>
  </div>
</div>
</form>   