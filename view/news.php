<div><br><br><br><h1 style="color:#696969; text-align:center">Latest News</h1></div><br>
<div class="row" >
  <div class="col-md-1 section-1-box wow fadeInUp"></div>
  <div class="col-md-10 section-1-box wow fadeInUp">
<?php
$id = new \MongoDB\BSON\ObjectId($_SESSION["loggeduser_id"]);
$filter1 = ['_id' => $id];
$query1 = new MongoDB\Driver\Query($filter1);
$cursor1 = $GoNGetzDatabase->executeQuery('GoNGetz.Consumer', $query1);
foreach ($cursor1 as $document1)
{
    $consumerid = strval($document1->_id);
    $ConsumerFName = ($document1->ConsumerFName);
    $ConsumerLName = ($document1->ConsumerLName);
    
    $groupid = new \MongoDB\BSON\ObjectId($document1->ConsumerGroup_id);
    $filter2 = ['_id' => $groupid];
    $query2 = new MongoDB\Driver\Query($filter2);
    $cursor2 = $GoNGetzDatabase->executeQuery('GoNGetz.ConsumerGroup', $query2);
    foreach ($cursor2 as $document2)
    {
        $ConsumerGroupName = strval($document2->ConsumerGroupName);
    }

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

$filter2 = ['SchoolNewsAccess'=>$ConsumerGroupName.$_SESSION["loggeduser_StaffLevel"]];
$query2 = new MongoDB\Driver\Query($filter2);
$cursor2 = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.SchoolNews',$query2);
foreach ($cursor2 as $document2)
{
    $Newsid = strval($document2->_id);
    $SchoolNewsStaff_id = ($document2->SchoolNewsStaff_id);
    $schoolNewsTitle = ($document2->schoolNewsTitle);
    $schoolNewsDetails = ($document2->schoolNewsDetails);
    $SchoolNewsDate = ($document2->SchoolNewsDate);
    $SchoolNewsStatus = ($document2->SchoolNewsStatus);
    $SchoolNewsAccess = ($document2->SchoolNewsAccess);

    $utcdatetime = new MongoDB\BSON\UTCDateTime(strval($SchoolNewsDate));
    $datetime = $utcdatetime->toDateTime()->setTimezone(new \DateTimeZone(date_default_timezone_get()));
    ?>
    <div class="card">
      <div class="card-header">
        <strong><a href="index.php?page=newsdetail&id=<?php echo $Newsid ; ?>" target="_blank"><?php echo $schoolNewsTitle; ?></a></strong>
      </div>
      <div class="card-body">
        <div class="table-responsive-sm">
            <table class="table">
            <span class="claimedRight" maxlength="100"><?php echo $schoolNewsDetails; ?></span><br>
            <span class="news-panel-date"><?php echo date_format($datetime,"D, M Y"); ?></span>
            </table>
        </div>
      </div>
      <div class="card-footer">
        <small><?php echo " BY : ".$ConsumerFName." ".$ConsumerLName.",DEPARTMENT : ".$DepartmentName;?></small>
      </div>
    </div><br>
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
