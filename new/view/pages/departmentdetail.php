<?php
if (isset($_GET['id']) && !empty($_GET['id']))
{

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
<style>
.highlight td.default {
background:red;
color:#ffffff;
}
</style>
<div><br><br><br><h1 style="color:#696969; text-align:center">Department Info</h1></div><br>
<div class="row" >
  <div class="col-md-1 section-1-box wow fadeInUp"></div>
  <div class="col-md-10 section-1-box wow fadeInUp">
  <div class="card">
        <div class="card-body">
        <div class="card-toolbar" style="text-align:right;">
                <!--begin::Dropdown-->
                <div class="dropdown dropdown-inline mr-2">
                <button type="button" class="btn btn-light-primary font-weight-bolder dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="svg-icon svg-icon-md">
                    <!--begin::Svg Icon | path:assets/media/svg/icons/Design/PenAndRuller.svg-->
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <rect x="0" y="0" width="24" height="24"/>
                            <path d="M7,3 L17,3 C19.209139,3 21,4.790861 21,7 C21,9.209139 19.209139,11 17,11 L7,11 C4.790861,11 3,9.209139 3,7 C3,4.790861 4.790861,3 7,3 Z M7,9 C8.1045695,9 9,8.1045695 9,7 C9,5.8954305 8.1045695,5 7,5 C5.8954305,5 5,5.8954305 5,7 C5,8.1045695 5.8954305,9 7,9 Z" fill="#000000"/>
                            <path d="M7,13 L17,13 C19.209139,13 21,14.790861 21,17 C21,19.209139 19.209139,21 17,21 L7,21 C4.790861,21 3,19.209139 3,17 C3,14.790861 4.790861,13 7,13 Z M17,19 C18.1045695,19 19,18.1045695 19,17 C19,15.8954305 18.1045695,15 17,15 C15.8954305,15 15,15.8954305 15,17 C15,18.1045695 15.8954305,19 17,19 Z" fill="#000000" opacity="0.3"/>
                        </g>
                    </svg><!--end::Svg Icon--></span>
                    <!--end::Svg Icon-->
                </span>Sort By</button>
                <!--begin::Dropdown Menu-->
                <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right" style="width:250%;">
                    <!--begin::Navigation-->
                    <ul class="navi flex-column navi-hover py-2">
                    <li class="navi-header font-weight-bolder text-uppercase font-size-sm text-primary pb-2">Choose an option:</li>
                        <?php 
                        $filter = ['School_id'=>$_SESSION["loggeduser_schoolID"]];
                        $query = new MongoDB\Driver\Query($filter);
                        $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.SchoolsDepartment',$query);
                        foreach ($cursor as $document)
                        {
                            $departmentid = strval($document->_id);
                            $DepartmentName = strval($document->DepartmentName);
                            ?>
                            <li style="padding:5px;">
                                <a href="index.php?page=departmentdetail&id=<?php echo $departmentid; ?>" class="navi-link">
                                    <span class="navi-icon">
                                        <i class="la la-user"></i>
                                    </span>
                                    <span class="navi-text"><?php echo $DepartmentName; ?></span>
                                </a>
                            </li>
                            <?php 
                        } 
                        ?>
                    </ul>
                    <!--end::Navigation-->
                </div>
                <!--end::Dropdown Menu-->
            </div>
            <!--end::Dropdown-->
            <!--begin::Dropdown-->
            <div class="dropdown dropdown-inline mr-2">
                    <button type="button" class="btn btn-light-primary font-weight-bolder dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span class="svg-icon svg-icon-md">
                        <!--begin::Svg Icon | path:assets/media/svg/icons/Design/PenAndRuller.svg-->
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <rect x="0" y="0" width="24" height="24"></rect>
                                <path d="M3,16 L5,16 C5.55228475,16 6,15.5522847 6,15 C6,14.4477153 5.55228475,14 5,14 L3,14 L3,12 L5,12 C5.55228475,12 6,11.5522847 6,11 C6,10.4477153 5.55228475,10 5,10 L3,10 L3,8 L5,8 C5.55228475,8 6,7.55228475 6,7 C6,6.44771525 5.55228475,6 5,6 L3,6 L3,4 C3,3.44771525 3.44771525,3 4,3 L10,3 C10.5522847,3 11,3.44771525 11,4 L11,19 C11,19.5522847 10.5522847,20 10,20 L4,20 C3.44771525,20 3,19.5522847 3,19 L3,16 Z" fill="#000000" opacity="0.3"></path>
                                <path d="M16,3 L19,3 C20.1045695,3 21,3.8954305 21,5 L21,15.2485298 C21,15.7329761 20.8241635,16.200956 20.5051534,16.565539 L17.8762883,19.5699562 C17.6944473,19.7777745 17.378566,19.7988332 17.1707477,19.6169922 C17.1540423,19.602375 17.1383289,19.5866616 17.1237117,19.5699562 L14.4948466,16.565539 C14.1758365,16.200956 14,15.7329761 14,15.2485298 L14,5 C14,3.8954305 14.8954305,3 16,3 Z" fill="#000000"></path>
                            </g>
                        </svg>
                        <!--end::Svg Icon-->
                    </span>Export</button>
                    <!--begin::Dropdown Menu-->
                    <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
                        <!--begin::Navigation-->
                        <ul class="navi flex-column navi-hover py-2">
                            <li class="navi-header font-weight-bolder text-uppercase font-size-sm text-primary pb-2">Choose an option:</li>
                            <li class="navi-item">
                                <a href="#" class="navi-link">
                                    <span class="navi-icon">
                                        <i class="la la-print"></i>
                                    </span>
                                    <span class="navi-text">Print</span>
                                </a>
                            </li>
                            <li class="navi-item">
                                <a href="#" class="navi-link">
                                    <span class="navi-icon">
                                        <i class="la la-copy"></i>
                                    </span>
                                    <span class="navi-text">Copy</span>
                                </a>
                            </li>
                            <li class="navi-item">
                                <a href="index.php?page=departmentdetail&id=<?php echo $_GET['id']; ?>&attendance=<?php echo "xls"; ?>">
                                    <span class="navi-icon">
                                        <i class="la la-file-excel-o"></i>
                                    </span>
                                    <span class="navi-text">Excel</span>
                                </a>
                            </li>
                            <li class="navi-item">
                                <a href="#" class="navi-link">
                                    <span class="navi-icon">
                                        <i class="la la-file-text-o"></i>
                                    </span>
                                    <span class="navi-text">CSV</span>
                                </a>
                            </li>
                            <li class="navi-item">
                                <a href="#" class="navi-link">
                                    <span class="navi-icon">
                                        <i class="la la-file-pdf-o"></i>
                                    </span>
                                    <span class="navi-text">PDF</span>
                                </a>
                            </li>
                        </ul>
                        <!--end::Navigation-->
                    </div>
                    <!--end::Dropdown Menu-->
                </div>
                <!--end::Dropdown-->
        </div>
        </div>
      </div>
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
                          <th scope="col" style="color:#696969; text-align:center">Staff ID</th>
                          <th scope="col" style="color:#696969; text-align:center">Staff Name</th>
                          <th scope="col" style="color:#696969; text-align:center">Date</th>
                          <th scope="col" style="color:#696969; text-align:center">IN</th>
                          <th scope="col" style="color:#696969; text-align:center">OUT</th>
                          </tr>
                      </thead>
                      <tbody>
                      <?php
                      $filter = ['SchoolID'=>$_SESSION["loggeduser_schoolID"],'Staffdepartment'=>$_GET['id']];
                      $query = new MongoDB\Driver\Query($filter);
                      $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Staff',$query);
                      foreach ($cursor as $document)
                      {
                      $ConsumerID = strval($document->ConsumerID);

                      $filter = ['_id'=>new \MongoDB\BSON\ObjectId($ConsumerID)];
                      $query = new MongoDB\Driver\Query($filter);
                      $cursor = $GoNGetzDatabase->executeQuery('GoNGetz.Consumer',$query);
                      foreach ($cursor as $document)
                      {
                      $_SESSION["staffremarkid"] = strval($document->_id);
                      $ConsumerFName = ($document->ConsumerFName);
                      $ConsumerLName = ($document->ConsumerLName);
                      $ConsumerIDNo = ($document->ConsumerIDNo);
                      $consumerid = strval($document->_id);
                      $varnow = date("d-m-Y");
                      ?>
                      <tr>
                          <td class="default"><?php echo $ConsumerIDNo; ?></td>
                          <td class="default"><?php echo $ConsumerFName." ".$ConsumerLName; ?></td>
                      <?php
                      $Cards_id ='';
                      $filter1 = ['Consumer_id'=>$consumerid];
                      $query1 = new MongoDB\Driver\Query($filter1);
                      $cursor1 = $GoNGetzDatabase->executeQuery('GoNGetz.Cards',$query1);
                      foreach ($cursor1 as $document1)
                      {
                      $Cards_id = strval($document1->Cards_id);
                      }
                      $varnow = date("d-m-Y");
                      $today = new MongoDB\BSON\UTCDateTime((new DateTime($varnow))->getTimestamp()*1000);
                      ?>
                      <td class="default"><?php echo $varnow."<br>"; ?></td>
                      <td class="default"><?php
                      $varcounting = 0;
                      $filterA = ['CardID'=>$Cards_id ,'AttendanceDate' => ['$gte' => $today]];
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
                      $filterA = ['CardID'=>$Cards_id ,'AttendanceDate' => ['$gte' => $today]];
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
                      <?php
                      }
                  }
              ?>
              </tbody>
                </table>
                <button type="button" style="font-size:15px width:25%" class="btn btn-success"><a href="index.php?page=departmentdetail&id=<?php echo $_GET['id']; ?>&attendance=<?php echo "xls"; ?>" tabindex="-1" data-type="alpha" style="color:#FFFFFF; text-decoration: none;">EXPORT ATTENDANCE TO XLS</a></button>
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
                      filename: "attendancedepartment.xls"
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
<div class="col-md-1 section-1-box wow fadeInUp"></div>
</div>
</div>
<?php include ('view/pages/modal-updatedepartmentremark.php'); ?>
<?php
}
else
{
  ?>
    <div><br><br><br><h1 style="color:#696969; text-align:center">Department Info</h1></div><br>
    <div class="row">
    <div class="col-md-1 section-1-box wow fadeInUp"></div>
    <div class="col-md-10 section-1-box wow fadeInUp">
          <div class="card">
            <div class="card-body">
            <div class="card-toolbar" style="text-align:right;">
                    <!--begin::Dropdown-->
                    <div class="dropdown dropdown-inline mr-2">
                    <button type="button" class="btn btn-light-primary font-weight-bolder dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span class="svg-icon svg-icon-md">
                        <!--begin::Svg Icon | path:assets/media/svg/icons/Design/PenAndRuller.svg-->
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <rect x="0" y="0" width="24" height="24"/>
                                <path d="M7,3 L17,3 C19.209139,3 21,4.790861 21,7 C21,9.209139 19.209139,11 17,11 L7,11 C4.790861,11 3,9.209139 3,7 C3,4.790861 4.790861,3 7,3 Z M7,9 C8.1045695,9 9,8.1045695 9,7 C9,5.8954305 8.1045695,5 7,5 C5.8954305,5 5,5.8954305 5,7 C5,8.1045695 5.8954305,9 7,9 Z" fill="#000000"/>
                                <path d="M7,13 L17,13 C19.209139,13 21,14.790861 21,17 C21,19.209139 19.209139,21 17,21 L7,21 C4.790861,21 3,19.209139 3,17 C3,14.790861 4.790861,13 7,13 Z M17,19 C18.1045695,19 19,18.1045695 19,17 C19,15.8954305 18.1045695,15 17,15 C15.8954305,15 15,15.8954305 15,17 C15,18.1045695 15.8954305,19 17,19 Z" fill="#000000" opacity="0.3"/>
                            </g>
                        </svg><!--end::Svg Icon--></span>
                        <!--end::Svg Icon-->
                    </span>Sort By</button>
                    <!--begin::Dropdown Menu-->
                    <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right" style="width:250%;">
                        <!--begin::Navigation-->
                        <ul class="navi flex-column navi-hover py-2">
                            <li class="navi-header font-weight-bolder text-uppercase font-size-sm text-primary pb-2">Choose an option:</li>
                            <?php 
                            $filter = ['School_id'=>$_SESSION["loggeduser_schoolID"]];
                            $query = new MongoDB\Driver\Query($filter);
                            $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.SchoolsDepartment',$query);
                            foreach ($cursor as $document)
                            {
                                $departmentid = strval($document->_id);
                                $DepartmentName = strval($document->DepartmentName);
                                ?>
                                <li style="padding:5px;">
                                    <a href="index.php?page=departmentdetail&id=<?php echo $departmentid; ?>" class="navi-link">
                                        <span class="navi-icon">
                                            <i class="la la-user"></i>
                                        </span>
                                        <span class="navi-text"><?php echo $DepartmentName; ?></span>
                                    </a>
                                </li>
                                <?php 
                            } 
                            ?>
                        </ul>
                        <!--end::Navigation-->
                    </div>
                    <!--end::Dropdown Menu-->
                </div>
                <!--end::Dropdown-->
                <!--begin::Dropdown-->
                <div class="dropdown dropdown-inline mr-2">
                        <button type="button" class="btn btn-light-primary font-weight-bolder dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="svg-icon svg-icon-md">
                            <!--begin::Svg Icon | path:assets/media/svg/icons/Design/PenAndRuller.svg-->
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <rect x="0" y="0" width="24" height="24"></rect>
                                    <path d="M3,16 L5,16 C5.55228475,16 6,15.5522847 6,15 C6,14.4477153 5.55228475,14 5,14 L3,14 L3,12 L5,12 C5.55228475,12 6,11.5522847 6,11 C6,10.4477153 5.55228475,10 5,10 L3,10 L3,8 L5,8 C5.55228475,8 6,7.55228475 6,7 C6,6.44771525 5.55228475,6 5,6 L3,6 L3,4 C3,3.44771525 3.44771525,3 4,3 L10,3 C10.5522847,3 11,3.44771525 11,4 L11,19 C11,19.5522847 10.5522847,20 10,20 L4,20 C3.44771525,20 3,19.5522847 3,19 L3,16 Z" fill="#000000" opacity="0.3"></path>
                                    <path d="M16,3 L19,3 C20.1045695,3 21,3.8954305 21,5 L21,15.2485298 C21,15.7329761 20.8241635,16.200956 20.5051534,16.565539 L17.8762883,19.5699562 C17.6944473,19.7777745 17.378566,19.7988332 17.1707477,19.6169922 C17.1540423,19.602375 17.1383289,19.5866616 17.1237117,19.5699562 L14.4948466,16.565539 C14.1758365,16.200956 14,15.7329761 14,15.2485298 L14,5 C14,3.8954305 14.8954305,3 16,3 Z" fill="#000000"></path>
                                </g>
                            </svg>
                            <!--end::Svg Icon-->
                        </span>Export</button>
                        <!--begin::Dropdown Menu-->
                        <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
                            <!--begin::Navigation-->
                            <ul class="navi flex-column navi-hover py-2">
                                <li class="navi-header font-weight-bolder text-uppercase font-size-sm text-primary pb-2">Choose an option:</li>
                                <li class="navi-item">
                                    <a href="#" class="navi-link">
                                        <span class="navi-icon">
                                            <i class="la la-print"></i>
                                        </span>
                                        <span class="navi-text">Print</span>
                                    </a>
                                </li>
                                <li class="navi-item">
                                    <a href="#" class="navi-link">
                                        <span class="navi-icon">
                                            <i class="la la-copy"></i>
                                        </span>
                                        <span class="navi-text">Copy</span>
                                    </a>
                                </li>
                                <li class="navi-item">
                                    <a href="#" class="navi-link">
                                        <span class="navi-icon">
                                            <i class="la la-file-excel-o"></i>
                                        </span>
                                        <span class="navi-text">Excel</span>
                                    </a>
                                </li>
                                <li class="navi-item">
                                    <a href="#" class="navi-link">
                                        <span class="navi-icon">
                                            <i class="la la-file-text-o"></i>
                                        </span>
                                        <span class="navi-text">CSV</span>
                                    </a>
                                </li>
                                <li class="navi-item">
                                    <a href="#" class="navi-link">
                                        <span class="navi-icon">
                                            <i class="la la-file-pdf-o"></i>
                                        </span>
                                        <span class="navi-text">PDF</span>
                                    </a>
                                </li>
                            </ul>
                            <!--end::Navigation-->
                        </div>
                        <!--end::Dropdown Menu-->
                    </div>
                    <!--end::Dropdown-->
            </div>
            </div>
          </div>
          <div class="card">
            <div class="card-header">
                <strong>Details</strong>
            </div>
            <div class="card-body">
            </div>
          </div>
    </div>
    </div>
  <?php
}
?>
