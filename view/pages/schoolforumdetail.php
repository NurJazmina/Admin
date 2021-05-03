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

.post-comments .avatar img {
    width: 22px;
    height: 22px;
    display: block;
}
.avatar>img {
    border-radius: 50%;
    max-width: 50px;
    max-height: 50px;
}
</style>

<br><br><br>
<div class="row" >
<div class="col-lg-2">
</div>
    <div class="col-md-6 section-1-box wow fadeInUp">
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
                $ret[] = 'ago';
            
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

                $filter2 = ['School_id'=>$_SESSION["loggeduser_schoolID"],'Forum_id'=>$Forumid,'ForumParent_id'=>'0'];
                $query2 = new MongoDB\Driver\Query($filter2);
                $cursor2 = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.SchoolForumComment',$query2);
                
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
                    <img class="img-round-sm block__item" src="https://c.disquscdn.com/uploads/users/383/2435/avatar92.jpg?1615629681" alt="avatar">
                    <a href="index.php?page=staffdetail&id=<?php echo $Consumer_id; ?>" style="color:#2e9fff; text-decoration: none;"><?php echo $ConsumerFName." ".$ConsumerLName;?></a>
                    <a style="color:#687a86;"><?php echo date_format($datetime,"d/m/y"); echo " ( ".time_elapsed($nowtime-$oldtime)." ) \n"; ?></a>
                </div>
                <br><br>
                <div class="spacing-right">
                    <span ><?php echo $ForumDetails; ?></span>
                </div>
                <br>
                <br>
                <div class="card">
                    <div class="card-header">
                        <?php
                        foreach ($cursor2 as $document2)
                        {
                            $total = $total + 1;
                            $Forum_id = strval($document2->Forum_id);
                            $SchoolForumDetails = ($document2->SchoolForumDetails);
                            $SchoolForumStaff_id = ($document2->SchoolForumStaff_id);

                            $SchoolForumStaff_id = new \MongoDB\BSON\ObjectId($SchoolForumStaff_id);
                            $filter3 = ['_id' => $SchoolForumStaff_id];
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
                                            <span class="button__text hidden-md"></span>
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
                                    <div class="col-lg-2">
                                    </div>
                                    <div class="col-lg-5">
                                            <a href="index.php?page=schoolforumdetail&forum=<?php echo $_GET['forum']; ?>&topic=<?php echo $_GET['topic'];?>&id=<?php echo $id;?>" style="color:#076d79; text-decoration: none;">Newest</a>
                                    </div>
                                    <div class="col-lg-5">
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
                            <form action="index.php?page=schoolforumdetail&forum=<?php echo $_GET['forum']; ?>&topic=<?php echo $_GET['topic'];?>&id=<?php echo $id;?>" method="post" name="AddForumsComment">
                                <div class="row">
                                    <textarea class="basic-example2" name="txtdetail" placeholder="Join, the discussion..." ></textarea>
                                    <div class="col-lg-12">
                                    <div class="row">
                                        <div class="col-lg-10">
                                        </div>
                                        <div class="text-right">
                                        <br>
                                            <input type="hidden"  name="txtForumid" value="<?php echo $Forumid; ?>">
                                            <button type="submit" class="btn btn-secondary" name="AddForumsComment">Post as <?php echo $_SESSION["loggeduser_consumerFName"];  ?></button>
                                        </div>
                                        </div>
                                    </div>
                                </div>
                            </form> 
                        <?php
                        //sorting by category
                        if (!isset($_GET['sort']) && empty($_GET['sort']))
                        {
                            $filter4 = ['School_id'=>$_SESSION["loggeduser_schoolID"],'Forum_id'=>$Forumid,'ForumParent_id'=>'0'];
                            $option4 = ['sort' => ['_id' => -1]];
                            $query4 = new MongoDB\Driver\Query($filter4,$option4);
                            $cursor4 = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.SchoolForumComment',$query4);
                        }
                        else
                        {
                            $filter4 = ['School_id'=>$_SESSION["loggeduser_schoolID"],'Forum_id'=>$Forumid,'ForumParent_id'=>'0'];
                            $option4 = ['sort' => ['_id' => 1]];
                            $query4 = new MongoDB\Driver\Query($filter4,$option4);
                            $cursor4 = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.SchoolForumComment',$query4);
                        }

                        foreach ($cursor4 as $document4)
                        {
                            $id4 = strval($document4->_id);
                            $Forum_id4 = strval($document4->Forum_id);
                            $SchoolForumDetails4 = ($document4->SchoolForumDetails);
                            $SchoolForumStaff_id4 = ($document4->SchoolForumStaff_id);

                            $SchoolForumStaff_id4 = new \MongoDB\BSON\ObjectId($SchoolForumStaff_id4);
                            $filter5 = ['_id' => $SchoolForumStaff_id4];
                            $query5 = new MongoDB\Driver\Query($filter5);
                            $cursor5 = $GoNGetzDatabase->executeQuery('GoNGetz.Consumer', $query5);
                            foreach ($cursor5 as $document5)
                            {
                            $ConsumerFName5 = ($document5->ConsumerFName);
                            $ConsumerLName5 = ($document5->ConsumerLName);
                        ?>
                        <div class="row">
                            <div class="col">
                                <div class="accordion accordion-flush" id="accordionFlushExample">
                                <div class="accordion-item">
                                <h2 class="accordion-header" id="flush-heading<?php echo $id4; ?>">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse<?php echo $id4; ?>" aria-expanded="false" aria-controls="flush-collapse<?php echo $id4; ?>">
                                        <div class="spacing-right">
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <img class="img-round-sm block__item" src="https://c.disquscdn.com/uploads/users/383/2435/avatar92.jpg?1615629681" alt="avatar">
                                                    <small style="text-decoration: none;"><?php echo " ".$ConsumerFName5." ".$ConsumerLName5;?></small>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="spacing-right">
                                        <span style="color:#687a86;"><?php echo $SchoolForumDetails4; ?></span>
                                        </div>
                                    </button>
                                </h2>
                                <div id="flush-collapse<?php echo $id4; ?>" class="accordion-collapse collapse" aria-labelledby="flush-heading<?php echo $id4; ?>" data-bs-parent="#accordionFlushExample">
                                    <?php
                                    $filter6 = ['School_id'=>$_SESSION["loggeduser_schoolID"],'Forum_id'=>$Forumid,'ForumParent_id'=>$id4];
                                    $option6 = ['sort' => ['_id' => 1]];
                                    $query6 = new MongoDB\Driver\Query($filter6,$option6);
                                    $cursor6 = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.SchoolForumComment',$query6);

                                    foreach ($cursor6 as $document6)
                                    {
                                        $Forum_id6 = strval($document6->Forum_id);
                                        $SchoolForumDetails6 = ($document6->SchoolForumDetails);
                                        $SchoolForumStaff_id6 = ($document6->SchoolForumStaff_id);

                                        $SchoolForumStaff_id6 = new \MongoDB\BSON\ObjectId($SchoolForumStaff_id6);
                                        $filter7 = ['_id' => $SchoolForumStaff_id6];
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
                                                                <small style="text-decoration: none;"><?php echo " ".$ConsumerFName7." ".$ConsumerLName7;?></small>
                                                                <span style="color:#687a86;"><?php echo $SchoolForumDetails6; ?></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                            </div>
                                        </div>
                                        <?php
                                        }
                                    }
                                    ?>
                                        <div class="card-body">
                                            <form name="AddForumsCommentChild" action="index.php?page=schoolforumdetail&forum=<?php echo $_GET['forum']; ?>&topic=<?php echo $_GET['topic'];?>&id=<?php echo $id;?>" method="post">
                                                <div class="row">
                                                    <textarea class="basic-example2" name="txtdetail" placeholder="Join, the discussion..."></textarea>
                                                    <div class="col-lg-12">
                                                        <div class="row">
                                                            <div class="col-lg-10">
                                                            </div>
                                                            <div class="text-right">
                                                            <br>
                                                                <input type="hidden"  name="txtForumid" value="<?php echo  $Forumid; ?>">
                                                                <input type="hidden"  name="txtForumParent_id" value="<?php echo $id4; ?>">
                                                                <button type="submit" class="btn btn-secondary" name="AddForumsCommentChild">Post as <?php echo $_SESSION["loggeduser_consumerFName"];  ?></button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
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
                <br>
            <?php
                }
            }
        }
        ?>
    </div>
</div>

<div class="col-lg-2">
<div class="row">
    <div class="card-header">
        <strong>Latest Forum</strong><span class="button--tag -inverted button-large"><?php echo "testing"; ?></span>
    </div>
    <?php
    $filter = ['School_id'=>$_SESSION["loggeduser_schoolID"],'ForumParentid'=>'0','Forum'=>$category];
    $option = ['sort' => ['_id' => 1]];
    $query = new MongoDB\Driver\Query($filter,$option);
    $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.SchoolForum',$query);

    foreach ($cursor as $document)
    {
        $ForumDetails1 ="";
        $total = 0;
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

        $filter1 = ['school_id'=>$_SESSION["loggeduser_schoolID"],'Forum_id'=>$Forumid,'ForumParent_id'=>'0'];
        $option1 = ['sort' => ['_id' => 1]];
        $query1 = new MongoDB\Driver\Query($filter1,$option1);
        $cursor1 = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.SchoolForumComment',$query1);

        foreach ($cursor1 as $document1)
        {
            $total = $total + 1;
            $Forum_id = strval($document1->Forum_id);
            $SchoolForumDetails = ($document1->SchoolForumDetails);
            $SchoolForumStaff_id = ($document1->SchoolForumStaff_id);
            $SchoolForumDate = ($document1->SchoolForumDate);

            $SchoolForumStaff_id = new \MongoDB\BSON\ObjectId($SchoolForumStaff_id);
            $filter2 = ['_id' => $SchoolForumStaff_id];
            $query2 = new MongoDB\Driver\Query($filter2);
            $cursor2 = $GoNGetzDatabase->executeQuery('GoNGetz.Consumer', $query2);
    
            foreach ($cursor2 as $document2)
            {
            $ConsumerFName = ($document2->ConsumerFName);
            $ConsumerLName = ($document2->ConsumerLName);
            }
        }

    }
    ?>
    <div class="card-body" style="background-color:#ffffff">
        <div class="row">
            <div class="row">
            <a style="font-size: 14px; font-weight: 600;" href="index.php?page=schoolforumdetail&forum=<?php echo $_GET['forum']; ?>&topic=<?php echo $_GET['topic'];?>&id=<?php echo $Forumid;?>" ><?php echo $ForumTitle; ?></a><br><br>
            </div>
            <div class="claimedRight">
            <a style="" ><?php echo $SchoolForumDetails; ?></a>
            </div>
        </div>
        <br>
        <div class="row">
            <a style="" class="button button-lnk spacing-right-small" href="index.php?page=schoolforumdetail&forum=<?php echo $_GET['forum']; ?>&topic=<?php echo $_GET['topic'];?>&id=<?php echo $Forumid;?>" data-link-name="view_discussion" data-thread-id="8434285354">
            Comments 
            <span class="label--count"><?php echo $total; ?></span>
            </a>
        </div>
    </div>
    <div class="card-footer" style="background-color:#f7f9fa">
        <div class="card__additional">
            <div class="row">
                <div class="col">
                    <div class="post-comments">
                        <div class="post-comments__reason">
                            <a href="" class="avatar" data-link-name="user_avatar"><img src="https://c.disquscdn.com/uploads/forums/318/9088/avatar92.jpg?1428445417" alt="avatar"></a>
                        </div>
                    </div>
                </div>
                <div class="col" style="text-align:right;">
                    <a><?php echo $ConsumerFName.$ConsumerLName; ?></a>
                </div>
                <div class="col">
                </div>
                <div class="col">
                </div>
            </div>
            <div class="row">
                <div class="col" style="text-align:right;">
                    <a href="index.php?page=schoolforumdetail&forum=<?php echo $_GET['forum']; ?>&topic=<?php echo $_GET['topic'];?>&id=<?php echo $Forumid1;?>"><?php echo $SchoolForumDetails; ?></a>
                </div>
            </div>
        </div>
    </div>
</div>
<br><br>

<div class="row">
    <div class="card-header">
        <strong>Active Forum</strong><span class="button--tag -inverted button-large"><?php echo "testing"; ?></span>
    </div>
    <?php
    $filter = ['school_id'=>$_SESSION["loggeduser_schoolID"],'ForumParentid'=>'0','Forum'=>$category];
    $option = ['sort' => ['_id' => 1]];
    $query = new MongoDB\Driver\Query($filter,$option);
    $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.SchoolForum',$query);

    foreach ($cursor as $document)
    {
        $ForumDetails1 ="";
        $total = 0;
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

        $filter1 = ['School_id'=>$_SESSION["loggeduser_schoolID"],'Forum_id'=>$Forumid,'ForumParent_id'=>'0'];
        $option1 = ['sort' => ['_id' => 1]];
        $query1 = new MongoDB\Driver\Query($filter1,$option1);
        $cursor1 = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.SchoolForumComment',$query1);

        foreach ($cursor1 as $document1)
        {
            $total = $total + 1;
            $Forum_id = strval($document1->Forum_id);
            $SchoolForumDetails = ($document1->SchoolForumDetails);
            $SchoolForumStaff_id = ($document1->SchoolForumStaff_id);
            $SchoolForumDate = ($document1->SchoolForumDate);

            $SchoolForumStaff_id = new \MongoDB\BSON\ObjectId($SchoolForumStaff_id);
            $filter2 = ['_id' => $SchoolForumStaff_id];
            $query2 = new MongoDB\Driver\Query($filter2);
            $cursor2 = $GoNGetzDatabase->executeQuery('GoNGetz.Consumer', $query2);
    
            foreach ($cursor2 as $document2)
            {
            $ConsumerFName = ($document2->ConsumerFName);
            $ConsumerLName = ($document2->ConsumerLName);
            }
        }

    }
    ?>
    <div class="card-body" style="background-color:#ffffff">
        <div class="row">
            <div class="row">
            <a style="font-size: 14px; font-weight: 600;" href="index.php?page=schoolforumdetail&forum=<?php echo $_GET['forum']; ?>&topic=<?php echo $_GET['topic'];?>&id=<?php echo $Forumid;?>" ><?php echo $ForumTitle; ?></a><br><br>
            </div>
            <div class="claimedRight">
            <a style="" ><?php echo $SchoolForumDetails; ?></a>
            </div>
        </div>
        <br>
        <div class="row">
            <a style="" class="button button-lnk spacing-right-small" href="index.php?page=schoolforumdetail&forum=<?php echo $_GET['forum']; ?>&topic=<?php echo $_GET['topic'];?>&id=<?php echo $Forumid;?>" data-link-name="view_discussion" data-thread-id="8434285354">
            Comments 
            <span class="label--count"><?php echo $total; ?></span>
            </a>
        </div>
    </div>
    <div class="card-footer" style="background-color:#f7f9fa">
        <div class="card__additional">
            <div class="row">
                <div class="col">
                    <div class="post-comments">
                        <div class="post-comments__reason">
                            <a href="" class="avatar" data-link-name="user_avatar"><img src="https://c.disquscdn.com/uploads/forums/318/9088/avatar92.jpg?1428445417" alt="avatar"></a>
                        </div>
                    </div>
                </div>
                <div class="col" style="text-align:right;">
                    <a><?php echo $ConsumerFName.$ConsumerLName; ?></a>
                </div>
                <div class="col">
                </div>
                <div class="col">
                </div>
            </div>
            <div class="row">
                <div class="col" style="text-align:right;">
                    <a href="index.php?page=schoolforumdetail&forum=<?php echo $_GET['forum']; ?>&topic=<?php echo $_GET['topic'];?>&id=<?php echo $Forumid1;?>"><?php echo $SchoolForumDetails; ?></a>
                </div>
            </div>
        </div>
    </div>
</div>
    </div>
</div>
<div class="col-lg-1">
</div>