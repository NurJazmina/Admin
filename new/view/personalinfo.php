<?php include ('model/aboutme.php'); ?>
<?php
  $id = new \MongoDB\BSON\ObjectId($_SESSION["loggeduser_id"]);
  $filter = ['_id'=>$id];
  $query = new MongoDB\Driver\Query($filter);
  $cursor = $GoNGetzDatabase->executeQuery('GoNGetz.Consumer',$query);
  foreach ($cursor as $document){
    $_SESSION["staffremarkid"] = strval($document->_id);
    $ConsumerFName = ($document->ConsumerFName);
    $ConsumerLName = ($document->ConsumerLName);
    $ConsumerIDType = ($document->ConsumerIDType);
    $ConsumerIDNo = ($document->ConsumerIDNo);
    $ConsumerEmail = ($document->ConsumerEmail);
    $ConsumerPhone = ($document->ConsumerPhone);
    $ConsumerAddress = ($document->ConsumerAddress);
    $ConsumerStatus = ($document->ConsumerStatus);
  }
?>
<!--begin::Entry-->
<div class="d-flex flex-column-fluid">
							<!--begin::Container-->
							<div class="container">
								<!--begin::Profile Personal Information-->
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
																		<span class="navi-text">Group</span>
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
														<span class="font-weight-bolder font-size-h5 text-dark-75"><?php echo $ConsumerFName; echo " "; echo $ConsumerLName; ?></span>
														<div class="text-muted"><?php echo $ConsumerStatus; ?></div>
														<div class="mt-2">
															<a href="#" class="btn btn-sm btn-primary font-weight-bold mr-2 py-2 px-3 px-xxl-5 my-1">Chat</a>
															<a href="#" class="btn btn-sm btn-success font-weight-bold py-2 px-3 px-xxl-5 my-1">Follow</a>
														</div>
													</div>
												</div>
												<!--end::User-->
												<!--begin::Contact-->
												<div class="py-9">
													<div class="d-flex align-items-center justify-content-between mb-4">
														<span class="font-weight-bold mr-2">ID Type:</span>
														<span class="text-muted text-hover-primary"><?php echo $ConsumerIDType; ?></span>
													</div>
													<div class="d-flex align-items-center justify-content-between mb-4">
														<span class="font-weight-bold mr-2">ID Number:</span>
														<span class="text-muted"><?php echo $ConsumerIDNo; ?></span>
													</div>
													<div class="d-flex align-items-center justify-content-between mb-4">
														<span class="font-weight-bold mr-2">Email:</span>
														<span class="text-muted"><?php echo $ConsumerEmail; ?></span>
													</div>
                                                    <div class="d-flex align-items-center justify-content-between mb-4">
														<span class="font-weight-bold mr-2">Phone Number:</span>
														<span class="text-muted"><?php echo $ConsumerPhone; ?></span>
													</div>
                                                    <div class="d-flex align-items-center justify-content-between mb-4">
														<span class="font-weight-bold mr-2">Address:</span>
														<span class="text-muted"><?php echo $ConsumerAddress; ?></span>
													</div>
												</div>
												<!--end::Contact-->
											</div>
											<!--end::Body-->
										</div>
										<!--end::Profile Card-->
									</div>
									<!--end::Aside-->
									<!--begin::Content-->
									<div class="flex-row-fluid ml-lg-8">
										<!--begin::Card-->
										<div class="card card-custom card-stretch">
											<!--begin::Header-->
											<div class="card-header py-3">
												<div class="card-title align-items-start flex-column">
													<h3 class="card-label font-weight-bolder text-dark">Personal Information</h3>
													<span class="text-muted font-weight-bold font-size-sm mt-1">Update your personal informaiton</span>
												</div>
												<div class="card-toolbar">
													<button type="reset" class="btn btn-success mr-2">Save Changes</button>
													<button type="reset" class="btn btn-secondary">Cancel</button>
												</div>
											</div>
											<!--end::Header-->
											<!--begin::Form-->
											<form class="form">
												<!--begin::Body-->
												<div class="card-body">
													<div class="row">
														<label class="col-xl-3"></label>
														<div class="col-lg-9 col-xl-6">
															<h5 class="font-weight-bold mb-6">Customer Info</h5>
														</div>
													</div>
													<div class="form-group row">
														<label class="col-xl-3 col-lg-3 col-form-label">Avatar</label>
														<div class="col-lg-9 col-xl-6">
                                                        <div class="image-input image-input-empty image-input-outline" id="kt_image_5" style="background-image: url(assets/media/users/blank.png)">
                                                        <div class="image-input-wrapper"></div>

                                                        <label class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="change" data-toggle="tooltip" title="" data-original-title="Change avatar">
                                                        <i class="fa fa-pen icon-sm text-muted"></i>
                                                        <input type="file" name="profile_avatar" accept=".png, .jpg, .jpeg"/>
                                                        <input type="hidden" name="profile_avatar_remove"/>
                                                        </label>

                                                        <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="cancel" data-toggle="tooltip" title="Cancel avatar">
                                                        <i class="ki ki-bold-close icon-xs text-muted"></i>
                                                        </span>

                                                        <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="remove" data-toggle="tooltip" title="Remove avatar">
                                                        <i class="ki ki-bold-close icon-xs text-muted"></i>
                                                        </span>
                                                        </div>
															<span class="form-text text-muted">Allowed file types: png, jpg, jpeg.</span>
														</div>
													</div>
													<div class="form-group row">
														<label class="col-xl-3 col-lg-3 col-form-label">First Name</label>
														<div class="col-lg-9 col-xl-6">
															<input class="form-control form-control-lg form-control-solid" type="text" value="<?php echo $ConsumerFName; ?>"/>
														</div>
													</div>
													<div class="form-group row">
														<label class="col-xl-3 col-lg-3 col-form-label">Last Name</label>
														<div class="col-lg-9 col-xl-6">
															<input class="form-control form-control-lg form-control-solid" type="text" value="<?php echo $ConsumerLName; ?>"/>
														</div>
													</div>
													<div class="form-group row">
														<label class="col-xl-3 col-lg-3 col-form-label">Home address</label>
														<div class="col-lg-9 col-xl-6">
															<input class="form-control form-control-lg form-control-solid" type="text" value="<?php echo $ConsumerAddress; ?>"/>
															<span class="form-text text-muted"></span>
														</div>
													</div>
													<div class="row">
														<label class="col-xl-3"></label>
														<div class="col-lg-9 col-xl-6">
															<h5 class="font-weight-bold mt-10 mb-6">Contact Info</h5>
														</div>
													</div>
													<div class="form-group row">
														<label class="col-xl-3 col-lg-3 col-form-label">Contact Phone</label>
														<div class="col-lg-9 col-xl-6">
															<div class="input-group input-group-lg input-group-solid">
																<div class="input-group-prepend">
																	<span class="input-group-text">
																		<i class="la la-phone"></i>
																	</span>
																</div>
																<input type="text" class="form-control form-control-lg form-control-solid" placeholder="Phone"/>
															</div>
															<span class="form-text text-muted">We'll never share your email with anyone else.</span>
														</div>
													</div>
													<div class="form-group row">
														<label class="col-xl-3 col-lg-3 col-form-label">Email Address</label>
														<div class="col-lg-9 col-xl-6">
															<div class="input-group input-group-lg input-group-solid">
																<div class="input-group-prepend">
																	<span class="input-group-text">
																		<i class="la la-at"></i>
																	</span>
																</div>
																<input type="text" class="form-control form-control-lg form-control-solid" placeholder="Email"/>
															</div>
														</div>
													</div>
													<div class="form-group row">
														<label class="col-xl-3 col-lg-3 col-form-label">Company Site</label>
														<div class="col-lg-9 col-xl-6">
															<div class="input-group input-group-lg input-group-solid">
																<input type="text" class="form-control form-control-lg form-control-solid" placeholder="Username"/>
																<div class="input-group-append">
																	<span class="input-group-text">.com</span>
																</div>
															</div>
														</div>
													</div>
												</div>
												<!--end::Body-->
											</form>
											<!--end::Form-->
										</div>
									</div>
									<!--end::Content-->
								</div>
								<!--end::Profile Personal Information-->
							</div>
							<!--end::Container-->
						</div>
						<!--end::Entry-->