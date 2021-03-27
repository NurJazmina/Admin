<?php
if (isset($_POST['EditStaffFormSubmit']))
{
  $varClasscategory = $_POST['txtClasscategory'];
  $varteacherid = $_POST['teacherid'];
  $filter = ['SchoolID'=>$_SESSION["loggeduser_schoolID"], 'ConsumerID'=>$varteacherid];
  $query = new MongoDB\Driver\Query($filter);
  $cursor =$GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Staff',$query);
  foreach ($cursor as $document)
  {
    $ConsumerID = strval($document->ConsumerID);
    $id = new \MongoDB\BSON\ObjectId($ConsumerID);
    $filter1 = ['_id'=>$id];
    $query1 = new MongoDB\Driver\Query($filter1);
    $cursor1 =$GoNGetzDatabase->executeQuery('GoNGetz.Consumer',$query1);
    foreach ($cursor1 as $document1)
    {
       $ConsumerFName = strval($document1->ConsumerFName);
    }
  }
}
?>
<br><br><br><br><h2 style="text-align: center;">PLEASE CONFIRM BEFORE PROCEED</h2>
<form id="submiteditstaff" name="submiteditstaff" action="index.php?page=stafflist" method="post">
  <div class="modal-dialog modal-lg modal-dialog-centered">
  <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editclassModalLabel">Edit Class</h5>
        </div>
        <div class="modal-body">
          <div class="form-group row">
            <label for="staticStaffNo" class="col-sm-2 col-form-label">Staff Name</label>
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
            <label for="staticStaffNo" class="col-sm-2 col-form-label">Class Teacher</label>
            <div class="col-sm-10">
              <select class="form-select" id="sltteacherclass" name="txtteacherclass">
                <?php
                $filter1 = ['SchoolID'=>$_SESSION["loggeduser_schoolID"], 'ClassCategory'=>$varClasscategory];
                $query1 = new MongoDB\Driver\Query($filter1);
                $cursor1 =$GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Classrooms',$query1);
                foreach ($cursor1 as $document1):
                ?>
                <option value="<?=($document1->_id)?>"><?=($document1->ClassName)?></option>
                <?php
                endforeach 
                ?>
              </select>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <input type="hidden" class="form-control" id="staticStaffNo" name="txtClasscategory" value="<?php echo  $varClasscategory; ?>">
           <input type="hidden" class="form-control" id="staticStaffNo" name="teacherid" value="<?php echo  $varteacherid; ?>">
          <button  onclick="index.php?page=stafflist" class="btn btn-secondary" >Close</button>
          <button type="submit" class="btn btn-secondary" name="submiteditstaff">Confirm</button>
        </div>
      </div>
  </div>
</form>
