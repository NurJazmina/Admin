<?php
$_SESSION["title"] = "Re-checking";
include 'view/partials/_subheader/subheader-v1.php';
$start = new MongoDB\BSON\UTCDateTime((new DateTime('now'))->getTimestamp()*1000);
$start = $start->toDateTime()->setTimezone(new \DateTimeZone(date_default_timezone_get()));
$start = date_format($start,"Y-m-d\TH:i:s");

if (isset($_POST['recheck_add_timetable']))
{
  $class_category = $_POST['class_category'];
  ?>
  <div class="text-dark-50 text-center m-10">
    <h1>PLEASE CONFIRM BEFORE PROCEED</h1>
  </div>
  <form name="add_timetable" action="index.php?page=timetablelist" method="post">
    <div class="modal-dialog modal-lg modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Add Timetable</h5>
        </div>
        <div class="modal-body">
          <div class="form-group row">
            <label class="col-sm-2 col-form-label">Class Name</label>
            <div class="col-sm-10">
              <select class="form-control" name="class_id">
              <?php
              $filter = ['SchoolID'=>$_SESSION["loggeduser_school_id"], 'ClassCategory'=>$class_category];
              $query = new MongoDB\Driver\Query($filter);
              $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Classrooms',$query);
              foreach ($cursor as $document)
              {
                $class_id = strval($document->_id);
                $ClassCategory = $document->ClassCategory;
                $ClassName = $document->ClassName;
                ?>
                <option value="<?=  $class_id; ?>"><?= $ClassCategory." ".$ClassName; ?></option>
                <?php
              }
              ?>
              </select>
            </div>
          </div>  
          <div class="form-group row">
            <label class="col-sm-2 col-form-label">Teacher</label>
            <div class="col-sm-10">
              <select class="form-control" name="teacher_id">
              <?php
              $filter = ['SchoolID'=>$_SESSION["loggeduser_school_id"], 'StaffLevel'=>'0'];
              $query = new MongoDB\Driver\Query($filter);
              $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Staff',$query);
              foreach ($cursor as $document)
              {
                $teacher_id = strval($document->_id); 
                $ConsumerID = $document->ConsumerID; 

                $filter = ['_id'=>new \MongoDB\BSON\ObjectId($ConsumerID)];
                $query = new MongoDB\Driver\Query($filter);   
                $cursor = $GoNGetzDatabase->executeQuery('GoNGetz.Consumer',$query);
                foreach ($cursor as $document)
                {
                  $ConsumerFName = $document->ConsumerFName;
                  $ConsumerLName = $document->ConsumerLName;
                }
                ?>
                <option value="<?= $teacher_id; ?>"><?= $ConsumerFName." ".$ConsumerLName; ?></option>
                <?php
              }
              ?>
              </select>
            </div>
          </div>
          <div class="form-group row">
            <label class="col-sm-2 col-form-label">subject</label>
            <div class="col-sm-10">
              <select class="form-control" name="subject_id">
              <?php
              $filter = ['School_id'=>$_SESSION["loggeduser_school_id"], 'Class_category'=>$class_category];
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
          <div class="form-group row">
            <label class="col-sm-2 col-form-label">Timetable Start</label>
            <div class="col-sm-10">
              <input class="form-control" type="datetime-local" name="date_start" value="<?= $start; ?>">
            </div>
          </div>
          <div class="form-group row">
            <label class="col-sm-2 col-form-label">Timetable End</label>
            <div class="col-sm-10">
              <input class="form-control" type="datetime-local" name="date_end" value="<?= $start; ?>">
            </div>
          </div>
          <div class="form-group row">
            <input type="hidden" name="repeat" value="NO">
            <label class="col-sm-2 col-form-label">Weekly Repeat</label>
            <div class="col-sm-10">
              <div class="checkbox-inline mt-3">
                  <label class="checkbox checkbox-success">
                    <input type="checkbox" name="repeat" value="YES">
                  <span> </span> 
                  Repeated </label>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button onclick="index.php?page=timetablelist" class="btn btn-light btn-hover-success btn-sm">Close</button>
          <button type="submit" class="btn btn-success btn-hover-light btn-sm" name="add_timetable">Confirm</button>
        </div>
      </div>
    </div>
  </form>
  <?php
}
 
if (isset($_POST['recheck_edit_timetable']))
{
  $class_category = $_POST['class_category'];
  $class_rel_id = $_POST['class_rel_id'];   
  ?>
  <div class="text-dark-50 text-center"><h1>PLEASE CONFIRM BEFORE PROCEED</h1></div>
  <form name="edit_timetable" action="index.php?page=timetablelist" method="post">
    <div class="modal-dialog modal-lg modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Edit Timetable</h5>
        </div>
        <div class="modal-body">
          <div class="form-group row">
            <label class="col-sm-2 col-form-label">Class Name</label>
            <div class="col-sm-10">
              <select class="form-control" name="class_id">
              <?php
              $filter = ['SchoolID'=>$_SESSION["loggeduser_school_id"], 'ClassCategory'=>$class_category];
              $query = new MongoDB\Driver\Query($filter);
              $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Classrooms',$query);
              foreach ($cursor as $document)
              {
                $class_id = strval($document->_id);
                $ClassCategory = $document->ClassCategory;
                $ClassName = $document->ClassName;
                ?>
                <option value="<?= $class_id; ?>"><?= $ClassCategory." ".$ClassName; ?></option>
                <?php
              }
              ?>
              </select>
            </div>
          </div>  
          <div class="form-group row">
            <label class="col-sm-2 col-form-label">Teacher</label>
            <div class="col-sm-10">
              <select class="form-control" name="teacher_id">
              <?php
              $filter = ['SchoolID'=>$_SESSION["loggeduser_school_id"], 'StaffLevel'=>'0'];
              $query = new MongoDB\Driver\Query($filter);
              $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Staff',$query);
              foreach ($cursor as $document)
              {
                $teacher_id = strval($document->_id); 
                $ConsumerID = $document->ConsumerID; 

                $filter = ['_id'=>new \MongoDB\BSON\ObjectId($ConsumerID)];
                $query = new MongoDB\Driver\Query($filter);   
                $cursor = $GoNGetzDatabase->executeQuery('GoNGetz.Consumer',$query);
                foreach ($cursor as $document)
                {
                  $ConsumerFName = $document->ConsumerFName;
                  $ConsumerLName = $document->ConsumerLName;
                }
                ?>
                <option value="<?= $teacher_id; ?>"><?= $ConsumerFName." ".$ConsumerLName; ?></option>
                <?php
              }
              ?>
              </select>
            </div>
          </div>
          <div class="form-group row">
            <label class="col-sm-2 col-form-label">subject</label>
            <div class="col-sm-10">
              <select class="form-control" name="subject_id">
              <?php
              $filter = ['School_id'=>$_SESSION["loggeduser_school_id"], 'Class_category'=>$class_category];
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
          <div class="form-group row">
            <label class="col-sm-2 col-form-label">Timetable Start</label>
            <div class="col-sm-10">
              <input class="form-control" type="datetime-local" name="date_start" value="<?= $start; ?>">
            </div>
          </div>
          <div class="form-group row">
            <label class="col-sm-2 col-form-label">Timetable End</label>
            <div class="col-sm-10">
              <input class="form-control" type="datetime-local" name="date_end" value="<?= $start; ?>">
            </div>
          </div>
          <div class="form-group row">
            <input type="hidden" name="repeat" value="NO">
            <label class="col-sm-2 col-form-label">Weekly Repeat</label>
            <div class="col-sm-10">
              <div class="checkbox-inline mt-3">
                  <label class="checkbox checkbox-success">
                    <input type="checkbox" name="repeat" value="YES">
                  <span> </span> 
                  Repeated </label>
              </div>
            </div>
          </div>
          <div class="form-group row">
            <label class="col-sm-2 col-form-label">Status</label>
            <div class="col-sm-10">
              <select class="form-control" name="status" >
                <option value="ACTIVE">ACTIVE</option>
                <option value="INACTIVE">INACTIVE</option>
              </select>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <input type="hidden" name="class_rel_id" value="<?= $class_rel_id; ?>">
          <button  onclick="index.php?page=timetablelist" class="btn btn-light btn-hover-success btn-sm">Timetable List</button>
          <button type="submit" class="btn btn-success btn-hover-light btn-sm" name="edit_timetable">Confirm</button>
        </div>
      </div>
    </div>
  </form>
  <?php
}
?>