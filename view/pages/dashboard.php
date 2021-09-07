<?php
$_SESSION["title"] = "Dashboard";
include 'view/partials/_subheader/subheader-v1.php';
include ('model/home.php'); 

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
<style>
#construction {
    background: linear-gradient(to right, #1BC5BD 50%, #ffffff 50%);
    color: #ffff;
}

#uc__wrapper {
	padding-top: 10%;
	padding-bottom: 10%;
    height: auto;
    display: flex;
    justify-content: space-between;
}

#uc__details {
    flex-basis: 50%;
    display: flex;
    flex-direction: column;
    padding: 0 2rem;
    align-items: flex-start;
    justify-content: center;
}

#uc__art {
    display: flex;
    align-items: center;
    justify-content: center;
}
</style>
        <!--begin::Dashboard-->
        <!--begin::Row-->
        <div class="row">
            <div class="col-lg-6 col-xxl-4">
                <!--begin::Mixed Widget 1-->
                <div class="card card-custom bg-gray-100 card-stretch gutter-b">
                    <!--begin::Body-->
                    <div class="card-body p-0 position-relative overflow-hidden">
                    </div>
                    <!--end::Body-->
                </div>
                <!--end::Mixed Widget 1-->
            </div>
            <div class="col-lg-6 col-xxl-4">
                <!--begin::List Widget 9-->
                <div class="card card-custom card-stretch gutter-b">
                    <!--begin::Body-->
                    <div class="card-body pt-4">
                    </div>
                    <!--end: Card Body-->
                </div>
                <!--end: List Widget 9-->
            </div>
            <div class="col-lg-6 col-xxl-4">
                <!--begin::Stats Widget 11-->
                <div class="card card-custom card-stretch card-stretch-half gutter-b">
                    <!--begin::Body-->
                    <div class="card-body p-0">
                    </div>
                    <!--end::Body-->
                </div>
                <!--end::Stats Widget 11-->
                <!--begin::Stats Widget 12-->
                <div class="card card-custom card-stretch card-stretch-half gutter-b">
                    <!--begin::Body-->
                    <div class="card-body p-0">
                    </div>
                    <!--end::Body-->
                </div>
                <!--end::Stats Widget 12-->
            </div>
            <div class="col-lg-6 col-xxl-4 order-1 order-xxl-1">
                <!--begin::List Widget 1-->
                <div class="card card-custom card-stretch gutter-b">
                    <!--begin::Body-->
                    <div class="card-body pt-8">
                    </div>
                    <!--end::Body-->
                </div>
                <!--end::List Widget 1-->
            </div>
            <div class="col-xxl-8 order-2 order-xxl-1">
                <!--begin::Advance Table Widget 2-->
                <div class="card card-custom card-stretch gutter-b">
                    <!--begin::Header-->
                    <div class="card-header border-0 pt-5">
                    </div>
                    <!--end::Body-->
                </div>
                <!--end::Advance Table Widget 2-->
            </div>
            <div class="col-lg-6 col-xxl-4 order-1 order-xxl-2">
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
					<div class="text-center m-3"><a href="index.php?page=event" class="btn btn-light btn-sm btn-block">See more event</a></div>
                </div>
                <!--end::List Widget 3-->
            </div>
            <div class="col-lg-6 col-xxl-4 order-1 order-xxl-2">
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
					<div class="text-center m-3"><a href="index.php?page=news" class="btn btn-light btn-sm btn-block">See more news</a></div>
                </div>
                <!--end:List Widget 4-->
            </div>
            <div class="col-lg-12 col-xxl-4 order-1 order-xxl-2">
                <!--begin::List Widget 8-->
                <div class="card card-custom card-stretch gutter-b">
					<!--begin::Header-->
					<div class="card-header border-0 pt-7">
						<h3 class="text-dark-50">Latest News</h3>
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
					<div class="text-center m-3"><a href="index.php?page=schoolforum&forum=1&topic=General" class="btn btn-light btn-sm btn-block">See More forums</a></div>
                </div>
                <!--end: Card-->
                <!--end::List Widget 8-->
            </div>
        </div>
        <!--end::Row-->
        <!--begin::Row-->
        <div class="row">
            <div class="col-lg-4">
                <!--begin::Mixed Widget 14-->
                <div class="card card-custom card-stretch gutter-b">
                    <!--begin::Body-->
                    <div class="card-body d-flex flex-column">
                    </div>
                    <!--end::Body-->
                </div>
                <!--end::Mixed Widget 14-->
            </div>
            <div class="col-lg-8">
                <!--begin::Advance Table Widget 4-->
                <div class="card card-custom card-stretch gutter-b">
                </div>
                <!--end::Advance Table Widget 4-->
            </div>
        </div>
        <!--end::Row-->
        <!--end::Dashboard-->
