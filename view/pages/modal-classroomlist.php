<form  id="AddclassFormSubmit" name="AddclassFormSubmit" action="index.php?page=modal-recheckclassroomlist" method="post">
  <div class="modal fade" id="recheckaddclass" tabindex="-1" aria-labelledby="AddclassModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="AddclassModalLabel">Add Class</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="form-group row">
            <label for="staticStaffNo" class="col-sm-2 col-form-label">Teacher ID</label>
            <div class="col-sm-10">
              <select class="form-control" id="txtteachername" name="txtconsumerid">
                <?php
                $filter = ['SchoolID'=>$_SESSION["loggeduser_schoolID"], 'StaffLevel'=>'0'];
                $query = new MongoDB\Driver\Query($filter);
                $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Staff',$query);
                foreach ($cursor as $document)
                {
                  $ConsumerID = strval($document->ConsumerID);
                  $id = new \MongoDB\BSON\ObjectId($ConsumerID);
                  $filter1 = ['_id'=>$id];
                  $query1 = new MongoDB\Driver\Query($filter1);
                  $cursor1 = $GoNGetzDatabase->executeQuery('GoNGetz.Consumer',$query1);
                  foreach ($cursor1 as $document1)
                  {
                    $ConsumerFName = strval($document1->ConsumerFName);
                    ?>
                    <option value="<?=($document1->_id)?>"><?=($document1->ConsumerFName)?></option>
                    <?php
                  }
                }
                ?>
              </select>
            </div>
          </div>
          <div class="form-group row">
            <label for="staticStaffNo" class="col-sm-2 col-form-label">Class Category</label>
            <div class="col-sm-10">
              <select class="form-control" id="sltStatus" name="txtClasscategory" style="height: auto; width: 70%">
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
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary" name="AddclassFormSubmit">Re-Checking</button>
        </div>
      </div>
    </div>
  </div>
</form>

<br><br><form id="EditclassFormSubmit"  name="EditclassFormSubmit" action="index.php?page=modal-recheckclassroomlist" method="post">
  <div class="modal fade" id="recheckeditclass" tabindex="-1" aria-labelledby="EditclassModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="EditclassModalLabel">Edit Class</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <input type="hidden" class="form-control" name="txtclassid">
          <div class="form-group row">
            <label for="staticStaffNo" class="col-sm-2 col-form-label">Class Category</label>
            <div class="col-sm-10">
              <select class="form-control" id="sltStatus" name="txtClasscategory" style="height: auto; width: 70%">
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
          <button type="button"  class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary" name="EditclassFormSubmit">Edit</button>
        </div>
    </div>
  </div>
</div>
</form>

<br><br><form name="DeleteclassFormSubmit" action="index.php?page=classroomlist" method="post">
  <div class="modal fade" id="DeleteclassModal" tabindex="-1" aria-labelledby="DeleteclassModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h1>Delete Account</h1>
        </div>
        <div class="modal-body">
          <p>Are you sure you want to delete this account?</p>
          <input type="hidden" class="form-control" name="txtclassid">
        </div>
        <div class="modal-footer">
          <button type="button"  class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-secondary" name="DeleteclassFormSubmit">Confirm</button>
        </div>
    </div>
  </div>
</div>
</form>   