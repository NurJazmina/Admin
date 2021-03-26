<?php
if (isset($_POST['EditStudentFormSubmit']))
{
  $varClasscategory = $_POST['txtClasscategory'];
  $varstudentid = $_POST['studentid'];
  $filter = ['Schools_id'=>$_SESSION["loggeduser_schoolID"], 'Consumer_id'=>$varstudentid];
  $query = new MongoDB\Driver\Query($filter);
  $cursor =$GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Students',$query);
  foreach ($cursor as $document)
  {
    $Consumer_id = strval($document->Consumer_id);
    $id = new \MongoDB\BSON\ObjectId($Consumer_id);
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
<body>
<br><br><br><br><h2 style="text-align: center;">PLEASE CONFIRM BEFORE PROCEED</h2>
<form id="submiteditstudent" name="submiteditstudent" action="index.php?page=studentlist" method="post">
  <div class="modal-dialog modal-lg modal-dialog-centered">
  <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editclassModalLabel">Edit Class</h5>
        </div>
        <div class="modal-body">
          <div class="form-group row">
            <label for="staticStaffNo" class="col-sm-2 col-form-label">Student Name</label>
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
            <label for="staticStaffNo" class="col-sm-2 col-form-label">Class</label>
            <div class="col-sm-10">
              <select class="form-select" id="sltteacherclass" name="txtstudentclass">
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
           <input type="hidden" class="form-control" id="staticStaffNo" name="studentid" value="<?php echo  $varstudentid; ?>">
          <button  onclick="index.php?page=studentlist" class="btn btn-secondary" >Close</button>
          <button type="submit" class="btn btn-secondary" name="submiteditstudent">Confirm</button>
        </div>
      </div>
  </div>
</form>
