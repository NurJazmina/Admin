<?php
$_SESSION["title"] = "Personal Calendar";
include 'view/partials/_subheader/subheader-v1.php';
include 'model/Calendar.php';
?>
<link href="assets/css/calendar.css" rel="stylesheet" type="text/css">
<div class="row">
    <div class="col-sm">
        <div class="card card-custom card-stretch">
            <div class="modal-header text-dark-50">
                <h3>To do List</h3>
            </div>
            <div class="card-body">
                <form name="add_calendar" action="index.php?page=personal_calendar&paging=0" method="post">
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
                    <!-- <div class="form-group">
                        <label>Color</label>
                        <select class="form-control form-control-sm" name="color" required>
                            <option value="warning" selected>Yellow</option>
                            <option value="green">Green</option>
                            <option value="primary">Blue</option>
                            <option value="danger">Red</option>
                            <option value="success">Mint</option>
                            <option value="info">Indigo</option>
                            <option value="frozen">Frozen</option>
                        </select>
                    </div> -->
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
                <div class="d-flex">
                    <a href="index.php?page=personal_calendar&paging=<?= $previous;?>" class="btn btn-success btn-hover-light btn-sm mr-1"><i class="flaticon2-left-arrow icon-md"></i></a>
                    <a href="index.php?page=personal_calendar&paging=<?= $next;?>" class="btn btn-success btn-hover-light btn-sm mr-1"><i class="flaticon2-right-arrow icon-md"></i></a>
                    <a href="index.php?page=personal_calendar&paging=0" class="btn btn-success btn-hover-light btn-sm mr-1">Today</a>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <h3 class="text-dark-50 text-center"><?= $date_paging_header; ?></h3>
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
                    <form name="detail" action="index.php?page=personal_calendar&paging=0" method="post" class="m-2">
                        <input type="hidden" name="calendar_id" value="<?= $calendar_id; ?>">
                        <button type="submit" class="btn btn-outline-success btn-sm btn-pill" name="detail"><?= $Title ?></button>
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