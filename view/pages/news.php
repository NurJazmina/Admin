<?php
$_SESSION["title"] = "News";
include 'view/partials/_subheader/subheader-v1.php';
include ('model/news.php'); 
?>
<style>
  .text4.eventdate {
    
    font-weight: bold;
    float: left;
    width: 20%;
    height: 140px;
    padding-right:5px;
  }

  .eventtitle {
    
    float: right;
    width: 80%;
    height: 140px;
  }

  /* small devices */
  @media only screen and (max-width: 600px) {
  .card-body {
    font-size: 14px;
    }
}

/* Small devices (portrait tablets and large phones, 600px and up) */
@media only screen and (min-width: 600px) {
  .card-body {
    font-size: 14px;
  }

}

/* Medium devices (landscape tablets, 768px and up) */
@media only screen and (min-width: 768px) {
  .card-body {
    font-size: 15px;
    }
} 

/* Medium devices (landscape tablets, 1024px and up) */
@media only screen and (min-width: 1024px) {
  .card-body {
    font-size: 14px;
    }
} 
</style>
<div>
  <h1 style="color:#696969; text-align:center">News</h1>
</div><br>

<div class="row">
  <?php
  $filter = ['school_id'=>$_SESSION["loggeduser_schoolID"],'NewsAccess'=>$_SESSION["loggeduser_ACCESS"]];
  $option = ['limit'=>100,'sort' => ['_id' => -1]];
  $query = new MongoDB\Driver\Query($filter,$option);
  $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.SchoolNews',$query);
  foreach ($cursor as $document0)
  {
    $Newsid = strval($document0->_id);
    $NewsStaff_id = ($document0->NewsStaff_id);
    $NewsTitle = ($document0->NewsTitle);
    $NewsDetails = ($document0->NewsDetails);
    $NewsDate = ($document0->NewsDate);
    $NewsStatus = ($document0->NewsStatus);
    $Access = ($document0->NewsAccess);
    
    $id = new \MongoDB\BSON\ObjectId($NewsStaff_id);
    $filter = ['_id' => $id];
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
    $utcdatetime = new MongoDB\BSON\UTCDateTime(strval($NewsDate));
    $datetime = $utcdatetime->toDateTime()->setTimezone(new \DateTimeZone(date_default_timezone_get()));
    ?>
    <!--begin::staff-->
    <div class="col-lg-4">
        <div class="card card-custom gutter-b">
            <div class="card-header">
              <div class="card-title">
                <strong><a href="index.php?page=newsdetail&id=<?php echo $Newsid ; ?>"><?php echo $NewsTitle; ?></a></strong>
              </div>
            </div>
            <div class="card-body">
              <div class="text4 eventdate">
                <span class="eventdate-day"><?php echo date_format($datetime,"d"); ?></span>
                <span class="eventdate-month"><?php echo date_format($datetime,"M"); ?></span> 
              </div>
              <div class="eventtitle">
                <span class="claimedRight" style="color:black"><?php echo $NewsDetails; ?></span><br>
                </table>
              </div>
            </div>
            <div class="card-footer">
              <small><?php echo " BY : ".$ConsumerFName." ".$ConsumerLName.",DEPARTMENT : ".$DepartmentName;?></small>
            </div>
        </div>
    </div>
    <?php
    }
    ?>
    <!--end::staff-->

    <!--begin::public-->
    <?php
    $filter = ['school_id'=>$_SESSION["loggeduser_schoolID"],'NewsAccess'=>'PUBLIC'];
    $option = ['limit'=>100,'sort' => ['_id' => -1]];
    $query = new MongoDB\Driver\Query($filter,$option);
    $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.SchoolNews',$query);
    foreach ($cursor as $document0)
    {
      $Newsid = strval($document0->_id);
      $NewsStaff_id = ($document0->NewsStaff_id);
      $NewsTitle = ($document0->NewsTitle);
      $NewsDetails = ($document0->NewsDetails);
      $NewsDate = ($document0->NewsDate);
      $NewsStatus = ($document0->NewsStatus);
      $Access = ($document0->NewsAccess);

      $id = new \MongoDB\BSON\ObjectId($NewsStaff_id);
      $filter = ['_id' => $id];
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
      
      $utcdatetime = new MongoDB\BSON\UTCDateTime(strval($NewsDate));
      $datetime = $utcdatetime->toDateTime()->setTimezone(new \DateTimeZone(date_default_timezone_get()));
      ?>
      <div class="col-lg-4">
        <div class="card card-custom gutter-b">
            <div class="card-header">
              <div class="card-title">
                <strong><a href="index.php?page=newsdetail&id=<?php echo $Newsid ; ?>"><?php echo $NewsTitle; ?></a></strong>
              </div>
            </div>
            <div class="card-body">
              <div class="text4 eventdate">
                <span class="eventdate-day"><?php echo date_format($datetime,"d"); ?></span>
                <span class="eventdate-month"><?php echo date_format($datetime,"M"); ?></span>
              </div>
              <div class="eventtitle">
                <span class="claimedRight" style="color:black"><?php echo $NewsDetails; ?></span><br>
                </table>
              </div>
            </div>
            <div class="card-footer">
              <small><?php echo " BY : ".$ConsumerFName." ".$ConsumerLName.",DEPARTMENT : ".$DepartmentName;?></small>
            </div>
        </div>
      </div>
    <?php
    }
    ?>
</div>
  <!--filter::end::public-->