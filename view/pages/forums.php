<?php
$_SESSION["title"] = "Forums";
include 'view/partials/_subheader/subheader-v1.php'; 
include 'model/forums.php';
?>
<style>
.topic {
    border-color: #fff;
    color:#687a86;
    background-color: transparent;
    font-weight: bold;
}
</style>
<div><br><br><br><h1 style="color:#696969; text-align:center">Forums</h1></div><br>

<div class="row" >
    <div class="col-md-9">
        <?php
        function time_elapsed($date){
            $bit = array(
                //' year'      => $date  / 31556926 % 12,
                //' week'      => $date  / 604800 % 52,
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
        <div class="card">
            <div class="card-header">
                <strong>SCHOOL</strong>
            </div>
            <!--SCHOOL-->
            <div class="card-body">
            <div class="table-responsive-sm" style="line-height: 100%;">
                <a class="topic" href="index.php?page=schoolforum&forum=1&topic=general">General</a>
                    <div class="card-footer">
                        <?php
                        $filter = ['school_id'=>$_SESSION["loggeduser_schoolID"],'Forum'=>'1'];
                        $option = ['limit'=>5,'sort' => ['_id' => -1]];
                        $query = new MongoDB\Driver\Query($filter,$option);
                        $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.SchoolForum',$query);

                        foreach ($cursor as $document)
                        {
                            $Forumid = ($document->_id);
                            $ForumTitle = ($document->ForumTitle);
                            $ForumDate = ($document->ForumDate);
                            $Consumer_id = ($document->Consumer_id);
                            
                            $utcdatetime = new MongoDB\BSON\UTCDateTime(strval($ForumDate));
                            $datetime = $utcdatetime->toDateTime()->setTimezone(new \DateTimeZone(date_default_timezone_get()));
                            $dateforum = date_format($datetime,"Y-m-d\TH:i:s");
                            $date = new MongoDB\BSON\UTCDateTime((new DateTime($dateforum))->getTimestamp());
                        
                            $oldtime = strval($date);

                            $consumerid = new \MongoDB\BSON\ObjectId($Consumer_id);
                            $filter1 = ['_id' => $consumerid];
                            $query1 = new MongoDB\Driver\Query($filter1);
                            $cursor1 = $GoNGetzDatabase->executeQuery('GoNGetz.Consumer', $query1);
            
                            foreach ($cursor1 as $document1)
                            {
                            $ConsumerFName = ($document1->ConsumerFName);
                            }

                            $total = 0;
                            $filter2 = ['School_id'=>$_SESSION["loggeduser_schoolID"],'Forum_id'=>$Forumid,'ForumParent_id'=>'0'];
                            $query2 = new MongoDB\Driver\Query($filter2);
                            $cursor2 = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.SchoolForumComment',$query2);
                            foreach ($cursor2 as $document2)
                            {
                                $total = $total + 1;
                            }
                            ?>
                            <a style="color:#076d79; text-decoration: none;" href="index.php?page=schoolforumdetail&forum=1&topic=general&id=<?php echo $Forumid; ?>"><?php echo $ForumTitle."<br>"; ?></a>
                            <!--listbox-->
                            <div id="listbox">
                                <span class="thaut"><a style="color:#687a86;"><?php echo $ConsumerFName; ?></a></span>
                                <span class="fff">|</span>
                                    <span class="thdate"><a style="color:#687a86;"><?php echo date_format($datetime,"d/m/y"); echo " ( ".time_elapsed($nowtime-$oldtime)." ) \n"; ?></a></span>
                                <span class="fff">|</span>
                                <span class="thcmd"><a style="color:#687a86;">Commenting : <?php echo $total; ?></span>
                            </div>
                            <br>
                            <?php
                        }
                        ?>
                    </div>
                <a class="topic" href="index.php?page=schoolforum&forum=2&topic=proposal">Proposal</a>
                    <div class="card-footer">
                        <?php
                        $filter = ['school_id'=>$_SESSION["loggeduser_schoolID"],'Forum'=>'2'];
                        $option = ['limit'=>5,'sort' => ['_id' => -1]];
                        $query = new MongoDB\Driver\Query($filter,$option);
                        $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.SchoolForum',$query);

                        foreach ($cursor as $document)
                        {
                            $Forumid = ($document->_id);
                            $ForumTitle = ($document->ForumTitle);
                            $ForumDate = ($document->ForumDate);
                            $Consumer_id = ($document->Consumer_id);
                            
                            $utcdatetime = new MongoDB\BSON\UTCDateTime(strval($ForumDate));
                            $datetime = $utcdatetime->toDateTime()->setTimezone(new \DateTimeZone(date_default_timezone_get()));
                            $dateforum = date_format($datetime,"Y-m-d\TH:i:s");
                            $date = new MongoDB\BSON\UTCDateTime((new DateTime($dateforum))->getTimestamp());
                        
                            $oldtime = strval($date);

                            $consumerid = new \MongoDB\BSON\ObjectId($Consumer_id);
                            $filter1 = ['_id' => $consumerid];
                            $query1 = new MongoDB\Driver\Query($filter1);
                            $cursor1 = $GoNGetzDatabase->executeQuery('GoNGetz.Consumer', $query1);
            
                            foreach ($cursor1 as $document1)
                            {
                            $ConsumerFName = ($document1->ConsumerFName);
                            }

                            $total = 0;
                            $filter2 = ['School_id'=>$_SESSION["loggeduser_schoolID"],'Forum_id'=>$Forumid,'ForumParent_id'=>'0'];
                            $query2 = new MongoDB\Driver\Query($filter2);
                            $cursor2 = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.SchoolForumComment',$query2);
                            foreach ($cursor2 as $document2)
                            {
                                $total = $total + 1;
                            }
                            ?>
                            <a style="color:#076d79; text-decoration: none;" href="index.php?page=schoolforumdetail&forum=1&topic=general&id=<?php echo $Forumid; ?>"><?php echo $ForumTitle."<br>"; ?></a>
                            <!--listbox-->
                            <div id="listbox">
                                <span class="thaut"><a style="color:#687a86;"><?php echo $ConsumerFName; ?></a></span>
                                <span class="fff">|</span>
                                    <span class="thdate"><a style="color:#687a86;"><?php echo date_format($datetime,"d/m/y"); echo " ( ".time_elapsed($nowtime-$oldtime)." ) \n"; ?></a></span>
                                <span class="fff">|</span>
                                <span class="thcmd"><a style="color:#687a86;">Commenting : <?php echo $total; ?></span>
                            </div>
                            <br>
                            <?php
                        }
                        ?>
                    </div>
                <a class="topic" href="index.php?page=schoolforum&forum=3&topic=short news / info">Short News / Info</a>
                    <div class="card-footer">
                        <?php
                        $filter = ['school_id'=>$_SESSION["loggeduser_schoolID"],'Forum'=>'3'];
                        $option = ['limit'=>5,'sort' => ['_id' => -1]];
                        $query = new MongoDB\Driver\Query($filter,$option);
                        $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.SchoolForum',$query);

                        foreach ($cursor as $document)
                        {
                            $Forumid = ($document->_id);
                            $ForumTitle = ($document->ForumTitle);
                            $ForumDate = ($document->ForumDate);
                            $Consumer_id = ($document->Consumer_id);
                            
                            $utcdatetime = new MongoDB\BSON\UTCDateTime(strval($ForumDate));
                            $datetime = $utcdatetime->toDateTime()->setTimezone(new \DateTimeZone(date_default_timezone_get()));
                            $dateforum = date_format($datetime,"Y-m-d\TH:i:s");
                            $date = new MongoDB\BSON\UTCDateTime((new DateTime($dateforum))->getTimestamp());
                        
                            $oldtime = strval($date);

                            $consumerid = new \MongoDB\BSON\ObjectId($Consumer_id);
                            $filter1 = ['_id' => $consumerid];
                            $query1 = new MongoDB\Driver\Query($filter1);
                            $cursor1 = $GoNGetzDatabase->executeQuery('GoNGetz.Consumer', $query1);
            
                            foreach ($cursor1 as $document1)
                            {
                            $ConsumerFName = ($document1->ConsumerFName);
                            }

                            $total = 0;
                            $filter2 = ['School_id'=>$_SESSION["loggeduser_schoolID"],'Forum_id'=>$Forumid,'ForumParent_id'=>'0'];
                            $query2 = new MongoDB\Driver\Query($filter2);
                            $cursor2 = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.SchoolForumComment',$query2);
                            foreach ($cursor2 as $document2)
                            {
                                $total = $total + 1;
                            }
                            ?>
                            <a style="color:#076d79; text-decoration: none;" href="index.php?page=schoolforumdetail&forum=1&topic=general&id=<?php echo $Forumid; ?>"><?php echo $ForumTitle."<br>"; ?></a>
                            <!--listbox-->
                            <div id="listbox">
                                <span class="thaut"><a style="color:#687a86;"><?php echo $ConsumerFName; ?></a></span>
                                <span class="fff">|</span>
                                    <span class="thdate"><a style="color:#687a86;"><?php echo date_format($datetime,"d/m/y"); echo " ( ".time_elapsed($nowtime-$oldtime)." ) \n"; ?></a></span>
                                <span class="fff">|</span>
                                <span class="thcmd"><a style="color:#687a86;">Commenting : <?php echo $total; ?></span>
                            </div>
                            <br>
                            <?php
                        }
                        ?>
                    </div>
            </div>
            </div>
        </div>
        <?php
        }
        ?>
        <br>
        <div class="card">
            <div class="card-header">
                <strong>PUBLIC</strong>
            </div>

            <div class="card-body">
                <div class="table-responsive-sm" style="line-height: 100%;">
                    <a class="topic" href="index.php?page=publicforum&forum=4&topic=general">General</a>
                    <div class="card-footer">
                        <?php
                        $filter = ['school_id'=>$_SESSION["loggeduser_schoolID"],'Forum'=>'4'];
                        $option = ['limit'=>5,'sort' => ['_id' => -1]];
                        $query = new MongoDB\Driver\Query($filter,$option);
                        $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.SchoolForum',$query);

                        foreach ($cursor as $document)
                        {
                            $Forumid = ($document->_id);
                            $ForumTitle = ($document->ForumTitle);
                            $ForumDate = ($document->ForumDate);
                            $Consumer_id = ($document->Consumer_id);
                            
                            $utcdatetime = new MongoDB\BSON\UTCDateTime(strval($ForumDate));
                            $datetime = $utcdatetime->toDateTime()->setTimezone(new \DateTimeZone(date_default_timezone_get()));
                            $dateforum = date_format($datetime,"Y-m-d\TH:i:s");
                            $date = new MongoDB\BSON\UTCDateTime((new DateTime($dateforum))->getTimestamp());
                        
                            $oldtime = strval($date);

                            $consumerid = new \MongoDB\BSON\ObjectId($Consumer_id);
                            $filter1 = ['_id' => $consumerid];
                            $query1 = new MongoDB\Driver\Query($filter1);
                            $cursor1 = $GoNGetzDatabase->executeQuery('GoNGetz.Consumer', $query1);
            
                            foreach ($cursor1 as $document1)
                            {
                            $ConsumerFName = ($document1->ConsumerFName);
                            }

                            $total = 0;
                            $filter2 = ['School_id'=>$_SESSION["loggeduser_schoolID"],'Forum_id'=>$Forumid,'ForumParent_id'=>'0'];
                            $query2 = new MongoDB\Driver\Query($filter2);
                            $cursor2 = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.SchoolForumComment',$query2);
                            foreach ($cursor2 as $document2)
                            {
                                $total = $total + 1;
                            }
                            ?>
                            <a style="color:#076d79; text-decoration: none;" href="index.php?page=publicforumdetail&forum=1&topic=general&id=<?php echo $Forumid; ?>"><?php echo $ForumTitle."<br>"; ?></a>
                            <!--listbox-->
                            <div id="listbox">
                                <span class="thaut"><a style="color:#687a86;"><?php echo $ConsumerFName; ?></a></span>
                                <span class="fff">|</span>
                                    <span class="thdate"><a style="color:#687a86;"><?php echo date_format($datetime,"d/m/y"); echo " ( ".time_elapsed($nowtime-$oldtime)." ) \n"; ?></a></span>
                                <span class="fff">|</span>
                                <span class="thcmd"><a style="color:#687a86;">Commenting : <?php echo $total; ?></span>
                            </div>
                            <br>
                            <?php
                        }
                        ?>
                    </div>
                    <a class="topic" href="index.php?page=publicforum&forum=5&topic=proposal">Proposal</a>
                    <div class="card-footer">
                        <a style="">
                        <?php
                        $filter = ['school_id'=>$_SESSION["loggeduser_schoolID"],'Forum'=>'5'];
                        $option = ['limit'=>5,'sort' => ['_id' => -1]];
                        $query = new MongoDB\Driver\Query($filter,$option);
                        $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.SchoolForum',$query);

                        foreach ($cursor as $document)
                        {   
                            $Forumid = ($document->_id);
                            $ForumTitle = ($document->ForumTitle);
                            $ForumDate = ($document->ForumDate);
                            $Consumer_id = ($document->Consumer_id);
                            
                            $utcdatetime = new MongoDB\BSON\UTCDateTime(strval($ForumDate));
                            $datetime = $utcdatetime->toDateTime()->setTimezone(new \DateTimeZone(date_default_timezone_get()));
                            $dateforum = date_format($datetime,"Y-m-d\TH:i:s");
                            $date = new MongoDB\BSON\UTCDateTime((new DateTime($dateforum))->getTimestamp());
                        
                            $oldtime = strval($date);

                            $consumerid = new \MongoDB\BSON\ObjectId($Consumer_id);
                            $filter1 = ['_id' => $consumerid];
                            $query1 = new MongoDB\Driver\Query($filter1);
                            $cursor1 = $GoNGetzDatabase->executeQuery('GoNGetz.Consumer', $query1);
            
                            foreach ($cursor1 as $document1)
                            {
                            $ConsumerFName = ($document1->ConsumerFName);
                            }

                            $total = 0;
                            $filter2 = ['School_id'=>$_SESSION["loggeduser_schoolID"],'Forum_id'=>$Forumid,'ForumParent_id'=>'0'];
                            $query2 = new MongoDB\Driver\Query($filter2);
                            $cursor2 = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.SchoolForumComment',$query2);
                            foreach ($cursor2 as $document2)
                            {
                                $total = $total + 1;
                            }
                            ?>
                            <a style="color:#076d79; text-decoration: none;" href="index.php?page=publicforumdetail&forum=1&topic=general&id=<?php echo $Forumid; ?>"><?php echo $ForumTitle."<br>"; ?></a>
                            <!--listbox-->
                            <div id="listbox">
                                <span class="thaut"><a style="color:#687a86;"><?php echo $ConsumerFName; ?></a></span>
                                <span class="fff">|</span>
                                    <span class="thdate"><a style="color:#687a86;"><?php echo date_format($datetime,"d/m/y"); echo " ( ".time_elapsed($nowtime-$oldtime)." ) \n"; ?></a></span>
                                <span class="fff">|</span>
                                <span class="thcmd"><a style="color:#687a86;">Commenting : <?php echo $total; ?></span>
                            </div>
                            <br>
                            <?php
                        }
                        ?>
                        </a>
                    </div>
                    <a class="topic" href="index.php?page=publicforum&forum=6&topic=short news / info">Short News / Info</a>
                    <div class="card-footer">
                        <?php
                        $filter = ['school_id'=>$_SESSION["loggeduser_schoolID"],'Forum'=>'6'];
                        $option = ['limit'=>5,'sort' => ['_id' => -1]];
                        $query = new MongoDB\Driver\Query($filter,$option);
                        $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.SchoolForum',$query);

                        foreach ($cursor as $document)
                        {
                            $Forumid = ($document->_id);
                            $ForumTitle = ($document->ForumTitle);
                            $ForumDate = ($document->ForumDate);
                            $Consumer_id = ($document->Consumer_id);
                            
                            $utcdatetime = new MongoDB\BSON\UTCDateTime(strval($ForumDate));
                            $datetime = $utcdatetime->toDateTime()->setTimezone(new \DateTimeZone(date_default_timezone_get()));
                            $dateforum = date_format($datetime,"Y-m-d\TH:i:s");
                            $date = new MongoDB\BSON\UTCDateTime((new DateTime($dateforum))->getTimestamp());
                        
                            $oldtime = strval($date);

                            $consumerid = new \MongoDB\BSON\ObjectId($Consumer_id);
                            $filter1 = ['_id' => $consumerid];
                            $query1 = new MongoDB\Driver\Query($filter1);
                            $cursor1 = $GoNGetzDatabase->executeQuery('GoNGetz.Consumer', $query1);
            
                            foreach ($cursor1 as $document1)
                            {
                            $ConsumerFName = ($document1->ConsumerFName);
                            }

                            $total = 0;
                            $filter2 = ['School_id'=>$_SESSION["loggeduser_schoolID"],'Forum_id'=>$Forumid,'ForumParent_id'=>'0'];
                            $query2 = new MongoDB\Driver\Query($filter2);
                            $cursor2 = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.SchoolForumComment',$query2);
                            foreach ($cursor2 as $document2)
                            {
                                $total = $total + 1;
                            }
                            ?>
                            <a style="color:#076d79; text-decoration: none;" href="index.php?page=publicforumdetail&forum=1&topic=general&id=<?php echo $Forumid; ?>"><?php echo $ForumTitle."<br>"; ?></a>
                            <div id="listbox">
                                <span class="thaut"><a style="color:#687a86;"><?php echo $ConsumerFName; ?></a></span>
                                <span class="fff">|</span>
                                    <span class="thdate"><a style="color:#687a86;"><?php echo date_format($datetime,"d/m/y"); echo " ( ".time_elapsed($nowtime-$oldtime)." ) \n"; ?></a></span>
                                <span class="fff">|</span>
                                <span class="thcmd"><a style="color:#687a86;">Commenting : <?php echo $total; ?></span>
                            </div>
                            <br>
                            <?php
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-3">
    <div class="card">
    <div class="card-header">
                <strong>Details</strong>
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

                        <p class="spacing-bottom">Read the <a href="#">Basic Rules</a>.</p>
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
    </div>
    </div>
</div>