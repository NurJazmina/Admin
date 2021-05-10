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
                    Features
                    <span class="svg-icon svg-icon-info svg-icon-2x"><!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\themes\metronic\theme\html\demo1\dist/../src/media/svg/icons\Communication\Forward.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                        <g  stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <rect x="0" y="0" width="24" height="24"/>
                            <path d="M12.6571817,10 L12.6571817,5.67013288 C12.6571817,5.25591932 12.3213953,4.92013288 11.9071817,4.92013288 C11.7234961,4.92013288 11.5461972,4.98754181 11.4089088,5.10957589 L4.25168161,11.4715556 C3.94209454,11.7467441 3.91420899,12.2207984 4.1893975,12.5303855 C4.19915701,12.541365 4.209237,12.5520553 4.21962441,12.5624427 L11.3768516,19.7196699 C11.6697448,20.0125631 12.1446186,20.0125631 12.4375118,19.7196699 C12.5781641,19.5790176 12.6571817,19.3882522 12.6571817,19.1893398 L12.6571817,15 C14.004369,14.9188289 16.83481,14.9157978 21.1485046,14.9909069 L21.1485051,14.9908794 C21.4245904,14.9956866 21.6522988,14.7757721 21.6571059,14.4996868 C21.6571564,14.4967857 21.6571817,14.4938842 21.6571817,14.4909827 L21.6572352,10.5050185 C21.6572352,10.2288465 21.4333536,10.0049649 21.1571817,10.0049649 C21.1555649,10.0049649 21.1539481,10.0049728 21.1523314,10.0049884 C16.0215539,10.0547574 13.1898373,10.0530946 12.6571817,10 Z" fill="#000000" fill-rule="nonzero" transform="translate(12.828591, 12.429736) scale(-1, 1) translate(-12.828591, -12.429736) "/>
                        </g>
                    </svg><!--end::Svg Icon--></span>
                    Commenting<br>We promise, it will be worth the wait!
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