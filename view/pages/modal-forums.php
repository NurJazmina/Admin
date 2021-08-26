<?php
$_SESSION["title"] = "Forum";
include 'view/partials/_subheader/subheader-v1.php'; 
?>
<form action="index.php?page=forums" method="post" name="AddForums">
    <div class="modal-dialog modal-lg modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Add Forum</h5>
        </div>
        <div class="modal-body">
          <div class="form-group row">
            <label class="col-sm-2 col-form-label">Title</label>
            <div class="col-sm-10">
                <input name="title" type="text" class="form-control" name="title" size="200" oninput="let p=this.selectionStart;this.value=this.value.toUpperCase();this.setSelectionRange(p, p);" required>
            </div>
          </div>
          <div class="form-group row">
            <label class="col-sm-2 col-form-label">Access Type</label>
            <div class="col-sm-10">
                <select class="form-control" name="access" required>
                    <option value="SCHOOL">SCHOOL</option>
                    <option value="PUBLIC">PUBLIC</option>
                </select>
            </div>
          </div>
          <div class="form-group row">
            <label class="col-sm-2 col-form-label">Channel Topic</label>
            <div class="col-sm-10">
                <select class="form-control" name="topic" required>
                    <option value="GENERAL">GENERAL</option>
                    <option value="PROPOSAL">PROPOSAL</option>
                    <option value="INFO">SHORT NEWS/INFO</option>
                </select>
            </div>
          </div>
          <div class="form-group row">
            <label class="col-sm-2 col-form-label">Detail</label>
            <div class="col-sm-10">
                <textarea class="forum" name="detail"></textarea>
                <span class="form-text text-muted">Enter the description</span>
            </div>
          </div>
        </div>
        <div class="modal-footer">
            <button type="button"  class="btn btn-light btn-sm" data-bs-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-success btn-sm" name="AddForums">Confirm</button>
        </div>
    </div>
</form>
<script type="text/javascript" src='https://cdn.tiny.cloud/1/jwc9s2y5k97422slkhbv6eu2eqwbwl2skj9npskngzqtsrhq/tinymce/4/tinymce.min.js' referrerpolicy="origin"></script>
<script>
tinymce.init({
  selector: '.forum',
  menubar:false,
  statusbar: false,
  toolbar: false,
  height:200,
});
</script>