<?php
$_SESSION["title"] = "Profile";
include 'view/partials/_subheader/subheader-v1.php'; 

$filter = ['_id'=>new \MongoDB\BSON\ObjectId($_SESSION["loggeduser_id"])];
$query = new MongoDB\Driver\Query($filter);
$cursor = $GoNGetzDatabase->executeQuery('GoNGetz.Consumer',$query);
foreach ($cursor as $document)
{
    $consumer_id = strval($document->_id);
    $ConsumerFName = $document->ConsumerFName;
    $ConsumerLName = $document->ConsumerLName;
    $ConsumerIDType = $document->ConsumerIDType;
    $ConsumerIDNo = $document->ConsumerIDNo;
    $ConsumerEmail = $document->ConsumerEmail;
    $ConsumerPhone = $document->ConsumerPhone;
    $ConsumerAddress = $document->ConsumerAddress;
    $ConsumerStatus = $document->ConsumerStatus;
}
$date = date("Y-m-d");
$today = new MongoDB\BSON\UTCDateTime((new DateTime($date))->getTimestamp()*1000);
if (isset($_POST['submit_date']))
{
    $date = $_POST['date'];
}
?>
<style>
.highlight td.default {
  background:#ff8795;
  color:#ffff ;
  border-color:#ffff;
}

.basic{
    background-image: url('assets/media/svg/patterns/taieri.svg');
    /* Center and scale the image nicely */
    background-position: center;
    background-repeat: no-repeat;
    background-size: cover;
}
</style>
<div class="row">
    <div class="col-lg-12">
        <div class="card card-custom card-stretch gutter-b">
            <div class="card-body basic">
                <!--begin::Info-->
                <div class="flex-grow-1">
                    <!--begin::Title-->
                    <div class="d-flex justify-content-between flex-wrap mt-1">
                        <div class="d-flex mr-3">
                            <a href="#" class="text-dark-75 text-hover-primary font-size-h5 font-weight-bold mr-3"><?= $_SESSION["loggeduser_consumerFName"]." ".$_SESSION["loggeduser_consumerLName"] ?></a>
                            <a href="#">
                                <i class="flaticon2-correct text-success font-size-h5"></i>
                            </a>
                        </div>
                        <div class="my-lg-0 my-3">
                        </div>
                    </div>
                    <!--end::Title-->
                    <!--begin::Content-->
                    <div class="d-flex flex-wrap justify-content-between mt-1">
                        <div class="d-flex flex-column flex-grow-1 pr-8">
                            <div class="d-flex flex-wrap mb-4">
                                <a href="#" class="text-dark-50 text-hover-primary font-weight-bold mr-lg-8 mr-5 mb-lg-0 mb-2">
                                <i class="flaticon2-new-email mr-2 font-size-lg"></i><?= $_SESSION["loggeduser_consumerEmail"]; ?></a>
                                <a href="#" class="text-dark-50 text-hover-primary font-weight-bold mr-lg-8 mr-5 mb-lg-0 mb-2 text-lowercase">
                                <i class="flaticon2-calendar-3 mr-2 font-size-lg"></i>
                                <?php
                                if ($_SESSION["loggeduser_ACCESS"] == 'STAFF')
                                {
                                    echo $_SESSION["loggeduser_DepartmentName"]; 
                                }
                                elseif($_SESSION["loggeduser_ACCESS"] == 'STUDENT')
                                {
                                    echo $_SESSION["loggeduser_ClassCategory"]." ".$_SESSION["loggeduser_ClassName"];
                                }
                                else
                                {
                                    
                                }
                                ?></a>
                                <a href="#" class="text-dark-50 text-hover-primary font-weight-bold text-lowercase">
                                <i class="flaticon2-placeholder mr-2 font-size-lg"></i><?= $_SESSION["loggeduser_consumerState"]; ?></a>
                            </div>
                        </div>
                    </div>
                    <!--end::Content-->
                </div>
                <!--end::Info-->
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-6">
        <div class="card card-custom card-stretch gutter-b">
            <div class="card-body">
            <table class="table table-bordered">
                <tbody>
                    <tr class="bg-success text-white">
                        <td>Name</td>
                        <td><?= $ConsumerFName." ".$ConsumerLName; ?> </td>
                    </tr>
                    <tr>
                        <td>ID Type</td>
                        <td><?= $ConsumerIDType; ?></td>
                    </tr>
                    <tr>
                        <td>ID Number</td>
                        <td><?= $ConsumerIDNo; ?></td>
                    </tr>
                    <tr>
                        <td>Email</td>
                        <td><?= $ConsumerEmail; ?></td>
                    </tr>
                    <tr>
                        <td>Phone Number</td>
                        <td><?= $ConsumerPhone; ?></td>
                    </tr>
                    <tr>
                        <td>Address</td>
                        <td><?= $ConsumerAddress; ?></td>
                    </tr>
                    <tr>
                        <td>Status</td>
                        <td><?= $ConsumerStatus; ?></td>
                    </tr>
                </tbody>
            </table>
            <?php
            if($_SESSION["loggeduser_ACCESS"] == 'TEACHER')
            {
                ?>
                <table class="table table-bordered">
                    <tr class="bg-success text-white">
                        <td>Class</td>
                        <td>Subject</td>
                    </tr>
                    <tbody>
                    <?php
                    $filter = ['Teacher_id'=>$_SESSION["loggeduser_teacherid"]];
                    $query = new MongoDB\Driver\Query($filter);
                    $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.ClassroomSubjectRel',$query);
                    foreach ($cursor as $document)
                    {
                        $Class_id = $document->Class_id;
                        $Subject_id = $document->Subject_id;
                    
                        $filter = ['_id'=>new \MongoDB\BSON\ObjectId($Class_id)];
                        $query = new MongoDB\Driver\Query($filter);
                        $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Classrooms',$query);
                        foreach ($cursor as $document)
                        {
                            $ClassName = $document->ClassName;
                        }

                        $filter = ['_id'=>new \MongoDB\BSON\ObjectId($Subject_id)];
                        $query = new MongoDB\Driver\Query($filter);
                        $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.SchoolsSubject',$query);
                        foreach ($cursor as $document)
                        {
                            $SubjectName = $document->SubjectName;
                        }
                        ?>
                        <tr>
                        <td><a href="index.php?page=class_detail&id=<?= $Class_id; ?>"><?= $ClassName; ?></a></td>
                        <td><a href="index.php?page=subject_detail&id=<?= $Subject_id; ?>"><?= $SubjectName; ?></a></td>
                        </tr>
                        <?php
                    }
                    ?>
                    </tbody>
                </table>
                <?php
            }
            elseif($_SESSION["loggeduser_ACCESS"] == 'STUDENT')
            {
                ?>
                <table class="table table-bordered">
                    <tr class="bg-success text-white">
                        <td>Class</td>
                        <td>Subject</td>
                    </tr>
                    <tbody>
                    <?php
                    $filter = ['Class_id'=>$_SESSION["loggeduser_class_id"]];
                    $query = new MongoDB\Driver\Query($filter);
                    $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.ClassroomSubjectRel',$query);
                    foreach ($cursor as $document)
                    {
                        $Class_id = $document->Class_id;
                        $Subject_id = $document->Subject_id;
                    
                        $filter = ['_id'=>new \MongoDB\BSON\ObjectId($Class_id)];
                        $query = new MongoDB\Driver\Query($filter);
                        $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Classrooms',$query);
                        foreach ($cursor as $document)
                        {
                        $ClassName = $document->ClassName;
                        }

                        $filter = ['_id'=>new \MongoDB\BSON\ObjectId($Subject_id)];
                        $query = new MongoDB\Driver\Query($filter);
                        $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.SchoolsSubject',$query);
                        foreach ($cursor as $document)
                        {
                        $SubjectName = $document->SubjectName;
                        }
                        ?>
                        <tr>
                        <td><a href="index.php?page=class_detail&id=<?= $Class_id; ?>"><?= $ClassName; ?></a></td>
                        <td><a href="index.php?page=subject_detail&id=<?= $Subject_id; ?>"><?= $SubjectName; ?></a></td>
                        </tr>
                        <?php
                    }
                    ?>
                    </tbody>
                </table>
                <?php
            }
            ?>
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="card card-custom card-stretch gutter-b">
            <div class="card-body">
                <div class="card-header bg-success text-white"><a>Remarks</a></div>
                <div class="tab-content" id="v-pills-tabContent">
                    <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
                        <div class="box mt-3">
                            <form name="add_remark" action="model/staff_remark.php" method="POST">
                                <textarea class="staff" name="remark"></textarea>
                                <div class="mt-3 text-right">
                                    <input type="hidden" value="<?= $consumer_id; ?>" name="consumer_id">
                                    <button type="submit" class="btn btn-success btn-hover-light btn-sm" name="add_remark">Add remark</button>
                                </div>
                            </form>
                        </div>
                        <div class="box">
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <li class="nav-item" role="presentation">
                                <a class="nav-link active" id="active-tab" data-bs-toggle="tab" href="#active" role="tab" aria-controls="active" aria-selected="true">Active</a>
                                </li>
                                <li class="nav-item" role="presentation">
                                <a class="nav-link" id="pending-tab" data-bs-toggle="tab" href="#pending" role="tab" aria-controls="pending" aria-selected="false">Pending</a>
                                </li>
                                <li class="nav-item" role="presentation">
                                <a class="nav-link" id="completed-tab" data-bs-toggle="tab" href="#completed" role="tab" aria-controls="completed" aria-selected="false">Completed</a>
                                </li>
                            </ul>
                            <div class="tab-content" id="myTabContent">
                                <div class="tab-pane fade show active" id="active" role="tabpanel" aria-labelledby="active-tab">
                                    <table class="table mx-3">
                                        <thead>
                                        <tr class="row">
                                            <th class="col-2">Date</th>
                                            <th class="col-2">Staff</th>
                                            <th class="col">Details</th>
                                        </tr>
                                        </thead>
                                    </table>
                                    <?php
                                    $filter = ['Consumer_id'=>$consumer_id,'SubRemarks'=>'0','Status'=>'ACTIVE'];
                                    $option = ['sort' => ['_id' => -1],'limit'=>10];
                                    $query = new MongoDB\Driver\Query($filter, $option);
                                    $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Staff_Remarks',$query);
                                    foreach ($cursor as $document)
                                    {
                                        $remark_id1 = strval($document->_id);
                                        $Details1 = $document->Details;
                                        $Staff_id1 = $document->Staff_id;
                                        $Date1 = strval($document->Date);
                                        $Date1 = new MongoDB\BSON\UTCDateTime(strval($Date1));
                                        $Date1 = $Date1->toDateTime()->setTimezone(new \DateTimeZone(date_default_timezone_get()));

                                        $filter = ['_id' => new \MongoDB\BSON\ObjectId($Staff_id1)];
                                        $query = new MongoDB\Driver\Query($filter);
                                        $cursor = $GoNGetzDatabase->executeQuery('GoNGetz.Consumer', $query);
                                        foreach ($cursor as $document)
                                        {
                                            $ConsumerFName = $document->ConsumerFName;
                                        }
                                        ?>
                                        <div class="accordion accordion-flush" id="accordionFlushExample">
                                            <div class="accordion-item">
                                                <h6 class="accordion-header" id="flush-heading<?= $remark_id1; ?>">
                                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse<?= $remark_id1; ?>" aria-expanded="false" aria-controls="flush-collapse<?= $remark_id1; ?>">
                                                        <table class="table table-borderless text-left">
                                                            <tbody>
                                                                <tr class="row">
                                                                    <td class="col-2"><?= date_format($Date1,"D,d M Y H:i") ?></td>
                                                                    <td class="col-2"><?= $ConsumerFName; ?></td>
                                                                    <td class="col"><a align="justify"><?= $Details1; ?></a></td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </button>
                                                </h6>
                                                <div  id="flush-collapse<?= $remark_id1; ?>" class="accordion-collapse collapse" aria-labelledby="flush-heading<?= $remark_id1; ?>" data-bs-parent="#accordionFlushExample">
                                                    <?php 
                                                    $filter = ['Consumer_id'=>$consumer_id,'SubRemarks'=>$remark_id1];
                                                    $option = ['sort' => ['_id' => -1],'limit'=>10];
                                                    $query = new MongoDB\Driver\Query($filter, $option);
                                                    $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Staff_Remarks',$query);
                                                    foreach ($cursor as $document2)
                                                    {
                                                        $remark_id2 = strval($document2->_id);
                                                        $Details2 = $document2->Details;
                                                        $Staff_id2 = $document2->Staff_id;
                                                        $Date2 = strval($document2->Date);
                                                        $Date2 = new MongoDB\BSON\UTCDateTime(strval($Date2));
                                                        $Date2 = $Date2->toDateTime()->setTimezone(new \DateTimeZone(date_default_timezone_get()));

                                                        $filter = ['_id' => new \MongoDB\BSON\ObjectId($Staff_id2)];
                                                        $query = new MongoDB\Driver\Query($filter);
                                                        $cursor = $GoNGetzDatabase->executeQuery('GoNGetz.Consumer', $query);
                                                        foreach ($cursor as $document)
                                                        {
                                                            $ConsumerFName = $document->ConsumerFName;
                                                        }
                                                        ?>
                                                        <div class="accordion-body">
                                                            <table class="table table-borderless text-left">
                                                                <tbody>
                                                                    <tr class="row">
                                                                    <td class="col-2"><?= date_format($Date2,"D,d M Y H:i") ?></td>
                                                                    <td class="col-2"><?= $ConsumerFName; ?></td>
                                                                    <td class="col"><a align="justify"><?= $Details2;?></a></td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                        <?php
                                                    }
                                                    ?>
                                                    <form name="add_remark_child" action="model/staff_remark.php" method="POST">
                                                        <div class="m-3">
                                                            <textarea class="staff" name="remark"></textarea>
                                                        </div>
                                                        <div class="m-3 text-right">
                                                            <input type="hidden" value="<?= $consumer_id; ?>" name="consumer_id">
                                                            <input type="hidden" value="<?= $remark_id1; ?>" name="remark_id">
                                                            <button type="submit" class="btn btn-light btn-sm" name="add_remark_child">Add remark</button>
                                                            <button type="button" class="btn btn-success btn-hover-light btn-sm" data-bs-toggle="modal" data-bs-target="#update_staff_remark" data-bs-whatever="<?= $remark_id1; ?>">Update</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        <?php
                                    }
                                    ?>
                                </div>
                                <div class="tab-pane fade show pending" id="pending" role="tabpanel" aria-labelledby="pending-tab">
                                    <table class="table">
                                        <thead>
                                        <tr class="row">
                                            <th class="col-2">Date</th>
                                            <th class="col-2">Staff</th>
                                            <th class="col">Details</th>
                                        </tr>
                                        </thead>
                                    </table>
                                    <?php
                                    $filter = ['Consumer_id'=>$consumer_id,'SubRemarks'=>'0','Status'=>'PENDING'];
                                    $option = ['sort' => ['_id' => -1],'limit'=>10];
                                    $query = new MongoDB\Driver\Query($filter, $option);
                                    $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Staff_Remarks',$query);
                                    foreach ($cursor as $document)
                                    {
                                        $remark_id1 = strval($document->_id);
                                        $Details1 = $document->Details;
                                        $Staff_id1 = $document->Staff_id;
                                        $Date1 = strval($document->Date);
                                        $Date1 = new MongoDB\BSON\UTCDateTime(strval($Date1));
                                        $Date1 = $Date1->toDateTime()->setTimezone(new \DateTimeZone(date_default_timezone_get()));

                                        $filter = ['_id' => new \MongoDB\BSON\ObjectId($Staff_id1)];
                                        $query = new MongoDB\Driver\Query($filter);
                                        $cursor = $GoNGetzDatabase->executeQuery('GoNGetz.Consumer', $query);
                                        foreach ($cursor as $document)
                                        {
                                            $ConsumerFName = $document->ConsumerFName;
                                        }
                                        ?>
                                        <div class="accordion accordion-flush" id="accordionFlushExample">
                                            <div class="accordion-item">
                                            <h6 class="accordion-header" id="flush-headingOne">
                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                                                <table class="table table-borderless text-left">
                                                    <tbody>
                                                    <tr class="row">
                                                        <td class="col-2"><?= date_format($Date1,"D,d M Y H:i") ?></td>
                                                        <td class="col-2"><?= $ConsumerFName; ?></td>
                                                        <td class="col"><a align="justify"><?= $Details1;?></a></td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                                </button>
                                            </h6>
                                            <div  id="flush-collapseOne" class="accordion-collapse collapse mt-3" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                                                <?php 
                                                $filter = ['Consumer_id'=>$consumer_id,'SubRemarks'=>$remark_id1];
                                                $option = ['sort' => ['_id' => -1],'limit'=>10];
                                                $query = new MongoDB\Driver\Query($filter, $option);
                                                $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Staff_Remarks',$query);
                                                foreach ($cursor as $document2)
                                                {
                                                    $remark_id2 = strval($document2->_id);
                                                    $Details2 = ($document2->Details);
                                                    $Staff_id2 = ($document2->Staff_id);
                                                    $Date2 = strval($document2->Date);
                                                    $Date2 = new MongoDB\BSON\UTCDateTime($Date2);
                                                    $Date2 = $Date2->toDateTime()->setTimezone(new \DateTimeZone(date_default_timezone_get()));

                                                    $filter = ['_id' => new \MongoDB\BSON\ObjectId($Staff_id2)];
                                                    $query = new MongoDB\Driver\Query($filter);
                                                    $cursor = $GoNGetzDatabase->executeQuery('GoNGetz.Consumer', $query);
                                                    foreach ($cursor as $document)
                                                    {
                                                        $ConsumerFName = $document->ConsumerFName;
                                                    }
                                                    ?>
                                                    <div class="accordion-body">
                                                        <table class="table table-borderless text-left">
                                                        <tbody>
                                                            <tr class="row">
                                                            <td class="col-2"><?= date_format($Date2,"D,d M Y H:i") ?></td>
                                                            <td class="col-2"><?= $ConsumerFName; ?></td>
                                                            <td class="col"><a align="justify"><?= $Details2;?></a></td>
                                                            </tr>
                                                        </tbody>
                                                        </table>
                                                    </div>
                                                    <?php
                                                }
                                                ?>
                                                <form name="add_remark_child" action="model/staff_remark.php" method="POST">
                                                <div class="m-3">
                                                    <textarea class="staff" name="remark"></textarea>
                                                </div>
                                                <div class="m-3 text-right">
                                                    <input type="hidden" value="<?= $consumer_id; ?>" name="consumer_id">
                                                    <input type="hidden" value="<?= $remark_id1; ?>" name="remark_id">
                                                    <button type="submit" class="btn btn-light btn-sm" name="add_remark_child">Add remark</button>
                                                    <button type="button" class="btn btn-success btn-hover-light btn-sm" data-bs-toggle="modal" data-bs-target="#update_staff_remark" data-bs-whatever="<?= $remark_id1; ?>">update</button>
                                                </div>
                                                </form>
                                            </div>
                                            </div>
                                        </div>
                                        <?php
                                    }
                                    ?>
                                </div>
                                <div class="tab-pane fade show completed" id="completed" role="tabpanel" aria-labelledby="completed-tab">
                                    <table class="table mx-3">
                                        <thead>
                                        <tr class="row">
                                            <th class="col-2">Date</th>
                                            <th class="col-2">Staff</th>
                                            <th class="col">Details</th>
                                        </tr>
                                        </thead>
                                    </table>
                                    <?php
                                    $filter = ['Consumer_id'=>$consumer_id,'SubRemarks'=>'0','Status'=>'COMPLETED'];
                                    $option = ['sort' => ['_id' => -1],'limit'=>10];
                                    $query = new MongoDB\Driver\Query($filter, $option);
                                    $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Staff_Remarks',$query);
                                    foreach ($cursor as $document)
                                    {
                                        $remark_id1 = strval($document->_id);
                                        $Staff_id1 = $document->Staff_id;
                                        $Details1 = $document->Details;
                                        $Date1 = strval($document->Date);
                                        $Date1 = new MongoDB\BSON\UTCDateTime(strval($Date1));
                                        $Date1 = $Date1->toDateTime()->setTimezone(new \DateTimeZone(date_default_timezone_get()));
                                        
                                        $filter = ['_id' => new \MongoDB\BSON\ObjectId($Staff_id1)];
                                        $query = new MongoDB\Driver\Query($filter);
                                        $cursor = $GoNGetzDatabase->executeQuery('GoNGetz.Consumer',$query);
                                        foreach ($cursor as $document)
                                        {
                                            $ConsumerFName = $document->ConsumerFName;
                                        }
                                        ?>
                                        <div class="accordion accordion-flush" id="accordionFlushExample">
                                            <div class="accordion-item">
                                                <h6 class="accordion-header" id="flush-headingOne">
                                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                                                    <table class="table table-borderless text-left">
                                                        <tbody>
                                                            <tr class="row">
                                                            <td class="col-2"><?= date_format($Date1,"D,d M Y H:i") ?></td>
                                                            <td class="col-2"><?= $ConsumerFName;?></td>
                                                            <td class="col"><a align="justify"><?= $Details1;?></a></td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                    </button>
                                                </h6>
                                                <div  id="flush-collapseOne" class="accordion-collapse collapse mt-3" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                                                    <?php 
                                                    $filter = ['Consumer_id'=>$consumer_id,'SubRemarks'=>$remark_id1];
                                                    $option = ['sort' => ['_id' => -1],'limit'=>10];
                                                    $query = new MongoDB\Driver\Query($filter,$option);
                                                    $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Staff_Remarks',$query);
                                                    foreach ($cursor as $document2)
                                                    {
                                                    $remark_id2 = strval($document2->_id);
                                                    $Details2 = $document2->Details;
                                                    $Staff_id2 = $document2->Staff_id;
                                                    $Date2 = $document2->Date;
                                                    $Date2 = new MongoDB\BSON\UTCDateTime(strval($Date2));
                                                    $Date2 = $Date2->toDateTime()->setTimezone(new \DateTimeZone(date_default_timezone_get()));

                                                    $filter = ['_id' => new \MongoDB\BSON\ObjectId($Staff_id2)];
                                                    $query = new MongoDB\Driver\Query($filter);
                                                    $cursor = $GoNGetzDatabase->executeQuery('GoNGetz.Consumer',$query);
                                                    foreach ($cursor as $document)
                                                    {
                                                        $ConsumerFName = $document->ConsumerFName;
                                                    }
                                                    ?>
                                                    <div class="accordion-body">
                                                        <table class="table table-borderless text-left">
                                                        <tbody>
                                                            <tr class="row">
                                                            <td class="col-2"><?= date_format($Date2,"D,d M Y H:i") ?></td>
                                                            <td class="col-2"><?= $ConsumerFName;?></td>
                                                            <td class="col"><a align="justify"><?= $Details2;?></a></td>
                                                            </tr>
                                                        </tbody>
                                                        </table>
                                                    </div>
                                                    <?php
                                                }
                                                    ?>
                                                    <form name="add_remark_child" action="model/staff_remark.php" method="POST">
                                                        <div class="m-3">
                                                        <textarea class="staff" name="remark"></textarea>
                                                        </div>
                                                        <div class="m-3 text-right">
                                                        <input type="hidden" value="<?= $consumer_id; ?>" name="consumer_id">
                                                        <input type="hidden" value="<?= $remark_id1; ?>" name="remark_id">
                                                        <button type="submit" class="btn btn-light btn-sm" name="add_remark_child">Add remark</button>
                                                        <button type="button" class="btn btn-success btn-hover-light btn-sm" data-bs-toggle="modal" data-bs-target="#update_staff_remark" data-bs-whatever="<?= $remark_id1; ?>">update</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        <?php
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="card card-custom card-stretch gutter-b">
            <div class="card-body table-responsive">
                <form name="submit_date" action="index.php?page=profile" method="post">
                    <div class="row mb-3">
                        <div class="col text-right">
                            <input type="date" class="form-control form-control-sm bg-white" name="date" placeholder="Select date" value="<?= $date; ?>"> 
                        </div>
                        <div class="col text-right">
                            <button type="submit" name="submit_date" class="btn btn-success btn-hover-light btn-sm">Submit</button>
                            <button type="button" id="submitted" class="btn btn-success btn-hover-light btn-sm">Export Attendance To XLS</button>
                        </div>
                    </div>
                </form>
                <table id="attendance" class="table table-bordered text-left shadow p-3 mb-5 rounded">
                <thead class="bg-white text-success">
                    <tr>
                        <th>Consumer ID</th>
                        <th>Consumer Name</th>
                        <th>Date</th>
                        <th>IN</th>
                        <th>OUT</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $Cards_id ='';
                    //$from_date = new MongoDB\BSON\UTCDateTime((new DateTime($date_now))->getTimestamp()*1000);
                    //$to_date = new MongoDB\BSON\UTCDateTime((new DateTime('now +1 month'))->getTimestamp()*1000);

                    $filter = ['Consumer_id'=>$consumer_id];
                    $query = new MongoDB\Driver\Query($filter);
                    $cursor = $GoNGetzDatabase->executeQuery('GoNGetz.Cards',$query);
                    foreach ($cursor as $document)
                    {
                        $Cards_id = strval($document->Cards_id);
                    }
                    ?>
                    <tr>
                    <td class="default"><?= $ConsumerIDNo; ?></td>
                    <td class="default"><?= $ConsumerFName." ".$ConsumerLName; ?></td>
                    <td class="default"><?= $date."<br>"; ?></td>
                    <td class="default"><?php
                    $count = 0;
                    $filter = ['CardID'=>$Cards_id ,'AttendanceDate' => ['$gte' => $today]];
                    $option = ['sort' => ['_id' => 1]];
                    $query = new MongoDB\Driver\Query($filter,$option);
                    $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Attendance',$query);
                    foreach ($cursor as $document)
                    {
                        $date = strval($document->AttendanceDate);
                        $date = new MongoDB\BSON\UTCDateTime($date);
                        $date = $date->toDateTime()->setTimezone(new \DateTimeZone(date_default_timezone_get()));

                        $count = $count +1;
                        if ($count % 2){
                        echo date_format($date,"H:i:s")."<br>";}
                    }
                    ?></td>
                    <td class="default"><?php
                    $count = 0;
                    $filter = ['CardID'=>$Cards_id ,'AttendanceDate' => ['$gte' => $today]];
                    $option = ['sort' => ['_id' => 1]];
                    $query = new MongoDB\Driver\Query($filter,$option);
                    $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Attendance',$query);
                    foreach ($cursor as $document)
                    {
                        $date = strval($document->AttendanceDate);
                        $date = new MongoDB\BSON\UTCDateTime($date);
                        $date = $date->toDateTime()->setTimezone(new \DateTimeZone(date_default_timezone_get()));
                        
                        $count = $count +1;
                        if ($count % 2){
                        }
                        else{
                        echo date_format($date,"H:i:s")."<br>";}
                    }
                    ?></td>
                    </tr>
                </tbody>
                </table>
                <script>
                $(document).ready(function() {

                    $("#submitted").click(function() {
                        $("#attendance").table2excel({
                        filename: "attendance.xls"
                    });
                    });

                });
                </script>
                <script type="text/javascript">
                var rows = document.querySelectorAll('tr');

                [...rows].forEach((r) => {
                if (r.querySelectorAll('td:empty').length > 0) {
                r.classList.add('highlight');
                }
                })
                </script>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" src='https://cdn.tiny.cloud/1/ctl5tdxtaqli3dvaw5f3zolgpcusntlmonfxnq4673uy1x7d/tinymce/4/tinymce.min.js' referrerpolicy="origin"></script>
<script>
tinymce.init({
  selector: '.staff',
  menubar:false,
  statusbar: false,
  toolbar: false,
  height:100,
});
</script>
<?php include ('view/pages/modal-update_remark.php'); ?>