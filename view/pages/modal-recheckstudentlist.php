<?php
if (isset($_POST['AddStudentFormSubmit']))
{
  $varschoolID = strval($_SESSION["loggeduser_schoolID"]);
  $varConsumerIDNo = $_POST['txtConsumerIDNo'];
  $varConsumerIDNoChild = $_POST['txtConsumerIDNoChild'];
  $varClasscategory = $_POST['txtClasscategory'];
  $Consumer_id = '';

  $filter0 = ['ConsumerIDNo'=>$varConsumerIDNoChild];
  $query0 = new MongoDB\Driver\Query($filter0);
  $cursor0 =$GoNGetzDatabase->executeQuery('GoNGetz.Consumer',$query0);

  foreach ($cursor0 as $document0)
  {
    $consumeridChild = strval($document0->_id);
    $ConsumerFNameChild = strval($document0->ConsumerFName);
    $ConsumerLNameChild = strval($document0->ConsumerLName);
    $ConsumerIDTypeChild = strval($document0->ConsumerIDType);
    $ConsumerGroup_idChild = strval($document0->ConsumerGroup_id);

    $filter = ['ConsumerIDNo'=>$varConsumerIDNo,'ConsumerGroup_id'=>'6018c2ebc8c7c7b2e8a4140c'];
    $query = new MongoDB\Driver\Query($filter);
    $cursor =$GoNGetzDatabase->executeQuery('GoNGetz.Consumer',$query);

    foreach ($cursor as $document)
    {
      $consumerid = strval($document->_id);
      $ConsumerFName = strval($document->ConsumerFName);
      $ConsumerLName = strval($document->ConsumerLName);
      $ConsumerIDType = strval($document->ConsumerIDType);
      $ConsumerGroup_id = strval($document->ConsumerGroup_id);

      if($ConsumerGroup_idChild == '6018c32b10184a751c102eb6')
      {
        $count = 0;
        $end = 1;
        $filter1 = ['Schools_id'=>$varschoolID, 'Consumer_id'=>$consumeridChild];
        $query1 = new MongoDB\Driver\Query($filter1);
        $cursor1 =$GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Students',$query1);

        foreach ($cursor1 as $document1)
        {
          $Consumer_id = strval($document1->Consumer_id);
        }
        if ($consumeridChild==$Consumer_id)
        {
        ?>
        <br><br><br><br><div class="alert alert-danger" role="alert">
        <h2 style="text-align: center;">DUPLICATE ID NUMBER</h2>
        <form id="EditParentFormSubmit" name="EditParentFormSubmit" action="index.php?page=modal-recheckparentlist" method="post">
        <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header"></div>
            <div class="modal-body">
            <div class="form-group row">
                <h6 >You have entered an ID that already exist in this column.</h6>
                <h5 >EDIT THIS DATA?</h5>
            </div>
            <a style="color:#FFFFE0; text-decoration: none;" href="index.php?page=editparentduplicate&txtConsumerIDNoChild=<?php echo $varConsumerIDNoChild; ?>&txtConsumerIDNo=<?php echo $varConsumerIDNo; ?>"><button type="button" class="btn btn-secondary">Add Child</a>
                <button  onclick="index.php?page=parentlist" class="btn btn-secondary" >Close</button>
        </div>
        </div>
        </form>
        </div>
        <?php
        }
        else
        {
        $count++;
        $ID = strval($document->_id);
        $ConsumerFName = strval($document->ConsumerFName);
        $ConsumerIDNo = strval($document->ConsumerIDNo);
        ?>
        <br><br><br><br><h2 style="text-align: center;">PLEASE CONFIRM BEFORE PROCEED</h2>
        <form id="submitaddstudent" name="submitaddstudent" action="index.php?page=studentlist" method="post">
        <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="AddStudentModalLabel">Add Parent</h5>
                </div>
                <div class="modal-body">
                <div class="form-group row">
                    <label for="staticStaffNo" class="col-sm-2 col-form-label">Parent Name</label>
                    <div class="col-sm-10">
                    <input   value="<?php echo  $ConsumerFName; ?>" disabled>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="staticStaffNo" class="col-sm-2 col-form-label">ID Type</label>
                    <div class="col-sm-10">
                    <input  value="<?php echo  $ConsumerIDType; ?>" disabled><br>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="staticStaffNo" class="col-sm-2 col-form-label">MyKad Parent</label>
                    <div class="col-sm-10">
                    <input  value="<?php echo  $ConsumerIDNo; ?>" disabled><br>
                    <input type="hidden" name="txtConsumerIDNo" value="<?php echo  $ConsumerIDNo; ?>" >
                    </div>
                </div>
                <div class="form-group row">
                    <label for="staticStaffNo" class="col-sm-2 col-form-label">Child Name</label>
                    <div class="col-sm-10">
                    <input   value="<?php echo  $ConsumerFNameChild; ?>" disabled>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="staticStaffNo" class="col-sm-2 col-form-label">ID Type</label>
                    <div class="col-sm-10">
                    <input  value="<?php echo  $ConsumerIDTypeChild; ?>" disabled><br>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="staticStaffNo" class="col-sm-2 col-form-label">Mykad Child</label>
                    <div class="col-sm-10">
                    <input  value="<?php echo  $varConsumerIDNoChild; ?>" disabled><br>
                    <input type="hidden" name="txtConsumerIDNoChild" value="<?php echo  $varConsumerIDNoChild; ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="staticStaffNo" class="col-sm-2 col-form-label">Group</label>
                    <div class="col-sm-10">
                    <input   value="VIP" disabled>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="staticStaff" class="col-sm-2 col-form-label">Parent Status</label>
                    <div class="col-sm-10">
                    <input class="form-control" id="sltStatus" value="ACTIVE" disabled>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="staticStaff" class="col-sm-2 col-form-label">Relation</label>
                    <div class="col-sm-10">
                    <select class="form-control" id="txtrelation" name="txtrelation" >
                        <option value="FATHER">FATHER</option>
                        <option value="MOTHER">MOTHER</option>
                        <option value="GUARDIAN">GUARDIAN</option>
                        <option value="RELATIVE">RELATVE</option>
                    </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="txtstudentclass" class="col-sm-2 col-form-label">Class</label>
                    <div class="col-sm-10">
                    <select class="form-control" id="txtstudentclass" name="txtstudentclass">
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
                <button  onclick="index.php?page=studentlist" class="btn btn-secondary" >Close</button>
                <button type="submit" class="btn btn-secondary" name="submitaddstudent">Confirm</button>
                </div>
            </div>
        </div>
        </form>
        <?php
        if ($count == $end) break;
        }
        }
        else
        {
        ?>
        <br><br><br><br><div class="alert alert-danger" role="alert">
        <h2 style="text-align: center;">AUTHORIZED PERSONNEL ONLY</h2>
        <form id="submitstudent" name="submitstudent" action="index.php?page=studentlist" method="post">
        <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="AddParentModalLabel">Add Parent</h5>
                </div>
                <div class="modal-body">
                <div class="form-group row">
                    <label for="staticStaffNo" class="col-sm-2 col-form-label">Name</label>
                    <div class="col-sm-10">
                    <input   value="<?php echo  $ConsumerFName; echo " "; echo  $ConsumerLName; ?>" disabled>
                    </div>
                </div>
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
                <button  onclick="index.php?page=studentlist" class="btn btn-secondary" >Close</button>
                </div>
            </div>
        </div>
        </form>
        </div>
        <?php
    }
}
}
}
?>


<?php
if (isset($_POST['EditStudentFormSubmit']))
{
  $varClasscategory = $_POST['txtClasscategory'];
  $varstudentid = strval($_POST['txtstudentid']);
  $varstudentid = new \MongoDB\BSON\ObjectId($varstudentid);
  $filter = ['_id'=>$varstudentid];
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

?>
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
<?php
    }
  }
}
?>
