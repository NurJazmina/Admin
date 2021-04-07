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
              <span class="field-content">
                <div class="news-panel">
                  <div class="news-panel-title"><a href="#" target="_blank">Three Writers Earn Scholastic Gold Key Awards</a></div>
                  <span class="news-panel-date">Friday, 26 Feb 2021</span>
                </div>
              </span>
            </div>
          </div>
        <div class="views-row">
        <div class="views-field views-field-nothing">
          <span class="field-content">
            <div class="news-panel">
              <div class="news-panel-title"><a href="#" target="_blank">students advised to comply with SOP to return to campus</a></div>
              <span class="news-panel-date">Friday, 26 Feb 2021</span>
            </div>
          </span>
        </div>
      </div>
      <div class="views-row">
        <div class="views-field views-field-nothing">
          <span class="field-content">
            <div class="news-panel">
              <div class="news-panel-title"><a href="#" target="_blank">50 of the Best Private Schools in Malaysia</a></div>
              <span class="news-panel-date">Friday, 26 Feb 2021</span>
            </div>
          </span>
        </div>
      </div>
      <div class="views-row">
        <div class="views-field views-field-nothing">
          <span class="field-content">
            <div class="news-panel">
              <div class="news-panel-title"><a href="#" target="_blank">School should always be a highly civilised place</a></div>
              <span class="news-panel-date">Friday, 26 Feb 2021</span>
            </div>
          </span>
        </div>
      </div>
      <div class="views-row">
        <div class="views-field views-field-nothing">
          <span class="field-content">
            <div class="news-panel">
              <div class="news-panel-title"><a href="#" target="_blank">Academy Students Contribute to Sunport Art</a></div>
              <span class="news-panel-date">Thursday, 18 Feb 2021</span>
            </div>
          </span>
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
