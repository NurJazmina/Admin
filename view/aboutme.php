<!-- selection-->
<br><br><br><div class="nav justify-content-center">
  <a class="nav-link active" id="v-pills-profile-tab"  data-bs-toggle="pill" href="#v-pills-profile" role="tab" aria-controls="v-pills-profile" aria-selected="true"><h5 style="font-weight:normal; color:darkslategray; text-decoration:none;">PROFILE</h5></a>
  <h5 style="font-weight:normal; color:darkslategray"></h5>
  <a class="nav-link" id="v-pills-attendance-tab" data-bs-toggle="pill" href="#v-pills-attendance" role="tab" aria-controls="v-pills-attendance" aria-selected="false"><h5 style="font-weight:normal; color:darkslategray; text-decoration:none;">ATTENDANCE</h5></a>
  <h5 style="font-weight:normal; color:darkslategray"></h5>
  <a class="nav-link" id="v-pills-remark-tab" data-bs-toggle="pill" href="#v-pills-remark" role="tab" aria-controls="v-pills-remark" aria-selected="false"><h5 style="font-weight:normal; color:darkslategray; text-decoration:none;">REMARKS</h5></a>
  <h5 style="font-weight:normal; color:darkslategray"></h5>
</div>
<div class="tab-content" id="v-pills-tabContent">
    <!--tab all profile -->
    <div class="tab-pane fade show active" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
    <div class="myDiv" style="color:#696969;text-align:center"><br><h1>About Me</h1></div>
    <div class="table-responsive">
    <table class="table table-bordered table-sm">
      <thead class="table-light">
      </thead>
      <tbody>
        <tr>
          <th scope="row" class="table-secondary">Name</th>
          <td class="table-secondary"><?php echo $_SESSION["loggeduser_consumerFName"]," ",$_SESSION["loggeduser_consumerLName"] ?></td>
        </tr>
        <tr>
        <th scope="row">ID Type</th>
        <td><?php echo $_SESSION["loggeduser_consumerIDType"] ?></td>
        </tr>
        <tr>
          <th scope="row">ID Number</th>
            <td><?php echo $_SESSION["loggeduser_consumerIDNo"] ?></td>
        </tr>
        <tr>
          <th scope="row">Email</th>
        <td><?php echo $_SESSION["loggeduser_consumerEmail"] ?></td>
        </tr>
        <tr>
          <th scope="row">Phone Number</th>
          <td><?php echo $_SESSION["loggeduser_consumerPhone"] ?></td>
        </tr>
        <tr>
          <th scope="row">Address</th>
          <td><?php echo $_SESSION["loggeduser_consumerAddress"] ?></td>
        </tr>
        <tr>
          <th scope="row">Status</th>
          <td><?php echo $_SESSION["loggeduser_consumerStatus"] ?></td>
        </tr>
        <tr>
          <th scope="row">Update</th>
          <td>
            <button type="button"  class="btn btn-success" data-bs-toggle="modal" data-bs-target="#EditDetailModal">
            <i class="fa fa-edit" style="font-size:20px"></i>
            </button>
          </td>
        </tr>
      </tbody>
    </table>
    </div>
    </div>
    <!--end tab -->

    <!--tab by attendance -->
    <div class="tab-pane fade" id="v-pills-attendance" role="tabpanel" aria-labelledby="v-pills-attendance-tab">
      <div class="myDiv" style="color:#696969;text-align:center"><br><br><br><h1>Attendance</h1></div><br>
          <?php
          $vardate = new MongoDB\BSON\UTCDateTime((new DateTime('now'))->getTimestamp()*1000);
          $date = $vardate->toDateTime()->setTimezone(new \DateTimeZone(date_default_timezone_get()));
          $id = new \MongoDB\BSON\ObjectId($_SESSION["loggeduser_id"]);
          $filter = ['_id'=>$id];
          $query = new MongoDB\Driver\Query($filter);
          $cursor = $GoNGetzDatabase->executeQuery('GoNGetz.Consumer',$query);
          foreach ($cursor as $document){
            $_SESSION["studentremarkid"] = strval($document->_id);
            $ConsumerFName = ($document->ConsumerFName);
            $ConsumerLName = ($document->ConsumerLName);
            $ConsumerIDNo = ($document->ConsumerIDNo);
          }
          ?>
          <div class="row">
          <div class="col-md-1 section-1-box wow fadeInUp"></div>
          <div class="col-md-10 section-1-box wow fadeInUp"><br><br><br>
              <div class="table-responsive" style="text-align: center;">
                <table id="attendance" class="table table-bordered ">
                <thead class="table-light">
                    <tr>
                    <th scope="col" style="color:#696969; text-align:center">Student ID</th>
                    <th scope="col" style="color:#696969; text-align:center">Student Name</th>
                    <th scope="col" style="color:#696969; text-align:center">Date</th>
                    <th scope="col" style="color:#696969; text-align:center">IN</th>
                    <th scope="col" style="color:#696969; text-align:center">OUT</th>
                    </tr>
                </thead>
                <tbody>
                <tr>
                    <td style="text-align:center"><?php echo "<br>".$ConsumerIDNo; ?></td>
                    <td style="text-align:center"><?php echo "<br>".$ConsumerFName." ".$ConsumerLName; ?></td>
                    <td style="text-align:center">
                <?php
                $Cards_id='';
                $filter1 = ['Consumer_id'=>$_SESSION["loggeduser_id"]];
                $query1 = new MongoDB\Driver\Query($filter1);
                $cursor1 = $GoNGetzDatabase->executeQuery('GoNGetz.Cards',$query1);
                foreach ($cursor1 as $document1)
                {
                $Cards_id = strval($document1->Cards_id);
                }
                /*
                check date
                $convert = $from_date->toDateTime()->setTimezone(new \DateTimeZone(date_default_timezone_get()));
                echo "<br>to_date: ".$to_date."<br>";
                echo "from_date: ".$from_date."<br>";
                $display = date_format($convert,"d/m/Y");
                echo $display;
                */
                $to_date = new MongoDB\BSON\UTCDateTime((new DateTime('now'))->getTimestamp()*1000);
                $from_date = new MongoDB\BSON\UTCDateTime((new DateTime('now -1 month'))->getTimestamp()*1000);

                $filter2 = ['CardID'=>$Cards_id ,'AttendanceDate' => ['$gte' => $from_date,'$lte' => $to_date]];
                $query2 = new MongoDB\Driver\Query($filter2);
                $cursor2 = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Attendance',$query2);
                $varcounting = 0;
                
                foreach ($cursor2 as $document2)
                {
                  $AttendanceDate = ($document2->AttendanceDate);
                  $utcdatetime = new MongoDB\BSON\UTCDateTime(strval($AttendanceDate));
                  $AttendanceDate = $utcdatetime->toDateTime()->setTimezone(new \DateTimeZone(date_default_timezone_get()));
                  $varcounting = $varcounting +1;
                  if ($varcounting % 2)
                  {
                  } 
                  else 
                  {
                    echo "<br>".date_format($AttendanceDate,"d-m-Y");
                  }
                }
                ?>
                </td>
                <td style="text-align:center">
                <?php
                $varcounting = 0;
                $filterA = ['CardID'=>$Cards_id ,'AttendanceDate' => ['$gte' => $from_date,'$lte' => $to_date]];
                $optionA = ['sort' => ['_id' => 1]];
                $queryA = new MongoDB\Driver\Query($filterA,$optionA);
                $cursorA = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Attendance',$queryA);
                
                foreach ($cursorA as $documentA)
                {
                    $AttendanceDate = ($documentA->AttendanceDate);
                    $utcdatetime = new MongoDB\BSON\UTCDateTime(strval($AttendanceDate));
                    $AttendanceDate = $utcdatetime->toDateTime()->setTimezone(new \DateTimeZone(date_default_timezone_get()));
                    $varcounting = $varcounting +1;

                if ($varcounting % 2)
                {
                    echo date_format($AttendanceDate,"H:i:s")."<br>";
                } 
                else
                {
                }
                }
                ?>
                </td>
                <td style="text-align:center">
                <?php
                $varcounting = 0;
                $filterA = ['CardID'=>$Cards_id ,'AttendanceDate' => ['$gte' => $from_date,'$lte' => $to_date]];
                $optionA = ['sort' => ['_id' => 1]];
                $queryA = new MongoDB\Driver\Query($filterA,$optionA);
                $cursorA = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Attendance',$queryA);
                
                foreach ($cursorA as $documentA)
                {
                    $AttendanceDate = ($documentA->AttendanceDate);
                    $utcdatetime = new MongoDB\BSON\UTCDateTime(strval($AttendanceDate));
                    $AttendanceDate = $utcdatetime->toDateTime()->setTimezone(new \DateTimeZone(date_default_timezone_get()));
                    $varcounting = $varcounting +1;

                if ($varcounting % 2)
                {
                } 
                else
                {
                    echo date_format($AttendanceDate,"H:i:s")."<br>";
                }
                ?>
                <?php
                }
                ?>
                </td>
                </tr>
          </tbody>
          </table>
          <button type="button" style="font-size:15px width:25%" class="btn btn-success"><a href="index.php?page=exportstudentattendance&id=<?php echo $_GET['id']; ?>&attendance=<?php echo "xls"; ?>" tabindex="-1" data-type="alpha" style="color:#FFFFFF; text-decoration: none;">EXPORT ATTENDANCE TO XLS</a></button>
        </div>
        </div>
        <div class="col-md-1 section-1-box wow fadeInUp"></div>
        </div>
      <?php
      if (!isset($_GET['attendance']) && empty($_GET['attendance']))
      {

      }
      else
      {
      $attendance = ($_GET['attendance']);
      ?>
      <script>
        $(document).ready(function () {
          $("#attendance").table2excel({
              filename: "attendancestudent.xls"
          });
        });
        
      </script>
      <?php
      }
      ?>
    </div>
    <!-- end tab -->

    <!--tab by remark -->
    <div class="tab-pane fade" id="v-pills-remark" role="tabpanel" aria-labelledby="v-pills-remark-tab">
      <div class="myDiv" style="color:#696969;text-align:center"><br><br><br><h1>Remarks</h1></div><br>
      <div class="table-responsive">
        <table class="table table-bordered table-sm">
          <thead class="table-light">
          </thead>
          <tbody>
            <tr>
              <th scope="row" class="table-secondary">Name</th>
              <td class="table-secondary"><?php echo $_SESSION["loggeduser_consumerFName"]," ",$_SESSION["loggeduser_consumerLName"] ?></td>
            </tr>
            <tr>
              <th scope="row">Date</th>
              <td><?php ?></td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
    <!-- end tab -->
</div>


