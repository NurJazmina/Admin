<?php include ('model/studentlist.php'); ?>
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
            <button type="button" class="btn btn-success btn-sm"><a class="text-white" href="index.php?page=exportstudentattendance">ATTENDANCE</a></button>
            <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#add_student">Add</button>
            <input  type="text" class="form-control" name="consumer" oninput="let p=this.selectionStart;this.value=this.value.toUpperCase();this.setSelectionRange(p, p);" placeholder="search by ID/Name">
            <button type="submit" class="btn btn-success btn-sm" name="search_student">Search</button>
            <?php
          } 
          else
          {
            ?>
            <input  type="text" class="form-control" name="consumer" oninput="let p=this.selectionStart;this.value=this.value.toUpperCase();this.setSelectionRange(p, p);" placeholder="search by ID/Name">
            <button type="submit" class="btn btn-success btn-sm" name="search_student">Search</button>
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
        <div class="table-responsive">
          <table class="table table-sm text-left table-bordered">
            <thead class="bg-success text-white">
              <tr>
                <th scope="col">Name</th>
                <th scope="col">ID Type</th>
                <th scope="col">ID No</th>
                <th scope="col">Parent</th>
                <th colspan="2">Class Name</th>
                <th scope="col">Student Status</th>
                <th scope="col">Delete</th>
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
                  ?>
                  <tr>
                    <td><a href="index.php?page=studentdetail&id=<?=$Consumer_id; ?>"><?=$ConsumerFName." ".$ConsumerLName;?></a></td>
                    <td><?= $ConsumerIDType; ?></td>
                    <td><?= $ConsumerIDNo; ?></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                  <?php
                }
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
                              $filter = ['Schools_id'=>$_SESSION["loggeduser_schoolID"]];
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
                              $filter = ['Schools_id'=>$_SESSION["loggeduser_schoolID"], 'StudentsStatus'=>'ACTIVE'];
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
                              $filter = ['Schools_id'=>$_SESSION["loggeduser_schoolID"], 'StudentsStatus'=>'INACTIVE'];
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
                      </div>
                      <div class="box">
                        <strong>Remarks</strong>
                        <div class="table-responsive">
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
                    </div>
                    <!-- End tab -->
                    <!--Tab by department -->
                    <?php
                    $filter = ['SchoolID'=>$_SESSION["loggeduser_schoolID"]];
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
                          <div class="table-responsive">
                            <table class="table table-sm">
                              <tr>
                                <th>Total</th>
                                <td>
                                <?php
                                $filter = ['Schools_id'=>$_SESSION["loggeduser_schoolID"],'Class_id'=>$class_id];
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
                                $filter = ['Schools_id'=>$_SESSION["loggeduser_schoolID"],'Class_id'=>$class_id,'StudentsStatus'=>'ACTIVE'];
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
                                $filter = ['Schools_id'=>$_SESSION["loggeduser_schoolID"],'Class_id'=>$class_id,'StudentsStatus'=>'INACTIVE'];
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
                    <a class="nav-link bg-success text-white font-weight-bolder btn-sm mb-1" id="v-pills-class-tab" data-bs-toggle="pill" href="#v-pills-class" role="tab" aria-controls="v-pills-class" aria-selected="true">ALL STUDENT</a>
                    <?php
                    $calc = 0;
                    $filter = ['SchoolID'=>$_SESSION["loggeduser_schoolID"]];
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
<?php include ('view/pages/modal-studentlist.php'); 