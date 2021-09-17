<?php 
include 'model/studentlist.php'; 
$date_now = date("Y-m-d");
$today = new MongoDB\BSON\UTCDateTime((new DateTime($date_now))->getTimestamp()*1000);

if (isset($_GET['paging']) && !empty($_GET['paging']))
{
  $datapaging = ($_GET['paging']*50);
  $pagingprevious = $_GET['paging']-1;
  $pagingnext = $_GET['paging']+1;
} 
else
{
  $datapaging = 0;
  $pagingnext = 1;
  $pagingprevious = 0;
}
if (!isset($_POST['search_student']) && empty($_POST['search_student']))
{
  if (!isset($_GET['level']) && empty($_GET['level']))
  {
    $filter = ['Schools_id'=>$_SESSION["loggeduser_school_id"]];
    $option = ['limit'=>50,'skip'=>$datapaging,'sort' => ['_id' => -1]];
    $query = new MongoDB\Driver\Query($filter,$option);
    $cursor =$GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Students',$query);
  }
  else
  {
    $sort = ($_GET['level']);

    $filter = ['SchoolID' => $_SESSION["loggeduser_school_id"],'ClassCategory'=>$sort];
    $option = ['limit'=>50,'skip'=>$datapaging,'sort' => ['_id' => -1]];
    $query = new MongoDB\Driver\Query($filter,$option);
    $cursor =$GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Classrooms',$query);
    foreach ($cursor as $document)
    {
      $class_id = strval($document->_id);

      $filter = ['Class_id'=>$class_id];
      $query = new MongoDB\Driver\Query($filter);
      $cursor =$GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Students',$query);
    }
  }
}
else
{
  $consumer = ($_POST['consumer']);
  $filter = [NULL];
  $query = new MongoDB\Driver\Query($filter);
  $cursor =$GoNGetzDatabase->executeQuery('GoNGetz.Consumer',$query);
  foreach ($cursor as $document)
  {
    $consumer_id = strval($document->_id);
    $ConsumerIDNo = $document->ConsumerIDNo;
    $ConsumerFName = $document->ConsumerFName;
    if ($ConsumerIDNo==$consumer || $ConsumerFName==$consumer)
    {
      $filter = ['Consumer_id'=>$consumer_id];
      $query = new MongoDB\Driver\Query($filter);
      $cursor =$GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Students',$query);
    }
  }
}
?>
<style>
.highlight td.default 
{
background:#ff8795;
color:#ffff ;
border-color:#ffff;
}

#loader {
  border: 12px solid #f3f3f3;
  border-radius: 50%;
  border-top: 12px solid #1BC5BD;
  width: 70px;
  height: 70px;
  animation: spin 1s linear infinite;
}
  
@keyframes spin {
  100% {
      transform: rotate(360deg);
  }
}
  
.center {
  position: absolute;
  top: 0;
  bottom: 0;
  left: 0;
  right: 0;
  margin: auto;
}
</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
<script>
$(document).ready(function() {

    $("#Date").click(function() {

        var date = $("#date").val();
        var school = $("#school").val();

        $.post("attendance_student.php", {
            date: date,
            school:school,

        beforeSend: function(){
            // Show image container
            $("#loader").hide();
        },

        complete:function(data){
            // Hide image container
            $("#loader").show();
        }
        
        },
        function(data, status){
            $("#test").html(data);
            $("#loader").hide();
        },
        );
        $(this).removeClass('btn-light').addClass('btn-success');
    });

});
</script>
<!--begin::Subheader-->
<div class="subheader py-2 py-lg-6 subheader-solid" id="kt_subheader">
  <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
    <!--begin::Info-->
    <div class="d-flex align-items-center flex-wrap mr-1">
      <!--begin::Page Heading-->
      <div class="d-flex align-items-baseline flex-wrap mr-5">
        <!--begin::Page Title-->
        <h5 class="text-dark font-weight-bold my-1 mr-5">Students</h5>
        <!--end::Page Title-->
      </div>
      <!--begin::Separator-->
      <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-5 bg-gray-200"></div>
      <!--end::Separator-->
      <!--begin::Detail-->
      <div class="d-flex align-items-center" id="kt_subheader_search">
      <span class="text-dark-50 font-weight-bold" id="kt_subheader_total"><?= $school = $_SESSION["totalstudent"]; ?> Total Student</span>
      </div>
      <!--end::Detail-->
      <!--end::Page Heading-->
    </div>
    <!--end::Info-->
    <!--begin::Toolbar-->
    <div class="d-flex align-items-center">
      <form name="search_student" class="form-inline" action="index.php?page=studentlist" method="post">
        <div class="text-right">
          <?php 
          if($_SESSION["loggeduser_ACCESS"] =='STAFF') 
          {
            ?>
            <button type="button" class="btn btn-success btn-hover-light btn-sm"><a class="text-white" href="index.php?page=class_attendance" target="_blank">ATTENDANCE</a></button>
            <button type="button" class="btn btn-success btn-hover-light btn-sm" data-bs-toggle="modal" data-bs-target="#add_student">Add</button>
            <input  type="text" class="form-control form-control-sm" name="consumer" oninput="let p=this.selectionStart;this.value=this.value.toUpperCase();this.setSelectionRange(p, p);" placeholder="search by ID/Name">
            <button type="submit" class="btn btn-success btn-hover-light btn-sm" name="search_student">Search</button>
            <?php
          } 
          else
          {
            ?>
            <input  type="text" class="form-control form-control-sm" name="consumer" oninput="let p=this.selectionStart;this.value=this.value.toUpperCase();this.setSelectionRange(p, p);" placeholder="search by ID/Name">
            <button type="submit" class="btn btn-success btn-hover-light btn-sm" name="search_student">Search</button>
            <?php
          }
          ?>
        </div>
      </form>
    </div>
    <!--end::Toolbar-->
  </div>
</div>
<!--end::Subheader-->
<div class="row">
  <!-- begin::staff list -->
  <div class="col-12 col-lg-8">
    <div class="card">
      <!-- begin :: card header -->
      <div class="modal-header">
        <strong>List</strong>
        <button class="btn btn-light btn-hover-success bolder btn-sm" type="button" data-bs-toggle="dropdown">Sort by &nbsp;&nbsp;&nbsp;<i class="fas fa-sort"></i></button>
        <ul class="dropdown-menu">
        <li class="dropdown-item"><a href="index.php?page=studentlist">All</a></li>
            <li class="dropdown-item"><a href="index.php?page=studentlist&level=1">category 1</a></li>
            <li class="dropdown-item"><a href="index.php?page=studentlist&level=2">category 2</a></li>
            <li class="dropdown-item"><a href="index.php?page=studentlist&level=3">category 3</a></li>
            <li class="dropdown-item"><a href="index.php?page=studentlist&level=4">category 4</a></li>
            <li class="dropdown-item"><a href="index.php?page=studentlist&level=5">category 5</a></li>
            <li class="dropdown-item"><a href="index.php?page=studentlist&level=6">category 6</a></li>
        </ul>
      </div>
      <!-- end :: card header -->
      <!-- begin :: card body -->
      <div class="card-body">
      <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="List-tab" data-toggle="tab" href="#List">
                    <span class="nav-icon">
                        <i class="flaticon2-layers-1"></i>
                    </span>
                    <span class="nav-text">List</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="Attendance-tab" data-toggle="tab" href="#Attendance" aria-controls="Attendance">
                    <span class="nav-icon">
                        <i class="flaticon2-list-2"></i>
                    </span>
                    <span class="nav-text">Attendance</span>
                </a>
            </li>
        </ul>
        <div class="tab-content mt-5" id="myTabContent">
          <div class="tab-pane fade show active" id="List" role="tabpanel" aria-labelledby="List-tab">
            <div class="table-responsive">
              <table class="table table-sm text-left table-bordered">
                <thead class="bg-success text-white">
                  <tr class="text-center">
                    <th scope="col">Name</th>
                    <th scope="col">ID Type</th>
                    <th scope="col">ID No</th>
                    <th colspan="2">Parent</th>
                    <th colspan="2">Class Name</th>
                    <th scope="col">Status</th>
                    <th scope="col">Update</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  foreach ($cursor as $document)
                  {
                    $date = new MongoDB\BSON\UTCDateTime((new DateTime('now'))->getTimestamp()*1000);
                    $date = $date->toDateTime()->setTimezone(new \DateTimeZone(date_default_timezone_get()));

                    $student_id = strval($document->_id);
                    $Consumer_id = $document->Consumer_id;
                    $Class_id = $document->Class_id;
                    $StudentsStatus = $document->StudentsStatus;

                    $filter = ['_id'=>new \MongoDB\BSON\ObjectId($Consumer_id)];
                    $query = new MongoDB\Driver\Query($filter);
                    $cursor =$GoNGetzDatabase->executeQuery('GoNGetz.Consumer',$query);
                    foreach ($cursor as $document)
                    {
                      $consumer_id = strval($document->_id);
                      $ConsumerFName = $document->ConsumerFName;
                      $ConsumerLName = $document->ConsumerLName;
                      $ConsumerIDType = $document->ConsumerIDType;
                      $ConsumerIDNo = $document->ConsumerIDNo;
                    }
                    $filter = ['_id'=>new \MongoDB\BSON\ObjectId($Class_id)];
                    $query = new MongoDB\Driver\Query($filter);
                    $cursor =$GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Classrooms',$query);
                    foreach ($cursor as $document)
                    {
                      $ClassName = $document->ClassName;
                      $ClassCategory = $document->ClassCategory;
                    }
                    ?>
                    <tr>
                      <td><a href="index.php?page=studentdetail&id=<?=$consumer_id; ?>"><?=$ConsumerFName." ".$ConsumerLName;?></a></td>
                      <td><?= $ConsumerIDType; ?></td>
                      <td><?= $ConsumerIDNo; ?></td>
                      <td>
                        <?php
                        $filter = ['StudentID'=>$student_id];
                        $query = new MongoDB\Driver\Query($filter);
                        $cursor =$GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.ParentStudentRel',$query);
                        foreach ($cursor as $document)
                        {
                          $ParentStudentRelation = $document->ParentStudentRelation;
                          ?>
                          <a class="text-primary"><?=$ParentStudentRelation;?></a><br>
                          <?php
                        }
                        ?>
                      </td>
                      <td>
                        <?php
                        $filter = ['StudentID'=>$student_id];
                        $query = new MongoDB\Driver\Query($filter);
                        $cursor =$GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.ParentStudentRel',$query);
                        foreach ($cursor as $document)
                        {
                          $relation_id = strval($document->_id);
                          $ParentID = $document->ParentID;
                          $ParentStudentRelation = $document->ParentStudentRelation;

                          $filter = ['_id'=>new \MongoDB\BSON\ObjectId($ParentID)];
                          $query = new MongoDB\Driver\Query($filter);
                          $cursor =$GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Parents',$query);
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
                          ?>
                          <a href="index.php?page=parentdetail&id=<?=$consumer_id; ?>"><?=$ConsumerFName." ".$ConsumerLName;?></a><br>
                          <?php
                        }
                        ?>
                      </td>
                      <td><a href="index.php?page=classdetail&id=<?=$Class_id; ?>"><?= $ClassCategory." ".$ClassName; ?></a></td>
                      <td>
                        <?php
                        if($_SESSION["loggeduser_ACCESS"] =='STAFF') 
                        {
                          ?>
                          <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#edit_student" data-bs-whatever="<?= $consumer_id; ?>">
                            <i class="flaticon2-edit icon-md text-hover-success"></i>
                          </button>
                          <?php
                        }
                        ?>
                      </td>
                      <?php
                      if($StudentsStatus == "ACTIVE")
                      {
                        ?>
                        <td class="text-warning"><?= $StudentsStatus; ?></td>
                        <?php
                      }
                      else
                      {
                        ?>
                        <td class="text-success"><?= $StudentsStatus; ?></td>
                        <?php
                      }
                      ?> 
                      <td>
                      <?php
                        if($_SESSION["loggeduser_ACCESS"] =='STAFF') 
                        {
                          ?>
                          <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#status_student" data-bs-whatever="<?= $consumer_id; ?>">
                            <i class="flaticon2-reload icon-md text-hover-success"></i>
                          </button>
                          <?php
                        }
                      ?>
                      </td>
                    </tr>
                    <?php
                  }
                  ?>
                </tbody>
              </table>
              <div class="col-12 text-right">
                <div class="btn-group" role="group" aria-label="Basic example">
                  <?php
                  if (isset($_GET['paging']) && !empty($_GET['paging']))
                  {
                    if ($_GET['paging'] == 0) 
                    {
                      ?>
                      <a class="btn btn-light btn-hover-success btn-sm">Previous</a>
                      <a href="index.php?page=studentlist&paging=<?= $pagingnext;?>" class="btn btn-success btn-hover-light btn-sm">Next</a>
                      <?php
                    } 
                    else
                    {
                      ?>
                      <a href="index.php?page=studentlist&paging=<?= $pagingprevious;?>" class="btn btn-light btn-hover-success btn-sm">Previous</a>
                      <a href="index.php?page=studentlist&paging=<?= $pagingnext;?>" class="btn btn-success btn-hover-light btn-sm">Next</a>
                      <?php
                    }
                  }
                  else if (!isset($_GET['paging']) && empty($_GET['paging']))
                  {
                    ?>
                    <a class="btn btn-light btn-hover-success btn-sm">Previous</a>
                    <a href="index.php?page=studentlist&paging=<?= $pagingnext;?>" class="btn btn-success btn-hover-light btn-sm">Next</a>
                    <?php
                  }
                  ?>
                </div>
              </div>
            </div>
          </div>
          <div class="tab-pane fade" id="Attendance" role="tabpanel" aria-labelledby="Attendance-tab">
            <div class="card">
              <div class="card-body text-right">
                <div class="form-group row">
                  <div class="col-sm-3">
                    <input type="hidden" id="school" value="<?= $_SESSION["loggeduser_school_id"]; ?>">
                    <input type="date" class="form-control form-control-sm bg-white" name="date" id="date" placeholder="Select date" value="<?= $date_now; ?>"> 
                  </div>
                  <div class="col-sm-1">
                  <button type="button" class="btn btn-sm btn-success btn-hover-light" id="Date">submit</button>
                  </div>
                  <div class="col-sm-5"></div>
                  <div class="col-sm-3">
                    <button type="button" id="submitted" class="btn btn-success btn-hover-light btn-sm mb-3">EXPORT ATTENDANCE TO XLS</button>
                  </div>
                </div>
                <div id='loader' style='display: none;' class="center"></div>
                <a id="test" class="table-responsive"></a>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- end :: card body -->
    </div>
  </div>
  <!-- end::staff list -->
    <!-- begin::latest summary -->
    <div class="col-12 col-lg-4">
    <div class="row">
        <div class="col-12 col-lg-12">
          <div class="card">
            <div class="card-header">
              <strong>Latest Summary</strong>
            </div>
            <div class="card-body table-responsive">
              <div class="row">
                <div class="col-8">
                  <div class="tab-content" id="v-pills-tabContent">
                    <!--Tab by all class -->
                    <div class="tab-pane fade show active" id="v-pills-class" role="tabpanel" aria-labelledby="v-pills-class-tab">
                      <div class="box">
                        <strong>Total</strong>
                        <table class="table table-sm">
                          <tr>
                            <th>Total</th>
                            <td>
                            <?php
                            $filter = ['Schools_id'=>$_SESSION["loggeduser_school_id"]];
                            $query = new MongoDB\Driver\Query($filter);
                            $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Students',$query);
                            $totalstudent = 0;

                            foreach ($cursor as $document)
                            {
                              $totalstudent = $totalstudent+ 1;
                            }
                            echo $totalstudent;
                            ?>
                            </td>
                          </tr>
                          <tr>
                            <th>Active</th>
                            <td>
                            <?php
                            $filter = ['Schools_id'=>$_SESSION["loggeduser_school_id"], 'StudentsStatus'=>'ACTIVE'];
                            $query = new MongoDB\Driver\Query($filter);
                            $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Students',$query);
                            $totalstudent = 0;

                            foreach ($cursor as $document)
                            {
                              $totalstudent = $totalstudent + 1;
                            }
                            echo $totalstudent;
                            ?>
                            </td>
                          </tr>
                          <tr>
                            <th>Inactive</th>
                            <td>
                            <?php
                            $filter = ['Schools_id'=>$_SESSION["loggeduser_school_id"], 'StudentsStatus'=>'INACTIVE'];
                            $query = new MongoDB\Driver\Query($filter);
                            $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Students',$query);
                            $totalstudent = 0;

                            foreach ($cursor as $document)
                            {
                              $totalstudent = $totalstudent + 1;
                            }
                            echo $totalstudent;
                            ?>
                            </td>
                          </tr>
                        </table>
                      </div>
                      <div class="box">
                        <strong>Remarks</strong>
                        <table class="table table-sm">
                          <thead>
                            <tr>
                              <th>School</th>
                              <th>Subject</th>
                              <th>Students</th>
                              <th>Status</th>
                            </tr>
                          </thead>
                          <tbody class="bg-light">
                            <tr>
                              <td>No data</td>
                              <td>No data</td>
                              <td>No data</td>
                              <td>No data</td>
                            </tr>
                          </tbody>
                        </table>
                      </div>
                    </div>
                    <!-- End tab -->
                    <!--Tab by department -->
                    <?php
                    $filter = ['SchoolID'=>$_SESSION["loggeduser_school_id"]];
                    $options = ['sort' => ['ClassCategory' => 1]];
                    $query = new MongoDB\Driver\Query($filter,$options);
                    $cursor =$GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Classrooms',$query);
                    foreach ($cursor as $document)
                    {
                      $class_id = strval($document->_id);
                      $ClassCategory = $document->ClassCategory;
                      $ClassName = $document->ClassName;
                      ?>
                      <div class="tab-pane fade" id="v-pills-<?= $class_id;?>" role="tabpanel" aria-labelledby="v-pills-department<?= $class_id;?>-tab">
                        <div class="box" >
                          <strong>Total</strong>
                          <table class="table table-sm">
                            <tr>
                              <th>Total</th>
                              <td>
                              <?php
                              $filter = ['Schools_id'=>$_SESSION["loggeduser_school_id"],'Class_id'=>$class_id];
                              $query = new MongoDB\Driver\Query($filter);
                              $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Students',$query);
                              $totalstudent = 0;
                              foreach ($cursor as $document)
                              {
                                $totalstudent = $totalstudent+ 1;
                              }
                              echo $totalstudent;
                              ?>
                              </td>
                            </tr>
                            <tr>
                              <th>Active</th>
                              <td>
                              <?php
                              $filter = ['Schools_id'=>$_SESSION["loggeduser_school_id"],'Class_id'=>$class_id,'StudentsStatus'=>'ACTIVE'];
                              $query = new MongoDB\Driver\Query($filter);
                              $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Students',$query);
                              $totalstudent = 0;

                              foreach ($cursor as $document)
                              {
                                $totalstudent = $totalstudent + 1;
                              }
                              echo $totalstudent;
                              ?>
                              </td>
                            </tr>
                            <tr>
                              <th>Inactive</th>
                              <td>
                              <?php
                              $filter = ['Schools_id'=>$_SESSION["loggeduser_school_id"],'Class_id'=>$class_id,'StudentsStatus'=>'INACTIVE'];
                              $query = new MongoDB\Driver\Query($filter);
                              $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Students',$query);
                              $totalstudent = 0;

                              foreach ($cursor as $document)
                              {
                                $totalstudent = $totalstudent + 1;
                              }
                              echo $totalstudent;
                              ?>
                              </td>
                            </tr>
                          </table>
                        </div>
                        <div class="box">
                          <strong>Remarks</strong>
                          <table class="table table-sm">
                            <thead>
                              <tr>
                                <th>Category</th>
                                <th>Subject</th>
                                <th>Parent</th>
                                <th>Status</th>
                              </tr>
                            </thead>
                            <tbody class="bg-light">
                              <tr>
                                <td>No data</td>
                                <td>No data</td>
                                <td>No data</td>
                                <td>No data</td>
                              </tr>
                            </tbody>
                          </table>
                        </div>
                      </div>
                      <?php
                    }
                    ?>
                    <!-- End tab -->
                    <div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">...</div>
                  </div>
                </div>
                <div class="col-4 p-1">
                  <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                    <a class="nav-link bg-success text-white font-weight-bolder btn-sm mb-1" id="v-pills-class-tab" data-bs-toggle="pill" href="#v-pills-class" role="tab" aria-controls="v-pills-class" aria-selected="true">ALL STUDENT</a>
                    <?php
                    $calc = 0;
                    $filter = ['SchoolID'=>$_SESSION["loggeduser_school_id"]];
                    $options = ['sort' => ['ClassCategory' => 1]];
                    $query = new MongoDB\Driver\Query($filter,$options);
                    $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Classrooms',$query);
                    foreach ($cursor as $document)
                    {
                      $calc = $calc + 1;
                      $class_id = strval($document->_id);
                      $ClassCategory = $document->ClassCategory;
                      $ClassName = $document->ClassName;
                      ?>
                      <a class="nav-link bg-success text-white font-weight-bolder btn-sm mb-1" id="v-pills-<?= $class_id;?>-tab" data-bs-toggle="pill" href="#v-pills-<?= $class_id;?>" role="tab" aria-controls="v-pills-department<?= $class_id;?>" aria-selected="false"><?= $ClassName; ?></a>
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
  <!-- end::latest summary -->
</div>
<script>
$(document).ready(function() {

    $("#submitted").click(function() {
        $("#attendance").table2excel({
        filename: "attendance_student.xls"
    });
    });

});
</script>
<?php include ('view/pages/modal-studentlist.php'); 