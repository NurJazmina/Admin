<?php
$_SESSION["title"] = "News";
?>
<?php include 'view/partials/_subheader/subheader-v1.php'; ?>

<?php include ('model/news.php'); ?>
<div><br><br><br><h1 style="color:#696969; text-align:center">News</h1></div><br>
<div class="row">

  <!--begin::staff-->
  <div class="col">
    <div class="card-header">

    </div>
    <div class="card-body">

    </div>
    <div class="card-footer">

    </div>
  </div>
  <div class="col">
    <div class="card-header">

    </div>
    <div class="card-body">

<<<<<<< HEAD
            $filter3 = ['_id'=>$departmentid];
            $query3 = new MongoDB\Driver\Query($filter3);
            $cursor3 = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.SchoolsDepartment',$query3);
            foreach ($cursor3 as $document3)
            {
                $DepartmentName = ($document3->DepartmentName);
            }
        }
    }
    
    $utcdatetime = new MongoDB\BSON\UTCDateTime(strval($SchoolNewsDate));
    $datetime = $utcdatetime->toDateTime()->setTimezone(new \DateTimeZone(date_default_timezone_get()));
    ?>
  <div class="card">
<div class="card-header">
  <strong><a href="index.php?page=newsdetail&id=<?php echo $Newsid ; ?>"><?php echo $schoolNewsTitle; ?></a></strong>
</div>
<div class="card-body">
  <div class="table-responsive-sm">
      <div class="text4 eventdate">
        <span class="eventdate-day"><?php echo date_format($datetime,"d"); ?></span>
        <br>
        <span class="eventdate-month"><?php echo date_format($datetime,"M"); ?></span>
      </div>
      <div class="eventtitle">
      <table class="table table-striped table-sm">
      <span class="claimedRight" style="color:black"><?php echo $schoolNewsDetails; ?></span><br>
      </table>
      </div>
=======
    </div>
    <div class="card-footer">

    </div>
>>>>>>> 408da6a7c623a7902f38065f6a8a94510e5081cb
  </div>
  <!--end::staff-->

  <!--begin::public-->
  <div class="col">
    <div class="card-header">

    </div>
    <div class="card-body">

    </div>
    <div class="card-footer">

    </div>
    <!--end::public-->
  </div>
  
</div>
<!--filter::end::public-->