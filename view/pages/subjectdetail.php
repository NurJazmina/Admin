<?php
$_SESSION["title"] = "Subject";
?>
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
					<h5 class="text-dark font-weight-bold my-1 mr-5"><?php echo $_SESSION["title"]; ?></h5>
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
                                  $filter = ['School_id'=>$_SESSION["loggeduser_schoolID"]];
                                  $query = new MongoDB\Driver\Query($filter);
                                  $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.SchoolsSubject',$query);
                                  foreach ($cursor as $document)
                                  {
                                      $subjectid = strval($document->_id);
                                      $SubjectName = strval($document->SubjectName);
                                      ?>
                                      <li style="padding:5px;">
                                          <a href="index.php?page=subjectdetail&id=<?php echo $subjectid; ?>" class="navi-link">
                                              <span class="navi-icon">
                                                  <i class="la la-user"></i>
                                              </span>
                                              <span class="navi-text"><?php echo $SubjectName; ?></span>
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
$cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.SchoolsSubject',$query);

foreach ($cursor as $document)
{
  $_SESSION["subjectremarkid"] = strval($document->_id);
  $subjectid = strval($document->_id);
  $SubjectName = ($document->SubjectName);
}
?>
<style>
.highlight td.default {
background:red;
color:#ffffff;
}
</style>
<div><br><h1 style="color:#696969; text-align:center">Subject Info</h1></div><br>
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
                  <th scope="row">Subject</th>
                  <td><?php echo $SubjectName; ?> </td>
                </tr>
                <tr>
                  <th scope="row">Class List</th>
                  <td>
                  <?php
                    $totalclass = 0;
                    $filter = ['Subject_id'=>$subjectid];
                    $query = new MongoDB\Driver\Query($filter);
                    $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.ClassroomSubjectRel',$query);
                    foreach ($cursor as $document)
                    {
                        $Class_id = strval($document->Class_id);
                        $Teacher_id = strval($document->Teacher_id);

                        $filter = ['_id'=>new \MongoDB\BSON\ObjectId($Class_id)];
                        $query = new MongoDB\Driver\Query($filter);
                        $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Classrooms',$query);
                        foreach ($cursor as $document)
                        {
                        $totalclass = $totalclass + 1;
                        $ClassName = strval($document->ClassName);
                        ?>
                        <a href="index.php?page=classdetail&id=<?php echo $Class_id; ?>" style="color:#076d79; text-decoration: none;">
                        <?php echo $ClassName."<br>";
                        }
                    }
                  ?>
                </td>
                </tr>
                <tr>
                  <th scope="row">Number of Class</th>
                  <td><?php echo $totalclass; ?></td>
                </tr>
              </tbody>
              </table>
            </div>

            <div class="table-responsive">
              <table class="table table-bordered">
              <thead class="table-light">
                <tr>
                  <th scope="col">Teacher</th>
                  <th scope="col">Class</th>
                  <th scope="col">Number of Student</th>
                </tr>
              </thead>
              <tbody>
                
                  <?php
                  $totalstudent = 0;
                  $filter = ['Subject_id'=>$_GET['id']];
                  $query = new MongoDB\Driver\Query($filter);
                  $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.ClassroomSubjectRel',$query);
                  foreach ($cursor as $document)
                  {
                      $Class_id = strval($document->Class_id);
                      $Teacher_id = strval($document->Teacher_id);

                      $filter = ['_id'=>new \MongoDB\BSON\ObjectId($Teacher_id)];
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
                          $ConsumerFName = strval($document->ConsumerFName);
                          ?>
                          <tr>
                          <td>
                            <a href="index.php?page=staffdetail&id=<?php echo $ConsumerID; ?>" style="color:#076d79; text-decoration: none;">
                            <?php echo $ConsumerFName."<br>";?>
                          </td>
                          <?php
                        }
                      }

                      $filter = ['_id'=>new \MongoDB\BSON\ObjectId($Class_id)];
                      $query = new MongoDB\Driver\Query($filter);
                      $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Classrooms',$query);
                      foreach ($cursor as $document)
                      {
                        $totalstudent = $totalstudent + 1;
                        $ClassName = strval($document->ClassName);
                        ?>
                        <td>
                          <a href="index.php?page=classdetail&id=<?php echo $Class_id; ?>" style="color:#076d79; text-decoration: none;">
                          <?php echo $ClassName."<br>";?>
                        </td>
                        <td>
                          <?php echo $totalstudent;?>
                        </td>
                        </tr>
                        <?php
                      }
                  }
                  ?>
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
                              <form name="AddSubjectRemarkFormSubmit" action="model/addsubjectremark.php" method="POST">
                                <div class="row">
                                  <div class="col">
                                    <textarea class="subject" name="txtsubjectRemark" rows="3"></textarea><br>        
                                    <div class="row">
                                      <div class="col text-right">
                                        <input type="hidden" value="<?php echo $_GET['id']; ?>" name="txtsubjectid">
                                        <button type="submit" class="btn btn-success" name="AddSubjectRemarkFormSubmit">Add remark</button>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </form>
                            </div>
                            <div class="box"><br>
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
                                $filter = ['Subject_id'=>$_GET['id'],'SubRemarks'=>'0','SubjectRemarksStatus'=>'ACTIVE'];
                                $option = ['sort' => ['_id' => -1],'limit'=>10];
                                $query = new MongoDB\Driver\Query($filter, $option);
                                $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.SubjectRemarks',$query);

                                foreach ($cursor as $document)
                                {
                                $remarkid1 = strval($document->_id);
                                $remark1 = ($document->SubjectRemarksDetails);
                                $remarkdate1 = ($document->SubjectRemarksDate);
                                $utcdatetime1 = new MongoDB\BSON\UTCDateTime(strval($remarkdate1));
                                $datetime1 = $utcdatetime1->toDateTime()->setTimezone(new \DateTimeZone(date_default_timezone_get()));
                                $remarkstaffid1 = ($document->SubjectRemarksStaff_id);
                                ?>
                                  <div class="accordion accordion-flush" id="accordionFlushExample">
                                  <div class="accordion-item" >
                                  <h6 class="accordion-header" id="flush-heading<?php echo $remarkid1; ?>">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse<?php echo $remarkid1; ?>" aria-expanded="false" aria-controls="flush-collapse<?php echo $remarkid1; ?>">
                                    <tbody>
                                    <tr>
                                    <td><?php print_r($datetime1->format('r')); ?></td>
                                    <td>
                                      <?php
                                      $filter = ['_id' => new \MongoDB\BSON\ObjectId($remarkstaffid1)];
                                      $query = new MongoDB\Driver\Query($filter);
                                      $cursor = $GoNGetzDatabase->executeQuery('GoNGetz.Consumer', $query);
                                      foreach ($cursor as $document)
                                      {
                                      $ConsumerFName = ($document->ConsumerFName);
                                      echo $ConsumerFName;
                                      ?>
                                    </td>
                                    <td><?php echo $remark1;?></td>
                                    </tr>
                                    </tbody>
                                    </button>
                                  </h6>
                                  <div  id="flush-collapse<?php echo $remarkid1; ?>" class="accordion-collapse collapse" aria-labelledby="flush-heading<?php echo $remarkid1; ?>" data-bs-parent="#accordionFlushExample">
                                  <?php 
                                  $filter = ['Subject_id'=>$_GET['id'],'SubRemarks'=>$remarkid1,'SubjectRemarksStatus'=>'ACTIVE'];
                                  $option = ['sort' => ['_id' => -1],'limit'=>10];
                                  $query = new MongoDB\Driver\Query($filter, $option);
                                  $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.SubjectRemarks',$query);
                                  foreach ($cursor as $document)
                                  {
                                    $remarkid2 = strval($document->_id);
                                    $remark2 = ($document->SubjectRemarksDetails);
                                    $remarkdate2 = ($document->SubjectRemarksDate);
                                    $utcdatetime2 = new MongoDB\BSON\UTCDateTime(strval($remarkdate2));
                                    $datetime2 = $utcdatetime2->toDateTime()->setTimezone(new \DateTimeZone(date_default_timezone_get()));
                                    $remarkstaffid2 = ($document->SubjectRemarksStaff_id);
                                    ?>
                                    <div class="accordion-body">
                                    <tbody>
                                    <tr>
                                      <td><?php print_r($datetime2->format('r')); ?></td>
                                      <td><?php echo $remark2;?></td>
                                    </tr>
                                    </tbody>
                                    </div>
                                    <?php
                                    }
                                    ?>
                                    <form name="AddSubjectRemarkChildFormSubmit" action="model/addsubjectremarkchild.php" method="POST">
                                    <div class="row">
                                    <div class="col">
                                      <textarea class="subject" name="txtsubjectRemark" rows="3"></textarea>
                                      <br>
                                      <div class="row">
                                      <div class="col text-right">
                                        <input type="hidden" value="<?php echo $_GET['id']; ?>" name="txtsubjectid">
                                        <input type="hidden" value="<?php echo $remarkid1; ?>" name="txtremarkid">
                                        <button type="submit" class="btn btn-light-success font-weight-bold mr-2" name="AddSubjectRemarkChildFormSubmit">Add remark</button>
                                        <button style="float: right;"type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#Updatesubjectremark" data-bs-whatever="<?php echo $remarkid1; ?>" style="display: flex;  ">Update</button>
                                        <br><br>
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
                              <div class="tab-pane fade show pending" id="pending" role="tabpanel" aria-labelledby="pending-tab">
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
                                $filter = ['Subject_id'=>$_GET['id'],'SubRemarks'=>'0','SubjectRemarksStatus'=>'PENDING'];
                                $option = ['sort' => ['_id' => -1],'limit'=>10];
                                $query = new MongoDB\Driver\Query($filter, $option);
                                $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.SubjectRemarks',$query);

                                foreach ($cursor as $document)
                                {
                                $_SESSION["departmentparent"] = strval($document->_id);
                                $remarkid1 = strval($document->_id);
                                $remark1 = ($document->SubjectRemarksDetails);
                                $remarkdate1 = ($document->SubjectRemarksDate);
                                $utcdatetime1 = new MongoDB\BSON\UTCDateTime(strval($remarkdate1));
                                $datetime1 = $utcdatetime1->toDateTime()->setTimezone(new \DateTimeZone(date_default_timezone_get()));
                                $remarkstaffid1 = ($document->SubjectRemarksStaff_id);
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
                                          $filter = ['_id' => new \MongoDB\BSON\ObjectId($remarkstaffid1)];
                                          $query = new MongoDB\Driver\Query($filter);
                                          $cursor = $GoNGetzDatabase->executeQuery('GoNGetz.Consumer', $query);
                                          foreach ($cursor as $document)
                                          {
                                          $ConsumerFName = ($document->ConsumerFName);
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
                                        $filter = ['Subject_id'=>$_GET['id'],'SubRemarks'=>$remarkid1,'SubjectRemarksStatus'=>'PENDING'];
                                        $option = ['sort' => ['_id' => -1],'limit'=>10];
                                        $query = new MongoDB\Driver\Query($filter, $option);
                                        $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.SubjectRemarks',$query);
                                        foreach ($cursor as $document)
                                        {
                                          $remarkid2 = strval($document->_id);
                                          $remark2 = ($document->SubjectRemarksDetails);
                                          $remarkdate2 = ($document->SubjectRemarksDate);
                                          $utcdatetime2 = new MongoDB\BSON\UTCDateTime(strval($remarkdate2));
                                          $datetime2 = $utcdatetime2->toDateTime()->setTimezone(new \DateTimeZone(date_default_timezone_get()));
                                          $remarkstaffid2 = ($document->SubjectRemarksStaff_id);
                                          ?>
                                          <div class="accordion-body">
                                            <tbody>
                                            <tr>
                                              <td><?php print_r($datetime2->format('r')); ?></td>
                                              <td><?php echo $remark2;?></td>
                                            </tr>
                                            </tbody>
                                          </div>
                                          <?php
                                        }
                                          ?>
                                          <form name="AddSubjectRemarkChildFormSubmit" action="model/addsubjectremarkchild.php" method="POST">
                                            <div class="row">
                                              <div class="col">
                                                <textarea class="subject" name="txtsubjectRemark" rows="3"></textarea>
                                                <br>
                                                <div class="row">
                                                  <div class="col text-right">
                                                    <input type="hidden" value="<?php echo $_GET['id']; ?>" name="txtsubjectid">
                                                    <input type="hidden" value="<?php echo $remarkid1; ?>" name="txtremarkid">
                                                    <button type="submit" class="btn btn-light-success font-weight-bold mr-2" name="AddSubjectRemarkChildFormSubmit">Add remark</button>
                                                    <button style="float: right;"type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#Updatesubjectremark" data-bs-whatever="<?php echo $remarkid1; ?>">update</button>
                                                    <br><br>                                                 
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
                              <div class="tab-pane fade show completed" id="completed" role="tabpanel" aria-labelledby="completed-tab">
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
                                $filter = ['Subject_id'=>$_GET['id'],'SubRemarks'=>'0','SubjectRemarksStatus'=>'COMPLETED'];
                                $option = ['sort' => ['_id' => -1],'limit'=>10];
                                $query = new MongoDB\Driver\Query($filter, $option);
                                $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.SubjectRemarks',$query);

                                foreach ($cursor as $document)
                                {
                                $_SESSION["departmentparent"] = strval($document->_id);
                                $remarkid1 = strval($document->_id);
                                $remark1 = ($document->SubjectRemarksDetails);
                                $remarkdate1 = ($document->SubjectRemarksDate);
                                $utcdatetime1 = new MongoDB\BSON\UTCDateTime(strval($remarkdate1));
                                $datetime1 = $utcdatetime1->toDateTime()->setTimezone(new \DateTimeZone(date_default_timezone_get()));
                                $remarkstaffid1 = ($document->SubjectRemarksStaff_id);
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
                                          $filter = ['_id' => new \MongoDB\BSON\ObjectId($remarkstaffid1)];
                                          $query = new MongoDB\Driver\Query($filter);
                                          $cursor = $GoNGetzDatabase->executeQuery('GoNGetz.Consumer', $query);
                                          foreach ($cursor as $document)
                                          {
                                          $ConsumerFName = ($document->ConsumerFName);
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
                                        $filter = ['Subject_id'=>$_GET['id'],'SubRemarks'=>$remarkid1,'SubjectRemarksStatus'=>'COMPLETED'];
                                        $option = ['sort' => ['_id' => -1],'limit'=>10];
                                        $query = new MongoDB\Driver\Query($filter, $option);
                                        $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.SubjectRemarks',$query);
                                        foreach ($cursor as $document)
                                        {
                                          $remarkid2 = strval($document->_id);
                                          $remark2 = ($document->SubjectRemarksDetails);
                                          $remarkdate2 = ($document->SubjectRemarksDate);
                                          $utcdatetime2 = new MongoDB\BSON\UTCDateTime(strval($remarkdate2));
                                          $datetime2 = $utcdatetime2->toDateTime()->setTimezone(new \DateTimeZone(date_default_timezone_get()));
                                          $remarkstaffid2 = ($document->SubjectRemarksStaff_id);
                                          ?>
                                          <div class="accordion-body">
                                            <tbody>
                                            <tr>
                                              <td><?php print_r($datetime2->format('r')); ?></td>
                                              <td><?php echo $remark2;?></td>
                                            </tr>
                                            </tbody>
                                          </div>
                                          <?php
                                        }
                                          ?>
                                          <form name="AddSubjectRemarkChildFormSubmit" action="model/addsubjectremarkchild.php" method="POST">
                                            <div class="row">
                                              <div class="col">
                                                <textarea class="subject" name="txtsubjectRemark" rows="3"></textarea>
                                                <br>
                                                <div class="row">
                                                  <div class="col text-right">
                                                    <input type="hidden" value="<?php echo $_GET['id']; ?>" name="txtsubjectid">
                                                    <input type="hidden" value="<?php echo $remarkid1; ?>" name="txtremarkid">
                                                    <button type="submit" class="btn btn-light-success font-weight-bold mr-2" name="AddSubjectRemarkChildFormSubmit">Add remark</button>
                                                    <button style="float: right;"type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#Updatesubjectremark" data-bs-whatever="<?php echo $remarkid1; ?>">update</button>
                                                    <br><br>
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
    </div>
  </div>
<div class="col-md-1 section-1-box wow fadeInUp"></div>
</div>
</div>
<?php 
}
else
{
  ?>
  <div><br><br><br><h1 style="color:#696969; text-align:center">Subject Info</h1></div><br>
  <?php
}
?>
<script type="text/javascript" src='https://cdn.tiny.cloud/1/qagffr3pkuv17a8on1afax661irst1hbr4e6tbv888sz91jc/tinymce/4/tinymce.min.js' referrerpolicy="origin"></script>
<script>
tinymce.init({
  selector: '.subject',
  menubar:false,
  statusbar: false,
  toolbar: false,
  height:100,
});
</script>
<?php include ('view/pages/modal-updatesubjectremark.php'); ?>