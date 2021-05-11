<style>

.nav-item.dropdown {
    /* for Firefox */
        -moz-appearance: none;
    /* for Safari, Chrome, Opera */
        -webkit-appearance: none;
}

</style>

<?php
$_SESSION["title"] = "Event";
?>
<?php include 'view/partials/_subheader/subheader-v1.php'; ?>

<form action="index.php?page=event" method="post" name="AddNews"><br><br>
    <div class="table-responsive" style="width:100%; margin:0 auto; padding: 40px">
        <div class="card card-custom gutter-b">
        
        <div class="card-body">
        
        <div class="form-group row">
            <label class="col-lg-2 col-form-label text-lg-left"><h5>TITLE</h5></label>
                <div class="col-lg-8">
                    <input type="text" class="form-control" id="staticStaffNo" name="txttitle" size="200" oninput="let p=this.selectionStart;this.value=this.value.toUpperCase();this.setSelectionRange(p, p);" required>   
                </div>
        </div>
        <div class="form-group row">
            <label class="col-lg-2 col-form-label text-lg-left"><h5>ACCESS TYPE</h5></label>
                <div class="col-lg-6">
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
                <div class="col-lg-6">
                    <input type="text" class="form-control"  id="staticStaffNo" name="txtschoolEventVenue" required>   
                </div>
        </div>
        <div class="form-group row">
            <label class="col-lg-2 col-form-label text-lg-left"><h5>ADDRESS</h5></label>
                <div class="col-lg-3">
                    <input type="text" class="form-control"  id="staticStaffNo" name="txtschoolEventAddress" required>
                </div>
        </div>
        <div class="form-group row">
            <label class="col-lg-2 col-form-label text-lg-left">
                <h5>GOOGLE MAPS LINK
                <div class="nav-item dropdown" style="float:right">
                <img src="assets/media/svg/icons/Code/Question-circle.svg" height="22px">
               
                <a class="nav-link dropdown-toggle " href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="true"></a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="https://www.google.com.my/maps" target="_blank" style="color:black;">User are adviced to go to googlemaps.com, select your location, copy the embed html and paste it in this field</a></li>
                    </ul>
                </div>
                </h5>
            </label>
                <div class="col-lg-3">
                    <input type="text" class="form-control"  id="staticStaffNo" name="txtschoolEventLocation" required>
                </div>
        </div>
        <div class="form-group row">
            <label class="col-lg-2 col-form-label text-lg-left"><h5>EVENT START</h5></label>
                <div class="col-lg-8">
                    <input type="datetime-local" id="staticStaffNo" name="txtSchoolEventDateStart">
                </div>
        </div>
        <div class="form-group row"> 
            <label class="col-lg-2 col-form-label text-lg-left"><h5>EVENT END</h5></label>
                <div class="col-lg-8">
                    <input type="datetime-local" id="staticStaffNo" name="txtSchoolEventDateEnd">
                </div>
        </div>
        <div class="card-footer">
            <div class="row">
            <div class="col-lg-2"></div> 
        <div class="text-right">
            <button type="submit" class="btn btn-success" name="AddNews">Confirm</button>
            <button type="button"  class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        </div>

        </div>  
        </div>
    </div>
</form>
