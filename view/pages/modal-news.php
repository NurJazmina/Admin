<?php
$_SESSION["title"] = "News";
include 'view/partials/_subheader/subheader-v1.php'; 
?>
<div class="container">
    <div class="card card-custom gutter-b example example-compact">
        <div class="card-header">
            <h3 class="card-title">Add News</h3>
            <div class="card-toolbar">
            </div>
        </div>
        <form class="form" id="kt_form" action="index.php?page=news" method="post" name="AddNews">
            <div class="card card-custom gutter-b">
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
                        <label class="col-form-label col-lg-3 col-sm-12 text-right">Access Type</label>
                        <div class="col-lg-4 col-md-9 col-sm-12">
                            <select class="form-control" id="kt_bootstrap_select" name="access" required>
                                <option value="PUBLIC">PUBLIC</option>
                                <option value="STAFF">STAFFS</option>
                                <option value="TEACHER">TEACHERS</option>
                                <option value="VIP">PARENTS</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-lg-3 col-sm-12 text-right">Description</label>
                        <div class="col-lg-7 col-md-9 col-sm-12">
                            <textarea class="news" name="txtdetail"></textarea>
                            <span class="form-text text-muted">Enter the description</span>
                        </div>
                    </div>
                    <div class="separator separator-dashed my-10"></div>
                    <div class="row">
                        <div class="col-lg-9 ml-lg-auto">
                            <button type="reset"  class="btn btn-secondary">Cancel</button>
                            <button type="submit" class="btn btn-success" name="AddNews">Confirm</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<script type="text/javascript" src='https://cdn.tiny.cloud/1/jwc9s2y5k97422slkhbv6eu2eqwbwl2skj9npskngzqtsrhq/tinymce/4/tinymce.min.js' referrerpolicy="origin"></script>
<script>
tinymce.init({
  selector: '.news',
  menubar:false,
  statusbar: false,
  toolbar: false,
  height:250,
});
</script>