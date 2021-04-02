 <?php  
//error utk recognize other group,vip,gongetz etc
if (isset($_POST['AddclassFormSubmit'])) 
{
  $varschoolID = strval($_SESSION["loggeduser_schoolID"]);
  $varconsumerid = $_POST['txtconsumerid'];
  $varClasscategory = $_POST['txtClasscategory'];
    
  $consumerid = new \MongoDB\BSON\ObjectId($varconsumerid);
  $filter = ['_id'=>$consumerid];
  $query = new MongoDB\Driver\Query($filter);
  $cursor = $GoNGetzDatabase->executeQuery('GoNGetz.Consumer',$query);
  
  foreach ($cursor as $document) 
  { 
    $IDcon = strval($document->_id);
    $ConsumerGroup_id = strval($document->ConsumerGroup_id);
    $StaffLevel = 1;

      $filter2 = ['SchoolID'=>$varschoolID, 'ConsumerID'=> $IDcon, 'StaffLevel'=>'0'];
      $query2 = new MongoDB\Driver\Query($filter2);
      $cursor2 = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Staff',$query2);
      
      $count = 0;
      $end = 1;
      foreach ($cursor2 as $document2) 
      { 
        $StaffLevel = strval($document2->StaffLevel);
        $count++;
        $ID = strval($document->_id);
        $ConsumerFName = strval($document->ConsumerFName);
        $ConsumerIDNo = strval($document->ConsumerIDNo);
        //$Staffdepartment = strval($document2->Staffdepartment);
    
?>
<br><br><br><br><h2 style="text-align: center;">PLEASE CONFIRM BEFORE PROCEED</h2>
<form id="submitaddclass" name="submitaddclass" action="index.php?page=classroomlist" method="post">
  <div class="modal-dialog modal-lg modal-dialog-centered">
  <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="AddclassModalLabel">Add Class</h5>
        </div>
        <div class="modal-body">
          <div class="form-group row">
            <label for="staticStaffNo" class="col-sm-2 col-form-label">Teacher Name</label>
            <div class="col-sm-10">
              <input   value="<?php echo  $ConsumerFName; ?>" disabled>
            </div>
          </div>
          <div class="form-group row">
            <label for="staticStaffNo" class="col-sm-2 col-form-label">Teacher ID</label>
            <div class="col-sm-10">
              <input  value="<?php echo  $ConsumerIDNo; ?>" disabled><br>
              <input type="hidden" name="txtConsumerIDNo" value="<?php echo  $ConsumerIDNo; ?>" >
            </div>
          </div> 
          <div class="form-group row">
            <label for="staticStaffNo" class="col-sm-2 col-form-label">Class Category</label>
            <div class="col-sm-10">
              <input  value="<?php echo $varClasscategory; ?>" disabled><br>
              <input type="hidden" name="txtClasscategory" value="<?php echo  $varClasscategory; ?>" >
            </div>
          </div>
          <div class="form-group row">
            <label for="staticStaffNo" class="col-sm-2 col-form-label">Class Name</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="staticStaffNo" name="txtclassname" style="text-transform:uppercase">
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <input type="hidden" class="form-control" id="staticStaffNo" name="txtStaffdepartment" value="<?php echo  $varStaffdepartment; ?>">
          <input type="hidden" class="form-control" id="staticStaffNo" name="txtconsumerid" value="<?php echo  $IDcon; ?>">
          <button  onclick="index.php?page=classroomlist" class="btn btn-secondary">Close</button>
          <button type="submit" class="btn btn-secondary" name="submitaddclass">Confirm</button>
        </div>
      </div>
  </div>
</form> 
<?php
            if ($count == $end) break;    
      }
            
        if ($ConsumerGroup_id !== '601b4cfd97728c027c01f187' || $StaffLevel == '1' )
    {
      ?>
<br><br><br><br><div class="alert alert-danger" role="alert"><h2 style="text-align: center;">AUTHORIZED PERSONNEL ONLY</h2>
<form id="submitstaff" name="submitstaff" action="index.php?page=classroomlist" method="post">
  <div class="modal-dialog modal-lg modal-dialog-centered">
  <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="AddStaffModalLabel">Add Teacher</h5>
        </div>
        <div class="modal-body">
          <div class="form-group row">
            <label for="staticStaffNo" class="col-sm-2 col-form-label">MyKad</label>
            <div class="col-sm-10">
              <input   value="<?php echo  $varConsumerIDNo; ?>" disabled>
            </div>
          </div>
          <div class="form-group row">
            <label for="staticStaffNo" class="col-sm-2 col-form-label"></label>
            <div class="col-sm-10">
              <input   value="UNAUTHORIZED" disabled>
            </div>
          </div>
        <div class="modal-footer">
          <button  onclick="index.php?page=stafflist" class="btn btn-secondary" >Close</button>
        </div>
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