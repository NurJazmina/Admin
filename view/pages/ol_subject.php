<?php
$Subject_id = ($_GET['id']);
include ('model/subject.php');

$filter = ['_id'=>new \MongoDB\BSON\ObjectId($Subject_id)];
$query = new MongoDB\Driver\Query($filter);
$cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.SchoolsSubject',$query);
foreach ($cursor as $document)
{
    $SubjectName = $document->SubjectName;
}
?>
<!--begin::Content-->
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
	<!--begin::Subheader-->
	<div class="subheader py-2 py-lg-6 subheader-solid" id="kt_subheader">
		<div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
			<!--begin::Info-->
			<div class="d-flex align-items-center flex-wrap mr-1">
				<!--begin::Page Heading-->
				<div class="d-flex align-items-baseline flex-wrap mr-5">
					<!--begin::Page Title-->
					<h5 class="text-dark font-weight-bold my-1 mr-5">Subject</h5>
					<!--end::Page Title-->
				</div>
                <!--begin::Separator-->
                <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-5 bg-gray-200"></div>
                <!--end::Separator-->
                <!--begin::Detail-->
                <div class="d-flex align-items-center" id="kt_subheader_search">
                <span class="text-dark-50 font-weight-bold" id="kt_subheader_total"><?php echo $SubjectName; ?></span>
                </div>
                <!--end::Detail-->
				<!--end::Page Heading-->
			</div>
			<!--end::Info-->
			<!--begin::Toolbar-->
			<div class="d-flex align-items-center">
            <div class="col-12 col-sm-12 col-sm-12">
                <div class="col-12 col-sm-12 col-lg-12 text-right">
                <div class="row">
                    <div class="input-group input-group-sm " style="width:25%">
                        <span class="svg-icon svg-icon-success svg-icon-2x" type="button" data-bs-toggle="dropdown">
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <rect x="0" y="0" width="24" height="24"/>
                                <path d="M18.6225,9.75 L18.75,9.75 C19.9926407,9.75 21,10.7573593 21,12 C21,13.2426407 19.9926407,14.25 18.75,14.25 L18.6854912,14.249994 C18.4911876,14.250769 18.3158978,14.366855 18.2393549,14.5454486 C18.1556809,14.7351461 18.1942911,14.948087 18.3278301,15.0846699 L18.372535,15.129375 C18.7950334,15.5514036 19.03243,16.1240792 19.03243,16.72125 C19.03243,17.3184208 18.7950334,17.8910964 18.373125,18.312535 C17.9510964,18.7350334 17.3784208,18.97243 16.78125,18.97243 C16.1840792,18.97243 15.6114036,18.7350334 15.1896699,18.3128301 L15.1505513,18.2736469 C15.008087,18.1342911 14.7951461,18.0956809 14.6054486,18.1793549 C14.426855,18.2558978 14.310769,18.4311876 14.31,18.6225 L14.31,18.75 C14.31,19.9926407 13.3026407,21 12.06,21 C10.8173593,21 9.81,19.9926407 9.81,18.75 C9.80552409,18.4999185 9.67898539,18.3229986 9.44717599,18.2361469 C9.26485393,18.1556809 9.05191298,18.1942911 8.91533009,18.3278301 L8.870625,18.372535 C8.44859642,18.7950334 7.87592081,19.03243 7.27875,19.03243 C6.68157919,19.03243 6.10890358,18.7950334 5.68746499,18.373125 C5.26496665,17.9510964 5.02757002,17.3784208 5.02757002,16.78125 C5.02757002,16.1840792 5.26496665,15.6114036 5.68716991,15.1896699 L5.72635306,15.1505513 C5.86570889,15.008087 5.90431906,14.7951461 5.82064513,14.6054486 C5.74410223,14.426855 5.56881236,14.310769 5.3775,14.31 L5.25,14.31 C4.00735931,14.31 3,13.3026407 3,12.06 C3,10.8173593 4.00735931,9.81 5.25,9.81 C5.50008154,9.80552409 5.67700139,9.67898539 5.76385306,9.44717599 C5.84431906,9.26485393 5.80570889,9.05191298 5.67216991,8.91533009 L5.62746499,8.870625 C5.20496665,8.44859642 4.96757002,7.87592081 4.96757002,7.27875 C4.96757002,6.68157919 5.20496665,6.10890358 5.626875,5.68746499 C6.04890358,5.26496665 6.62157919,5.02757002 7.21875,5.02757002 C7.81592081,5.02757002 8.38859642,5.26496665 8.81033009,5.68716991 L8.84944872,5.72635306 C8.99191298,5.86570889 9.20485393,5.90431906 9.38717599,5.82385306 L9.49484664,5.80114977 C9.65041313,5.71688974 9.7492905,5.55401473 9.75,5.3775 L9.75,5.25 C9.75,4.00735931 10.7573593,3 12,3 C13.2426407,3 14.25,4.00735931 14.25,5.25 L14.249994,5.31450877 C14.250769,5.50881236 14.366855,5.68410223 14.552824,5.76385306 C14.7351461,5.84431906 14.948087,5.80570889 15.0846699,5.67216991 L15.129375,5.62746499 C15.5514036,5.20496665 16.1240792,4.96757002 16.72125,4.96757002 C17.3184208,4.96757002 17.8910964,5.20496665 18.312535,5.626875 C18.7350334,6.04890358 18.97243,6.62157919 18.97243,7.21875 C18.97243,7.81592081 18.7350334,8.38859642 18.3128301,8.81033009 L18.2736469,8.84944872 C18.1342911,8.99191298 18.0956809,9.20485393 18.1761469,9.38717599 L18.1988502,9.49484664 C18.2831103,9.65041313 18.4459853,9.7492905 18.6225,9.75 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"/>
                                <path d="M12,15 C13.6568542,15 15,13.6568542 15,12 C15,10.3431458 13.6568542,9 12,9 C10.3431458,9 9,10.3431458 9,12 C9,13.6568542 10.3431458,15 12,15 Z" fill="#000000"/>
                            </g>
                        </svg>
                        </span>
                        <div class="dropdown-menu dropdown-menu-md py-5">
                            <ul class="navi navi-hover">
                                <li class="navi-item">
                                    <a class="navi-link" href="#">
                                        <span class="navi-icon"><i class="icon fa fa-cog fa-fw text-success"></i></span>
                                        <span class="navi-text">Edit setting</span>
                                    </a>
                                </li>
                                <li class="navi-item">
                                    <a class="navi-link" href="#">
                                        <span class="navi-icon"><i class="icon fa fa-cog fa-fw text-success"></i></span>
                                        <span class="navi-text">Course completion</span>
                                    </a>
                                </li>
                                <li class="navi-item">
                                    <a class="navi-link" href="#">
                                        <span class="navi-icon"><i class="icon fa fa-filter fa-fw text-success"></i></span>
                                        <span class="navi-text">Filters</span>
                                    </a>
                                </li>
                                <li class="navi-item">
                                    <a class="navi-link" href="#">
                                        <span class="navi-icon"><i class="icon fa fa-cog fa-fw text-success"></i></span>
                                        <span class="navi-text">Gradebook setup</span>
                                    </a>
                                </li>
                                <li class="navi-item">
                                    <a class="navi-link" href="#">
                                        <span class="navi-icon"><i class="icon fa fa-tasks fa-fw text-success"></i></span>
                                        <span class="navi-text">Outcomes</span>
                                    </a>
                                </li>
                                <li class="navi-item">
                                    <a class="navi-link" href="#">
                                        <span class="navi-icon">
                                        <span class="svg-icon svg-icon-success svg-icon-2x">
                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <polygon points="0 0 24 0 24 24 0 24"/>
                                                <path d="M5.85714286,2 L13.7364114,2 C14.0910962,2 14.4343066,2.12568431 14.7051108,2.35473959 L19.4686994,6.3839416 C19.8056532,6.66894833 20,7.08787823 20,7.52920201 L20,20.0833333 C20,21.8738751 19.9795521,22 18.1428571,22 L5.85714286,22 C4.02044787,22 4,21.8738751 4,20.0833333 L4,3.91666667 C4,2.12612489 4.02044787,2 5.85714286,2 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"/>
                                                <path d="M8.95128003,13.8153448 L10.9077535,13.8153448 L10.9077535,15.8230161 C10.9077535,16.0991584 11.1316112,16.3230161 11.4077535,16.3230161 L12.4310522,16.3230161 C12.7071946,16.3230161 12.9310522,16.0991584 12.9310522,15.8230161 L12.9310522,13.8153448 L14.8875257,13.8153448 C15.1636681,13.8153448 15.3875257,13.5914871 15.3875257,13.3153448 C15.3875257,13.1970331 15.345572,13.0825545 15.2691225,12.9922598 L12.3009997,9.48659872 C12.1225648,9.27584861 11.8070681,9.24965194 11.596318,9.42808682 C11.5752308,9.44594059 11.5556598,9.46551156 11.5378061,9.48659872 L8.56968321,12.9922598 C8.39124833,13.2030099 8.417445,13.5185067 8.62819511,13.6969416 C8.71848979,13.773391 8.8329684,13.8153448 8.95128003,13.8153448 Z" fill="#000000"/>
                                            </g>
                                        </svg>
                                        </span>
                                        </span>
                                        <span class="navi-text">Backup</span>
                                    </a>
                                </li>
                                <li class="navi-item">
                                    <a class="navi-link" href="#">
                                        <span class="navi-icon"><span class="svg-icon svg-icon-success svg-icon-2x">
                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <polygon points="0 0 24 0 24 24 0 24"/>
                                                <path d="M5.85714286,2 L13.7364114,2 C14.0910962,2 14.4343066,2.12568431 14.7051108,2.35473959 L19.4686994,6.3839416 C19.8056532,6.66894833 20,7.08787823 20,7.52920201 L20,20.0833333 C20,21.8738751 19.9795521,22 18.1428571,22 L5.85714286,22 C4.02044787,22 4,21.8738751 4,20.0833333 L4,3.91666667 C4,2.12612489 4.02044787,2 5.85714286,2 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"/>
                                                <path d="M14.8875071,11.8306874 L12.9310336,11.8306874 L12.9310336,9.82301606 C12.9310336,9.54687369 12.707176,9.32301606 12.4310336,9.32301606 L11.4077349,9.32301606 C11.1315925,9.32301606 10.9077349,9.54687369 10.9077349,9.82301606 L10.9077349,11.8306874 L8.9512614,11.8306874 C8.67511903,11.8306874 8.4512614,12.054545 8.4512614,12.3306874 C8.4512614,12.448999 8.49321518,12.5634776 8.56966458,12.6537723 L11.5377874,16.1594334 C11.7162223,16.3701835 12.0317191,16.3963802 12.2424692,16.2179453 C12.2635563,16.2000915 12.2831273,16.1805206 12.3009811,16.1594334 L15.2691039,12.6537723 C15.4475388,12.4430222 15.4213421,12.1275254 15.210592,11.9490905 C15.1202973,11.8726411 15.0058187,11.8306874 14.8875071,11.8306874 Z" fill="#000000"/>
                                            </g>
                                        </svg>
                                        </span>
                                        </span>
                                        <span class="navi-text">Restore</span>
                                    </a>
                                </li>
                                <li class="navi-item">
                                    <a class="navi-link" href="#">
                                        <span class="navi-icon">
                                        <span class="svg-icon svg-icon-success svg-icon-2x">
                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <rect x="0" y="0" width="24" height="24"/>
                                                <path d="M2,13 C2,12.5 2.5,12 3,12 C3.5,12 4,12.5 4,13 C4,13.3333333 4,15 4,18 C4,19.1045695 4.8954305,20 6,20 L18,20 C19.1045695,20 20,19.1045695 20,18 L20,13 C20,12.4477153 20.4477153,12 21,12 C21.5522847,12 22,12.4477153 22,13 L22,18 C22,20.209139 20.209139,22 18,22 L6,22 C3.790861,22 2,20.209139 2,18 C2,15 2,13.3333333 2,13 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"/>
                                                <rect fill="#000000" opacity="0.3" transform="translate(12.000000, 8.000000) rotate(-180.000000) translate(-12.000000, -8.000000) " x="11" y="1" width="2" height="14" rx="1"/>
                                                <path d="M7.70710678,15.7071068 C7.31658249,16.0976311 6.68341751,16.0976311 6.29289322,15.7071068 C5.90236893,15.3165825 5.90236893,14.6834175 6.29289322,14.2928932 L11.2928932,9.29289322 C11.6689749,8.91681153 12.2736364,8.90091039 12.6689647,9.25670585 L17.6689647,13.7567059 C18.0794748,14.1261649 18.1127532,14.7584547 17.7432941,15.1689647 C17.3738351,15.5794748 16.7415453,15.6127532 16.3310353,15.2432941 L12.0362375,11.3779761 L7.70710678,15.7071068 Z" fill="#000000" fill-rule="nonzero" transform="translate(12.000004, 12.499999) rotate(-180.000000) translate(-12.000004, -12.499999) "/>
                                            </g>
                                        </svg>
                                        </span>
                                        </span>
                                        <span class="navi-text">Import</span>
                                    </a>
                                </li>
                                <li class="navi-item">
                                    <a class="navi-link" href="#">
                                        <span class="navi-icon"><i class="icon fa fa-arrow-left fa-fw text-success"></i></span>
                                        <span class="navi-text">Reset</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <button type="submit" style="width:75%;" class="btn btn-success font-weight-bolder btn-sm" name="editing">Turn Editing On</button>
                </div>
                </div>
            </div>
		</div>
		<!--end::Toolbar-->
	</div>
</div>
<!--end::Subheader-->

<div class="content d-flex flex-column flex-column-fluid">
    <div class="card card-custom gutter-b px-5">
        <div class="card-body">
            <div class="row">
               <?php
                $filter = ['Subject_id'=>$Subject_id];
                $query = new MongoDB\Driver\Query($filter);
                $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.OL_Notes',$query);
                foreach ($cursor as $document)
                {
                    $Notes_id = strval($document->_id);
                    $Title = $document->Title;
                    $Detail = $document->Detail;
                    $Note_sort = $document->Note_sort;
                    ?>
                    <div class="col-sm">
                    <div class="checkbox-inline">
                        <h3  id="section0" contenteditable="true" style="color:#04ada5;">SLOT <?php echo $Note_sort." : ".$Title; ?> </h3>
                        <div class="col-sm text-right">
                            <i class="fas fa-pencil-alt" type="button" data-bs-toggle="dropdown"> EDIT</i>
                            <div class="dropdown-menu dropdown-menu-md py-5">
                                <ul class="navi navi-hover">
                                    <li class="navi-item">
                                        <a class="navi-link" href="#">
                                            <span class="navi-icon"><i class="icon fa fa-cog fa-fw text-success"></i></span>
                                            <span class="navi-text">Edit Topic</span>
                                        </a>
                                    </li>
                                    <li class="navi-item">
                                        <a class="navi-link" href="#">
                                            <span class="navi-icon"><i class="far fa-eye text-success"></i></span>
                                            <span class="navi-text">Hide Topic</span>
                                        </a>
                                    </li>
                                    <li class="navi-item">
                                        <a class="navi-link" href="#">
                                            <span class="navi-icon"><i class="fas fa-trash-alt text-success"></i></span>
                                            <span class="navi-text">Delete Topic</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    </div>
                    <div class="px-10 mb-10" id="contentinfo">
                        <p><?php echo $Detail; ?></p>
                    </div>
                    <div class="px-5" id="assignment">
                        <?php
                        $filter = ['Notes_id'=>$Notes_id];
                        $query = new MongoDB\Driver\Query($filter);
                        $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.OL_Assignment',$query);
                        foreach ($cursor as $document)
                        {
                            $Assignment_id = $document->_id;
                            $Title = $document->Title;
                        ?>
                        <div class="checkbox-inline mb-5">
                            <a  style="color:#04ada5;" href="index.php?page=ol_submit_assignment&Notes=<?php echo $Notes_id; ?>">
                            <img class="icon icon px-5" alt="" aria-hidden="true" src="assets/media/svg/social-icons/handgiving.svg"><?php echo " ".$Title; ?>
                            </a>
                        </div>
                        <?php
                        }
                        $filter = ['Notes_id'=>$Notes_id];
                        $query = new MongoDB\Driver\Query($filter);
                        $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.OL_Quiz',$query);
                        foreach ($cursor as $document)
                        {
                            $Quiz_id = $document->_id;
                            $Title = $document->Title;
                        ?>
                        <div class="checkbox-inline mb-5">
                            <a  style="color:#04ada5;" href="#">
                            <img class="icon icon px-5" alt="" aria-hidden="true" src="assets/media/svg/social-icons/quiz.svg"><?php echo " ".$Title; ?>
                            </a>
                        </div>
                        <?php
                        }
                        $filter = ['Notes_id'=>$Notes_id];
                        $query = new MongoDB\Driver\Query($filter);
                        $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.OL_URL',$query);
                        foreach ($cursor as $document)
                        {
                            $URL_id = $document->_id;
                            $Title = $document->Title;
                        ?>
                        <div class="checkbox-inline mb-5">
                            <a  style="color:#04ada5;" href="#">
                            <img class="icon icon px-5" alt="" aria-hidden="true" src="assets/media/svg/social-icons/url.svg"><?php echo " ".$Title; ?>
                            </a>
                        </div>
                        <?php
                        }
                        $filter = ['Notes_id'=>$Notes_id];
                        $query = new MongoDB\Driver\Query($filter);
                        $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.OL_Survey',$query);
                        foreach ($cursor as $document)
                        {
                            $Survey_id = $document->_id;
                            $Title = $document->Title;
                        ?>
                        <div class="checkbox-inline mb-5">
                            <a  style="color:#04ada5;" href="#">
                            <img class="icon icon px-5" alt="" aria-hidden="true" src="assets/media/svg/social-icons/survey.svg"><?php echo " ".$Title; ?>
                            </a>
                        </div>
                        <?php
                        }
                        ?>
                    </div>
                    <div class="col-sm text-right">
                        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#activity">
                        <i class="icon fa fa-plus fa-fw text-light-success" aria-hidden="true"></i>  Add an activity or resource
                        </button>
                    </div>
                    <div class="separator separator-dashed my-10"></div>
                    <?php
                }
                ?>
            </div>
            <div class="row">
                <div class="col-sm text-right">
                    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#topic" data-bs-whatever="<?php echo $Subject_id; ?>">
                    <i class="icon fa fa-plus fa-fw text-light-success" aria-hidden="true"></i>  Add Topic
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include ('view/pages/modal-activity.php'); ?>
<?php include ('view/pages/modal-sorting.php'); ?>
<script>
    var topic = document.getElementById('topic')
    topic.addEventListener('show.bs.modal', function (event) {
      // Button that triggered the modal
      var button = event.relatedTarget
      // Extract info from data-bs-* attributes
      var recipient = button.getAttribute('data-bs-whatever')
      // If necessary, you could initiate an AJAX request here
      // and then do the updating in a callback.
      //
      // Update the modal's content.
      var modalTitle = topic.querySelector('.modal-title')
      var modalBodyInput = topic.querySelector('.modal-body input')
      modalBodyInput.value = recipient
      })
</script>
