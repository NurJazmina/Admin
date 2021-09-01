<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require_once "vendor/autoload.php";

$FromNameF = $_SESSION["loggeduser_consumerFName"];
$FromNameL = $_SESSION["loggeduser_consumerLName"];
$SchoolName = $_SESSION["loggeduser_schoolName"];
$SchoolEmail = $_SESSION["loggeduser_SchoolsEmail"];
$SchoolPhone = $_SESSION["loggeduser_schoolsPhoneNo"];
$SchoolAddress = $_SESSION["loggeduser_schoolsAddress"];
$school_id = $_SESSION["loggeduser_schoolID"];

//Add school student
if (isset($_POST['add_student']))
{
  //add parent
  $parent_idno = $_POST['parent_idno'];
  $student_idno = $_POST['student_idno'];
  $class = $_POST['class'];
  $relation = $_POST['relation'];
  $date = new MongoDB\BSON\UTCDateTime((new DateTime('now'))->getTimestamp()*1000);

  $filter = ['ConsumerIDNo'=>$parent_idno];
  $query = new MongoDB\Driver\Query($filter);
  $cursor = $GoNGetzDatabase->executeQuery('GoNGetz.Consumer',$query);
  foreach ($cursor as $document)
  {
    $consumer_parent_id = strval($document->_id);
  
    $bulk = new MongoDB\Driver\BulkWrite(['ordered' => TRUE]);
    $bulk->insert([
      'Schools_id'=> $school_id,
      'ConsumerID'=>$consumer_parent_id,
      'ParentStatus'=> "ACTIVE",
      'ParentAddDate'=>$date
      ]);
    $writeConcern = new MongoDB\Driver\WriteConcern(MongoDB\Driver\WriteConcern::MAJORITY, 1000);
    try
    {
      $result = $GoNGetzDatabase->executeBulkWrite('GoNGetzSmartSchool.Parents', $bulk, $writeConcern);
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

  //add student
  $filter = ['ConsumerIDNo'=>$student_idno];
  $query = new MongoDB\Driver\Query($filter);
  $cursor = $GoNGetzDatabase->executeQuery('GoNGetz.Consumer',$query);
  foreach ($cursor as $document)
  {
    $student_consumer_id = strval($document->_id);
    $ConsumerFNameChild = $document->ConsumerFName;
    $ConsumerLNameChild = $document->ConsumerLName;

    $bulk = new MongoDB\Driver\BulkWrite(['ordered' => TRUE]);
    $bulk->insert([
      'Schools_id'=> $school_id,
      'Consumer_id'=>$student_consumer_id,
      'Class_id'=>$class,
      'StudentsStatus'=>"ACTIVE"
    ]);
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

  //add relation
  $filter = ['ConsumerID'=>$consumer_parent_id];
  $query = new MongoDB\Driver\Query($filter);
  $cursor =$GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Parents',$query);
  foreach ($cursor as $document)
  {
    $parent_id = strval($document->_id);
  }

  $filter = ['Consumer_id'=>$student_consumer_id];
  $query = new MongoDB\Driver\Query($filter);
  $cursor =$GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Students',$query);
  foreach ($cursor as $document)
  {
    $student_id = strval($document->_id);
  }

  $bulk1 = new MongoDB\Driver\BulkWrite(['ordered' => TRUE]);
  $bulk1->insert([
    'Schools_id'=>$school_id,
    'ParentID'=>$parent_id,
    'StudentID'=>$student_id,
    'ParentStudentRelation'=>$relation,
    'ParentStudentRelationStatus'=>'ACTIVE']);
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

  $date = new MongoDB\BSON\UTCDateTime((new DateTime('now'))->getTimestamp()*1000);
  $date = new MongoDB\BSON\UTCDateTime(strval($date));
  $date = $date->toDateTime()->setTimezone(new \DateTimeZone(date_default_timezone_get()));
  $date = date_format($date,"d M Y");

  $filter = ['ConsumerIDNo'=>$parent_idno];
  $query = new MongoDB\Driver\Query($filter);
  $cursor = $GoNGetzDatabase->executeQuery('GoNGetz.Consumer',$query);
  foreach ($cursor as $document)
  {
    $ConsumerFName = $document->ConsumerFName;
    $ConsumerLName = $document->ConsumerLName;
    $ConsumerIDType = $document->ConsumerIDType;
    $ConsumerIDNo = $document->ConsumerIDNo;
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
                                  <p><a href='https://smartschool.gongetz.com/school.php?id=$school_id'>$SchoolName</a> and $ConsumerFNameChild $ConsumerLNameChild succesfully link with <a href='https://smartschool.gongetz.com/profile.php?id=$ConsumerIDNo'>$ConsumerFName $ConsumerLName</a> with $ConsumerIDType $ConsumerIDNo on $date. If you found out this is an error, kindly contact:
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
}

if (isset($_POST['add_relation']))
{
  $school_id = $_SESSION["loggeduser_schoolID"];
  $parent_id = $_POST['parent_id'];
  $student_id = $_POST['student_id'];
  $relation = $_POST['relation'];

  $filter = ['_id'=>new \MongoDB\BSON\ObjectId($student_id)];
  $query = new MongoDB\Driver\Query($filter);
  $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Students',$query);
  foreach ($cursor as $document)
  {
    $Consumer_id = $document->Consumer_id;

    $filter = ['_id'=>new \MongoDB\BSON\ObjectId($Consumer_id)];
    $query = new MongoDB\Driver\Query($filter);
    $cursor = $GoNGetzDatabase->executeQuery('GoNGetz.Consumer',$query);
    foreach ($cursor as $document)
    {
      $ConsumerFNameChild = $document->ConsumerFName;
      $ConsumerLNameChild = $document->ConsumerLName;
      $ConsumerIDNoChild = $document->ConsumerIDNo;
    }
  }

  //add relation
  $bulk = new MongoDB\Driver\BulkWrite(['ordered' => TRUE]);
  $bulk->insert([
    'Schools_id'=>$school_id,
    'ParentID'=>$parent_id,
    'StudentID'=>$student_id,
    'ParentStudentRelation'=>$relation,
    'ParentStudentRelationStatus'=>'ACTIVE']);
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

  $date = new MongoDB\BSON\UTCDateTime((new DateTime('now'))->getTimestamp()*1000);
  $date = new MongoDB\BSON\UTCDateTime(strval($date));
  $date = $date->toDateTime()->setTimezone(new \DateTimeZone(date_default_timezone_get()));
  $date = date_format($date,"d M Y");

  $filter = ['_id'=>new \MongoDB\BSON\ObjectId($parent_id)];
  $query = new MongoDB\Driver\Query($filter);
  $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Parents',$query);
  foreach ($cursor as $document)
  {
    $ConsumerID = $document->ConsumerID;
  }

  $filter = ['_id'=> new \MongoDB\BSON\ObjectId($ConsumerID)];
  $query = new MongoDB\Driver\Query($filter);
  $cursor = $GoNGetzDatabase->executeQuery('GoNGetz.Consumer',$query);
  foreach ($cursor as $document)
  {
    $ConsumerFName = $document->ConsumerFName;
    $ConsumerLName = $document->ConsumerLName;
    $ConsumerIDType = $document->ConsumerIDType;
    $ConsumerIDNo = $document->ConsumerIDNo;
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
                                <p>$ConsumerFNameChild $ConsumerLNameChild succesfully link with <a href='https://smartschool.gongetz.com/profile.php?id=$ConsumerIDNo'>$ConsumerFName $ConsumerLName</a> with $ConsumerIDType $ConsumerIDNo on $date. If you found out this is an error, kindly contact:
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
}

if (isset($_POST['add_relation_student']))
{
  $school_id = $_SESSION["loggeduser_schoolID"];
  $parent_id = $_POST['parent_id'];
  $student_consumer_id = $_POST['student_consumer_id'];
  $relation = $_POST['relation'];
  $class = $_POST['class'];

  $filter = ['_id'=>new \MongoDB\BSON\ObjectId($student_consumer_id)];
  $query = new MongoDB\Driver\Query($filter);
  $cursor = $GoNGetzDatabase->executeQuery('GoNGetz.Consumer',$query);
  foreach ($cursor as $document)
  {
    $ConsumerFNameChild = $document->ConsumerFName;
    $ConsumerLNameChild = $document->ConsumerLName;
  }

  //adding student
  $bulk = new MongoDB\Driver\BulkWrite(['ordered' => TRUE]);
  $bulk->insert([
    'Schools_id'=>$school_id,
    'Consumer_id'=>$student_consumer_id,
    'Class_id'=>$class,
    'StudentsStatus'=>"ACTIVE"]);
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

  $filter = ['Consumer_id'=>$student_consumer_id];
  $query = new MongoDB\Driver\Query($filter);
  $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Students',$query);
  foreach ($cursor as $document) 
  {
    $student_id = strval($document->_id);
  }

  //adding relation
  $bulk = new MongoDB\Driver\BulkWrite(['ordered' => TRUE]);
  $bulk->insert(['ParentID'=>$parent_id,'StudentID'=>$student_id,'ParentStudentRelation'=>$relation,'Schools_id'=>$school_id,'ParentStudentRelationStatus'=>'ACTIVE']);
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

  $date = new MongoDB\BSON\UTCDateTime((new DateTime('now'))->getTimestamp()*1000);
  $date = new MongoDB\BSON\UTCDateTime(strval($date));
  $date = $date->toDateTime()->setTimezone(new \DateTimeZone(date_default_timezone_get()));
  $date = date_format($date,"d M Y");

  $filter = ['_id'=>new \MongoDB\BSON\ObjectId($parent_id)];
  $query = new MongoDB\Driver\Query($filter);
  $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Parents',$query);
  foreach ($cursor as $document)
  {
    $ConsumerID = $document->ConsumerID;
  }

  $filter = ['_id'=>new \MongoDB\BSON\ObjectId($ConsumerID)];
  $query = new MongoDB\Driver\Query($filter);
  $cursor = $GoNGetzDatabase->executeQuery('GoNGetz.Consumer',$query);
  foreach ($cursor as $document)
  {
    $ConsumerFName = $document->ConsumerFName;
    $ConsumerLName = $document->ConsumerLName;
    $ConsumerIDType = $document->ConsumerIDType;
    $ConsumerIDNo = $document->ConsumerIDNo;
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
                                  <p><a href='https://smartschool.gongetz.com/profile.php?id=$ConsumerIDNoChild'>$ConsumerFNameChild $ConsumerLNameChild</a> succesfully link with <a href='https://smartschool.gongetz.com/profile.php?id=$ConsumerIDNo'>$ConsumerFName $ConsumerLName</a> with $ConsumerIDType $ConsumerIDNo on $date. If you found out this is an error, kindly contact:
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
}


if (isset($_POST['add_relation_parent']))
{
  $parent_consumer_id = $_POST['parent_consumer_id'];
  $student_id = $_POST['student_id'];
  $relation = $_POST['relation'];
  $date = new MongoDB\BSON\UTCDateTime((new DateTime('now'))->getTimestamp()*1000);

  //adding parent
  $bulk = new MongoDB\Driver\BulkWrite(['ordered' => TRUE]);
  $bulk->insert([
    'Schools_id'=>$school_id,
    'ConsumerID'=>$parent_consumer_id,
    'ParentStatus'=>"ACTIVE",
    'ParentAddDate'=>$date
  ]);
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

  $filter = ['ConsumerID'=>$parent_consumer_id];
  $query = new MongoDB\Driver\Query($filter);
  $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Parents',$query);
  foreach ($cursor as $document) 
  {
    $parent_id = strval($document->_id);
  }

  //adding relation
  $bulk = new MongoDB\Driver\BulkWrite(['ordered' => TRUE]);
  $bulk->insert([
    'Schools_id'=>$school_id,
    'ParentID'=>$parent_id,
    'StudentID'=>$student_id,
    'ParentStudentRelation'=>$relation,
    'ParentStudentRelationStatus'=>'ACTIVE'
  ]);
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

  $filter = ['_id'=>new \MongoDB\BSON\ObjectId($student_id)];
  $query = new MongoDB\Driver\Query($filter);
  $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Students',$query);
  foreach ($cursor as $document) 
  {
    $Consumer_id = $document->Consumer_id;

    $filter = ['_id'=>new \MongoDB\BSON\ObjectId($Consumer_id)];
    $query = new MongoDB\Driver\Query($filter);
    $cursor = $GoNGetzDatabase->executeQuery('GoNGetz.Consumer',$query);
    foreach ($cursor as $document)
    {
      $ConsumerFNameChild = $document->ConsumerFName;
      $ConsumerLNameChild = $document->ConsumerLName;
      $ConsumerIDNoChild = $document->ConsumerIDNo;
    }
  }

  $date = new MongoDB\BSON\UTCDateTime((new DateTime('now'))->getTimestamp()*1000);
  $date = new MongoDB\BSON\UTCDateTime(strval($date));
  $date = $date->toDateTime()->setTimezone(new \DateTimeZone(date_default_timezone_get()));
  $date = date_format($date,"d M Y");

  $filter = ['_id'=>new \MongoDB\BSON\ObjectId($parent_consumer_id)];
  $query = new MongoDB\Driver\Query($filter);
  $cursor = $GoNGetzDatabase->executeQuery('GoNGetz.Consumer',$query);
  foreach ($cursor as $document)
  {
    $ConsumerFName = $document->ConsumerFName;
    $ConsumerLName = $document->ConsumerLName;
    $ConsumerIDType = $document->ConsumerIDType;
    $ConsumerIDNo = $document->ConsumerIDNo;
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
                                  <p><a href='https://smartschool.gongetz.com/profile.php?id=$ConsumerIDNoChild'>$ConsumerFNameChild $ConsumerLNameChild</a> succesfully link with <a href='https://smartschool.gongetz.com/profile.php?id=$ConsumerIDNo'>$ConsumerFName $ConsumerLName</a> with $ConsumerIDType $ConsumerIDNo on $date. If you found out this is an error, kindly contact:
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
}


if (isset($_POST['edit_student']))
{
  $class = $_POST['class'];
  $student_consumer_id = $_POST['student_consumer_id'];
  $bulk = new MongoDB\Driver\BulkWrite(['ordered' => TRUE]);
  $bulk->update( ['Consumer_id' => new \MongoDB\BSON\ObjectID($student_consumer_id)],
                ['$set' => ['Class_id'=>$class]],
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

  $filter = ['_id'=>new \MongoDB\BSON\ObjectId($class)];
  $query = new MongoDB\Driver\Query($filter);
  $cursor =$GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Classrooms',$query);
  foreach ($cursor as $document)
  {
    $ClassCategoryNew = $document->ClassCategory;
    $ClassNameNew = $document->ClassName;
  }

  $date = new MongoDB\BSON\UTCDateTime((new DateTime('now'))->getTimestamp()*1000);
  $date = new MongoDB\BSON\UTCDateTime(strval($date));
  $date = $date->toDateTime()->setTimezone(new \DateTimeZone(date_default_timezone_get()));
  $date = date_format($date,"d M Y");

  $filter = ['_id'=>new \MongoDB\BSON\ObjectId($student_consumer_id)];
  $query = new MongoDB\Driver\Query($filter);
  $cursor = $GoNGetzDatabase->executeQuery('GoNGetz.Consumer',$query);
  foreach ($cursor as $document)
  {
    $ConsumerFName = $document->ConsumerFName;
    $ConsumerLName = $document->ConsumerLName;
    $ConsumerIDType = $document->ConsumerIDType;
    $ConsumerIDNo = $document->ConsumerIDNo;
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
                                  <p>$ClassCategoryNew $ClassNameNew succesfully link with <a href='https://smartschool.gongetz.com/profile.php?id=$ConsumerIDNo'>$ConsumerFName $ConsumerLName</a> with $ConsumerIDType $ConsumerIDNo on $date. If you found out this is an error, kindly contact:
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
}

if (isset($_POST['status']))
{
  $student_consumer_id = $_POST['student_consumer_id'];
  $status = $_POST['status'];
  $details = $_POST['details'];

  $bulk = new MongoDB\Driver\BulkWrite(['ordered' => TRUE]);
  $bulk->update(['Consumer_id' => $student_consumer_id],
                ['$set' => ['StudentsStatus'=>$status]],
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

  $staff_id = $_SESSION["loggeduser_id"];
  $school_id = $_SESSION["loggeduser_schoolID"];

  $date = new MongoDB\BSON\UTCDateTime((new DateTime('now'))->getTimestamp()*1000);
  $date = new MongoDB\BSON\UTCDateTime(strval($date));
  $date = $date->toDateTime()->setTimezone(new \DateTimeZone(date_default_timezone_get()));
  $date = date_format($date,"d M Y");

  $bulk = new MongoDB\Driver\BulkWrite(['ordered'=>true]);
  $bulk->insert([
    'SubRemarks'=>'0',
    'School_id'=>$school_id,
    'Consumer_id'=>$consumerid,
    'Staff_id'=>$staff_id,
    'Details'=>$details,
    'Date'=>$date,
    'Status'=>'ACTIVE']);
  $writeConcern = new MongoDB\Driver\WriteConcern(MongoDB\Driver\WriteConcern::MAJORITY, 1000);
  try
  {
    $result = $GoNGetzDatabase->executeBulkWrite('GoNGetzSmartSchool.Student_Remarks', $bulk, $writeConcern);
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

  $filter = ['StudentID'=>$student_consumer_id];
  $query = new MongoDB\Driver\Query($filter);
  $cursor =$GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.ParentStudentRel',$query);
  foreach ($cursor as $document)
  {
    $ParentID = $document->ParentID;

    $filter = ['_id'=>new \MongoDB\BSON\ObjectId($ParentID)];
    $query = new MongoDB\Driver\Query($filter);
    $cursor =$GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Parents',$query);
    foreach ($cursor as $document)
    {
      $ConsumerID = $document->ConsumerID;

      $filter = ['_id'=>new \MongoDB\BSON\ObjectId($ConsumerID)];
      $query = new MongoDB\Driver\Query($filter);
      $cursor = $GoNGetzDatabase->executeQuery('GoNGetz.Consumer',$query);
      foreach ($cursor as $document)
      {
        $ConsumerFName = $document->ConsumerFName;
        $ConsumerLName = $document->ConsumerLName;
        $ConsumerIDType = $document->ConsumerIDType;
        $ConsumerIDNo = $document->ConsumerIDNo;
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
                                      <p>Status for <a href='https://smartschool.gongetz.com/profile.php?id=$ConsumerIDNo'>$ConsumerFName $ConsumerLName</a> with $ConsumerIDType $ConsumerIDNo on $date has been change to $varStaffStatus. If you found out this is an error, kindly contact:
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
    }
  }
}


/* ------------------------------------------- begin:paging --------------------------------------------------------------------------------------*/
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
  if (!isset($_POST['search_student']) && empty($_POST['search_student']))
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

      $filter = ['SchoolID' => $_SESSION["loggeduser_schoolID"],'ClassCategory'=>$sort];
      $option = ['limit'=>50,'skip'=>$datapaging,'sort' => ['_id' => -1]];
      $query = new MongoDB\Driver\Query($filter,$option);
      $cursor =$GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Classrooms',$query);
      foreach ($cursor as $document)
      {
        $class_id = strval($document->_id);

        $filter = ['Class_id'=>$class_id];
        $query = new MongoDB\Driver\Query($filter);
        $cursor =$GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Students',$query);
      }
    }
  }
  else
  {
    $consumer = ($_POST['consumer']);
    $filter = [NULL];
    $query = new MongoDB\Driver\Query($filter);
    $cursor =$GoNGetzDatabase->executeQuery('GoNGetz.Consumer',$query);
    foreach ($cursor as $document)
    {
      $consumer_id = strval($document->_id);
      $ConsumerIDNo = $document->ConsumerIDNo;
      $ConsumerFName = $document->ConsumerFName;
      if ($ConsumerIDNo==$consumer || $ConsumerFName==$consumer)
      {
        $filter = ['Consumer_id'=>$consumer_id];
        $query = new MongoDB\Driver\Query($filter);
        $cursor =$GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Students',$query);
      }
    }
  }
/* ------------------------------------------- end:paging --------------------------------------------------------------------------------------*/
?>