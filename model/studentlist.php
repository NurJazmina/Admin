<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require_once "vendor/autoload.php";

//Add student
if (isset($_POST['submitaddstudent']))
{
  $varschoolID = strval($_SESSION["loggeduser_schoolID"]);
  $varConsumerIDNoChild = $_POST['txtConsumerIDNoChild'];
  $varstudentclass = $_POST['txtstudentclass'];
  $filter = ['ConsumerIDNo'=>$varConsumerIDNoChild];
  $query = new MongoDB\Driver\Query($filter);
  $cursor = $GoNGetzDatabase->executeQuery('GoNGetz.Consumer',$query);

  //add student
  foreach ($cursor as $document)
  {
    $studentID = strval($document->_id);
    $bulk = new MongoDB\Driver\BulkWrite(['ordered' => TRUE]);
    $bulk->insert(['Consumer_id'=>$studentID,'Schools_id'=> $varschoolID,'Class_id'=>$varstudentclass,'StudentsStatus'=>"ACTIVE"]);
    $writeConcern = new MongoDB\Driver\WriteConcern(MongoDB\Driver\WriteConcern::MAJORITY, 1000);
    try
    {
      $result =$GoNGetzDatabase->executeBulkWrite('GoNGetzSmartSchool.Students', $bulk, $writeConcern);
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
  }

  //add parent
  $varConsumerIDNoParent = $_POST['txtConsumerIDNoParent'];
  $varParentRegDate = new MongoDB\BSON\UTCDateTime((new DateTime('now'))->getTimestamp()*1000);
  $filter = ['ConsumerIDNo'=>$varConsumerIDNoParent];
  $query = new MongoDB\Driver\Query($filter);
  $cursor = $GoNGetzDatabase->executeQuery('GoNGetz.Consumer',$query);
  foreach ($cursor as $document)
  {
  $parentID = strval($document->_id);
  $bulk = new MongoDB\Driver\BulkWrite(['ordered' => TRUE]);
  $bulk->insert(['ConsumerID'=>$parentID,'Schools_id'=> $varschoolID,'ParentStatus'=> "ACTIVE",'ParentAddDate'=>$varParentRegDate]);
  $writeConcern = new MongoDB\Driver\WriteConcern(MongoDB\Driver\WriteConcern::MAJORITY, 1000);
  try
  {
    $result =$GoNGetzDatabase->executeBulkWrite('GoNGetzSmartSchool.Parents', $bulk, $writeConcern);
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
  }

  //add relation
  $varrelation = $_POST['txtrelation'];
  $varConsumerIDNoParent = $_POST['txtConsumerIDNoParent'];
  $varConsumerIDNoChild = $_POST['txtConsumerIDNoChild'];
  $filter = ['ConsumerIDNo'=>$varConsumerIDNoParent];
  $query = new MongoDB\Driver\Query($filter);
  $cursor = $GoNGetzDatabase->executeQuery('GoNGetz.Consumer',$query);
  foreach ($cursor as $document)
  {
  $Parentid = strval($document->_id);
  $filter1 = ['ConsumerID'=>$Parentid];
  $query1 = new MongoDB\Driver\Query($filter1);
  $cursor1 =$GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Parents',$query1);
  foreach ($cursor1 as $document1)
  {
  $parentid = strval($document1->_id);
  }
  }
  $filter = ['ConsumerIDNo'=>$varConsumerIDNoChild];
  $query = new MongoDB\Driver\Query($filter);
  $cursor =$GoNGetzDatabase->executeQuery('GoNGetz.Consumer',$query);
  foreach ($cursor as $document)
  {
  $childid = strval($document->_id);
  $filter1 = ['Consumer_id'=>$childid];
  $query1 = new MongoDB\Driver\Query($filter1);
  $cursor1 =$GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Students',$query1);
  foreach ($cursor1 as $document1)
  {
  $studentid = strval($document1->_id);
  }
  }
  $bulk1 = new MongoDB\Driver\BulkWrite(['ordered' => TRUE]);
  $bulk1->insert(['ParentID'=>$parentid,'StudentID'=>$studentid,'ParentStudentRelation'=>$varrelation,'Schools_id'=>$varschoolID,'ParentStudentRelationStatus'=>'ACTIVE']);
  $writeConcern = new MongoDB\Driver\WriteConcern(MongoDB\Driver\WriteConcern::MAJORITY, 1000);
  try
  {
    $result =$GoNGetzDatabase->executeBulkWrite('GoNGetzSmartSchool.ParentStudentRel', $bulk1, $writeConcern);
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

  $AddDate = new MongoDB\BSON\UTCDateTime((new DateTime('now'))->getTimestamp()*1000);
  $utcdatetime = new MongoDB\BSON\UTCDateTime(strval($AddDate));
  $datetime = $utcdatetime->toDateTime()->setTimezone(new \DateTimeZone(date_default_timezone_get()));
  $date = date_format($datetime,"d M Y");

  $FromNameF = ($_SESSION["loggeduser_consumerFName"]);
  $FromNameL = ($_SESSION["loggeduser_consumerLName"]);
  $SchoolName = ($_SESSION["loggeduser_schoolName"]);
  $SchoolEmail = ($_SESSION["loggeduser_SchoolsEmail"]);
  $SchoolPhone = ($_SESSION["loggeduser_schoolsPhoneNo"]);
  $SchoolAddress = ($_SESSION["loggeduser_schoolsAddress"]);

  $filter = ['ConsumerIDNo'=>$varConsumerIDNoParent];
  $query = new MongoDB\Driver\Query($filter);
  $cursor = $GoNGetzDatabase->executeQuery('GoNGetz.Consumer',$query);

  foreach ($cursor as $document)
  {
    $ConsumerFName = strval($document->ConsumerFName);
    $ConsumerLName = strval($document->ConsumerLName);
    $ConsumerIDType = strval($document->ConsumerIDType);
    $ConsumerIDNo = strval($document->ConsumerIDNo);
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
                              <p>Hi $ConsumerFName $ConsumerLName,</p>
                              <p>$SchoolName succesfully link with $ConsumerFName $ConsumerLName with $ConsumerIDType $ConsumerIDNo on $date. If you found out this is an error, kindly contact:
                                <ul>
                                    <li>$SchoolName</li>
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
    </html>
    ";
    $mail->AltBody = "This is the plain text version of the email content";

    try { $mail->send();} 

    catch (Exception $e) { echo "Mailer Error: " . $mail->ErrorInfo;}
  }
}
}

//Edit student
if (isset($_POST['submiteditstudent']))
{
  $studentclass = $_POST['txtstudentclass'];
  $studentid = $_POST['studentid'];
  $bulk = new MongoDB\Driver\BulkWrite(['ordered' => TRUE]);
  $bulk->update( ['Consumer_id' => new \MongoDB\BSON\ObjectID($studentid)],
                ['$set' => ['Class_id'=>$studentclass]],
                ['upsert' => TRUE]
               );
  $writeConcern = new MongoDB\Driver\WriteConcern(MongoDB\Driver\WriteConcern::MAJORITY, 1000);
  try
  {
    $result =$GoNGetzDatabase->executeBulkWrite('GoNGetzSmartSchool.Students', $bulk, $writeConcern);
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

  $studentclass = new \MongoDB\BSON\ObjectId($studentclass);
  $filter1 = ['_id'=>$studentclass];
  $query1 = new MongoDB\Driver\Query($filter1);
  $cursor1 =$GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Classrooms',$query1);
  foreach ($cursor1 as $document1)
  {
    $ClassCategoryNew = strval($document1->ClassCategory);
    $ClassNameNew = strval($document1->ClassName);
  }
  $AddDate = new MongoDB\BSON\UTCDateTime((new DateTime('now'))->getTimestamp()*1000);
  $utcdatetime = new MongoDB\BSON\UTCDateTime(strval($AddDate));
  $datetime = $utcdatetime->toDateTime()->setTimezone(new \DateTimeZone(date_default_timezone_get()));
  $date = date_format($datetime,"d M Y");

  $FromNameF = ($_SESSION["loggeduser_consumerFName"]);
  $FromNameL = ($_SESSION["loggeduser_consumerLName"]);
  $SchoolName = ($_SESSION["loggeduser_schoolName"]);
  $SchoolEmail = ($_SESSION["loggeduser_SchoolsEmail"]);
  $SchoolPhone = ($_SESSION["loggeduser_schoolsPhoneNo"]);
  $SchoolAddress = ($_SESSION["loggeduser_schoolsAddress"]);

  $studentid = new \MongoDB\BSON\ObjectId($studentid);
  $filter = ['_id'=>$studentid];
  $query = new MongoDB\Driver\Query($filter);
  $cursor = $GoNGetzDatabase->executeQuery('GoNGetz.Consumer',$query);

  foreach ($cursor as $document)
  {
    $ConsumerFName = strval($document->ConsumerFName);
    $ConsumerLName = strval($document->ConsumerLName);
    $ConsumerIDType = strval($document->ConsumerIDType);
    $ConsumerIDNo = strval($document->ConsumerIDNo);
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
                              <p>Hi $ConsumerFName $ConsumerLName,</p>
                              <p>$ClassCategoryNew $ClassNameNew  succesfully link with $ConsumerFName $ConsumerLName with $ConsumerIDType $ConsumerIDNo on $date. If you found out this is an error, kindly contact:
                                <ul>
                                    <li>$SchoolName</li>
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
    </html>
    ";
    $mail->AltBody = "This is the plain text version of the email content";

    try { $mail->send();} 

    catch (Exception $e) { echo "Mailer Error: " . $mail->ErrorInfo;}
  }
}
}

//Add Relation and Student
if (isset($_POST['addrelationstudent']))
{
  $schoolID = strval($_SESSION["loggeduser_schoolID"]);
  $parentid = $_POST['txtparentid'];
  $childconsumerid = $_POST['txtchildconsumerid'];
  $relation = $_POST['txtParentStudentRelation'];
  $studentclass = $_POST['txtstudentclass'];

  $childconsumerid = new \MongoDB\BSON\ObjectId($childconsumerid);
  $filter = ['_id'=>$childconsumerid];
  $query = new MongoDB\Driver\Query($filter);
  $cursor = $GoNGetzDatabase->executeQuery('GoNGetz.Consumer',$query);

  foreach ($cursor as $document)
  {
    $ConsumerFNameChild = strval($document->ConsumerFName);
    $ConsumerLNameChild = strval($document->ConsumerLName);
  }

  //adding student
  $bulk = new MongoDB\Driver\BulkWrite(['ordered' => TRUE]);
  $bulk->insert(['Consumer_id'=>$childconsumerid,'Schools_id'=>$schoolID,'Class_id'=>$studentclass,'StudentsStatus'=>"ACTIVE"]);
  $writeConcern = new MongoDB\Driver\WriteConcern(MongoDB\Driver\WriteConcern::MAJORITY, 1000);
  try
  {
    $result =$GoNGetzDatabase->executeBulkWrite('GoNGetzSmartSchool.Students', $bulk, $writeConcern);
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

  $filter = ['Consumer_id'=>$childconsumerid];
  $query = new MongoDB\Driver\Query($filter);
  $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Students',$query);
  foreach ($cursor as $document) 
  {
    $studentid = strval($document->_id);
  }

  //adding relation
  $bulk = new MongoDB\Driver\BulkWrite(['ordered' => TRUE]);
  $bulk->insert(['ParentID'=>$parentid,'StudentID'=>$studentid,'ParentStudentRelation'=>$relation,'Schools_id'=>$schoolID,'ParentStudentRelationStatus'=>'ACTIVE']);
  $writeConcern = new MongoDB\Driver\WriteConcern(MongoDB\Driver\WriteConcern::MAJORITY, 1000);
  try
  {
    $result =$GoNGetzDatabase->executeBulkWrite('GoNGetzSmartSchool.ParentStudentRel', $bulk, $writeConcern);
  }
  catch (MongoDB\Driver\Exception\BulkWriteException $e)
  {
    $result = $e->getWriteResult();
    $_SESSION["loggeduser_schoolName"] = $varschoolname;
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

  $AddDate = new MongoDB\BSON\UTCDateTime((new DateTime('now'))->getTimestamp()*1000);
  $utcdatetime = new MongoDB\BSON\UTCDateTime(strval($AddDate));
  $datetime = $utcdatetime->toDateTime()->setTimezone(new \DateTimeZone(date_default_timezone_get()));
  $date = date_format($datetime,"d M Y");

  $FromNameF = ($_SESSION["loggeduser_consumerFName"]);
  $FromNameL = ($_SESSION["loggeduser_consumerLName"]);
  $SchoolName = ($_SESSION["loggeduser_schoolName"]);
  $SchoolEmail = ($_SESSION["loggeduser_SchoolsEmail"]);
  $SchoolPhone = ($_SESSION["loggeduser_schoolsPhoneNo"]);
  $SchoolAddress = ($_SESSION["loggeduser_schoolsAddress"]);

  $parentid = new \MongoDB\BSON\ObjectId($parentid);
  $filter = ['_id'=>$parentid];
  $query = new MongoDB\Driver\Query($filter);
  $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Parents',$query);

  foreach ($cursor as $document)
  {
    $ConsumerID = strval($document->ConsumerID);
    $ConsumerID = new \MongoDB\BSON\ObjectId($ConsumerID);
  }

  $filter = ['_id'=>$ConsumerID];
  $query = new MongoDB\Driver\Query($filter);
  $cursor = $GoNGetzDatabase->executeQuery('GoNGetz.Consumer',$query);

  foreach ($cursor as $document)
  {
    $ConsumerFName = strval($document->ConsumerFName);
    $ConsumerLName = strval($document->ConsumerLName);
    $ConsumerIDType = strval($document->ConsumerIDType);
    $ConsumerIDNo = strval($document->ConsumerIDNo);
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
                              <p>Hi $ConsumerFName $ConsumerLName,</p>
                              <p>$ConsumerFNameChild $ConsumerLNameChild succesfully link with $ConsumerFName $ConsumerLName with $ConsumerIDType $ConsumerIDNo on $date. If you found out this is an error, kindly contact:
                                <ul>
                                    <li>$SchoolName</li>
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
    </html>
    ";
    $mail->AltBody = "This is the plain text version of the email content";

    try { $mail->send();} 

    catch (Exception $e) { echo "Mailer Error: " . $mail->ErrorInfo;}
  }
}
}

//Add Relation without Student
if (isset($_POST['addrelation']))
{
  $schoolID = strval($_SESSION["loggeduser_schoolID"]);
  $parentid = $_POST['txtparentid'];
  $studentid = $_POST['txtstudentid'];
  $relation = $_POST['txtParentStudentRelation'];

  $studentid = new \MongoDB\BSON\ObjectId($studentid);
  $filter = ['_id'=>$studentid];
  $query = new MongoDB\Driver\Query($filter);
  $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Students',$query);

  foreach ($cursor as $document)
  {
    $Consumer_id = strval($document->Consumer_id);
    $Consumer_id = new \MongoDB\BSON\ObjectId($Consumer_id);

    $filter = ['_id'=>$Consumer_id];
    $query = new MongoDB\Driver\Query($filter);
    $cursor = $GoNGetzDatabase->executeQuery('GoNGetz.Consumer',$query);
  
    foreach ($cursor as $document)
    {
      $ConsumerFNameChild = strval($document->ConsumerFName);
      $ConsumerLNameChild = strval($document->ConsumerLName);
    }
  }

  //adding relation
  $bulk = new MongoDB\Driver\BulkWrite(['ordered' => TRUE]);
  $bulk->insert(['ParentID'=>$parentid,'StudentID'=>$studentid,'ParentStudentRelation'=>$relation,'Schools_id'=>$schoolID,'ParentStudentRelationStatus'=>'ACTIVE']);
  $writeConcern = new MongoDB\Driver\WriteConcern(MongoDB\Driver\WriteConcern::MAJORITY, 1000);
  try
  {
    $result =$GoNGetzDatabase->executeBulkWrite('GoNGetzSmartSchool.ParentStudentRel', $bulk, $writeConcern);
  }
  catch (MongoDB\Driver\Exception\BulkWriteException $e)
  {
    $result = $e->getWriteResult();
    $_SESSION["loggeduser_schoolName"] = $varschoolname;
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

  $AddDate = new MongoDB\BSON\UTCDateTime((new DateTime('now'))->getTimestamp()*1000);
  $utcdatetime = new MongoDB\BSON\UTCDateTime(strval($AddDate));
  $datetime = $utcdatetime->toDateTime()->setTimezone(new \DateTimeZone(date_default_timezone_get()));
  $date = date_format($datetime,"d M Y");

  $FromNameF = ($_SESSION["loggeduser_consumerFName"]);
  $FromNameL = ($_SESSION["loggeduser_consumerLName"]);
  $SchoolName = ($_SESSION["loggeduser_schoolName"]);
  $SchoolEmail = ($_SESSION["loggeduser_SchoolsEmail"]);
  $SchoolPhone = ($_SESSION["loggeduser_schoolsPhoneNo"]);
  $SchoolAddress = ($_SESSION["loggeduser_schoolsAddress"]);

  $parentid = new \MongoDB\BSON\ObjectId($parentid);
  $filter = ['_id'=>$parentid];
  $query = new MongoDB\Driver\Query($filter);
  $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Parents',$query);

  foreach ($cursor as $document)
  {
    $ConsumerID = strval($document->ConsumerID);
    $ConsumerID = new \MongoDB\BSON\ObjectId($ConsumerID);
  }

  $filter = ['_id'=>$ConsumerID];
  $query = new MongoDB\Driver\Query($filter);
  $cursor = $GoNGetzDatabase->executeQuery('GoNGetz.Consumer',$query);

  foreach ($cursor as $document)
  {
    $ConsumerFName = strval($document->ConsumerFName);
    $ConsumerLName = strval($document->ConsumerLName);
    $ConsumerIDType = strval($document->ConsumerIDType);
    $ConsumerIDNo = strval($document->ConsumerIDNo);
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
                              <p>Hi $ConsumerFName $ConsumerLName,</p>
                              <p>$ConsumerFNameChild $ConsumerLNameChild succesfully link with $ConsumerFName $ConsumerLName with $ConsumerIDType $ConsumerIDNo on $date. If you found out this is an error, kindly contact:
                                <ul>
                                    <li>$SchoolName</li>
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
    </html>
    ";
    $mail->AltBody = "This is the plain text version of the email content";

    try { $mail->send();} 

    catch (Exception $e) { echo "Mailer Error: " . $mail->ErrorInfo;}
  }
}
}

//De/activate student
if (isset($_POST['StatusStudentFormSubmit']))
{
  $varstudentid = $_POST['txtstudentid'];
  $varStudentStatus = $_POST['txtStudentStatus'];
  $varConsumerRemarksDetails = $_POST['txtConsumerRemarksDetails'];

  $filter = ['Consumer_id'=>$varstudentid];
  $query = new MongoDB\Driver\Query($filter);
  $cursor =$GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Students',$query);
  foreach ($cursor as $document)
  {
    $consumerid = strval($document->Consumer_id);
  }

  $bulk = new MongoDB\Driver\BulkWrite(['ordered' => TRUE]);
  $bulk->update(['Consumer_id' => $varstudentid],
                ['$set' => ['StudentsStatus'=>$varStudentStatus]],
                ['upsert' => TRUE]
               );
  $writeConcern = new MongoDB\Driver\WriteConcern(MongoDB\Driver\WriteConcern::MAJORITY, 1000);
  try
  {
    $result =$GoNGetzDatabase->executeBulkWrite('GoNGetzSmartSchool.Students', $bulk, $writeConcern);
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

  $varstaffid = strval($_SESSION["loggeduser_id"]);
  $varschoolid = strval($_SESSION["loggeduser_schoolID"]);
  $varconsumerremarkdate = new MongoDB\BSON\UTCDateTime((new DateTime('now'))->getTimestamp()*1000);
  $bulk = new MongoDB\Driver\BulkWrite(['ordered'=>true]);
  $bulk->insert([
    'SubRemarks'=>'0',
    'Consumer_id'=>$consumerid,
    'ConsumerRemarksDetails'=>$varConsumerRemarksDetails,
    'ConsumerRemarksStaff_id'=>$varstaffid,
    'school_id'=>$varschoolid,
    'ConsumerRemarksDate'=>$varconsumerremarkdate,
    'ConsumerRemarksStatus'=>'ACTIVE']);
  $writeConcern = new MongoDB\Driver\WriteConcern(MongoDB\Driver\WriteConcern::MAJORITY, 1000);
  try
  {
    $result = $GoNGetzDatabase->executeBulkWrite('GoNGetzSmartSchool.StudentRemarks', $bulk, $writeConcern);
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
    foreach ($result->getWriteErrors() as $writeError) {
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

  $AddDate = new MongoDB\BSON\UTCDateTime((new DateTime('now'))->getTimestamp()*1000);
  $utcdatetime = new MongoDB\BSON\UTCDateTime(strval($AddDate));
  $datetime = $utcdatetime->toDateTime()->setTimezone(new \DateTimeZone(date_default_timezone_get()));
  $date = date_format($datetime,"d M Y");

  $FromNameF = ($_SESSION["loggeduser_consumerFName"]);
  $FromNameL = ($_SESSION["loggeduser_consumerLName"]);
  $SchoolName = ($_SESSION["loggeduser_schoolName"]);
  $SchoolEmail = ($_SESSION["loggeduser_SchoolsEmail"]);
  $SchoolPhone = ($_SESSION["loggeduser_schoolsPhoneNo"]);
  $SchoolAddress = ($_SESSION["loggeduser_schoolsAddress"]);

  $filter = ['StudentID'=>$varstudentid];
  $query = new MongoDB\Driver\Query($filter);
  $cursor =$GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.ParentStudentRel',$query);
  foreach ($cursor as $document)
  {
    $ParentID = strval($document->ParentID);
    $ParentID = new \MongoDB\BSON\ObjectId($ParentID);

    $filter = ['_id'=>$ParentID];
    $query = new MongoDB\Driver\Query($filter);
    $cursor =$GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Parents',$query);
    foreach ($cursor as $document)
    {
      $ConsumerID = strval($document->ConsumerID);
      $ConsumerID = new \MongoDB\BSON\ObjectId($ConsumerID);

      $filter = ['_id'=>$ConsumerID];
      $query = new MongoDB\Driver\Query($filter);
      $cursor = $GoNGetzDatabase->executeQuery('GoNGetz.Consumer',$query);

      foreach ($cursor as $document)
      {
        $ConsumerFName = strval($document->ConsumerFName);
        $ConsumerLName = strval($document->ConsumerLName);
        $ConsumerIDType = strval($document->ConsumerIDType);
        $ConsumerIDNo = strval($document->ConsumerIDNo);
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
                                  <p>Hi $ConsumerFName $ConsumerLName,</p>
                                  <p>Status for $ConsumerFName $ConsumerLName with $ConsumerIDType $ConsumerIDNo on $date has been change to $varStaffStatus. If you found out this is an error, kindly contact:
                                    <ul>
                                        <li>$SchoolName</li>
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
        </html>
        ";
        $mail->AltBody = "This is the plain text version of the email content";

        try { $mail->send();} 

        catch (Exception $e) { echo "Mailer Error: " . $mail->ErrorInfo;}
      }
    }
  }
}
}


//list student 
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
  if (!isset($_POST['searchstudent']) && empty($_POST['searchstudent']))
  {
    if (!isset($_GET['level']) && empty($_GET['level']))
    {
    $filter = ['Schools_id'=>$_SESSION["loggeduser_schoolID"]];
    $option = ['limit'=>50,'skip'=>$datapaging,'sort' => ['_id' => -1]];
    $query = new MongoDB\Driver\Query($filter,$option);
    $cursor =$GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Students',$query);
    }
    else
    {
    $sort = ($_GET['level']);
    $filter = ['SchoolID' => $_SESSION["loggeduser_schoolID"],
              'ClassCategory'=>$sort
              ];
    $option = ['limit'=>50,'skip'=>$datapaging,'sort' => ['_id' => -1]];
    $query = new MongoDB\Driver\Query($filter,$option);
    $cursor =$GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Classrooms',$query);
    foreach ($cursor as $document)
    {
    $classid = strval($document->_id);
    $filter = ['Schools_id'=>$_SESSION["loggeduser_schoolID"], 'Class_id'=>$classid];
    $query = new MongoDB\Driver\Query($filter);
    $cursor =$GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Students',$query);
    }
    }
  }
  else
  {
    $IDnumber = ($_POST['IDnumber']);
    $filter = [NULL];
    $query = new MongoDB\Driver\Query($filter);
    $cursor =$GoNGetzDatabase->executeQuery('GoNGetz.Consumer',$query);
    foreach ($cursor as $document)
    {
      $idx = strval($document->_id);
      $ConsumerIDNox = strval($document->ConsumerIDNo);
      $ConsumerFNamex = strval($document->ConsumerFName);

      if ($ConsumerIDNox==$IDnumber || $ConsumerFNamex==$IDnumber)
      {
        $filter = ['Schools_id' => $_SESSION["loggeduser_schoolID"],'Consumer_id'=>$idx];
        $query = new MongoDB\Driver\Query($filter);
        $cursor =$GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Students',$query);
      }
    }
  }
?>