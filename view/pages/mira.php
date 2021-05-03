
<?php include 'model/mail.php'; ?>
<br><br><br>
<!--begin::Compose-->
<div  id="kt_inbox_compose" >
        <div class="modal-content">
            <!--begin::Form-->
            <form id="mail"  name="mail" action="index.php?page=mail" method="post">
                <!--begin::Header-->
                <div class="d-flex align-items-center justify-content-between py-5 pl-8 pr-5 border-bottom">
                    <h5 class="font-weight-bold m-0">Compose</h5>
                    <div class="d-flex ml-2">
                    </div>
                </div>
                <!--end::Header-->
                <!--begin::Body-->
                <div class="d-block">
                    <!--begin::To-->
                    <div class="d-flex align-items-center border-bottom inbox-to px-8 min-h-45px">
                        <div class="text-dark-50 w-75px">To:</div>
                        <div class="d-flex align-items-center flex-grow-1">
                            <input type="text" class="form-control border-0" name="compose_to" >
						</div>
                        <div class="ml-2">
                            <span class="text-muted font-weight-bold cursor-pointer text-hover-primary mr-2" data-inbox="cc-show">Cc</span>
                            <span class="text-muted font-weight-bold cursor-pointer text-hover-primary" data-inbox="bcc-show">Bcc</span>
                        </div>
                    </div>
                    <!--end::To-->
                    <!--begin::CC-->
                    <div class="d-none align-items-center border-bottom inbox-to-cc pl-8 pr-5 min-h-45px">
                        <div class="text-dark-50 w-75px">Cc:</div>
                        <div class="flex-grow-1">
                            <input type="text" class="form-control border-0" name="compose_cc" value="" />
                        </div>
                        <span class="btn btn-clean btn-xs btn-icon" data-inbox="cc-hide">
                            <i class="la la-close"></i>
                        </span>
                    </div>
                    <!--end::CC-->
                    <!--begin::BCC-->
                    <div class="d-none align-items-center border-bottom inbox-to-bcc pl-8 pr-5 min-h-45px">
                        <div class="text-dark-50 w-75px">Bcc:</div>
                        <div class="flex-grow-1">
                            <input type="text" class="form-control border-0" name="compose_bcc" value="" />
                        </div>
                        <span class="btn btn-clean btn-xs btn-icon" data-inbox="bcc-hide">
                            <i class="la la-close"></i>
                        </span>
                    </div>
                    <!--end::BCC-->
                    <!--begin::Subject-->
                    <div class="border-bottom">
                        <input class="form-control border-0 px-8 min-h-45px" name="compose_subject" placeholder="Subject" />
                    </div>
                    <!--end::Subject-->
                    <!--begin::Message-->
                    <div id="kt_inbox_compose_editor" class="border-0" style="height: 250px">
                        <input class="form-control border-0 px-8 min-h-45px" name="message" placeholder="Type message..." />
                    </div>
                    <!--end::Message-->
                    <!--begin::Attachments-->
                    <div class="dropzone dropzone-multi px-8 py-4" id="kt_inbox_compose_attachments">
                        <div class="dropzone-items">
                            <div class="dropzone-item" style="display:none">
                                <div class="dropzone-file">
                                    <div class="dropzone-filename" title="some_image_file_name.jpg">
                                        <span data-dz-name="">some_image_file_name.jpg</span>
                                        <strong>(
                                        <span data-dz-size="">340kb</span>)</strong>
                                    </div>
                                    <div class="dropzone-error" data-dz-errormessage=""></div>
                                </div>
                                <div class="dropzone-progress">
                                    <div class="progress">
                                        <div class="progress-bar bg-primary" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0" data-dz-uploadprogress=""></div>
                                    </div>
                                </div>
                                <div class="dropzone-toolbar">
                                    <span class="dropzone-delete" data-dz-remove="">
                                        <i class="flaticon2-cross"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end::Attachments-->
                </div>
                <!--end::Body-->
                <!--begin::Footer-->
                <div class="d-flex align-items-center justify-content-between py-5 pl-8 pr-5 border-top">
                    <!--begin::Actions-->
                    <div class="d-flex align-items-center mr-3">
                        <!--begin::Send-->
                        <div class="btn-group mr-4">
                        </div>
                        <!--end::Send-->
                        <!--begin::Other-->
                        <!--end::Other-->
                    </div>
                    <!--end::Actions-->
                    <!--begin::Toolbar-->
                    <div class="d-flex align-items-center">
                        <button type="submit" class="btn btn-primary font-weight-bold px-6" name="mail">Send</button>
                    </div>
                    <!--end::Toolbar-->
                </div>
                <!--end::Footer-->
            </form>
            <!--end::Form-->
        </div>
</div>
<!--end::Compose-->
