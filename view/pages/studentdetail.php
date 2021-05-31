<?php
$_SESSION["title"] = "Student Detail";
include 'view/partials/_subheader/subheader-v1.php'; 

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
<style>
.highlight td.default {
background:#FFE2E5;
color:#F64E60 ;
}
</style>
<div><br><br><br><h1 style="color:#696969; text-align:center">Student Personal Info</h1></div><br>
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
                            <form name="AddStudentRemarkFormSubmit" action="model/addstudentremark.php" method="POST">
                            <div class="row">
                              <div class="col">
                                <textarea class="form-control" name="txtconsumerRemark" rows="3"></textarea>
                                <div class="row">
                                  <div class="col text-right">
                                    <input type="hidden" value="<?php echo $_GET['id']; ?>" name="txtconsumerid">
                                    <button type="submit" class="btn btn-primary" name="AddStudentRemarkFormSubmit">Add remark</button>
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
                                $filter2 = ['Consumer_id'=>$_GET['id'],'SubRemarks'=>'0','ConsumerRemarksStatus'=>'ACTIVE'];
                                $option2 = ['sort' => ['_id' => -1],'limit'=>10];
                                $query2 = new MongoDB\Driver\Query($filter2, $option2);
                                $cursor2 = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.StudentRemarks',$query2);

                                foreach ($cursor2 as $document2)
                                {
                                  $_SESSION["staffremarkidparent"] = strval($document2->_id);
                                  $remarkid = strval($document2->_id);
                                  $parentremark = ($document2->ConsumerRemarksDetails);
                                  $consumerremarkdate = ($document2->ConsumerRemarksDate);
                                  $utcdatetime = new MongoDB\BSON\UTCDateTime(strval($consumerremarkdate));
                                  $datetime = $utcdatetime->toDateTime()->setTimezone(new \DateTimeZone(date_default_timezone_get()));
                                  $parentremarkstaffid = ($document2->ConsumerRemarksStaff_id);
                                  ?>
                                    <div class="accordion accordion-flush" id="accordionFlushExample">
                                    <div class="accordion-item" >
                                      <h6 class="accordion-header" id="flush-headingOne">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                                        <tbody>
                                          <tr>
                                          <td><?php print_r($datetime->format('r')); ?></td>
                                          <td>
                                            <?php
                                            $varstaffid1 = new \MongoDB\BSON\ObjectId($parentremarkstaffid);
                                            $filter1 = ['_id' => $varstaffid1];
                                            $query1 = new MongoDB\Driver\Query($filter1);
                                            $cursor1 = $GoNGetzDatabase->executeQuery('GoNGetz.Consumer', $query1);
                                            foreach ($cursor1 as $document1)
                                            {
                                            $ConsumerFName = ($document1->ConsumerFName);
                                            echo $ConsumerFName;
                                            ?>
                                          </td>
                                          <td><?php echo $parentremark;?></td>
                                          </tr>
                                          </tbody>
                                        </button>
                                      </h6>
                                      <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                                      <?php 
                                      $filter4 = ['Consumer_id'=>$_GET['id'],'SubRemarks'=>$_SESSION["staffremarkidparent"],'ConsumerRemarksStatus'=>'ACTIVE'];
                                      $option4 = ['sort' => ['_id' => -1],'limit'=>10];
                                      $query4 = new MongoDB\Driver\Query($filter4, $option4);
                                      $cursor4 = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.StudentRemarks',$query4);
                                      foreach ($cursor4 as $document4)
                                      {
                                        $childremark = ($document4->ConsumerRemarksDetails);
                                        $consumerremarkdate = (($document4->ConsumerRemarksDate));
                                        $utcdatetime = new MongoDB\BSON\UTCDateTime(strval($consumerremarkdate));
                                        $date = $utcdatetime->toDateTime()->setTimezone(new \DateTimeZone(date_default_timezone_get()));
                                        $childremarkstaffid = ($document4->ConsumerRemarksStaff_id);
                                        ?>
                                        <div class="accordion-body">
                                        <tbody>
                                          <tr>
                                            <td><?php print_r($date->format('r')); ?></td>
                                            <td>
                                              <?php echo $childremark;?>
                                            </td>
                                          </tr>
                                          </tbody>
                                        </div>
                                        <?php
                                        }
                                        ?>
                                        <form name="AddStudentRemarkChildFormSubmit" action="model/addstudentremarkchild.php" method="POST">
                                        <div class="row">
                                          <div class="col">
                                            <textarea class="form-control" name="txtconsumerRemark" rows="3"></textarea>
                                            <div class="row">
                                              <div class="col text-right">
                                                <input type="hidden" value="<?php echo $_GET['id']; ?>" name="txtconsumerid">
                                                <input type="hidden" value="<?php echo $remarkid; ?>" name="txtremarkid">
                                                <button type="submit" class="btn btn-primary" name="AddStudentRemarkChildFormSubmit">Add remark</button>
                                              </div>
                                            </div>
                                          </div>
                                        </div>
                                        </form>
                                        <button style="float: right;"type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#Updatestudentremark" data-bs-whatever="<?php echo $remarkid; ?>" style="display: flex;  ">update</button>
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
                                $filter2 = ['Consumer_id'=>$_GET['id'],'SubRemarks'=>'0','ConsumerRemarksStatus'=>'PENDING'];
                                $option2 = ['sort' => ['_id' => -1],'limit'=>10];
                                $query2 = new MongoDB\Driver\Query($filter2, $option2);
                                $cursor2 = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.StudentRemarks',$query2);

                                foreach ($cursor2 as $document2)
                                {
                                  $_SESSION["staffremarkidparent"] = strval($document2->_id);
                                  $remarkid = strval($document2->_id);
                                  $parentremark = ($document2->ConsumerRemarksDetails);
                                  $consumerremarkdate = ($document2->ConsumerRemarksDate);
                                  $utcdatetime = new MongoDB\BSON\UTCDateTime(strval($consumerremarkdate));
                                  $datetime = $utcdatetime->toDateTime()->setTimezone(new \DateTimeZone(date_default_timezone_get()));
                                  $parentremarkstaffid = ($document2->ConsumerRemarksStaff_id);
                                  ?>
                                    <div class="accordion accordion-flush" id="accordionFlushExample">
                                    <div class="accordion-item" >
                                      <h6 class="accordion-header" id="flush-headingOne">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                                        <tbody>
                                          <tr>
                                          <td><?php print_r($datetime->format('r')); ?></td>
                                          <td>
                                            <?php
                                            $varstaffid1 = new \MongoDB\BSON\ObjectId($parentremarkstaffid);
                                            $filter1 = ['_id' => $varstaffid1];
                                            $query1 = new MongoDB\Driver\Query($filter1);
                                            $cursor1 = $GoNGetzDatabase->executeQuery('GoNGetz.Consumer', $query1);
                                            foreach ($cursor1 as $document1)
                                            {
                                            $ConsumerFName = ($document1->ConsumerFName);
                                            echo $ConsumerFName;
                                            ?>
                                          </td>
                                          <td><?php echo $parentremark;?></td>
                                          </tr>
                                          </tbody>
                                        </button>
                                      </h6>
                                      <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                                      <?php 
                                      $filter4 = ['Consumer_id'=>$_GET['id'],'SubRemarks'=>$_SESSION["staffremarkidparent"],'ConsumerRemarksStatus'=>'PENDING'];
                                      $option4 = ['sort' => ['_id' => -1],'limit'=>10];
                                      $query4 = new MongoDB\Driver\Query($filter4, $option4);
                                      $cursor4 = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.StudentRemarks',$query4);
                                      foreach ($cursor4 as $document4)
                                      {
                                        $childremark = ($document4->ConsumerRemarksDetails);
                                        $consumerremarkdate = (($document4->ConsumerRemarksDate));
                                        $utcdatetime = new MongoDB\BSON\UTCDateTime(strval($consumerremarkdate));
                                        $date = $utcdatetime->toDateTime()->setTimezone(new \DateTimeZone(date_default_timezone_get()));
                                        $childremarkstaffid = ($document4->ConsumerRemarksStaff_id);
                                        ?>
                                        <div class="accordion-body">
                                        <tbody>
                                          <tr>
                                            <td><?php print_r($date->format('r')); ?></td>
                                            <td>
                                              <?php echo $childremark;?>
                                            </td>
                                          </tr>
                                          </tbody>
                                        </div>
                                        <?php
                                        }
                                        ?>
                                        <form name="AddStaffRemarkChildFormSubmit" action="model/addstaffremarkchild.php" method="POST">
                                        <div class="row">
                                          <div class="col">
                                            <textarea class="form-control" name="txtconsumerRemark" rows="3"></textarea>
                                            <div class="row">
                                              <div class="col text-right">
                                                <input type="hidden" value="<?php echo $_GET['id']; ?>" name="txtconsumerid">
                                                <input type="hidden" value="<?php echo $remarkid; ?>" name="txtremarkid">
                                                <button type="submit" class="btn btn-primary" name="AddStaffRemarkChildFormSubmit">Add remark</button>
                                              </div>
                                            </div>
                                          </div>
                                        </div>
                                        </form>
                                        <button style="float: right;"type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#Updatestudentremark" data-bs-whatever="<?php echo $remarkid; ?>" style="display: flex;">update</button>
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
                                $filter2 = ['Consumer_id'=>$_GET['id'],'SubRemarks'=>'0','ConsumerRemarksStatus'=>'COMPLETED'];
                                $option2 = ['sort' => ['_id' => -1],'limit'=>10];
                                $query2 = new MongoDB\Driver\Query($filter2, $option2);
                                $cursor2 = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.StudentRemarks',$query2);

                                foreach ($cursor2 as $document2)
                                {
                                  $_SESSION["staffremarkidparent"] = strval($document2->_id);
                                  $remarkid = strval($document2->_id);
                                  $parentremark = ($document2->ConsumerRemarksDetails);
                                  $consumerremarkdate = ($document2->ConsumerRemarksDate);
                                  $utcdatetime = new MongoDB\BSON\UTCDateTime(strval($consumerremarkdate));
                                  $datetime = $utcdatetime->toDateTime()->setTimezone(new \DateTimeZone(date_default_timezone_get()));
                                  $parentremarkstaffid = ($document2->ConsumerRemarksStaff_id);
                                  ?>
                                    <div class="accordion accordion-flush" id="accordionFlushExample">
                                    <div class="accordion-item" >
                                      <h6 class="accordion-header" id="flush-headingOne">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                                        <tbody>
                                          <tr>
                                          <td><?php print_r($datetime->format('r')); ?></td>
                                          <td>
                                            <?php
                                            $varstaffid1 = new \MongoDB\BSON\ObjectId($parentremarkstaffid);
                                            $filter1 = ['_id' => $varstaffid1];
                                            $query1 = new MongoDB\Driver\Query($filter1);
                                            $cursor1 = $GoNGetzDatabase->executeQuery('GoNGetz.Consumer', $query1);
                                            foreach ($cursor1 as $document1)
                                            {
                                            $ConsumerFName = ($document1->ConsumerFName);
                                            echo $ConsumerFName;
                                            ?>
                                          </td>
                                          <td><?php echo $parentremark;?></td>
                                          </tr>
                                          </tbody>
                                        </button>
                                      </h6>
                                      <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                                      <?php 
                                      $filter4 = ['Consumer_id'=>$_GET['id'],'SubRemarks'=>$_SESSION["staffremarkidparent"],'ConsumerRemarksStatus'=>'COMPLETED'];
                                      $option4 = ['sort' => ['_id' => -1],'limit'=>10];
                                      $query4 = new MongoDB\Driver\Query($filter4, $option4);
                                      $cursor4 = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.StudentRemarks',$query4);
                                      foreach ($cursor4 as $document4)
                                      {
                                        $childremark = ($document4->ConsumerRemarksDetails);
                                        $consumerremarkdate = (($document4->ConsumerRemarksDate));
                                        $utcdatetime = new MongoDB\BSON\UTCDateTime(strval($consumerremarkdate));
                                        $date = $utcdatetime->toDateTime()->setTimezone(new \DateTimeZone(date_default_timezone_get()));
                                        $childremarkstaffid = ($document4->ConsumerRemarksStaff_id);
                                        ?>
                                        <div class="accordion-body">
                                        <tbody>
                                          <tr>
                                            <td><?php print_r($date->format('r')); ?></td>
                                            <td>
                                              <?php echo $childremark;?>
                                            </td>
                                          </tr>
                                          </tbody>
                                        </div>
                                        <?php
                                        }
                                        ?>
                                        <form name="AddStaffRemarkChildFormSubmit" action="model/addstaffremarkchild.php" method="POST">
                                        <div class="row">
                                          <div class="col">
                                            <textarea class="form-control" name="txtconsumerRemark" rows="3"></textarea>
                                            <div class="row">
                                              <div class="col text-right">
                                                <input type="hidden" value="<?php echo $_GET['id']; ?>" name="txtconsumerid">
                                                <input type="hidden" value="<?php echo $remarkid; ?>" name="txtremarkid">
                                                <button type="submit" class="btn btn-primary" name="AddStaffRemarkChildFormSubmit">Add remark</button>
                                              </div>
                                            </div>
                                          </div>
                                        </div>
                                        </form>
                                        <button style="float: right;"type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#Updatestudentremark" data-bs-whatever="<?php echo $remarkid; ?>" style="display: flex;">update</button>
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
                    <?php
                      $id = new \MongoDB\BSON\ObjectId($_GET['id']);
                      $filter = ['_id'=>$id];
                      $query = new MongoDB\Driver\Query($filter);
                      $cursor = $GoNGetzDatabase->executeQuery('GoNGetz.Consumer',$query);
                      foreach ($cursor as $document){
                        $ConsumerFName = ($document->ConsumerFName);
                        $ConsumerLName = ($document->ConsumerLName);
                        $ConsumerIDNo = ($document->ConsumerIDNo);
                    ?>
                    <table id="attendance" class="table table-bordered" style="text-align:center">
                    <thead class="table-light">
                        <tr style="color:#696969;">
                        <th scope="col">Student ID</th>
                        <th scope="col">Student Name</th>
                        <th scope="col">Date</th>
                        <th scope="col">IN</th>
                        <th scope="col">OUT</th>
                        </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td class="default"><?php echo $ConsumerIDNo; ?></td>
                        <td class="default"><?php echo $ConsumerFName." ".$ConsumerLName; ?></td>
                        <td class="default"><?php
                    $Cards_id ='';
                    $filter1 = ['Consumer_id'=>$_GET['id']];
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
                    ?></td>
                    <td class="default"><?php
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
                    ?></td>
                    <td class="default"><?php
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
                    }
                    ?></td>
                    </tr>
              </tbody>
              </table>
              <button type="button" style="font-size:15px width:25%" class="btn btn-success"><a href="index.php?page=studentdetail&id=<?php echo $_GET['id']; ?>&attendance=<?php echo "xls"; ?>" tabindex="-1" data-type="alpha" style="color:#FFFFFF; text-decoration: none;">EXPORT ATTENDANCE TO XLS</a></button>
              <?php
              }
              ?>
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
                    filename: "attendancestudent.xls"
                });
              });
            </script>
            <?php
            }
            ?>
            <script type="text/javascript">
            var rows = document.querySelectorAll('tr');

            [...rows].forEach((r) => {
            if (r.querySelectorAll('td:empty').length > 0) {
            r.classList.add('highlight');
            }
            })
            </script>
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

<?php include ('view/pages/modal-updatestudentremark.php'); ?>
