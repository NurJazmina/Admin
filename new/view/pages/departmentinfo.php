<?php
$_SESSION["title"] = "Profile";
?>
<?php include 'view/partials/_subheader/subheader-v1.php'; ?>

<!--begin::Entry-->
<div class="d-flex flex-column-fluid">
	<!--begin::Container-->
	<div class="container">
		<!--begin::Profile Account Information-->
		<div class="d-flex flex-row">
			<!--begin::Aside-->
			<div class="flex-row-auto offcanvas-mobile w-250px w-xxl-350px" id="kt_profile_aside">
                <!--begin::Profile Card-->
                <div class="card card-custom card-stretch">
                    <!--begin::Body-->
                    <div class="card-body pt-4">
                        <!--begin::Toolbar-->
                        <div class="d-flex justify-content-end">
                            <div class="dropdown dropdown-inline">
                                <a href="#" class="btn btn-clean btn-hover-light-primary btn-sm btn-icon" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="ki ki-bold-more-hor"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
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
                        <!--end::Toolbar-->
                        <!--begin::User-->
                        <div class="d-flex align-items-center">
                            <div class="symbol symbol-60 symbol-xxl-100 mr-5 align-self-start align-self-xxl-center">
                                <div class="symbol-label" style="background-image:url('assets/media/users/300_21.jpg')"></div>
                                <i class="symbol-badge bg-success"></i>
                            </div>
                            <div>
                                <a href="#" class="font-weight-bolder font-size-h5 text-dark-75 text-hover-primary"><?php echo $_SESSION["loggeduser_consumerFName"]." ".$_SESSION["loggeduser_consumerLName"] ?></a>
                                <div class="text-muted"><?php echo $_SESSION["loggeduser_DepartmentName"]; ?></div>
                                <div class="mt-2">
                                    <a href="#" class="btn btn-sm btn-primary font-weight-bold mr-2 py-2 px-3 px-xxl-5 my-1">Chat</a>
                                    <a href="#" class="btn btn-sm btn-success font-weight-bold py-2 px-3 px-xxl-5 my-1">Follow</a>
                                </div>
                            </div>
                        </div>
                        <!--end::User-->
                        <!--begin::Contact-->
                        <div class="py-9">
						    <div class="d-flex align-items-center justify-content-between mb-2">
                                <span class="font-weight-bold mr-2">ID Type:</span>
								<a href="#" class="text-muted text-hover-primary"><?php echo $_SESSION["loggeduser_consumerIDType"]; ?></a>
                            </div>
                            <div class="d-flex align-items-center justify-content-between mb-2">
                                <span class="font-weight-bold mr-2">Email:</span>
                                <a href="#" class="text-muted text-hover-primary"><?php echo $_SESSION["loggeduser_consumerEmail"]; ?></a>
                            </div>
                            <div class="d-flex align-items-center justify-content-between mb-2">
                                <span class="font-weight-bold mr-2">Phone:</span>
								<a href="#" class="text-muted text-hover-primary"><?php echo $_SESSION["loggeduser_consumerPhone"]; ?></a>
                            </div>
                            <div class="d-flex align-items-center justify-content-between mb-2">
                                <span class="font-weight-bold mr-2">Location:</span>
								<a href="#" class="text-muted text-hover-primary"><?php echo $_SESSION["loggeduser_consumerCity"].",".$_SESSION["loggeduser_consumerState"]; ?></a>
                            </div>
                            <div class="d-flex align-items-center justify-content-between mb-2">
                                <span class="font-weight-bold mr-2">Status:</span>
								<a href="#" class="text-muted text-hover-primary"><?php echo $_SESSION["loggeduser_consumerStatus"]; ?></a>
                            </div>
                        </div>
                        <!--end::Contact-->
                        <!--begin::Nav-->
                        <div class="navi navi-bold navi-hover navi-active navi-link-rounded">
                            <div class="navi-item mb-2">
                                <a href="index.php?page=profile" class="navi-link py-4 active">
                                    <span class="navi-icon mr-2">
                                        <span class="svg-icon">
                                            <!--begin::Svg Icon | path:assets/media/svg/icons/Design/Layers.svg-->
                                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                    <polygon points="0 0 24 0 24 24 0 24"></polygon>
                                                    <path d="M12.9336061,16.072447 L19.36,10.9564761 L19.5181585,10.8312381 C20.1676248,10.3169571 20.2772143,9.3735535 19.7629333,8.72408713 C19.6917232,8.63415859 19.6104327,8.55269514 19.5206557,8.48129411 L12.9336854,3.24257445 C12.3871201,2.80788259 11.6128799,2.80788259 11.0663146,3.24257445 L4.47482784,8.48488609 C3.82645598,9.00054628 3.71887192,9.94418071 4.23453211,10.5925526 C4.30500305,10.6811601 4.38527899,10.7615046 4.47382636,10.8320511 L4.63,10.9564761 L11.0659024,16.0730648 C11.6126744,16.5077525 12.3871218,16.5074963 12.9336061,16.072447 Z" fill="#000000" fill-rule="nonzero"></path>
                                                    <path d="M11.0563554,18.6706981 L5.33593024,14.122919 C4.94553994,13.8125559 4.37746707,13.8774308 4.06710397,14.2678211 C4.06471678,14.2708238 4.06234874,14.2738418 4.06,14.2768747 L4.06,14.2768747 C3.75257288,14.6738539 3.82516916,15.244888 4.22214834,15.5523151 C4.22358765,15.5534297 4.2250303,15.55454 4.22647627,15.555646 L11.0872776,20.8031356 C11.6250734,21.2144692 12.371757,21.2145375 12.909628,20.8033023 L19.7677785,15.559828 C20.1693192,15.2528257 20.2459576,14.6784381 19.9389553,14.2768974 C19.9376429,14.2751809 19.9363245,14.2734691 19.935,14.2717619 L19.935,14.2717619 C19.6266937,13.8743807 19.0546209,13.8021712 18.6572397,14.1104775 C18.654352,14.112718 18.6514778,14.1149757 18.6486172,14.1172508 L12.9235044,18.6705218 C12.377022,19.1051477 11.6029199,19.1052208 11.0563554,18.6706981 Z" fill="#000000" opacity="0.3"></path>
                                                </g>
                                            </svg>
                                            <!--end::Svg Icon-->
                                        </span>
                                    </span>
                                    <span class="navi-text font-size-lg">Profile Overview</span>
                                </a>
                            </div>
                            <div class="navi-item mb-2">
                                <a href="index.php?page=personal-information" class="navi-link py-4">
                                    <span class="navi-icon mr-2">
                                        <span class="svg-icon">
                                            <!--begin::Svg Icon | path:assets/media/svg/icons/General/User.svg-->
                                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                    <polygon points="0 0 24 0 24 24 0 24"></polygon>
                                                    <path d="M12,11 C9.790861,11 8,9.209139 8,7 C8,4.790861 9.790861,3 12,3 C14.209139,3 16,4.790861 16,7 C16,9.209139 14.209139,11 12,11 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"></path>
                                                    <path d="M3.00065168,20.1992055 C3.38825852,15.4265159 7.26191235,13 11.9833413,13 C16.7712164,13 20.7048837,15.2931929 20.9979143,20.2 C21.0095879,20.3954741 20.9979143,21 20.2466999,21 C16.541124,21 11.0347247,21 3.72750223,21 C3.47671215,21 2.97953825,20.45918 3.00065168,20.1992055 Z" fill="#000000" fill-rule="nonzero"></path>
                                                </g>
                                            </svg>
                                            <!--end::Svg Icon-->
                                        </span>
                                    </span>
                                    <span class="navi-text font-size-lg">Personal Information</span>
                                </a>
                            </div>
                            <div class="navi-item mb-2">
                                <a href="index.php?page=change-password" class="navi-link py-4">
                                    <span class="navi-icon mr-2">
                                        <span class="svg-icon">
                                            <!--begin::Svg Icon | path:assets/media/svg/icons/Communication/Shield-user.svg-->
                                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                    <rect x="0" y="0" width="24" height="24"></rect>
                                                    <path d="M4,4 L11.6314229,2.5691082 C11.8750185,2.52343403 12.1249815,2.52343403 12.3685771,2.5691082 L20,4 L20,13.2830094 C20,16.2173861 18.4883464,18.9447835 16,20.5 L12.5299989,22.6687507 C12.2057287,22.8714196 11.7942713,22.8714196 11.4700011,22.6687507 L8,20.5 C5.51165358,18.9447835 4,16.2173861 4,13.2830094 L4,4 Z" fill="#000000" opacity="0.3"></path>
                                                    <path d="M12,11 C10.8954305,11 10,10.1045695 10,9 C10,7.8954305 10.8954305,7 12,7 C13.1045695,7 14,7.8954305 14,9 C14,10.1045695 13.1045695,11 12,11 Z" fill="#000000" opacity="0.3"></path>
                                                    <path d="M7.00036205,16.4995035 C7.21569918,13.5165724 9.36772908,12 11.9907452,12 C14.6506758,12 16.8360465,13.4332455 16.9988413,16.5 C17.0053266,16.6221713 16.9988413,17 16.5815,17 C14.5228466,17 11.463736,17 7.4041679,17 C7.26484009,17 6.98863236,16.6619875 7.00036205,16.4995035 Z" fill="#000000" opacity="0.3"></path>
                                                </g>
                                            </svg>
                                            <!--end::Svg Icon-->
                                        </span>
                                    </span>
                                    <span class="navi-text font-size-lg">Change Password</span>
                                </a>
                            </div>
                            <?php
                            if ($_SESSION["loggeduser_ConsumerGroup_id"] == '601b4cfd97728c027c01f187')
                            {
                                //filter by department::teacher
                                $filter1 = ['StaffLevel'=>$_SESSION["loggeduser_StaffLevel"]];
                                $query1 = new MongoDB\Driver\Query($filter1);
                                $cursor1 = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Staff',$query1);

                                foreach ($cursor1 as $document1)
                                {
                                    $StaffLevel = strval($document1->StaffLevel);
                                    
                                }
                                if ($StaffLevel == '0')
                                {
                                    ?>
                                    <div class="navi-item mb-2">
                                        <a href="index.php?page=classroominfo" class="navi-link py-4" data-toggle="tooltip" title="" data-placement="right" data-bs-original-title="Coming soon...">
                                            <span class="navi-icon mr-2">
                                                <span class="svg-icon">
                                                    <!--begin::Svg Icon | path:assets/media/svg/icons/Files/File.svg-->
                                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                            <polygon points="0 0 24 0 24 24 0 24"></polygon>
                                                            <path d="M5.85714286,2 L13.7364114,2 C14.0910962,2 14.4343066,2.12568431 14.7051108,2.35473959 L19.4686994,6.3839416 C19.8056532,6.66894833 20,7.08787823 20,7.52920201 L20,20.0833333 C20,21.8738751 19.9795521,22 18.1428571,22 L5.85714286,22 C4.02044787,22 4,21.8738751 4,20.0833333 L4,3.91666667 C4,2.12612489 4.02044787,2 5.85714286,2 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"></path>
                                                            <rect fill="#000000" x="6" y="11" width="9" height="2" rx="1"></rect>
                                                            <rect fill="#000000" x="6" y="15" width="5" height="2" rx="1"></rect>
                                                        </g>
                                                    </svg>
                                                    <!--end::Svg Icon-->
                                                </span>
                                            </span>
                                            <span class="navi-text font-size-lg">Classroom Info</span>
                                            <span class="navi-label">
                                                <span class="label label-light-primary label-inline font-weight-bold">new</span>
                                            </span>
                                        </a>
                                    </div>
                                    <?php
                                }
                            }
                                //filter by group::school
                                if ($_SESSION["loggeduser_ConsumerGroup_id"] == '601b4cfd97728c027c01f187')
                                {
                                    ?>
                                        <div class="navi-item mb-2">
                                            <a href="index.php?page=departmentinfo" class="navi-link py-4" data-toggle="tooltip" title="" data-placement="right" data-bs-original-title="Coming soon...">
                                                <span class="navi-icon mr-2">
                                                    <span class="svg-icon">
                                                        <!--begin::Svg Icon | path:assets/media/svg/icons/Text/Article.svg-->
                                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                                <rect x="0" y="0" width="24" height="24"></rect>
                                                                <rect fill="#000000" x="4" y="5" width="16" height="3" rx="1.5"></rect>
                                                                <path d="M5.5,15 L18.5,15 C19.3284271,15 20,15.6715729 20,16.5 C20,17.3284271 19.3284271,18 18.5,18 L5.5,18 C4.67157288,18 4,17.3284271 4,16.5 C4,15.6715729 4.67157288,15 5.5,15 Z M5.5,10 L12.5,10 C13.3284271,10 14,10.6715729 14,11.5 C14,12.3284271 13.3284271,13 12.5,13 L5.5,13 C4.67157288,13 4,12.3284271 4,11.5 C4,10.6715729 4.67157288,10 5.5,10 Z" fill="#000000" opacity="0.3"></path>
                                                            </g>
                                                        </svg>
                                                        <!--end::Svg Icon-->
                                                    </span>
                                                </span>
                                                <span class="navi-text">Department Info</span>
                                                <span class="navi-label">
                                                    <span class="label label-light-danger label-rounded font-weight-bold">5</span>
                                                </span>
                                            </a>
                                        </div>
                                    <?php
                                }
                                ?>
                        </div>
                        <!--end::Nav-->
                    </div>
                    <!--end::Body-->
                </div>
                <!--end::Profile Card-->
			</div>
			<!--end::Aside-->
			<!--begin::Content-->
			<div class="flex-row-fluid ml-lg-8">
			    <?php
				$id = new \MongoDB\BSON\ObjectId($_SESSION["loggeduser_Staffdepartment"]);
				$filter = ['_id'=>$id];
				$query = new MongoDB\Driver\Query($filter);
				$cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.SchoolsDepartment',$query);
				foreach ($cursor as $document)
				{
				$DepartmentName = ($document->DepartmentName);
				}
				?>
				<!--begin::Card-->
				<div class="card card-custom">
					<!--begin::Header-->
					<div class="card-header py-3">
						<div class="card-title align-items-start flex-column">
							<h3 class="card-label font-weight-bolder text-dark">Your Department</h3>
							<span class="text-muted font-weight-bold font-size-sm mt-1"><?php echo $DepartmentName; ?></span>
						</div>
					</div>
					<!--end::Header-->
					<!--begin::Form-->
					<div class="row" >
					<div class="col-md-1 section-1-box wow fadeInUp"></div>
					<div class="col-md-10 section-1-box wow fadeInUp">
						<br><br>
						<div class="card">
						<div class="card-header">
							<strong>Details</strong>
						</div>
						<div class="card-body">
							<div class="row">
							   <div class="col-sm">
								<div class="table-responsive">
								<table class="table table-bordered">
								<thead class="table-light">
								</thead>
								<tbody>
									<tr>
									<th scope="row" class="table-secondary">Department</th>
									<td class="table-secondary"><?php echo $DepartmentName; ?> </td>
									</tr>
									<tr>
									<th scope="row">Staff List </th>
									<td>
									<?php
									$filter = ['SchoolID'=>$_SESSION["loggeduser_schoolID"], 'Staffdepartment'=>$_SESSION["loggeduser_Staffdepartment"]];
									$query = new MongoDB\Driver\Query($filter);
									$cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Staff',$query);
									$totalstaff = 0;
									foreach ($cursor as $document)
									{
										$totalstaff = $totalstaff + 1;
										$ConsumerID = strval($document->ConsumerID);
										$id = new \MongoDB\BSON\ObjectId($ConsumerID);
										$filter1 = ['_id'=>$id];
										$query1 = new MongoDB\Driver\Query($filter1);
										$cursor1 = $GoNGetzDatabase->executeQuery('GoNGetz.Consumer',$query1);
										foreach ($cursor1 as $document1)
										{
										$Consumer_id = ($document1->_id);
										$ConsumerFName = ($document1->ConsumerFName);
										?>
										<a href="index.php?page=staffdetail&id=<?php echo $Consumer_id; ?>" style="color:#076d79; text-decoration: none;">
										<?php
										echo $ConsumerFName."<br>";
										}
									}
									?>
									</td>
									</tr>
									<tr>
									<th scope="row">Number of Staff</th>
									<td><?php echo $totalstaff; ?></td>
									</tr>
								</tbody>
								</table>
								</div>
							</div>
							<div class="col-12 col-lg-6">
								<div class="row">
								<div class="col-12 col-lg-12">
									<div class="card">
									<div class="card-header">
										<strong>Remarks</strong>
									</div>
									<div class="card-body">
										<div class="row">
										<div class="col-12">
										<div class="tab-content" id="v-pills-tabContent">
											<div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
											<div class="box">
												<form name="AddDepartmentRemarkFormSubmit" action="model/adddepartmentremark.php" method="POST">
												<div class="row">
												<div class="col">
													<textarea class="form-control" name="txtdepartmentRemark" rows="3"></textarea>
													<br>
													<div class="row">
														
														<div class="col text-right">
														<input type="hidden" value="<?php echo $_SESSION["loggeduser_Staffdepartment"]; ?>" name="txtdepartmentid">
														<button type="submit" class="btn btn-primary" name="AddDepartmentRemarkFormSubmit">Add remark</button>
														</div>
													</div>
													</div>
												</div>
											</form>
											</div>
											<div class="box">
											<strong></strong>
											<br>
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
												<div class="table-responsive">
													<table class="table table-striped table-sm ">
													<thead>
														<tr>
														<th>Date</th>
														<th>Details</th>
														<th>Staff</th>
														</tr>
													</thead>
													</table>
													<?php
													$filter2 = ['department_id'=>$_SESSION["loggeduser_Staffdepartment"],'SubRemarks'=>'0','departmentRemarksStatus'=>'ACTIVE'];
													$option2 = ['sort' => ['_id' => -1],'limit'=>10];
													$query2 = new MongoDB\Driver\Query($filter2, $option2);
													$cursor2 = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.DepartmentRemarks',$query2);

													foreach ($cursor2 as $document2)
													{
													$_SESSION["departmentparent"] = strval($document2->_id);
													$remarkid1 = strval($document2->_id);
													$remark1 = ($document2->departmentRemarksDetails);
													$remarkdate1 = ($document2->departmentRemarksDate);
													$utcdatetime1 = new MongoDB\BSON\UTCDateTime(strval($remarkdate1));
													$datetime1 = $utcdatetime1->toDateTime()->setTimezone(new \DateTimeZone(date_default_timezone_get()));
													$remarkstaffid1 = ($document2->departmentRemarksStaff_id);
													?>
														<div class="accordion accordion-flush" id="accordionFlushExample">
														<div class="accordion-item" >
														<h6 class="accordion-header" id="flush-headingOne">
															<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
															<tbody>
															<tr>
															<td><?php print_r($datetime1->format('r')); ?></td>
															<td>
																<?php
																$filter1 = ['_id' => new \MongoDB\BSON\ObjectId($remarkstaffid1)];
																$query1 = new MongoDB\Driver\Query($filter1);
																$cursor1 = $GoNGetzDatabase->executeQuery('GoNGetz.Consumer', $query1);
																foreach ($cursor1 as $document1)
																{
																$ConsumerFName = ($document1->ConsumerFName);
																echo $ConsumerFName;
																?>
															</td>
															<td><?php echo $remark1;?></td>
															</tr>
															</tbody>
															</button>
														</h6>
														<div  id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
														<?php 
														$filter4 = ['department_id'=>$_SESSION["loggeduser_Staffdepartment"],'SubRemarks'=>$_SESSION["departmentparent"],'departmentRemarksStatus'=>'ACTIVE'];
														$option4 = ['sort' => ['_id' => -1],'limit'=>10];
														$query4 = new MongoDB\Driver\Query($filter4, $option4);
														$cursor4 = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.DepartmentRemarks',$query4);
														foreach ($cursor4 as $document4)
														{
															$remarkid2 = strval($document4->_id);
															$remark2 = ($document4->departmentRemarksDetails);
															$remarkdate2 = ($document4->departmentRemarksDate);
															$utcdatetime2 = new MongoDB\BSON\UTCDateTime(strval($remarkdate2));
															$datetime2 = $utcdatetime2->toDateTime()->setTimezone(new \DateTimeZone(date_default_timezone_get()));
															$remarkstaffid2 = ($document4->departmentRemarksStaff_id);
															?>
															<div class="accordion-body">
															<tbody>
															<tr>
																<td><?php print_r($datetime2->format('r')); ?></td>
																<td>
																<?php echo $remark2;?>
																</td>
															</tr>
															</tbody>
															</div>
															<?php
															}
															?>
															<form name="AddDepartmentRemarkChildFormSubmit" action="model/adddepartmentremarkchild.php" method="POST">
															<div class="row">
															<div class="col">
																<textarea class="form-control" name="txtconsumerRemark" rows="3"></textarea>
																<div class="row">
																<div class="col text-right">
																	<input type="hidden" value="<?php echo $_GET['id']; ?>" name="txtconsumerid">
																	<input type="hidden" value="<?php echo $remarkid1; ?>" name="txtremarkid">
																	<button type="submit" class="btn btn-primary" name="AddDepartmentRemarkChildFormSubmit">Add remark</button>
																</div>
																</div>
															</div>
															</div>
															</form>
															<button style="float: right;"type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#Updatedepartmentremark" data-bs-whatever="<?php echo $remarkid1; ?>" style="display: flex;  ">update</button>
														</div>
														</div>
														</div>
													<?php
													}
													}
													?>
												</div>
												</div>
												<div class="tab-pane fade show pending" id="pending" role="tabpanel" aria-labelledby="pending-tab">
												<div class="table-responsive">
													<table class="table table-striped table-sm ">
													<thead>
														<tr>
														<th>Date</th>
														<th>Details</th>
														<th>Staff</th>
														</tr>
													</thead>
													</table>
													<?php
													$filter2 = ['department_id'=>$_SESSION["loggeduser_Staffdepartment"],'SubRemarks'=>'0','departmentRemarksStatus'=>'PENDING'];
													$option2 = ['sort' => ['_id' => -1],'limit'=>10];
													$query2 = new MongoDB\Driver\Query($filter2, $option2);
													$cursor2 = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.DepartmentRemarks',$query2);

													foreach ($cursor2 as $document2)
													{
													$_SESSION["departmentparent"] = strval($document2->_id);
													$remarkid1 = strval($document2->_id);
													$remark1 = ($document2->departmentRemarksDetails);
													$remarkdate1 = ($document2->departmentRemarksDate);
													$utcdatetime1 = new MongoDB\BSON\UTCDateTime(strval($remarkdate1));
													$datetime1 = $utcdatetime1->toDateTime()->setTimezone(new \DateTimeZone(date_default_timezone_get()));
													$remarkstaffid1 = ($document2->departmentRemarksStaff_id);
													?>
														<div class="accordion accordion-flush" id="accordionFlushExample">
														<div class="accordion-item" >
														<h6 class="accordion-header" id="flush-headingOne">
															<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
															<tbody>
															<tr>
															<td><?php print_r($datetime1->format('r')); ?></td>
															<td>
																<?php
																$filter1 = ['_id' => new \MongoDB\BSON\ObjectId($remarkstaffid1)];
																$query1 = new MongoDB\Driver\Query($filter1);
																$cursor1 = $GoNGetzDatabase->executeQuery('GoNGetz.Consumer', $query1);
																foreach ($cursor1 as $document1)
																{
																$ConsumerFName = ($document1->ConsumerFName);
																echo $ConsumerFName;
																?>
															</td>
															<td><?php echo $remark1;?></td>
															</tr>
															</tbody>
															</button>
														</h6>
														<div  id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
														<?php 
														$filter4 = ['department_id'=>$_SESSION["loggeduser_Staffdepartment"],'SubRemarks'=>$_SESSION["departmentparent"],'departmentRemarksStatus'=>'PENDING'];
														$option4 = ['sort' => ['_id' => -1],'limit'=>10];
														$query4 = new MongoDB\Driver\Query($filter4, $option4);
														$cursor4 = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.DepartmentRemarks',$query4);
														foreach ($cursor4 as $document4)
														{
															$remarkid2 = strval($document4->_id);
															$remark2 = ($document4->departmentRemarksDetails);
															$remarkdate2 = ($document4->departmentRemarksDate);
															$utcdatetime2 = new MongoDB\BSON\UTCDateTime(strval($remarkdate2));
															$datetime2 = $utcdatetime2->toDateTime()->setTimezone(new \DateTimeZone(date_default_timezone_get()));
															$remarkstaffid2 = ($document4->departmentRemarksStaff_id);
															?>
															<div class="accordion-body">
															<tbody>
															<tr>
																<td><?php print_r($datetime2->format('r')); ?></td>
																<td>
																<?php echo $remark2;?>
																</td>
															</tr>
															</tbody>
															</div>
															<?php
															}
															?>
															<form name="AddDepartmentRemarkChildFormSubmit" action="model/adddepartmentremarkchild.php" method="POST">
															<div class="row">
															<div class="col">
																<textarea class="form-control" name="txtconsumerRemark" rows="3"></textarea>
																<div class="row">
																<div class="col text-right">
																	<input type="hidden" value="<?php echo $_GET['id']; ?>" name="txtconsumerid">
																	<input type="hidden" value="<?php echo $remarkid; ?>" name="txtremarkid">
																	<button type="submit" class="btn btn-primary" name="AddDepartmentRemarkChildFormSubmit">Add remark</button>
																</div>
																</div>
															</div>
															</div>
															</form>
															<button style="float: right;"type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#Updatedepartmentremark" data-bs-whatever="<?php echo $remarkid1; ?>" style="display: flex;  ">update</button>
														</div>
														</div>
														</div>
													<?php
													}
													}
													?>
												</div>
												</div>
												<div class="tab-pane fade show completed" id="completed" role="tabpanel" aria-labelledby="completed-tab">
												<div class="table-responsive">
													<table class="table table-striped table-sm ">
													<thead>
														<tr>
														<th>Date</th>
														<th>Details</th>
														<th>Staff</th>
														</tr>
													</thead>
													</table>
													<?php
													$filter2 = ['department_id'=>$_SESSION["loggeduser_Staffdepartment"],'SubRemarks'=>'0','departmentRemarksStatus'=>'COMPLETED'];
													$option2 = ['sort' => ['_id' => -1],'limit'=>10];
													$query2 = new MongoDB\Driver\Query($filter2, $option2);
													$cursor2 = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.DepartmentRemarks',$query2);

													foreach ($cursor2 as $document2)
													{
													$_SESSION["departmentparent"] = strval($document2->_id);
													$remarkid1 = strval($document2->_id);
													$remark1 = ($document2->departmentRemarksDetails);
													$remarkdate1 = ($document2->departmentRemarksDate);
													$utcdatetime1 = new MongoDB\BSON\UTCDateTime(strval($remarkdate1));
													$datetime1 = $utcdatetime1->toDateTime()->setTimezone(new \DateTimeZone(date_default_timezone_get()));
													$remarkstaffid1 = ($document2->departmentRemarksStaff_id);
													?>
														<div class="accordion accordion-flush" id="accordionFlushExample">
														<div class="accordion-item" >
														<h6 class="accordion-header" id="flush-headingOne">
															<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
															<tbody>
															<tr>
															<td><?php print_r($datetime1->format('r')); ?></td>
															<td>
																<?php
																$filter1 = ['_id' => new \MongoDB\BSON\ObjectId($remarkstaffid1)];
																$query1 = new MongoDB\Driver\Query($filter1);
																$cursor1 = $GoNGetzDatabase->executeQuery('GoNGetz.Consumer', $query1);
																foreach ($cursor1 as $document1)
																{
																$ConsumerFName = ($document1->ConsumerFName);
																echo $ConsumerFName;
																?>
															</td>
															<td><?php echo $remark1;?></td>
															</tr>
															</tbody>
															</button>
														</h6>
														<div  id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
														<?php 
														$filter4 = ['department_id'=>$_SESSION["loggeduser_Staffdepartment"],'SubRemarks'=>$_SESSION["departmentparent"],'departmentRemarksStatus'=>'COMPLETED'];
														$option4 = ['sort' => ['_id' => -1],'limit'=>10];
														$query4 = new MongoDB\Driver\Query($filter4, $option4);
														$cursor4 = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.DepartmentRemarks',$query4);
														foreach ($cursor4 as $document4)
														{
															$remarkid2 = strval($document4->_id);
															$remark2 = ($document4->departmentRemarksDetails);
															$remarkdate2 = ($document4->departmentRemarksDate);
															$utcdatetime2 = new MongoDB\BSON\UTCDateTime(strval($remarkdate2));
															$datetime2 = $utcdatetime2->toDateTime()->setTimezone(new \DateTimeZone(date_default_timezone_get()));
															$remarkstaffid2 = ($document4->departmentRemarksStaff_id);
															?>
															<div class="accordion-body">
															<tbody>
															<tr>
																<td><?php print_r($datetime2->format('r')); ?></td>
																<td>
																<?php echo $remark2;?>
																</td>
															</tr>
															</tbody>
															</div>
															<?php
															}
															?>
															<form name="AddDepartmentRemarkChildFormSubmit" action="model/adddepartmentremarkchild.php" method="POST">
															<div class="row">
															<div class="col">
																<textarea class="form-control" name="txtconsumerRemark" rows="3"></textarea>
																<div class="row">
																<div class="col text-right">
																	<input type="hidden" value="<?php echo $_GET['id']; ?>" name="txtconsumerid">
																	<input type="hidden" value="<?php echo $remarkid; ?>" name="txtremarkid">
																	<button type="submit" class="btn btn-primary" name="AddDepartmentRemarkChildFormSubmit">Add remark</button>
																</div>
																</div>
															</div>
															</div>
															</form>
															<button style="float: right;"type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#Updatedepartmentremark" data-bs-whatever="<?php echo $remarkid1; ?>" style="display: flex;  ">update</button>
														</div>
														</div>
														</div>
													<?php
													}
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
								</div>
							</div>
							</div>
							</div>
							<div class="w-100"></div>
							<div class="col-sm">
							<div class="row">
								<div class="col-12 col-lg-12">
								<div class="card">
									<div class="card-header">
									<strong>Attendance</strong>
									</div>
									<div class="card-body">
									<div class="row">
										<div class="col-sm-12">
										<table id="attendance" class="table table-bordered ">
										<thead class="table-light">
											<tr>
											<th scope="col" style="color:#696969; text-align:center">Staff ID</th>
											<th scope="col" style="color:#696969; text-align:center">Staff Name</th>
											<th scope="col" style="color:#696969; text-align:center">Date</th>
											<th scope="col" style="color:#696969; text-align:center">IN</th>
											<th scope="col" style="color:#696969; text-align:center">OUT</th>
											</tr>
										</thead>
										<tbody>
										<?php
										$filter = ['SchoolID'=>$_SESSION["loggeduser_schoolID"],'Staffdepartment'=>$_SESSION["loggeduser_Staffdepartment"]];
										$query = new MongoDB\Driver\Query($filter);
										$cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Staff',$query);
										foreach ($cursor as $document)
										{
										$ConsumerID = strval($document->ConsumerID);

										$filter = ['_id'=>new \MongoDB\BSON\ObjectId($ConsumerID)];
										$query = new MongoDB\Driver\Query($filter);
										$cursor = $GoNGetzDatabase->executeQuery('GoNGetz.Consumer',$query);
										foreach ($cursor as $document)
										{
										$_SESSION["staffremarkid"] = strval($document->_id);
										$ConsumerFName = ($document->ConsumerFName);
										$ConsumerLName = ($document->ConsumerLName);
										$ConsumerIDNo = ($document->ConsumerIDNo);
										$consumerid = strval($document->_id);
										$varnow = date("d-m-Y");
										?>
										<tr>
											<td class="default"><?php echo $ConsumerIDNo; ?></td>
											<td class="default"><?php echo $ConsumerFName." ".$ConsumerLName; ?></td>
										<?php
										$Cards_id ='';
										$filter1 = ['Consumer_id'=>$consumerid];
										$query1 = new MongoDB\Driver\Query($filter1);
										$cursor1 = $GoNGetzDatabase->executeQuery('GoNGetz.Cards',$query1);
										foreach ($cursor1 as $document1)
										{
										$Cards_id = strval($document1->Cards_id);
										}
										$varnow = date("d-m-Y");
										$today = new MongoDB\BSON\UTCDateTime((new DateTime($varnow))->getTimestamp()*1000);
										?>
										<td class="default"><?php echo $varnow."<br>"; ?></td>
										<td class="default"><?php
										$varcounting = 0;
										$filterA = ['CardID'=>$Cards_id ,'AttendanceDate' => ['$gte' => $today]];
										$optionA = ['sort' => ['_id' => 1]];
										$queryA = new MongoDB\Driver\Query($filterA,$optionA);
										$cursorA = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Attendance',$queryA);
										foreach ($cursorA as $documentA)
										{
											$AttendanceDate = ($documentA->AttendanceDate);
											$utcdatetime = new MongoDB\BSON\UTCDateTime(strval($AttendanceDate));
											$AttendanceDate = $utcdatetime->toDateTime()->setTimezone(new \DateTimeZone(date_default_timezone_get()));
											$varcounting = $varcounting +1;
										if ($varcounting % 2)
										{
										echo date_format($AttendanceDate,"H:i:s")."<br>";
										} 
										else
										{
										}
										}
										?></td>
										<td class="default"><?php
										$varcounting = 0;
										$filterA = ['CardID'=>$Cards_id ,'AttendanceDate' => ['$gte' => $today]];
										$optionA = ['sort' => ['_id' => 1]];
										$queryA = new MongoDB\Driver\Query($filterA,$optionA);
										$cursorA = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Attendance',$queryA);
										foreach ($cursorA as $documentA)
										{
											$AttendanceDate = ($documentA->AttendanceDate);
											$utcdatetime = new MongoDB\BSON\UTCDateTime(strval($AttendanceDate));
											$AttendanceDate = $utcdatetime->toDateTime()->setTimezone(new \DateTimeZone(date_default_timezone_get()));
											$varcounting = $varcounting +1;

										if ($varcounting % 2)
										{
										} 
										else
										{
											echo date_format($AttendanceDate,"H:i:s")."<br>";
										}
										}
										?></td>
										</tr>
										<?php
										}
									}
								?>
								</tbody>
									</table>
									<button type="button" style="font-size:15px width:25%" class="btn btn-success"><a href="index.php?page=departmentdetail&id=<?php echo $_GET['id']; ?>&attendance=<?php echo "xls"; ?>" tabindex="-1" data-type="alpha" style="color:#FFFFFF; text-decoration: none;">EXPORT ATTENDANCE TO XLS</a></button>
								<?php
								if (!isset($_GET['attendance']) && empty($_GET['attendance']))
								{

								}
								else
								{
								$attendance = ($_GET['attendance']);
								?>
								<script>
									$(document).ready(function () {
									$("#attendance").table2excel({
										filename: "attendancedepartment.xls"
									});
									});
									
								</script>
								<?php
								}
								?>
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
					</div>
					<div class="col-md-1 section-1-box wow fadeInUp"></div>
					</div>
					</div>
					<!--end::Form-->
				</div>
				<!--end::Card-->
			</div>
			<!--end::Content-->
		</div>
		<!--end::Profile Account Information-->
	</div>
	<!--end::Container-->
</div>
<!--end::Entry-->
<?php include ('view/pages/modal-updatedepartmentremark.php'); ?>