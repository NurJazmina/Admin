<?php
$_SESSION["title"] = "Change Password";
include 'view/partials/_subheader/subheader-v1.php'; 
?>
<form class="form" name="change_password" action="model/change-password.php" method="post">
    <div class="modal-dialog modal-lg modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Change Password</h5>
        </div>
        <div class="modal-body">
          <div class="form-group row">
            <div class="card-body">
                <?php  
                if (isset($_GET['password']) && !empty($_GET['password']))
                {
                    ?>
                    <!--begin::success-->
                    <div class="alert alert-custom alert-light-info fade show" role="alert">
                        <div class="alert-icon">
                            <span class="svg-icon svg-icon-primary svg-icon-2x">
                                <!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\themes\metronic\theme\html\demo1\dist/../src/media/svg/icons\Communication\Shield-thunder.svg-->
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                        <rect x="0" y="0" width="24" height="24"/>
                                        <path d="M4,4 L11.6314229,2.5691082 C11.8750185,2.52343403 12.1249815,2.52343403 12.3685771,2.5691082 L20,4 L20,13.2830094 C20,16.2173861 18.4883464,18.9447835 16,20.5 L12.5299989,22.6687507 C12.2057287,22.8714196 11.7942713,22.8714196 11.4700011,22.6687507 L8,20.5 C5.51165358,18.9447835 4,16.2173861 4,13.2830094 L4,4 Z" fill="#000000" opacity="0.3"/>
                                        <polygon fill="#000000" opacity="0.3" points="11.3333333 18 16 11.4 13.6666667 11.4 13.6666667 7 9 13.6 11.3333333 13.6"/>
                                    </g>
                                </svg>
                                <!--end::Svg Icon-->
                            </span>
                        </div>
                        <div class="alert-text font-weight-bold">Your password was successfully changed. Your password has been hashed to enhanced security.!</div>
                        <div class="alert-close">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">
                                    <i class="ki ki-close"></i>
                                </span>
                            </button>
                        </div>
                    </div>
                    <!--end::success-->
                    <?php 
                }
                elseif (isset($_GET['ERROR']) && !empty($_GET['ERROR']))
                {
                    ?>
                    <!--begin::Alert Password Not Matching-->
                    <div class="alert alert-custom alert-light-danger fade show" role="alert">
                        <div class="alert-icon">
                            <span class="svg-icon svg-icon-2x svg-icon-danger">
                                <!--begin::Svg Icon | path:assets/media/svg/icons/Code/Info-circle.svg-->
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                        <rect x="0" y="0" width="24" height="24" />
                                        <circle fill="#000000" opacity="0.3" cx="12" cy="12" r="10" />
                                        <rect fill="#000000" x="11" y="10" width="2" height="7" rx="1" />
                                        <rect fill="#000000" x="11" y="7" width="2" height="2" rx="1" />
                                    </g>
                                </svg>
                                <!--end::Svg Icon-->
                            </span>
                        </div>
                        <div class="alert-text font-weight-bold">The password confirmation does not match!</div>
                        <div class="alert-close">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">
                                    <i class="ki ki-close"></i>
                                </span>
                            </button>
                        </div>
                    </div>
                    <!--end::Alert Password Not Matching-->
                    <?php  
                }
                else
                {
                    ?>
                    <!--begin::Alert-->
                    <div class="alert alert-custom alert-light-danger fade show" role="alert">
                        <div class="alert-icon">
                            <span class="svg-icon svg-icon-2x svg-icon-danger">
                                <!--begin::Svg Icon | path:assets/media/svg/icons/Code/Info-circle.svg-->
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                        <rect x="0" y="0" width="24" height="24" />
                                        <circle fill="#000000" opacity="0.3" cx="12" cy="12" r="10" />
                                        <rect fill="#000000" x="11" y="10" width="2" height="7" rx="1" />
                                        <rect fill="#000000" x="11" y="7" width="2" height="2" rx="1" />
                                    </g>
                                </svg>
                                <!--end::Svg Icon-->
                            </span>
                        </div>
                        <div class="alert-text font-weight-bold">Configure user passwords to expire periodically.</div>
                        <div class="alert-close">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">
                                    <i class="ki ki-close"></i>
                                </span>
                            </button>
                        </div>
                    </div>
                    <!--end::Alert-->
                    <?php
                }
                ?>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">New Password</label>
                    <div class="col-sm-9">
                        <input name="password" id="password" type="password" onkeyup='check();' class="form-control" placeholder="New password" />
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Confirm Password</label>
                    <div class="col-sm-9">
                        <input type="password" name="confirm_password" id="confirm_password" onkeyup='check();' class="form-control" placeholder="Confirm password">
                        <span id='message'></span>
                    </div>
                </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
            <input type="hidden" name="id" value="<?= $_SESSION["loggeduser_id"]; ?>">
            <button type="reset" class="btn btn-light btn-hover-success btn-sm">Cancel</button>
            <button type="submit" class="btn btn-success btn-hover-light btn-sm" name="change_password">Save Changes</button>
        </div>
      </div>
    </div>			