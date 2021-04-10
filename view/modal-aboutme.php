<?php $consumerid = $_SESSION["loggeduser_id"]; ?>
<br>
<br>
<form name="EditDetailFormSubmit" action="model/updateaboutme.php" method="post">
  <div class="modal fade" id="EditDetailModal" tabindex="-1" aria-labelledby="EditDetailModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="EditDetailModalLabel">Edit Detail</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="form-group row">
            <label for="staticStaffNo" class="col-sm-2 col-form-label">First Name</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="staticStaffNo" name="txtConsumerFName" value="<?=$_SESSION["loggeduser_consumerFName"]?>" style="text-transform:uppercase">
            </div>
          </div>
          <div class="form-group row">
            <label for="staticStaffNo" class="col-sm-2 col-form-label">Last Name</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="staticStaffNo" name="txtConsumerLName" value="<?=$_SESSION["loggeduser_consumerLName"]?>" style="text-transform:uppercase">
            </div>
          </div>
          <div class="form-group row">
            <label for="staticStaffNo" class="col-sm-2 col-form-label">ID Type</label>
            <div class="col-sm-10">
              <select class="form-control" id="staticStaffNo" name="txtConsumerIDType" value="<?=$_SESSION["loggeduser_consumerIDType"] ?>">
                <option value="MYKAD">MyKad</option>
                <option value="MYKAS">MyKas</option>
                <option value="MYPR">MyPr</option>
                <option value="KAD POLIS">Kad Polis</option>
                <option value="KAD TENTERA">Kad Tentera</option>
                <option value="PASSPORT">Passport</option>
              </select>
            </div>
          </div>
          <div class="form-group row">
            <label for="staticStaffNo" class="col-sm-2 col-form-label">ID Number</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="staticStaffNo" name="txtConsumerIDNo" value="<?=$_SESSION["loggeduser_consumerIDNo"]?>">
            </div>
          </div>
          <div class="form-group row">
            <label for="staticStaffNo" class="col-sm-2 col-form-label">Phone Number</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="staticStaffNo" name="txtConsumerPhone" value="<?=$_SESSION["loggeduser_consumerPhone"]?>">
            </div>
          </div>
          <div class="form-group row">
            <label for="staticStaffNo" class="col-sm-2 col-form-label">Address</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="staticStaffNo" name="txtConsumerAddress" value="<?=$_SESSION["loggeduser_consumerAddress"]?>" style="text-transform:uppercase">
            </div>
          </div>
          <div class="form-group row">
            <label for="staticStaffNo" class="col-sm-2 col-form-label">Email</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="staticStaffNo" name="txtConsumerEmail" value="<?=$_SESSION["loggeduser_consumerEmail"]?>">
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-secondary" name="EditDetailFormSubmit">Save changes</button>
        </div>
    </div>
  </div>
</div>
</form>