<?php
$category = ($_GET['forum']);
$topic = ($_GET['topic']);
$_SESSION["title"] = "Public Forum : $topic ";
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
<div class="row">
    <div class="col-sm-2 mb-5">
        <div>
            <h6 class="text-dark-50 font-weight-bold">Channel topics</h6>
        </div>
        <div class="bg-white mt-3 p-5 rounded">
            <a href="index.php?page=publicforum&forum=4&topic=General" class="btn btn-outline-green btn-sm font-weight-bold btn-pill mb-3">General</a><br>
            <a href="index.php?page=publicforum&forum=5&topic=Proposal" class="btn btn-outline-green btn-sm font-weight-bold btn-pill mb-3">Proposal</a><br>
            <a href="index.php?page=publicforum&forum=6&topic=Short News / Info" class="btn btn-outline-green btn-sm font-weight-bold btn-pill mb-3">Short News / Info</a><br>
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
        $filter = ['School_id'=>$_SESSION["loggeduser_school_id"],'Forum'=>$category];
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
                    $filter = ['School_id'=>$_SESSION["loggeduser_school_id"],'Forum_id'=>$Forumid,'Parent_id'=>'0'];
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
        ?>
    </div>
    <div class="col-sm-2">
        <div class="bg-white p-5 rounded">
            <h6 class="text-dark-50 font-weight-bold">Details</h6>
        </div>
        <div class="bg-white mt-2 p-5 rounded">
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