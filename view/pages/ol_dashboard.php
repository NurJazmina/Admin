<?php
include ('model/ol_dashboard.php'); 
?>
<style>
.show>.btn-outline-secondary.dropdown-toggle {
    color: #fff;
    background-color: #6c757d;
    border-color: #6c757d;
}
.btn:not(:disabled):not(.disabled) {
    cursor: pointer;
}

.list-group-item {
    position: relative;
    display: block;
    padding: .75rem 1.25rem;
    background-color: #fff;
    border: 1px solid rgba(0,0,0,.125);
}
</style>
<!--begin::Subheader-->
<div class="subheader py-2 py-lg-6 subheader-solid gradient-custom" id="kt_subheader">
    <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
        <!--begin::Info-->
        <div class="d-flex align-items-center flex-wrap mr-1">
            <!--begin::Page Heading-->
            <div class="d-flex align-items-baseline flex-wrap mr-5">
                <!--begin::Page Title-->
                <h5 class="text-white font-weight-bold my-1 mr-5">Online Learning</h5>
                <!--end::Page Title-->
            </div>
            <!--begin::Separator-->
            <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-5 bg-gray-200"></div>
            <!--end::Separator-->
            <!--begin::Detail-->
            <div class="d-flex align-items-center" id="kt_subheader_search">
            <span class="text-white-50 font-weight-bold" id="kt_subheader_total">Dashboard</span>
            </div>
            <!--end::Detail-->
            <!--end::Page Heading-->
        </div>
        <!--end::Info-->
        <!--begin::Toolbar-->
    </div>
    <!--end::Toolbar-->
</div>
<!--end::Subheader-->
<div class="card card-custom gutter-b">
    <main class="" x-data="{'layout': 'grid'}">
        <div class="card-header">
            <div class="card-title">
                <h3 class="card-label">NOTES</h3>
            </div>
            <div data-region="filter" class="d-flex flex-wrap" aria-label="Course overview controls" >
                <div class="dropdown">
                    <button id="groupingdropdown" type="button" class="btn btn-outline-secondary btn-hover-light dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" aria-label="Grouping drop-down menu">
                        <i class="icon fa fa-filter fa-fw" style="color:#7E8299;"></i>
                        <span class="d-sm-inline-block" data-active-item-text="">All (except removed from view)</span>
                    </button>
                    <ul class="dropdown-menu" role="menu" data-show-active-item="" data-skip-active-class="true" data-active-item-text="" aria-labelledby="groupingdropdown" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 36px, 0px); top: 0px; left: 0px; will-change: transform;">
                        <li>
                            <a class="dropdown-item" href="index.php?page=ol_dashboard&status=all">All (except removed from view)</a>
                        </li>
                        <li class="dropdown-divider" role="presentation">
                            <span class="filler">&nbsp;</span>
                        </li>
                        <li>
                            <a class="dropdown-item" href="index.php?page=ol_dashboard&status=favourites">Starred</a>
                        </li><li class="dropdown-divider" role="presentation">
                            <span class="filler">&nbsp;</span>
                        </li>
                        <li>
                            <a class="dropdown-item" href="index.php?page=ol_dashboard&status=hidden">Removed from view</a>
                        </li>
                    </ul>
                </div>
                <div class="dropdown">
                    <button id="displaydropdown" type="button" class="btn btn-outline-secondary btn-hover-light dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" aria-label="Display drop-down menu">
                        <i class="icon fa fa-th fa-fw" style="color:#7E8299;"></i>
                        <span class="d-sm-inline-block" data-active-item-text="">Card</span>
                    </button>
                    <ul class="dropdown-menu" >
                        <li>
                            <a class="dropdown-item">
                            <button type="button" class="btn" x-on:click="layout = 'grid'" x-bind:class="{'bg-white-800': layout === 'grid'}">Grid</button>
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item">
                            <button type="button" class="btn" x-on:click="layout = 'list'" x-bind:class="{'bg-white-800': layout === 'list'}">List</button>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="m-3" x-bind:class="{'row': layout === 'list', 'row': layout === 'grid'}" >
        <?php
        $filter = ['Teacher_id'=>$_SESSION["loggeduser_teacherid"]];
        $query = new MongoDB\Driver\Query($filter);
        $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.ClassroomSubjectRel',$query);
        foreach ($cursor as $document)
        {
            $Subjectid =strval($document->Subject_id);

            $filter = ['_id'=>new \MongoDB\BSON\ObjectId($Subjectid)];
            $query = new MongoDB\Driver\Query($filter);
            $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.SchoolsSubject',$query);
            foreach ($cursor as $document)
            {
                $SubjectName = $document->SubjectName;
                $status = $document->status;

                if(isset($_GET['status']) && !empty($_GET['status']))
                {
                    $select_status = $_GET['status'];
                    if($select_status == 'all')
                    {
                        if($status !== 'hidden')
                        {
                            ?>
                            <section class="" x-bind:class="{'col-sm': layout === 'list', 'col-sm-3 px-5 py-2': layout === 'grid'}">
                                <div x-show="layout === 'grid'" x-cloak>
                                    <article class="bg-white shadow">
                                        <div class="card dashboard-card">
                                            <div class="bg-white" style="height:50px;">
                                                <p class="font-size-h4 text-center">
                                                <a class="text-lightsecondary text-hover-primary" href="index.php?page=ol_subject&id=<?= $Subjectid ; ?>"><?= $SubjectName; ?></a>
                                                </p>
                                            </div>
                                            <div class="dropdown text-right bg-white">
                                                <button type="button" class="btn btn-sm btn-light btn-icon m-1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="ki ki-bold-more-hor text-lightsecondary"></i>
                                                </button>
                                                <div class="dropdown-menu">
                                                    <form id="edit_status" name="edit_status" action="" method="post">
                                                        <input type="hidden" value="<?= $Subjectid ?>" name="subject_id">
                                                        <input type="hidden" value="favourites" name="status">
                                                        <button class="dropdown-item" type="submit" name="edit_status">Star this subject</button>
                                                    </form>
                                                    <form id="edit_status" name="edit_status" action="" method="post">
                                                        <input type="hidden" value="<?= $Subjectid ?>" name="subject_id">
                                                        <input type="hidden" value="hidden" name="status">
                                                        <button class="dropdown-item" type="submit" name="edit_status">Remove from view</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </article>
                                </div>
                                <div x-show="layout === 'list'" x-cloak>
                                    <form name="recheck_edit_student" action="index.php?page=ol_subject&id=<?= $Subjectid ; ?>" method="post">
                                        <button class="btn btn-light btn-block mb-1 p-10 text-left" type="submit"><?= $SubjectName; ?></button>
                                    </form>
                                </div>
                            </section>
                            <?php
                        }
                    }
                    else if($status == $select_status)
                    {
                        ?>
                        <section class="" x-bind:class="{'col-sm': layout === 'list', 'col-sm-3 px-5 py-2': layout === 'grid'}">
                            <div x-show="layout === 'grid'" x-cloak>
                                <article class="bg-white p-4 shadow">
                                    <div class="card dashboard-card">
                                    <div class="card card-custom wave wave-animate-slow wave-purple mb-8 mb-lg-0">
                                        <div class="card-body">
                                            <div class="d-flex align-items-center p-5">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="bg-white" style="height:50px;">
                                        <p class="font-size-h4 text-center">
                                        <a class="text-lightsecondary text-hover-primary" href="index.php?page=ol_subject&id=<?= $Subjectid ; ?>"><?= $SubjectName; ?></a>
                                        </p>
                                    </div>
                                    <div class="dropdown text-right bg-white" >
                                        <button type="button" class="btn btn-sm btn-light btn-icon m-1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="ki ki-bold-more-hor text-lightsecondary"></i>
                                        </button>
                                        <div class="dropdown-menu">
                                            <form id="edit_status" name="edit_status" action="" method="post">
                                                <input type="hidden" value="<?= $Subjectid ?>" name="subject_id">
                                                <input type="hidden" value="all" name="status">
                                                <button class="dropdown-item" type="submit" name="edit_status">
                                                Unstar this subject
                                                </button>
                                            </form>
                                            <form id="edit_status" name="edit_status" action="" method="post">
                                                <input type="hidden" value="<?= $Subjectid ?>" name="subject_id">
                                                <input type="hidden" value="all" name="status">
                                                <button class="dropdown-item" type="submit" name="edit_status">
                                                Restore from view
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                    </div>
                                </article>
                            </div>
                            <div x-show="layout === 'list'" x-cloak>
                                <form name="recheck_edit_student" action="index.php?page=ol_subject&id=<?= $Subjectid ; ?>" method="post">
                                    <button class="btn btn-light btn-block mb-1 p-10 text-left" type="submit"><?= $SubjectName; ?></button>
                                </form>
                            </div>
                        </section>
                        <?php
                    }
                }
                else if(!isset($_GET['status']) && empty($_GET['status']))
                {
                    ?>
                    <section class="" x-bind:class="{'col-sm': layout === 'list', 'col-sm-3 px-5 py-2': layout === 'grid'}">
                        <div x-show="layout === 'grid'" x-cloak>
                            <article class="bg-white p-4 shadow">
                                <div class="card dashboard-card">
                                <div class="card card-custom wave wave-animate-slow wave-purple mb-8 mb-lg-0">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center p-5">
                                        </div>
                                    </div>
                                </div>
                                <div class="bg-white" style="height:50px;">
                                    <p class="font-size-h4 text-center">
                                    <a class="text-lightsecondary text-hover-primary" href="index.php?page=ol_subject&id=<?= $Subjectid ; ?>"><?= $SubjectName; ?></a>
                                    </p>
                                </div>
                                <div class="dropdown text-right bg-white">
                                    <button type="button" class="btn btn-sm btn-light btn-icon m-1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="ki ki-bold-more-hor text-lightsecondary"></i>
                                    </button>
                                    <div class="dropdown-menu">
                                        <form id="edit_status" name="edit_status" action="" method="post">
                                            <input type="hidden" value="<?= $Subjectid ?>" name="subject_id">
                                            <input type="hidden" value="favourites" name="status">
                                            <button class="dropdown-item" type="submit" name="edit_status">Star this subject</button>
                                        </form>
                                        <form id="edit_status" name="edit_status" action="" method="post">
                                            <input type="hidden" value="<?= $Subjectid ?>" name="subject_id">
                                            <input type="hidden" value="hidden" name="status">
                                            <button class="dropdown-item" type="submit" name="edit_status">Remove from view</button>
                                        </form>
                                    </div>
                                </div>
                                </div>
                            </article>
                        </div>
                        <div x-show="layout === 'list'" x-cloak>
                            <form name="recheck_edit_student" action="index.php?page=ol_subject&id=<?= $Subjectid ; ?>" method="post">
                                <button class="btn btn-light btn-block mb-1 p-10 text-left" type="submit"><?= $SubjectName; ?></button>
                            </form>
                        </div>
                    </section>
                    <?php
                }
            }
        }
        ?>
        </div>
        <br>
    </main>
</div>

<div class="card card-custom gutter">
    <div class="card-header">
        <div class="card-title">
            <h3 class="card-label"> EXERCISE </h3>
        </div>
    </div>
    <div class="row m-3">
        <?php
        $filter = ['Teacher_id'=>$_SESSION["loggeduser_teacherid"]];
        $query = new MongoDB\Driver\Query($filter);
        $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.ClassroomSubjectRel',$query);
        foreach ($cursor as $document)
        {
            $Subject_id = $document->Subject_id;

            $filter = ['_id'=>new \MongoDB\BSON\ObjectId($Subject_id)];
            $query = new MongoDB\Driver\Query($filter);
            $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.SchoolsSubject',$query);
            foreach ($cursor as $document)
            {
                $SubjectName = $document->SubjectName;
            }
            ?>
            <div class="col-lg-3 px-5 py-2">
                <div class="card card-custom card-stretch bg-white p-4 shadow">
                    <article class="bg-white">
                        <p class="font-size-h4 text-center mt-3"><a  class="text-lightsecondary text-hover-primary"><?= $SubjectName; ?></a></p>
                        <div class="separator separator-solid separator-border-3 separator-secondary"></div><br>
                        <?php
                        $filter = [null];
                        $query = new MongoDB\Driver\Query($filter);
                        $cursor = $GoNGetzDatabase->executeQuery('GoNGetz.Consumer',$query);
                        foreach ($cursor as $document)
                        {
                            $ConsumerFName = $document->ConsumerFName;
                        }
                        $filter = ['Subject_id'=>$Subject_id];
                        $query = new MongoDB\Driver\Query($filter);
                        $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.OL_Assignment',$query);
                        foreach ($cursor as $document)
                        {
                            $Assignment_id = strval($document->_id);
                            $Title = $document->Title;
                            ?>
                            <div class="checkbox-inline mb-5">
                                <a  class="text-success" href="index.php?page=ol_submit_assignment&id=<?= $Assignment_id; ?>">
                                <img class="icon icon px-5" alt="" aria-hidden="true" src="assets/media/svg/social-icons/handgiving.svg"><?= " ".$Title; ?>
                                </a>
                            </div>
                            <?php
                        }
                        $filter = ['Subject_id'=>$Subject_id];
                        $query = new MongoDB\Driver\Query($filter);
                        $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.OL_Quiz',$query);
                        foreach ($cursor as $document)
                        {
                            $Quiz_id = strval($document->_id);
                            $Title = $document->Title;
                            ?>
                            <div class="checkbox-inline mb-5">
                                <a  class="text-success" href="index.php?page=ol_submit_quiz&id=<?= $Quiz_id; ?>">
                                <img class="icon icon px-5" alt="" aria-hidden="true" src="assets/media/svg/social-icons/quiz.svg"><?= " ".$Title; ?>
                                </a>
                            </div>
                            <?php
                        }
                        $filter = ['Subject_id'=>$Subject_id];
                        $query = new MongoDB\Driver\Query($filter);
                        $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.OL_URL',$query);
                        foreach ($cursor as $document)
                        {
                            $URL_id = strval($document->_id);
                            $Title = $document->Title;
                            $Url = $document->Url;
                            ?>
                            <div class="checkbox-inline mb-5">
                                <a  class="text-success" href="<?= $Url; ?>">
                                <img class="icon icon px-5" alt="" aria-hidden="true" src="assets/media/svg/social-icons/url.svg"><?= " ".$Title; ?>
                                </a>
                            </div>
                            <?php
                        }
                        $filter = ['Subject_id'=>$Subject_id];
                        $query = new MongoDB\Driver\Query($filter);
                        $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.OL_Survey',$query);
                        foreach ($cursor as $document)
                        {
                            $Survey_id = strval($document->_id);
                            $Title = $document->Title;
                            ?>
                            <div class="checkbox-inline mb-5">
                                <a  class="text-success" href="index.php?page=ol_submit_survey&id=<?= $Survey_id; ?>">
                                <img class="icon icon px-5" alt="" aria-hidden="true" src="assets/media/svg/social-icons/survey.svg"><?= " ".$Title; ?>
                                </a>
                            </div>
                            <?php
                        }
                        $filter = ['Subject_id'=>$Subject_id];
                        $query = new MongoDB\Driver\Query($filter);
                        $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.OL_Announcement',$query);
                        foreach ($cursor as $document)
                        {
                            $Announcement_id = strval($document->_id);
                            $Title = $document->Title;
                            $Description = $document->Description;
                            ?>
                            <div class="checkbox-inline mb-5">
                                <a  class="text-success" href="index.php?page=ol_announcement&id=<?= $Announcement_id; ?>">
                                <img class="icon icon px-5" alt="" aria-hidden="true" src="assets/media/svg/social-icons/forum.svg"><?= " ".$Title; ?>
                                </a>
                            </div>
                            <?php
                        }
                        ?>
                    </article>
                </div>
            </div>
            <?php
        }
        ?>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v1.2.0/dist/alpine.js"></script>