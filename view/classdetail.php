<div style="color:#696969; text-align:center"><br><br><br><h1>Class Info</h1></div><br>
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
              <?php
              $ConsumerFName ='';
              $ConsumerPhone ='';
              $id = new \MongoDB\BSON\ObjectId($_GET['id']);
              $filter = ['_id'=>$id];
              $query = new MongoDB\Driver\Query($filter);
              $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Classrooms',$query);
              foreach ($cursor as $document)
              {
                $_SESSION["classremarkid"] = strval($document->_id);
                $ClassName = ($document->ClassName);
              ?>
              <tbody>
                <tr>
                  <th scope="row" class="table-secondary">Class Name</th>
                  <td class="table-secondary"><?php echo $ClassName; ?> </td>
                </tr>
                <?php
                $filter1= ['StaffLevel'=>'0','SchoolID'=> $_SESSION["loggeduser_schoolID"],'ClassID' => $_GET['id']];
                $query1= new MongoDB\Driver\Query($filter1);
                $cursor1= $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Staff',$query1);
                foreach ($cursor1 as $document1)
                {
                  $ConsumerID = ($document1->ConsumerID);
                  $idstaff = new \MongoDB\BSON\ObjectId($ConsumerID);
                  $filter2 = ['_id'=>$idstaff];
                  $query2 = new MongoDB\Driver\Query($filter2);
                  $cursor2 = $GoNGetzDatabase->executeQuery('GoNGetz.Consumer',$query2);
                  foreach ($cursor2 as $document2)
                  {
                    $ConsumerFName = ($document2->ConsumerFName);
                    $ConsumerPhone = ($document2->ConsumerPhone);
                  }
                }
                ?>
                <tr>
                  <th scope="row">Teacher</th>
                  <td><?php  echo $ConsumerFName; ?></td>
                </tr>
                <tr>
                  <th scope="row">Teacher Phone Number</th>
                  <td><?php echo $ConsumerPhone; ?></td>
                </tr>
                <tr>
                  <th scope="row">Student Names</th>
                  <td>
                    <?php
                    $filter3= ['Schools_id' => $_SESSION["loggeduser_schoolID"],'Class_id'=>$_GET['id']];
                    $query3= new MongoDB\Driver\Query($filter3);
                    $cursor3= $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Students',$query3);
                    $totalstudent = 0;
                    foreach ($cursor3 as $document3)
                    {
                      $totalstudent = $totalstudent+ 1;
                      $Consumer_id = ($document3->Consumer_id);
                      $idstudent = new \MongoDB\BSON\ObjectId($Consumer_id);
                      $filter4 = ['_id'=>$idstudent];
                      $query4 = new MongoDB\Driver\Query($filter4);
                      $cursor4 = $GoNGetzDatabase->executeQuery('GoNGetz.Consumer',$query4);
                      foreach ($cursor4 as $document4)
                      {
                        $Consumer_id = ($document4->_id);
                        $ConsumerFName = ($document4->ConsumerFName);
                        $ConsumerLName = ($document4->ConsumerLName);
                        ?>
                        <a href="index.php?page=studentdetail&id=<?php echo $Consumer_id; ?>" style="color:#076d79; text-decoration: none;">
                        <?php
                        echo $ConsumerFName." ".$ConsumerLName."<br>";
                      }
                    }
                    ?>
                    </a></td>
                  </tr>
                  <tr>
                  <th scope="row">Number of Student</th>
                  <td><?php echo $totalstudent; ?></td>
                </tr>
              </tbody>
              <?php
              }
              ?>
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
                              <form name="AddClassRemarkFormSubmit" action="model/addclassremark.php" method="POST">
                                <div class="row">
                                <div class="col">
                                  <?php
                                  $varstaffid = strval($_SESSION["loggeduser_id"]);
                                  $filter = ['ConsumerID'=>$varstaffid];
                                  $query = new MongoDB\Driver\Query($filter);
                                  $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Staff',$query);
                                  foreach ($cursor as $document)
                                  {
                                   ?>
                                   <textarea class="form-control" name="txtconsumerRemark" rows="3"></textarea>
                                   <div class="row">
                                    <div class="col text-right">
                                      <input type="hidden" value="<?php echo $_GET['id']; ?>" name="txtconsumerid">
                                      <button type="submit" class="btn btn-primary" name="AddClassRemarkFormSubmit">Add remark</button>
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
                                        $filter = ['Class_id'=>$_GET['id'], 'ClassRemarksStatus'=>'ACTIVE'];
                                        $option = ['sort' => ['_id' => -1],'limit'=>10];
                                        $query = new MongoDB\Driver\Query($filter,$option);
                                        $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.ClassRemarks',$query);
                                        foreach ($cursor as $document)
                                        {
                                          $remarkid = ($document->_id);
                                          $classrremark = ($document->ClassRemarksDetails);
                                          $classremarkdate = (($document->ClassRemarksDate));
                                          $utcdatetime = new MongoDB\BSON\UTCDateTime(strval($classremarkdate));
                                          $datetime = $utcdatetime->toDateTime()->setTimezone(new \DateTimeZone(date_default_timezone_get()));
                                          $classremarkstaffid = ($document->ClassRemarksStaff_id);
                                          ?>
                                          <tr>
                                            <td><?php print_r($datetime->format('r'));?></td>
                                            <td><?php echo $classrremark; ?></td>
                                            <td>
                                          <?php
                                          $varstaffid = new \MongoDB\BSON\ObjectId($classremarkstaffid);
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
                                              <button  type="button" class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#Updateclassremark" data-bs-whatever="<?php echo $remarkid; ?>">
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
                                        $filter = ['Class_id'=>$_GET['id'], 'ClassRemarksStatus'=>'PENDING'];
                                        $option = ['sort' => ['_id' => -1],'limit'=>10];
                                        $query = new MongoDB\Driver\Query($filter,$option);
                                        $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.ClassRemarks',$query);
                                        foreach ($cursor as $document)
                                        {
                                          $remarkid = ($document->_id);
                                          $classrremark = ($document->ClassRemarksDetails);
                                          $classremarkdate = (($document->ClassRemarksDate));
                                          $utcdatetime = new MongoDB\BSON\UTCDateTime(strval($classremarkdate));
                                          $datetime = $utcdatetime->toDateTime()->setTimezone(new \DateTimeZone(date_default_timezone_get()));
                                          $classremarkstaffid = ($document->ClassRemarksStaff_id);
                                          ?>
                                          <tr>
                                            <td><?php print_r($datetime->format('r'));?></td>
                                            <td><?php echo $classrremark; ?></td>
                                            <td>
                                          <?php
                                          $varstaffid = new \MongoDB\BSON\ObjectId($classremarkstaffid);
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
                                              <button  type="button" class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#Updateclassremark" data-bs-whatever="<?php echo $remarkid; ?>">
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
                                        $filter = ['Class_id'=>$_GET['id'], 'ClassRemarksStatus'=>'COMPLETED'];
                                        $option = ['sort' => ['_id' => -1],'limit'=>10];
                                        $query = new MongoDB\Driver\Query($filter,$option);
                                        $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.ClassRemarks',$query);
                                        foreach ($cursor as $document)
                                        {
                                          $remarkid = ($document->_id);
                                          $classrremark = ($document->ClassRemarksDetails);
                                          $classremarkdate = (($document->ClassRemarksDate));
                                          $utcdatetime = new MongoDB\BSON\UTCDateTime(strval($classremarkdate));
                                          $datetime = $utcdatetime->toDateTime()->setTimezone(new \DateTimeZone(date_default_timezone_get()));
                                          $classremarkstaffid = ($document->ClassRemarksStaff_id);
                                          ?>
                                          <tr>
                                            <td><?php print_r($datetime->format('r'));?></td>
                                            <td><?php echo $classrremark; ?></td>
                                            <td>
                                          <?php
                                          $varstaffid = new \MongoDB\BSON\ObjectId($classremarkstaffid);
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
                                              <button  type="button" class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#Updateclassremark" data-bs-whatever="<?php echo $remarkid; ?>">
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
                    <strong>Attendance</strong>
                  </div>
                  <div class="card-body">
                    <!--tab by attendance -->
                    <table class="table table-striped table-sm" width="100%" cellspacing="0" style= "text-align: center;">
                      <thead>
                        <tr>
                          <th>Student</th>
                          <th><?php $varnow = date("d-m-Y"); echo $varnow;?></th>
                        </tr>
                      </thead>
                      <tbody>
                      <td></td>
                      <td>
                      <table>
                      <tr style="text-decoration: none;">
                      <?php
                      $Cards_id='';
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
                      $today = new MongoDB\BSON\UTCDateTime((new DateTime($varnow))->getTimestamp()*1000);
                      $varcount = 0;
                      $filterA = ['CardID'=>$Cards_id, 'AttendanceDate' => ['$gte' => $today]];
                      $queryA = new MongoDB\Driver\Query($filterA);
                      $cursorA = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Attendance',$queryA);
                      $varcounting = 0;
                      ?>
                      <?php
                        foreach ($cursorA as $documentA)
                          {
                            $varcounting = $varcounting +1;
                            if ($varcounting % 2){
                              echo"<br>";
                              $displayinout = "In: ";
                            } else {
                              $displayinout = " | Out: ";
                            }
                            $AttendanceDate = ($documentA->AttendanceDate);
                            if (!isset($datecapture) && empty($datecapture)) {
                              $datecapture = $AttendanceDate;
                            }
                            $utcdatetime = new MongoDB\BSON\UTCDateTime(strval($AttendanceDate));
                            $AttendanceDate = $utcdatetime->toDateTime()->setTimezone(new \DateTimeZone(date_default_timezone_get()));
                            if ($datecapture!=$AttendanceDate) {
                            echo $displayinout . date_format($AttendanceDate,"h:i:sa");
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
<?php include ('view/modal-updateclassremark.php'); ?>
<script>
  var Updateclassremark = document.getElementById('Updateclassremark')
  Updateclassremark.addEventListener('show.bs.modal', function (event) {
  // Button that triggered the modal
  var button = event.relatedTarget
  // Extract info from data-bs-* attributes
  var recipient = button.getAttribute('data-bs-whatever')
  // If necessary, you could initiate an AJAX request here
  // and then do the updating in a callback.
  //
  // Update the modal's content.
  var modalTitle = Updateclassremark.querySelector('.modal-title')
  var modalBodyInput = Updateclassremark.querySelector('.modal-body input')
  modalBodyInput.value = recipient
  })
</script>
