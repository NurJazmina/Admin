<?php
$_SESSION["title"] = "Re-checking";
include 'view/partials/_subheader/subheader-v1.php';

if (isset($_POST['recheck_add_student']))
{
  $school_id = $_SESSION["loggeduser_school_id"];
  $parent_idno = $_POST['parent_idno'];
  $student_idno = $_POST['student_idno'];
  $class_category = $_POST['class_category'];

  $consumer_student_id = '';
  $ConsumerGroup_idChild = '';
  $filter = ['ConsumerIDNo'=>$student_idno];
  $query = new MongoDB\Driver\Query($filter);
  $cursor = $GoNGetzDatabase->executeQuery('GoNGetz.Consumer',$query);
  foreach ($cursor as $document)
  {
    $consumer_student_id = strval($document->_id);
    $ConsumerFNameChild = $document->ConsumerFName;
    $ConsumerLNameChild = $document->ConsumerLName;
    $ConsumerIDTypeChild = $document->ConsumerIDType;
    $ConsumerIDNoChild = $document->ConsumerIDNo;
    $ConsumerGroup_idChild = $document->ConsumerGroup_id;
  }

  $studentid = '';
  $filter = ['Schools_id'=>$school_id,'Consumer_id'=>$consumer_student_id];
  $query = new MongoDB\Driver\Query($filter);
  $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Students',$query);
  foreach ($cursor as $document)
  {
    $studentid = strval($document->_id);
  }

  $consumer_parent_id = '';
  $ConsumerGroup_id = '';
  $filter = ['ConsumerIDNo'=>$parent_idno];
  $query = new MongoDB\Driver\Query($filter);
  $cursor = $GoNGetzDatabase->executeQuery('GoNGetz.Consumer',$query);
  foreach ($cursor as $document2)
  {
    $consumer_parent_id = strval($document2->_id);
    $ConsumerFName = $document2->ConsumerFName;
    $ConsumerLName = $document2->ConsumerLName;
    $ConsumerIDType = $document2->ConsumerIDType;
    $ConsumerGroup_id = $document2->ConsumerGroup_id;
  }
  if($ConsumerGroup_idChild == '6018c32b10184a751c102eb6')//student
  {
    if($ConsumerGroup_id == '6018c2ebc8c7c7b2e8a4140c' || $ConsumerGroup_id == '601b4cfd97728c027c01f187')//vip && school
    {
      $filter = ['ConsumerID'=>$consumer_parent_id];
      $query = new MongoDB\Driver\Query($filter);
      $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Parents',$query);
      foreach ($cursor as $document)
      {
        $parent_id = strval($document->_id);
        $ParentConsumerid = $document->ConsumerID;

        $filter = ['ParentID'=>$parent_id];
        $query = new MongoDB\Driver\Query($filter);
        $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.ParentStudentRel',$query);
        foreach ($cursor as $document) 
        {
          $ParentStudentRelation = $document->ParentStudentRelation;
        }
      }

      //parent already exist
      if ($consumer_parent_id == $ParentConsumerid)
      {
        //parent already exist
        if($studentid == '')
        {
          ?>
          <!-- redundant data -->
          <div class="text-dark-50 text-center">
            <h1>PARENT ALREADY EXIST</h1>
          </div>
          <form name="add_relation_student" action="index.php?page=duplicate_student_parent" method="post">
            <div class="modal-dialog modal-lg modal-dialog-centered">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title">Add Parent</h5>
                </div>
                <div class="modal-body">
                  <div class="form-group row">
                    <label>This Parent already have existing account. Do you want to add another child?</label>
                  </div>
                </div>
                <div class="modal-footer">
                  <input type="hidden" name="parent_idno" value="<?= $parent_idno; ?>">
                  <input type="hidden" name="student_idno" value="<?= $student_idno; ?>">
                  <input type="hidden" name="class_category" value="<?= $class_category; ?>">
                  <button type="submit" name="add_relation_student" class="btn btn-success btn-hover-light">Proceed</a>
                </div>
              </div>
            </div>
          </form>
          <!-- redundant data -->
          <?php
        }
        //student and parent already exist
        else
        {
          ?>
          <!-- redundant data -->
          <div class="text-dark-50 text-center">
            <h1>PARENT AND STUDENT ALREADY EXIST</h1>
          </div>
          <form name="duplicate_add_relation" action="index.php?page=duplicate_student_parent" method="post">
            <div class="modal-dialog modal-lg modal-dialog-centered">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title">Add Relation</h5>
                </div>
                <div class="modal-body">
                  <div class="form-group row">
                    <label>This Student and Parent already have existing account. Do you want to link between these two consumer?</label>
                  </div>
                </div>
                <div class="modal-footer">
                  <input type="hidden" name="parent_idno" value="<?= $parent_idno; ?>">
                  <input type="hidden" name="student_idno" value="<?= $student_idno; ?>">
                  <input type="hidden" name="class_category" value="<?= $class_category; ?>">
                  <button name="duplicate_add_relation" type="submit" class="btn btn-success btn-hover-light">Proceed</button>
                </div>
              </div>
            </div>
          </form>
          <!-- redundant data -->
          <?php
        }
      }
      //parent not exist
      else
      {
        //student and parent not exist
        if($studentid == '')
        {
          ?>
          <!-- redundant data -->
          <div class="text-dark-50 text-center">
            <h1>PLEASE CONFIRM BEFORE PROCEED</h1>
          </div>
          <form name="add_student" action="index.php?page=studentlist" method="post">
            <div class="modal-dialog modal-lg modal-dialog-centered">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title">Add Parent and Student</h5>
                </div>
                <div class="modal-body">
                    <div class="form-group row">
                      <label class="col-sm-2 col-form-label">Parent Name</label>
                      <div class="col-sm-10">
                        <input class="form-control"  value="<?=  $ConsumerFName; ?>" disabled>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-sm-2 col-form-label">ID Type</label>
                      <div class="col-sm-10">
                        <input class="form-control" value="<?=  $ConsumerIDType; ?>" disabled><br>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-sm-2 col-form-label">MyKad Parent</label>
                      <div class="col-sm-10">
                        <input class="form-control" value="<?=  $parent_idno; ?>" disabled><br>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-sm-2 col-form-label">Child Name</label>
                      <div class="col-sm-10">
                        <input class="form-control" value="<?=  $ConsumerFNameChild; ?>" disabled>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-sm-2 col-form-label">ID Type</label>
                      <div class="col-sm-10">
                        <input class="form-control" value="<?=  $ConsumerIDTypeChild; ?>" disabled><br>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-sm-2 col-form-label">Mykad Child</label>
                      <div class="col-sm-10">
                        <input class="form-control" value="<?=  $student_idno; ?>" disabled><br>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-sm-2 col-form-label">Parent Status</label>
                      <div class="col-sm-10">
                        <input class="form-control" id="status" value="ACTIVE" disabled>
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
                    <div class="form-group row">
                      <label class="col-sm-2 col-form-label">Class</label>
                      <div class="col-sm-10">
                        <select class="form-control" name="class">
                          <?php
                          $filter = ['SchoolID'=>$_SESSION["loggeduser_school_id"], 'ClassCategory'=>$class_category];
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
                  <input type="hidden" name="parent_idno" value="<?=  $parent_idno; ?>" >
                  <input type="hidden" name="student_idno" value="<?=  $student_idno; ?>">
                  <button onclick="index.php?page=studentlist" class="btn btn-light btn-hover-success btn-sm">Close</button>
                  <button type="submit" class="btn btn-success btn-hover-light btn-sm" name="add_student">Confirm</button>
                </div>
              </div>
            </div>
          </form>
          <!-- redundant data -->
          <?php
        }
        //parent not exist
        else
        {
          ?>
          <!-- redundant data -->
          <div class="text-dark-50 text-center">
            <h1>STUDENT ALREADY EXIST</h1>
          </div>
          <form name="add_relation_parent" action="index.php?page=duplicate_student_parent" method="post">
            <div class="modal-dialog modal-lg modal-dialog-centered">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title">Add Student</h5>
                </div>
                <div class="modal-body">
                  <div class="form-group row">
                    <label>This Student already have existing account. Do you want to add another family member?</label>
                  </div>
                </div>
                <div class="modal-footer">
                  <input type="hidden" name="parent_idno" value="<?= $parent_idno; ?>">
                  <input type="hidden" name="student_idno" value="<?= $student_idno; ?>">
                  <input type="hidden" name="class_category" value="<?= $class_category; ?>">
                  <button onclick="index.php?page=studentlist" class="btn btn-light btn-hover-success btn-sm">Student list</button>
                  <button name="add_relation_parent" type="submit" class="btn btn-success btn-hover-light">Proceed</a>
                </div>
              </div>
            </div>
          </form>
          <!-- redundant data -->
          <?php
        }
      }
    }
    elseif ($ConsumerGroup_id == '6018c32b10184a751c102eb6')//student
    {
      ?>
      <!-- group : student -->
      <div class="text-dark-50 text-center">
        <h1>AUTHORIZED PERSONNEL ONLY</h1>
      </div>
      <form action="index.php?page=student_detail&id=<?= $consumer_parent_id; ?>" method="post">
        <div class="modal-dialog modal-lg modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Add Parent</h5>
            </div>
            <div class="modal-body">
              <div class="form-group row">
                <label class="col-sm-2 col-form-label">Consumer Name</label>
                <div class="col-sm-10">
                  <input class="form-control" value="<?= $ConsumerFName." ".$ConsumerLName; ?>" disabled>
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-2 col-form-label">MyKad</label>
                <div class="col-sm-10">
                  <input class="form-control" value="<?= $parent_idno; ?>" disabled>
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-2 col-form-label">Group</label>
                <div class="col-sm-10">
                  <input class="form-control" value="UNAUTHORIZED" disabled>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button class="btn btn-success btn-hover-light btn-hover-light btn-sm">Resume Consumer Detail</button>
            </div>
          </div>
        </div>
      </form>
      <!-- group : student -->
      <?php
    }
    else
    {
      ?>
      <!-- group : gongetz | else -->
      <div class="text-dark-50 text-center">
        <h1>AUTHORIZED PERSONNEL ONLY</h1>
      </div>
      <form action="index.php?page=studentlist" method="post">
        <div class="modal-dialog modal-lg modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Add Parent</h5>
            </div>
            <div class="modal-body">
              <div class="form-group row">
                <label class="col-sm-2 col-form-label">MyKad</label>
                <div class="col-sm-10">
                  <input class="form-control" value="<?= $parent_idno; ?>" disabled>
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-2 col-form-label">Group</label>
                <div class="col-sm-10">
                  <input class="form-control" value="UNAUTHORIZED" disabled>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button class="btn btn-success btn-hover-light btn-hover-light btn-sm">Return</button>
            </div>
          </div>
        </div>
      </form>
      <!-- group : gongetz | else -->
      <?php
    }
  }
  elseif ($ConsumerGroup_idChild == '6018c2ebc8c7c7b2e8a4140c' || $ConsumerGroup_idChild == '601b4cfd97728c027c01f187')//vip && school
  {
    if($ConsumerGroup_idChild == '6018c2ebc8c7c7b2e8a4140c')
    {
      $detail = 'parent_detail';
    }
    else
    {
      $detail = 'staff_detail';
    }
    ?>
    <!-- group : vip | school -->
    <div class="text-dark-50 text-center">
      <h1>AUTHORIZED PERSONNEL ONLY</h1>
    </div>
    <form action="index.php?page=<?= $detail; ?>&id=<?= $studentid; ?>" method="post">
      <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Add Student</h5>
          </div>
          <div class="modal-body">
            <div class="form-group row">
              <label class="col-sm-2 col-form-label">Consumer Name</label>
              <div class="col-sm-10">
                <input class="form-control" value="<?= $ConsumerFNameChild." ".$ConsumerLNameChild; ?>" disabled>
              </div>
            </div>
            <div class="form-group row">
              <label class="col-sm-2 col-form-label">MyKad</label>
              <div class="col-sm-10">
                <input class="form-control" value="<?= $student_idno; ?>" disabled>
              </div>
            </div>
            <div class="form-group row">
              <label class="col-sm-2 col-form-label">Group</label>
              <div class="col-sm-10">
                <input class="form-control" value="UNAUTHORIZED" disabled>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button class="btn btn-success btn-hover-light btn-hover-light btn-sm">Resume Consumer Detail</button>
          </div>
        </div>
      </div>
    </form>
    <!-- group : vip | school -->
    <?php
  }
  else
  {
    ?>
    <!-- group : gongetz | else -->
    <div class="text-dark-50 text-center">
      <h1>AUTHORIZED PERSONNEL ONLY</h1>
    </div>
    <form action="index.php?page=studentlist" method="post">
      <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Add Student</h5>
          </div>
          <div class="modal-body">
            <div class="form-group row">
              <label class="col-sm-2 col-form-label">MyKad</label>
              <div class="col-sm-10">
                <input class="form-control" value="<?= $student_idno; ?>" disabled>
              </div>
            </div>
            <div class="form-group row">
              <label class="col-sm-2 col-form-label">Group</label>
              <div class="col-sm-10">
                <input class="form-control" value="UNAUTHORIZED" disabled>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button class="btn btn-success btn-hover-light btn-hover-light btn-sm">Return</button>
          </div>
        </div>
      </div>
    </form>
    <!-- group : gongetz | else -->
    <?php
  }
}


if (isset($_POST['recheck_edit_student']))
{
  $class_category = $_POST['class_category'];
  $student_id = strval($_POST['student_id']);
  
  $filter = ['_id'=>new \MongoDB\BSON\ObjectId($student_id)];
  $query = new MongoDB\Driver\Query($filter);
  $cursor =$GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Students',$query);
  foreach ($cursor as $document)
  {
    $Consumer_id = $document->Consumer_id;

    $filter = ['_id'=> new \MongoDB\BSON\ObjectId($Consumer_id)];
    $query = new MongoDB\Driver\Query($filter);
    $cursor = $GoNGetzDatabase->executeQuery('GoNGetz.Consumer',$query);
    foreach ($cursor as $document)
    {
      $ConsumerFName = $document->ConsumerFName;
      $ConsumerLName = $document->ConsumerLName;
      $ConsumerIDNo = $document->ConsumerIDNo;
      ?>
      <div class="text-dark-50 text-center">
        <h1>PLEASE CONFIRM BEFORE PROCEED</h1>
      </div>
      <form name="edit_student" action="index.php?page=studentlist" method="post">
        <div class="modal-dialog modal-lg modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Edit Class</h5>
            </div>
            <div class="modal-body">
              <div class="form-group row">
                <label class="col-sm-2 col-form-label">Student Name</label>
                <div class="col-sm-10">
                  <input class="form-control" value="<?= $ConsumerFName." ".$ConsumerLName; ?>" disabled>
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-2 col-form-label">MyKad</label>
                <div class="col-sm-10">
                  <input class="form-control" value="<?= $ConsumerIDNo; ?>" disabled>
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-2 col-form-label">Class category</label>
                <div class="col-sm-10">
                  <input class="form-control" value="<?= $class_category; ?>" disabled>
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-2 col-form-label">Class</label>
                <div class="col-sm-10">
                  <select class="form-control" name="class_id">
                  <?php
                  $filter = ['SchoolID'=>$school_id,'ClassCategory'=>$class_category];
                  $query = new MongoDB\Driver\Query($filter);
                  $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Classrooms',$query);
                  foreach ($cursor as $document)
                  {
                    $class_id = strval($document->_id);
                    $ClassName = $document->ClassName;
                    ?>
                    <option value="<?= $class_id; ?>"><?= $ClassName; ?></option>
                    <?php
                  }
                  ?>
                  </select>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <input type="hidden" name="consumer_student_id" value="<?=  $student_id; ?>">
              <button type="button" class="btn btn-light btn-hover-success btn-sm" data-bs-dismiss="modal">Cancel</button>
              <button type="submit" class="btn btn-success btn-hover-light btn-sm" name="edit_student">Confirm</button>
            </div>
          </div>
        </div>
      </form>
      <?php
    }
  }
}
?>
