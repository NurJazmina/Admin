<?php
if (isset($_POST['AddStudentFormSubmit']))
{
  $schoolID = strval($_SESSION["loggeduser_schoolID"]);
  $ConsumerIDNoParent = $_POST['txtConsumerIDNoParent'];
  $ConsumerIDNoChild = $_POST['txtConsumerIDNoChild'];
  $Classcategory = $_POST['txtClasscategory'];

  $ConsumerID = "";
  $studentid = "";
  $parentid = "";
  $ParentConsumerid = "";
  $ParentStudentRelation = "";

  $filter = ['ConsumerIDNo'=>$ConsumerIDNoChild,'ConsumerGroup_id'=>'6018c32b10184a751c102eb6'];
  $query = new MongoDB\Driver\Query($filter);
  $cursor = $GoNGetzDatabase->executeQuery('GoNGetz.Consumer',$query);
  foreach ($cursor as $document)
  {
    $studentconsumerid = strval($document->_id);
    $ConsumerFNameChild = strval($document->ConsumerFName);
    $ConsumerLNameChild = strval($document->ConsumerLName);
    $ConsumerIDTypeChild = strval($document->ConsumerIDType);

    $filter = ['Schools_id'=>$schoolID,'Consumer_id'=>$studentconsumerid];
    $query = new MongoDB\Driver\Query($filter);
    $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Students',$query);
    foreach ($cursor as $document)
    {
      $studentid = strval($document->_id);
    }

    $filter = ['ConsumerIDNo'=>$ConsumerIDNoParent];
    $query = new MongoDB\Driver\Query($filter);
    $cursor = $GoNGetzDatabase->executeQuery('GoNGetz.Consumer',$query);
    foreach ($cursor as $document)
    {
      $parentconsumerid = strval($document->_id);
      $ConsumerFName = strval($document->ConsumerFName);
      $ConsumerLName = strval($document->ConsumerLName);
      $ConsumerIDType = strval($document->ConsumerIDType);
      $ConsumerGroup_id = strval($document->ConsumerGroup_id);

      if($ConsumerGroup_id == '6018c2ebc8c7c7b2e8a4140c')
      {
        $filter = ['Schools_id'=>$schoolID, 'ConsumerID'=>$parentconsumerid];
        $query = new MongoDB\Driver\Query($filter);
        $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Parents',$query);
        foreach ($cursor as $document)
        {
          $parentid = strval($document->_id);
          $ParentConsumerid = strval($document->ConsumerID);

          $filter = ['ParentID'=>$parentid];
          $query = new MongoDB\Driver\Query($filter);
          $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.ParentStudentRel',$query);
          foreach ($cursor as $document) 
          {
            $ParentStudentRelation = strval($document->ParentStudentRelation);
          }
        }

        //parent already exist
        if ($parentconsumerid == $ParentConsumerid)
        {
          //parent already exist
          if($studentid == '')
          {
            ?>
            <form id="addrelationstudent" name="addrelationstudent" action="index.php?page=duplicateforstudentlist" method="post" style="padding-top: 10em;">
              <div class="modal-dialog modal-lg modal-dialog-centered">
              <div class="modal-content">
                  <div class="alert alert-danger" role="alert">
                    <h2 style="text-align:center;">PARENT ALREADY EXIST</h2>
                  </div>
                  <div class="modal-body">
                    <div class="form-group row">
                      <h6 style="color:	#696969;">This Parent already have existing account. Do you want to add another child?</h6>
                      <input type="hidden" name="ConsumerIDNoParent" value="<?php echo $ConsumerIDNoParent; ?>">
                      <input type="hidden" name="ConsumerIDNoChild" value="<?php echo $ConsumerIDNoChild; ?>">
                      <input type="hidden" name="Classcategory" value="<?php echo $Classcategory; ?>">
                    </div>
                  </div>
                  <div class="modal-footer">
                    <button  onclick="index.php?page=studentlist" class="btn btn-secondary">Close</button>
                    <button name="addrelationstudent" type="submit" class="btn btn-success">Proceed</a>
                  </div>
              </div>
            </form>
            <?php
          }
          //student and parent already exist
          else
          {
            ?>
            <form id="addrelation" name="addrelation" action="index.php?page=duplicateforstudentlist" method="post" style="padding-top: 10em;">
              <div class="modal-dialog modal-lg modal-dialog-centered">
              <div class="modal-content">
                  <div class="alert alert-danger" role="alert">
                    <h2 style="text-align:center;">STUDENT AND PARENT ALREADY EXIST</h2>
                  </div>
                  <div class="modal-body">
                    <div class="form-group row">
                      <h6 style="color:	#696969;">This Student and Parent already have existing account. Do you want to link between these two consumer?</h6>
                      <input type="hidden" name="ConsumerIDNoParent" value="<?php echo $ConsumerIDNoParent; ?>">
                      <input type="hidden" name="ConsumerIDNoChild" value="<?php echo $ConsumerIDNoChild; ?>">
                      <input type="hidden" name="Classcategory" value="<?php echo $Classcategory; ?>">
                    </div>
                  </div>
                  <div class="modal-footer">
                    <button  onclick="index.php?page=studentlist" class="btn btn-secondary">Close</button>
                    <button name="addrelation" type="submit" class="btn btn-success">Proceed</a>
                  </div>
              </div>
            </form>
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
            <div style="padding-top: 10em;">
            <h2 style="text-align: center;">PLEASE CONFIRM BEFORE PROCEED</h2>
            <form id="submitaddstudent" name="submitaddstudent" action="index.php?page=studentlist" method="post">
              <div class="modal-dialog modal-lg modal-dialog-centered">
              <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="AddParentModalLabel">Add Student and Parent</h5>
                    </div>
                    <div class="modal-body">
                      <div class="form-group row">
                        <label for="staticStaffNo" class="col-sm-2 col-form-label">Parent Name</label>
                        <div class="col-sm-10">
                          <input class="form-control"  value="<?php echo  $ConsumerFName; ?>" disabled>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="staticStaffNo" class="col-sm-2 col-form-label">ID Type</label>
                        <div class="col-sm-10">
                          <input class="form-control" value="<?php echo  $ConsumerIDType; ?>" disabled><br>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="staticStaffNo" class="col-sm-2 col-form-label">MyKad Parent</label>
                        <div class="col-sm-10">
                          <input class="form-control" value="<?php echo  $ConsumerIDNoParent; ?>" disabled><br>
                          <input type="hidden" name="txtConsumerIDNoParent" value="<?php echo  $ConsumerIDNoParent; ?>" >
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="staticStaffNo" class="col-sm-2 col-form-label">Child Name</label>
                        <div class="col-sm-10">
                          <input class="form-control" value="<?php echo  $ConsumerFNameChild; ?>" disabled>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="staticStaffNo" class="col-sm-2 col-form-label">ID Type</label>
                        <div class="col-sm-10">
                          <input class="form-control" value="<?php echo  $ConsumerIDTypeChild; ?>" disabled><br>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="staticStaffNo" class="col-sm-2 col-form-label">Mykad Child</label>
                        <div class="col-sm-10">
                          <input class="form-control" value="<?php echo  $ConsumerIDNoChild; ?>" disabled><br>
                          <input type="hidden" name="txtConsumerIDNoChild" value="<?php echo  $ConsumerIDNoChild; ?>">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="staticStaffNo" class="col-sm-2 col-form-label">Group</label>
                        <div class="col-sm-10">
                          <input class="form-control"  value="VIP" disabled>
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
                      <button type="submit" class="btn btn-success" name="submitaddstudent">Confirm</button>
                    </div>
                  </div>
              </div>
            </form>
            </div>
            <?php
          }
          //parent not exist
          else
          {
            ?>
            <form id="addrelationparent" name="addrelationparent" action="index.php?page=duplicateforstudentlist" method="post" style="padding-top: 10em;">
              <div class="modal-dialog modal-lg modal-dialog-centered">
              <div class="modal-content">
                  <div class="alert alert-danger" role="alert">
                    <h2 style="text-align:center;">STUDENT ALREADY EXIST</h2>
                  </div>
                  <div class="modal-body">
                    <div class="form-group row">
                      <h6 style="color:	#696969;">This Student already have existing account. Do you want to add another family member?</h6>
                      <input type="hidden" name="ConsumerIDNoParent" value="<?php echo $ConsumerIDNoParent; ?>">
                      <input type="hidden" name="ConsumerIDNoChild" value="<?php echo $ConsumerIDNoChild; ?>">
                      <input type="hidden" name="Classcategory" value="<?php echo $Classcategory; ?>">
                    </div>
                  </div>
                  <div class="modal-footer">
                    <button  onclick="index.php?page=studentlist" class="btn btn-secondary">Close</button>
                    <button name="addrelationparent" type="submit" class="btn btn-success">Proceed</a>
                  </div>
              </div>
            </form>
            <?php
          }
        }
      }
      else
      {
      ?>
      <div class="alert alert-danger" role="alert"><h2 style="text-align: center;">AUTHORIZED PERSONNEL ONLY</h2>
      <form id="submitparent" name="submitparent" action="index.php?page=parentlist" method="post">
        <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="AddParentModalLabel">Add Parent</h5>
              </div>
              <div class="modal-body">
                <div class="form-group row">
                  <label for="staticStaffNo" class="col-sm-2 col-form-label">Name</label>
                  <div class="col-sm-10">
                    <input class="form-control" value="<?php echo  $ConsumerFName; echo " "; echo  $ConsumerLName; ?>" disabled>
                  </div>
                </div>
                <div class="form-group row">
                  <label for="staticStaffNo" class="col-sm-2 col-form-label">MyKad</label>
                  <div class="col-sm-10">
                    <input class="form-control" value="<?php echo  $ConsumerIDNoParent; ?>" disabled>
                  </div>
                </div>
                <div class="form-group row">
                  <label for="staticStaffNo" class="col-sm-2 col-form-label"></label>
                  <div class="col-sm-10">
                    <input class="form-control" value="UNAUTHORIZED" disabled>
                  </div>
                </div>
              <div class="modal-footer">
                <button  onclick="index.php?page=parentlist" class="btn btn-secondary" >Close</button>
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
              <input class="form-control" value="<?php echo $ConsumerFName; ?>" disabled>
            </div>
          </div>
          <div class="form-group row">
            <label for="staticStaffNo" class="col-sm-2 col-form-label">Class Category</label>
            <div class="col-sm-10">
              <input class="form-control" value="<?php echo $varClasscategory; ?>" disabled>
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
          <button type="submit" class="btn btn-success" name="submiteditstudent">Confirm</button>
        </div>
      </div>
  </div>
</form>
<?php
    }
  }
}
?>
