<?php
$_SESSION["title"] = "Email Blaster";
include 'view/partials/_subheader/subheader-v1.php'; 
include 'model/mail.php';
?>
<!--begin::Compose-->
<?php 
if ($_SESSION["loggeduser_ACCESS"] == 'STAFF')
{
    ?>
    <!-- begin::form staff -->
    <form name="staff_mail" action="index.php?page=mail" method="post">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Compose</h5>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <div class="alert alert-light-primary d-none mb-15" role="alert">
                            <div class="alert-icon">
                                <i class="la la-warning"></i>
                            </div>
                            <div class="alert-text font-weight-bold">
                                Oh snap! Change a few things up and try submitting again.
                            </div>
                            <div class="alert-close">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span><i class="ki ki-close "></i></span>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="d-block">
                            <!--begin::To-->
                            <div class="d-flex align-items-center border-bottom inbox-to px-8 min-h-45px">
                                <div class="text-dark-50 w-75px">To:</div>
                                <div class="d-flex align-items-center flex-grow-1">
                                    <input class="form-control border-0" value="<?= $_SESSION["loggeduser_SchoolsEmail"]; ?>" disabled>
                                </div>
                            </div>
                            <!--end::To-->
                            <!--begin::CC-->
                            <div class="d-flex align-items-center border-bottom inbox-to px-8 min-h-45px">
                                <div class="text-dark-50 w-75px">Cc:</div>
                                <div class="flex-grow-1">
                                    <input class="form-control border-0" value="<?= "gngsoftech@gmail.com"; ?>" disabled>
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
                            <textarea name="message"></textarea>
                            <!--end::Message-->
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="reset"  class="btn btn-light btn-hover-success btn-sm">Cancel</button>
                    <button type="submit" class="btn btn-success btn-hover-light btn-sm" name="staff_mail">Send</button>
                </div>
            </div>
        </div>
    </form>
    <!-- end::form staff -->
    <?php
}
else
{
    ?>
    <!-- begin::form teacher -->
    <form name="teacher_mail" action="index.php?page=mail" method="post">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Compose</h5>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <div class="alert alert-light-primary d-none mb-15" role="alert">
                            <div class="alert-icon">
                                <i class="la la-warning"></i>
                            </div>
                            <div class="alert-text font-weight-bold">
                                Oh snap! Change a few things up and try submitting again.
                            </div>
                            <div class="alert-close">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span><i class="ki ki-close "></i></span>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="d-block">
                            <!--begin::To-->
                            <div class="d-flex align-items-center border-bottom inbox-to px-8 min-h-45px">
                                <div class="text-dark-50 w-75px">To:</div>
                                <div class="d-flex align-items-center flex-grow-1">
                                    <input class="form-control border-0" value="<?= $_SESSION["loggeduser_SchoolsEmail"]; ?>" disabled>
                                </div>
                            </div>
                            <!--end::To-->
                            <!--begin::CC-->
                            <div class="d-flex align-items-center border-bottom inbox-to px-8 min-h-45px">
                                <div class="text-dark-50 w-75px">Cc:</div>
                                <div class="flex-grow-1">
                                    <input class="form-control border-0" value="<?= "gngsoftech@gmail.com"; ?>" disabled>
                                </div>
                            </div>
                            <!--end::CC-->
                            <!--begin::BCC-->
                            <div class="d-flex align-items-center border-bottom inbox-to px-8 min-h-45px">
                                <div class="text-dark-50 w-75px">Bcc:</div>
                                <div class="flex-grow-1" >
                                    <select class="form-control form-control-lg" name="compose_Bcc">
                                        <?php
                                        $filter = ['Schools_id'=>$_SESSION["loggeduser_school_id"],'Class_id'=>$_SESSION["loggeduser_ClassID"]];
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
                                                if($Email !== "")
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
                            <textarea name="message"></textarea>
                            <!--end::Message-->
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="reset"  class="btn btn-light btn-hover-success btn-sm">Cancel</button>
                    <button type="submit" class="btn btn-success btn-hover-light btn-sm" name="teacher_mail">Send</button>
                </div>
            </div>
        </div>
    </form>
    <!-- end::form teacher -->
    <?php
}
?>
<!--end::Compose-->
<script type="text/javascript" src='https://cdn.tiny.cloud/1/jwc9s2y5k97422slkhbv6eu2eqwbwl2skj9npskngzqtsrhq/tinymce/4/tinymce.min.js' referrerpolicy="origin"></script>
<script>
tinymce.init({
  selector: 'textarea',
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
</script>
