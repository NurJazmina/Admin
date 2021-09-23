<?php
        $filter = ['Teacher_id'=>$_SESSION["loggeduser_teacherid"]];
        $query = new MongoDB\Driver\Query($filter);
        $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.ClassroomSubjectRel',$query);
        foreach ($cursor as $document)
        {
            $Subjectid = strval($document->Subject_id);

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