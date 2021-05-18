<form  id="AddtimetableFormSubmit"  name="AddtimetableFormSubmit" action="index.php?page=rechecktimetable" method="post">
  <div class="modal fade" id="recheckaddtimetable" tabindex="-1" aria-labelledby="AddtimetableModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="AddtimetableModalLabel">Add Timetable</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <!-- add teacher -->
            <div class="form-group row">
            <label for="txtteacherclass" class="col-sm-2 col-form-label">Teacher</label>
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
                    //echo $ConsumerFName;
                ?>
                <option value="<?=($document1->_id)?>"><?=($document1->ConsumerFName)?></option>
                <?php
                  }
                }
                ?>
              </select>
            </div>
          </div>
          <!-- add category -->
          <div class="form-group row">
            <label for="staticStaffNo" class="col-sm-2 col-form-label">Class Category</label>
            <div class="col-sm-10">
              <select class="form-control" id="sltStatus" name="txtcategory" >
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
            <label for="staticStaffNo" class="col-sm-2 col-form-label">Timetable Subject</label>
            <div class="col-sm-10">
              <select class="form-control" id="txtsubject" name="txtsubject">
                <?php
                $filter = ['School_id'=>$_SESSION["loggeduser_schoolID"]];
                $query = new MongoDB\Driver\Query($filter);
                $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.SchoolsSubject',$query);
                foreach ($cursor as $document)
                {
                ?>
                <option value="<?=($document->SubjectName)?>"><?=($document->SubjectName)?></option>
                <?php
                  }
                ?>
              </select>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-success" name="AddtimetableFormSubmit">Re-Checking</button>
        </div>
      </div>
    </div>
  </div>
</form>

<form id="EditTimetableFormSubmit"  name="EditTimetableFormSubmit"  action="index.php?page=rechecktimetable" method="post">
  <div class="modal fade" id="recheckedittimetable" tabindex="-1" aria-labelledby="EditTimetableModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="EditTimetableModalLabel">Edit Timetable</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="form-group row">
            <label for="staticStaffNo" class="col-sm-2 col-form-label">Class Category</label>
            <div class="col-sm-10">
              <input type="hidden" id="staticStaffNo" name="txttimetableid">
              <select class="form-control" id="sltStatus" name="txtcategory" >
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
          <button type="submit" class="btn btn-success" name="EditTimetableFormSubmit">Edit</button>
        </div>
    </div>
  </div>
</div>
</form>  
