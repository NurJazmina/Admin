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
      <div class="col section-2 section-description wow fadeIn"></div>
    </div>
    <div class="row">
    	<div class="col-md-6 section-2-box wow fadeInLeft">
        <h3>Latest News</h3>
        <div class="block-content">
          <div class="views-row">
            <div class="views-field views-field-nothing">
<?php
$filter = ['school_id'=> $_SESSION["loggeduser_schoolID"],'SchoolNewsStatus'=>'ACTIVE'];
$option = ['sort' => ['_id' => -1],'limit'=>10];
$query = new MongoDB\Driver\Query($filter, $option);
$cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.SchoolNews',$query);

foreach ($cursor as $document)
{
  $Newsid = strval($document->_id);
  $SchoolNewsStaff_id = ($document->SchoolNewsStaff_id);
  $schoolNewsTitle = ($document->schoolNewsTitle);
  $schoolNewsDetails = ($document->schoolNewsDetails);
  $SchoolNewsDate = ($document->SchoolNewsDate);
  $SchoolNewsStatus = ($document->SchoolNewsStatus);

  $utcdatetime = new MongoDB\BSON\UTCDateTime(strval($SchoolNewsDate));
  $datetime = $utcdatetime->toDateTime()->setTimezone(new \DateTimeZone(date_default_timezone_get()));

    $varstaffid = new \MongoDB\BSON\ObjectId($SchoolNewsStaff_id);
    $filter1 = ['_id' => $varstaffid];
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
    ?>
    <span class="field-content">
      <div class="news-panel">
        <div class="news-panel-title"><a href="index.php?page=newsdetail&id=<?php echo $Newsid; ?>" target="_blank"><?php echo $schoolNewsTitle; ?></a><small ><?php echo " By : ".$ConsumerFName." ".$ConsumerLName;?></small></div>
        <span class="claimedRight" maxlength="100"><?php echo $schoolNewsDetails; ?></span><br>
        <span class="news-panel-date"><?php echo date_format($datetime,"D, M Y"); ?></span>
      </div>
    </span>
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
        <div class="text-center"><a href="#" target="_blank" class="button btn btn-info">See more News</a></div>
      </footer>
    </div>
  </div>
  <div class="col-md-6 section-2-box wow fadeInLeft">
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
          <div class="text-center"><a href="#" target="_blank" class="button btn btn-info">See more Events</a></div>
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
