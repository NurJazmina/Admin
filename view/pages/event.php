<style>

  .div1 {
    
    width: 300px;
    height: 180px;
    
    border: 2px solid black;
  }

</style>
<?php
$_SESSION["title"] = "Event";
include 'view/partials/_subheader/subheader-v1.php'; 
?>

<?php include ('model/event.php'); ?>
<div><br><br><br><h1 style="color:#696969; text-align:center">Upcoming Event</h1></div><br>
<div class="row" >
  <div class="col-md-0 section-1-box wow fadeInUp"></div>
  <div class="col-md-12 section-1-box wow fadeInUp">
  
  <!--begin::staff-->
  <?php
  $to_date = new MongoDB\BSON\UTCDateTime((new DateTime('now +1 week'))->getTimestamp()*1000);
  $from_date = new MongoDB\BSON\UTCDateTime((new DateTime('now'))->getTimestamp()*1000);

  $filterA = ['school_id'=>$_SESSION["loggeduser_schoolID"],'EventDateStart' => ['$gte' => $from_date,'$lte' => $to_date],'EventAccess'=>$_SESSION["loggeduser_ACCESS"]];
  $optionA = ['limit'=>100,'sort' => ['EventDateStart' => 1]];
  $queryA = new MongoDB\Driver\Query($filterA,$optionA );
  $cursorA = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.SchoolEvent',$queryA);
  foreach ($cursorA as $documentA)
  {
    $eventid = strval($documentA->_id);
    $EventStaff_id = ($documentA->EventStaff_id);
    $EventTitle = ($documentA->EventTitle);
    $EventVenue = ($documentA->EventVenue);
    $EventLocation = ($documentA->EventLocation);
    $EventDateStart = ($documentA->EventDateStart);
    $EventDateEnd = ($documentA->EventDateEnd);
    $EventStatus = ($documentA->EventStatus);

    $utcdatetimeStart = new MongoDB\BSON\UTCDateTime(strval($EventDateStart));
    $datetimeStart = $utcdatetimeStart->toDateTime()->setTimezone(new \DateTimeZone(date_default_timezone_get()));
    $utcdatetimeEnd = new MongoDB\BSON\UTCDateTime(strval($EventDateEnd));
    $datetimeEnd = $utcdatetimeEnd->toDateTime()->setTimezone(new \DateTimeZone(date_default_timezone_get()));
    
    $id = new \MongoDB\BSON\ObjectId($EventStaff_id);
    $filter1 = ['_id' => $id];
    $query1 = new MongoDB\Driver\Query($filter1);
    $cursor1 = $GoNGetzDatabase->executeQuery('GoNGetz.Consumer', $query1);
    foreach ($cursor1 as $document1)
    {
      $consumerid = strval($document1->_id);
      $ConsumerFName = ($document1->ConsumerFName);
      $ConsumerLName = ($document1->ConsumerLName);
      $filter2 = ['ConsumerID'=>$consumerid];
      $query2 = new MongoDB\Driver\Query($filter2);
      $cursor2 = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Staff',$query2);
      foreach ($cursor2 as $document2)
      {
        $Staffdepartment = ($document2->Staffdepartment);
        $departmentid = new \MongoDB\BSON\ObjectId($Staffdepartment);
        $filter3 = ['_id'=>$departmentid];
        $query3 = new MongoDB\Driver\Query($filter3);
        $cursor3 = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.SchoolsDepartment',$query3);
        foreach ($cursor3 as $document3)
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
                  <div class="event-location">
                  <span><i class="fas fa-map-marker-alt"></i><?php echo " ".$EventAddress; ?></span>
                  </div>
                  <div class="div1">
                  <div class="card custom-card gutter-b">
                  <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1991.8816563451512!2d101.71120731333397!3d3.1569911027993234!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xc88666cc8d01d22a!2sSurau%20Suria%20KLCC!5e0!3m2!1sen!2smy!4v1620713415320!5m2!1sen!2smy" ></iframe>
                  <?php echo $EventLocation; ?>
                  </div>
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
  </div>
  <br>
  <!--end::staff-->

<!--begin::public-->
<br>
  <?php
  }
  $to_date = new MongoDB\BSON\UTCDateTime((new DateTime('now +1 week'))->getTimestamp()*1000);
	$from_date = new MongoDB\BSON\UTCDateTime((new DateTime('now'))->getTimestamp()*1000);
  
  $filterA = ['school_id'=>$_SESSION["loggeduser_schoolID"],'EventDateStart' => ['$gte' => $from_date,'$lte' => $to_date],'EventAccess'=>'PUBLIC'];
  $optionA = ['limit'=>100,'sort' => ['SchoolEventDateStart' => 1]];
  $queryA = new MongoDB\Driver\Query($filterA,$optionA );
  $cursorA = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.SchoolEvent',$queryA);
  foreach ($cursorA as $documentA)
  {
    $eventid = strval($documentA->_id);
    $EventStaff_id = ($documentA->EventStaff_id);
    $EventTitle = ($documentA->EventTitle);
    $EventVenue = ($documentA->EventVenue);
    $EventLocation = ($documentA->EventLocation);
    $EventDateStart = ($documentA->EventDateStart);
    $EventDateEnd = ($documentA->EventDateEnd);
    $EventStatus = ($documentA->EventStatus);

    $utcdatetimeStart = new MongoDB\BSON\UTCDateTime(strval($EventDateStart));
    $datetimeStart = $utcdatetimeStart->toDateTime()->setTimezone(new \DateTimeZone(date_default_timezone_get()));
    $utcdatetimeEnd = new MongoDB\BSON\UTCDateTime(strval($EventDateEnd));
    $datetimeEnd = $utcdatetimeEnd->toDateTime()->setTimezone(new \DateTimeZone(date_default_timezone_get()));

    $id = new \MongoDB\BSON\ObjectId($EventStaff_id);
    $filter1 = ['_id' => $id];
    $query1 = new MongoDB\Driver\Query($filter1);
    $cursor1 = $GoNGetzDatabase->executeQuery('GoNGetz.Consumer', $query1);
    foreach ($cursor1 as $document1)
    {
        $consumerid = strval($document1->_id);
        $ConsumerFName = ($document1->ConsumerFName);
        $ConsumerLName = ($document1->ConsumerLName);
        $filter2 = ['ConsumerID'=>$consumerid];
        $query2 = new MongoDB\Driver\Query($filter2);
        $cursor2 = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Staff',$query2);
        foreach ($cursor2 as $document2)
        {
            $Staffdepartment = ($document2->Staffdepartment);
            $departmentid = new \MongoDB\BSON\ObjectId($Staffdepartment);

            $filter3 = ['_id'=>$departmentid];
            $query3 = new MongoDB\Driver\Query($filter3);
            $cursor3 = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.SchoolsDepartment',$query3);
            foreach ($cursor3 as $document3)
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
                <span><i class="fas fa-map-marker-alt"></i><?php echo " ".$EventAddress; ?></span>
                </div>
                <br>
                <div class="div1">
                <div class="card custom-card gutter-b">
                  <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1991.8816563451512!2d101.71120731333397!3d3.1569911027993234!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xc88666cc8d01d22a!2sSurau%20Suria%20KLCC!5e0!3m2!1sen!2smy!4v1620713415320!5m2!1sen!2smy" ></iframe>
                  <?php echo $EventLocation; ?>
                </div>
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
  <?php
  }
  ?>
  </div>
<!--begin::public-->
  <div class="col-md-1 section-1-box wow fadeInUp"></div>
</div>
