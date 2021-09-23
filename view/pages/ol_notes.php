<?php
include ('model/notes.php');
include ('model/subject.php');
include ('model/assignment.php');
include ('model/quiz.php');
include 'model/survey.php';
include ('model/announcement.php');
include ('model/url.php');

$Notes_id = strval($_GET['id']);
$slot = ($_GET['slot']);

$filter = ['_id'=>new \MongoDB\BSON\ObjectId($Notes_id)];
$query = new MongoDB\Driver\Query($filter);
$cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.OL_Notes',$query);
foreach ($cursor as $document)
{
    $Subject_id = strval($document->Subject_id);
    $filter = ['_id'=>new \MongoDB\BSON\ObjectId($Subject_id)];
    $query = new MongoDB\Driver\Query($filter);
    $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.SchoolsSubject',$query);
    foreach ($cursor as $document1)
    {
        $SubjectName = $document1->SubjectName;
    }
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
<!--begin::Subheader-->
<div class="subheader py-2 py-lg-6 subheader-solid gradient-custom" id="kt_subheader">
    <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap mx-3">
        <!--begin::Info-->
        <div class="d-flex align-items-center flex-wrap mr-1">
            <!--begin::Page Heading-->
            <div class="d-flex align-items-baseline flex-wrap mr-5">
                <!--begin::Page Title-->
                <h5 class="text-white font-weight-bold my-1 mr-5"><?= $SubjectName; ?></h5>
                <!--end::Page Title-->
            </div>
            <!--begin::Separator-->
            <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-5 bg-gray-200"></div>
            <!--end::Separator-->
            <!--begin::Detail-->
            <div class="d-flex align-items-center" id="kt_subheader_search">
            <span class="text-white-50 font-weight-bold" id="kt_subheader_total"><?= "SLOT ".$slot ?></span>
            </div>
            <!--end::Detail-->
            <!--end::Page Heading-->
        </div>
	</div>
</div>
<!--end::Subheader-->

<div class="content d-flex flex-column flex-column-fluid">
    <div class="card card-custom gutter-b">
        <div class="card-body">
            <div class="row">
               <?php
                $filter = ['_id'=>new \MongoDB\BSON\ObjectId($Notes_id)];
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
                        <h1  id="section0" contenteditable="false" style="color:#04ada5;">SLOT <?= $Note_sort." : ".$Title; ?> </h1>
                        <?php
                        if ($_SESSION["loggeduser_ACCESS"] == 'TEACHER')
                        {
                            ?>
                            <div class="col-sm text-right">
                                <i class="fas fa-pencil-alt text-success" type="button" data-bs-toggle="dropdown"></i>
                                <div class="dropdown-menu dropdown-menu-md py-5">
                                    <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#edit" data-bs-whatever="<?= $Notes_id; ?>">
                                        <span class="navi-icon"><i class="icon fa fa-cog fa-fw text-success"></i></span>
                                        <span class="navi-text">Edit Topic</span>
                                    </button>
                                    <form name="hidenotes" action="#" method="post">
                                        <input type="hidden" name="notes_id" value="<?= $Notes_id; ?>">
                                        <button type="submit" name="hidenotes" class="btn">
                                            <span class="navi-icon"><i class="far fa-eye text-success"></i></span>
                                            <span class="navi-text">Hide Topic</span>
                                        </button>
                                    </form>
                                    <form name="deletenotes" action="#" method="post">
                                        <input type="hidden" name="notes_id" value="<?= $Notes_id; ?>">
                                        <button type="submit" name="deletenotes" class="btn">
                                            <span class="navi-icon"><i class="fas fa-trash-alt text-success"></i></span>
                                            <span class="navi-text">Delete Topic</span>
                                        </button>
                                    </form>
                                </div>
                            </div>
                            <?php
                        }
                        ?>
                    </div>
                    </div>
                    <div class="mb-10" id="contentinfo">
                        <a align="justify"><?= $Detail; ?></a>
                    </div>
                    <div id="assignment">
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
                                <a  style="color:#04ada5;" href="index.php?page=ol_submit_assignment&id=<?= $Assignment_id; ?>">
                                <img class="icon icon px-5" alt="" aria-hidden="true" src="assets/media/svg/social-icons/handgiving.svg"><?= " ".$Title; ?>
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
                                <a  style="color:#04ada5;" href="index.php?page=ol_submit_quiz&id=<?= $Quiz_id; ?>">
                                <img class="icon icon px-5" alt="" aria-hidden="true" src="assets/media/svg/social-icons/quiz.svg"><?= " ".$Title; ?>
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
                                <a  style="color:#04ada5;" href="<?= $Url; ?>">
                                <img class="icon icon px-5" alt="" aria-hidden="true" src="assets/media/svg/social-icons/url.svg"><?= " ".$Title; ?>
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
                                <a  style="color:#04ada5;" href="index.php?page=ol_submit_survey&id=<?= $Survey_id; ?>">
                                <img class="icon icon px-5" alt="" aria-hidden="true" src="assets/media/svg/social-icons/survey.svg"><?= " ".$Title; ?>
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
                                <a  style="color:#04ada5;" href="index.php?page=ol_announcement&id=<?= $Announcement_id; ?>">
                                <img class="icon icon px-5" alt="" aria-hidden="true" src="assets/media/svg/social-icons/forum.svg"><?= " ".$Title; ?>
                                </a>
                            </div>
                            <?php
                        }
                        ?>
                    </div>
                    <?php
                    if ($_SESSION["loggeduser_ACCESS"] == 'TEACHER')
                    {
                    ?>
                    <div class="col-sm text-right">
                        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#activity">
                            <i class="icon fa fa-plus fa-fw text-light-success"></i>  Add an activity or resource
                        </button>
                    </div>
                    <?php
                    }
                }
                ?>
            </div>
        </div>
    </div>
</div>
<?php 
include ('view/pages/ol_modal-activity.php'); 
include ('view/pages/ol_modal-notes.php'); 
?>
