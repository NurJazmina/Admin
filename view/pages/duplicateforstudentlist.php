<?php
  $parent_consumer_idno = $_POST['parent_consumer_idno'];
  $student_consumer_idno = $_POST['student_consumer_idno'];
  $class_category = $_POST['class_category'];
  
  $studentid = "";
  $parentid = "";
  $ParentConsumerid = "";
  $ParentStudentRelation = "";
    
  $filter = ['ConsumerIDNo'=>$student_consumer_idno];
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
  
  $filter = ['ConsumerIDNo'=>$parent_consumer_idno];
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
        $ParentStudentRelation = $document->ParentStudentRelation;
      }
    }
  } 

if (isset($_POST['duplicate_add_relation']))
{
  ?>
  <div class="text-dark-50 text-center m-5">
    <h1>PLEASE CONFIRM BEFORE PROCEED</h1>
  </div>
  <form name="add_relation" action="index.php?page=studentlist" method="post">
    <div class="modal-dialog modal-lg modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Edit Relation</h5>
        </div>
        <div class="modal-body">
          <div class="form-group row">
            <label class="col-sm-2 col-form-label">Parent Name</label>
            <div class="col-sm-10">
              <input class="form-control" value="<?=  $ConsumerFName." ".$ConsumerLName; ?>" disabled>
              <input type="hidden" name="txtparentid" value="<?= $parentid; ?>">
            </div>
          </div>
          <div class="form-group row">
            <label class="col-sm-2 col-form-label">Child Name</label>
            <div class="col-sm-10">
              <input class="form-control" value="<?= $ConsumerFNameChild." ".$ConsumerLNameChild; ?>" disabled><br>
              <input type="hidden" name="txtstudentid" value="<?= $studentid; ?>">
            </div>
          </div>
          <div class="form-group row">
            <label class="col-sm-2 col-form-label">Relation</label>
            <div class="col-sm-10">
                <input class="form-control" value="<?= $ParentStudentRelation; ?>" disabled><br>
                <input type="hidden" name="relation" value="<?= $ParentStudentRelation; ?>">
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button onclick="index.php?page=studentlist" class="btn btn-light btn-sm">Close</button>
          <button type="submit" class="btn btn-success btn-sm" name="add_relation">Confirm</button>
        </div>
      </div>
    </div>
  </form>
  <?php
}

if (isset($_POST['add_relation_student']))
{
  ?>
  <div class="text-dark-50 text-center m-5">
    <h1>PLEASE CONFIRM BEFORE PROCEED</h1>
  </div>
  <form name="add_relation_student" action="index.php?page=studentlist" method="post">
    <div class="modal-dialog modal-lg modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Edit Relation</h5>
        </div>
        <div class="modal-body">
          <div class="form-group row">
            <label class="col-sm-2 col-form-label">Parent Name</label>
            <div class="col-sm-10">
              <input class="form-control" value="<?=  $ConsumerFName." ".$ConsumerLName; ?>" disabled>
              <input type="hidden" name="txtparentid" value="<?= $parentid; ?>">
            </div>
          </div>
          <div class="form-group row">
            <label class="col-sm-2 col-form-label">Child Name</label>
            <div class="col-sm-10">
              <input class="form-control" value="<?= $ConsumerFNameChild." ".$ConsumerLNameChild; ?>" disabled><br>
              <input type="hidden" name="txtchildconsumerid" value="<?= $childconsumerid; ?>">
            </div>
          </div>
          <div class="form-group row">
            <label class="col-sm-2 col-form-label">Relation</label>
            <div class="col-sm-10">
                <input class="form-control" value="<?= $ParentStudentRelation; ?>" disabled><br>
                <input type="hidden" name="txtParentStudentRelation" value="<?= $ParentStudentRelation; ?>">
            </div>
          </div>
          <div class="form-group row">
            <label for="txtstudentclass" class="col-sm-2 col-form-label">Class</label>
            <div class="col-sm-10">
              <select class="form-control" id="txtstudentclass" name="txtstudentclass">
                <?php
                $filter = ['SchoolID'=>$_SESSION["loggeduser_schoolID"],'ClassCategory'=>$class_category];
                $query = new MongoDB\Driver\Query($filter);
                $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Classrooms',$query);
                foreach ($cursor as $document)
                {
                  ?>
                  <option value="<?=($document1->_id)?>"><?=($document1->ClassName)?></option>
                  <?php
                }
                ?>
              </select>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button onclick="index.php?page=studentlist" class="btn btn-light btn-sm">Close</button>
          <button type="submit" class="btn btn-success btn-sm" name="add_relation_student">Confirm</button>
        </div>
      </div>
    </div>
  </form>
  <?php
}

if (isset($_POST['add_relation_parent']))
{
  ?>
  <div class="text-dark-50 text-center m-5">
    <h1>PLEASE CONFIRM BEFORE PROCEED</h1>
  </div>
  <form name="add_relation_parent" action="index.php?page=studentlist" method="post">
    <div class="modal-dialog modal-lg modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Edit Relation</h5>
        </div>
        <div class="modal-body">
          <div class="form-group row">
            <label class="col-sm-2 col-form-label">Parent Name</label>
            <div class="col-sm-10">
              <input class="form-control" value="<?=  $ConsumerFName." ".$ConsumerLName; ?>" disabled>
              <input type="hidden" name="parent_id" value="<?= $parentconsumerid; ?>">
            </div>
          </div>
          <div class="form-group row">
            <label class="col-sm-2 col-form-label">Child Name</label>
            <div class="col-sm-10">
              <input class="form-control" value="<?= $ConsumerFNameChild." ".$ConsumerLNameChild; ?>" disabled><br>
              <input type="hidden" name="student_id" value="<?= $studentid; ?>">
            </div>
          </div>
          <div class="form-group row">
            <label class="col-sm-2 col-form-label">Relation</label>
            <div class="col-sm-10">
                <select class="form-control" id="txtrelation" name="relation" >
                  <option value="FATHER">FATHER</option>
                  <option value="MOTHER">MOTHER</option>
                  <option value="GUARDIAN">GUARDIAN</option>
                  <option value="RELATIVE">RELATVE</option>
                </select>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button onclick="index.php?page=studentlist" class="btn btn-light btn-sm">Close</button>
          <button type="submit" class="btn btn-success btn-sm" name="add_relation_parent">Confirm</button>
        </div>
      </div>
    </div>
  </form>
  <?php
    ?>
    <h2 style="text-align: center;">PLEASE CONFIRM BEFORE PROCEED</h2>
    <form name="add_relation_parent" action="index.php?page=studentlist" method="post">
      <div class="modal-dialog modal-lg modal-dialog-centered">
      <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="EditParentModalLabel">Add Parent</h5>
            </div>
            <div class="modal-body">
              <div class="form-group row">
                <label class="col-sm-2 col-form-label">Parent Name</label>
                <div class="col-sm-10">
                  <input class="form-control" value="<?=  $ConsumerFName." ".$ConsumerLName; ?>" disabled>
                  <input type="hidden" name="txtparentconsumerid" value="<?= $parentconsumerid; ?>">
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-2 col-form-label">Child Name</label>
                <div class="col-sm-10">
                  <input class="form-control" value="<?= $ConsumerFNameChild." ".$ConsumerLNameChild; ?>" disabled><br>
                  <input type="hidden" name="txtstudentid" value="<?= $studentid; ?>">
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-2 col-form-label">Relation</label>
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
              <button type="submit" class="btn btn-success" name="add_relation_parent">Confirm</button>
            </div>
          </div>
      </div>
    </form>
    <?php
}
?>