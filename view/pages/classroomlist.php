<?php include ('model/classroomlist.php'); ?>
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
      <form name="searchclass" class="form-inline" action="index.php?page=classroomlist" method="post">
        <div class="text-right">
          <?php 
          if($_SESSION["loggeduser_ACCESS"] =='STAFF') 
          {
            ?>
            <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#add_class">Add</button>
            <input  type="text" class="form-control" name="classname" oninput="let p=this.selectionStart;this.value=this.value.toUpperCase();this.setSelectionRange(p, p);" placeholder="search by classroom name">
            <button type="submit" class="btn btn-success btn-sm" name="searchclass">Search</button>
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
  <!-- begin::class list -->
  <div class="col-12 col-lg-8">
    <div class="card">
      <div class="modal-header">
        <strong>List</strong>
        <button class="btn btn-light btn-hover-success bolder btn-sm" type="button" data-bs-toggle="dropdown">Sort by &nbsp;&nbsp;&nbsp;<i class="fas fa-sort"></i></button>
        <!-- sorting -->
        <ul class="dropdown-menu">
          <li class="dropdown-item"><a href="index.php?page=classroomlist">All</a></li>
          <li class="dropdown-item"><a href="index.php?page=classroomlist&level=1">category 1</a></li>
          <li class="dropdown-item"><a href="index.php?page=classroomlist&level=2">category 2</a></li>
          <li class="dropdown-item"><a href="index.php?page=classroomlist&level=3">category 3</a></li>
          <li class="dropdown-item"><a href="index.php?page=classroomlist&level=4">category 4</a></li>
          <li class="dropdown-item"><a href="index.php?page=classroomlist&level=5">category 5</a></li>
          <li class="dropdown-item"><a href="index.php?page=classroomlist&level=6">category 6</a></li>
        </ul>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-sm text-center table-bordered">
            <thead class="bg-success text-white"> 
              <tr>
                <th scope="col">Teacher</th>
                <th scope="col">Class name</th>
                <th colspan="2">Subject</th>
                <th scope="col">Total Student</th>
                <th scope="col">Attendance</th>
                <th scope="col">Update</th>
              </tr>
            </thead>
            <tbody>
              <?php
              foreach ($cursor as $document)
              {
                $class_id = strval($document->_id);
                $ClassCategory = $document->ClassCategory;
                $ClassName = $document->ClassName;
                ?>
                <tr>
                  <td class="text-left">
                  <?php
                  $filter = ['StaffLevel'=>'0','SchoolID'=> $_SESSION["loggeduser_school_id"],'ClassID' => $class_id];
                  $query = new MongoDB\Driver\Query($filter);
                  $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Staff',$query);
                  foreach ($cursor as $document1)
                  {
                    $ConsumerID = ($document1->ConsumerID);

                    $filter = ['_id'=>new \MongoDB\BSON\ObjectId($ConsumerID)];
                    $query = new MongoDB\Driver\Query($filter);
                    $cursor = $GoNGetzDatabase->executeQuery('GoNGetz.Consumer',$query);
                    foreach ($cursor as $document2)
                    {
                      $consumer_id = $document2->_id;
                      $ConsumerFName = $document2->ConsumerFName;
                      $ConsumerPhone = $document2->ConsumerPhone;
                      ?>
                      <a href="index.php?page=staffdetail&id=<?= $consumer_id; ?>">
                      <?= $ConsumerFName."<br>"; ?></a>
                      <?php
                    }
                  }
                  ?>
                  </td>
                  <td class="text-left"><a href="index.php?page=classdetail&id=<?= $class_id; ?>"><?= $ClassCategory." ".$ClassName;?></a></td>
                  <?php
                  $totalstudent = 0;
                  $filter = ['Schools_id' => $_SESSION["loggeduser_school_id"], 'Class_id'=>$class_id];
                  $query = new MongoDB\Driver\Query($filter);
                  $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Students',$query);
                  foreach ($cursor as $document)
                  {
                    $totalstudent = $totalstudent+ 1;
                  }
                  ?>
                  <td class="text-left">
                  <?php
                  $filter = ['Class_id' => $class_id];
                  $query = new MongoDB\Driver\Query($filter);
                  $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.ClassroomSubjectRel',$query);
                  foreach ($cursor as $document)
                  {
                    $Subject_id = $document->Subject_id;
                    $Teacher_id = $document->Teacher_id;

                    $filter = ['_id' => new \MongoDB\BSON\ObjectId($Subject_id)];
                    $query = new MongoDB\Driver\Query($filter);
                    $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.SchoolsSubject',$query);
                    foreach ($cursor as $document)
                    {
                      $subject_id = $document->_id;
                      $SubjectName = $document->SubjectName;
                      ?>
                      <a href="index.php?page=subjectdetail&id=<?= $subject_id; ?>">
                      <?= $SubjectName."<br>"; ?></a>
                      <?php
                    }
                  }
                  ?>
                  </td>
                  <td class="text-left">
                  <?php
                  $filter = ['Class_id' => $class_id];
                  $query = new MongoDB\Driver\Query($filter);
                  $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.ClassroomSubjectRel',$query);
                  foreach ($cursor as $document)
                  {
                    $Subject_id = $document->Subject_id;
                    $Teacher_id = $document->Teacher_id;

                    $filter = ['_id' => new \MongoDB\BSON\ObjectId($Teacher_id)];
                    $query = new MongoDB\Driver\Query($filter);
                    $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Staff',$query);
                    foreach ($cursor as $document)
                    {
                      $teacher_id = $document->_id;
                      $ConsumerID = $document->ConsumerID;

                      $filter = ['_id' => new \MongoDB\BSON\ObjectId($ConsumerID)];
                      $query = new MongoDB\Driver\Query($filter);
                      $cursor = $GoNGetzDatabase->executeQuery('GoNGetz.Consumer',$query);
                      foreach ($cursor as $document)
                      {
                        $ConsumerFName = $document->ConsumerFName;
                        ?>
                        <a href="index.php?page=staffdetail&id=<?= $ConsumerID; ?>">
                        <?= $ConsumerFName."<br>"; ?></a>
                        <?php
                      }
                    }
                  }
                  ?>
                  </td>
                  <td><?= $totalstudent; ?></td>
                  <td>
                    <button class="btn">
                      <a class="text-dark-50 text-hover-success font-weight-bold" href="index.php?page=classattendance&id=<?= $class_id; ?>">
                        <i class="flaticon2-list-2 icon-md text-hover-success"></i>
                      </a>
                    </button>
                  </td>
                  <td>
                  <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#edit_class" data-bs-whatever="<?= $class_id; ?>">
                    <i class="flaticon2-edit icon-md text-hover-success"></i>
                  </button>
                  <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#delete_class" data-bs-whatever="<?= $class_id; ?>">
                    <i class="flaticon2-trash icon-md text-hover-success"></i>
                  </button>
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
                  <a href="index.php?page=classroomlist&paging=<?= $pagingnext;?>" class="btn btn-success btn-hover-light btn-sm">Next</a>
                  <?php
                } 
                else
                {
                  ?>
                  <a href="index.php?page=classroomlist&paging=<?= $pagingprevious;?>" class="btn btn-light btn-hover-success btn-sm">Previous</a>
                  <a href="index.php?page=classroomlist&paging=<?= $pagingnext;?>" class="btn btn-success btn-hover-light btn-sm">Next</a>
                  <?php
                }
              }
              else if (!isset($_GET['paging']) && empty($_GET['paging']))
              {
                ?>
                <a class="btn btn-light btn-hover-success btn-sm">Previous</a>
                <a href="index.php?page=classroomlist&paging=<?= $pagingnext;?>" class="btn btn-success btn-hover-light btn-sm">Next</a>
                <?php
              }
              ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- end::class list -->
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
                              $filter = ['Schools_id'=>$_SESSION["loggeduser_school_id"],'StudentsStatus'=>'ACTIVE'];
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
                              <th>Inactive</th>
                              <td>
                              <?php
                              $filter = ['Schools_id'=>$_SESSION["loggeduser_school_id"],'StudentsStatus'=>'INACTIVE'];
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
                    $filter = ['SchoolID'=>$_SESSION["loggeduser_school_id"],];
                    $options = ['sort' => ['ClassCategory' => 1]];
                    $query = new MongoDB\Driver\Query($filter,$options);
                    $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Classrooms',$query);
                    foreach ($cursor as $document)
                    {
                      $class_id = strval($document->_id);
                      $ClassCategory = $document->ClassCategory;
                      $ClassName = $document->ClassName;
                      ?>
                      <div class="tab-pane fade" id="v-pills-<?= $class_id;?>" role="tabpanel" aria-labelledby="v-pills-<?= $ClassName; echo $ClassCategory;?>-tab">
                        <div class="box" >
                          <strong>Total</strong>
                          <div class="table-responsive">
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
                                  $filter = ['Schools_id'=>$_SESSION["loggeduser_school_id"],'Class_id'=>$class_id, 'StudentsStatus'=>'ACTIVE'];
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
                                <th>Inactive</th>
                                <td>
                                  <?php
                                  $filter = ['Schools_id'=>$_SESSION["loggeduser_school_id"],'Class_id'=>$class_id, 'StudentsStatus'=>'INACTIVE'];
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
                    <a class="nav-link bg-success text-white font-weight-bolder btn-sm mb-1" id="v-pills-class-tab" data-bs-toggle="pill" href="#v-pills-class" role="tab" aria-controls="v-pills-class" aria-selected="true">ALL CLASS</a>
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
                      <a class="nav-link bg-success text-white font-weight-bolder btn-sm mb-1" id="v-pills-<?= $class_id;?>-tab" data-bs-toggle="pill" href="#v-pills-<?= $class_id;?>" role="tab" aria-controls="v-pills-<?= $class_id;?>" aria-selected="false"><?= $ClassCategory."&nbsp".$ClassName; ?></a>
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
<?php include ('view/pages/modal-classroomlist.php'); ?>


