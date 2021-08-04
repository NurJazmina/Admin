<div class="modal fade" id="EditGrade" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
            <button class="btn btn-outline-success btn-sm rounded-pill btn-hover-outline-white font-weight-boldest">
               Final Grade
            </button>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form name="EditGrade" action="" method="post">
            <div class="modal-body">
                <input type="hidden" name="answer_id">
                <div class="row mb-5">     
                    <label>Grade out of 100</label>
                    <div class="col-sm-12">
                        <input class="form-control" type="number" name="Mark" min="0" max="100">
                    </div>
                </div>
                <div class="row mb-5">
                    <label>Feedback comments</label>
                    <div class="col-sm-12">
                        <textarea class="grade" name="comment"></textarea>
                    </div>
                </div>
                <div class="row mb-5" align="right">
                    <div class="col-sm-12">
                        <button type="reset" class="btn btn-secondary btn-sm">Reset</button>
                        <button type="submit" name="EditGrade" class="btn btn-success btn-sm">Submit</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
  </div>
</div>
<div class="modal fade" id="EditCommentQuiz" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
            <button class="btn btn-outline-success btn-sm rounded-pill btn-hover-outline-white font-weight-boldest">
               Final Grade : Comments
            </button>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form name="EditCommentQuiz" action="" method="post">
            <div class="modal-body">
                <input type="hidden" name="answer_id">
                <div class="row mb-5">
                    <label>Feedback comments</label>
                    <div class="col-sm-12">
                        <textarea class="grade" name="Comment"></textarea>
                    </div>
                </div>
                <div class="row mb-5" align="right">
                    <div class="col-sm-12">
                        <button type="reset" class="btn btn-secondary btn-sm">Reset</button>
                        <button type="submit" name="EditCommentQuiz" class="btn btn-success btn-sm">Submit</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
  </div>
</div>
<script type="text/javascript" src='https://cdn.tiny.cloud/1/jwc9s2y5k97422slkhbv6eu2eqwbwl2skj9npskngzqtsrhq/tinymce/4/tinymce.min.js' referrerpolicy="origin"></script>
<script>
tinymce.init({
  selector: '.grade',
  menubar:false,
  statusbar: false,
  toolbar: false,
  height:100,
});
</script>
