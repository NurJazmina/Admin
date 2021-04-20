<form name="ChangePasswordFormSubmit" action="model/changepassword.php" method="post">
  <div class="modal fade" id="ChangePasswordModal" tabindex="-1" aria-labelledby="ChangePasswordModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="ChangePasswordModalLabel">Change Password</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="mb-3 row">
            <label class="col-sm-2 col-form-label">Password</label>
            <div class="col-sm-10">
              <input type="password" class="form-control" name="txtPassword">
            </div>
          </div>
          <div class="mb-3 row">
            <div class="col-sm-2"></div>
            <div class="col-sm-10">
              <input type="hidden" name="txtid" value="<?php echo $_SESSION["loggeduser_id"]; ?>">
              <button type="submit" class="btn btn-secondary" name="ChangePasswordFormSubmit">Save changes</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</form>