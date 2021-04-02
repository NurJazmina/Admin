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
<div><br><br><br><h1 style="color:#696969; text-align:center">Class Info</h1></div><br>
<div class="row" >
  <div class="col-md-1 section-1-box wow fadeInUp"></div>
  <div class="col-md-10 section-1-box wow fadeInUp">
    <div class="card">
      <div class="card-header">
        <strong>Details</strong>
      </div>
      <div class="card-body">
        <div class="row">
          <div class="col-sm">
            <div class="table-responsive">
              <table class="table table-bordered">
              <thead class="table-light">
              </thead>
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
                        $_SESSION["studentclassid"] = strval($document4->_id);
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
          <div class="col-sm">
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
                                   <textarea class="form-control" name="txtclassRemark" rows="3"></textarea>
                                   <div class="row">
                                    <div class="col text-right">
                                      <input type="hidden" value="<?php echo $_GET['id']; ?>" name="txtclassid">
                                      <button type="submit" class="btn btn-primary" name="AddClassRemarkFormSubmit">Add remark</button>
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
                                $filter2 = ['Class_id'=>$_GET['id'],'SubRemarks'=>'0','ClassRemarksStatus'=>'ACTIVE'];
                                $option2 = ['sort' => ['_id' => -1],'limit'=>10];
                                $query2 = new MongoDB\Driver\Query($filter2, $option2);
                                $cursor2 = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.ClassRemarks',$query2);

                                foreach ($cursor2 as $document2)
                                {
                                  $_SESSION["classparent"] = strval($document2->_id);
                                  $remarkid1 = strval($document2->_id);
                                  $remark1 = ($document2->ClassRemarksDetails);
                                  $remarkdate1 = ($document2->ClassRemarksDate);
                                  $utcdatetime1 = new MongoDB\BSON\UTCDateTime(strval($remarkdate1));
                                  $datetime1 = $utcdatetime1->toDateTime()->setTimezone(new \DateTimeZone(date_default_timezone_get()));
                                  $remarkstaffid1 = ($document2->ClassRemarksStaff_id);
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
                                      $filter4 = ['Class_id'=>$_GET['id'],'SubRemarks'=>$_SESSION["classparent"],'ClassRemarksStatus'=>'ACTIVE'];
                                      $option4 = ['sort' => ['_id' => -1],'limit'=>10];
                                      $query4 = new MongoDB\Driver\Query($filter4, $option4);
                                      $cursor4 = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.ClassRemarks',$query4);
                                      foreach ($cursor4 as $document4)
                                      {
                                        $remarkid2 = strval($document4->_id);
                                        $remark2 = ($document4->ClassRemarksDetails);
                                        $remarkdate2 = ($document4->ClassRemarksDate);
                                        $utcdatetime2 = new MongoDB\BSON\UTCDateTime(strval($remarkdate2));
                                        $datetime2 = $utcdatetime2->toDateTime()->setTimezone(new \DateTimeZone(date_default_timezone_get()));
                                        $remarkstaffid2 = ($document4->ClassRemarksStaff_id);
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
                                        <form name="AddClassRemarkChildFormSubmit" action="model/addclassremarkchild.php" method="POST">
                                        <div class="row">
                                          <div class="col">
                                            <textarea class="form-control" name="txtconsumerRemark" rows="3"></textarea>
                                            <div class="row">
                                              <div class="col text-right">
                                                <input type="hidden" value="<?php echo $_GET['id']; ?>" name="txtclassid">
                                                <input type="hidden" value="<?php echo $remarkid1; ?>" name="txtremarkid">
                                                <button type="submit" class="btn btn-primary" name="AddClassRemarkChildFormSubmit">Add remark</button>
                                              </div>
                                            </div>
                                          </div>
                                        </div>
                                        </form>
                                        <button style="float: right;"type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#UpdateClassremark" data-bs-whatever="<?php echo $remarkid1; ?>" style="display: flex;  ">update</button>
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
                                $filter2 = ['Class_id'=>$_GET['id'],'SubRemarks'=>'0','ClassRemarksStatus'=>'PENDING'];
                                $option2 = ['sort' => ['_id' => -1],'limit'=>10];
                                $query2 = new MongoDB\Driver\Query($filter2, $option2);
                                $cursor2 = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.ClassRemarks',$query2);

                                foreach ($cursor2 as $document2)
                                {
                                  $_SESSION["classparent"] = strval($document2->_id);
                                  $remarkid1 = strval($document2->_id);
                                  $remark1 = ($document2->ClassRemarksDetails);
                                  $remarkdate1 = ($document2->ClassRemarksDate);
                                  $utcdatetime1 = new MongoDB\BSON\UTCDateTime(strval($remarkdate1));
                                  $datetime1 = $utcdatetime1->toDateTime()->setTimezone(new \DateTimeZone(date_default_timezone_get()));
                                  $remarkstaffid1 = ($document2->ClassRemarksStaff_id);
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
                                      $filter4 = ['Class_id'=>$_GET['id'],'SubRemarks'=>$_SESSION["classparent"],'ClassRemarksStatus'=>'PENDING'];
                                      $option4 = ['sort' => ['_id' => -1],'limit'=>10];
                                      $query4 = new MongoDB\Driver\Query($filter4, $option4);
                                      $cursor4 = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.ClassRemarks',$query4);
                                      foreach ($cursor4 as $document4)
                                      {
                                        $remarkid2 = strval($document4->_id);
                                        $remark2 = ($document4->ClassRemarksDetails);
                                        $remarkdate2 = ($document4->ClassRemarksDate);
                                        $utcdatetime2 = new MongoDB\BSON\UTCDateTime(strval($remarkdate2));
                                        $datetime2 = $utcdatetime2->toDateTime()->setTimezone(new \DateTimeZone(date_default_timezone_get()));
                                        $remarkstaffid2 = ($document4->ClassRemarksStaff_id);
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
                                        <form name="AddClassRemarkChildFormSubmit" action="model/addclassremarkchild.php" method="POST">
                                        <div class="row">
                                          <div class="col">
                                            <textarea class="form-control" name="txtconsumerRemark" rows="3"></textarea>
                                            <div class="row">
                                              <div class="col text-right">
                                                <input type="hidden" value="<?php echo $_GET['id']; ?>" name="txtclassid">
                                                <input type="hidden" value="<?php echo $remarkid1; ?>" name="txtremarkid">
                                                <button type="submit" class="btn btn-primary" name="AddClassRemarkChildFormSubmit">Add remark</button>
                                              </div>
                                            </div>
                                          </div>
                                        </div>
                                        </form>
                                        <button style="float: right;"type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#UpdateClassremark" data-bs-whatever="<?php echo $remarkid1; ?>" style="display: flex;  ">update</button>
                                      </div>
                                      </div>
                                    </div>
                                <?php
                                }
                                }
                                ?>
                              </div>
                            </div>
                            <div class="tab-pane fade show completed" id="completed" role="tabpanel" aria-labelledby="comleted-tab">
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
                                $filter2 = ['Class_id'=>$_GET['id'],'SubRemarks'=>'0','ClassRemarksStatus'=>'COMPLETED'];
                                $option2 = ['sort' => ['_id' => -1],'limit'=>10];
                                $query2 = new MongoDB\Driver\Query($filter2, $option2);
                                $cursor2 = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.ClassRemarks',$query2);

                                foreach ($cursor2 as $document2)
                                {
                                  $_SESSION["classparent"] = strval($document2->_id);
                                  $remarkid1 = strval($document2->_id);
                                  $remark1 = ($document2->ClassRemarksDetails);
                                  $remarkdate1 = ($document2->ClassRemarksDate);
                                  $utcdatetime1 = new MongoDB\BSON\UTCDateTime(strval($remarkdate1));
                                  $datetime1 = $utcdatetime1->toDateTime()->setTimezone(new \DateTimeZone(date_default_timezone_get()));
                                  $remarkstaffid1 = ($document2->ClassRemarksStaff_id);
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
                                      $filter4 = ['Class_id'=>$_GET['id'],'SubRemarks'=>$_SESSION["classparent"],'ClassRemarksStatus'=>'COMPLETED'];
                                      $option4 = ['sort' => ['_id' => -1],'limit'=>10];
                                      $query4 = new MongoDB\Driver\Query($filter4, $option4);
                                      $cursor4 = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.ClassRemarks',$query4);
                                      foreach ($cursor4 as $document4)
                                      {
                                        $remarkid2 = strval($document4->_id);
                                        $remark2 = ($document4->ClassRemarksDetails);
                                        $remarkdate2 = ($document4->ClassRemarksDate);
                                        $utcdatetime2 = new MongoDB\BSON\UTCDateTime(strval($remarkdate2));
                                        $datetime2 = $utcdatetime2->toDateTime()->setTimezone(new \DateTimeZone(date_default_timezone_get()));
                                        $remarkstaffid2 = ($document4->ClassRemarksStaff_id);
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
                                        <form name="AddClassRemarkChildFormSubmit" action="model/addclassremarkchild.php" method="POST">
                                        <div class="row">
                                          <div class="col">
                                            <textarea class="form-control" name="txtconsumerRemark" rows="3"></textarea>
                                            <div class="row">
                                              <div class="col text-right">
                                                <input type="hidden" value="<?php echo $_GET['id']; ?>" name="txtclassid">
                                                <input type="hidden" value="<?php echo $remarkid1; ?>" name="txtremarkid">
                                                <button type="submit" class="btn btn-primary" name="AddClassRemarkChildFormSubmit">Add remark</button>
                                              </div>
                                            </div>
                                          </div>
                                        </div>
                                        </form>
                                        <button style="float: right;"type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#UpdateClassremark" data-bs-whatever="<?php echo $remarkid1; ?>" style="display: flex;  ">update</button>
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
        <div class="w-100"></div>
        <div class="col-sm">
        <div class="row">
          <div class="col-12 col-lg-12">
            <div class="card">
              <div class="card-header">
                <strong>Attendance</strong>
              </div>
              <div class="card-body">
                <div class="row">
                  <div class="col-sm-12">
                    <table id="attendance" class="table table-bordered ">
                    <thead class="table-light">
                        <tr>
                        <th scope="col" style="color:#696969; text-align:center">Student ID</th>
                        <th scope="col" style="color:#696969; text-align:center">Student Name</th>
                        <th scope="col" style="color:#696969; text-align:center">Date</th>
                        <th scope="col" style="color:#696969; text-align:center">IN</th>
                        <th scope="col" style="color:#696969; text-align:center">OUT</th>
                        </tr>
                    </thead>
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
                        $_SESSION["studentclassid"] = strval($document4->_id);
                        $Consumer_id = ($document4->_id);
                        $ConsumerFName = ($document4->ConsumerFName);
                        $ConsumerLName = ($document4->ConsumerLName);
                        $ConsumerIDNo = ($document4->ConsumerIDNo);
                      }
                    ?>
                    <tbody>
                    <tr>
                        <td style="text-align:center"><?php echo $ConsumerIDNo; ?></td>
                        <td style="text-align:center"><?php echo $ConsumerFName." ".$ConsumerLName; ?></td>
                        <td style="text-align:center">
                    <?php
                    $Cards_id ='';
                    $filter1 = ['Consumer_id'=>$_SESSION["studentclassid"]];
                    $query1 = new MongoDB\Driver\Query($filter1);
                    $cursor1 = $GoNGetzDatabase->executeQuery('GoNGetz.Cards',$query1);
                    foreach ($cursor1 as $document1)
                    {
                    $Cards_id = strval($document1->Cards_id);
                    }
                    /*
                    check date
                    $convert = $from_date->toDateTime()->setTimezone(new \DateTimeZone(date_default_timezone_get()));
                    echo "<br>to_date: ".$to_date."<br>";
                    echo "from_date: ".$from_date."<br>";
                    $display = date_format($convert,"d/m/Y");
                    echo $display;
                    */
                    $to_date = new MongoDB\BSON\UTCDateTime((new DateTime('now'))->getTimestamp()*1000);
                    $from_date = new MongoDB\BSON\UTCDateTime((new DateTime('now -1 month'))->getTimestamp()*1000);

                    $filter2 = ['CardID'=>$Cards_id ,'AttendanceDate' => ['$gte' => $from_date,'$lte' => $to_date]];
                    $query2 = new MongoDB\Driver\Query($filter2);
                    $cursor2 = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Attendance',$query2);
                    $varcounting = 0;
                    
                    foreach ($cursor2 as $document2)
                    {
                      $AttendanceDate = ($document2->AttendanceDate);
                      $utcdatetime = new MongoDB\BSON\UTCDateTime(strval($AttendanceDate));
                      $AttendanceDate = $utcdatetime->toDateTime()->setTimezone(new \DateTimeZone(date_default_timezone_get()));
                      $varcounting = $varcounting +1;
                      if ($varcounting % 2)
                      {
                      } 
                      else 
                      {
                        echo date_format($AttendanceDate,"d-m-Y")."<br>";
                      }
                    }
                    ?>
                    </td>
                    <td style="text-align:center">
                    <?php
                    $varcounting = 0;
                    $filterA = ['CardID'=>$Cards_id ,'AttendanceDate' => ['$gte' => $from_date,'$lte' => $to_date]];
                    $optionA = ['sort' => ['_id' => 1]];
                    $queryA = new MongoDB\Driver\Query($filterA,$optionA);
                    $cursorA = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Attendance',$queryA);
                    
                    foreach ($cursorA as $documentA)
                    {
                      $AttendanceDate = ($documentA->AttendanceDate);
                      $utcdatetime = new MongoDB\BSON\UTCDateTime(strval($AttendanceDate));
                      $AttendanceDate = $utcdatetime->toDateTime()->setTimezone(new \DateTimeZone(date_default_timezone_get()));
                      $varcounting = $varcounting +1;

                    if ($varcounting % 2)
                    {
                      echo date_format($AttendanceDate,"H:i:s")."<br>";
                    } 
                    else
                    {
                    }
                    }
                    ?>
                    </td>
                    <td style="text-align:center">
                    <?php
                    $varcounting = 0;
                    $filterA = ['CardID'=>$Cards_id ,'AttendanceDate' => ['$gte' => $from_date,'$lte' => $to_date]];
                    $optionA = ['sort' => ['_id' => 1]];
                    $queryA = new MongoDB\Driver\Query($filterA,$optionA);
                    $cursorA = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Attendance',$queryA);
                    
                    foreach ($cursorA as $documentA)
                    {
                      $AttendanceDate = ($documentA->AttendanceDate);
                      $utcdatetime = new MongoDB\BSON\UTCDateTime(strval($AttendanceDate));
                      $AttendanceDate = $utcdatetime->toDateTime()->setTimezone(new \DateTimeZone(date_default_timezone_get()));
                      $varcounting = $varcounting +1;

                    if ($varcounting % 2)
                    {
                    } 
                    else
                    {
                      echo date_format($AttendanceDate,"H:i:s")."<br>";
                    }
                    ?>
                    <?php
                    }
                  }
                    ?>
                    </td>
                    </tr>
              </tbody>
              </table>
              <button type="button" style="font-size:15px width:25%" class="btn btn-success"><a href="index.php?page=classdetail&id=<?php echo $_GET['id']; ?>&attendance=<?php echo "xls"; ?>" tabindex="-1" data-type="alpha" style="color:#FFFFFF; text-decoration: none;">EXPORT ATTENDANCE TO XLS</a></button>
            <?php
            if (!isset($_GET['attendance']) && empty($_GET['attendance']))
            {

            }
            else
            {
            $attendance = ($_GET['attendance']);
            ?>
            <script>
              $(document).ready(function () {
                $("#attendance").table2excel({
                    filename: "attendanceclass.xls"
                });
              });
              
            </script>
            <?php
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
<div class="col-md-1 section-1-box wow fadeInUp"></div>
</div>
<?php include ('view/modal-updateclassremark.php'); ?>
<script>
  var UpdateClassremark = document.getElementById('UpdateClassremark')
  UpdateClassremark.addEventListener('show.bs.modal', function (event) {
  // Button that triggered the modal
  var button = event.relatedTarget
  // Extract info from data-bs-* attributes
  var recipient = button.getAttribute('data-bs-whatever')
  // If necessary, you could initiate an AJAX request here
  // and then do the updating in a callback.
  //
  // Update the modal's content.
  var modalTitle = UpdateClassremark.querySelector('.modal-title')
  var modalBodyInput = UpdateClassremark.querySelector('.modal-body input')
  modalBodyInput.value = recipient
  })
</script>
