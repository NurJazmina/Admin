<!--List of timetable-->
<?php
if ($_SESSION["loggeduser_ACCESS"] =='STAFF')
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
    $pagingnext = 1;
    $pagingprevious = 0;
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
  include ('model/timetablelist.php'); 
?>
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
					<h5 class="text-dark font-weight-bold my-1 mr-5">Timetable</h5>
					<!--end::Page Title-->
				</div>
				<!--end::Page Heading-->
			</div>
			<!--end::Info-->
			<!--begin::Toolbar-->
			<div class="d-flex align-items-center">
        <div class="col-12 col-sm-12 col-sm-12">
          <form name="searchschool" class="form-inline" action="index.php?page=timetablelist" method="post">
            <div class="col-12 col-sm-12 col-lg-12 text-right">
              <div class="row">
                <button type="button" style="width:25%;" class="btn btn-success font-weight-bolder btn-sm" data-bs-toggle="modal" data-bs-target="#recheckaddtimetable">Add</button>
                <div class="input-group input-group-sm input-group-solid" style="width:50%">
                  <input  type="text" class="form-control" name="teachername" oninput="let p=this.selectionStart;this.value=this.value.toUpperCase();this.setSelectionRange(p, p);" placeholder="Search by Name">
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
                <button type="submit" style="width:25%;" class="btn btn-success font-weight-bolder btn-sm" name="teacherid">Search</button>
              </div>
            </div>
          </form>
        </div>
			</div>
			<!--end::Toolbar-->
		</div>
	</div>
	<!--end::Subheader-->

<!-- for staff only -->
<div class="row">
  <div class="col-12 col-sm-12 col-lg-6">
    <div class="col-12 col-sm-6 col-lg-6">
      <br><h1 style="color:#404040;">Timetable List</h1>
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
        <button class="btn btn-success font-weight-bolder btn-sm" type="button" data-bs-toggle="dropdown">Sort by <i class="fas fa-sort"></i></button>
        <ul class="dropdown-menu">
          <li class="dropdown-item"><a href="index.php?page=timetablelist" tabindex="-1" data-type="alpha">All</a></li>
          <li class="dropdown-item"><a href="index.php?page=timetablelist&level=<?php echo "1"; ?>" tabindex="-1" data-type="alpha">category 1</a></li>
          <li class="dropdown-item"><a href="index.php?page=timetablelist&level=<?php echo "2"; ?>" tabindex="-1" data-type="alpha">category 2</a></li>
          <li class="dropdown-item"><a href="index.php?page=timetablelist&level=<?php echo "3"; ?>" tabindex="-1" data-type="alpha">category 3</a></li>
          <li class="dropdown-item"><a href="index.php?page=timetablelist&level=<?php echo "4"; ?>" tabindex="-1" data-type="alpha">category 4</a></li>
          <li class="dropdown-item"><a href="index.php?page=timetablelist&level=<?php echo "5"; ?>" tabindex="-1" data-type="alpha">category 5</a></li>
          <li class="dropdown-item"><a href="index.php?page=timetablelist&level=<?php echo "6"; ?>" tabindex="-1" data-type="alpha">category 6</a></li>
        </ul>
        <br><br>
        <div class="table-responsive" style="width:100%; margin:0 auto;">
          <table id="demoGrid" class="table table-striped table-bordered dt-responsive nowrap table-sm" width="100%" cellspacing="0" style="text-align: center;">
            <thead>
              <tr>
                <th rowspan="2">Teacher</th>
                <th rowspan="2">Class Name</th>
                <th rowspan="2">Total Student</th>
                <th rowspan="2">Subject</th>
                <th colspan="3">Start</th>
                <th colspan="3">End</th>
                <th rowspan="2">Timetable Status</th>
                <th rowspan="2">Update</th>
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

                $filter = ['SchoolID'=>$_SESSION["loggeduser_schoolID"], '_id'=>$bid];
                $query = new MongoDB\Driver\Query($filter);
                $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Staff',$query);
                foreach ($cursor as $document3)
                {
                  $ConsumerID = strval($document3->ConsumerID);

                  $filter = ['_id'=>new \MongoDB\BSON\ObjectId($ConsumerID)];
                  $query = new MongoDB\Driver\Query($filter);
                  $cursor = $GoNGetzDatabase->executeQuery('GoNGetz.Consumer',$query);
                  foreach ($cursor as $document4)
                  {
                    ?>
                    <tr>
                      <td><a href="index.php?page=staffdetail&id=<?php echo $ConsumerID; ?>" style="color:#076d79; text-decoration: none;"><?php print_r($document4->ConsumerFName); ?></a></td>
                    <?php
                  }
                }
                $Classroom_id = $document->Classroom_id;
                $filter = ['_id'=>new \MongoDB\BSON\ObjectId($Classroom_id)];
                $query = new MongoDB\Driver\Query($filter);
                $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Classrooms',$query);

                foreach ($cursor as $document5)
                {
                  $classroomid = $document5->_id;
                  ?>
                  <td><a href="index.php?page=classdetail&id=<?php echo $ConsumerID; ?>" style="color:#076d79; text-decoration: none;"><?php print_r($document5->ClassCategory); echo"  "; print_r($document5->ClassName); ?></a></td>
                  <?php
                }
                $filter = ['Schools_id' => $_SESSION["loggeduser_schoolID"], 'Class_id'=>$Classroom_id];
                $query = new MongoDB\Driver\Query($filter);
                $cursor =$GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Students',$query);
                $totalstudent = 0;
                foreach ($cursor as $document4)
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
                    <a href="index.php?page=stafflist&paging=<?php echo $pagingprevious;?>" class="btn btn-success font-weight-bolder btn-sm">Previous</a>
                  <?php
                }
              }
              ?>
              <a href="index.php?page=stafflist&paging=<?php echo $pagingnext;?>" class="btn btn-success font-weight-bolder btn-sm">Next</a>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-12 col-lg-4"></div>
  </div><br><br>
  <?php
}
elseif ($_SESSION["loggeduser_ACCESS"] =='TEACHER')
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
                      <a href="index.php?page=stafflist&paging=<?php echo $pagingprevious;?>" class="btn btn-success font-weight-bolder btn-sm">Previous</a>
                    <?php
                    }
                  }
                  ?>
                  <a href="index.php?page=stafflist&paging=<?php echo $pagingnext;?>" class="btn btn-success font-weight-bolder btn-sm">Next</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-12 col-lg-4"></div>
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
              <table id="demoGrid" class="table table-striped table-bordered dt-responsive nowrap table-sm" width="100%" cellspacing="0" style="text-align: center;">
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
                            <a href="index.php?page=stafflist&paging=<?php echo $pagingprevious;?>" class="btn btn-success font-weight-bolder btn-sm">Previous</a>
                          <?php
                          }
                        }
                        ?>
                        <a href="index.php?page=stafflist&paging=<?php echo $pagingnext;?>" class="btn btn-success font-weight-bolder btn-sm">Next</a>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-12 col-lg-4"></div>
          </div><br><br>
          <?php
}
include ('view/pages/modal-timetablelist.php'); 
?>

