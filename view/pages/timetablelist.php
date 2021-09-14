<?php 
include 'model/timetablelist.php'; 
$date = date("Y-m-d");
$today = new MongoDB\BSON\UTCDateTime((new DateTime($date))->getTimestamp()*1000);
?>
<!--begin::Subheader-->
<div class="subheader py-2 py-lg-6 subheader-solid" id="kt_subheader">
  <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
    <!--begin::Info-->
    <div class="d-flex align-items-center flex-wrap mr-1">
      <!--begin::Page Heading-->
      <div class="d-flex align-items-baseline flex-wrap mr-5">
        <!--begin::Page Title-->
        <h5 class="text-dark font-weight-bold my-1 mr-5">Timetable List</h5>
        <!--end::Page Title-->
      </div>
      <!--begin::Separator-->
      <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-5 bg-gray-200"></div>
      <!--end::Separator-->
      <!--begin::Detail-->
      <div class="d-flex align-items-center" id="kt_subheader_search">
      <span class="text-dark-50 font-weight-bold" id="kt_subheader_total"></span>
      </div>
      <!--end::Detail-->
      <!--end::Page Heading-->
    </div>
    <!--end::Info-->
    <!--begin::Toolbar-->
    <div class="d-flex align-items-center">
      <div class="text-right">
        <?php 
        if($_SESSION["loggeduser_ACCESS"] =='STAFF') 
        {
          ?>
          <button type="button" class="btn btn-success btn-hover-light btn-sm"><a class="text-white" href="index.php?page=classattendance" target="_blank">ATTENDANCE</a></button>
          <button type="button" class="btn btn-success btn-hover-light btn-sm" data-bs-toggle="modal" data-bs-target="#add_timetable">Add</button>
          <?php
        }
        ?>
      </div>
    </div>
    <!--end::Toolbar-->
  </div>
</div>
<!--end::Subheader-->

<div class="row">
  <!-- begin::timetable list -->
  <div class="col-12 col-lg-12">
    <div class="card">
      <!-- begin :: card header -->
      <div class="modal-header">
        <strong>List</strong>
      </div>
      <!-- end :: card header -->
      <!-- begin :: card body -->
      <div class="card-body">
        <?php
        if ($_SESSION["loggeduser_ACCESS"] == "STAFF")
        {
          ?>
          <div class="table-responsive">
            <table class="table table-sm text-center table-bordered">
              <thead class="bg-success text-white"> 
                <tr>
                  <th>Name</th>
                  <th>Class</th>
                  <th>Student</th>
                  <th>Subject</th>
                  <th colspan="2">Start</th>
                  <th colspan="2">End</th>
                  <th>Status</th>
                  <th>Update</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $filter = ['School_id'=>$_SESSION["loggeduser_school_id"]];
                $query = new MongoDB\Driver\Query($filter);
                $cursor =$GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.TimeTable',$query);
                foreach ($cursor as $document)
                {
                  $timetable_id = $document->_id;
                  $Classroom_id = $document->Classroom_id;
                  $Teachers_id = $document->Teachers_id;
                  $Subject_id = $document->Subject_id;
                  $Status = $document->Status;

                  $Start = strval($document->Start);
                  $End = strval($document->End);

                  $Start = new MongoDB\BSON\UTCDateTime($Start);
                  $Start = $Start->toDateTime()->setTimezone(new \DateTimeZone(date_default_timezone_get()));
                  $Start_day = date_format($Start,"d-m-Y");
                  $Start_hour = date_format($Start,"H:i");

                  $End = new MongoDB\BSON\UTCDateTime($End);
                  $End = $End->toDateTime()->setTimezone(new \DateTimeZone(date_default_timezone_get()));
                  $End_day = date_format($End,"d-m-Y");
                  $End_hour = date_format($End,"H:i");

                  $filter = ['_id'=>new \MongoDB\BSON\ObjectId($Classroom_id)];
                  $query = new MongoDB\Driver\Query($filter);
                  $cursor =$GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Classrooms',$query);
                  foreach ($cursor as $document)
                  {
                    $ClassCategory = $document->ClassCategory;
                    $ClassName = $document->ClassName;
                  }

                  $filter = ['_id'=>new \MongoDB\BSON\ObjectId($Teachers_id)];
                  $query = new MongoDB\Driver\Query($filter);
                  $cursor =$GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Staff',$query);
                  foreach ($cursor as $document)
                  {
                    $ConsumerID = $document->ConsumerID;

                    $filter = ['_id'=>new \MongoDB\BSON\ObjectId($ConsumerID)];
                    $query = new MongoDB\Driver\Query($filter);
                    $cursor =$GoNGetzDatabase->executeQuery('GoNGetz.Consumer',$query);
                    foreach ($cursor as $document)
                    {
                      $consumer_id = strval($document->_id);
                      $ConsumerFName = $document->ConsumerFName;
                      $ConsumerLName = $document->ConsumerLName;
                    }
                  }

                  $filter = ['_id'=>new \MongoDB\BSON\ObjectId($Subject_id)];
                  $query = new MongoDB\Driver\Query($filter);
                  $cursor =$GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.SchoolsSubject',$query);
                  foreach ($cursor as $document)
                  {
                    $subject_id = strval($document->_id);
                    $SubjectName = $document->SubjectName;
                    $Class_category = $document->Class_category;
                  }
                  
                  $totalstudent = 0;
                  $filter = ['Class_id'=>'5f9bffb4f88e385efc635816'];
                  $query = new MongoDB\Driver\Query($filter);
                  $cursor =$GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Students',$query);
                  foreach ($cursor as $document)
                  {
                    $totalstudent = $totalstudent + 1;
                  }
                  echo $totalstudent;
                  ?>
                  <tr>
                    <td class="text-left"><a href="index.php?page=staffdetail&id=<?= $consumer_id; ?>"><?= $ConsumerFName." ".$ConsumerLName;?></a></td>
                    <td class="text-left"><?= $ClassCategory." ".$ClassName;?></td>
                    <td><?= $totalstudent; ?></td>
                    <td><?= $SubjectName; ?></td>
                    <td><?= $Start_day; ?></td>
                    <td><?= $Start_hour; ?></td>
                    <td><?= $End_day; ?></td>
                    <td><?= $End_hour; ?></td>
                    <td><?= $Status; ?></td>
                    <td>
                      <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#edit_timetable">
                        <i class="flaticon2-edit icon-md text-hover-success"></i>
                      </button>
                      <button id="submit" type="button" class="btn" data-bs-toggle="modal" data-bs-target="#delete_timetable" data-bs-whatever="<?= $timetable_id; ?>">
                        <i class="flaticon2-trash icon-md text-hover-success"></i>
                      </button>
                    </td>
                  </tr>
                  <?php
                }
                ?>
              </tbody>
            </table>
          </div>
          <?php
        }
        elseif($_SESSION["loggeduser_ACCESS"] == "TEACHER")
        {
          ?>
          <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item">
              <a class="nav-link active" id="timetable_personal-tab" data-toggle="tab" href="#timetable_personal">
                <span class="nav-icon">
                  <i class="flaticon2-list-3"></i>
                </span>
                <span class="nav-text">Timetable Personal</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="timetable_class-tab" data-toggle="tab" href="#timetable_class" aria-controls="timetable_class">
                <span class="nav-icon">
                  <i class="flaticon2-list-2"></i>
                </span>
                <span class="nav-text">Timetable Class</span>
              </a>
            </li>
          </ul>
          <div class="tab-content mt-5" id="myTabContent">
            <div class="tab-pane fade show active" id="timetable_personal" role="tabpanel" aria-labelledby="timetable_personal-tab">
              <div class="table-responsive">
                <table class="table table-sm text-center table-bordered">
                  <thead class="bg-success text-white"> 
                    <tr>
                      <th class="text-left">Name</th>
                      <th class="text-left">Class</th>
                      <th>Student</th>
                      <th>Subject</th>
                      <th colspan="2">Start</th>
                      <th colspan="2">End</th>
                      <th>Status</th>
                      <th>Update</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $filter = ['Teachers_id'=>$_SESSION["loggeduser_teacherid"]];
                    $query = new MongoDB\Driver\Query($filter);
                    $cursor =$GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.TimeTable',$query);
                    foreach ($cursor as $document)
                    {
                      $timetable_id = $document->_id;
                      $Classroom_id = $document->Classroom_id;
                      $Teachers_id = $document->Teachers_id;
                      $Subject_id = $document->Subject_id;
                      $Status = $document->Status;

                      $Start = strval($document->Start);
                      $End = strval($document->End);

                      $Start = new MongoDB\BSON\UTCDateTime($Start);
                      $Start = $Start->toDateTime()->setTimezone(new \DateTimeZone(date_default_timezone_get()));
                      $Start_day = date_format($Start,"d-m-Y");
                      $Start_hour = date_format($Start,"H:i");

                      $End = new MongoDB\BSON\UTCDateTime($End);
                      $End = $End->toDateTime()->setTimezone(new \DateTimeZone(date_default_timezone_get()));
                      $End_day = date_format($End,"d-m-Y");
                      $End_hour = date_format($End,"H:i");

                      $filter = ['_id'=>new \MongoDB\BSON\ObjectId($Classroom_id)];
                      $query = new MongoDB\Driver\Query($filter);
                      $cursor =$GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Classrooms',$query);
                      foreach ($cursor as $document)
                      {
                        $ClassCategory = $document->ClassCategory;
                        $ClassName = $document->ClassName;
                      }

                      $filter = ['_id'=>new \MongoDB\BSON\ObjectId($Teachers_id)];
                      $query = new MongoDB\Driver\Query($filter);
                      $cursor =$GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Staff',$query);
                      foreach ($cursor as $document)
                      {
                        $ConsumerID = $document->ConsumerID;

                        $filter = ['_id'=>new \MongoDB\BSON\ObjectId($ConsumerID)];
                        $query = new MongoDB\Driver\Query($filter);
                        $cursor =$GoNGetzDatabase->executeQuery('GoNGetz.Consumer',$query);
                        foreach ($cursor as $document)
                        {
                          $consumer_id = strval($document->_id);
                          $ConsumerFName = $document->ConsumerFName;
                          $ConsumerLName = $document->ConsumerLName;
                        }
                      }

                      $filter = ['_id'=>new \MongoDB\BSON\ObjectId($Subject_id)];
                      $query = new MongoDB\Driver\Query($filter);
                      $cursor =$GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.SchoolsSubject',$query);
                      foreach ($cursor as $document)
                      {
                        $subject_id = strval($document->_id);
                        $SubjectName = $document->SubjectName;
                        $Class_category = $document->Class_category;
                      }

                      $totalstudent = 0;
                      $filter = ['Class_id'=>$Classroom_id];
                      $query = new MongoDB\Driver\Query($filter);
                      $cursor =$GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Students',$query);
                      foreach ($cursor as $document)
                      {
                        $totalstudent = $totalstudent + 1;
                      }
                      ?>
                      <tr>
                        <td class="text-left"><a href="index.php?page=staffdetail&id=<?= $consumer_id; ?>"><?= $ConsumerFName." ".$ConsumerLName;?></a></td>
                        <td class="text-left"><?= $ClassCategory." ".$ClassName;?></td>
                        <td><?= $totalstudent; ?></td>
                        <td><?= $SubjectName; ?></td>
                        <td><?= $Start_day; ?></td>
                        <td><?= $Start_hour; ?></td>
                        <td><?= $End_day; ?></td>
                        <td><?= $End_hour; ?></td>
                        <td><?= $Status; ?></td>
                        <td>
                          <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#edit_timetable">
                            <i class="flaticon2-edit icon-md text-hover-success"></i>
                          </button>
                          <button id="submit" type="button" class="btn" data-bs-toggle="modal" data-bs-target="#delete_timetable" data-bs-whatever="<?= $timetable_id; ?>">
                            <i class="flaticon2-trash icon-md text-hover-success"></i>
                          </button>
                        </td>
                      </tr>
                      <?php
                    }
                    ?>
                  </tbody>
                </table>
              </div>
            </div>
            <div class="tab-pane fade" id="timetable_class" role="tabpanel" aria-labelledby="timetable_class-tab">
              <div class="table-responsive">
                <table class="table table-sm text-center table-bordered">
                  <thead class="bg-success text-white"> 
                    <tr>
                      <th>Name</th>
                      <th>Class</th>
                      <th>Student</th>
                      <th>Subject</th>
                      <th colspan="2">Start</th>
                      <th colspan="2">End</th>
                      <th>Status</th>
                      <th>Update</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $filter = ['Classroom_id'=>$_SESSION["loggeduser_class_id"]];
                    $query = new MongoDB\Driver\Query($filter);
                    $cursor =$GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.TimeTable',$query);
                    foreach ($cursor as $document)
                    {
                      $timetable_id = $document->_id;
                      $Classroom_id = $document->Classroom_id;
                      $Teachers_id = $document->Teachers_id;
                      $Subject_id = $document->Subject_id;
                      $Status = $document->Status;

                      $Start = strval($document->Start);
                      $End = strval($document->End);

                      $Start = new MongoDB\BSON\UTCDateTime($Start);
                      $Start = $Start->toDateTime()->setTimezone(new \DateTimeZone(date_default_timezone_get()));
                      $Start_day = date_format($Start,"d-m-Y");
                      $Start_hour = date_format($Start,"H:i");

                      $End = new MongoDB\BSON\UTCDateTime($End);
                      $End = $End->toDateTime()->setTimezone(new \DateTimeZone(date_default_timezone_get()));
                      $End_day = date_format($End,"d-m-Y");
                      $End_hour = date_format($End,"H:i");

                      $filter = ['_id'=>new \MongoDB\BSON\ObjectId($Classroom_id)];
                      $query = new MongoDB\Driver\Query($filter);
                      $cursor =$GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Classrooms',$query);
                      foreach ($cursor as $document)
                      {
                        $ClassCategory = $document->ClassCategory;
                        $ClassName = $document->ClassName;
                      }

                      $filter = ['_id'=>new \MongoDB\BSON\ObjectId($Teachers_id)];
                      $query = new MongoDB\Driver\Query($filter);
                      $cursor =$GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Staff',$query);
                      foreach ($cursor as $document)
                      {
                        $ConsumerID = $document->ConsumerID;

                        $filter = ['_id'=>new \MongoDB\BSON\ObjectId($ConsumerID)];
                        $query = new MongoDB\Driver\Query($filter);
                        $cursor =$GoNGetzDatabase->executeQuery('GoNGetz.Consumer',$query);
                        foreach ($cursor as $document)
                        {
                          $consumer_id = strval($document->_id);
                          $ConsumerFName = $document->ConsumerFName;
                          $ConsumerLName = $document->ConsumerLName;
                        }
                      }

                      $filter = ['_id'=>new \MongoDB\BSON\ObjectId($Subject_id)];
                      $query = new MongoDB\Driver\Query($filter);
                      $cursor =$GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.SchoolsSubject',$query);
                      foreach ($cursor as $document)
                      {
                        $subject_id = strval($document->_id);
                        $SubjectName = $document->SubjectName;
                        $Class_category = $document->Class_category;
                      }

                      $totalstudent = 0;
                      $filter = ['Class_id'=>$Classroom_id];
                      $query = new MongoDB\Driver\Query($filter);
                      $cursor =$GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Students',$query);
                      foreach ($cursor as $document)
                      {
                        $totalstudent = $totalstudent + 1;
                      }
                      ?>
                      <tr>
                        <td class="text-left"><a href="index.php?page=staffdetail&id=<?= $consumer_id; ?>"><?= $ConsumerFName." ".$ConsumerLName;?></a></td>
                        <td class="text-left"><?= $ClassCategory." ".$ClassName;?></td>
                        <td><?= $totalstudent; ?></td>
                        <td><?= $SubjectName; ?></td>
                        <td><?= $Start_day; ?></td>
                        <td><?= $Start_hour; ?></td>
                        <td><?= $End_day; ?></td>
                        <td><?= $End_hour; ?></td>
                        <td><?= $Status; ?></td>
                        <td>
                          <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#edit_timetable">
                            <i class="flaticon2-edit icon-md text-hover-success"></i>
                          </button>
                          <button id="submit" type="button" class="btn" data-bs-toggle="modal" data-bs-target="#delete_timetable" data-bs-whatever="<?= $timetable_id; ?>">
                            <i class="flaticon2-trash icon-md text-hover-success"></i>
                          </button>
                        </td>
                      </tr>
                      <?php
                    }
                    ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
          <?php
        }
        ?>
      </div>
      <!-- end :: card body -->
    </div>
  </div>
  <!-- end::staff list -->
</div>
<?php include ('view/pages/modal-timetablelist.php'); 