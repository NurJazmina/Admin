<html>

<?php
$_SESSION["title"] = "Event";
include 'view/partials/_subheader/subheader-v1.php'; 
include ('model/event.php'); 
?>

<form action="index.php?page=event" method="post" name="AddEvent"><br><br>
    <div class="table-responsive" style="width:100%; margin:0 auto; padding: 40px">
        <div class="card card-custom gutter-b">
        
        <div class="card-body">
        
        <div class="form-group row">
            <label class="col-lg-2 col-form-label text-lg-left"><h5>TITLE</h5></label>
            <div class="col-lg-8">
                <input type="text" class="form-control" id="staticStaffNo" name="txttitle"  oninput="let p=this.selectionStart;this.value=this.value.toUpperCase();this.setSelectionRange(p, p);" required>   
            </div>
        </div>
        <div class="form-group row">
        <label class="col-lg-2 col-form-label text-lg-left"><h5>ACCESS TYPE</h5></label>
        <div class="col-lg-8">
            <select class="form-control" id="staticStaffNo" name="txtaccess" style="height: auto;" required>
            <option value="PUBLIC">PUBLIC</option>
            <option value="STAFF">STAFFS</option>
            <option value="TEACHER">TEACHERS</option>
            <option value="VIP">PARENTS</option>
            </select>
        </div>
        </div>
        <div class="form-group row">
        <label class="col-lg-2 col-form-label text-lg-left"><h5>VENUE</h5></label>
        <div class="col-lg-8">
            <input type="text" class="form-control"  id="staticStaffNo" name="txtEventVenue" required>   
        </div>
        </div>
        <div class="form-group row">
        <label class="col-lg-2 col-form-label text-lg-left"><h5>ADDRESS</h5></label>
        <div class="col-lg-8">
            <input type="text" class="form-control"  id="staticStaffNo" name="txtEventAddress" required>
        </div>
        </div>
        <div class="form-group row">
            <label class="col-lg-2 col-form-label text-lg-left">
            <h5>
                <div class="dropdown" style="">GOOGLE MAPS LINK
                    <img src="assets/media/svg/icons/Code/Question-circle.svg" height="40px" class="btn dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item" href="https://www.google.com.my/maps" target="_blank" style="color:black;">Click here to redirect to googlemaps.com. Select the preferred location, click on "Share" button and choose "Embed a map". Copy the html and please paste it in this field.</a>
                    </div>
                </div>
            </h5>
            </label>
            <div class="col-lg-8">
                <input type="text" class="form-control"  id="staticStaffNo" name="txtEventLocation" required>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-lg-2 col-form-label text-lg-left"><h5>EVENT START</h5></label>
            <div class="col-lg-8">
                <input type="datetime-local" class="form-control" id="staticStaffNo" name="txtEventDateStart">
            </div>
        </div>
        <div class="form-group row"> 
            <label class="col-lg-2 col-form-label text-lg-left"><h5>EVENT END</h5></label>
            <div class="col-lg-8">
                <input type="datetime-local" class="form-control" id="staticStaffNo" name="txtEventDateEnd">
            </div>
        </div>
        <div class="card-footer">
        <div class="row">
            <div class="col-lg-2"></div> 
            <div class="text-right">
                <button type="button"  class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-success" name="AddEvent">Confirm</button>
            </div>
        </div>  
        </div>
    </div>
</form>
</html>
