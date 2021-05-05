<?php include ('model/studentlist.php'); ?>

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
					<h5 class="text-dark font-weight-bold my-1 mr-5">Student</h5>
					<!--end::Page Title-->
				</div>
        <!--begin::Separator-->
        <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-5 bg-gray-200"></div>
        <!--end::Separator-->
        <!--begin::Detail-->
        <div class="d-flex align-items-center" id="kt_subheader_search">
        <?php 
        $student = $_SESSION["totalstudent"];
        ?>
          <span class="text-dark-50 font-weight-bold" id="kt_subheader_total"><?php echo $student; ?> Total Student</span>
        </div>
        <!--end::Detail-->
				<!--end::Page Heading-->
			</div>
			<!--end::Info-->
			<!--begin::Toolbar-->
			<div class="d-flex align-items-center">
        <div class="col-12 col-sm-12 col-sm-12">
              <form name="searchstudent" class="form-inline" action="index.php?page=studentlist" method="post">
                <div class="col-12 col-sm-12 col-lg-12 text-right">
                  <div class="row">
                  <?php 
                  if($_SESSION["loggeduser_StaffLevel"]=='1') 
                  {
                  ?>
                    <button type="button" style="width:20%"; class="btn btn-success font-weight-bolder btn-sm"><a href="index.php?page=exportstudentattendance" style="color:#FFFFFF; text-decoration: none;">ATTENDANCE</a></button>
                    <button type="button" style="width:20%; color:#FFFFFF;" class="btn btn-info font-weight-bolder btn-sm" data-bs-toggle="modal" data-bs-target="#recheckaddstudent" >Add</button>
                    <div class="input-group input-group-sm input-group-solid" style="width:40%">
                      <input  type="text" class="form-control" name="IDnumber" oninput="let p=this.selectionStart;this.value=this.value.toUpperCase();this.setSelectionRange(p, p);" placeholder="Search by ID/Name">
                      <div class="input-group-append">
                        <span class="input-group-text">
                          <span class="svg-icon">
                            <!--begin::Svg Icon | path:assets/media/svg/icons/General/Search.svg-->
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                              <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <rect x="0" y="0" width="24" height="24"></rect>
                                <path d="M14.2928932,16.7071068 C13.9023689,16.3165825 13.9023689,15.6834175 14.2928932,15.2928932 C14.6834175,14.9023689 15.3165825,14.9023689 15.7071068,15.2928932 L19.7071068,19.2928932 C20.0976311,19.6834175 20.0976311,20.3165825 19.7071068,20.7071068 C19.3165825,21.0976311 18.6834175,21.0976311 18.2928932,20.7071068 L14.2928932,16.7071068 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"></path>
                                <path d="M11,16 C13.7614237,16 16,13.7614237 16,11 C16,8.23857625 13.7614237,6 11,6 C8.23857625,6 6,8.23857625 6,11 C6,13.7614237 8.23857625,16 11,16 Z M11,18 C7.13400675,18 4,14.8659932 4,11 C4,7.13400675 7.13400675,4 11,4 C14.8659932,4 18,7.13400675 18,11 C18,14.8659932 14.8659932,18 11,18 Z" fill="#000000" fill-rule="nonzero"></path>
                              </g>
                            </svg>
                            <!--end::Svg Icon-->
                          </span>
                          <!--<i class="flaticon2-search-1 icon-sm"></i>-->
                        </span>
                      </div>
                    </div>
                    <button type="submit" style="width:20%; color:#FFFFFF;" class="btn btn-info font-weight-bolder btn-sm" name="searchstudent">Search</button>
                  <?php
                  } 
                  else
                  {
                  ?>
                    <div class="input-group input-group-sm input-group-solid" style="width:75%">
                      <input  type="text" class="form-control" name="IDnumber" oninput="let p=this.selectionStart;this.value=this.value.toUpperCase();this.setSelectionRange(p, p);" placeholder="Search by ID/Name">
                      <div class="input-group-append">
                        <span class="input-group-text">
                          <span class="svg-icon">
                            <!--begin::Svg Icon | path:assets/media/svg/icons/General/Search.svg-->
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                              <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <rect x="0" y="0" width="24" height="24"></rect>
                                <path d="M14.2928932,16.7071068 C13.9023689,16.3165825 13.9023689,15.6834175 14.2928932,15.2928932 C14.6834175,14.9023689 15.3165825,14.9023689 15.7071068,15.2928932 L19.7071068,19.2928932 C20.0976311,19.6834175 20.0976311,20.3165825 19.7071068,20.7071068 C19.3165825,21.0976311 18.6834175,21.0976311 18.2928932,20.7071068 L14.2928932,16.7071068 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"></path>
                                <path d="M11,16 C13.7614237,16 16,13.7614237 16,11 C16,8.23857625 13.7614237,6 11,6 C8.23857625,6 6,8.23857625 6,11 C6,13.7614237 8.23857625,16 11,16 Z M11,18 C7.13400675,18 4,14.8659932 4,11 C4,7.13400675 7.13400675,4 11,4 C14.8659932,4 18,7.13400675 18,11 C18,14.8659932 14.8659932,18 11,18 Z" fill="#000000" fill-rule="nonzero"></path>
                              </g>
                            </svg>
                            <!--end::Svg Icon-->
                          </span>
                          <!--<i class="flaticon2-search-1 icon-sm"></i>-->
                        </span>
                      </div>
                    </div>
                    <button type="submit" style="width:25%; color:#FFFFFF;" class="btn btn-info font-weight-bolder btn-sm" name="searchstudent">Search</button>
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
      <br><h1 style="color:#404040;">Student List</h1>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-12 col-lg-8">
    <div class="card">
        <div class="card-header">
          <strong>List</strong>
        </div>
        <div class="card-body">
        <!-- sorting -->
        <div class="btn-group sort-btn" style="width:10%";>
          <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Sort by </button>
          <ul class="dropdown-menu">
            <li class="dropdown-item"><a href="index.php?page=studentlist" tabindex="-1" data-type="alpha" style="color:#076d79; text-decoration: none;">All</a></li>
            <li class="dropdown-item"><a href="index.php?page=studentlist&level=<?php echo "1"; ?>" tabindex="-1" data-type="alpha" style="color:#076d79; text-decoration: none;">category 1</a></li>
            <li class="dropdown-item"><a href="index.php?page=studentlist&level=<?php echo "2"; ?>" tabindex="-1" data-type="alpha" style="color:#076d79; text-decoration: none;">category 2</a></li>
            <li class="dropdown-item"><a href="index.php?page=studentlist&level=<?php echo "3"; ?>" tabindex="-1" data-type="alpha" style="color:#076d79; text-decoration: none;">category 3</a></li>
            <li class="dropdown-item"><a href="index.php?page=studentlist&level=<?php echo "4"; ?>" tabindex="-1" data-type="alpha" style="color:#076d79; text-decoration: none;">category 4</a></li>
            <li class="dropdown-item"><a href="index.php?page=studentlist&level=<?php echo "5"; ?>" tabindex="-1" data-type="alpha" style="color:#076d79; text-decoration: none;">category 5</a></li>
            <li class="dropdown-item"><a href="index.php?page=studentlist&level=<?php echo "6"; ?>" tabindex="-1" data-type="alpha" style="color:#076d79; text-decoration: none;">category 6</a></li>
          </ul>
        </div>
        <br><br>
          <div class="table-responsive" style="width:100%; margin:0 auto;">
            <table id="demoGrid" class="table table-bordered dt-responsive nowrap table-sm" width="100%" cellspacing="0" style= "text-align: center;">
              <thead>
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
                  $vardate = new MongoDB\BSON\UTCDateTime((new DateTime('now'))->getTimestamp()*1000);
                  $date = $vardate->toDateTime()->setTimezone(new \DateTimeZone(date_default_timezone_get()));

                  $studentid = strval($document->_id);
                  $StudentsStatus = strval($document->StudentsStatus);
                  $Class_id = strval($document->Class_id);
                  $classid = new \MongoDB\BSON\ObjectId($Class_id);
                  $Consumer_id = strval($document->Consumer_id);
                  $consumeridstudent = new \MongoDB\BSON\ObjectId($Consumer_id);

                  $filter1 = ['_id'=>$consumeridstudent];
                  $query1 = new MongoDB\Driver\Query($filter1);
                  $cursor1 =$GoNGetzDatabase->executeQuery('GoNGetz.Consumer',$query1);
                  foreach ($cursor1 as $document1)
                  {
                    $consumerid = $document1->_id;
                    $ConsumerFName = $document1->ConsumerFName;
                    $ConsumerLName = $document1->ConsumerLName;
                    $ConsumerIDType = $document1->ConsumerIDType;
                    $ConsumerIDNo = $document1->ConsumerIDNo;
                    $ConsumerEmail = $document1->ConsumerEmail;
                    $ConsumerPhone = $document1->ConsumerPhone;
                    ?>
                    <tr>
                      <td><a href="index.php?page=studentdetail&id=<?php echo $Consumer_id; ?>" style="color:#076d79; text-decoration: none;"><?php echo $ConsumerFName." ".$ConsumerLName;?></a>
                      <div class="table-responsive">
                      <table class="table table-striped table-sm" width="50%" cellspacing="0" style= "text-align: center;">
                      <td>
                      <table>
                      <tr>
                      <?php
                      $varnow = date("d-m-Y");
                      echo $varnow."<br>";
                      ?>
                      </tr>
                      <tr style="text-decoration: none;">
                      <?php
                      $Cards_id='';
                      $filter = ['_id'=>new \MongoDB\BSON\ObjectId($Consumer_id)];
                      $query = new MongoDB\Driver\Query($filter);
                      $cursor =$GoNGetzDatabase->executeQuery('GoNGetz.Consumer',$query);

                      foreach ($cursor as $document)
                      {
                        $consumerid = strval($document->_id);
                        $filter1 = ['Consumer_id'=>$consumerid];
                        $query1 = new MongoDB\Driver\Query($filter1);
                        $cursor1 =$GoNGetzDatabase->executeQuery('GoNGetz.Cards',$query1);
                        foreach ($cursor1 as $document1)
                        {
                          $Cards_id = strval($document1->Cards_id);
                        }
                      }
                      $today = new MongoDB\BSON\UTCDateTime((new DateTime($varnow))->getTimestamp()*1000);
                      $varcount = 0;
                      $filterA = ['CardID'=>$Cards_id, 'AttendanceDate' => ['$gte' => $today]];
                      $queryA = new MongoDB\Driver\Query($filterA);
                      $cursorA =$GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Attendance',$queryA);
                      $varcounting = 0;
                      ?>
                      <?php
                        foreach ($cursorA as $documentA)
                          {
                            $varcounting = $varcounting +1;
                            if ($varcounting % 2){
                              echo"<br>";
                              $displayinout = "IN";

                            } else {
                              $displayinout = " | OUT";

                            }
                            $AttendanceDate = ($documentA->AttendanceDate);
                            if (!isset($datecapture) && empty($datecapture)) {
                              $datecapture = $AttendanceDate;
                            }
                            $utcdatetime = new MongoDB\BSON\UTCDateTime(strval($AttendanceDate));
                            $AttendanceDate = $utcdatetime->toDateTime()->setTimezone(new \DateTimeZone(date_default_timezone_get()));
                            if ($datecapture!=$AttendanceDate) {
                            echo $displayinout ?><i class="fas fa-arrow-circle-right"></i><?php echo date_format($AttendanceDate,"h:i:a");
                            }
                          }
                          ?>
                      </tr>
                      </table>
                      <br>
                      <?php
                      if($_SESSION["loggeduser_StaffLevel"]=='1') 
                      {
                      ?>
                      <button type="button" style="font-size:15px width:25%" class="btn btn-light btn-hover-secondary"><a href="index.php?page=exportstudentattendance&id=<?php echo $consumerid; ?>">more >></a></button>
                      <?php
                      }
                      ?>
                      </td>
                      </table>
                      </div>
                      </td>
                      <td><?php print_r($ConsumerIDType);?></td>
                      <td><?php print_r($ConsumerIDNo);?></td>
                      <?php
                      }
                      ?>
                      <td>
                      <?php
                      $filter2 = ['Schools_id'=>$_SESSION["loggeduser_schoolID"], 'StudentID'=>$studentid];
                      $query2 = new MongoDB\Driver\Query($filter2);
                      $cursor2 =$GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.ParentStudentRel',$query2);

                      foreach ($cursor2 as $document2)
                      {
                        $ParentID = strval($document2->ParentID);
                        $StudentID = strval($document2->StudentID);
                        $ParentStudentRelation = strval($document2->ParentStudentRelation);
                        $ParentID = new \MongoDB\BSON\ObjectId($ParentID);

                        $filter3 = ['_id'=>$ParentID];
                        $query3 = new MongoDB\Driver\Query($filter3);
                        $cursor3 =$GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Parents',$query3);
                        foreach ($cursor3 as $document3)
                        {
                          $ConsumerID = strval($document3->ConsumerID);
                          $consumeridparent = new \MongoDB\BSON\ObjectId($ConsumerID);
                          $filter2 = ['_id'=>$consumeridparent];
                          $query2 = new MongoDB\Driver\Query($filter2);
                          $cursor2 =$GoNGetzDatabase->executeQuery('GoNGetz.Consumer',$query2);
                          foreach ($cursor2 as $document2)
                          {
                            $ConsumerFName2 = $document2->ConsumerFName;
                            $ConsumerLName2 = $document2->ConsumerLName;
                            echo $ConsumerFName2." ".$ConsumerLName2." (".$ParentStudentRelation.")<br>";
                          }
                        }
                      }
                      $filter4 = ['_id'=>$classid];
                      $query4 = new MongoDB\Driver\Query($filter4);
                      $cursor4 =$GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Classrooms',$query4);

                      foreach ($cursor4 as $document4)
                      {
                       $ClassCategory = $document4->ClassCategory;
                       $ClassName = $document4->ClassName;
                      }
                      ?>
                      </td>
                      <td><?php echo $ClassCategory." ".$ClassName; ?></td>
                      <td>
                      <?php
                      if($_SESSION["loggeduser_StaffLevel"]=='1') 
                      {
                      ?>
                        <button style="font-size:10px" type="button" class="btn btn-light btn-hover-primary" data-bs-toggle="modal" data-bs-target="#recheckeditstudent" data-bs-whatever="<?php echo $studentid; ?>">
                          <i class="fa fa-edit" style="font-size:15px"></i>
                        </button>
                      <?php
                      }
                      ?>
                      </td>
                      <td><?php if(($StudentsStatus) == "ACTIVE") {echo " <font color=green> ACTIVE";} else {echo " <font color=red> INACTIVE";}; ?></td>
                      <td>
                      <?php
                      if($_SESSION["loggeduser_StaffLevel"]=='1') 
                      {
                      ?>
                        <button style="font-size:10px" type="button" class="btn btn-light btn-hover-primary" data-bs-toggle="modal" data-bs-target="#StatusStudentModal" data-bs-whatever="<?php echo $studentid; ?>">
                          <i class="fas fa-exchange-alt" style="font-size:15px" ></i>
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
                  if ($_GET['paging'=='0'])
                  {
                    $pagingprevious = '0';
                  }
                }
                else
                {
                  $pagingprevious = "0";
                }
                ?>
                <?php
                if ($pagingprevious == "0")
                {
                ?>
                  <span class="btn btn-secondary">Previous</span>
                <?php
                }
                else
                {
                ?>
                  <a href="index.php?page=studentlist&paging=<?php echo $pagingprevious;?>" class="btn btn-secondary">Previous</a>
                <?php
                }
                ?>
                <a href="index.php?page=studentlist&paging=<?php echo $pagingnext;?>" class="btn btn-secondary">Next</a>
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
                              $cursor =$GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Students',$query);
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
                              $cursor =$GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Students',$query);
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
                              $cursor =$GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Students',$query);
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
                  $filter = ['SchoolID'=>$_SESSION["loggeduser_schoolID"]];
                  $options = ['sort' => ['ClassCategory' => 1]];
                  $query = new MongoDB\Driver\Query($filter,$options);
                  $cursor =$GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Classrooms',$query);
                  foreach ($cursor as $document)
                  {
                    $classid = strval($document->_id);
                    $ClassCategory = strval($document->ClassCategory);
                    $ClassName = strval($document->ClassName);
                   ?>
                    <div class="tab-pane fade" id="v-pills-<?php echo $classid;?>" role="tabpanel" aria-labelledby="v-pills-<?php echo $classid;?>-tab">
                      <div class="box" >
                        <strong>Total</strong>
                        <div class="table-responsive">
                        <table class="table table-sm">
                          <tr>
                            <th>Total</th>
                            <td>
                              <?php
                              $filter = ['Schools_id'=>$_SESSION["loggeduser_schoolID"],'Class_id'=>$classid];
                              $query = new MongoDB\Driver\Query($filter);
                              $cursor =$GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Students',$query);
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
                              $cursor =$GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Students',$query);
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
                              $cursor =$GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Students',$query);
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
                  </div>
                </div>
                <div class="col-4" style="border-left: solid 1px #eee;">
                  <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                    <a class="nav-link active btn-primary" id="v-pills-class-tab" data-bs-toggle="pill" href="#v-pills-class" role="tab" aria-controls="v-pills-class" aria-selected="true">All Students</a>
                    <?php
                    $calc = 0;
                    $filter = ['SchoolID'=>$_SESSION["loggeduser_schoolID"]];
                    $options = ['sort' => ['ClassCategory' => 1]];
                    $query = new MongoDB\Driver\Query($filter,$options);
                    $cursor =$GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Classrooms',$query);
                    foreach ($cursor as $document)
                    {
                      $calc = $calc + 1;
                      $classid = strval($document->_id);
                      $ClassCategory = strval($document->ClassCategory);
                      $ClassName = strval($document->ClassName);
                    ?>
                    <a class="nav-link btn-light text-dark" id="v-pills-<?php echo $classid;?>-tab" data-bs-toggle="pill" href="#v-pills-<?php echo $classid;?>" role="tab" aria-controls="v-pills-<?php echo $classid;?>" aria-selected="false"><?php echo $ClassCategory;echo $ClassName;?></a>
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
<?php include ('view/pages/modal-studentlist.php'); ?>
