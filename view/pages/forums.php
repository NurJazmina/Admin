<?php
$_SESSION["title"] = "Forums";
include 'view/partials/_subheader/subheader-v1.php'; 
include 'model/forums.php';
?>
<div class="text-dark-50 text-center m-5">
  <h1>Forums</h1>
</div>
<div class="row">
    <div class="col-1"></div>
    <div class="col-8">
        <?php
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
            array_splice($ret, count($ret)-1, 0, 'and');
            $ret[] = 'ago';
        
            return join(' ', $ret);
        }
        $nowtime = time();
        if ($_SESSION["loggeduser_ConsumerGroupName"] == 'SCHOOL' || $_SESSION["loggeduser_ConsumerGroupName"] == 'GONGETZ')
        {
            ?>
            <div class="card m-1">
                <div class="card-header">
                    <strong>SCHOOL</strong>
                </div>
                <!-- begin :: school -->
                <div class="card-body">
                    <!-- begin :: general -->
                    <a class="h6 text-dark-50" href="index.php?page=schoolforum&forum=1&topic=General">GENERAL</a>
                    <div class="card m-4 p-4">
                        <?php
                        $filter = ['School_id'=>$_SESSION["loggeduser_schoolID"],'Forum'=>'1'];
                        $option = ['limit'=>5,'sort' => ['_id' => -1]];
                        $query = new MongoDB\Driver\Query($filter,$option);
                        $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Forum',$query);
                        foreach ($cursor as $document)
                        {
                            $Forum_id = strval($document->_id);
                            $Title = $document->Title;
                            $Date = strval($document->Date);
                            $Consumer_id = $document->Consumer_id;
                            
                            $utcdatetime = new MongoDB\BSON\UTCDateTime($Date);
                            $datetime = $utcdatetime->toDateTime()->setTimezone(new \DateTimeZone(date_default_timezone_get()));
                            $dateforum = date_format($datetime,"Y-m-d\TH:i:s");
                            $date = new MongoDB\BSON\UTCDateTime((new DateTime($dateforum))->getTimestamp());
                            $time_strval = strval($date);

                            $filter = ['_id' => new \MongoDB\BSON\ObjectId($Consumer_id)];
                            $query = new MongoDB\Driver\Query($filter);
                            $cursor = $GoNGetzDatabase->executeQuery('GoNGetz.Consumer', $query);
                            foreach ($cursor as $document1)
                            {
                                $ConsumerFName = ($document1->ConsumerFName);
                            }
                            $total = 0;
                            $filter = ['School_id'=>$_SESSION["loggeduser_schoolID"],'Forum_id'=>$Forum_id,'Parent_id'=>'0'];
                            $query = new MongoDB\Driver\Query($filter);
                            $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.ForumComment',$query);
                            foreach ($cursor as $document2)
                            {
                                $total = $total + 1;
                            }
                            ?>
                            <a href="index.php?page=forumdetail&forum=1&topic=General&id=<?= $Forum_id; ?>" style="text-transform:uppercase"><?= $Title."<br>"; ?></a>
                            <!--listbox-->
                            <div class="mt-3 mb-3 text-muted">
                                <small><?= $ConsumerFName; ?></small>
                                <span>|</span>
                                <small><?= date_format($datetime,"d/m/y"); echo " ( ".time_elapsed($nowtime-$time_strval)." ) \n"; ?></small>
                                <span>|</span>
                                <small>Commenting : <?= $total; ?></small>
                            </div>
                            <?php
                        }
                        ?>
                    </div>
                    <!-- end :: general-->
                    <!-- begin :: proposal -->
                    <a class="h6 text-dark-50" href="index.php?page=schoolforum&forum=2&topic=Proposal">PROPOSAL</a>
                    <div class="card m-4 p-4">
                        <?php
                        $filter = ['School_id'=>$_SESSION["loggeduser_schoolID"],'Forum'=>'2'];
                        $option = ['limit'=>5,'sort' => ['_id' => -1]];
                        $query = new MongoDB\Driver\Query($filter,$option);
                        $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Forum',$query);

                        foreach ($cursor as $document)
                        {
                            $Forum_id = strval($document->_id);
                            $Title = $document->Title;
                            $Date = strval($document->Date);
                            $Consumer_id = $document->Consumer_id;
                            
                            $utcdatetime = new MongoDB\BSON\UTCDateTime($Date);
                            $datetime = $utcdatetime->toDateTime()->setTimezone(new \DateTimeZone(date_default_timezone_get()));
                            $dateforum = date_format($datetime,"Y-m-d\TH:i:s");
                            $date = new MongoDB\BSON\UTCDateTime((new DateTime($dateforum))->getTimestamp());
                            $time_strval = strval($date);

                            $consumerid = new \MongoDB\BSON\ObjectId($Consumer_id);
                            $filter = ['_id' => $consumerid];
                            $query = new MongoDB\Driver\Query($filter);
                            $cursor = $GoNGetzDatabase->executeQuery('GoNGetz.Consumer', $query);

                            foreach ($cursor as $document1)
                            {
                                $ConsumerFName = $document1->ConsumerFName;
                            }

                            $total = 0;
                            $filter = ['School_id'=>$_SESSION["loggeduser_schoolID"],'Forum_id'=>$Forum_id,'Parent_id'=>'0'];
                            $query = new MongoDB\Driver\Query($filter);
                            $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.ForumComment',$query);
                            foreach ($cursor as $document2)
                            {
                                $total = $total + 1;
                            }
                            ?>
                            <a href="index.php?page=forumdetail&forum=1&topic=Proposal&id=<?= $Forum_id; ?>" style="text-transform:uppercase"><?= $Title."<br>"; ?></a>
                            <!--listbox-->
                            <div class="mt-3 mb-3 text-muted">
                                <small><?= $ConsumerFName; ?></small>
                                <span>|</span>
                                <small><?= date_format($datetime,"d/m/y"); echo " ( ".time_elapsed($nowtime-$time_strval)." ) \n"; ?></small>
                                <span>|</span>
                                <small>Commenting : <?= $total; ?></small>
                            </div>
                            <?php
                        }
                        ?>
                    </div>
                    <!-- end :: proposal -->
                    <!-- begin :: short news -->
                    <a class="h6 text-dark-50" href="index.php?page=schoolforum&forum=3&topic=Short News / Info">SHORT NEWS / INFO</a>
                    <div class="card m-4 p-4">
                        <?php
                        $filter = ['School_id'=>$_SESSION["loggeduser_schoolID"],'Forum'=>'3'];
                        $option = ['limit'=>5,'sort' => ['_id' => -1]];
                        $query = new MongoDB\Driver\Query($filter,$option);
                        $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Forum',$query);

                        foreach ($cursor as $document)
                        {
                            $Forum_id = strval($document->_id);
                            $Title = $document->Title;
                            $Date = strval($document->Date);
                            $Consumer_id = $document->Consumer_id;
                            
                            $utcdatetime = new MongoDB\BSON\UTCDateTime(strval($Date));
                            $datetime = $utcdatetime->toDateTime()->setTimezone(new \DateTimeZone(date_default_timezone_get()));
                            $dateforum = date_format($datetime,"Y-m-d\TH:i:s");
                            $date = new MongoDB\BSON\UTCDateTime((new DateTime($dateforum))->getTimestamp());
                            $time_strval = strval($date);

                            $filter = ['_id' => new \MongoDB\BSON\ObjectId($Consumer_id)];
                            $query = new MongoDB\Driver\Query($filter);
                            $cursor = $GoNGetzDatabase->executeQuery('GoNGetz.Consumer', $query);
                            foreach ($cursor as $document1)
                            {
                                $ConsumerFName = ($document1->ConsumerFName);
                            }
                            $total = 0;
                            $filter = ['School_id'=>$_SESSION["loggeduser_schoolID"],'Forum_id'=>$Forum_id,'Parent_id'=>'0'];
                            $query = new MongoDB\Driver\Query($filter);
                            $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.ForumComment',$query);
                            foreach ($cursor as $document2)
                            {
                                $total = $total + 1;
                            }
                            ?>
                            <a href="index.php?page=forumdetail&forum=1&topic=Short News / Info&id=<?= $Forum_id; ?>" style="text-transform:uppercase"><?= $Title."<br>"; ?></a>
                            <!--listbox-->
                            <div class="mt-3 mb-3 text-muted">
                                <small><?= $ConsumerFName; ?></small>
                                <span>|</span>
                                <small><?= date_format($datetime,"d/m/y"); echo " ( ".time_elapsed($nowtime-$time_strval)." ) \n"; ?></small>
                                <span>|</span>
                                <small>Commenting : <?= $total; ?></small>
                            </div>
                            <?php
                        }
                        ?>
                    </div>
                    <!-- end :: short news -->
                </div>
                <!-- end :: school -->
            </div>
            <?php
        }
        ?>
        <div class="card m-1">
            <div class="card-header">
                <strong>PUBLIC</strong>
            </div>
            <div class="card-body">
                <!-- begin :: general -->
                <a class="h6 text-dark-50" href="index.php?page=publicforum&forum=4&topic=General">GENERAL</a>
                <div class="card m-4 p-4">
                    <?php
                    $filter = ['School_id'=>$_SESSION["loggeduser_schoolID"],'Forum'=>'4'];
                    $option = ['limit'=>5,'sort' => ['_id' => -1]];
                    $query = new MongoDB\Driver\Query($filter,$option);
                    $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Forum',$query);

                    foreach ($cursor as $document)
                    {
                        $Forum_id = strval($document->_id);
                        $Title = $document->Title;
                        $Date = strval($document->Date);
                        $Consumer_id = $document->Consumer_id;
                        
                        $utcdatetime = new MongoDB\BSON\UTCDateTime(strval($Date));
                        $datetime = $utcdatetime->toDateTime()->setTimezone(new \DateTimeZone(date_default_timezone_get()));
                        $dateforum = date_format($datetime,"Y-m-d\TH:i:s");
                        $date = new MongoDB\BSON\UTCDateTime((new DateTime($dateforum))->getTimestamp());
                    
                        $time_strval = strval($date);

                        $consumerid = new \MongoDB\BSON\ObjectId($Consumer_id);
                        $filter1 = ['_id' => $consumerid];
                        $query1 = new MongoDB\Driver\Query($filter1);
                        $cursor1 = $GoNGetzDatabase->executeQuery('GoNGetz.Consumer', $query1);
        
                        foreach ($cursor1 as $document1)
                        {
                        $ConsumerFName = ($document1->ConsumerFName);
                        }

                        $total = 0;
                        $filter2 = ['School_id'=>$_SESSION["loggeduser_schoolID"],'Forum_id'=>$Forum_id,'Parent_id'=>'0'];
                        $query2 = new MongoDB\Driver\Query($filter2);
                        $cursor2 = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.ForumComment',$query2);
                        foreach ($cursor2 as $document2)
                        {
                            $total = $total + 1;
                        }
                        ?>
                        <a href="index.php?page=forumdetail&forum=1&topic=General&id=<?= $Forum_id; ?>" style="text-transform:uppercase"><?= $Title."<br>"; ?></a>
                        <!--listbox-->
                        <div class="mt-3 mb-3 text-muted">
                            <small><?= $ConsumerFName; ?></small>
                            <span>|</span>
                            <small><?= date_format($datetime,"d/m/y"); echo " ( ".time_elapsed($nowtime-$time_strval)." ) \n"; ?></small>
                            <span>|</span>
                            <small>Commenting : <?= $total; ?></small>
                        </div>
                        <?php
                    }
                    ?>
                </div>
                <!-- end :: general -->
                <!-- begin :: proposal -->
                <a class="h6 text-dark-50" href="index.php?page=publicforum&forum=5&topic=Proposal">PROPOSAL</a>
                <div class="card m-4 p-4">
                    <?php
                    $filter = ['School_id'=>$_SESSION["loggeduser_schoolID"],'Forum'=>'5'];
                    $option = ['limit'=>5,'sort' => ['_id' => -1]];
                    $query = new MongoDB\Driver\Query($filter,$option);
                    $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Forum',$query);

                    foreach ($cursor as $document)
                    {   
                        $Forum_id = strval($document->_id);
                        $Title = $document->Title;
                        $Date = strval($document->Date);
                        $Consumer_id = $document->Consumer_id;
                        
                        $utcdatetime = new MongoDB\BSON\UTCDateTime(strval($Date));
                        $datetime = $utcdatetime->toDateTime()->setTimezone(new \DateTimeZone(date_default_timezone_get()));
                        $dateforum = date_format($datetime,"Y-m-d\TH:i:s");
                        $date = new MongoDB\BSON\UTCDateTime((new DateTime($dateforum))->getTimestamp());
                    
                        $time_strval = strval($date);

                        $consumerid = new \MongoDB\BSON\ObjectId($Consumer_id);
                        $filter1 = ['_id' => $consumerid];
                        $query1 = new MongoDB\Driver\Query($filter1);
                        $cursor1 = $GoNGetzDatabase->executeQuery('GoNGetz.Consumer', $query1);
        
                        foreach ($cursor1 as $document1)
                        {
                        $ConsumerFName = ($document1->ConsumerFName);
                        }

                        $total = 0;
                        $filter2 = ['School_id'=>$_SESSION["loggeduser_schoolID"],'Forum_id'=>$Forum_id,'Parent_id'=>'0'];
                        $query2 = new MongoDB\Driver\Query($filter2);
                        $cursor2 = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.ForumComment',$query2);
                        foreach ($cursor2 as $document2)
                        {
                            $total = $total + 1;
                        }
                        ?>
                        <a href="index.php?page=forumdetail&forum=1&topic=Proposal&id=<?= $Forum_id; ?>" style="text-transform:uppercase"><?= $Title."<br>"; ?></a>
                        <!--listbox-->
                        <div class="mt-3 mb-3 text-muted">
                            <small><?= $ConsumerFName; ?></small>
                            <span>|</span>
                            <small><?= date_format($datetime,"d/m/y"); echo " ( ".time_elapsed($nowtime-$time_strval)." ) \n"; ?></small>
                            <span>|</span>
                            <small>Commenting : <?= $total; ?></small>
                        </div>
                        <?php
                    }
                    ?>
                </div>
                <!-- end :: proposal -->
                <!-- begin :: short news -->
                <a class="h6 text-dark-50" href="index.php?page=publicforum&forum=6&topic=Short News / Info">SHORT NEWS / INFO</a>
                <div class="card m-4 p-4">
                    <?php
                    $filter = ['School_id'=>$_SESSION["loggeduser_schoolID"],'Forum'=>'6'];
                    $option = ['limit'=>5,'sort' => ['_id' => -1]];
                    $query = new MongoDB\Driver\Query($filter,$option);
                    $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Forum',$query);

                    foreach ($cursor as $document)
                    {
                        $Forum_id = strval($document->_id);
                        $Title = $document->Title;
                        $Date = strval($document->Date);
                        $Consumer_id = $document->Consumer_id;
                        
                        $utcdatetime = new MongoDB\BSON\UTCDateTime(strval($Date));
                        $datetime = $utcdatetime->toDateTime()->setTimezone(new \DateTimeZone(date_default_timezone_get()));
                        $dateforum = date_format($datetime,"Y-m-d\TH:i:s");
                        $date = new MongoDB\BSON\UTCDateTime((new DateTime($dateforum))->getTimestamp());
                    
                        $time_strval = strval($date);

                        $consumerid = new \MongoDB\BSON\ObjectId($Consumer_id);
                        $filter1 = ['_id' => $consumerid];
                        $query1 = new MongoDB\Driver\Query($filter1);
                        $cursor1 = $GoNGetzDatabase->executeQuery('GoNGetz.Consumer', $query1);
        
                        foreach ($cursor1 as $document1)
                        {
                        $ConsumerFName = ($document1->ConsumerFName);
                        }

                        $total = 0;
                        $filter2 = ['School_id'=>$_SESSION["loggeduser_schoolID"],'Forum_id'=>$Forum_id,'Parent_id'=>'0'];
                        $query2 = new MongoDB\Driver\Query($filter2);
                        $cursor2 = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.ForumComment',$query2);
                        foreach ($cursor2 as $document2)
                        {
                            $total = $total + 1;
                        }
                        ?>
                        <a href="index.php?page=forumdetail&forum=1&topic=Short News / Info&id=<?= $Forum_id; ?>" style="text-transform:uppercase"><?= $Title."<br>"; ?></a>
                        <!--listbox-->
                        <div class="mt-3 mb-3 text-muted">
                            <small><?= $ConsumerFName; ?></small>
                            <span>|</span>
                            <small><?= date_format($datetime,"d/m/y"); echo " ( ".time_elapsed($nowtime-$time_strval)." ) \n"; ?></small>
                            <span>|</span>
                            <small>Commenting : <?= $total; ?></small>
                        </div>
                        <?php
                    }
                    ?>
                </div>
                <!-- end :: short news -->
            </div>
        </div>
    </div>
    <div class="col-2">
        <div class="card">
            <div class="card-header">
                <strong>DETAILS</strong>
            </div>
            <div class="card-body">
                <div class="spacing-right">
                    <div class="padding-gutter">
                        <div class="guidelines expanded" data-role="guidelines">
                            <p class="spacing-bottom">The following are not allowed on SmartSchool:</p>
                            <ol class="list-num spacing-bottom">
                                <li>Targeted harassment or encouraging others</li>
                                <li>Spam</li>
                                <li>Impersonation</li>
                                <li>Direct threat of harm</li>
                                <li>Posting personally identifiable information</li>
                                <li>Inappropriate profile content</li>
                            </ol>
                            <div class="accordion accordion-flush" id="accordionFlushExample">
                                <div class="accordion-item">
                                    <a class="accordion-header" id="flush-headingOne">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                                        Show guidelines
                                        </button>
                                    </a>
                                    <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                                        <div class="accordion-body">
                                            <p><strong>Targeted harassment or encouraging others to do so</strong></p>
                                            <p class="spacing-bottom">The targeted and systematic harassment of people has no place on SmartSchool, nor do we tolerate communities dedicated to fostering harassing behavior.</p>

                                            <p><strong>Spam</strong></p>
                                            <p class="spacing-bottom">Examples include 1) comments posted in large quantities to promote a product or service, 2) the exact same comment posted repeatedly to disrupt a thread. 3) following users multiple times</p>

                                            <p><strong>Impersonation</strong></p>
                                            <p class="spacing-bottom">You may not impersonate others in a manner that does or is intended to mislead, confuse, or deceive others.</p>

                                            <p><strong>Direct threat of harm</strong></p>
                                            <p class="spacing-bottom">This covers active threats of harm directed towards a specific person or defined group of individuals. Contact local authorities if you feel a crime has been committed or is imminent.</p>

                                            <p><strong>Posting personally identifiable information</strong></p>
                                            <p class="spacing-bottom">Examples of protected information: credit card number, home/work address, phone number, email address, social security number. Real name isn't currently covered.</p>

                                            <p><strong>Inappropriate profile content</strong></p>
                                            <p class="spacing-bottom">Graphic media containing violence and pornographic content are not allowed. Profile content allowed by SmartSchool may not be allowed on all communitie, so report such profiles to the site moderator.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-1"></div>
</div>