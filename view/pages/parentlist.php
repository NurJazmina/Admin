<?php include ('model/parentlist.php'); ?>
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
					<h5 class="text-dark font-weight-bold my-1 mr-5">Parent</h5>
					<!--end::Page Title-->
				</div>
        <!--begin::Separator-->
        <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-5 bg-gray-200"></div>
        <!--end::Separator-->
        <!--begin::Detail-->
        <div class="d-flex align-items-center" id="kt_subheader_search">
        <?php 
        $parent = $_SESSION["totalparent"];
        ?>
        <span class="text-dark-50 font-weight-bold" id="kt_subheader_total"><?php echo $parent; ?> Total Parent</span>
        </div>
        <!--end::Detail-->
				<!--end::Page Heading-->
			</div>
			<!--end::Info-->
			<!--begin::Toolbar-->
			<div class="d-flex align-items-center">
        <div class="col-12 col-sm-12 col-sm-12">
              <form name="searchparent" class="form-inline" action="index.php?page=parentlist" method="post">
                <div class="col-12 col-sm-12 col-lg-12 text-right">
                  <div class="row">
                  <?php 
                  if($_SESSION["loggeduser_ACCESS"] =='STAFF') 
                  {
                  ?>
                    <button type="button" style="width:25%;" class="btn btn-success font-weight-bolder btn-sm" data-bs-toggle="modal" data-bs-target="#recheckaddparent">Add</button>
                    <div class="input-group input-group-sm input-group-solid" style="width:50%">
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
                    <button type="submit" style="width:25%; " class="btn btn-success font-weight-bolder btn-sm"" name="searchname">Search</button>
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
                    <button type="submit" style="width:25%;" class="btn btn-success font-weight-bolder btn-sm" name="searchname">Search</button>
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
      <br><h1 style="color:#404040;">Parent List</h1>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-12 col-lg-9">
    <div class="card">
        <div class="card-header">
          <strong>List</strong>
        </div>
        <div class="card-body">
          <div class="table-responsive" style="width:100%; margin:0 auto;">
            <table id="demoGrid" class="table table-bordered dt-responsive nowrap table-sm" width="100%" cellspacing="0" style= "text-align: center;">
              <thead>
                <tr>
                  <th scope="col">Name</th>
                  <th scope="col">Phone</th>
                  <th scope="col">ID Type</th>
                  <th scope="col">IC No</th>
                  <th scope="col">Son/Daughter</th>
                  <th scope="col">Total Child</th>
                  <th scope="col">Relation</th>
                  <th scope="col">Status</th>
                  <th scope="col">Update</th>
                </tr>
              </thead>
              <tbody>
              <?php
                foreach ($cursor as $document)
                {
                  $count = 0;
                  $parentid = strval($document->_id);
                  $ConsumerID = strval($document->ConsumerID);
                  $ParentStatus = strval($document->ParentStatus);
                  $consumeridparent = new \MongoDB\BSON\ObjectId($ConsumerID);
                  $filter1 = ['_id'=>$consumeridparent];
                  $query1 = new MongoDB\Driver\Query($filter1);
                  $cursor1 = $GoNGetzDatabase->executeQuery('GoNGetz.Consumer',$query1);
                  foreach ($cursor1 as $document1)
                  {
                    $ConsumerFName = $document1->ConsumerFName;
                    $ConsumerLName = $document1->ConsumerLName;
                    $ConsumerIDType = $document1->ConsumerIDType;
                    $ConsumerIDNoParent = $document1->ConsumerIDNo;
                    $ConsumerEmail = $document1->ConsumerEmail;
                    $ConsumerPhone = $document1->ConsumerPhone;
                    ?>
                    <tr>
                    <td><a href="index.php?page=parentdetail&id=<?php echo $ConsumerID; ?>" style="color:#076d79; text-decoration: none;"><?php echo $ConsumerFName." ".$ConsumerLName;?></a></td>
                    <td><?php print_r($ConsumerPhone);?></td>
                    <td><?php print_r($ConsumerIDType);?></td>
                    <td><?php print_r($ConsumerIDNoParent);?></td>
                    <td>
                    <?php
                  }
                  $filter2 = ['Schools_id'=>$_SESSION["loggeduser_schoolID"], 'ParentID'=>$parentid];
                  $query2 = new MongoDB\Driver\Query($filter2);
                  $cursor2 = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.ParentStudentRel',$query2);
                  foreach ($cursor2 as $document2)
                  {
                    $totalchild = $count + 1;
                    $ParentID = strval($document2->ParentID);
                    $StudentID = strval($document2->StudentID);
                    $ParentStudentRelation = strval($document2->ParentStudentRelation);
                    $studentid = new \MongoDB\BSON\ObjectId($StudentID);
                    $filter3 = ['_id'=>$studentid];
                    $query3 = new MongoDB\Driver\Query($filter3);
                    $cursor3 = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Students',$query3);

                    foreach ($cursor3 as $document3)
                    {
                      $Consumer_id = strval($document3->Consumer_id);
                      $consumeridstudent = new \MongoDB\BSON\ObjectId($Consumer_id);
                      $filter4 = ['_id'=>$consumeridstudent];
                      $query4 = new MongoDB\Driver\Query($filter4);
                      $cursor4 = $GoNGetzDatabase->executeQuery('GoNGetz.Consumer',$query4);
                      foreach ($cursor4 as $document4)
                      {
                        $studentid = $document4->_id;
                        $studentFName = $document4->ConsumerFName;
                        $studentLName = $document4->ConsumerLName;
                        ?>
                        <a href="index.php?page=studentdetail&id=<?php echo $studentid; ?>" style="color:#076d79; text-decoration: none;">
                        <?php
                        echo $studentFName." ".$studentLName;
                        ?>
                        </a>
                        <?php
                        echo "<br>";
                      }
                    }
                  }
                  ?>
                  </td>
                  <td><?php print_r($totalchild);?></td>
                  <td><?php print_r($ParentStudentRelation);?></td>
                  <td><?php if(($ParentStatus) == "ACTIVE") {echo " <font color=green> ACTIVE";} else {echo " <font color=red> INACTIVE";}; ?></td>
                  <td>
                  <?php
                  if($_SESSION["loggeduser_ACCESS"] =='STAFF') 
                  {
                  ?>
                    <button style="font-size:10px" type="button" class="btn btn-light btn-hover-success btn-sm" data-bs-toggle="modal" data-bs-target="#RecheckEditParent" data-bs-whatever="<?php echo $ConsumerIDNoParent; ?>">
                      <i class="fa fa-edit" style="font-size:15px"></i>
                    </button>
                    <button style="font-size:10px" type="button" class="btn btn-light btn-hover-success btn-sm" data-bs-toggle="modal" data-bs-target="#StatusParentModal" data-bs-whatever="<?php echo $ConsumerID; ?>">
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
                  if ($_GET['paging'] == 0) 
                  {
                    ?>
                    <span class="btn btn-secondary">Previous</span>
                    <?php
                  } 
                  else 
                  {
                    ?>
                    <a href="index.php?page=parentlist&paging=<?php echo $pagingprevious;?>" class="btn btn-success font-weight-bolder btn-sm">Previous</a>
                    <?php
                  }
                }
                ?>
                <a href="index.php?page=parentlist&paging=<?php echo $pagingnext;?>" class="btn btn-success font-weight-bolder btn-sm">Next</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-12 col-lg-3">
      <div class="row">
        <div class="col-12 col-lg-12">
          <div class="card">
            <div class="card-header">
              <strong>Latest Summary</strong>
            </div>
            <div class="card-body">
              <div class="row">
                <div class="col-12">
                  <div class="tab-content" id="v-pills-tabContent">
                    <div class="tab-pane fade show active" id="v-pills-staff" role="tabpanel" aria-labelledby="v-pills-home-tab">
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
                              $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Parents',$query);
                              $totalparent = 0;
                              foreach ($cursor as $document)
                              {
                                $totalparent = $totalparent + 1;
                              }
                              echo $totalparent;
                              ?>
                            </td>
                          </tr>
                          <tr>
                            <th>Active</th>
                            <td>
                              <?php
                              $filter = ['Schools_id'=>$_SESSION["loggeduser_schoolID"],'ParentStatus'=>'ACTIVE'];
                              $query = new MongoDB\Driver\Query($filter);
                              $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Parents',$query);
                              $totalparent = 0;
                              foreach ($cursor as $document)
                              {
                                $totalparent = $totalparent + 1;
                              }
                              echo $totalparent;
                              ?>
                            </td>
                          </tr>
                          <tr>
                            <th>Inactive</th>
                            <td>
                              <?php
                              $filter = ['Schools_id'=>$_SESSION["loggeduser_schoolID"],  'ParentStatus'=>'INACTIVE'];
                              $query = new MongoDB\Driver\Query($filter);
                              $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Parents',$query);
                              $totalparent = 0;
                              foreach ($cursor as $document)
                              {
                                $totalparent = $totalparent + 1;
                              }
                              echo $totalparent;
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
                    <div class="tab-pane fade" id="v-pills-department" role="tabpanel" aria-labelledby="v-pills-department-tab">...</div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
     </div>
    </div>
<?php include ('view/pages/modal-parentlist.php'); ?>