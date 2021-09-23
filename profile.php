<?php
    $GoNGetzConnectionString="mongodb://admin:TempPassword@51.79.173.45:27017/gngoffice?authSource=admin";
    $GoNGetzDatabase = new MongoDB\Driver\Manager($GoNGetzConnectionString);

    function time_elapsed($Date){
        $bit = array(
            ' year'      => $Date  / 31556926 % 12,
            ' week'      => $Date  / 604800 % 52,
            ' day'       => $Date  / 86400 % 7,
            ' hour'      => $Date  / 3600 % 24,
            ' minute'    => $Date  / 60 % 60,
            ' second'    => $Date  % 60
            );
        foreach($bit as $k => $v){
            if($v > 1)$ret[] = $v . $k . 's';
            if($v == 1)$ret[] = $v . $k;
            }
        array_splice($ret, count($ret)-1, 0, '');
        $ret[] = '';
    
        return join(' ', $ret);
    }
    $user_id = $_GET['id'];
    $parent_id = "";
    //$School_id = "5fb5a728c930cc7b988b3bb7";

    $filter = ['ConsumerIDNo'=>$user_id];
    $query = new MongoDB\Driver\Query($filter);
    $cursor = $GoNGetzDatabase->executeQuery('GoNGetz.Consumer',$query);
    foreach ($cursor as $document)
    {
        $id = strval($document->_id);
        $ConsumerFName = $document->ConsumerFName;
        $ConsumerLName = $document->ConsumerLName;
        $ConsumerIDType = $document->ConsumerIDType;
        $ConsumerIDNo = $document->ConsumerIDNo;
        $ConsumerEmail = $document->ConsumerEmail;
        $ConsumerPhone = $document->ConsumerPhone;
        $ConsumerCity = $document->ConsumerCity;
        $ConsumerState = $document->ConsumerState;
        $ConsumerStatus = $document->ConsumerStatus;

        $filter = ['ConsumerID'=>$id,'StaffLevel'=>'1'];
        $query = new MongoDB\Driver\Query($filter);
        $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Staff',$query);
        $totalstaff = 0;
        foreach ($cursor as $document)
        {
            $ConsumerID = $document->ConsumerID;
            $SchoolID = $document->SchoolID;
            $_SESSION["loggeduser_ACCESS"] = "STAFF";
    
            $School_id = new \MongoDB\BSON\ObjectId($SchoolID);
            $filter = ['_id'=>$School_id];
            $query = new MongoDB\Driver\Query($filter);
            $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Schools',$query);
            foreach ($cursor as $document)
            {
                $schoolID = strval($document->_id);
                $SchoolsName = $document->SchoolsName;
                $SchoolsPhoneNo = $document->SchoolsPhoneNo;
                $SchoolsAddress = $document->SchoolsAddress;
                $SchoolsEmail = $document->SchoolsEmail;
            }
    
        }

        $filter = ['ConsumerID'=>$id,'StaffLevel'=>'0'];
        $query = new MongoDB\Driver\Query($filter);
        $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Staff',$query);
        $totalteacher= 0;
        foreach ($cursor as $document)
        {
            $ConsumerID = $document->ConsumerID;
            $SchoolID = $document->SchoolID;
            $_SESSION["loggeduser_ACCESS"] = "TEACHER";
    
            $School_id = new \MongoDB\BSON\ObjectId($SchoolID);
            $filter = ['_id'=>$School_id];
            $query = new MongoDB\Driver\Query($filter);
            $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Schools',$query);
            foreach ($cursor as $document)
            {
                $schoolID = strval($document->_id);
                $SchoolsName = $document->SchoolsName;
                $SchoolsPhoneNo = $document->SchoolsPhoneNo;
                $SchoolsAddress = $document->SchoolsAddress;
                $SchoolsEmail = $document->SchoolsEmail;
            }
        }

        /*
        $filter = ['Consumer_id'=>$id];
        $query = new MongoDB\Driver\Query($filter);
        $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Students',$query);
        $totalstudent = 0;
        foreach ($cursor as $document)
        {
            $totalstudent = $totalstudent+ 1;
            $Consumer_id = $document->Consumer_id;
            $Schools_id = $document->Schools_id;
            $_SESSION["loggeduser_ACCESS"] = "STUDENT";
    
            $School_id = new \MongoDB\BSON\ObjectId($Schools_id);
            $filter = ['_id'=>$School_id];
            $query = new MongoDB\Driver\Query($filter);
            $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Schools',$query);
            foreach ($cursor as $document)
            {
                $SchoolsName = $document->SchoolsName;
                $SchoolsPhoneNo = $document->SchoolsPhoneNo;
                $SchoolsAddress = $document->SchoolsAddress;
                $SchoolsEmail = $document->SchoolsEmail;
            }
        }*/

        $filter = ['ConsumerID'=>$id];
        $query = new MongoDB\Driver\Query($filter);
        $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Parents',$query);
        $totalparent = 0;
        foreach ($cursor as $document)
        {
            $parent_id = strval($document->_id);
            $ConsumerID = $document->ConsumerID;
            $Schools_id = $document->Schools_id;
            $_SESSION["loggeduser_ACCESS"] = "PARENT";
    
            $School_id = new \MongoDB\BSON\ObjectId($Schools_id);
            $filter = ['_id'=>$School_id];
            $query = new MongoDB\Driver\Query($filter);
            $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Schools',$query);
            foreach ($cursor as $document)
            {
                $schoolID = strval($document->_id);
                $SchoolsName = $document->SchoolsName;
                $SchoolsPhoneNo = $document->SchoolsPhoneNo;
                $SchoolsAddress = $document->SchoolsAddress;
                $SchoolsEmail = $document->SchoolsEmail;
            }
        }
    }

    //echo $_SESSION["loggeduser_ACCESS"];
    ?>
<!doctype html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
        <style>
        .main-card {
            -webkit-box-shadow: 0px 0px 5px 0px rgba(184,184,184,1);
            -moz-box-shadow: 0px 0px 5px 0px rgba(184,184,184,1);
            box-shadow: 0px 0px 5px 0px rgba(184,184,184,1);
        }
        .card {
            border-radius: 10px;
        }

        .btn.btn-success {
            color: #ffffff;
            background-color: #1BC5BD;
            border-color: #1BC5BD;
        }

        .flex-center {
            justify-content: center;
            /* align-items: center; */
        }

        .nav.nav-pills.nav-light-success .nav-link.active {
        color: #ffff;
        background-color: #1BC5BD;
        }

        link.active {
            color: #ffffff;
            background-color: #ffffff;
            transition: color 0.15s ease, background-color 0.15s ease, border-color 0.15s ease, box-shadow 0.15s ease;
        }

        .nav.nav-pills .nav-link {
            color: #B5B5C3;
            transition: color 0.15s ease, background-color 0.15s ease, border-color 0.15s ease, box-shadow 0.15s ease;
            position: relative;
        }

        .nav .nav-link {
            display: flex;
            align-items: center;
            transition: color 0.15s ease, background-color 0.15s ease, border-color 0.15s ease, box-shadow 0.15s ease;
            padding: 0.75rem 1.5rem;
            color: #7E8299;
            padding-top: .25rem!important;
            padding-bottom: .25rem!important;
        }

        .flex-center {
            justify-content: center;
            /* align-items: center; */
        }

        .svg-icon.svg-icon-success svg g [fill] {
            transition: fill 0.3s ease;
            fill: #1BC5BD !important;
        }

        .nav {
            display: flex;
            flex-wrap: wrap;
        }
        
        .pt-9, .py-9 {
            padding-top: 1.25rem !important;
        }

        .mt-5 {
            margin-top: 1rem!important;
        }
        </style>
        <title>Go N Getz - School Name</title>
    </head>
    <body style="color: #696969;">
        <div class="container"  style="padding-top:50px; padding-bottom:10px;">
            <div class="row" style="padding-top:10px; padding-bottom:10px;">
                <div class="col">
                    <a href="https://smartschool.gongetz.com" class="btn btn-success font-weight-bolder font-size-sm py-1 px-14"><i class="bi bi-building"></i> Smart School</a> 
                    <a href="https://support.gongetz.com" class="btn btn-success font-weight-bolder font-size-sm py-1 px-14"><i class="bi bi-headset"></i> Support</a>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="card main-card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <br><h1 style="text-align:center;"><?= $SchoolsName; ?></h1>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12 col-lg-4">
                                    <div class="card">
                                        <div class="card-header" style="text-align:center;">
                                            <strong>Profile</strong>
                                        </div>
                                        <div class="card-body">
                                            <!--begin::Profile Card-->
                                            <div class="card card-custom card-stretch">
                                                <!--begin::Body-->
                                                <div class="card-body pt-0">
                                                    <!--begin::Toolbar-->
                                                    <div class="d-flex justify-content-end">
                                                        <div class="dropdown dropdown-inline">
                                                            <a href="#" class="btn btn-clean btn-hover-light-primary btn-sm btn-icon" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></a>
                                                            <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right"></div>
                                                        </div>
                                                    </div>
                                                    <!--end::Toolbar-->
                                                    <!--begin::Contact-->
                                                    <div class="py-7">
                                                        <div class="d-flex align-items-center justify-content-between mb-2">
                                                            <span class="font-weight-bold mr-2">Name:</span>
                                                            <a href="#" class="text-muted text-hover-primary"><?= $ConsumerFName ." ".$ConsumerLName  ?></a>
                                                        </div>
                                                        <div class="d-flex align-items-center justify-content-between mb-2">
                                                            <span class="font-weight-bold mr-2">ID Type:</span>
                                                            <a href="#" class="text-muted text-hover-primary"><?= $ConsumerIDType; ?></a>
                                                        </div>
                                                        <div class="d-flex align-items-center justify-content-between mb-2">
                                                            <span class="font-weight-bold mr-2">Email:</span>
                                                            <a href="#" class="text-muted text-hover-primary"><?= $ConsumerEmail; ?></a>
                                                        </div>
                                                        <div class="d-flex align-items-center justify-content-between mb-2">
                                                            <span class="font-weight-bold mr-2">Phone:</span>
                                                            <a href="#" class="text-muted text-hover-primary"><?= $ConsumerPhone; ?></a>
                                                        </div>
                                                        <div class="d-flex align-items-center justify-content-between mb-2">
                                                            <span class="font-weight-bold mr-2">Location:</span>
                                                            <a href="#" class="text-muted text-hover-primary"><?= $ConsumerCity.",".$ConsumerState; ?></a>
                                                        </div>
                                                    </div>
                                                    <!--end::Contact-->
                                                    <!--end::User-->
                                                    <?php
                                                    $totalstudent = 0;
                                                    $filter = ['ParentID'=>$parent_id];
                                                    $query = new MongoDB\Driver\Query($filter);
                                                    $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.ParentStudentRel',$query);
                                                    foreach ($cursor as $document)
                                                    {
                                                        $StudentID = $document->StudentID;
                                                        $ParentStudentRelation = $document->ParentStudentRelation;
                                                        $ParentStudentRelationStatus = $document->ParentStudentRelationStatus;
                                        
                                                        $filter = ['_id'=>new \MongoDB\BSON\ObjectId($StudentID)];
                                                        $query = new MongoDB\Driver\Query($filter);
                                                        $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Students',$query);
                                                        foreach ($cursor as $document)
                                                        {
                                                            $totalstudent = $totalstudent+ 1;
                                                            $Consumer_id = $document->Consumer_id;
                                                            $Schools_id = $document->Schools_id;
                                        
                                                            $filter = ['_id'=>new \MongoDB\BSON\ObjectId($Consumer_id)];
                                                            $query = new MongoDB\Driver\Query($filter);
                                                            $cursor = $GoNGetzDatabase->executeQuery('GoNGetz.Consumer',$query);
                                                            foreach ($cursor as $document)
                                                            {
                                                                $id = strval($document->_id);
                                                                $ConsumerFNameChild = $document->ConsumerFName;
                                                                $ConsumerLNameChild = $document->ConsumerLName;
                                                                $ConsumerIDTypeChild = $document->ConsumerIDType;
                                                                $ConsumerIDNo = $document->ConsumerIDNo;
                                                           
                                                                if($parent_id !== '')
                                                                {
                                                                ?><br>
                                                                <div class="card">
                                                                    <ul class="list-group ">
                                                                        <li class="list-group-item">Child <?= $totalstudent; ?></li>
                                                                    </ul>
                                                                </div>
                                                                <div class="py-9">
                                                                    <div class="d-flex align-items-center justify-content-between mb-2">
                                                                        <span class="font-weight-bold mr-2">Name:</span>
                                                                        <a href="#" class="text-muted text-hover-primary"><?= $ConsumerFNameChild; ?></a>
                                                                    </div>
                                                                    <div class="d-flex align-items-center justify-content-between mb-2">
                                                                        <span class="font-weight-bold mr-2">ID Type:</span>
                                                                        <a href="#" class="text-muted text-hover-primary"><?= $ConsumerIDTypeChild; ?></a>
                                                                    </div>
                                                                    <div class="d-flex align-items-center justify-content-between mb-2">
                                                                        <span class="font-weight-bold mr-2">ID No:</span>
                                                                        <a href="#" class="text-muted text-hover-primary"><?= $ConsumerIDNo; ?></a>
                                                                    </div>
                                                                </div>
                                                                <?php
                                                                }
                                                            }
                                                        }
                                                    }
                                                    ?>
                                                </div>
                                                <!--end::Body-->
                                            </div>
                                            <!--end::Profile Card-->
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-lg-4">
                                    <div class="card">
                                        <div class="card-header" style="text-align:center;">
                                            <strong>Latest News</strong>
                                        </div>
                                        <div class="card-body">
                                            <div class="card card-custom gutter-b">
                                                <!--begin::Header-->
                                                <div class="card-header border-0 pt-2">
                                                    <ul class="nav nav-light-success nav-pills nav-pills-sm nav-dark-75">
                                                        <li class="nav-item">
                                                            <a class="nav-link py-2 px-4 font-weight-bolder" data-bs-toggle="tab" href="#kt_tab_pane_10_1"><?= $_SESSION["loggeduser_ACCESS"]; ?></a>
                                                        </li>
                                                        <li class="nav-item">
                                                            <a class="nav-link py-2 px-4 active font-weight-bolder" data-bs-toggle="tab" href="#kt_tab_pane_10_2">PUBLIC</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <!--end::Header-->
                                                <!--begin::Body--> 
                                                <div class="card-body pt-0">
                                                    <div class="tab-content mt-5" id="myTabTables10">
                                                        <!--begin::Tap pane-->
                                                        <div class="tab-pane fade " id="kt_tab_pane_10_1" role="tabpanel" aria-labelledby="kt_tab_pane_10_1">
                                                            <?php
                                                            $filter = ['School_id'=>$schoolID,'Access'=>$_SESSION["loggeduser_ACCESS"]];
                                                            $option = ['limit'=>5,'sort' => ['Date' => 1]];
                                                            $query = new MongoDB\Driver\Query($filter,$option);
                                                            $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.News',$query);
                                                            foreach ($cursor as $document)
                                                            {
                                                                $news_id = strval($document->_id);
                                                                $Date = strval($document->Date);
                                                                $Date = new MongoDB\BSON\UTCDateTime($Date);
                                                                $Date = $Date->toDateTime()->setTimezone(new \DateTimeZone(date_default_timezone_get()));
                                                                $Date = date_format($Date,"Y-m-d\TH:i:s");
                                                                $Date = new MongoDB\BSON\UTCDateTime((new DateTime($Date))->getTimestamp());
                                                                $Date = strval($Date);
                                                                $time_now = time();
                                                            }
                                                            ?>
                                                            <span class="text-muted mt-3 font-weight-bold font-size-sm">Latest News update 
                                                            <span class="text-primary"><?= "".time_elapsed($time_now-$Date);  ?></span></span>
                                                            <!--begin::Table-->
                                                            <div>
                                                                <table class="table table-borderless table-vertical-center">
                                                                    <!--begin::Thead-->
                                                                    <thead>
                                                                        <tr>
                                                                            <th></th>
                                                                            <th></th>
                                                                        </tr>
                                                                    </thead>
                                                                    <!--end::Thead-->
                                                                    <!--begin::Tbody-->
                                                                    <?php
                                                                    $filter = ['School_id'=>$schoolID,'Access'=>$_SESSION["loggeduser_ACCESS"]];
                                                                    $option = ['limit'=>10,'sort' => ['Date' => -1]];
                                                                    $query = new MongoDB\Driver\Query($filter,$option);
                                                                    $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.News',$query);
                                                                    foreach ($cursor as $document)
                                                                    {
                                                                        $new_id = strval($document->_id);
                                                                        $Staff_id = $document->Staff_id;
                                                                        $Title = $document->Title;
                                                                        $Details = $document->Details;
                                                                        $Status = $document->Status;
                                                                        $Access = $document->Access;
                                                                        $Date = strval($document->Date);
                                                                        $Date = new MongoDB\BSON\UTCDateTime(strval($Date));
                                                                        $Date = $Date->toDateTime()->setTimezone(new \DateTimeZone(date_default_timezone_get()));
                                                                    
                                                                        $filter = ['_id' =>  new \MongoDB\BSON\ObjectId($Staff_id)];
                                                                        $query = new MongoDB\Driver\Query($filter);
                                                                        $cursor = $GoNGetzDatabase->executeQuery('GoNGetz.Consumer', $query);
                                                                        foreach ($cursor as $document)
                                                                        {
                                                                            $consumer_id = strval($document->_id);
                                                                            $ConsumerFName = $document->ConsumerFName;
                                                                            $ConsumerLName = $document->ConsumerLName;

                                                                            $filter = ['ConsumerID'=>$consumer_id];
                                                                            $query = new MongoDB\Driver\Query($filter);
                                                                            $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Staff',$query);
                                                                            foreach ($cursor as $document)
                                                                            {
                                                                                $Staffdepartment = $document->Staffdepartment;
                                                                    
                                                                                $filter = ['_id'=>new \MongoDB\BSON\ObjectId($Staffdepartment)];
                                                                                $query = new MongoDB\Driver\Query($filter);
                                                                                $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.SchoolsDepartment',$query);
                                                                                foreach ($cursor as $document)
                                                                                {
                                                                                    $DepartmentName = $document->DepartmentName;
                                                                                }
                                                                            }
                                                                        }
                                                                        ?>
                                                                        <tbody>
                                                                            <tr>
                                                                                <td class="pl-0">
                                                                                    <span class="svg-icon svg-icon-2x svg-icon-success">
                                                                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                                                                <rect x="0" y="0" width="24" height="24"/>
                                                                                                <path d="M14,7 C13.6666667,10.3333333 12.6666667,12.1167764 11,12.3503292 C11,12.3503292 12.5,6.5 10.5,3.5 C10.5,3.5 10.287918,6.71444735 8.14498739,10.5717225 C7.14049032,12.3798172 6,13.5986793 6,16 C6,19.428689 9.51143904,21.2006583 12.0057195,21.2006583 C14.5,21.2006583 18,20.0006172 18,15.8004732 C18,14.0733981 16.6666667,11.1399071 14,7 Z" fill="#000000"/>
                                                                                            </g>
                                                                                        </svg>
                                                                                    </span>
                                                                                </td>
                                                                                <td class="pl-0">
                                                                                    <a href="index.php?page=news_detail&id=<?= $new_id; ?>" class="text-dark-75 font-weight-bolder text-hover-primary mb-1 font-size-lg"><?= $Title; ?></a>
                                                                                    <span class="text-muted font-weight-bold d-block"><?= " By ".$ConsumerFName;?></span>
                                                                                    <span class="text-muted font-weight-bold d-block"><?= date_format($Date,"d M, H:i")." "; ?></span>
                                                                                </td>
                                                                            </tr>
                                                                        </tbody>
                                                                        <!--end::Tbody-->
                                                                        <?php
                                                                        }
                                                                    ?>
                                                                </table>
                                                            </div>
                                                            <!--end::Table-->
                                                        </div>
                                                        <!--end::Tap pane-->
                                                        <!--begin::Tap pane-->
                                                        <div class="tab-pane fade show active" id="kt_tab_pane_10_2" role="tabpanel" aria-labelledby="kt_tab_pane_10_2">
                                                            <?php 
                                                            $filter = ['School_id'=>$schoolID,'Access'=>'PUBLIC'];
                                                            $option = ['limit'=>10,'sort' => ['Date' => 1]];
                                                            $query = new MongoDB\Driver\Query($filter,$option);
                                                            $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.News',$query);
                                                            foreach ($cursor as $document)
                                                            {
                                                                $news_id = strval($document->_id);
                                                                $Date = strval($document->Date);
                                                                $Date = new MongoDB\BSON\UTCDateTime(strval($Date));
                                                                $Date = $Date->toDateTime()->setTimezone(new \DateTimeZone(date_default_timezone_get()));
                                                                $Date = date_format($Date,"Y-m-d\TH:i:s");
                                                                $Date = new MongoDB\BSON\UTCDateTime((new DateTime($Date))->getTimestamp());
                                                                $Date = strval($Date);
                                                                $time_now = time();
                                                            }
                                                            ?>
                                                            <span class="text-muted mt-3 font-weight-bold font-size-sm">Latest News update 
                                                            <span class="text-primary"><?= "".time_elapsed($time_now-$Date);  ?></span></span>
                                                            <!--begin::Table-->
                                                            <div>
                                                                <table class="table table-borderless table-vertical-center">
                                                                    <!--begin::Thead-->
                                                                    <thead>
                                                                        <tr>
                                                                            <th></th>
                                                                            <th></th>
                                                                        </tr>
                                                                    </thead>
                                                                    <!--end::Thead-->
                                                                    <!--begin::Tbody-->
                                                                    <?php
                                                                    $filter = ['School_id'=>$schoolID,'Access'=>'PUBLIC'];
                                                                    $option = ['limit'=>5,'sort' => ['Date' => -1]];
                                                                    $query = new MongoDB\Driver\Query($filter,$option);
                                                                    $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.News',$query);
                                                                    foreach ($cursor as $document)
                                                                    {
                                                                        $new_id = strval($document->_id);
                                                                        $Staff_id = $document->Staff_id;
                                                                        $Title = $document->Title;
                                                                        $Details = $document->Details;
                                                                        $Status = $document->Status;
                                                                        $Access = $document->Access;
                                                                        $Date = strval($document->Date);
                                                                        $Date = new MongoDB\BSON\UTCDateTime(strval($Date));
                                                                        $Date = $Date->toDateTime()->setTimezone(new \DateTimeZone(date_default_timezone_get()));
                                                                    
                                                                        $filter = ['_id' =>  new \MongoDB\BSON\ObjectId($Staff_id)];
                                                                        $query = new MongoDB\Driver\Query($filter);
                                                                        $cursor = $GoNGetzDatabase->executeQuery('GoNGetz.Consumer', $query);
                                                                        foreach ($cursor as $document)
                                                                        {
                                                                            $consumer_id = strval($document->_id);
                                                                            $ConsumerFName = $document->ConsumerFName;
                                                                            $ConsumerLName = $document->ConsumerLName;

                                                                            $filter = ['ConsumerID'=>$consumer_id];
                                                                            $query = new MongoDB\Driver\Query($filter);
                                                                            $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Staff',$query);
                                                                            foreach ($cursor as $document)
                                                                            {
                                                                                $Staffdepartment = $document->Staffdepartment;
                                                                    
                                                                                $filter = ['_id'=> new \MongoDB\BSON\ObjectId($Staffdepartment)];
                                                                                $query = new MongoDB\Driver\Query($filter);
                                                                                $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.SchoolsDepartment',$query);
                                                                                foreach ($cursor as $document)
                                                                                {
                                                                                    $DepartmentName = $document->DepartmentName;
                                                                                }
                                                                            }
                                                                        }
                                                                        ?>
                                                                    <tbody>
                                                                        <tr>
                                                                            <td class="pl-0">
                                                                                <span class="svg-icon svg-icon-2x svg-icon-success"><!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\themes\metronic\theme\html\demo1\dist/../src/media/svg/icons\General\Fire.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                                                        <rect x="0" y="0" width="24" height="24"/>
                                                                                        <path d="M14,7 C13.6666667,10.3333333 12.6666667,12.1167764 11,12.3503292 C11,12.3503292 12.5,6.5 10.5,3.5 C10.5,3.5 10.287918,6.71444735 8.14498739,10.5717225 C7.14049032,12.3798172 6,13.5986793 6,16 C6,19.428689 9.51143904,21.2006583 12.0057195,21.2006583 C14.5,21.2006583 18,20.0006172 18,15.8004732 C18,14.0733981 16.6666667,11.1399071 14,7 Z" fill="#000000"/>
                                                                                    </g>
                                                                                </svg><!--end::Svg Icon--></span>
                                                                            </td>
                                                                            <td class="pl-0">
                                                                                <a href="index.php?page=news_detail&id=<?= $new_id; ?>" class="text-dark-75 font-weight-bolder text-hover-primary mb-1 font-size-lg"><?= $Title; ?></a>
                                                                                <span class="text-muted font-weight-bold d-block"><?= " By ".$ConsumerFName;?></span>
                                                                                <span class="text-muted font-weight-bold d-block"><?= date_format($Date,"d M, H:i")." "; ?></span>
                                                                            </td>
                                                                        </tr>
                                                                    </tbody>
                                                                    <?php
                                                                    }
                                                                    ?>
                                                                    <!--end::Tbody-->
                                                                </table>
                                                            </div>
                                                            <!--end::Table-->
                                                        </div>
                                                        <!--end::Tap pane-->
                                                    </div>
                                                </div>
                                                <!--end::Body-->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-lg-4">
                                    <div class="card">
                                        <div class="card-header" style="text-align:center;">
                                            <strong>Upcoming Events</strong>
                                        </div>
                                        <div class="card-body">
                                            <div class="card card-custom gutter-b">
                                                <!--begin::Header-->
                                                <div class="card-header border-0 pt-2">
                                                    <ul class="nav nav-light-success nav-pills nav-pills-sm nav-dark-75">
                                                        <li class="nav-item">
                                                            <a class="nav-link py-2 px-4 font-weight-bolder" data-bs-toggle="tab" href="#kt_tab_pane_10_3"><?= $_SESSION["loggeduser_ACCESS"]; ?></a>
                                                        </li>
                                                        <li class="nav-item">
                                                            <a class="nav-link py-2 px-4 active font-weight-bolder" data-bs-toggle="tab" href="#kt_tab_pane_10_4">PUBLIC</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <!--end::Header-->
                                                <!--begin::Body-->
                                                <div class="card-body pt-0">
                                                    <div class="tab-content mt-5" id="myTabTables10">
                                                        <!--begin::Tap pane-->
                                                        <div class="tab-pane fade" id="kt_tab_pane_10_3" role="tabpanel" aria-labelledby="kt_tab_pane_10_3">
                                                            <?php
                                                            $to_date = new MongoDB\BSON\UTCDateTime((new DateTime('now +1 month'))->getTimestamp()*1000);
                                                            $from_date = new MongoDB\BSON\UTCDateTime((new DateTime('now'))->getTimestamp()*1000);

                                                            $filter = ['School_id'=>$schoolID,'Access'=>$_SESSION["loggeduser_ACCESS"],'Date_start' => ['$gte' => $from_date,'$lte' => $to_date]];
                                                            $option = ['sort' => ['Date_start' => -1]];
                                                            $query = new MongoDB\Driver\Query($filter,$option);
                                                            $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Event',$query);
                                                            foreach ($cursor as $document)
                                                            {
                                                                $event_id = strval($document->_id);
                                                                $Date_start = strval($document->Date_start);

                                                                    $Date_start = new MongoDB\BSON\UTCDateTime($Date_start);
                                                                    $Date_start = $Date_start->toDateTime()->setTimezone(new \DateTimeZone(date_default_timezone_get()));
                                                                    $Date_start = date_format($Date_start,"Y-m-d\TH:i:s");
                                                                    $Date_start = new MongoDB\BSON\UTCDateTime((new DateTime($Date_start))->getTimestamp());
                                                                    $Date_start = strval($Date_start);
                                                                    $time_now = time();
                                                            }
                                                            ?>
                                                            <span class="text-muted mt-3 font-weight-bold font-size-sm">Next Event is in
                                                            <span class="text-primary"><?= " ".time_elapsed($Date_start-$time_now)." \n";  ?></span></span>
                                                            <!--begin::Table-->
                                                            <div>
                                                                <table class="table table-borderless table-vertical-center">
                                                                    <!--begin::Thead-->
                                                                    <thead>
                                                                        <tr>
                                                                            <th></th>
                                                                            <th></th>
                                                                        </tr>
                                                                    </thead>
                                                                    <!--end::Thead-->
                                                                    <!--begin::Tbody-->
                                                                    <?php
                                                                    $filter = ['School_id'=>$schoolID,'Date_start' => ['$gte' => $from_date,'$lte' => $to_date],'Access'=>$_SESSION["loggeduser_ACCESS"]];
                                                                    $option = ['limit'=>5,'sort' => ['Date_start' => 1]];
                                                                    $query = new MongoDB\Driver\Query($filter,$option);
                                                                    $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Event',$query);
                                                                    foreach ($cursor as $document)
                                                                    {
                                                                        $event_id = strval($document->_id);
                                                                        $Staff_id = ($document->Staff_id);
                                                                        $Title = $document->Title;
                                                                        $Venue = $document->Venue;
                                                                        $Location = $document->Location;
                                                                        $Date_start = strval($document->Date_start);
                                                                        $Date_end = strval($document->Date_end);
                                                                        $Status = $document->Status;
                                                                    
                                                                        $Date_start = new MongoDB\BSON\UTCDateTime($Date_start);
                                                                        $Date_start = $Date_start->toDateTime()->setTimezone(new \DateTimeZone(date_default_timezone_get()));

                                                                        $Date_end = new MongoDB\BSON\UTCDateTime($Date_end);
                                                                        $Date_end = $Date_end->toDateTime()->setTimezone(new \DateTimeZone(date_default_timezone_get()));
                                                                    
                                                                        $id = new \MongoDB\BSON\ObjectId($Staff_id);
                                                                        $filter = ['_id' => $id];
                                                                        $query = new MongoDB\Driver\Query($filter);
                                                                        $cursor = $GoNGetzDatabase->executeQuery('GoNGetz.Consumer', $query);
                                                                        foreach ($cursor as $document)
                                                                        {
                                                                            $consumer_id = strval($document->_id);
                                                                            $ConsumerFName = $document->ConsumerFName;
                                                                            $ConsumerLName = $document->ConsumerLName;

                                                                            $filter = ['ConsumerID'=>$consumer_id];
                                                                            $query = new MongoDB\Driver\Query($filter);
                                                                            $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Staff',$query);
                                                                            foreach ($cursor as $document)
                                                                            {
                                                                                $Staffdepartment = $document->Staffdepartment;
                                                                    
                                                                                $filter = ['_id'=>new \MongoDB\BSON\ObjectId($Staffdepartment)];
                                                                                $query = new MongoDB\Driver\Query($filter);
                                                                                $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.SchoolsDepartment',$query);
                                                                                foreach ($cursor as $document)
                                                                                {
                                                                                    $DepartmentName = $document->DepartmentName;
                                                                                }
                                                                            }
                                                                        }
                                                                        ?>
                                                                        <tbody>
                                                                            <tr>
                                                                                <td class="pl-0">
                                                                                    <span class="svg-icon svg-icon-2x svg-icon-success"><!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\themes\metronic\theme\html\demo1\dist/../src/media/svg/icons\General\Fire.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                                                            <rect x="0" y="0" width="24" height="24"/>
                                                                                            <path d="M14,7 C13.6666667,10.3333333 12.6666667,12.1167764 11,12.3503292 C11,12.3503292 12.5,6.5 10.5,3.5 C10.5,3.5 10.287918,6.71444735 8.14498739,10.5717225 C7.14049032,12.3798172 6,13.5986793 6,16 C6,19.428689 9.51143904,21.2006583 12.0057195,21.2006583 C14.5,21.2006583 18,20.0006172 18,15.8004732 C18,14.0733981 16.6666667,11.1399071 14,7 Z" fill="#000000"/>
                                                                                        </g>
                                                                                    </svg><!--end::Svg Icon--></span>
                                                                                </td>
                                                                                <td class="pl-0">
                                                                                    <a href="index.php?page=event_detail&id=<?= $event_id; ?>" class="text-dark-75 font-weight-bolder text-hover-primary mb-1 font-size-lg"><?= $Title; ?></a>
                                                                                    <span class="text-muted font-weight-bold d-block"><?= " By ".$ConsumerFName;?></span>
                                                                                    <span class="text-muted font-weight-bold d-block"><?= date_format($datetimeStart,"d M, H:i")." "; ?></span>
                                                                                </td>
                                                                            </tr>
                                                                        </tbody>
                                                                    <?php
                                                                    }
                                                                    ?>
                                                                    <!--end::Tbody-->
                                                                </table>
                                                            </div>
                                                            <!--end::Table-->
                                                        </div>
                                                        <!--end::Tap pane-->
                                                        <!--begin::Tap pane-->
                                                        <div class="tab-pane fade show active" id="kt_tab_pane_10_4" role="tabpanel" aria-labelledby="kt_tab_pane_10_4">
                                                            <?php 
                                                            $filter = ['School_id'=>$schoolID,'Access'=>'PUBLIC','Date_start' => ['$gte' => $from_date,'$lte' => $to_date]];
                                                            $option = ['limit'=>5,'sort' => ['Date_start' => -1]];
                                                            $query = new MongoDB\Driver\Query($filter,$option);
                                                            $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Event',$query);
                                                            foreach ($cursor as $document)
                                                            {
                                                                $event_id = strval($document->_id);
                                                                $Date_start = strval($document->Date_start);
                                                                $Date_start = new MongoDB\BSON\UTCDateTime($Date_start);
                                                                $Date_start = $Date_start->toDateTime()->setTimezone(new \DateTimeZone(date_default_timezone_get()));
                                                                $Date_start = date_format($Date_start,"Y-m-d\TH:i:s");
                                                                $Date_start = new MongoDB\BSON\UTCDateTime((new DateTime($Date_start))->getTimestamp());
                                                                $Date_start = strval($Date_start);
                                                                $time_now = time();
                                                            }
                                                            ?>
                                                            <span class="text-muted mt-3 font-weight-bold font-size-sm">Next Event is in
                                                            <span class="text-primary"><?= " ".time_elapsed($Date_start-$time_now)." \n";  ?></span></span>
                                                            <!--begin::Table-->
                                                            <div>
                                                                <table class="table table-borderless table-vertical-center">
                                                                    <!--begin::Thead-->
                                                                    <thead>
                                                                        <tr>
                                                                            <th></th>
                                                                            <th></th>
                                                                        </tr>
                                                                    </thead>
                                                                    <!--end::Thead-->
                                                                    <!--begin::Tbody-->
                                                                    <?php
                                                                    $filter = ['School_id'=>$schoolID,'Date_start' => ['$gte' => $from_date,'$lte' => $to_date],'Access'=>'PUBLIC'];
                                                                    $option = ['limit'=>5,'sort' => ['Date_start' => 1]];
                                                                    $query = new MongoDB\Driver\Query($filter,$option);
                                                                    $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Event',$query);
                                                                    foreach ($cursor as $document)
                                                                    {
                                                                        $event_id = strval($document->_id);
                                                                        $Staff_id = $document->Staff_id;
                                                                        $Title = $document->Title;
                                                                        $Venue = $document->Venue;
                                                                        $Location = $document->Location;
                                                                        $Date_start = strval($document->Date_start);
                                                                        $Date_end = strval($document->Date_end);
                                                                        $Status = $document->Status;
                                                                    
                                                                        $Date_start = new MongoDB\BSON\UTCDateTime($Date_start);
                                                                        $Date_start = $Date_start->toDateTime()->setTimezone(new \DateTimeZone(date_default_timezone_get()));
                                                                        $Date_end = new MongoDB\BSON\UTCDateTime($Date_end);
                                                                        $Date_end = $Date_end->toDateTime()->setTimezone(new \DateTimeZone(date_default_timezone_get()));
                                                                    
                                                                        $filter = ['_id' =>new \MongoDB\BSON\ObjectId($Staff_id)];
                                                                        $query = new MongoDB\Driver\Query($filter);
                                                                        $cursor = $GoNGetzDatabase->executeQuery('GoNGetz.Consumer', $query);
                                                                        foreach ($cursor as $document)
                                                                        {
                                                                            $consumer_id = strval($document->_id);
                                                                            $ConsumerFName = $document->ConsumerFName;
                                                                            $ConsumerLName = $document->ConsumerLName;

                                                                            $filter = ['ConsumerID'=>$consumer_id];
                                                                            $query = new MongoDB\Driver\Query($filter);
                                                                            $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Staff',$query);
                                                                            foreach ($cursor as $document)
                                                                            {
                                                                                $Staffdepartment = $document->Staffdepartment;
                                                                    
                                                                                $filter = ['_id'=>new \MongoDB\BSON\ObjectId($Staffdepartment)];
                                                                                $query = new MongoDB\Driver\Query($filter);
                                                                                $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.SchoolsDepartment',$query);
                                                                                foreach ($cursor as $document)
                                                                                {
                                                                                    $DepartmentName = $document->DepartmentName;
                                                                                }
                                                                            }
                                                                        }
                                                                        ?>
                                                                        <tbody>
                                                                            <tr>
                                                                                <td class="pl-0">
                                                                                    <span class="svg-icon svg-icon-2x svg-icon-success"><!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\themes\metronic\theme\html\demo1\dist/../src/media/svg/icons\General\Fire.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                                                            <rect x="0" y="0" width="24" height="24"/>
                                                                                            <path d="M14,7 C13.6666667,10.3333333 12.6666667,12.1167764 11,12.3503292 C11,12.3503292 12.5,6.5 10.5,3.5 C10.5,3.5 10.287918,6.71444735 8.14498739,10.5717225 C7.14049032,12.3798172 6,13.5986793 6,16 C6,19.428689 9.51143904,21.2006583 12.0057195,21.2006583 C14.5,21.2006583 18,20.0006172 18,15.8004732 C18,14.0733981 16.6666667,11.1399071 14,7 Z" fill="#000000"/>
                                                                                        </g>
                                                                                    </svg><!--end::Svg Icon--></span>
                                                                                </td>
                                                                                <td class="pl-0">
                                                                                    <a href="index.php?page=event_detail&id=<?= $event_id; ?>" class="text-dark-75 font-weight-bolder text-hover-primary mb-1 font-size-lg"><?= $Title; ?></a>
                                                                                    <span class="text-muted font-weight-bold d-block"><?= " By ".$ConsumerFName;?></span>
                                                                                    <span class="text-muted font-weight-bold d-block"><?= date_format($datetimeStart,"d M, H:i")." "; ?></span>
                                                                                </td>
                                                                            </tr>
                                                                        </tbody>
                                                                    <?php
                                                                    }
                                                                    ?>
                                                                    <!--end::Tbody-->
                                                                </table>
                                                            </div>
                                                            <!--end::Table-->
                                                        </div>
                                                        <!--end::Tap pane-->
                                                    </div>
                                                </div>
                                                <!--end::Body-->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>

    </body>
</html>
