<!--begin::Header-->
<div id="kt_header" class="header header-fixed">
	<!--begin::Container-->
	<div class="container-fluid d-flex align-items-stretch justify-content-between">
		<div></div>
		<!--begin::Topbar-->
		<div class="topbar">
			<!--begin::Notifications-->
			<div class="dropdown">
			</div>
			<!--end::Notifications-->
			<!--begin::User-->
			<div class="dropdown">
				<div class="topbar-item" data-toggle="dropdown" data-offset="0px,0px">
					<div class="btn btn-icon btn-icon-mobile w-auto btn-clean d-flex align-items-center btn-lg px-2" id="kt_quick_user_toggle">
						<span class="text-muted font-weight-bold font-size-base d-none d-md-inline mr-1">Hi,</span>
						<span class="text-dark-50 font-weight-bolder font-size-base d-none d-md-inline mr-3"><?php echo $_SESSION["loggeduser_consumerFName"]; ?></span>
						<?php
							$name = $_SESSION["loggeduser_consumerFName"];
							$firstCharacter = $name[0];
						?>
						<span class="symbol symbol-lg-35 symbol-25 symbol-success">
							<span class="symbol-label font-size-h5 font-weight-bold" style="color:#ffffff;"><?php echo $firstCharacter; ?></span>
						</span>
					</div>
				</div>
				<div class="dropdown-menu p-0 m-0 dropdown-menu-right dropdown-menu-anim-up dropdown-menu-lg p-0">
						<!--[html-partial:include:{"file":"partials/_extras/dropdown/notifications.html"}]/-->
					<?php include 'view/pages/user.php'; ?>
				</div>
			</div>
			<!--end::User-->
		</div>
		<!--end::Topbar-->
	</div>
	<!--end::Container-->
</div>
<!--end::Header-->