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
?>
<style>
.highlight td.default 
{
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
<!--begin::Entry-->
<div class="d-flex flex-column-fluid">
    <!--begin::Container-->
    <div class="container">
        <!--begin::Card-->
        <div class="card card-custom gutter-b basic">
            <div class="card-body">
                <!--begin::Details-->
                <div class="d-flex mb-9">
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
                                    <i class="flaticon2-calendar-3 mr-2 font-size-lg"></i><?= $_SESSION["loggeduser_DepartmentName"]; ?></a>
                                    <a href="#" class="text-dark-50 text-hover-primary font-weight-bold text-lowercase">
                                    <i class="flaticon2-placeholder mr-2 font-size-lg"></i><?= $_SESSION["loggeduser_consumerState"]; ?></a>
                                </div>
                            </div>
                        </div>
                        <!--end::Content-->
                    </div>
                    <!--end::Info-->
                </div>
                <!--end::Details-->
            </div>
        </div>
        <!--end::Card-->
        <!--begin::Row-->
        <div class="row">
            <div class="col-lg-6">
                <!--begin::Charts Widget 4-->
                <div class="card card-custom card-stretch gutter-b">
                    <!--begin::Body-->
                    <div class="card-body">
                        <div id="kt_charts_widget_4_chart">
                            <table class="table table-bordered">
                                <tbody>
                                    <tr class="bg-light text-dark-50">
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
                        if($_SESSION["loggeduser_ConsumerGroupName"] == 'SCHOOL' && $_SESSION["loggeduser_ConsumerGroupName"] !== 'GONGETZ')
                        {
                            ?>
                            <table class="table table-bordered">
                                <tr class="bg-light text-dark-50">
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
                                    <td><a href="index.php?page=classdetail&id=<?= $Class_id; ?>"><?= $ClassName; ?></a></td>
                                    <td><a href="index.php?page=subjectdetail&id=<?= $Subject_id; ?>"><?= $SubjectName; ?></a></td>
                                    </tr>
                                    <?php
                                }
                                ?>
                                </tbody>
                            </table>
                            <?php
                        }
                        elseif($_SESSION["loggeduser_ConsumerGroupName"] == 'STUDENT')
                        {
                            ?>
                            <table class="table table-bordered">
                                <tr class="bg-light text-dark-50">
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
                                    <td><a href="index.php?page=classdetail&id=<?= $Class_id; ?>"><?= $ClassName; ?></a></td>
                                    <td><a href="index.php?page=subjectdetail&id=<?= $Subject_id; ?>"><?= $SubjectName; ?></a></td>
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
                    <!--end::Body-->
                </div>
                <!--end::Charts Widget 4-->
            </div>
            <div class="col-lg-6">
                <!--begin::List Widget 11-->
                <div class="card card-custom card-stretch gutter-b">
                    <!--begin::Body-->
                    <div class="card-body">
                        <div id="kt_charts_widget_4_chart">
                            <div class="card">
                                <div class="card-header bg-light text-dark-50">
                                    <a>Remarks</a>
                                </div>
                                <div class="card-body">
                                    <div class="tab-content" id="v-pills-tabContent">
                                    <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
                                        <div class="box">
                                        <form name="add_remark" action="model/staff_remark.php" method="POST">
                                            <textarea class="staff" name="remark"></textarea>
                                            <div class="mt-3 text-right">
                                            <input type="hidden" value="<?= $consumer_id; ?>" name="consumer_id">
                                            <button type="submit" class="btn btn-light btn-hover-success btn-sm" name="add_remark">Add remark</button>
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
                                                            <button type="button" class="btn btn-light btn-hover-success btn-sm" data-bs-toggle="modal" data-bs-target="#update_staff_remark" data-bs-whatever="<?= $remark_id1; ?>">Update</button>
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
                                                            <button type="button" class="btn btn-light btn-hover-success btn-sm" data-bs-toggle="modal" data-bs-target="#update_staff_remark" data-bs-whatever="<?= $remark_id1; ?>">update</button>
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
                                                            <button type="button" class="btn btn-light btn-hover-success btn-sm" data-bs-toggle="modal" data-bs-target="#update_staff_remark" data-bs-whatever="<?= $remark_id1; ?>">update</button>
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
                    <!--end::Body-->
                </div>
                <!--end::List Widget 11-->
            </div>
        </div>
        <!--end::Row-->
        <!--begin::Row-->
        <div class="row">
            <div class="col-lg-12">
                <!--begin::Advance Table Widget 2-->
                <div class="card card-custom card-stretch gutter-b">
                    <!--begin::Body-->
                    <div class="card-body">
                        <!-- begin::attendance -->
                        <div class="text-right p-3">
                            <a href="index.php?page=staffdetail&id=<?= $consumer_id; ?>&attendance=xls" class="btn btn-light btn-hover-success btn-sm mb-3">EXPORT ATTENDANCE TO XLS</a>
                            <table id="attendance" class="table table-bordered text-left shadow p-3 mb-5 rounded">
                            <thead class="text-dark-50">
                                <tr>
                                    <th>Staff ID</th>
                                    <th>Staff Name</th>
                                    <th>Date</th>
                                    <th>IN</th>
                                    <th>OUT</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $Cards_id ='';
                                $date_now = date("d-m-Y");
                                $from_date = new MongoDB\BSON\UTCDateTime((new DateTime($date_now))->getTimestamp()*1000);
                                $to_date = new MongoDB\BSON\UTCDateTime((new DateTime('now +1 month'))->getTimestamp()*1000);

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
                                <td class="default"><?= $date_now."<br>"; ?></td>
                                <td class="default"><?php
                                $count = 0;
                                $filter = ['CardID'=>$Cards_id ,'AttendanceDate' => ['$gte' => $from_date]];
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
                                $filter = ['CardID'=>$Cards_id ,'AttendanceDate' => ['$gte' => $from_date]];
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
                            <?php
                            if (isset($_GET['attendance']) && !empty($_GET['attendance']))
                            {
                                $attendance = ($_GET['attendance']);
                                ?>
                                <script>
                                $(document).ready(function () {
                                    $("#attendance").table2excel({
                                        filename: "attendancestaff.xls"
                                    });
                                });
                                
                                </script>
                                <?php
                            }?>
                            <script type="text/javascript">
                            var rows = document.querySelectorAll('tr');

                            [...rows].forEach((r) => {
                            if (r.querySelectorAll('td:empty').length > 0) {
                            r.classList.add('highlight');
                            }
                            })
                            </script>
                        </div>
                        <!-- end::attendance -->
                    </div>
                    <!--end::Body-->
                </div>
                <!--end::Advance Table Widget 2-->
            </div>
        </div>
        <!--end::Row-->
    </div>
    <!--end::Container-->
</div>
<!--end::Entry-->
<script type="text/javascript" src='https://cdn.tiny.cloud/1/qagffr3pkuv17a8on1afax661irst1hbr4e6tbv888sz91jc/tinymce/4/tinymce.min.js' referrerpolicy="origin"></script>
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