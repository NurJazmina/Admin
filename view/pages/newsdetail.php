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
    $total=0;
    $filter2 = ['school_id'=>$_SESSION["loggeduser_schoolID"],'news_id'=>$_GET['id'], 'news'=>'0'];
    $option2 = ['sort' => ['_id' => 1]];
    $query2 = new MongoDB\Driver\Query($filter2,$option2);
    $cursor2 = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.SchoolNewsComment',$query2);

    foreach ($cursor2 as $document2)
    {
    $total = $total + 1;
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
      <div class="card-body" style="color:#687a86; text-align:center">
            <ul style="list-style:none;text-align:center;border-bottom: 3px solid #e7e9ee;margin:0;padding:0;">
                <li>
                <a >Comments 0</a>
                </li>
            </ul>
            <br>
            <div class="row" style="margin:0;">
                <h1 class="title">Coming Soon!</h1>
                <h3 class="intro">
                    We are working hard to give you a better experience.
                </h3>
                <p class="uc__description">
                    We are working hard on our commenting features. We promise, it will be worth the wait!
                </p>
                <!--
                <div class="uc__subscribe">
                    <h3>Get Notified When We Go Live</h3>
                    <div class="uc__form">
                        <form action="#">
                            <input type="email" class="email" placeholder="Email Address..">
                            <input type="submit" class="submit" value="Get Notified">
                        </form>
                    </div>
                </div>
                -->
                <div class="uc__art">
                    <img style="width: 30%;" src="assets/media/svg/construction/under_construction.svg" alt="">
                </div>
            </div>
            <br>
      </div>
    </div>
    </div>
  <div class="col-md-1 section-1-box wow fadeInUp"></div>
</div>

<script type="text/javascript" src='https://cdn.tiny.cloud/1/qagffr3pkuv17a8on1afax661irst1hbr4e6tbv888sz91jc/tinymce/4/tinymce.min.js' referrerpolicy="origin"></script>
<script>
tinymce.init({
  selector: '.newsdetail',
  menubar:false,
  statusbar: false,
  toolbar: false,
  height:50,
});
</script>