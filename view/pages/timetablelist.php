<?php 
include 'model/timetablelist.php'; 
$date = date("Y-m-d");
$today = new MongoDB\BSON\UTCDateTime((new DateTime($date))->getTimestamp()*1000);

$count_for_staff = 0;
$filter = ['SchoolID'=>$_SESSION["loggeduser_school_id"]];
$query = new MongoDB\Driver\Query($filter);
$cursor =$GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Staff',$query);
foreach ($cursor as $document)
{
  $teacher_id = strval($document->_id);

  $filter = ['Teacher_id'=>$teacher_id];
  $query = new MongoDB\Driver\Query($filter);
  $cursor =$GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.ClassroomSubjectRel',$query);
  foreach ($cursor as $document)
  { 
    $count_for_staff = $count_for_staff + 1;
  }
}
?>
<!--begin::Subheader-->
<div class="subheader py-2 py-lg-6 subheader-solid" id="kt_subheader">
  <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
    <!--begin::Info-->
    <div class="d-flex align-items-center flex-wrap mr-1">
      <!--begin::Page Heading-->
      <div class="d-flex align-items-baseline flex-wrap mr-5">
        <!--begin::Page Title-->
        <h5 class="text-dark font-weight-bold my-1 mr-5">Timetable</h5>
        <!--end::Page Title-->
      </div>
      <!--begin::Separator-->
      <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-5 bg-gray-200"></div>
      <!--end::Separator-->
      <!--begin::Detail-->
      <div class="d-flex" id="kt_subheader_search">
        <span class="text-dark-50 font-weight-bold" id="kt_subheader_total">
        <?php  
        if($_SESSION["loggeduser_ACCESS"] =='STAFF')
        { 
          echo $count_for_staff; 
        } 
        elseif($_SESSION["loggeduser_ACCESS"] =='TEACHER') 
        { 
          $count_for_class = 0;
          $filter = ['Class_id'=>$_SESSION["loggeduser_class_id"]];
          $query = new MongoDB\Driver\Query($filter);
          $cursor =$GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.ClassroomSubjectRel',$query);
          foreach ($cursor as $document)
          { 
            $count_for_class = $count_for_class + 1;
          }
          echo $count_for_class; 
        } 
        elseif($_SESSION["loggeduser_ACCESS"] =='STUDENT')
        {
          $count_for_class = 0;
          $filter = ['Class_id'=>$_SESSION["loggeduser_class_id"]];
          $query = new MongoDB\Driver\Query($filter);
          $cursor =$GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.ClassroomSubjectRel',$query);
          foreach ($cursor as $document)
          { 
            $count_for_class = $count_for_class + 1;
          }
          echo $count_for_class; 
        }
        ?> 
        Total Timetable
        </span>
      </div>
      <!--end::Detail-->
      <!--end::Page Heading-->
    </div>
    <!--end::Info-->
    <!--begin::Toolbar-->
    <form class="d-flex mb-2" name="search_staff" action="index.php?page=timetablelist" method="post">
      <?php 
      if($_SESSION["loggeduser_ACCESS"] =='STAFF') 
      {
        ?>
        <button type="button" class="btn btn-success btn-sm mr-1"><a class="text-white" href="index.php?page=class_attendance" target="_blank">ATTENDANCE</a></button>
        <button type="button" class="btn btn-success btn-sm mr-1" data-bs-toggle="modal" data-bs-target="#add_timetable">Add</button>
        <input  type="text" class="form-control form-control-sm mr-1" name="consumer" oninput="let p=this.selectionStart;this.value=this.value.toUpperCase();this.setSelectionRange(p, p);" placeholder="search by first name">
        <button type="submit" class="btn btn-success btn-sm mr-1" name="search_staff">Search</button>
        <?php
      }
      ?>
    </form>
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
                if (!isset($_POST['search_staff']) && empty($_POST['search_staff']))
                {
                  $filter = ['SchoolID'=>$_SESSION["loggeduser_school_id"]];
                  $query = new MongoDB\Driver\Query($filter);
                  $cursor =$GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Staff',$query);
                }
                else
                {
                  $consumer = $_POST['consumer'];
                  $filter = ['ConsumerFName'=>$consumer];
                  $query = new MongoDB\Driver\Query($filter);
                  $cursor = $GoNGetzDatabase->executeQuery('GoNGetz.Consumer',$query);
                  foreach ($cursor as $document)
                  {
                    $consumer_id = strval($document->_id);

                    $filter = ['ConsumerID'=>$consumer_id];
                    $query = new MongoDB\Driver\Query($filter);
                    $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Staff',$query);
                  }
                }
                foreach ($cursor as $document)
                {
                  $teacher_id = strval($document->_id);
                  $filter = ['Teacher_id'=>$teacher_id];
                  $query = new MongoDB\Driver\Query($filter);
                  $cursor =$GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.ClassroomSubjectRel',$query);
                  foreach ($cursor as $document)
                  { 
                    $class_rel_id = strval($document->_id);
                    $Class_id = $document->Class_id;
                    $Teacher_id = $document->Teacher_id;
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

                    $totalstudent = 0;
                    $filter = ['Class_id'=>$Class_id];
                    $query = new MongoDB\Driver\Query($filter);
                    $cursor =$GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Students',$query);
                    foreach ($cursor as $document)
                    {
                      $totalstudent = $totalstudent + 1;
                    }

                    $filter = ['_id'=>new \MongoDB\BSON\ObjectId($Teacher_id)];
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

                    $filter = ['_id'=>new \MongoDB\BSON\ObjectId($Class_id)];
                    $query = new MongoDB\Driver\Query($filter);
                    $cursor =$GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Classrooms',$query);
                    foreach ($cursor as $document)
                    {
                      $ClassCategory = $document->ClassCategory;
                      $ClassName = $document->ClassName;
                    }

                    $filter = ['_id'=>new \MongoDB\BSON\ObjectId($Subject_id)];
                    $query = new MongoDB\Driver\Query($filter);
                    $cursor =$GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.SchoolsSubject',$query);
                    foreach ($cursor as $document)
                    {
                      $SubjectName = $document->SubjectName;
                    }
                    ?>
                    <tr>
                      <td class="text-left"><a href="index.php?page=staff_detail&id=<?= $consumer_id; ?>"><?= $ConsumerFName." ".$ConsumerLName;?></a></td>
                      <td class="text-left"><a href="index.php?page=class_detail&id=<?= $Class_id; ?>"><?= $ClassCategory." ".$ClassName;?></a></td>
                      <td><?= $totalstudent; ?></td>
                      <td><a href="index.php?page=subject_detail&id=<?= $Subject_id; ?>"><?= $SubjectName; ?></a></td>
                      <td><?= $Start_day; ?></td>
                      <td><?= $Start_hour; ?></td>
                      <td><?= $End_day; ?></td>
                      <td><?= $End_hour; ?></td>
                      <td><?= $Status; ?></td>
                      <td>
                        <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#edit_timetable" data-bs-whatever="<?= $class_rel_id; ?>">
                          <i class="flaticon2-edit icon-md text-hover-success"></i>
                        </button>
                        <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#delete_timetable" data-bs-whatever="<?= $class_rel_id; ?>">
                          <i class="flaticon2-trash icon-md text-hover-success"></i>
                        </button>
                      </td>
                    </tr>
                    <?php
                  }
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
                    $filter = ['Teacher_id'=>$_SESSION["loggeduser_teacherid"]];
                    $query = new MongoDB\Driver\Query($filter);
                    $cursor =$GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.ClassroomSubjectRel',$query);
                    foreach ($cursor as $document)
                    {
                      $class_rel_id = strval($document->_id);
                      $Class_id = $document->Class_id;
                      $Teacher_id = $document->Teacher_id;
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

                      $filter = ['_id'=>new \MongoDB\BSON\ObjectId($Class_id)];
                      $query = new MongoDB\Driver\Query($filter);
                      $cursor =$GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Classrooms',$query);
                      foreach ($cursor as $document)
                      {
                        $ClassCategory = $document->ClassCategory;
                        $ClassName = $document->ClassName;
                      }

                      $filter = ['_id'=>new \MongoDB\BSON\ObjectId($Teacher_id)];
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
                      $filter = ['Class_id'=>$Class_id];
                      $query = new MongoDB\Driver\Query($filter);
                      $cursor =$GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Students',$query);
                      foreach ($cursor as $document)
                      {
                        $totalstudent = $totalstudent + 1;
                      }
                      ?>
                      <tr>
                        <td class="text-left"><a href="index.php?page=staff_detail&id=<?= $consumer_id; ?>"><?= $ConsumerFName." ".$ConsumerLName;?></a></td>
                        <td><a href="index.php?page=class_detail&id=<?= $Class_id; ?>"><?= $ClassCategory." ".$ClassName;?></a></td>
                        <td><?= $totalstudent; ?></td>
                        <td><a href="index.php?page=subject_detail&id=<?= $Subject_id; ?>"><?= $SubjectName; ?></a></td>
                        <td><?= $Start_day; ?></td>
                        <td><?= $Start_hour; ?></td>
                        <td><?= $End_day; ?></td>
                        <td><?= $End_hour; ?></td>
                        <td><?= $Status; ?></td>
                        <td>
                          <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#edit_timetable" data-bs-whatever="<?= $class_rel_id; ?>">
                            <i class="flaticon2-edit icon-md text-hover-success"></i>
                          </button>
                          <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#delete_timetable" data-bs-whatever="<?= $class_rel_id; ?>">
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
                    $filter = ['Class_id'=>$_SESSION["loggeduser_class_id"]];
                    $query = new MongoDB\Driver\Query($filter);
                    $cursor =$GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.ClassroomSubjectRel',$query);
                    foreach ($cursor as $document)
                    {
                      $class_rel_id = strval($document->_id);
                      $Class_id = $document->Class_id;
                      $Teacher_id = $document->Teacher_id;
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

                      $filter = ['_id'=>new \MongoDB\BSON\ObjectId($Class_id)];
                      $query = new MongoDB\Driver\Query($filter);
                      $cursor =$GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Classrooms',$query);
                      foreach ($cursor as $document)
                      {
                        $ClassCategory = $document->ClassCategory;
                        $ClassName = $document->ClassName;
                      }

                      $filter = ['_id'=>new \MongoDB\BSON\ObjectId($Teacher_id)];
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
                      $filter = ['Class_id'=>$Class_id];
                      $query = new MongoDB\Driver\Query($filter);
                      $cursor =$GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Students',$query);
                      foreach ($cursor as $document)
                      {
                        $totalstudent = $totalstudent + 1;
                      }
                      ?>
                      <tr>
                        <td class="text-left"><a href="index.php?page=staff_detail&id=<?= $consumer_id; ?>"><?= $ConsumerFName." ".$ConsumerLName;?></a></td>
                        <td><a href="index.php?page=class_detail&id=<?= $Class_id; ?>"><?= $ClassCategory." ".$ClassName;?></a></td>
                        <td><?= $totalstudent; ?></td>
                        <td><a href="index.php?page=subject_detail&id=<?= $Subject_id; ?>"><?= $SubjectName; ?></a></td>
                        <td><?= $Start_day; ?></td>
                        <td><?= $Start_hour; ?></td>
                        <td><?= $End_day; ?></td>
                        <td><?= $End_hour; ?></td>
                        <td><?= $Status; ?></td>
                        <td>
                          <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#edit_timetable" data-bs-whatever="<?= $class_rel_id; ?>">
                            <i class="flaticon2-edit icon-md text-hover-success"></i>
                          </button>
                          <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#delete_timetable" data-bs-whatever="<?= $class_rel_id; ?>">
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
        elseif($_SESSION["loggeduser_ACCESS"] == "STUDENT")
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
          </ul>
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
                </tr>
              </thead>
              <tbody>
                <?php
                $filter = ['Class_id'=>$_SESSION["loggeduser_class_id"]];
                $query = new MongoDB\Driver\Query($filter);
                $cursor =$GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.ClassroomSubjectRel',$query);
                foreach ($cursor as $document)
                {
                  $class_rel_id = strval($document->_id);
                  $Class_id = $document->Class_id;
                  $Teacher_id = $document->Teacher_id;
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

                  $filter = ['_id'=>new \MongoDB\BSON\ObjectId($Class_id)];
                  $query = new MongoDB\Driver\Query($filter);
                  $cursor =$GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Classrooms',$query);
                  foreach ($cursor as $document)
                  {
                    $ClassCategory = $document->ClassCategory;
                    $ClassName = $document->ClassName;
                  }

                  $filter = ['_id'=>new \MongoDB\BSON\ObjectId($Teacher_id)];
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
                  $filter = ['Class_id'=>$Class_id];
                  $query = new MongoDB\Driver\Query($filter);
                  $cursor =$GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Students',$query);
                  foreach ($cursor as $document)
                  {
                    $totalstudent = $totalstudent + 1;
                  }
                  ?>
                  <tr>
                    <td class="text-left"><a href="index.php?page=staff_detail&id=<?= $consumer_id; ?>"><?= $ConsumerFName." ".$ConsumerLName;?></a></td>
                    <td><a href="index.php?page=class_detail&id=<?= $Class_id; ?>"><?= $ClassCategory." ".$ClassName;?></a></td>
                    <td><?= $totalstudent; ?></td>
                    <td><a href="index.php?page=subject_detail&id=<?= $Subject_id; ?>"><?= $SubjectName; ?></a></td>
                    <td><?= $Start_day; ?></td>
                    <td><?= $Start_hour; ?></td>
                    <td><?= $End_day; ?></td>
                    <td><?= $End_hour; ?></td>
                    <td><?= $Status; ?></td>
                  </tr>
                  <?php
                }
                ?>
              </tbody>
            </table>
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