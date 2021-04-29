<?php
$_SESSION["title"] = "News";
?>
<?php include 'view/partials/_subheader/subheader-v1.php'; ?>

<form action="index.php?page=news" method="post" name="AddNews"><br><br>
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
                <div class="col-lg-8">
                <select class="form-control" id="staticStaffNo" style="height: auto; width: 50%;" name="access" required>
                  <option value="PUBLIC">PUBLIC</option>
                  <option value="SCHOOL1">STAFFS</option>
                  <option value="SCHOOL0">TEACHERS</option>
                  <option value="VIP">PARENTS</option>
                </select>
                </div>
        </div>

        <div>
        <label><h5> NEWS </h5></label>
            <textarea id="basic-example" name="txtdetail" ></textarea>
        </div>

        <div class="card-footer">
            <div class="row">
            <div class="col-lg-2"></div>
        <div class="text-right">
            <button type="submit" class="btn btn-primary" name="AddNews">Confirm</button>
            <button type="button"  class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        </div>

        </div>  
        </div>
    </div>
</form>