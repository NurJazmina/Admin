<?php
$_SESSION["title"] = "News";
?>
<?php include 'view/partials/_subheader/subheader-v1.php'; ?>

<?php
$id = new \MongoDB\BSON\ObjectId($_GET['id']);
$filter = ['_id'=>$id];
$query = new MongoDB\Driver\Query($filter);
$cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.SchoolNews',$query);
foreach ($cursor as $document)
{
    $Newsid = strval($document->_id);
    $SchoolNewsStaff_id = ($document->SchoolNewsStaff_id);
    $schoolNewsTitle = ($document->schoolNewsTitle);
    $schoolNewsDetails = ($document->schoolNewsDetails);
    $SchoolNewsDate = ($document->SchoolNewsDate);
    $SchoolNewsStatus = ($document->SchoolNewsStatus);

    $utcdatetime = new MongoDB\BSON\UTCDateTime(strval($SchoolNewsDate));
    $datetime = $utcdatetime->toDateTime()->setTimezone(new \DateTimeZone(date_default_timezone_get()));

    $staffid = new \MongoDB\BSON\ObjectId($SchoolNewsStaff_id);
    $filter1 = ['_id' => $staffid];
    $query1 = new MongoDB\Driver\Query($filter1);
    $cursor1 = $GoNGetzDatabase->executeQuery('GoNGetz.Consumer', $query1);
    foreach ($cursor1 as $document1)
    {
        $consumerid = strval($document1->_id);
        $ConsumerFName = ($document1->ConsumerFName);
        $ConsumerLName = ($document1->ConsumerLName);
        $ConsumerIDType = ($document1->ConsumerIDType);
        $ConsumerIDNo = ($document1->ConsumerIDNo);
        $ConsumerEmail = ($document1->ConsumerEmail);
        $ConsumerPhone = ($document1->ConsumerPhone);
        $ConsumerAddress = ($document1->ConsumerAddress);
        $ConsumerStatus = ($document1->ConsumerStatus);

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

}
?>
<div><br><br><br><h1 style="color:#696969; text-align:center"><?php echo $schoolNewsTitle; ?></h1></div><br>
<div class="row" >
  <div class="col-md-1 section-1-box wow fadeInUp"></div>
  <div class="col-md-10 section-1-box wow fadeInUp">
    <div class="card">
      <div class="card-body">
        <div class="table-responsive-sm">
            <table class="table">
            <span class="claimedRight" maxlength="100"><?php echo $schoolNewsDetails; ?></span><br>
            </table>
        </div>
      </div>
      <div class="card-header">
        <small><?php echo " BY : ".$ConsumerFName." ".$ConsumerLName.",DEPARTMENT : ".$DepartmentName;?></small>
        <small><?php echo date_format($datetime,"D, M Y"); ?></small>
      </div>
      <div class="card-body">
      <div id="disqus_thread"></div>
<script>
    /**
    *  RECOMMENDED CONFIGURATION VARIABLES: EDIT AND UNCOMMENT THE SECTION BELOW TO INSERT DYNAMIC VALUES FROM YOUR PLATFORM OR CMS.
    *  LEARN WHY DEFINING THESE VARIABLES IS IMPORTANT: https://disqus.com/admin/universalcode/#configuration-variables    */
    /*
    var disqus_config = function () {
    this.page.url = PAGE_URL;  // Replace PAGE_URL with your page's canonical URL variable
    this.page.identifier = PAGE_IDENTIFIER; // Replace PAGE_IDENTIFIER with your page's unique identifier variable
    };
    */
    (function() { // DON'T EDIT BELOW THIS LINE
    var d = document, s = d.createElement('script');
    s.src = 'https://smartschoolgongetz.disqus.com/embed.js';
    s.setAttribute('data-timestamp', +new Date());
    (d.head || d.body).appendChild(s);
    })();
</script>
<noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>
      </div>
    </div>
    </div>
  <div class="col-md-1 section-1-box wow fadeInUp"></div>
</div>
