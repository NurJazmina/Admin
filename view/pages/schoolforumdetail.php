<?php
$category = ($_GET['forum']);
$topic = ($_GET['topic']);
$_SESSION["title"] = "School Forum : $topic ";
include 'view/partials/_subheader/subheader-v1.php';
include ('model/schoolforum.php'); 
include 'model/counter.php';

$filter = ['url'=>$URL];
$query = new MongoDB\Driver\Query($filter);
$cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Views',$query);
foreach ($cursor as $document)
{
    $url = strval($document->url);
    $count = strval($document->count);
}
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

.img-round-sm {
    border-radius: 100%;
    height: 30px;
    width: 30px;
}
</style>
<div class="row" >
    <div class="col-lg-2"></div>
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
        if ($_SESSION["loggeduser_ConsumerGroup_id"]=='601b4cfd97728c027c01f187' || $_SESSION["loggeduser_ConsumerGroup_id"] =='601b4f1697728c027c01f188')
        {
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
                $oldtime = strval($date);
                
                $consumerid = new \MongoDB\BSON\ObjectId($Consumer_id);
                $filter = ['_id' => $consumerid];
                $query = new MongoDB\Driver\Query($filter);
                $cursor = $GoNGetzDatabase->executeQuery('GoNGetz.Consumer', $query);

                foreach ($cursor as $document1)
                {
                    $ConsumerFName = ($document1->ConsumerFName);
                    $ConsumerLName = ($document1->ConsumerLName);
                    ?>
                    <strong class="discussion-title" style="font-size: 42px; color: #353a3d">General: <?php echo $ForumTitle; ?></strong><br><br>
                    <div class="spacing-right" >
                        <img class="img-round-sm block__item" src="assets/media/svg/avatars/032-boy-13.svg" alt="avatar">
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
                            $filter = ['School_id'=>$_SESSION["loggeduser_schoolID"],'Forum_id'=>$Forumid,'ForumParent_id'=>'0'];
                            $query = new MongoDB\Driver\Query($filter);
                            $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.SchoolForumComment',$query);

                            foreach ($cursor as $document2)
                            {
                                $total = $total + 1;
                                $Forum_id = strval($document2->Forum_id);
                                $SchoolForumDetails = ($document2->SchoolForumDetails);
                                $SchoolForumStaff_id = ($document2->SchoolForumStaff_id);

                                $filter = ['_id' => new \MongoDB\BSON\ObjectId($SchoolForumStaff_id)];
                                $query = new MongoDB\Driver\Query($filter);
                                $cursor = $GoNGetzDatabase->executeQuery('GoNGetz.Consumer', $query);
                                foreach ($cursor as $document3)
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
                                            <h5 class="btn btn-light-success font-weight-bolder btn-sm">Views : <?php echo $count; ?></h5>
                                        </div>
                                        <div class="col-lg-5">
                                            <a class="button--recommend button-small" href="#" style="color:#f05f70;">
                                                <span class="button__text hidden-md"></span>
                                            </a>
                                        </div>
                                        <div class="col-lg-2">
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
                                    <textarea class="forum" name="txtdetail" placeholder="Join, the discussion..." ></textarea>
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
                            if (!isset($_GET['sort']) && empty($_GET['sort']))
                            {
                                $filter = ['School_id'=>$_SESSION["loggeduser_schoolID"],'Forum_id'=>$Forumid,'ForumParent_id'=>'0'];
                                $option = ['sort' => ['_id' => -1]];
                                $query = new MongoDB\Driver\Query($filter,$option);
                                $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.SchoolForumComment',$query);
                            }
                            else
                            {
                                $filter = ['School_id'=>$_SESSION["loggeduser_schoolID"],'Forum_id'=>$Forumid,'ForumParent_id'=>'0'];
                                $option = ['sort' => ['_id' => 1]];
                                $query = new MongoDB\Driver\Query($filter,$option);
                                $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.SchoolForumComment',$query);
                            }

                            foreach ($cursor as $document4)
                            {
                                $id4 = strval($document4->_id);
                                $Forum_id4 = strval($document4->Forum_id);
                                $SchoolForumDetails4 = ($document4->SchoolForumDetails);
                                $SchoolForumStaff_id4 = ($document4->SchoolForumStaff_id);
                                $SchoolForumDate4 = ($document4->SchoolForumDate);

                                $utcdatetime4 = new MongoDB\BSON\UTCDateTime(strval($SchoolForumDate4));
                                $datetime4 = $utcdatetime4->toDateTime()->setTimezone(new \DateTimeZone(date_default_timezone_get()));
                                $dateforum4 = date_format($datetime4,"Y-m-d\TH:i:s");
                                $date4 = new MongoDB\BSON\UTCDateTime((new DateTime($dateforum4))->getTimestamp());
                                $oldtime4 = strval($date4);

                                $filter = ['_id' => new \MongoDB\BSON\ObjectId($SchoolForumStaff_id4)];
                                $query = new MongoDB\Driver\Query($filter);
                                $cursor = $GoNGetzDatabase->executeQuery('GoNGetz.Consumer', $query);
                                foreach ($cursor as $document5)
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
                                                            <div class="headline commentreply">
                                                                <img class="img-round-sm block__item" src="assets/media/svg/avatars/029-boy-11.svg" alt="avatar">
                                                                <a href="index.php?page=staffdetail&id=<?php echo $Consumer_id; ?>" style="color:#2e9fff; text-decoration: none;"><?php echo $ConsumerFName5." ".$ConsumerLName5;?></a>
                                                                <small><span style="color:#687a86;"><?php echo date_format($datetime4,"d/m/y"); echo " ( ".time_elapsed($nowtime-$oldtime4)." ) \n"; ?></span></small>
                                                                <div style="border-left: 1px solid #eee; color:#687a86; padding-left:10px; text-align:left;"><?php echo $SchoolForumDetails4; ?></div>
                                                            </div> 
                                                        </button>
                                                    </h2>
                                                    <div id="flush-collapse<?php echo $id4; ?>" class="accordion-collapse collapse" aria-labelledby="flush-heading<?php echo $id4; ?>" data-bs-parent="#accordionFlushExample">
                                                        <div class="accordion-body commentline">
                                                        <?php
                                                        $filter = ['School_id'=>$_SESSION["loggeduser_schoolID"],'Forum_id'=>$Forumid,'ForumParent_id'=>$id4];
                                                        $option = ['sort' => ['_id' => 1]];
                                                        $query = new MongoDB\Driver\Query($filter,$option);
                                                        $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.SchoolForumComment',$query);

                                                        foreach ($cursor as $document6)
                                                        {
                                                            $Forum_id6 = strval($document6->Forum_id);
                                                            $SchoolForumDetails6 = ($document6->SchoolForumDetails);
                                                            $SchoolForumStaff_id6 = ($document6->SchoolForumStaff_id);
                                                            $SchoolForumDate6 = ($document6->SchoolForumDate);

                                                            $utcdatetime6 = new MongoDB\BSON\UTCDateTime(strval($SchoolForumDate6));
                                                            $datetime6 = $utcdatetime6->toDateTime()->setTimezone(new \DateTimeZone(date_default_timezone_get()));
                                                            $dateforum6 = date_format($datetime6,"Y-m-d\TH:i:s");
                                                            $date6 = new MongoDB\BSON\UTCDateTime((new DateTime($dateforum6))->getTimestamp());
                                                            $oldtime6 = strval($date6);

                                                            $filter = ['_id' => new \MongoDB\BSON\ObjectId($SchoolForumStaff_id6)];
                                                            $query = new MongoDB\Driver\Query($filter);
                                                            $cursor = $GoNGetzDatabase->executeQuery('GoNGetz.Consumer', $query);
                                                            foreach ($cursor as $document7)
                                                            {
                                                                $ConsumerFName7 = ($document7->ConsumerFName);
                                                                $ConsumerLName7 = ($document7->ConsumerLName);
                                                                ?>
                                                                <div class="headline commentreply">
                                                                    <img class="img-round-sm block__item" src="assets/media/svg/avatars/029-boy-11.svg" alt="avatar">
                                                                    <a href="index.php?page=staffdetail&id=<?php echo $Consumer_id; ?>" style="color:#2e9fff; text-decoration: none;"><?php echo $ConsumerFName7." ".$ConsumerLName7;?></a>
                                                                    <small><span style="color:#687a86;"><?php echo date_format($datetime6,"d/m/y"); echo " ( ".time_elapsed($nowtime-$oldtime6)." ) \n"; ?></span></small>
                                                                    <div style="border-left: 1px solid #eee; padding-left:10px; margin-left: 10px;"><?php echo $SchoolForumDetails6; ?></div>
                                                                </div> 
                                                                <?php
                                                            }
                                                        }
                                                        ?>
                                                        <div>
                                                            <form name="AddForumsCommentChild" action="index.php?page=schoolforumdetail&forum=<?php echo $_GET['forum']; ?>&topic=<?php echo $_GET['topic'];?>&id=<?php echo $id;?>" method="post">
                                                                <div class="row">
                                                                    <textarea class="forum" name="txtdetail" placeholder="Join, the discussion..."></textarea>
                                                                    <div class="col-lg-12">
                                                                        <div class="row">
                                                                            <div class="col-lg-10"></div>
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
                    </div>
                    <?php
                }
            }
        }
        ?>
    </div>
</div>

<div class="col-lg-3">
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

        $filter = ['school_id'=>$_SESSION["loggeduser_schoolID"],'Forum_id'=>$Forumid,'ForumParent_id'=>'0'];
        $option = ['sort' => ['_id' => 1]];
        $query = new MongoDB\Driver\Query($filter,$option);
        $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.SchoolForumComment',$query);

        foreach ($cursor as $document1)
        {
            $total = $total + 1;
            $Forum_id = strval($document1->Forum_id);
            $SchoolForumDetails = ($document1->SchoolForumDetails);
            $SchoolForumStaff_id = ($document1->SchoolForumStaff_id);
            $SchoolForumDate = ($document1->SchoolForumDate);
        }
        $filter = ['_id' =>new \MongoDB\BSON\ObjectId($Consumer_id)];
        $query = new MongoDB\Driver\Query($filter);
        $cursor = $GoNGetzDatabase->executeQuery('GoNGetz.Consumer', $query);

        foreach ($cursor as $document2)
        {
            $ConsumerFName = $document2->ConsumerFName;
        }
    }
    ?>
    <!--begin::Card-->
    <div class="card card-custom gutter-b card-stretch">
        <!--begin::Body-->
        <div class="card-body">
            <!--begin::Info-->
            <div class="d-flex align-items-center">
                <!--begin::Info-->
                <div class="d-flex flex-column mr-auto">
                    <!--begin: Title-->
                    <div class="d-flex flex-column mr-auto">
                        <a href="index.php?page=schoolforumdetail&forum=<?php echo $_GET['forum']; ?>&topic=<?php echo $_GET['topic'];?>&id=<?php echo $Forumid;?>" class="text-dark text-hover-primary font-size-h4 font-weight-bolder mb-1"><?php echo $ForumTitle; ?></a>
                        <span class="text-muted font-weight-bold">started a discussion
                            <time class="text-gray"><?php echo date_format($datetime,"d/m/y"); ?></time>
                        </span>
                    </div>
                    <!--end::Title-->
                </div>
                <!--end::Info-->
            </div>
            <!--end::Info-->
            <!--begin::Description-->
            <div class="mb-10 mt-5 font-weight-bold"><?php echo $ForumDetails; ?></div>
            <!--end::Description-->
            <!--begin::Data-->
            <div class="d-flex mb-5">
                <div class="d-flex align-items-center mr-7">
                    <span class="font-weight-bold mr-4">posted by :</span>
                    <span class="btn btn-light-success btn-sm font-weight-bold btn-upper btn-text"><?php echo $ConsumerFName; ?></span>
                </div>
            </div>
            <!--end::Data-->
        </div>
        <!--end::Body-->
        <!--begin::Footer-->
        <div class="card-footer d-flex align-items-center">
            <div class="d-flex">
                <div class="d-flex align-items-center mr-7">
                    <span class="svg-icon svg-icon-gray-500">
                        <!--begin::Svg Icon | path:assets/media/svg/icons/Communication/Group-chat.svg-->
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <rect x="0" y="0" width="24" height="24"></rect>
                                <path d="M16,15.6315789 L16,12 C16,10.3431458 14.6568542,9 13,9 L6.16183229,9 L6.16183229,5.52631579 C6.16183229,4.13107011 7.29290239,3 8.68814808,3 L20.4776218,3 C21.8728674,3 23.0039375,4.13107011 23.0039375,5.52631579 L23.0039375,13.1052632 L23.0206157,17.786793 C23.0215995,18.0629336 22.7985408,18.2875874 22.5224001,18.2885711 C22.3891754,18.2890457 22.2612702,18.2363324 22.1670655,18.1421277 L19.6565168,15.6315789 L16,15.6315789 Z" fill="#000000"></path>
                                <path d="M1.98505595,18 L1.98505595,13 C1.98505595,11.8954305 2.88048645,11 3.98505595,11 L11.9850559,11 C13.0896254,11 13.9850559,11.8954305 13.9850559,13 L13.9850559,18 C13.9850559,19.1045695 13.0896254,20 11.9850559,20 L4.10078614,20 L2.85693427,21.1905292 C2.65744295,21.3814685 2.34093638,21.3745358 2.14999706,21.1750444 C2.06092565,21.0819836 2.01120804,20.958136 2.01120804,20.8293182 L2.01120804,18.32426 C1.99400175,18.2187196 1.98505595,18.1104045 1.98505595,18 Z M6.5,14 C6.22385763,14 6,14.2238576 6,14.5 C6,14.7761424 6.22385763,15 6.5,15 L11.5,15 C11.7761424,15 12,14.7761424 12,14.5 C12,14.2238576 11.7761424,14 11.5,14 L6.5,14 Z M9.5,16 C9.22385763,16 9,16.2238576 9,16.5 C9,16.7761424 9.22385763,17 9.5,17 L11.5,17 C11.7761424,17 12,16.7761424 12,16.5 C12,16.2238576 11.7761424,16 11.5,16 L9.5,16 Z" fill="#000000" opacity="0.3"></path>
                            </g>
                        </svg>
                        <!--end::Svg Icon-->
                    </span>
                    <a href="index.php?page=schoolforumdetail&forum=<?php echo $_GET['forum']; ?>&topic=<?php echo $_GET['topic'];?>&id=<?php echo $Forumid;?>" class="font-weight-bolder text-primary ml-2"><?php echo $total; ?> Comments</a>
                </div>
            </div>
        </div>
        <!--end::Footer-->
    </div>
    <!--end:: Card-->
</div>						
<script type="text/javascript" src='https://cdn.tiny.cloud/1/qagffr3pkuv17a8on1afax661irst1hbr4e6tbv888sz91jc/tinymce/4/tinymce.min.js' referrerpolicy="origin"></script>
<script>
tinymce.init({
  selector: '.forum',
  menubar:false,
  statusbar: false,
  toolbar: false,
  height:100,
});
</script>