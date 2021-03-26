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

