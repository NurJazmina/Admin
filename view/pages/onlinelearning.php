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
</style>
<div class="card card-custom gutter-b">
    <div class="card-header">
        <div class="card-title">
            <h3 class="card-label"> NOTES </h3>
        </div>
        <div data-region="filter" class="d-flex align-items-center flex-wrap" aria-label="Course overview controls" >
            <div class="dropdown mb-1 mr-auto">
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
            <div class="mb-1 mr-1 d-flex align-items-center">
                <div class="dropdown">
                    <button id="sortingdropdown" type="button" class="btn btn-outline-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" aria-label="Sorting drop-down menu">
                        <i class="icon fa fa-sort-amount-asc fa-fw " aria-hidden="true"></i>
                        <span class="d-sm-inline-block" data-active-item-text="">
                                Subject name
                            </span>
                    </button>
                    <ul class="dropdown-menu" role="menu" data-show-active-item="" data-skip-active-class="true" aria-labelledby="sortingdropdown" style="will-change: transform;" id="yui_3_17_2_1_1622175928758_46">
                        <li>
                            <a class="dropdown-item" href="#" data-filter="sort" data-pref="title" data-value="fullname" aria-label="Sort courses by course name" aria-controls="courses-view-60b064e42666060b064e36ba2c3" role="menuitem" id="yui_3_17_2_1_1622175928758_263" aria-current="true">
                                Subejct name
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="#" data-filter="sort" data-pref="lastaccessed" data-value="ul.timeaccess desc" aria-label="Sort courses by last accessed date" aria-controls="courses-view-60b064e42666060b064e36ba2c3" role="menuitem" id="yui_3_17_2_1_1622175928758_44">
                                Last accessed
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="dropdown mb-1" id="yui_3_17_2_1_1622175928758_482">
                <button id="displaydropdown" type="button" class="btn btn-outline-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" aria-label="Display drop-down menu">
                    <i class="icon fa fa-th fa-fw " aria-hidden="true" id="yui_3_17_2_1_1622175928758_481"></i>
                    <span class="d-sm-inline-block" data-active-item-text="">
                                Card
                            </span>
                </button>
                <ul class="dropdown-menu" role="menu" data-show-active-item="" data-skip-active-class="true" aria-labelledby="displaydropdown" style="will-change: transform;" id="yui_3_17_2_1_1622175928758_485">
                        <li id="yui_3_17_2_1_1622175928758_865">
                            <a class="dropdown-item" href="#" data-display-option="display" data-value="card" data-pref="card" aria-label="Switch to card view" aria-controls="courses-view-60b064e42666060b064e36ba2c3" role="menuitem" id="yui_3_17_2_1_1622175928758_864" aria-current="true">
                                Card
                            </a>
                        </li>
                        <li id="yui_3_17_2_1_1622175928758_484">
                            <a class="dropdown-item" href="#" data-display-option="display" data-value="list" data-pref="list" aria-label="Switch to list view" aria-controls="courses-view-60b064e42666060b064e36ba2c3" role="menuitem" id="yui_3_17_2_1_1622175928758_483">
                                List
                            </a>
                        </li>
                        <li id="yui_3_17_2_1_1622175928758_685">
                            <a class="dropdown-item" href="#" data-display-option="display" data-value="summary" data-pref="summary" aria-label="Switch to summary view" aria-controls="courses-view-60b064e42666060b064e36ba2c3" role="menuitem" id="yui_3_17_2_1_1622175928758_684">
                                Summary
                            </a>
                        </li>
                </ul>
            </div>
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
            <div class="col-lg-4 px-5 py-2">
                <div class="card card-custom card-stretch bg-light">
                    <a class="btn btn-light btn-hover-warning" href="index.php?page=notes" role="button">
                        <div class="card-body">
                            <h3><?php echo $SubjectName; ?></h3>
                            <div class="separator separator-dashed separator-border-3"></div>
                            <div class="claimedRight">
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
                                echo $Title."<br>".$Detail; 
                            }
                            ?>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            <?php
        }
        ?>
    </div>
</div>

<div class="card card-custom gutter-b">
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
                <div class="col-lg-4 px-5 py-2">
                    <div class="card card-custom card-stretch bg-light">
                        <span class="btn btn-light btn-hover-light"><h3><?php echo $SubjectName; ?></h3></span>
                        <div class="separator separator-dashed separator-border-3"></div><br>
                        <?php
                        $filter = ['Subject_id'=>$Subjectid];
                        $query = new MongoDB\Driver\Query($filter);
                        $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.OnlineLearningQuestions',$query);
                        foreach ($cursor as $document)
                        {
                            $Title = $document->Title;
                            $Question_type = $document->Question_type;
                            $Created_by = $document->Created_by;
                            $Note_sort = $document->Note_sort;

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
                                    <a href="index.php?page=notes&id=<?php echo $Question_id ; ?>"><?php echo "Slot : ".$Note_sort." ".$Title." Quiz Teacher ".$ConsumerFName; ?></a>
                                </div>
                            </div>
                            <?php
                        }
                        ?>
                    </div>
                </div>
                <?php
            }
?>
</div>