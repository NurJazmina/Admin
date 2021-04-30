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
                  if($_SESSION["loggeduser_StaffLevel"]=='1') 
                  {
                  ?>
                    <button type="button" style="width:25%; color:#FFFFFF;" class="btn btn-info font-weight-bolder btn-sm" data-bs-toggle="modal" data-bs-target="#recheckaddparent" >Add</button>
                    <input  type="text" style="width:50%";  class="form-control" name="IDnumber" oninput="let p=this.selectionStart;this.value=this.value.toUpperCase();this.setSelectionRange(p, p);" placeholder="Search by ID/Name">
                    <button type="submit" style="width:25%; color:#FFFFFF;" class="btn btn-info font-weight-bolder btn-sm"" name="searchname" >Search</button>
                  <?php
                  } 
                  else
                  {
                  ?>
                    <input  type="text" style="width:75%";  class="form-control" name="IDnumber" oninput="let p=this.selectionStart;this.value=this.value.toUpperCase();this.setSelectionRange(p, p);" placeholder="Search by ID/Name">
                    <button type="submit" style="width:25%; color:#FFFFFF;" class="btn btn-info font-weight-bolder btn-sm"" name="searchname" >Search</button>
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
          <div class="table-responsive">
            <table id="demoGrid" class="table table-striped table-bordered dt-responsive nowrap table-sm" width="100%" cellspacing="0" style= "text-align: center;">
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
                    $ConsumerPassword = $document1->ConsumerPassword;
                    $options = ['cost' => 4,];
                    $password_hash = password_verify("zaq12wsx", $ConsumerPassword);
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
                  if($_SESSION["loggeduser_StaffLevel"]=='1') 
                  {
                  ?>
                    <button style="font-size:10px" type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#RecheckEditParent" data-bs-whatever="<?php echo $ConsumerIDNoParent; ?>">
                      <i class="fa fa-edit" style="font-size:15px"></i>
                    </button>
                    <button style="font-size:10px" type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#StatusParentModal" data-bs-whatever="<?php echo $parentid; ?>">
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
                  <a href="index.php?page=parentlist&paging=<?php echo $pagingprevious;?>" class="btn btn-secondary">Previous</a>
                <?php
                }
                ?>
                <a href="index.php?page=parentlist&paging=<?php echo $pagingnext;?>" class="btn btn-secondary">Next</a>
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
                <div class="col-9">
                  <div class="tab-content" id="v-pills-tabContent">
                    <div class="tab-pane fade show active" id="v-pills-staff" role="tabpanel" aria-labelledby="v-pills-home-tab">
                      <div class="box">
                        <strong>Total</strong>
                        <div class="table-responsive">
                        <table class="table table-striped table-sm">
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
