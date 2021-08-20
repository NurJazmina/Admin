<?php
$_SESSION["title"] = "Event";
include 'view/partials/_subheader/subheader-v1.php'; 
include ('model/event.php'); 
?>
<div><h1 style="color:#696969; text-align:center">Upcoming Event</h1></div><br>
<div class="row">
  <div class="col-md-0 section-1-box wow fadeInUp"></div>
  <div class="col-md-12 section-1-box wow fadeInUp">
    <!--begin::staff-->
    <?php
    $filter = ['school_id'=>$_SESSION["loggeduser_schoolID"],'EventAccess'=>$_SESSION["loggeduser_ACCESS"]];
    $option = ['limit'=>100,'sort' => ['EventDateStart' => 1]];
    $query = new MongoDB\Driver\Query($filter,$option);
    $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.SchoolEvent',$query);
    foreach ($cursor as $document0)
    {
      $eventid = strval($document0->_id);
      $EventStaff_id = ($document0->EventStaff_id);
      $EventTitle = ($document0->EventTitle);
      $EventVenue = ($document0->EventVenue);
      $EventAddress = ($document0->EventAddress);
      $EventLocation = ($document0->EventLocation);
      $EventDateStart = ($document0->EventDateStart);
      $EventDateEnd = ($document0->EventDateEnd);
      $EventStatus = ($document0->EventStatus);

      $utcdatetimeStart = new MongoDB\BSON\UTCDateTime(strval($EventDateStart));
      $datetimeStart = $utcdatetimeStart->toDateTime()->setTimezone(new \DateTimeZone(date_default_timezone_get()));
      $utcdatetimeEnd = new MongoDB\BSON\UTCDateTime(strval($EventDateEnd));
      $datetimeEnd = $utcdatetimeEnd->toDateTime()->setTimezone(new \DateTimeZone(date_default_timezone_get()));
      
      $filter = ['_id' => new \MongoDB\BSON\ObjectId($EventStaff_id)];
      $query = new MongoDB\Driver\Query($filter);
      $cursor = $GoNGetzDatabase->executeQuery('GoNGetz.Consumer', $query);
      foreach ($cursor as $document1)
      {
        $consumerid = strval($document1->_id);
        $ConsumerFName = ($document1->ConsumerFName);
        $ConsumerLName = ($document1->ConsumerLName);

        $filter = ['ConsumerID'=>$consumerid];
        $query = new MongoDB\Driver\Query($filter);
        $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Staff',$query);
        foreach ($cursor as $document2)
        {
          $Staffdepartment = ($document2->Staffdepartment);

          $departmentid = new \MongoDB\BSON\ObjectId($Staffdepartment);
          $filter = ['_id'=>$departmentid];
          $query = new MongoDB\Driver\Query($filter);
          $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.SchoolsDepartment',$query);
          foreach ($cursor as $document3)
          {
              $DepartmentName = ($document3->DepartmentName);
          }
        }
      }
      ?>
      <div class="card">
      <div class="card-header">
        <strong><a href="index.php?page=eventdetail&id=<?php echo $eventid; ?>" ><?php echo $EventTitle; ?></a></strong>
      </div>
      <div class="card-body">
        <div class="table-responsive-sm">
          <table class="table">
              <div class="event-meta-wrap">
                <div class="row event-duration">
                  <div class="col-md-4 event-date"><h6 class="event-meta-tile">Date</h6><?php echo date_format($datetimeStart,"d M Y")." "; ?>to<?php echo " ".date_format($datetimeEnd,"d M Y"); ?></div>
                    <div class="col-md-3 event-time"><h6 class="event-meta-tile">Time</h6><?php echo date_format($datetimeStart,"H:i"); ?></div>
                    <div class="col-md-5 event-venue-wrap">
                      <h6 class="event-meta-tile">Venue</h6>
                      <span><?php echo $EventVenue; ?></span>
                      <div class="event-address">
                        <span><i class="fas fa-map-marker-alt"></i><?php echo $EventAddress; ?></span>
                      </div>
                      <br>
                      <div class="table-responsive-sm">
                        <?php echo $EventLocation; ?>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
          </table>
        </div>
      </div>
      <div class="card-footer">
        <small><?php echo " BY : ".$ConsumerFName." ".$ConsumerLName.",DEPARTMENT : ".$DepartmentName;?></small>
      </div>
  </div><br>
  <!--end::staff-->

  <!--begin::public-->
  <?php
  }
  $filter = ['school_id'=>$_SESSION["loggeduser_schoolID"],'EventAccess'=>'PUBLIC'];
  $option = ['limit'=>100,'sort' => ['EventDateStart' => 1]];
  $query = new MongoDB\Driver\Query($filter,$option);
  $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.SchoolEvent',$query);
  foreach ($cursor as $document0)
  {
    $eventid = strval($document0->_id);
    $EventStaff_id = ($document0->EventStaff_id);
    $EventTitle = ($document0->EventTitle);
    $EventVenue = ($document0->EventVenue);
    $EventLocation = ($document0->EventLocation);
    $EventDateStart = ($document0->EventDateStart);
    $EventDateEnd = ($document0->EventDateEnd);
    $EventStatus = ($document0->EventStatus);

    $utcdatetimeStart = new MongoDB\BSON\UTCDateTime(strval($EventDateStart));
    $datetimeStart = $utcdatetimeStart->toDateTime()->setTimezone(new \DateTimeZone(date_default_timezone_get()));
    $utcdatetimeEnd = new MongoDB\BSON\UTCDateTime(strval($EventDateEnd));
    $datetimeEnd = $utcdatetimeEnd->toDateTime()->setTimezone(new \DateTimeZone(date_default_timezone_get()));

    $filter = ['_id' => new \MongoDB\BSON\ObjectId($EventStaff_id)];
    $query = new MongoDB\Driver\Query($filter);
    $cursor = $GoNGetzDatabase->executeQuery('GoNGetz.Consumer', $query);
    foreach ($cursor as $document1)
    {
        $consumerid = strval($document1->_id);
        $ConsumerFName = ($document1->ConsumerFName);
        $ConsumerLName = ($document1->ConsumerLName);

        $filter = ['ConsumerID'=>$consumerid];
        $query = new MongoDB\Driver\Query($filter);
        $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Staff',$query);
        foreach ($cursor as $document2)
        {
            $Staffdepartment = ($document2->Staffdepartment);
            $departmentid = new \MongoDB\BSON\ObjectId($Staffdepartment);

            $filter = ['_id'=>$departmentid];
            $query = new MongoDB\Driver\Query($filter);
            $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.SchoolsDepartment',$query);
            foreach ($cursor as $document3)
            {
                $DepartmentName = ($document3->DepartmentName);
            }
        }
    }
    ?>
    <div class="card">
      <div class="card-header">
      <strong><a href="index.php?page=eventdetail&id=<?php echo $eventid ; ?>"><?php echo $EventTitle; ?></a></strong><br><br>
      </div>
      <div class="card-body">
        <div class="table-responsive-sm">
          <table class="table">
            <div class="event-meta-wrap">
              <div class="row event-duration">
                <div class="col-md-4 event-date"><h6 class="event-meta-tile">Date</h6><?php echo date_format($datetimeStart,"d M Y")." "; ?>to<?php echo " ".date_format($datetimeEnd,"d M Y"); ?></div>
                  <div class="col-md-3 event-time"><h6 class="event-meta-tile">Time</h6><?php echo date_format($datetimeStart,"H:i"); ?></div>
                    <div class="col-md-5 event-venue-wrap">
                      <h6 class="event-meta-tile">Venue</h6>
                      <span><?php echo $EventVenue; ?></span>
                      <div class="event-address">
                      <span><i class="fas fa-map-marker-alt"></i><?php echo $EventAddress; ?></span>
                      </div>
                      <br>
                      <div class="table-responsive-sm"><?php echo $EventLocation; ?></div>
                    </div>
                </div>
              </div>
            </div>
          </table>
        </div>
      </div>
      <div class="card-footer">
        <small><?php echo " BY : ".$ConsumerFName." ".$ConsumerLName.",DEPARTMENT : ".$DepartmentName;?></small>
      </div>
    </div><br>
    <?php
  }
  ?>
  </div>
  <!--begin::public-->
  <div class="col-md-1 section-1-box wow fadeInUp"></div>
</div>
