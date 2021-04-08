<div><br><br><br><h1 style="color:#696969; text-align:center">Latest News</h1></div><br>
<div class="row" >
  <div class="col-md-1 section-1-box wow fadeInUp"></div>
  <div class="col-md-10 section-1-box wow fadeInUp">
<?php
$filter = ['school_id'=> $_SESSION["loggeduser_schoolID"],'SchoolNewsStatus'=>'ACTIVE'];
$option = ['sort' => ['_id' => -1],'limit'=>10];
$query = new MongoDB\Driver\Query($filter, $option);
$cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.SchoolNews',$query);

foreach ($cursor as $document)
{
    $Newsid = strval($document->_id);
    $SchoolNewsStaff_id = ($document->SchoolNewsStaff_id);
    $schoolNewsTitle = ($document->schoolNewsTitle);
    $schoolNewsDetails = ($document->schoolNewsDetails);
    $SchoolNewsDate = ($document->SchoolNewsDate);
    $SchoolNewsStatus = ($document->SchoolNewsStatus);
    $SchoolNewsAccess = ($document->SchoolNewsAccess);

    $utcdatetime = new MongoDB\BSON\UTCDateTime(strval($SchoolNewsDate));
    $datetime = $utcdatetime->toDateTime()->setTimezone(new \DateTimeZone(date_default_timezone_get()));

    $varstaffid = new \MongoDB\BSON\ObjectId($SchoolNewsStaff_id);
    $filter1 = ['_id' => $varstaffid];
    $query1 = new MongoDB\Driver\Query($filter1);
    $cursor1 = $GoNGetzDatabase->executeQuery('GoNGetz.Consumer', $query1);
    foreach ($cursor1 as $document1)
    {
    $ConsumerFName = ($document1->ConsumerFName);
    $ConsumerLName = ($document1->ConsumerLName);
    }
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