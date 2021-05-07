<?php
$_SESSION["title"] = "News";
?>
<?php include 'view/partials/_subheader/subheader-v1.php'; ?>

<?php
$id = new \MongoDB\BSON\ObjectId($_GET['id']);
$filter = ['_id'=>$id];
$query = new MongoDB\Driver\Query($filter);
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

    $staffid = new \MongoDB\BSON\ObjectId($SchoolNewsStaff_id);
    $filter1 = ['_id' => $staffid];
    $query1 = new MongoDB\Driver\Query($filter1);
    $cursor1 = $GoNGetzDatabase->executeQuery('GoNGetz.Consumer', $query1);
    foreach ($cursor1 as $document1)
    {
        $consumerid = strval($document1->_id);
        $ConsumerFName = ($document1->ConsumerFName);
        $ConsumerLName = ($document1->ConsumerLName);
        $ConsumerIDType = ($document1->ConsumerIDType);
        $ConsumerIDNo = ($document1->ConsumerIDNo);
        $ConsumerEmail = ($document1->ConsumerEmail);
        $ConsumerPhone = ($document1->ConsumerPhone);
        $ConsumerAddress = ($document1->ConsumerAddress);
        $ConsumerStatus = ($document1->ConsumerStatus);

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
    $total=0;
    $filter2 = ['school_id'=>$_SESSION["loggeduser_schoolID"],'news_id'=>$_GET['id'], 'news'=>'0'];
    $option2 = ['sort' => ['_id' => 1]];
    $query2 = new MongoDB\Driver\Query($filter2,$option2);
    $cursor2 = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.SchoolNewsComment',$query2);

    foreach ($cursor2 as $document2)
    {
    $total = $total + 1;
    }

}
?>
<div><br><br><br><h1 style="color:#696969; text-align:center"><?php echo $schoolNewsTitle; ?></h1></div><br>
<div class="row" >
  <div class="col-md-1 section-1-box wow fadeInUp"></div>
  <div class="col-md-10 section-1-box wow fadeInUp">
    <div class="card">
      <div class="card-body">
        <div class="table-responsive-sm">
            <table class="table">
            <span class="claimedRight" maxlength="100"><?php echo $schoolNewsDetails; ?></span><br>
            </table>
        </div>
      </div>
      <div class="card-header">
        <small><?php echo " BY : ".$ConsumerFName." ".$ConsumerLName.",DEPARTMENT : ".$DepartmentName;?></small>
        <small><?php echo date_format($datetime,"D, M Y"); ?></small>
      </div>
      <div class="card-body" style="color:#687a86;">
          <ul style="list-style:none;text-align:center;border-bottom: 3px solid #e7e9ee;margin:0;padding:0;">
              <li>
              <a >Comments <?php echo " ".$total; ?></a>
              </li>
          </ul>
          <form action="index.php?page=newsdetail&id=<?php echo $id;?>" method="post" name="AddNewsComment">
              <div class="row">
                  <textarea class="basic-example2" name="txtdetail" placeholder="Join, the discussion..." ></textarea>
                  <div class="col-lg-12">
                  <div class="row">
                      <div class="col-lg-10">
                      </div>
                      <div class="col-lg-2">
                      <br>
                          <button type="submit" class="btn btn-secondary" name="AddNewsComment">Post as <?php echo $_SESSION["loggeduser_consumerFName"];  ?></button>
                      </div>
                      </div>
                  </div>
              </div>
          </form> 
          <?php
          //sorting by category
          if (!isset($_GET['sort']) && empty($_GET['sort']))
          {
              $filter3 = ['school_id'=>$_SESSION["loggeduser_schoolID"],'news_id'=>$_GET['id'], 'news'=>'0'];
              $option3 = ['sort' => ['_id' => -1]];
              $query3 = new MongoDB\Driver\Query($filter3,$option3);
              $cursor3 = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.SchoolNewsComment',$query3);
          }
          else
          {
              $filter3 = ['school_id'=>$_SESSION["loggeduser_schoolID"],'news_id'=>$_GET['id'], 'news'=>'0'];
              $option3 = ['sort' => ['_id' => 1]];
              $query3 = new MongoDB\Driver\Query($filter3,$option3);
              $cursor3 = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.SchoolNewsComment',$query3);
          }

          foreach ($cursor3 as $document3)
          {
              $parentid = ($document3->_id);
              $schoolNewsDetails3 = ($document3->schoolNewsDetails);
              $SchoolNewsStaff_id3 = ($document3->SchoolNewsStaff_id);
              $SchoolNewsDate3 = strval($document3->SchoolNewsDate);

              $SchoolNewsStaff_id3 = new \MongoDB\BSON\ObjectId($SchoolNewsStaff_id3);
              $filter4 = ['_id' => $SchoolNewsStaff_id3];
              $query4 = new MongoDB\Driver\Query($filter4);
              $cursor4 = $GoNGetzDatabase->executeQuery('GoNGetz.Consumer', $query4);
              foreach ($cursor4 as $document4)
              {
              $ConsumerFName4 = ($document4->ConsumerFName);
              $ConsumerLName4 = ($document4->ConsumerLName);
          ?>
          <div class="row">
              <div class="col">
                  <div class="accordion accordion-flush" id="accordionFlushExample">
                  <div class="accordion-item">
                  <h2 class="accordion-header" id="flush-heading<?php echo $parentid; ?>">
                      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse<?php echo $parentid; ?>" aria-expanded="false" aria-controls="flush-collapse<?php echo $Forumid4; ?>">
                          <div class="spacing-right">
                              <div class="row">
                                  <div class="col-lg-12">
                                      <img class="img-round-sm block__item" src="https://c.disquscdn.com/uploads/users/383/2435/avatar92.jpg?1615629681" alt="avatar">
                                      <small href="#" style="text-decoration: none;"><?php echo " ".$ConsumerFName4." ".$ConsumerLName4." ";?></small>
                                  </div>
                              </div>
                          </div>
                          <div class="spacing-right">
                          <span style="color:#687a86;"><?php echo " ".$schoolNewsDetails3; ?></span>
                          </div>
                      </button>
                  </h2>
                  <div id="flush-collapse<?php echo $parentid; ?>" class="accordion-collapse collapse" aria-labelledby="flush-heading<?php echo $parentid; ?>" data-bs-parent="#accordionFlushExample">
                      <?php
                      echo $parentid; 
                      $filter5 = ['news'=>$parentid];
                      $query5 = new MongoDB\Driver\Query($filter5);
                      $cursor5 = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.SchoolNewsComment',$query5);

                      foreach ($cursor5 as $document5)
                      {
                        echo "aaaadfjsdjgunsdy";
                          $total = $total + 1;
                          $schoolNewsDetails5 = ($document5->schoolNewsDetails);
                          $SchoolNewsStaff_id5 = ($document5->SchoolNewsStaff_id);
                          $SchoolNewsDate5 = strval($document5->SchoolNewsDate);

                          $SchoolNewsStaff_id5 = new \MongoDB\BSON\ObjectId($SchoolNewsStaff_id5);
                          $filter6 = ['_id' => $SchoolNewsStaff_id5];
                          $query6 = new MongoDB\Driver\Query($filter6);
                          $cursor6 = $GoNGetzDatabase->executeQuery('GoNGetz.Consumer', $query6);
                          foreach ($cursor6 as $document6)
                          {
                          $ConsumerFName6 = ($document6->ConsumerFName);
                          $ConsumerLName6 = ($document6->ConsumerLName);
                          ?>
                          <div class="card-body">
                              <div class="spacing-right">
                                      <div class="row">
                                          <div class="col-lg-5">
                                              <div class="col-lg-1">
                                              </div>
                                              <div class="col-lg-11">
                                                  <img class="img-round-small" src="//a.disquscdn.com/1617742046/images/noavatar92.png">
                                                  <small href="#" style="text-decoration: none;"></small>
                                                  <span ><?php echo $schoolNewsDetails5; ?></span>
                                              </div>
                                          </div>
                                      </div>
                              </div>
                          </div>
                          <?php
                              }
                          }
                          ?>
                          <div class="card-body">
                              <form name="AddNewsCommentChild" action="index.php?page=newsdetail&id=<?php echo $_GET['id'];?>" method="post">
                                  <div class="row">
                                      <textarea class="basic-example2" name="txtdetail" placeholder="Join, the discussion..."></textarea>
                                      <div class="col-lg-12">
                                          <div class="row">
                                              <div class="col-lg-10">
                                              </div>
                                              <div class="col-lg-2">
                                                  <button type="submit" class="btn btn-secondary" name="AddNewsCommentChild">Post as <?php echo $_SESSION["loggeduser_consumerFName"];?></button>
                                              </div>
                                          </div>
                                      </div>
                                  </div>
                              </form>
                          </div>
                          
                      </div>
                  </div>
              </div>
          </div>
      </div>
      <?php 
      }
    }
      ?>
    </div>
    </div>
  <div class="col-md-1 section-1-box wow fadeInUp"></div>
</div>