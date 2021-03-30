<!--Add school staff-->
<?php
if (isset($_POST['submitaddstaff']))
{
  $varschoolID = strval($_SESSION["loggeduser_schoolID"]);
  $varConsumerIDNo = $_POST['txtConsumerIDNo'];
  $varStaffdepartment = strval($_SESSION["departmentid"]);
  $varDepartmentName = strval($_SESSION["DepartmentName"]);
  $varStaffstatus = $_POST['txtStaffstatus'];
  $varteacherclass = $_POST['txtteacherclass'];

  $filter = ['ConsumerIDNo'=>$varConsumerIDNo];
  $query = new MongoDB\Driver\Query($filter);
  $cursor = $GoNGetzDatabase->executeQuery('GoNGetz.Consumer',$query);
  foreach ($cursor as $document)
  {
  $ID = strval($document->_id);
  $ConsumerFName = strval($document->ConsumerFName);
  $bulk = new MongoDB\Driver\BulkWrite(['ordered' => TRUE]);
  if ($varDepartmentName !== "TEACHER")
  {
    $bulk->insert([
      'ConsumerID'=>$ID,
      'SchoolID'=> $varschoolID,
      'ClassID'=> "",
      'StaffLevel'=>"1",
      'Staffdepartment'=> $varStaffdepartment,
      'StaffStatus'=>$varStaffstatus]);
  }
  else
  {
    $bulk->insert([
      'ConsumerID'=>$ID,
      'SchoolID'=> $varschoolID,
      'ClassID'=> $varteacherclass,
      'StaffLevel'=>"0",
      'Staffdepartment'=> $varStaffdepartment,
      'StaffStatus'=>$varStaffstatus]);
  }
  $writeConcern = new MongoDB\Driver\WriteConcern(MongoDB\Driver\WriteConcern::MAJORITY, 1000);
  try
  {
    $result=$GoNGetzDatabase->executeBulkWrite('GoNGetzSmartSchool.Staff', $bulk, $writeConcern);
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
  printf("Matched: %d\n", $result->getMatchedCount());
  printf("Updated  %d document(s)\n", $result->getModifiedCount());
  }
}
?>

<!--Edit school staff-->
<?php
if (isset($_POST['submiteditstaff']))
{
  $Teacherclass = $_POST['txtteacherclass'];
  $Classcategory = $_POST['txtClasscategory'];
  $Teacherid= $_POST['teacherid'];
  $bulk = new MongoDB\Driver\BulkWrite(['ordered' => TRUE]);
  $bulk->update(['ConsumerID'=> $Teacherid],
                ['$set' => ['ClassID'=>$Teacherclass]],
                ['upsert' => TRUE]
               );
  $writeConcern = new MongoDB\Driver\WriteConcern(MongoDB\Driver\WriteConcern::MAJORITY, 1000);

  try
  {
    $result=$GoNGetzDatabase->executeBulkWrite('GoNGetzSmartSchool.Staff', $bulk, $writeConcern);
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

<!--De/activate school staff-->
<?php
if (isset($_POST['UpdateStaffFormSubmit']))
{
  $varstaffid = $_POST['txtstaffid'];
  $varStaffStatus = $_POST['txtStaffStatus'];
  $varConsumerRemarksDetails = $_POST['txtConsumerRemarksDetails'];

  $bulk = new MongoDB\Driver\BulkWrite(['ordered' => TRUE]);
  $bulk->update(['ConsumerID'=>$varstaffid],
                ['$set' => ['StaffStatus'=>$varStaffStatus]],
                ['upsert' => TRUE]
               );
  $writeConcern = new MongoDB\Driver\WriteConcern(MongoDB\Driver\WriteConcern::MAJORITY, 1000);
  $result =$GoNGetzDatabase->executeBulkWrite('GoNGetzSmartSchool.Staff', $bulk, $writeConcern);

  $varstaffremark = strval($_SESSION["loggeduser_id"]);
  $varschoolid = strval($_SESSION["loggeduser_schoolID"]);
  $varconsumerremarkdate = new MongoDB\BSON\UTCDateTime((new DateTime('now'))->getTimestamp()*1000);

  $bulk1 = new MongoDB\Driver\BulkWrite(['ordered'=>true]);
  $bulk1->insert([
    'Consumer_id'=>$varstaffid,
    'ConsumerRemarksDetails'=>$varConsumerRemarksDetails,
    'ConsumerRemarksStaff_id'=>$varstaffremark,
    'school_id'=>$varschoolid,
    'ConsumerRemarksDate'=>$varconsumerremarkdate,
    'ConsumerRemarksStatus'=>'ACTIVE']);

  $writeConcern = new MongoDB\Driver\WriteConcern(MongoDB\Driver\WriteConcern::MAJORITY, 1000);
  try
  {
    $result =$GoNGetzDatabase->executeBulkWrite('GoNGetzSmartSchool.StaffRemarks', $bulk1, $writeConcern);
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
  printf("Matched: %d\n", $result->getMatchedCount());
  printf("Update %d document(s)\n", $result->getModifiedCount());
}
?>

<!--List staff -->
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
  if (!isset($_POST['searchstaff']) && empty($_POST['searchstaff']))
  {
    //sorting by category
    if (!isset($_GET['level']) && empty($_GET['level']))
    {
    $filter = ['SchoolID'=>$_SESSION["loggeduser_schoolID"]];
    $option = ['limit'=>50,'skip'=>$datapaging,'sort' => ['_id' => -1]];
    $query = new MongoDB\Driver\Query($filter,$option);
    $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Staff',$query);
    }
    else
    {
    $sort = ($_GET['level']);
    $filter = ['SchoolID'=>$_SESSION["loggeduser_schoolID"],
              'StaffLevel'=>$sort
              ];
    $option = ['limit'=>50,'skip'=>$datapaging,'sort' => ['_id' => -1]];
    $query = new MongoDB\Driver\Query($filter,$option);
    $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Staff',$query);
    }
  }
  else
  {
    //search using name/id number
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
        $filter = ['SchoolID'=>$_SESSION["loggeduser_schoolID"], 'ConsumerID'=>$idx];
        $query = new MongoDB\Driver\Query($filter);
        $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Staff',$query);

      }
    }
  }
?>
<div class="row">
  <div class="col-12 col-sm-12 col-lg-6">
    <div class="col-12 col-sm-6 col-lg-6">
      <br><h1 style="color:#404040;">Staff List</h1>
    </div>
  </div>
  <div class="col-12 col-sm-12 col-sm-6">
     <div class="card">
      <div class="card-body">
        <form name="searchstaff" class="form-inline" action="index.php?page=stafflist" method="post">
          <div class="col-12 col-sm-6 col-lg-6 text-right">
            <div class="form-group row">
              <button type="button" style="width:25%"; class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#recheckaddstaff" >Add</button>
              <input type="text" style="width:50%";  class="form-control" name="IDnumber" oninput="let p=this.selectionStart;this.value=this.value.toUpperCase();this.setSelectionRange(p, p);" placeholder="Search by ID/Name">
              <button type="submit" style="width:25%";  name="searchstaff" class="btn btn-secondary">Search</button>
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
        <div class="btn-group sort-btn" style="width:10%";>
          <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Sort by </button>
          <ul class="dropdown-menu">
            <li class="dropdown-item"><a href="index.php?page=stafflist" tabindex="-1" data-type="alpha" style="color:#076d79; text-decoration: none;">All</a></li>
            <li class="dropdown-item"><a href="index.php?page=stafflist&level=<?php echo "1"; ?>" tabindex="-1" data-type="alpha" style="color:#076d79; text-decoration: none;">Staff</a></li>
            <li class="dropdown-item"><a href="index.php?page=stafflist&level=<?php echo "0"; ?>" tabindex="-1" data-type="alpha" style="color:#076d79; text-decoration: none;">Teacher</a></li>
          </ul>
        </div>
          <div class="table-responsive" style="width:100%; margin:0 auto;">
            <table id="example" class="table table-bordered dt-responsive nowrap" width="100%" cellspacing="0" style= "text-align: center;">
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
               $Staffdepartment = strval($document->Staffdepartment);
               $iddepartment = new \MongoDB\BSON\ObjectId($Staffdepartment);

               $department = ($document->Staffdepartment);
               $StaffDepartment = $document->Staffdepartment;
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
                  <tr bgcolor='white'>
                    <td><a href="index.php?page=staffdetail&id=<?php echo $varconsumerid; ?>" style="color:#076d79; text-decoration: none;"><?php echo $ConsumerFName." ".$ConsumerLName;?></a>
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
                    ?>
                    <?php
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
                        <a href="index.php?page=attendancestudent&id=<?php echo $constudentid; ?>" tabindex="-1" data-type="alpha" style="color:#076d79; text-decoration: none;">More >></a>
                        </td>
                        </table>
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
                          ?>
                          </td>
                          <td>
                            <?php print_r($document2->ClassName);?>
                          </td>
                          <?php
                          }
                          }
                          else
                            {
                            ?>
                            <td></td>
                            <td>
                              <button style="font-size:10px" type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#recheckeditstaff" data-bs-whatever="<?php echo $varconsumerid; ?>">
                                <i class="fa fa-edit" style="font-size:15px"></i>
                              </button>
                            </td>
                            <?php
                            }
                            ?>
                            <td><?php if(($StaffStatus) == "ACTIVE") {echo " <font color=green> ACTIVE";} else {echo " <font color=red> INACTIVE";}; ?></td>
                            <td>
                            <button style="font-size:10px" type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#UpdateStaffModal" data-bs-whatever="<?php echo $varconsumerid; ?>">
                                <i class="fas fa-exchange-alt" style="font-size:15px" ></i>
                            </button>
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
                            <a href="index.php?page=stafflist&paging=<?php echo $pagingprevious;?>" class="btn btn-secondary">Previous</a>
                          <?php
                          }
                          ?>
                          <a href="index.php?page=stafflist&paging=<?php echo $pagingnext;?>" class="btn btn-secondary">Next</a>
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
                              <!--tab all department -->
                              <div class="tab-pane fade show active" id="v-pills-staff" role="tabpanel" aria-labelledby="v-pills-staff-tab">
                                <div class="box" >
                                  <strong>Total</strong>
                                  <div class="table-responsive">
                                  <table class="table table-striped table-sm">
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
                                  <table class="table table-striped table-sm">
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
                              <!-- end tab -->
                            </div>
                          </div>
                          <div class="col-3" style="border-left: solid 1px #eee;">
                            <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                              <a class="nav-link active btn-secondary" id="v-pills-staff-tab"  data-bs-toggle="pill" href="#v-pills-staff" role="tab" aria-controls="v-pills-staff" aria-selected="true">STAFF</a>
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
                              <a class="nav-link btn-secondary" id="v-pills-department<?php echo $departmentid;?>-tab" data-bs-toggle="pill" href="#v-pills-department<?php echo $departmentid;?>" role="tab" aria-controls="v-pills-department<?php echo $departmentid;?>" aria-selected="false"><?php echo $DepartmentName; ?></a>
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
<?php include ('view/modal-addstaff.php'); ?>
<?php include ('view/modal-editstaff.php'); ?>
<?php include ('view/modal-updatestaff.php'); ?>
<script>
  var recheckaddstaff = document.getElementById('recheckaddstaff')
  recheckaddstaff.addEventListener('show.bs.modal', function (event) {
  // Button that triggered the modal
  var button = event.relatedTarget
  // Extract info from data-bs-* attributes
  var recipient = button.getAttribute('data-bs-whatever')
  // If necessary, you could initiate an AJAX request here
  // and then do the updating in a callback.
  //
  // Update the modal's content.
  var modalTitle = recheckaddstaff.querySelector('.modal-title')
  var modalBodyInput = recheckaddstaff.querySelector('.modal-body input')
  modalBodyInput.value = recipient
  })
</script>

<script>
  var recheckeditstaff = document.getElementById('recheckeditstaff')
  recheckeditstaff.addEventListener('show.bs.modal', function (event) {
  // Button that triggered the modal
  var button = event.relatedTarget
  // Extract info from data-bs-* attributes
  var recipient = button.getAttribute('data-bs-whatever')
  // If necessary, you could initiate an AJAX request here
  // and then do the updating in a callback.
  //
  // Update the modal's content.
  var modalTitle = recheckeditstaff.querySelector('.modal-title')
  var modalBodyInput = recheckeditstaff.querySelector('.modal-body input')
  modalBodyInput.value = recipient
  })
</script>
<script>
  var UpdateStaffModal = document.getElementById('UpdateStaffModal')
  UpdateStaffModal.addEventListener('show.bs.modal', function (event) {
  // Button that triggered the modal
  var button = event.relatedTarget
  // Extract info from data-bs-* attributes
  var recipient = button.getAttribute('data-bs-whatever')
  // If necessary, you could initiate an AJAX request here
  // and then do the updating in a callback.
  //
  // Update the modal's content.
  var modalTitle = UpdateStaffModal.querySelector('.modal-title')
  var modalBodyInput = UpdateStaffModal.querySelector('.modal-body input')
  modalBodyInput.value = recipient
  })
</script>
