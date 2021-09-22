<style>
.highlight td.default 
{
  background:#ff8795;
  color:#ffff ;
  border-color:#ffff;
}
</style>
<!--begin::Content-->
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
	<!--begin::Subheader-->
	<div class="subheader py-2 py-lg-6 subheader-solid" id="kt_subheader">
		<div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
			<!--begin::Info-->
			<div class="d-flex align-items-center flex-wrap mr-1">
				<!--begin::Page Heading-->
				<div class="d-flex align-items-baseline flex-wrap mr-5">
					<!--begin::Page Title-->
					<h5 class="text-dark font-weight-bold my-1 mr-5">Department Detail</h5>
					<!--end::Page Title-->
				</div>
				<!--end::Page Heading-->
			</div>
			<!--end::Info-->
			<!--begin::Toolbar-->
			<div class="d-flex align-items-center">
        <div class="card-toolbar text-right">
          <!--begin::Dropdown-->
          <div class="dropdown dropdown-inline mr-2">
            <button type="button" class="btn btn-success btn-hover-light btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <span class="svg-icon svg-icon-md">
                  <!--begin::Svg Icon | path:assets/media/svg/icons/Design/PenAndRuller.svg-->
                  <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                      <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                          <rect x="0" y="0" width="24" height="24"/>
                          <path d="M7,3 L17,3 C19.209139,3 21,4.790861 21,7 C21,9.209139 19.209139,11 17,11 L7,11 C4.790861,11 3,9.209139 3,7 C3,4.790861 4.790861,3 7,3 Z M7,9 C8.1045695,9 9,8.1045695 9,7 C9,5.8954305 8.1045695,5 7,5 C5.8954305,5 5,5.8954305 5,7 C5,8.1045695 5.8954305,9 7,9 Z" fill="#000000"/>
                          <path d="M7,13 L17,13 C19.209139,13 21,14.790861 21,17 C21,19.209139 19.209139,21 17,21 L7,21 C4.790861,21 3,19.209139 3,17 C3,14.790861 4.790861,13 7,13 Z M17,19 C18.1045695,19 19,18.1045695 19,17 C19,15.8954305 18.1045695,15 17,15 C15.8954305,15 15,15.8954305 15,17 C15,18.1045695 15.8954305,19 17,19 Z" fill="#000000" opacity="0.3"/>
                      </g>
                  </svg>
              </span>Sort By
            </button>
            <!--begin::Dropdown Menu-->
            <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
              <!--begin::Navigation-->
              <ul class="navi flex-column navi-hover">
                <li class="dropdown-item">Choose an option :</li>
                <?php 
                $filter = ['School_id'=>$_SESSION["loggeduser_school_id"]];
                $query = new MongoDB\Driver\Query($filter);
                $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.SchoolsDepartment',$query);
                foreach ($cursor as $document)
                {
                  $department_id = strval($document->_id);
                  $Department_name = $document->DepartmentName;
                  ?>
                  <li class="dropdown-item">
                    <a href="index.php?page=departmentdetail&id=<?= $department_id; ?>">
                      <?= $Department_name; ?>
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
        </div>
			</div>
			<!--end::Toolbar-->
		</div>
	</div>
	<!--end::Subheader-->
<?php
if (isset($_GET['id']) && !empty($_GET['id']))
{
  $filter = ['_id'=>new \MongoDB\BSON\ObjectId($_GET['id'])];
  $query = new MongoDB\Driver\Query($filter);
  $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.SchoolsDepartment',$query);
  foreach ($cursor as $document)
  {
    $_SESSION["department_id"] = strval($document->_id);
    $department_id = strval($document->_id);
    $DepartmentName = $document->DepartmentName;
  }
}
else
{
  $filter = [null];
  $query = new MongoDB\Driver\Query($filter);
  $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.SchoolsDepartment',$query);
  foreach ($cursor as $document)
  {
    $_SESSION["department_id"] = strval($document->_id);
    $department_id = strval($document->_id);
    $DepartmentName = $document->DepartmentName;
  }
}
$date = date("Y-m-d");
$today = new MongoDB\BSON\UTCDateTime((new DateTime($date))->getTimestamp()*1000);
if (isset($_POST['submit_date']))
{
    $date = $_POST['date'];
}
?>
<div class="text-dark-50 text-center">
  <h1>Department Info</h1>
</div>
<div class="card">
  <div class="card-body">
    <div class="row">
      <!-- begin::department detail -->
      <div class="col-sm">
        <div class="table-responsive">
          <table class="table table-bordered">
            <tbody>
              <tr class="bg-light text-dark-50">
                <td>Department</td>
                <td><?= $DepartmentName; ?></td>
              </tr>
              <tr>
                <td>Staff List</td>
                <td>
                <?php
                $ConsumerFName = '';
                $ConsumerLName = '';
                $totalstaff = 0;
                $filter = ['Staffdepartment'=>$department_id];
                $query = new MongoDB\Driver\Query($filter);
                $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Staff',$query);
                foreach ($cursor as $document)
                {
                  $ConsumerID = $document->ConsumerID;
                  $totalstaff = $totalstaff + 1;
                  
                  $filter = ['_id'=>new \MongoDB\BSON\ObjectId($ConsumerID)];
                  $query = new MongoDB\Driver\Query($filter);
                  $cursor = $GoNGetzDatabase->executeQuery('GoNGetz.Consumer',$query);
                  foreach ($cursor as $document)
                  {
                    $ConsumerFName = $document->ConsumerFName;
                    $ConsumerLName = $document->ConsumerLName;
                    ?>
                      <a href="index.php?page=staffdetail&id=<?= $ConsumerID; ?>"><?= $ConsumerFName." ".$ConsumerLName;?></a><br>
                    <?php
                  }
                }
                ?>
                </td>
              </tr>
              <tr>
                <td>Number of Staff</td>
                <td><?= $totalstaff; ?></td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
      <!-- end::department detail -->
      <!-- begin::Remark -->
      <div class="col-sm">
        <div class="card">
          <div class="modal-header bg-light text-dark-50">
            <a>Remarks</a>
          </div>
          <div class="card-body">
            <div class="tab-content" id="v-pills-tabContent">
              <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
                <div class="box">
                  <form name="add_remark" action="model/department_remark.php" method="POST">
                    <textarea class="department" name="remark"></textarea>
                    <div class="mt-3 text-right">
                      <input type="hidden" value="<?= $department_id; ?>" name="department_id">
                      <button type="submit" class="btn btn-success btn-hover-light btn-sm" name="add_remark">Add remark</button>
                    </div>
                  </form>
                </div>
                <div class="box">
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
                      <table class="table mx-3">
                        <thead>
                          <tr class="row">
                            <th class="col-2">Date</th>
                            <th class="col-2">Staff</th>
                            <th class="col">Details</th>
                          </tr>
                        </thead>
                      </table>
                      <?php
                      $filter = ['Department_id'=>$department_id,'SubRemarks'=>'0','Status'=>'ACTIVE'];
                      $option = ['sort' => ['_id' => -1],'limit'=>10];
                      $query = new MongoDB\Driver\Query($filter, $option);
                      $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Department_Remarks',$query);
                      foreach ($cursor as $document1)
                      {
                        $remark_id1 = strval($document1->_id);
                        $Details1 = $document1->Details;
                        $Staff_id1 = $document1->Staff_id;
                        $Date1 = strval($document1->Date);
                        $Date1 = new MongoDB\BSON\UTCDateTime(strval($Date1));
                        $Date1 = $Date1->toDateTime()->setTimezone(new \DateTimeZone(date_default_timezone_get()));

                        $filter = ['_id' => new \MongoDB\BSON\ObjectId($Staff_id1)];
                        $query = new MongoDB\Driver\Query($filter);
                        $cursor = $GoNGetzDatabase->executeQuery('GoNGetz.Consumer', $query);
                        foreach ($cursor as $document1)
                        {
                          $ConsumerFName = $document1->ConsumerFName;
                        }
                        ?>
                        <div class="accordion accordion-flush" id="accordionFlushExample">
                          <div class="accordion-item">
                            <h6 class="accordion-header" id="flush-heading<?= $remark_id1; ?>">
                              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse<?= $remark_id1; ?>" aria-expanded="false" aria-controls="flush-collapse<?= $remark_id1; ?>">
                              <table class="table table-borderless text-left">
                                <tbody>
                                  <tr class="row">
                                    <td class="col-2"><?= date_format($Date1,"D,d M Y H:i") ?></td>
                                    <td class="col-2"><?= $ConsumerFName; ?></td>
                                    <td class="col"><a align="justify"><?= $Details1; ?></a></td>
                                  </tr>
                                </tbody>
                                </table>
                              </button>
                            </h6>
                            <div  id="flush-collapse<?= $remark_id1; ?>" class="accordion-collapse collapse" aria-labelledby="flush-heading<?= $remark_id1; ?>" data-bs-parent="#accordionFlushExample">
                              <?php 
                              $filter = ['Department_id'=>$department_id,'SubRemarks'=>$remark_id1];
                              $option = ['sort' => ['_id' => -1],'limit'=>10];
                              $query = new MongoDB\Driver\Query($filter, $option);
                              $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Department_Remarks',$query);
                              foreach ($cursor as $document2)
                              {
                                $remark_id2 = strval($document2->_id);
                                $Details2 = $document2->Details;
                                $Staff_id2 = $document2->Staff_id;
                                $Date2 = strval($document2->Date);
                                $Date2 = new MongoDB\BSON\UTCDateTime(strval($Date2));
                                $Date2 = $Date2->toDateTime()->setTimezone(new \DateTimeZone(date_default_timezone_get()));

                                $filter = ['_id' => new \MongoDB\BSON\ObjectId($Staff_id2)];
                                $query = new MongoDB\Driver\Query($filter);
                                $cursor = $GoNGetzDatabase->executeQuery('GoNGetz.Consumer', $query);
                                foreach ($cursor as $document)
                                {
                                  $ConsumerFName = $document->ConsumerFName;
                                }
                                ?>
                                <div class="accordion-body">
                                <table class="table table-borderless text-left">
                                  <tbody>
                                    <tr class="row">
                                      <td class="col-2"><?= date_format($Date2,"D,d M Y H:i") ?></td>
                                      <td class="col-2"><?= $ConsumerFName; ?></td>
                                      <td class="col"><a align="justify"><?= $Details2;?></a></td>
                                    </tr>
                                  </tbody>
                                </table>
                                </div>
                                <?php
                                }
                                ?>
                                <form name="add_remark_child" action="model/department_remark.php" method="POST">
                                    <div class="m-3">
                                      <textarea class="department" name="remark"></textarea>
                                    </div>
                                    <div class="m-3 text-right">
                                      <input type="hidden" value="<?= $department_id; ?>" name="department_id">
                                      <input type="hidden" value="<?= $remark_id1; ?>" name="remark_id">
                                      <button type="submit" class="btn btn-light btn-sm" name="add_remark_child">Add remark</button>
                                      <button type="button" class="btn btn-success btn-hover-light btn-sm" data-bs-toggle="modal" data-bs-target="#update_department_remark" data-bs-whatever="<?= $remark_id1; ?>">Update</button>
                                    </div>
                                </form>
                            </div>
                          </div>
                        </div>
                        <?php
                      }
                      ?>
                    </div>
                    <div class="tab-pane fade show pending" id="pending" role="tabpanel" aria-labelledby="pending-tab">
                      <table class="table">
                        <thead>
                          <tr class="row">
                            <th class="col-2">Date</th>
                            <th class="col-2">Staff</th>
                            <th class="col">Details</th>
                          </tr>
                        </thead>
                      </table>
                      <?php
                      $filter = ['Department_id'=>$department_id,'SubRemarks'=>'0','Status'=>'PENDING'];
                      $option = ['sort' => ['_id' => -1],'limit'=>10];
                      $query = new MongoDB\Driver\Query($filter, $option);
                      $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Department_Remarks',$query);
                      foreach ($cursor as $document1)
                      {
                        $remark_id1 = strval($document1->_id);
                        $Details1 = $document1->Details;
                        $Staff_id1 = $document1->Staff_id;
                        $Date1 = strval($document1->Date);
                        $Date1 = new MongoDB\BSON\UTCDateTime(strval($Date1));
                        $Date1 = $Date1->toDateTime()->setTimezone(new \DateTimeZone(date_default_timezone_get()));

                        $filter = ['_id' => new \MongoDB\BSON\ObjectId($Staff_id1)];
                        $query = new MongoDB\Driver\Query($filter);
                        $cursor = $GoNGetzDatabase->executeQuery('GoNGetz.Consumer', $query);
                        foreach ($cursor as $document1)
                        {
                          $ConsumerFName = ($document1->ConsumerFName);
                        }
                        ?>
                          <div class="accordion accordion-flush" id="accordionFlushExample">
                            <div class="accordion-item">
                              <h6 class="accordion-header" id="flush-headingOne">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                                  <table class="table table-borderless text-left">
                                    <tbody>
                                      <tr class="row">
                                        <td class="col-2"><?= date_format($Date1,"D,d M Y H:i") ?></td>
                                        <td class="col-2"><?= $ConsumerFName; ?></td>
                                        <td class="col"><a align="justify"><?= $Details1;?></a></td>
                                      </tr>
                                    </tbody>
                                  </table>
                                </button>
                              </h6>
                              <div  id="flush-collapseOne" class="accordion-collapse collapse mt-3" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                                <?php 
                                $filter = ['Department_id'=>$department_id,'SubRemarks'=>$remark_id1];
                                $option = ['sort' => ['_id' => -1],'limit'=>10];
                                $query = new MongoDB\Driver\Query($filter, $option);
                                $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Department_Remarks',$query);
                                foreach ($cursor as $document2)
                                {
                                  $remark_id2 = strval($document2->_id);
                                  $Details2 = ($document2->Details);
                                  $Staff_id2 = ($document2->Staff_id);
                                  $Date2 = strval($document2->Date);
                                  $Date2 = new MongoDB\BSON\UTCDateTime($Date2);
                                  $Date2 = $Date2->toDateTime()->setTimezone(new \DateTimeZone(date_default_timezone_get()));

                                  $filter = ['_id' => new \MongoDB\BSON\ObjectId($Staff_id2)];
                                  $query = new MongoDB\Driver\Query($filter);
                                  $cursor = $GoNGetzDatabase->executeQuery('GoNGetz.Consumer', $query);
                                  foreach ($cursor as $document)
                                  {
                                    $ConsumerFName = $document->ConsumerFName;
                                  }
                                  ?>
                                  <div class="accordion-body">
                                    <table class="table table-borderless text-left">
                                      <tbody>
                                        <tr class="row">
                                          <td class="col-2"><?= date_format($Date2,"D,d M Y H:i") ?></td>
                                          <td class="col-2"><?= $ConsumerFName; ?></td>
                                          <td class="col"><a align="justify"><?= $Details2;?></a></td>
                                        </tr>
                                      </tbody>
                                    </table>
                                  </div>
                                  <?php
                                }
                                ?>
                                <form name="add_remark_child" action="model/department_remark.php" method="POST">
                                  <div class="m-3">
                                    <textarea class="department" name="remark"></textarea>
                                  </div>
                                  <div class="m-3 text-right">
                                    <input type="hidden" value="<?= $department_id; ?>" name="department_id">
                                    <input type="hidden" value="<?= $remark_id1; ?>" name="remark_id">
                                    <button type="submit" class="btn btn-light btn-sm" name="add_remark_child">Add remark</button>
                                    <button type="button" class="btn btn-success btn-hover-light btn-sm" data-bs-toggle="modal" data-bs-target="#update_department_remark" data-bs-whatever="<?= $remark_id1; ?>">update</button>
                                  </div>
                                </form>
                              </div>
                            </div>
                          </div>
                        <?php
                      }
                      ?>
                    </div>
                    <div class="tab-pane fade show completed" id="completed" role="tabpanel" aria-labelledby="completed-tab">
                      <table class="table mx-3">
                        <thead>
                          <tr class="row">
                            <th class="col-2">Date</th>
                            <th class="col-2">Staff</th>
                            <th class="col">Details</th>
                          </tr>
                        </thead>
                      </table>
                      <?php
                      $filter = ['Department_id'=>$department_id,'SubRemarks'=>'0','Status'=>'COMPLETED'];
                      $option = ['sort' => ['_id' => -1],'limit'=>10];
                      $query = new MongoDB\Driver\Query($filter, $option);
                      $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Department_Remarks',$query);
                      foreach ($cursor as $document1)
                      {
                        $remark_id1 = strval($document1->_id);
                        $Staff_id1 = $document1->Staff_id;
                        $Details1 = $document1->Details;
                        $Date1 = strval($document1->Date);
                        $Date1 = new MongoDB\BSON\UTCDateTime(strval($Date1));
                        $Date1 = $Date1->toDateTime()->setTimezone(new \DateTimeZone(date_default_timezone_get()));
                        
                        $filter = ['_id' => new \MongoDB\BSON\ObjectId($Staff_id1)];
                        $query = new MongoDB\Driver\Query($filter);
                        $cursor = $GoNGetzDatabase->executeQuery('GoNGetz.Consumer',$query);
                        foreach ($cursor as $document)
                        {
                          $ConsumerFName = $document->ConsumerFName;
                        }
                        ?>
                          <div class="accordion accordion-flush" id="accordionFlushExample">
                            <div class="accordion-item">
                              <h6 class="accordion-header" id="flush-headingOne">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                                  <table class="table table-borderless text-left">
                                    <tbody>
                                        <tr class="row">
                                          <td class="col-2"><?= date_format($Date1,"D,d M Y H:i") ?></td>
                                          <td class="col-2"><?= $ConsumerFName;?></td>
                                          <td class="col"><a align="justify"><?= $Details1;?></a></td>
                                        </tr>
                                    </tbody>
                                  </table>
                                </button>
                              </h6>
                              <div  id="flush-collapseOne" class="accordion-collapse collapse mt-3" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                                <?php 
                                $filter = ['Department_id'=>$department_id,'SubRemarks'=>$remark_id1];
                                $option = ['sort' => ['_id' => -1],'limit'=>10];
                                $query = new MongoDB\Driver\Query($filter,$option);
                                $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Department_Remarks',$query);
                                foreach ($cursor as $document2)
                                {
                                  $remark_id2 = strval($document2->_id);
                                  $Details2 = $document2->Details;
                                  $Staff_id2 = $document2->Staff_id;
                                  $Date2 = $document2->Date;
                                  $Date2 = new MongoDB\BSON\UTCDateTime(strval($Date2));
                                  $Date2 = $Date2->toDateTime()->setTimezone(new \DateTimeZone(date_default_timezone_get()));

                                  $filter = ['_id' => new \MongoDB\BSON\ObjectId($Staff_id2)];
                                  $query = new MongoDB\Driver\Query($filter);
                                  $cursor = $GoNGetzDatabase->executeQuery('GoNGetz.Consumer',$query);
                                  foreach ($cursor as $document)
                                  {
                                    $ConsumerFName = $document->ConsumerFName;
                                  }
                                  ?>
                                  <div class="accordion-body">
                                    <table class="table table-borderless text-left">
                                      <tbody>
                                        <tr class="row">
                                          <td class="col-2"><?= date_format($Date2,"D,d M Y H:i") ?></td>
                                          <td class="col-2"><?= $ConsumerFName;?></td>
                                          <td class="col"><a align="justify"><?= $Details2;?></a></td>
                                        </tr>
                                      </tbody>
                                    </table>
                                  </div>
                                  <?php
                                  }
                                  ?>
                                  <form name="add_remark_child" action="model/department_remark.php" method="POST">
                                    <div class="m-3">
                                      <textarea class="department" name="remark"></textarea>
                                    </div>
                                    <div class="m-3 text-right">
                                      <input type="hidden" value="<?= $department_id; ?>" name="department_id">
                                      <input type="hidden" value="<?= $remark_id1; ?>" name="remark_id">
                                      <button type="submit" class="btn btn-light btn-sm" name="add_remark_child">Add remark</button>
                                      <button type="button" class="btn btn-success btn-hover-light btn-sm" data-bs-toggle="modal" data-bs-target="#update_department_remark" data-bs-whatever="<?= $remark_id1; ?>">update</button>
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
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- end::Remark -->
    </div>
  </div>
</div>
<!-- begin::attendance -->
<div class="card">
  <div class="card-body table-responsive">
    <form name="submit_date" action="" method="post">
      <div class="row mb-3">
        <div class="col text-right">
          <input type="date" class="form-control form-control-sm bg-white" name="date" placeholder="Select date" value="<?= $date; ?>"> 
        </div>
        <div class="col text-right">
        <button type="submit" name="submit_date" class="btn btn-success btn-hover-light btn-sm">Submit</button>
          <button type="button" id="submitted" class="btn btn-success btn-hover-light btn-sm">Export Attendance To XLS</button>
        </div>
      </div>
    </form>
    <table id="attendance" class="table table-bordered text-left shadow p-3 mb-5 rounded">
      <thead class="bg-white text-success">
          <tr>
            <th>Staff ID</th>
            <th>Staff Name</th>
            <th>Date</th>
            <th>IN</th>
            <th>OUT</th>
          </tr>
      </thead>
      <tbody>
      <?php
      $Cards_id ='';
      $filter = ['SchoolID'=>$_SESSION["loggeduser_school_id"],'Staffdepartment'=>$department_id];
      $query = new MongoDB\Driver\Query($filter);
      $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Staff',$query);
      foreach ($cursor as $document)
      {
        $ConsumerID = $document->ConsumerID;

        $filter = ['_id'=>new \MongoDB\BSON\ObjectId($ConsumerID)];
        $query = new MongoDB\Driver\Query($filter);
        $cursor = $GoNGetzDatabase->executeQuery('GoNGetz.Consumer',$query);
        foreach ($cursor as $document)
        {
          $consumer_id = strval($document->_id);
          $ConsumerFName = $document->ConsumerFName;
          $ConsumerLName = $document->ConsumerLName;
          $ConsumerIDNo = $document->ConsumerIDNo;

          $Cards_id ='';
          $filter = ['Consumer_id'=>$consumer_id];
          $query = new MongoDB\Driver\Query($filter);
          $cursor = $GoNGetzDatabase->executeQuery('GoNGetz.Cards',$query);
          foreach ($cursor as $document1)
          {
            $Cards_id = strval($document1->Cards_id);
          }
          ?>
          <tr>
            <td class="default"><?= $ConsumerIDNo; ?></td>
            <td class="default"><?= $ConsumerFName." ".$ConsumerLName; ?></td>
            <td class="default"><?= $date."<br>"; ?></td>
            <td class="default"><?php
            $count = 0;
            $filter = ['CardID'=>$Cards_id ,'AttendanceDate' => ['$gte' => $today]];
            $option = ['sort' => ['_id' => 1]];
            $query = new MongoDB\Driver\Query($filter,$option);
            $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Attendance',$query);
            foreach ($cursor as $document)
            {
              $date = strval($document->AttendanceDate);
              $date = new MongoDB\BSON\UTCDateTime($date);
              $date = $date->toDateTime()->setTimezone(new \DateTimeZone(date_default_timezone_get()));

              $count = $count +1;
              if ($count % 2){
                echo date_format($date,"H:i:s")."<br>";}
            }
            ?></td>
            <td class="default"><?php
            $count = 0;
            $filter = ['CardID'=>$Cards_id ,'AttendanceDate' => ['$gte' => $today]];
            $option = ['sort' => ['_id' => 1]];
            $query = new MongoDB\Driver\Query($filter,$option);
            $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Attendance',$query);
            foreach ($cursor as $document)
            {
              $date = strval($document->AttendanceDate);
              $date = new MongoDB\BSON\UTCDateTime($date);
              $date = $date->toDateTime()->setTimezone(new \DateTimeZone(date_default_timezone_get()));

              $count = $count +1;
              if ($count % 2){
              }
              else{
                echo date_format($date,"H:i:s")."<br>";}
            }
            ?></td>
          </tr>
          <?php
        }
      }
      ?>
      </tbody>
    </table>
      <script>
        $(document).ready(function() {
            $("#submitted").click(function() {
                $("#attendance").table2excel({
                filename: "attendance_class.xls"
            });
            });

        });
      </script>
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
<!-- end::attendance -->
<script type="text/javascript" src='https://cdn.tiny.cloud/1/ctl5tdxtaqli3dvaw5f3zolgpcusntlmonfxnq4673uy1x7d/tinymce/4/tinymce.min.js' referrerpolicy="origin"></script>
<script>
tinymce.init({
  selector: '.department',
  menubar:false,
  statusbar: false,
  toolbar: false,
  height:100,
});
</script>
<?php include ('view/pages/modal-update_remark.php'); ?>