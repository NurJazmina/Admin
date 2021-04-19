/**schoolforumdetail
* @todo Reject access kalau bukan staff atau cikgu
* @body as title.
*/
<div class="card-header">School - General</div>
<?php
if ($_SESSION["loggeduser_ConsumerGroup_id"]=='601b4cfd97728c027c01f187')
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
        $ret[] = 'ago.';
    
        return join(' ', $ret);
        }

    $counting = 0;
    $sort = ($_GET['forum']);
    $filter = ['school_id'=>$_SESSION["loggeduser_schoolID"],'ForumParentid'=>'0','Forum'=>$sort];
    $option = ['sort' => ['_id' => -1]];
    $query = new MongoDB\Driver\Query($filter,$option);
    $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.SchoolForum',$query);

    foreach ($cursor as $document)
    {
        $counting = $counting + 1;
        $Forumid = strval($document->_id);
        $ForumTitle = ($document->ForumTitle);
        $ForumDetails = ($document->ForumDetails);
        $ForumDate = ($document->ForumDate);
        $Consumer_id = ($document->Consumer_id);

        $utcdatetime = new MongoDB\BSON\UTCDateTime(strval($ForumDate));
        $datetime = $utcdatetime->toDateTime()->setTimezone(new \DateTimeZone(date_default_timezone_get()));
        $dateforum = date_format($datetime,"Y-m-d\TH:i:s");
        $date = new MongoDB\BSON\UTCDateTime((new DateTime($dateforum))->getTimestamp());
?>
<br><br>
<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-header">
            <?php echo $ForumTitle; ?>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <div id="disqus_thread"></div>
                            <div>
                                <table class="table table-striped table-sm ">
                                  <thead>
                                  <?php
                                $nowtime = time();
                                $oldtime = strval($date);
                                echo "time elapsed: ".time_elapsed($nowtime-$oldtime)."\n";


                                  echo $ForumDetails;
                                  ?>                          
                                  </thead>
                                </table>
                                <form name="AddforumsFormSubmit" action="model/forums.php" method="POST">
                                <div class="row">
                                    <textarea id="comment<?php echo $counting; ?>"  name="txtconsumerforum" rows="3"></textarea>
                                    <button type="submit" class="btn btn-secondary" name="AddforumsFormSubmit">Confirm</button>
                                </div>
                                </form>
                                <?php
                                $filter1 = ['school_id'=>$_SESSION["loggeduser_schoolID"],'ForumParentid'=>$Forumid,'Forum'=>$sort];
                                $option1 = ['sort' => ['_id' => -1]];
                                $query1 = new MongoDB\Driver\Query($filter1,$option1);
                                $cursor1 = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.SchoolForum',$query1);
                            
                                foreach ($cursor1 as $document1)
                                {
                                    $Forumid1 = strval($document1->_id);
                                    $ForumDetails1 = ($document1->ForumDetails);
                                    $ForumDate1 = ($document1->ForumDate);
                                    $Consumer_id1 = ($document1->Consumer_id);
                                    $utcdatetime1 = new MongoDB\BSON\UTCDateTime(strval($ForumDate1));
                                    $datetime1 = $utcdatetime1->toDateTime()->setTimezone(new \DateTimeZone(date_default_timezone_get()));
                                    ?>
                                    <div class="accordion accordion-flush" id="accordionFlushExample">
                                    <div class="accordion-item" >
                                      <h6 class="accordion-header" id="flush-headingOne">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                                        <tbody>
                                          <tr>
                                          <td><?php print_r($datetime1->format('r')); ?></td>
                                          <td>
                                            <?php
                                            $consumerid = new \MongoDB\BSON\ObjectId($Consumer_id1);
                                            $filter1 = ['_id' => $consumerid];
                                            $query1 = new MongoDB\Driver\Query($filter1);
                                            $cursor1 = $GoNGetzDatabase->executeQuery('GoNGetz.Consumer', $query1);
                                            foreach ($cursor1 as $document1)
                                            {
                                            $ConsumerFName = ($document1->ConsumerFName);
                                            echo $ConsumerFName;
                                            }
                                            ?>
                                          </td>
                                          <td><?php echo $ForumDetails1; ?></td>
                                          </tr>
                                          </tbody>
                                        </button>
                                      </h6>
                                      <div  id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                                      <?php 
                                        $filter2 = ['school_id'=>$_SESSION["loggeduser_schoolID"],'ForumParentid'=>$Forumid1,'Forum'=>$sort];
                                        $option2 = ['sort' => ['_id' => -1]];
                                        $query2 = new MongoDB\Driver\Query($filter2,$option2);
                                        $cursor2 = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.SchoolForum',$query2);
                                    
                                        foreach ($cursor2 as $document2)
                                        {
                                            $Forumid2 = strval($document2->_id);
                                            $ForumDetails2 = ($document2->ForumDetails);
                                            $ForumDate2 = ($document2->ForumDate);
                                            $Consumer_id2 = ($document2->Consumer_id);
                                            $utcdatetime2 = new MongoDB\BSON\UTCDateTime(strval($ForumDate2));
                                            $datetime2 = $utcdatetime2->toDateTime()->setTimezone(new \DateTimeZone(date_default_timezone_get()));
                                        ?>
                                        <div class="accordion-body">
                                        <tbody>
                                          <tr>
                                            <td><?php print_r($datetime1->format('r')); ?></td>
                                            <td>
                                            <?php
                                            $consumerid = new \MongoDB\BSON\ObjectId($Consumer_id1);
                                            $filter1 = ['_id' => $consumerid];
                                            $query1 = new MongoDB\Driver\Query($filter1);
                                            $cursor1 = $GoNGetzDatabase->executeQuery('GoNGetz.Consumer', $query1);
                                            foreach ($cursor1 as $document1)
                                            {
                                            $ConsumerFName = ($document1->ConsumerFName);
                                            echo $ConsumerFName;
                                            }
                                            ?>
                                            </td>
                                            <td>
                                              <?php echo $ForumDetails1; ?>
                                            </td>
                                          </tr>
                                          </tbody>
                                        </div>
                                        <?php
                                        }
                                        ?>
                                        <form name="AddforumsFormSubmit" action="model/forums.php" method="POST">
                                        <div class="row">
                                            <textarea id="comment" name="txtconsumerforum" rows="3"></textarea>
                                            <button type="submit" class="btn btn-secondary" name="AddforumsFormSubmit">Confirm</button>
                                        </div>
                                        </form>
                                      </div>
                                      </div>
                                    </div>
                                <?php
                                }
                                ?>
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
else
{
?>
<br><br><br><br><div class="alert alert-danger" role="alert">
<h2 style="text-align: center;">AUTHORIZED PERSONNEL ONLY</h2>
<form id="unauthorized" name="unauthorized" action="index.php?page=forums" method="post">
  <div class="modal-dialog modal-lg modal-dialog-centered">
  <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="unauthorizedModalLabel"></h5>
        </div>
        <div class="modal-body">
          <div class="form-group row">
            <label for="staticStaffNo" class="col-sm-2 col-form-label">MyKad</label>
            <div class="col-sm-10">
              <input value="<?php echo $_SESSION["loggeduser_consumerIDNo"]; ?>" disabled>
            </div>
          </div>
          <div class="form-group row">
            <label for="staticStaffNo" class="col-sm-2 col-form-label"></label>
            <div class="col-sm-10">
              <input value="UNAUTHORIZED" disabled>
            </div>
          </div>
        <div class="modal-footer">
          <button onclick="index.php?page=forums" class="btn btn-secondary" >Close</button>
        </div>
      </div>
  </div>
  </div>
  </form>
  </div>
<?php
}
?>