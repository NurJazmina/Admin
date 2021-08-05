<?php
$_SESSION["title"] = "Event";
include 'view/partials/_subheader/subheader-v1.php'; 
include ('model/event.php'); 
?>
<div class="container">
    <div class="card card-custom gutter-b example example-compact">
        <div class="card-header">
            <h3 class="card-title">Add Event</h3>
            <div class="card-toolbar">
            </div>
        </div>
        <form class="form" id="kt_form" action="index.php?page=event" method="post" name="AddEvent">
            <div class="card-body">
                <div class="form-group">
                    <div class="alert alert-light-primary d-none mb-15" role="alert" id="kt_form_msg">
                        <div class="alert-icon">
                            <i class="la la-warning"></i>
                        </div>
                        <div class="alert-text font-weight-bold">
                            Oh snap! Change a few things up and try submitting again.
                        </div>
                        <div class="alert-close">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span><i class="ki ki-close "></i></span>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-form-label col-lg-3 col-sm-12 text-right">Title</label>
                    <div class="col-lg-4 col-md-9 col-sm-12">
                        <div class="typeahead">
                            <input type="text" class="form-control" id="kt_typeahead" name="txttitle" oninput="let p=this.selectionStart;this.value=this.value.toUpperCase();this.setSelectionRange(p, p);" required>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-form-label col-lg-3 col-sm-12 text-right">Venue</label>
                    <div class="col-lg-4 col-md-9 col-sm-12">
                        <div class="typeahead">
                            <input type="text" class="form-control" id="kt_typeahead" name="txtEventVenue" required>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-form-label col-lg-3 col-sm-12 text-right">Address</label>
                    <div class="col-lg-4 col-md-9 col-sm-12">
                        <div class="typeahead">
                            <input type="text" class="form-control" id="kt_typeahead" name="txtEventAddress" required>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-form-label col-lg-3 col-sm-12 text-right">Access Type</label>
                    <div class="col-lg-4 col-md-9 col-sm-12">
                        <select class="form-control" id="kt_bootstrap_select" name="txtaccess" required>
                            <option value="PUBLIC">PUBLIC</option>
                            <option value="STAFF">STAFFS</option>
                            <option value="TEACHER">TEACHERS</option>
                            <option value="VIP">PARENTS</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-form-label col-lg-3 col-sm-12 text-right">Google Maps Link
                        <i class="flaticon-info text-secondary text-hover-success" class="btn dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></i>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item" href="https://www.google.com.my/maps" target="_blank" style="color:black;">Click here to redirect to googlemaps.com. Select the preferred location, click on "Share" button and choose "Embed a map". Copy the html and please paste it in this field.</a>
                        </div>
                    </label>
                    <div class="col-lg-4 col-md-9 col-sm-12">
                        <div class="typeahead">
                            <input type="text" class="form-control" id="kt_typeahead" name="txtEventLocation" required>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-form-label col-lg-3 col-sm-12 text-right">Event Start</label>
                    <div class="col-lg-4 col-md-9 col-sm-12">
                        <div class="input-group">
                            <input type="date" class="form-control" name="txtEventDateStart" placeholder="Select date" id="kt_datepicker" required>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-form-label col-lg-3 col-sm-12 text-right">Event End</label>
                    <div class="col-lg-4 col-md-9 col-sm-12">
                        <div class="input-group">
                            <input type="date" class="form-control" name="txtEventDateEnd" placeholder="Select date" id="kt_datepicker" required>
                        </div>
                    </div>
                </div>
                <div class="separator separator-dashed my-10"></div>
                <div class="row">
                    <div class="col-lg-9 ml-lg-auto">
                        <button type="reset"  class="btn btn-secondary" >Cancel</button>
                        <button type="submit" class="btn btn-success" name="AddEvent">Confirm</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>