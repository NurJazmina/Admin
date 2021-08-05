<form id="addtopic" name="addtopic" action="" method="post">
    <div class="modal fade" id="topic" tabindex="-1" role="dialog" aria-labelledby="topicTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Add Topic</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body">
            <input type="hidden" class="form-control" id="Notes_id" name="Notes_id">
            <!--Title-->
            <div class="form-group row">
                <label for="txtStaffdepartment" class="col-sm-2 col-form-label">Title</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="Title" name="Title" oninput="let p=this.selectionStart;this.value=this.value.toUpperCase();this.setSelectionRange(p, p);" required>
                </div>
            </div>
            <!--Description-->
            <div class="form-group row">
                <label for="staticStaffNo" class="col-sm-2 col-form-label">Description</label>
                <div class="col-sm-10">
                <textarea class="topic" name="Detail"></textarea>
                </div>
            </div>
            </div>
            <div class="modal-footer">
            <button type="submit" class="btn btn-success" name="addtopic">Confirm</button>
            </div>
        </div>
    </div>
    </div>
</form>
<script type="text/javascript" src='https://cdn.tiny.cloud/1/jwc9s2y5k97422slkhbv6eu2eqwbwl2skj9npskngzqtsrhq/tinymce/4/tinymce.min.js' referrerpolicy="origin"></script>
<script>
tinymce.init({
  selector: '.topic',
  menubar:false,
  statusbar: false,
  toolbar: false,
  height:250,
});
</script>