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
					<h5 class="text-dark font-weight-bold my-1 mr-5">Staff Detail</h5>
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
            <button type="button" class="btn btn-light btn-hover-success btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
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
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
              <!--begin::Navigation-->
              <ul class="navi flex-column navi-hover">
                <li class="dropdown-item">Choose an option :</li>
                <?php 
                $filter = ['SchoolID'=>$_SESSION["loggeduser_school_id"]];
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
                    $ConsumerFName = $document->ConsumerFName;
                    $ConsumerLName = $document->ConsumerLName;
                  }
                  ?>
                  <li class="dropdown-item">
                    <a href="index.php?page=staffdetail&id=<?= $ConsumerID; ?>">
                      <?= $ConsumerFName." ".$ConsumerLName ; ?>
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
  // group : school
  $filter = ['_id'=>new \MongoDB\BSON\ObjectId($_GET['id'])];
  $query = new MongoDB\Driver\Query($filter);
  $cursor = $GoNGetzDatabase->executeQuery('GoNGetz.Consumer',$query);
  foreach ($cursor as $document)
  {
    $_SESSION["consumer_id"] = strval($document->_id);
    $consumer_id = strval($document->_id);
    $ConsumerFName = $document->ConsumerFName;
    $ConsumerLName = $document->ConsumerLName;
    $ConsumerIDType = $document->ConsumerIDType;
    $ConsumerIDNo = $document->ConsumerIDNo;
    $ConsumerEmail = $document->ConsumerEmail;
    $ConsumerPhone = $document->ConsumerPhone;
    $ConsumerAddress = $document->ConsumerAddress;
    $ConsumerStatus = $document->ConsumerStatus;
  }
}
else
{
  // group : school
  $filter = ['ConsumerGroup_id'=>'601b4cfd97728c027c01f187'];
  $query = new MongoDB\Driver\Query($filter);
  $cursor = $GoNGetzDatabase->executeQuery('GoNGetz.Consumer',$query);
  foreach ($cursor as $document)
  {
    $_SESSION["consumer_id"] = strval($document->_id);
    $consumer_id = strval($document->_id);
    $ConsumerFName = $document->ConsumerFName;
    $ConsumerLName = $document->ConsumerLName;
    $ConsumerIDType = $document->ConsumerIDType;
    $ConsumerIDNo = $document->ConsumerIDNo;
    $ConsumerEmail = $document->ConsumerEmail;
    $ConsumerPhone = $document->ConsumerPhone;
    $ConsumerAddress = $document->ConsumerAddress;
    $ConsumerStatus = $document->ConsumerStatus;
  }
}
$filter = ['ConsumerID'=>$consumer_id];
$query = new MongoDB\Driver\Query($filter);
$cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Staff',$query);
foreach ($cursor as $document)
{
  $staff_id = strval($document->_id);
  $ClassID = $document->ClassID;
  $StaffLevel = $document->StaffLevel;
}
?>
<div class="text-dark-50 text-center m-5">
  <h1>Staff Info</h1>
</div>
<div class="row">
  <div class="col-1"></div>
  <div class="col-10">
    <div class="card">
      <div class="card-body">
        <div class="row">
          <!-- begin::staff detail -->
          <div class="col-sm">
            <table class="table table-bordered">
              <tbody>
                <tr class="bg-light text-dark-50">
                  <td>Name</td>
                  <td><?= $ConsumerFName." ".$ConsumerLName; ?> </td>
                </tr>
                <tr>
                  <td>ID Type</td>
                  <td><?= $ConsumerIDType; ?></td>
                </tr>
                <tr>
                  <td>ID Number</td>
                  <td><?= $ConsumerIDNo; ?></td>
                </tr>
                <tr>
                  <td>Email</td>
                  <td><?= $ConsumerEmail; ?></td>
                </tr>
                <tr>
                  <td>Phone Number</td>
                  <td><?= $ConsumerPhone; ?></td>
                </tr>
                <tr>
                  <td>Address</td>
                  <td><?= $ConsumerAddress; ?></td>
                </tr>
                <tr>
                  <td>Status</td>
                  <td><?= $ConsumerStatus; ?></td>
                </tr>
              </tbody>
            </table>
            <!-- teacher -->
            <?php
            if($StaffLevel == '0' && $ClassID !== '')
            {
              $filter = ['Teacher_id'=>$staff_id];
              $query = new MongoDB\Driver\Query($filter);
              $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.ClassroomSubjectRel',$query);
              foreach ($cursor as $document)
              {
                $Class_id = $document->Class_id;
                $Subject_id = $document->Subject_id;
              
                $filter = ['_id'=>new \MongoDB\BSON\ObjectId($Class_id)];
                $query = new MongoDB\Driver\Query($filter);
                $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Classrooms',$query);
                foreach ($cursor as $document)
                {
                  $ClassName = $document->ClassName;
                }

                $filter = ['_id'=>new \MongoDB\BSON\ObjectId($Subject_id)];
                $query = new MongoDB\Driver\Query($filter);
                $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.SchoolsSubject',$query);
                foreach ($cursor as $document)
                {
                  $SubjectName = $document->SubjectName;
                }
                ?>
                <table class="table table-bordered">
                  <tr class="bg-light text-dark-50">
                    <td>Class</td>
                    <td>Subject</td>
                  </tr>
                  <tbody>
                    <tr>
                      <td><a href="index.php?page=classdetail&id=<?= $Class_id; ?>"><?= $ClassName; ?></a></td>
                      <td><a href="index.php?page=subjectdetail&id=<?= $Subject_id; ?>"><?= $SubjectName; ?></a></td>
                    </tr>
                  </tbody>
                </table>
                <?php
              }
            }
            ?>
            <!-- teacher -->
          </div>
          <!-- end::staff detail -->
          <!-- begin::Remark -->
          <div class="col-sm">
            <div class="card">
              <div class="card-header bg-light text-dark-50">
                <a>Remarks</a>
              </div>
              <div class="card-body">
                <div class="tab-content" id="v-pills-tabContent">
                  <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
                    <div class="box">
                      <form name="add_remark" action="model/staff_remark.php" method="POST">
                        <textarea class="staff" name="remark"></textarea>
                        <div class="mt-3 text-right">
                          <input type="hidden" value="<?= $consumer_id; ?>" name="consumer_id">
                          <button type="submit" class="btn btn-light btn-hover-success btn-sm" name="add_remark">Add remark</button>
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
                          $filter = ['Consumer_id'=>$consumer_id,'SubRemarks'=>'0','Status'=>'ACTIVE'];
                          $option = ['sort' => ['_id' => -1],'limit'=>10];
                          $query = new MongoDB\Driver\Query($filter, $option);
                          $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Staff_Remarks',$query);
                          foreach ($cursor as $document)
                          {
                            $remark_id1 = strval($document->_id);
                            $Details1 = $document->Details;
                            $Staff_id1 = $document->Staff_id;
                            $Date1 = strval($document->Date);
                            $Date1 = new MongoDB\BSON\UTCDateTime(strval($Date1));
                            $Date1 = $Date1->toDateTime()->setTimezone(new \DateTimeZone(date_default_timezone_get()));

                            $filter = ['_id' => new \MongoDB\BSON\ObjectId($Staff_id1)];
                            $query = new MongoDB\Driver\Query($filter);
                            $cursor = $GoNGetzDatabase->executeQuery('GoNGetz.Consumer', $query);
                            foreach ($cursor as $document)
                            {
                              $ConsumerFName = $document->ConsumerFName;
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
                                  $filter = ['Consumer_id'=>$consumer_id,'SubRemarks'=>$remark_id1];
                                  $option = ['sort' => ['_id' => -1],'limit'=>10];
                                  $query = new MongoDB\Driver\Query($filter, $option);
                                  $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Staff_Remarks',$query);
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
                                    <form name="add_remark_child" action="model/staff_remark.php" method="POST">
                                        <div class="m-3">
                                          <textarea class="staff" name="remark"></textarea>
                                        </div>
                                        <div class="m-3 text-right">
                                          <input type="hidden" value="<?= $consumer_id; ?>" name="consumer_id">
                                          <input type="hidden" value="<?= $remark_id1; ?>" name="remark_id">
                                          <button type="submit" class="btn btn-light btn-sm" name="add_remark_child">Add remark</button>
                                          <button type="button" class="btn btn-light btn-hover-success btn-sm" data-bs-toggle="modal" data-bs-target="#update_staff_remark" data-bs-whatever="<?= $remark_id1; ?>">Update</button>
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
                          $filter = ['Consumer_id'=>$consumer_id,'SubRemarks'=>'0','Status'=>'PENDING'];
                          $option = ['sort' => ['_id' => -1],'limit'=>10];
                          $query = new MongoDB\Driver\Query($filter, $option);
                          $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Staff_Remarks',$query);
                          foreach ($cursor as $document)
                          {
                            $remark_id1 = strval($document->_id);
                            $Details1 = $document->Details;
                            $Staff_id1 = $document->Staff_id;
                            $Date1 = strval($document->Date);
                            $Date1 = new MongoDB\BSON\UTCDateTime(strval($Date1));
                            $Date1 = $Date1->toDateTime()->setTimezone(new \DateTimeZone(date_default_timezone_get()));

                            $filter = ['_id' => new \MongoDB\BSON\ObjectId($Staff_id1)];
                            $query = new MongoDB\Driver\Query($filter);
                            $cursor = $GoNGetzDatabase->executeQuery('GoNGetz.Consumer', $query);
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
                                            <td class="col-2"><?= $ConsumerFName; ?></td>
                                            <td class="col"><a align="justify"><?= $Details1;?></a></td>
                                          </tr>
                                        </tbody>
                                      </table>
                                    </button>
                                  </h6>
                                  <div  id="flush-collapseOne" class="accordion-collapse collapse mt-3" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                                    <?php 
                                    $filter = ['Consumer_id'=>$consumer_id,'SubRemarks'=>$remark_id1];
                                    $option = ['sort' => ['_id' => -1],'limit'=>10];
                                    $query = new MongoDB\Driver\Query($filter, $option);
                                    $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Staff_Remarks',$query);
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
                                    <form name="add_remark_child" action="model/staff_remark.php" method="POST">
                                      <div class="m-3">
                                        <textarea class="staff" name="remark"></textarea>
                                      </div>
                                      <div class="m-3 text-right">
                                        <input type="hidden" value="<?= $consumer_id; ?>" name="consumer_id">
                                        <input type="hidden" value="<?= $remark_id1; ?>" name="remark_id">
                                        <button type="submit" class="btn btn-light btn-sm" name="add_remark_child">Add remark</button>
                                        <button type="button" class="btn btn-light btn-hover-success btn-sm" data-bs-toggle="modal" data-bs-target="#update_staff_remark" data-bs-whatever="<?= $remark_id1; ?>">update</button>
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
                          $filter = ['Consumer_id'=>$consumer_id,'SubRemarks'=>'0','Status'=>'COMPLETED'];
                          $option = ['sort' => ['_id' => -1],'limit'=>10];
                          $query = new MongoDB\Driver\Query($filter, $option);
                          $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Staff_Remarks',$query);
                          foreach ($cursor as $document)
                          {
                            $remark_id1 = strval($document->_id);
                            $Staff_id1 = $document->Staff_id;
                            $Details1 = $document->Details;
                            $Date1 = strval($document->Date);
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
                                    $filter = ['Consumer_id'=>$consumer_id,'SubRemarks'=>$remark_id1];
                                    $option = ['sort' => ['_id' => -1],'limit'=>10];
                                    $query = new MongoDB\Driver\Query($filter,$option);
                                    $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Staff_Remarks',$query);
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
                                      <form name="add_remark_child" action="model/staff_remark.php" method="POST">
                                        <div class="m-3">
                                          <textarea class="staff" name="remark"></textarea>
                                        </div>
                                        <div class="m-3 text-right">
                                          <input type="hidden" value="<?= $consumer_id; ?>" name="consumer_id">
                                          <input type="hidden" value="<?= $remark_id1; ?>" name="remark_id">
                                          <button type="submit" class="btn btn-light btn-sm" name="add_remark_child">Add remark</button>
                                          <button type="button" class="btn btn-light btn-hover-success btn-sm" data-bs-toggle="modal" data-bs-target="#update_staff_remark" data-bs-whatever="<?= $remark_id1; ?>">update</button>
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
  </div>
  <div class="col-1"></div>
</div>
<!-- begin::attendance -->
<div class="row">
  <div class="col-1"></div>
  <div class="col-10">
    <div class="card">
      <div class="card-body text-right">
        <a href="index.php?page=staffdetail&id=<?= $consumer_id; ?>&attendance=xls" class="btn btn-light btn-hover-success btn-sm mb-3 mx-3">EXPORT ATTENDANCE TO XLS</a>
        <table id="attendance" class="table table-bordered text-left shadow p-3 mb-5 rounded">
          <thead class="bg-white text-dark-50">
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
            $date_now = date("d-m-Y");
            $from_date = new MongoDB\BSON\UTCDateTime((new DateTime($date_now))->getTimestamp()*1000);
            $to_date = new MongoDB\BSON\UTCDateTime((new DateTime('now +1 month'))->getTimestamp()*1000);

            if (isset($_GET['id']) && !empty($_GET['id']))
            {
              $filter = ['_id'=>new \MongoDB\BSON\ObjectId($_GET['id'])];
              $query = new MongoDB\Driver\Query($filter);
              $cursor = $GoNGetzDatabase->executeQuery('GoNGetz.Consumer',$query);
              foreach ($cursor as $document)
              {
                $consumer_id = strval($document->_id);
                $ConsumerFName = $document->ConsumerFName;
                $ConsumerLName = $document->ConsumerLName;
                $ConsumerIDNo = $document->ConsumerIDNo;
              }
            }
            else
            {
              $filter = ['ConsumerGroup_id'=>'601b4cfd97728c027c01f187'];
              $query = new MongoDB\Driver\Query($filter);
              $cursor = $GoNGetzDatabase->executeQuery('GoNGetz.Consumer',$query);
              foreach ($cursor as $document)
              {
                $consumer_id = strval($document->_id);
                $ConsumerFName = $document->ConsumerFName;
                $ConsumerLName = $document->ConsumerLName;
                $ConsumerIDNo = $document->ConsumerIDNo;
              }
            }
            $filter = ['Consumer_id'=>$consumer_id];
            $query = new MongoDB\Driver\Query($filter);
            $cursor = $GoNGetzDatabase->executeQuery('GoNGetz.Cards',$query);
            foreach ($cursor as $document)
            {
              $Cards_id = strval($document->Cards_id);
            }
            ?>
            <tr>
              <td class="default"><?= $ConsumerIDNo; ?></td>
              <td class="default"><?= $ConsumerFName." ".$ConsumerLName; ?></td>
              <td class="default"><?= $date_now."<br>"; ?></td>
              <td class="default"><?php
              $count = 0;
              $filter = ['CardID'=>$Cards_id ,'AttendanceDate' => ['$gte' => $from_date]];
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
              $filter = ['CardID'=>$Cards_id ,'AttendanceDate' => ['$gte' => $from_date]];
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
                    filename: "attendancestaff.xls"
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
<!-- end::attendance -->
<script type="text/javascript" src='https://cdn.tiny.cloud/1/qagffr3pkuv17a8on1afax661irst1hbr4e6tbv888sz91jc/tinymce/4/tinymce.min.js' referrerpolicy="origin"></script>
<script>
tinymce.init({
  selector: '.staff',
  menubar:false,
  statusbar: false,
  toolbar: false,
  height:100,
});
</script>
<?php include ('view/pages/modal-update_remark.php'); ?>