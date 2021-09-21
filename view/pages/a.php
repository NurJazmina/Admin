<?php
if (isset($_GET['paging']) && !empty($_GET['paging']))
{
    $next = $_GET['paging']+1;
    $previous = $_GET['paging']-1;
}
else
{
    $next = + 1;
    $previous = - 1;
}
if (isset($_GET['paging']) && !empty($_GET['paging']))
{
    $date_paging = new MongoDB\BSON\UTCDateTime((new DateTime('first day of '.$_GET['paging'].' month'))->getTimestamp()*1000);
    $date_paging = $date_paging->toDateTime()->setTimezone(new \DateTimeZone(date_default_timezone_get()));
    $date_paging = date_format($date_paging,"Y-m-d");
    echo $date_paging;
}
else if (!isset($_GET['paging']) && empty($_GET['paging']))
{
    $date_paging = new MongoDB\BSON\UTCDateTime((new DateTime('now'))->getTimestamp()*1000);
    $date_paging = $date_paging->toDateTime()->setTimezone(new \DateTimeZone(date_default_timezone_get()));
    $date_paging = date_format($date_paging,"Y-m-d");
    echo $date_paging;
}
?>
<a href="index.php?page=a&paging=<?= $previous;?>" class="btn btn-light btn-hover-success btn-sm">Previous</a>
<a href="index.php?page=a&paging=<?= $next;?>" class="btn btn-success btn-hover-light btn-sm">Next</a>