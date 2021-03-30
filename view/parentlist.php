<!-- Add parent -->
<?php
if (isset($_POST['submitaddparent']))
{
  //add parent
  $varschoolID = strval($_SESSION["loggeduser_schoolID"]);
  $varConsumerIDNo = $_POST['txtConsumerIDNo'];
  $filter = ['ConsumerIDNo'=>$varConsumerIDNo];
  $query = new MongoDB\Driver\Query($filter);
  $cursor = $GoNGetzDatabase->executeQuery('GoNGetz.Consumer',$query);

  foreach ($cursor as $document)
  {
  $ID = strval($document->_id);
  $ConsumerFName = strval($document->ConsumerFName);
  $varParentRegDate = new MongoDB\BSON\UTCDateTime((new DateTime('now'))->getTimestamp()*1000);
  $bulk = new MongoDB\Driver\BulkWrite(['ordered' => TRUE]);
  $bulk->insert(['ConsumerID'=>$ID,'Schools_id'=> $varschoolID,'ParentStatus'=> "ACTIVE",'ParentAddDate'=>$varParentRegDate]);
  $writeConcern = new MongoDB\Driver\WriteConcern(MongoDB\Driver\WriteConcern::MAJORITY, 1000);
  try
  {
    $result = $GoNGetzDatabase->executeBulkWrite('GoNGetzSmartSchool.Parents', $bulk, $writeConcern);
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
  //add student
  $varConsumerIDNoChild = $_POST['txtConsumerIDNoChild'];
  $varstudentclass = $_POST['txtstudentclass'];
  $filter = ['ConsumerIDNo'=>$varConsumerIDNoChild];
  $query = new MongoDB\Driver\Query($filter);
  $cursor = $GoNGetzDatabase->executeQuery('GoNGetz.Consumer',$query);
  foreach ($cursor as $document)
  {
  $studentID = strval($document->_id);
  $bulk = new MongoDB\Driver\BulkWrite(['ordered' => TRUE]);
  $bulk->insert(['Consumer_id'=>$studentID,'Schools_id'=> $varschoolID,'Class_id'=>$varstudentclass,'StudentsStatus'=>"ACTIVE"]);
  $writeConcern = new MongoDB\Driver\WriteConcern(MongoDB\Driver\WriteConcern::MAJORITY, 1000);
  try
  {
    $result =$GoNGetzDatabase->executeBulkWrite('GoNGetzSmartSchool.Students', $bulk, $writeConcern);
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
  //add relation
  $varrelation = $_POST['txtrelation'];
  $filter = ['ConsumerIDNo'=>$varConsumerIDNo];
  $query = new MongoDB\Driver\Query($filter);
  $cursor =$GoNGetzDatabase->executeQuery('GoNGetz.Consumer',$query);
  foreach ($cursor as $document)
  {
  $Parentid = strval($document->_id);
  $filter1 = ['ConsumerID'=>$Parentid];
  $query1 = new MongoDB\Driver\Query($filter1);
  $cursor1 =$GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Parents',$query1);
  foreach ($cursor1 as $document1)
  {
  $parentid = strval($document1->_id);
  }
  }
  $filter = ['ConsumerIDNo'=>$varConsumerIDNoChild];
  $query = new MongoDB\Driver\Query($filter);
  $cursor =$GoNGetzDatabase->executeQuery('GoNGetz.Consumer',$query);
  foreach ($cursor as $document)
  {
  $childid = strval($document->_id);
  $filter1 = ['Consumer_id'=>$childid];
  $query1 = new MongoDB\Driver\Query($filter1);
  $cursor1 =$GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Students',$query1);
  foreach ($cursor1 as $document1)
  {
  $studentid = strval($document1->_id);
  }
  }
  $bulk1 = new MongoDB\Driver\BulkWrite(['ordered' => TRUE]);
  $bulk1->insert(['ParentID'=>$parentid,'StudentID'=>$studentid,'ParentStudentRelation'=>$varrelation,'Schools_id'=>$varschoolID,'ParentStudentRelationStatus'=>'ACTIVE']);
  $writeConcern = new MongoDB\Driver\WriteConcern(MongoDB\Driver\WriteConcern::MAJORITY, 1000);
  try
  {
    $result =$GoNGetzDatabase->executeBulkWrite('GoNGetzSmartSchool.ParentStudentRel', $bulk1, $writeConcern);
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
<!-- Edit Parent and add child -->
<?php
if (isset($_POST['submiteditparent']))
{
  $varschoolID = strval($_SESSION["loggeduser_schoolID"]);
  $varparentid = $_POST['txtparentid'];
  $varstudentid = $_POST['txtstudentid'];
  $varrelation = $_POST['txtrelation'];
  $bulk = new MongoDB\Driver\BulkWrite(['ordered' => TRUE]);
  $bulk->insert(['ParentID'=>$varparentid,'StudentID'=>$varstudentid,'ParentStudentRelation'=>$varrelation,'Schools_id'=>$varschoolID,'ParentStudentRelationStatus'=>'ACTIVE']);
  $writeConcern = new MongoDB\Driver\WriteConcern(MongoDB\Driver\WriteConcern::MAJORITY, 1000);
  try
  {
    $result =$GoNGetzDatabase->executeBulkWrite('GoNGetzSmartSchool.ParentStudentRel', $bulk, $writeConcern);
  }
  catch (MongoDB\Driver\Exception\BulkWriteException $e)
  {
    $result = $e->getWriteResult();
    $_SESSION["loggeduser_schoolName"] = $varschoolname;
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

<!-- De/activate parent -->
<?php
if (isset($_POST['UpdateParentFormSubmit']))
{
  $varparentid = $_POST['txtparentid'];
  $varparentStatus = $_POST['txtparentStatus'];
  $varConsumerRemarksDetails = $_POST['txtConsumerRemarksDetails'];

  $filter = ['_id'=>new \MongoDB\BSON\ObjectID($varparentid)];
  $query = new MongoDB\Driver\Query($filter);
  $cursor =$GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Parents',$query);
  foreach ($cursor as $document)
  {
    $consumerid = strval($document->ConsumerID);
  }
  $bulk = new MongoDB\Driver\BulkWrite(['ordered' => TRUE]);
  $bulk->update(['_id' => new \MongoDB\BSON\ObjectID($varparentid)],
                ['$set' => ['ParentStatus'=>$varparentStatus]],
                ['upsert' => TRUE]
               );
  $writeConcern = new MongoDB\Driver\WriteConcern(MongoDB\Driver\WriteConcern::MAJORITY, 1000);
  try
  {
    $result =$GoNGetzDatabase->executeBulkWrite('GoNGetzSmartSchool.Parents', $bulk, $writeConcern);
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
  $varstaffid = strval($_SESSION["loggeduser_id"]);
  $varschoolid = strval($_SESSION["loggeduser_schoolID"]);
  $varconsumerremarkdate = new MongoDB\BSON\UTCDateTime((new DateTime('now'))->getTimestamp()*1000);
  $bulk = new MongoDB\Driver\BulkWrite(['ordered'=>true]);
  $bulk->insert([
    'Consumer_id'=>$consumerid,
    'ConsumerRemarksDetails'=>$varConsumerRemarksDetails,
    'ConsumerRemarksStaff_id'=>$varstaffid,
    'school_id'=>$varschoolid,
    'ConsumerRemarksDate'=>$varconsumerremarkdate,
    'ConsumerRemarksStatus'=>'ACTIVE']);
  $writeConcern = new MongoDB\Driver\WriteConcern(MongoDB\Driver\WriteConcern::MAJORITY, 1000);
  try
  {
    $result = $GoNGetzDatabase->executeBulkWrite('GoNGetzSmartSchool.ParentRemarks', $bulk, $writeConcern);
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
    foreach ($result->getWriteErrors() as $writeError) {
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
  printf("Deactivate %d document(s)\n", $result->getModifiedCount());
}
?>


<!-- List parent -->
<?php
  if (isset($_GET['paging']) && !empty($_GET['paging']))
  {
    $datapaging = ($_GET['paging']*50);
    $pagingprevious = $_GET['paging']-1;
    $pagingnext = $_GET['paging']+1;
  } else
  {
    $datapaging = 0;
  }
  if (!isset($_POST['searchname']) && empty($_POST['searchname']))
  {
    $filter = ['Schools_id'=>$_SESSION["loggeduser_schoolID"]];
    $option = ['limit'=>50,'skip'=>$datapaging,'sort' => ['_id' => -1]];
    $query = new MongoDB\Driver\Query($filter,$option);
    $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Parents',$query);
  }
  else
  {
    $IDnumber = ($_POST['IDnumber']);
    $filter = [NULL];
    $query = new MongoDB\Driver\Query($filter);
    $cursor = $GoNGetzDatabase->executeQuery('GoNGetz.Consumer',$query);
    foreach ($cursor as $document)
    {
      $idx = strval($document->_id);
      $ConsumerIDNox = strval($document->ConsumerIDNo);
      $ConsumerFNamex = strval($document->ConsumerFName);
      if ($ConsumerIDNox==$IDnumber || $ConsumerFNamex==$IDnumber)
      {
        $filter = ['Schools_id'=>$_SESSION["loggeduser_schoolID"], 'ConsumerID'=>$idx];
        $query = new MongoDB\Driver\Query($filter);
        $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Parents',$query);
      }
    }
  }
?>
<div class="row">
  <div class="col-12 col-sm-12 col-lg-6">
    <div class="col-12 col-sm-6 col-lg-6">
      <br><h1 style="color:#404040;">Parent List</h1>
    </div>
  </div>
  <div class="col-12 col-sm-12 col-sm-6">
     <div class="card">
      <div class="card-body">
        <form name="searchparent" class="form-inline" action="index.php?page=parentlist" method="post">
          <div class="col-12 col-sm-6 col-lg-6 text-right">
            <div class="form-group row">
              <button type="button" style="width:25%"; class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#recheckparent">Add</button>
              <input type="text"style="width:50%";  class="form-control" name="IDnumber" oninput="let p=this.selectionStart;this.value=this.value.toUpperCase();this.setSelectionRange(p, p);" placeholder="Search by ID/Name">
              <button type="submit" style="width:25%"; name="searchname" class="btn btn-secondary">Search</button>
            </div>
          </div>
        </form>
      </div>
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
                      $filter2 = ['_id'=>$consumeridstudent];
                      $query2 = new MongoDB\Driver\Query($filter2);
                      $cursor2 = $GoNGetzDatabase->executeQuery('GoNGetz.Consumer',$query2);
                      foreach ($cursor2 as $document2)
                      {
                        $ConsumerFName2 = $document2->ConsumerFName;
                        $ConsumerLName2 = $document2->ConsumerLName;
                        $ConsumerIDType = $document2->ConsumerIDType;
                        $ConsumerIDNo = $document2->ConsumerIDNo;
                        $ConsumerEmail = $document2->ConsumerEmail;
                        $ConsumerPhone = $document2->ConsumerPhone;
                        echo $ConsumerFName2." ".$ConsumerLName2;
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
                    <button style="font-size:10px" type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#RecheckEditParent" data-bs-whatever="<?php echo $ConsumerIDNoParent; ?>">
                      <i class="fa fa-edit" style="font-size:15px"></i>
                    </button>
                    <button style="font-size:10px" type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#UpdateParentModal" data-bs-whatever="<?php echo $parentid; ?>">
                      <i class="fas fa-exchange-alt" style="font-size:15px" ></i>
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
<?php include ('view/modal-addparent.php'); ?>
<?php include ('view/modal-editparent.php'); ?>
<?php include ('view/modal-updateparent.php'); ?>
<script>
  var recheckparent = document.getElementById('recheckparent')
  recheckparent.addEventListener('show.bs.modal', function (event) {
  // Button that triggered the modal
  var button = event.relatedTarget
  // Extract info from data-bs-* attributes
  var recipient = button.getAttribute('data-bs-whatever')
  // If necessary, you could initiate an AJAX request here
  // and then do the updating in a callback.
  //
  // Update the modal's content.
  var modalTitle = recheckparent.querySelector('.modal-title')
  var modalBodyInput = recheckparent.querySelector('.modal-body input')
  modalBodyInput.value = recipient
  })
</script>
<script>
  var RecheckEditParent = document.getElementById('RecheckEditParent')
  RecheckEditParent.addEventListener('show.bs.modal', function (event) {
  // Button that triggered the modal
  var button = event.relatedTarget
  // Extract info from data-bs-* attributes
  var recipient = button.getAttribute('data-bs-whatever')
  // If necessary, you could initiate an AJAX request here
  // and then do the updating in a callback.
  //
  // Update the modal's content.
  var modalTitle = RecheckEditParent.querySelector('.modal-title')
  var modalBodyInput = RecheckEditParent.querySelector('.modal-body input')
  modalBodyInput.value = recipient
  })
</script>
<script>
  var UpdateParentModal = document.getElementById('UpdateParentModal')
  UpdateParentModal.addEventListener('show.bs.modal', function (event) {
  // Button that triggered the modal
  var button = event.relatedTarget
  // Extract info from data-bs-* attributes
  var recipient = button.getAttribute('data-bs-whatever')
  // If necessary, you could initiate an AJAX request here
  // and then do the updating in a callback.
  //
  // Update the modal's content.
  var modalTitle = UpdateParentModal.querySelector('.modal-title')
  var modalBodyInput = UpdateParentModal.querySelector('.modal-body input')
  modalBodyInput.value = recipient
  })
</script>
