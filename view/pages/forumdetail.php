<?php
$category = $_GET['forum'];
$topic = $_GET['topic'];
$_SESSION["title"] = "Forum : $topic ";

include 'view/partials/_subheader/subheader-v1.php';
include 'model/forums.php'; 
include 'model/counter.php';

$filter = ['url'=>$URL];
$query = new MongoDB\Driver\Query($filter);
$cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Views',$query);
foreach ($cursor as $document)
{
    $url = $document->url;
    $count = $document->count;
}
?>
<style>
.img-round-xsm  {
    border-radius: 50%;
    height: 25px;
    width: 25px;
}
.img-round-xxxsm  {
    border-radius: 50%;
    height: 15px;
    width: 15px;
}
</style>
<div class="row">
    <div class="col-3"></div>		
    <div class="col-6">
        <div class="mt-3 mb-3 p-4 rounded" style="color: #5e9164; background-color: #8bcf93;">
            <strong>Channel Topic &nbsp;&nbsp;:&nbsp;&nbsp; </strong>
            <span class="btn btn-outline-white btn-sm font-weight-bold btn-pill"><?= $_GET['topic']; ?></span>
        </div>
        <?php
        if ($_SESSION["loggeduser_ConsumerGroupName"] =='SCHOOL' || $_SESSION["loggeduser_ConsumerGroupName"] =='GONGETZ')
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
            $id = $_GET['id'];
            $nowtime = time();
            $ConsumerFName3 = " ";
            $filter = ['_id'=>new \MongoDB\BSON\ObjectId($id)];
            $query = new MongoDB\Driver\Query($filter);
            $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Forum',$query);
            foreach ($cursor as $document)
            {
                $total = 0;
                $Forum_id = strval($document->_id);
                $Title = $document->Title;
                $Details = $document->Details;
                $Date = strval($document->Date);
                $Consumer_id = $document->Consumer_id;

                $utcdatetime = new MongoDB\BSON\UTCDateTime($Date);
                $datetime = $utcdatetime->toDateTime()->setTimezone(new \DateTimeZone(date_default_timezone_get()));
                $dateforum = date_format($datetime,"Y-m-d\TH:i:s");
                $date = new MongoDB\BSON\UTCDateTime((new DateTime($dateforum))->getTimestamp());
                $time_strval = strval($date);
                
                $filter = ['_id' => new \MongoDB\BSON\ObjectId($Consumer_id)];
                $query = new MongoDB\Driver\Query($filter);
                $cursor = $GoNGetzDatabase->executeQuery('GoNGetz.Consumer', $query);
                foreach ($cursor as $document1)
                {
                    $ConsumerFName = $document1->ConsumerFName;
                    $ConsumerLName = $document1->ConsumerLName;
                    ?>
                    <div class="bg-white p-8 mb-3">
                        <a class="h5"><?= $Title; ?></a>
                        <div class="mt-5">
                            <span align="justify"><?= $Details; ?></span>
                        </div>
                        <div class="mt-5 mb-5">
                            <img class="img-round-xxxsm" src="assets/media/svg/avatars/032-boy-13.svg" alt="avatar">&nbsp;&nbsp;
                            <small class="text-muted"><?= $ConsumerFName." ".$ConsumerLName;?></small>&nbsp;&nbsp;
                            <small class="text-muted"><?= date_format($datetime,"d/m/y"); echo " ( ".time_elapsed($nowtime-$time_strval)." ) \n"; ?></small>
                        </div>
                    </div>
                    <div class="card p-8 ribbon ribbon-left">
                        <div class="ribbon-target bg-warning" style="top: 10px; left: -2px;">Views : <?= $count; ?></div>
                            <?php
                            $filter = ['School_id'=>$_SESSION["loggeduser_schoolID"],'Forum_id'=>$Forum_id,'Parent_id'=>'0'];
                            $query = new MongoDB\Driver\Query($filter);
                            $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.ForumComment',$query);

                            foreach ($cursor as $document2)
                            {
                                $total = $total + 1;
                                $Forum_id = strval($document2->Forum_id);
                                $Details = $document2->Details;
                                $Staff_id = $document2->Staff_id;

                                $filter = ['_id' => new \MongoDB\BSON\ObjectId($Staff_id)];
                                $query = new MongoDB\Driver\Query($filter);
                                $cursor = $GoNGetzDatabase->executeQuery('GoNGetz.Consumer',$query);
                                foreach ($cursor as $document3)
                                {
                                    $ConsumerFName3 = $document3->ConsumerFName;
                                    $ConsumerLName3 = $document3->ConsumerLName;
                                }
                            }
                            ?>
                            <div class="text-right">
                                <a href="index.php?page=schoolforumdetail&forum=<?= $_GET['forum']; ?>&topic=<?= $_GET['topic'];?>&id=<?= $id;?>">Newest</a>&nbsp;&nbsp;
                                <a href="index.php?page=schoolforumdetail&forum=<?= $_GET['forum']; ?>&topic=<?= $_GET['topic'];?>&id=<?= $id;?>&sort">Oldest</a>
                            </div>
                            <div class="mt-3">
                                <a class="text-dark-50"><?= "Comments &nbsp;&nbsp;".$total; ?></a>
                            </div>
                            <form name="AddComment" action="index.php?page=schoolforumdetail&forum=<?= $_GET['forum']; ?>&topic=<?= $_GET['topic'];?>&id=<?= $id;?>" method="post">
                                <textarea class="forum" name="detail"></textarea>
                                <div class="text-right">
                                    <input type="hidden"  name="forum_id" value="<?= $Forum_id; ?>">
                                    <button type="submit" class="btn btn-warning btn-hover-light btn-sm" name="AddComment">Post as <?= $_SESSION["loggeduser_consumerFName"];  ?></button>
                                </div>
                            </form> 
                            <?php
                            if (!isset($_GET['sort']) && empty($_GET['sort']))
                            {
                                $filter = ['School_id'=>$_SESSION["loggeduser_schoolID"],'Forum_id'=>$Forum_id,'Parent_id'=>'0'];
                                $option = ['sort' => ['_id' => -1]];
                                $query = new MongoDB\Driver\Query($filter,$option);
                                $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.ForumComment',$query);
                            }
                            else
                            {
                                $filter = ['School_id'=>$_SESSION["loggeduser_schoolID"],'Forum_id'=>$Forum_id,'Parent_id'=>'0'];
                                $option = ['sort' => ['_id' => 1]];
                                $query = new MongoDB\Driver\Query($filter,$option);
                                $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.ForumComment',$query);
                            }

                            foreach ($cursor as $document4)
                            {
                                $_id4 = strval($document4->_id);
                                $Details4 = $document4->Details;
                                $Staff_id4 = $document4->Staff_id;
                                $Date4 = strval($document4->Date);

                                $utcdatetime4 = new MongoDB\BSON\UTCDateTime($Date4);
                                $datetime4 = $utcdatetime4->toDateTime()->setTimezone(new \DateTimeZone(date_default_timezone_get()));
                                $dateforum4 = date_format($datetime4,"Y-m-d\TH:i:s");
                                $date4 = new MongoDB\BSON\UTCDateTime((new DateTime($dateforum4))->getTimestamp());
                                $time4_strval = strval($date4);

                                $filter = ['_id' => new \MongoDB\BSON\ObjectId($Staff_id4)];
                                $query = new MongoDB\Driver\Query($filter);
                                $cursor = $GoNGetzDatabase->executeQuery('GoNGetz.Consumer', $query);
                                foreach ($cursor as $document5)
                                {
                                    $ConsumerFName5 = $document5->ConsumerFName;
                                    $ConsumerLName5 = $document5->ConsumerLName;
                                    ?>
                                    <div class="accordion accordion-flush" id="accordionFlushExample">
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="flush-heading<?= $_id4; ?>">
                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse<?= $_id4; ?>" aria-expanded="false" aria-controls="flush-collapse<?= $_id4; ?>">
                                                    <div class="text-left">
                                                        <img class="img-round-xsm" src="assets/media/svg/avatars/029-boy-11.svg" alt="avatar">
                                                        <a href="index.php?page=staffdetail&id=<?= $Consumer_id; ?>"><?= $ConsumerFName5." ".$ConsumerLName5;?></a>
                                                        <small class="text-muted"><?= date_format($datetime4,"d/m/y"); echo " ( ".time_elapsed($nowtime-$time4_strval)." ) \n"; ?></small>
                                                        <div style="border-left: 1px solid #eee; color:#687a86; padding-left:10px; text-align:left;"><?= $Details4; ?></div>
                                                    </div> 
                                                </button>
                                            </h2>
                                            <div id="flush-collapse<?= $_id4; ?>" class="accordion-collapse collapse" aria-labelledby="flush-heading<?= $_id4; ?>" data-bs-parent="#accordionFlushExample">
                                                <div class="accordion-body commentline">
                                                <?php
                                                $filter = ['School_id'=>$_SESSION["loggeduser_schoolID"],'Forum_id'=>$Forum_id,'Parent_id'=>$_id4];
                                                $option = ['sort' => ['_id' => 1]];
                                                $query = new MongoDB\Driver\Query($filter,$option);
                                                $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.ForumComment',$query);

                                                foreach ($cursor as $document6)
                                                {
                                                    $Details6 = $document6->Details;
                                                    $Staff_id6 = $document6->Staff_id;
                                                    $Date6 = strval($document6->Date);

                                                    $utcdatetime6 = new MongoDB\BSON\UTCDateTime($Date6);
                                                    $datetime6 = $utcdatetime6->toDateTime()->setTimezone(new \DateTimeZone(date_default_timezone_get()));
                                                    $dateforum6 = date_format($datetime6,"Y-m-d\TH:i:s");
                                                    $date6 = new MongoDB\BSON\UTCDateTime((new DateTime($dateforum6))->getTimestamp());
                                                    $time6_strval = strval($date6);

                                                    $filter = ['_id' => new \MongoDB\BSON\ObjectId($Staff_id6)];
                                                    $query = new MongoDB\Driver\Query($filter);
                                                    $cursor = $GoNGetzDatabase->executeQuery('GoNGetz.Consumer', $query);
                                                    foreach ($cursor as $document7)
                                                    {
                                                        $ConsumerFName7 = $document7->ConsumerFName;
                                                        $ConsumerLName7 = $document7->ConsumerLName;
                                                        ?>
                                                        <div class="text-left">
                                                            <img class="img-round-xsm" src="assets/media/svg/avatars/029-boy-11.svg" alt="avatar">
                                                            <a href="index.php?page=staffdetail&id=<?= $Consumer_id; ?>"><?= $ConsumerFName7." ".$ConsumerLName7;?></a>
                                                            <small class="text-muted"><?= date_format($datetime6,"d/m/y"); echo " ( ".time_elapsed($nowtime-$time6_strval)." ) \n"; ?></small>
                                                            <div style="border-left: 1px solid #eee; padding-left:10px; margin-left: 10px;"><?= $Details6; ?></div>
                                                        </div> 
                                                        <?php
                                                    }
                                                }
                                                ?>
                                                <form name="AddCommentChild" action="index.php?page=schoolforumdetail&forum=<?= $_GET['forum']; ?>&topic=<?= $_GET['topic'];?>&id=<?= $id;?>" method="post">
                                                    <div class="col-12">
                                                        <textarea class="forum" name="detail"></textarea>
                                                        <div class="text-right">
                                                            <input type="hidden" name="forum_id" value="<?=  $Forum_id; ?>">
                                                            <input type="hidden" name="parent_id" value="<?= $_id4; ?>">
                                                            <button type="submit" class="btn btn-warning btn-hover-light btn-sm" name="AddCommentChild">Post as <?= $_SESSION["loggeduser_consumerFName"];  ?></button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                }
                            }
                        ?>
                    </div>
                    <?php
                }
            }
        }
        ?>
    </div>
    <div class="col-3"></div>
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