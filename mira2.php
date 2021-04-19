/**school forum
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
        $nowtime = time();
        $oldtime = strval($date);
?>
<br><br>
<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-header">
            <a href="index.php?page=schoolforumdetail&id=<?php echo $Forumid; ?>" style="color:#076d79; text-decoration: none;">
            <?php echo $ForumTitle." .".time_elapsed($nowtime-$oldtime)."\n"; ?>
            </a>
            </div>
            <div class="card-body">
                <table class="table table-striped table-sm ">
                <?php echo $ForumDetails;?>
                </table>
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