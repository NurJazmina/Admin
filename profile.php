<?php
    $GoNGetzConnectionString="mongodb://admin:TempPassword@51.79.173.45:27017/gngoffice?authSource=admin";
    $GoNGetzDatabase = new MongoDB\Driver\Manager($GoNGetzConnectionString);

    function time_elapsed($date){
        $bit = array(
            //' year'      => $date  / 31556926 % 12,
            ' week'      => $date  / 604800 % 52,
            ' day'       => $date  / 86400 % 7,
            ' hour'      => $date  / 3600 % 24,
            //' minute'    => $date  / 60 % 60,
            //' second'    => $date  % 60
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
    //$school_id = "5fb5a728c930cc7b988b3bb7";

    $filter = ['ConsumerIDNo'=>$user_id];
    $query = new MongoDB\Driver\Query($filter);
    $cursor = $GoNGetzDatabase->executeQuery('GoNGetz.Consumer',$query);
    foreach ($cursor as $document)
    {
        $id = strval($document->_id);
        $ConsumerFName = strval($document->ConsumerFName);
        $ConsumerLName = strval($document->ConsumerLName);
        $ConsumerIDType = strval($document->ConsumerIDType);
        $ConsumerIDNo = strval($document->ConsumerIDNo);
        $ConsumerEmail = strval($document->ConsumerEmail);
        $ConsumerPhone = strval($document->ConsumerPhone);
        $ConsumerCity = strval($document->ConsumerCity);
        $ConsumerState = strval($document->ConsumerState);
        $ConsumerStatus = strval($document->ConsumerStatus);

        $filter = ['ConsumerID'=>$id,'StaffLevel'=>'1'];
        $query = new MongoDB\Driver\Query($filter);
        $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Staff',$query);
        $totalstaff = 0;
        foreach ($cursor as $document)
        {
            $ConsumerID = strval($document->ConsumerID);
            $SchoolID = strval($document->SchoolID);
            $_SESSION["loggeduser_ACCESS"] = "STAFF";
    
            $School_id = new \MongoDB\BSON\ObjectId($SchoolID);
            $filter = ['_id'=>$School_id];
            $query = new MongoDB\Driver\Query($filter);
            $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Schools',$query);
            foreach ($cursor as $document)
            {
                $schoolID = strval($document->_id);
                $SchoolsName = strval($document->SchoolsName);
                $SchoolsPhoneNo = strval($document->SchoolsPhoneNo);
                $SchoolsAddress = strval($document->SchoolsAddress);
                $SchoolsEmail = strval($document->SchoolsEmail);
            }
    
        }

        $filter = ['ConsumerID'=>$id,'StaffLevel'=>'0'];
        $query = new MongoDB\Driver\Query($filter);
        $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Staff',$query);
        $totalteacher= 0;
        foreach ($cursor as $document)
        {
            $ConsumerID = strval($document->ConsumerID);
            $SchoolID = strval($document->SchoolID);
            $_SESSION["loggeduser_ACCESS"] = "TEACHER";
    
            $School_id = new \MongoDB\BSON\ObjectId($SchoolID);
            $filter = ['_id'=>$School_id];
            $query = new MongoDB\Driver\Query($filter);
            $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Schools',$query);
            foreach ($cursor as $document)
            {
                $schoolID = strval($document->_id);
                $SchoolsName = strval($document->SchoolsName);
                $SchoolsPhoneNo = strval($document->SchoolsPhoneNo);
                $SchoolsAddress = strval($document->SchoolsAddress);
                $SchoolsEmail = strval($document->SchoolsEmail);
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
            $Consumer_id = strval($document->Consumer_id);
            $Schools_id = strval($document->Schools_id);
            $_SESSION["loggeduser_ACCESS"] = "STUDENT";
    
            $School_id = new \MongoDB\BSON\ObjectId($Schools_id);
            $filter = ['_id'=>$School_id];
            $query = new MongoDB\Driver\Query($filter);
            $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Schools',$query);
            foreach ($cursor as $document)
            {
                $SchoolsName = strval($document->SchoolsName);
                $SchoolsPhoneNo = strval($document->SchoolsPhoneNo);
                $SchoolsAddress = strval($document->SchoolsAddress);
                $SchoolsEmail = strval($document->SchoolsEmail);
            }
        }*/

        $filter = ['ConsumerID'=>$id];
        $query = new MongoDB\Driver\Query($filter);
        $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Parents',$query);
        $totalparent = 0;
        foreach ($cursor as $document)
        {
            $parent_id = strval($document->_id);
            $ConsumerID = strval($document->ConsumerID);
            $Schools_id = strval($document->Schools_id);
            $_SESSION["loggeduser_ACCESS"] = "PARENT";
    
            $School_id = new \MongoDB\BSON\ObjectId($Schools_id);
            $filter = ['_id'=>$School_id];
            $query = new MongoDB\Driver\Query($filter);
            $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Schools',$query);
            foreach ($cursor as $document)
            {
                $schoolID = strval($document->_id);
                $SchoolsName = strval($document->SchoolsName);
                $SchoolsPhoneNo = strval($document->SchoolsPhoneNo);
                $SchoolsAddress = strval($document->SchoolsAddress);
                $SchoolsEmail = strval($document->SchoolsEmail);
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
                                    <br><h1 style="text-align:center;"><?php echo $SchoolsName; ?></h1>
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
                                                            <a href="#" class="text-muted text-hover-primary"><?php echo $ConsumerFName ." ".$ConsumerLName  ?></a>
                                                        </div>
                                                        <div class="d-flex align-items-center justify-content-between mb-2">
                                                            <span class="font-weight-bold mr-2">ID Type:</span>
                                                            <a href="#" class="text-muted text-hover-primary"><?php echo $ConsumerIDType; ?></a>
                                                        </div>
                                                        <div class="d-flex align-items-center justify-content-between mb-2">
                                                            <span class="font-weight-bold mr-2">Email:</span>
                                                            <a href="#" class="text-muted text-hover-primary"><?php echo $ConsumerEmail; ?></a>
                                                        </div>
                                                        <div class="d-flex align-items-center justify-content-between mb-2">
                                                            <span class="font-weight-bold mr-2">Phone:</span>
                                                            <a href="#" class="text-muted text-hover-primary"><?php echo $ConsumerPhone; ?></a>
                                                        </div>
                                                        <div class="d-flex align-items-center justify-content-between mb-2">
                                                            <span class="font-weight-bold mr-2">Location:</span>
                                                            <a href="#" class="text-muted text-hover-primary"><?php echo $ConsumerCity.",".$ConsumerState; ?></a>
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
                                                        $StudentID = strval($document->StudentID);
                                                        $ParentStudentRelation = strval($document->ParentStudentRelation);
                                                        $ParentStudentRelationStatus = strval($document->ParentStudentRelationStatus);
                                                        
                                        
                                                        $Student_ID = new \MongoDB\BSON\ObjectId($StudentID);
                                                        $filter = ['_id'=>$Student_ID];
                                                        $query = new MongoDB\Driver\Query($filter);
                                                        $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Students',$query);
                                                        
                                                        foreach ($cursor as $document)
                                                        {
                                                            $totalstudent = $totalstudent+ 1;
                                                            $Consumer_id = strval($document->Consumer_id);
                                                            $Schools_id = strval($document->Schools_id);
                                        
                                                            $Consumerid = new \MongoDB\BSON\ObjectId($Consumer_id);
                                                            $filter = ['_id'=>$Consumerid];
                                                            $query = new MongoDB\Driver\Query($filter);
                                                            $cursor = $GoNGetzDatabase->executeQuery('GoNGetz.Consumer',$query);
                                                            foreach ($cursor as $document)
                                                            {
                                                                $id = strval($document->_id);
                                                                $ConsumerFNameChild = strval($document->ConsumerFName);
                                                                $ConsumerLNameChild = strval($document->ConsumerLName);
                                                                $ConsumerIDTypeChild = strval($document->ConsumerIDType);
                                                                $ConsumerIDNo = strval($document->ConsumerIDNo);
                                                           
                                                                if($parent_id !== '')
                                                                {
                                                                ?><br>
                                                                <div class="card">
                                                                    <ul class="list-group ">
                                                                        <li class="list-group-item">Child <?php echo $totalstudent; ?></li>
                                                                    </ul>
                                                                </div>
                                                                <div class="py-9">
                                                                    <div class="d-flex align-items-center justify-content-between mb-2">
                                                                        <span class="font-weight-bold mr-2">Name:</span>
                                                                        <a href="#" class="text-muted text-hover-primary"><?php echo $ConsumerFNameChild; ?></a>
                                                                    </div>
                                                                    <div class="d-flex align-items-center justify-content-between mb-2">
                                                                        <span class="font-weight-bold mr-2">ID Type:</span>
                                                                        <a href="#" class="text-muted text-hover-primary"><?php echo $ConsumerIDTypeChild; ?></a>
                                                                    </div>
                                                                    <div class="d-flex align-items-center justify-content-between mb-2">
                                                                        <span class="font-weight-bold mr-2">ID No:</span>
                                                                        <a href="#" class="text-muted text-hover-primary"><?php echo $ConsumerIDNo; ?></a>
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
                                                            <a class="nav-link py-2 px-4 font-weight-bolder" data-bs-toggle="tab" href="#kt_tab_pane_10_1"><?php echo $_SESSION["loggeduser_ACCESS"]; ?></a>
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
                                                            <span class="menu-label">
                                                            <?php
                                                            $newsid="";
                                                            $filter = ['school_id'=>$schoolID,'NewsAccess'=>$_SESSION["loggeduser_ACCESS"]];
                                                            $option = ['limit'=>5,'sort' => ['NewsDate' => 1]];
                                                            $query = new MongoDB\Driver\Query($filter,$option);
                                                            $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.SchoolNews',$query);
                                                            foreach ($cursor as $document)
                                                            {
                                                                $newsid = ($document->_id);
                                                                $newsid = new \MongoDB\BSON\ObjectId($newsid);
                                                            }
                                                            if(!$newsid == "")
                                                            {
                                                                $filter = ['_id'=>$newsid];
                                                                $query = new MongoDB\Driver\Query($filter);
                                                                $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.SchoolNews',$query);
                                                                foreach ($cursor as $document)
                                                                {
                                                                    $NewsDate = ($document->NewsDate);
                                                                    $utcdatetime = new MongoDB\BSON\UTCDateTime(strval($NewsDate));
                                                                    $datetime = $utcdatetime->toDateTime()->setTimezone(new \DateTimeZone(date_default_timezone_get()));
                                                                    $datenew = date_format($datetime,"Y-m-d\TH:i:s");
                                                                    $date = new MongoDB\BSON\UTCDateTime((new DateTime($datenew))->getTimestamp());
                                                            
                                                                    $nowtimeNew = time();
                                                                    $timeNew = strval($date);
                                                                }
                                                            }
                                                            ?>
                                                            <span class="text-muted mt-3 font-weight-bold font-size-sm">Latest News update 
                                                            <span class="text-primary"><?php echo "".time_elapsed($nowtimeNew-$timeNew);  ?></span></span>
                                                            </span>
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
                                                                    $filterA = ['school_id'=>$schoolID,'NewsAccess'=>$_SESSION["loggeduser_ACCESS"]];
                                                                    $optionA = ['limit'=>10,'sort' => ['NewsDate' => -1]];
                                                                    $queryA = new MongoDB\Driver\Query($filterA,$optionA);
                                                                    $cursorA = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.SchoolNews',$queryA);
                                                                    foreach ($cursorA as $documentA)
                                                                    {
                                                                        $Newsid = strval($documentA->_id);
                                                                        $NewsStaff_id = ($documentA->NewsStaff_id);
                                                                        $NewsTitle = ($documentA->NewsTitle);
                                                                        $NewsDetails = ($documentA->NewsDetails);
                                                                        $NewsDate = ($documentA->NewsDate);
                                                                        $NewsStatus = ($documentA->NewsStatus);
                                                                        $Access = ($documentA->NewsAccess);
                                                                    
                                                                        $id = new \MongoDB\BSON\ObjectId($NewsStaff_id);
                                                                        $filter1 = ['_id' => $id];
                                                                        $query1 = new MongoDB\Driver\Query($filter1);
                                                                        $cursor1 = $GoNGetzDatabase->executeQuery('GoNGetz.Consumer', $query1);
                                                                        foreach ($cursor1 as $document1)
                                                                        {
                                                                            $consumerid = strval($document1->_id);
                                                                            $ConsumerFName = ($document1->ConsumerFName);
                                                                            $ConsumerLName = ($document1->ConsumerLName);
                                                                            $filter2 = ['ConsumerID'=>$consumerid];
                                                                            $query2 = new MongoDB\Driver\Query($filter2);
                                                                            $cursor2 = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Staff',$query2);
                                                                            foreach ($cursor2 as $document2)
                                                                            {
                                                                                $Staffdepartment = ($document2->Staffdepartment);
                                                                                $departmentid = new \MongoDB\BSON\ObjectId($Staffdepartment);
                                                                    
                                                                                $filter3 = ['_id'=>$departmentid];
                                                                                $query3 = new MongoDB\Driver\Query($filter3);
                                                                                $cursor3 = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.SchoolsDepartment',$query3);
                                                                                foreach ($cursor3 as $document3)
                                                                                {
                                                                                    $DepartmentName = ($document3->DepartmentName);
                                                                                }
                                                                            }
                                                                        }
                                                                        $utcdatetime = new MongoDB\BSON\UTCDateTime(strval($NewsDate));
                                                                        $datetime = $utcdatetime->toDateTime()->setTimezone(new \DateTimeZone(date_default_timezone_get()));
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
                                                                                    <a href="index.php?page=newsdetail&id=<?php echo $Newsid; ?>" class="text-dark-75 font-weight-bolder text-hover-primary mb-1 font-size-lg"><?php echo $NewsTitle; ?></a>
                                                                                    <span class="text-muted font-weight-bold d-block"><?php echo " By ".$ConsumerFName;?></span>
                                                                                    <span class="text-muted font-weight-bold d-block"><?php echo date_format($datetime,"d M, H:i")." "; ?></span>
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
                                                            <span class="menu-label">
                                                            <?php 
                                                            $newsid1="";
                                                            $filter = ['school_id'=>$schoolID,'NewsAccess'=>'PUBLIC'];
                                                            $option = ['limit'=>10,'sort' => ['NewsDate' => 1]];
                                                            $query = new MongoDB\Driver\Query($filter,$option);
                                                            $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.SchoolNews',$query);
                                                            foreach ($cursor as $document)
                                                            {
                                                                $newsid = ($document->_id);
                                                                $newsid1 = new \MongoDB\BSON\ObjectId($newsid);
                                                            }
                                                            if(!$newsid1 == "")
                                                            {
                                                                $filter = ['_id'=>$newsid1];
                                                                $query = new MongoDB\Driver\Query($filter);
                                                                $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.SchoolNews',$query);
                                                                foreach ($cursor as $document)
                                                                {
                                                                    $NewsDate = ($document->NewsDate);

                                                                    $utcdatetime = new MongoDB\BSON\UTCDateTime(strval($NewsDate));
                                                                    $datetime = $utcdatetime->toDateTime()->setTimezone(new \DateTimeZone(date_default_timezone_get()));
                                                                    $datenew = date_format($datetime,"Y-m-d\TH:i:s");
                                                                    $date = new MongoDB\BSON\UTCDateTime((new DateTime($datenew))->getTimestamp());
                                                                
                                                                    $nowtimeNew1 = time();
                                                                    $timeNew1 = strval($date);
                                                                }
                                                                ?>
                                                                <span class="text-muted mt-3 font-weight-bold font-size-sm">Latest News update 
                                                                <span class="text-primary"><?php echo "".time_elapsed($nowtimeNew1-$timeNew1);  ?></span></span>
                                                                <?php
                                                            }
                                                            ?>
                                                            </span>
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
                                                                    $filterA = ['school_id'=>$schoolID,'NewsAccess'=>'PUBLIC'];
                                                                    $optionA = ['limit'=>5,'sort' => ['NewsDate' => -1]];
                                                                    $queryA = new MongoDB\Driver\Query($filterA,$optionA);
                                                                    $cursorA = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.SchoolNews',$queryA);
                                                                    foreach ($cursorA as $documentA)
                                                                    {
                                                                        $Newsid = strval($documentA->_id);
                                                                        $NewsStaff_id = ($documentA->NewsStaff_id);
                                                                        $NewsTitle = ($documentA->NewsTitle);
                                                                        $NewsDetails = ($documentA->NewsDetails);
                                                                        $NewsDate = ($documentA->NewsDate);
                                                                        $NewsStatus = ($documentA->NewsStatus);
                                                                        $Access = ($documentA->NewsAccess);
                                                                    
                                                                        $id = new \MongoDB\BSON\ObjectId($NewsStaff_id);
                                                                        $filter1 = ['_id' => $id];
                                                                        $query1 = new MongoDB\Driver\Query($filter1);
                                                                        $cursor1 = $GoNGetzDatabase->executeQuery('GoNGetz.Consumer', $query1);
                                                                        foreach ($cursor1 as $document1)
                                                                        {
                                                                            $consumerid = strval($document1->_id);
                                                                            $ConsumerFName = ($document1->ConsumerFName);
                                                                            $ConsumerLName = ($document1->ConsumerLName);
                                                                            $filter2 = ['ConsumerID'=>$consumerid];
                                                                            $query2 = new MongoDB\Driver\Query($filter2);
                                                                            $cursor2 = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Staff',$query2);
                                                                            foreach ($cursor2 as $document2)
                                                                            {
                                                                                $Staffdepartment = ($document2->Staffdepartment);
                                                                                $departmentid = new \MongoDB\BSON\ObjectId($Staffdepartment);
                                                                    
                                                                                $filter3 = ['_id'=>$departmentid];
                                                                                $query3 = new MongoDB\Driver\Query($filter3);
                                                                                $cursor3 = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.SchoolsDepartment',$query3);
                                                                                foreach ($cursor3 as $document3)
                                                                                {
                                                                                    $DepartmentName = ($document3->DepartmentName);
                                                                                }
                                                                            }
                                                                        }
                                                                        $utcdatetime = new MongoDB\BSON\UTCDateTime(strval($NewsDate));
                                                                        $datetime = $utcdatetime->toDateTime()->setTimezone(new \DateTimeZone(date_default_timezone_get()));
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
                                                                                <a href="index.php?page=newsdetail&id=<?php echo $Newsid; ?>" class="text-dark-75 font-weight-bolder text-hover-primary mb-1 font-size-lg"><?php echo $NewsTitle; ?></a>
                                                                                <span class="text-muted font-weight-bold d-block"><?php echo " By ".$ConsumerFName;?></span>
                                                                                <span class="text-muted font-weight-bold d-block"><?php echo date_format($datetime,"d M, H:i")." "; ?></span>
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
                                                            <a class="nav-link py-2 px-4 font-weight-bolder" data-bs-toggle="tab" href="#kt_tab_pane_10_3"><?php echo $_SESSION["loggeduser_ACCESS"]; ?></a>
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
                                                        <span class="menu-label">
                                                            <?php
                                                            $eventid1="";
                                                            $to_date = new MongoDB\BSON\UTCDateTime((new DateTime('now +1 month'))->getTimestamp()*1000);
                                                            $from_date = new MongoDB\BSON\UTCDateTime((new DateTime('now'))->getTimestamp()*1000);

                                                            $filter = ['school_id'=>$schoolID,'EventAccess'=>$_SESSION["loggeduser_ACCESS"],'EventDateStart' => ['$gte' => $from_date,'$lte' => $to_date]];
                                                            $option = ['sort' => ['EventDateStart' => -1]];
                                                            $query = new MongoDB\Driver\Query($filter,$option);
                                                            $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.SchoolEvent',$query);
                                                            foreach ($cursor as $document)
                                                            {
                                                                $eventid = ($document->_id);
                                                                $eventid1 = new \MongoDB\BSON\ObjectId($eventid);
                                                            }
                                                            
                                                            if(!$eventid1 == "")
                                                            {
                                                            $filter1 = ['_id'=>$eventid1];
                                                            $query1 = new MongoDB\Driver\Query($filter1);
                                                            $cursor1 = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.SchoolEvent',$query1);
                                                            foreach ($cursor1 as $document1)
                                                            {
                                                                $EventDateStart = ($document1->EventDateStart);

                                                                $utcdatetime = new MongoDB\BSON\UTCDateTime(strval($EventDateStart));
                                                                $datetime = $utcdatetime->toDateTime()->setTimezone(new \DateTimeZone(date_default_timezone_get()));
                                                                $dateforum = date_format($datetime,"Y-m-d\TH:i:s");
                                                                $date = new MongoDB\BSON\UTCDateTime((new DateTime($dateforum))->getTimestamp());
                                                            
                                                                $nowtimeEvent1 = time();
                                                                $timeEvent1 = strval($date);
                                                            }
                                                            ?>
                                                            <span class="text-muted mt-3 font-weight-bold font-size-sm">Next Event is in
                                                            <span class="text-primary"><?php echo " ".time_elapsed($timeEvent1-$nowtimeEvent1)." \n";  ?></span></span>
                                                            <?php
                                                            }
                                                            ?>
                                                            </span>
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
                                                                    $to_date = new MongoDB\BSON\UTCDateTime((new DateTime('now +1 month'))->getTimestamp()*1000);
                                                                    $from_date = new MongoDB\BSON\UTCDateTime((new DateTime('now'))->getTimestamp()*1000); 

                                                                    $filterA = ['school_id'=>$schoolID,'EventDateStart' => ['$gte' => $from_date,'$lte' => $to_date],'EventAccess'=>$_SESSION["loggeduser_ACCESS"]];
                                                                    $optionA = ['limit'=>5,'sort' => ['EventDateStart' => 1]];
                                                                    $queryA = new MongoDB\Driver\Query($filterA,$optionA);
                                                                    $cursorA = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.SchoolEvent',$queryA);
                                                                    foreach ($cursorA as $documentA)
                                                                    {
                                                                        $eventid = strval($documentA->_id);
                                                                        $EventStaff_id = ($documentA->EventStaff_id);
                                                                        $EventTitle = ($documentA->EventTitle);
                                                                        $EventVenue = ($documentA->EventVenue);
                                                                        $EventLocation = ($documentA->EventLocation);
                                                                        $EventDateStart = ($documentA->EventDateStart);
                                                                        $EventDateEnd = ($documentA->EventDateEnd);
                                                                        $EventStatus = ($documentA->EventStatus);
                                                                    
                                                                        $utcdatetimeStart = new MongoDB\BSON\UTCDateTime(strval($EventDateStart));
                                                                        $datetimeStart = $utcdatetimeStart->toDateTime()->setTimezone(new \DateTimeZone(date_default_timezone_get()));
                                                                        $utcdatetimeEnd = new MongoDB\BSON\UTCDateTime(strval($EventDateEnd));
                                                                        $datetimeEnd = $utcdatetimeEnd->toDateTime()->setTimezone(new \DateTimeZone(date_default_timezone_get()));
                                                                    
                                                                        $id = new \MongoDB\BSON\ObjectId($EventStaff_id);
                                                                        $filter1 = ['_id' => $id];
                                                                        $query1 = new MongoDB\Driver\Query($filter1);
                                                                        $cursor1 = $GoNGetzDatabase->executeQuery('GoNGetz.Consumer', $query1);
                                                                        foreach ($cursor1 as $document1)
                                                                        {
                                                                            $consumerid = strval($document1->_id);
                                                                            $ConsumerFName = ($document1->ConsumerFName);
                                                                            $ConsumerLName = ($document1->ConsumerLName);
                                                                            $filter2 = ['ConsumerID'=>$consumerid];
                                                                            $query2 = new MongoDB\Driver\Query($filter2);
                                                                            $cursor2 = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Staff',$query2);
                                                                            foreach ($cursor2 as $document2)
                                                                            {
                                                                                $Staffdepartment = ($document2->Staffdepartment);
                                                                                $departmentid = new \MongoDB\BSON\ObjectId($Staffdepartment);
                                                                    
                                                                                $filter3 = ['_id'=>$departmentid];
                                                                                $query3 = new MongoDB\Driver\Query($filter3);
                                                                                $cursor3 = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.SchoolsDepartment',$query3);
                                                                                foreach ($cursor3 as $document3)
                                                                                {
                                                                                    $DepartmentName = ($document3->DepartmentName);
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
                                                                                    <a href="index.php?page=eventdetail&id=<?php echo $eventid; ?>" class="text-dark-75 font-weight-bolder text-hover-primary mb-1 font-size-lg"><?php echo $EventTitle; ?></a>
                                                                                    <span class="text-muted font-weight-bold d-block"><?php echo " By ".$ConsumerFName;?></span>
                                                                                    <span class="text-muted font-weight-bold d-block"><?php echo date_format($datetimeStart,"d M, H:i")." "; ?></span>
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
                                                            <span class="menu-label">
                                                            <?php 
                                                            $eventid2="";
                                                            $to_date = new MongoDB\BSON\UTCDateTime((new DateTime('now +1 month'))->getTimestamp()*1000);
                                                            $from_date = new MongoDB\BSON\UTCDateTime((new DateTime('now'))->getTimestamp()*1000);

                                                            $filter = ['school_id'=>$schoolID,'EventAccess'=>'PUBLIC','EventDateStart' => ['$gte' => $from_date,'$lte' => $to_date]];
                                                            $option = ['limit'=>5,'sort' => ['EventDateStart' => -1]];
                                                            $query = new MongoDB\Driver\Query($filter,$option);
                                                            $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.SchoolEvent',$query);
                                                            foreach ($cursor as $document)
                                                            {
                                                                $eventid = ($document->_id);
                                                                $eventid2 = new \MongoDB\BSON\ObjectId($eventid);
                                                            }

                                                            if(!$eventid2 == "")
                                                            {
                                                            $filter1 = ['_id'=>$eventid2];
                                                            $query1 = new MongoDB\Driver\Query($filter1);
                                                            $cursor1 = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.SchoolEvent',$query1);
                                                            foreach ($cursor1 as $document1)
                                                            {
                                                                $EventDateStart = ($document1->EventDateStart);

                                                                $utcdatetime = new MongoDB\BSON\UTCDateTime(strval($EventDateStart));
                                                                $datetime = $utcdatetime->toDateTime()->setTimezone(new \DateTimeZone(date_default_timezone_get()));
                                                                $dateforum = date_format($datetime,"Y-m-d\TH:i:s");
                                                                $date = new MongoDB\BSON\UTCDateTime((new DateTime($dateforum))->getTimestamp());
                                                            
                                                                $nowtimeEvent2 = time();
                                                                $timeEvent2 = strval($date);
                                                            }
                                                            ?>
                                                            <span class="text-muted mt-3 font-weight-bold font-size-sm">Next Event is in
                                                            <span class="text-primary"><?php echo " ".time_elapsed($timeEvent2-$nowtimeEvent2)." \n";  ?></span></span>
                                                            <?php
                                                            }
                                                            ?>
                                                            </span>
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
                                                                    $to_date = new MongoDB\BSON\UTCDateTime((new DateTime('now +1 month'))->getTimestamp()*1000);
                                                                    $from_date = new MongoDB\BSON\UTCDateTime((new DateTime('now'))->getTimestamp()*1000); 
                                                                    
                                                                    $filterA = ['school_id'=>$schoolID,'EventDateStart' => ['$gte' => $from_date,'$lte' => $to_date],'EventAccess'=>'PUBLIC'];
                                                                    $optionA = ['limit'=>5,'sort' => ['EventDateStart' => 1]];
                                                                    $queryA = new MongoDB\Driver\Query($filterA,$optionA);
                                                                    $cursorA = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.SchoolEvent',$queryA);
                                                                    foreach ($cursorA as $documentA)
                                                                    {
                                                                        $eventid = strval($documentA->_id);
                                                                        $EventStaff_id = ($documentA->EventStaff_id);
                                                                        $EventTitle = ($documentA->EventTitle);
                                                                        $EventVenue = ($documentA->EventVenue);
                                                                        $EventLocation = ($documentA->EventLocation);
                                                                        $EventDateStart = ($documentA->EventDateStart);
                                                                        $EventDateEnd = ($documentA->EventDateEnd);
                                                                        $EventStatus = ($documentA->EventStatus);
                                                                    
                                                                        $utcdatetimeStart = new MongoDB\BSON\UTCDateTime(strval($EventDateStart));
                                                                        $datetimeStart = $utcdatetimeStart->toDateTime()->setTimezone(new \DateTimeZone(date_default_timezone_get()));
                                                                        $utcdatetimeEnd = new MongoDB\BSON\UTCDateTime(strval($EventDateEnd));
                                                                        $datetimeEnd = $utcdatetimeEnd->toDateTime()->setTimezone(new \DateTimeZone(date_default_timezone_get()));
                                                                    
                                                                        $id = new \MongoDB\BSON\ObjectId($EventStaff_id);
                                                                        $filter1 = ['_id' => $id];
                                                                        $query1 = new MongoDB\Driver\Query($filter1);
                                                                        $cursor1 = $GoNGetzDatabase->executeQuery('GoNGetz.Consumer', $query1);
                                                                        foreach ($cursor1 as $document1)
                                                                        {
                                                                            $consumerid = strval($document1->_id);
                                                                            $ConsumerFName = ($document1->ConsumerFName);
                                                                            $ConsumerLName = ($document1->ConsumerLName);
                                                                            $filter2 = ['ConsumerID'=>$consumerid];
                                                                            $query2 = new MongoDB\Driver\Query($filter2);
                                                                            $cursor2 = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Staff',$query2);
                                                                            foreach ($cursor2 as $document2)
                                                                            {
                                                                                $Staffdepartment = ($document2->Staffdepartment);
                                                                                $departmentid = new \MongoDB\BSON\ObjectId($Staffdepartment);
                                                                    
                                                                                $filter3 = ['_id'=>$departmentid];
                                                                                $query3 = new MongoDB\Driver\Query($filter3);
                                                                                $cursor3 = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.SchoolsDepartment',$query3);
                                                                                foreach ($cursor3 as $document3)
                                                                                {
                                                                                    $DepartmentName = ($document3->DepartmentName);
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
                                                                                    <a href="index.php?page=eventdetail&id=<?php echo $eventid; ?>" class="text-dark-75 font-weight-bolder text-hover-primary mb-1 font-size-lg"><?php echo $EventTitle; ?></a>
                                                                                    <span class="text-muted font-weight-bold d-block"><?php echo " By ".$ConsumerFName;?></span>
                                                                                    <span class="text-muted font-weight-bold d-block"><?php echo date_format($datetimeStart,"d M, H:i")." "; ?></span>
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
