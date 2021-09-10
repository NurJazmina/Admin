<form name="edit_school" action="index.php?page=schoolabout" method="post">
  <div class="modal fade" id="edit_school">
    <div class="modal-dialog modal-md modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Edit School</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="form-group row">
            <label class="col-sm-3 col-form-label">Phone number</label>
            <div class="col-sm-9">
              <input type="text" class="form-control" name="no_phone">
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <input type="hidden" name="schoolname" value="<?=$schoolname?>">
          <button type="button" class="btn btn-light btn-sm" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-success btn-sm" name="edit_school">Save changes</button>
        </div>
    </div>
  </div>
</form>