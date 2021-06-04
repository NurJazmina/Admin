<?php
$_SESSION["title"] = "Calendar";
include 'view/partials/_subheader/subheader-v1.php'; 
include 'model/calendar.php';
$calendar = new Calendar();
?>
<!--begin::Content-->
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
<!--begin::Entry-->
<div class="d-flex flex-column-fluid">
    <!--begin::Container-->
    <div class="container">
        <!--begin::Example-->
        <!--begin::Row-->
        <div class="row">
            <div class="col-lg-3">
                <!--begin::Card-->
                <div class="card card-custom card-stretch">
                    <div class="card-header">
                        <div class="card-title">
                            <h3 class="card-label">External Events</h3>
                        </div>
                    </div>
                    <div class="card-body">
                        <div id="kt_calendar_external_events" class="fc-unthemed">
                            <div class="btn btn-block text-left font-weight-bold btn-light-primary fc-draggable-handle mb-5 cursor-move" data-color="fc-event-primary">Meeting</div>
                            <div class="btn btn-block text-left font-weight-bold btn-light-success fc-draggable-handle mb-5 cursor-move" data-color="fc-event-primary">Conference Call</div>
                            <div class="btn btn-block text-left font-weight-bold btn-light-danger fc-draggable-handle mb-5 cursor-move" data-color="fc-event-success">Dinner</div>
                            <div class="btn btn-block text-left font-weight-bold btn-light-info fc-draggable-handle mb-5 cursor-move" data-color="fc-event-warning">Product Launch</div>
                            <div class="btn btn-block text-left font-weight-bold btn-light-warning fc-draggable-handle cursor-move" data-color="fc-event-danger">Reporting</div>
                            <div class="separator separator-dashed my-10"></div>
                            <div class="btn btn-block text-left font-weight-bold btn-light-success fc-draggable-handle cursor-move" data-color="fc-event-success">Project Update</div>
                            <div class="btn btn-block text-left font-weight-bold btn-light-primary fc-draggable-handle cursor-move" data-color="fc-event-info">Staff Meeting</div>
                            <div class="btn btn-block text-left font-weight-bold btn-light-danger fc-draggable-handle cursor-move" data-color="fc-event-dark">Lunch</div>
                            <div class="separator separator-dashed my-10"></div>
                            <div>
                                <label class="checkbox checkbox-primary">
                                <input type="checkbox" id="kt_calendar_external_events_remove" />Remove after drop
                                <span></span></label>
                            </div>
                        </div>
                    </div>
                </div>
                <!--end::Card-->
            </div>
            <div class="col-lg-9">
                <!--begin::Card-->
                <div class="card card-custom card-stretch">
                    <div class="card-header">
                        <div class="card-title">
                            <h3 class="card-label">Your Calendar</h3>
                        </div>
                        <div class="card-toolbar">
                            <a href="#" class="btn btn-light-success font-weight-bold">
                            <i class="ki ki-plus"></i>Add Event</a>
                        </div>
                    </div>
                    <div class="card-body">
                       <div id="kt_calendar" class="fc fc-ltr fc-unthemed" style="">
                            <?php
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
                            $filter = ['Created_by'=>$_SESSION["loggeduser_id"]];
                            $query = new MongoDB\Driver\Query($filter);
                            $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Calendar',$query);
             
                            foreach ($cursor as $document)
                            {
                                $calendarid = $document->_id;
                                $Created_by = $document->Created_by;
                                $Description = $document->Description;
                                $Event_Title = $document->Event_Title;
                                $Venue = $document->Venue;
                                $Location = $document->Location;
                                $Repeated = $document->Repeated;
                                $Type_Event = $document->Type_Event;
                                $Class_id = $document->Class_id;
                                $Date_Start = $document->Date_Start;
                                $Date_End = $document->Date_End;

                                $utcdatetimeStart = new MongoDB\BSON\UTCDateTime(strval($Date_Start));
                                $datetimeStart = $utcdatetimeStart->toDateTime()->setTimezone(new \DateTimeZone(date_default_timezone_get()));
                                $utcdatetimeEnd = new MongoDB\BSON\UTCDateTime(strval($Date_End));
                                $datetimeEnd = $utcdatetimeEnd->toDateTime()->setTimezone(new \DateTimeZone(date_default_timezone_get()));
                                
                                $DateStart = date_format($datetimeStart,"Y/m/d");
                                $DateEnd = date_format($datetimeEnd,"Y/m/d");

                                $Duration = date_format($datetimeEnd,"d") - date_format($datetimeStart,"d") + 1;
                                
                                $calendar->add_event($Event_Title,$DateStart,$Duration,'yellow',);
                            }
                            ?>
                            <div class="content home">
                                <?=$calendar?>
                            </div>
                            
                       </div>
                    </div>
                </div>
                <!--end::Card-->
            </div>
        </div>
        <!--end::Row-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::Entry-->
</div>
<!--end::Content-->