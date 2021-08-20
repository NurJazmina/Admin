<style>
.nav-link {
color: white !important;
border:1px solid #ffffff;
}
</style>
<?php include ('model/classroomlist.php'); ?>
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
        <div class="col-12 col-sm-12 col-sm-12">
          <form name="searchclass" class="form-inline" action="index.php?page=classroomlist" method="post">
            <div class="col-12 col-sm-12 col-lg-12 text-right">
              <div class="row">
              <?php 
              if($_SESSION["loggeduser_ACCESS"] =='STAFF') 
              {
              ?>
                <button type="button" style="width:25%; color:#FFFFFF;" class="btn btn-success font-weight-bolder btn-sm" data-bs-toggle="modal" data-bs-target="#recheckaddclass" >Add</button>
                <input  type="text" style="width:50%";  class="form-control" name="classname" oninput="let p=this.selectionStart;this.value=this.value.toUpperCase();this.setSelectionRange(p, p);" placeholder="search by classroom name">
                <button type="submit" style="width:25%; color:#FFFFFF;" class="btn btn-success font-weight-bolder btn-sm" name="searchclass" >Search</button>
              <?php
              }
              ?>
              </div>
            </div>
          </form>
        </div>
			</div>
			<!--end::Toolbar-->
		</div>
	</div>
	<!--end::Subheader-->
<div class="row">
  <div class="col-12 col-sm-12 col-lg-6">
    <div class="col-12 col-sm-6 col-lg-6">
      <br><h1 style="color:#404040;">Classroom List</h1>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-12 col-lg-8">
    <div class="card">
        <div class="card-header">
          <strong>List</strong>
        </div>
      <div class="card-body" >
        <!-- sorting -->
          <button class="btn btn-success font-weight-bolder btn-sm" type="button" data-bs-toggle="dropdown">Sort by <i class="fas fa-sort"></i></button>
          <ul class="dropdown-menu">
            <li class="dropdown-item"><a href="index.php?page=classroomlist" tabindex="-1" data-type="alpha">All</a></li>
            <li class="dropdown-item"><a href="index.php?page=classroomlist&level=<?php echo "1"; ?>" tabindex="-1" data-type="alpha">category 1</a></li>
            <li class="dropdown-item"><a href="index.php?page=classroomlist&level=<?php echo "2"; ?>" tabindex="-1" data-type="alpha">category 2</a></li>
            <li class="dropdown-item"><a href="index.php?page=classroomlist&level=<?php echo "3"; ?>" tabindex="-1" data-type="alpha">category 3</a></li>
            <li class="dropdown-item"><a href="index.php?page=classroomlist&level=<?php echo "4"; ?>" tabindex="-1" data-type="alpha">category 4</a></li>
            <li class="dropdown-item"><a href="index.php?page=classroomlist&level=<?php echo "5"; ?>" tabindex="-1" data-type="alpha">category 5</a></li>
            <li class="dropdown-item"><a href="index.php?page=classroomlist&level=<?php echo "6"; ?>" tabindex="-1" data-type="alpha">category 6</a></li>
          </ul>
        <br><br>
          <div class="table-responsive" style="width:100%; margin:0 auto;">
            <table id="demoGrid" class="table table-bordered dt-responsive nowrap table-sm" width="100%" cellspacing="0" style= "text-align: center;">
              <thead>
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
                  $idclass = strval($document->_id);
                  $ClassCategory = strval($document->ClassCategory);
                  $ClassName = strval($document->ClassName);
                  $Class_Name=$ClassName;
                  ?>
                  <tr bgcolor='white'>
                  <td>
                  <?php
                  $filter1= ['StaffLevel'=>'0','SchoolID'=> $_SESSION["loggeduser_schoolID"],'ClassID' => $idclass];
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
                      $ConsumerFName = $document2->ConsumerFName;
                      $ConsumerPhone = $document2->ConsumerPhone;
                      echo $ConsumerFName."<br>";
                    }
                  }
                  ?>
                  </td>
                  <td><a href="index.php?page=classdetail&id=<?php echo $idclass; ?>" style="color:#076d79; text-decoration: none;"><?php echo $ClassCategory; echo "  "; print_r($document->ClassName);?></a></td>
                  <?php
                  $filter = ['Schools_id' => $_SESSION["loggeduser_schoolID"], 'Class_id'=>$idclass];
                  $query = new MongoDB\Driver\Query($filter);
                  $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Students',$query);
                  $totalstudent = 0;
                  foreach ($cursor as $document)
                  {
                    $totalstudent = $totalstudent+ 1;
                  }
                  ?>
                  <td>
                  <?php
                  $filter = ['Class_id' => $idclass];
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
                      $subjectid = $document->_id;
                      $SubjectName = $document->SubjectName;
                      ?>
                      <a href="index.php?page=subjectdetail&id=<?php echo $subjectid; ?>" style="color:#076d79; text-decoration: none;">
                      <?php echo $SubjectName."<br>"; ?></a>
                      <?php
                    }
                  }
                  ?>
                  </td>
                  <td>
                  <?php
                  $filter = ['Class_id' => $idclass];
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
                      $teacherid = $document->_id;
                      $ConsumerID = $document->ConsumerID;

                      $filter = ['_id' => new \MongoDB\BSON\ObjectId($ConsumerID)];
                      $query = new MongoDB\Driver\Query($filter);
                      $cursor = $GoNGetzDatabase->executeQuery('GoNGetz.Consumer',$query);
                      foreach ($cursor as $document)
                      {
                        $ConsumerFName = $document->ConsumerFName;
                        ?>
                        <a href="index.php?page=staffdetail&id=<?php echo $ConsumerID; ?>" style="color:#076d79; text-decoration: none;">
                        <?php echo "TEACHER ".$ConsumerFName."<br>"; ?></a>
                        <?php
                      }
                    }
                  }
                  ?>
                  </td>
                  <td><?php echo $totalstudent; ?></td>
                  <td><button type="button" style="font-size:15px width:25%" class="btn btn-light btn-hover-secondary"><a href="index.php?page=exportclassattendance&id=<?php echo $idclass; ?>">more >></a></button></td>
                  <td>
                  <button style="font-size:10px" type="button" class="btn btn-light btn-hover-primary" data-bs-toggle="modal" data-bs-target="#recheckeditclass" data-bs-whatever="<?php echo $idclass; ?>">
                    <i class="fa fa-edit" style="font-size:15px"></i>
                  </button>
                  <button style="font-size:10px" type="button" class="btn btn-light btn-hover-primary" data-bs-toggle="modal" data-bs-target="#DeleteclassModal" data-bs-whatever="<?php echo $idclass; ?>">
                    <i class="fas fa-trash" style="font-size:15px"></i>
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
                    <span class="btn btn-secondary">Previous</span>
                  <?php
                  } 
                  else 
                  {
                  ?>
                    <a href="index.php?page=classroomlist&paging=<?php echo $pagingprevious;?>" class="btn btn-success font-weight-bolder btn-sm">Previous</a>
                  <?php
                  }
                }
                ?>
                <a href="index.php?page=classroomlist&paging=<?php echo $pagingnext;?>" class="btn btn-success font-weight-bolder btn-sm">Next</a>
              </div>
            </div>
          </div>
          </div>
      </div>
    </div>
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
                            $filter = ['Schools_id'=>$_SESSION["loggeduser_schoolID"],'StudentsStatus'=>'ACTIVE'];
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
                            $filter = ['Schools_id'=>$_SESSION["loggeduser_schoolID"],'StudentsStatus'=>'INACTIVE'];
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
                          <tbody>
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
                    $filter = ['SchoolID'=>$_SESSION["loggeduser_schoolID"],];
                    $options = ['sort' => ['ClassCategory' => 1]];
                    $query = new MongoDB\Driver\Query($filter,$options);
                    $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Classrooms',$query);
                    foreach ($cursor as $document)
                    {
                      $classid = strval($document->_id);
                      $ClassCategory = strval($document->ClassCategory);
                      $ClassName = strval($document->ClassName);
                    ?>
                    <div class="tab-pane fade" id="v-pills-<?php echo $classid;?>" role="tabpanel" aria-labelledby="v-pills-<?php echo $ClassName; echo $ClassCategory;?>-tab">
                      <div class="box" >
                        <strong>Total</strong>
                        <div class="table-responsive">
                        <table class="table table-striped table-sm">
                          <tr>
                            <th>Total</th>
                            <td>
                            <?php
                            $filter = ['Schools_id'=>$_SESSION["loggeduser_schoolID"],'Class_id'=>$classid];
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
                              $filter = ['Schools_id'=>$_SESSION["loggeduser_schoolID"],'Class_id'=>$classid, 'StudentsStatus'=>'ACTIVE'];
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
                              $filter = ['Schools_id'=>$_SESSION["loggeduser_schoolID"],'Class_id'=>$classid, 'StudentsStatus'=>'INACTIVE'];
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
                        <table class="table table-striped table-sm">
                          <thead>
                            <tr>
                              <th>Category</th>
                              <th>Subject</th>
                              <th>Parent</th>
                              <th>Status</th>
                            </tr>
                          </thead>
                          <tbody>
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
                <div class="col-4" style="border-left: solid 1px #eee;">
                  <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                    <a class="nav-link bg-success font-weight-bolder btn-sm" id="v-pills-class-tab" data-bs-toggle="pill" href="#v-pills-class" role="tab" aria-controls="v-pills-class" aria-selected="true">All Class</a>
                    <?php
                    $calc = 0;
                    $filter = ['SchoolID'=>$_SESSION["loggeduser_schoolID"]];
                    $options = ['sort' => ['ClassCategory' => 1]];
                    $query = new MongoDB\Driver\Query($filter,$options);
                    $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Classrooms',$query);
                    foreach ($cursor as $document)
                    {
                      $calc = $calc + 1;
                      $classid = strval($document->_id);
                      $ClassCategory = strval($document->ClassCategory);
                      $ClassName = strval($document->ClassName);
                    ?>
                    <a class="nav-link bg-success font-weight-bolder btn-sm" id="v-pills-<?php echo $classid;?>-tab" data-bs-toggle="pill" href="#v-pills-<?php echo $classid;?>" role="tab" aria-controls="v-pills-<?php echo $classid;?>" aria-selected="false"><?php  echo $ClassCategory; echo "  "; echo $ClassName; ?></a>
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
<?php include ('view/pages/modal-classroomlist.php'); ?>


