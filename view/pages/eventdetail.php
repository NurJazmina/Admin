<?php
$_SESSION["title"] = "Event";
include 'view/partials/_subheader/subheader-v1.php'; 
include 'model/counter.php'; 

$filter = ['url'=>$URL];
$query = new MongoDB\Driver\Query($filter);
$cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Views',$query);
foreach ($cursor as $document)
{
    $url = strval($document->url);
    $count = strval($document->count);
}

$filter = ['_id'=>new \MongoDB\BSON\ObjectId($_GET['id'])];
$query = new MongoDB\Driver\Query($filter);
$cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.SchoolEvent',$query);
foreach ($cursor as $document)
{
    $eventid = strval($document->_id);
    $EventStaff_id = ($document->EventStaff_id);
    $EventTitle = ($document->EventTitle);
    $EventVenue = ($document->EventVenue);
    $EventAddress = ($document->EventAddress);
    $EventLocation = ($document->EventLocation);
    $EventDateStart = ($document->EventDateStart);
    $EventDateEnd = ($document->EventDateEnd);
    $EventStatus = ($document->EventStatus);

    $utcdatetimeStart = new MongoDB\BSON\UTCDateTime(strval($EventDateStart));
    $datetimeStart = $utcdatetimeStart->toDateTime()->setTimezone(new \DateTimeZone(date_default_timezone_get()));
    $utcdatetimeEnd = new MongoDB\BSON\UTCDateTime(strval($EventDateEnd));
    $datetimeEnd = $utcdatetimeEnd->toDateTime()->setTimezone(new \DateTimeZone(date_default_timezone_get()));

    $filter = ['_id' => new \MongoDB\BSON\ObjectId($EventStaff_id)];
    $query = new MongoDB\Driver\Query($filter);
    $cursor = $GoNGetzDatabase->executeQuery('GoNGetz.Consumer', $query);
    foreach ($cursor as $document1)
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

}
?>
<div><h1 style="color:#696969; text-align:center"><?php echo $EventTitle; ?></h1></div><br>
<div class="row">
    <div class="col-md-1 section-1-box wow fadeInUp"></div>
    <div class="col-md-10 section-1-box wow fadeInUp">
        <div class="card-header ribbon ribbon-clip ribbon-right">
            <div class="card ribbon ribbon-clip ribbon-right" style="background-color:#31a0a4">
                <div class="ribbon-target bg-warning" style="top: 12px;">
                    <span class="ribbon-inner"></span>Views : <?php echo $count; ?>
                </div>
                <div class="card-body">
                    <div class="table-responsive-sm">
                        <table class="table">
                            <div class="event-meta-wrap">
                                <div class="row event-duration" style="color:#FFFFFF">
                                    <div class="col-md-4 event-date"><h6 class="event-meta-tile">Date</h6><?php echo date_format($datetimeStart,"d M Y")." "; ?>to<?php echo " ".date_format($datetimeEnd,"d M Y"); ?></div>
                                        <div class="col-md-3 event-time"><h6 class="event-meta-tile">Time</h6><?php echo date_format($datetimeStart,"H:i"); ?></div>
                                            <div class="col-md-5 event-venue-wrap">
                                                <h6 class="event-meta-tile mb-2">Venue</h6>
                                                <span><?php echo $EventVenue; ?></span>
                                                <div class="event-address">
                                                <br>
                                                    <span><i class="fas fa-map-marker-alt"></i>&nbsp;&nbsp;<?php echo $EventAddress; ?></span>
                                                </div><br>
                                                <p><?php echo $EventLocation; ?></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </table>
                    </div>
                </div>
                <div class="card-header">
                    <small><?php echo " BY : ".$ConsumerFName." ".$ConsumerLName.",DEPARTMENT : ".$DepartmentName;?></small>
                </div>
                <div class="card-footer" style="color:#687a86; text-align:center">
                    <ul style="list-style:none;text-align:center;border-bottom: 3px solid #e7e9ee;margin:0;padding:0;">
                        <li><a>Comments 0</a></li>
                    </ul><br>
                    <div class="row" style="margin:0;">
                        <h1 class="title">Coming Soon!</h1>
                        <h3 class="intro">
                            We are working hard to give you a better experience.
                        </h3>
                        <p class="uc__description">
                            Features
                            <span class="svg-icon svg-icon-info svg-icon-2x">
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                <g  stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <rect x="0" y="0" width="24" height="24"/>
                                    <path d="M12.6571817,10 L12.6571817,5.67013288 C12.6571817,5.25591932 12.3213953,4.92013288 11.9071817,4.92013288 C11.7234961,4.92013288 11.5461972,4.98754181 11.4089088,5.10957589 L4.25168161,11.4715556 C3.94209454,11.7467441 3.91420899,12.2207984 4.1893975,12.5303855 C4.19915701,12.541365 4.209237,12.5520553 4.21962441,12.5624427 L11.3768516,19.7196699 C11.6697448,20.0125631 12.1446186,20.0125631 12.4375118,19.7196699 C12.5781641,19.5790176 12.6571817,19.3882522 12.6571817,19.1893398 L12.6571817,15 C14.004369,14.9188289 16.83481,14.9157978 21.1485046,14.9909069 L21.1485051,14.9908794 C21.4245904,14.9956866 21.6522988,14.7757721 21.6571059,14.4996868 C21.6571564,14.4967857 21.6571817,14.4938842 21.6571817,14.4909827 L21.6572352,10.5050185 C21.6572352,10.2288465 21.4333536,10.0049649 21.1571817,10.0049649 C21.1555649,10.0049649 21.1539481,10.0049728 21.1523314,10.0049884 C16.0215539,10.0547574 13.1898373,10.0530946 12.6571817,10 Z" fill="#000000" fill-rule="nonzero" transform="translate(12.828591, 12.429736) scale(-1, 1) translate(-12.828591, -12.429736) "/>
                                </g>
                            </svg>
                            </span>
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
                            <img style="width: 30%;" src="assets/media/svg/construction/under_construction.svg">
                        </div>
                    </div>
                <br>
                </div>
            </div>
        </div>
    <div class="col-md-1 section-1-box wow fadeInUp"></div>
</div>
