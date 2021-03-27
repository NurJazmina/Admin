<!--Add timetable-->
testing
<?php
if (isset($_POST['submitaddtimetable']))
{
  $varschoolid =  strval($_SESSION["loggeduser_schoolID"]);
  $varclassid = $_POST['txtclassid'];
  $varteacherid = $_POST['txtteacherid'];
  $varsubject = $_POST['txtsubject'];
  $varTimetableStart= $_POST['txtTimetableStart'];
  $varTimetableEnd= $_POST['txtTimetableEnd'];
  $varTimetableWeeklyRepeat= $_POST['txtTimetableWeeklyRepeat'];
  $varTimetableStatus= $_POST['txtTimetableStatus'];
  $bulk = new MongoDB\Driver\BulkWrite(['ordered'=>true]);
  $bulk->insert([
    'School_id'=>$varschoolid,
    'Classroom_id'=>$varclassid,
    'Teachers_id'=>$varteacherid,
    'TimetableSubject'=>$varsubject,
    'TimetableStart'=>new MongoDB\BSON\UTCDateTime(new DateTime($varTimetableStart)),
    'TimetableEnd'=>new MongoDB\BSON\UTCDateTime(new DateTime($varTimetableEnd)),
    'TimetableWeeklyRepeat'=>$varTimetableWeeklyRepeat,
    'TimetableStatus'=>$varTimetableStatus,]);
  $writeConcern = new MongoDB\Driver\WriteConcern(MongoDB\Driver\WriteConcern::MAJORITY, 1000);
  try {
    $result = $GoNGetzDatabase->executeBulkWrite('GoNGetzSmartSchool.TimeTable', $bulk, $writeConcern);
  }
  catch (MongoDB\Driver\Exception\BulkWriteException $e) {
    $result = $e->getWriteResult();
    // Check if the write concern could not be fulfilled
    if ($writeConcernError = $result->getWriteConcernError()) {
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
  catch (MongoDB\Driver\Exception\Exception $e) {
    printf("Other error: %s\n", $e->getMessage());
    exit;
  }
  printf("Inserted %d document(s)\n", $result->getInsertedCount());
  printf("Updated  %d document(s)\n", $result->getModifiedCount());
}
?>

<!--Edit timetable-->
<?php
if (isset($_POST['submitedittimetable']))
{
  $varschoolid =  strval($_SESSION["loggeduser_schoolID"]);
  $vartimetableid = $_POST['txttimetableid'];
  $varclassid = $_POST['txtclassid'];
  $varteacherid = $_POST['txtteacherid'];
  $varsubject = $_POST['txtsubject'];
  $varTimetableStart= $_POST['txtTimetableStart'];
  $varTimetableEnd= $_POST['txtTimetableEnd'];
  $varTimetableWeeklyRepeat= $_POST['txtTimetableWeeklyRepeat'];
  $bulk = new MongoDB\Driver\BulkWrite(['ordered' => TRUE]);
  $bulk->update( ['_id' => new \MongoDB\BSON\ObjectID($vartimetableid)],
                ['$set' => ['School_id'=>$varschoolid,
                'Classroom_id'=>$varclassid,
                'Teachers_id'=>$varteacherid,
                'TimetableSubject'=>$varsubject,
                'TimetableStart'=>new MongoDB\BSON\UTCDateTime(new DateTime($varTimetableStart)),
                'TimetableEnd'=>new MongoDB\BSON\UTCDateTime(new DateTime($varTimetableEnd)),
                'TimetableWeeklyRepeat'=>$varTimetableWeeklyRepeat,
                'TimetableStatus'=>'ACTIVE']],
                ['upsert' => TRUE]
               );
  $writeConcern = new MongoDB\Driver\WriteConcern(MongoDB\Driver\WriteConcern::MAJORITY, 1000);
  try
  {
    $result = $GoNGetzDatabase->executeBulkWrite('GoNGetzSmartSchool.TimeTable', $bulk, $writeConcern);
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

<!--delete timetable-->
<?php
if (isset($_POST['DeleteTimetableFormSubmit']))
{
  $vartimetableid = $_POST['txttimetableid'];
  $bulk = new MongoDB\Driver\BulkWrite;
  $bulk->delete(['_id'=>new \MongoDB\BSON\ObjectID($vartimetableid)], ['limit' => 1]);
  $writeConcern = new MongoDB\Driver\WriteConcern(MongoDB\Driver\WriteConcern::MAJORITY, 1000);
  try
  {
    $result = $GoNGetzDatabase->executeBulkWrite('GoNGetzSmartSchool.TimeTable', $bulk, $writeConcern);
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
<!--List of timetable-->
<?php
//display been filter using level
if ($_SESSION["loggeduser_StaffLevel"] =='1')
{
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
  if (!isset($_POST['teacherid']) && empty($_POST['teacherid']))
  {
    if (!isset($_GET['level']) && empty($_GET['level']))
    {
      $vardate = new MongoDB\BSON\UTCDateTime((new DateTime('now'))->getTimestamp()*1000);
      $filter = ['School_id' => $_SESSION["loggeduser_schoolID"],
               '$or' => [
                 ['TimetableStart' => ['$gte' => $vardate]],
                 ['TimetableEnd' => ['$gte' => $vardate]]
               ]
                ];
      $option = ['limit'=>50,'skip'=>$datapaging,'sort' => ['_id' => -1]];
      $query = new MongoDB\Driver\Query($filter,$option);
      $cursor =$GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.TimeTable',$query);
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
      foreach ($cursor as $document)
      {
        $class = strval($document->_id);
        $vardate = new MongoDB\BSON\UTCDateTime((new DateTime('now'))->getTimestamp()*1000);
        $filter = ['School_id' => $_SESSION["loggeduser_schoolID"],
                   '$or' => [
                     ['TimetableStart' => ['$gte' => $vardate]],
                     ['TimetableEnd' => ['$gte' => $vardate]]
                   ],
                   'Classroom_id'=>$class
                  ];
        $option = ['limit'=>50,'skip'=>$datapaging,'sort' => ['_id' => -1]];
        $query = new MongoDB\Driver\Query($filter,$option);
        $cursor =$GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.TimeTable',$query);
      }
    }
  }
  else
  {
    $vardate = new MongoDB\BSON\UTCDateTime((new DateTime('now'))->getTimestamp()*1000);
    $teachername = ($_POST['teachername']);
    $filter = ['ConsumerFName'=>$teachername];
    $query = new MongoDB\Driver\Query($filter);
    $cursor = $GoNGetzDatabase->executeQuery('GoNGetz.Consumer',$query);
    foreach ($cursor as $document)
    {
    $consumer = strval($document->_id);
    $filter = ['ConsumerID'=>$consumer];
    $query = new MongoDB\Driver\Query($filter);
    $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Staff',$query);
    foreach ($cursor as $document)
    {
    $teacher = strval($document->_id);
    $filter = ['School_id' => $_SESSION["loggeduser_schoolID"],
               '$or' => [
                 ['TimetableStart' => ['$gte' => $vardate]],
                 ['TimetableEnd' => ['$gte' => $vardate]]
               ],
               'Teachers_id'=>$teacher
              ];
    $option = ['limit'=>10,'skip'=>$datapaging,'sort' => ['_id' => -1]];
    $query = new MongoDB\Driver\Query($filter,$option);
    $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.TimeTable',$query);
    }
    }
  }
?>

<!-- for staff only -->
<div class="row">
  <div class="col-12 col-sm-12 col-lg-6">
    <div class="col-12 col-sm-6 col-lg-6">
      <br><h1 style="color:#404040;">Timetable List</h1>
    </div>
  </div>
  <div class="col-12 col-sm-12 col-sm-8">
    <div class="card">
      <div class="card-body">
        <form name="searchschool" class="form-inline" action="index.php?page=timetablelist" method="post">
          <div class="col-12 col-sm-6 col-lg-6 text-right">
            <div class="form-group row">
              <button type="button" style="width:25%"; class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#recheckaddtimetable">Add</button>
              <input type="text" style="width:50%"; class="form-control" name="teachername" oninput="let p=this.selectionStart;this.value=this.value.toUpperCase();this.setSelectionRange(p, p);" placeholder="search by teacher name">
              <button type="submit" style="width:25%"; name="teacherid" class="btn btn-secondary">Search</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-12 col-sm-12">
    <div class="card">
        <div class="card-header">
          <strong>List</strong>
        </div>
        <div class="card-body">
          <!-- sorting -->
        <div class="btn-group sort-btn">
          <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Sort by </button>
          <ul class="dropdown-menu">
            <li><a href="index.php?page=timetablelist" tabindex="-1" data-type="alpha" style="color:#076d79; text-decoration: none;">All</a></li>
            <li><a href="index.php?page=timetablelist&level=<?php echo "1"; ?>" tabindex="-1" data-type="alpha" style="color:#076d79; text-decoration: none;">category 1</a></li>
            <li><a href="index.php?page=timetablelist&level=<?php echo "2"; ?>" tabindex="-1" data-type="alpha" style="color:#076d79; text-decoration: none;">category 2</a></li>
            <li><a href="index.php?page=timetablelist&level=<?php echo "3"; ?>" tabindex="-1" data-type="alpha" style="color:#076d79; text-decoration: none;">category 3</a></li>
            <li><a href="index.php?page=timetablelist&level=<?php echo "4"; ?>" tabindex="-1" data-type="alpha" style="color:#076d79; text-decoration: none;">category 4</a></li>
            <li><a href="index.php?page=timetablelist&level=<?php echo "5"; ?>" tabindex="-1" data-type="alpha" style="color:#076d79; text-decoration: none;">category 5</a></li>
            <li><a href="index.php?page=timetablelist&level=<?php echo "6"; ?>" tabindex="-1" data-type="alpha" style="color:#076d79; text-decoration: none;">category 6</a></li>
          </ul>
        </div>
          <div class="table-responsive" style="width:100%; margin:0 auto;">
            <table id="demoGrid" class="table table-striped table-bordered dt-responsive nowrap" width="100%" cellspacing="0" style="text-align: center;">
              <thead>
                <tr>
                  <th rowspan="2">Teacher</th>
                  <th rowspan="2">Class Name</th>
                  <th rowspan="2">Total Student</th>
                  <th rowspan="2">Subject</th>
                  <th colspan="3">Start</th>
                  <th colspan="3">End</th>
                  <th rowspan="2">Timetable Status</th>
                  <th rowspan="2" >Update</th>
                </tr>
                <tr>
                  <th colspan="2">Time</th>
                  <th>Date</th>
                  <th colspan="2">Time</th>
                  <th>Date</th>
                </tr>
              </thead>
              <tbody>
                <?php
                foreach ($cursor as $document)
                {
                  $_id = strval($document->_id);
                  $timetableid = new \MongoDB\BSON\ObjectId($_id);
                  $_SESSION["timetableid"] = strval($timetableid);
                  $TimetableStatus = strval($document->TimetableStatus);
                  $TimetableStart = new MongoDB\BSON\UTCDateTime(strval($document->TimetableStart));
                  $TimetableEnd = new MongoDB\BSON\UTCDateTime(strval($document->TimetableEnd));
                  $datetimestart = $TimetableStart->toDateTime()->setTimezone(new \DateTimeZone(date_default_timezone_get()));
                  $datetimeend = $TimetableEnd->toDateTime()->setTimezone(new \DateTimeZone(date_default_timezone_get()));
                  $Teachers_id = $document->Teachers_id;
                  $bid = new \MongoDB\BSON\ObjectId($Teachers_id);

                  $filter3 = ['SchoolID'=>$_SESSION["loggeduser_schoolID"], '_id'=>$bid];
                  $query3 = new MongoDB\Driver\Query($filter3);
                  $cursor3 = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Staff',$query3);
                  foreach ($cursor3 as $document3)
                  {
                  $ConsumerID = strval($document3->ConsumerID);
                  $cid = new \MongoDB\BSON\ObjectId($ConsumerID);
                  $filter4 = ['_id'=>$cid];
                  $query4 = new MongoDB\Driver\Query($filter4);
                  $cursor4 = $GoNGetzDatabase->executeQuery('GoNGetz.Consumer',$query4);
                  foreach ($cursor4 as $document4)
                  {
                    ?>
                    <tr>
                      <td><?php print_r($document4->ConsumerFName); ?></td>
                    <?php
                  }
                  }
                  $Classroom_id = $document->Classroom_id;
                  $cid = new \MongoDB\BSON\ObjectId($Classroom_id);
                  $filter5 = ['SchoolID'=>$_SESSION["loggeduser_schoolID"], '_id'=>$cid];
                  $query5 = new MongoDB\Driver\Query($filter5);
                  $cursor5 = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Classrooms',$query5);
                  foreach ($cursor5 as $document5)
                  {
                    $classroomid = $document5->_id;
                    ?>
                    <td><?php print_r($document5->ClassCategory); echo"  "; print_r($document5->ClassName); ?></td>
                    <?php
                  }
                  $filter4 = ['Schools_id' => $_SESSION["loggeduser_schoolID"], 'Class_id'=>$Classroom_id];
                  $query4 = new MongoDB\Driver\Query($filter4);
                  $cursor4 =$GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Students',$query4);
                  $totalstudent = 0;
                  foreach ($cursor4 as $document4)
                  {
                    $totalstudent = $totalstudent+ 1;
                  }
                  ?>
                      <td><?php echo $totalstudent; ?></td>
                      <td><?php print_r($document->TimetableSubject); ?></td>
                      <!-- date start -->
                      <td><?php echo date_format($datetimestart,"d/m/Y");?></td>
                      <td><?php echo date_format($datetimestart,"D");?></td>
                      <!-- time start -->
                      <td><?php echo date_format($datetimestart,"H:i");?></td>
                      <!-- date end -->
                      <td><?php echo date_format($datetimeend,"d/m/Y");?></td>
                      <td><?php echo date_format($datetimeend,"D");?></td>
                      <!-- time end -->
                      <td><?php echo date_format($datetimeend,"H:i");?></td>
                      <td><?php if($TimetableStatus == "ACTIVE") {echo " <font color=green> ACTIVE";} else {echo " <font color=red> INACTIVE";}; ?></td>
                      <td>
                        <button style="font-size:10px" type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#recheckedittimetable" data-bs-whatever="<?php echo $_id; ?>">
                          <i class="fa fa-edit" style="font-size:15px"></i>
                        </button>
                        <button style="font-size:10px" type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#UpdateTimetableModal" data-bs-whatever="<?php echo $_id; ?>">
                          <i class="fas fa-exchange-alt" style="font-size:15px"></i>
                        </button>
                       </td
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
                          <a href="index.php?page=timetablelist&paging=<?php echo $pagingprevious;?>" class="btn btn-secondary">Previous</a>
                        <?php
                        }
                        ?>
                        <a href="index.php?page=timetablelist&paging=<?php echo $pagingnext;?>" class="btn btn-secondary">Next</a>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-12 col-lg-4">
              <div class="row">
                <div class="col-12 col-lg-12">
                </div>
              </div>
            </div>
          </div><br><br>
<?php
}
else
{
?>
<!-- User/teacher timetable -->
<br>
<div class="row">
  <div class="col-12 col-sm-12 col-lg-6">
    <div class="col-12 col-sm-6 col-lg-6">
      <br><h1 style="color:#404040;">My Timetable</h1>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-12 col-sm-12">
    <div class="card">
        <div class="card-header">
          <strong>List</strong>
        </div>
        <div class="card-body">
          <div class="table-responsive" style="width:100%; margin:0 auto;">
            <table id="demoGrid" class="table table-striped table-bordered dt-responsive nowrap" width="100%" cellspacing="0" style="text-align: center;">
              <thead>
                <tr>
                  <th rowspan="2">Teacher</th>
                  <th rowspan="2">Class Name</th>
                  <th rowspan="2">Total Student</th>
                  <th rowspan="2">Subject</th>
                  <th colspan="3">Start</th>
                  <th colspan="3">End</th>
                  <th rowspan="2">Timetable Status</th>
                  <th rowspan="2" >Update</th>
                </tr>
                <tr>
                  <th colspan="2">Date</th>
                  <th>Time</th>
                  <th colspan="2">Date</th>
                  <th>Time</th>
                </tr>
              </thead>
              <tbody>
                <?php
                  $vardate = new MongoDB\BSON\UTCDateTime((new DateTime('now'))->getTimestamp()*1000);
                  $filter5 = ['School_id' => $_SESSION["loggeduser_schoolID"],'Teachers_id'=>strval($_SESSION["loggeduser_teacherid"])];
                  $option5 = ['sort' => ['_id' => -1]];
                  $query5 = new MongoDB\Driver\Query($filter5,$option5);
                  $cursor5 = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.TimeTable',$query5);
                  foreach ($cursor5 as $document5)
                  {
                    $Classroom_id = $document5->Classroom_id;
                    $TimetableStatus = $document5->TimetableStatus;
                    $TimetableStart = new MongoDB\BSON\UTCDateTime(strval($document5->TimetableStart));
                    $TimetableEnd = new MongoDB\BSON\UTCDateTime(strval($document5->TimetableEnd));
                    $datetimestart = $TimetableStart->toDateTime()->setTimezone(new \DateTimeZone(date_default_timezone_get()));
                    $datetimeend = $TimetableEnd->toDateTime()->setTimezone(new \DateTimeZone(date_default_timezone_get()));
                    $consumer = new \MongoDB\BSON\ObjectId($_SESSION["loggeduser_id"]);
                    $filter4 = ['_id'=>$consumer];
                    $query4 = new MongoDB\Driver\Query($filter4);
                    $cursor4 =$GoNGetzDatabase->executeQuery('GoNGetz.Consumer',$query4);
                    foreach ($cursor4 as $document4)
                    {
                      ?>
                      <tr>
                        <td><?php print_r($document4->ConsumerFName); ?></td>
                        <?php
                      }
                      $filter3 = ['_id'=>new \MongoDB\BSON\ObjectId($Classroom_id)];
                      $query3 = new MongoDB\Driver\Query($filter3);
                      $cursor3 =$GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Classrooms',$query3);
                      foreach ($cursor3 as $document3)
                      {
                      ?>
                      <td><?php print_r($document3->ClassCategory); echo"  "; print_r($document3->ClassName); ?></td>
                      <?php
                      }
                      $filter1 = ['Class_id'=>$Classroom_id];
                      $query1 = new MongoDB\Driver\Query($filter1);
                      $cursor1 = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Students',$query1);
                      $totalstudent = 0;
                      foreach ($cursor1 as $document1)
                      {
                        $totalstudent = $totalstudent+ 1;
                      }
                      ?>
                      <td><?php echo $totalstudent; ?></td>

                      <td><?php print_r($document5->TimetableSubject); ?></td>
                      <!-- date start -->
                      <td><?php echo date_format($datetimestart,"d/m/Y");?></td>
                      <td><?php echo date_format($datetimestart,"D");?></td>
                      <!-- time start -->
                      <td><?php echo date_format($datetimestart,"H:i");?></td>
                      <!-- date end -->
                      <td><?php echo date_format($datetimeend,"d/m/Y");?></td>
                      <td><?php echo date_format($datetimeend,"D");?></td>
                      <!-- time end -->
                      <td><?php echo date_format($datetimeend,"H:i");?></td>
                      <td><?php if($TimetableStatus == "ACTIVE") {echo " <font color=green> ACTIVE";} else {echo " <font color=red> INACTIVE";}; ?></td>
                      <td>
                        <button style="font-size:10px" type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#recheckedittimetable" data-bs-whatever="<?php echo $_id; ?>">
                          <i class="fa fa-edit" style="font-size:15px"></i>
                        </button>
                        <button style="font-size:10px" type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#DeleteTimetableModal" data-bs-whatever="<?php echo $_id; ?>">
                          <i class="fas fa-trash" style="font-size:15px"></i>
                        </button>
                       </td
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
                  <a href="index.php?page=timetablelist&paging=<?php echo $pagingprevious;?>" class="btn btn-secondary">Previous</a>
                <?php
                }
                ?>
                <a href="index.php?page=timetablelist&paging=<?php echo $pagingnext;?>" class="btn btn-secondary">Next</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-12 col-lg-4">
      <div class="row">
        <div class="col-12 col-lg-12">
        </div>
      </div>
    </div>
  </div>
<!-- Teacher class timetable -->
<br>
<div class="row">
  <div class="col-12 col-sm-12 col-lg-6">
    <div class="col-12 col-sm-6 col-lg-6">
      <br><h1 style="color:#404040;">Class Timetable</h1>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-12 col-sm-12">
    <div class="card">
        <div class="card-header">
          <strong>List</strong>
        </div>
        <div class="card-body">
          <div class="table-responsive" style="width:100%; margin:0 auto;">
            <table id="demoGrid" class="table table-striped table-bordered dt-responsive nowrap" width="100%" cellspacing="0" style="text-align: center;">
              <thead>
                <tr>
                  <th rowspan="2">Teacher</th>
                  <th rowspan="2">Class Name</th>
                  <th rowspan="2">Total Student</th>
                  <th rowspan="2">Subject</th>
                  <th colspan="3">Start</th>
                  <th colspan="3">End</th>
                  <th rowspan="2">Timetable Status</th>
                </tr>
                <tr>
                  <th colspan="2">Date</th>
                  <th>Time</th>
                  <th colspan="2">Date</th>
                  <th>Time</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $vardate = new MongoDB\BSON\UTCDateTime((new DateTime('now'))->getTimestamp()*1000);
                $filterA = ['School_id' => $_SESSION["loggeduser_schoolID"],'Classroom_id'=>$_SESSION["loggeduser_ClassID"]];
                $optionA = ['sort' => ['_id' => -1]];
                $queryA = new MongoDB\Driver\Query($filterA,$optionA);
                $cursorA = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.TimeTable',$queryA);
                foreach ($cursorA as $documentA)
                {
                  $Classroom_idA = strval($documentA->Classroom_id);
                  $TimetableStatusA = strval($documentA->TimetableStatus);
                  $TimetableStartA= new MongoDB\BSON\UTCDateTime(strval($documentA->TimetableStart));
                  $TimetableEndA= new MongoDB\BSON\UTCDateTime(strval($documentA->TimetableEnd));

                  $datetimestartA = $TimetableStartA->toDateTime()->setTimezone(new \DateTimeZone(date_default_timezone_get()));
                  $datetimeendA = $TimetableEndA->toDateTime()->setTimezone(new \DateTimeZone(date_default_timezone_get()));

                  $Teachers_id = $documentA->Teachers_id;
                  $Classroom_id = $documentA->Classroom_id;

                  $filterB = ['_id'=>new \MongoDB\BSON\ObjectId($Teachers_id)];
                  $queryB = new MongoDB\Driver\Query($filterB);
                  $cursorB = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Staff',$queryB);
                  foreach ($cursorB as $documentB)
                  {
                    $ConsumerID = $documentB->ConsumerID;
                    $ClassID = $documentB->ClassID;
                    $filterC = ['_id'=>new \MongoDB\BSON\ObjectId($ConsumerID)];
                    $queryC = new MongoDB\Driver\Query($filterC);
                    $cursorC = $GoNGetzDatabase->executeQuery('GoNGetz.Consumer',$queryC);
                    foreach ($cursorC as $documentC)
                    {
                    ?>
                    <tr>
                     <td><?php print_r($documentC->ConsumerFName); ?></td>
                    <?php
                      $filterD = ['_id'=>new \MongoDB\BSON\ObjectId($_SESSION["loggeduser_ClassID"])];
                      $queryD = new MongoDB\Driver\Query($filterD);
                      $cursorD = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Classrooms',$queryD);
                      foreach ($cursorD as $documentD)
                      {
                      ?>
                      <td><?php print_r($documentD->ClassCategory); echo"  "; print_r($documentD->ClassName); ?></td>
                      <?php
                      $filterE = ['Class_id'=>$Classroom_idA];
                      $queryE = new MongoDB\Driver\Query($filterE);
                      $cursorE =$GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Students',$queryE);
                      $totalstudent = 0;
                      foreach ($cursorE as $documentE)
                      {
                        $totalstudent = $totalstudent+ 1;
                      }
                      ?>
                      <td><?php echo $totalstudent; ?></td>
                      <td><?php print_r($documentA->TimetableSubject); ?></td>
                      <!-- date start -->
                      <td><?php echo date_format($datetimestartA,"d/m/Y");?></td>
                      <td><?php echo date_format($datetimestartA,"D");?></td>
                      <!-- time start -->
                      <td><?php echo date_format($datetimestartA,"H:i");?></td>
                      <!-- date end -->
                      <td><?php echo date_format($datetimeendA,"d/m/Y");?></td>
                      <td><?php echo date_format($datetimeendA,"D");?></td>
                      <!-- time end -->
                      <td><?php echo date_format($datetimeendA,"H:i");?></td>

                      <td><?php if($TimetableStatusA == "ACTIVE") {echo " <font color=green> ACTIVE";} else {echo " <font color=red> INACTIVE";}; ?></td>
                      <?php
                        }
                      }
                      }
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
                        <a href="index.php?page=timetablelist&paging=<?php echo $pagingprevious;?>" class="btn btn-secondary">Previous</a>
                      <?php
                      }
                      ?>

                      <a href="index.php?page=timetablelist&paging=<?php echo $pagingnext;?>" class="btn btn-secondary">Next</a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-12 col-lg-4">
            <div class="row">
              <div class="col-12 col-lg-12">
              </div>
            </div>
          </div>
        </div><br><br><br><br>
<?php
}
?>
<?php include ('view/modal-addtimetable.php'); ?>
<?php include ('view/modal-edittimetable.php'); ?>
<?php include ('view/modal-updatetimetable.php'); ?>
<script>
var recheckedittimetable = document.getElementById('recheckedittimetable')
recheckedittimetable.addEventListener('show.bs.modal', function (event) {
// Button that triggered the modal
var button = event.relatedTarget
// Extract info from data-bs-* attributes
var recipient = button.getAttribute('data-bs-whatever')
// If necessary, you could initiate an AJAX request here
// and then do the updating in a callback.
//
// Update the modal's content.
var modalTitle = recheckedittimetable.querySelector('.modal-title')

  var modalBodyInput = recheckedittimetable.querySelector('.modal-body input')
  modalBodyInput.value = recipient
  })
</script>
<script>
  var UpdateTimetableModal = document.getElementById('UpdateTimetableModal')
  UpdateTimetableModal.addEventListener('show.bs.modal', function (event) {
  // Button that triggered the modal
  var button = event.relatedTarget
  // Extract info from data-bs-* attributes
  var recipient = button.getAttribute('data-bs-whatever')
  // If necessary, you could initiate an AJAX request here
  // and then do the updating in a callback.
  //
  // Update the modal's content.
  var modalTitle = UpdateTimetableModal.querySelector('.modal-title')
  var modalBodyInput = UpdateTimetableModal.querySelector('.modal-body input')
  modalBodyInput.value = recipient
  })
</script>
