<form id="Addclass" name="Addclass" action="index.php?page=modal-recheckclassroomlist" method="post">
  <div class="modal fade" id="recheckaddclass" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="AddclassModalLabel">Add Class</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="form-group row">
            <label class="col-sm-2 col-form-label">Teacher ID</label>
            <div class="col-sm-10">
              <select class="form-control" name="consumer_id">
                <?php
                $filter = ['SchoolID'=>$_SESSION["loggeduser_schoolID"], 'StaffLevel'=>'0'];
                $query = new MongoDB\Driver\Query($filter);
                $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Staff',$query);
                foreach ($cursor as $document)
                {
                  $ConsumerID = $document->ConsumerID;

                  $filter = ['_id'=>new \MongoDB\BSON\ObjectId($ConsumerID)];
                  $query = new MongoDB\Driver\Query($filter);
                  $cursor = $GoNGetzDatabase->executeQuery('GoNGetz.Consumer',$query);
                  foreach ($cursor as $document1)
                  {
                    $consumer_id = $document1->_id;
                    $ConsumerFName = $document1->ConsumerFName;
                    ?>
                    <option value="<?= $consumer_id; ?>"><?= $ConsumerFName; ?></option>
                    <?php
                  }
                }
                ?>
              </select>
            </div>
          </div>
          <div class="form-group row">
            <label class="col-sm-2 col-form-label">Class Category</label>
            <div class="col-sm-10">
              <select class="form-control" name="class_category">
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
          <button type="submit" class="btn btn-success btn-sm" name="Addclass">Re-Checking</button>
        </div>
      </div>
    </div>
  </div>
</form>

<form id="Editclass"  name="Editclass" action="index.php?page=modal-recheckclassroomlist" method="post">
  <div class="modal fade" id="recheckeditclass" tabindex="-1" aria-labelledby="EditclassModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Edit Class</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <input type="hidden" name="class_id">
          <div class="form-group row">
            <label class="col-sm-3 col-form-label">Number of Subject</label>
            <div class="col-sm-9">
              <input type="number" class="form-control" name="number">
            </div>
          </div>
          <div class="form-group row">
            <label class="col-sm-3 col-form-label">Class Category</label>
            <div class="col-sm-9">
              <select class="form-control" name="class_category">
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
          <button type="button"  class="btn btn-light btn-sm" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-success btn-sm" name="Editclass">Edit</button>
        </div>
      </div>
    </div>
  </div>
</form>

<form name="Deleteclass" action="index.php?page=classroomlist" method="post">
  <div class="modal fade" id="DeleteclassModal" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5>Delete Account</h5>
        </div>
        <div class="modal-body">
          <p>Are you sure you want to delete this account?</p>
          <input type="hidden" class="form-control" name="class_id">
        </div>
        <div class="modal-footer">
          <button type="button"  class="btn btn-light btn-sm" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-success btn-sm" name="Deleteclass">Confirm</button>
        </div>
      </div>
    </div>
  </div>
</form>   