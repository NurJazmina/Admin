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
