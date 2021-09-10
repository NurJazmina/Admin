<?php 
include 'model/stafflist.php'; 
$date = date("Y-m-d");
$today = new MongoDB\BSON\UTCDateTime((new DateTime($date))->getTimestamp()*1000);
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

    $.post("attendance_staff.php", {
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
        <h5 class="text-dark font-weight-bold my-1 mr-5">Staff</h5>
        <!--end::Page Title-->
      </div>
      <!--begin::Separator-->
      <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-5 bg-gray-200"></div>
      <!--end::Separator-->
      <!--begin::Detail-->
      <div class="d-flex align-items-center" id="kt_subheader_search">
      <span class="text-dark-50 font-weight-bold" id="kt_subheader_total"><?= $school = $_SESSION["totalstaff"] + $_SESSION["totalteacher"]; ?> Total Staff</span>
      </div>
      <!--end::Detail-->
      <!--end::Page Heading-->
    </div>
    <!--end::Info-->
    <!--begin::Toolbar-->
    <div class="d-flex align-items-center">
      <form name="search_staff" class="form-inline" action="index.php?page=stafflist" method="post">
        <div class="text-right">
          <?php 
          if($_SESSION["loggeduser_ACCESS"] =='STAFF') 
          {
            ?>
            <button type="button" class="btn btn-success btn-hover-light btn-sm"><a class="text-white" href="index.php?page=attendance_staff" target="_blank">ATTENDANCE</a></button>
            <button type="button" class="btn btn-success btn-hover-light btn-sm" data-bs-toggle="modal" data-bs-target="#add_staff">Add</button>
            <input  type="text" class="form-control" name="consumer" oninput="let p=this.selectionStart;this.value=this.value.toUpperCase();this.setSelectionRange(p, p);" placeholder="search by ID/Name">
            <button type="submit" class="btn btn-success btn-hover-light btn-sm" name="search_staff">Search</button>
            <?php
          } 
          else
          {
            ?>
            <input  type="text" class="form-control" name="consumer" oninput="let p=this.selectionStart;this.value=this.value.toUpperCase();this.setSelectionRange(p, p);" placeholder="search by ID/Name">
            <button type="submit" class="btn btn-success btn-hover-light btn-sm" name="search_staff">Search</button>
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
          <li class="dropdown-item"><a href="index.php?page=stafflist">All</a></li>
          <li class="dropdown-item"><a href="index.php?page=stafflist&level=<?= "1"; ?>">Staff</a></li>
          <li class="dropdown-item"><a href="index.php?page=stafflist&level=<?= "0"; ?>">Teacher</a></li>
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
                    <th scope="col">IC</th>
                    <th scope="col">Phone</th>
                    <th scope="col">Department</th>
                    <th colspan="2">Class Name</th>
                    <th scope="col">Status</th>
                    <th scope="col">Update</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $ClassID = '';
                  $class_id = '';
                  $Cards_id = '';
                  $Staffdepartment = '';
                  foreach ($cursor as $document)
                  {
                    $ConsumerID = $document->ConsumerID;
                    $Staffdepartment = $document->Staffdepartment;
                    $ClassID = $document->ClassID;
                    $StaffLevel = $document->StaffLevel;
                    $StaffStatus = $document->StaffStatus;

                    $filter = ['_id'=>new \MongoDB\BSON\ObjectId($ConsumerID)];
                    $query = new MongoDB\Driver\Query($filter);
                    $cursor = $GoNGetzDatabase->executeQuery('GoNGetz.Consumer',$query);
                    foreach ($cursor as $document1)
                    {
                      $consumer_id = strval($document1->_id);
                      $ConsumerFName = $document1->ConsumerFName;
                      $ConsumerLName = $document1->ConsumerLName;
                      $ConsumerIDNo = $document1->ConsumerIDNo;
                      $ConsumerAddress = $document1->ConsumerAddress;
                      $ConsumerPhone = $document1->ConsumerPhone;

                      $filter = ['Consumer_id'=>$consumer_id];
                      $query = new MongoDB\Driver\Query($filter);
                      $cursor = $GoNGetzDatabase->executeQuery('GoNGetz.Cards',$query);
                      foreach ($cursor as $document2)
                      {
                        $Cards_id = $document2->Cards_id;
                      }
                    }

                    if($Staffdepartment != '')
                    {
                      $filter = ['_id'=>new \MongoDB\BSON\ObjectId($Staffdepartment)];
                      $query = new MongoDB\Driver\Query($filter);
                      $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.SchoolsDepartment',$query);
                      foreach ($cursor as $document)
                      {
                        $department_id = strval($document->_id);
                        $DepartmentName = $document->DepartmentName;
                      }
                    }
                    else
                    {
                      $DepartmentName = '';
                    }
                    ?>
                    <tr>
                      <td><a href="index.php?page=staffdetail&id=<?= $consumer_id; ?>"><?= $ConsumerFName." ".$ConsumerLName;?></a></td>
                      <td><?= $ConsumerIDNo; ?></td>
                      <td><?= $ConsumerPhone; ?></td>
                      <td><a href="index.php?page=departmentdetail&id=<?= $department_id; ?>"><?= $DepartmentName; ?></a></td>
                      <td>
                        <?php
                        if($ClassID == '') 
                        {
                          ?>
                          <a></a>
                          <?php
                        }
                        else
                        {
                          if($ClassID !== '')
                          {
                            $filter = ['_id'=>new \MongoDB\BSON\ObjectId($ClassID)];
                            $query = new MongoDB\Driver\Query($filter);
                            $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Classrooms',$query);
                            foreach ($cursor as $document)
                            {
                              $class_id = strval($document->_id);
                              $ClassName = $document->ClassName;
                              ?>
                              <a href="index.php?page=classdetail&id=<?= $class_id; ?>"><?= $ClassName; ?></a>
                              <?php
                            }
                          }
                        }
                        ?>
                      </td>
                      <td class="text-center">
                        <?php
                        if($_SESSION["loggeduser_ACCESS"] =='STAFF') 
                        {
                          ?>
                          <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#edit_staff">
                            <i class="flaticon2-edit icon-md text-hover-success"></i>
                          </button>
                          <?php
                        }
                        else
                        {
                          ?>
                          <button class="btn" disabled>
                            <i class="flaticon2-edit icon-md text-hover-success"></i>
                          </button>
                          <?php
                        }
                        ?>
                      </td>
                        <?php
                        if($StaffStatus == "ACTIVE")
                        {
                          ?>
                          <td class="text-warning"><?= $StaffStatus; ?></td>
                          <?php
                        }
                        else
                        {
                          ?>
                          <td class="text-success"><?= $StaffStatus; ?></td>
                          <?php
                        }
                        ?>
                      <td class="text-center">
                        <?php
                        if($_SESSION["loggeduser_ACCESS"] =='STAFF') 
                        {
                          ?>
                          <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#status_staff">
                            <i class="flaticon2-reload icon-md text-hover-success"></i>
                          </button>
                          <?php
                        }
                        else
                        {
                          ?>
                          <button class="btn" disabled>
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
                      <a href="index.php?page=stafflist&paging=<?= $pagingnext;?>" class="btn btn-success btn-hover-light btn-sm">Next</a>
                      <?php
                    } 
                    else
                    {
                      ?>
                      <a href="index.php?page=stafflist&paging=<?= $pagingprevious;?>" class="btn btn-light btn-hover-success btn-sm">Previous</a>
                      <a href="index.php?page=stafflist&paging=<?= $pagingnext;?>" class="btn btn-success btn-hover-light btn-sm">Next</a>
                      <?php
                    }
                  }
                  else if (!isset($_GET['paging']) && empty($_GET['paging']))
                  {
                    ?>
                    <a class="btn btn-light btn-hover-success btn-sm">Previous</a>
                    <a href="index.php?page=stafflist&paging=<?= $pagingnext;?>" class="btn btn-success btn-hover-light btn-sm">Next</a>
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
                      <input type="date" class="form-control form-control-sm bg-white" name="date" id="date" placeholder="Select date" value="<?= $date; ?>"> 
                    </div>
                    <div class="col-sm-1">
                      <button type="button" class="btn btn-sm btn-success btn-hover-light" id="Date">submit</button>
                    </div>
                    <div class="col-sm-3"></div>
                    <div class="col-sm-5">
                      <button type="button" id="submitted" class="btn btn-success btn-hover-light btn-sm mb-3">EXPORT ATTENDANCE TO XLS</button>
                    </div>
                  </div>
                  <div id='loader' style='display: none;' class="center"></div>
                  <a id="test"></a>
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
            <div class="card-body">
              <div class="row">
                <div class="col-8">
                  <div class="tab-content" id="v-pills-tabContent">
                    <!--Tab by all class -->
                    <div class="tab-pane fade show active" id="v-pills-class" role="tabpanel" aria-labelledby="v-pills-class-tab">
                      <div class="box">
                        <strong>Total</strong>
                        <div class="table-responsive">
                          <table class="table table-sm">
                            <tr>
                              <th>Total</th>
                              <td>
                              <?php
                              $filter = ['SchoolID'=>$_SESSION["loggeduser_school_id"]];
                              $query = new MongoDB\Driver\Query($filter);
                              $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Staff',$query);
                              $totalstaff = 0;

                              foreach ($cursor as $document)
                              {
                                $totalstaff = $totalstaff+ 1;
                              }
                              echo $totalstaff;
                              ?>
                              </td>
                            </tr>
                            <tr>
                              <th>Active</th>
                              <td>
                              <?php
                              $filter = ['SchoolID'=>$_SESSION["loggeduser_school_id"], 'StaffStatus'=>'ACTIVE'];
                              $query = new MongoDB\Driver\Query($filter);
                              $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Staff',$query);
                              $totalstaff = 0;

                              foreach ($cursor as $document)
                              {
                                $totalstaff = $totalstaff + 1;
                              }
                              echo $totalstaff;
                              ?>
                              </td>
                            </tr>
                            <tr>
                              <th>Inactive</th>
                              <td>
                              <?php
                              $filter = ['SchoolID'=>$_SESSION["loggeduser_school_id"], 'StaffStatus'=>'INACTIVE'];
                              $query = new MongoDB\Driver\Query($filter);
                              $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Staff',$query);
                              $totalstaff = 0;

                              foreach ($cursor as $document)
                              {
                                $totalstaff = $totalstaff + 1;
                              }
                              echo $totalstaff;
                              ?>
                              </td>
                            </tr>
                          </table>
                        </div>
                      </div>
                      <div class="box">
                        <strong>Remarks</strong>
                        <div class="table-responsive">
                          <table class="table table-sm">
                            <thead>
                              <tr>
                                <th>School</th>
                                <th>Subject</th>
                                <th>Staff</th>
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
                    </div>
                    <!-- End tab -->
                    <!--Tab by department -->
                    <?php
                    $filter = ['School_id'=>$_SESSION["loggeduser_school_id"]];
                    $query = new MongoDB\Driver\Query($filter);
                    $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.SchoolsDepartment',$query);
                    foreach ($cursor as $document)
                    {
                      $departmentid = strval($document->_id);
                      $DepartmentName = strval($document->DepartmentName);
                      ?>
                      <div class="tab-pane fade" id="v-pills-<?= $departmentid;?>" role="tabpanel" aria-labelledby="v-pills-department<?= $departmentid;?>-tab">
                        <div class="box" >
                          <strong>Total</strong>
                          <div class="table-responsive">
                            <table class="table table-sm">
                              <tr>
                                <th>Total</th>
                                <td>
                                <?php
                                $filter = ['SchoolID'=>$_SESSION["loggeduser_school_id"],'Staffdepartment'=>$departmentid];
                                $query = new MongoDB\Driver\Query($filter);
                                $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Staff',$query);
                                $totalstaff = 0;
                                foreach ($cursor as $document)
                                {
                                  $totalstaff = $totalstaff+ 1;
                                }
                                echo $totalstaff;
                                ?>
                                </td>
                              </tr>
                              <tr>
                                <th>Active</th>
                                <td>
                                <?php
                                $filter = ['SchoolID'=>$_SESSION["loggeduser_school_id"],'Staffdepartment'=>$departmentid,'StaffStatus'=>'ACTIVE'];
                                $query = new MongoDB\Driver\Query($filter);
                                $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Staff',$query);
                                $totalstaff = 0;

                                foreach ($cursor as $document)
                                {
                                  $totalstaff = $totalstaff + 1;
                                }
                                echo $totalstaff;
                                ?>
                                </td>
                              </tr>
                              <tr>
                                <th>Inactive</th>
                                <td>
                                <?php
                                $filter = ['SchoolID'=>$_SESSION["loggeduser_school_id"],'Staffdepartment'=>$departmentid,'StaffStatus'=>'INACTIVE'];
                                $query = new MongoDB\Driver\Query($filter);
                                $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Staff',$query);
                                $totalstaff = 0;

                                foreach ($cursor as $document)
                                {
                                  $totalstaff = $totalstaff + 1;
                                }
                                echo $totalstaff;
                                ?>
                                </td>
                              </tr>
                            </table>
                          </div>
                        </div>
                        <div class="box">
                          <strong>Remarks</strong>
                          <div class="table-responsive">
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
                    <a class="nav-link bg-success text-white font-weight-bolder btn-sm mb-1" id="v-pills-class-tab" data-bs-toggle="pill" href="#v-pills-class" role="tab" aria-controls="v-pills-class" aria-selected="true">ALL STAFF</a>
                    <?php
                    $calc = 0;
                    $filter = ['School_id'=>$_SESSION["loggeduser_school_id"]];
                    $query = new MongoDB\Driver\Query($filter);
                    $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.SchoolsDepartment',$query);
                    foreach ($cursor as $document)
                    {
                      $calc = $calc + 1;
                      $department_id = strval($document->_id);
                      $DepartmentName = $document->DepartmentName;
                      ?>
                      <a class="nav-link bg-success text-white font-weight-bolder btn-sm mb-1" id="v-pills-<?= $class_id;?>-tab" data-bs-toggle="pill" href="#v-pills-<?= $department_id;?>" role="tab" aria-controls="v-pills-department<?= $department_id;?>" aria-selected="false"><?= $DepartmentName; ?></a>
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
        filename: "attendance_staff.xls"
    });
    });

});
</script>
<?php include ('view/pages/modal-stafflist.php'); 