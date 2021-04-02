<!--Add student-->
<?php
if (isset($_POST['submitaddstudent']))
{
  $varschoolID = strval($_SESSION["loggeduser_schoolID"]);
  $varConsumerIDNoChild = $_POST['txtConsumerIDNoChild'];
  $varstudentclass = $_POST['txtstudentclass'];
  $filter = ['ConsumerIDNo'=>$varConsumerIDNoChild];
  $query = new MongoDB\Driver\Query($filter);
  $cursor = $GoNGetzDatabase->executeQuery('GoNGetz.Consumer',$query);

  //add student
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
  //add parent
  $varConsumerIDNo = $_POST['txtConsumerIDNo'];
  $varParentRegDate = new MongoDB\BSON\UTCDateTime((new DateTime('now'))->getTimestamp()*1000);
  $filter = ['ConsumerIDNo'=>$varConsumerIDNo];
  $query = new MongoDB\Driver\Query($filter);
  $cursor = $GoNGetzDatabase->executeQuery('GoNGetz.Consumer',$query);
  foreach ($cursor as $document)
  {
  $parentID = strval($document->_id);
  $bulk = new MongoDB\Driver\BulkWrite(['ordered' => TRUE]);
  $bulk->insert(['ConsumerID'=>$parentID,'Schools_id'=> $varschoolID,'ParentStatus'=> "ACTIVE",'ParentAddDate'=>$varParentRegDate]);
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
  }

  //add relation
  $varrelation = $_POST['txtrelation'];
  $varConsumerIDNo = $_POST['txtConsumerIDNo'];
  $varConsumerIDNoChild = $_POST['txtConsumerIDNoChild'];
  $filter = ['ConsumerIDNo'=>$varConsumerIDNo];
  $query = new MongoDB\Driver\Query($filter);
  $cursor = $GoNGetzDatabase->executeQuery('GoNGetz.Consumer',$query);
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

<!--Edit student-->
<?php
if (isset($_POST['submiteditstudent']))
{
  $studentclass= $_POST['txtstudentclass'];
  $studentid= $_POST['studentid'];
  $bulk = new MongoDB\Driver\BulkWrite(['ordered' => TRUE]);
  $bulk->update( ['_id' => new \MongoDB\BSON\ObjectID($studentid)],
                ['$set' => ['Class_id'=>$studentclass]],
                ['upsert' => TRUE]
               );
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
?>

<!-- De/activate Student-->
<?php
if (isset($_POST['UpdateStudentFormSubmit']))
{
  $varstudentid = $_POST['txtstudentid'];
  $varStudentStatus = $_POST['txtStudentStatus'];
  $varConsumerRemarksDetails = $_POST['txtConsumerRemarksDetails'];

  $filter = ['_id'=>new \MongoDB\BSON\ObjectID($varstudentid)];
  $query = new MongoDB\Driver\Query($filter);
  $cursor =$GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Students',$query);
  foreach ($cursor as $document)
  {
    $consumerid = strval($document->Consumer_id);
  }
  $bulk = new MongoDB\Driver\BulkWrite(['ordered' => TRUE]);
  $bulk->update(['_id' => new \MongoDB\BSON\ObjectID($varstudentid)],
                ['$set' => ['StudentsStatus'=>$varStudentStatus]],
                ['upsert' => TRUE]
               );
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
    $result = $GoNGetzDatabase->executeBulkWrite('GoNGetzSmartSchool.StudentRemarks', $bulk, $writeConcern);
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

<!-- list student -->
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
  if (!isset($_POST['searchstudent']) && empty($_POST['searchstudent']))
  {
    if (!isset($_GET['level']) && empty($_GET['level']))
    {
    $filter = ['Schools_id'=>$_SESSION["loggeduser_schoolID"]];
    $option = ['limit'=>50,'skip'=>$datapaging,'sort' => ['_id' => -1]];
    $query = new MongoDB\Driver\Query($filter,$option);
    $cursor =$GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Students',$query);
    }
    else
    {
    $sort = ($_GET['level']);
    $filter = ['SchoolID' => $_SESSION["loggeduser_schoolID"],
              'ClassCategory'=>$sort
              ];
    $option = ['limit'=>50,'skip'=>$datapaging,'sort' => ['_id' => -1]];
    $query = new MongoDB\Driver\Query($filter,$option);
    $cursor =$GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Classrooms',$query);
    foreach ($cursor as $document)
    {
    $classid = strval($document->_id);
    $filter = ['Schools_id'=>$_SESSION["loggeduser_schoolID"], 'Class_id'=>$classid];
    $query = new MongoDB\Driver\Query($filter);
    $cursor =$GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Students',$query);
    }
    }
  }
  else
  {
    $IDnumber = ($_POST['IDnumber']);
    $filter = [NULL];
    $query = new MongoDB\Driver\Query($filter);
    $cursor =$GoNGetzDatabase->executeQuery('GoNGetz.Consumer',$query);
    foreach ($cursor as $document)
    {
      $idx = strval($document->_id);
      $ConsumerIDNox = strval($document->ConsumerIDNo);
      $ConsumerFNamex = strval($document->ConsumerFName);

      if ($ConsumerIDNox==$IDnumber || $ConsumerFNamex==$IDnumber)
      {
        $filter = ['Schools_id' => $_SESSION["loggeduser_schoolID"],'Consumer_id'=>$idx];
        $query = new MongoDB\Driver\Query($filter);
        $cursor =$GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Students',$query);
      }
    }
  }
?>
<div class="row">
  <div class="col-12 col-sm-12 col-lg-6">
    <div class="col-12 col-sm-6 col-lg-6">
      <br><h1 style="color:#404040;">Student List</h1>
    </div>
  </div>
  <div class="col-12 col-sm-12 col-sm-6">
     <div class="card">
      <div class="card-body">
        <form name="searchstudent" class="form-inline" action="index.php?page=studentlist" method="post">
          <div class="col-12 col-sm-6 col-lg-6 text-right">
            <div class="form-group row">
              <button type="button" style="width:25%"; class="btn btn-info"><a href="index.php?page=exportstudentattendance" style="color:#FFFFFF; text-decoration: none;">ATTENDANCE</a></button>
              <button type="button" style="width:20%"; class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#recheckaddstudent">Add</button>
              <input type="text" style="width:35%"; class="form-control" name="IDnumber" oninput="let p=this.selectionStart;this.value=this.value.toUpperCase();this.setSelectionRange(p, p);" placeholder="Search by ID/Name">
              <button type="submit" style="width:20%"; name="searchstudent" class="btn btn-secondary" >Search</button>
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
        <div class="card-body">
        <!-- sorting -->
        <div class="btn-group sort-btn">
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
          <div class="table-responsive">
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
                      <button type="button" style="font-size:15px width:25%" class="btn btn-info"><a href="index.php?page=exportstudentattendance&id=<?php echo $consumerid; ?>" style="color:#FFFFFF; text-decoration: none;">more >></a></button>
                      </td>
                      </table>
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
                        <button style="font-size:10px" type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#recheckeditstudent" data-bs-whatever="<?php echo $studentid; ?>">
                          <i class="fa fa-edit" style="font-size:15px"></i>
                        </button>
                      </td>
                      <td><?php if(($StudentsStatus) == "ACTIVE") {echo " <font color=green> ACTIVE";} else {echo " <font color=red> INACTIVE";}; ?></td>
                      <td>
                        <button style="font-size:10px" type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#UpdateStudentModal" data-bs-whatever="<?php echo $studentid; ?>">
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
                    <a class="nav-link active btn-secondary" id="v-pills-class-tab" data-bs-toggle="pill" href="#v-pills-class" role="tab" aria-controls="v-pills-class" aria-selected="true">All Students</a>
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
                    <a class="nav-link btn-secondary" id="v-pills-<?php echo $ClassName; echo $ClassCategory;?>-tab" data-bs-toggle="pill" href="#v-pills-<?php echo $ClassName; echo $ClassCategory;?>" role="tab" aria-controls="v-pills-<?php echo $ClassName; echo $ClassCategory;?>" aria-selected="false"><?php echo $ClassCategory; echo "  "; echo $ClassName;?></a>
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
<?php include ('view/modal-addstudent.php'); ?>
<?php include ('view/modal-editstudent.php'); ?>
<?php include ('view/modal-updatestudent.php'); ?>
<script>
  var recheckaddstudent = document.getElementById('recheckaddstudent')
  recheckaddstudent.addEventListener('show.bs.modal', function (event) {
  // Button that triggered the modal
  var button = event.relatedTarget
  // Extract info from data-bs-* attributes
  var recipient = button.getAttribute('data-bs-whatever')
  // If necessary, you could initiate an AJAX request here
  // and then do the updating in a callback.
  //
  // Update the modal's content.
  var modalTitle = recheckaddstudent.querySelector('.modal-title')
  var modalBodyInput = recheckaddstudent.querySelector('.modal-body input')
  modalBodyInput.value = recipient
  })
</script>
<script>
  var recheckeditstudent = document.getElementById('recheckeditstudent')
  recheckeditstudent.addEventListener('show.bs.modal', function (event) {
  // Button that triggered the modal
  var button = event.relatedTarget
  // Extract info from data-bs-* attributes
  var recipient = button.getAttribute('data-bs-whatever')
  // If necessary, you could initiate an AJAX request here
  // and then do the updating in a callback.
  //
  // Update the modal's content.
  var modalTitle = recheckeditstudent.querySelector('.modal-title')
  var modalBodyInput = recheckeditstudent.querySelector('.modal-body input')
  modalBodyInput.value = recipient
  })
</script>
<script>
  var UpdateStudentModal = document.getElementById('UpdateStudentModal')
  UpdateStudentModal.addEventListener('show.bs.modal', function (event) {
  // Button that triggered the modal
  var button = event.relatedTarget
  // Extract info from data-bs-* attributes
  var recipient = button.getAttribute('data-bs-whatever')
  // If necessary, you could initiate an AJAX request here
  // and then do the updating in a callback.
  //
  // Update the modal's content.
  var modalTitle = UpdateStudentModal.querySelector('.modal-title')
  var modalBodyInput = UpdateStudentModal.querySelector('.modal-body input')
  modalBodyInput.value = recipient
  })
</script>
