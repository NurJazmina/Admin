<!--begin::Aside-->
<div class="aside aside-left aside-fixed d-flex flex-column flex-row-auto" id="kt_aside">
	<!--begin::Brand-->
	<div class="brand flex-column-auto" id="kt_brand">
		<!--begin::Logo-->
		<a href="index.php?page=dashboard" class="brand-logo">
			<img alt="Logo" src="assets/media/logos/logogongetz.png" width="30" height="30"/>
		</a>
		<!--end::Logo-->
		<!--begin::Toggle-->
		<button class="brand-toggle btn btn-sm px-0" id="kt_aside_toggle">
			<span class="svg-icon svg-icon svg-icon-xl">
				<!--begin::Svg Icon | path:assets/media/svg/icons/Navigation/Angle-double-left.svg-->
				<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
					<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
						<polygon points="0 0 24 0 24 24 0 24" />
						<path d="M5.29288961,6.70710318 C4.90236532,6.31657888 4.90236532,5.68341391 5.29288961,5.29288961 C5.68341391,4.90236532 6.31657888,4.90236532 6.70710318,5.29288961 L12.7071032,11.2928896 C13.0856821,11.6714686 13.0989277,12.281055 12.7371505,12.675721 L7.23715054,18.675721 C6.86395813,19.08284 6.23139076,19.1103429 5.82427177,18.7371505 C5.41715278,18.3639581 5.38964985,17.7313908 5.76284226,17.3242718 L10.6158586,12.0300721 L5.29288961,6.70710318 Z" fill="#000000" fill-rule="nonzero" transform="translate(8.999997, 11.999999) scale(-1, 1) translate(-8.999997, -11.999999)" />
						<path d="M10.7071009,15.7071068 C10.3165766,16.0976311 9.68341162,16.0976311 9.29288733,15.7071068 C8.90236304,15.3165825 8.90236304,14.6834175 9.29288733,14.2928932 L15.2928873,8.29289322 C15.6714663,7.91431428 16.2810527,7.90106866 16.6757187,8.26284586 L22.6757187,13.7628459 C23.0828377,14.1360383 23.1103407,14.7686056 22.7371482,15.1757246 C22.3639558,15.5828436 21.7313885,15.6103465 21.3242695,15.2371541 L16.0300699,10.3841378 L10.7071009,15.7071068 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" transform="translate(15.999997, 11.999999) scale(-1, 1) rotate(-270.000000) translate(-15.999997, -11.999999)" />
					</g>
				</svg>
				<!--end::Svg Icon-->
			</span>
		</button>
		<!--end::Toolbar-->
	</div>
	<!--end::Brand-->

	<!--begin::Aside Menu-->
	<div class="aside-menu-wrapper flex-column-fluid" id="kt_aside_menu_wrapper">

		<!--begin::Menu Container-->
		<div id="kt_aside_menu" class="aside-menu" data-menu-vertical="1" data-menu-scroll="1" data-menu-dropdown-timeout="500">

			<!--begin::Menu Nav-->
			<ul class="menu-nav">
				<li class="menu-section">
					<h4 class="menu-text">Highlight</h4>
					<i class="menu-icon ki ki-bold-more-hor icon-md"></i>
				</li>
				<li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
					<a href="javascript:;" class="menu-link menu-toggle">
						<span class="svg-icon menu-icon">
							<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
								<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
									<polygon points="0 0 24 0 24 24 0 24"/>
									<path d="M16.5,4.5 C14.8905,4.5 13.00825,6.32463215 12,7.5 C10.99175,6.32463215 9.1095,4.5 7.5,4.5 C4.651,4.5 3,6.72217984 3,9.55040872 C3,12.6834696 6,16 12,19.5 C18,16 21,12.75 21,9.75 C21,6.92177112 19.349,4.5 16.5,4.5 Z" fill="#000000" fill-rule="nonzero"/>
								</g>
							</svg>
						</span>
						<span class="menu-text">News</span>
						<i class="menu-arrow"></i>
					</a>
					<div class="menu-submenu">
						<i class="menu-arrow"></i>
						<ul class="menu-subnav">
							<li class="menu-item menu-item-parent" aria-haspopup="true">
								<span class="menu-link">
									<span class="menu-text">News</span>
								</span>
							</li>
							<li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
								<a href="index.php?page=news" class="menu-link menu-toggle">
									<i class="menu-bullet menu-bullet-dot">
										<span></span>
									</i>
									<span class="menu-text">List News</span>
									<span class="menu-label">
									<?php 
									$latestnews = 0;
									$to_date = new MongoDB\BSON\UTCDateTime((new DateTime('now'))->getTimestamp()*1000);
									$from_date = new MongoDB\BSON\UTCDateTime((new DateTime('now -1 week'))->getTimestamp()*1000);

									$filter = ['school_id'=>$_SESSION["loggeduser_school_id"],'NewsDate' => ['$gte' => $from_date,'$lte' => $to_date]];
									$query = new MongoDB\Driver\Query($filter);
									$cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.SchoolNews',$query);
									foreach ($cursor as $document)
									{
										$latestnews = $latestnews + 1;
									}
									if($latestnews !== 0)
									{
										?>
										<span class="label label-rounded label-warning"><?= $latestnews; ?></span>
										<?php
									}
									?>
									</span>
								</a>
							</li>
							<?php
							if ($_SESSION["loggeduser_ConsumerGroupName"] == 'SCHOOL' || $_SESSION["loggeduser_ConsumerGroupName"] == 'GONGETZ')
							{
							?>
							<li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
								<a href="index.php?page=add_news" class="menu-link menu-toggle">
									<i class="menu-bullet menu-bullet-dot">
										<span></span>
									</i>
									<span class="menu-text">Add News</span>
								</a>
							</li>
							<?php
							}
							?>
						</ul>
					</div>
				</li>
				<li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
					<a href="javascript:;" class="menu-link menu-toggle">
						<span class="svg-icon menu-icon">
							<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
								<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
									<rect x="0" y="0" width="24" height="24"/>
									<path d="M14,7 C13.6666667,10.3333333 12.6666667,12.1167764 11,12.3503292 C11,12.3503292 12.5,6.5 10.5,3.5 C10.5,3.5 10.287918,6.71444735 8.14498739,10.5717225 C7.14049032,12.3798172 6,13.5986793 6,16 C6,19.428689 9.51143904,21.2006583 12.0057195,21.2006583 C14.5,21.2006583 18,20.0006172 18,15.8004732 C18,14.0733981 16.6666667,11.1399071 14,7 Z" fill="#000000"/>
								</g>
							</svg>
						</span>
						<span class="menu-text">Events</span>
						<i class="menu-arrow"></i>
					</a>
					<div class="menu-submenu">
						<i class="menu-arrow"></i>
						<ul class="menu-subnav">
							<li class="menu-item menu-item-parent" aria-haspopup="true">
								<span class="menu-link">
									<span class="menu-text">Events</span>
								</span>
							</li>
							<li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
								<a href="index.php?page=event" class="menu-link menu-toggle">
									<i class="menu-bullet menu-bullet-dot">
										<span></span>
									</i>
									<span class="menu-text">Upcoming Events</span>
									<span class="menu-label">
									<?php 
									$latestevent = 0;
									$to_date = new MongoDB\BSON\UTCDateTime((new DateTime('now +1 week'))->getTimestamp()*1000);
									$from_date = new MongoDB\BSON\UTCDateTime((new DateTime('now'))->getTimestamp()*1000);

									$filter = ['school_id'=>$_SESSION["loggeduser_school_id"],'EventDateStart' => ['$gte' => $from_date,'$lte' => $to_date]];
									$query = new MongoDB\Driver\Query($filter);
									$cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.SchoolEvent',$query);
									foreach ($cursor as $document)
									{
										$latestevent = $latestevent + 1;
									}
									if($latestevent !== 0)
									{
										?>
										<span class="label label-rounded label-warning"><?= $latestevent; ?></span>
										<?php
									}
									?>
									</span>
								</a>
							</li>
							<?php
							if ($_SESSION["loggeduser_ConsumerGroupName"] == 'SCHOOL' || $_SESSION["loggeduser_ConsumerGroupName"] == 'GONGETZ')
							{
							?>
							<li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
								<a href="index.php?page=add_event" class="menu-link menu-toggle">
									<i class="menu-bullet menu-bullet-dot">
										<span></span>
									</i>
									<span class="menu-text">Add Events</span>
								</a>
							</li>
							<?php
							}
							?>
						</ul>
					</div>
				</li>
				<li class="menu-item menu-item" aria-haspopup="true" style="border-top: 1px solid #eceef7;; margin-top: 12px; padding-top: 12px;">
					<a href="index.php?page=dashboard" class="menu-link">
						<span class="svg-icon menu-icon">
							<!--begin::Svg Icon | path:assets/media/svg/icons/Design/Layers.svg-->
							<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
								<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
									<polygon points="0 0 24 0 24 24 0 24" />
									<path d="M12.9336061,16.072447 L19.36,10.9564761 L19.5181585,10.8312381 C20.1676248,10.3169571 20.2772143,9.3735535 19.7629333,8.72408713 C19.6917232,8.63415859 19.6104327,8.55269514 19.5206557,8.48129411 L12.9336854,3.24257445 C12.3871201,2.80788259 11.6128799,2.80788259 11.0663146,3.24257445 L4.47482784,8.48488609 C3.82645598,9.00054628 3.71887192,9.94418071 4.23453211,10.5925526 C4.30500305,10.6811601 4.38527899,10.7615046 4.47382636,10.8320511 L4.63,10.9564761 L11.0659024,16.0730648 C11.6126744,16.5077525 12.3871218,16.5074963 12.9336061,16.072447 Z" fill="#000000" fill-rule="nonzero" />
									<path d="M11.0563554,18.6706981 L5.33593024,14.122919 C4.94553994,13.8125559 4.37746707,13.8774308 4.06710397,14.2678211 C4.06471678,14.2708238 4.06234874,14.2738418 4.06,14.2768747 L4.06,14.2768747 C3.75257288,14.6738539 3.82516916,15.244888 4.22214834,15.5523151 C4.22358765,15.5534297 4.2250303,15.55454 4.22647627,15.555646 L11.0872776,20.8031356 C11.6250734,21.2144692 12.371757,21.2145375 12.909628,20.8033023 L19.7677785,15.559828 C20.1693192,15.2528257 20.2459576,14.6784381 19.9389553,14.2768974 C19.9376429,14.2751809 19.9363245,14.2734691 19.935,14.2717619 L19.935,14.2717619 C19.6266937,13.8743807 19.0546209,13.8021712 18.6572397,14.1104775 C18.654352,14.112718 18.6514778,14.1149757 18.6486172,14.1172508 L12.9235044,18.6705218 C12.377022,19.1051477 11.6029199,19.1052208 11.0563554,18.6706981 Z" fill="#000000" opacity="0.3" />
								</g>
							</svg>
						</span>
						<span class="menu-text">Dashboard</span>
					</a>
				</li>
				<li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
					<a href="javascript:;" class="menu-link menu-toggle">
						<span class="svg-icon menu-icon">
							<!--begin::Svg Icon | path:assets/media/svg/icons/Shopping/Barcode-read.svg-->
							<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
								<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
									<rect x="0" y="0" width="24" height="24"/>
									<path d="M3.95709826,8.41510662 L11.47855,3.81866389 C11.7986624,3.62303967 12.2013376,3.62303967 12.52145,3.81866389 L20.0429,8.41510557 C20.6374094,8.77841684 21,9.42493654 21,10.1216692 L21,19.0000642 C21,20.1046337 20.1045695,21.0000642 19,21.0000642 L4.99998155,21.0000673 C3.89541205,21.0000673 2.99998155,20.1046368 2.99998155,19.0000673 L2.99999828,10.1216672 C2.99999935,9.42493561 3.36258984,8.77841732 3.95709826,8.41510662 Z M10,13 C9.44771525,13 9,13.4477153 9,14 L9,17 C9,17.5522847 9.44771525,18 10,18 L14,18 C14.5522847,18 15,17.5522847 15,17 L15,14 C15,13.4477153 14.5522847,13 14,13 L10,13 Z" fill="#000000"/>
								</g>
							</svg>
						</span>
						<span class="menu-text">School</span>
						<i class="menu-arrow"></i>
					</a>
					<div class="menu-submenu">
						<i class="menu-arrow"></i>
						<ul class="menu-subnav">
							<li class="menu-item menu-item-parent" aria-haspopup="true">
								<span class="menu-link">
									<span class="menu-text">School</span>
								</span>
							</li>
							<li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
								<a href="index.php?page=schoolabout" class="menu-link menu-toggle">
									<i class="menu-bullet menu-bullet-dot">
										<span></span>
									</i>
									<span class="menu-text">About</span>
								</a>
							</li>
							<?php
							if ($_SESSION["loggeduser_ConsumerGroupName"] == 'SCHOOL' || $_SESSION["loggeduser_ConsumerGroupName"] == 'GONGETZ')
							{
							?>
							<li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
								<a href="index.php?page=mail" class="menu-link menu-toggle" data-target="#kt_inbox_compose">
									<i class="menu-bullet menu-bullet-dot">
										<span></span>
									</i>
									<span class="menu-text">Email Blaster</span>
								</a>
							</li>
							<?php
							}
							?>
						</ul>
					</div>
				</li>
				<li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
					<a href="javascript:;" class="menu-link menu-toggle">
						<span class="svg-icon menu-icon">
							<!--begin::Svg Icon | path:assets/media/svg/icons/Shopping/Barcode-read.svg-->
							<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
								<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
									<rect x="0" y="0" width="24" height="24"/>
									<path d="M16,15.6315789 L16,12 C16,10.3431458 14.6568542,9 13,9 L6.16183229,9 L6.16183229,5.52631579 C6.16183229,4.13107011 7.29290239,3 8.68814808,3 L20.4776218,3 C21.8728674,3 23.0039375,4.13107011 23.0039375,5.52631579 L23.0039375,13.1052632 L23.0206157,17.786793 C23.0215995,18.0629336 22.7985408,18.2875874 22.5224001,18.2885711 C22.3891754,18.2890457 22.2612702,18.2363324 22.1670655,18.1421277 L19.6565168,15.6315789 L16,15.6315789 Z" fill="#000000"/>
									<path d="M1.98505595,18 L1.98505595,13 C1.98505595,11.8954305 2.88048645,11 3.98505595,11 L11.9850559,11 C13.0896254,11 13.9850559,11.8954305 13.9850559,13 L13.9850559,18 C13.9850559,19.1045695 13.0896254,20 11.9850559,20 L4.10078614,20 L2.85693427,21.1905292 C2.65744295,21.3814685 2.34093638,21.3745358 2.14999706,21.1750444 C2.06092565,21.0819836 2.01120804,20.958136 2.01120804,20.8293182 L2.01120804,18.32426 C1.99400175,18.2187196 1.98505595,18.1104045 1.98505595,18 Z M6.5,14 C6.22385763,14 6,14.2238576 6,14.5 C6,14.7761424 6.22385763,15 6.5,15 L11.5,15 C11.7761424,15 12,14.7761424 12,14.5 C12,14.2238576 11.7761424,14 11.5,14 L6.5,14 Z M9.5,16 C9.22385763,16 9,16.2238576 9,16.5 C9,16.7761424 9.22385763,17 9.5,17 L11.5,17 C11.7761424,17 12,16.7761424 12,16.5 C12,16.2238576 11.7761424,16 11.5,16 L9.5,16 Z" fill="#000000" opacity="0.3"/>
								</g>
							</svg>
						</span>
						<span class="menu-text">Forum</span>
						<i class="menu-arrow"></i>
					</a>
					<div class="menu-submenu">
						<i class="menu-arrow"></i>
						<ul class="menu-subnav">
							<li class="menu-item menu-item-parent" aria-haspopup="true">
								<span class="menu-link">
									<span class="menu-text" disable>Forum</span>
								</span>
							</li>
							<li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
								<a href="index.php?page=forums" class="menu-link menu-toggle">
									<i class="menu-bullet menu-bullet-dot">
										<span></span>
									</i>
									<span class="menu-text">List Forum</span>
									<span class="menu-label">
									<?php 
									$latestforum = 0;
									$to_date = new MongoDB\BSON\UTCDateTime((new DateTime('now'))->getTimestamp()*1000);
									$from_date = new MongoDB\BSON\UTCDateTime((new DateTime('now -1 month'))->getTimestamp()*1000);

									$filter = ['school_id'=>$_SESSION["loggeduser_school_id"],'ForumDate' => ['$gte' => $from_date,'$lte' => $to_date]];
									$query = new MongoDB\Driver\Query($filter);
									$cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.SchoolForum',$query);
									foreach ($cursor as $document)
									{
										$latestforum = $latestforum + 1;
									}
									if($latestforum !== 0)
									{
										?>
										<span class="label label-rounded label-warning"><?= $latestevent; ?></span>
										<?php
									}
									?>
									</span>
								</a>
							</li>
							<?php
							if ($_SESSION["loggeduser_ConsumerGroupName"] == 'SCHOOL' || $_SESSION["loggeduser_ConsumerGroupName"] == 'GONGETZ')
							{
							?>
							<li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
								<a href="index.php?page=add_forums" class="menu-link menu-toggle">
									<i class="menu-bullet menu-bullet-dot">
										<span></span>
									</i>
									<span class="menu-text">Add Forum</span>
								</a>
							</li>
							<?php
							}
							?>
						</ul>
					</div>
				</li>
				<?php
				if ($_SESSION["loggeduser_ConsumerGroupName"] == 'SCHOOL' || $_SESSION["loggeduser_ConsumerGroupName"] == 'GONGETZ')
				{
					?>
					<li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
						<a href="javascript:;" class="menu-link menu-toggle">
							<span class="svg-icon menu-icon">
								<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
									<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
										<rect x="0" y="0" width="24" height="24"/>
										<path d="M5,3 L6,3 C6.55228475,3 7,3.44771525 7,4 L7,20 C7,20.5522847 6.55228475,21 6,21 L5,21 C4.44771525,21 4,20.5522847 4,20 L4,4 C4,3.44771525 4.44771525,3 5,3 Z M10,3 L11,3 C11.5522847,3 12,3.44771525 12,4 L12,20 C12,20.5522847 11.5522847,21 11,21 L10,21 C9.44771525,21 9,20.5522847 9,20 L9,4 C9,3.44771525 9.44771525,3 10,3 Z" fill="#000000"/>
										<rect fill="#000000" opacity="0.3" transform="translate(17.825568, 11.945519) rotate(-19.000000) translate(-17.825568, -11.945519) " x="16.3255682" y="2.94551858" width="3" height="18" rx="1"/>
									</g>
								</svg>
							</span>
							<span class="menu-text">Department</span>
							<i class="menu-arrow"></i>
						</a>
						<div class="menu-submenu">
							<i class="menu-arrow"></i>
							<ul class="menu-subnav">
								<li class="menu-item menu-item-parent" aria-haspopup="true">
									<span class="menu-link">
										<span class="menu-text">Department</span>
									</span>
								</li>
								<li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
									<a href="index.php?page=departmentlist" class="menu-link menu-toggle">
										<i class="menu-bullet menu-bullet-dot">
											<span></span>
										</i>
										<span class="menu-text">List Department</span>
									</a>
								</li>
								<?php
								if ($_SESSION["loggeduser_ACCESS"] == 'STAFF')
								{
								?>
								<li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
									<a href="index.php?page=add_department" class="menu-link menu-toggle">
										<i class="menu-bullet menu-bullet-dot">
											<span></span>
										</i>
										<span class="menu-text">Add Department</span>
									</a>
								</li>
								<?php
								}
								?>
								<li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
									<a href="index.php?page=departmentdetail" class="menu-link menu-toggle">
										<i class="menu-bullet menu-bullet-dot">
											<span></span>
										</i>
										<span class="menu-text">Department Info</span>
									</a>
								</li>
								<?php
								if ($_SESSION["loggeduser_ACCESS"] == 'STAFF')
								{
								?>
								<li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
									<a href="index.php?page=departmentattendance" class="menu-link menu-toggle">
										<i class="menu-bullet menu-bullet-dot">
											<span></span>
										</i>
										<span class="menu-text">Attendance</span>
									</a>
								</li>
								<?php
								}
								?>
							</ul>
						</div>
					</li>
					<li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
						<a href="javascript:;" class="menu-link menu-toggle">
							<span class="svg-icon menu-icon">
								<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
									<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
										<rect x="0" y="0" width="24" height="24"/>
										<path d="M5.5,2 L18.5,2 C19.3284271,2 20,2.67157288 20,3.5 L20,6.5 C20,7.32842712 19.3284271,8 18.5,8 L5.5,8 C4.67157288,8 4,7.32842712 4,6.5 L4,3.5 C4,2.67157288 4.67157288,2 5.5,2 Z M11,4 C10.4477153,4 10,4.44771525 10,5 C10,5.55228475 10.4477153,6 11,6 L13,6 C13.5522847,6 14,5.55228475 14,5 C14,4.44771525 13.5522847,4 13,4 L11,4 Z" fill="#000000" opacity="0.3"/>
										<path d="M5.5,9 L18.5,9 C19.3284271,9 20,9.67157288 20,10.5 L20,13.5 C20,14.3284271 19.3284271,15 18.5,15 L5.5,15 C4.67157288,15 4,14.3284271 4,13.5 L4,10.5 C4,9.67157288 4.67157288,9 5.5,9 Z M11,11 C10.4477153,11 10,11.4477153 10,12 C10,12.5522847 10.4477153,13 11,13 L13,13 C13.5522847,13 14,12.5522847 14,12 C14,11.4477153 13.5522847,11 13,11 L11,11 Z M5.5,16 L18.5,16 C19.3284271,16 20,16.6715729 20,17.5 L20,20.5 C20,21.3284271 19.3284271,22 18.5,22 L5.5,22 C4.67157288,22 4,21.3284271 4,20.5 L4,17.5 C4,16.6715729 4.67157288,16 5.5,16 Z M11,18 C10.4477153,18 10,18.4477153 10,19 C10,19.5522847 10.4477153,20 11,20 L13,20 C13.5522847,20 14,19.5522847 14,19 C14,18.4477153 13.5522847,18 13,18 L11,18 Z" fill="#000000"/>
									</g>
								</svg>
							</span>
							<span class="menu-text">Subject</span>
							<i class="menu-arrow"></i>
						</a>
						<div class="menu-submenu">
							<i class="menu-arrow"></i>
							<ul class="menu-subnav">
								<li class="menu-item menu-item-parent" aria-haspopup="true">
									<span class="menu-link">
										<span class="menu-text">Subject</span>
									</span>
								</li>
								<li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
									<a href="index.php?page=subjectlist" class="menu-link menu-toggle">
										<i class="menu-bullet menu-bullet-dot">
											<span></span>
										</i>
										<span class="menu-text">List Subject</span>
									</a>
								</li>
								<?php
								if ($_SESSION["loggeduser_ACCESS"] == 'STAFF')
								{
								?>
								<li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
									<a href="index.php?page=add_subject" class="menu-link menu-toggle">
										<i class="menu-bullet menu-bullet-dot">
											<span></span>
										</i>
										<span class="menu-text">Add Subject</span>
									</a>
								</li>
								<?php
								}
								?>
								<li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
									<a href="index.php?page=subjectdetail" class="menu-link menu-toggle">
										<i class="menu-bullet menu-bullet-dot">
											<span></span>
										</i>
										<span class="menu-text">Subject Info</span>
									</a>
								</li>
							</ul>
						</div>
					</li>
					<li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
						<a href="javascript:;" class="menu-link menu-toggle">
							<span class="svg-icon menu-icon">
								<!--begin::Svg Icon | path:assets/media/svg/icons/Shopping/Barcode-read.svg-->
								<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
									<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
										<rect opacity="0.300000012" x="0" y="0" width="24" height="24"/>
										<polygon fill="#000000" fill-rule="nonzero" opacity="0.3" points="7 4.89473684 7 21 5 21 5 3 11 3 11 4.89473684"/>
										<path d="M10.1782982,2.24743315 L18.1782982,3.6970464 C18.6540619,3.78325557 19,4.19751166 19,4.68102291 L19,19.3190064 C19,19.8025177 18.6540619,20.2167738 18.1782982,20.3029829 L10.1782982,21.7525962 C9.63486295,21.8510675 9.11449486,21.4903531 9.0160235,20.9469179 C9.00536265,20.8880837 9,20.8284119 9,20.7686197 L9,3.23140966 C9,2.67912491 9.44771525,2.23140966 10,2.23140966 C10.0597922,2.23140966 10.119464,2.2367723 10.1782982,2.24743315 Z M11.9166667,12.9060229 C12.6070226,12.9060229 13.1666667,12.2975724 13.1666667,11.5470105 C13.1666667,10.7964487 12.6070226,10.1879981 11.9166667,10.1879981 C11.2263107,10.1879981 10.6666667,10.7964487 10.6666667,11.5470105 C10.6666667,12.2975724 11.2263107,12.9060229 11.9166667,12.9060229 Z" fill="#000000"/>
									</g>
								</svg>
							</span>
							<span class="menu-text">Classroom</span>
							<i class="menu-arrow"></i>
						</a>
						<div class="menu-submenu">
							<i class="menu-arrow"></i>
							<ul class="menu-subnav">
								<li class="menu-item menu-item-parent" aria-haspopup="true">
									<span class="menu-link">
										<span class="menu-text">classroom</span>
									</span>
								</li>
								<li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
									<a href="index.php?page=classroomlist" class="menu-link menu-toggle">
										<i class="menu-bullet menu-bullet-dot">
											<span></span>
										</i>
										<span class="menu-text">List classroom</span>
									</a>
								</li>
								<?php
								if ($_SESSION["loggeduser_ACCESS"] == 'STAFF')
								{
								?>
								<li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
									<a href="index.php?page=add_class" class="menu-link menu-toggle">
										<i class="menu-bullet menu-bullet-dot">
											<span></span>
										</i>
										<span class="menu-text">Add Classroom</span>
									</a>
								</li>
								<?php
								}
								?>
								<li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
									<a href="index.php?page=classdetail" class="menu-link menu-toggle">
										<i class="menu-bullet menu-bullet-dot">
											<span></span>
										</i>
										<span class="menu-text">Classroom Info</span>
									</a>
								</li>
								<li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
									<a href="index.php?page=classattendance" class="menu-link menu-toggle">
										<i class="menu-bullet menu-bullet-dot">
											<span></span>
										</i>
										<span class="menu-text">Attendance</span>
									</a>
								</li>
							</ul>
						</div>
					</li>
					<li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
						<a href="javascript:;" class="menu-link menu-toggle">
							<span class="svg-icon menu-icon">

								<!--begin::Svg Icon | path:assets/media/svg/icons/Shopping/Barcode-read.svg-->
								<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
									<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
										<rect x="0" y="0" width="24" height="24"/>
										<path d="M8,3 L8,3.5 C8,4.32842712 8.67157288,5 9.5,5 L14.5,5 C15.3284271,5 16,4.32842712 16,3.5 L16,3 L18,3 C19.1045695,3 20,3.8954305 20,5 L20,21 C20,22.1045695 19.1045695,23 18,23 L6,23 C4.8954305,23 4,22.1045695 4,21 L4,5 C4,3.8954305 4.8954305,3 6,3 L8,3 Z" fill="#000000" opacity="0.3"/>
										<path d="M11,2 C11,1.44771525 11.4477153,1 12,1 C12.5522847,1 13,1.44771525 13,2 L14.5,2 C14.7761424,2 15,2.22385763 15,2.5 L15,3.5 C15,3.77614237 14.7761424,4 14.5,4 L9.5,4 C9.22385763,4 9,3.77614237 9,3.5 L9,2.5 C9,2.22385763 9.22385763,2 9.5,2 L11,2 Z" fill="#000000"/>
										<rect fill="#000000" opacity="0.3" x="10" y="9" width="7" height="2" rx="1"/>
										<rect fill="#000000" opacity="0.3" x="7" y="9" width="2" height="2" rx="1"/>
										<rect fill="#000000" opacity="0.3" x="7" y="13" width="2" height="2" rx="1"/>
										<rect fill="#000000" opacity="0.3" x="10" y="13" width="7" height="2" rx="1"/>
										<rect fill="#000000" opacity="0.3" x="7" y="17" width="2" height="2" rx="1"/>
										<rect fill="#000000" opacity="0.3" x="10" y="17" width="7" height="2" rx="1"/>
									</g>
								</svg>
							</span>
							<span class="menu-text">Timetable</span>
							<i class="menu-arrow"></i>
						</a>
						<div class="menu-submenu">
							<i class="menu-arrow"></i>
							<ul class="menu-subnav">
								<li class="menu-item menu-item-parent" aria-haspopup="true">
									<span class="menu-link">
										<span class="menu-text">timetable</span>
									</span>
								</li>
								<li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
									<a href="index.php?page=timetablelist" class="menu-link menu-toggle">
										<i class="menu-bullet menu-bullet-dot">
											<span></span>
										</i>
										<span class="menu-text">Timetable List</span>
									</a>
								</li>
							</ul>
						</div>
					</li>
					<?php
				}
				?>
				<li class="menu-section" style="border-top: 1px solid #eceef7; margin-top: 12px; padding-top: 12px;">
					<h4 class="menu-text">Online Learning</h4>
					<i class="menu-icon ki ki-bold-more-hor icon-md"></i>
				</li>
				<li class="menu-item menu-item" aria-haspopup="true" >
					<a href="index.php?page=ol_dashboard" class="menu-link">
						<span class="svg-icon menu-icon">
							<i class="flaticon2-laptop icon-l"></i>
						</span>
						<span class="menu-text">Dashboard</span>
					</a>
				</li>
				<li class="menu-item menu-item" aria-haspopup="true" >
					<a href="index.php?page=ol_calendar" class="menu-link">
						<span class="svg-icon menu-icon">
						<i class="far fa-calendar-alt icon-lg"></i>
						</span>
						<span class="menu-text">Calendar</span>
					</a>
				</li>
				<li class="menu-section" style="border-top: 1px solid #eceef7;; margin-top: 12px; padding-top: 12px;">
					<h4 class="menu-text">Directory</h4>
					<i class="menu-icon ki ki-bold-more-hor icon-md"></i>
				</li>
				<li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
					<a href="javascript:;" class="menu-link menu-toggle">
						<span class="svg-icon menu-icon">
							<i class="fas fa-user-tie"></i>
						</span>
						<span class="menu-text">Staff</span>
						<i class="menu-arrow"></i>
					</a>
					<div class="menu-submenu">
						<i class="menu-arrow"></i>
						<ul class="menu-subnav">
							<li class="menu-item menu-item-parent" aria-haspopup="true">
								<span class="menu-link">
									<span class="menu-text">Staff</span>
								</span>
							</li>
							<li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
								<a href="index.php?page=stafflist" class="menu-link menu-toggle">
									<i class="menu-bullet menu-bullet-dot">
										<span></span>
									</i>
									<span class="menu-text">List Staff</span>
								</a>
							</li>
							<?php
							if ($_SESSION["loggeduser_ACCESS"] == 'STAFF')
							{
							?>
							<li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
								<a href="index.php?page=add_staff" class="menu-link menu-toggle">
									<i class="menu-bullet menu-bullet-dot">
										<span></span>
									</i>
									<span class="menu-text">Add Staff</span>
								</a>
							</li>
							<?php
							}
							?>
						</ul>
					</div>
				</li>
				<li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
					<a href="javascript:;" class="menu-link menu-toggle">
						<span class="svg-icon menu-icon">
								<i class="fas fa-user-graduate"></i>
						</span>
						<span class="menu-text">Student</span>
						<i class="menu-arrow"></i>
					</a>
					<div class="menu-submenu">
						<i class="menu-arrow"></i>
						<ul class="menu-subnav">
							<li class="menu-item menu-item-parent" aria-haspopup="true">
								<span class="menu-link">
									<span class="menu-text">Student</span>
								</span>
							</li>
							<li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
								<a href="index.php?page=studentlist" class="menu-link menu-toggle">
									<i class="menu-bullet menu-bullet-dot">
										<span></span>
									</i>
									<span class="menu-text">List Student</span>
								</a>
							</li>
							<?php
							if ($_SESSION["loggeduser_ACCESS"] == 'STAFF')
							{
							?>
							<li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
								<a href="index.php?page=add_student" class="menu-link menu-toggle">
									<i class="menu-bullet menu-bullet-dot">
										<span></span>
									</i>
									<span class="menu-text">Add Student</span>
								</a>
							</li>
							<?php
							}
							?>
						</ul>
					</div>
				</li>
				<li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
					<a href="javascript:;" class="menu-link menu-toggle">
						<span class="svg-icon menu-icon">
								<i class="fas fa-user-alt"></i>
						</span>
						<span class="menu-text">Parent</span>
						<i class="menu-arrow"></i>
					</a>
					<div class="menu-submenu">
						<i class="menu-arrow"></i>
						<ul class="menu-subnav">
							<li class="menu-item menu-item-parent" aria-haspopup="true">
								<span class="menu-link">
									<span class="menu-text">Parent</span>
								</span>
							</li>
							<li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
								<a href="index.php?page=parentlist" class="menu-link menu-toggle">
									<i class="menu-bullet menu-bullet-dot">
										<span></span>
									</i>
									<span class="menu-text">List Parent</span>
								</a>
							</li>
							<?php
							if ($_SESSION["loggeduser_ACCESS"] == 'STAFF')
							{
							?>
							<li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
								<a href="index.php?page=add_parent" class="menu-link menu-toggle">
									<i class="menu-bullet menu-bullet-dot">
										<span></span>
									</i>
									<span class="menu-text">Add Parent</span>
								</a>
							</li>
							<?php
							}
							?>
						</ul>
					</div>
				</li>
			</ul>
			<!--end::Menu Nav-->
		</div>
		<!--end::Menu Container-->
	</div>
	<!--end::Aside Menu-->
</div>
<!--end::Aside-->