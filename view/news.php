<div><br><br><br><h1 style="color:#696969; text-align:center">Latest News</h1></div><br>
<div class="row" >
  <div class="col-md-1 section-1-box wow fadeInUp"></div>
  <div class="col-md-10 section-1-box wow fadeInUp">
<?php

$groupid = new \MongoDB\BSON\ObjectId($_SESSION["loggeduser_ConsumerGroup_id"]);
$filter2 = ['_id' => $groupid];
$query2 = new MongoDB\Driver\Query($filter2);
$cursor2 = $GoNGetzDatabase->executeQuery('GoNGetz.ConsumerGroup', $query2);
foreach ($cursor2 as $document2)
{
    $ConsumerGroupName = strval($document2->ConsumerGroupName);
}

$filter1 = ['SchoolNewsStatus'=>'ACTIVE'];
$query1 = new MongoDB\Driver\Query($filter1);
$cursor1 = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.SchoolNews',$query1);
foreach ($cursor1 as $document1)
{
    $SchoolNewsAccess = ($document1->SchoolNewsAccess);

if ($SchoolNewsAccess=='SCHOOL0')
{
  $filterA = ['SchoolNewsAccess'=>'SCHOOL0'];
  $queryA = new MongoDB\Driver\Query($filterA);
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
    <div class="card">
      <div class="card-header">
        <strong><a href="index.php?page=newsdetail&id=<?php echo $Newsid ; ?>" target="_blank"><?php echo $schoolNewsTitle; ?></a></strong>
      </div>
      <div class="card-body">
        <div class="table-responsive-sm">
            <table class="table table-sm">
            <span class="claimedRight" maxlength="100"><?php echo $schoolNewsDetails; ?></span><br>
            <span class="news-panel-date"><?php echo date_format($datetime,"D, M Y"); ?></span>
            </table>
        </div>
      </div>
      <div class="card-footer">
        <small><?php echo " BY : ".$ConsumerFName." ".$ConsumerLName.",DEPARTMENT : ".$DepartmentName;?></small>
      </div>
    </div><br>
<?php

  }
}
elseif ($SchoolNewsAccess=='SCHOOL1')
{
  $filterB = ['SchoolNewsAccess'=>'SCHOOL1'];
  $queryB = new MongoDB\Driver\Query($filterB);
  $cursorB = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.SchoolNews',$queryB);
  foreach ($cursorB as $documentB)
  {
    $Newsid = strval($documentB->_id);
    $SchoolNewsStaff_id = ($documentB->SchoolNewsStaff_id);
    $schoolNewsTitle = ($documentB->schoolNewsTitle);
    $schoolNewsDetails = ($documentB->schoolNewsDetails);
    $SchoolNewsDate = ($documentB->SchoolNewsDate);
    $SchoolNewsStatus = ($documentB->SchoolNewsStatus);
    $Access = ($documentB->SchoolNewsAccess);
    //echo $Access;

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
    <div class="card">
      <div class="card-header">
        <strong><a href="index.php?page=newsdetail&id=<?php echo $Newsid ; ?>" target="_blank"><?php echo $schoolNewsTitle; ?></a></strong>
      </div>
      <div class="card-body">
        <div class="table-responsive-sm">
            <table class="table table-sm">
            <span class="claimedRight" maxlength="100"><?php echo $schoolNewsDetails; ?></span><br>
            <span class="news-panel-date"><?php echo date_format($datetime,"D, M Y"); ?></span>
            </table>
        </div>
      </div>
      <div class="card-footer">
        <small><?php echo " BY : ".$ConsumerFName." ".$ConsumerLName.",DEPARTMENT : ".$DepartmentName;?></small>
      </div>
    </div><br>
<?php

  }
}
elseif ($SchoolNewsAccess=='VIP')
{
  $filterC = ['SchoolNewsAccess'=>'VIP'];
  $queryC = new MongoDB\Driver\Query($filterC);
  $cursorC = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.SchoolNews',$queryC);
  foreach ($cursorC as $documentC)
  {
    $Newsid = strval($documentC->_id);
    $SchoolNewsStaff_id = ($documentC->SchoolNewsStaff_id);
    $schoolNewsTitle = ($documentC->schoolNewsTitle);
    $schoolNewsDetails = ($documentC->schoolNewsDetails);
    $SchoolNewsDate = ($documentC->SchoolNewsDate);
    $SchoolNewsStatus = ($documentC->SchoolNewsStatus);
    $Access = ($documentC->SchoolNewsAccess);

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
    <div class="card">
      <div class="card-header">
        <strong><a href="index.php?page=newsdetail&id=<?php echo $Newsid ; ?>" target="_blank"><?php echo $schoolNewsTitle; ?></a></strong>
      </div>
      <div class="card-body">
        <div class="table-responsive-sm">
            <table class="table table-sm">
            <span class="claimedRight" maxlength="100"><?php echo $schoolNewsDetails; ?></span><br>
            <span class="news-panel-date"><?php echo date_format($datetime,"D, M Y"); ?></span>
            </table>
        </div>
      </div>
      <div class="card-footer">
        <small><?php echo " BY : ".$ConsumerFName." ".$ConsumerLName.",DEPARTMENT : ".$DepartmentName;?></small>
      </div>
    </div><br>
<?php

  }
}
else
{
  $filterD = [NULL];
  $queryD = new MongoDB\Driver\Query($filterD);
  $cursorD = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.SchoolNews',$queryD);
  foreach ($cursorD as $documentD)
  {
    $Newsid = strval($documentD->_id);
    $SchoolNewsStaff_id = ($documentD->SchoolNewsStaff_id);
    $schoolNewsTitle = ($documentD->schoolNewsTitle);
    $schoolNewsDetails = ($documentD->schoolNewsDetails);
    $SchoolNewsDate = ($documentD->SchoolNewsDate);
    $SchoolNewsStatus = ($documentD->SchoolNewsStatus);
    $SchoolNewsAccess = ($documentD->SchoolNewsAccess);

    $utcdatetime = new MongoDB\BSON\UTCDateTime(strval($SchoolNewsDate));
    $datetime = $utcdatetime->toDateTime()->setTimezone(new \DateTimeZone(date_default_timezone_get()));
  }
  ?>
    <div class="card">
      <div class="card-header">
        <strong><a href="index.php?page=newsdetail&id=<?php echo $Newsid ; ?>" target="_blank"><?php echo $schoolNewsTitle; ?></a></strong>
      </div>
      <div class="card-body">
        <div class="table-responsive-sm">
            <table class="table table-sm">
            <span class="claimedRight" maxlength="100"><?php echo $schoolNewsDetails; ?></span><br>
            <span class="news-panel-date"><?php echo date_format($datetime,"D, M Y"); ?></span>
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
<script>
    //Limit characters displayed in span
    $(document).ready(function(){
    $('.claimedRight').each(function (f) {
        var newstr = $(this).text().substring(0,100);
        $(this).text(newstr);

        });
    })
    </script>
<?php
}
?>
  </div>
  <div class="col-md-1 section-1-box wow fadeInUp"></div>
</div>
