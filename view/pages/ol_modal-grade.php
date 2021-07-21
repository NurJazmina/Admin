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
<script>
//copied url
function sweetalert1() {
    var Url = document.getElementById("url");
    Url.value = window.location.href;
    Url.focus();
    Url.select();  
    const successful = document.execCommand("Copy");

    if(successful) 
    {
        Swal.fire({
        icon: 'success',
        title: 'URL have been copied',
        confirmButtonColor: "#1BC5BD",
        timer: 5000
        })
    } 
    else 
    {
        // ...
    }
}
</script>