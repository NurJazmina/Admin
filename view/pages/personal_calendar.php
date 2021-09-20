<?php
$_SESSION["title"] = "Personal Calendar";
include 'view/partials/_subheader/subheader-v1.php';
include 'model/Calendar.php';

$date = date("Y-m-d");
$calendar = new Calendar($date);
//$calendar->add_event('Birthday', '2021-09-03', 1);

// default date start $ date end
$default_date = new MongoDB\BSON\UTCDateTime((new DateTime('now'))->getTimestamp()*1000);
$default_date = $default_date->toDateTime()->setTimezone(new \DateTimeZone(date_default_timezone_get()));
$default_date = date_format($default_date,"Y-m-d\TH:i:s");

$filter = ['Created_by'=>$_SESSION["loggeduser_id"]];
$query = new MongoDB\Driver\Query($filter);
$cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Calendar',$query);
foreach ($cursor as $document)
{
    $calendar_id = strval($document->_id);
    $Title = $document->Title;
    $Color = $document->Color;
    $Date_start = strval($document->Date_start);
    $Date_end = strval($document->Date_end);

    $Date_start = new MongoDB\BSON\UTCDateTime($Date_start);
    $Datetime_Start = $Date_start->toDateTime()->setTimezone(new \DateTimeZone(date_default_timezone_get()));
    $Date_start = date_format($Datetime_Start,"Y-m-d");

    $Date_end = new MongoDB\BSON\UTCDateTime($Date_end);
    $Datetime_End = $Date_end->toDateTime()->setTimezone(new \DateTimeZone(date_default_timezone_get()));
    $Date_end = date_format($Datetime_End,"Y-m-d");

    $date1 = date_create($Date_start);
    
    $date2 = date_create($Date_end);

    //difference between two dates
    $diff = date_diff($date1,$date2);
    $diff = $diff->format("%a");

    $calendar->add_event(mb_strimwidth($Title, 0,9, ".."), $Date_start,$diff + 1, $Color);
}
?>
<link href="assets/css/calendar.css" rel="stylesheet" type="text/css">
<div class="row">
    <div class="col-sm">
        <div class="card card-custom card-stretch">
            <div class="modal-header text-dark-50">
                <h3>To do List</h3>
            </div>
            <div class="card-body">
                <form name="add_calendar" action="index.php?page=personal_calendar" method="post">
                    <div class="form-group">
                        <label>Title <span class="text-danger">*</span></label>
                        <input type="text" class="form-control form-control-sm" name="title" oninput="let p=this.selectionStart;this.value=this.value.toUpperCase();this.setSelectionRange(p, p);" placeholder="Enter new to do" required>
                    </div>
                    <div class="form-group">
                        <label>Detail <span class="text-danger">*</span></label>
                        <input type="text" class="form-control form-control-sm" name="detail" placeholder="description" required>
                    </div>
                    <div class="form-group">
                        <label>Venue <span class="text-danger">*</span></label>
                        <input type="text" class="form-control form-control-sm" name="venue" placeholder="Location" required>
                    </div>
                    <div class="form-group">
                        <label>Color</label>
                        <select class="form-control form-control-sm" name="color" required>
                            <option value="yellow" selected>Yellow</option>
                            <option value="green">Green</option>
                            <option value="blue">Blue</option>
                            <option value="red">Red</option>
                            <option value="red">Mint</option>
                            <option value="indigo">Indigo</option>
                            <option value="frozen">Frozen</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Start</label>
                        <input type="datetime-local" class="form-control form-control-sm" name="date_start" placeholder="Select date" value="<?= $default_date; ?>" required>
                    </div>
                    <div class="form-group">
                        <label>End</label>
                        <input type="datetime-local" class="form-control form-control-sm" name="date_end" placeholder="Select date" value="<?= $default_date; ?>" required>
                    </div>
                    <div class="separator separator-dashed separator-border-2 mb-5"></div>
                    <div class="form-group row">
                        <div class="col-sm-12">
                            <button type="submit" class="btn btn-success btn-hover-light btn-sm btn-block" name="add_calendar">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-sm-7">
        <div class="card card-custom card-stretch">
            <div class="modal-header text-dark-50">
                <h3>Calendar</h3>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <h3 class="text-dark-50 text-center"><?= date("F Y"); ?></h3>
                    <div>
                        <?=$calendar?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm">
        <div class="card card-custom card-stretch">
            <div class="modal-header text-dark-50">
                <h3>List</h3>
            </div>
            <div class="card-body">
                <?php
                $filter = ['Created_by'=>$_SESSION["loggeduser_id"]];
                $query = new MongoDB\Driver\Query($filter);
                $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Calendar',$query);
                foreach ($cursor as $document)
                {
                    $calendar_id = strval($document->_id);
                    $Title = $document->Title;
                    ?>
                    <form name="detail" action="index.php?page=personal_calendar" method="post" class="m-2">
                        <input type="hidden" name="calendar_id" value="<?= $calendar_id; ?>">
                        <button type="submit" class="btn btn-outline-warning btn-sm btn-pill" name="detail"><?= $Title ?></button>
                    </form>
                    <?php
                }
                ?>
                <div class="separator separator-dashed separator-border-2 mt-5 mb-5"></div>
                <?php
                $calendar_id = '';
                if(isset($_POST['detail']))
                {
                    $calendar_id = $_POST['calendar_id'];
                    $filter = ['_id'=> new \MongoDB\BSON\ObjectID($calendar_id)];
                    $query = new MongoDB\Driver\Query($filter);
                    $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Calendar',$query);
                    foreach ($cursor as $document)
                    {
                        $calendar_id = strval($document->_id);
                        $Title = $document->Title;
                        $Detail = $document->Detail;
                        $Venue = $document->Venue;
                        $Color = $document->Color;
                        $Date_start = strval($document->Date_start);
                        $Date_end = strval($document->Date_end);
    
                        $Date_start = new MongoDB\BSON\UTCDateTime($Date_start);
                        $Datetime_Start = $Date_start->toDateTime()->setTimezone(new \DateTimeZone(date_default_timezone_get()));
                        $Date_start = date_format($Datetime_Start,"d F y");
    
                        $Date_end = new MongoDB\BSON\UTCDateTime($Date_end);
                        $Datetime_End = $Date_end->toDateTime()->setTimezone(new \DateTimeZone(date_default_timezone_get()));
                        $Date_end = date_format($Datetime_End,"d F y");
                        ?>
                        <div class="form-group row">
                            <div class="col-sm-3">Title</div>
                            <div class="col-sm-9 border bg-light"><?= $Title; ?></div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-3">Detail</div>
                            <div class="col-sm-9 border bg-light" align="justify"><?= $Detail; ?></div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-3">Venue</div>
                            <div class="col-sm-9 border bg-light"><?= $Venue; ?></div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-3">Start</div>
                            <div class="col-sm-9 border bg-light"><?= $Date_start; ?></div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-3">End</div>
                            <div class="col-sm-9 border bg-light"><?= $Date_end; ?></div>
                        </div>
                        <div class="separator separator-dashed separator-border-2 mb-5"></div>
                        <div class="form-group row text-right">
                            <div class="col-sm-12">
                                <button type="button" class="btn btn-light btn-hover-success btn-sm" data-bs-toggle="modal" data-bs-target="#delete_calendar" data-bs-whatever="<?= $calendar_id; ?>">Delete</button>
                                <button type="button" class="btn btn-success btn-hover-light btn-sm" data-bs-toggle="modal" data-bs-target="#edit_calendar" data-bs-whatever="<?= $calendar_id; ?>">Edit</button>
                            </div>
                        </div>
                        <?php
                    }
                }
                ?>
            </div>
        </div>
    </div>
</div>
<?php include ('view/pages/modal-calendar.php'); ?>