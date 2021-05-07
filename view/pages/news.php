<html>
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

<body>
<?php
$_SESSION["title"] = "News";
?>
<?php include 'view/partials/_subheader/subheader-v1.php'; ?>

<?php include ('model/news.php'); ?>
<div><br><br><br><h1 style="color:#696969; text-align:center">News</h1></div><br>
<div class="row">
<?php
  $filterA = ['school_id'=>$_SESSION["loggeduser_schoolID"],'SchoolNewsAccess'=>$ConsumerGroupName.$_SESSION["loggeduser_StaffLevel"]];
  $optionA = ['limit'=>100,'sort' => ['_id' => -1]];
  $queryA = new MongoDB\Driver\Query($filterA,$optionA );
  $cursorA = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.SchoolNews',$queryA);
  foreach ($cursorA as $documentA)
  {
    $Newsid = strval($documentA->_id);
    $SchoolNewsStaff_id = ($documentA->SchoolNewsStaff_id);
    $schoolNewsTitle = ($documentA->schoolNewsTitle);
    $schoolNewsDetails = ($documentA->schoolNewsDetails);
    $SchoolNewsDate = ($documentA->SchoolNewsDate);
    $SchoolNewsStatus = ($documentA->SchoolNewsStatus);
    $Access = ($documentA->SchoolNewsAccess);
    
    $id = new \MongoDB\BSON\ObjectId($SchoolNewsStaff_id);
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
    $utcdatetime = new MongoDB\BSON\UTCDateTime(strval($SchoolNewsDate));
    $datetime = $utcdatetime->toDateTime()->setTimezone(new \DateTimeZone(date_default_timezone_get()));
    ?>

  <!--begin::staff-->
  <div class="col-lg-4">
      <div class="card card-custom gutter-b">
          <div class="card-header">
            <div class="card-title">
              <strong><a href="index.php?page=newsdetail&id=<?php echo $Newsid ; ?>"><?php echo $schoolNewsTitle; ?></a></strong>
            </div>
          </div>
          <div class="card-body">
            <div class="text4 eventdate">
              <span class="eventdate-day"><?php echo date_format($datetime,"d"); ?></span>
              <span class="eventdate-month"><?php echo date_format($datetime,"M"); ?></span> 
            </div>
            <div class="eventtitle">
              <span class="claimedRight" style="color:black"><?php echo $schoolNewsDetails; ?></span><br>
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
  $filterA = ['school_id'=>$_SESSION["loggeduser_schoolID"],'SchoolNewsAccess'=>'PUBLIC'];
  $optionA = ['limit'=>100,'sort' => ['_id' => -1]];
  $queryA = new MongoDB\Driver\Query($filterA,$optionA );
  $cursorA = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.SchoolNews',$queryA);
  foreach ($cursorA as $documentA)
  {
    $Newsid = strval($documentA->_id);
    $SchoolNewsStaff_id = ($documentA->SchoolNewsStaff_id);
    $schoolNewsTitle = ($documentA->schoolNewsTitle);
    $schoolNewsDetails = ($documentA->schoolNewsDetails);
    $SchoolNewsDate = ($documentA->SchoolNewsDate);
    $SchoolNewsStatus = ($documentA->SchoolNewsStatus);
    $Access = ($documentA->SchoolNewsAccess);

    $id = new \MongoDB\BSON\ObjectId($SchoolNewsStaff_id);
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
    
    $utcdatetime = new MongoDB\BSON\UTCDateTime(strval($SchoolNewsDate));
    $datetime = $utcdatetime->toDateTime()->setTimezone(new \DateTimeZone(date_default_timezone_get()));
    ?>
  <div class="col-lg-4">
      <div class="card card-custom gutter-b">
          <div class="card-header">
            <div class="card-title">
              <strong><a href="index.php?page=newsdetail&id=<?php echo $Newsid ; ?>"><?php echo $schoolNewsTitle; ?></a></strong>
            </div>
          </div>
          <div class="card-body">
            <div class="text4 eventdate">
              <span class="eventdate-day"><?php echo date_format($datetime,"d"); ?></span>
              <span class="eventdate-month"><?php echo date_format($datetime,"M"); ?></span>
            </div>
            <div class="eventtitle">
              <span class="claimedRight" style="color:black"><?php echo $schoolNewsDetails; ?></span><br>
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
</body>
</html>
<!--filter::end::public-->