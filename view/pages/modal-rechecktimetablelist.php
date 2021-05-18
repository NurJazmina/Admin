<?php
if (isset($_POST['AddtimetableFormSubmit']))
{
  $varconsumerid = $_POST['txtconsumerid'];
  $varcategory = $_POST['txtcategory'];
  $varsubject = $_POST['txtsubject'];

  $filter = ['SchoolID'=>$_SESSION["loggeduser_schoolID"], 'StaffLevel'=>'0', 'ConsumerID'=>$varconsumerid];
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
      $ConsumerIDNo = strval($document1->ConsumerIDNo);
      $teacherid = strval($document->_id);
    ?>
    <br><br><br><br><h2 style="text-align: center;">PLEASE CONFIRM BEFORE PROCEED</h2>
    <form id="submitaddtimetable" name="submitaddtimetable" action="index.php?page=timetablelist" method="post">
    <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="AddtimetableModalLabel">Add Timetable</h5>
            </div>
            <div class="modal-body">
            <div class="form-group row">
                <label for="staticStaffNo" class="col-sm-2 col-form-label">Teacher Name</label>
                <div class="col-sm-10">
                <input   value="<?php echo $ConsumerFName; ?>" disabled>
                </div>
            </div>
            <div class="form-group row">
                <label for="staticStaffNo" class="col-sm-2 col-form-label">MyKad</label>
                <div class="col-sm-10">
                <input  value="<?php echo $ConsumerIDNo; ?>"  disabled><br>
                <input type="hidden" name="txtConsumerIDNo" value="<?php echo  $ConsumerIDNo; ?>"  >
                </div>
            </div>
            <div class="form-group row">
                <label for="staticStaffNo" class="col-sm-2 col-form-label">Class Category</label>
                <div class="col-sm-10">
                <input   value="<?php echo $varcategory; ?>"  disabled>
                <input type="hidden" name="txtcategory" value="<?php echo  $varcategory; ?>" >
                </div>
            </div>
            <div class="form-group row">
                <label for="staticStaffNo" class="col-sm-2 col-form-label">Subject</label>
                <div class="col-sm-10">
                <input  value="<?php echo $varsubject; ?>" disabled><br>
                <input type="hidden" name="txtsubject" value="<?php echo  $varsubject; ?>" >
                </div>
            </div>
            <div class="form-group row">
                <label for="txtclassname" class="col-sm-2 col-form-label">Class Name</label>
                <div class="col-sm-10">
                <select class="form-control" id="txtteachername" name="txtclassid">
                    <?php
                    $filter2 = ['SchoolID'=>$_SESSION["loggeduser_schoolID"], 'ClassCategory'=>$varcategory];
                    $query2 = new MongoDB\Driver\Query($filter2);
                    $cursor2 = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Classrooms',$query2);
                    foreach ($cursor2 as $document2)
                    {
                    ?>
                    <option value="<?=($document2->_id)?>"><?=($document2->ClassName)?></option>
                    <?php
                    }
                    ?>
                </select>
                </div>
            </div><br>
            <div class="form-group row">
                <label for="staticStaffNo" class="col-sm-2 col-form-label">Timetable Start</label>
                <div class="col-sm-10">
                <input type="datetime-local" id="staticStaffNo" name="txtTimetableStart">
                </div>
            </div>
            <div class="form-group row">
                <label for="staticStaffNo" class="col-sm-2 col-form-label">Timetable End</label>
                <div class="col-sm-10">
                <input type="datetime-local" id="staticStaffNo" name="txtTimetableEnd">
                </div>
            </div><br>
            <input type="hidden" name="txtTimetableWeeklyRepeat" value="NO" >
            <div class="form-group row">
                <label for="staticStaffNo" class="col-sm-2 col-form-label">Weekly Repeat</label>
                <div class="col-sm-10">
                    <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="Check" name="txtTimetableWeeklyRepeat" value="YES">
                    <label class="form-check-label" for="Check">Repeated</label>
                </div>
                </div>
            </div>
            <div class="form-group row">
                <label for="staticStaffNo" class="col-sm-2 col-form-label">Status</label>
                <div class="col-sm-10">
                <select class="form-control" id="sltStaffStatus" name="txtTimetableStatus">
                    <option value="ACTIVE">Active</option>
                    <option value="INACTIVE">Inactive</option>
                </select>
                </div>
            </div>
            </div>
            <div class="modal-footer">
            <input type="hidden" class="form-control" id="staticStaffNo" name="txtteacherid" value="<?php echo  $teacherid; ?>">
            <button  onclick="index.php?page=timetablelist" class="btn btn-secondary">Close</button>
            <button type="submit" class="btn btn-success" name="submitaddtimetable">Confirm</button>
            </div>
        </div>
    </div>
    </form>
    </div>
    <?php
    }
  }
}
?>

<?php  
if (isset($_POST['EditTimetableFormSubmit']))
{
  $varcategory = $_POST['txtcategory'];
  $vartimetableid = $_POST['txttimetableid'];   
?>
<br><br><br><br><h2 style="text-align: center;">PLEASE CONFIRM BEFORE PROCEED</h2>
<form id="submitedittimetable" name="submitedittimetable" action="index.php?page=timetablelist" method="post">
  <div class="modal-dialog modal-lg modal-dialog-centered">
  <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="edittimetableModalLabel">Edit Timetable</h5>
        </div>
        <div class="modal-body">
          <div class="form-group row">
            <label for="staticStaffNo" class="col-sm-2 col-form-label">Teacher Name</label>
            <div class="col-sm-10">
               <select class="form-control" id="txtteachername" name="txtteacherid">
              <?php
              $filter1 = ['SchoolID'=>$_SESSION["loggeduser_schoolID"], 'StaffLevel'=>'0'];
              $query1 = new MongoDB\Driver\Query($filter1);
              $cursor1 = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Staff',$query1);
              foreach ($cursor1 as $document1)
              {
                $ConsumerID = strval($document1->ConsumerID);  
                $consumerid = new \MongoDB\BSON\ObjectId($ConsumerID); 
                $filter2 = ['_id'=>$consumerid];
                $query2 = new MongoDB\Driver\Query($filter2);   
                $cursor2 =$GoNGetzDatabase->executeQuery('GoNGetz.Consumer',$query2);
                foreach ($cursor2 as $document2)
                {
                  $ConsumerFName = strval($document2->ConsumerFName);
                  $_id = strval($document1->_id); 
                  $ConsumerIDNo = strval($document2->ConsumerIDNo);
                ?>
                <option value="<?=($document1->_id)?>"><?=($document2->ConsumerFName)?></option>
                <?php
                }
              }
                ?>
              </select>
            </div>
          </div>
          <div class="form-group row">
            <label for="staticStaffNo" class="col-sm-2 col-form-label">Subject</label>
            <div class="col-sm-10">
               <select class="form-control" id="txtsubjectid" name="txtsubject">
              <?php
              $filter3 = ['School_id' =>$_SESSION["loggeduser_schoolID"]];
              $query3 = new MongoDB\Driver\Query($filter3);
              $cursor3 = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.SchoolsSubject',$query3);
              foreach ($cursor3 as $document3)   
              {
                ?>
                <option value="<?=($document3->SubjectName)?>"><?=($document3->SubjectName)?></option>
                <?php
              }    
              ?>
              </select>
            </div>
          </div>
          <div class="form-group row">
            <label for="txtclassname" class="col-sm-2 col-form-label">Class Name</label>
            <div class="col-sm-10">
              <select class="form-control" id="txtteachername" name="txtclassid">
                <?php
                $filter4 = ['SchoolID'=>$_SESSION["loggeduser_schoolID"], 'ClassCategory'=>$varcategory];
                $query4 = new MongoDB\Driver\Query($filter4);
                $cursor4 = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Classrooms',$query4);
                foreach ($cursor4 as $document4)
                {
                ?>
                <option value="<?=($document4->_id)?>"><?=($document4->ClassName)?></option>
                <?php
                }
                ?>
              </select>
            </div>
          </div>
          <div class="form-group row">
            <label for="staticStaffNo" class="col-sm-2 col-form-label">Class Category</label>
            <div class="col-sm-10">
              <input  value="<?php echo $varcategory; ?>"  disabled>
              <input type="hidden" name="txtcategory" value="<?php echo  $varcategory; ?>">
            </div>
          </div>
          <div class="form-group row">
            <label for="staticStaffNo" class="col-sm-2 col-form-label">Timetable Start</label>
            <div class="col-sm-10">
              <input type="datetime-local" id="staticStaffNo" name="txtTimetableStart">
            </div>
          </div>
          <div class="form-group row">
            <label for="staticStaffNo" class="col-sm-2 col-form-label">Timetable End</label>
            <div class="col-sm-10">
              <input type="datetime-local" id="staticStaffNo" name="txtTimetableEnd">
            </div>
          </div>
          <input type="hidden" name="txtTimetableWeeklyRepeat" value="NO" >
          <div class="form-group row">
            <label for="staticStaffNo" class="col-sm-2 col-form-label">Weekly Repeat</label>
            <div class="col-sm-10">
                <div class="form-check">
                  <input type="checkbox" class="form-check-input" id="Check" name="txtTimetableWeeklyRepeat" value="YES">
                  <label class="form-check-label" for="Check">Repeated</label>
              </div>
            </div>
          </div>
        <div class="modal-footer">
          <input type="hidden" class="form-control" id="staticStaffNo" value="<?=$vartimetableid?>" name="txttimetableid">
          <button  onclick="index.php?page=timetablelist" class="btn btn-secondary">Close</button>
          <button type="submit" class="btn btn-success" name="submitedittimetable">Confirm</button>
        </div>
      </div>
  </div>
</form> 
</div>
<?php
}
?>