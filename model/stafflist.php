<?php
  use PHPMailer\PHPMailer\PHPMailer;
  use PHPMailer\PHPMailer\Exception;
  require_once "vendor/autoload.php";

//Add school staff
if (isset($_POST['submitaddstaff']))
{

  $varschoolID = strval($_SESSION["loggeduser_schoolID"]);
  $varConsumerIDNo = $_POST['txtConsumerIDNo'];
  $varStaffdepartment = strval($_SESSION["departmentid"]);
  $varDepartmentName = strval($_SESSION["DepartmentName"]);
  $varStaffstatus = $_POST['txtStaffstatus'];
  $varteacherclass = $_POST['txtteacherclass'];

  $filter = ['ConsumerIDNo'=>$varConsumerIDNo];
  $query = new MongoDB\Driver\Query($filter);
  $cursor = $GoNGetzDatabase->executeQuery('GoNGetz.Consumer',$query);
  foreach ($cursor as $document)
  {
  $ID = strval($document->_id);
  $ConsumerFName = strval($document->ConsumerFName);
  $bulk = new MongoDB\Driver\BulkWrite(['ordered' => TRUE]);
  if ($varDepartmentName !== "TEACHER")
  {
    $bulk->insert([
      'ConsumerID'=>$ID,
      'SchoolID'=> $varschoolID,
      'ClassID'=> "",
      'StaffLevel'=>"1",
      'Staffdepartment'=> $varStaffdepartment,
      'StaffStatus'=>$varStaffstatus]);
  }
  else
  {
    $bulk->insert([
      'ConsumerID'=>$ID,
      'SchoolID'=> $varschoolID,
      'ClassID'=> $varteacherclass,
      'StaffLevel'=>"0",
      'Staffdepartment'=> $varStaffdepartment,
      'StaffStatus'=>$varStaffstatus]);
  }
  $writeConcern = new MongoDB\Driver\WriteConcern(MongoDB\Driver\WriteConcern::MAJORITY, 1000);
  try
  {
    $result=$GoNGetzDatabase->executeBulkWrite('GoNGetzSmartSchool.Staff', $bulk, $writeConcern);
  }
  catch (MongoDB\Driver\Exception\BulkWriteException $e)
  {
    $result = $e->getWriteResult();
    // Check if the write concern could not be fulfilled
    if ($writeConcernError = $result->getWriteConcernError())
    {
        printf("%s (%d): %s\n",
            $writeConcernError->getMessage(),
            $writeConcernError->getCode(),
            var_export($writeConcernError->getInfo(), true)
        );
    }
    // Check if any write operations did not complete at all
    foreach ($result->getWriteErrors() as $writeError)
    {
        printf("Operation#%d: %s (%d)\n",
            $writeError->getIndex(),
            $writeError->getMessage(),
            $writeError->getCode()
        );
    }
  }
  catch (MongoDB\Driver\Exception\Exception $e)
  {
    printf("Other error: %s\n", $e->getMessage());
    exit;
  }
  printf("Matched: %d\n", $result->getMatchedCount());
  printf("Updated  %d document(s)\n", $result->getModifiedCount());
  }
}

//Edit school staff
if (isset($_POST['submiteditstaff']))
{
  $TeacherClass = $_POST['txtteacherclass'];
  $Classcategory = $_POST['txtClasscategory'];
  $Teacherid = $_POST['teacherid'];

  $bulk = new MongoDB\Driver\BulkWrite(['ordered' => TRUE]);
  $bulk->update(['ConsumerID'=> $Teacherid],
                ['$set' => ['ClassID'=>$TeacherClass]],
                ['upsert' => TRUE]
               );
  $writeConcern = new MongoDB\Driver\WriteConcern(MongoDB\Driver\WriteConcern::MAJORITY, 1000);

  try
  {
    $result=$GoNGetzDatabase->executeBulkWrite('GoNGetzSmartSchool.Staff', $bulk, $writeConcern);
  }
  catch (MongoDB\Driver\Exception\BulkWriteException $e)
  {
    $result = $e->getWriteResult();
    // Check if the write concern could not be fulfilled
    if ($writeConcernError = $result->getWriteConcernError())
    {
        printf("%s (%d): %s\n",
            $writeConcernError->getMessage(),
            $writeConcernError->getCode(),
            var_export($writeConcernError->getInfo(), true)
        );
    }
    foreach ($result->getWriteErrors() as $writeError)
    {
        printf("Operation#%d: %s (%d)\n",
            $writeError->getIndex(),
            $writeError->getMessage(),
            $writeError->getCode()
        );
    }
  }
  catch (MongoDB\Driver\Exception\Exception $e)
  {
    printf("Other error: %s\n", $e->getMessage());
    exit;
  }
  printf("Matched: %d\n", $result->getMatchedCount());
  printf("Updated  %d document(s)\n", $result->getModifiedCount());

  $Teacherclass = new \MongoDB\BSON\ObjectId($TeacherClass);
  $filter1 = ['_id'=>$Teacherclass];
  $query1 = new MongoDB\Driver\Query($filter1);
  $cursor1 =$GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Classrooms',$query1);
  foreach ($cursor1 as $document1)
  {
    $ClassCategoryNew = strval($document1->ClassCategory);
    $ClassNameNew = strval($document1->ClassName);
  }

  $FromNameF = strval($_SESSION["loggeduser_consumerFName"]);
  $FromNameL = strval($_SESSION["loggeduser_consumerLName"]);
  $SchoolName = strval($_SESSION["loggeduser_schoolName"]);
  $SchoolEmail = strval($_SESSION["loggeduser_SchoolsEmail"]);

  $Teacherid = new \MongoDB\BSON\ObjectId($Teacherid);
  $filter = ['_id'=>$Teacherid];
  $query = new MongoDB\Driver\Query($filter);
  $cursor = $GoNGetzDatabase->executeQuery('GoNGetz.Consumer',$query);

  foreach ($cursor as $document)
  {
    $ConsumerFName = strval($document->ConsumerFName);
    $ConsumerLName = strval($document->ConsumerLName);
    $Email = strval($document->ConsumerEmail);

    if($Email != "")
    {
      $Email = strval($document->ConsumerEmail);

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

      $mail->Subject = "$SchoolName  - Your Classroom has been changed";
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
                              <p>Hi $ConsumerFName $ConsumerLName,</p>
                              <p>An Admin($FromNameF $FromNameL) has updated your classroom name.</p>
                              <p>The previous classroom has been changed to  <span style='color:blue;font-weight:bold'>$ClassCategoryNew $ClassNameNew</span>. If you think this change was made in error, please contact your workspace admin. Thanks</p>
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
    </html>
    ";
    $mail->AltBody = "This is the plain text version of the email content";

    try { $mail->send();} 

    catch (Exception $e) { echo "Mailer Error: " . $mail->ErrorInfo;}
  }
}

}

//Change status school staff
if (isset($_POST['StatusStaffFormSubmit']))
{

  $varstaffid = $_POST['txtstaffid'];
  $varStaffStatus = $_POST['txtStaffStatus'];
  $varConsumerRemarksDetails = $_POST['txtConsumerRemarksDetails'];

  $bulk = new MongoDB\Driver\BulkWrite(['ordered' => TRUE]);
  $bulk->update(['ConsumerID'=>$varstaffid],
                ['$set' => ['StaffStatus'=>$varStaffStatus]],
                ['upsert' => TRUE]
               );
  $writeConcern = new MongoDB\Driver\WriteConcern(MongoDB\Driver\WriteConcern::MAJORITY, 1000);
  $result =$GoNGetzDatabase->executeBulkWrite('GoNGetzSmartSchool.Staff', $bulk, $writeConcern);

  $varstaffremark = strval($_SESSION["loggeduser_id"]);
  $varschoolid = strval($_SESSION["loggeduser_schoolID"]);
  $varconsumerremarkdate = new MongoDB\BSON\UTCDateTime((new DateTime('now'))->getTimestamp()*1000);

  $bulk1 = new MongoDB\Driver\BulkWrite(['ordered'=>true]);
  $bulk1->insert([
    'SubRemarks'=>'0',
    'Consumer_id'=>$varstaffid,
    'ConsumerRemarksDetails'=>$varConsumerRemarksDetails,
    'ConsumerRemarksStaff_id'=>$varstaffremark,
    'school_id'=>$varschoolid,
    'ConsumerRemarksDate'=>$varconsumerremarkdate,
    'ConsumerRemarksStatus'=>'ACTIVE']);

  $writeConcern = new MongoDB\Driver\WriteConcern(MongoDB\Driver\WriteConcern::MAJORITY, 1000);
  try
  {
    $result =$GoNGetzDatabase->executeBulkWrite('GoNGetzSmartSchool.StaffRemarks', $bulk1, $writeConcern);
  }
  catch (MongoDB\Driver\Exception\BulkWriteException $e)
  {
    $result = $e->getWriteResult();
    // Check if the write concern could not be fulfilled
    if ($writeConcernError = $result->getWriteConcernError())
    {
        printf("%s (%d): %s\n",
            $writeConcernError->getMessage(),
            $writeConcernError->getCode(),
            var_export($writeConcernError->getInfo(), true)
        );
    }
    // Check if any write operations did not complete at all
    foreach ($result->getWriteErrors() as $writeError)
    {
        printf("Operation#%d: %s (%d)\n",
            $writeError->getIndex(),
            $writeError->getMessage(),
            $writeError->getCode()
        );
    }
  }
  catch (MongoDB\Driver\Exception\Exception $e)
  {
    printf("Other error: %s\n", $e->getMessage());
    exit;
  }

  $FromNameF = strval($_SESSION["loggeduser_consumerFName"]);
  $FromNameL = strval($_SESSION["loggeduser_consumerLName"]);
  $SchoolName = strval($_SESSION["loggeduser_schoolName"]);
  $SchoolEmail = strval($_SESSION["loggeduser_SchoolsEmail"]);

  $varstaffid = new \MongoDB\BSON\ObjectId($varstaffid);
  $filter = ['_id'=>$varstaffid];
  $query = new MongoDB\Driver\Query($filter);
  $cursor = $GoNGetzDatabase->executeQuery('GoNGetz.Consumer',$query);

  foreach ($cursor as $document)
  {
    $ConsumerFName = strval($document->ConsumerFName);
    $ConsumerLName = strval($document->ConsumerLName);
    $Email = strval($document->ConsumerEmail);

    if($Email != "")
    {
      $Email = strval($document->ConsumerEmail);

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

      $mail->Subject = "$SchoolName  - Your Status has been changed";
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
                              <p>Hi $ConsumerFName $ConsumerLName,</p>
                              <p>An Admin($FromNameF $FromNameL) has updated your Status.</p>
                              <p>The previous Status has been changed to  <span style='color:red;font-weight:bold'> $varStaffStatus </span> because of <span style='font-weight:bold'>$varConsumerRemarksDetails</span> . If you think this change was made in error, please contact your workspace admin. Thanks</p>
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
    </html>
    ";
    $mail->AltBody = "This is the plain text version of the email content";

    try { $mail->send();} 

    catch (Exception $e) { echo "Mailer Error: " . $mail->ErrorInfo;}
  }
}

}

if (isset($_GET['paging']) && !empty($_GET['paging']))
{
  $datapaging = ($_GET['paging']*50);
  $pagingprevious = $_GET['paging']-1;
  $pagingnext = $_GET['paging']+1;
}
else
{
  $datapaging = 0;
  $pagingnext = 1;
  $pagingprevious = 0;
}

if (!isset($_POST['searchstaff']) && empty($_POST['searchstaff']))
{
  //sorting by category
  if (!isset($_GET['level']) && empty($_GET['level']))
  {
  $filter = ['SchoolID'=>$_SESSION["loggeduser_schoolID"]];
  $option = ['limit'=>50,'skip'=>$datapaging,'sort' => ['_id' => -1]];
  $query = new MongoDB\Driver\Query($filter,$option);
  $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Staff',$query);
  }
  else
  {
  $sort = ($_GET['level']);
  $filter = ['SchoolID'=>$_SESSION["loggeduser_schoolID"],
            'StaffLevel'=>$sort];
  $option = ['limit'=>50,'skip'=>$datapaging,'sort' => ['_id' => -1]];
  $query = new MongoDB\Driver\Query($filter,$option);
  $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Staff',$query);
  }
}
else
{
  //search using name/id number
  $IDnumber = ($_POST['IDnumber']);
  $filter = [NULL];
  $query = new MongoDB\Driver\Query($filter);
  $cursor = $GoNGetzDatabase->executeQuery('GoNGetz.Consumer',$query);

  foreach ($cursor as $document)
  {
    $idx = strval($document->_id);
    $ConsumerIDNox = strval($document->ConsumerIDNo);
    $ConsumerFNamex = strval($document->ConsumerFName);

    if ($ConsumerIDNox==$IDnumber || $ConsumerFNamex==$IDnumber)
    {
      $filter = ['SchoolID'=>$_SESSION["loggeduser_schoolID"], 'ConsumerID'=>$idx];
      $query = new MongoDB\Driver\Query($filter);
      $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Staff',$query);

    }
  }
}
?>
