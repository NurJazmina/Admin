<?php  
if (isset($_POST['EditTimetableFormSubmit']))
{
  $varcategory = $_POST['txtcategory'];
  $vartimetableid = $_POST['txttimetableid'];
             
?>
<html>
<head>
 <style>
h2 {text-align: center;}
</style>
  
<style type="text/css">
   input {font-weight:bold;}
</style>
</head>
  
<body>
<br><br><br><br>
<h2>PLEASE CONFIRM BEFORE PROCEED</h2>
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
              $cursor1 = $GoNGetzBackEnd->executeQuery('GoNGetzSmartSchool.Staff',$query1);
              foreach ($cursor1 as $document1)
              {
                $ConsumerID = strval($document1->ConsumerID);  
                $consumerid = new \MongoDB\BSON\ObjectId($ConsumerID); 
                

                $filter2 = ['_id'=>$consumerid];
                $query2 = new MongoDB\Driver\Query($filter2);   
                $cursor2 = $GoNGetzBackEnd->executeQuery('GoNGetz.Consumer',$query2);

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
              $cursor3 = $GoNGetzSmartSchoolFrontEnd->executeQuery('GoNGetzSmartSchool.SchoolsSubject',$query3);

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
                $cursor4 = $GoNGetzBackEnd->executeQuery('GoNGetzSmartSchool.Classrooms',$query4);
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
          <button type="submit" class="btn btn-secondary" name="submitedittimetable">Confirm</button>
        </div>
      </div>
  </div>
</form> 
</div>
</body>
</html>
<?php
    }

?>

