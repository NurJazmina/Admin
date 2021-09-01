<?php
$_SESSION["title"] = "Re-checking";
include 'view/partials/_subheader/subheader-v1.php';

$parent_idno = $_POST['parent_idno'];
$student_idno = $_POST['student_idno'];
$class_category = $_POST['class_category'];

$student_id = '';
$parent_id = '';
$ParentConsumerid = '';
$ParentStudentRelation = '';
  
$filter = ['ConsumerIDNo'=>$student_idno];
$query = new MongoDB\Driver\Query($filter);
$cursor = $GoNGetzDatabase->executeQuery('GoNGetz.Consumer',$query);
foreach ($cursor as $document) 
{
  $student_consumer_id = strval($document->_id);
  $ConsumerFNameChild = $document->ConsumerFName;
  $ConsumerLNameChild = $document->ConsumerLName;

  $filter = ['Consumer_id'=>$student_consumer_id];
  $query = new MongoDB\Driver\Query($filter);
  $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Students',$query);
  foreach ($cursor as $document)
  {
    $student_id = strval($document->_id);
  }
}  

$filter = ['ConsumerIDNo'=>$parent_idno];
$query = new MongoDB\Driver\Query($filter);
$cursor = $GoNGetzDatabase->executeQuery('GoNGetz.Consumer',$query);
foreach ($cursor as $document) 
{
  $parent_consumer_id = strval($document->_id);
  $ConsumerFName = $document->ConsumerFName;
  $ConsumerLName = $document->ConsumerLName;
  
  $filter = ['ConsumerID'=>$parent_consumer_id];
  $query = new MongoDB\Driver\Query($filter);
  $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Parents',$query);
  foreach ($cursor as $document) 
  {
    $parent_id = strval($document->_id);

    $filter = ['ParentID'=>$parent_id];
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
            </div>
          </div>
          <div class="form-group row">
            <label class="col-sm-2 col-form-label">Child Name</label>
            <div class="col-sm-10">
              <input class="form-control" value="<?= $ConsumerFNameChild." ".$ConsumerLNameChild; ?>" disabled>
            </div>
          </div>
          <div class="form-group row">
            <label class="col-sm-2 col-form-label">Relation</label>
            <div class="col-sm-10">
                <input class="form-control" value="<?= $ParentStudentRelation; ?>" disabled>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <input type="hidden" name="parent_id" value="<?= $parent_id; ?>">
          <input type="hidden" name="student_id" value="<?= $student_id; ?>">
          <input type="hidden" name="relation" value="<?= $ParentStudentRelation; ?>">
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
            </div>
          </div>
          <div class="form-group row">
            <label class="col-sm-2 col-form-label">Child Name</label>
            <div class="col-sm-10">
              <input class="form-control" value="<?= $ConsumerFNameChild." ".$ConsumerLNameChild; ?>" disabled>
            </div>
          </div>
          <div class="form-group row">
            <label class="col-sm-2 col-form-label">Relation</label>
            <div class="col-sm-10">
                <input class="form-control" value="<?= $ParentStudentRelation; ?>" disabled>
            </div>
          </div>
          <div class="form-group row">
            <label class="col-sm-2 col-form-label">Class</label>
            <div class="col-sm-10">
              <select class="form-control" name="class">
                <?php
                $filter = ['SchoolID'=>$_SESSION["loggeduser_schoolID"],'ClassCategory'=>$class_category];
                $query = new MongoDB\Driver\Query($filter);
                $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Classrooms',$query);
                foreach ($cursor as $document)
                {
                  ?>
                  <option value="<?=($document->_id)?>"><?=($document->ClassName)?></option>
                  <?php
                }
                ?>
              </select>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <input type="hidden" name="parent_id" value="<?= $parent_id; ?>">
          <input type="hidden" name="student_consumer_id" value="<?= $student_consumer_id; ?>">
          <input type="hidden" name="relation" value="<?= $ParentStudentRelation; ?>">
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
            </div>
          </div>
          <div class="form-group row">
            <label class="col-sm-2 col-form-label">Child Name</label>
            <div class="col-sm-10">
              <input class="form-control" value="<?= $ConsumerFNameChild." ".$ConsumerLNameChild; ?>" disabled>
            </div>
          </div>
          <div class="form-group row">
            <label class="col-sm-2 col-form-label">Relation</label>
            <div class="col-sm-10">
                <select class="form-control" name="relation">
                  <option value="FATHER">FATHER</option>
                  <option value="MOTHER">MOTHER</option>
                  <option value="GUARDIAN">GUARDIAN</option>
                  <option value="RELATIVE">RELATVE</option>
                </select>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <input type="hidden" name="parent_consumer_id" value="<?= $parent_consumer_id; ?>">
          <input type="hidden" name="student_id" value="<?= $student_id; ?>">
          <button onclick="index.php?page=studentlist" class="btn btn-light btn-sm">Close</button>
          <button type="submit" class="btn btn-success btn-sm" name="add_relation_parent">Confirm</button>
        </div>
      </div>
    </div>
  </form>
  <?php
}
?>