<form id="EditParentFormSubmit" name="EditParentFormSubmit" action="index.php?page=editparent" method="post">
  <div class="modal fade" id="RecheckEditParent" tabindex="-1" aria-labelledby="EditParentModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="EditParentModalLabel">Edit Parent</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <input type="hidden" class="form-control" name="txtConsumerIDNo">
          <div class="form-group row">
            <label for="staticStaffNo" class="col-sm-2 col-form-label">ID Child</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="staticStaffNo" name="txtConsumerIDNoChild">
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button"  class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-secondary" name="EditParentFormSubmit">Edit</button>
        </div>
    </div>
  </div>
</div>
</form>
