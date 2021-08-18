<?php
if (isset($_POST['AddStaffFormSubmit']))
{
    $varClasscategory = "";
    $varConsumerIDNo = $_POST['txtConsumerIDNo'];
    $varStaffdepartment = $_POST['txtStaffdepartment'];
    $varClasscategory = $_POST['txtClasscategory'];
    $varaccesslevel = $_POST['txtaccesslevel'];

    $filter = ['School_id'=>$_SESSION["loggeduser_schoolID"], 'DepartmentName'=>$varStaffdepartment];
    $query = new MongoDB\Driver\Query($filter);
    $cursor =$GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.SchoolsDepartment',$query);
    foreach ($cursor as $document)
    {
      $_SESSION["departmentid"] = strval($document->_id);
      $_SESSION["DepartmentName"] = strval($document->DepartmentName);
    }
    $filter = ['ConsumerIDNo'=>$varConsumerIDNo];
    $query = new MongoDB\Driver\Query($filter);
    $cursor =$GoNGetzDatabase->executeQuery('GoNGetz.Consumer',$query);
    foreach ($cursor as $document)
    {
      $IDcon = strval($document->_id);
      $ConsumerGroup_id = strval($document->ConsumerGroup_id);
      if($ConsumerGroup_id == '601b4cfd97728c027c01f187')
      {
        $count = 0;
        $end = 1;
        $filter2 = ['SchoolID'=>$_SESSION["loggeduser_schoolID"]];
        $query2 = new MongoDB\Driver\Query($filter2);
        $cursor2 =$GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Staff',$query2);

        foreach ($cursor2 as $document2)
        {
          $count++;
          $ID = strval($document->_id);
          $ConsumerFName = strval($document->ConsumerFName);
          $ConsumerIDNo = strval($document->ConsumerIDNo);
          ?>
        <br><br><br><br><h2 style="text-align: center;">PLEASE CONFIRM BEFORE PROCEED</h2>
        <form id="submitaddstaff" name="submitaddstaff" action="index.php?page=stafflist" method="post">
          <div class="modal-dialog modal-lg modal-dialog-centered">
          <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="AddStaffModalLabel">Add Staff</h5>
                </div>
                <div class="modal-body">
                  <div class="form-group row">
                    <label for="staticStaffNo" class="col-sm-2 col-form-label">Staff Name</label>
                    <div class="col-sm-10">
                      <input class="form-control" value="<?php echo $ConsumerFName; ?>" disabled>
                      <input type="hidden" name="txtaccesslevel" value="<?php echo  $varaccesslevel; ?>" >
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="staticStaffNo" class="col-sm-2 col-form-label">MyKad</label>
                    <div class="col-sm-10">
                      <input class="form-control" value="<?php echo $ConsumerIDNo; ?>" disabled><br>
                      <input type="hidden" name="txtConsumerIDNo" value="<?php echo  $ConsumerIDNo; ?>" >
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="staticStaffNo" class="col-sm-2 col-form-label">Group</label>
                    <div class="col-sm-10">
                      <input class="form-control" value="SCHOOL" disabled>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="staticStaffNo" class="col-sm-2 col-form-label">Department</label>
                    <div class="col-sm-10">
                      <input class="form-control" value="<?php echo $varStaffdepartment; ?>" disabled><br>
                    </div>
                  </div>
                  <?php
                  if ($varaccesslevel == '0')
                  {
                    if ($varClasscategory == '')
                    {
                      ?>
                      <input type="hidden" name="txtteacherclass" value="" >
                      <?php
                    }
                    else
                    {
                      ?>
                      <div class="form-group row">
                        <label for="staticStaffNo" class="col-sm-2 col-form-label">Class Category</label>
                        <div class="col-sm-10">
                          <input class="form-control" value="<?php echo $varClasscategory; ?>" disabled><br>
                        </div>
                      </div>
                      <div id="teacherbox">
                        <div class="form-group row">
                        <label for="txtteacherclass" class="col-sm-2 col-form-label">Class</label>
                        <div class="col-sm-10">
                          <select class="form-control" id="txtteacherclass" name="txtteacherclass">
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
                      <?php
                    }
                  }
                else
                {
                ?>
                <input type="hidden" name="txtteacherclass" value="" >
                <?php
                }
                ?>
                  <div class="form-group row">
                    <label for="staticStaff" class="col-sm-2 col-form-label">Staff Status</label>
                    <div class="col-sm-10">
                      <select class="form-control" id="sltStatus" name="txtStaffstatus" >
                        <option value="ACTIVE">ACTIVE</option>
                        <option value="INACTIVE">INACTIVE</option>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="modal-footer">
                  <button  onclick="index.php?page=stafflist" class="btn btn-secondary">Close</button>
                  <button type="submit" class="btn btn-success" name="submitaddstaff">Confirm</button>
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
        <form id="submitstaff" name="submitstaff" action="index.php?page=stafflist" method="post">
          <div class="modal-dialog modal-lg modal-dialog-centered">
          <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="AddStaffModalLabel">Add Staff</h5>
                </div>
                <div class="modal-body">
                  <div class="form-group row">
                    <label for="staticStaffNo" class="col-sm-2 col-form-label">MyKad</label>
                    <div class="col-sm-10">
                      <input class="form-control" value="<?php echo $varConsumerIDNo; ?>" disabled>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="staticStaffNo" class="col-sm-2 col-form-label"></label>
                    <div class="col-sm-10">
                      <input class="form-control" value="UNAUTHORIZED" disabled>
                    </div>
                  </div>
                <div class="modal-footer">
                  <button onclick="index.php?page=stafflist" class="btn btn-secondary" >Close</button>
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
              $ConsumerID = new \MongoDB\BSON\ObjectId($ConsumerID);
              
              $filter = ['_id'=>$ConsumerID];
              $query = new MongoDB\Driver\Query($filter);
              $cursor =$GoNGetzDatabase->executeQuery('GoNGetz.Consumer',$query);
              foreach ($cursor as $document)
              {
                $ConsumerFName = strval($document->ConsumerFName);
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
                    <button type="submit" class="btn btn-success" name="submiteditstaff">Confirm</button>
                    </div>
                </div>
            </div>
            </form>
            <?php
            }
            ?>