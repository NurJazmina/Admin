<?php
if (isset($_POST['submitaddclass']))
{
  $varschoolID = strval($_SESSION["loggeduser_schoolID"]);
  $varClasscategory = $_POST['txtClasscategory'];
  $varClassName = $_POST['txtclassname'];
  $varConsumerIDNo = $_POST['txtConsumerIDNo'];
  $varconsumerid = $_POST['txtconsumerid'];
  $bulk = new MongoDB\Driver\BulkWrite(['ordered' => TRUE]);
  $bulk->insert(['SchoolID'=>$varschoolID,'ClassCategory'=> $varClasscategory,'ClassName'=>$varClassName]);
  $writeConcern = new MongoDB\Driver\WriteConcern(MongoDB\Driver\WriteConcern::MAJORITY, 1000);
  try
  {
    $result = $GoNGetzDatabase->executeBulkWrite('GoNGetzSmartSchool.Classrooms', $bulk, $writeConcern);
  }
  catch (MongoDB\Driver\Exception\BulkWriteException $e)
  {
    $result = $e->getWriteResult();
    // Check if the write concern could not be fulfilled
    if ($writeConcernError = $result->getWriteConcernError())
    {
        printf("%s (%d): %s\n",
            $writeConcernError->getMessage(),
            $writeConcernError->getCode(),
            var_export($writeConcernError->getInfo(), true)
        );
    }
    // Check if any write operations did not complete at all
    foreach ($result->getWriteErrors() as $writeError)
    {
        printf("Operation#%d: %s (%d)\n",
            $writeError->getIndex(),
            $writeError->getMessage(),
            $writeError->getCode()
        );
    }
  }
  catch (MongoDB\Driver\Exception\Exception $e)
  {
    printf("Other error: %s\n", $e->getMessage());
    exit;
  }
  //call back class id
  $filter = ['SchoolID' => $_SESSION["loggeduser_schoolID"], 'ClassCategory'=>$varClasscategory ,'ClassName'=> $varClassName];
  $query = new MongoDB\Driver\Query($filter);
  $cursor = $GoNGetzSmartSchoolFrontEnd->executeQuery('GoNGetzSmartSchool.Classrooms',$query);

  foreach ($cursor as $document)
  {
    $idclass = strval($document->_id);
  }

  //insert class id into our staff database
  $bulk = new MongoDB\Driver\BulkWrite(['ordered' => TRUE]);
  $bulk->update(['ConsumerID'=> $varconsumerid],
                ['$set' => ['ClassID'=> $idclass]],
                ['upsert' => TRUE]
               );

  $writeConcern = new MongoDB\Driver\WriteConcern(MongoDB\Driver\WriteConcern::MAJORITY, 1000);
  try
  {
    $result =$GoNGetzDatabase->executeBulkWrite('GoNGetzSmartSchool.Staff', $bulk, $writeConcern);
  }
  catch (MongoDB\Driver\Exception\BulkWriteException $e)
  {
    $result = $e->getWriteResult();
    // Check if the write concern could not be fulfilled
    if ($writeConcernError = $result->getWriteConcernError())
    {
        printf("%s (%d): %s\n",
            $writeConcernError->getMessage(),
            $writeConcernError->getCode(),
            var_export($writeConcernError->getInfo(), true)
        );
    }
    foreach ($result->getWriteErrors() as $writeError)
    {
        printf("Operation#%d: %s (%d)\n",
            $writeError->getIndex(),
            $writeError->getMessage(),
            $writeError->getCode()
        );
    }
  }
  catch (MongoDB\Driver\Exception\Exception $e)
  {
    printf("Other error: %s\n", $e->getMessage());
    exit;
  }
}
?>
<?php
//Edit Class
if (isset($_POST['submiteditclass']))
{
  $varclassid = $_POST['txtclassid'];
  $varclassname = $_POST['txtclassname'];
  $varclasscategory = $_POST['txtclasscategory'];
  $bulk = new MongoDB\Driver\BulkWrite(['ordered' => TRUE]);
  $bulk->update(['_id'=>  new \MongoDB\BSON\ObjectID($varclassid)],
                ['$set' => ['ClassName'=>$varclassname , 'ClassCategory'=>$varclasscategory]],
                ['upsert' => TRUE]
               );
  $writeConcern = new MongoDB\Driver\WriteConcern(MongoDB\Driver\WriteConcern::MAJORITY, 1000);

  try
  {
    $result = $GoNGetzDatabase->executeBulkWrite('GoNGetzSmartSchool.Classrooms', $bulk, $writeConcern);
  }
  catch (MongoDB\Driver\Exception\BulkWriteException $e)
  {
    $result = $e->getWriteResult();
    // Check if the write concern could not be fulfilled
    if ($writeConcernError = $result->getWriteConcernError())
    {
        printf("%s (%d): %s\n",
            $writeConcernError->getMessage(),
            $writeConcernError->getCode(),
            var_export($writeConcernError->getInfo(), true)
        );
    }
    foreach ($result->getWriteErrors() as $writeError)
    {
        printf("Operation#%d: %s (%d)\n",
            $writeError->getIndex(),
            $writeError->getMessage(),
            $writeError->getCode()
        );
    }
  }
  catch (MongoDB\Driver\Exception\Exception $e)
  {
    printf("Other error: %s\n", $e->getMessage());
    exit;
  }
  printf("Matched: %d\n", $result->getMatchedCount());
  printf("Updated  %d document(s)\n", $result->getModifiedCount());
}
?>

<?php
//Delete Class
if (isset($_POST['DeleteclassFormSubmit']))
{
  $varclassid = $_POST['txtclassid'];
  $bulk = new MongoDB\Driver\BulkWrite;
  $bulk->delete(['_id'=> new \MongoDB\BSON\ObjectID($varclassid)], ['limit' => 1]);
  $writeConcern = new MongoDB\Driver\WriteConcern(MongoDB\Driver\WriteConcern::MAJORITY, 1000);
  try
  {
    $result = $GoNGetzDatabase->executeBulkWrite('GoNGetzSmartSchool.Classrooms', $bulk, $writeConcern);
  }
  catch (MongoDB\Driver\Exception\BulkWriteException $e)
  {
    $result = $e->getWriteResult();
    // Check if the write concern could not be fulfilled
    if ($writeConcernError = $result->getWriteConcernError())
    {
        printf("%s (%d): %s\n",
            $writeConcernError->getMessage(),
            $writeConcernError->getCode(),
            var_export($writeConcernError->getInfo(), true)
        );
    }
    // Check if any write operations did not complete at all
    foreach ($result->getWriteErrors() as $writeError)
    {
        printf("Operation#%d: %s (%d)\n",
            $writeError->getIndex(),
            $writeError->getMessage(),
            $writeError->getCode()
        );
    }
  }
  catch (MongoDB\Driver\Exception\Exception $e)
  {
    printf("Other error: %s\n", $e->getMessage());
    exit;
  }
}
?>

<?php
  if (isset($_GET['paging']) && !empty($_GET['paging']))
  {
    $datapaging = ($_GET['paging']*50);
    $pagingprevious = $_GET['paging']-1;
    $pagingnext = $_GET['paging']+1;
  }
else
  {
    $datapaging = 0;
  }

  if (!isset($_POST['searchclass']) && empty($_POST['searchclass']))
  {
    if (!isset($_GET['level']) && empty($_GET['level']))
    {
    $filter = ['SchoolID' => $_SESSION["loggeduser_schoolID"]];
    $option = ['limit'=>50,'skip'=>$datapaging,'sort' => ['_id' => -1]];
    $query = new MongoDB\Driver\Query($filter,$option);
    $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Classrooms',$query);
    }
    else
    {
    $sort = ($_GET['level']);
    $filter = ['SchoolID' => $_SESSION["loggeduser_schoolID"],
              'ClassCategory'=>$sort
              ];
    $option = ['limit'=>50,'skip'=>$datapaging,'sort' => ['_id' => -1]];
    $query = new MongoDB\Driver\Query($filter,$option);
    $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Classrooms',$query);
    }
  }
  else
  {
    $classname = ($_POST['classname']);
    $filter = ['SchoolID' => $_SESSION["loggeduser_schoolID"],'ClassName'=>$classname];
    $query = new MongoDB\Driver\Query($filter);
    $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Classrooms',$query);
  }
?>
<div class="row">
  <div class="col-12 col-sm-12 col-lg-6">
    <div class="col-12 col-sm-6 col-lg-6">
      <br><h1 style="color:#404040;">Classroom List</h1>
    </div>
  </div>
  <div class="col-12 col-sm-12 col-sm-6">
    <div class="card">
      <div class="card-body">
        <form name="searchclass" class="form-inline" action="index.php?page=classroomlist" method="post">
          <div class="col-12 col-sm-6 col-lg-6 text-right">
            <div class="form-group row">
              <button type="button" style="width:25%"; class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#recheckaddclass">Add</button>
              <input type="text" style="width:50%";  class="form-control" name="classname" oninput="let p=this.selectionStart;this.value=this.value.toUpperCase();this.setSelectionRange(p, p);" placeholder="search by classroom name">
              <button type="submit" style="width:25%"; name="searchclass" class="btn btn-secondary">Search</button>
            </div>
          </div>
        </form>
      </div>
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
        <div class="btn-group sort-btn">
          <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Sort by </button>
          <ul class="dropdown-menu">
            <li class="dropdown-item"><a href="index.php?page=classroomlist" tabindex="-1" data-type="alpha" style="color:#076d79; text-decoration: none;">All</a></li>
            <li class="dropdown-item"><a href="index.php?page=classroomlist&level=<?php echo "1"; ?>" tabindex="-1" data-type="alpha" style="color:#076d79; text-decoration: none;">category 1</a></li>
            <li class="dropdown-item"><a href="index.php?page=classroomlist&level=<?php echo "2"; ?>" tabindex="-1" data-type="alpha" style="color:#076d79; text-decoration: none;">category 2</a></li>
            <li class="dropdown-item"><a href="index.php?page=classroomlist&level=<?php echo "3"; ?>" tabindex="-1" data-type="alpha" style="color:#076d79; text-decoration: none;">category 3</a></li>
            <li class="dropdown-item"><a href="index.php?page=classroomlist&level=<?php echo "4"; ?>" tabindex="-1" data-type="alpha" style="color:#076d79; text-decoration: none;">category 4</a></li>
            <li class="dropdown-item"><a href="index.php?page=classroomlist&level=<?php echo "5"; ?>" tabindex="-1" data-type="alpha" style="color:#076d79; text-decoration: none;">category 5</a></li>
            <li class="dropdown-item"><a href="index.php?page=classroomlist&level=<?php echo "6"; ?>" tabindex="-1" data-type="alpha" style="color:#076d79; text-decoration: none;">category 6</a></li>
          </ul>
        </div>
          <div class="table-responsive" style="width:100%; margin:0 auto;">
            <table id="demoGrid" class="table table-striped table-bordered dt-responsive nowrap table-sm" width="100%" cellspacing="0" style= "text-align: center;">
              <thead>
                <tr>
                  <th scope="col">Teacher</th>
                  <th scope="col">Class name</th>
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
                      $ConsumerFName = ($document2->ConsumerFName);
                      $ConsumerPhone = ($document2->ConsumerPhone);
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
                  <td><?php echo $totalstudent; ?></td>
                  <td><button type="button" style="font-size:15px width:25%" class="btn btn-info"><a href="index.php?page=exportclassattendance&id=<?php echo $idclass; ?>" style="color:#FFFFFF; text-decoration: none;">more >></a></button></td>
                  <td>
                  <button style="font-size:10px" type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#recheckeditclass" data-bs-whatever="<?php echo $idclass; ?>">
                    <i class="fa fa-edit" style="font-size:15px"></i>
                  </button>
                  <button style="font-size:10px" type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#DeleteclassModal" data-bs-whatever="<?php echo $idclass; ?>">
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
                if (isset($_GET['paging']) && !empty($_GET['paging'])){
                  if ($_GET['paging'=='0']) {
                    $pagingprevious = '0';
                  }
                } else {
                  $pagingprevious = "0";
                }
                ?>
                <?php
                if ($pagingprevious == "0") {
                  ?>
                  <span class="btn btn-secondary">Previous</span>
                <?php
                } else {
                  ?>
                  <a href="index.php?page=classroomlist&paging=<?php echo $pagingprevious;?>" class="btn btn-secondary">Previous</a>
                <?php
                }
                ?>
                <a href="index.php?page=classroomlist&paging=<?php echo $pagingnext;?>" class="btn btn-secondary">Next</a>
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
                <div class="col-9">
                  <div class="tab-content" id="v-pills-tabContent">
                    <!--Tab by all class -->
                    <div class="tab-pane fade show active" id="v-pills-class" role="tabpanel" aria-labelledby="v-pills-class-tab">
                      <div class="box">
                        <strong>Total</strong>
                        <div class="table-responsive">
                        <table class="table table-striped table-sm">
                          <tr>
                            <th>Total</th>
                            <td>
                              <?php
                              $filter = ['SchoolID'=>$_SESSION["loggeduser_schoolID"]];
                              $query = new MongoDB\Driver\Query($filter);
                              $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Classrooms',$query);
                              $totalschool = 0;
                              foreach ($cursor as $document)
                              {
                                $totalschool = $totalschool + 1;
                              }
                              echo $totalschool; ?>
                            </td>
                          </tr>
                          <tr>
                            <th>Active</th>
                            <td>
                              <?php
                              $filter = ['SchoolID'=>$_SESSION["loggeduser_schoolID"], 'SchoolsStatus'=>'ACTIVE'];
                              $query = new MongoDB\Driver\Query($filter);
                              $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Classrooms',$query);
                              $totalschool = 0;
                              foreach ($cursor as $document)
                              {
                                $totalschool = $totalschool + 1;
                              }
                              echo $totalschool;
                              ?>
                            </td>
                          </tr>
                          <tr>
                            <th>Inactive</th>
                            <td>
                              <?php
                              $filter = ['SchoolID'=>$_SESSION["loggeduser_schoolID"], 'SchoolsStatus'=>'INACTIVE'];
                              $query = new MongoDB\Driver\Query($filter);
                              $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Classrooms',$query);
                              $totalschool = 0;
                              foreach ($cursor as $document)
                              {
                                $totalschool = $totalschool + 1;
                              }
                              echo $totalschool;
                              ?>
                            </td>
                          </tr>
                        </table>
                      </div>
                    </div>
                    <div class="box">
                        <strong>Remarks</strong>
                        <table class="table table-striped table-sm">
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
                    <div class="tab-pane fade" id="v-pills-<?php echo $ClassName; echo $ClassCategory;?>" role="tabpanel" aria-labelledby="v-pills-<?php echo $ClassName; echo $ClassCategory;?>-tab">
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
                    <?php
                    }
                    ?>
                    <!-- End tab -->
                    <div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">...</div>
                  </div>
                </div>
                <div class="col-3" style="border-left: solid 1px #eee;">
                  <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                    <a class="nav-link active btn-secondary" id="v-pills-class-tab" data-bs-toggle="pill" href="#v-pills-class" role="tab" aria-controls="v-pills-class" aria-selected="true">All Class</a>
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
                    <a class="nav-link btn-secondary" id="v-pills-<?php echo $ClassName; echo $ClassCategory;?>-tab" data-bs-toggle="pill" href="#v-pills-<?php echo $ClassName; echo $ClassCategory;?>" role="tab" aria-controls="v-pills-<?php echo $ClassName; echo $ClassCategory;?>" aria-selected="false"><?php  echo $ClassCategory; echo "  "; echo $ClassName; ?></a>
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
<?php include ('view/modal-addclass.php'); ?>
<?php include ('view/modal-editclass.php'); ?>
<?php include ('view/modal-deleteclass.php'); ?>
<script>
  var recheckaddclass = document.getElementById('recheckaddclass')
  recheckaddclass.addEventListener('show.bs.modal', function (event) {
  // Button that triggered the modal
  var button = event.relatedTarget
  // Extract info from data-bs-* attributes
  var recipient = button.getAttribute('data-bs-whatever')
  // If necessary, you could initiate an AJAX request here
  // and then do the updating in a callback.
  //
  // Update the modal's content.
  var modalTitle = recheckaddclass.querySelector('.modal-title')
  var modalBodyInput = recheckaddclass.querySelector('.modal-body input')
  modalBodyInput.value = recipient
  })
</script>
<script>
  var recheckeditclass = document.getElementById('recheckeditclass')
  recheckeditclass.addEventListener('show.bs.modal', function (event) {
  // Button that triggered the modal
  var button = event.relatedTarget
  // Extract info from data-bs-* attributes
  var recipient = button.getAttribute('data-bs-whatever')
  // If necessary, you could initiate an AJAX request here
  // and then do the updating in a callback.
  //
  // Update the modal's content.
  var modalTitle = recheckeditclass.querySelector('.modal-title')
  var modalBodyInput = recheckeditclass.querySelector('.modal-body input')
  modalBodyInput.value = recipient
  })
</script>
<script>
  var DeleteclassModal = document.getElementById('DeleteclassModal')
  DeleteclassModal.addEventListener('show.bs.modal', function (event) {
  // Button that triggered the modal
  var button = event.relatedTarget
  // Extract info from data-bs-* attributes
  var recipient = button.getAttribute('data-bs-whatever')
  // If necessary, you could initiate an AJAX request here
  // and then do the updating in a callback.
  //
  // Update the modal's content.
  var modalTitle = DeleteclassModal.querySelector('.modal-title')
  var modalBodyInput = DeleteclassModal.querySelector('.modal-body input')
  modalBodyInput.value = recipient
  })
</script>
