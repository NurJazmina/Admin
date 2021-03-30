<?php
$id = new \MongoDB\BSON\ObjectId($_GET['id']);
$filter = ['_id'=>$id];
$query = new MongoDB\Driver\Query($filter);
$cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.SchoolsDepartment',$query);

foreach ($cursor as $document)
{
  $_SESSION["departmentremarkid"] = strval($document->_id);
  $DepartmentName = ($document->DepartmentName);
  $filter1 = ['SchoolID'=>$_SESSION["loggeduser_schoolID"],'Staffdepartment'=>$_SESSION["departmentremarkid"]];
  $query1 = new MongoDB\Driver\Query($filter1);
  $cursor1 = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Staff',$query1);
  $totalstaff = 0;
  foreach ($cursor1 as $document1)
  {
    $totalstaff = $totalstaff + 1;
    $Staffdepartment = strval($document1->Staffdepartment);
  }
}
?>
<div><br><br><br><h1 style="color:#696969; text-align:center">Department Info</h1></div><br>
<div class="row" >
  <div class="col-md-1 section-1-box wow fadeInUp"></div>
  <div class="col-md-10 section-1-box wow fadeInUp">
    <div class="card">
      <div class="card-header">
        <strong>Details</strong>
      </div>
      <div class="card-body">
        <div class="row">
          <div class="col-12 col-sm-12 col-lg-6">
            <div class="table-responsive">
              <table class="table table-bordered">
              <thead class="table-light">
              </thead>
              <tbody>
                <tr>
                  <th scope="row" class="table-secondary">Department</th>
                  <td class="table-secondary"><?php echo $DepartmentName; ?> </td>
                </tr>
                <tr>
                  <th scope="row">Staff List </th>
                  <td>
                  <?php
                  $filter = ['SchoolID'=>$_SESSION["loggeduser_schoolID"], 'Staffdepartment'=>$_SESSION["departmentremarkid"]];
                  $query = new MongoDB\Driver\Query($filter);
                  $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Staff',$query);
                  $totalstaff = 0;
                  foreach ($cursor as $document)
                  {
                    $totalstaff = $totalstaff + 1;
                    $ConsumerID = strval($document->ConsumerID);
                    $id = new \MongoDB\BSON\ObjectId($ConsumerID);
                    $filter1 = ['_id'=>$id];
                    $query1 = new MongoDB\Driver\Query($filter1);
                    $cursor1 = $GoNGetzDatabase->executeQuery('GoNGetz.Consumer',$query1);
                    foreach ($cursor1 as $document1)
                    {
                      $Consumer_id = ($document1->_id);
                      $ConsumerFName = ($document1->ConsumerFName);
                      ?>
                      <a href="index.php?page=staffdetail&id=<?php echo $Consumer_id; ?>" style="color:#076d79; text-decoration: none;">
                      <?php
                      echo $ConsumerFName."<br>";
                    }
                  }
                  ?>
                </td>
                </tr>
                <tr>
                  <th scope="row">Number of Staff</th>
                  <td><?php echo $totalstaff; ?></td>
                </tr>
              </tbody>
              </table>
            </div>
          </div>
          <div class="col-12 col-lg-6">
            <div class="row">
              <div class="col-12 col-lg-12">
                <div class="card">
                  <div class="card-header">
                    <strong>Remarks</strong>
                  </div>
                  <div class="card-body">
                    <div class="row">
                      <div class="col-12">
                      <div class="tab-content" id="v-pills-tabContent">
                        <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
                          <div class="box">
                            <form name="AddDepartmentRemarkFormSubmit" action="model/adddepartmentremark.php" method="POST">
                            <div class="row">
                              <div class="col">
                                  <textarea class="form-control" name="txtdepartmentRemark" rows="3"></textarea>
                                  <div class="row">
                                    <div class="col text-right">
                                      <input type="hidden" value="<?php echo $_GET['id']; ?>" name="txtdepartmentid">
                                      <button type="submit" class="btn btn-primary" name="AddDepartmentRemarkFormSubmit">Add remark</button>
                                    </div>
                                  </div>
                                </div>
                            </div>
                          </form>
                        </div>
                        <div class="box">
                          <strong></strong>
                          <br>
                          <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                              <a class="nav-link active" id="active-tab" data-bs-toggle="tab" href="#active" role="tab" aria-controls="active" aria-selected="true">Active</a>
                            </li>
                            <li class="nav-item" role="presentation">
                              <a class="nav-link" id="pending-tab" data-bs-toggle="tab" href="#pending" role="tab" aria-controls="pending" aria-selected="false">Pending</a>
                            </li>
                            <li class="nav-item" role="presentation">
                              <a class="nav-link" id="completed-tab" data-bs-toggle="tab" href="#completed" role="tab" aria-controls="completed" aria-selected="false">Completed</a>
                            </li>
                          </ul>
                          <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="active" role="tabpanel" aria-labelledby="active-tab">
                              <div class="table-responsive">
                                <table class="table table-striped table-sm ">
                                  <thead>
                                    <tr>
                                      <th>Date</th>
                                      <th>Details</th>
                                      <th>Staff</th>
                                    </tr>
                                  </thead>
                                </table>
                                <?php
                                $filter2 = ['department_id'=>$_GET['id'],'SubRemarks'=>'0','departmentRemarksStatus'=>'ACTIVE'];
                                $option2 = ['sort' => ['_id' => -1],'limit'=>10];
                                $query2 = new MongoDB\Driver\Query($filter2, $option2);
                                $cursor2 = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.DepartmentRemarks',$query2);

                                foreach ($cursor2 as $document2)
                                {
                                  $_SESSION["departmentparent"] = strval($document2->_id);
                                  $remarkid1 = strval($document2->_id);
                                  $remark1 = ($document2->departmentRemarksDetails);
                                  $remarkdate1 = ($document2->departmentRemarksDate);
                                  $utcdatetime1 = new MongoDB\BSON\UTCDateTime(strval($remarkdate1));
                                  $datetime1 = $utcdatetime1->toDateTime()->setTimezone(new \DateTimeZone(date_default_timezone_get()));
                                  $remarkstaffid1 = ($document2->departmentRemarksStaff_id);
                                  ?>
                                    <div class="accordion accordion-flush" id="accordionFlushExample">
                                    <div class="accordion-item" >
                                      <h6 class="accordion-header" id="flush-headingOne">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                                        <tbody>
                                          <tr>
                                          <td><?php print_r($datetime1->format('r')); ?></td>
                                          <td>
                                            <?php
                                            $filter1 = ['_id' => new \MongoDB\BSON\ObjectId($remarkstaffid1)];
                                            $query1 = new MongoDB\Driver\Query($filter1);
                                            $cursor1 = $GoNGetzDatabase->executeQuery('GoNGetz.Consumer', $query1);
                                            foreach ($cursor1 as $document1)
                                            {
                                            $ConsumerFName = ($document1->ConsumerFName);
                                            echo $ConsumerFName;
                                            ?>
                                          </td>
                                          <td><?php echo $remark1;?></td>
                                          </tr>
                                          </tbody>
                                        </button>
                                      </h6>
                                      <div  id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                                      <?php 
                                      $filter4 = ['department_id'=>$_GET['id'],'SubRemarks'=>$_SESSION["departmentparent"],'departmentRemarksStatus'=>'ACTIVE'];
                                      $option4 = ['sort' => ['_id' => -1],'limit'=>10];
                                      $query4 = new MongoDB\Driver\Query($filter4, $option4);
                                      $cursor4 = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.DepartmentRemarks',$query4);
                                      foreach ($cursor4 as $document4)
                                      {
                                        $remarkid2 = strval($document4->_id);
                                        $remark2 = ($document4->departmentRemarksDetails);
                                        $remarkdate2 = ($document4->departmentRemarksDate);
                                        $utcdatetime2 = new MongoDB\BSON\UTCDateTime(strval($remarkdate2));
                                        $datetime2 = $utcdatetime2->toDateTime()->setTimezone(new \DateTimeZone(date_default_timezone_get()));
                                        $remarkstaffid2 = ($document4->departmentRemarksStaff_id);
                                        ?>
                                        <div class="accordion-body">
                                        <tbody>
                                          <tr>
                                            <td><?php print_r($datetime2->format('r')); ?></td>
                                            <td>
                                              <?php echo $remark2;?>
                                            </td>
                                          </tr>
                                          </tbody>
                                        </div>
                                        <?php
                                        }
                                        ?>
                                        <form name="AddDepartmentRemarkChildFormSubmit" action="model/adddepartmentremarkchild.php" method="POST">
                                        <div class="row">
                                          <div class="col">
                                            <textarea class="form-control" name="txtconsumerRemark" rows="3"></textarea>
                                            <div class="row">
                                              <div class="col text-right">
                                                <input type="hidden" value="<?php echo $_GET['id']; ?>" name="txtconsumerid">
                                                <input type="hidden" value="<?php echo $remarkid1; ?>" name="txtremarkid">
                                                <button type="submit" class="btn btn-primary" name="AddDepartmentRemarkChildFormSubmit">Add remark</button>
                                              </div>
                                            </div>
                                          </div>
                                        </div>
                                        </form>
                                        <button style="float: right;"type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#Updatedepartmentremark" data-bs-whatever="<?php echo $remarkid1; ?>" style="display: flex;  ">update</button>
                                      </div>
                                      </div>
                                    </div>
                                <?php
                                }
                                }
                                ?>
                              </div>
                            </div>
                            <div class="tab-pane fade show pending" id="pending" role="tabpanel" aria-labelledby="pending-tab">
                              <div class="table-responsive">
                                <table class="table table-striped table-sm ">
                                  <thead>
                                    <tr>
                                      <th>Date</th>
                                      <th>Details</th>
                                      <th>Staff</th>
                                    </tr>
                                  </thead>
                                </table>
                                <?php
                                $filter2 = ['department_id'=>$_GET['id'],'SubRemarks'=>'0','departmentRemarksStatus'=>'PENDING'];
                                $option2 = ['sort' => ['_id' => -1],'limit'=>10];
                                $query2 = new MongoDB\Driver\Query($filter2, $option2);
                                $cursor2 = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.DepartmentRemarks',$query2);

                                foreach ($cursor2 as $document2)
                                {
                                  $_SESSION["departmentparent"] = strval($document2->_id);
                                  $remarkid1 = strval($document2->_id);
                                  $remark1 = ($document2->departmentRemarksDetails);
                                  $remarkdate1 = ($document2->departmentRemarksDate);
                                  $utcdatetime1 = new MongoDB\BSON\UTCDateTime(strval($remarkdate1));
                                  $datetime1 = $utcdatetime1->toDateTime()->setTimezone(new \DateTimeZone(date_default_timezone_get()));
                                  $remarkstaffid1 = ($document2->departmentRemarksStaff_id);
                                  ?>
                                    <div class="accordion accordion-flush" id="accordionFlushExample">
                                    <div class="accordion-item" >
                                      <h6 class="accordion-header" id="flush-headingOne">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                                        <tbody>
                                          <tr>
                                          <td><?php print_r($datetime1->format('r')); ?></td>
                                          <td>
                                            <?php
                                            $filter1 = ['_id' => new \MongoDB\BSON\ObjectId($remarkstaffid1)];
                                            $query1 = new MongoDB\Driver\Query($filter1);
                                            $cursor1 = $GoNGetzDatabase->executeQuery('GoNGetz.Consumer', $query1);
                                            foreach ($cursor1 as $document1)
                                            {
                                            $ConsumerFName = ($document1->ConsumerFName);
                                            echo $ConsumerFName;
                                            ?>
                                          </td>
                                          <td><?php echo $remark1;?></td>
                                          </tr>
                                          </tbody>
                                        </button>
                                      </h6>
                                      <div  id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                                      <?php 
                                      $filter4 = ['department_id'=>$_GET['id'],'SubRemarks'=>$_SESSION["departmentparent"],'departmentRemarksStatus'=>'PENDING'];
                                      $option4 = ['sort' => ['_id' => -1],'limit'=>10];
                                      $query4 = new MongoDB\Driver\Query($filter4, $option4);
                                      $cursor4 = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.DepartmentRemarks',$query4);
                                      foreach ($cursor4 as $document4)
                                      {
                                        $remarkid2 = strval($document4->_id);
                                        $remark2 = ($document4->departmentRemarksDetails);
                                        $remarkdate2 = ($document4->departmentRemarksDate);
                                        $utcdatetime2 = new MongoDB\BSON\UTCDateTime(strval($remarkdate2));
                                        $datetime2 = $utcdatetime2->toDateTime()->setTimezone(new \DateTimeZone(date_default_timezone_get()));
                                        $remarkstaffid2 = ($document4->departmentRemarksStaff_id);
                                        ?>
                                        <div class="accordion-body">
                                        <tbody>
                                          <tr>
                                            <td><?php print_r($datetime2->format('r')); ?></td>
                                            <td>
                                              <?php echo $remark2;?>
                                            </td>
                                          </tr>
                                          </tbody>
                                        </div>
                                        <?php
                                        }
                                        ?>
                                        <form name="AddDepartmentRemarkChildFormSubmit" action="model/adddepartmentremarkchild.php" method="POST">
                                        <div class="row">
                                          <div class="col">
                                            <textarea class="form-control" name="txtconsumerRemark" rows="3"></textarea>
                                            <div class="row">
                                              <div class="col text-right">
                                                <input type="hidden" value="<?php echo $_GET['id']; ?>" name="txtconsumerid">
                                                <input type="hidden" value="<?php echo $remarkid; ?>" name="txtremarkid">
                                                <button type="submit" class="btn btn-primary" name="AddDepartmentRemarkChildFormSubmit">Add remark</button>
                                              </div>
                                            </div>
                                          </div>
                                        </div>
                                        </form>
                                        <button style="float: right;"type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#Updatedepartmentremark" data-bs-whatever="<?php echo $remarkid1; ?>" style="display: flex;  ">update</button>
                                      </div>
                                      </div>
                                    </div>
                                <?php
                                }
                                }
                                ?>
                              </div>
                            </div>
                            <div class="tab-pane fade show completed" id="completed" role="tabpanel" aria-labelledby="completed-tab">
                              <div class="table-responsive">
                                <table class="table table-striped table-sm ">
                                  <thead>
                                    <tr>
                                      <th>Date</th>
                                      <th>Details</th>
                                      <th>Staff</th>
                                    </tr>
                                  </thead>
                                </table>
                                <?php
                                $filter2 = ['department_id'=>$_GET['id'],'SubRemarks'=>'0','departmentRemarksStatus'=>'COMPLETED'];
                                $option2 = ['sort' => ['_id' => -1],'limit'=>10];
                                $query2 = new MongoDB\Driver\Query($filter2, $option2);
                                $cursor2 = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.DepartmentRemarks',$query2);

                                foreach ($cursor2 as $document2)
                                {
                                  $_SESSION["departmentparent"] = strval($document2->_id);
                                  $remarkid1 = strval($document2->_id);
                                  $remark1 = ($document2->departmentRemarksDetails);
                                  $remarkdate1 = ($document2->departmentRemarksDate);
                                  $utcdatetime1 = new MongoDB\BSON\UTCDateTime(strval($remarkdate1));
                                  $datetime1 = $utcdatetime1->toDateTime()->setTimezone(new \DateTimeZone(date_default_timezone_get()));
                                  $remarkstaffid1 = ($document2->departmentRemarksStaff_id);
                                  ?>
                                    <div class="accordion accordion-flush" id="accordionFlushExample">
                                    <div class="accordion-item" >
                                      <h6 class="accordion-header" id="flush-headingOne">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                                        <tbody>
                                          <tr>
                                          <td><?php print_r($datetime1->format('r')); ?></td>
                                          <td>
                                            <?php
                                            $filter1 = ['_id' => new \MongoDB\BSON\ObjectId($remarkstaffid1)];
                                            $query1 = new MongoDB\Driver\Query($filter1);
                                            $cursor1 = $GoNGetzDatabase->executeQuery('GoNGetz.Consumer', $query1);
                                            foreach ($cursor1 as $document1)
                                            {
                                            $ConsumerFName = ($document1->ConsumerFName);
                                            echo $ConsumerFName;
                                            ?>
                                          </td>
                                          <td><?php echo $remark1;?></td>
                                          </tr>
                                          </tbody>
                                        </button>
                                      </h6>
                                      <div  id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                                      <?php 
                                      $filter4 = ['department_id'=>$_GET['id'],'SubRemarks'=>$_SESSION["departmentparent"],'departmentRemarksStatus'=>'COMPLETED'];
                                      $option4 = ['sort' => ['_id' => -1],'limit'=>10];
                                      $query4 = new MongoDB\Driver\Query($filter4, $option4);
                                      $cursor4 = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.DepartmentRemarks',$query4);
                                      foreach ($cursor4 as $document4)
                                      {
                                        $remarkid2 = strval($document4->_id);
                                        $remark2 = ($document4->departmentRemarksDetails);
                                        $remarkdate2 = ($document4->departmentRemarksDate);
                                        $utcdatetime2 = new MongoDB\BSON\UTCDateTime(strval($remarkdate2));
                                        $datetime2 = $utcdatetime2->toDateTime()->setTimezone(new \DateTimeZone(date_default_timezone_get()));
                                        $remarkstaffid2 = ($document4->departmentRemarksStaff_id);
                                        ?>
                                        <div class="accordion-body">
                                        <tbody>
                                          <tr>
                                            <td><?php print_r($datetime2->format('r')); ?></td>
                                            <td>
                                              <?php echo $remark2;?>
                                            </td>
                                          </tr>
                                          </tbody>
                                        </div>
                                        <?php
                                        }
                                        ?>
                                        <form name="AddDepartmentRemarkChildFormSubmit" action="model/adddepartmentremarkchild.php" method="POST">
                                        <div class="row">
                                          <div class="col">
                                            <textarea class="form-control" name="txtconsumerRemark" rows="3"></textarea>
                                            <div class="row">
                                              <div class="col text-right">
                                                <input type="hidden" value="<?php echo $_GET['id']; ?>" name="txtconsumerid">
                                                <input type="hidden" value="<?php echo $remarkid; ?>" name="txtremarkid">
                                                <button type="submit" class="btn btn-primary" name="AddDepartmentRemarkChildFormSubmit">Add remark</button>
                                              </div>
                                            </div>
                                          </div>
                                        </div>
                                        </form>
                                        <button style="float: right;"type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#Updatedepartmentremark" data-bs-whatever="<?php echo $remarkid1; ?>" style="display: flex;  ">update</button>
                                      </div>
                                      </div>
                                    </div>
                                <?php
                                }
                                }
                                ?>
                              </div>
                            </div>
                          </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
<div class="col-md-1 section-1-box wow fadeInUp"></div>
</div>
</div>
<?php include ('view/modal-updatedepartmentremark.php'); ?>
<script>
  var Updatedepartmentremark = document.getElementById('Updatedepartmentremark')
  Updatedepartmentremark.addEventListener('show.bs.modal', function (event) {
  // Button that triggered the modal
  var button = event.relatedTarget
  // Extract info from data-bs-* attributes
  var recipient = button.getAttribute('data-bs-whatever')
  // If necessary, you could initiate an AJAX request here
  // and then do the updating in a callback.
  //
  // Update the modal's content.
  var modalTitle = Updatedepartmentremark.querySelector('.modal-title')
  var modalBodyInput = Updatedepartmentremark.querySelector('.modal-body input')
  modalBodyInput.value = recipient
  })
</script>
