<?php
$category = ($_GET['forum']);
$topic = ($_GET['topic']);
$_SESSION["title"] = "Public Forum: $topic ";
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
    border-radius: 50%;
    height: 28px;
    width: 28px;
}

.img-round-small {
    border-radius: 50%;
    height: 20px;
    width: 20px;
}
</style>
<br><br><br>
<div class="row" >
    <div class="col-lg-3">
    <div class="row">
        <div class="col-md-4 section-1-box wow fadeInUp">
        <!-- hidden box -->
        </div>
        
        <div class="col-md-8 section-1-box wow fadeInUp">
        <div class="column">
            <div class="card-header" style="color: #5e9164; background-color: #8bcf93;  border-radius: 8px; ">
                <div class="spacing-right">
                        <a href="index.php?page=modalforums&forum=<?php echo $sort; ?>&topic=<?php echo $topic; ?>" style="color:#ffffff; text-decoration: none;"><strong>ADD FORUMS </strong></a>
                        <span class="button--tag -inverted button-large"><?php echo $_GET['topic']; ?></span>
                </div>
            </div><br>
            <div class="card">
                <div class="card-body">
                    <div class="spacing-right">
                        <span style="color:#687a86;">Channel Topics</span><br><br>
                        <div class="spacing-right">
                        <a href="index.php?page=publicforum&forum=4&topic=general">
                            <span class="button--tag -inverted button-large" style="color: #5e9164; border-color: #8bcf93;">General</span>
                        </a><br><br>
                        <a href="index.php?page=publicforum&forum=5&topic=proposal">
                            <span class="button--tag -inverted button-large" style="color: #5e9164; border-color: #8bcf93;">Proposal</span>
                        </a><br><br>
                        <a href="index.php?page=publicforum&forum=6&topic=short news / info">
                            <span class="button--tag -inverted button-large" style="color: #5e9164; border-color: #8bcf93;">Short News</span>
                        </a><br><br>
                        <a href="index.php?page=publicforum&forum=6&topic=short news / info">
                            <span class="button--tag -inverted button-large" style="color: #5e9164; border-color: #8bcf93;">Info</span>
                        </a><br><br>
                        </div>
                    </div>
                </div>
            </div>
        </div>    
        </div>
    </div>
    </div>
    <div class="col-md-6 section-1-box wow fadeInUp">
        <div style="color: #5e9164; background-color: #8bcf93;  border-radius: 8px; ">
            <div class="modal-header">
                <div class="spacing-right">
                <strong>Channel Topic : </strong><span class="button--tag -inverted button-large"><?php echo $_GET['topic']; ?></span>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
        </div><br>
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
                $ret[] = 'ago.';
            
                return join(' ', $ret);
            }
            $ConsumerFName3=" ";
            $ConsumerLName3=" ";
            $ForumDetails2=" ";
            $filter = ['school_id'=>$_SESSION["loggeduser_schoolID"],'ForumParentid'=>'0','Forum'=>$category];
            $option = ['sort' => ['_id' => -1]];
            $query = new MongoDB\Driver\Query($filter,$option);
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
                <div class="card">
                    <div class="card-header ">
                        <div class="spacing-right">
                          <div class="row">
                          <div class="col-lg-12">
                                <img class="img-round-sm" src="//a.disquscdn.com/1617742046/images/noavatar92.png">
                                <a href="index.php?page=staffdetail&id=<?php echo $Consumer_id; ?>" style="color:#2e9fff; text-decoration: none;"><?php echo $ConsumerFName." ".$ConsumerLName;?></a>
                                <a style="color:#687a86;">Started a discussion</a>
                                <a style="color:#687a86;"><?php echo " . ".time_elapsed($nowtime-$oldtime)."\n"; ?></a>
                          </div>
                          </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="spacing-right">
                        <a href="index.php?page=schoolforumdetail&forum=<?php echo $_GET['forum']; ?>&topic=<?php echo $_GET['topic'];?>&id=<?php echo $Forumid;?>" style="color:#353a3d; text-decoration: none;">
                            <h2 class="discussion-title" >General: <?php echo $ForumTitle; ?></h2>
                        </a>
                        <a href="index.php?page=schoolforumdetail&forum=<?php echo $_GET['forum']; ?>&topic=<?php echo $_GET['topic'];?>&id=<?php echo $Forumid;?>" style="color:#353a3d; text-decoration: none;">
                            <span class="claimedRight" ><?php echo $ForumDetails; ?></span>
                        </a>
                        </div>
                    </div>
                    <div class="card-body">
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
                            <div class="col-lg-6">
                                <a class="button--recommend button-small" style="color:#f05f70;">
                                    <span class="button__text hidden-md"><i class="fas fa-heart"></i> Recommend</span>
                                    <span class="button__count">1</span>
                                </a>
                            </div>
                            <div class="col-lg-4">
                                <a class="button button-lnk spacing-right-small" href="index.php?page=schoolforumdetail&forum=<?php echo $_GET['forum']; ?>&topic=<?php echo $_GET['topic'];?>&id=<?php echo $Forumid;?>">Comments 
                                <span class="label--count"><?php echo $total; ?></span>
                                </a>
                            </div>
                        </div>    
                        </div>
                    </div>
                    </div>
                    <div class="card-header">
                            <div class="spacing-right">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <img class="img-round-small" src="//a.disquscdn.com/1617742046/images/noavatar92.png">
                                        <small href="index.php?page=schoolforumdetail&forum=<?php echo $_GET['forum']; ?>&topic=<?php echo $_GET['topic'];?>&id=<?php echo $Forumid;?>" style="text-decoration: none;"><?php echo " ".$ConsumerFName3." ".$ConsumerLName3;?></small>
                                     </div>
                                </div>
                            </div>
                        <div class="card-body">
                            <div class="spacing-right">
                            <a href="index.php?page=schoolforumdetail&forum=<?php echo $_GET['forum']; ?>&topic=<?php echo $_GET['topic'];?>&id=<?php echo $Forumid;?>" target="_blank" style="color:#687a86; text-decoration: none;"><?php echo $ForumDetails2; ?></a>
                            </div>
                        </div>
                    </div>
                </div>
                <br>
            <?php
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

        <div class="col-md-4 section-1-box wow fadeInUp">
        <!-- hidden box -->
        </div>
    </div>
    </div>
</div>
<br><br>