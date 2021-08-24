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
					<h5 class="text-dark font-weight-bold my-1 mr-5">Subject</h5>
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
            <button type="button" class="btn btn-light-primary btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
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
              <ul class="navi flex-column navi-hover py-2">
                <li class="dropdown-item">Choose an option:</li>
                <?php 
                $filter = ['School_id'=>$_SESSION["loggeduser_schoolID"]];
                $query = new MongoDB\Driver\Query($filter);
                $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.SchoolsSubject',$query);
                foreach ($cursor as $document)
                {
                  $subject_id = strval($document->_id);
                  $subject_name = $document->SubjectName;
                  ?>
                  <li class="dropdown-item">
                    <a href="index.php?page=subjectdetail&id=<?= $subject_id; ?>" class="navi-link">
                      <?= $subject_name; ?>
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
  $subject_id = strval($document->_id);
  $subject_name = $document->SubjectName;
}
?>
<div class="text-center m-5"><h1>Subject Info</h1></div>
<div class="row">
  <div class="col-1"></div>
  <div class="col-10">
    <div class="card">
      <div class="card-body">
        <div class="row">
          <!-- begin::Subject/class detail -->
          <div class="col-sm">
            <table class="table table-bordered text-primary">
              <tbody>
                <tr class="bg-light-primary">
                  <th>Subject</th>
                  <td><?= $subject_name; ?> </td>
                </tr>
                <tr>
                  <th>Class List</th>
                  <td>
                  <?php
                    $totalclass = 0;
                    $filter = ['Subject_id'=>$subject_id];
                    $query = new MongoDB\Driver\Query($filter);
                    $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.ClassroomSubjectRel',$query);
                    foreach ($cursor as $document)
                    {
                      $Class_id = $document->Class_id;
                      $Teacher_id = $document->Teacher_id;

                      $filter = ['_id'=>new \MongoDB\BSON\ObjectId($Class_id)];
                      $query = new MongoDB\Driver\Query($filter);
                      $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Classrooms',$query);
                      foreach ($cursor as $document)
                      {
                        $totalclass = $totalclass + 1;
                        $ClassName = $document->ClassName;
                        ?>
                        <a href="index.php?page=classdetail&id=<?= $Class_id; ?>">
                        <?= $ClassName."<br>";
                      }
                    }
                  ?>
                </td>
                </tr>
                <tr>
                  <th>Number of Class</th>
                  <td><?= $totalclass; ?></td>
                </tr>
              </tbody>
            </table>
            <table class="table table-bordered text-warning">
              <tbody>
                <tr class="bg-light-warning">
                  <th>Teacher</th>
                  <th>Class</th>
                  <th>Number of Student</th>
                </tr>
                <?php
                $totalstudent = 0;
                $filter = ['Subject_id'=>$_GET['id']];
                $query = new MongoDB\Driver\Query($filter);
                $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.ClassroomSubjectRel',$query);
                foreach ($cursor as $document)
                {
                  $Class_id = $document->Class_id;
                  $Teacher_id = $document->Teacher_id;

                  $filter = ['_id'=>new \MongoDB\BSON\ObjectId($Teacher_id)];
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
                      ?>
                      <tr>
                        <td>
                          <a class="text-warning" href="index.php?page=staffdetail&id=<?= $ConsumerID; ?>">
                          <?= $ConsumerFName."<br>";?>
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
                    $ClassName = $document->ClassName;
                    ?>
                      <td>
                        <a class="text-warning" href="index.php?page=classdetail&id=<?= $Class_id; ?>">
                        <?= $ClassName."<br>";?>
                      </td>
                      <td>
                        <?= $totalstudent;?>
                      </td>
                    </tr>
                    <?php
                  }
                }
                ?>
              </tbody>
            </table>
          </div>
          <!-- end::Subject/class detail -->
          <!-- begin::Remark -->
          <div class="col-sm">
            <div class="card">
              <div class="card-header bg-light-primary text-primary">
                <strong>Remarks</strong>
              </div>
              <div class="card-body">
                <div class="tab-content" id="v-pills-tabContent">
                  <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
                    <div class="box">
                      <form name="AddSubjectRemark" action="model/addsubjectremark.php" method="POST">
                        <textarea class="subject" name="remark"></textarea>
                        <div class="m-3 text-right">
                          <input type="hidden" value="<?= $_GET['id']; ?>" name="id">
                          <button type="submit" class="btn btn-primary btn-sm" name="AddSubjectRemark">Add remark</button>
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
                          $filter = ['Subject_id'=>$_GET['id'],'SubRemarks'=>'0','Status'=>'ACTIVE'];
                          $option = ['sort' => ['_id' => -1],'limit'=>10];
                          $query = new MongoDB\Driver\Query($filter, $option);
                          $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.SubjectRemarks',$query);

                          foreach ($cursor as $document)
                          {
                            $_id1 = strval($document->_id);
                            $remark1 = $document->Details;
                            $staff_id1 = $document->Staff_id;
                            $date1 = $document->Date;

                            $utcdatetime1 = new MongoDB\BSON\UTCDateTime(strval($date1));
                            $datetime1 = $utcdatetime1->toDateTime()->setTimezone(new \DateTimeZone(date_default_timezone_get()));
                            ?>
                              <div class="accordion accordion-flush" id="accordionFlushExample">
                              <div class="accordion-item" >
                              <h6 class="accordion-header" id="flush-heading<?= $_id1; ?>">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse<?= $_id1; ?>" aria-expanded="false" aria-controls="flush-collapse<?= $_id1; ?>">
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
                              <div  id="flush-collapse<?= $_id1; ?>" class="accordion-collapse collapse" aria-labelledby="flush-heading<?= $_id1; ?>" data-bs-parent="#accordionFlushExample">
                              <?php 
                              $filter = ['Subject_id'=>$_GET['id'],'SubRemarks'=>$_id1];
                              $option = ['sort' => ['_id' => -1],'limit'=>10];
                              $query = new MongoDB\Driver\Query($filter, $option);
                              $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.SubjectRemarks',$query);
                              foreach ($cursor as $document)
                              {
                                $_id2 = strval($document->_id);
                                $remark2 = $document->Details;
                                $staff_id2 = $document->Staff_id;
                                $date2 = $document->Date;

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
                                <form name="AddSubjectRemarkChild" action="model/addsubjectremarkchild.php" method="POST">
                                  <div class="m-3">
                                    <textarea class="subject" name="remark"></textarea>
                                  </div>
                                  <div class="m-3 text-right">
                                    <input type="hidden" value="<?php echo $_GET['id']; ?>" name="subject_id">
                                    <input type="hidden" value="<?= $_id1; ?>" name="remark_id">
                                    <button type="submit" class="btn btn-light btn-sm" name="AddSubjectRemarkChild">Add remark</button>
                                    <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#Updatesubjectremark" data-bs-whatever="<?= $_id1; ?>">Update</button>
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
                          $filter = ['Subject_id'=>$_GET['id'],'SubRemarks'=>'0','Status'=>'PENDING'];
                          $option = ['sort' => ['_id' => -1],'limit'=>10];
                          $query = new MongoDB\Driver\Query($filter, $option);
                          $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.SubjectRemarks',$query);

                          foreach ($cursor as $document)
                          {
                            $_SESSION["departmentparent"] = strval($document->_id);
                            $_id1 = strval($document->_id);
                            $remark1 = $document->Details;
                            $date1 = $document->Date;

                            $utcdatetime1 = new MongoDB\BSON\UTCDateTime(strval($date1));
                            $datetime1 = $utcdatetime1->toDateTime()->setTimezone(new \DateTimeZone(date_default_timezone_get()));
                            $staff_id1 = $document->Staff_id;
                            ?>
                            <div class="accordion accordion-flush" id="accordionFlushExample">
                              <div class="accordion-item" >
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
                                <div  id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                                  <?php 
                                  $filter = ['Subject_id'=>$_GET['id'],'SubRemarks'=>$_id1];
                                  $option = ['sort' => ['_id' => -1],'limit'=>10];
                                  $query = new MongoDB\Driver\Query($filter, $option);
                                  $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.SubjectRemarks',$query);
                                  foreach ($cursor as $document)
                                  {
                                    $_id2 = strval($document->_id);
                                    $remark2 = $document->Details;
                                    $date2 = $document->Date;

                                    $utcdatetime2 = new MongoDB\BSON\UTCDateTime(strval($date2));
                                    $datetime2 = $utcdatetime2->toDateTime()->setTimezone(new \DateTimeZone(date_default_timezone_get()));
                                    $staff_id2 = $document->Staff_id;
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
                                  <form name="AddSubjectRemarkChild" action="model/addsubjectremarkchild.php" method="POST">
                                    <div class="m-3">
                                      <textarea class="subject" name="remark"></textarea>
                                    </div>
                                    <div class="m-3 text-right">
                                      <input type="hidden" value="<?php echo $_GET['id']; ?>" name="subject_id">
                                      <input type="hidden" value="<?= $_id1; ?>" name="remark_id">
                                      <button type="submit" class="btn btn-light btn-sm" name="AddSubjectRemarkChild">Add remark</button>
                                      <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#Updatesubjectremark" data-bs-whatever="<?= $_id1; ?>">Update</button>
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
                          $filter = ['Subject_id'=>$_GET['id'],'SubRemarks'=>'0','Status'=>'COMPLETED'];
                          $option = ['sort' => ['_id' => -1],'limit'=>10];
                          $query = new MongoDB\Driver\Query($filter, $option);
                          $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.SubjectRemarks',$query);

                          foreach ($cursor as $document)
                          {
                            $_SESSION["departmentparent"] = strval($document->_id);
                            $_id1 = strval($document->_id);
                            $remark1 = $document->Details;
                            $date1 = $document->Date;
                            $utcdatetime1 = new MongoDB\BSON\UTCDateTime(strval($date1));
                            $datetime1 = $utcdatetime1->toDateTime()->setTimezone(new \DateTimeZone(date_default_timezone_get()));
                            $staff_id1 = $document->Staff_id;
                            ?>
                            <div class="accordion accordion-flush" id="accordionFlushExample">
                              <div class="accordion-item" >
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
                                <div  id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                                  <?php 
                                  $filter = ['Subject_id'=>$_GET['id'],'SubRemarks'=>$_id1];
                                  $option = ['sort' => ['_id' => -1],'limit'=>10];
                                  $query = new MongoDB\Driver\Query($filter, $option);
                                  $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.SubjectRemarks',$query);
                                  foreach ($cursor as $document)
                                  {
                                    $_id2 = strval($document->_id);
                                    $remark2 = $document->Details;
                                    $date2 = $document->Date;
                                    $utcdatetime2 = new MongoDB\BSON\UTCDateTime(strval($date2));
                                    $datetime2 = $utcdatetime2->toDateTime()->setTimezone(new \DateTimeZone(date_default_timezone_get()));
                                    $staff_id2 = $document->Staff_id;
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
                                  <form name="AddSubjectRemarkChild" action="model/addsubjectremarkchild.php" method="POST">
                                    <div class="m-3">
                                      <textarea class="subject" name="remark"></textarea>
                                    </div>
                                    <div class="m-3 text-right">
                                      <input type="hidden" value="<?php echo $_GET['id']; ?>" name="subject_id">
                                      <input type="hidden" value="<?= $_id1; ?>" name="remark_id">
                                      <button type="submit" class="btn btn-light btn-sm" name="AddSubjectRemarkChild">Add remark</button>
                                      <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#Updatesubjectremark" data-bs-whatever="<?= $_id1; ?>">Update</button>
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
<?php 
}
else
{
  $filter = [null];
  $query = new MongoDB\Driver\Query($filter);
  $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.SchoolsSubject',$query);

  foreach ($cursor as $document)
  {
    $_SESSION["subjectremarkid"] = strval($document->_id);
    $subject_id = strval($document->_id);
    $subject_name = $document->SubjectName;
  }
  ?>
  <div class="text-center m-5"><h1>Subject Info</h1></div>
  <div class="row">
    <div class="col-1"></div>
    <div class="col-10">
      <div class="card">
        <div class="card-body">
          <div class="row">
            <!-- begin::Subject/class detail -->
            <div class="col-sm">
              <table class="table table-bordered text-primary">
                <tbody>
                  <tr class="bg-light-primary">
                    <th>Subject</th>
                    <td><?= $subject_name; ?> </td>
                  </tr>
                  <tr>
                    <th>Class List</th>
                    <td>
                    <?php
                      $totalclass = 0;
                      $filter = ['Subject_id'=>$subject_id];
                      $query = new MongoDB\Driver\Query($filter);
                      $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.ClassroomSubjectRel',$query);
                      foreach ($cursor as $document)
                      {
                        $Class_id = $document->Class_id;
                        $Teacher_id = $document->Teacher_id;

                        $filter = ['_id'=>new \MongoDB\BSON\ObjectId($Class_id)];
                        $query = new MongoDB\Driver\Query($filter);
                        $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Classrooms',$query);
                        foreach ($cursor as $document)
                        {
                          $totalclass = $totalclass + 1;
                          $ClassName = $document->ClassName;
                          ?>
                          <a href="index.php?page=classdetail&id=<?= $Class_id; ?>">
                          <?= $ClassName."<br>";
                        }
                      }
                    ?>
                  </td>
                  </tr>
                  <tr>
                    <th>Number of Class</th>
                    <td><?= $totalclass; ?></td>
                  </tr>
                </tbody>
              </table>
              <table class="table table-bordered text-warning">
                <tbody>
                  <tr class="bg-light-warning">
                    <th>Teacher</th>
                    <th>Class</th>
                    <th>Number of Student</th>
                  </tr>
                  <?php
                  $totalstudent = 0;
                  $filter = ['Subject_id'=>$subject_id];
                  $query = new MongoDB\Driver\Query($filter);
                  $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.ClassroomSubjectRel',$query);
                  foreach ($cursor as $document)
                  {
                    $Class_id = $document->Class_id;
                    $Teacher_id = $document->Teacher_id;

                    $filter = ['_id'=>new \MongoDB\BSON\ObjectId($Teacher_id)];
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
                        ?>
                        <tr>
                          <td>
                            <a class="text-warning" href="index.php?page=staffdetail&id=<?= $ConsumerID; ?>">
                            <?= $ConsumerFName."<br>";?>
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
                      $ClassName = $document->ClassName;
                      ?>
                        <td>
                          <a class="text-warning" href="index.php?page=classdetail&id=<?= $Class_id; ?>">
                          <?= $ClassName."<br>";?>
                        </td>
                        <td>
                          <?= $totalstudent;?>
                        </td>
                      </tr>
                      <?php
                    }
                  }
                  ?>
                </tbody>
              </table>
            </div>
            <!-- end::Subject/class detail -->
            <!-- begin::Remark -->
            <div class="col-sm">
              <div class="card">
                <div class="card-header bg-light-primary text-primary">
                  <strong>Remarks</strong>
                </div>
                <div class="card-body">
                  <div class="tab-content" id="v-pills-tabContent">
                    <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
                      <div class="box">
                        <form name="AddSubjectRemark" action="model/addsubjectremark.php" method="POST">
                          <textarea class="subject" name="remark"></textarea>
                          <div class="m-3 text-right">
                            <input type="hidden" value="<?= $subject_id; ?>" name="id">
                            <button type="submit" class="btn btn-primary btn-sm" name="AddSubjectRemark">Add remark</button>
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
                            $filter = ['Subject_id'=>$subject_id,'SubRemarks'=>'0','Status'=>'ACTIVE'];
                            $option = ['sort' => ['_id' => -1],'limit'=>10];
                            $query = new MongoDB\Driver\Query($filter, $option);
                            $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.SubjectRemarks',$query);

                            foreach ($cursor as $document)
                            {
                              $_id1 = strval($document->_id);
                              $remark1 = $document->Details;
                              $staff_id1 = $document->Staff_id;
                              $date1 = $document->Date;

                              $utcdatetime1 = new MongoDB\BSON\UTCDateTime(strval($date1));
                              $datetime1 = $utcdatetime1->toDateTime()->setTimezone(new \DateTimeZone(date_default_timezone_get()));
                              ?>
                                <div class="accordion accordion-flush" id="accordionFlushExample">
                                <div class="accordion-item" >
                                <h6 class="accordion-header" id="flush-heading<?= $_id1; ?>">
                                  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse<?= $_id1; ?>" aria-expanded="false" aria-controls="flush-collapse<?= $_id1; ?>">
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
                                <div  id="flush-collapse<?= $_id1; ?>" class="accordion-collapse collapse" aria-labelledby="flush-heading<?= $_id1; ?>" data-bs-parent="#accordionFlushExample">
                                <?php 
                                $filter = ['Subject_id'=>$subject_id,'SubRemarks'=>$_id1];
                                $option = ['sort' => ['_id' => -1],'limit'=>10];
                                $query = new MongoDB\Driver\Query($filter, $option);
                                $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.SubjectRemarks',$query);
                                foreach ($cursor as $document)
                                {
                                  $_id2 = strval($document->_id);
                                  $remark2 = $document->Details;
                                  $staff_id2 = $document->Staff_id;
                                  $date2 = $document->Date;

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
                                  <form name="AddSubjectRemarkChild" action="model/addsubjectremarkchild.php" method="POST">
                                    <div class="m-3">
                                      <textarea class="subject" name="remark"></textarea>
                                    </div>
                                    <div class="m-3 text-right">
                                      <input type="hidden" value="<?= $subject_id; ?>" name="subject_id">
                                      <input type="hidden" value="<?= $_id1; ?>" name="remark_id">
                                      <button type="submit" class="btn btn-light btn-sm" name="AddSubjectRemarkChild">Add remark</button>
                                      <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#Updatesubjectremark" data-bs-whatever="<?= $_id1; ?>">Update</button>
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
                            $filter = ['Subject_id'=>$subject_id,'SubRemarks'=>'0','Status'=>'PENDING'];
                            $option = ['sort' => ['_id' => -1],'limit'=>10];
                            $query = new MongoDB\Driver\Query($filter, $option);
                            $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.SubjectRemarks',$query);

                            foreach ($cursor as $document)
                            {
                              $_SESSION["departmentparent"] = strval($document->_id);
                              $_id1 = strval($document->_id);
                              $remark1 = $document->Details;
                              $date1 = $document->Date;

                              $utcdatetime1 = new MongoDB\BSON\UTCDateTime(strval($date1));
                              $datetime1 = $utcdatetime1->toDateTime()->setTimezone(new \DateTimeZone(date_default_timezone_get()));
                              $staff_id1 = $document->Staff_id;
                              ?>
                              <div class="accordion accordion-flush" id="accordionFlushExample">
                                <div class="accordion-item" >
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
                                  <div  id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                                    <?php 
                                    $filter = ['Subject_id'=>$subject_id,'SubRemarks'=>$_id1];
                                    $option = ['sort' => ['_id' => -1],'limit'=>10];
                                    $query = new MongoDB\Driver\Query($filter, $option);
                                    $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.SubjectRemarks',$query);
                                    foreach ($cursor as $document)
                                    {
                                      $_id2 = strval($document->_id);
                                      $remark2 = $document->Details;
                                      $date2 = $document->Date;

                                      $utcdatetime2 = new MongoDB\BSON\UTCDateTime(strval($date2));
                                      $datetime2 = $utcdatetime2->toDateTime()->setTimezone(new \DateTimeZone(date_default_timezone_get()));
                                      $staff_id2 = $document->Staff_id;
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
                                    <form name="AddSubjectRemarkChild" action="model/addsubjectremarkchild.php" method="POST">
                                      <div class="m-3">
                                        <textarea class="subject" name="remark"></textarea>
                                      </div>
                                      <div class="m-3 text-right">
                                        <input type="hidden" value="<?= $subject_id; ?>" name="subject_id">
                                        <input type="hidden" value="<?= $_id1; ?>" name="remark_id">
                                        <button type="submit" class="btn btn-light btn-sm" name="AddSubjectRemarkChild">Add remark</button>
                                        <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#Updatesubjectremark" data-bs-whatever="<?= $_id1; ?>">Update</button>
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
                            $filter = ['Subject_id'=>$subject_id,'SubRemarks'=>'0','Status'=>'COMPLETED'];
                            $option = ['sort' => ['_id' => -1],'limit'=>10];
                            $query = new MongoDB\Driver\Query($filter, $option);
                            $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.SubjectRemarks',$query);

                            foreach ($cursor as $document)
                            {
                              $_SESSION["departmentparent"] = strval($document->_id);
                              $_id1 = strval($document->_id);
                              $remark1 = $document->Details;
                              $date1 = $document->Date;
                              $utcdatetime1 = new MongoDB\BSON\UTCDateTime(strval($date1));
                              $datetime1 = $utcdatetime1->toDateTime()->setTimezone(new \DateTimeZone(date_default_timezone_get()));
                              $staff_id1 = $document->Staff_id;
                              ?>
                              <div class="accordion accordion-flush" id="accordionFlushExample">
                                <div class="accordion-item" >
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
                                  <div  id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                                    <?php 
                                    $filter = ['Subject_id'=>$subject_id,'SubRemarks'=>$_id1];
                                    $option = ['sort' => ['_id' => -1],'limit'=>10];
                                    $query = new MongoDB\Driver\Query($filter, $option);
                                    $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.SubjectRemarks',$query);
                                    foreach ($cursor as $document)
                                    {
                                      $_id2 = strval($document->_id);
                                      $remark2 = $document->Details;
                                      $date2 = $document->Date;
                                      $utcdatetime2 = new MongoDB\BSON\UTCDateTime(strval($date2));
                                      $datetime2 = $utcdatetime2->toDateTime()->setTimezone(new \DateTimeZone(date_default_timezone_get()));
                                      $staff_id2 = $document->Staff_id;
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
                                    <form name="AddSubjectRemarkChild" action="model/addsubjectremarkchild.php" method="POST">
                                      <div class="m-3">
                                        <textarea class="subject" name="remark"></textarea>
                                      </div>
                                      <div class="m-3 text-right">
                                        <input type="hidden" value="<= $subject_id; ?>" name="subject_id">
                                        <input type="hidden" value="<?= $_id1; ?>" name="remark_id">
                                        <button type="submit" class="btn btn-light btn-sm" name="AddSubjectRemarkChild">Add remark</button>
                                        <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#Updatesubjectremark" data-bs-whatever="<?= $_id1; ?>">Update</button>
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
<?php include ('view/pages/modal-updateremark.php'); ?>