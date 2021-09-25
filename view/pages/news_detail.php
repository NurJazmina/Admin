<?php
$_SESSION["title"] = "News";
include 'view/partials/_subheader/subheader-v1.php'; 
include 'model/counter.php';

function time_elapsed($Date){
    $bit = array(
        ' year'      => $Date  / 31556926 % 12,
        ' week'      => $Date  / 604800 % 52,
        ' day'       => $Date  / 86400 % 7,
        ' hour'      => $Date  / 3600 % 24,
        ' minute'    => $Date  / 60 % 60,
        ' second'    => $Date  % 60
        );
    foreach($bit as $k => $v){
        if($v > 1)$ret[] = $v . $k . 's';
        if($v == 1)$ret[] = $v . $k;
        }
    array_splice($ret, count($ret)-1, 0, 'and');
    $ret[] = 'ago';

    return join(' ', $ret);
}
$time_now = time();

$filter = ['url'=>$URL];
$query = new MongoDB\Driver\Query($filter);
$cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Views',$query);
foreach ($cursor as $document)
{
    $url = $document->url;
    $count = strval($document->count);
}

$filter = ['_id'=>new \MongoDB\BSON\ObjectId($_GET['id'])];
$query = new MongoDB\Driver\Query($filter);
$cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.News',$query);
foreach ($cursor as $document)
{
    $news_id = strval($document->_id);
    $Staff_id = $document->Staff_id;
    $Title = $document->Title;
    $Details = $document->Details;
    $Date = strval($document->Date);
    $Status = $document->Status;

    $Date = new MongoDB\BSON\UTCDateTime($Date);
    $Date_time = $Date->toDateTime()->setTimezone(new \DateTimeZone(date_default_timezone_get()));
    $Date = date_format($Date_time,"Y-m-d\TH:i:s");
    $Date = new MongoDB\BSON\UTCDateTime((new DateTime($Date))->getTimestamp());
    $Date = strval($Date);

    $filter = ['_id' => new \MongoDB\BSON\ObjectId($Staff_id)];
    $query = new MongoDB\Driver\Query($filter);
    $cursor = $GoNGetzDatabase->executeQuery('GoNGetz.Consumer', $query);
    foreach ($cursor as $document1)
    {
        $consumer_id = strval($document1->_id);
        $ConsumerFName = $document1->ConsumerFName;
        $ConsumerLName = $document1->ConsumerLName;

        $filter = ['ConsumerID'=>$consumer_id];
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
                $DepartmentName = $document3->DepartmentName;
            }
        }
    }
    $total = 0;
    $filter = ['news_id'=>$_GET['id'], 'news'=>'0'];
    $option = ['sort' => ['_id' => 1]];
    $query = new MongoDB\Driver\Query($filter,$option);
    $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.SchoolNewsComment',$query);
    foreach ($cursor as $document2)
    {
        $total = $total + 1;
    }
}
?>
<div class="text-dark-50 text-center"><h1><?= $Title; ?></h1></div>
<div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
        <div class="modal-body ribbon ribbon-right rounded">
            <div class="ribbon-target bg-warning" style="top: 10px; right: -2px;">Views : <?= $count; ?></div>
            <div class="mt-6">
                <a align="justify"><?= $Details; ?></a>
            </div>
            <div class="text-muted">
                <small><?= $ConsumerFName; ?></small>
                <span>|</span>
                <small><?= date_format($Date_time,"d/m/y"); echo " ( ".time_elapsed($time_now-$Date)." ) \n"; ?></small>
                <span>|</span>
                <small>Commenting : <?= $total; ?></small>
            </div>
        </div>
        <div class="modal-footer">
            <div class="card">
                <!--begin::Body-->
                <div class="card-body d-flex flex-column">
                    <div class="text-center text-dark-50">
                        <h1>Coming Soon!</h1>
                        <h5>We are working hard to give you a better experience.</h5>
                        <p id="uc__description">
                            Features
                            <span class="svg-icon svg-icon-1x">
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                    <g  stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                        <rect x="0" y="0" width="24" height="24"/>
                                        <path d="M12.6571817,10 L12.6571817,5.67013288 C12.6571817,5.25591932 12.3213953,4.92013288 11.9071817,4.92013288 C11.7234961,4.92013288 11.5461972,4.98754181 11.4089088,5.10957589 L4.25168161,11.4715556 C3.94209454,11.7467441 3.91420899,12.2207984 4.1893975,12.5303855 C4.19915701,12.541365 4.209237,12.5520553 4.21962441,12.5624427 L11.3768516,19.7196699 C11.6697448,20.0125631 12.1446186,20.0125631 12.4375118,19.7196699 C12.5781641,19.5790176 12.6571817,19.3882522 12.6571817,19.1893398 L12.6571817,15 C14.004369,14.9188289 16.83481,14.9157978 21.1485046,14.9909069 L21.1485051,14.9908794 C21.4245904,14.9956866 21.6522988,14.7757721 21.6571059,14.4996868 C21.6571564,14.4967857 21.6571817,14.4938842 21.6571817,14.4909827 L21.6572352,10.5050185 C21.6572352,10.2288465 21.4333536,10.0049649 21.1571817,10.0049649 C21.1555649,10.0049649 21.1539481,10.0049728 21.1523314,10.0049884 C16.0215539,10.0547574 13.1898373,10.0530946 12.6571817,10 Z" fill="#000000" fill-rule="nonzero" transform="translate(12.828591, 12.429736) scale(-1, 1) translate(-12.828591, -12.429736) "/>
                                    </g>
                                </svg>
                            </span>
                            Commenting<br>We promise, it will be worth the wait!
                        </p>
                    </div>
                </div>
                <!--end::Body-->
                <div class="row">
                    <div class="col-3"></div>
                    <div class="col-6">
                        <img src="assets/media/bg/construction2.png" class="img-fluid" alt="...">
                    </div>
                    <div class="col-3"></div>
                </div>
            </div>
        </div>
    </div>
</div>