<?php
$category = ($_GET['forum']);
$topic = ($_GET['topic']);
$_SESSION["title"] = "Public Forum : $topic ";
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
                                            <a href="index.php?page=publicforumdetail&forum=<?php echo $_GET['forum']; ?>&topic=<?php echo $_GET['topic'];?>&id=<?php echo $id;?>" style="color:#076d79; text-decoration: none;">Newest</a>
                                    </div>
                                    <div class="col-lg-5">
                                            <a href="index.php?page=publicforumdetail&forum=<?php echo $_GET['forum']; ?>&topic=<?php echo $_GET['topic'];?>&id=<?php echo $id;?>&sort" tabindex="-1" data-type="alpha" style="color:#076d79; text-decoration: none;">Oldest</a>
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
                                    <div class="col-lg-2">
                                        <input type="hidden"  name="txtforum" value="<?php echo  $category; ?>">
                                        <input type="hidden"  name="txtForumParentid" value="<?php echo  $Forumid; ?>">
                                        <button type="submit" class="btn btn-secondary" name="AddForumsComment">Post as <?php echo $ConsumerFName3;  ?></button>
                                    </div>
                                    </div>
                                </div>
                            </div>
                        </form> 
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
                        <div class="row">
                            <div class="col">
                                <div class="accordion accordion-flush" id="accordionFlushExample">
                                <div class="accordion-item">
                                <h2 class="accordion-header" id="flush-heading<?php echo $Forumid4; ?>">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse<?php echo $Forumid4; ?>" aria-expanded="false" aria-controls="flush-collapse<?php echo $Forumid4; ?>">
                                        <div class="spacing-right">
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <img class="img-round-sm block__item" src="https://c.disquscdn.com/uploads/users/383/2435/avatar92.jpg?1615629681" alt="avatar">
                                                    <small href="index.php?page=publicforumdetail&forum=<?php echo $_GET['forum']; ?>&topic=<?php echo $_GET['topic'];?>&id=<?php echo $Consumer_id4;?>" style="text-decoration: none;"><?php echo " ".$ConsumerFName5." ".$ConsumerLName5;?></small>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="spacing-right">
                                        <span style="color:#687a86;"><?php echo $ForumDetails4; ?></span>
                                        </div>
                                    </button>
                                </h2>
                                <div id="flush-collapse<?php echo $Forumid4; ?>" class="accordion-collapse collapse" aria-labelledby="flush-heading<?php echo $Forumid4; ?>" data-bs-parent="#accordionFlushExample">
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
                                                                <small href="index.php?page=publicforumdetail&forum=<?php echo $_GET['forum']; ?>&topic=<?php echo $_GET['topic'];?>&id=<?php echo $Consumer_id6;?>" style="text-decoration: none;"><?php echo " ".$ConsumerFName7." ".$ConsumerLName7;?></small>
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
                                        <div class="card-body">
                                            <form name="AddForumsCommentChild" action="index.php?page=publicforumdetail&forum=<?php echo $_GET['forum']; ?>&topic=<?php echo $_GET['topic'];?>&id=<?php echo $id;?>" method="post">
                                                <div class="row">
                                                    <textarea class="basic-example2" name="txtdetail" placeholder="Join, the discussion..."></textarea>
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
    $ForumDetails1 ="";
    $filter = ['school_id'=>$_SESSION["loggeduser_schoolID"],'ForumParentid'=>'0','Forum'=>$category];
    $option = ['sort' => ['_id' => 1]];
    $query = new MongoDB\Driver\Query($filter,$option);
    $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.SchoolForum',$query);

    foreach ($cursor as $document)
    {
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

        $filter1 = ['school_id'=>$_SESSION["loggeduser_schoolID"],'ForumParentid'=>$Forumid ,'Forum'=>$category];
        $option1 = ['sort' => ['_id' => 1]];
        $query1 = new MongoDB\Driver\Query($filter1,$option1);
        $cursor1 = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.SchoolForum',$query1);
    
        foreach ($cursor1 as $document1)
        {
            $total = $total + 1;
            $Forumid1 = strval($document1->_id);
            $ForumTitle1 = ($document1->ForumTitle);
            $ForumDetails1 = ($document1->ForumDetails);
            $ForumDate1 = ($document1->ForumDate);
            $Consumer_id1 = ($document1->Consumer_id);

            $consumerid = new \MongoDB\BSON\ObjectId($Consumer_id1);
            $filter1 = ['_id' => $consumerid];
            $query1 = new MongoDB\Driver\Query($filter1);
            $cursor1 = $GoNGetzDatabase->executeQuery('GoNGetz.Consumer', $query1);
    
            foreach ($cursor1 as $document1)
            {
            $ConsumerFName = ($document1->ConsumerFName);
            $ConsumerLName = ($document1->ConsumerLName);
            }
        }

    }
    ?>
    <div class="card-body" style="background-color:#ffffff">
        <div class="row">
            <div class="row">
            <a style="font-size: 14px; font-weight: 600;" href="index.php?page=publicforumdetail&forum=<?php echo $_GET['forum']; ?>&topic=<?php echo $_GET['topic'];?>&id=<?php echo $Forumid;?>" ><?php echo $ForumTitle; ?></a><br><br>
            </div>
            <div class="claimedRight">
            <a style="" ><?php echo $ForumDetails; ?></a>
            </div>
        </div>
        <br>
        <div class="row">
            <a style="" class="button button-lnk spacing-right-small" href="index.php?page=publicforumdetail&forum=<?php echo $_GET['forum']; ?>&topic=<?php echo $_GET['topic'];?>&id=<?php echo $Forumid;?>" data-link-name="view_discussion" data-thread-id="8434285354">
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
                    <a href="index.php?page=publicforumdetail&forum=<?php echo $_GET['forum']; ?>&topic=<?php echo $_GET['topic'];?>&id=<?php echo $Forumid1;?>"><?php echo $ForumDetails1; ?></a>
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
    $ForumDetails1 ="";
    $filter = ['school_id'=>$_SESSION["loggeduser_schoolID"],'ForumParentid'=>'0','Forum'=>$category];
    $option = ['sort' => ['_id' => 1]];
    $query = new MongoDB\Driver\Query($filter,$option);
    $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.SchoolForum',$query);

    foreach ($cursor as $document)
    {
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

        $filter1 = ['school_id'=>$_SESSION["loggeduser_schoolID"],'ForumParentid'=>$Forumid ,'Forum'=>$category];
        $option1 = ['sort' => ['_id' => 1]];
        $query1 = new MongoDB\Driver\Query($filter1,$option1);
        $cursor1 = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.SchoolForum',$query1);
    
        foreach ($cursor1 as $document1)
        {
            $total = $total + 1;
            $Forumid1 = strval($document1->_id);
            $ForumTitle1 = ($document1->ForumTitle);
            $ForumDetails1 = ($document1->ForumDetails);
            $ForumDate1 = ($document1->ForumDate);
            $Consumer_id1 = ($document1->Consumer_id);

            $consumerid = new \MongoDB\BSON\ObjectId($Consumer_id1);
            $filter1 = ['_id' => $consumerid];
            $query1 = new MongoDB\Driver\Query($filter1);
            $cursor1 = $GoNGetzDatabase->executeQuery('GoNGetz.Consumer', $query1);
    
            foreach ($cursor1 as $document1)
            {
            $ConsumerFName = ($document1->ConsumerFName);
            $ConsumerLName = ($document1->ConsumerLName);
            }
        }

    }
    ?>
    <div class="card-body" style="background-color:#ffffff">
        <div class="row">
            <div class="row">
            <a style="font-size: 14px; font-weight: 600;" href="index.php?page=publicforumdetail&forum=<?php echo $_GET['forum']; ?>&topic=<?php echo $_GET['topic'];?>&id=<?php echo $Forumid;?>" ><?php echo $ForumTitle; ?></a><br><br>
            </div>
            <div class="claimedRight">
            <a style="" ><?php echo $ForumDetails; ?></a>
            </div>
        </div>
        <br>
        <div class="row">
            <a style="" class="button button-lnk spacing-right-small" href="index.php?page=publicforumdetail&forum=<?php echo $_GET['forum']; ?>&topic=<?php echo $_GET['topic'];?>&id=<?php echo $Forumid;?>" data-link-name="view_discussion" data-thread-id="8434285354">
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
                    <a href="index.php?page=publicforumdetail&forum=<?php echo $_GET['forum']; ?>&topic=<?php echo $_GET['topic'];?>&id=<?php echo $Forumid1;?>"><?php echo $ForumDetails1; ?></a>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
</div>
<div class="col-lg-1">
</div>