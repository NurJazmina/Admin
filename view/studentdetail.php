<?php
  $id = new \MongoDB\BSON\ObjectId($_GET['id']);
  $filter = ['_id'=>$id];
  $query = new MongoDB\Driver\Query($filter);
  $cursor = $GoNGetzDatabase->executeQuery('GoNGetz.Consumer',$query);

  foreach ($cursor as $document)
  {
    $_SESSION["studentremarkid"] = strval($document->_id);
    $consumerid = strval($document->_id);
    $ConsumerFName = ($document->ConsumerFName);
    $ConsumerLName = ($document->ConsumerLName);
    $ConsumerIDType = ($document->ConsumerIDType);
    $ConsumerIDNo = ($document->ConsumerIDNo);
    $ConsumerEmail = ($document->ConsumerEmail);
    $ConsumerPhone = ($document->ConsumerPhone);
    $ConsumerAddress = ($document->ConsumerAddress);
    $ConsumerStatus = ($document->ConsumerStatus);

    $filter0 = ['Consumer_id'=>$consumerid];
    $query0 = new MongoDB\Driver\Query($filter0);
    $cursor0 =$GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Students',$query0);

    foreach ($cursor0 as $document0)
    {
      $studentid = strval($document0->_id);
      $Class_id = strval($document0->Class_id);
      $class_id=new \MongoDB\BSON\ObjectId($Class_id);
    }

    $filter0 = ['_id'=>$class_id];
    $query0 = new MongoDB\Driver\Query($filter0);
    $cursor0 =$GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Classrooms',$query0);

    foreach ($cursor0 as $document0)
    {
      $classid = strval($document0->_id);
      $ClassCategory = strval($document0->ClassCategory);
      $ClassName = strval($document0->ClassName);
    }

  }
?>
<div style="color:#696969; text-align:center"><br><br><br><h1>Student Personal Info</h1></div><br>
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
                  <th scope="row" class="table-secondary">Name</th>
                  <td class="table-secondary"><?php echo $ConsumerFName; echo " "; echo $ConsumerLName; ?></td>
                </tr>
                <tr>
                <th scope="row">ID Type</th>
                <td><?php echo $ConsumerIDType; ?></td>
                </tr>
                <tr>
                   <th scope="row">ID Number</th>
                    <td><?php echo $ConsumerIDNo; ?></td>
                </tr>
                <tr>
                  <th scope="row">Phone Number</th>
                  <td><?php echo $ConsumerPhone; ?></td>
                </tr>
                <tr>
                  <th scope="row">Address</th>
                  <td><?php echo $ConsumerAddress; ?></td>
                </tr>
                <tr>
                <tr>
                   <th scope="row">Class Name</th>
                  <td><a href="index.php?page=classdetail&id=<?php echo $classid; ?>" style="color:#076d79; text-decoration: none;"><?php echo $ClassCategory." ".$ClassName; ?></a></td>
                </tr>
                   <th scope="row">Status</th>
                   <td><?php echo $ConsumerStatus; ?></td>
                </tr>
              </tbody>
            </table>
              <?php
              $varcount = 1;
              do
              {
              $filter1 = ['StudentID'=>$studentid];
              $query1 = new MongoDB\Driver\Query($filter1);
              $cursor1 =$GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.ParentStudentRel',$query1);
              foreach ($cursor1 as $document1)
              {
              $ParentStudentRelation = ($document1->ParentStudentRelation);
              $ParentID = ($document1->ParentID);
              $parentid = new \MongoDB\BSON\ObjectId($ParentID);

              $filter2 = ['_id'=>$parentid];
              $query2 = new MongoDB\Driver\Query($filter2);
              $cursor2 =$GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Parents',$query2);

              foreach ($cursor2 as $document2)
              {
              $ConsumerID = strval($document2->ConsumerID);
              $consumerID = new \MongoDB\BSON\ObjectId($ConsumerID);

              $filter3 = ['_id'=>$consumerID];
              $query3 = new MongoDB\Driver\Query($filter3);
              $cursor3 =$GoNGetzDatabase->executeQuery('GoNGetz.Consumer',$query3);

              foreach ($cursor3 as $document3)
              {
                $ParentFName = ($document3->ConsumerFName);
                $ParentLName = ($document3->ConsumerLName);
                $ParentIDNo = ($document3->ConsumerIDNo);
                $ParentEmail = ($document3->ConsumerEmail);
                $ParentPhone = ($document3->ConsumerPhone);
              ?>
              <table class="table table-bordered">
              <thead class="table-light">
              <tbody>
                <tr>
                  <th scope="row" class="table-secondary">Relation</th>
                  <td class="table-secondary"><?php echo $ParentStudentRelation; ?> </td>
                </tr>
                <tr>
                  <th scope="row">Name</th>
                  <td><a href="index.php?page=parentdetail&id=<?php echo $ConsumerID; ?>" style="color:#076d79; text-decoration: none;"><?php echo $ParentFName; echo " "; echo $ParentLName; ?></a></td>
                </tr>
                <tr>
                <th scope="row">ID Number</th>
                <td><?php echo $ParentIDNo; ?></td>
                </tr>
                <tr>
                  <th scope="row">Email</th>
                <td><?php echo $ParentEmail; ?></td>
                </tr>
                <tr>
                   <th scope="row">Phone Number</th>
                    <td><?php echo $ParentPhone; ?></td>
                </tr>
              </tbody>
                </table>
              <?php
              }
              }
              }
              $varcount = $varcount + 1;
              }
              while ($varcount <= 1);
              ?>
            </div>
          </div>
          <div class="col-12 col-lg-6">
            <div class="row">
            <div class="col-12 col-lg-12">
              <div class="card">
                <div class="card-header">
                /**
                * @todo Display student's remark with child remark and form
                * @body As our discussion
                */
                  <strong>Remarks</strong>
                </div>
                <div class="card-body">
                  <div class="row">
                    <div class="col-12">
                      <div class="tab-content" id="v-pills-tabContent">
                        <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
                          <div class="box">
                            <form name="AddStudentRemarkFormSubmit" action="model/addstudentremark.php" method="POST">
                            <div class="row">
                              <div class="col">
                                <?php
                                $varstaffid = strval($_SESSION["loggeduser_id"]);
                                $filter = ['ConsumerID'=>$varstaffid];
                                $query = new MongoDB\Driver\Query($filter);
                                $cursor =$GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Staff',$query);
                                foreach ($cursor as $document)
                                {
                                  ?>
                                <textarea class="form-control" name="txtconsumerRemark" rows="3"></textarea>
                                <div class="row">
                                  <div class="col text-right">
                                    <input type="hidden" value="<?php echo $_GET['id']; ?>" name="txtconsumerid">
                                    <button type="submit" class="btn btn-primary" name="AddStudentRemarkFormSubmit">Add remark</button>
                                  </div>
                                </div>
                                <?php
                                }
                                ?>
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
                                      <th>Update</th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                    <?php
                                    $filter = ['Consumer_id'=>$_GET['id'], 'ConsumerRemarksStatus'=>'ACTIVE'];
                                    $option = ['sort' => ['_id' => -1]];
                                    $query = new MongoDB\Driver\Query($filter,$option);
                                    $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.StudentRemarks',$query);
                                    foreach ($cursor as $document)
                                    {
                                      $remarkid = ($document->_id);
                                      $consumerremark = ($document->ConsumerRemarksDetails);
                                      $consumerremarkdate = (($document->ConsumerRemarksDate));
                                      $utcdatetime = new MongoDB\BSON\UTCDateTime(strval($consumerremarkdate));
                                      $datetime = $utcdatetime->toDateTime()->setTimezone(new \DateTimeZone(date_default_timezone_get()));
                                      $consumerremarkstaffid = ($document->ConsumerRemarksStaff_id);
                                    ?>
                                      <tr>
                                        <td><?php print_r($datetime->format('r'));?></td>
                                        <td><?php echo $consumerremark; ?></td>
                                        <td>
                                          <?php
                                      $varstaffid = new \MongoDB\BSON\ObjectId($consumerremarkstaffid);
                                      $filter1 = ['_id'=>$varstaffid];
                                      $query1 = new MongoDB\Driver\Query($filter1);
                                      $cursor1 =$GoNGetzDatabase->executeQuery('GoNGetz.Consumer',$query1);

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
                                          <button  type="button" class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#Updatestudentremark" data-bs-whatever="<?php echo $remarkid; ?>">
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
                                      <th>Update</th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                  <?php
                                  $filter = ['Consumer_id'=>$_GET['id'], 'ConsumerRemarksStatus'=>'PENDING'];
                                  $option = ['sort' => ['_id' => -1]];
                                  $query = new MongoDB\Driver\Query($filter,$option);
                                  $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.StudentRemarks',$query);
                                  foreach ($cursor as $document)
                                  {
                                    $remarkid = ($document->_id);
                                    $consumerremark = ($document->ConsumerRemarksDetails);
                                    $consumerremarkdate = (($document->ConsumerRemarksDate));
                                    $utcdatetime = new MongoDB\BSON\UTCDateTime(strval($consumerremarkdate));
                                    $datetime = $utcdatetime->toDateTime()->setTimezone(new \DateTimeZone(date_default_timezone_get()));
                                    $consumerremarkstaffid = ($document->ConsumerRemarksStaff_id);
                                    ?>
                                    <tr>
                                      <td><?php print_r($datetime->format('r'));?></td>
                                      <td><?php echo $consumerremark; ?></td>
                                      <td>
                                    <?php
                                    $varstaffid = new \MongoDB\BSON\ObjectId($consumerremarkstaffid);
                                    $filter1 = ['_id'=>$varstaffid];
                                    $query1 = new MongoDB\Driver\Query($filter1);
                                    $cursor1 =$GoNGetzDatabase->executeQuery('GoNGetz.Consumer',$query1);
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
                                        <button  type="button" class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#Updatestudentremark" data-bs-whatever="<?php echo $remarkid; ?>">
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
                                    <th>Update</th>
                                  </tr>
                                </thead>
                                <tbody>
                                <?php
                                $filter = ['Consumer_id'=>$_GET['id'], 'ConsumerRemarksStatus'=>'COMPLETED'];
                                $option = ['sort' => ['_id' => -1]];
                                $query = new MongoDB\Driver\Query($filter,$option);
                                $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.StudentRemarks',$query);
                                foreach ($cursor as $document)
                                {
                                  $remarkid = ($document->_id);
                                  $consumerremark = ($document->ConsumerRemarksDetails);
                                  $consumerremarkdate = (($document->ConsumerRemarksDate));
                                  $utcdatetime = new MongoDB\BSON\UTCDateTime(strval($consumerremarkdate));
                                  $datetime = $utcdatetime->toDateTime()->setTimezone(new \DateTimeZone(date_default_timezone_get()));
                                  $consumerremarkstaffid = ($document->ConsumerRemarksStaff_id);
                                  ?>
                                  <tr>
                                    <td><?php print_r($datetime->format('r'));?></td>
                                    <td><?php echo $consumerremark; ?></td>
                                    <td>
                                  <?php
                                  $varstaffid = new \MongoDB\BSON\ObjectId($consumerremarkstaffid);
                                  $filter1 = ['_id'=>$varstaffid];
                                  $query1 = new MongoDB\Driver\Query($filter1);
                                  $cursor1 =$GoNGetzDatabase->executeQuery('GoNGetz.Consumer',$query1);
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
                                      <button  type="button" class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#Updatestudentremark" data-bs-whatever="<?php echo $remarkid; ?>">
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
<div class="col-12 col-lg-6">
<div class="row">
  <div class="col-12 col-lg-12">
    <div class="card">
        <div class="card-header">
        /**
        * @todo Display current month attendance for student
        * @body It also have a button to export current month attendance as excel by using &_GET["attendance"] = "studentdetails"
        */
         <strong>Attendance</strong>
        </div>
        <div class="card-body">
        <!--tab by attendance -->
        <table class="table table-striped table-sm">
        <thead>
          <tr>
            <th colspan="2">Date</th>
          </tr>
        </thead>
        <tbody>
        <td>
        <table>
        <?php
        $Cards_id='';
          $attendancehold = '';
        $filter = ['_id'=>new \MongoDB\BSON\ObjectId($_GET['id'])];
        $query = new MongoDB\Driver\Query($filter);
        $cursor = $GoNGetzDatabase->executeQuery('GoNGetz.Consumer',$query);

        foreach ($cursor as $document)
        {
          $consumerid = strval($document->_id);
          $filter1 = ['Consumer_id'=>$consumerid];
          $query1 = new MongoDB\Driver\Query($filter1);
          $cursor1 = $GoNGetzDatabase->executeQuery('GoNGetz.Cards',$query1);
          foreach ($cursor1 as $document1)
          {
            $Cards_id = strval($document1->Cards_id);
          }
        }

        $varcount = 0;
        $filterA = ['CardID'=>$Cards_id];
        //$optionA = ['sort' => ['_id' =>1]];
        $queryA = new MongoDB\Driver\Query($filterA);
        $cursorA = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Attendance',$queryA);
        foreach ($cursorA as $documentA)
        {
          $AttendanceDate = new MongoDB\BSON\UTCDateTime(strval($documentA->AttendanceDate));
          $attendance = $AttendanceDate->toDateTime()->setTimezone(new \DateTimeZone(date_default_timezone_get()));
          $attendancehold = date_format($attendance,"d/m/Y");

          $filterA = ['CardID'=>$Cards_id,'AttendanceDate'=> $AttendanceDate];
          //$optionA = ['sort' => ['_id' =>1]];
          $queryA = new MongoDB\Driver\Query($filterA);
          $cursorA = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Attendance',$queryA);
          foreach ($cursorA as $documentA)
          {
            $AttendanceDate = new MongoDB\BSON\UTCDateTime(strval($documentA->AttendanceDate));
            $attendance = $AttendanceDate->toDateTime()->setTimezone(new \DateTimeZone(date_default_timezone_get()));
            $attendancetoday = date_format($attendance,"d/m/Y");

            //value is odd=out
            if ($varcount % 2)
            {
            do
            {
            ?>
            <td style="text-align:right;">OUT</td>
            <td><i class="fas fa-arrow-circle-right"></i></td>
            <td><?php echo date_format($attendance,"H:i"); ?></td>
            <td></td>
            </tr>
            <?php
            $varcount = $varcount + 1;
            }
            while ($varcount <='0');
            }
            //value is even=in
            else
            {
              do
              {
            ?>
            <tr>
            <td>
              <?php echo $attendancehold; ?>
            </td>
            </tr>
            <tr>
            <td style="text-align:right;">IN</td>
            <td><i class="fas fa-arrow-circle-right"></i></td>
            <td><?php echo date_format($attendance,"H:i"); ?></td>
            <td>|</td>
            <?php
            $varcount = $varcount + 1;
            }
            while ($varcount <='0');
            }
          }
        }
      ?>
      </tr>
    </table>
        </td>
        </tbody>
        </table>
        <!-- end tab -->
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
<?php include ('view/modal-updatestudentremark.php'); ?>
<script>
  var Updatestudentremark = document.getElementById('Updatestudentremark')
  Updatestudentremark.addEventListener('show.bs.modal', function (event) {
  // Button that triggered the modal
  var button = event.relatedTarget
  // Extract info from data-bs-* attributes
  var recipient = button.getAttribute('data-bs-whatever')
  // If necessary, you could initiate an AJAX request here
  // and then do the updating in a callback.
  //
  // Update the modal's content.
  var modalTitle = Updatestudentremark.querySelector('.modal-title')
  var modalBodyInput = Updatestudentremark.querySelector('.modal-body input')
  modalBodyInput.value = recipient
  })
</script>
