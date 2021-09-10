<?php
$_SESSION["title"] = "Staff Detail";
include 'view/partials/_subheader/subheader-v1.php'; 

$filter = ['_id'=>new \MongoDB\BSON\ObjectId($_GET['id'])];
$query = new MongoDB\Driver\Query($filter);
$cursor = $GoNGetzDatabase->executeQuery('GoNGetz.Consumer',$query);
foreach ($cursor as $document)
{
  $_SESSION["staff_id"] = strval($document->_id);
  $ConsumerFName = $document->ConsumerFName;
  $ConsumerLName = $document->ConsumerLName;
  $ConsumerIDType = $document->ConsumerIDType;
  $ConsumerIDNo = $document->ConsumerIDNo;
  $ConsumerEmail = $document->ConsumerEmail;
  $ConsumerPhone = $document->ConsumerPhone;
  $ConsumerAddress = $document->ConsumerAddress;
  $ConsumerStatus = $document->ConsumerStatus;
}
?>
<style>
.highlight td.default {
background:#FFE2E5;
color:#F64E60 ;
}
</style>
<div><br><br><br><h1 style="color:#696969; text-align:center">Staff Personal Info</h1></div><br>
<div class="row">
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
                  <td class="table-secondary"><?= $ConsumerFName." ".$ConsumerLName; ?> </td>
                </tr>
                <tr>
                <th scope="row">ID Type</th>
                <td><?= $ConsumerIDType; ?></td>
                </tr>
                <tr>
                   <th scope="row">ID Number</th>
                    <td><?= $ConsumerIDNo; ?></td>
                </tr>
                <tr>
                  <th scope="row">Email</th>
                <td><?= $ConsumerEmail; ?></td>
                </tr>
                <tr>
                  <th scope="row">Phone Number</th>
                  <td><?= $ConsumerPhone; ?></td>
                </tr>
                <tr>
                  <th scope="row">Address</th>
                  <td><?= $ConsumerAddress; ?></td>
                </tr>
                <tr>
                   <th scope="row">Status</th>
                   <td><?= $ConsumerStatus; ?></td>
                </tr>
              </tbody>
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
                  <div class="col-sm-12">
                    <div class="tab-content" id="v-pills-tabContent">
                      <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
                        <div class="box">
                        <form name="add_remark" action="model/staff_remark.php" method="POST">
                          <div class="row">
                            <div class="col">
                              <textarea class="form-control" name="remark" rows="3"></textarea>
                              <div class="row">
                                <div class="col text-right">
                                  <input type="hidden" value="<?= $_GET['id']; ?>" name="consumer_id">
                                  <button type="submit" class="btn btn-primary" name="add_remark">Add remark</button>
                                </div>
                              </div>
                            </div>
                          </div>
                        </form>
                        </div>
                        <div class="box">
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
                              <div>
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
                                $filter = ['Consumer_id'=>$_GET['id'],'SubRemarks'=>'0','Status'=>'ACTIVE'];
                                $option = ['sort' => ['_id' => -1],'limit'=>10];
                                $query = new MongoDB\Driver\Query($filter2, $option);
                                $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.StaffRemarks',$query);
                                foreach ($cursor as $document)
                                {
                                  $remark_id = strval($document->_id);
                                  $Staff_id = $document->Staff_id;
                                  $Details = $odcument->Details;
                                  $Date = $document->Date;
                                  $Date = new MongoDB\BSON\UTCDateTime(strval($Date));
                                  $Date = $Date->toDateTime()->setTimezone(new \DateTimeZone(date_default_timezone_get()));
                                  
                                  ?>
                                    <div class="accordion accordion-flush" id="accordionFlushExample">
                                    <div class="accordion-item" >
                                      <h6 class="accordion-header" id="flush-headingOne">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                                        <tbody>
                                          <tr>
                                          <td><?php print_r($Date->format('r')); ?></td>
                                          <td>
                                            <?php
                                            $varstaffid1 = new \MongoDB\BSON\ObjectId($Staff_id);
                                            $filter1 = ['_id' => $varstaffid1];
                                            $query1 = new MongoDB\Driver\Query($filter1);
                                            $cursor1 = $GoNGetzDatabase->executeQuery('GoNGetz.Consumer', $query1);
                                            foreach ($cursor1 as $document1)
                                            {
                                            $ConsumerFName = ($document1->ConsumerFName);
                                            echo $ConsumerFName;
                                            ?>
                                          </td>
                                          <td><?= $Details;?></td>
                                          </tr>
                                          </tbody>
                                        </button>
                                      </h6>
                                      <div  id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                                      <?php 
                                      $filter4 = ['Consumer_id'=>$_GET['id'],'SubRemarks'=>$_SESSION["staffremarkidparent"],'Status'=>'ACTIVE'];
                                      $option4 = ['sort' => ['_id' => -1],'limit'=>10];
                                      $query4 = new MongoDB\Driver\Query($filter4, $option4);
                                      $cursor4 = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.StaffRemarks',$query4);
                                      foreach ($cursor4 as $document4)
                                      {
                                        $childremark = ($document4->ConsumerRemarksDetails);
                                        $Date = (($document4->ConsumerRemarksDate));
                                        $Date = new MongoDB\BSON\UTCDateTime(strval($Date));
                                        $date = $Date->toDateTime()->setTimezone(new \DateTimeZone(date_default_timezone_get()));
                                        $childremarkstaffid = ($document4->ConsumerRemarksStaff_id);
                                        ?>
                                        <div class="accordion-body">
                                        <tbody>
                                          <tr>
                                            <td><?php print_r($date->format('r')); ?></td>
                                            <td>
                                              <?= $childremark;?>
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
                                                <input type="hidden" value="<?= $_GET['id']; ?>" name="txtconsumerid">
                                                <input type="hidden" value="<?= $remark_id; ?>" name="txtremarkid">
                                                <button type="submit" class="btn btn-light-success font-weight-bold mr-2" name="AddStaffRemarkChildFormSubmit">Add remark</button>
                                                <button style="float: right;"type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#UpdateStaffremark" data-bs-whatever="<?= $remark_id; ?>" style="display:flex;">update</button>
                                              </div>
                                            </div>
                                          </div>
                                        </div>
                                        </form>
                                      </div>
                                      </div>
                                    </div>
                                <?php
                                }
                                ?>
                              </div>
                            </div>
                            <div class="tab-pane fade show pending" id="pending" role="tabpanel" aria-labelledby="pending-tab">
                              <div>
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
                                $filter2 = ['Consumer_id'=>$_GET['id'],'SubRemarks'=>'0','Status'=>'PENDING'];
                                $option = ['sort' => ['_id' => -1],'limit'=>10];
                                $query = new MongoDB\Driver\Query($filter2, $option);
                                $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.StaffRemarks',$query);

                                foreach ($cursor as $document)
                                {
                                  $_SESSION["staffremarkidparent"] = strval($document->_id);
                                  $remark_id = strval($document->_id);
                                  $Details = ($document->ConsumerRemarksDetails);
                                  $Date = $document->Date;
                                  $Date = new MongoDB\BSON\UTCDateTime(strval($Date));
                                  $Date = $Date->toDateTime()->setTimezone(new \DateTimeZone(date_default_timezone_get()));
                                  $Staff_id = $document->Staff_id;
                                  ?>
                                    <div class="accordion accordion-flush" id="accordionFlushExample">
                                    <div class="accordion-item" >
                                      <h6 class="accordion-header" id="flush-headingOne">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                                        <tbody>
                                          <tr>
                                          <td><?php print_r($Date->format('r')); ?></td>
                                          <td>
                                            <?php
                                            $varstaffid1 = new \MongoDB\BSON\ObjectId($Staff_id);
                                            $filter1 = ['_id' => $varstaffid1];
                                            $query1 = new MongoDB\Driver\Query($filter1);
                                            $cursor1 = $GoNGetzDatabase->executeQuery('GoNGetz.Consumer', $query1);
                                            foreach ($cursor1 as $document1)
                                            {
                                            $ConsumerFName = ($document1->ConsumerFName);
                                            echo $ConsumerFName;
                                            }
                                            ?>
                                          </td>
                                          <td><?= $Details;?></td>
                                          </tr>
                                          </tbody>
                                        </button>
                                      </h6>
                                      <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                                      <?php 
                                      $filter4 = ['Consumer_id'=>$_GET['id'],'SubRemarks'=>$_SESSION["staffremarkidparent"],'Status'=>'PENDING'];
                                      $option4 = ['sort' => ['_id' => -1],'limit'=>10];
                                      $query4 = new MongoDB\Driver\Query($filter4, $option4);
                                      $cursor4 = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.StaffRemarks',$query4);
                                      foreach ($cursor4 as $document4)
                                      {
                                        $childremark = ($document4->ConsumerRemarksDetails);
                                        $Date = (($document4->ConsumerRemarksDate));
                                        $Date = new MongoDB\BSON\UTCDateTime(strval($Date));
                                        $date = $Date->toDateTime()->setTimezone(new \DateTimeZone(date_default_timezone_get()));
                                        $childremarkstaffid = ($document4->ConsumerRemarksStaff_id);
                                        ?>
                                        <div class="accordion-body">
                                        <tbody>
                                          <tr>
                                            <td><?php print_r($date->format('r')); ?></td>
                                            <td>
                                              <?= $childremark;?>
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
                                                <input type="hidden" value="<?= $_GET['id']; ?>" name="txtconsumerid">
                                                <input type="hidden" value="<?= $remark_id; ?>" name="txtremarkid">
                                                <button type="submit" class="btn btn-light-success font-weight-bold mr-2" name="AddStaffRemarkChildFormSubmit">Add remark</button>
                                                <button style="float: right;"type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#UpdateStaffremark" data-bs-whatever="<?= $remark_id; ?>" style="display: flex;">update</button>
                                              </div>
                                            </div>
                                          </div>
                                        </div>
                                        </form>
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
                              <div>
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
                                $filter2 = ['Consumer_id'=>$_GET['id'],'SubRemarks'=>'0','Status'=>'COMPLETED'];
                                $option = ['sort' => ['_id' => -1],'limit'=>10];
                                $query = new MongoDB\Driver\Query($filter2, $option);
                                $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.StaffRemarks',$query);

                                foreach ($cursor as $document)
                                {
                                  $_SESSION["staffremarkidparent"] = strval($document->_id);
                                  $remark_id = strval($document->_id);
                                  $Details = ($document->ConsumerRemarksDetails);
                                  $Date = $document->Date;
                                  $Date = new MongoDB\BSON\UTCDateTime(strval($Date));
                                  $Date = $Date->toDateTime()->setTimezone(new \DateTimeZone(date_default_timezone_get()));
                                  $Staff_id = $document->Staff_id;
                                  ?>
                                    <div class="accordion accordion-flush" id="accordionFlushExample">
                                    <div class="accordion-item" >
                                      <h6 class="accordion-header" id="flush-headingOne">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                                        <tbody>
                                          <tr>
                                          <td><?php print_r($Date->format('r')); ?></td>
                                          <td>
                                            <?php
                                            $varstaffid1 = new \MongoDB\BSON\ObjectId($Staff_id);
                                            $filter1 = ['_id' => $varstaffid1];
                                            $query1 = new MongoDB\Driver\Query($filter1);
                                            $cursor1 = $GoNGetzDatabase->executeQuery('GoNGetz.Consumer', $query1);
                                            foreach ($cursor1 as $document1)
                                            {
                                            $ConsumerFName = ($document1->ConsumerFName);
                                            echo $ConsumerFName;
                                            ?>
                                          </td>
                                          <td><?= $Details;?></td>
                                          </tr>
                                          </tbody>
                                        </button>
                                      </h6>
                                      <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                                      <?php 
                                      $filter4 = ['Consumer_id'=>$_GET['id'],'SubRemarks'=>$_SESSION["staffremarkidparent"],'Status'=>'COMPLETED'];
                                      $option4 = ['sort' => ['_id' => -1],'limit'=>10];
                                      $query4 = new MongoDB\Driver\Query($filter4, $option4);
                                      $cursor4 = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.StaffRemarks',$query4);
                                      foreach ($cursor4 as $document4)
                                      {
                                        $childremark = ($document4->ConsumerRemarksDetails);
                                        $Date = (($document4->ConsumerRemarksDate));
                                        $Date = new MongoDB\BSON\UTCDateTime(strval($Date));
                                        $date = $Date->toDateTime()->setTimezone(new \DateTimeZone(date_default_timezone_get()));
                                        $childremarkstaffid = ($document4->ConsumerRemarksStaff_id);
                                        ?>
                                        <div class="accordion-body">
                                        <tbody>
                                          <tr>
                                            <td><?php print_r($date->format('r')); ?></td>
                                            <td>
                                              <?= $childremark;?>
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
                                                <input type="hidden" value="<?= $_GET['id']; ?>" name="txtconsumerid">
                                                <input type="hidden" value="<?= $remark_id; ?>" name="txtremarkid">
                                                <button type="submit" class="btn btn-light-success font-weight-bold mr-2" name="AddStaffRemarkChildFormSubmit">Add remark</button>
                                                <button style="float: right;"type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#UpdateStaffremark" data-bs-whatever="<?= $remark_id; ?>" style="display: flex;">update</button>
                                              </div>
                                            </div>
                                          </div>
                                        </div>
                                        </form>
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
                        <th scope="col">Staff ID</th>
                        <th scope="col">Staff Name</th>
                        <th scope="col">Date</th>
                        <th scope="col">IN</th>
                        <th scope="col">OUT</th>
                        </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td class="default"><?= $ConsumerIDNo; ?></td>
                        <td class="default"><?= $ConsumerFName." ".$ConsumerLName; ?></td>
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
                    $query = new MongoDB\Driver\Query($filter2);
                    $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Attendance',$query);
                    $varcounting = 0;
                    
                    foreach ($cursor as $document)
                    {
                      $AttendanceDate = ($document->AttendanceDate);
                      $Date = new MongoDB\BSON\UTCDateTime(strval($AttendanceDate));
                      $AttendanceDate = $Date->toDateTime()->setTimezone(new \DateTimeZone(date_default_timezone_get()));
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
                      $Date = new MongoDB\BSON\UTCDateTime(strval($AttendanceDate));
                      $AttendanceDate = $Date->toDateTime()->setTimezone(new \DateTimeZone(date_default_timezone_get()));
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
                      $Date = new MongoDB\BSON\UTCDateTime(strval($AttendanceDate));
                      $AttendanceDate = $Date->toDateTime()->setTimezone(new \DateTimeZone(date_default_timezone_get()));
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
              <button type="button" style="font-size:15px width:25%" class="btn btn-success"><a href="index.php?page=staffdetail&id=<?= $_GET['id']; ?>&attendance=<?= "xls"; ?>" tabindex="-1" data-type="alpha" style="color:#FFFFFF; text-decoration: none;">EXPORT ATTENDANCE TO XLS</a></button>
              <?php
              }
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
                      filename: "attendancestaff.xls"
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
<?php include ('view/pages/modal-updatestaffremark.php'); ?>
