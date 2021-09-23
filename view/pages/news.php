<?php
$_SESSION["title"] = "News";
include 'view/partials/_subheader/subheader-v1.php';
include ('model/news.php'); 
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
<div class="text-dark-50 text-center"><h1>News</h1></div>
<div class="row">
  <?php
  $filter = ['School_id'=>$_SESSION["loggeduser_school_id"],'Access'=>$_SESSION["loggeduser_ACCESS"]];
  $option = ['limit'=>100,'sort' => ['_id' => -1]];
  $query = new MongoDB\Driver\Query($filter,$option);
  $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.News',$query);
  foreach ($cursor as $document)
  {
    $news_id = strval($document->_id);
    $Staff_id = $document->Staff_id;
    $Title = $document->Title;
    $Details = $document->Details;
    $Date = strval($document->Date);
    $Status = $document->Status;
    $Access = $document->Access;

    $Date = new MongoDB\BSON\UTCDateTime($Date);
    $Date_time = $Date->toDateTime()->setTimezone(new \DateTimeZone(date_default_timezone_get()));
    $Date = date_format($Date_time,"Y-m-d\TH:i:s");
    $Date = new MongoDB\BSON\UTCDateTime((new DateTime($Date))->getTimestamp());
    $Date = strval($Date);
    
    $filter = ['_id' => new \MongoDB\BSON\ObjectId($Staff_id)];
    $query = new MongoDB\Driver\Query($filter);
    $cursor = $GoNGetzDatabase->executeQuery('GoNGetz.Consumer', $query);
    foreach ($cursor as $document1)
    {
      $consumer_id = strval($document1->_id);
      $ConsumerFName = $document1->ConsumerFName;
      $ConsumerLName = $document1->ConsumerLName;

      $filter = ['ConsumerID'=>$consumer_id];
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
          $DepartmentName = $document3->DepartmentName;
        }
      }
    }
    ?>
    <div class="col-lg-4 mb-3 view view-first">
      <form name="detail" action="index.php?page=news_detail&id=<?= $news_id ?>" method="post">
        <div class="card mask">
          <button type="submit" class="btn btn-hover-light text-left">
            <!-- begin :: display -->
            <div class="mt-5 mx-5">
              <div class="modal-title">
                <label><?= $Title; ?></label>
              </div>
            </div>
            <div class="card p-5" style="height: 8rem;">
              <a class="text-primary mb-1">Detail</a>
              <?= mb_strimwidth($Details, 0,80, "..."); ?>
            </div>
            <div class="p-3 mx-2">
              <div class="text-muted text-lowercase">
                <small><?= $ConsumerFName; ?></small>
                <span>|</span>
                <small>Department : <?= $DepartmentName; ?></small>
                <span>|</span>
                <small><?= date_format($Date_time,"d/m/y"); ?></small>
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
    <!--end::staff-->

    <!--begin::public-->
    <?php
    $filter = ['School_id'=>$_SESSION["loggeduser_school_id"],'Access'=>'PUBLIC'];
    $option = ['limit'=>100,'sort' => ['_id' => -1]];
    $query = new MongoDB\Driver\Query($filter,$option);
    $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.News',$query);
    foreach ($cursor as $document)
    {
      $news_id = strval($document->_id);
      $Staff_id = $document->Staff_id;
      $Title = $document->Title;
      $Details = $document->Details;
      $Date = strval($document->Date);
      $Status = $document->Status;
      $Access = $document->Access;

      $Date = new MongoDB\BSON\UTCDateTime($Date);
      $Date_time = $Date->toDateTime()->setTimezone(new \DateTimeZone(date_default_timezone_get()));
      $Date = date_format($Date_time,"Y-m-d\TH:i:s");
      $Date = new MongoDB\BSON\UTCDateTime((new DateTime($Date))->getTimestamp());
      $Date = strval($Date);

      $filter = ['_id' => new \MongoDB\BSON\ObjectId($Staff_id)];
      $query = new MongoDB\Driver\Query($filter);
      $cursor = $GoNGetzDatabase->executeQuery('GoNGetz.Consumer', $query);
      foreach ($cursor as $document1)
      {
        $consumer_id = strval($document1->_id);
        $ConsumerFName = $document1->ConsumerFName;
        $ConsumerLName = $document1->ConsumerLName;

        $filter = ['ConsumerID'=>$consumer_id];
        $query = new MongoDB\Driver\Query($filter);
        $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Staff',$query);
        foreach ($cursor as $document2)
        {
          $Staffdepartment = $document2->Staffdepartment;
          $departmentid = new \MongoDB\BSON\ObjectId($Staffdepartment);

          $filter = ['_id'=>$departmentid];
          $query = new MongoDB\Driver\Query($filter);
          $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.SchoolsDepartment',$query);
          foreach ($cursor as $document3)
          {
            $DepartmentName = $document3->DepartmentName;
          }
        }
      }
      ?>
      <div class="col-lg-4 mb-3 view view-first">
        <form name="detail" action="index.php?page=news_detail&id=<?= $news_id ?>" method="post">
          <div class="card mask">
            <button type="submit" class="btn btn-hover-light text-left">
             <!-- begin :: display -->
              <div class="mt-5 mx-5">
                <div class="modal-title">
                  <label><?= $Title; ?></label>
                </div>
              </div>
              <div class="card p-5" style="height: 8rem;">
                <a class="text-primary mb-1">Detail</a>
                <?= mb_strimwidth($Details, 0,80, "..."); ?>
              </div>
              <div class="p-3 mx-2">
                <div class="text-muted text-lowercase">
                    <small><?= $ConsumerFName; ?></small>
                    <span>|</span>
                    <small>Department : <?= $DepartmentName; ?></small>
                    <span>|</span>
                    <small><?= date_format($Date_time,"d/m/y"); ?></small>
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