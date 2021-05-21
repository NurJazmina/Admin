<?php

$_SESSION["title"] = "Dashboard";
include 'view/partials/_subheader/subheader-v1.php';
include ('model/home.php'); 

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

?>
<div class="card card-custom gutter-b">
			<!--begin::Header-->
			<div class="card-header border-0 pt-7">
				<h3 class="card-title align-items-start flex-column">
				<span class="card-label font-weight-bolder font-size-h4 text-dark-75">Latest Forum</span>
				</h3>
				<div class="card-toolbar">
					<ul class="nav nav-light-success nav-pills nav-pills-sm nav-dark-75">
						<li class="nav-item">
							<a class="nav-link py-2 px-4 font-weight-bolder" data-toggle="tab" href="#kt_tab_pane_10_1"><?php echo $_SESSION["loggeduser_ACCESS"]; ?></a>
						</li>
						<li class="nav-item">
							<a class="nav-link py-2 px-4 active font-weight-bolder" data-toggle="tab" href="#kt_tab_pane_10_2">PUBLIC</a>
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
						<span class="menu-label">
						<?php
						$Forumid=" ";
						$filter = ['school_id'=>$_SESSION["loggeduser_schoolID"],'NewsAccess'=>$_SESSION["loggeduser_ACCESS"]];
						$option = ['limit'=>5,'sort' => ['NewsDate' => 1]];
						$query = new MongoDB\Driver\Query($filter,$option);
						$cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.SchoolForum',$query);
						foreach ($cursor as $document)
						{
							$Forumid = ($document->_id);
							$newsid = new \MongoDB\BSON\ObjectId($newsid);
						}
						if(!$Forumid == "")
						{
							$filter = ['_id'=>$Forumid];
							$query = new MongoDB\Driver\Query($filter);
							$cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.SchoolForum',$query);
							foreach ($cursor as $document)
							{
								$ForumDate = ($document->ForumDate);
								$utcdatetime = new MongoDB\BSON\UTCDateTime(strval($NewsDate));
								$datetime = $utcdatetime->toDateTime()->setTimezone(new \DateTimeZone(date_default_timezone_get()));
								$datenew = date_format($datetime,"Y-m-d\TH:i:s");
								$date = new MongoDB\BSON\UTCDateTime((new DateTime($datenew))->getTimestamp());
						
								$nowtimeNew = time();
								$timeNew = strval($date);
							}
					    }
						?>
						<span class="text-muted mt-3 font-weight-bold font-size-sm">Latest News update 
						
						</span>
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
                    $filter = ['school_id'=>$_SESSION["loggeduser_schoolID"],'Forum'=>'1'];
                    $option = ['limit'=>5,'sort' => ['_id' => -1]];
                    $query = new MongoDB\Driver\Query($filter,$option);
                    $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.SchoolForum',$query);

                    foreach ($cursor as $document)
                    {
                        $Forumid = ($document->_id);
                        $ForumTitle = ($document->ForumTitle);
                        $ForumDate = ($document->ForumDate);
                        $Consumer_id = ($document->Consumer_id);
                        
                        $utcdatetime = new MongoDB\BSON\UTCDateTime(strval($ForumDate));
                        $datetime = $utcdatetime->toDateTime()->setTimezone(new \DateTimeZone(date_default_timezone_get()));
                        $dateforum = date_format($datetime,"Y-m-d\TH:i:s");
                        $date = new MongoDB\BSON\UTCDateTime((new DateTime($dateforum))->getTimestamp());
                    
                        $oldtime = strval($date);

                        $consumerid = new \MongoDB\BSON\ObjectId($Consumer_id);
                        $filter1 = ['_id' => $consumerid];
                        $query1 = new MongoDB\Driver\Query($filter1);
                        $cursor1 = $GoNGetzDatabase->executeQuery('GoNGetz.Consumer', $query1);
        
                        foreach ($cursor1 as $document1)
                        {
                        $ConsumerFName = ($document1->ConsumerFName);
                        }

                        $total = 0;
                        $filter2 = ['School_id'=>$_SESSION["loggeduser_schoolID"],'Forum_id'=>$Forumid,'ForumParent_id'=>'0'];
                        $query2 = new MongoDB\Driver\Query($filter2);
                        $cursor2 = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.SchoolForumComment',$query2);
                        foreach ($cursor2 as $document2)
                        {
                            $total = $total + 1;
                        }
                        ?>	
							<tbody>
								<tr>
								<td class="pl-0 py-2">
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
												<a href="index.php?page=schoolforumdetail&forum=1&topic=general&id=<?php echo $Forumid; ?>" class="text-dark-75 font-weight-bolder text-hover-primary mb-1 font-size-lg"><?php echo $ForumTitle; ?></a>
												<span class="text-muted font-weight-bold d-block"><?php echo " By ".$ConsumerFName;?></span>
												<span class="text-muted font-weight-bold d-block"><?php echo date_format($datetime,"d M, H:i")." "; ?></span>
											</td>
										</tr>
									</tbody>
									<!--end::Tbody-->
									<?php
									}
								?>
							</table>
							<footer>
								<div class="text-center"><a href="index.php?page=forums" class="btn btn-success">See More Forums</a></div><br><br>
							</footer>
						</div>
						<!--end::Table-->
					</div>
					<!--end::Tap pane-->
					<!--begin::Tap pane-->
					<div class="tab-pane fade show active" id="kt_tab_pane_10_2" role="tabpanel" aria-labelledby="kt_tab_pane_10_2">
						<span class="menu-label">
						<?php
                    $filter = ['school_id'=>$_SESSION["loggeduser_schoolID"],'Forum'=>'4'];
                    $option = ['limit'=>5,'sort' => ['_id' => -1]];
                    $query = new MongoDB\Driver\Query($filter,$option);
                    $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.SchoolForum',$query);

                    foreach ($cursor as $document)
                    {
                        $Forumid = ($document->_id);
                        $ForumTitle = ($document->ForumTitle);
                        $ForumDate = ($document->ForumDate);
                        $Consumer_id = ($document->Consumer_id);
                        
                        $utcdatetime = new MongoDB\BSON\UTCDateTime(strval($ForumDate));
                        $datetime = $utcdatetime->toDateTime()->setTimezone(new \DateTimeZone(date_default_timezone_get()));
                        $dateforum = date_format($datetime,"Y-m-d\TH:i:s");
                        $date = new MongoDB\BSON\UTCDateTime((new DateTime($dateforum))->getTimestamp());
                    
                        $oldtime = strval($date);

                        $consumerid = new \MongoDB\BSON\ObjectId($Consumer_id);
                        $filter1 = ['_id' => $consumerid];
                        $query1 = new MongoDB\Driver\Query($filter1);
                        $cursor1 = $GoNGetzDatabase->executeQuery('GoNGetz.Consumer', $query1);
        
                        foreach ($cursor1 as $document1)
                        {
                        $ConsumerFName = ($document1->ConsumerFName);
                        }

                        $total = 0;
                        $filter2 = ['School_id'=>$_SESSION["loggeduser_schoolID"],'Forum_id'=>$Forumid,'ForumParent_id'=>'0'];
                        $query2 = new MongoDB\Driver\Query($filter2);
                        $cursor2 = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.SchoolForumComment',$query2);
                        foreach ($cursor2 as $document2)
                        {
                            $total = $total + 1;
                        }
                        ?>
							<span class="text-muted mt-3 font-weight-bold font-size-sm">Latest Forum update 
						    <?php
						}
						?>
						</span>
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
                    $filter = ['school_id'=>$_SESSION["loggeduser_schoolID"],'Forum'=>'4'];
                    $option = ['limit'=>5,'sort' => ['_id' => -1]];
                    $query = new MongoDB\Driver\Query($filter,$option);
                    $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.SchoolForum',$query);

                    foreach ($cursor as $document)
                    {
                        $Forumid = ($document->_id);
                        $ForumTitle = ($document->ForumTitle);
                        $ForumDate = ($document->ForumDate);
                        $Consumer_id = ($document->Consumer_id);
                        
                        $utcdatetime = new MongoDB\BSON\UTCDateTime(strval($ForumDate));
                        $datetime = $utcdatetime->toDateTime()->setTimezone(new \DateTimeZone(date_default_timezone_get()));
                        $dateforum = date_format($datetime,"Y-m-d\TH:i:s");
                        $date = new MongoDB\BSON\UTCDateTime((new DateTime($dateforum))->getTimestamp());
                    
                        $oldtime = strval($date);

                        $consumerid = new \MongoDB\BSON\ObjectId($Consumer_id);
                        $filter1 = ['_id' => $consumerid];
                        $query1 = new MongoDB\Driver\Query($filter1);
                        $cursor1 = $GoNGetzDatabase->executeQuery('GoNGetz.Consumer', $query1);
        
                        foreach ($cursor1 as $document1)
                        {
                        $ConsumerFName = ($document1->ConsumerFName);
                        }

                        $total = 0;
                        $filter2 = ['School_id'=>$_SESSION["loggeduser_schoolID"],'Forum_id'=>$Forumid,'ForumParent_id'=>'0'];
                        $query2 = new MongoDB\Driver\Query($filter2);
                        $cursor2 = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.SchoolForumComment',$query2);
                        foreach ($cursor2 as $document2)
                        {
                            $total = $total + 1;
                        }
                        ?>
                        <?php
                        }
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
											<a href="index.php?page=schoolforumdetail&forum=1&topic=general&id=<?php echo $Forumid; ?>" class="text-dark-75 font-weight-bolder text-hover-primary mb-1 font-size-lg"><?php echo $ForumTitle; ?></a>
											<span class="text-muted font-weight-bold d-block"><?php echo " By ".$ConsumerFName;?></span>
											<span class="text-muted font-weight-bold d-block"><?php echo date_format($datetime,"d M, H:i")." "; ?></span>
										</td>
									</tr>
								</tbody>
								<?php
								
								?>
								<!--end::Tbody-->
							</table>
							<footer>
								<div class="text-center"><a href="index.php?page=forums" class="btn btn-success">See more Forums</a></div><br><br>
							</footer>
						</div>
						<!--end::Table-->
					</div>
					<!--end::Tap pane-->
				</div>
			</div>
			<!--end::Body-->
		</div>