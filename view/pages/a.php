<?php
if (isset($_GET['paging']) && !empty($_GET['paging']))
{
    $next = $_GET['paging']+1;
    $previous = $_GET['paging']-1;
}
else
{
    $next = + 1;
    $previous = - 1;
}
if (isset($_GET['paging']) && !empty($_GET['paging']))
{
    $date_paging = new MongoDB\BSON\UTCDateTime((new DateTime('first day of '.$_GET['paging'].' month'))->getTimestamp()*1000);
    $date_paging = $date_paging->toDateTime()->setTimezone(new \DateTimeZone(date_default_timezone_get()));
    $date_paging = date_format($date_paging,"Y-m-d");
    echo $date_paging;
}
else if (!isset($_GET['paging']) && empty($_GET['paging']))
{
    $date_paging = new MongoDB\BSON\UTCDateTime((new DateTime('now'))->getTimestamp()*1000);
    $date_paging = $date_paging->toDateTime()->setTimezone(new \DateTimeZone(date_default_timezone_get()));
    $date_paging = date_format($date_paging,"Y-m-d");
    echo $date_paging;
}
?>
<a href="index.php?page=a&paging=<?= $previous;?>" class="btn btn-light btn-hover-success btn-sm">Previous</a>
<a href="index.php?page=a&paging=<?= $next;?>" class="btn btn-success btn-hover-light btn-sm">Next</a>
<?php
    if($ConsumerGroup_idChild == '6018c32b10184a751c102eb6')
    {
    }
    elseif ($ConsumerGroup_id == '601b4cfd97728c027c01f187' || $ConsumerGroup_id == '6018c2ebc8c7c7b2e8a4140c')//school && parent
    {
      if($ConsumerGroup_id == '601b4cfd97728c027c01f187')
      {
        //staff
        $detail = 'staffdetail';
      }
      elseif ($ConsumerGroup_id == '6018c2ebc8c7c7b2e8a4140c')
      {
        //parent
        $detail = 'parentdetail';
      }
      ?>
      <!-- group : staff/vip/gongetz -->
      <div class="text-dark-50 text-center">
        <h1>AUTHORIZED PERSONNEL ONLY</h1>
      </div>
      <form action="index.php?page=<?= $detail; ?>&id=<?= $consumer_student_id; ?>" method="post">
        <div class="modal-dialog modal-lg modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Add Student</h5>
            </div>
            <div class="modal-body">
              <div class="form-group row">
                <label class="col-sm-2 col-form-label">Student Name</label>
                <div class="col-sm-10">
                  <input class="form-control" value="<?= $ConsumerFNameChild." ".$ConsumerLNameChild; ?>" disabled>
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-2 col-form-label">MyKad</label>
                <div class="col-sm-10">
                  <input class="form-control" value="<?= $ConsumerIDNoChild; ?>" disabled>
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-2 col-form-label">Group</label>
                <div class="col-sm-10">
                  <input class="form-control" value="UNAUTHORIZED" disabled>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button class="btn btn-success btn-hover-light btn-hover-light btn-sm">Resume Consumer Detail</button>
            </div>
          </div>
        </div>
      </form>
      <!-- group : staff/vip/gongetz -->
      <?php
    }
    else
    {
      ?>
      <!-- group : staff/vip/gongetz -->
      <div class="text-dark-50 text-center">
        <h1>AUTHORIZED PERSONNEL ONLY</h1>
      </div>
      <form action="index.php?page=studentlist" method="post">
        <div class="modal-dialog modal-lg modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Add Student</h5>
            </div>
            <div class="modal-body">
              <div class="form-group row">
                <label class="col-sm-2 col-form-label">MyKad</label>
                <div class="col-sm-10">
                  <input class="form-control" value="<?= $student_idno; ?>" disabled>
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-2 col-form-label">Group</label>
                <div class="col-sm-10">
                  <input class="form-control" value="UNAUTHORIZED" disabled>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button class="btn btn-success btn-hover-light btn-hover-light btn-sm">Return</button>
            </div>
          </div>
        </div>
      </form>
      <!-- group : staff/vip/gongetz -->
      <?php
    }