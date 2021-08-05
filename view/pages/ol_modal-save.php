<style>
.mb-26{
   margin-bottom: 26px;
}
.submit-button{
    padding: 14px 44px;
    color: #fdfdfd;   
    display: block;
    margin: 0 auto;
}
.submit-button:disabled{
   background: #c5dce7;
}
.form-input.text{
     width: 34%;
     height: 28px;
  }
}
</style>
<div class="modal fade" id="save" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
            <button class="btn btn-outline-success btn-sm rounded-pill btn-hover-outline-white">
                <span class="svg-icon svg-icon-success svg-icon-s">
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <rect x="0" y="0" width="24" height="24"/>
                            <path d="M5.5,4 L18.5,4 C19.3284271,4 20,4.67157288 20,5.5 L20,9.5 C20,10.3284271 19.3284271,11 18.5,11 L5.5,11 C4.67157288,11 4,10.3284271 4,9.5 L4,5.5 C4,4.67157288 4.67157288,4 5.5,4 Z M11,6 C10.4477153,6 10,6.44771525 10,7 C10,7.55228475 10.4477153,8 11,8 L13,8 C13.5522847,8 14,7.55228475 14,7 C14,6.44771525 13.5522847,6 13,6 L11,6 Z" fill="#000000" opacity="0.3"/>
                            <path d="M5.5,13 L18.5,13 C19.3284271,13 20,13.6715729 20,14.5 L20,18.5 C20,19.3284271 19.3284271,20 18.5,20 L5.5,20 C4.67157288,20 4,19.3284271 4,18.5 L4,14.5 C4,13.6715729 4.67157288,13 5.5,13 Z M11,15 C10.4477153,15 10,15.4477153 10,16 C10,16.5522847 10.4477153,17 11,17 L13,17 C13.5522847,17 14,16.5522847 14,16 C14,15.4477153 13.5522847,15 13,15 L11,15 Z" fill="#000000"/>
                        </g>
                    </svg>
                </span>
                Add Collection
            </button>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form name="savequiz" action="" method="post">
            <div class="modal-body">
                <h5>Create new collection</h5>
                <div class="form-group row">     
                    <div class="col-sm-6">
                        <input placeholder="e.g. Favourites,Mathematics" class="form-control" name="title" required></input>
                    </div>
                    <div class="col-sm-6">
                        <input type="hidden" name="URL" value="<?php echo $URL; ?>">
                        <button type="submit" name="savequiz" class="btn btn-secondary btn-hover-success btn-block">Done</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
  </div>
</div>