<?php
$category = ($_GET['forum']);
$topic = ($_GET['topic']);
$_SESSION["title"] = "School Forum : $topic ";
include 'view/partials/_subheader/subheader-v1.php'; 
include ('model/forums.php');
?>
<style>
.forum {
    background-color: #8bcf93;
    color: #5e9164;
}
.img-round-sm {
    border-radius: 50%;
    height: 32px;
    width: 32px;
}
.img-round-xsm  {
    border-radius: 50%;
    height: 25px;
    width: 25px;
}
</style>
<div class="row ">
    <div class="col-1"></div>
    <div class="col-sm-2">
        <div class="m-2">
            <h6 class="text-dark-50 font-weight-bold">Channel topics</h6>
        </div>
        <div class="bg-white mt-3 p-5 rounded">
            <a href="index.php?page=schoolforum&forum=1&topic=General" class="btn btn-outline-green btn-sm font-weight-bold btn-pill mb-3">General</a><br>
            <a href="index.php?page=schoolforum&forum=2&topic=Proposal" class="btn btn-outline-green btn-sm font-weight-bold btn-pill mb-3">Proposal</a><br>
            <a href="index.php?page=schoolforum&forum=3&topic=Short News / Info" class="btn btn-outline-green btn-sm font-weight-bold btn-pill mb-3">Short News / Info </a><br>
        </div>
    </div>
    <div class="col-sm-8">
        <div class="forum mt-3 mb-3 p-4 rounded">
            <strong>Channel Topic &nbsp;&nbsp;:&nbsp;&nbsp; </strong>
            <span class="btn btn-outline-white btn-sm font-weight-bold btn-pill">Forum</span>
            &nbsp;/&nbsp;
            <span class="btn btn-outline-white btn-sm font-weight-bold btn-pill"><?= $_GET['topic']; ?></span>
        </div>
        <?php
        if ($_SESSION["loggeduser_ConsumerGroupName"] == 'SCHOOL' || $_SESSION["loggeduser_ConsumerGroupName"] == 'GONGETZ')
        {
            function time_elapsed($date)
            {
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

            $ConsumerFName3=" ";
            $ConsumerLName3=" ";
            $ForumDetails2=" ";
            $filter = ['School_id'=>$_SESSION["loggeduser_schoolID"],'Forum'=>$category];
            $option = ['sort' => ['_id' => -1]];
            $query = new MongoDB\Driver\Query($filter,$option);
            $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Forum',$query);

            foreach ($cursor as $document)
            {
                $total = 0;
                $Forumid = strval($document->_id);
                $Title = $document->Title;
                $Details = $document->Details;
                $Date = strval($document->Date);
                $Consumer_id = $document->Consumer_id;

                $utcdatetime = new MongoDB\BSON\UTCDateTime($Date);
                $datetime = $utcdatetime->toDateTime()->setTimezone(new \DateTimeZone(date_default_timezone_get()));
                $dateforum = date_format($datetime,"Y-m-d\TH:i:s");
                $date = new MongoDB\BSON\UTCDateTime((new DateTime($dateforum))->getTimestamp());
            
                $nowtime = time();
                $time_strval = strval($date);
                
                $filter = ['_id' => new \MongoDB\BSON\ObjectId($Consumer_id)];
                $query = new MongoDB\Driver\Query($filter);
                $cursor = $GoNGetzDatabase->executeQuery('GoNGetz.Consumer', $query);
                foreach ($cursor as $document1)
                {
                    $ConsumerFName = $document1->ConsumerFName;
                    $ConsumerLName = $document1->ConsumerLName;
                    ?>
                    <div class="card mb-3 p-5">
                        <div class="mt-3 mb-3">
                            <div class="checkbox-inline">
                                <img class="img-round-sm" src="assets/media/svg/avatars/032-boy-13.svg" alt="avatar">&nbsp;&nbsp;
                                <a class="name"><?= $ConsumerFName." ".$ConsumerLName;?></a>&nbsp;&nbsp;
                                <time class="text-muted">started a discussion &nbsp;&nbsp;<?= date_format($datetime,"d/m/y"); echo " ( ".time_elapsed($nowtime-$time_strval)." ) \n"; ?></time>
                            </div>
                        </div>
                        <div class="separator separator-solid"></div>
                        <div class="mt-3">
                            <h6><a class="font-weight-bold" href="index.php?page=forumdetail&forum=<?= $_GET['forum']; ?>&topic=<?= $_GET['topic'];?>&id=<?= $Forumid;?>" style="text-transform:uppercase"><?= $Title; ?></a></h6>
                        </div>
                        <div class="mt-3">
                            <a class="text-dark-50"><?= $Details; ?></a>
                        </div>
                        <?php
                        $Details = "";
                        $filter = ['School_id'=>$_SESSION["loggeduser_schoolID"],'Forum_id'=>$Forumid,'Parent_id'=>'0'];
                        $query = new MongoDB\Driver\Query($filter);
                        $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.ForumComment',$query);

                        foreach ($cursor as $document2)
                        {
                            $total = $total + 1;
                            $Forum_id = strval($document2->Forum_id);
                            $Details = ($document2->Details);
                            $Staff_id = ($document2->Staff_id);

                            $filter = ['_id' => new \MongoDB\BSON\ObjectId($Staff_id)];
                            $query = new MongoDB\Driver\Query($filter);
                            $cursor = $GoNGetzDatabase->executeQuery('GoNGetz.Consumer', $query);
                            foreach ($cursor as $document3)
                            {
                                $ConsumerFName3 = ($document3->ConsumerFName);
                                $ConsumerLName3 = ($document3->ConsumerLName);
                            }
                        }
                        ?>
                        <div class="mt-3">
                            <a class="text-dark-50"><?= "Comments &nbsp;&nbsp;".$total; ?></a>
                        </div>
                        <div class="separator separator-solid"></div>
                        <div class="mt-3 mb-3">
                            <div class="checkbox-inline">
                                <img class="img-round-xsm" src="assets/media/svg/avatars/029-boy-11.svg" alt="avatar">&nbsp;&nbsp;
                                <a class="text-dark-50"><?= $ConsumerFName3." ".$ConsumerLName3;?></a>&nbsp;&nbsp;
                                <a class="text-dark-50 mx-3"><?= $Details; ?></a>
                            </div>
                        </div>
                    </div>
                    <?php
                }
            }
        }
        ?>
    </div>
    <div class="col-1"></div>
</div>