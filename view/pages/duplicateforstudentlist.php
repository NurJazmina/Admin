<?php
  $ConsumerIDNoParent = $_POST['ConsumerIDNoParent'];
  $ConsumerIDNoChild = $_POST['ConsumerIDNoChild'];
  $Classcategory = $_POST['Classcategory'];
  
  $studentid = "";
  $parentid = "";
  $ParentConsumerid = "";
  $ParentStudentRelation = "";
    
  $filter = ['ConsumerIDNo'=>$ConsumerIDNoChild];
  $query = new MongoDB\Driver\Query($filter);
  $cursor = $GoNGetzDatabase->executeQuery('GoNGetz.Consumer',$query);
  foreach ($cursor as $document) 
  {
    $childconsumerid = strval($document->_id);
    $ConsumerFNameChild = $document->ConsumerFName;
    $ConsumerLNameChild = $document->ConsumerLName;

    $filter = ['Consumer_id'=>$childconsumerid];
    $query = new MongoDB\Driver\Query($filter);
    $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Students',$query);
    foreach ($cursor as $document)
    {
      $studentid = strval($document->_id);
    }
  }  
  
  $filter = ['ConsumerIDNo'=>$ConsumerIDNoParent];
  $query = new MongoDB\Driver\Query($filter);
  $cursor = $GoNGetzDatabase->executeQuery('GoNGetz.Consumer',$query);
  foreach ($cursor as $document) 
  {
    $parentconsumerid = strval($document->_id);
    $ConsumerFName = $document->ConsumerFName;
    $ConsumerLName = $document->ConsumerLName;
    
    $filter = ['ConsumerID'=>$parentconsumerid];
    $query = new MongoDB\Driver\Query($filter);
    $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Parents',$query);
    foreach ($cursor as $document) 
    {
      $parentid = strval($document->_id);

      $filter = ['ParentID'=>$parentid];
      $query = new MongoDB\Driver\Query($filter);
      $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.ParentStudentRel',$query);
      foreach ($cursor as $document) 
      {
        $ParentStudentRelation = strval($document->ParentStudentRelation);
      }
    }
  } 

if (isset($_POST['addrelation']))
{
    ?>
    <br><br><br><br>
    <h2 style="text-align: center;">PLEASE CONFIRM BEFORE PROCEED</h2>
    <form id="addrelation" name="addrelation" action="index.php?page=studentlist" method="post">
      <div class="modal-dialog modal-lg modal-dialog-centered">
      <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="EditParentModalLabel">Edit Relation</h5>
            </div>
            <div class="modal-body">
              <div class="form-group row">
                <label for="staticStaffNo" class="col-sm-2 col-form-label">Parent Name</label>
                <div class="col-sm-10">
                  <input class="form-control" value="<?php echo  $ConsumerFName." ".$ConsumerLName; ?>" disabled>
                  <input type="hidden" name="txtparentid" value="<?php echo $parentid; ?>">
                </div>
              </div>
              <div class="form-group row">
                <label for="staticStaffNo" class="col-sm-2 col-form-label">Child Name</label>
                <div class="col-sm-10">
                  <input class="form-control" value="<?php echo $ConsumerFNameChild." ".$ConsumerLNameChild; ?>" disabled><br>
                  <input type="hidden" name="txtstudentid" value="<?php echo $studentid; ?>">
                </div>
              </div>
              <div class="form-group row">
                <label for="staticStaff" class="col-sm-2 col-form-label">Relation</label>
                <div class="col-sm-10">
                    <input class="form-control" value="<?php echo $ParentStudentRelation; ?>" disabled><br>
                    <input type="hidden" name="txtParentStudentRelation" value="<?php echo $ParentStudentRelation; ?>">
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button  onclick="index.php?page=studentlist" class="btn btn-secondary" >Close</button>
              <button type="submit" class="btn btn-success" name="addrelation">Confirm</button>
            </div>
          </div>
      </div>
    </form>
    <?php
}

if (isset($_POST['addrelationstudent']))
{
    ?>
    <br><br><br><br>
    <h2 style="text-align: center;">PLEASE CONFIRM BEFORE PROCEED</h2>
    <form id="addrelationstudent" name="addrelationstudent" action="index.php?page=studentlist" method="post">
      <div class="modal-dialog modal-lg modal-dialog-centered">
      <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="EditParentModalLabel">Add Student</h5>
            </div>
            <div class="modal-body">
              <div class="form-group row">
                <label for="staticStaffNo" class="col-sm-2 col-form-label">Parent Name</label>
                <div class="col-sm-10">
                  <input class="form-control" value="<?php echo  $ConsumerFName." ".$ConsumerLName; ?>" disabled>
                  <input type="hidden" name="txtparentid" value="<?php echo $parentid; ?>">
                </div>
              </div>
              <div class="form-group row">
                <label for="staticStaffNo" class="col-sm-2 col-form-label">Child Name</label>
                <div class="col-sm-10">
                  <input class="form-control" value="<?php echo $ConsumerFNameChild." ".$ConsumerLNameChild; ?>" disabled><br>
                  <input type="hidden" name="txtchildconsumerid" value="<?php echo $childconsumerid; ?>">
                </div>
              </div>
              <div class="form-group row">
                <label for="staticStaff" class="col-sm-2 col-form-label">Relation</label>
                <div class="col-sm-10">
                    <input class="form-control" value="<?php echo $ParentStudentRelation; ?>" disabled><br>
                    <input type="hidden" name="txtParentStudentRelation" value="<?php echo $ParentStudentRelation; ?>">
                </div>
              </div>
              <div class="form-group row">
                <label for="txtstudentclass" class="col-sm-2 col-form-label">Class</label>
                <div class="col-sm-10">
                  <select class="form-control" id="txtstudentclass" name="txtstudentclass">
                    <?php
                    $filter1 = ['SchoolID'=>$_SESSION["loggeduser_schoolID"], 'ClassCategory'=>$Classcategory];
                    $query1 = new MongoDB\Driver\Query($filter1);
                    $cursor1 = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Classrooms',$query1);
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
              <button type="submit" class="btn btn-success" name="addrelationstudent">Confirm</button>
            </div>
          </div>
      </div>
    </form>
    <?php
}

if (isset($_POST['addrelationparent']))
{
    ?>
    <br><br><br><br>
    <h2 style="text-align: center;">PLEASE CONFIRM BEFORE PROCEED</h2>
    <form id="addrelationparent" name="addrelationparent" action="index.php?page=studentlist" method="post">
      <div class="modal-dialog modal-lg modal-dialog-centered">
      <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="EditParentModalLabel">Add Parent</h5>
            </div>
            <div class="modal-body">
              <div class="form-group row">
                <label for="staticStaffNo" class="col-sm-2 col-form-label">Parent Name</label>
                <div class="col-sm-10">
                  <input class="form-control" value="<?php echo  $ConsumerFName." ".$ConsumerLName; ?>" disabled>
                  <input type="hidden" name="txtparentconsumerid" value="<?php echo $parentconsumerid; ?>">
                </div>
              </div>
              <div class="form-group row">
                <label for="staticStaffNo" class="col-sm-2 col-form-label">Child Name</label>
                <div class="col-sm-10">
                  <input class="form-control" value="<?php echo $ConsumerFNameChild." ".$ConsumerLNameChild; ?>" disabled><br>
                  <input type="hidden" name="txtstudentid" value="<?php echo $studentid; ?>">
                </div>
              </div>
              <div class="form-group row">
                <label for="staticStaff" class="col-sm-2 col-form-label">Relation</label>
                <div class="col-sm-10">
                    <select class="form-control" id="txtrelation" name="txtParentStudentRelation" >
                      <option value="FATHER">FATHER</option>
                      <option value="MOTHER">MOTHER</option>
                      <option value="GUARDIAN">GUARDIAN</option>
                      <option value="RELATIVE">RELATVE</option>
                    </select>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button  onclick="index.php?page=studentlist" class="btn btn-secondary" >Close</button>
              <button type="submit" class="btn btn-success" name="addrelationparent">Confirm</button>
            </div>
          </div>
      </div>
    </form>
    <?php
}
?>