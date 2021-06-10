<?php
$_SESSION["title"] = "Calendar";
include 'view/partials/_subheader/subheader-v1.php'; 
include 'model/calendar.php';
$calendar = new Calendar();
?>
<style>

 .todo-overlay{
  width: 100vw;
  height: 100vh;
  position: fixed;
  top: 0;
  left: 0;
  opacity: 0.9;
  display: flex;
  justify-content: center;
  align-items: center;
  transform: translateX(-100vw);
  transition: transform 250ms;
  z-index: 2;
}
  .todo-modal{
  min-width: 50vw;
  height: 50vh;
}

.todo-modal-close-btn{
  position: absolute;
  top: 2rem;
  right: 2rem;
  width: 2rem;
  height: 2rem;
  display: flex;
  justify-content: center;
  align-items: center;
}

.slidedIntoView {
  transform: translateX(0);
  transition: transform 650ms;
  backdrop-filter: blur(10px) !important;
  /*background-color: #1BC5BD !important;*/
}

.fc-next-button, .fc-prev-button, .fc-today-button, .fc-next-button, .fc-dayGridMonth-button, .fc-timeGridWeek-button, .fc-timeGridDay-button{
    color: #fff !important;
    background-color: #1BC5BD !important;
    border-color: #1BC5BD !important;
}
.fc-next-button:hover, .fc-prev-button:hover, .fc-today-button:hover, .fc-next-button:hover, .fc-dayGridMonth-button:hover, .fc-timeGridWeek-button:hover, .fc-timeGridDay-button:hover{
    color: #1BC5BD !important;
    background-color: #fff !important;
    border-color: #1BC5BD !important;
}

.fc-scrollgrid-section, .fc-scrollgrid-section-header{
    color: #B5B5C3 !important;
    border-color: #ddd !important;
}
.fc-daygrid-day-top{
    color: #3699FF !important;
}
}
</style>
<!--begin::Row-->
<div class="container">
<div class="row">
    <div class="col-lg-4">
        <!--begin::Card-->
        <div class="card card-custom card-stretch">
            <div class="card-header">
                <div class="card-title">
                    <h3 class="card-label">To-Do list</h3>
                </div>
            </div>
            <div class="card-body">
                <div id="kt_calendar_external_events" class="fc-unthemed">
                    <div class="todo-input todo-block">
                        <div class="form-group row">
                            <label class="col-lg-2 col-form-label">To-do</label>
                            <div class="col-lg-10">
                                <input type="text" class="form-control form-control-sm" placeholder="Enter new to-do">
                            </div>
                            <label class="col-lg-2 col-form-label">Type</label>
                            <div class="col-lg-10">
                                <input type="text" class="form-control form-control-sm" placeholder="Choose a category" list="categoryList">
                                <datalist id="categoryList">
                                    <option value="Personal"></option>
                                    <option value="School"></option>
                                </datalist>
                            </div>
                            <label class="col-lg-2 col-form-label">Date</label>
                            <div class="col-lg-10">
                                <input type="date" id="dateInput" class="form-control form-control-sm">
                            </div>
                            <label class="col-lg-2 col-form-label">Time</label>
                            <div class="col-lg-10">
                                <input type="time" id="timeInput" class="form-control form-control-sm">
                            </div>
                            <div class="col-lg-2 mt-2">
                            </div>
                            <div class="col-lg-10 mt-2">
                                <button id="addBtn" class="btn btn-success btn-sm btn-block" name="">Add</button>
                                <button id="sortBtn" class="btn btn-secondary btn-sm btn-block" >Sort by date</button>
                                <div class="checkbox-inline">
                                    <label class="checkbox checkbox-success mt-3"><input type="checkbox" id="shortlistBtn" name="Checkboxes5"/>
                                    <span> </span> 
                                    Incomplete First </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="separator separator-dashed my-10"></div>
                    <div class="table-responsive rounded">
                        <table id="todoTable" class="table table-bordered table-sm" style="text-align:center;">
                            <tr class="table-danger" style="color:#fff">
                                <th colspan="2">Date</th>
                                <th>Time</th>
                                <th>To-do</th>
                                <th>
                                    <select id="categoryFilter" class="form-control form-control-sm" align="center"></select>
                                </th>
                                <th colspan="2">Edit</th>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!--end::Card-->
    </div>
    <div class="col-lg-8">
        <!--begin::Card-->
        <div class="card card-custom card-stretch">
            <div class="card-header">
                <div class="card-title">
                    <h3 class="card-label">Your Calendar</h3>
                </div>
                <div class="card-toolbar">
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

                        $NowDate = new MongoDB\BSON\UTCDateTime((new DateTime('now'))->getTimestamp()*1000); 
                        $Now = $NowDate->toDateTime()->setTimezone(new \DateTimeZone(date_default_timezone_get()));
                        $date = date_format($Now,"Y/m/d");
                    
                    }
                    ?>
                    <div class="card-body">
                        <div id='calendar' class="fc fc-ltr fc-unthemed"></div>
                    </div>

                    <div class="todo-overlay" id="todo-overlay">
                    <div class="col-4"></div>
                    <div class="col-4">
                        <div class="card" id="todo-modal" style="background-color:#E4E6EF;">
                            <div class="todo-modal-close-btn" id="todo-modal-close-btn">X</div>
                            <div class="card-body">
                                <div class="form-group row">
                                    <label class="col-lg-2 col-form-label">To-do</label>
                                    <div class="col-lg-10">
                                        <input type="text" id="todo-edit-todo" class="form-control" placeholder="Enter new to-do">
                                    </div>
                                    <label class="col-lg-2 col-form-label">Type</label>
                                    <div class="col-lg-10">
                                        <input type="text" id="todo-edit-category" class="form-control" placeholder="Enter category" list="categoryList">
                                        <datalist id="categoryList">
                                            <option value="Personal"></option>
                                            <option value="School"></option>
                                        </datalist>
                                    </div>
                                    <label class="col-lg-2 col-form-label">Date</label>
                                    <div class="col-lg-10">
                                        <input type="date" id="todo-edit-date" class="form-control">
                                    </div>
                                    <label class="col-lg-2 col-form-label">Time</label>
                                    <div class="col-lg-10">
                                        <input type="time" id="todo-edit-time" class="form-control">
                                    </div>
                                    <div class="col-lg-2 mt-2">
                                    </div>
                                    <div class="col-lg-10 mt-2">
                                        <button id="changeBtn" class="btn btn-success btn-lg btn-block" name="">Add</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-4"></div>
                    </div>
                    
                </div>
            </div>
        </div>
        <!--end::Card-->
    </div>
</div>
</div>
<!--end::Row-->
