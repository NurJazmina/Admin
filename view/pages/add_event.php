<?php
$_SESSION["title"] = "Event";
include 'view/partials/_subheader/subheader-v1.php'; 
include ('model/event.php'); 
$from = new MongoDB\BSON\UTCDateTime((new DateTime('now'))->getTimestamp()*1000);
$from = $from->toDateTime()->setTimezone(new \DateTimeZone(date_default_timezone_get()));
$from = date_format($from,"Y-m-d\TH:i:s");

$Due = new MongoDB\BSON\UTCDateTime((new DateTime('now +1 week'))->getTimestamp()*1000);
$Due = $Due->toDateTime()->setTimezone(new \DateTimeZone(date_default_timezone_get()));
$Due = date_format($Due,"Y-m-d\TH:i:s");
?>
<form name="add_event" action="index.php?page=event" method="post">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Forum</h5>
            </div>
            <div class="modal-body">
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Title</label>
                    <div class="col-sm-9">
                        <div class="typeahead">
                            <input type="text" class="form-control" name="title" oninput="let p=this.selectionStart;this.value=this.value.toUpperCase();this.setSelectionRange(p, p);" required>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Venue</label>
                    <div class="col-sm-9">
                        <div class="typeahead">
                            <input type="text" class="form-control" name="venue" required>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Address</label>
                    <div class="col-sm-9">
                        <div class="typeahead">
                            <input type="text" class="form-control" name="address" required>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Access Type</label>
                    <div class="col-sm-9">
                        <select class="form-control" id="kt_bootstrap_select" name="access" required>
                            <option value="PUBLIC">PUBLIC</option>
                            <option value="STAFF">STAFFS</option>
                            <option value="TEACHER">TEACHERS</option>
                            <option value="VIP">PARENTS</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Google Maps Link &nbsp;&nbsp;
                        <i class="flaticon-info text-secondary" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></i>
                        <div class="dropdown-menu">
                            <a class="btn btn-light btn-hover-success btn-sm" href="https://www.google.com.my/maps" target="_blank">Click here to redirect to googlemaps.com. Select the preferred location, click on "Share" button and choose "Embed a map". Copy the html and please paste it in this field.</a>
                        </div>
                    </label>
                    <div class="col-sm-9">
                        <div class="typeahead">
                            <input type="text" class="form-control" name="location" required>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Event Start</label>
                    <div class="col-sm-9">
                        <div class="input-group">
                            <input type="datetime-local" class="form-control" name="date_start" placeholder="Select date" value="<?= $from; ?>" required>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Event End</label>
                    <div class="col-sm-9">
                        <div class="input-group">
                            <input type="datetime-local" class="form-control" name="date_end" placeholder="Select date" value="<?= $Due; ?>" required>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button"  class="btn btn-light btn-sm" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-success btn-sm" name="add_event">Confirm</button>
            </div>
        </div>
    </div>
</form>