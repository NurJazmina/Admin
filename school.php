<?php
    $GoNGetzConnectionString="mongodb://admin:TempPassword@51.79.173.45:27017/gngoffice?authSource=admin";
    $GoNGetzDatabase = new MongoDB\Driver\Manager($GoNGetzConnectionString);

    function time_elapsed($date){
        $bit = array(
            ' year'      => $date  / 31556926 % 12,
            ' week'      => $date  / 604800 % 52,
            ' day'       => $date  / 86400 % 7,
            ' hour'      => $date  / 3600 % 24,
            ' minute'    => $date  / 60 % 60,
            ' second'    => $date  % 60
            );
        foreach($bit as $k => $v){
            if($v > 1)$ret[] = $v . $k . 's';
            if($v == 1)$ret[] = $v . $k;
            }
        array_splice($ret, count($ret)-1, 0, '');
        $ret[] = '';
    
        return join(' ', $ret);
    }

    $school_id = $_GET['id'];
    //$school_id = "5fb5a728c930cc7b988b3bb7";
    
    $School_id = new \MongoDB\BSON\ObjectId($school_id);
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

    $filter = ['SchoolID'=>$school_id, 'StaffLevel'=>'1'];
    $query = new MongoDB\Driver\Query($filter);
    $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Staff',$query);
    $totalstaff = 0;
    foreach ($cursor as $document)
    {
        $totalstaff = $totalstaff + 1;
    }
    $_SESSION["totalstaff"] = $totalstaff;

    $filter = ['SchoolID'=>$school_id, 'StaffLevel'=>'0'];
    $query = new MongoDB\Driver\Query($filter);
    $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Staff',$query);
    $totalteacher= 0;
    foreach ($cursor as $document)
    {
        $totalteacher= $totalteacher + 1;
    }
    $_SESSION["totalteacher"] = $totalteacher;

    $filter = ['Schools_id'=>$school_id];
    $query = new MongoDB\Driver\Query($filter);
    $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Students',$query);
    $totalstudent = 0;
    foreach ($cursor as $document)
    {
        $totalstudent = $totalstudent+ 1;
    }
    $_SESSION["totalstudent"] = $totalstudent;

    $filter = ['Schools_id'=>$school_id];
    $query = new MongoDB\Driver\Query($filter);
    $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Parents',$query);
    $totalparent = 0;
    foreach ($cursor as $document)
    {
        $totalparent = $totalparent + 1;
    }
    $_SESSION["totalparent"] = $totalparent;
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

        .svg-icon.svg-icon-success svg g [fill] {
            transition: fill 0.3s ease;
            fill: #1BC5BD !important;
        }

        .pt-9, .py-9 {
            padding-top: 1.25rem !important;
        }

        .mt-5 {
            margin-top: 0rem!important;
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
                                            <strong>Statistics</strong>
                                        </div>
                                        <div class="card-body">
                                            <!--begin::Item-->
                                            <div class="d-flex align-items-center pb-9">
                                                <!--begin::Symbol-->
                                                <div class="symbol symbol-45 symbol-light mr-4">
                                                    <span class="symbol-label">
                                                        <span class="svg-icon svg-icon-2x svg-icon-dark-50">
                                                            <!--begin::Svg Icon | path:assets/media/svg/icons/Media/Equalizer.svg-->
                                                            <i class="fas fa-user-tie fa-2x"></i>
                                                            <!--end::Svg Icon-->
                                                        </span>
                                                    </span>
                                                </div>
                                                <!--end::Symbol-->
                                                <!--begin::Text-->
                                                <div class="d-flex flex-column flex-grow-1">
                                                    <a href="index.php?page=stafflist&level=1" class="text-dark-75 text-hover-primary mb-1 font-size-lg font-weight-bolder">Staff</a>
                                                    <span class="text-muted font-weight-bold">Good Fellas</span>
                                                </div>
                                                <!--end::Text-->
                                                <!--begin::label-->
                                                <span class="font-weight-bolder label label-xl label-light-success label-inline px-3 py-5 min-w-45px"><?php echo $_SESSION["totalstaff"] ?></span>
                                                <!--end::label-->
                                            </div>
                                            <!--end::Item-->
                                            <!--begin::Item-->
                                            <div class="d-flex align-items-center pb-9">
                                                <!--begin::Symbol-->
                                                <div class="symbol symbol-45 symbol-light mr-4">
                                                    <span class="symbol-label">
                                                        <span class="svg-icon svg-icon-2x svg-icon-dark-50">
                                                            <!--begin::Svg Icon | path:assets/media/svg/icons/Communication/Group.svg-->
                                                            <i class="fas fa-chalkboard-teacher fa-2x"></i>
                                                            <!--end::Svg Icon-->
                                                        </span>
                                                    </span>
                                                </div>
                                                <!--end::Symbol-->
                                                <!--begin::Text-->
                                                <div class="d-flex flex-column flex-grow-1">
                                                    <a href="index.php?page=stafflist&level=0" class="text-dark-75 text-hover-primary mb-1 font-size-lg font-weight-bolder">Teacher</a>
                                                    <span class="text-muted font-weight-bold">Successful Fellas</span>
                                                </div>
                                                <!--end::Text-->
                                                <!--begin::label-->
                                                <span class="font-weight-bolder label label-xl label-light-danger label-inline px-3 py-5 min-w-45px"><?php echo $_SESSION["totalteacher"] ?></span>
                                                <!--end::label-->
                                            </div>
                                            <!--end::Item-->
                                            <!--begin::Item-->
                                            <div class="d-flex align-items-center pb-9">
                                                <!--begin::Symbol-->
                                                <div class="symbol symbol-45 symbol-light mr-4">
                                                    <span class="symbol-label">
                                                        <span class="svg-icon svg-icon-2x svg-icon-dark-50">
                                                            <!--begin::Svg Icon | path:assets/media/svg/icons/Home/Globe.svg-->
                                                            <i class="fas fa-user-graduate fa-2x"></i>
                                                            <!--end::Svg Icon-->
                                                        </span>
                                                    </span>
                                                </div>
                                                <!--end::Symbol-->
                                                <!--begin::Text-->
                                                <div class="d-flex flex-column flex-grow-1">
                                                    <a href="index.php?page=studentlist" class="text-dark-75 text-hover-primary mb-1 font-size-lg font-weight-bolder">Students</a>
                                                    <span class="text-muted font-weight-bold">Creative Fellas</span>
                                                </div>
                                                <!--end::Text-->
                                                <!--begin::label-->
                                                <span class="font-weight-bolder label label-xl label-light-danger label-inline px-3 py-5 min-w-45px"><?php echo $_SESSION["totalstudent"] ?></span>
                                                <!--end::label-->
                                            </div>
                                            <!--end::Item-->
                                            <!--begin::Item-->
                                            <div class="d-flex align-items-center pb-9">
                                                <!--begin::Symbol-->
                                                <div class="symbol symbol-45 symbol-light mr-4">
                                                    <span class="symbol-label">
                                                        <span class="svg-icon svg-icon-2x svg-icon-dark-50">
                                                            <!--begin::Svg Icon | path:assets/media/svg/icons/Layout/Layout-4-blocks.svg-->
                                                            <i class="fas fa-user-friends fa-2x"></i>
                                                            <!--end::Svg Icon-->
                                                        </span>
                                                    </span>
                                                </div>
                                                <!--end::Symbol-->
                                                <!--begin::Text-->
                                                <div class="d-flex flex-column flex-grow-1">
                                                    <a href="index.php?page=parentlist" class="text-dark-75 text-hover-primary mb-1 font-size-lg font-weight-bolder">Parent</a>
                                                    <span class="text-muted font-weight-bold">Productive Fellas</span>
                                                </div>
                                                <!--end::Text-->
                                                <!--begin::label-->
                                                <span class="font-weight-bolder label label-xl label-light-info label-inline px-3 py-5 min-w-45px"><?php echo $_SESSION["totalparent"] ?></span>
                                                <!--end::label-->
                                            </div>
                                            <!--end::Item-->
                                        </div>
                                       
                                        <div class="card-footer">
                                        <!--begin::Footer-->
                                        <div class="d-flex flex-center" id="kt_sticky_toolbar_chat_toggler_2" data-toggle="tooltip" title="" data-placement="right" data-original-title="Chat Example">
                                            <button class="btn btn-success font-weight-bolder font-size-sm py-1 px-14" data-toggle="modal" data-target="#kt_chat_modal">Contact School</button>
                                        </div>
                                        <!--end::Footer-->
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
                                                <!--begin::Body--> 
                                                <div class="card-body pt-0">
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
                                                <!--begin::Body-->
                                                <div class="card-body pt-0">
                                                    <?php 
                                                    $to_date = new MongoDB\BSON\UTCDateTime((new DateTime('now +1 month'))->getTimestamp()*1000);
                                                    $from_date = new MongoDB\BSON\UTCDateTime((new DateTime('now'))->getTimestamp()*1000);
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
