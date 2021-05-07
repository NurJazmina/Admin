<?php
$category = ($_GET['forum']);
$topic = ($_GET['topic']);
$_SESSION["title"] = "School Forum : $topic ";

include 'view/partials/_subheader/subheader-v1.php'; 
include ('model/schoolforum.php');
?>
<link rel="stylesheet" href="//c.disquscdn.com/next/96f5580/home/css/main.css">

<div class="row">
    <div class="col-sm-2">
        <div class="aside__subheadings text-subheading">
            <h2>Channel topics</h2>
        </div>
        <div class="aside__wrap">
            <ul class="tag-list">
                <li data-action="switch-tab" data-tab="topic-general" class="active">
                    <a href="index.php?page=schoolforum&forum=1&topic=general" class="button--tag">
                    General
                    </a>
                </li>
                <li data-action="switch-tab" data-tab="topic-proposal">
                    <a href="index.php?page=schoolforum&forum=2&topic=proposal" class="button--tag">
                    Proposal
                    </a>
                </li>
                <li data-action="switch-tab" data-tab="topic-shortnews">
                    <a href="index.php?page=schoolforum&forum=3&topic=short news / info" class="button--tag">
                    Short News
                    </a>
                </li>
                <li data-action="switch-tab" data-tab="topic-info">
                    <a href="index.php?page=schoolforum&forum=3&topic=short news / info" class="button--tag">
                    Info
                    </a>
                </li>
            </ul>
        </div>
    </div>
    <div class="col-sm-10">
        <section>
            <div data-role="content-area">
                <div class="container">
                    <div class="alert alert--topics">
                    <div class="align align--between">
                    <div class="align align--wrap align--middle">
                    <div class="spacing-right">

                    <strong>Channel Topic:</strong>

                    </div>
                        <span class="button--tag -inverted button-large">Forum</span>/
                        <span class="button--tag -inverted button-large"><?php echo $_GET['topic']; ?></span>
                    </div>

                </div>
            </div>
        <?php
        if ($_SESSION["loggeduser_ConsumerGroup_id"]=='601b4cfd97728c027c01f187' ||  $_SESSION["loggeduser_ConsumerGroup_id"] =='601b4f1697728c027c01f188')
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
        $ConsumerLName3=" ";
        $ForumDetails2=" ";
        $filter = ['school_id'=>$_SESSION["loggeduser_schoolID"],'Forum'=>$category];
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
            <div data-role="header-area"></div>
                <div data-role="content-area">
                    <div>
                        <div class="card-wrap card--channel">
                            <div data-role="card-alert"></div>
                                    <div class="card__inner">
                                        <div class="card__header -feed">

                                            <div class="card__reason link-inner-gray-dark align align--middle">
                                                <a class="spacing-right align__item" href="/by/pogue972/" data-link-name="user_avatar">
                                                    <img class="img-round-sm block__item" src="assets/media/svg/avatars/032-boy-13.svg" alt="avatar">
                                                </a>

                                                <div class="align__item">
                                                    <span class="actors">
                                                        <span class="actor">
                                                        <a href="/by/pogue972/" class="name" data-link-name="user_name"><?php echo $ConsumerFName." ".$ConsumerLName;?></a>
                                                        </span>
                                                    </span>
                                                    started a discussion
                                                    <time class="text-gray"><?php echo date_format($datetime,"d/m/y"); echo " ( ".time_elapsed($nowtime-$oldtime)." ) \n"; ?></time>
                                                    <span data-role="badges"></span>
                                                </div>
                                            </div>

                                            <div class="card__subnav pull-right dropdown" data-role="menu">
                                            </div>
                                        </div>

                                        <div class="card__content -default">
                                            <div class="card-content__body">
                                                <h2 class="discussion-title" dir="auto">
                                                    <a href="index.php?page=schoolforumdetail&forum=<?php echo $_GET['forum']; ?>&topic=<?php echo $_GET['topic'];?>&id=<?php echo $Forumid;?>" data-link-name="title" data-thread-id="8471888124" style="float: none; position: static;"><?php echo $ForumTitle; ?></a>
                                                </h2>

                                                <div class="card-content__summary hidden-md" style="">
                                                    <div class="truncate"  data-truncate-lines="3" dir="auto" style="float: none; position: static;">
                                                        <span class="claimedRight" ><?php echo $ForumDetails; ?></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="card__footer text-small" data-role="footer">
                                        <?php
                                        $SchoolForumDetails = "";
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
                                            <ul class="list--layout">
                                                <a class="button button-lnk spacing-right-small" href="index.php?page=schoolforumdetail&forum=<?php echo $_GET['forum']; ?>&topic=<?php echo $_GET['topic'];?>&id=<?php echo $Forumid;?>" data-link-name="view_discussion" data-thread-id="8434285354">
                                                Comments 
                                                    <span class="label--count"><?php echo $total; ?></span>
                                                </a>
                                                </li>
                                            </ul>
                                        </div>

                                        <div class="card__additional">
                                            <div class="card-comment-band" data-role="posts"><div>
                                            <div class="post-comments__wrapper">
                                            <div class="post-comments">
                                                    <div class="post-comments__reason">
                                                    <a href="/by/disqus_EAsrYwGXA9/" class="avatar" data-link-name="user_avatar">
                                                        <img class="img-round-sm block__item" src="assets/media/svg/avatars/029-boy-11.svg" alt="avatar">
                                                    </a>
                                                    <?php echo " ".$ConsumerFName3." ".$ConsumerLName3;?>
                                                    </div>
                                                    <div class="post-comment__content">
                                                        <a href="index.php?page=schoolforumdetail&forum=<?php echo $_GET['forum']; ?>&topic=<?php echo $_GET['topic'];?>&id=<?php echo $Forumid;?>">
                                                            <?php echo $SchoolForumDetails; ?>
                                                        </a>
                                                    </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
                }
            }
        }
        ?>
        </section>
    </div>
</div>