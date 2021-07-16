<div class="modal fade" id="EditGrade" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
            <button class="btn btn-outline-success btn-sm rounded-pill btn-hover-outline-white">
                <span class="svg-icon svg-icon-success svg-icon-2x">
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <polygon points="0 0 24 0 24 24 0 24"/>
                            <path d="M12,4.25932872 C12.1488635,4.25921584 12.3000368,4.29247316 12.4425657,4.36281539 C12.6397783,4.46014562 12.7994058,4.61977315 12.8967361,4.81698575 L14.9389263,8.95491503 L19.5054023,9.61846284 C20.0519472,9.69788046 20.4306287,10.2053233 20.351211,10.7518682 C20.3195865,10.9695052 20.2170993,11.1706476 20.0596157,11.3241562 L16.7552826,14.545085 L17.5353298,19.0931094 C17.6286908,19.6374458 17.263103,20.1544017 16.7187666,20.2477627 C16.5020089,20.2849396 16.2790408,20.2496249 16.0843804,20.1472858 L12,18 L12,4.25932872 Z" fill="#000000" opacity="0.3"/>
                            <path d="M12,4.25932872 L12,18 L7.91561963,20.1472858 C7.42677504,20.4042866 6.82214789,20.2163401 6.56514708,19.7274955 C6.46280801,19.5328351 6.42749334,19.309867 6.46467018,19.0931094 L7.24471742,14.545085 L3.94038429,11.3241562 C3.54490071,10.938655 3.5368084,10.3055417 3.92230962,9.91005817 C4.07581822,9.75257453 4.27696063,9.65008735 4.49459766,9.61846284 L9.06107374,8.95491503 L11.1032639,4.81698575 C11.277344,4.464261 11.6315987,4.25960807 12,4.25932872 Z" fill="#000000"/>
                        </g>
                    </svg>
                </span>
                Grade
            </button>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form name="Grade" action="" method="post">
            <div class="modal-body">
                <input type="hidden" name="Created_by">
                <div class="row mb-5">     
                    <label>Grade out of 100</label>
                    <div class="col-sm-12">
                        <input class="form-control" type="number" id="quantity" name="quantity" min="1" max="5">
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
                        <button type="submit" name="Grade" class="btn btn-success btn-sm">Submit</button>
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