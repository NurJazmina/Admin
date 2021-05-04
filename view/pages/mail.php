<?php include 'model/mail.php'; ?>
<!--begin::View-->
<div class="flex-row-fluid ml-lg-8 d-none" id="kt_inbox_view">
    <!--begin::Card-->
    <div class="card card-custom card-stretch">

    </div>
    <!--end::Card-->
</div>
<!--end::View-->
<!--begin::Compose-->
<br><br><br>
<div id="kt_inbox_compose" >
<div role="document">
    <div class="modal-content">
        <?php 
        if ($_SESSION["loggeduser_StaffLevel"] == '1')
        {
        ?>
        <!--begin::Form::staff-->
        <form id="Staffmail"  name="Staffmail" action="index.php?page=mail" method="post">
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
                        <input   class="form-control border-0" value="<?php echo  $_SESSION["loggeduser_SchoolsEmail"]; ?>" disabled>
                    </div>
                </div>
                <!--end::To-->
                <!--begin::CC-->
                <div class="d-flex align-items-center border-bottom inbox-to px-8 min-h-45px">
                    <div class="text-dark-50 w-75px">Cc:</div>
                    <div class="flex-grow-1">
                        <input class="form-control border-0" value="<?php echo  "gngsoftech@gmail.com"; ?>" disabled>
                    </div>
                </div>
                <!--end::CC-->
                <!--begin::BCC-->
                <div class="d-flex align-items-center border-bottom inbox-to px-8 min-h-45px">
                    <div class="text-dark-50 w-75px">Bcc:</div>
                    <div class="flex-grow-1" >
                        <select class="form-control form-control-lg" name="compose_Bcc" >

                            <option value="staff">Staff</option>

                            <option value="teacher">Teacher</option>

                            <option value="school">School</option>

                            <option value="parent">Parent</option>

                            <option value="all">All</option>

                        </select>
                    </div>
                </div>
                <!--end::BCC-->
                <!--begin::Subject-->
                <div class="border-bottom">
                    <input class="form-control border-0 px-8 min-h-45px" name="compose_subject" placeholder="Subject" />
                </div>
                <!--end::Subject-->
                <!--begin::Message-->
                    <textarea name="message">



                    </textarea>
                <!--end::Message-->
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
                </div>
                <!--end::Actions-->
                <!--begin::Toolbar-->
                <div class="d-flex align-items-center">
                    <span class="btn btn-icon btn-sm btn-clean mr-2" id="kt_inbox_compose_attachments_select">
                        <i class="flaticon2-clip-symbol"></i>
                    </span>
                    <button type="submit" class="btn btn-primary font-weight-bold px-6" name="Staffmail">Send</button>
                </div>
                <!--end::Toolbar-->
            </div>
            <!--end::Footer-->
        </form>
        <!--end::Form::staff-->
        <?php
        }
        else
        {
        ?>
        <!--begin::Form::teacher-->
        <form id="Teachermail"  name="Teachermail" action="index.php?page=mail" method="post">
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
                        <input class="form-control border-0" value="<?php echo  $_SESSION["loggeduser_SchoolsEmail"]; ?>" disabled>
                    </div>
                </div>
                <!--end::To-->
                <!--begin::CC-->
                <div class="d-flex align-items-center border-bottom inbox-to px-8 min-h-45px">
                    <div class="text-dark-50 w-75px">Cc:</div>
                    <div class="flex-grow-1">
                        <input class="form-control border-0" value="<?php echo  "gngsoftech@gmail.com"; ?>" disabled>
                    </div>
                </div>
                <!--end::CC-->
                <!--begin::BCC-->
                <div class="d-flex align-items-center border-bottom inbox-to px-8 min-h-45px">
                    <div class="text-dark-50 w-75px">Bcc:</div>
                    <div class="flex-grow-1" >
                        <select class="form-control form-control-lg" name="compose_Bcc">
                            <?php
                            $filter = ['Schools_id'=>$_SESSION["loggeduser_schoolID"],'Class_id'=>$_SESSION["loggeduser_ClassID"]];
                            $query = new MongoDB\Driver\Query($filter);
                            $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Students',$query);
                            foreach ($cursor as $document)
                            {
                                $studentid = strval($document->_id);
                                $Class_id = strval($document->Class_id);

                                $filter = ['StudentID'=>$studentid];
                                $query = new MongoDB\Driver\Query($filter);
                                $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.ParentStudentRel',$query);
                                foreach ($cursor as $document)
                                {
                                    $ParentID = strval($document->ParentID);

                                    $filter = ['_id'=>new \MongoDB\BSON\ObjectId($ParentID)];
                                    $query = new MongoDB\Driver\Query($filter);
                                    $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Parents',$query);
                                    foreach ($cursor as $document)
                                    {
                                        $ConsumerID = strval($document->ConsumerID);

                                        $filter1 = ['_id'=>new \MongoDB\BSON\ObjectID($ConsumerID)];
                                        $query1 = new MongoDB\Driver\Query($filter1);
                                        $cursor1 = $GoNGetzDatabase->executeQuery('GoNGetz.Consumer',$query1);
                            
                                        foreach ($cursor1 as $document1)
                                        {
                                            $Email = strval($document1->ConsumerEmail);
                                        }
                                    }
                                    if($Email == "")
                                    {

                                    }
                                    else
                                    {
                                        $ConsumerFName = strval($document1->ConsumerFName); 
                                        ?>
                                        <option value="<?=($Email)?>"><?php echo $ConsumerFName;  ?> </option>
                                        <?php 
                                    }
                                }
                            }
                            ?>
                            <option value="all">All Parent</option>
                        </select>
                    </div>
                </div>
                <!--end::BCC-->
                <!--begin::Subject-->
                <div class="border-bottom">
                    <input class="form-control border-0 px-8 min-h-45px" name="compose_subject" placeholder="Subject" />
                </div>
                <!--end::Subject-->
                <!--begin::Message-->
                    <textarea id="basic" name="message">

                    </textarea>
                <!--end::Message-->
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
                </div>
                <!--end::Actions-->
                <!--begin::Toolbar-->
                <div class="d-flex align-items-center">
                    <button type="submit" class="btn btn-primary font-weight-bold px-6" name="Teachermail">Send</button>
                </div>
                <!--end::Toolbar-->
            </div>
            <!--end::Footer-->
        </form>
        <!--end::Form::teacher-->
        <?php
        }
        ?>
    </div>
</div>
</div>
<!--end::Compose-->

<script type="text/javascript" src='https://cdn.tiny.cloud/1/qagffr3pkuv17a8on1afax661irst1hbr4e6tbv888sz91jc/tinymce/4/tinymce.min.js' referrerpolicy="origin"></script>
<script>
tinymce.init({
  selector: 'textarea#basic',
  height: 200,
  menubar: false,
  plugins: [
    'advlist autolink lists link image charmap print preview anchor',
    'searchreplace visualblocks code fullscreen',
    'insertdatetime media table paste code help wordcount'
  ],
  toolbar: 'undo redo | formatselect | ' +
  'bold italic backcolor | alignleft aligncenter ' +
  'alignright alignjustify | bullist numlist outdent indent | ' +
  'removeformat | help',
  content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:14px }'
});

tinymce.init({
  selector: 'textarea',
  height: 200,
  menubar: false,
  readonly : 1,
  plugins: [
    'advlist autolink lists link image charmap print preview anchor',
    'searchreplace visualblocks code fullscreen',
    'insertdatetime media table paste code help wordcount'
  ],
  toolbar: 'undo redo | formatselect | ' +
  'bold italic backcolor | alignleft aligncenter ' +
  'alignright alignjustify | bullist numlist outdent indent | ' +
  'removeformat | help',
  content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:14px }'
});
</script>
