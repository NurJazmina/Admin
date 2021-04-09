<?php include ('model/home.php'); ?>
<div class="col" style="color:#404040; text-align:center;">
	<div class="row">
    <h1><br>Dashboard testing</h1>
  </div>
</div>
<br>
<div class="col" style=" color:#404040; text-align:center;">
	<div class="row">
    <h3><?php echo $_SESSION["loggeduser_schoolName"];?></h3>
  </div>
</div>
<br><br><br>
<div class="section">
<!-- Section 1 -->
<div class="section-1-container section-container">
<div class="container">
  <div class="row">
    <div class="col section-1 section-description wow fadeIn">
      <div class="divider-1 wow fadeInUp"><span></span></div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-3 section-1-box wow fadeInUp">
      <div class="row">
        <div class="col-md-3">
        </div>
        <div class="col-md-12">
          <div class="card">
            <div class="card-body">
              <i class="fas fa-user-tie fa-2x"></i>
              <h3>Total Staff</h3>
              <h3><a href="index.php?page=stafflist&level=1" style="color:#076d79;"><?php echo $_SESSION["totalstaff"] ?></a></h3>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-3 section-1-box wow fadeInDown">
      <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-12">
          <div class="card">
            <div class="card-body">
              <i class="fas fa-chalkboard-teacher fa-2x"></i>
              <h3>Total Teacher</h3>
              <h3><a href="index.php?page=stafflist&level=0" style="color:#076d79;"><?php echo $_SESSION["totalteacher"] ?></a></h3>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-3 section-1-box wow fadeInUp">
      <div class="row">
        <div class="col-md-3">
          <div class="section-1-box-icon"></div>
        </div>
        <div class="col-md-12">
          <div class="card">
            <div class="card-body">
              <i class="fas fa-user-graduate fa-2x"></i>
              <h3>Total Student</h3>
              <h3><a href="index.php?page=studentlist" style="color:#076d79;"><?php echo $_SESSION["totalstudent"] ?></a></h3>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-3 section-1-box wow fadeInUp">
      <div class="row">
        <div class="col-md-3">
          <div class="section-1-box-icon"></div>
        </div>
        <div class="col-md-12">
          <div class="card">
            <div class="card-body">
              <i class="fas fa-user-friends fa-2x"></i>
              <h3>Total Parent</h3>
              <h3><a href="index.php?page=parentlist" style="color:#076d79;"><?php echo $_SESSION["totalparent"] ?></a></h3>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</div>
<br><br>
<!-- Section 2 -->
<div class="section-2-container section-container section-container-gray-bg">
  <div class="container">
    <div class="row">
    	<div class="col-md-12 section-2-box wow fadeInLeft">
        <h3>Latest News</h3>
        <div class="block-content">
          <div class="views-row">
            <div class="views-field views-field-nothing">
            <?php
$groupid = new \MongoDB\BSON\ObjectId($_SESSION["loggeduser_ConsumerGroup_id"]);
$filter2 = ['_id' => $groupid];
$query2 = new MongoDB\Driver\Query($filter2);
$cursor2 = $GoNGetzDatabase->executeQuery('GoNGetz.ConsumerGroup', $query2);
foreach ($cursor2 as $document2)
{
    $ConsumerGroupName = strval($document2->ConsumerGroupName);
}

$filter2 = ['SchoolNewsStatus'=>'ACTIVE'];
$query2 = new MongoDB\Driver\Query($filter2);
$cursor2 = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.SchoolNews',$query2);
foreach ($cursor2 as $document2)
{
    $SchoolNewsAccess = ($document2->SchoolNewsAccess);

    if ($SchoolNewsAccess=='SCHOOL0')
    {
      $filterA = ['SchoolNewsAccess'=>'SCHOOL0'];
      $queryA = new MongoDB\Driver\Query($filterA);
      $cursorA = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.SchoolNews',$queryA);
      foreach ($cursorA as $documentA)
      {
        $Newsid = strval($documentA->_id);
        $SchoolNewsStaff_id = ($documentA->SchoolNewsStaff_id);
        $schoolNewsTitle = ($documentA->schoolNewsTitle);
        $schoolNewsDetails = ($documentA->schoolNewsDetails);
        $SchoolNewsDate = ($documentA->SchoolNewsDate);
        $SchoolNewsStatus = ($documentA->SchoolNewsStatus);
        $Access = ($documentA->SchoolNewsAccess);
    
        $id = new \MongoDB\BSON\ObjectId($SchoolNewsStaff_id);
        $filter1 = ['_id' => $id];
        $query1 = new MongoDB\Driver\Query($filter1);
        $cursor1 = $GoNGetzDatabase->executeQuery('GoNGetz.Consumer', $query1);
        foreach ($cursor1 as $document1)
        {
            $consumerid = strval($document1->_id);
            $ConsumerFName = ($document1->ConsumerFName);
            $ConsumerLName = ($document1->ConsumerLName);
            $filter2 = ['ConsumerID'=>$consumerid];
            $query2 = new MongoDB\Driver\Query($filter2);
            $cursor2 = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Staff',$query2);
            foreach ($cursor2 as $document2)
            {
                $Staffdepartment = ($document2->Staffdepartment);
                $departmentid = new \MongoDB\BSON\ObjectId($Staffdepartment);
    
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
            <strong><a href="index.php?page=newsdetail&id=<?php echo $Newsid ; ?>" target="_blank"><?php echo $schoolNewsTitle; ?></a></strong>
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
            </div>
          </div>
          <div class="card-footer">
            <small><?php echo " BY : ".$ConsumerFName." ".$ConsumerLName.",DEPARTMENT : ".$DepartmentName;?></small>
          </div>
        </div><br>
    <?php
    
      }
    }
    elseif ($SchoolNewsAccess=='SCHOOL1')
    {
      $filterB = ['SchoolNewsAccess'=>'SCHOOL1'];
      $queryB = new MongoDB\Driver\Query($filterB);
      $cursorB = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.SchoolNews',$queryB);
      foreach ($cursorB as $documentB)
      {
        $Newsid = strval($documentB->_id);
        $SchoolNewsStaff_id = ($documentB->SchoolNewsStaff_id);
        $schoolNewsTitle = ($documentB->schoolNewsTitle);
        $schoolNewsDetails = ($documentB->schoolNewsDetails);
        $SchoolNewsDate = ($documentB->SchoolNewsDate);
        $SchoolNewsStatus = ($documentB->SchoolNewsStatus);
        $Access = ($documentB->SchoolNewsAccess);
        //echo $Access;
    
        $id = new \MongoDB\BSON\ObjectId($SchoolNewsStaff_id);
        $filter1 = ['_id' => $id];
        $query1 = new MongoDB\Driver\Query($filter1);
        $cursor1 = $GoNGetzDatabase->executeQuery('GoNGetz.Consumer', $query1);
        foreach ($cursor1 as $document1)
        {
            $consumerid = strval($document1->_id);
            $ConsumerFName = ($document1->ConsumerFName);
            $ConsumerLName = ($document1->ConsumerLName);
            $filter2 = ['ConsumerID'=>$consumerid];
            $query2 = new MongoDB\Driver\Query($filter2);
            $cursor2 = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Staff',$query2);
            foreach ($cursor2 as $document2)
            {
                $Staffdepartment = ($document2->Staffdepartment);
                $departmentid = new \MongoDB\BSON\ObjectId($Staffdepartment);
    
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
            <strong><a href="index.php?page=newsdetail&id=<?php echo $Newsid ; ?>" target="_blank"><?php echo $schoolNewsTitle; ?></a></strong>
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
            </div>
          </div>
          <div class="card-footer">
            <small><?php echo " BY : ".$ConsumerFName." ".$ConsumerLName.",DEPARTMENT : ".$DepartmentName;?></small>
          </div>
        </div><br>
    <?php
    
      }
    }
    elseif ($SchoolNewsAccess=='VIP')
    {
      $filterC = ['SchoolNewsAccess'=>'VIP'];
      $queryC = new MongoDB\Driver\Query($filterC);
      $cursorC = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.SchoolNews',$queryC);
      foreach ($cursorC as $documentC)
      {
        $Newsid = strval($documentC->_id);
        $SchoolNewsStaff_id = ($documentC->SchoolNewsStaff_id);
        $schoolNewsTitle = ($documentC->schoolNewsTitle);
        $schoolNewsDetails = ($documentC->schoolNewsDetails);
        $SchoolNewsDate = ($documentC->SchoolNewsDate);
        $SchoolNewsStatus = ($documentC->SchoolNewsStatus);
        $Access = ($documentC->SchoolNewsAccess);
    
        $id = new \MongoDB\BSON\ObjectId($SchoolNewsStaff_id);
        $filter1 = ['_id' => $id];
        $query1 = new MongoDB\Driver\Query($filter1);
        $cursor1 = $GoNGetzDatabase->executeQuery('GoNGetz.Consumer', $query1);
        foreach ($cursor1 as $document1)
        {
            $consumerid = strval($document1->_id);
            $ConsumerFName = ($document1->ConsumerFName);
            $ConsumerLName = ($document1->ConsumerLName);
            $filter2 = ['ConsumerID'=>$consumerid];
            $query2 = new MongoDB\Driver\Query($filter2);
            $cursor2 = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Staff',$query2);
            foreach ($cursor2 as $document2)
            {
                $Staffdepartment = ($document2->Staffdepartment);
                $departmentid = new \MongoDB\BSON\ObjectId($Staffdepartment);
    
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
            <strong><a href="index.php?page=newsdetail&id=<?php echo $Newsid ; ?>" target="_blank"><?php echo $schoolNewsTitle; ?></a></strong>
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
            </div>
          </div>
          <div class="card-footer">
            <small><?php echo " BY : ".$ConsumerFName." ".$ConsumerLName.",DEPARTMENT : ".$DepartmentName;?></small>
          </div>
        </div><br>
    <?php
    
      }
    }
else
{
  $filter2 = [NULL];
  $query2 = new MongoDB\Driver\Query($filter2);
  $cursor2 = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.SchoolNews',$query2);
  foreach ($cursor2 as $document2)
  {
    $Newsid = strval($document2->_id);
    $SchoolNewsStaff_id = ($document2->SchoolNewsStaff_id);
    $schoolNewsTitle = ($document2->schoolNewsTitle);
    $schoolNewsDetails = ($document2->schoolNewsDetails);
    $SchoolNewsDate = ($document2->SchoolNewsDate);
    $SchoolNewsStatus = ($document2->SchoolNewsStatus);
    $SchoolNewsAccess = ($document2->SchoolNewsAccess);

    $utcdatetime = new MongoDB\BSON\UTCDateTime(strval($SchoolNewsDate));
    $datetime = $utcdatetime->toDateTime()->setTimezone(new \DateTimeZone(date_default_timezone_get()));
  }
  ?>
    <div class="card">
      <div class="card-body">
        <div class="table-responsive-sm">
            <div class="text4 eventdate">
              <span class="eventdate-day"><?php echo date_format($datetime,"d"); ?></span>
              <br>
              <span class="eventdate-month"><?php echo date_format($datetime,"M"); ?></span>
            </div>
            <div class="eventtitle">
            <table class="table table-striped table-sm">
            <strong><a href="index.php?page=newsdetail&id=<?php echo $Newsid ; ?>" target="_blank"><?php echo $schoolNewsTitle; ?></a></strong><br>
            <span class="claimedRight" style="color:black"><?php echo $schoolNewsDetails; ?></span><br>
            </table>
            </div>
        </div>
      </div>
      <div class="card-footer">
        <small><?php echo " BY : ".$ConsumerFName." ".$ConsumerLName.",DEPARTMENT : ".$DepartmentName;?></small>
      </div>
    </div><br>
<?php
}
?>
<script>
//Limit characters displayed in span
$(document).ready(function(){
$('.claimedRight').each(function (f) {
    var newstr = $(this).text().substring(0,100);
    $(this).text(newstr);

    });
})
</script>
<?php
}
?>
            </div>
          </div>
      <footer>
        <div class="text-center"><a href="index.php?page=news" target="_blank" class="button btn btn-info">See more News</a></div><br><br>
      </footer>
    </div>
  </div>
  <div class="col-md-12 section-2-box wow fadeInLeft">
    <div class="column">
      <div class="block-title-wrap clearfix">
        <div class="block-title-content">
          <h3 class="block-title">Upcoming Events</h3>
        </div>
      </div>
      <div class="block-content">
        <div class="views-row">
          <span class="field-content">
            <div class="umpevents">
              <div class="text4 eventdate">
                <span class="eventdate-day">11</span>
                <br>
                <span class="eventdate-month">Mar</span>
              </div>
              <div class="eventtitle">
                <a href="#" target="_blank">Anugerah Akademik</a>
              </div>
            </div>
          </span>
        </div>
        <footer>
          <div class="text-center"><a href="#" target="_blank" class="button btn btn-info">See more Events</a></div><br><br>
        </footer>
      </div>
    </div>
  </div>
</div>
</div>
</div>
<br><br>
    <!-- Do not display this section at the moment -->
		<!-- Section 3
        <div class="section-3-container section-container">
	        <div class="container">

	            <div class="row">
	                <div class="col section-3 section-description wow fadeIn">
	                    <h2>Section 3</h2>
	                    <div class="divider-1 wow fadeInUp"><span></span></div>
	                </div>
	            </div>

	            <div class="row">
	                <div class="col-md-6 section-3-box wow fadeInLeft">
	                	<div class="row">
	                		<div class="col-md-3">
	                			<div class="section-3-box-icon">
	                				<i class="fas fa-paperclip"></i>
	                			</div>
	                		</div>
	                		<div class="col-md-9">
	                			<h3>Ut wisi enim ad minim</h3>
		                    	<p>
		                    		Lorem ipsum dolor sit amet,
		                    	</p>
	                		</div>
	                	</div>
	                </div>
	                <div class="col-md-6 section-3-box wow fadeInLeft">
	                	<div class="row">
	                		<div class="col-md-3">
	                			<div class="section-3-box-icon">
	                				<i class="fas fa-pencil-alt"></i>
	                			</div>
	                		</div>
	                		<div class="col-md-9">
	                			<h3>Sed do eiusmod tempor</h3>
		                    	<p>
		                    		Lorem ipsum dolor sit amet,
		                    	</p>
	                		</div>
	                	</div>
	                </div>
	            </div>

	            <div class="row">
	                <div class="col-md-6 section-3-box wow fadeInLeft">
	                	<div class="row">
	                		<div class="col-md-3">
	                			<div class="section-3-box-icon">
	                				<i class="fas fa-cloud"></i>
	                			</div>
	                		</div>
	                		<div class="col-md-9">
	                			<h3>Quis nostrud exerci tat</h3>
		                    	<p>
		                    		Lorem ipsum dolor sit amet,
		                    	</p>
	                		</div>
	                	</div>
	                </div>
	                <div class="col-md-6 section-3-box wow fadeInLeft">
	                	<div class="row">
	                		<div class="col-md-3">
	                			<div class="section-3-box-icon">
	                				<i class="fab fa-google"></i>
	                			</div>
	                		</div>
	                		<div class="col-md-9">
	                			<h3>Minim veniam quis nostrud</h3>
		                    	<p>
		                    		Lorem ipsum dolor sit amet,
		                    	</p>
	                		</div>
	                	</div>
	                </div>
	            </div>

	        </div>
        </div>
    <br><br>

		<!-- Section 4
        <div class="section-4-container section-container section-container-gray-bg">
	        <div class="container">
	            <div class="row">
	                <div class="col section-4 section-description wow fadeInLeftBig">
	                	<h2>Section 4</h2>
	                    <p>
	                    	Ut wisi enim ad minim veniam,
	                    </p>
	                </div>
	            </div>
	        </div>
        </div>
    <br><br>
    </div>
