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
                <select class="form-control" id="staticStaffNo" name="access" required>
                    <option>Public</option>
                    <option>Staff</option>
                    <option>Teacher</option>
                    <option>Parents</option>
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
        <div>
            <button type="submit" class="btn btn-success" name="AddNews">Confirm</button>
            <button type="button"  class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        </div>

        </div>  
        </div>
    </div>
</form>