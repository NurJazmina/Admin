<form name="recheck_add_class" action="index.php?page=modal-recheck_class" method="post">
  <div class="modal fade" id="add_class">
    <div class="modal-dialog modal-md modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Add Class</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="form-group row">
            <label class="col-sm-3 col-form-label">Teacher ID</label>
            <div class="col-sm-9">
              <select class="form-control" name="consumer_id">
                <?php
                $filter = ['SchoolID'=>$_SESSION["loggeduser_school_id"], 'StaffLevel'=>'0'];
                $query = new MongoDB\Driver\Query($filter);
                $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Staff',$query);
                foreach ($cursor as $document)
                {
                  $ConsumerID = $document->ConsumerID;

                  $filter = ['_id'=>new \MongoDB\BSON\ObjectId($ConsumerID)];
                  $query = new MongoDB\Driver\Query($filter);
                  $cursor = $GoNGetzDatabase->executeQuery('GoNGetz.Consumer',$query);
                  foreach ($cursor as $document)
                  {
                    $consumer_id = strval($document->_id);
                    $ConsumerFName = $document->ConsumerFName;
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
          <button type="button" class="btn btn-light btn-sm" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-success btn-sm" name="recheck_add_class">Re-Checking</button>
        </div>
      </div>
    </div>
  </div>
</form>

<form  name="recheck_edit_class" action="index.php?page=modal-recheck_class" method="post">
  <div class="modal fade" id="edit_class">
    <div class="modal-dialog modal-md modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Edit Class</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <input type="hidden" name="class_id">
          <div class="form-group row">
            <label class="col-sm-3 col-form-label">Total Subject</label>
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
          <button type="submit" class="btn btn-success btn-sm" name="recheck_edit_class">Edit</button>
        </div>
      </div>
    </div>
  </div>
</form>

<form name="delete_class" action="index.php?page=classroomlist" method="post">
  <div class="modal fade" id="delete_class">
    <div class="modal-dialog modal-md modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5>Delete Account</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <a>To delete the&nbsp;&nbsp;<i class="flaticon-warning-sign icon-md text-danger"></i>&nbsp;&nbsp;<b>Classroom</b> type your <b>password</b>.</a><br>
          <input type="hidden" class="form-control" name="class_id">
          <input type="password" class="form-control" name="password" placeholder="Password">
        </div>
        <div class="modal-footer">
          <button type="button"  class="btn btn-light btn-sm" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-success btn-sm" name="delete_class">Confirm</button>
        </div>
      </div>
    </div>
  </div>
</form>   