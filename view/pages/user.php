<!--begin::Header-->
<div class="d-flex align-items-center justify-content-between flex-wrap p-8 bgi-size-cover bgi-no-repeat rounded-top" style="background-image: url(assets/media/bg/bg-12.jpg);">
	<div class="d-flex align-items-center mr-2">
		<?php
		$name = $_SESSION["loggeduser_consumerFName"];
		$firstCharacter = $name[0];
		?>
		<!--begin::Symbol-->
		<div class="symbol bg-white mr-3">
			<span class="symbol-label text-success font-weight-boldest font-size-h4"><?= $firstCharacter; ?></span>
		</div>
		<!--end::Symbol-->

		<!--begin::Text-->
		<div class="text-white m-0 flex-grow-1 mr-3 font-size-h5 font-weight-bold"><?= $_SESSION["loggeduser_consumerFName"]." ".$_SESSION["loggeduser_consumerLName"] ?></div>
		<!--end::Text-->
	</div>
	<!--<span class="label label-success label-lg font-weight-bold label-inline">3 messages</span>-->
</div>
<!--end::Header-->

<!--begin::Nav-->
<div class="navi navi-spacer-x-0 mt-3">
	<!--begin::Item-->
	<a href="index.php?page=profile" class="navi-item px-8">
		<div class="navi-link">
			<div class="navi-icon mr-2">
				<i class="flaticon2-calendar-3 text-success"></i>
			</div>
			<div class="navi-text">
				<div class="font-weight-bold">My Profile</div>
				<div class="text-muted">Account settings and more
					<span class="label label-light-danger label-inline font-weight-bold">update</span>
				</div>
			</div>
		</div>
	</a>
	<a href="index.php?page=change-password" class="navi-item px-8">
		<div class="navi-link">
			<div class="navi-icon mr-2">
				<i class="flaticon2-lock text-warning"></i>
			</div>
			<div class="navi-text">
				<div class="font-weight-bold">Change password</div>
				<div class="text-muted">Resetting your password</div>
			</div>
		</div>
	</a>
	<!--end::Item-->

	<!--begin::Item
	<a href="custom/apps/user/profile-2.html" class="navi-item px-8">
		<div class="navi-link">
			<div class="navi-icon mr-2">
				<i class="flaticon2-rocket-1 text-danger"></i>
			</div>
			<div class="navi-text">
				<div class="font-weight-bold">My Activities</div>
				<div class="text-muted">Logs and notifications</div>
			</div>
		</div>
	</a>
	<a href="custom/apps/userprofile-1/overview.html" class="navi-item px-8">
		<div class="navi-link">
			<div class="navi-icon mr-2">
				<i class="flaticon2-hourglass text-primary"></i>
			</div>
			<div class="navi-text">
				<div class="font-weight-bold">My Tasks</div>
				<div class="text-muted">latest tasks and projects</div>
			</div>
		</div>
	</a>
	--end::Item-->
	<!--begin::Footer-->
	<div class="navi-separator mt-3"></div>
	<?php
	if(!isset($_SESSION['is_mobile']))
	{
		?>
		<div class="navi-footer px-8 py-5" >
		<a href="model/logout.php" class="btn btn-success btn-hover-light btn-block">Sign Out</a>
		</div>
		<?php
	}
	?>
	<!--end::Footer-->
</div>
<!--end::Nav-->