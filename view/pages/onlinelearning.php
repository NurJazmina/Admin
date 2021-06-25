<?php
$_SESSION["title"] = "Online learning";
include 'view/partials/_subheader/subheader-v1.php'; 
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
<div class="card card-custom gutter-b px-5">
<main class="" x-data="{'layout': 'grid'}">
    <div class="card-header" >
        <div class="card-title">
            <h3 class="card-label"> NOTES </h3>
        </div>
        <div data-region="filter" class="d-flex flex-wrap" aria-label="Course overview controls" >
            <div class="dropdown mb-0 mr-auto">
                <button id="groupingdropdown" type="button" class="btn btn-outline-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" aria-label="Grouping drop-down menu">
                    <i class="icon fa fa-filter fa-fw " aria-hidden="true"></i>
                    <span class="d-sm-inline-block" data-active-item-text="">
                        All (except removed from view)
                    </span>
                </button>
                <ul class="dropdown-menu" role="menu" data-show-active-item="" data-skip-active-class="true" data-active-item-text="" aria-labelledby="groupingdropdown" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 36px, 0px); top: 0px; left: 0px; will-change: transform;">
                    <li class="dropdown-divider" role="presentation">
                        <span class="filler">&nbsp;</span>
                    </li>
                    <li>
                        <a class="dropdown-item" href="#" data-filter="grouping" data-value="all" data-pref="all" aria-label="Show all courses except courses removed from view" aria-controls="courses-view-60b064e42666060b064e36ba2c3" role="menuitem" aria-current="true">
                            All (except removed from view)
                        </a>
                    </li>
                    <li class="dropdown-divider" role="presentation">
                        <span class="filler">&nbsp;</span>
                    </li>
                    <li>
                        <a class="dropdown-item" href="#" data-filter="grouping" data-value="inprogress" data-pref="inprogress" aria-label="Show courses in progress" aria-controls="courses-view-60b064e42666060b064e36ba2c3" role="menuitem">
                            In progress
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="#" data-filter="grouping" data-value="future" data-pref="future" aria-label="Show future courses" aria-controls="courses-view-60b064e42666060b064e36ba2c3" role="menuitem">
                            Future
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="#" data-filter="grouping" data-value="past" data-pref="past" aria-label="Show past courses" aria-controls="courses-view-60b064e42666060b064e36ba2c3" role="menuitem">
                            Past
                        </a>
                    </li>
                    <li class="dropdown-divider" role="presentation">
                        <span class="filler">&nbsp;</span>
                    </li>
                    <li>
                        <a class="dropdown-item" href="#" data-filter="grouping" data-value="favourites" data-pref="favourites" aria-label="Show starred courses" aria-controls="courses-view-60b064e42666060b064e36ba2c3" role="menuitem">
                            Starred
                        </a>
                    </li><li class="dropdown-divider" role="presentation">
                        <span class="filler">&nbsp;</span>
                    </li>
                    <li>
                        <a class="dropdown-item" href="#" data-filter="grouping" data-value="hidden" data-pref="hidden" aria-label="Show courses removed from view" aria-controls="courses-view-60b064e42666060b064e36ba2c3" role="menuitem">
                            Removed from view
                        </a>
                    </li>
                </ul>
            </div>
            <div class="dropdown mb-0">
                <button id="displaydropdown" type="button" class="btn btn-outline-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" aria-label="Display drop-down menu">
                    <i class="icon fa fa-th fa-fw " aria-hidden="true"></i>
                    <span class="d-sm-inline-block" data-active-item-text="">
                        Card
                    </span>
                </button>
                <ul class="dropdown-menu" >
                    <li>
                        <a class="dropdown-item">
                        <button type="button" class="btn btn-hover-bg-light" x-on:click="layout = 'grid'" x-bind:class="{'bg-white-800': layout === 'grid'}">Grid</button>
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item">
                        <button type="button" class="btn btn-hover-bg-light" x-on:click="layout = 'list'" x-bind:class="{'bg-white-800': layout === 'list'}">List</button>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <br>
    <div class="" x-bind:class="{'row': layout === 'list', 'row': layout === 'grid'}" >
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
        }
        ?>
        <section class="" x-bind:class="{'col-sm': layout === 'list', 'col-sm-3 px-5 py-2': layout === 'grid'}">
                <div x-show="layout === 'grid'" x-cloak>
                    <article class="bg-white p-4 shadow">
                        <div class="card dashboard-card">
                        <img src="assets/media/bg/bg-8.jpg" height="100">
                        <div class="bg-light" style="height:50px;">
                            <p class="font-size-h4 text-center mt-3">
                            <a href="index.php?page=subject&id=<?php echo $Subjectid ; ?>" style="color:#7E8299; text-decoration: underline;"><?php echo $SubjectName; ?></a>
                            </p>
                        </div>
                        <div class="dropdown text-right bg-light" >
                            <button type="button" class="btn btn-light btn-icon btn-sm btn-hover-secondary" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="ki ki-bold-more-hor text-secondary"></i>
                            </button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="#">Star this subject</a>
                                <a class="dropdown-item" href="#">Remove from view</a>
                                <a class="dropdown-item" href="#">Unstar this subject</a>
                                <a class="dropdown-item" href="#">Remove from view</a>
                            </div>
                        </div>
                        </div>
                    </article>
                </div>
                <div x-show="layout === 'list'" x-cloak>
                    <div class="list-group-item mt-1 mb-1">
                        <p class="font-size-h4 mt-3">
                        <a href="index.php?page=subject&id=<?php echo $Subjectid ; ?>" style="color:#7E8299; text-decoration: underline;"><?php echo $SubjectName; ?></a>
                        </p>
                        <?php
                        $filter = ['Subject_id'=>$Subjectid,'Note_sort'=>1];
                        $query = new MongoDB\Driver\Query($filter);
                        $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.OnlineLearningNotes',$query);
                        foreach ($cursor as $document)
                        {
                            $Subject_id = $document->Subject_id;
                            $Title = $document->Title;
                            $Detail = $document->Detail;
                            $Created_by = $document->Created_by;
                            $Edited_by = $document->Edited_by;
                            $y=substr($Detail,0,500) . '...';
                            echo $y;
                        }
                        ?>
                        <p class="text-right"><a href="#" class="uppercase text-base text-gray-600 hover:text-black">Read more →</a></p>
                    </div>
                </div>
        </section>
        <?php
    }
    ?>
    </div>
    <br>
</main>
</div>

<div class="card card-custom gutter-b px-5">
    <div class="card-header">
        <div class="card-title">
            <h3 class="card-label"> EXERCISE </h3>
        </div>
    </div>
    <div class="row">
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
        }
        ?>
        <div class="col-lg-3 px-5 py-2">
            <div class="card card-custom card-stretch bg-white p-4 shadow">
            <article class="bg-white">
                <p class="font-size-h4 text-center mt-3">
                <a href="index.php?page=subject&id=<?php echo $Subjectid ; ?>" style="color:#7E8299; text-decoration: underline;"><?php echo $SubjectName; ?></a>
                </p>
                <div class="separator separator-solid separator-border-3 separator-secondary"></div><br>
                <?php
                $filter = ['Subject_id'=>$Subjectid];
                $query = new MongoDB\Driver\Query($filter);
                $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.OnlineLearningQuestions',$query);
                foreach ($cursor as $document)
                {
                    $Question_id = $document->_id;
                    $Title = $document->Title;
                    $Created_by = $document->Created_by;

                    $filter = ['_id'=>new \MongoDB\BSON\ObjectId($Created_by)];
                    $query = new MongoDB\Driver\Query($filter);
                    $cursor = $GoNGetzDatabase->executeQuery('GoNGetz.Consumer',$query);
                    foreach ($cursor as $document)
                    {
                        $ConsumerFName = $document->ConsumerFName;
                    }
                    ?>
                    <div class="col">
                        <div class="card-title">
                            <img alt="Logo" src="assets/media/svg/social-icons/quiz.svg" width="30" height="30"/>
                            <a href="index.php?page=subject&id=<?php echo $Question_id ; ?>"><span><?php echo $Title.": Quiz Teacher ".$ConsumerFName; ?></span></a>
                        </div>
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
<br>
<script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v1.2.0/dist/alpine.js"></script>