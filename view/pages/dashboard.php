<?php
$_SESSION["title"] = "Dashboard";
include 'view/partials/_subheader/subheader-v1.php';
include 'model/covid.php'; 
include 'model/home.php'; 

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
?>
<style src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/themes/smoothness/jquery-ui.css"></style>
<style>

.colornude{
	color:#BDB76B;
}

@import url(https://fonts.googleapis.com/css?family=Lato:300,400,700);

.clearfix:before,.clearfix:after {
    content: " "; /* 1 */
    display: table; /* 2 */
}
.clearfix:after { clear: both;}
.clearfix {    *zoom: 1;}
body {
  font-family: 'Lato', Calibri, Arial, sans-serif;
  background-image: url(https://goo.gl/XZ7Kr7);
  background-position: center;
  background-size: cover;
  font-weight: 400;
  font-size: 15px;
  color: #333;
}

section {
	width: 100%;
	height: 100%;
	position: relative;
}
section, .main {
	border-radius: 8px;
	padding: 0 5px 50px 5px;
	width: 100%;
	margin: 0 auto;
	max-width: 660px;
}
.fc-calendar1-container {
	position: relative;
	height: 100px;
	width: 100px;
}
.fc-calendar1 {
	width: 100%;
	height: 100%;
}
.fc-calendar1 .fc-head {
	height: 30px;
	line-height: 30px;
	background: #ccc;
	color: #fff;
}
.fc-calendar1 .fc-body {
	position: relative;
	width: 100%;
	height: 80%;
	height: -moz-calc(100% - 30px);
	height: -webkit-calc(100% - 30px);
	height: calc(100% - 30px);
	border: 1px solid #ddd;
}
.fc-calendar1 .fc-row {
	width: 100%;
	border-bottom: 1px solid #ddd;
}
.fc-four-rows .fc-row  {
	height: 25%;
}
.fc-five-rows .fc-row  {
	height: 20%;
}
.fc-six-rows .fc-row {
	height: 16.66%;
	height: -moz-calc(100%/6);
	height: -webkit-calc(100%/6);
	height: calc(100%/6);
}
.fc-calendar1 .fc-row > div, .fc-calendar1 .fc-head > div {
	float: left;
	height: 100%;
	width:  14.28%; /* 100% / 7 */
	width: -moz-calc(100%/7);
	width: -webkit-calc(100%/7);
	width: calc(100%/7);
	position: relative;
}
.ie9 .fc-calendar1 .fc-row > div, .ie9 .fc-calendar1 .fc-head > div {
	width:  14.2%;
}
.fc-calendar1 .fc-row > div {
	border-right: 1px solid #ddd;
	padding: 4px;
	overflow: hidden;
	position: relative;
}
.fc-calendar1 .fc-head > div {
	text-align: center;
}
.fc-calendar1 .fc-row > div > span.fc-date {
	position: absolute;
	width: 30px;
	height: 20px;
	font-size: 20px;
	line-height: 20px;
	font-weight: 700;
	color: #ddd;
	text-shadow: 0 -1px 0 rgba(255,255,255,0.8);
	bottom: 5px;
	right: 5px;
	text-align: right;
}
.fc-calendar1 .fc-row > div > span.fc-weekday {
	padding-left: 5px;
	display: none;
}
.fc-calendar1 .fc-row > div.fc-today {
	background: #fff4c3;
}
.fc-calendar1 .fc-row > div.fc-out {
	opacity: 0.6;
}
.fc-calendar1 .fc-row > div:last-child,.fc-calendar1 .fc-head > div:last-child {
	border-right: none;
}
.fc-calendar1 .fc-row:last-child {
	border-bottom: none;
}
.custom-calendar1-wrap {
	margin: 10px auto;
	position: relative;
	overflow: hidden;
}
.custom-inner {
	background: #fff;
  border-radius: 5px;
	box-shadow: 0 1px 3px rgba(0,0,0,0.2);
  overflow: hidden;
}
.custom-inner:before,.custom-inner:after  {
	content: '';
	width: 99%;
	height: 50%;
	position: absolute;
	background: #f6f6f6;
	bottom: -4px;
	left: 0.5%;
	z-index: -1;
	box-shadow: 0 1px 3px rgba(0,0,0,0.2);
}
.custom-inner:after {
	content: '';
	width: 98%;
	bottom: -7px;
	left: 1%;
	z-index: -2;
}
.custom-header {
	background: #BDB76B;
	padding: 5px 10px 10px 20px;
	height: 70px;
	position: relative;
	border-top: 5px solid #BDB76B;
	border-bottom: 1px solid #ddd;
}
.custom-header h2,.custom-header h3 {
	text-align: center;
	text-transform: uppercase;
}
.custom-header h2 {
	color: #FFF;
	font-weight: 700;
	font-size: 18px;
	margin-top: 10px;
}
.custom-header h3 {
	font-size: 10px;
	font-weight: 700;
	color: #FFF;
}
.custom-header nav span {
	position: absolute;
	top: 17px;
	width: 30px;
	height: 30px;
	color: transparent;
	cursor: pointer;
	margin: 0 1px;
	font-size: 20px;
	line-height: 30px;
	-webkit-touch-callout: none;
	-webkit-user-select: none;
	-khtml-user-select: none;
	-moz-user-select: none;
	user-select: none;
}
.custom-header nav span:first-child {	left: 5px;}
.custom-header nav span:last-child {	right: 5px;}
.custom-header nav span:before {
	font-family: 'fontawesome-selected';
	color: #FFF;
	position: absolute;
	text-align: center;
	width: 100%;
}
.custom-header nav span.custom-prev:before {	content: '\25c2';}
.custom-header nav span.custom-next:before {	content: '\25b8';}
.custom-header nav span:hover:before {	color: #495468;}
.custom-content-reveal {
	background: #f6f6f6;
	background: rgba(246, 246, 246, 0.9);
	width: 100%;
	height: 100%;
	position: absolute;
	z-index: 100;
	top: 100%;
	left: 0px;
	text-align: center;
	-webkit-transition: all 0.6s ease-in-out;
	-moz-transition: all 0.6s ease-in-out;
	-o-transition: all 0.6s ease-in-out;
	-ms-transition: all 0.6s ease-in-out;
	transition: all 0.6s ease-in-out;
}
.custom-content-reveal span.custom-content-close {
	position: absolute;
	top: 15px;
	right: 10px;
	width: 20px;
	height: 20px;
	text-align: center;
	background: #BDB76B;
	box-shadow: 0 1px 1px rgba(0,0,0,0.1);
	cursor: pointer;
	line-height: 13px;
	padding: 0;
}
.custom-content-reveal span.custom-content-close:after {
	content: 'x';
	font-size: 18px;
	color: #fff;
}
.custom-content-reveal a, .custom-content-reveal span {
	font-size: 22px;
	padding: 10px 30px;
	display: block;
}
.custom-content-reveal h4 {
	text-transform: uppercase;
	font-size: 13px;
	font-weight: 300;
	letter-spacing: 3px;
	color: #777;
	padding: 20px;
	background: #fff;
	border-bottom: 1px solid #ddd;
	border-top: 5px solid #BDB76B;
	box-shadow: 0 1px rgba(255,255,255,0.9);
	margin-bottom: 30px;
}
.custom-content-reveal span {	color: #888;}
.custom-content-reveal a {	color: #BDB76B;}
.custom-content-reveal a:hover {	color: #333;}

/* Modifications */
.fc-calendar1-container {
	height: 250px;
	width: auto;
	padding: 30px;
	background: #f6f6f6;
	box-shadow: inset 0 1px rgba(255,255,255,0.8);
}
.fc-calendar1 .fc-head {
	background: transparent;
	color: #BDB76B;
	font-weight: bold;
	text-transform: uppercase;
	font-size: 12px;
}
.fc-calendar1 .fc-row > div {
	background: #fff;
	cursor: pointer;
}
.fc-calendar1 .fc-row > div:empty {
	background: transparent;
}
.fc-calendar1 .fc-row > div > span.fc-date {
	top: 50%;
	left: 50%;
	text-align: center;
	margin: -10px 0 0 -15px;
	color: #686a6e;
	font-weight: 400;
	pointer-events: none;
}
.fc-calendar1 .fc-row > div.fc-today {
	background: #BDB76B;
	box-shadow: inset 0 -1px 1px rgba(0,0,0,0.1);
}
.fc-calendar1 .fc-row > div.fc-today > span.fc-date {
	color: #fff;
	text-shadow: 0 1px 1px rgba(0,0,0,0.1);
}
.fc-calendar1 .fc-row > div.fc-content:after {
	content: '\00B7';
	text-align: center;
	width: 20px;
	margin-left: -10px;
	position: absolute;
	color: #DDD;
	font-size: 70px;
	line-height: 20px;
	left: 50%;
	bottom: 3px;
}
.fc-calendar1 .fc-row > div.fc-today.fc-content:after {	color: #b02c42;}
.fc-calendar1 .fc-row > div.fc-content:hover:after{	color: #BDB76B;}
.fc-calendar1 .fc-row > div.fc-today.fc-content:hover:after{	color: #fff;}
.fc-calendar1 .fc-row > div > div a, .fc-calendar1 .fc-row > div > div span {
	display: none;
	font-size: 22px;
}
@media screen and (max-width: 400px) {
	.fc-calendar1-container {		height: 100px;	}
	.fc-calendar1 .fc-row > div > span.fc-date {		font-size: 15px;	}
}
</style>
<!--begin::Dashboard-->
<!--begin::Row-->
<div class="row">
	<div class="col-lg-6 col-xxl-4">
		<!--begin::Mixed Widget 1-->
		<div class="card card-custom card-stretch gutter-b">
			<!--begin::Body-->
			<div class="card-body d-flex flex-column">
				<!--begin::Wrapper-->
					<!--begin::Header-->
					<div class="d-flex flex-column flex-center">
						<!--begin::Image-->
						<div class="bgi-no-repeat bgi-size-cover rounded min-h-180px w-100" style="background-image: url(assets/media/stock-600x400/img-70.jpg)"></div>
						<!--end::Image-->
						<!--begin::Title-->
						<a href="#" class="card-title font-weight-bolder text-dark-75 text-hover-primary font-size-h4 m-0 pt-7 pb-1"><?= $_SESSION["loggeduser_schoolName"]; ?></a>
						<!--end::Title-->
						<!--begin::Text-->
						<div class= text-dark-50 font-size-sm pb-7"><?= $_SESSION["loggeduser_schoolsAddress"]; ?></div>
						<!--end::Text-->
					</div>
					<!--end::Header-->
					<!--begin::Body-->
					<div class="pt-15">
						<!--begin::Item-->
						<div class="d-flex align-items-center pb-9">
							<!--begin::Symbol-->
							<div class="symbol symbol-45 symbol-light mr-4 ">
								<span class="symbol-label bg-white">
									<span class="svg-icon svg-icon-2x">
										<!--begin::Svg Icon | path:assets/media/svg/icons/Media/Equalizer.svg-->
										<i class="fas fa-user-tie fa-2x text-dark-50"></i>
										<!--end::Svg Icon-->
									</span>
								</span>
							</div>
							<!--end::Symbol-->
							<!--begin::Text-->
							<div class="d-flex flex-column flex-grow-1">
								<a href="index.php?page=stafflist&level=1" class="text-dark-75 text-hover-primary mb-1 font-size-lg font-weight-bolder">Staff</a>
								<span class="text-muted">Good Fellas</span>
							</div>
							<!--end::Text-->
							<!--begin::label-->
							<span class="font-weight-bolder label label-xl label-light label-inline px-3 py-5 min-w-45px"><?= $_SESSION["totalstaff"] ?></span>
							<!--end::label-->
						</div>
						<!--end::Item-->
						<!--begin::Item-->
						<div class="d-flex align-items-center pb-9">
							<!--begin::Symbol-->
							<div class="symbol symbol-45 symbol-light mr-4">
								<span class="symbol-label bg-white">
									<span class="svg-icon svg-icon-2x">
										<!--begin::Svg Icon | path:assets/media/svg/icons/Communication/Group.svg-->
										<i class="fas fa-chalkboard-teacher fa-2x text-dark-50"></i>
										<!--end::Svg Icon-->
									</span>
								</span>
							</div>
							<!--end::Symbol-->
							<!--begin::Text-->
							<div class="d-flex flex-column flex-grow-1">
								<a href="index.php?page=stafflist&level=0" class="text-dark-75 text-hover-primary mb-1 font-size-lg font-weight-bolder">Teacher</a>
								<span class="text-muted">Successful Fellas</span>
							</div>
							<!--end::Text-->
							<!--begin::label-->
							<span class="font-weight-bolder label label-xl label-light label-inline px-3 py-5 min-w-45px"><?= $_SESSION["totalteacher"] ?></span>
							<!--end::label-->
						</div>
						<!--end::Item-->
						<!--begin::Item-->
						<div class="d-flex align-items-center pb-9">
							<!--begin::Symbol-->
							<div class="symbol symbol-45 symbol-light mr-4">
								<span class="symbol-label bg-white">
									<span class="svg-icon svg-icon-2x">
										<!--begin::Svg Icon | path:assets/media/svg/icons/Home/Globe.svg-->
										<i class="fas fa-user-graduate fa-2x text-dark-50"></i>
										<!--end::Svg Icon-->
									</span>
								</span>
							</div>
							<!--end::Symbol-->
							<!--begin::Text-->
							<div class="d-flex flex-column flex-grow-1">
								<a href="index.php?page=studentlist" class="text-dark-75 text-hover-primary mb-1 font-size-lg font-weight-bolder">Students</a>
								<span class="text-muted">Creative Fellas</span>
							</div>
							<!--end::Text-->
							<!--begin::label-->
							<span class="font-weight-bolder label label-xl label-light label-inline py-5 min-w-45px"><?= $_SESSION["totalstudent"] ?></span>
							<!--end::label-->
						</div>
						<!--end::Item-->
						<!--begin::Item-->
						<div class="d-flex align-items-center pb-9">
							<!--begin::Symbol-->
							<div class="symbol symbol-45 symbol-light mr-4">
								<span class="symbol-label bg-white">
									<span class="svg-icon svg-icon-2x">
										<!--begin::Svg Icon | path:assets/media/svg/icons/Layout/Layout-4-blocks.svg-->
										<i class="fas fa-user-friends fa-2x text-dark-50"></i>
										<!--end::Svg Icon-->
									</span>
								</span>
							</div>
							<!--end::Symbol-->
							<!--begin::Text-->
							<div class="d-flex flex-column flex-grow-1">
								<a href="index.php?page=parentlist" class="text-dark-75 text-hover-primary mb-1 font-size-lg font-weight-bolder">Parent</a>
								<span class="text-muted">Productive Fellas</span>
							</div>
							<!--end::Text-->
							<!--begin::label-->
							<span class="font-weight-bolder label label-xl label-light label-inline px-3 py-5 min-w-45px"><?= $_SESSION["totalparent"] ?></span>
							<!--end::label-->
						</div>
						<!--end::Item-->
					</div>
					<!--end::Body-->
				<!--end::Wrapper-->
			</div>
			<!--end::Body-->
			<div class="text-center mx-5 mb-5">
				<button class="btn btn-success btn-hover-light btn-sm btn-block">Contact School</button>
			</div>
		</div>
		<!--end::Mixed Widget 1-->
	</div>
	<div class="col-lg-6 col-xxl-4">
		<!--begin::List Widget 9-->
		<div class="card card-custom card-stretch gutter-b">
			<!--begin::Body-->
			<div class="card-body d-flex flex-column">
				<div class="text-center text-dark-50">
					<div class="row">
						<a class="text-muted">Last updated: <?= $date_display; ?></a>
						<div class="col-sm"></div>
						<div class="col-sm">
							<img src="assets/media/client-logos/malaysia.png" class="img-fluid" alt="...">
						</div>
						<div class="col-sm"></div>
						<h1 class="mt-5">Coronavirus Cases :</h1>
						<a class="h1 font-weight-boldest text-primary"><?= $cases_new1; ?></a>

						<h1 class="mt-10">Death :</h1>
						<a class="h1 font-weight-boldest text-danger"><?= $deaths_new; ?></a>

						<h1 class="mt-10">Recovered :</h1>
						<a class="h1 font-weight-boldest text-warning"><?= $cases_recovered1; ?></a>
					</div>
				</div>
				<div class="text-dark-50 text-center m-1 mt-10"><h3>Cluster Covid19</h3></div>
				<table class="table table-bordered table-sm">
					<tbody>
						<tr class="bg-success text-white">
							<td>Date</td>
							<td><?= $date2; ?></td>
							<td><?= $date1; ?></td>
						</tr>
						<tr class="bg-white">
							<td>Cluster import</td>
							<td><?= $cluster_import2; ?></td>
							<td><?= $cluster_import1; ?></td>
						</tr>
						<tr class="bg-white">
							<td>Cluster religious</td>
							<td><?= $cluster_religious2; ?></td>
							<td><?= $cluster_religious1; ?></td>
						</tr>
						<tr class="bg-white">
							<td>Cluster community</td>
							<td><?= $cluster_community2; ?></td>
							<td><?= $cluster_community1; ?></td>
						</tr>
						<tr class="bg-white">
							<td>Cluster high risk</td>
							<td><?= $cluster_highRisk2; ?></td>
							<td><?= $cluster_highRisk1; ?></td>
						</tr>
						<tr class="bg-white">
							<td>Cluster education</td>
							<td><?= $cluster_education2; ?></td>
							<td><?= $cluster_education1; ?></td>
						</tr>
						<tr class="bg-white">
							<td>Cluster detention centre</td>
							<td><?= $cluster_detentionCentre2; ?></td>
							<td><?= $cluster_detentionCentre1; ?></td>
						</tr>
						<tr class="bg-white">
							<td>Cluster workplace</td>
							<td><?= $cluster_workplace2; ?></td>
							<td><?= $cluster_workplace1; ?></td>
						</tr>
					</tbody>
				</table>
			</div>
			<!--end::Body-->
		</div>
		<!--end: List Widget 9-->
	</div>
	<div class="col-lg-6 col-xxl-4">
		<!--begin::Stats Widget 11-->
		<div class="card card-custom card-stretch card-stretch-half gutter-b">
			<!--begin::Body-->
			<div class="card-body">
				<a class="twitter-timeline" href="https://twitter.com/gongetz?ref_src=twsrc%5Etfw">Tweets by gongetz</a> <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
			</div>
			<!--end::Body-->
		</div>
		<!--end::Stats Widget 11-->
		<!--begin::Stats Widget 12-->
		<div class="card card-custom card-stretch card-stretch-half gutter-b">
			<!--begin::Body-->
			<div class="card-body">
				<section>
					<div class="main">
						<div class="custom-calendar1-wrap">
							<div id="custom-inner" class="custom-inner">
								<div class="custom-header clearfix">
									<nav>
										<span id="custom-prev" class="custom-prev"></span>
										<span id="custom-next" class="custom-next"></span>
									</nav>
									<h2 id="custom-month" class="custom-month"></h2>
									<h3 id="custom-year" class="custom-year"></h3>
								</div>
								<div id="calendar1" class="fc-calendar1-container"></div>
							</div>
						</div>
					</div>
				</section>
			</div>
			<!--end::Body-->
		</div>
		<!--end::Stats Widget 12-->
	</div>
	<div class="col-lg-6 col-xxl-4 order-1 order-xxl-1">
		<!--begin::List Widget 3-->
		<div class="card card-custom card-stretch gutter-b">
			<!--begin::Header-->
			<div class="card-header border-0 pt-7">
				<h3 class="nav-link text-dark-50">Upcoming Events</h3>
				<ul class="nav nav-success nav-pills nav-pills-sm">
					<li class="nav-item">
						<a class="nav-link" data-toggle="tab" href="#kt_tab_pane_10_3"><?= $_SESSION["loggeduser_ACCESS"]; ?></a>
					</li>
					<li class="nav-item">
						<a class="nav-link active" data-toggle="tab" href="#kt_tab_pane_10_4">PUBLIC</a>
					</li>
				</ul>
			</div>
			<!--end::Header-->
			<div class="separator separator-solid"></div>
			<!--begin::Body-->
			<div class="card-body d-flex flex-column">
				<div class="tab-content" id="myTabTables10">
					<!--begin::Tap pane-->
					<div class="tab-pane fade" id="kt_tab_pane_10_3" role="tabpanel" aria-labelledby="kt_tab_pane_10_3">
						<!--begin::Table-->
						<div>
							<table class="table table-borderless table-vertical-center">
								<!--begin::Thead-->
								<thead>
									<tr>
										<th class="p-0 w-100 min-w-100px"></th>
										<th class="p-0"></th>
										<th class="p-0 min-w-130px w-100"></th>
									</tr>
								</thead>
								<!--end::Thead-->
								<!--begin::Tbody-->
								<?php
								$to_date = new MongoDB\BSON\UTCDateTime((new DateTime('now +1 month'))->getTimestamp()*1000);
								$from_date = new MongoDB\BSON\UTCDateTime((new DateTime('now'))->getTimestamp()*1000); 

								$filter = ['School_id'=>$_SESSION["loggeduser_school_id"],'Access'=>$_SESSION["loggeduser_ACCESS"],'Date_start' => ['$gte' => $from_date,'$lte' => $to_date]];
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
									$Status = $document->Status;
								
									$Date_start = new MongoDB\BSON\UTCDateTime($Date_start);
									$Date_start = $Date_start->toDateTime()->setTimezone(new \DateTimeZone(date_default_timezone_get()));
								
									$filter = ['_id' => new \MongoDB\BSON\ObjectId($Staff_id)];
									$query = new MongoDB\Driver\Query($filter);
									$cursor = $GoNGetzDatabase->executeQuery('GoNGetz.Consumer',$query);
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
												<a href="index.php?page=eventdetail&id=<?= $event_id; ?>" class="text-dark-50 mb-1 font-size-lg"><?= mb_strimwidth($Title, 0,20, "..."); ?></a>
												<span class="text-muted d-block"><?= " By ".$ConsumerFName;?></span>
											</td>
											<td></td>
											<td class="text-left">
												<span class="d-block font-size-lg text-dark-50"><?= date_format($Date_start,"d M, H:i")." "; ?></span>
												<span class="text-muted d-block font-size-sm">Time</span>
											</td>
											<td class="text-right pr-0">
												<a href="index.php?page=eventdetail&id=<?= $event_id; ?>" target="_blank">
													<span class="svg-icon svg-icon-md">
														<!--begin::Svg Icon | path:assets/media/svg/icons/Navigation/Arrow-right.svg-->
														<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
															<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
																<polygon points="0 0 24 0 24 24 0 24" />
																<rect fill="#000000" opacity="0.3" transform="translate(12.000000, 12.000000) rotate(-90.000000) translate(-12.000000, -12.000000)" x="11" y="5" width="2" height="14" rx="1" />
																<path d="M9.70710318,15.7071045 C9.31657888,16.0976288 8.68341391,16.0976288 8.29288961,15.7071045 C7.90236532,15.3165802 7.90236532,14.6834152 8.29288961,14.2928909 L14.2928896,8.29289093 C14.6714686,7.914312 15.281055,7.90106637 15.675721,8.26284357 L21.675721,13.7628436 C22.08284,14.136036 22.1103429,14.7686034 21.7371505,15.1757223 C21.3639581,15.5828413 20.7313908,15.6103443 20.3242718,15.2371519 L15.0300721,10.3841355 L9.70710318,15.7071045 Z" fill="#000000" fill-rule="nonzero" transform="translate(14.999999, 11.999997) scale(1, -1) rotate(90.000000) translate(-14.999999, -11.999997)" />
															</g>
														</svg>
														<!--end::Svg Icon-->
													</span>
												</a>
											</td>
										</tr>
									</tbody>
									<?php
								}
								?>
								<!--end::Tbody-->
							</table>
						</div>
					</div>
					<!--end::Tap pane-->
					<!--begin::Tap pane-->
					<div class="tab-pane fade show active" id="kt_tab_pane_10_4" role="tabpanel" aria-labelledby="kt_tab_pane_10_4">
						<!--begin::Table-->
						<div>
							<table class="table table-borderless table-vertical-center">
								<!--begin::Thead-->
								<thead>
									<tr>
										<th class="p-0 w-100 min-w-100px"></th>
										<th class="p-0"></th>
										<th class="p-0 min-w-130px w-100"></th>
									</tr>
								</thead>
								<!--end::Thead-->
								<!--begin::Tbody-->
								<?php
								$to_date = new MongoDB\BSON\UTCDateTime((new DateTime('now +1 month'))->getTimestamp()*1000);
								$from_date = new MongoDB\BSON\UTCDateTime((new DateTime('now'))->getTimestamp()*1000); 

								$filter = ['School_id'=>$_SESSION["loggeduser_school_id"],'Access'=>'PUBLIC','Date_start' => ['$gte' => $from_date,'$lte' => $to_date]];
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
									$Status = $document->Status;
								
									$Date_start = new MongoDB\BSON\UTCDateTime($Date_start);
									$Date_start = $Date_start->toDateTime()->setTimezone(new \DateTimeZone(date_default_timezone_get()));
								
									$filter = ['_id' => new \MongoDB\BSON\ObjectId($Staff_id)];
									$query = new MongoDB\Driver\Query($filter);
									$cursor = $GoNGetzDatabase->executeQuery('GoNGetz.Consumer',$query);
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
												<a href="index.php?page=eventdetail&id=<?= $event_id; ?>" class="text-dark-50 mb-1 font-size-lg"><?= mb_strimwidth($Title, 0,20, "..."); ?></a>
												<span class="text-muted d-block"><?= " By ".$ConsumerFName;?></span>
											</td>
											<td></td>
											<td class="text-left">
												<span class="d-block font-size-lg text-dark-50"><?= date_format($Date_start,"d M, H:i")." "; ?></span>
												<span class="text-muted d-block font-size-sm">Time</span>
											</td>
											<td class="text-right pr-0">
												<a href="index.php?page=eventdetail&id=<?= $event_id; ?>" target="_blank">
													<span class="svg-icon svg-icon-md">
														<!--begin::Svg Icon | path:assets/media/svg/icons/Navigation/Arrow-right.svg-->
														<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
															<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
																<polygon points="0 0 24 0 24 24 0 24" />
																<rect fill="#000000" opacity="0.3" transform="translate(12.000000, 12.000000) rotate(-90.000000) translate(-12.000000, -12.000000)" x="11" y="5" width="2" height="14" rx="1" />
																<path d="M9.70710318,15.7071045 C9.31657888,16.0976288 8.68341391,16.0976288 8.29288961,15.7071045 C7.90236532,15.3165802 7.90236532,14.6834152 8.29288961,14.2928909 L14.2928896,8.29289093 C14.6714686,7.914312 15.281055,7.90106637 15.675721,8.26284357 L21.675721,13.7628436 C22.08284,14.136036 22.1103429,14.7686034 21.7371505,15.1757223 C21.3639581,15.5828413 20.7313908,15.6103443 20.3242718,15.2371519 L15.0300721,10.3841355 L9.70710318,15.7071045 Z" fill="#000000" fill-rule="nonzero" transform="translate(14.999999, 11.999997) scale(1, -1) rotate(90.000000) translate(-14.999999, -11.999997)" />
															</g>
														</svg>
														<!--end::Svg Icon-->
													</span>
												</a>
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
					<!--end::Tap panel-->
				</div>
			</div>
			<!--end::Body-->
			<div class="text-center mx-5 mb-5"><a href="index.php?page=event" class="btn btn-light btn-hover-success btn-sm btn-block">See more event</a></div>
		</div>
		<!--end::List Widget 3-->
	</div>
	<div class="col-lg-6 col-xxl-4 order-1 order-xxl-1">
		<!--begin::List Widget 4-->
		<div class="card card-custom card-stretch gutter-b">
			<!--begin::Header-->
			<div class="card-header border-0 pt-7">
				<h3 class="nav-link text-dark-50">Latest News</h3>
				<ul class="nav nav-success nav-pills nav-pills-sm">
					<li class="nav-item">
						<a class="nav-link" data-toggle="tab" href="#kt_tab_pane_10_1"><?= $_SESSION["loggeduser_ACCESS"]; ?></a>
					</li>
					<li class="nav-item">
						<a class="nav-link active" data-toggle="tab" href="#kt_tab_pane_10_2">PUBLIC</a>
					</li>
				</ul>
			</div>
			<!--end::Header-->
			<div class="separator separator-solid"></div>
			<!--begin::Body-->
			<div class="card-body d-flex flex-column">
				<div class="tab-content" id="myTabTables10">
					<!--begin::Tap pane-->
					<div class="tab-pane fade" id="kt_tab_pane_10_1" role="tabpanel" aria-labelledby="kt_tab_pane_10_1">
						<!--begin::Table-->
						<div>
							<table class="table table-borderless table-vertical-center">
								<!--begin::Thead-->
								<thead>
									<tr>
										<th class="p-0 w-100 min-w-100px"></th>
										<th class="p-0"></th>
										<th class="p-0 min-w-130px w-100"></th>
									</tr>
								</thead>
								<!--end::Thead-->
								<!--begin::Tbody-->
								<?php
								$filter = ['School_id'=>$_SESSION["loggeduser_school_id"],'Access'=>$_SESSION["loggeduser_ACCESS"]];
								$option = ['limit'=>5,'sort' => ['Date' => -1]];
								$query = new MongoDB\Driver\Query($filter,$option);
								$cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.News',$query);
								foreach ($cursor as $document)
								{
									$news_id = strval($document->_id);
									$Staff_id = $document->Staff_id;
									$Title = $document->Title;
									$Details = $document->Details;
									$Date = strval($document->Date);
									$Status = $document->Status;
									$Access = $document->Access;

									$Date = new MongoDB\BSON\UTCDateTime($Date);
									$Date = $Date->toDateTime()->setTimezone(new \DateTimeZone(date_default_timezone_get()));
								
									$filter = ['_id' => new \MongoDB\BSON\ObjectId($Staff_id)];
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
												<a href="index.php?page=newsdetail&id=<?= $news_id; ?>" class="text-dark-50 mb-1 font-size-lg"><?= mb_strimwidth($Title, 0,20, "..."); ?></a>
												<span class="text-muted d-block"><?= " By ".$ConsumerFName;?></span>
											</td>
											<td></td>
											<td class="text-left">
												<span class="d-block font-size-lg text-dark-50"><?= date_format($Date,"d M, H:i")." "; ?></span>
												<span class="text-muted d-block font-size-sm">Time</span>
											</td>
											<td class="text-right pr-0">
												<a href="index.php?page=newsdetail&id=<?= $news_id; ?>">
													<span class="svg-icon svg-icon-md svg-icon-dark-50">
														<!--begin::Svg Icon | path:assets/media/svg/icons/Navigation/Arrow-right.svg-->
														<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
															<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
																<polygon points="0 0 24 0 24 24 0 24" />
																<rect fill="#000000" opacity="0.3" transform="translate(12.000000, 12.000000) rotate(-90.000000) translate(-12.000000, -12.000000)" x="11" y="5" width="2" height="14" rx="1" />
																<path d="M9.70710318,15.7071045 C9.31657888,16.0976288 8.68341391,16.0976288 8.29288961,15.7071045 C7.90236532,15.3165802 7.90236532,14.6834152 8.29288961,14.2928909 L14.2928896,8.29289093 C14.6714686,7.914312 15.281055,7.90106637 15.675721,8.26284357 L21.675721,13.7628436 C22.08284,14.136036 22.1103429,14.7686034 21.7371505,15.1757223 C21.3639581,15.5828413 20.7313908,15.6103443 20.3242718,15.2371519 L15.0300721,10.3841355 L9.70710318,15.7071045 Z" fill="#000000" fill-rule="nonzero" transform="translate(14.999999, 11.999997) scale(1, -1) rotate(90.000000) translate(-14.999999, -11.999997)" />
															</g>
														</svg>
														<!--end::Svg Icon-->
													</span>
												</a>
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
					<div class="tab-pane fade show active" id="kt_tab_pane_10_2" role="tabpanel" aria-labelledby="kt_tab_pane_10_2">
						<!--begin::Table-->
						<div>
							<table class="table table-borderless table-vertical-center">
								<!--begin::Thead-->
								<thead>
									<tr>
										<th class="p-0 w-100 min-w-100px"></th>
										<th class="p-0"></th>
										<th class="p-0 min-w-130px w-100"></th>
									</tr>
								</thead>
								<!--end::Thead-->
								<!--begin::Tbody-->
								<?php
								$filter = ['School_id'=>$_SESSION["loggeduser_school_id"],'Access'=>'PUBLIC'];
								$option = ['limit'=>5,'sort' => ['Date' => -1]];
								$query = new MongoDB\Driver\Query($filter,$option);
								$cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.News',$query);
								foreach ($cursor as $document)
								{
									$news_id = strval($document->_id);
									$Staff_id = $document->Staff_id;
									$Title = $document->Title;
									$Details = $document->Details;
									$Date = strval($document->Date);
									$Status = $document->Status;
									$Access = $document->Access;

									$Date = new MongoDB\BSON\UTCDateTime($Date);
									$Date = $Date->toDateTime()->setTimezone(new \DateTimeZone(date_default_timezone_get()));
								
									$filter = ['_id' => new \MongoDB\BSON\ObjectId($Staff_id)];
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
												<a href="index.php?page=newsdetail&id=<?= $news_id; ?>" class="text-dark-50 mb-1 font-size-lg"><?= mb_strimwidth($Title, 0,20, "..."); ?></a>
												<span class="text-muted d-block"><?= " By ".$ConsumerFName;?></span>
											</td>
											<td></td>
											<td class="text-left">
												<span class="d-block font-size-lg text-dark-50"><?= date_format($Date,"d M, H:i")." "; ?></span>
												<span class="text-muted d-block font-size-sm">Time</span>
											</td>
											<td class="text-right pr-0">
												<a href="index.php?page=newsdetail&id=<?= $news_id; ?>">
													<span class="svg-icon svg-icon-md svg-icon-dark-50">
														<!--begin::Svg Icon | path:assets/media/svg/icons/Navigation/Arrow-right.svg-->
														<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
															<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
																<polygon points="0 0 24 0 24 24 0 24" />
																<rect fill="#000000" opacity="0.3" transform="translate(12.000000, 12.000000) rotate(-90.000000) translate(-12.000000, -12.000000)" x="11" y="5" width="2" height="14" rx="1" />
																<path d="M9.70710318,15.7071045 C9.31657888,16.0976288 8.68341391,16.0976288 8.29288961,15.7071045 C7.90236532,15.3165802 7.90236532,14.6834152 8.29288961,14.2928909 L14.2928896,8.29289093 C14.6714686,7.914312 15.281055,7.90106637 15.675721,8.26284357 L21.675721,13.7628436 C22.08284,14.136036 22.1103429,14.7686034 21.7371505,15.1757223 C21.3639581,15.5828413 20.7313908,15.6103443 20.3242718,15.2371519 L15.0300721,10.3841355 L9.70710318,15.7071045 Z" fill="#000000" fill-rule="nonzero" transform="translate(14.999999, 11.999997) scale(1, -1) rotate(90.000000) translate(-14.999999, -11.999997)" />
															</g>
														</svg>
														<!--end::Svg Icon-->
													</span>
												</a>
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
			<div class="text-center mx-5 mb-5"><a href="index.php?page=news" class="btn btn-light btn-hover-success btn-sm btn-block">See more news</a></div>
		</div>
		<!--end:List Widget 4-->
	</div>
	<div class="col-lg-12 col-xxl-4 order-1 order-xxl-1">
		<!--begin::List Widget 8-->
		<div class="card card-custom card-stretch gutter-b">
			<!--begin::Header-->
			<div class="card-header border-0 pt-7">
				<h3 class="text-dark-50">Latest Forums</h3>
				<ul class="nav nav-success nav-pills nav-pills-sm">
					<li class="nav-item">
						<a class="nav-link" data-toggle="tab" href="#kt_tab_pane_10_5"><?= $_SESSION["loggeduser_ACCESS"]; ?></a>
					</li>
					<li class="nav-item">
						<a class="nav-link active" data-toggle="tab" href="#kt_tab_pane_10_6">PUBLIC</a>
					</li>
				</ul>
			</div>
			<!--end::Header-->
			<div class="separator separator-solid"></div>
			<!--begin::Body-->
			<div class="card-body d-flex flex-column">
				<div class="tab-content" id="myTabTables10">
					<!--begin::Tap pane-->
					<div class="tab-pane fade" id="kt_tab_pane_10_5" role="tabpanel" aria-labelledby="kt_tab_pane_10_5">
						<!--begin::Table-->
						<div>
							<table class="table table-borderless table-vertical-center">
								<!--begin::Thead-->
								<thead>
									<tr>
										<th class="p-0 w-100 min-w-100px"></th>
										<th class="p-0"></th>
										<th class="p-0 min-w-130px w-100"></th>
									</tr>
								</thead>
								<!--end::Thead-->
								<!--begin::Tbody-->
								<?php
								$filter = ['School_id'=>$_SESSION["loggeduser_school_id"],'Forum'=>'1','Forum'=>'2','Forum'=>'3'];
								$option = ['limit'=>10,'sort' => ['_id' => -1]];
								$query = new MongoDB\Driver\Query($filter,$option);
								$cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Forum',$query);
								foreach ($cursor as $document)
								{
									$forum_id = strval($document->_id);
									$Consumer_id = $document->Consumer_id;
									$Forum = $document->Forum;
									$Title = $document->Title;
									$Date = strval($document->Date);
									$Date = new MongoDB\BSON\UTCDateTime($Date);
									$Date = $Date->toDateTime()->setTimezone(new \DateTimeZone(date_default_timezone_get()));
								
									if($Forum == '1')
									{
										$topic = 'General';
									}
									elseif($Forum == '2')
									{
										$topic = 'Proposal';
									}
									elseif($Forum == '3')
									{
										$topic = 'Short News / Info';
									}
									$filter = ['_id' => new \MongoDB\BSON\ObjectId($Consumer_id)];
									$query = new MongoDB\Driver\Query($filter);
									$cursor = $GoNGetzDatabase->executeQuery('GoNGetz.Consumer',$query);
									foreach ($cursor as $document)
									{
										$ConsumerFName = $document->ConsumerFName;
									}
									?>
									<tbody>
										<tr>
											<td class="pl-0">
												<a href="index.php?page=forumdetail&forum=<?= $Forum; ?>&topic=<?= $topic; ?>&id=<?= $forum_id; ?>" class="text-dark-50 mb-1 font-size-lg"><?= mb_strimwidth($Title, 0,20, "..."); ?></a>
												<span class="text-muted d-block"><?= " By ".$ConsumerFName;?></span>
											</td>
											<td></td>
											<td class="text-left">
												<span class="d-block font-size-lg text-dark-50"><?= date_format($Date,"d M, H:i")." "; ?></span>
												<span class="text-muted d-block font-size-sm">Time</span>
											</td>
											<td class="text-right pr-0">
												<a href="index.php?page=forumdetail&forum=<?= $Forum; ?>&topic=<?= $topic; ?>&id=<?= $forum_id; ?>">
													<span class="svg-icon svg-icon-md svg-icon-primary">
														<!--begin::Svg Icon | path:assets/media/svg/icons/Navigation/Arrow-right.svg-->
														<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
															<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
																<polygon points="0 0 24 0 24 24 0 24" />
																<rect fill="#000000" opacity="0.3" transform="translate(12.000000, 12.000000) rotate(-90.000000) translate(-12.000000, -12.000000)" x="11" y="5" width="2" height="14" rx="1" />
																<path d="M9.70710318,15.7071045 C9.31657888,16.0976288 8.68341391,16.0976288 8.29288961,15.7071045 C7.90236532,15.3165802 7.90236532,14.6834152 8.29288961,14.2928909 L14.2928896,8.29289093 C14.6714686,7.914312 15.281055,7.90106637 15.675721,8.26284357 L21.675721,13.7628436 C22.08284,14.136036 22.1103429,14.7686034 21.7371505,15.1757223 C21.3639581,15.5828413 20.7313908,15.6103443 20.3242718,15.2371519 L15.0300721,10.3841355 L9.70710318,15.7071045 Z" fill="#000000" fill-rule="nonzero" transform="translate(14.999999, 11.999997) scale(1, -1) rotate(90.000000) translate(-14.999999, -11.999997)" />
															</g>
														</svg>
														<!--end::Svg Icon-->
													</span>
												</a>
											</td>
										</tr>
									</tbody>
									<?php
								}
								?>
							</table>
						</div>
						<!--end::Table-->
					</div>
					<!--end::Tap pane-->
					<!--begin::Tap pane-->
					<div class="tab-pane fade show active" id="kt_tab_pane_10_6" role="tabpanel" aria-labelledby="kt_tab_pane_10_6">
						<!--begin::Table-->
						<div>
							<table class="table table-borderless table-vertical-center">
								<!--begin::Thead-->
								<thead>
									<tr>
										<th class="p-0 w-100 min-w-100px"></th>
										<th class="p-0"></th>
										<th class="p-0 min-w-130px w-100"></th>
									</tr>
								</thead>
								<!--end::Thead-->
								<!--begin::Tbody-->
								<?php
								$filter = ['School_id'=>$_SESSION["loggeduser_school_id"],'Forum'=>'4','Forum'=>'5','Forum'=>'6'];
								$option = ['limit'=>10,'sort' => ['_id' => -1]];
								$query = new MongoDB\Driver\Query($filter,$option);
								$cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Forum',$query);
								foreach ($cursor as $document)
								{
									$forum_id = strval($document->_id);
									$Consumer_id = $document->Consumer_id;
									$Forum = $document->Forum;
									$Title = $document->Title;
									$Date = strval($document->Date);
									$Date = new MongoDB\BSON\UTCDateTime($Date);
									$Date = $Date->toDateTime()->setTimezone(new \DateTimeZone(date_default_timezone_get()));
								
									if($Forum == '4')
									{
										$topic = 'General';
									}
									elseif($Forum == '5')
									{
										$topic = 'Proposal';
									}
									elseif($Forum == '6')
									{
										$topic = 'Short News / Info';
									}
									$filter = ['_id' => new \MongoDB\BSON\ObjectId($Consumer_id)];
									$query = new MongoDB\Driver\Query($filter);
									$cursor = $GoNGetzDatabase->executeQuery('GoNGetz.Consumer',$query);
									foreach ($cursor as $document)
									{
										$ConsumerFName = $document->ConsumerFName;
									}
									?>
									<tbody>
										<tr>
											<td class="pl-0">
												<a href="index.php?page=forumdetail&forum=<?= $Forum; ?>&topic=<?= $topic; ?>&id=<?= $forum_id; ?>" class="text-dark-50 mb-1 font-size-lg"><?= mb_strimwidth($Title, 0,20, "..."); ?></a>
												<span class="text-muted d-block"><?= " By ".$ConsumerFName;?></span>
											</td>
											<td></td>
											<td class="text-left">
												<span class="d-block font-size-lg text-dark-50"><?= date_format($Date,"d M, H:i")." "; ?></span>
												<span class="text-muted d-block font-size-sm">Time</span>
											</td>
											<td class="text-right pr-0">
												<a href="index.php?page=forumdetail&forum=<?= $Forum; ?>&topic=<?= $topic; ?>&id=<?= $forum_id; ?>">
													<span class="svg-icon svg-icon-md">
														<!--begin::Svg Icon | path:assets/media/svg/icons/Navigation/Arrow-right.svg-->
														<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
															<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
																<polygon points="0 0 24 0 24 24 0 24" />
																<rect fill="#000000" opacity="0.3" transform="translate(12.000000, 12.000000) rotate(-90.000000) translate(-12.000000, -12.000000)" x="11" y="5" width="2" height="14" rx="1" />
																<path d="M9.70710318,15.7071045 C9.31657888,16.0976288 8.68341391,16.0976288 8.29288961,15.7071045 C7.90236532,15.3165802 7.90236532,14.6834152 8.29288961,14.2928909 L14.2928896,8.29289093 C14.6714686,7.914312 15.281055,7.90106637 15.675721,8.26284357 L21.675721,13.7628436 C22.08284,14.136036 22.1103429,14.7686034 21.7371505,15.1757223 C21.3639581,15.5828413 20.7313908,15.6103443 20.3242718,15.2371519 L15.0300721,10.3841355 L9.70710318,15.7071045 Z" fill="#000000" fill-rule="nonzero" transform="translate(14.999999, 11.999997) scale(1, -1) rotate(90.000000) translate(-14.999999, -11.999997)" />
															</g>
														</svg>
														<!--end::Svg Icon-->
													</span>
												</a>
											</td>
										</tr>
									</tbody>
									<?php
								}
								?>
							</table>
						</div>
						<!--end::Table-->
					</div>
					<!--end::Tap pane-->
				</div>
			</div>
			<!--end::Body-->
			<div class="text-center mx-5 mb-5"><a href="index.php?page=schoolforum&forum=1&topic=General" class="btn btn-light btn-hover-success btn-sm btn-block">See More forums</a></div>
		</div>
		<!--end::List Widget 8-->
	</div>
	<!-- <div class="col-lg-6 col-xxl-4 order-1 order-xxl-2">
		<div class="card card-custom card-stretch gutter-b">
			<div class="card-body pt-8"></div>
		</div>
	</div>
	<div class="col-xxl-8 order-2 order-xxl-2">
		<div class="card card-custom card-stretch gutter-b">
			<div class="card-body pt-8">
			</div>
		</div>
	</div> -->
</div>
<!--end::Row-->
<!--begin::Row-->
<div class="row">
	<div class="col-lg-4">
		<!--begin::Mixed Widget 14-->
		<div class="card card-custom card-stretch gutter-b">
			<!--begin::Body-->
			<div class="card-body d-flex flex-column">
				<div class="text-center text-dark-50">
					<h1>Coming Soon!</h1>
					<h5>We are working hard to give you a better experience.</h5>
					<p id="uc__description">
						Features
						<span class="svg-icon svg-icon-1x">
							<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
								<g  stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
									<rect x="0" y="0" width="24" height="24"/>
									<path d="M12.6571817,10 L12.6571817,5.67013288 C12.6571817,5.25591932 12.3213953,4.92013288 11.9071817,4.92013288 C11.7234961,4.92013288 11.5461972,4.98754181 11.4089088,5.10957589 L4.25168161,11.4715556 C3.94209454,11.7467441 3.91420899,12.2207984 4.1893975,12.5303855 C4.19915701,12.541365 4.209237,12.5520553 4.21962441,12.5624427 L11.3768516,19.7196699 C11.6697448,20.0125631 12.1446186,20.0125631 12.4375118,19.7196699 C12.5781641,19.5790176 12.6571817,19.3882522 12.6571817,19.1893398 L12.6571817,15 C14.004369,14.9188289 16.83481,14.9157978 21.1485046,14.9909069 L21.1485051,14.9908794 C21.4245904,14.9956866 21.6522988,14.7757721 21.6571059,14.4996868 C21.6571564,14.4967857 21.6571817,14.4938842 21.6571817,14.4909827 L21.6572352,10.5050185 C21.6572352,10.2288465 21.4333536,10.0049649 21.1571817,10.0049649 C21.1555649,10.0049649 21.1539481,10.0049728 21.1523314,10.0049884 C16.0215539,10.0547574 13.1898373,10.0530946 12.6571817,10 Z" fill="#000000" fill-rule="nonzero" transform="translate(12.828591, 12.429736) scale(-1, 1) translate(-12.828591, -12.429736) "/>
								</g>
							</svg>
						</span>
						User Activity<br>We promise, it will be worth the wait!
					</p>
				</div>
			</div>
			<!--end::Body-->
			<div class="text-center m-3">
				<img src="assets/media/bg/construction2.png" class="img-fluid" alt="...">
			</div>
		</div>
		<!--end::Mixed Widget 14-->
	</div>
	<div class="col-lg-8">
		<!--begin::Advance Table Widget 4-->
		<div class="card card-custom card-stretch gutter-b">
			<!--begin::Body-->
			<div class="card-body d-flex flex-column">
				<div class="text-center text-dark-50">
					<h1>Coming Soon!</h1>
					<h5>We are working hard to give you a better experience.</h5>
					<p id="uc__description">
						Features
						<span class="svg-icon svg-icon-1x">
							<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
								<g  stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
									<rect x="0" y="0" width="24" height="24"/>
									<path d="M12.6571817,10 L12.6571817,5.67013288 C12.6571817,5.25591932 12.3213953,4.92013288 11.9071817,4.92013288 C11.7234961,4.92013288 11.5461972,4.98754181 11.4089088,5.10957589 L4.25168161,11.4715556 C3.94209454,11.7467441 3.91420899,12.2207984 4.1893975,12.5303855 C4.19915701,12.541365 4.209237,12.5520553 4.21962441,12.5624427 L11.3768516,19.7196699 C11.6697448,20.0125631 12.1446186,20.0125631 12.4375118,19.7196699 C12.5781641,19.5790176 12.6571817,19.3882522 12.6571817,19.1893398 L12.6571817,15 C14.004369,14.9188289 16.83481,14.9157978 21.1485046,14.9909069 L21.1485051,14.9908794 C21.4245904,14.9956866 21.6522988,14.7757721 21.6571059,14.4996868 C21.6571564,14.4967857 21.6571817,14.4938842 21.6571817,14.4909827 L21.6572352,10.5050185 C21.6572352,10.2288465 21.4333536,10.0049649 21.1571817,10.0049649 C21.1555649,10.0049649 21.1539481,10.0049728 21.1523314,10.0049884 C16.0215539,10.0547574 13.1898373,10.0530946 12.6571817,10 Z" fill="#000000" fill-rule="nonzero" transform="translate(12.828591, 12.429736) scale(-1, 1) translate(-12.828591, -12.429736) "/>
								</g>
							</svg>
						</span>
						Library<br>We promise, it will be worth the wait!
					</p>
				</div>
			</div>
			<!--end::Body-->
			<div class="text-center m-3">
				<img src="assets/media/bg/construction2.png" class="img-fluid" alt="...">
			</div>
		</div>
		<!--end::Advance Table Widget 4-->
	</div>
</div>
<!--end::Row-->
<!--end::Dashboard-->
