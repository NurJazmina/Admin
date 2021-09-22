<div class="modal fade" id="edit" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form name="editnotes" action="#" method="post">
            <div class="modal-body">
                <input type="hidden" name="notes_id" value="<?= $Notes_id; ?>">
                <div class="row mb-5">     
                    <label>Topic</label>
                    <div class="col-sm-12">
                        <input class="form-control" type="text" name="topic">
                    </div>
                </div>
                <div class="row mb-5">
                    <label>Detail</label>
                    <div class="col-sm-12">
                        <textarea class="notes" name="detail"></textarea>
                    </div>
                </div>
                <div class="row mb-5" align="right">
                    <div class="col-sm-12">
                        <button type="reset" class="btn btn-secondary btn-sm">Reset</button>
                        <button type="submit" name="editnotes" class="btn btn-success btn-sm">Submit</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
  </div>
</div>
<script type="text/javascript" src='https://cdn.tiny.cloud/1/ctl5tdxtaqli3dvaw5f3zolgpcusntlmonfxnq4673uy1x7d/tinymce/4/tinymce.min.js' referrerpolicy="origin"></script>
<script>
tinymce.init({
  selector: '.notes',
  menubar:false,
  statusbar: false,
  toolbar: false,
  height:50,
});
</script>

