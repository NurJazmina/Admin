<?php
$category = ($_GET['forum']);
$topic = ($_GET['topic']);
$_SESSION["title"] = "School Forum : $topic ";
?>
<?php include 'view/partials/_subheader/subheader-v1.php'; ?>
<?php 
include ('model/schoolforum.php'); 
?>
<style>
.button--tag.button-large, .topics--large .button--tag {

    font-size: 15px;
    padding: 4px 15px;
}
.button--tag.-inverted, .topics--inverted .button--tag {
    border-color: #fff;
    color: #fff;
    background-color: transparent;
}
.button--tag {
    border-radius: 30px;
    line-height: 1.1em;
    border: 1px solid #5cb767;
}

.spacing-right {
    margin-right: 10px;
}

.spacing-left {
    margin-left: 10px;
}


.discussion-title {
    font-size: 22px;
    line-height: 1.25em;
    word-wrap: break-word;
    font-weight: 600;
}

.card__footer {
    padding: 5px 5px 5px;
}


.img-round-sm {
    border-radius: 10%;
    height: 40px;
    width: 40px;
}

.img-round-small {
    border-radius: 50%;
    height: 20px;
    width: 20px;
}
</style>

<br><br><br>
<div class="row" >
    <div class="col-lg-2">
        <div class="row">
        </div>
    </div>
    <div class="col-md-7 section-1-box wow fadeInUp">
        <div style="color: #5e9164; background-color: #8bcf93;  border-radius: 8px; ">
            <div class="modal-header">
                <div class="spacing-right">
                <strong>Channel Topic : </strong><span class="button--tag -inverted button-large"><?php echo $_GET['topic']; ?></span>
                </div>
            </div>
        </div><br><br>
        <?php
        $id = new \MongoDB\BSON\ObjectId($_GET['id']);
        if ($_SESSION["loggeduser_ConsumerGroup_id"]=='601b4cfd97728c027c01f187')
        {
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
                $ret[] = 'ago.';
            
                return join(' ', $ret);
            }
            $ConsumerFName3=" ";
            $filter = ['_id'=>$id];
            $query = new MongoDB\Driver\Query($filter);
            $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.SchoolForum',$query);

            foreach ($cursor as $document)
            {
                $total =0;
                $Forumid = strval($document->_id);
                $ForumTitle = ($document->ForumTitle);
                $ForumDetails = ($document->ForumDetails);
                $ForumDate = ($document->ForumDate);
                $Consumer_id = ($document->Consumer_id);

                $utcdatetime = new MongoDB\BSON\UTCDateTime(strval($ForumDate));
                $datetime = $utcdatetime->toDateTime()->setTimezone(new \DateTimeZone(date_default_timezone_get()));
                $dateforum = date_format($datetime,"Y-m-d\TH:i:s");
                $date = new MongoDB\BSON\UTCDateTime((new DateTime($dateforum))->getTimestamp());
            
                $nowtime = time();
                $oldtime = strval($date);

                $filter2 = ['school_id'=>$_SESSION["loggeduser_schoolID"],'ForumParentid'=>$Forumid,'Forum'=>$category];
                $query2 = new MongoDB\Driver\Query($filter2);
                $cursor2 = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.SchoolForum',$query2);
                
                $consumerid = new \MongoDB\BSON\ObjectId($Consumer_id);
                $filter1 = ['_id' => $consumerid];
                $query1 = new MongoDB\Driver\Query($filter1);
                $cursor1 = $GoNGetzDatabase->executeQuery('GoNGetz.Consumer', $query1);

                foreach ($cursor1 as $document1)
                {
                $ConsumerFName = ($document1->ConsumerFName);
                $ConsumerLName = ($document1->ConsumerLName);
                ?>
                <strong class="discussion-title" style="font-size: 42px; color: #353a3d">General: <?php echo $ForumTitle; ?></strong><br><br>
                <div class="spacing-right" >
                    <img class="img-round-sm" src="//a.disquscdn.com/1617742046/images/noavatar92.png">
                    <a href="index.php?page=staffdetail&id=<?php echo $Consumer_id; ?>" style="color:#2e9fff; text-decoration: none;"><?php echo $ConsumerFName." ".$ConsumerLName;?></a>
                    <a style="color:#687a86;"><?php echo " . ".time_elapsed($nowtime-$oldtime)."\n"; ?></a>
                </div>
                <br><br>
                <div class="spacing-right">
                    <span class="claimedRight"><?php echo $ForumDetails; ?></span>
                </div>
                <br>
                <br>
                <div class="card">
                    <div class="card-header">
                    <?php
                    foreach ($cursor2 as $document2)
                    {
                    $total = $total + 1;
                    $Forumid2 = strval($document2->_id);
                    $ForumDetails2 = ($document2->ForumDetails);
                    $Consumer_id2 = ($document2->Consumer_id);

                        $consumerid2 = new \MongoDB\BSON\ObjectId($Consumer_id2);
                        $filter3 = ['_id' => $consumerid2];
                        $query3 = new MongoDB\Driver\Query($filter3);
                        $cursor3 = $GoNGetzDatabase->executeQuery('GoNGetz.Consumer', $query3);
                        foreach ($cursor3 as $document3)
                        {
                        $ConsumerFName3 = ($document3->ConsumerFName);
                        $ConsumerLName3 = ($document3->ConsumerLName);
                        }
                    }
                    ?>
                    <div class="row">
                        <div class="col-lg-5">
                        <div class="row">
                            <div class="col-lg-5">
                                <a class="button--recommend button-small" href="#" style="color:#f05f70;">
                                    <span class="button__text hidden-md"><i class="fas fa-heart"></i> Recommend <?php echo " 1"; ?></span>
                                </a>
                            </div>
                            <div class="col-lg-7">
                            </div>
                        </div>    
                        </div>
                        <div class="col-lg-4">
                        </div>
                        <div class="col-lg-3">
                        <div class="row">
                            <div class="col-lg-4">
                            </div>
                            <div class="col-lg-4">
                                    <a href="index.php?page=schoolforumdetail&forum=<?php echo $_GET['forum']; ?>&topic=<?php echo $_GET['topic'];?>&id=<?php echo $id;?>" style="color:#076d79; text-decoration: none;">Newest</a>
                            </div>
                            <div class="col-lg-4">
                                    <a href="index.php?page=schoolforumdetail&forum=<?php echo $_GET['forum']; ?>&topic=<?php echo $_GET['topic'];?>&id=<?php echo $id;?>&sort" tabindex="-1" data-type="alpha" style="color:#076d79; text-decoration: none;">Oldest</a>
                            </div>
                        </div>    
                        </div>
                    </div>
                    </div>
                    <div class="card-body" style="color:#687a86;">
                    <ul style="list-style:none;text-align:center;border-bottom: 3px solid #e7e9ee;margin:0;padding:0;">
                        <li>
                        <a >Comments <?php echo " ".$total; ?></a>
                        </li>
                    </ul>
                    </div>
                    <div class="card-body">
                        <form action="index.php?page=schoolforumdetail&forum=<?php echo $_GET['forum']; ?>&topic=<?php echo $_GET['topic'];?>&id=<?php echo $id;?>" method="post" name="AddForumsComment">
                            <div class="row">
                                <textarea name="txtdetail" placeholder="Join, the discussion..." cols="30" rows="5" ></textarea>
                                <div class="col-lg-12">
                                <div class="row">
                                    <div class="col-lg-10">
                                    </div>
                                    <div class="col-lg-2">
                                        <input type="hidden"  name="txtforum" value="<?php echo  $category; ?>">
                                        <input type="hidden"  name="txtForumParentid" value="<?php echo  $Forumid; ?>">
                                        <button type="submit" class="btn btn-secondary" name="AddForumsComment">Post as <?php echo $ConsumerFName3;  ?></button>
                                    </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>

                    <?php
                    //sorting by category
                    if (!isset($_GET['sort']) && empty($_GET['sort']))
                    {
                        $filter4 = ['school_id'=>$_SESSION["loggeduser_schoolID"],'ForumParentid'=>$Forumid,'Forum'=>$category];
                        $option4 = ['sort' => ['_id' => -1]];
                        $query4 = new MongoDB\Driver\Query($filter4,$option4);
                        $cursor4 = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.SchoolForum',$query4);
                    }
                    else
                    {
                        $filter4 = ['school_id'=>$_SESSION["loggeduser_schoolID"],'ForumParentid'=>$Forumid,'Forum'=>$category];
                        $option4 = ['sort' => ['_id' => 1]];
                        $query4 = new MongoDB\Driver\Query($filter4,$option4);
                        $cursor4 = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.SchoolForum',$query4);
                    }

                    foreach ($cursor4 as $document4)
                    {
                    $total = $total + 1;
                    $Forumid4 = strval($document4->_id);
                    $ForumDetails4 = ($document4->ForumDetails);
                    $Consumer_id4 = ($document4->Consumer_id);

                        $consumerid4 = new \MongoDB\BSON\ObjectId($Consumer_id4);
                        $filter5 = ['_id' => $consumerid4];
                        $query5 = new MongoDB\Driver\Query($filter5);
                        $cursor5 = $GoNGetzDatabase->executeQuery('GoNGetz.Consumer', $query5);
                        foreach ($cursor5 as $document5)
                        {
                        $ConsumerFName5 = ($document5->ConsumerFName);
                        $ConsumerLName5 = ($document5->ConsumerLName);
                    ?>
                    <div class="card-body">
                    <div class="accordion accordion-flush" id="accordionFlushExample">
                        <div class="accordion-item">
                        <h2 class="accordion-header" id="flush-heading<?php echo $Forumid4; ?>">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse<?php echo $Forumid4; ?>" aria-expanded="false" aria-controls="flush-collapse<?php echo $Forumid4; ?>">
                                <div class="spacing-right">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <img class="img-round-small" src="//a.disquscdn.com/1617742046/images/noavatar92.png">
                                            <small href="index.php?page=schoolforumdetail&forum=<?php echo $_GET['forum']; ?>&topic=<?php echo $_GET['topic'];?>&id=<?php echo $Consumer_id4;?>" style="text-decoration: none;"><?php echo " ".$ConsumerFName5." ".$ConsumerLName5;?></small>
                                        </div>
                                    </div>
                                </div>
                                <div class="spacing-right">
                                <span style="color:#687a86;"><?php echo $ForumDetails4; ?></span>
                                </div>
                            </button>
                        </h2>
                        <div id="flush-collapse<?php echo $Forumid4; ?>" class="accordion-collapse collapse" aria-labelledby="flush-heading<?php echo $Forumid4; ?>" data-bs-parent="#accordionFlushExample">
                            <div class="card-body">
                                <form name="AddForumsCommentChild" action="index.php?page=schoolforumdetail&forum=<?php echo $_GET['forum']; ?>&topic=<?php echo $_GET['topic'];?>&id=<?php echo $id;?>" method="post">
                                    <div class="row">
                                        <textarea name="txtdetail" placeholder="Join, the discussion..." cols="30" rows="5" ></textarea>
                                        <div class="col-lg-12">
                                        <div class="row">
                                            <div class="col-lg-10">
                                            </div>
                                            <div class="col-lg-2">
                                                <input type="hidden"  name="txtforum" value="<?php echo  $category; ?>">
                                                <input type="hidden"  name="txtForumParentid" value="<?php echo $Forumid4; ?>">
                                                <button type="submit" class="btn btn-secondary" name="AddForumsCommentChild">Post as <?php echo $ConsumerFName3;  ?></button>
                                            </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <?php

                            $filter6 = ['school_id'=>$_SESSION["loggeduser_schoolID"],'ForumParentid'=>$Forumid4,'Forum'=>$category];
                            $query6 = new MongoDB\Driver\Query($filter6);
                            $cursor6 = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.SchoolForum',$query6);

                            foreach ($cursor6 as $document6)
                            {
                            $total = $total + 1;
                            $Forumid6 = strval($document6->_id);
                            $ForumDetails6 = ($document6->ForumDetails);
                            $Consumer_id6 = ($document6->Consumer_id);

                                $consumerid6 = new \MongoDB\BSON\ObjectId($Consumer_id6);
                                $filter7 = ['_id' => $consumerid6];
                                $query7 = new MongoDB\Driver\Query($filter5);
                                $cursor7 = $GoNGetzDatabase->executeQuery('GoNGetz.Consumer', $query7);
                                foreach ($cursor7 as $document7)
                                {
                                $ConsumerFName7 = ($document7->ConsumerFName);
                                $ConsumerLName7 = ($document7->ConsumerLName);
                            ?>
                               <div class="card-body">
                                    <div class="spacing-right">
                                            <div class="row">
                                                <div class="col-lg-5">
                                                    <div class="col-lg-1">
                                                    </div>
                                                    <div class="col-lg-11">
                                                        <img class="img-round-small" src="//a.disquscdn.com/1617742046/images/noavatar92.png">
                                                        <small href="index.php?page=schoolforumdetail&forum=<?php echo $_GET['forum']; ?>&topic=<?php echo $_GET['topic'];?>&id=<?php echo $Consumer_id6;?>" style="text-decoration: none;"><?php echo " ".$ConsumerFName7." ".$ConsumerLName7;?></small>
                                                        <span style="color:#687a86;"><?php echo $ForumDetails6; ?></span>
                                                    </div>
                                                </div>
                                            </div>
                                    </div>
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
                        }
                    }
                    ?>
                </div>
                <br>
            <?php
                }
            }
        }
        ?>
    </div>

    <div class="col-lg-3">
    <div class="row">
        <div class="col-md-8 section-1-box wow fadeInUp">
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
                    <li>Targeted harassment or encouraging others </li>
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

        <div class="col-md-4 section-1-box wow fadeInUp">
        <!-- hidden box -->
        </div>
    </div>
    </div>
</div>
<br><br><br><br>