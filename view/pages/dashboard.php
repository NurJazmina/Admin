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
.construction {
    font-size: 1rem;
    line-height: 1.65;
    font-family: 'Poppins', sans-serif;
    background: linear-gradient(to right, #41c5bd 50%, #ffffff 50%);
    color: #ffffff;
}

.uc__wrapper {
	padding-top: 10%;
	padding-bottom: 10%;
    height: auto;
    display: flex;
    justify-content: space-between;
}

.uc__details {
    flex-basis: 50%;
    display: flex;
    flex-direction: column;
    padding: 0 2rem;
    align-items: flex-start;
    justify-content: center;
}

.uc__art {
    display: flex;
    align-items: center;
    justify-content: center;
}

.comingsoon{
    display: inline-block;
    font-size: 40px;
    position: relative;
    margin-bottom: 1rem;
}

.intro {
    font-size: 15px;
    font-weight: normal;
    text-transform: uppercase;
    letter-spacing: 1px;
    margin-bottom: 1rem;
}
</style>
<div class="row">
	<div class="col">
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
							<a href="#" class="card-title font-weight-bolder text-dark-75 text-hover-primary font-size-h4 m-0 pt-7 pb-1"><?= $_SESSION["loggeduser_schoolName"]; ?></a>
							<!--end::Title-->
							<!--begin::Text-->
							<div class="font-weight-bold text-dark-50 font-size-sm pb-7"><?= $_SESSION["loggeduser_schoolsAddress"]; ?></div>
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
								<span class="font-weight-bolder label label-xl label-light-success label-inline px-3 py-5 min-w-45px"><?= $_SESSION["totalstaff"] ?></span>
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
								<span class="font-weight-bolder label label-xl label-light-danger label-inline px-3 py-5 min-w-45px"><?= $_SESSION["totalteacher"] ?></span>
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
								<span class="font-weight-bolder label label-xl label-light-primary label-inline py-5 min-w-45px"><?= $_SESSION["totalstudent"] ?></span>
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
								<span class="font-weight-bolder label label-xl label-light-info label-inline px-3 py-5 min-w-45px"><?= $_SESSION["totalparent"] ?></span>
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
		<!-- forum commenting section -->
		<!-- <div class="card card-custom gutter-b">
			<div class="card-body">
				<div class="d-flex justify-content-between flex-column h-100">
					<div class="h-100">
						<div class="d-flex flex-column flex">
						<h3 class="card-title align-items-start flex-column">
						<span class="card-label font-weight-bolder font-size-h4 text-dark-75">Forum Commenting Section</span>
						</div>
						<div class="pt-1">
						(Forum commenting section will be included here)
						</div>
					</div>
					<br>
					<div class="d-flex flex" id="kt_sticky_toolbar_chat_toggler_2" data-toggle="tooltip" title="" data-placement="right" data-original-title="Chat Example">
					(Contents)
					</div>
				</div>
			</div>
		</div> -->
		<!-- end forum commenting section -->
	</div>
	<div class="col">
		<div class="card card-custom gutter-b">
		    <div class="construction">
				<div class="uc__wrapper">
					<div class="uc__details">
						<h1 class="comingsoon">Coming Soon!</h1>
						<h3 class="intro">
							We are working hard to give you a better experience.
						</h3>
						<p class="uc__description">
							Features
							<span class="svg-icon svg-icon-light svg-icon-1x"><!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\themes\metronic\theme\html\demo1\dist/../src/media/svg/icons\Communication\Forward.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
								<g  stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
									<rect x="0" y="0" width="24" height="24"/>
									<path d="M12.6571817,10 L12.6571817,5.67013288 C12.6571817,5.25591932 12.3213953,4.92013288 11.9071817,4.92013288 C11.7234961,4.92013288 11.5461972,4.98754181 11.4089088,5.10957589 L4.25168161,11.4715556 C3.94209454,11.7467441 3.91420899,12.2207984 4.1893975,12.5303855 C4.19915701,12.541365 4.209237,12.5520553 4.21962441,12.5624427 L11.3768516,19.7196699 C11.6697448,20.0125631 12.1446186,20.0125631 12.4375118,19.7196699 C12.5781641,19.5790176 12.6571817,19.3882522 12.6571817,19.1893398 L12.6571817,15 C14.004369,14.9188289 16.83481,14.9157978 21.1485046,14.9909069 L21.1485051,14.9908794 C21.4245904,14.9956866 21.6522988,14.7757721 21.6571059,14.4996868 C21.6571564,14.4967857 21.6571817,14.4938842 21.6571817,14.4909827 L21.6572352,10.5050185 C21.6572352,10.2288465 21.4333536,10.0049649 21.1571817,10.0049649 C21.1555649,10.0049649 21.1539481,10.0049728 21.1523314,10.0049884 C16.0215539,10.0547574 13.1898373,10.0530946 12.6571817,10 Z" fill="#000000" fill-rule="nonzero" transform="translate(12.828591, 12.429736) scale(-1, 1) translate(-12.828591, -12.429736) "/>
								</g>
							</svg><!--end::Svg Icon--></span>
						    Library<br>We promise, it will be worth the wait!
						</p>
						<!--
						<div class="uc__subscribe">
							<h3>Get Notified When We Go Live</h3>
							<div class="uc__form">
								<form action="#">
									<input type="email" class="email" placeholder="Email Address..">
									<input type="submit" class="submit" value="Get Notified">
								</form>
							</div>
						</div>
						-->
					</div>
					<div class="uc__art">
						<img style="width: 85%;" src="assets/media/svg/construction/under_construction.svg" alt="">
					</div>
				</div>
			</div>
		</div>
		<div class="card card-custom gutter-b">
		    <div class="construction">
				<div class="uc__wrapper">
					<div class="uc__details">
						<h1 class="title">Coming Soon!</h1> 
						<h3 class="intro">
							We are working hard to give you a better experience.
						</h3>
						<p class="uc__description">
							Features
							<span class="svg-icon svg-icon-light svg-icon-1x"><!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\themes\metronic\theme\html\demo1\dist/../src/media/svg/icons\Communication\Forward.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
								<g  stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
									<rect x="0" y="0" width="24" height="24"/>
									<path d="M12.6571817,10 L12.6571817,5.67013288 C12.6571817,5.25591932 12.3213953,4.92013288 11.9071817,4.92013288 C11.7234961,4.92013288 11.5461972,4.98754181 11.4089088,5.10957589 L4.25168161,11.4715556 C3.94209454,11.7467441 3.91420899,12.2207984 4.1893975,12.5303855 C4.19915701,12.541365 4.209237,12.5520553 4.21962441,12.5624427 L11.3768516,19.7196699 C11.6697448,20.0125631 12.1446186,20.0125631 12.4375118,19.7196699 C12.5781641,19.5790176 12.6571817,19.3882522 12.6571817,19.1893398 L12.6571817,15 C14.004369,14.9188289 16.83481,14.9157978 21.1485046,14.9909069 L21.1485051,14.9908794 C21.4245904,14.9956866 21.6522988,14.7757721 21.6571059,14.4996868 C21.6571564,14.4967857 21.6571817,14.4938842 21.6571817,14.4909827 L21.6572352,10.5050185 C21.6572352,10.2288465 21.4333536,10.0049649 21.1571817,10.0049649 C21.1555649,10.0049649 21.1539481,10.0049728 21.1523314,10.0049884 C16.0215539,10.0547574 13.1898373,10.0530946 12.6571817,10 Z" fill="#000000" fill-rule="nonzero" transform="translate(12.828591, 12.429736) scale(-1, 1) translate(-12.828591, -12.429736) "/>
								</g>
							</svg><!--end::Svg Icon--></span>
							User Activity<br>We promise, it will be worth the wait!
						</p>
						<!--
						<div class="uc__subscribe">
							<h3>Get Notified When We Go Live</h3>
							<div class="uc__form">
								<form action="#">
									<input type="email" class="email" placeholder="Email Address..">
									<input type="submit" class="submit" value="Get Notified">
								</form>
							</div>
						</div>
						-->
					</div>
					<div class="uc__art">
						<img style="width: 85%;" src="assets/media/svg/construction/under_construction.svg" alt="">
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="col">

	</div>
</div>
