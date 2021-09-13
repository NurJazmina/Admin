<form name="recheck_add_timetable" action="index.php?page=modal-recheck_timetable" method="post">
  <div class="modal fade" id="add_timetable">
    <div class="modal-dialog modal-md modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Add Timetable</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <!-- add teacher -->
          <div class="form-group row">
            <label class="col-sm-3 col-form-label">Teacher</label>
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
                    $ConsumerLName = $document->ConsumerLName;
                  }
                  ?>
                  <option value="<?= $consumer_id; ?>"><?= $ConsumerFName." ".$ConsumerLName; ?></option>
                  <?php
                }
                ?>
              </select>
            </div>
          </div>
          <!-- add category -->
          <div class="form-group row">
            <label class="col-sm-3 col-form-label">Class Category</label>
            <div class="col-sm-9">
              <select class="form-control" name="class_category" >
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
                <option value="6">6</option>
              </select>
            </div>
          </div>
         <!-- add subject -->
         <div class="form-group row">
            <label class="col-sm-3 col-form-label">Subject</label>
            <div class="col-sm-9">
              <select class="form-control" name="subject_id">
                <?php
                $filter = ['School_id'=>$_SESSION["loggeduser_school_id"]];
                $query = new MongoDB\Driver\Query($filter);
                $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.SchoolsSubject',$query);
                foreach ($cursor as $document)
                {
                  $subject_id = strval($document->_id);
                  $SubjectName = $document->SubjectName;
                  ?>
                  <option value="<?= $subject_id; ?>"><?= $SubjectName; ?></option>
                  <?php
                  }
                ?>
              </select>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-light btn-hover-success btn-sm" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-success btn-hover-light btn-sm" name="recheck_add_timetable">Re-Checking</button>
        </div>
      </div>
    </div>
  </div>
</form>

<form name="recheck_edit_timetable" action="index.php?page=recheck_timetable" method="post">
  <div class="modal fade" id="edit_timetable">
    <div class="modal-dialog modal-md modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Edit Timetable</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="form-group row">
            <label class="col-sm-3 col-form-label">Class Category</label>
            <div class="col-sm-9">
              <input type="hidden" name="timetable_id">
              <select class="form-control" name="class_category" >
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
          <button type="button"  class="btn btn-light btn-hover-success btn-sm" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-success btn-hover-light btn-sm" name="recheck_edit_timetable">Edit</button>
        </div>
      </div>
    </div>
  </div>
</form>  

<form  name="delete_timetable" action="index.php?page=timetablelist" method="post">
  <div class="modal fade" id="delete_timetable" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Delete Timetable</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <a>To delete the&nbsp;&nbsp;<i class="flaticon-warning-sign icon-md text-danger"></i>&nbsp;&nbsp;<b>Timetable</b> type your <b>password</b>.</a><br>
          <input type="hidden" class="form-control" name="timetable_id">
          <input type="password" class="form-control" name="password" placeholder="Password">
        </div>
        <div class="modal-footer">
          <button type="button"  class="btn btn-light btn-sm" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-success btn-sm" name="delete_timetable">Delete</button>
        </div>
      </div>
    </div>
  </div>
</form>
