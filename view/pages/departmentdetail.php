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
            <div class="card-toolbar" style="text-align:right;">
                    <!--begin::Dropdown-->
                    <div class="dropdown dropdown-inline mr-2">
                    <button type="button" class="btn btn-success btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
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
                        $filter = ['School_id'=>$_SESSION["loggeduser_schoolID"]];
                        $query = new MongoDB\Driver\Query($filter);
                        $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.SchoolsDepartment',$query);
                        foreach ($cursor as $document)
                        {
                          $departmentid = strval($document->_id);
                          $DepartmentName = strval($document->DepartmentName);
                          ?>
                          <li class="dropdown-item">
                              <a href="index.php?page=departmentdetail&id=<?php echo $departmentid; ?>">
                                <?php echo $DepartmentName; ?>
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
    $_SESSION["departmentremarkid"] = strval($document->_id);

    $Department_id = strval($document->_id);
    $DepartmentName = ($document->DepartmentName);
  }
?>
<h1 class="text-center">Department Info</h1><br>
<div class="row">
  <div class="col-1"></div>
  <div class="col-10">
    <div class="card">
      <div class="card-body">
        <div class="row">
          <div class="col-sm">
            <div class="table-responsive">
              <table class="table table-bordered">
                <thead class="table-light"></thead>
                <tbody>
                  <tr class="bg-light">
                    <th>Department</th>
                    <td><?php echo $DepartmentName; ?> </td>
                  </tr>
                  <tr>
                    <th>Staff List</th>
                    <td>
                    <?php
                    $totalstaff = 0;
                    $filter = ['Staffdepartment'=>$Department_id];
                    $query = new MongoDB\Driver\Query($filter);
                    $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Staff',$query);
                    foreach ($cursor as $document)
                    {
                      $totalstaff = $totalstaff + 1;
                      $ConsumerID = $document->ConsumerID;

                      $filter = ['_id'=>new \MongoDB\BSON\ObjectId($ConsumerID)];
                      $query = new MongoDB\Driver\Query($filter);
                      $cursor = $GoNGetzDatabase->executeQuery('GoNGetz.Consumer',$query);
                      foreach ($cursor as $document1)
                      {
                        $Consumer_id = strval($document1->_id);
                        $ConsumerFName = ($document1->ConsumerFName);
                        ?>
                        <a href="index.php?page=staffdetail&id=<?php echo $Consumer_id; ?>">
                        <?php 
                        echo $ConsumerFName."<br>";
                      }
                    }
                    ?>
                  </td>
                  </tr>
                  <tr>
                    <th>Number of Staff</th>
                    <td><?php echo $totalstaff; ?></td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
          <div class="col-sm">
            <div class="card">
              <div class="card-header bg-light">
                <strong>Remarks</strong>
              </div>
              <div class="card-body">
                <div class="tab-content" id="v-pills-tabContent">
                  <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
                    <div class="box">
                      <form name="AddDepartmentRemark" action="model/adddepartmentremark.php" method="POST">
                        <textarea class="department" name="remark"></textarea>
                        <div class="m-3 text-right">
                          <input type="hidden" value="<?= $_GET['id']; ?>" name="id">
                          <button type="submit" class="btn btn-success btn-sm" name="AddDepartmentRemark">Add remark</button>
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
                          $filter = ['Department_id'=>$_GET['id'],'SubRemarks'=>'0','Status'=>'ACTIVE'];
                          $option = ['sort' => ['_id' => -1],'limit'=>10];
                          $query = new MongoDB\Driver\Query($filter, $option);
                          $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.DepartmentRemarks',$query);

                          foreach ($cursor as $document2)
                          {
                            $_SESSION["departmentparent"] = strval($document2->_id);

                            $_id1 = strval($document2->_id);
                            $remark1 = $document2->Details;
                            $staff_id1 = $document2->Staff_id;
                            $date1 = $document2->Date;

                            $utcdatetime1 = new MongoDB\BSON\UTCDateTime(strval($date1));
                            $datetime1 = $utcdatetime1->toDateTime()->setTimezone(new \DateTimeZone(date_default_timezone_get()));
                            ?>
                            <div class="accordion accordion-flush" id="accordionFlushExample">
                              <div class="accordion-item">
                                <h6 class="accordion-header" id="flush-heading<?= $_id1; ?>">
                                  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse<?php echo $_id1; ?>" aria-expanded="false" aria-controls="flush-collapse<?= $_id1; ?>">
                                  <table class="table table-borderless text-left">
                                    <tbody>
                                      <tr class="row">
                                        <td class="col-2"><?= date_format($datetime1,"D,d M Y H:i") ?></td>
                                        <td class="col-2">
                                          <?php
                                          $filter = ['_id' => new \MongoDB\BSON\ObjectId($staff_id1)];
                                          $query = new MongoDB\Driver\Query($filter);
                                          $cursor = $GoNGetzDatabase->executeQuery('GoNGetz.Consumer', $query);
                                          foreach ($cursor as $document1)
                                          {
                                            $ConsumerFName = $document1->ConsumerFName;
                                            echo $ConsumerFName;
                                          }
                                          ?>
                                        </td>
                                        <td class="col"><a align="justify"><?= $remark1; ?></a></td>
                                      </tr>
                                    </tbody>
                                    </table>
                                  </button>
                                </h6>
                                <div  id="flush-collapse<?php echo $_id1; ?>" class="accordion-collapse collapse" aria-labelledby="flush-heading<?php echo $_id1; ?>" data-bs-parent="#accordionFlushExample">
                                  <?php 
                                  $filter = ['Department_id'=>$_GET['id'],'SubRemarks'=>$_id1];
                                  $option = ['sort' => ['_id' => -1],'limit'=>10];
                                  $query = new MongoDB\Driver\Query($filter, $option);
                                  $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.DepartmentRemarks',$query);
                                  foreach ($cursor as $document4)
                                  {
                                    $_id2 = strval($document4->_id);
                                    $remark2 = $document4->Details;
                                    $staff_id2 = $document4->Staff_id;
                                    $date2 = $document4->Date;

                                    $utcdatetime2 = new MongoDB\BSON\UTCDateTime(strval($date2));
                                    $datetime2 = $utcdatetime2->toDateTime()->setTimezone(new \DateTimeZone(date_default_timezone_get()))
                                    ?>
                                    <div class="accordion-body">
                                    <table class="table table-borderless text-left">
                                      <tbody>
                                        <tr class="row">
                                          <td class="col-2"><?= date_format($datetime2,"D,d M Y H:i") ?></td>
                                          <td class="col-2">
                                          <?php
                                          $filter = ['_id' => new \MongoDB\BSON\ObjectId($staff_id2)];
                                          $query = new MongoDB\Driver\Query($filter);
                                          $cursor = $GoNGetzDatabase->executeQuery('GoNGetz.Consumer', $query);
                                          foreach ($cursor as $document1)
                                          {
                                            $ConsumerFName = $document1->ConsumerFName;
                                            echo $ConsumerFName;
                                          }
                                          ?>
                                          </td>
                                          <td class="col"><a align="justify"><?= $remark2;?></a></td>
                                        </tr>
                                      </tbody>
                                    </table>
                                    </div>
                                    <?php
                                    }
                                    ?>
                                    <form name="AddDepartmentRemarkChild" action="model/adddepartmentremarkchild.php" method="POST">
                                        <div class="m-3">
                                          <textarea class="department" name="remark"></textarea>
                                        </div>
                                        <div class="m-3 text-right">
                                          <input type="hidden" value="<?= $_id1; ?>" name="id">
                                          <button type="submit" class="btn btn-light btn-sm" name="AddDepartmentRemarkChild">Add remark</button>
                                          <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#Updatedepartmentremark" data-bs-whatever="<?= $_id1; ?>">Update</button>
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
                          $filter = ['Department_id'=>$_GET['id'],'SubRemarks'=>'0','Status'=>'PENDING'];
                          $option = ['sort' => ['_id' => -1],'limit'=>10];
                          $query = new MongoDB\Driver\Query($filter, $option);
                          $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.DepartmentRemarks',$query);

                          foreach ($cursor as $document2)
                          {
                            $_SESSION["departmentparent"] = strval($document2->_id);
                            $_id1 = strval($document2->_id);
                            $remark1 = $document2->Details;
                            $staff_id1 = $document2->Staff_id;
                            $date1 = $document2->Date;

                            $utcdatetime1 = new MongoDB\BSON\UTCDateTime(strval($date1));
                            $datetime1 = $utcdatetime1->toDateTime()->setTimezone(new \DateTimeZone(date_default_timezone_get()));
                            ?>
                              <div class="accordion accordion-flush" id="accordionFlushExample">
                                <div class="accordion-item">
                                  <h6 class="accordion-header" id="flush-headingOne">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                                      <table class="table table-borderless text-left">
                                        <tbody>
                                          <tr class="row">
                                            <td class="col-2"><?= date_format($datetime1,"D,d M Y H:i") ?></td>
                                            <td class="col-2">
                                              <?php
                                              $filter = ['_id' => new \MongoDB\BSON\ObjectId($staff_id1)];
                                              $query = new MongoDB\Driver\Query($filter);
                                              $cursor = $GoNGetzDatabase->executeQuery('GoNGetz.Consumer', $query);
                                              foreach ($cursor as $document1)
                                              {
                                                $ConsumerFName = ($document1->ConsumerFName);
                                                echo $ConsumerFName;
                                              }
                                              ?>
                                            </td>
                                            <td class="col"><a align="justify"><?= $remark1;?></a></td>
                                          </tr>
                                        </tbody>
                                      </table>
                                    </button>
                                  </h6>
                                  <div  id="flush-collapseOne" class="accordion-collapse collapse mt-3" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                                    <?php 
                                    $filter = ['Department_id'=>$_GET['id'],'SubRemarks'=>$_id1];
                                    $option = ['sort' => ['_id' => -1],'limit'=>10];
                                    $query = new MongoDB\Driver\Query($filter, $option);
                                    $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.DepartmentRemarks',$query);
                                    foreach ($cursor as $document4)
                                    {
                                      $_id2 = strval($document4->_id);
                                      $remark2 = ($document4->Details);
                                      $staff_id2 = ($document4->Staff_id);
                                      $date2 = strval($document4->Date);

                                      $utcdatetime2 = new MongoDB\BSON\UTCDateTime($date2);
                                      $datetime2 = $utcdatetime2->toDateTime()->setTimezone(new \DateTimeZone(date_default_timezone_get()));
                                      ?>
                                      <div class="accordion-body">
                                        <table class="table table-borderless text-left">
                                          <tbody>
                                            <tr class="row">
                                              <td class="col-2"><?= date_format($datetime2,"D,d M Y H:i") ?></td>
                                              <td class="col-2">
                                                <?php
                                                $filter = ['_id' => new \MongoDB\BSON\ObjectId($staff_id2)];
                                                $query = new MongoDB\Driver\Query($filter);
                                                $cursor = $GoNGetzDatabase->executeQuery('GoNGetz.Consumer', $query);
                                                foreach ($cursor as $document1)
                                                {
                                                  $ConsumerFName = ($document1->ConsumerFName);
                                                  echo $ConsumerFName;
                                                }
                                                ?>
                                              </td>
                                              <td class="col"><a align="justify"><?= $remark2;?></a></td>
                                            </tr>
                                          </tbody>
                                        </table>
                                      </div>
                                      <?php
                                    }
                                    ?>
                                    <form name="AddDepartmentRemarkChild" action="model/adddepartmentremarkchild.php" method="POST">
                                      <div class="m-3">
                                        <textarea class="department" name="remark"></textarea>
                                      </div>
                                      <div class="m-3 text-right">
                                        <input type="hidden" value="<?= $_id1; ?>" name="id">
                                        <button type="submit" class="btn btn-light btn-sm" name="AddDepartmentRemarkChild">Add remark</button>
                                        <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#Updatedepartmentremark" data-bs-whatever="<?= $_id1; ?>">update</button>
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
                          $filter = ['Department_id'=>$_GET['id'],'SubRemarks'=>'0','Status'=>'COMPLETED'];
                          $option = ['sort' => ['_id' => -1],'limit'=>10];
                          $query = new MongoDB\Driver\Query($filter, $option);
                          $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.DepartmentRemarks',$query);

                          foreach ($cursor as $document2)
                          {
                            $_SESSION["departmentparent"] = strval($document2->_id);
                            $_id1 = strval($document2->_id);
                            $remark1 = $document2->Details;
                            $date1 = $document2->Date;

                            $utcdatetime1 = new MongoDB\BSON\UTCDateTime(strval($date1));
                            $datetime1 = $utcdatetime1->toDateTime()->setTimezone(new \DateTimeZone(date_default_timezone_get()));
                            $staff_id1 = ($document2->Staff_id);
                            ?>
                              <div class="accordion accordion-flush" id="accordionFlushExample">
                                <div class="accordion-item">
                                  <h6 class="accordion-header" id="flush-headingOne">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                                      <table class="table table-borderless text-left">
                                        <tbody>
                                            <tr class="row">
                                              <td class="col-2"><?= date_format($datetime1,"D,d M Y H:i") ?></td>
                                              <td class="col-2">
                                              <?php
                                              $filter = ['_id' => new \MongoDB\BSON\ObjectId($staff_id1)];
                                              $query = new MongoDB\Driver\Query($filter);
                                              $cursor = $GoNGetzDatabase->executeQuery('GoNGetz.Consumer',$query);
                                              foreach ($cursor as $document1)
                                              {
                                                $ConsumerFName = ($document1->ConsumerFName);
                                                echo $ConsumerFName;
                                              }
                                              ?>
                                              </td>
                                              <td class="col"><a align="justify"><?= $remark1;?></a></td>
                                            </tr>
                                        </tbody>
                                      </table>
                                    </button>
                                  </h6>
                                  <div  id="flush-collapseOne" class="accordion-collapse collapse mt-3" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                                    <?php 
                                    $filter = ['Department_id'=>$_GET['id'],'SubRemarks'=>$_id1];
                                    $option = ['sort' => ['_id' => -1],'limit'=>10];
                                    $query = new MongoDB\Driver\Query($filter,$option);
                                    $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.DepartmentRemarks',$query);
                                    foreach ($cursor as $document4)
                                    {
                                      $_id2 = strval($document4->_id);
                                      $remark2 = $document4->Details;
                                      $staff_id2 = $document4->Staff_id;
                                      $date2 = $document4->Date;

                                      $utcdatetime2 = new MongoDB\BSON\UTCDateTime(strval($date2));
                                      $datetime2 = $utcdatetime2->toDateTime()->setTimezone(new \DateTimeZone(date_default_timezone_get()));
                                      ?>
                                      <div class="accordion-body">
                                        <table class="table table-borderless text-left">
                                          <tbody>
                                            <tr class="row">
                                              <td class="col-2"><?= date_format($datetime2,"D,d M Y H:i") ?></td>
                                              <td class="col-2">
                                              <?php
                                              $filter = ['_id' => new \MongoDB\BSON\ObjectId($staff_id2)];
                                              $query = new MongoDB\Driver\Query($filter);
                                              $cursor = $GoNGetzDatabase->executeQuery('GoNGetz.Consumer',$query);
                                              foreach ($cursor as $document1)
                                              {
                                                $ConsumerFName = ($document1->ConsumerFName);
                                                echo $ConsumerFName;
                                              }
                                              ?>
                                              </td>
                                              <td class="col"><a align="justify"><?= $remark2;?></a></td>
                                            </tr>
                                          </tbody>
                                        </table>
                                      </div>
                                      <?php
                                      }
                                      ?>
                                      <form name="AddDepartmentRemarkChild" action="model/adddepartmentremarkchild.php" method="POST">
                                        <div class="m-3">
                                          <textarea class="department" name="remark"></textarea>
                                        </div>
                                        <div class="m-3 text-right">
                                          <input type="hidden" value="<?= $_id1; ?>" name="id">
                                          <button type="submit" class="btn btn-light btn-sm" name="AddDepartmentRemarkChild">Add remark</button>
                                          <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#Updatedepartmentremark" data-bs-whatever="<?= $_id1; ?>">update</button>
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
        </div>
      </div>
    </div>
  </div>
  <div class="col-1"></div>
</div>
<div class="row">
  <div class="col-1"></div>
  <div class="col-10">
    <div class="card">
      <div class="card-body text-right">
        <a href="index.php?page=departmentdetail&id=<?= $_GET['id']; ?>&attendance=xls" class="btn btn-success btn-sm mb-3 mx-3 text-white">EXPORT ATTENDANCE TO XLS</a>
        <table id="attendance" class="table table-bordered text-left">
          <thead class="bg-light">
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
                $filter = ['Consumer_id'=>$consumerid];
                $query = new MongoDB\Driver\Query($filter);
                $cursor = $GoNGetzDatabase->executeQuery('GoNGetz.Cards',$query);
                foreach ($cursor as $document1)
                {
                  $Cards_id = strval($document1->Cards_id);
                }
                $varnow = date("d-m-Y");
                $today = new MongoDB\BSON\UTCDateTime((new DateTime($varnow))->getTimestamp()*1000);
                ?>
                <td class="default"><?php echo $varnow."<br>"; ?></td>
                <td class="default"><?php
                $varcounting = 0;
                $filter = ['CardID'=>$Cards_id ,'AttendanceDate' => ['$gte' => $today]];
                $option = ['sort' => ['_id' => 1]];
                $query = new MongoDB\Driver\Query($filter,$option);
                $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Attendance',$query);
                foreach ($cursor as $documentA)
                {
                    $AttendanceDate = ($documentA->AttendanceDate);
                    $utcdatetime = new MongoDB\BSON\UTCDateTime(strval($AttendanceDate));
                    $AttendanceDate = $utcdatetime->toDateTime()->setTimezone(new \DateTimeZone(date_default_timezone_get()));
                    $varcounting = $varcounting +1;
                    if ($varcounting % 2){
                      echo date_format($AttendanceDate,"H:i:s")."<br>";}
                }
                ?></td>
                <td class="default"><?php
                $varcounting = 0;
                $filter = ['CardID'=>$Cards_id ,'AttendanceDate' => ['$gte' => $today]];
                $option = ['sort' => ['_id' => 1]];
                $query = new MongoDB\Driver\Query($filter,$option);
                $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Attendance',$query);
                foreach ($cursor as $documentA)
                {
                  $AttendanceDate = ($documentA->AttendanceDate);
                  $utcdatetime = new MongoDB\BSON\UTCDateTime(strval($AttendanceDate));
                  $AttendanceDate = $utcdatetime->toDateTime()->setTimezone(new \DateTimeZone(date_default_timezone_get()));
                  $varcounting = $varcounting +1;
                  if ($varcounting % 2){
                  }
                  else{
                    echo date_format($AttendanceDate,"H:i:s")."<br>";}
                }
                ?></td>
              </tr>
              <?php
            }
          }
          ?>
          </tbody>
        </table>
          <?php
          if (isset($_GET['attendance']) && !empty($_GET['attendance']))
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
          }?>
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
  <div class="col-1"></div>
</div>
<?php
}
else
{
  $filter = [null];
  $query = new MongoDB\Driver\Query($filter);
  $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.SchoolsDepartment',$query);

  foreach ($cursor as $document)
  {
    $_SESSION["departmentremarkid"] = strval($document->_id);

    $Department_id = strval($document->_id);
    $DepartmentName = ($document->DepartmentName);
  }
?>
<h1 class="text-center">Department Info</h1><br>
<div class="row">
  <div class="col-1"></div>
  <div class="col-10">
    <div class="card">
      <div class="card-body">
        <div class="row">
          <div class="col-sm">
            <div class="table-responsive">
              <table class="table table-bordered">
                <thead class="table-light"></thead>
                <tbody>
                  <tr class="bg-light">
                    <th>Department</th>
                    <td><?php echo $DepartmentName; ?> </td>
                  </tr>
                  <tr>
                    <th>Staff List</th>
                    <td>
                    <?php
                    $totalstaff = 0;
                    $filter = ['Staffdepartment'=>$Department_id];
                    $query = new MongoDB\Driver\Query($filter);
                    $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Staff',$query);
                    foreach ($cursor as $document)
                    {
                      $totalstaff = $totalstaff + 1;
                      $ConsumerID = $document->ConsumerID;

                      $filter = ['_id'=>new \MongoDB\BSON\ObjectId($ConsumerID)];
                      $query = new MongoDB\Driver\Query($filter);
                      $cursor = $GoNGetzDatabase->executeQuery('GoNGetz.Consumer',$query);
                      foreach ($cursor as $document1)
                      {
                        $Consumer_id = strval($document1->_id);
                        $ConsumerFName = ($document1->ConsumerFName);
                        ?>
                        <a href="index.php?page=staffdetail&id=<?php echo $Consumer_id; ?>">
                        <?php 
                        echo $ConsumerFName."<br>";
                      }
                    }
                    ?>
                  </td>
                  </tr>
                  <tr>
                    <th>Number of Staff</th>
                    <td><?php echo $totalstaff; ?></td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
          <div class="col-sm">
            <div class="card">
              <div class="card-header bg-light">
                <strong>Remarks</strong>
              </div>
              <div class="card-body">
                <div class="tab-content" id="v-pills-tabContent">
                  <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
                    <div class="box">
                      <form name="AddDepartmentRemark" action="model/adddepartmentremark.php" method="POST">
                        <textarea class="department" name="remark"></textarea>
                        <div class="m-3 text-right">
                          <input type="hidden" value="<?= $Department_id; ?>" name="id">
                          <button type="submit" class="btn btn-success btn-sm" name="AddDepartmentRemark">Add remark</button>
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
                          $filter = ['Department_id'=>$Department_id,'SubRemarks'=>'0','Status'=>'ACTIVE'];
                          $option = ['sort' => ['_id' => -1],'limit'=>10];
                          $query = new MongoDB\Driver\Query($filter, $option);
                          $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.DepartmentRemarks',$query);

                          foreach ($cursor as $document2)
                          {
                            $_SESSION["departmentparent"] = strval($document2->_id);

                            $_id1 = strval($document2->_id);
                            $remark1 = $document2->Details;
                            $staff_id1 = $document2->Staff_id;
                            $date1 = $document2->Date;

                            $utcdatetime1 = new MongoDB\BSON\UTCDateTime(strval($date1));
                            $datetime1 = $utcdatetime1->toDateTime()->setTimezone(new \DateTimeZone(date_default_timezone_get()));
                            ?>
                            <div class="accordion accordion-flush" id="accordionFlushExample">
                              <div class="accordion-item">
                                <h6 class="accordion-header" id="flush-heading<?= $_id1; ?>">
                                  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse<?php echo $_id1; ?>" aria-expanded="false" aria-controls="flush-collapse<?= $_id1; ?>">
                                  <table class="table table-borderless text-left">
                                    <tbody>
                                      <tr class="row">
                                        <td class="col-2"><?= date_format($datetime1,"D,d M Y H:i") ?></td>
                                        <td class="col-2">
                                          <?php
                                          $filter = ['_id' => new \MongoDB\BSON\ObjectId($staff_id1)];
                                          $query = new MongoDB\Driver\Query($filter);
                                          $cursor = $GoNGetzDatabase->executeQuery('GoNGetz.Consumer', $query);
                                          foreach ($cursor as $document1)
                                          {
                                            $ConsumerFName = $document1->ConsumerFName;
                                            echo $ConsumerFName;
                                          }
                                          ?>
                                        </td>
                                        <td class="col"><a align="justify"><?= $remark1; ?></a></td>
                                      </tr>
                                    </tbody>
                                    </table>
                                  </button>
                                </h6>
                                <div  id="flush-collapse<?php echo $_id1; ?>" class="accordion-collapse collapse" aria-labelledby="flush-heading<?php echo $_id1; ?>" data-bs-parent="#accordionFlushExample">
                                  <?php 
                                  $filter = ['Department_id'=>$Department_id,'SubRemarks'=>$_id1];
                                  $option = ['sort' => ['_id' => -1],'limit'=>10];
                                  $query = new MongoDB\Driver\Query($filter, $option);
                                  $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.DepartmentRemarks',$query);
                                  foreach ($cursor as $document4)
                                  {
                                    $_id2 = strval($document4->_id);
                                    $remark2 = $document4->Details;
                                    $staff_id2 = $document4->Staff_id;
                                    $date2 = $document4->Date;

                                    $utcdatetime2 = new MongoDB\BSON\UTCDateTime(strval($date2));
                                    $datetime2 = $utcdatetime2->toDateTime()->setTimezone(new \DateTimeZone(date_default_timezone_get()))
                                    ?>
                                    <div class="accordion-body">
                                    <table class="table table-borderless text-left">
                                      <tbody>
                                        <tr class="row">
                                          <td class="col-2"><?= date_format($datetime2,"D,d M Y H:i") ?></td>
                                          <td class="col-2">
                                          <?php
                                          $filter = ['_id' => new \MongoDB\BSON\ObjectId($staff_id2)];
                                          $query = new MongoDB\Driver\Query($filter);
                                          $cursor = $GoNGetzDatabase->executeQuery('GoNGetz.Consumer', $query);
                                          foreach ($cursor as $document1)
                                          {
                                            $ConsumerFName = $document1->ConsumerFName;
                                            echo $ConsumerFName;
                                          }
                                          ?>
                                          </td>
                                          <td class="col"><a align="justify"><?= $remark2;?></a></td>
                                        </tr>
                                      </tbody>
                                    </table>
                                    </div>
                                    <?php
                                    }
                                    ?>
                                    <form name="AddDepartmentRemarkChild" action="model/adddepartmentremarkchild.php" method="POST">
                                      <div class="m-3">
                                        <textarea class="department" name="remark"></textarea>
                                      </div>
                                      <div class="m-3 text-right">
                                        <input type="hidden" value="<?= $_id1; ?>" name="id">
                                        <button type="submit" class="btn btn-light btn-sm" name="AddDepartmentRemarkChild">Add remark</button>
                                        <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#Updatedepartmentremark" data-bs-whatever="<?= $_id1; ?>">Update</button>
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
                          $filter = ['Department_id'=>$Department_id,'SubRemarks'=>'0','Status'=>'PENDING'];
                          $option = ['sort' => ['_id' => -1],'limit'=>10];
                          $query = new MongoDB\Driver\Query($filter, $option);
                          $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.DepartmentRemarks',$query);

                          foreach ($cursor as $document2)
                          {
                            $_SESSION["departmentparent"] = strval($document2->_id);
                            $_id1 = strval($document2->_id);
                            $remark1 = $document2->Details;
                            $staff_id1 = $document2->Staff_id;
                            $date1 = $document2->Date;

                            $utcdatetime1 = new MongoDB\BSON\UTCDateTime(strval($date1));
                            $datetime1 = $utcdatetime1->toDateTime()->setTimezone(new \DateTimeZone(date_default_timezone_get()));
                            ?>
                              <div class="accordion accordion-flush" id="accordionFlushExample">
                                <div class="accordion-item">
                                  <h6 class="accordion-header" id="flush-headingOne">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                                      <table class="table table-borderless text-left">
                                        <tbody>
                                          <tr class="row">
                                            <td class="col-2"><?= date_format($datetime1,"D,d M Y H:i") ?></td>
                                            <td class="col-2">
                                              <?php
                                              $filter = ['_id' => new \MongoDB\BSON\ObjectId($staff_id1)];
                                              $query = new MongoDB\Driver\Query($filter);
                                              $cursor = $GoNGetzDatabase->executeQuery('GoNGetz.Consumer', $query);
                                              foreach ($cursor as $document1)
                                              {
                                                $ConsumerFName = ($document1->ConsumerFName);
                                                echo $ConsumerFName;
                                              }
                                              ?>
                                            </td>
                                            <td class="col"><a align="justify"><?= $remark1;?></a></td>
                                          </tr>
                                        </tbody>
                                      </table>
                                    </button>
                                  </h6>
                                  <div  id="flush-collapseOne" class="accordion-collapse collapse mt-3" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                                    <?php 
                                    $filter = ['Department_id'=>$Department_id,'SubRemarks'=>$_id1];
                                    $option = ['sort' => ['_id' => -1],'limit'=>10];
                                    $query = new MongoDB\Driver\Query($filter, $option);
                                    $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.DepartmentRemarks',$query);
                                    foreach ($cursor as $document4)
                                    {
                                      $_id2 = strval($document4->_id);
                                      $remark2 = ($document4->Details);
                                      $staff_id2 = ($document4->Staff_id);
                                      $date2 = strval($document4->Date);

                                      $utcdatetime2 = new MongoDB\BSON\UTCDateTime($date2);
                                      $datetime2 = $utcdatetime2->toDateTime()->setTimezone(new \DateTimeZone(date_default_timezone_get()));
                                      
                                      ?>
                                      <div class="accordion-body">
                                        <table class="table table-borderless text-left">
                                          <tbody>
                                            <tr class="row">
                                              <td class="col-2"><?= date_format($datetime2,"D,d M Y H:i") ?></td>
                                              <td class="col-2">
                                                <?php
                                                $filter = ['_id' => new \MongoDB\BSON\ObjectId($staff_id2)];
                                                $query = new MongoDB\Driver\Query($filter);
                                                $cursor = $GoNGetzDatabase->executeQuery('GoNGetz.Consumer', $query);
                                                foreach ($cursor as $document1)
                                                {
                                                  $ConsumerFName = ($document1->ConsumerFName);
                                                  echo $ConsumerFName;
                                                }
                                                ?>
                                              </td>
                                              <td class="col"><a align="justify"><?= $remark2;?></a></td>
                                            </tr>
                                          </tbody>
                                        </table>
                                      </div>
                                      <?php
                                    }
                                    ?>
                                    <form name="AddDepartmentRemarkChild" action="model/adddepartmentremarkchild.php" method="POST">
                                      <div class="m-3">
                                        <textarea class="department" name="remark"></textarea>
                                      </div>
                                      <div class="m-3 text-right">
                                        <input type="hidden" value="<?= $_id1; ?>" name="id">
                                        <button type="submit" class="btn btn-light btn-sm" name="AddDepartmentRemarkChild">Add remark</button>
                                        <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#Updatedepartmentremark" data-bs-whatever="<?= $_id1; ?>">update</button>
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
                          $filter = ['Department_id'=>$Department_id,'SubRemarks'=>'0','Status'=>'COMPLETED'];
                          $option = ['sort' => ['_id' => -1],'limit'=>10];
                          $query = new MongoDB\Driver\Query($filter, $option);
                          $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.DepartmentRemarks',$query);

                          foreach ($cursor as $document2)
                          {
                            $_SESSION["departmentparent"] = strval($document2->_id);
                            $_id1 = strval($document2->_id);
                            $remark1 = $document2->Details;
                            $date1 = $document2->Date;

                            $utcdatetime1 = new MongoDB\BSON\UTCDateTime(strval($date1));
                            $datetime1 = $utcdatetime1->toDateTime()->setTimezone(new \DateTimeZone(date_default_timezone_get()));
                            $staff_id1 = ($document2->Staff_id);
                            ?>
                              <div class="accordion accordion-flush" id="accordionFlushExample">
                                <div class="accordion-item">
                                  <h6 class="accordion-header" id="flush-headingOne">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                                      <table class="table table-borderless text-left">
                                        <tbody>
                                            <tr class="row">
                                              <td class="col-2"><?= date_format($datetime1,"D,d M Y H:i") ?></td>
                                              <td class="col-2">
                                              <?php
                                              $filter = ['_id' => new \MongoDB\BSON\ObjectId($staff_id1)];
                                              $query = new MongoDB\Driver\Query($filter);
                                              $cursor = $GoNGetzDatabase->executeQuery('GoNGetz.Consumer',$query);
                                              foreach ($cursor as $document1)
                                              {
                                                $ConsumerFName = ($document1->ConsumerFName);
                                                echo $ConsumerFName;
                                              }
                                              ?>
                                              </td>
                                              <td class="col"><a align="justify"><?= $remark1;?></a></td>
                                            </tr>
                                        </tbody>
                                      </table>
                                    </button>
                                  </h6>
                                  <div  id="flush-collapseOne" class="accordion-collapse collapse mt-3" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                                    <?php 
                                    $filter = ['Department_id'=>$Department_id,'SubRemarks'=>$_id1];
                                    $option = ['sort' => ['_id' => -1],'limit'=>10];
                                    $query = new MongoDB\Driver\Query($filter,$option);
                                    $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.DepartmentRemarks',$query);
                                    foreach ($cursor as $document4)
                                    {
                                      $_id2 = strval($document4->_id);
                                      $remark2 = $document4->Details;
                                      $staff_id2 = $document4->Staff_id;
                                      $date2 = $document4->Date;

                                      $utcdatetime2 = new MongoDB\BSON\UTCDateTime(strval($date2));
                                      $datetime2 = $utcdatetime2->toDateTime()->setTimezone(new \DateTimeZone(date_default_timezone_get()));
                                      ?>
                                      <div class="accordion-body">
                                        <table class="table table-borderless text-left">
                                          <tbody>
                                            <tr class="row">
                                              <td class="col-2"><?= date_format($datetime2,"D,d M Y H:i") ?></td>
                                              <td class="col-2">
                                              <?php
                                              $filter = ['_id' => new \MongoDB\BSON\ObjectId($staff_id2)];
                                              $query = new MongoDB\Driver\Query($filter);
                                              $cursor = $GoNGetzDatabase->executeQuery('GoNGetz.Consumer',$query);
                                              foreach ($cursor as $document1)
                                              {
                                                $ConsumerFName = ($document1->ConsumerFName);
                                                echo $ConsumerFName;
                                              }
                                              ?>
                                              </td>
                                              <td class="col"><a align="justify"><?= $remark2;?></a></td>
                                            </tr>
                                          </tbody>
                                        </table>
                                      </div>
                                      <?php
                                      }
                                      ?>
                                      <form name="AddDepartmentRemarkChild" action="model/adddepartmentremarkchild.php" method="POST">
                                        <div class="m-3">
                                          <textarea class="department" name="remark"></textarea>
                                        </div>
                                        <div class="m-3 text-right">
                                          <input type="hidden" value="<?= $_id1; ?>" name="id">
                                          <button type="submit" class="btn btn-light btn-sm" name="AddDepartmentRemarkChild">Add remark</button>
                                          <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#Updatedepartmentremark" data-bs-whatever="<?= $_id1; ?>">update</button>
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
        </div>
      </div>
    </div>
  </div>
  <div class="col-1"></div>
</div>
<div class="row">
  <div class="col-1"></div>
  <div class="col-10">
    <div class="card">
      <div class="card-body text-right">
        <a href="index.php?page=departmentdetail&id=<?= $Department_id; ?>&attendance=xls" class="btn btn-success btn-sm mb-3 mx-3 text-white">EXPORT ATTENDANCE TO XLS</a>
        <table id="attendance" class="table table-bordered text-left">
          <thead class="bg-light">
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
          $filter = ['SchoolID'=>$_SESSION["loggeduser_schoolID"],'Staffdepartment'=>$Department_id];
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
                $filter = ['Consumer_id'=>$consumerid];
                $query = new MongoDB\Driver\Query($filter);
                $cursor = $GoNGetzDatabase->executeQuery('GoNGetz.Cards',$query);
                foreach ($cursor as $document1)
                {
                  $Cards_id = strval($document1->Cards_id);
                }
                $varnow = date("d-m-Y");
                $today = new MongoDB\BSON\UTCDateTime((new DateTime($varnow))->getTimestamp()*1000);
                ?>
                <td class="default"><?php echo $varnow."<br>"; ?></td>
                <td class="default"><?php
                $varcounting = 0;
                $filter = ['CardID'=>$Cards_id ,'AttendanceDate' => ['$gte' => $today]];
                $option = ['sort' => ['_id' => 1]];
                $query = new MongoDB\Driver\Query($filter,$option);
                $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Attendance',$query);
                foreach ($cursor as $documentA)
                {
                    $AttendanceDate = ($documentA->AttendanceDate);
                    $utcdatetime = new MongoDB\BSON\UTCDateTime(strval($AttendanceDate));
                    $AttendanceDate = $utcdatetime->toDateTime()->setTimezone(new \DateTimeZone(date_default_timezone_get()));
                    $varcounting = $varcounting +1;
                    if ($varcounting % 2){
                      echo date_format($AttendanceDate,"H:i:s")."<br>";}
                }
                ?></td>
                <td class="default"><?php
                $varcounting = 0;
                $filter = ['CardID'=>$Cards_id ,'AttendanceDate' => ['$gte' => $today]];
                $option = ['sort' => ['_id' => 1]];
                $query = new MongoDB\Driver\Query($filter,$option);
                $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Attendance',$query);
                foreach ($cursor as $documentA)
                {
                  $AttendanceDate = ($documentA->AttendanceDate);
                  $utcdatetime = new MongoDB\BSON\UTCDateTime(strval($AttendanceDate));
                  $AttendanceDate = $utcdatetime->toDateTime()->setTimezone(new \DateTimeZone(date_default_timezone_get()));
                  $varcounting = $varcounting +1;
                  if ($varcounting % 2){
                  }
                  else{
                    echo date_format($AttendanceDate,"H:i:s")."<br>";}
                }
                ?></td>
              </tr>
              <?php
            }
          }
          ?>
          </tbody>
        </table>
          <?php
          if (isset($_GET['attendance']) && !empty($_GET['attendance']))
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
          }?>
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
  <div class="col-1"></div>
</div>
<?php
}
?>
<script type="text/javascript" src='https://cdn.tiny.cloud/1/qagffr3pkuv17a8on1afax661irst1hbr4e6tbv888sz91jc/tinymce/4/tinymce.min.js' referrerpolicy="origin"></script>
<script>
tinymce.init({
  selector: '.department',
  menubar:false,
  statusbar: false,
  toolbar: false,
  height:100,
});
</script>
<?php include ('view/pages/modal-updateremark.php'); ?>