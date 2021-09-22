<?php
$_SESSION["title"] = "Re-checking";
include 'view/partials/_subheader/subheader-v1.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require_once "vendor/autoload.php";

if (isset($_POST['recheck_add_staff']))
{
  $consumer_idno = $_POST['consumer_idno'];
  $department_id = $_POST['department_id'];
  $staff_level = $_POST['staff_level'];

  // start : email blaster
  $Date = new MongoDB\BSON\UTCDateTime((new DateTime('now'))->getTimestamp()*1000);
  $Date = new MongoDB\BSON\UTCDateTime(strval($Date));
  $Date_time = $Date->toDateTime()->setTimezone(new \DateTimeZone(date_default_timezone_get()));
  $Date = date_format($Date_time,"d M Y");

  $school_id = $_SESSION["loggeduser_school_id"];
  $FromNameF = $_SESSION["loggeduser_consumerFName"];
  $FromNameL = $_SESSION["loggeduser_consumerLName"];
  $FromconsumerIDNo = $_SESSION["loggeduser_consumerIDNo"];
  $FromconsumerIDType = $_SESSION["loggeduser_consumerIDType"];
  
  $SchoolName = $_SESSION["loggeduser_schoolName"];
  $SchoolEmail = $_SESSION["loggeduser_SchoolsEmail"];
  $SchoolPhone = $_SESSION["loggeduser_schoolsPhoneNo"];
  $SchoolAddress = $_SESSION["loggeduser_schoolsAddress"];

  $consumer_id = '';
  $ConsumerGroup_id = '';
  $filter = ['ConsumerIDNo'=>$consumer_idno];
  $query = new MongoDB\Driver\Query($filter);
  $cursor = $GoNGetzDatabase->executeQuery('GoNGetz.Consumer',$query);
  foreach ($cursor as $document)
  {
    $consumer_id = strval($document->_id);
    $ConsumerFName = $document->ConsumerFName;
    $ConsumerLName = $document->ConsumerLName;
    $ConsumerIDType = $document->ConsumerIDType;
    $ConsumerIDNo = $document->ConsumerIDNo;
    $ConsumerGroup_id = $document->ConsumerGroup_id;
    $Email = $document->ConsumerEmail;

    if($Email != "")
    {
      //PHPMailer Object
      $mail = new PHPMailer(true);
      $mail->SMTPOptions = array(
          'ssl' => array(
              'verify_peer' => false,
              'verify_peer_name' => false,
              'allow_self_signed' => true
          )
      );
      //Argument true in constructor enables exceptions
      //$mail->SMTPDebug = 2;
      $mail->isSMTP();
      $mail->Host = 'mail.gongetz.com';
      $mail->SMTPAuth = true;
      $mail->Username = 'noreply@gongetz.com'; 

      //paste one generated by Mailtrap
      $mail->Password = 'zaq12wsx'; 

      //paste one generated by Mailtrap
      $mail->SMTPSecure = 'tls';
      $mail->AuthType = 'PLAIN';
      $mail->Port = 25;

      //From email address and name
      $mail->From =  'noreply@gongetz.com'; 
      $mail->FromName = $SchoolName;

      //To address and name
      $mail->addAddress($Email,$ConsumerFName);

      //Address to which recipient will reply
      $mail->addReplyTo($Email,$ConsumerFName);

      //CC and BCC
      $mail->addCC("gngsoftech@gmail.com");
      
      //Send HTML or Plain Text email
      $mail->isHTML(true);

      $mail->Subject = "$SchoolName";
      $mail->Body ="
      <html>
        <head>
          <meta name='viewport' content='width=device-width'>
          <meta http-equiv='Content-Type' content='text/html; charset=UTF-8'>
          <title>Simple Transactional Email</title>
          <style>
          /* -------------------------------------
              INLINED WITH htmlemail.io/inline
          ------------------------------------- */
          /* -------------------------------------
              RESPONSIVE AND MOBILE FRIENDLY STYLES
          ------------------------------------- */
          @media only screen and (max-width: 620px) {
            table[class=body] h1 {
              font-size: 28px !important;
              margin-bottom: 10px !important;
            }
            table[class=body] p,
                  table[class=body] ul,
                  table[class=body] ol,
                  table[class=body] td,
                  table[class=body] span,
                  table[class=body] a {
              font-size: 16px !important;
            }
            table[class=body] .wrapper,
                  table[class=body] .article {
              padding: 10px !important;
            }
            table[class=body] .content {
              padding: 0 !important;
            }
            table[class=body] .container {
              padding: 0 !important;
              width: 100% !important;
            }
            table[class=body] .main {
              border-left-width: 0 !important;
              border-radius: 0 !important;
              border-right-width: 0 !important;
            }
            table[class=body] .btn table {
              width: 100% !important;
            }
            table[class=body] .btn a {
              width: 100% !important;
            }
            table[class=body] .img-responsive {
              height: auto !important;
              max-width: 100% !important;
              width: auto !important;
            }
          }
  
          /* -------------------------------------
              PRESERVE THESE STYLES IN THE HEAD
          ------------------------------------- */
          @media all {
            .ExternalClass {
              width: 100%;
            }
            .ExternalClass,
                  .ExternalClass p,
                  .ExternalClass span,
                  .ExternalClass font,
                  .ExternalClass td,
                  .ExternalClass div {
              line-height: 100%;
            }
            .apple-link a {
              color: inherit !important;
              font-family: inherit !important;
              font-size: inherit !important;
              font-weight: inherit !important;
              line-height: inherit !important;
              text-decoration: none !important;
            }
            #MessageViewBody a {
              color: inherit;
              text-decoration: none;
              font-size: inherit;
              font-family: inherit;
              font-weight: inherit;
              line-height: inherit;
            }
            .btn-primary table td:hover {
              background-color: #34495e !important;
            }
            .btn-primary a:hover {
              background-color: #34495e !important;
              border-color: #34495e !important;
            }
          }
          </style>
        </head>
        <body class='' style='background-color: #f6f6f6; font-family: sans-serif; -webkit-font-smoothing: antialiased; font-size: 14px; line-height: 1.4; margin: 0; padding: 0; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%;'>
          <span class='preheader' style='color: transparent; display: none; height: 0; max-height: 0; max-width: 0; opacity: 0; overflow: hidden; mso-hide: all; visibility: hidden; width: 0;'> You got this email because you're a member of.. </span>
          <table border='0' cellpadding='0' cellspacing='0' class='body' style='border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%; background-color: #f6f6f6;'>
            <tr>
              <td style='font-family: sans-serif; font-size: 14px; vertical-align: top;'>&nbsp;</td>
              <td class='container' style='font-family: sans-serif; font-size: 14px; vertical-align: top; display: block; Margin: 0 auto; max-width: 580px; padding: 10px; width: 580px;'>
                <div class='content' style='box-sizing: border-box; display: block; Margin: 0 auto; max-width: 580px; padding: 10px;'>
  
                  <!-- START CENTERED WHITE CONTAINER -->
                  <table class='main' style='border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%; background: #ffffff; border-radius: 3px;'>
  
                    <!-- START MAIN CONTENT AREA -->
                    <tr>
                      <td class='wrapper' style='font-family: sans-serif; font-size: 14px; vertical-align: top; box-sizing: border-box; padding: 20px;'>
                        <table border='0' cellpadding='0' cellspacing='0' style='border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%;'>
                          <tr>
                            <td style='font-family: sans-serif; font-size: 14px; vertical-align: top;'>
                              <p style='font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; Margin-bottom: 15px;'> 
                                <p>Hi </p><a href='https://smartschool.gongetz.com/profile.php?id=$ConsumerIDNo'>$ConsumerFName $ConsumerLName</a>,
                                <p>your personal data has been exposed  to <a href='https://smartschool.gongetz.com/profile.php?id=$FromconsumerIDNo'>$FromNameF $FromNameL</a> with $FromconsumerIDType $FromconsumerIDNo on $Date. If you found out this is an error, kindly contact:
                                  <ul>
                                      <li><a href='https://smartschool.gongetz.com/school.php?id=$school_id'>$SchoolName</a></li>
                                      <li>Phone: $SchoolPhone</li>
                                      <li>Email: $SchoolEmail</li>
                                      <li>Address: $SchoolAddress</li>
                                  </ul>
                                </p>
                                <p>Thanks,<br/>
                                <p>Go N Getz</p>
                                <p><small>Please don't reply to this email, it won't go anyway except to our great black hole.</small></p>
                              </p>
                              <table border='0' cellpadding='0' cellspacing='0' class='btn btn-primary' style='border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%; box-sizing: border-box;'>
                                <tbody>
                                  <tr>
                                    <td align='left' style='font-family: sans-serif; font-size: 14px; vertical-align: top; padding-bottom: 15px;'>
                                      <table border='0' cellpadding='0' cellspacing='0' style='border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: auto;'>
                                        <tbody>
                                          <tr>
                                          </tr>
                                        </tbody>
                                      </table>
                                    </td>
                                  </tr>
                                </tbody>
                              </table>
                            </td>
                          </tr>
                        </table>
                      </td>
                    </tr>
                  <!-- END MAIN CONTENT AREA -->
                  </table>
  
                  <!-- START FOOTER -->
                  <div class='footer' style='clear: both; Margin-top: 10px; text-align: center; width: 100%;'>
                    <table border='0' cellpadding='0' cellspacing='0' style='border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%;'>
                      <tr>
                        <td class='content-block' style='font-family: sans-serif; vertical-align: top; padding-bottom: 10px; padding-top: 10px; font-size: 12px; color: #999999; text-align: center;'>
                          <span class='apple-link' style='color: #999999; font-size: 12px; text-align: center;'>G&G Softech Sdn Bhd, 75-1, jalan pudu lama, 50200, wilayah persekutuan, kuala lumpur</span>
                          <br> Don't like these emails? <a href='mailto:care@gongetz.com' class='btn btn-danger btn-sm'>Report Spam</a>.
                        </td>
                      </tr>
                      <tr>
                        <td class='content-block powered-by' style='font-family: sans-serif; vertical-align: top; padding-bottom: 10px; padding-top: 10px; font-size: 12px; color: #999999; text-align: center;'>
                        <a href='' style='color: #999999; font-size: 12px; text-align: center; text-decoration: none;'>gongetz.com</a>.
                        </td>
                      </tr>
                    </table>
                  </div>
                  <!-- END FOOTER -->
  
                <!-- END CENTERED WHITE CONTAINER -->
                </div>
              </td>
              <td style='font-family: sans-serif; font-size: 14px; vertical-align: top;'>&nbsp;</td>
            </tr>
          </table>
        </body>
      </html>";
      $mail->AltBody = "This is the plain text version of the email content";
      try { $mail->send();} 
      catch (Exception $e) { echo "Mailer Error: " . $mail->ErrorInfo;}
    }
  }
  // end : email blaster
  $staff_id = '';
  $filter = ['ConsumerID'=>$consumer_id];
  $query = new MongoDB\Driver\Query($filter);
  $cursor =$GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Staff',$query);
  foreach ($cursor as $document)
  {
    $staff_id = strval($document->_id);
    $Staffdepartment = $document->Staffdepartment;

    $filter = ['_id'=>new \MongoDB\BSON\ObjectId($Staffdepartment)];
    $query = new MongoDB\Driver\Query($filter);
    $cursor =$GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.SchoolsDepartment',$query);
    foreach ($cursor as $document)
    {
      $DepartmentName = $document->DepartmentName;
    }
  }

  if($staff_id !== '')
  {
    ?>
    <!-- redundant data -->
    <div class="text-dark-50 text-center">
      <h1>STAFF ALREADY EXIST</h1>
    </div>
    <form action="index.php?page=staffdetail&id=<?= $consumer_id; ?>" method="post">
      <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Add Staff</h5>
          </div>
          <div class="modal-body">
            <div class="form-group row">
              <label class="col-sm-2 col-form-label">Staff Name</label>
              <div class="col-sm-10">
                <input class="form-control" value="<?= $ConsumerFName." ".$ConsumerLName; ?>" disabled>
              </div>
            </div>
            <div class="form-group row">
              <label class="col-sm-2 col-form-label">MyKad</label>
              <div class="col-sm-10">
                <input class="form-control" value="<?= $ConsumerIDNo; ?>" disabled>
              </div>
            </div>
            <div class="form-group row">
              <label class="col-sm-2 col-form-label">Group</label>
              <div class="col-sm-10">
                <input class="form-control" value="SCHOOL" disabled>
              </div>
            </div>
            <div class="form-group row">
              <label class="col-sm-2 col-form-label">Department</label>
              <div class="col-sm-10">
                <input class="form-control" value="<?= $DepartmentName; ?>" disabled>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button class="btn btn-success btn-hover-light btn-sm">Resume Staff Detail</button>
          </div>
        </div>
      </div>
    </form>
     <!-- redundant data -->
    <?php
  }
  elseif ($staff_id == '')
  {
    if($ConsumerGroup_id == '601b4cfd97728c027c01f187' || $ConsumerGroup_id == '6018c2ebc8c7c7b2e8a4140c') //school && parent
    {
      ?>
      <!-- group : school -->
      <div class="text-dark-50 text-center">
        <h1>PLEASE CONFIRM BEFORE PROCEED</h1>
      </div>
      <form name="add_staff" action="index.php?page=stafflist" method="post">
        <div class="modal-dialog modal-lg modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Add Staff</h5>
            </div>
            <div class="modal-body">
              <div class="form-group row">
                <label class="col-sm-2 col-form-label">Staff Name</label>
                <div class="col-sm-10">
                  <input class="form-control" value="<?= $ConsumerFName." ".$ConsumerLName; ?>" disabled>
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-2 col-form-label">MyKad</label>
                <div class="col-sm-10">
                  <input class="form-control" value="<?= $ConsumerIDNo; ?>" disabled>
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-2 col-form-label">Group</label>
                <div class="col-sm-10">
                  <input class="form-control" value="SCHOOL" disabled>
                </div>
              </div>
              <?php
              if ($staff_level == '0')
              {
                $class_category = $_POST['class_category'];

                if($class_category == '')
                {
                  ?>
                  <!-- teacher :: not assign -->
                  <input type="hidden" name="class_id" value="">
                  <!-- teacher :: not assign -->
                  <?php
                }
                else
                {
                  ?>
                  <!-- teacher :: assign -->
                    <div class="form-group row">
                      <label class="col-sm-2 col-form-label">Class category</label>
                      <div class="col-sm-10">
                        <input class="form-control" value="<?= $class_category; ?>" disabled>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-sm-2 col-form-label">Class</label>
                      <div class="col-sm-10">
                        <select class="form-control" name="class_id">
                        <?php
                        $class_id = '';
                        $filter = ['SchoolID'=>$school_id,'ClassCategory'=>$class_category];
                        $query = new MongoDB\Driver\Query($filter);
                        $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Classrooms',$query);
                        foreach ($cursor as $document1)
                        {
                          $class_id = $document1->_id;
                          $ClassName = $document1->ClassName;
                          ?>
                          <option value="<?= $class_id; ?>"><?= $ClassName; ?></option>
                          <?php
                        }
                        ?>
                        </select>
                      </div>
                    </div>
                  <!-- teacher :: assign -->
                  <?php
                }
              }
              elseif ($staff_level == '1')
              {
                ?>
                <!-- staff -->
                <input type="hidden" name="class_id" value="">
                <!-- staff -->
                <?php
              }
              ?>
            </div>
            <div class="modal-footer">
              <input type="hidden" name="consumer_id" value="<?=  $consumer_id; ?>">
              <input type="hidden" name="department_id" value="<?=  $department_id; ?>">
              <input type="hidden" name="staff_level" value="<?=  $staff_level; ?>">
              <button onclick="index.php?page=stafflist" class="btn btn-light btn-sm">Cancel</button>
              <button type="submit" class="btn btn-success btn-sm" name="add_staff">Confirm</button>
            </div>
          </div>
        </div>
      </form>
      <!-- group : school -->
      <?php
    }
    elseif($ConsumerGroup_id == '6018c32b10184a751c102eb6')//student && gongetz
    {
      ?>
      <!-- group : staff/student/gongetz -->
      <div class="text-dark-50 text-center">
        <h1>AUTHORIZED PERSONNEL ONLY</h1>
      </div>
      <form action="index.php?page=studentdetail&id=<?= $consumer_id; ?>" method="post">
        <div class="modal-dialog modal-lg modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Add Staff</h5>
            </div>
            <div class="modal-body">
              <div class="form-group row">
                <label class="col-sm-2 col-form-label">Consumer Name</label>
                <div class="col-sm-10">
                  <input class="form-control" value="<?= $ConsumerFName." ".$ConsumerLName; ?>" disabled>
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-2 col-form-label">MyKad</label>
                <div class="col-sm-10">
                  <input class="form-control" value="<?= $ConsumerIDNo; ?>" disabled>
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
      <!-- group : vip -->
      <?php
    }
    else 
    {
      ?>
      <!-- group : vip/student/gongetz -->
      <div class="text-dark-50 text-center">
        <h1>AUTHORIZED PERSONNEL ONLY</h1>
      </div>
      <form action="index.php?page=stafflist" method="post">
        <div class="modal-dialog modal-lg modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Add Staff</h5>
            </div>
            <div class="modal-body">
              <div class="form-group row">
                <label class="col-sm-2 col-form-label">ID Number</label>
                <div class="col-sm-10">
                  <input class="form-control" value="<?= $consumer_idno; ?>" disabled>
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
              <button class="btn btn-success btn-hover-light btn-sm">Return</button>
            </div>
          </div>
        </div>
      </form>
       <!-- group : vip/student/gongetz -->
      <?php
    }
  }
}

if (isset($_POST['recheck_edit_staff']))
{
  $class_category = $_POST['class_category'];
  $consumer_id = $_POST['consumer_id'];
  $school_id = $_SESSION["loggeduser_school_id"];

  $filter = ['_id'=>new \MongoDB\BSON\ObjectId($consumer_id)];
  $query = new MongoDB\Driver\Query($filter);
  $cursor = $GoNGetzDatabase->executeQuery('GoNGetz.Consumer',$query);
  foreach ($cursor as $document)
  {
    $ConsumerFName = $document->ConsumerFName;
    $ConsumerLName = $document->ConsumerLName;
    $ConsumerIDNo = $document->ConsumerIDNo;
  }
  ?>
    <div class="text-dark-50 text-center">
      <h1>PLEASE CONFIRM BEFORE PROCEED</h1>
    </div>
    <form name="edit_staff" action="index.php?page=stafflist" method="post">
      <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Add Staff</h5>
          </div>
          <div class="modal-body">
            <div class="form-group row">
              <label class="col-sm-2 col-form-label">Staff Name</label>
              <div class="col-sm-10">
                <input class="form-control" value="<?= $ConsumerFName." ".$ConsumerLName; ?>" disabled>
              </div>
            </div>
            <div class="form-group row">
              <label class="col-sm-2 col-form-label">MyKad</label>
              <div class="col-sm-10">
                <input class="form-control" value="<?= $ConsumerIDNo; ?>" disabled>
              </div>
            </div>
            <div class="form-group row">
              <label class="col-sm-2 col-form-label">Class category</label>
              <div class="col-sm-10">
                <input class="form-control" value="<?= $class_category; ?>" disabled>
              </div>
            </div>
            <div class="form-group row">
              <label class="col-sm-2 col-form-label">Class</label>
              <div class="col-sm-10">
                <select class="form-control" name="class_id">
                <?php
                $filter = ['SchoolID'=>$school_id,'ClassCategory'=>$class_category];
                $query = new MongoDB\Driver\Query($filter);
                $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Classrooms',$query);
                foreach ($cursor as $document)
                {
                  $class_id = strval($document->_id);
                  $ClassName = $document->ClassName;
                  ?>
                  <option value="<?= $class_id; ?>"><?= $ClassName; ?></option>
                  <?php
                }
                ?>
                </select>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <input type="hidden" name="consumer_id" value="<?=  $consumer_id; ?>">
            <button type="button" class="btn btn-light btn-sm" data-bs-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-success btn-sm" name="edit_staff">Confirm</button>
          </div>
        </div>
      </div>
    </form>
  <?php
}
?>