<?php
$_SESSION["title"] = "Event";
include 'view/partials/_subheader/subheader-v1.php'; 
include ('model/event.php'); 
?>
<style>
.view {
  float: left;
  overflow: hidden;
  position: relative;
  text-align: center;
}

.view .mask,
.view .content {
  overflow: hidden;
  bottom: 0;
}

.view.opacity {
    opacity: 1;
}

.view-first .popup {
  transform: translateY(-100px);
  opacity: 0;
  transition: all 0.6s ease-in-out;
}

.view-first:hover .opacity {
  opacity: 0.2;
}

.view-first:hover .popup,
.view-first:hover div.info {
  opacity: 1;
  transform: translateY(0px);
}
</style>
<div class="text-dark-50 text-center"><h1>Upcoming Event</h1></div>
<div class="row">
  <!-- begin::staff -->
  <?php
  $filter = ['School_id'=>$_SESSION["loggeduser_school_id"],'Access'=>$_SESSION["loggeduser_ACCESS"]];
  $option = ['limit'=>100,'sort' => ['Date_start' => 1]];
  $query = new MongoDB\Driver\Query($filter,$option);
  $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Event',$query);
  foreach ($cursor as $document)
  {
    $event_id = strval($document->_id);
    $Staff_id = $document->Staff_id;
    $Title = $document->Title;
    $Venue = $document->Venue;
    $Address = $document->Address;
    $Location = $document->Location;
    $Date_start = $document->Date_start;
    $Date_end = $document->Date_end;
    $Status = $document->Status;

    $Date_start = new MongoDB\BSON\UTCDateTime(strval($Date_start));
    $Date_start = $Date_start->toDateTime()->setTimezone(new \DateTimeZone(date_default_timezone_get()));

    $Date_end = new MongoDB\BSON\UTCDateTime(strval($Date_end));
    $Date_end = $Date_end->toDateTime()->setTimezone(new \DateTimeZone(date_default_timezone_get()));

    $filter = ['_id' => new \MongoDB\BSON\ObjectId($Staff_id)];
    $query = new MongoDB\Driver\Query($filter);
    $cursor = $GoNGetzDatabase->executeQuery('GoNGetz.Consumer', $query);
    foreach ($cursor as $document1)
    {
      $staff_id = strval($document1->_id);
      $ConsumerFName = $document1->ConsumerFName;
      $ConsumerLName = $document1->ConsumerLName;

      $filter = ['ConsumerID'=>$staff_id];
      $query = new MongoDB\Driver\Query($filter);
      $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Staff',$query);
      foreach ($cursor as $document2)
      {
        $Staffdepartment = $document2->Staffdepartment;

        $filter = ['_id'=>new \MongoDB\BSON\ObjectId($Staffdepartment)];
        $query = new MongoDB\Driver\Query($filter);
        $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.SchoolsDepartment',$query);
        foreach ($cursor as $document3)
        {
          $DepartmentName = ($document3->DepartmentName);
        }
      }
    }
    ?>
    <div class="col-lg-4 mb-3 view view-first">
      <form action="index.php?page=event_detail&id=<?= $event_id ?>" method="post">
        <div class="card mask">
          <button type="submit" class="btn btn-hover-light text-left">
            <!-- begin :: display -->
            <div class="mt-5 mx-5">
              <div class="modal-title">
                <label><?= $Title; ?></label>
              </div>
            </div>
            <div class="card p-5">
              <div class="row">
                <div class="col-sm-4">
                  <a class="text-primary mb-1">Date</a>
                  <p><?= date_format($Date_start,"d M Y")." "; ?>to<?= " ".date_format($Date_end,"d M Y"); ?></p>
                </div>
                <div class="col-sm-4">
                  <a class="text-primary mb-1">Address</a>
                  <p><i class="fas fa-map-marker-alt text-primary"></i>&nbsp;&nbsp;<?= mb_strimwidth($Address, 0,30, "..."); ?></p>
                </div>
                <div class="col-sm-4">
                  <a class="text-primary mb-1">Venue</a>
                  <p><?= $Venue; ?></p>
                </div>
              </div>
            </div>
            <div class="p-3 mx-2">
              <div class="text-muted">
                <small><?= " BY : ".$ConsumerFName." ".$ConsumerLName.",DEPARTMENT : ".$DepartmentName;?></small>
              </div>
            </div>
            <!-- end :: display -->
          </button>
          <button class="btn btn-success btn-sm popup m-3" type="submit">More Info</button>
        </div>
      </form>
    </div>
    <?php
  }
  ?>
  <!-- end::staff -->
  <!-- begin::public -->
  <?php
  $filter = ['School_id'=>$_SESSION["loggeduser_school_id"],'Access'=>'PUBLIC'];
  $option = ['limit'=>100,'sort' => ['Date_start' => 1]];
  $query = new MongoDB\Driver\Query($filter,$option);
  $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Event',$query);
  foreach ($cursor as $document)
  {
    $event_id = strval($document->_id);
    $Staff_id = $document->Staff_id;
    $Title = $document->Title;
    $Venue = $document->Venue;
    $Address = $document->Address;
    $Location = $document->Location;
    $Date_start = $document->Date_start;
    $Date_end = $document->Date_end;
    $Status = $document->Status;

    $utcdatetimeStart = new MongoDB\BSON\UTCDateTime(strval($Date_start));
    $Date_start = $utcdatetimeStart->toDateTime()->setTimezone(new \DateTimeZone(date_default_timezone_get()));
    $utcdatetimeEnd = new MongoDB\BSON\UTCDateTime(strval($Date_end));
    $Date_end = $utcdatetimeEnd->toDateTime()->setTimezone(new \DateTimeZone(date_default_timezone_get()));

    $filter = ['_id' => new \MongoDB\BSON\ObjectId($Staff_id)];
    $query = new MongoDB\Driver\Query($filter);
    $cursor = $GoNGetzDatabase->executeQuery('GoNGetz.Consumer', $query);
    foreach ($cursor as $document1)
    {
      $staff_id = strval($document1->_id);
      $ConsumerFName = $document1->ConsumerFName;
      $ConsumerLName = $document1->ConsumerLName;

      $filter = ['ConsumerID'=>$staff_id];
      $query = new MongoDB\Driver\Query($filter);
      $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Staff',$query);
      foreach ($cursor as $document2)
      {
        $Staffdepartment = $document2->Staffdepartment;

        $filter = ['_id'=>new \MongoDB\BSON\ObjectId($Staffdepartment)];
        $query = new MongoDB\Driver\Query($filter);
        $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.SchoolsDepartment',$query);
        foreach ($cursor as $document3)
        {
          $DepartmentName = ($document3->DepartmentName);
        }
      }
    }
    ?>
    <div class="col-lg-4 mb-3 view view-first">
      <form action="index.php?page=event_detail&id=<?= $event_id ?>" method="post"> 
        <div class="card mask">
          <button type="submit" class="btn btn-hover-light text-left">
            <!-- begin :: display -->
            <div class="mt-5 mx-5">
              <div class="modal-title">
                <label><?= $Title; ?></label>
              </div>
            </div>
            <div class="card p-5">
              <div class="row">
                <div class="col-sm-4">
                  <a class="text-primary mb-1">Date</a>
                  <p><?= date_format($Date_start,"d M Y")." "; ?>to<?= " ".date_format($Date_end,"d M Y"); ?></p>
                </div>
                <div class="col-sm-4">
                  <a class="text-primary mb-1">Address</a>
                  <p><i class="fas fa-map-marker-alt text-primary"></i>&nbsp;&nbsp;<?= mb_strimwidth($Address, 0,30, "..."); ?></p>
                </div>
                <div class="col-sm-4">
                  <a class="text-primary mb-1">Venue</a>
                  <p><?= $Venue; ?></p>
                </div>
              </div>
            </div>
            <div class="p-3 mx-2">
              <div class="text-muted">
                <small><?= " BY : ".$ConsumerFName." ".$ConsumerLName.",DEPARTMENT : ".$DepartmentName;?></small>
              </div>
            </div>
            <!-- end :: display -->
          </button>
          <button class="btn btn-success btn-sm popup m-3" type="submit">More Info</button>
        </div>
      </form>
    </div>
    <?php
  }
  ?>
  <!-- end::public -->
</div>
