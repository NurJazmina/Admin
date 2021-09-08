<form  name="edit_forum" action="index.php?page=forums" method="post">
  <div class="modal fade" id="edit_forum" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Edit Forum</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <input type="hidden" class="form-control" name="forum_id">
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
          <button type="submit" class="btn btn-success btn-sm" name="edit_forum">Confirm</button>
        </div>
      </div>
    </div>
  </div>
</form>

<form  name="delete_forum" action="index.php?page=forums" method="post">
  <div class="modal fade" id="delete_forum" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Delete Forum</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <a>To delete the&nbsp;&nbsp;<i class="flaticon-warning-sign icon-md text-danger"></i>&nbsp;&nbsp;<b>Forum</b> type your <b>password</b>.</a><br>
          <input type="hidden" class="form-control" name="forum_id">
          <input type="password" class="form-control" name="password" placeholder="Password">
        </div>
        <div class="modal-footer">
          <button type="button"  class="btn btn-light btn-sm" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-success btn-sm" name="delete_forum">Delete</button>
        </div>
      </div>
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