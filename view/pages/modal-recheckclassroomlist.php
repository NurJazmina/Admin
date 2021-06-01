<?php  
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


if (isset($_POST['EditclassFormSubmit']))
{
  $varclassid = $_POST['txtclassid'];
  $number = $_POST['txtnumber'];
  $varClasscategory = $_POST['txtClasscategory'];
  $filter = ['SchoolID'=>$_SESSION["loggeduser_schoolID"], 'ClassID'=>$varclassid];
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
    }
  }
?>
<br><br><br><br><h2 style="text-align: center;">PLEASE CONFIRM BEFORE PROCEED</h2>
<form id="submiteditclass" name="submiteditclass" action="index.php?page=classroomlist" method="post">
  <div class="modal-dialog modal-lg modal-dialog-centered">
  <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editclassModalLabel">Edit Class</h5>
        </div>
        <div class="modal-body">
          <div class="form-group row">
            <label for="staticStaffNo" class="col-sm-2 col-form-label">Teacher Name</label>
            <div class="col-sm-10">
              <input value="<?php echo $ConsumerFName; ?>" disabled>
            </div>
          </div>
          <div class="form-group row">
            <label for="staticStaffNo" class="col-sm-2 col-form-label">Class Category</label>
            <div class="col-sm-10">
              <input value="<?php echo $varClasscategory; ?>" disabled>
            </div>
          </div>
          <div class="form-group row">
            <label for="staticStaffNo" class="col-sm-2 col-form-label">Class Name</label>
            <div class="col-sm-10">
              <select class="form-select" id="sltteacherclass" name="txtclassname">
                <?php
                $filter1 = ['SchoolID'=>$_SESSION["loggeduser_schoolID"], 'ClassCategory'=>$varClasscategory];
                $query1 = new MongoDB\Driver\Query($filter1);
                $cursor1 = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Classrooms',$query1);
                foreach ($cursor1 as $document1):
                ?>
                <option value="<?=($document1->ClassName)?>"><?=($document1->ClassName)?></option>
                <?php
                endforeach
                ?>
              </select>
            </div>
          </div>    
          <?php
          for ($x = 1; $x <= $number; $x++)
          { 
          ?>  
          <div class="form-group row">
            <label for="staticStaffNo" class="col-sm-2 col-form-label">Teacher</label>
            <div class="col-sm-10">
              <select class="form-select" name="teacher<?php echo $x; ?>">
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
                <option value="<?=($document1->_id)?>"><?=($document2->ConsumerFName)." ".($document2->ConsumerLName)?></option>
                <?php
                }
              }
              ?>
              </select>
            </div>
            <label for="staticStaffNo" class="col-sm-2 col-form-label">subject</label>
            <div class="col-sm-10">
              <select class="form-select" name="subject<?php echo $x; ?>">
                <?php
                $filter = ['School_id'=>$_SESSION["loggeduser_schoolID"], 'Class_category'=>$varClasscategory];
                $query = new MongoDB\Driver\Query($filter);
                $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.SchoolsSubject',$query);
                foreach ($cursor as $document):
                ?>
                <option value="<?=($document->_id)?>"><?=($document->SubjectName)?></option>
                <?php
                endforeach
                ?>
              </select>
            </div>
            <br>
          </div>
          <?php
          }
          ?>
        </div>
        <div class="modal-footer">
          <input type="hidden" class="form-control" id="staticStaffNo" name="txtnumber" value="<?php echo $number; ?>">
          <input type="hidden" class="form-control" id="staticStaffNo" name="txtclasscategory" value="<?php echo  $varClasscategory; ?>">
          <input type="hidden" class="form-control" id="staticStaffNo" name="txtclassid" value="<?php echo  $varclassid; ?>">
          <button  onclick="index.php?page=classroomlist" class="btn btn-secondary" >Close</button>
          <button type="submit" class="btn btn-success" name="submiteditclass">Confirm</button>
        </div>
      </div>
  </div>
</form>
<?php
}
?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>
$(document).ready(function() {
    var max_fields = 15;
    var wrapper = $(".container1");
    var add_button = $(".add_form_field");

    var x = 1;
    $(add_button).click(function(e) {
        e.preventDefault();
        if (x < max_fields) {
            x++;
            $(wrapper).append('<div class="form-group row"><label class="col-sm-2 col-form-label">Teacher</label><div class="col-sm-10"><input type="text" class="form-control" name="teacher[]"></div><label for="staticStaffNo" class="col-sm-2 col-form-label">subject</label><div class="col-sm-10"><input type="text" class="form-control" name="subject[]"></div><a href="#" class="delete"> Delete</a></div>'); //add input box
        } else {
            alert('You Reached the limits')
        }
    });

    $(wrapper).on("click", ".delete", function(e) {
        e.preventDefault();
        $(this).parent('div').remove();
        x--;
    })
});
</script>