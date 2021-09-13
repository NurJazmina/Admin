<?php
$_SESSION["title"] = "Re-checking";
include 'view/partials/_subheader/subheader-v1.php';
$start = new MongoDB\BSON\UTCDateTime((new DateTime('now'))->getTimestamp()*1000);
$start = $start->toDateTime()->setTimezone(new \DateTimeZone(date_default_timezone_get()));
$start = date_format($start,"Y-m-d\TH:i:s");
if (isset($_POST['recheck_add_timetable']))
{
  $consumer_id = $_POST['consumer_id'];
  $class_category = $_POST['class_category'];
  $subject_id = $_POST['subject_id'];

  $filter = ['_id' =>new \MongoDB\BSON\ObjectId($subject_id)];
  $query = new MongoDB\Driver\Query($filter);
  $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.SchoolsSubject',$query);
  foreach ($cursor as $document)   
  {
    $SubjectName = $document->SubjectName;
  }
  $filter = ['StaffLevel'=>'0', 'ConsumerID'=>$consumer_id];
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
      $teacherid = strval($document->_id);
      $ConsumerFName = $document->ConsumerFName;
      $ConsumerlName = $document->ConsumerLName;
      $ConsumerIDNo = $document->ConsumerIDNo;
      ?>
      <div class="text-dark-50 text-center m-5"><h1>PLEASE CONFIRM BEFORE PROCEED</h1></div>
      <form name="add_timetable" action="index.php?page=timetablelist" method="post">
        <div class="modal-dialog modal-lg modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Add Timetable</h5>
            </div>
            <div class="modal-body">
              <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Teacher Name</label>
                  <div class="col-sm-10">
                  <input class="form-control" value="<?= $ConsumerFName." ".$ConsumerFName; ?>" disabled>
                  </div>
              </div>
              <div class="form-group row">
                  <label class="col-sm-2 col-form-label">MyKad</label>
                  <div class="col-sm-10">
                  <input class="form-control" value="<?= $ConsumerIDNo; ?>" disabled>
                  </div>
              </div>
              <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Class Category</label>
                  <div class="col-sm-10">
                  <input class="form-control" value="<?= $class_category; ?>" disabled>
                  </div>
              </div>
              <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Subject</label>
                  <div class="col-sm-10">
                  <input class="form-control" value="<?= $SubjectName; ?>" disabled>
                  </div>
              </div>
              <div class="form-group row">
                  <label for="txtclassname" class="col-sm-2 col-form-label">Class Name</label>
                  <div class="col-sm-10">
                  <select class="form-control" name="class_id">
                    <?php
                    $filter = ['SchoolID'=>$_SESSION["loggeduser_school_id"], 'ClassCategory'=>$class_category];
                    $query = new MongoDB\Driver\Query($filter);
                    $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Classrooms',$query);
                    foreach ($cursor as $document)
                    {
                      $class_id = strval($document->_id);
                      $ClassName = $document->ClassName;
                      ?>
                      <option value="<?= $class_id; ?>"><?= $ClassName; ?></option>
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
                  <select class="form-control" name="status">
                      <option value="ACTIVE">Active</option>
                      <option value="INACTIVE">Inactive</option>
                  </select>
                  </div>
              </div>
            </div>
            <div class="modal-footer">
              <input type="hidden" name="teacher_id" value="<?= $teacherid; ?>">
              <input type="hidden" name="class_category" value="<?= $class_category; ?>">
              <input type="hidden" name="subject_id" value="<?= $subject_id; ?>">
              <input type="hidden" name="ConsumerIDNo" value="<?= $ConsumerIDNo; ?>">
              <button onclick="index.php?page=timetablelist" class="btn btn-light btn-hover-success btn-sm">Timetable List</button>
              <button type="submit" class="btn btn-success btn-hover-light" name="add_timetable">Confirm</button>
            </div>
          </div>
        </div>
      </form>
      <?php
    }
  }
}
?>

<?php  
if (isset($_POST['recheck_edit_timetable']))
{
  $class_category = $_POST['class_category'];
  $timetable_id = $_POST['timetable_id'];   
  ?>
  <div class="text-dark-50 text-center m-5"><h1>PLEASE CONFIRM BEFORE PROCEED</h1></div>
  <form name="edit_timetable" action="index.php?page=timetablelist" method="post">
    <div class="modal-dialog modal-lg modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Edit Timetable</h5>
        </div>
        <div class="modal-body">
          <div class="form-group row">
            <label class="col-sm-2 col-form-label">Teacher Name</label>
            <div class="col-sm-10">
              <select class="form-control" name="teacher_id">
                <?php
                $filter = ['SchoolID'=>$_SESSION["loggeduser_school_id"], 'StaffLevel'=>'0'];
                $query = new MongoDB\Driver\Query($filter);
                $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Staff',$query);
                foreach ($cursor as $document)
                {
                  $ConsumerID = strval($document->ConsumerID);  

                  $filter = ['_id'=>new \MongoDB\BSON\ObjectId($ConsumerID)];
                  $query = new MongoDB\Driver\Query($filter);   
                  $cursor =$GoNGetzDatabase->executeQuery('GoNGetz.Consumer',$query);
                  foreach ($cursor as $document)
                  {
                    $consumer_id = strval($document->_id); 
                    $ConsumerFName = $document->ConsumerFName;
                    $ConsumerLName = $document->ConsumerLName;
                  }
                  ?>
                  <option value="<?= $consumer_id; ?>"><?= $ConsumerFName." ".$ConsumerLName  ?></option>
                  <?php
                }
                ?>
              </select>
            </div>
          </div>
          <div class="form-group row">
            <label class="col-sm-2 col-form-label">Subject</label>
            <div class="col-sm-10">
              <select class="form-control" name="subject_id">
              <?php
              $filter = ['School_id' =>$_SESSION["loggeduser_school_id"]];
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
                  $ClassName = $document->ClassName;
                  ?>
                  <option value="<?= $class_id; ?>"><?= $ClassName; ?></option>
                  <?php
                }
                ?>
              </select>
            </div>
          </div>
          <div class="form-group row">
            <label class="col-sm-2 col-form-label">Class Category</label>
            <div class="col-sm-10">
              <input class="form-control" value="<?= $class_category; ?>"  disabled>
            </div>
          </div>
          <div class="form-group row">
            <label class="col-sm-2 col-form-label">Timetable Start</label>
            <div class="col-sm-10">
              <input class="form-control" type="datetime-local" name="date_start">
            </div>
          </div>
          <div class="form-group row">
            <label class="col-sm-2 col-form-label">Timetable End</label>
            <div class="col-sm-10">
              <input class="form-control" type="datetime-local" name="date_end">
            </div>
          </div>
          <input type="hidden" name="repeat" value="NO" >
          <div class="form-group row">
            <label class="col-sm-2 col-form-label">Weekly Repeat</label>
            <div class="col-sm-10">
                <div class="form-check">
                  <input type="checkbox" class="form-check-input" id="Check" name="repeat" value="YES">
                  <label class="form-check-label" for="Check">Repeated</label>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <input type="hidden" class="form-control" value="<?=$timetable_id?>" name="timetable_id">
          <input type="hidden" name="class_category" value="<?=  $class_category; ?>">
          <button  onclick="index.php?page=timetablelist" class="btn btn-light btn-hover-success btn-sm">Timetable List</button>
          <button type="submit" class="btn btn-success btn-hover-light" name="edit_timetable">Confirm</button>
        </div>
      </div>
    </div>
  </form>
  <?php
}
?>