<style>
/* form-validation */

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
<div class="modal fade" id="share" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
            <button class="btn btn-outline-success btn-sm rounded-pill btn-hover-outline-white">
                <span class="svg-icon svg-icon-success svg-icon-s">
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                        <polygon points="0 0 24 0 24 24 0 24"/>
                        <path d="M18,8 L16,8 C15.4477153,8 15,7.55228475 15,7 C15,6.44771525 15.4477153,6 16,6 L18,6 L18,4 C18,3.44771525 18.4477153,3 19,3 C19.5522847,3 20,3.44771525 20,4 L20,6 L22,6 C22.5522847,6 23,6.44771525 23,7 C23,7.55228475 22.5522847,8 22,8 L20,8 L20,10 C20,10.5522847 19.5522847,11 19,11 C18.4477153,11 18,10.5522847 18,10 L18,8 Z M9,11 C6.790861,11 5,9.209139 5,7 C5,4.790861 6.790861,3 9,3 C11.209139,3 13,4.790861 13,7 C13,9.209139 11.209139,11 9,11 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"/>
                        <path d="M0.00065168429,20.1992055 C0.388258525,15.4265159 4.26191235,13 8.98334134,13 C13.7712164,13 17.7048837,15.2931929 17.9979143,20.2 C18.0095879,20.3954741 17.9979143,21 17.2466999,21 C13.541124,21 8.03472472,21 0.727502227,21 C0.476712155,21 -0.0204617505,20.45918 0.00065168429,20.1992055 Z" fill="#000000" fill-rule="nonzero"/>
                    </g>
                    </svg>
                </span>
                Invite
            </button>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form name="sharequiz" action="" method="post">
            <div class="modal-body">
                <div class="form-group row">     
                    <div class="col-sm-6">
                        <input type="text" name="email" class="form-control" id="input-email" oninput="validateForm()">
                    </div>
                    <div class="col-sm-6">
                        <input type="hidden" name="Created_by" value="<?php echo $Created_by; ?>">
                        <input type="hidden" name="Quiz_id" value="<?php echo $Quiz_id; ?>">
                        <button type="submit" name="sharequiz" class="btn btn-secondary btn-hover-success btn-block" id="submit-button" disabled>share invite via link</button>
                    </div>
                </div>
                <div class="form-group row">
                    <?php
                    $url = "$_SERVER[REQUEST_URI]";
                    ?>
                    <div class="col-sm-12">
                        <input type="text" class="form-control" value="<?php echo $url; ?>" id="url">
                        <button type="button" class="btn btn-sm btn-hover-light-success btn-text-success" onclick="sweetalert1()">
                            <span class="svg-icon svg-icon-success svg-icon-md">
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                        <rect x="0" y="0" width="24" height="24"/>
                                        <path d="M14,16 L12,16 L12,12.5 C12,11.6715729 11.3284271,11 10.5,11 C9.67157288,11 9,11.6715729 9,12.5 L9,17.5 C9,19.4329966 10.5670034,21 12.5,21 C14.4329966,21 16,19.4329966 16,17.5 L16,7.5 C16,5.56700338 14.4329966,4 12.5,4 L12,4 C10.3431458,4 9,5.34314575 9,7 L7,7 C7,4.23857625 9.23857625,2 12,2 L12.5,2 C15.5375661,2 18,4.46243388 18,7.5 L18,17.5 C18,20.5375661 15.5375661,23 12.5,23 C9.46243388,23 7,20.5375661 7,17.5 L7,12.5 C7,10.5670034 8.56700338,9 10.5,9 C12.4329966,9 14,10.5670034 14,12.5 L14,16 Z" fill="#000000" fill-rule="nonzero" transform="translate(12.500000, 12.500000) rotate(-315.000000) translate(-12.500000, -12.500000) "/>
                                    </g>
                                </svg>
                            </span>
                        Copy link</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
  </div>
</div>
<script>
var inputEmail = document.getElementById('input-email');
var button = document.querySelector('#submit-button');
var regEx = /^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/; // string, white-space, @ , white-space, dot, white-space, value, string //
var form = document.querySelector('.form');

//disablebutton
function validateForm()
{
    if (regEx.test(inputEmail.value))
    {
       button.disabled = false;
    } else 
    {
       button.disabled = true;
    }
}
form.addEventListener('submit', function(event)
{
     event.preventDefault();
     console.log("submitted")

})

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