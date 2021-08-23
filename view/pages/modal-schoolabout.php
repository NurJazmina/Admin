<form name="EditSchoolFormSubmit" action="index.php?page=schoolabout" method="post">
  <div class="modal fade" id="EditSchoolModal" tabindex="-1" aria-labelledby="EditSchoolModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Edit School</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="form-group row">
            <label class="col-sm-2 col-form-label">School Phone</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="txtSchoolsPhoneNo">
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <input type="hidden" name="schoolname" value="<?=$schoolname?>">
          <button type="button" class="btn btn-light btn-sm" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-success btn-sm" name="EditSchoolFormSubmit">Save changes</button>
        </div>
    </div>
  </div>
</form>