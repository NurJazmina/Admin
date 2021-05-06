<?php
$_SESSION["title"] = "Dashboard";
include 'view/partials/_subheader/subheader-v1.php';
include ('model/home.php'); 
?>
<!--begin::Entry-->
<div class="d-flex flex-column-fluid">
	<!--begin::Container-->
	<div class="flex-container">
		<!--begin::Education-->
		<div class="d-flex flex-column flex-md-row">
			<!--begin::Content-->
			<div class="flex-md-row-fluid ">
				<div class="row">
					<div class="col-xxl-4">
						<div class="card card-custom gutter-b">
							<!--begin::Body-->
							<div class="card-body">
								<!--begin::Wrapper-->
								<div class="d-flex justify-content-between flex-column h-100">
									<!--begin::Container-->
									<div class="h-100">
										<!--begin::Header-->
										<div class="d-flex flex-column flex-center">
											<!--begin::Image-->
											<div class="bgi-no-repeat bgi-size-cover rounded min-h-180px w-100" style="background-image: url(assets/media/stock-600x400/img-70.jpg)"></div>
											<!--end::Image-->
											<!--begin::Title-->
											<a href="#" class="card-title font-weight-bolder text-dark-75 text-hover-primary font-size-h4 m-0 pt-7 pb-1"><?php echo $_SESSION["loggeduser_schoolName"]; ?></a>
											<!--end::Title-->
											<!--begin::Text-->
											<div class="font-weight-bold text-dark-50 font-size-sm pb-7"><?php echo $_SESSION["loggeduser_schoolsAddress"]; ?></div>
											<!--end::Text-->
										</div>
										<!--end::Header-->
										<!--begin::Body-->
										<div class="pt-1">
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
												<span class="font-weight-bolder label label-xl label-light-primary label-inline py-5 min-w-45px"><?php echo $_SESSION["totalstudent"] ?></span>
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
										<!--end::Body-->
									</div>
									<!--eng::Container-->
									<!--begin::Footer-->
									<div class="d-flex flex-center" id="kt_sticky_toolbar_chat_toggler_2" data-toggle="tooltip" title="" data-placement="right" data-original-title="Chat Example">
										<button class="btn btn-success font-weight-bolder font-size-sm py-3 px-14" data-toggle="modal" data-target="#kt_chat_modal">Contact School</button>
									</div>
									<!--end::Footer-->
								</div>
								<!--end::Wrapper-->
							</div>
							<!--end::Body-->
					    </div>
					</div>
				    <div class="col-xxl-4">
						<!--begin::List Widget 17-->
						<div class="card card-custom gutter-b">
							<!--begin::Header-->
							<div class="card-header border-0 pt-5">
								<h3 class="card-title align-items-start flex-column">
									<span class="card-label font-weight-bolder text-dark">Books to Pickup</span>
									<span class="text-muted mt-3 font-weight-bold font-size-sm">24 Books to Return</span>
								</h3>
								<div class="card-toolbar">
									<div class="dropdown dropdown-inline" data-toggle="tooltip" title="Quick actions" data-placement="left">
										<a href="#" class="btn btn-clean btn-hover-light-primary btn-sm btn-icon" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
											<i class="ki ki-bold-more-hor"></i>
										</a>
										<div class="dropdown-menu dropdown-menu-md dropdown-menu-right">
											<!--begin::Navigation-->
											<ul class="navi navi-hover py-5">
												<li class="navi-item">
													<a href="#" class="navi-link">
														<span class="navi-icon">
															<i class="flaticon2-drop"></i>
														</span>
														<span class="navi-text">New Group</span>
													</a>
												</li>
												<li class="navi-item">
													<a href="#" class="navi-link">
														<span class="navi-icon">
															<i class="flaticon2-list-3"></i>
														</span>
														<span class="navi-text">Contacts</span>
													</a>
												</li>
												<li class="navi-item">
													<a href="#" class="navi-link">
														<span class="navi-icon">
															<i class="flaticon2-rocket-1"></i>
														</span>
														<span class="navi-text">Groups</span>
														<span class="navi-link-badge">
															<span class="label label-light-primary label-inline font-weight-bold">new</span>
														</span>
													</a>
												</li>
												<li class="navi-item">
													<a href="#" class="navi-link">
														<span class="navi-icon">
															<i class="flaticon2-bell-2"></i>
														</span>
														<span class="navi-text">Calls</span>
													</a>
												</li>
												<li class="navi-item">
													<a href="#" class="navi-link">
														<span class="navi-icon">
															<i class="flaticon2-gear"></i>
														</span>
														<span class="navi-text">Settings</span>
													</a>
												</li>
												<li class="navi-separator my-3"></li>
												<li class="navi-item">
													<a href="#" class="navi-link">
														<span class="navi-icon">
															<i class="flaticon2-magnifier-tool"></i>
														</span>
														<span class="navi-text">Help</span>
													</a>
												</li>
												<li class="navi-item">
													<a href="#" class="navi-link">
														<span class="navi-icon">
															<i class="flaticon2-bell-2"></i>
														</span>
														<span class="navi-text">Privacy</span>
														<span class="navi-link-badge">
															<span class="label label-light-danger label-rounded font-weight-bold">5</span>
														</span>
													</a>
												</li>
											</ul>
											<!--end::Navigation-->
										</div>
									</div>
								</div>
							</div>
							<!--end::Header-->
							<!--begin::Body-->
							<div class="card-body pt-4">
								<!--begin::Container-->
								<div>
									<!--begin::Item-->
									<div class="d-flex align-items-center mb-8">
										<!--begin::Symbol-->
										<div class="symbol mr-5 pt-1">
											<div class="symbol-label min-w-65px min-h-100px" style="background-image: url('assets/media/books/4.png')"></div>
										</div>
										<!--end::Symbol-->
										<!--begin::Info-->
										<div class="d-flex flex-column">
											<!--begin::Title-->
											<a href="#" class="text-dark-75 font-weight-bolder text-hover-primary font-size-lg">Darius The Great</a>
											<!--end::Title-->
											<!--begin::Text-->
											<span class="text-muted font-weight-bold font-size-sm pb-4">Amazing Short Story About
											<br />Darius greatness</span>
											<!--end::Text-->
											<!--begin::Action-->
											<div>
												<button type="button" class="btn btn-light font-weight-bolder font-size-sm py-2">Book Now</button>
											</div>
											<!--end::Action-->
										</div>
										<!--end::Info-->
									</div>
									<!--end::Item-->
									<!--begin::Item-->
									<div class="d-flex align-items-center mb-8">
										<!--begin::Symbol-->
										<div class="symbol mr-5 pt-1">
											<div class="symbol-label min-w-65px min-h-100px" style="background-image: url('assets/media/books/12.png')"></div>
										</div>
										<!--end::Symbol-->
										<!--begin::Info-->
										<div class="d-flex flex-column">
											<!--begin::Title-->
											<a href="#" class="text-dark-75 font-weight-bolder text-hover-primary font-size-lg">Wild Blues</a>
											<!--end::Title-->
											<!--begin::Text-->
											<span class="text-muted font-weight-bold font-size-sm pb-4">Amazing Short Story About
											<br />Darius greatness</span>
											<!--end::Text-->
											<!--begin::Action-->
											<div>
												<button type="button" class="btn btn-light font-weight-bolder font-size-sm py-2">Book Now</button>
											</div>
											<!--end::Action-->
										</div>
										<!--end::Info-->
									</div>
									<!--end::Item-->
									<!--begin::Item-->
									<div class="d-flex align-items-center">
										<!--begin::Symbol-->
										<div class="symbol mr-5 pt-1">
											<div class="symbol-label min-w-65px min-h-100px" style="background-image: url('assets/media/books/13.png')"></div>
										</div>
										<!--end::Symbol-->
										<!--begin::Info-->
										<div class="d-flex flex-column">
											<!--begin::Title-->
											<a href="#" class="text-dark-75 font-weight-bolder text-hover-primary font-size-lg">Simple Thinking</a>
											<!--end::Title-->
											<!--begin::Text-->
											<span class="text-muted font-weight-bold font-size-sm pb-4">Amazing Short Story About
											<br />Darius greatness</span>
											<!--end::Text-->
											<!--begin::Action-->
											<div>
												<button type="button" class="btn btn-light font-weight-bolder font-size-sm py-2">Book Now</button>
											</div>
											<!--end::Action-->
										</div>
										<!--end::Info-->
									</div>
									<!--end::Item-->
								</div>
								<!--end::Container-->
							</div>
							<!--end::Body-->
						</div>
						<!--end::List Widget 17-->
						<!--begin::List Widget 9-->
						<div class="card card-custom gutter-b">
							<div class="card-header align-items-center border-0 mt-4">
								<h3 class="card-title align-items-start flex-column">
									<span class="font-weight-bolder text-dark">My Activity</span>
									<span class="text-muted mt-3 font-weight-bold font-size-sm">890,344 Sales</span>
								</h3>
								<div class="card-toolbar">
									<div class="dropdown dropdown-inline">
										<a href="#" class="btn btn-clean btn-hover-light-primary btn-sm btn-icon" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
											<i class="ki ki-bold-more-hor"></i>
										</a>
										<div class="dropdown-menu dropdown-menu-md dropdown-menu-right">
											<!--begin::Navigation-->
											<ul class="navi navi-hover">
												<li class="navi-header font-weight-bold py-4">
													<span class="font-size-lg">Choose Label:</span>
													<i class="flaticon2-information icon-md text-muted" data-toggle="tooltip" data-placement="right" title="Click to learn more..."></i>
												</li>
												<li class="navi-separator mb-3 opacity-70"></li>
												<li class="navi-item">
													<a href="#" class="navi-link">
														<span class="navi-text">
															<span class="label label-xl label-inline label-light-success">Customer</span>
														</span>
													</a>
												</li>
												<li class="navi-item">
													<a href="#" class="navi-link">
														<span class="navi-text">
															<span class="label label-xl label-inline label-light-danger">Partner</span>
														</span>
													</a>
												</li>
												<li class="navi-item">
													<a href="#" class="navi-link">
														<span class="navi-text">
															<span class="label label-xl label-inline label-light-warning">Suplier</span>
														</span>
													</a>
												</li>
												<li class="navi-item">
													<a href="#" class="navi-link">
														<span class="navi-text">
															<span class="label label-xl label-inline label-light-primary">Member</span>
														</span>
													</a>
												</li>
												<li class="navi-item">
													<a href="#" class="navi-link">
														<span class="navi-text">
															<span class="label label-xl label-inline label-light-dark">Staff</span>
														</span>
													</a>
												</li>
												<li class="navi-separator mt-3 opacity-70"></li>
												<li class="navi-footer py-4">
													<a class="btn btn-clean font-weight-bold btn-sm" href="#">
													<i class="ki ki-plus icon-sm"></i>Add new</a>
												</li>
											</ul>
											<!--end::Navigation-->
										</div>
									</div>
								</div>
							</div>
							<div class="card-body pt-4">
								<!--begin::Timeline-->
								<div class="timeline timeline-6 mt-3">
									<!--begin::Item-->
									<div class="timeline-item align-items-start">
										<!--begin::Label-->
										<div class="timeline-label font-weight-bolder text-dark-75 font-size-lg">08:42</div>
										<!--end::Label-->
										<!--begin::Badge-->
										<div class="timeline-badge">
											<i class="fa fa-genderless text-warning icon-xl"></i>
										</div>
										<!--end::Badge-->
										<!--begin::Text-->
										<div class="font-weight-mormal font-size-lg timeline-content text-muted pl-3">Outlines keep you honest. And keep structure</div>
										<!--end::Text-->
									</div>
									<!--end::Item-->
									<!--begin::Item-->
									<div class="timeline-item align-items-start">
										<!--begin::Label-->
										<div class="timeline-label font-weight-bolder text-dark-75 font-size-lg">10:00</div>
										<!--end::Label-->
										<!--begin::Badge-->
										<div class="timeline-badge">
											<i class="fa fa-genderless text-success icon-xl"></i>
										</div>
										<!--end::Badge-->
										<!--begin::Content-->
										<div class="timeline-content d-flex">
											<span class="font-weight-bolder text-dark-75 pl-3 font-size-lg">AEOL meeting</span>
										</div>
										<!--end::Content-->
									</div>
									<!--end::Item-->
									<!--begin::Item-->
									<div class="timeline-item align-items-start">
										<!--begin::Label-->
										<div class="timeline-label font-weight-bolder text-dark-75 font-size-lg">14:37</div>
										<!--end::Label-->
										<!--begin::Badge-->
										<div class="timeline-badge">
											<i class="fa fa-genderless text-danger icon-xl"></i>
										</div>
										<!--end::Badge-->
										<!--begin::Desc-->
										<div class="timeline-content font-weight-bolder font-size-lg text-dark-75 pl-3">Make deposit
										<a href="#" class="text-primary">USD 700</a>. to ESL</div>
										<!--end::Desc-->
									</div>
									<!--end::Item-->
									<!--begin::Item-->
									<div class="timeline-item align-items-start">
										<!--begin::Label-->
										<div class="timeline-label font-weight-bolder text-dark-75 font-size-lg">16:50</div>
										<!--end::Label-->
										<!--begin::Badge-->
										<div class="timeline-badge">
											<i class="fa fa-genderless text-primary icon-xl"></i>
										</div>
										<!--end::Badge-->
										<!--begin::Text-->
										<div class="timeline-content font-weight-mormal font-size-lg text-muted pl-3">Indulging in poorly driving and keep structure keep great</div>
										<!--end::Text-->
									</div>
									<!--end::Item-->
									<!--begin::Item-->
									<div class="timeline-item align-items-start">
										<!--begin::Label-->
										<div class="timeline-label font-weight-bolder text-dark-75 font-size-lg">21:03</div>
										<!--end::Label-->
										<!--begin::Badge-->
										<div class="timeline-badge">
											<i class="fa fa-genderless text-danger icon-xl"></i>
										</div>
										<!--end::Badge-->
										<!--begin::Desc-->
										<div class="timeline-content font-weight-bolder text-dark-75 pl-3 font-size-lg">New order placed
										<a href="#" class="text-primary">#XF-2356</a>.</div>
										<!--end::Desc-->
									</div>
									<!--end::Item-->
									<!--begin::Item-->
									<div class="timeline-item align-items-start">
										<!--begin::Label-->
										<div class="timeline-label font-weight-bolder text-dark-75 font-size-lg">23:07</div>
										<!--end::Label-->
										<!--begin::Badge-->
										<div class="timeline-badge">
											<i class="fa fa-genderless text-info icon-xl"></i>
										</div>
										<!--end::Badge-->
										<!--begin::Text-->
										<div class="timeline-content font-weight-mormal font-size-lg text-muted pl-3">Outlines keep and you honest. Indulging in poorly driving</div>
										<!--end::Text-->
									</div>
									<!--end::Item-->
								</div>
								<!--end::Timeline-->
							</div>
						</div>
				        <!--end: List Widget 9-->
					</div>
					<div class="col-xxl-4">
						<!--begin::Base Table Widget 10-->
						<div class="card card-custom gutter-b">
							<!--begin::Header-->
							<div class="card-header border-0 pt-7">
								<h3 class="card-title align-items-start flex-column">
								<span class="card-label font-weight-bolder font-size-h4 text-dark-75">Latest News</span>
								</h3>
								<div class="card-toolbar">
									<ul class="nav nav-light-success nav-pills nav-pills-sm nav-dark-75">
										<li class="nav-item">
											<a class="nav-link py-2 px-4 font-weight-bolder" data-toggle="tab" href="#kt_tab_pane_10_1"><?php echo $_SESSION["loggeduser_DepartmentName"]; ?></a>
										</li>
										<li class="nav-item">
											<a class="nav-link py-2 px-4 active font-weight-bolder" data-toggle="tab" href="#kt_tab_pane_10_2">Public</a>
										</li>
									</ul>
								</div>
							</div>
							<!--end::Header-->
							<!--begin::Body-->
							<div class="card-body pt-1">
								<div class="tab-content mt-5" id="myTabTables10">
									<!--begin::Tap pane-->
									<div class="tab-pane fade" id="kt_tab_pane_10_1" role="tabpanel" aria-labelledby="kt_tab_pane_10_1">
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
												$groupid = new \MongoDB\BSON\ObjectId($_SESSION["loggeduser_ConsumerGroup_id"]);
												$filter2 = ['_id' => $groupid];
												$query2 = new MongoDB\Driver\Query($filter2);
												$cursor2 = $GoNGetzDatabase->executeQuery('GoNGetz.ConsumerGroup', $query2);
												foreach ($cursor2 as $document2)
												{
													$ConsumerGroupName = strval($document2->ConsumerGroupName);
												}
												
												$filterA = ['SchoolNewsAccess'=>$ConsumerGroupName.$_SESSION["loggeduser_StaffLevel"]];
												$optionA = ['limit'=>5,'sort' => ['_id' => -1]];
												$queryA = new MongoDB\Driver\Query($filterA);
												$cursorA = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.SchoolNews',$queryA);
												foreach ($cursorA as $documentA)
												{
													$Newsid = strval($documentA->_id);
													$SchoolNewsStaff_id = ($documentA->SchoolNewsStaff_id);
													$schoolNewsTitle = ($documentA->schoolNewsTitle);
													$schoolNewsDetails = ($documentA->schoolNewsDetails);
													$SchoolNewsDate = ($documentA->SchoolNewsDate);
													$SchoolNewsStatus = ($documentA->SchoolNewsStatus);
													$Access = ($documentA->SchoolNewsAccess);
												
													$id = new \MongoDB\BSON\ObjectId($SchoolNewsStaff_id);
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
													$utcdatetime = new MongoDB\BSON\UTCDateTime(strval($SchoolNewsDate));
													$datetime = $utcdatetime->toDateTime()->setTimezone(new \DateTimeZone(date_default_timezone_get()));
													?>
												<tbody>
													<tr>
														<td class="pl-0 py-5">
														<div class="symbol symbol-45 symbol-light-success mr-2">
															<span class="symbol-label">
																<span class="svg-icon svg-icon-2x svg-icon-success">
																	<!--begin::Svg Icon | path:assets/media/svg/icons/Media/Playlist1.svg-->
																	<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
																		<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
																			<rect x="0" y="0" width="24" height="24"></rect>
																			<path d="M8.97852058,18.8007059 C8.80029331,20.0396328 7.53473012,21 6,21 C4.34314575,21 3,19.8807119 3,18.5 C3,17.1192881 4.34314575,16 6,16 C6.35063542,16 6.68722107,16.0501285 7,16.1422548 L7,5.93171093 C7,5.41893942 7.31978104,4.96566617 7.78944063,4.81271925 L13.5394406,3.05418311 C14.2638626,2.81827161 15,3.38225531 15,4.1731748 C15,4.95474642 15,5.54092513 15,5.93171093 C15,6.51788965 14.4511634,6.89225606 14,7 C13.3508668,7.15502181 11.6842001,7.48835515 9,8 L9,18.5512168 C9,18.6409956 8.9927193,18.7241187 8.97852058,18.8007059 Z" fill="#000000" fill-rule="nonzero"></path>
																			<path d="M16,9 L20,9 C20.5522847,9 21,9.44771525 21,10 C21,10.5522847 20.5522847,11 20,11 L16,11 C15.4477153,11 15,10.5522847 15,10 C15,9.44771525 15.4477153,9 16,9 Z M14,13 L20,13 C20.5522847,13 21,13.4477153 21,14 C21,14.5522847 20.5522847,15 20,15 L14,15 C13.4477153,15 13,14.5522847 13,14 C13,13.4477153 13.4477153,13 14,13 Z M14,17 L20,17 C20.5522847,17 21,17.4477153 21,18 C21,18.5522847 20.5522847,19 20,19 L14,19 C13.4477153,19 13,18.5522847 13,18 C13,17.4477153 13.4477153,17 14,17 Z" fill="#000000" opacity="0.3"></path>
																		</g>
																	</svg>
																	<!--end::Svg Icon-->
																</span>
															</span>
														</div>
														</td>
														<td class="pl-0">
															<a href="index.php?page=newsdetail&id=<?php echo $Newsid; ?>" class="text-dark-75 font-weight-bolder text-hover-primary mb-1 font-size-lg"><?php echo $schoolNewsTitle; ?></a>
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
											<footer>
												<div class="text-center"><a href="index.php?page=news" class="btn btn-success">See more News</a></div><br><br>
											</footer>
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
														<th></th>
														<th></th>
													</tr>
												</thead>
												<!--end::Thead-->
												<!--begin::Tbody-->
												<?php
												$filterA = ['SchoolNewsAccess'=>'PUBLIC'];
												$optionA = ['limit'=>5,'sort' => ['_id' => -1]];
												$queryA = new MongoDB\Driver\Query($filterA);
												$cursorA = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.SchoolNews',$queryA);
												foreach ($cursorA as $documentA)
												{
													$Newsid = strval($documentA->_id);
													$SchoolNewsStaff_id = ($documentA->SchoolNewsStaff_id);
													$schoolNewsTitle = ($documentA->schoolNewsTitle);
													$schoolNewsDetails = ($documentA->schoolNewsDetails);
													$SchoolNewsDate = ($documentA->SchoolNewsDate);
													$SchoolNewsStatus = ($documentA->SchoolNewsStatus);
													$Access = ($documentA->SchoolNewsAccess);
												
													$id = new \MongoDB\BSON\ObjectId($SchoolNewsStaff_id);
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
													$utcdatetime = new MongoDB\BSON\UTCDateTime(strval($SchoolNewsDate));
													$datetime = $utcdatetime->toDateTime()->setTimezone(new \DateTimeZone(date_default_timezone_get()));
													?>
												<tbody>
													<tr>
														<td class="pl-0 py-5">
														<div class="symbol symbol-45 symbol-light-danger mr-2">
															<span class="symbol-label">
																<span class="svg-icon svg-icon-2x svg-icon-danger">
																	<!--begin::Svg Icon | path:assets/media/svg/icons/Layout/Layout-4-blocks.svg-->
																	<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
																		<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
																			<rect x="0" y="0" width="24" height="24"></rect>
																			<rect fill="#000000" x="4" y="4" width="7" height="7" rx="1.5"></rect>
																			<path d="M5.5,13 L9.5,13 C10.3284271,13 11,13.6715729 11,14.5 L11,18.5 C11,19.3284271 10.3284271,20 9.5,20 L5.5,20 C4.67157288,20 4,19.3284271 4,18.5 L4,14.5 C4,13.6715729 4.67157288,13 5.5,13 Z M14.5,4 L18.5,4 C19.3284271,4 20,4.67157288 20,5.5 L20,9.5 C20,10.3284271 19.3284271,11 18.5,11 L14.5,11 C13.6715729,11 13,10.3284271 13,9.5 L13,5.5 C13,4.67157288 13.6715729,4 14.5,4 Z M14.5,13 L18.5,13 C19.3284271,13 20,13.6715729 20,14.5 L20,18.5 C20,19.3284271 19.3284271,20 18.5,20 L14.5,20 C13.6715729,20 13,19.3284271 13,18.5 L13,14.5 C13,13.6715729 13.6715729,13 14.5,13 Z" fill="#000000" opacity="0.3"></path>
																		</g>
																	</svg>
																	<!--end::Svg Icon-->
																</span>
															</span>
														</div>
														</td>
														<td class="pl-0">
															<a href="index.php?page=newsdetail&id=<?php echo $Newsid; ?>" class="text-dark-75 font-weight-bolder text-hover-primary mb-1 font-size-lg"><?php echo $schoolNewsTitle; ?></a>
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
											<footer>
												<div class="text-center"><a href="index.php?page=news" class="btn btn-success">See more News</a></div><br><br>
											</footer>
										</div>
										<!--end::Table-->
									</div>
									<!--end::Tap pane-->
								</div>
							</div>
							<!--end::Body-->
						</div>
						<!--end::Base Table Widget 10-->
						<!--begin::Base Table Widget 10-->
						<div class="card card-custom gutter-b">
							<!--begin::Header-->
							<div class="card-header border-0 pt-7">
								<h3 class="card-title align-items-start flex-column">
									<span class="card-label font-weight-bolder text-dark">Upcoming Events</span>
									<span class="text-muted mt-3 font-weight-bold font-size-sm">Next Event is in
									<span class="text-primary">9 days</span></span>
								</h3>
								<div class="card-toolbar">
									<ul class="nav nav-light-success nav-pills nav-pills-sm nav-dark-75">
										<li class="nav-item">
											<a class="nav-link py-2 px-4 font-weight-bolder" data-toggle="tab" href="#kt_tab_pane_10_3"><?php echo $_SESSION["loggeduser_DepartmentName"]; ?></a>
										</li>
										<li class="nav-item">
											<a class="nav-link py-2 px-4 active font-weight-bolder" data-toggle="tab" href="#kt_tab_pane_10_4">Public</a>
										</li>
									</ul>
								</div>
							</div>
							<!--end::Header-->
							<!--begin::Body-->
							<div class="card-body pt-1">
								<div class="tab-content mt-5" id="myTabTables10">
									<!--begin::Tap pane-->
									<div class="tab-pane fade" id="kt_tab_pane_10_3" role="tabpanel" aria-labelledby="kt_tab_pane_10_3">
										<!--begin::Table-->
										<div>
											<table class="table table-borderless table-vertical-center">
												<!--begin::Thead-->
												<thead>
													<tr>
														<th class="p-0 w-50px"></th>
														<th class="p-0 w-100 min-w-100px"></th>
														<th class="p-0"></th>
														<th class="p-0 min-w-130px w-100"></th>
													</tr>
												</thead>
												<!--end::Thead-->
												<!--begin::Tbody-->
												<?php
												$groupid = new \MongoDB\BSON\ObjectId($_SESSION["loggeduser_ConsumerGroup_id"]);
												$filter2 = ['_id' => $groupid];
												$query2 = new MongoDB\Driver\Query($filter2);
												$cursor2 = $GoNGetzDatabase->executeQuery('GoNGetz.ConsumerGroup', $query2);
												foreach ($cursor2 as $document2)
												{
													$ConsumerGroupName = strval($document2->ConsumerGroupName);
												}
												
												$filterA = ['SchoolEventAccess'=>$ConsumerGroupName.$_SESSION["loggeduser_StaffLevel"]];
												$optionA = ['limit'=>5,'sort' => ['_id' => -1]];
												$queryA = new MongoDB\Driver\Query($filterA);
												$cursorA = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.SchoolEvent',$queryA);
												foreach ($cursorA as $documentA)
												{
													$eventid = strval($documentA->_id);
													$SchoolEventStaff_id = ($documentA->SchoolEventStaff_id);
													$schoolEventTitle = ($documentA->schoolEventTitle);
													$schoolEventVenue = ($documentA->schoolEventVenue);
													$schoolEventLocation = ($documentA->schoolEventLocation);
													$SchoolEventDateStart = ($documentA->SchoolEventDateStart);
													$SchoolEventDateEnd = ($documentA->SchoolEventDateEnd);
													$SchoolEventStatus = ($documentA->SchoolEventStatus);
												
													$utcdatetimeStart = new MongoDB\BSON\UTCDateTime(strval($SchoolEventDateStart));
													$datetimeStart = $utcdatetimeStart->toDateTime()->setTimezone(new \DateTimeZone(date_default_timezone_get()));
													$utcdatetimeEnd = new MongoDB\BSON\UTCDateTime(strval($SchoolEventDateEnd));
													$datetimeEnd = $utcdatetimeEnd->toDateTime()->setTimezone(new \DateTimeZone(date_default_timezone_get()));
												
													$id = new \MongoDB\BSON\ObjectId($SchoolEventStaff_id);
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
														<td class="pl-0 py-5">
															<div class="symbol symbol-45 symbol-light-info mr-2">
																<span class="symbol-label">
																	<span class="svg-icon svg-icon-2x svg-icon-info">
																		<!--begin::Svg Icon | path:assets/media/svg/icons/Design/Color-profile.svg-->
																		<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
																			<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
																				<rect x="0" y="0" width="24" height="24" />
																				<path d="M12,10.9996338 C12.8356605,10.3719448 13.8743941,10 15,10 C17.7614237,10 20,12.2385763 20,15 C20,17.7614237 17.7614237,20 15,20 C13.8743941,20 12.8356605,19.6280552 12,19.0003662 C11.1643395,19.6280552 10.1256059,20 9,20 C6.23857625,20 4,17.7614237 4,15 C4,12.2385763 6.23857625,10 9,10 C10.1256059,10 11.1643395,10.3719448 12,10.9996338 Z M13.3336047,12.504354 C13.757474,13.2388026 14,14.0910788 14,15 C14,15.9088933 13.7574889,16.761145 13.3336438,17.4955783 C13.8188886,17.8206693 14.3938466,18 15,18 C16.6568542,18 18,16.6568542 18,15 C18,13.3431458 16.6568542,12 15,12 C14.3930587,12 13.8175971,12.18044 13.3336047,12.504354 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" />
																				<circle fill="#000000" cx="12" cy="9" r="5" />
																			</g>
																		</svg>
																		<!--end::Svg Icon-->
																	</span>
																</span>
															</div>
														</td>
														<td class="pl-0">
															<a href="index.php?page=eventdetail&id=<?php echo $eventid; ?>" class="text-dark-75 font-weight-bolder text-hover-primary mb-1 font-size-lg"><?php echo $schoolEventTitle; ?></a>
															<span class="text-muted font-weight-bold d-block"><?php echo " By ".$ConsumerFName;?></span>
														</td>
														<td></td>
														<td class="text-left">
														    <span class="text-dark-75 font-weight-bolder d-block font-size-lg"><?php echo date_format($datetimeStart,"d M, H:i")." "; ?></span>
															<span class="text-muted font-weight-bold d-block font-size-sm">Time</span>
														</td>
														<td class="text-right pr-0">
															<a href="index.php?page=eventdetail&id=<?php echo $eventid; ?>" target="_blank" class="btn btn-icon btn-light btn-sm">
																<span class="svg-icon svg-icon-md svg-icon-success">
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
											<footer>
												<div class="text-center"><a href="index.php?page=event" class="btn btn-success">See more Event</a></div><br><br>
											</footer>
										</div>
										<!--end::Table-->
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
														<th class="p-0 w-50px"></th>
														<th class="p-0 w-100 min-w-100px"></th>
														<th class="p-0"></th>
														<th class="p-0 min-w-130px w-100"></th>
													</tr>
												</thead>
												<!--end::Thead-->
												<!--begin::Tbody-->
												<?php
												$groupid = new \MongoDB\BSON\ObjectId($_SESSION["loggeduser_ConsumerGroup_id"]);
												$filter2 = ['_id' => $groupid];
												$query2 = new MongoDB\Driver\Query($filter2);
												$cursor2 = $GoNGetzDatabase->executeQuery('GoNGetz.ConsumerGroup', $query2);
												foreach ($cursor2 as $document2)
												{
													$ConsumerGroupName = strval($document2->ConsumerGroupName);
												}
												
												$filterA = ['SchoolEventAccess'=>'PUBLIC'];
												$optionA = ['limit'=>5,'sort' => ['_id' => -1]];
												$queryA = new MongoDB\Driver\Query($filterA);
												$cursorA = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.SchoolEvent',$queryA);
												foreach ($cursorA as $documentA)
												{
													$eventid = strval($documentA->_id);
													$SchoolEventStaff_id = ($documentA->SchoolEventStaff_id);
													$schoolEventTitle = ($documentA->schoolEventTitle);
													$schoolEventVenue = ($documentA->schoolEventVenue);
													$schoolEventLocation = ($documentA->schoolEventLocation);
													$SchoolEventDateStart = ($documentA->SchoolEventDateStart);
													$SchoolEventDateEnd = ($documentA->SchoolEventDateEnd);
													$SchoolEventStatus = ($documentA->SchoolEventStatus);
												
													$utcdatetimeStart = new MongoDB\BSON\UTCDateTime(strval($SchoolEventDateStart));
													$datetimeStart = $utcdatetimeStart->toDateTime()->setTimezone(new \DateTimeZone(date_default_timezone_get()));
													$utcdatetimeEnd = new MongoDB\BSON\UTCDateTime(strval($SchoolEventDateEnd));
													$datetimeEnd = $utcdatetimeEnd->toDateTime()->setTimezone(new \DateTimeZone(date_default_timezone_get()));
												
													$id = new \MongoDB\BSON\ObjectId($SchoolEventStaff_id);
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
													    <td class="pl-0 py-5">
														<div class="symbol symbol-45 symbol-light-warning mr-2">
															<span class="symbol-label">
																<span class="svg-icon svg-icon-2x svg-icon-warning">
																	<!--begin::Svg Icon | path:assets/media/svg/icons/Home/Library.svg-->
																	<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
																		<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
																			<rect x="0" y="0" width="24" height="24"></rect>
																			<path d="M5,3 L6,3 C6.55228475,3 7,3.44771525 7,4 L7,20 C7,20.5522847 6.55228475,21 6,21 L5,21 C4.44771525,21 4,20.5522847 4,20 L4,4 C4,3.44771525 4.44771525,3 5,3 Z M10,3 L11,3 C11.5522847,3 12,3.44771525 12,4 L12,20 C12,20.5522847 11.5522847,21 11,21 L10,21 C9.44771525,21 9,20.5522847 9,20 L9,4 C9,3.44771525 9.44771525,3 10,3 Z" fill="#000000"></path>
																			<rect fill="#000000" opacity="0.3" transform="translate(17.825568, 11.945519) rotate(-19.000000) translate(-17.825568, -11.945519)" x="16.3255682" y="2.94551858" width="3" height="18" rx="1"></rect>
																		</g>
																	</svg>
																	<!--end::Svg Icon-->
																</span>
															</span>
														</div>
														</td>
														<td class="pl-0">
															<a href="index.php?page=eventdetail&id=<?php echo $eventid; ?>" class="text-dark-75 font-weight-bolder text-hover-primary mb-1 font-size-lg"><?php echo $schoolEventTitle; ?></a>
															<span class="text-muted font-weight-bold d-block"><?php echo " By ".$ConsumerFName;?></span>
														</td>
														<td></td>
														<td class="text-left">
														    <span class="text-dark-75 font-weight-bolder d-block font-size-lg"><?php echo date_format($datetimeStart,"d M, H:i")." "; ?></span>
															<span class="text-muted font-weight-bold d-block font-size-sm">Time</span>
														</td>
														<td class="text-right pr-0">
															<a href="index.php?page=eventdetail&id=<?php echo $eventid; ?>" class="btn btn-icon btn-light btn-sm">
																<span class="svg-icon svg-icon-md svg-icon-success">
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
											<footer>
												<div class="text-center"><a href="index.php?page=event" class="btn btn-success">See more Event</a></div><br><br>
											</footer>
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
			<!--end::Content-->
		</div>
		<!--end::Education-->
	</div>
	<!--end::Container-->
</div>
<!--end::Entry-->
</div>
<!--end::Content-->
