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
$cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Event',$query);
foreach ($cursor as $document)
{
    $event_id = strval($document->_id);
    $Staff_id = $document->Staff_id;
    $Title = $document->Title;
    $Venue = $document->Venue;
    $Address = $document->Address;
    $Location = $document->Location;
    $Date_start = $document->Date_start;
    $Date_end = $document->Date_end;
    $Status = $document->Status;

    $Date_start = new MongoDB\BSON\UTCDateTime(strval($Date_start));
    $Date_start = $Date_start->toDateTime()->setTimezone(new \DateTimeZone(date_default_timezone_get()));

    $Date_end = new MongoDB\BSON\UTCDateTime(strval($Date_end));
    $Date_end = $Date_end->toDateTime()->setTimezone(new \DateTimeZone(date_default_timezone_get()));

    $filter = ['_id' => new \MongoDB\BSON\ObjectId($Staff_id)];
    $query = new MongoDB\Driver\Query($filter);
    $cursor = $GoNGetzDatabase->executeQuery('GoNGetz.Consumer', $query);
    foreach ($cursor as $document1)
    {
        $staff_id = strval($document1->_id);
        $ConsumerFName = $document1->ConsumerFName;
        $ConsumerLName = $document1->ConsumerLName;

        $filter = ['ConsumerID'=>$staff_id];
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
                $DepartmentName = ($document3->DepartmentName);
            }
        }
    }

}
?>
<div class="text-dark-50 text-center m-5">
    <h1><?= $Title; ?></h1>
</div>
<div class="row">
    <div class="col-2"></div>
    <div class="col-8">
        <div class="card ribbon ribbon-right shadow rounded">
            <div class="ribbon-target bg-warning" style="top: 10px; right: -2px;">Views : <?= $count; ?></div>
            <div class="p-5 mt-5 mx-5">
                <div class="row">
                    <div class="col-sm-6">
                        <a class="text-primary mb-1">Date</a>
                        <p><?= date_format($Date_start,"d M Y H:i")." "; ?>to<?= " ".date_format($Date_end,"d M Y H:i"); ?></p>
                    </div>
                    <div class="col-sm-6">
                        <a class="text-primary mb-1">Venue</a>
                        <p><?= $Venue; ?></p>
                        <p class="mb-3"><i class="fas fa-map-marker-alt text-primary"></i>&nbsp;&nbsp;<?= $Address; ?></p>
                        <?= $Location; ?>
                    </div>
                </div>
            </div>
            <div class="mx-5 mb-3">
                <div class="text-muted">
                <small><?= " BY : ".$ConsumerFName." ".$ConsumerLName.",DEPARTMENT : ".$DepartmentName;?></small>
                </div>
            </div>
            <div class="separator separator-solid separator-border-1"></div>
            <div class="p-5 text-center text-dark-50">
                <div class="row" style="margin:0;">
                    <h1 class="title">Coming Soon!</h1>
                    <h3 class="intro">
                        We are working hard to give you a better experience.
                    </h3>
                    <p class="uc__description">
                        Features
                        <span class="svg-icon icon-secondary">
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
            </div>
        </div>
    <div class="col-2"></div>
</div>
