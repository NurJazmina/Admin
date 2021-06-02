

<main class="mx-auto bg-gray-200" x-data="{'layout': 'list'}">
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
        <ul class="dropdown-menu" >
          <li >
              <a class="dropdown-item">
              <button type="button" class="mx-1 px-2 py-1 hover:bg-white-900" x-on:click="layout = 'grid'" x-bind:class="{'bg-white-800': layout === 'grid'}">Grid</button>
              </a>
          </li>
          <li id="yui_3_17_2_1_1622175928758_484">
              <a class="dropdown-item">
              <button type="button" class="mx-1 px-2 py-1 hover:bg-white-900" x-on:click="layout = 'list'" x-bind:class="{'bg-white-800': layout === 'list'}">List</button>
              </a>
          </li>
        </ul>
    </div>
</div>
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
  <section class="" x-bind:class="{'col-sm px-5 py-2': layout === 'list', 'col-sm-3 px-5 py-2': layout === 'grid'}">
    <div class="card card-custom gutter-b">
      <article class="bg-white p-4 shadow">
        <div class="card dashboard-card" x-show="layout === 'grid'" x-cloak>
            <img src="assets/media/bg/bg-8.jpg" height="100">
            <div class="col-md-12 bg-light">
            <p class="font-size-h4 text-center"><?php echo $SubjectName; ?></p>
            <div class="dropdown text-right" >
                <button type="button" class="btn btn-light btn-icon btn-sm btn-hover-success" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
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
        </div>
        <div class="font-light ml-4" x-show="layout === 'list'" x-cloak>
          <p class="font-size-h4"><?php echo $SubjectName; ?></p>
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
                //echo $Title."<br>".$Detail;
                $y=substr($Detail,0,500) . '...';
                echo $y;
              ?>
              <p class="text-right">
                <a href="#" class="uppercase text-base text-gray-600 hover:text-black">Read more →</a>
              </p>
            <?php
            }
            ?>
        </div>
      </article>
    </div>
    </section>
  <?php
}
?>
</div>
</main>
<script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v1.2.0/dist/alpine.js"></script>
