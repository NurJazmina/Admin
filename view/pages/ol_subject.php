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
<style>
.gradient-custom {
  /* fallback for old browsers */
  background: #30cfd0;

  /* Chrome 10-25, Safari 5.1-6 */
  background: -webkit-linear-gradient(to left, rgba(48, 207, 208, 0.5), rgba(51, 8, 103, 0.5));

  /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
  background: linear-gradient(to left, rgba(48, 207, 208, 0.5), rgba(51, 8, 103, 0.5))
}
</style>
<!--begin::Content-->
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
	<!--begin::Subheader-->
	<div class="subheader py-2 py-lg-6 subheader-solid gradient-custom" id="kt_subheader">
		<div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap mx-3">
			<!--begin::Info-->
			<div class="d-flex align-items-center flex-wrap mr-1">
				<!--begin::Page Heading-->
				<div class="d-flex align-items-baseline flex-wrap mr-5">
					<!--begin::Page Title-->
					<h5 class="text-white font-weight-bold my-1 mr-5">Subject</h5>
					<!--end::Page Title-->
				</div>
                <!--begin::Separator-->
                <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-5 bg-gray-200"></div>
                <!--end::Separator-->
                <!--begin::Detail-->
                <div class="d-flex align-items-center" id="kt_subheader_search">
                <span class="text-white-50 font-weight-bold" id="kt_subheader_total"><?php echo $SubjectName; ?></span>
                </div>
                <!--end::Detail-->
				<!--end::Page Heading-->
			</div>
			<!--end::Info-->
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
                        <a href="index.php?page=ol_notes&id=<?= $Notes_id; ?>&slot=<?= $Note_sort; ?>"><h1  id="section0" contenteditable="false" style="color:#04ada5;">SLOT <?php echo $Note_sort." : ".$Title; ?> </h1></a>
                    </div>
                    </div>
                    <div class="px-10 mb-10" id="contentinfo">
                        <a align="justify"><?php echo mb_strimwidth($Detail, 0,900, "..."); ?></a>
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
                                <a  style="color:#04ada5;" href="index.php?page=ol_submit_assignment&id=<?php echo $Assignment_id; ?>">
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
                                <a  style="color:#04ada5;" href="index.php?page=ol_submit_quiz&id=<?php echo $Quiz_id; ?>">
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
                            $Url = $document->Url;
                            ?>
                            <div class="checkbox-inline mb-5">
                                <a  style="color:#04ada5;" href="<?php echo $Url; ?>">
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
                                <a  style="color:#04ada5;" href="index.php?page=ol_submit_survey&id=<?php echo $Survey_id; ?>">
                                <img class="icon icon px-5" alt="" aria-hidden="true" src="assets/media/svg/social-icons/survey.svg"><?php echo " ".$Title; ?>
                                </a>
                            </div>
                            <?php
                        }
                        $filter = ['Notes_id'=>$Notes_id];
                        $query = new MongoDB\Driver\Query($filter);
                        $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.OL_Announcement',$query);
                        foreach ($cursor as $document)
                        {
                            $Announcement_id = $document->_id;
                            $Title = $document->Title;
                            $Description = $document->Description;
                            ?>
                            <div class="checkbox-inline mb-5">
                                <a  style="color:#04ada5;" href="index.php?page=ol_announcement&id=<?php echo $Announcement_id; ?>">
                                <img class="icon icon px-5" alt="" aria-hidden="true" src="assets/media/svg/social-icons/forum.svg"><?php echo " ".$Title; ?>
                                </a>
                            </div>
                            <?php
                        }
                        ?>
                    </div>
                    <div class="separator separator-dashed my-10 separator-success"></div>
                    <?php
                }
                ?>
            </div>
            <div class="row">
                <div class="col-sm text-right">
                    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#topic" data-bs-whatever="<?php echo $Notes_id; ?>">
                    <i class="icon fa fa-plus fa-fw text-light-success" aria-hidden="true"></i>  Add Topic
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
<?php 
include ('view/pages/modal-sorting.php'); 
?>