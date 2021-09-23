<?php
$_SESSION["title"] = "Forums";
include 'view/partials/_subheader/subheader-v1.php'; 
include 'model/forums.php';

function time_elapsed($Date){
    $bit = array(
        ' year'      => $Date  / 31556926 % 12,
        ' week'      => $Date  / 604800 % 52,
        ' day'       => $Date  / 86400 % 7,
        ' hour'      => $Date  / 3600 % 24,
        ' minute'    => $Date  / 60 % 60,
        ' second'    => $Date  % 60
        );
    foreach($bit as $k => $v){
        if($v > 1)$ret[] = $v . $k . 's';
        if($v == 1)$ret[] = $v . $k;
        }
    array_splice($ret, count($ret)-1, 0, 'and');
    $ret[] = 'ago';

    return join(' ', $ret);
}
$time_now = time();
?>
<div class="text-dark-50 text-center mt-10">
  <h1>Forums</h1>
</div>
<div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
        <div class="modal-body">
            <?php
            if ($_SESSION["loggeduser_ConsumerGroupName"] == 'SCHOOL' || $_SESSION["loggeduser_ConsumerGroupName"] == 'GONGETZ')
            {
                ?>
                <div class="border">
                    <div class="card-header">
                        <strong>SCHOOL</strong>
                    </div>
                    <!-- begin :: school -->
                    <div class="card-body">
                        <!-- begin :: general -->
                        <a class="h6 text-dark-50" href="index.php?page=schoolforum&forum=1&topic=General">1. GENERAL</a>
                        <div class="mt-5 mb-5">
                            <?php
                            $filter = ['School_id'=>$_SESSION["loggeduser_school_id"],'Forum'=>'1'];
                            $option = ['limit'=>5,'sort' => ['_id' => -1]];
                            $query = new MongoDB\Driver\Query($filter,$option);
                            $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Forum',$query);
                            foreach ($cursor as $document)
                            {
                                $Forum_id = strval($document->_id);
                                $Title = $document->Title;
                                $Date = strval($document->Date);
                                $Consumer_id = $document->Consumer_id;
                                
                                $Date = new MongoDB\BSON\UTCDateTime($Date);
                                $Date_time = $Date->toDateTime()->setTimezone(new \DateTimeZone(date_default_timezone_get()));
                                $Date = date_format($Date_time,"Y-m-d\TH:i:s");
                                $Date = new MongoDB\BSON\UTCDateTime((new DateTime($Date))->getTimestamp());
                                $Date = strval($Date);

                                $filter = ['_id' => new \MongoDB\BSON\ObjectId($Consumer_id)];
                                $query = new MongoDB\Driver\Query($filter);
                                $cursor = $GoNGetzDatabase->executeQuery('GoNGetz.Consumer', $query);
                                foreach ($cursor as $document1)
                                {
                                    $ConsumerFName = ($document1->ConsumerFName);
                                }
                                $total = 0;
                                $filter = ['School_id'=>$_SESSION["loggeduser_school_id"],'Forum_id'=>$Forum_id,'Parent_id'=>'0'];
                                $query = new MongoDB\Driver\Query($filter);
                                $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.ForumComment',$query);
                                foreach ($cursor as $document2)
                                {
                                    $total = $total + 1;
                                }
                                ?>
                                <a href="index.php?page=forum_detail&forum=1&topic=General&id=<?= $Forum_id; ?>" style="text-transform:uppercase"><?= $Title."<br>"; ?></a>
                                <!--listbox-->
                                <div class="text-muted">
                                    <small><?= $ConsumerFName; ?></small>
                                    <span>|</span>
                                    <small><?= date_format($Date_time,"d/m/y"); echo " ( ".time_elapsed($time_now-$Date)." ) \n"; ?></small>
                                    <span>|</span>
                                    <small>Commenting : <?= $total; ?></small>
                                </div>
                                <?php
                            }
                            ?>
                        </div>
                        <!-- end :: general-->
                        <!-- begin :: proposal -->
                        <a class="h6 text-dark-50" href="index.php?page=schoolforum&forum=2&topic=Proposal">2. PROPOSAL</a>
                        <div class="mt-5 mb-5">
                            <?php
                            $filter = ['School_id'=>$_SESSION["loggeduser_school_id"],'Forum'=>'2'];
                            $option = ['limit'=>5,'sort' => ['_id' => -1]];
                            $query = new MongoDB\Driver\Query($filter,$option);
                            $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Forum',$query);
                            foreach ($cursor as $document)
                            {
                                $Forum_id = strval($document->_id);
                                $Title = $document->Title;
                                $Date = strval($document->Date);
                                $Consumer_id = $document->Consumer_id;
                                
                                $Date = new MongoDB\BSON\UTCDateTime($Date);
                                $Date_time = $Date->toDateTime()->setTimezone(new \DateTimeZone(date_default_timezone_get()));
                                $Date = date_format($Date_time,"Y-m-d\TH:i:s");
                                $Date = new MongoDB\BSON\UTCDateTime((new DateTime($Date))->getTimestamp());
                                $Date = strval($Date);

                                $consumerid = new \MongoDB\BSON\ObjectId($Consumer_id);
                                $filter = ['_id' => $consumerid];
                                $query = new MongoDB\Driver\Query($filter);
                                $cursor = $GoNGetzDatabase->executeQuery('GoNGetz.Consumer', $query);

                                foreach ($cursor as $document1)
                                {
                                    $ConsumerFName = $document1->ConsumerFName;
                                }

                                $total = 0;
                                $filter = ['School_id'=>$_SESSION["loggeduser_school_id"],'Forum_id'=>$Forum_id,'Parent_id'=>'0'];
                                $query = new MongoDB\Driver\Query($filter);
                                $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.ForumComment',$query);
                                foreach ($cursor as $document2)
                                {
                                    $total = $total + 1;
                                }
                                ?>
                                <a href="index.php?page=forum_detail&forum=1&topic=Proposal&id=<?= $Forum_id; ?>" style="text-transform:uppercase"><?= $Title."<br>"; ?></a>
                                <!--listbox-->
                                <div class="text-muted">
                                    <small><?= $ConsumerFName; ?></small>
                                    <span>|</span>
                                    <small><?= date_format($Date_time,"d/m/y"); echo " ( ".time_elapsed($time_now-$Date)." ) \n"; ?></small>
                                    <span>|</span>
                                    <small>Commenting : <?= $total; ?></small>
                                </div>
                                <?php
                            }
                            ?>
                        </div>
                        <!-- end :: proposal -->
                        <!-- begin :: short news -->
                        <a class="h6 text-dark-50" href="index.php?page=schoolforum&forum=3&topic=Short News / Info">3. SHORT NEWS / INFO</a>
                        <div class="mt-5 mb-5">
                            <?php
                            $filter = ['School_id'=>$_SESSION["loggeduser_school_id"],'Forum'=>'3'];
                            $option = ['limit'=>5,'sort' => ['_id' => -1]];
                            $query = new MongoDB\Driver\Query($filter,$option);
                            $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Forum',$query);
                            foreach ($cursor as $document)
                            {
                                $Forum_id = strval($document->_id);
                                $Title = $document->Title;
                                $Date = strval($document->Date);
                                $Consumer_id = $document->Consumer_id;
                                
                                $Date = new MongoDB\BSON\UTCDateTime(strval($Date));
                                $Date_time = $Date->toDateTime()->setTimezone(new \DateTimeZone(date_default_timezone_get()));
                                $Date = date_format($Date_time,"Y-m-d\TH:i:s");
                                $Date = new MongoDB\BSON\UTCDateTime((new DateTime($Date))->getTimestamp());
                                $Date = strval($Date);

                                $filter = ['_id' => new \MongoDB\BSON\ObjectId($Consumer_id)];
                                $query = new MongoDB\Driver\Query($filter);
                                $cursor = $GoNGetzDatabase->executeQuery('GoNGetz.Consumer', $query);
                                foreach ($cursor as $document1)
                                {
                                    $ConsumerFName = ($document1->ConsumerFName);
                                }
                                $total = 0;
                                $filter = ['School_id'=>$_SESSION["loggeduser_school_id"],'Forum_id'=>$Forum_id,'Parent_id'=>'0'];
                                $query = new MongoDB\Driver\Query($filter);
                                $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.ForumComment',$query);
                                foreach ($cursor as $document2)
                                {
                                    $total = $total + 1;
                                }
                                ?>
                                <a href="index.php?page=forum_detail&forum=1&topic=Short News / Info&id=<?= $Forum_id; ?>" style="text-transform:uppercase"><?= $Title."<br>"; ?></a>
                                <!--listbox-->
                                <div class="text-muted">
                                    <small><?= $ConsumerFName; ?></small>
                                    <span>|</span>
                                    <small><?= date_format($Date_time,"d/m/y"); echo " ( ".time_elapsed($time_now-$Date)." ) \n"; ?></small>
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
            <div class="card mt-1">
                <div class="card-header">
                    <strong>PUBLIC</strong>
                </div>
                <div class="card-body">
                    <!-- begin :: general -->
                    <a class="h6 text-dark-50" href="index.php?page=publicforum&forum=4&topic=General">1. GENERAL</a>
                    <div class="mt-5 mb-5">
                        <?php
                        $filter = ['School_id'=>$_SESSION["loggeduser_school_id"],'Forum'=>'4'];
                        $option = ['limit'=>5,'sort' => ['_id' => -1]];
                        $query = new MongoDB\Driver\Query($filter,$option);
                        $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Forum',$query);
                        foreach ($cursor as $document)
                        {
                            $Forum_id = strval($document->_id);
                            $Title = $document->Title;
                            $Date = strval($document->Date);
                            $Consumer_id = $document->Consumer_id;
                            
                            $Date = new MongoDB\BSON\UTCDateTime(strval($Date));
                            $Date_time = $Date->toDateTime()->setTimezone(new \DateTimeZone(date_default_timezone_get()));
                            $Date = date_format($Date_time,"Y-m-d\TH:i:s");
                            $Date = new MongoDB\BSON\UTCDateTime((new DateTime($Date))->getTimestamp());
                        
                            $Date = strval($Date);

                            $consumerid = new \MongoDB\BSON\ObjectId($Consumer_id);
                            $filter1 = ['_id' => $consumerid];
                            $query1 = new MongoDB\Driver\Query($filter1);
                            $cursor1 = $GoNGetzDatabase->executeQuery('GoNGetz.Consumer', $query1);
            
                            foreach ($cursor1 as $document1)
                            {
                            $ConsumerFName = ($document1->ConsumerFName);
                            }

                            $total = 0;
                            $filter2 = ['School_id'=>$_SESSION["loggeduser_school_id"],'Forum_id'=>$Forum_id,'Parent_id'=>'0'];
                            $query2 = new MongoDB\Driver\Query($filter2);
                            $cursor2 = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.ForumComment',$query2);
                            foreach ($cursor2 as $document2)
                            {
                                $total = $total + 1;
                            }
                            ?>
                            <a href="index.php?page=forum_detail&forum=1&topic=General&id=<?= $Forum_id; ?>" style="text-transform:uppercase"><?= $Title."<br>"; ?></a>
                            <!--listbox-->
                            <div class="text-muted">
                                <small><?= $ConsumerFName; ?></small>
                                <span>|</span>
                                <small><?= date_format($Date_time,"d/m/y"); echo " ( ".time_elapsed($time_now-$Date)." ) \n"; ?></small>
                                <span>|</span>
                                <small>Commenting : <?= $total; ?></small>
                            </div>
                            <?php
                        }
                        ?>
                    </div>
                    <!-- end :: general -->
                    <!-- begin :: proposal -->
                    <a class="h6 text-dark-50" href="index.php?page=publicforum&forum=5&topic=Proposal">2. PROPOSAL</a>
                    <div class="mt-5 mb-5">
                        <?php
                        $filter = ['School_id'=>$_SESSION["loggeduser_school_id"],'Forum'=>'5'];
                        $option = ['limit'=>5,'sort' => ['_id' => -1]];
                        $query = new MongoDB\Driver\Query($filter,$option);
                        $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Forum',$query);
                        foreach ($cursor as $document)
                        {   
                            $Forum_id = strval($document->_id);
                            $Title = $document->Title;
                            $Date = strval($document->Date);
                            $Consumer_id = $document->Consumer_id;
                            
                            $Date = new MongoDB\BSON\UTCDateTime(strval($Date));
                            $Date_time = $Date->toDateTime()->setTimezone(new \DateTimeZone(date_default_timezone_get()));
                            $Date = date_format($Date_time,"Y-m-d\TH:i:s");
                            $Date = new MongoDB\BSON\UTCDateTime((new DateTime($Date))->getTimestamp());
                        
                            $Date = strval($Date);

                            $consumerid = new \MongoDB\BSON\ObjectId($Consumer_id);
                            $filter1 = ['_id' => $consumerid];
                            $query1 = new MongoDB\Driver\Query($filter1);
                            $cursor1 = $GoNGetzDatabase->executeQuery('GoNGetz.Consumer', $query1);
            
                            foreach ($cursor1 as $document1)
                            {
                            $ConsumerFName = ($document1->ConsumerFName);
                            }

                            $total = 0;
                            $filter2 = ['School_id'=>$_SESSION["loggeduser_school_id"],'Forum_id'=>$Forum_id,'Parent_id'=>'0'];
                            $query2 = new MongoDB\Driver\Query($filter2);
                            $cursor2 = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.ForumComment',$query2);
                            foreach ($cursor2 as $document2)
                            {
                                $total = $total + 1;
                            }
                            ?>
                            <a href="index.php?page=forum_detail&forum=1&topic=Proposal&id=<?= $Forum_id; ?>" style="text-transform:uppercase"><?= $Title."<br>"; ?></a>
                            <!--listbox-->
                            <div class="text-muted">
                                <small><?= $ConsumerFName; ?></small>
                                <span>|</span>
                                <small><?= date_format($Date_time,"d/m/y"); echo " ( ".time_elapsed($time_now-$Date)." ) \n"; ?></small>
                                <span>|</span>
                                <small>Commenting : <?= $total; ?></small>
                            </div>
                            <?php
                        }
                        ?>
                    </div>
                    <!-- end :: proposal -->
                    <!-- begin :: short news -->
                    <a class="h6 text-dark-50" href="index.php?page=publicforum&forum=6&topic=Short News / Info">3. SHORT NEWS / INFO</a>
                    <div class="mt-5 mb-5">
                        <?php
                        $filter = ['School_id'=>$_SESSION["loggeduser_school_id"],'Forum'=>'6'];
                        $option = ['limit'=>5,'sort' => ['_id' => -1]];
                        $query = new MongoDB\Driver\Query($filter,$option);
                        $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Forum',$query);
                        foreach ($cursor as $document)
                        {
                            $Forum_id = strval($document->_id);
                            $Title = $document->Title;
                            $Date = strval($document->Date);
                            $Consumer_id = $document->Consumer_id;
                            
                            $Date = new MongoDB\BSON\UTCDateTime(strval($Date));
                            $Date_time = $Date->toDateTime()->setTimezone(new \DateTimeZone(date_default_timezone_get()));
                            $Date = date_format($Date_time,"Y-m-d\TH:i:s");
                            $Date = new MongoDB\BSON\UTCDateTime((new DateTime($Date))->getTimestamp());
                        
                            $Date = strval($Date);

                            $consumerid = new \MongoDB\BSON\ObjectId($Consumer_id);
                            $filter1 = ['_id' => $consumerid];
                            $query1 = new MongoDB\Driver\Query($filter1);
                            $cursor1 = $GoNGetzDatabase->executeQuery('GoNGetz.Consumer', $query1);
            
                            foreach ($cursor1 as $document1)
                            {
                            $ConsumerFName = ($document1->ConsumerFName);
                            }

                            $total = 0;
                            $filter2 = ['School_id'=>$_SESSION["loggeduser_school_id"],'Forum_id'=>$Forum_id,'Parent_id'=>'0'];
                            $query2 = new MongoDB\Driver\Query($filter2);
                            $cursor2 = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.ForumComment',$query2);
                            foreach ($cursor2 as $document2)
                            {
                                $total = $total + 1;
                            }
                            ?>
                            <a href="index.php?page=forum_detail&forum=1&topic=Short News / Info&id=<?= $Forum_id; ?>" style="text-transform:uppercase"><?= $Title."<br>"; ?></a>
                            <!--listbox-->
                            <div class="text-muted">
                                <small><?= $ConsumerFName; ?></small>
                                <span>|</span>
                                <small><?= date_format($Date_time,"d/m/y"); echo " ( ".time_elapsed($time_now-$Date)." ) \n"; ?></small>
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
    </div>
</div>
