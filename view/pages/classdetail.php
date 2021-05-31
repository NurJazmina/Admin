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
					<h5 class="text-dark font-weight-bold my-1 mr-5">Classroom</h5>
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
                        <button type="button" class="btn btn-light-success font-weight-bolder dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
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
                                <li class="dropdown-item">Choose an option:</li>
                                <?php 
                                $filter = ['SchoolID'=>$_SESSION["loggeduser_schoolID"]];
                                $options = ['sort' => ['ClassCategory' => 1]];
                                $query = new MongoDB\Driver\Query($filter,$options);
                                $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Classrooms',$query);
                                foreach ($cursor as $document)
                                {
                                  $classid = strval($document->_id);
                                  $ClassName = strval($document->ClassName);
                                  $ClassCategory = strval($document->ClassCategory);
                                  ?>
                                  <li style="padding:5px;">
                                      <a href="index.php?page=classdetail&id=<?php echo $classid; ?>" class="navi-link">
                                          <span class="navi-icon">
                                              <i class="la la-user"></i>
                                          </span>
                                          <span class="navi-text"><?php echo $ClassCategory." ".$ClassName; ?></span>
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
  <style>
  .highlight td.default {
  background:#FFE2E5;
  color:#F64E60 ;
  }
  </style>
  <div><br><br><br><h1 style="color:#696969; text-align:center">Class Info</h1></div><br>
  <div class="row" >
    <div class="col-md-1 section-1-box wow fadeInUp"></div>
    <div class="col-md-10 section-1-box wow fadeInUp">
    <div class="card">
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
                                    <br>
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
                                                  <br>
                                                  <button type="submit" class="btn btn-primary" name="AddClassRemarkChildFormSubmit">Add remark</button>
                                                  <button style="float: right;"type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#UpdateClassremark" data-bs-whatever="<?php echo $remarkid1; ?>" style="display: flex;  ">Update</button>
                                                </div>
                                              </div>
                                              <br>
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
                                                  <button style="float: right;"type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#UpdateClassremark" data-bs-whatever="<?php echo $remarkid1; ?>" style="display: flex;  ">Update</button>
                                                </div>
                                              </div>
                                              <br>
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
                                                  <button style="float: right;"type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#UpdateClassremark" data-bs-whatever="<?php echo $remarkid1; ?>" style="display: flex;  "> Update</button>
                                                </div>
                                              </div>
                                              <br>
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
                          <td class="default"><?php echo $ConsumerIDNo; ?></td>
                          <td class="default"><?php echo $ConsumerFName." ".$ConsumerLName; ?></td>
                      <?php
                      $Cards_id ='';
                      $filter1 = ['Consumer_id'=>$Consumer_id];
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
                        echo date_format($AttendanceDate,"H:i:s")."<br>";
                      } 
                      else
                      {
                      }
                      }
                      ?></td>
                      <?php
                    }
                    ?>
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
  <?php include ('view/pages/modal-updateclassremark.php'); ?>
  <?php
}
else
{
  ?>
    <div><br><br><br><h1 style="color:#696969; text-align:center">Class Info</h1></div><br>
  <?php
}
?>
