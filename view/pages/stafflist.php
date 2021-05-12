<style>
.nav-link {
color: white !important;
border:1px solid #ffffff;
}
</style>
<?php include ('model/stafflist.php'); ?>
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
					<h5 class="text-dark font-weight-bold my-1 mr-5">Staff</h5>
					<!--end::Page Title-->
				</div>
        <!--begin::Separator-->
        <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-5 bg-gray-200"></div>
        <!--end::Separator-->
        <!--begin::Detail-->
        <div class="d-flex align-items-center" id="kt_subheader_search">
        <?php 
        $school = $_SESSION["totalstaff"] + $_SESSION["totalteacher"];
        ?>
        <span class="text-dark-50 font-weight-bold" id="kt_subheader_total"><?php echo $school; ?> Total Staff</span>
        </div>
        <!--end::Detail-->
				<!--end::Page Heading-->
			</div>
			<!--end::Info-->
			<!--begin::Toolbar-->
			<div class="d-flex align-items-center">
        <div class="col-12 col-sm-12 col-sm-12">
              <form name="searchstaff" class="form-inline" action="index.php?page=stafflist" method="post">
                <div class="col-12 col-sm-12 col-lg-12 text-right">
                  <div class="row">
                  <?php 
                  if($_SESSION["loggeduser_ACCESS"] =='STAFF') 
                  {
                  ?>
                    <button type="button" style="width:20%;" class="btn btn-success font-weight-bolder btn-sm"><a href="index.php?page=exportstaffattendance" style="color:#FFFFFF; text-decoration: none;">ATTENDANCE</a></button>
                    <button type="button" style="width:20%;" class="btn btn-success font-weight-bolder btn-sm" data-bs-toggle="modal" data-bs-target="#recheckaddstaff" >Add</button>
                    <div class="input-group input-group-sm input-group-solid" style="width:40%">
                      <input  type="text" style="";  id="kt_subheader_search_form"  class="form-control" name="IDnumber" oninput="let p=this.selectionStart;this.value=this.value.toUpperCase();this.setSelectionRange(p, p);" placeholder="Search by ID/Name">
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
                    <button type="submit" style="width:20%;" class="btn btn-success font-weight-bolder btn-sm" name="searchstaff" >Search</button>
                  <?php
                  } 
                  else
                  {
                  ?>
                    <div class="input-group input-group-sm input-group-solid" style="width:75%">
                      <input  type="text" style="";  id="kt_subheader_search_form"  class="form-control" name="IDnumber" oninput="let p=this.selectionStart;this.value=this.value.toUpperCase();this.setSelectionRange(p, p);" placeholder="Search by ID/Name">
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
                    <button type="submit" style="width:25%;" class="btn btn-success font-weight-bolder btn-sm" name="searchstaff" >Search</button>
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
      <br><h1 style="color:#404040;">Staff List</h1>
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
            <li class="dropdown-item"><a href="index.php?page=stafflist" tabindex="-1" data-type="alpha" style="color:#076d79; text-decoration: none;">All</a></li>
            <li class="dropdown-item"><a href="index.php?page=stafflist&level=<?php echo "1"; ?>" tabindex="-1" data-type="alpha" style="color:#076d79; text-decoration: none;">Staff</a></li>
            <li class="dropdown-item"><a href="index.php?page=stafflist&level=<?php echo "0"; ?>" tabindex="-1" data-type="alpha" style="color:#076d79; text-decoration: none;">Teacher</a></li>
          </ul>
        <br><br>
          <div class="table-responsive" style="width:100%; margin:0 auto;">
            <table id="example" class="table table-bordered dt-responsive nowrap table-sm" width="100%" cellspacing="0" style= "text-align: center;">
              <thead>
                <tr>
                  <th scope="col">Name</th>
                  <th scope="col">IC</th>
                  <th scope="col">Address</th>
                  <th scope="col">Phone</th>
                  <th scope="col">Staff Department
                  <th colspan="2">Class Name</th>
                  <th scope="col">Status</th>
                  <th scope="col">Update</th>
                </tr>
              </thead>
              <tbody>
              <?php
              foreach ($cursor as $document)
              {
               $StaffLevel = strval($document->StaffLevel);
               $Staffdepartment = strval($document->Staffdepartment);
               $iddepartment = new \MongoDB\BSON\ObjectId($Staffdepartment);
               $ClassID = $document->ClassID;
               $StaffStatus = $document->StaffStatus;

               $ConsumerID = $document->ConsumerID;
               $bid = new \MongoDB\BSON\ObjectId($ConsumerID);
               $filter1 = ['_id'=>$bid];
               $query1 = new MongoDB\Driver\Query($filter1);
               $cursor1 = $GoNGetzDatabase->executeQuery('GoNGetz.Consumer',$query1);

                foreach ($cursor1 as $document1)
                {
                  $varconsumerid = $document1->_id;
                  $ConsumerFName = $document1->ConsumerFName;
                  $ConsumerLName = $document1->ConsumerLName;
                  $ConsumerIDNo = $document1->ConsumerIDNo;
                  $ConsumerAddress = $document1->ConsumerAddress;
                  $ConsumerPhone = $document1->ConsumerPhone;
                  ?>
                  <tr bgcolor="white">
                    <td><a href="index.php?page=staffdetail&id=<?php echo $varconsumerid; ?>" style="color:#076d79; text-decoration: none;"><?php echo $ConsumerFName." ".$ConsumerLName;?></a>
                    <div class="table-responsive">
                    <table class="table table-striped table-sm" width="100%" cellspacing="0" style= "text-align: center;">
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
                    $filter = ['_id'=>new \MongoDB\BSON\ObjectId($varconsumerid)];
                    $query = new MongoDB\Driver\Query($filter);
                    $cursor = $GoNGetzDatabase->executeQuery('GoNGetz.Consumer',$query);

                    foreach ($cursor as $document)
                    {
                      $consumerid = strval($document->_id);
                      $filter1 = ['Consumer_id'=>$consumerid];
                      $query1 = new MongoDB\Driver\Query($filter1);
                      $cursor1 = $GoNGetzDatabase->executeQuery('GoNGetz.Cards',$query1);
                      foreach ($cursor1 as $document1)
                      {
                        $Cards_id = strval($document1->Cards_id);
                      }
                    }
                    $today = new MongoDB\BSON\UTCDateTime((new DateTime($varnow))->getTimestamp()*1000);
                    $varcount = 0;
                    $filterA = ['CardID'=>$Cards_id, 'AttendanceDate' => ['$gte' => $today]];
                    $queryA = new MongoDB\Driver\Query($filterA);
                    $cursorA = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Attendance',$queryA);
                    $varcounting = 0;
                      foreach ($cursorA as $documentA)
                        {
                          $varcounting = $varcounting +1;
                          if ($varcounting % 2){
                            echo"<br>";
                            $displayinout = "In: ";
                          } else {
                            $displayinout = " | Out: ";
                          }
                          $AttendanceDate = ($documentA->AttendanceDate);
                          if (!isset($datecapture) && empty($datecapture)) {
                            $datecapture = $AttendanceDate;
                          }
                          $utcdatetime = new MongoDB\BSON\UTCDateTime(strval($AttendanceDate));
                          $AttendanceDate = $utcdatetime->toDateTime()->setTimezone(new \DateTimeZone(date_default_timezone_get()));
                          if ($datecapture!=$AttendanceDate) {
                          echo $displayinout . date_format($AttendanceDate,"h:i:sa");
                          }
                        }
                        ?>
                        </tr>
                        </table>
                        <br>
                        <?php
                        if($_SESSION["loggeduser_ACCESS"] =='TEACHER') 
                        {
                        ?>
                        <button type="button" style="font-size:15px width:25%" class="btn btn-info"><a href="index.php?page=exportstaffattendance&id=<?php echo $varconsumerid; ?>" style="color:#FFFFFF; text-decoration: none;"> More >></a></button>
                        <?php
                        }
                        ?>
                        </td>
                        </table>
                        </div>
                        </td>
                        <td><?php print_r($ConsumerIDNo);?></td>
                        <td><?php print_r($ConsumerAddress); ?></td>
                        <td><?php print_r($ConsumerPhone); ?></td>
                        <td>
                        <?php
                        $filter = ['School_id'=>$_SESSION["loggeduser_schoolID"], '_id'=>$iddepartment];
                        $query = new MongoDB\Driver\Query($filter);
                        $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.SchoolsDepartment',$query);
                        foreach ($cursor as $document)
                        {
                          $departmentid = strval($document->_id);
                          $DepartmentName = strval($document->DepartmentName);
                          ?>
                          <a href="index.php?page=departmentdetail&id=<?php echo $departmentid ; ?>" style="color:#076d79; text-decoration: none;"><?php print_r($DepartmentName); ?></a>
                          <?php
                        }
                          if ($ClassID !== "")
                          {
                            $idclass = new \MongoDB\BSON\ObjectId($ClassID);
                            $filter2 = ['SchoolID'=>$_SESSION["loggeduser_schoolID"], '_id'=>$idclass];
                            $query2 = new MongoDB\Driver\Query($filter2);
                            $cursor2 = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Classrooms',$query2);

                          foreach ($cursor2 as $document2)
                          {
                            if ($StaffLevel == "0")
                            {
                            ?>
                            </td>
                            <td>
                              <?php print_r($document2->ClassName);?>
                            </td>
                            <td>
                            <?php
                            if($_SESSION["loggeduser_ACCESS"] =='STAFF') 
                            {
                            ?>
                              <button style="font-size:10px" type="button" class="btn btn-light btn-hover-primary" data-bs-toggle="modal" data-bs-target="#recheckeditstaff" data-bs-whatever="<?php echo $varconsumerid; ?>">
                                <i class="fa fa-edit" style="font-size:15px"></i>
                              </button>
                            <?php
                            }
                            ?>
                            </td>
                            <?php
                            }
                            else
                            {
                              ?>
                              <td></td>
                              <td></td>
                              <?php
                            }
                          }
                          }
                          else
                          {
                            if ($StaffLevel == "0")
                            {
                            ?>
                            <td></td>
                            <td>
                            <?php
                            if($_SESSION["loggeduser_ACCESS"] =='STAFF') 
                            {
                            ?>
                              <button style="font-size:10px" type="button" class="btn btn-light btn-hover-primary" data-bs-toggle="modal" data-bs-target="#recheckeditstaff" data-bs-whatever="<?php echo $varconsumerid; ?>">
                                <i class="fa fa-edit" style="font-size:15px"></i>
                              </button>
                            <?php
                            }
                            ?>
                            </td>
                            <?php
                            }
                            else
                            {
                              ?>
                              <td></td>
                              <td></td>
                              <?php
                            }
                          }
                            ?>
                            <td><?php if(($StaffStatus) == "ACTIVE") {echo " <font color=green> ACTIVE";} else {echo " <font color=red> INACTIVE";}; ?></td>
                            <td>
                            <?php
                            if($_SESSION["loggeduser_ACCESS"] =='STAFF') 
                            {
                            ?>
                            <button style="font-size:10px" type="button" class="btn btn-light btn-hover-primary" data-bs-toggle="modal" data-bs-target="#StatusStaffModal" data-bs-whatever="<?php echo $varconsumerid; ?>">
                                <i class="fas fa-exchange-alt" style="font-size:15px" ></i>
                            </button>
                            <?php
                            }
                            ?>
                            </td>
                          </tr>
                          <?php
                           }
                          }
                          ?>
                          </tbody>
                        </table>
                      </div>
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
                              <a href="index.php?page=timetablelist&paging=<?php echo $pagingprevious;?>" class="btn btn-success font-weight-bolder btn-sm">Previous</a>
                            <?php
                            }
                          }
                          ?>
                          <a href="index.php?page=timetablelist&paging=<?php echo $pagingnext;?>" class="btn btn-success font-weight-bolder btn-sm">Next</a>
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
                          <div class="col-7">
                            <div class="tab-content" id="v-pills-tabContent">
                            
                              <!--tab all department -->
                              <div class="tab-pane fade show active" id="v-pills-staff" role="tabpanel" aria-labelledby="v-pills-staff-tab">
                                <div class="box" >
                                  <strong>Total</strong>
                                  <div class="table-responsive">
                                  <table class="table table-sm">
                                    <tr>
                                      <th>Total</th>
                                      <td>
                                        <?php
                                        $filter = ['SchoolID'=>$_SESSION["loggeduser_schoolID"]];
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
                                        $filter = ['SchoolID'=>$_SESSION["loggeduser_schoolID"], 'StaffStatus'=>'ACTIVE'];
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
                                        $filter = ['SchoolID'=>$_SESSION["loggeduser_schoolID"], 'StaffStatus'=>'INACTIVE'];
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
                              <!--end tab -->
                              <!--tab by department -->
                              <?php
                              $filter = ['School_id'=>$_SESSION["loggeduser_schoolID"]];
                              $query = new MongoDB\Driver\Query($filter);
                              $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.SchoolsDepartment',$query);
                              foreach ($cursor as $document)
                              {
                                $departmentid = strval($document->_id);
                                $DepartmentName = strval($document->DepartmentName);
                                ?>
                                <div class="tab-pane fade" id="v-pills-department<?php echo $departmentid;?>" role="tabpanel" aria-labelledby="v-pills-department<?php echo $departmentid;?>-tab">
                                  <div class="box" >
                                    <strong>Total</strong>
                                    <div class="table-responsive">
                                    <table class="table table-sm">
                                      <tr>
                                        <th>Total</th>
                                        <td>
                                          <?php
                                          $filter = ['SchoolID'=>$_SESSION["loggeduser_schoolID"],'Staffdepartment'=>$departmentid];
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
                                          $filter = ['SchoolID'=>$_SESSION["loggeduser_schoolID"],'Staffdepartment'=>$departmentid,'StaffStatus'=>'ACTIVE'];
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
                                          $filter = ['SchoolID'=>$_SESSION["loggeduser_schoolID"],'Staffdepartment'=>$departmentid,'StaffStatus'=>'INACTIVE'];
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
                              <!-- end tab -->
                            </div>
                          </div>
                          <div class="col-5" style="border-left: solid 1px #eee;">
                            <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                              <a class="nav-link bg-success font-weight-bolder btn-sm" id="v-pills-staff-tab"  data-bs-toggle="pill" href="#v-pills-staff" role="tab" aria-controls="v-pills-staff" aria-selected="true">STAFF</a>
                              <?php
                              $calc = 0;
                              $filter = ['School_id'=>$_SESSION["loggeduser_schoolID"]];
                              $query = new MongoDB\Driver\Query($filter);
                              $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.SchoolsDepartment',$query);
                              foreach ($cursor as $document)
                              {
                                $calc = $calc + 1;
                                $departmentid = strval($document->_id);
                                $DepartmentName = strval($document->DepartmentName);
                              ?>
                              <a class="nav-link bg-success font-weight-bolder btn-sm" id="v-pills-department<?php echo $departmentid;?>-tab" data-bs-toggle="pill" href="#v-pills-department<?php echo $departmentid;?>" role="tab" aria-controls="v-pills-department<?php echo $departmentid;?>" aria-selected="false"><?php echo $DepartmentName; ?></a>
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
            </div>
<?php include ('view/pages/modal-stafflist.php'); 