<?php
$_SESSION["title"] = "News";
include 'view/partials/_subheader/subheader-v1.php'; 
?>
<form class="form" action="index.php?page=news" method="post" name="AddNews">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add News</h5>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <div class="alert alert-light-primary d-none mb-15" role="alert">
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
                    <label class="col-sm-2 col-form-label">Title</label>
                    <div class="col-sm-10">
                        <div class="typeahead">
                            <input type="text" class="form-control" name="title" oninput="let p=this.selectionStart;this.value=this.value.toUpperCase();this.setSelectionRange(p, p);" required>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Access Type</label>
                    <div class="col-sm-10">
                        <select class="form-control" name="access" required>
                            <option value="PUBLIC">PUBLIC</option>
                            <option value="STAFF">STAFFS</option>
                            <option value="TEACHER">TEACHERS</option>
                            <option value="VIP">PARENTS</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Description</label>
                    <div class="col-sm-10">
                        <textarea class="news" name="detail"></textarea>
                        <span class="form-text text-muted">Enter the description</span>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="reset"  class="btn btn-light btn-hover-success btn-sm">Cancel</button>
                <button type="submit" class="btn btn-success btn-hover-light btn-sm" name="AddNews">Confirm</button>
            </div>
        </div>
    </div>
</form>
<script type="text/javascript" src='https://cdn.tiny.cloud/1/jwc9s2y5k97422slkhbv6eu2eqwbwl2skj9npskngzqtsrhq/tinymce/4/tinymce.min.js' referrerpolicy="origin"></script>
<script>
tinymce.init({
  selector: '.news',
  menubar:false,
  statusbar: false,
  toolbar: false,
  height:200,
});
</script>