<!--begin::Aside-->
<div class="aside aside-left aside-fixed d-flex flex-column flex-row-auto" id="kt_aside">
	<!--begin::Brand-->
	<div class="brand flex-column-auto" id="kt_brand">
		<!--begin::Logo-->
		<a href="index.php?page=dashboard" class="brand-logo">
			<img alt="Logo" src="assets/media/logos/gongetz2.png" width="150" height="150"/>
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
				<li class="menu-item menu-item" aria-haspopup="true">
					<a href="index.php?page=covid" class="menu-link">
						<span class="svg-icon menu-icon">
							<i class="flaticon2-protected icon-md"></i>
						</span>
						<span class="menu-text">Malaysia Covid</span>
					</a>
				</li>
				<li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
					<a href="javascript:;" class="menu-link menu-toggle">
						<span class="svg-icon menu-icon">
							<i class="flaticon2-bell-2 icon-md"></i>
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
							<i class="flaticon2-bell-3 icon-md"></i>
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
							<i class="flaticon2-layers-1 icon-md"></i>
						</span>
						<span class="menu-text">Dashboard</span>
					</a>
				</li>
				<li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
					<a href="javascript:;" class="menu-link menu-toggle">
						<span class="svg-icon menu-icon">
							<i class="flaticon2-shelter icon-md"></i>
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
							<i class="flaticon2-open-box icon-md"></i>
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
								<i class="flaticon2-browser-2 icon-md"></i>
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
									<a href="index.php?page=department_detail" class="menu-link menu-toggle">
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
									<a href="index.php?page=department_attendance" class="menu-link menu-toggle">
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
								<i class="flaticon2-list-3 icon-md"></i>
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
									<a href="index.php?page=subject_detail" class="menu-link menu-toggle">
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
								<i class="flaticon2-architecture-and-city icon-md"></i>
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
									<a href="index.php?page=class_detail" class="menu-link menu-toggle">
										<i class="menu-bullet menu-bullet-dot">
											<span></span>
										</i>
										<span class="menu-text">Classroom Info</span>
									</a>
								</li>
								<li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
									<a href="index.php?page=class_attendance" class="menu-link menu-toggle">
										<i class="menu-bullet menu-bullet-dot">
											<span></span>
										</i>
										<span class="menu-text">Attendance</span>
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
				<?php
				if ($_SESSION["loggeduser_ACCESS"] == 'TEACHER' || $_SESSION["loggeduser_ACCESS"] == 'STUDENT')
				{
					?> 
					<li class="menu-item menu-item" aria-haspopup="true" >
						<a href="index.php?page=ol_dashboard" class="menu-link">
							<span class="svg-icon menu-icon">
								<i class="flaticon2-layers-1 icon-md"></i>
							</span>
							<span class="menu-text">Dashboard</span>
						</a>
					</li>
					<?php
				}
				?>
				<li class="menu-item menu-item" aria-haspopup="true" >
					<a href="index.php?page=timetablelist" class="menu-link">
						<span class="svg-icon menu-icon">
							<i class="flaticon2-writing icon-md"></i>
						</span>
						<span class="menu-text">Timetable</span>
					</a>
				</li>
				<li class="menu-item menu-item" aria-haspopup="true" >
					<a href="index.php?page=personal_calendar&paging=0" class="menu-link">
						<span class="svg-icon menu-icon">
							<i class="flaticon2-calendar-4 icon-md"></i>
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
							<i class="flaticon2-user-outline-symbol icon-md"></i>
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
							<i class="flaticon2-user-outline-symbol icon-md"></i>
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
							<i class="flaticon2-user-outline-symbol icon-md"></i>
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