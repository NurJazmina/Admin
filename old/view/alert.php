<?php
if(isset($_GET['action']) && !empty($_GET['action'])) 
{
?>
  <?php
  if ($_GET['action']=="loginsuccesful")
  {
  ?>
    <div class="alert alert-success alert-dismissible fade show text-center" role="alert">
      Welcome back <?php echo $_SESSION['loggeduser_consumerFName']; ?>
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
  <?php
  }
  elseif ($_GET['action']=="invalidlogin")
  {
  ?>
    <div class="alert alert-alert alert-dismissible fade show text-center" role="alert">
      Login error! Please check your email and password!
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
  <?php
  }
    elseif ($_GET['action']=="passwordchanged"){
    ?>
    <div class="alert alert-success alert-dismissible fade show text-center" role="alert">
      Your password changed!
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <?php
  }
}
  ?>