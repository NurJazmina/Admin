<?php
$DepartmentName = $_GET['name'];
$filter = ['School_id'=>$_SESSION["loggeduser_schoolID"], 'DepartmentName'=>$DepartmentName];
$query = new MongoDB\Driver\Query($filter);
$cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.SchoolsDepartment',$query);

foreach ($cursor as $document)
{
    $_SESSION["departmentremarkid"] = strval($document->_id);
    $_SESSION["DepartmentName"] = strval($document->DepartmentName);
    $filter1 = ['SchoolID'=>$_SESSION["loggeduser_schoolID"],'Staffdepartment'=>$_SESSION["departmentid"]];
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
<div style="color:#696969; text-align:center"><br><br><br><h1>Department Info</h1></div><br>
<div class="row" >
  <div class="col"></div>
  <div class="col-12 col-lg-10">
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
                  <td class="table-secondary"><?php echo $_SESSION["DepartmentName"] ?> </td>
                </tr>
                <tr>
                  <th scope="row">Staff List </th>
                  <td>
                  <?php
                  $filter = ['SchoolID'=>$_SESSION["loggeduser_schoolID"], 'Staffdepartment'=>$_SESSION["departmentid"]];
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
                            <form name="AdddepartmentRemarkFormSubmit" action="model/adddepartmentremark.php" method="POST">
                              <div class="row">
                                <div class="col">
                                  <textarea class="form-control" name="txtdepartmentRemark" rows="3"></textarea>
                                  <div class="row">
                                    <div class="col text-right">
                                      <button type="submit" class="btn btn-primary" name="AdddepartmentRemarkFormSubmit">Add remark</button>
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
                                        <th></th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                      <?php
                                      $filter = ['department_id'=>$_SESSION["departmentid"], 'departmentRemarksStatus'=>'ACTIVE'];
                                      $option = ['sort' => ['_id' => -1],'limit'=>10];
                                      $query = new MongoDB\Driver\Query($filter,$option);
                                      $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.DepartmentRemarks',$query);
                                      foreach ($cursor as $document)
                                      {
                                        $remarkid = ($document->_id);
                                        $departmentremark = ($document->departmentRemarksDetails);
                                        $departmentremarkdate = (($document->departmentRemarksDate));
                                        $utcdatetime = new MongoDB\BSON\UTCDateTime(strval($departmentremarkdate));
                                        $datetime = $utcdatetime->toDateTime()->setTimezone(new \DateTimeZone(date_default_timezone_get()));
                                        $departmentremarkstaffid = ($document->departmentRemarksStaff_id);
                                        ?>
                                        <tr>
                                          <td><?php print_r($datetime->format('r'));?></td>
                                          <td><?php echo $departmentremark; ?></td>
                                          <td>
                                        <?php
                                        $varstaffid = new \MongoDB\BSON\ObjectId($departmentremarkstaffid);
                                        $filter1 = ['_id'=>$varstaffid];
                                        $query1 = new MongoDB\Driver\Query($filter1);
                                        $cursor1 = $GoNGetzDatabase->executeQuery('GoNGetz.Consumer',$query1);
                                        foreach ($cursor1 as $document1)
                                        {
                                          $ConsumerFName = ($document1->ConsumerFName);
                                        }
                                        echo $ConsumerFName;
                                        ?>
                                        </td>
                                        <?php
                                        $varstaffid = strval($_SESSION["loggeduser_id"]);
                                        $filter = ['ConsumerID'=>$varstaffid];
                                        $query = new MongoDB\Driver\Query($filter);
                                        $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Staff',$query);
                                        foreach ($cursor as $document)
                                        {
                                          ?>
                                          <td>
                                            <button  type="button" class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#Updatedepartmentremark" data-bs-whatever="<?php echo $remarkid; ?>">
                                              <i class="fas fa-exchange-alt"></i>
                                            </button>
                                          </td>
                                          <?php
                                        }
                                        ?>
                                        </tr>
                                        <?php
                                        }
                                        ?>
                                      </tbody>
                                    </table>
                                  </div>
                                </div>
                                <div class="tab-pane fade" id="pending" role="tabpanel" aria-labelledby="pending-tab">
                                <div class="table-responsive">
                                  <table class="table table-striped table-sm ">
                                    <thead>
                                      <tr>
                                        <th>Date</th>
                                        <th>Details</th>
                                        <th>Staff</th>
                                        <th></th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                      <?php
                                      $filter = ['department_id'=>$_SESSION["departmentid"], 'departmentRemarksStatus'=>'PENDING'];
                                      $option = ['sort' => ['_id' => -1],'limit'=>10];
                                      $query = new MongoDB\Driver\Query($filter,$option);
                                      $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.DepartmentRemarks',$query);
                                      foreach ($cursor as $document)
                                      {
                                        $remarkid = ($document->_id);
                                        $departmentremark = ($document->departmentRemarksDetails);
                                        $departmentremarkdate = (($document->departmentRemarksDate));
                                        $utcdatetime = new MongoDB\BSON\UTCDateTime(strval($departmentremarkdate));
                                        $datetime = $utcdatetime->toDateTime()->setTimezone(new \DateTimeZone(date_default_timezone_get()));
                                        $departmentremarkstaffid = ($document->departmentRemarksStaff_id);
                                        ?>
                                        <tr>
                                          <td><?php print_r($datetime->format('r'));?></td>
                                          <td><?php echo $departmentremark; ?></td>
                                          <td>
                                        <?php
                                        $varstaffid = new \MongoDB\BSON\ObjectId($departmentremarkstaffid);
                                        $filter1 = ['_id'=>$varstaffid];
                                        $query1 = new MongoDB\Driver\Query($filter1);
                                        $cursor1 = $GoNGetzDatabase->executeQuery('GoNGetz.Consumer',$query1);
                                        foreach ($cursor1 as $document1)
                                        {
                                          $ConsumerFName = ($document1->ConsumerFName);
                                        }
                                        echo $ConsumerFName;
                                        ?>
                                        </td>
                                        <?php
                                        $varstaffid = strval($_SESSION["loggeduser_id"]);
                                        $filter = ['ConsumerID'=>$varstaffid];
                                        $query = new MongoDB\Driver\Query($filter);
                                        $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Staff',$query);
                                        foreach ($cursor as $document)
                                        {
                                          ?>
                                          <td>
                                            <button  type="button" class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#Updatedepartmentremark" data-bs-whatever="<?php echo $remarkid; ?>">
                                              <i class="fas fa-exchange-alt"></i>
                                            </button>
                                          </td>
                                          <?php
                                        }
                                        ?>
                                        </tr>
                                        <?php
                                        }
                                        ?>
                                      </tbody>
                                    </table>
                                </div>
                              </div>
                              <div class="tab-pane fade" id="completed" role="tabpanel" aria-labelledby="completed-tab">
                                <div class="table-responsive">
                                  <table class="table table-striped table-sm ">
                                    <thead>
                                      <tr>
                                        <th>Date</th>
                                        <th>Details</th>
                                        <th>Staff</th>
                                        <th></th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                      <?php
                                      $filter = ['department_id'=>$_SESSION["departmentid"], 'departmentRemarksStatus'=>'COMPLETED'];
                                      $option = ['sort' => ['_id' => -1],'limit'=>10];
                                      $query = new MongoDB\Driver\Query($filter,$option);
                                      $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.DepartmentRemarks',$query);
                                      foreach ($cursor as $document)
                                      {
                                        $remarkid = ($document->_id);
                                        $departmentremark = ($document->departmentRemarksDetails);
                                        $departmentremarkdate = (($document->departmentRemarksDate));
                                        $utcdatetime = new MongoDB\BSON\UTCDateTime(strval($departmentremarkdate));
                                        $datetime = $utcdatetime->toDateTime()->setTimezone(new \DateTimeZone(date_default_timezone_get()));
                                        $departmentremarkstaffid = ($document->departmentRemarksStaff_id);
                                        ?>
                                        <tr>
                                          <td><?php print_r($datetime->format('r'));?></td>
                                          <td><?php echo $departmentremark; ?></td>
                                          <td>
                                        <?php
                                        $varstaffid = new \MongoDB\BSON\ObjectId($departmentremarkstaffid);
                                        $filter1 = ['_id'=>$varstaffid];
                                        $query1 = new MongoDB\Driver\Query($filter1);
                                        $cursor1 = $GoNGetzDatabase->executeQuery('GoNGetz.Consumer',$query1);
                                        foreach ($cursor1 as $document1)
                                        {
                                          $ConsumerFName = ($document1->ConsumerFName);
                                        }
                                        echo $ConsumerFName;
                                        ?>
                                        </td>
                                        <?php
                                        $varstaffid = strval($_SESSION["loggeduser_id"]);
                                        $filter = ['ConsumerID'=>$varstaffid];
                                        $query = new MongoDB\Driver\Query($filter);
                                        $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Staff',$query);
                                        foreach ($cursor as $document)
                                        {
                                          ?>
                                          <td>
                                            <button  type="button" class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#Updatedepartmentremark" data-bs-whatever="<?php echo $remarkid; ?>">
                                              <i class="fas fa-exchange-alt"></i>
                                            </button>
                                          </td>
                                          <?php
                                        }
                                        ?>
                                        </tr>
                                        <?php
                                        }
                                        ?>
                                      </tbody>
                                    </table>
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
    </div>
  </div>
</div>
<div class="col"></div>
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
