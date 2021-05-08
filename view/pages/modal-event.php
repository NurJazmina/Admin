<style>

.form-group.row {
    
}

.help-tip{

    overflow: visible;
    text-align: center;
    background-color: #BCDBEA;
    border-radius: 50%;
    width: 24px;
    height: 24px;
    font-size: 14px;
    line-height: 26px;
    cursor: default;
}

.help-tip:before{
    content:'?';
    font-weight: bold;
    color:#fff;
}

.help-tip:hover p{
    display:block;
    transform-origin: 100% 0%;

    -webkit-animation: fadeIn 0.3s ease-in-out;
    animation: fadeIn 0.3s ease-in-out;

}

.help-tip p{    /* The tooltip */
    display: none;
    text-align: left;
    background-color: #1E2021;
    padding: 20px;
    width: 300px;
    
    border-radius: 3px;
    box-shadow: 1px 1px 1px rgba(0, 0, 0, 0.2);
    right: -4px;
    color: #FFF;
    font-size: 13px;
    line-height: 1.4;
}

.help-tip p:before{ /* The pointer of the tooltip */

    content: '';
    width:0;
    height: 0;
    border:6px solid transparent;
    border-bottom-color:#1E2021;
    left:10px;
   
}

.help-tip p:after{ /* Prevents the tooltip from being hidden */
    width:100%;
    height:40px;
    content:'';
  
    top:-40px;
    left:0;
}

/* CSS animation */

@-webkit-keyframes fadeIn {
    0% { 
        opacity:0; 
        transform: scale(0.6);
    }

    100% {
        opacity:100%;
        transform: scale(1);
    }
}

@keyframes fadeIn {
    0% { opacity:0; }
    100% { opacity:100%; }
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
                  <option value="1">STAFFS</option>
                  <option value="0">TEACHERS</option>
                  <option value="VIP">PARENTS</option>
                </select>
                </div>
        </div>
        <div class="form-group row">
            <label class="col-lg-2 col-form-label text-lg-left"><h5>VENUE</h5></label>
                <div class="col-lg-6">
                    <input type="text" class="form-control"  id="staticStaffNo" name="txtschoolEventVenue">   
                </div>
        </div>
        <div class="form-group row">
            <label class="col-lg-2 col-form-label text-lg-left"><h5>ADDRESS</h5></label>
                <div class="col-lg-3">
                    <input type="text" class="form-control"  id="staticStaffNo" name="txtschoolLocation">
                </div>
        </div>
        <div class="form-group row">
            <label class="col-lg-2 col-form-label text-lg-left"><h5>GOOGLE MAPS LINK</h5></label>
            <div class="help-tip">
                <p>Testing</p>
            </div>
                <div class="col-lg-3">
                    <input type="text" class="form-control"  id="staticStaffNo" name="txtschoolGoogleMaps">
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
