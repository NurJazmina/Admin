<?php
    //$category = ($_GET['forum']);
    //$topic = ($_GET['topic']);
?>
<?php
$_SESSION["title"] = "Forum";
?>
<?php include 'view/partials/_subheader/subheader-v1.php'; ?>

<form action="index.php?page=schoolforum&forum=<?php echo $sort; ?>&topic=<?php echo $topic; ?>" method="post" name="AddForums"><br><br>
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
        <div>
        <label><h5> FORUM </h5></label>
            <textarea id="basic-example" name="txtdetail" ></textarea>
        </div>

        <div class="card-footer">
            <div class="row">
            <div class="col-lg-2"></div>
        <div class="text-right">
            <input type="hidden"  name="txtforum" value="<?php echo  $category; ?>">
            <button type="submit" class="btn btn-primary" name="AddForums">Confirm</button>
            <button type="button"  class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        </div>

        </div>  
        </div>
    </div>
</form>
