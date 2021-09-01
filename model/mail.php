<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require_once "vendor/autoload.php";

if (isset($_POST['staff_mail']))
{
    $subject = $_POST['compose_subject'];
    $message = $_POST['message'];
    $FromName = $_SESSION["loggeduser_consumerFName"];
    $SchoolName = $_SESSION["loggeduser_schoolName"];
    $SchoolEmail = $_SESSION["loggeduser_SchoolsEmail"];
    $Bcc = $_POST['compose_Bcc'];

    $Emails = array();
    if ($Bcc == 'staff')
    {
      $filter = ['SchoolID'=>$_SESSION["loggeduser_schoolID"]];
      $query = new MongoDB\Driver\Query($filter);
      $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Staff',$query);
      foreach ($cursor as $document)
      {
        $ConsumerID = $document->ConsumerID;
        $StaffLevel = strval($document->StaffLevel);

        if ($StaffLevel == 1)
        {
          $filter = ['_id'=>new \MongoDB\BSON\ObjectID($ConsumerID)];
          $query = new MongoDB\Driver\Query($filter);
          $cursor = $GoNGetzDatabase->executeQuery('GoNGetz.Consumer',$query);
          foreach ($cursor as $document1)
          {
            $Email = $document1->ConsumerEmail;
            if($Email !== "")
            {
              array_push($Emails, $Email);
            }
          }
        }
      }
    }
    elseif ($Bcc == 'teacher')
    {
      $filter = ['SchoolID'=>$_SESSION["loggeduser_schoolID"]];
      $query = new MongoDB\Driver\Query($filter);
      $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Staff',$query);
      foreach ($cursor as $document)
      {
        $ConsumerID = $document->ConsumerID;
        $StaffLevel = strval($document->StaffLevel);

        if ($StaffLevel == 0)
        {
          $filter = ['_id'=>new \MongoDB\BSON\ObjectID($ConsumerID)];
          $query = new MongoDB\Driver\Query($filter);
          $cursor = $GoNGetzDatabase->executeQuery('GoNGetz.Consumer',$query);
          foreach ($cursor as $document1)
          {
            $Email = $document1->ConsumerEmail;
            if($Email !== "")
            {
              array_push($Emails, $Email);
            }
          }
        }
      }
    }
    elseif ($Bcc == 'school')
    {
      $filter = ['SchoolID'=>$_SESSION["loggeduser_schoolID"]];
      $query = new MongoDB\Driver\Query($filter);
      $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Staff',$query);
      foreach ($cursor as $document)
      {
        $ConsumerID = $document->ConsumerID;
        $StaffLevel = strval($document->StaffLevel);

        $filter = ['_id'=>new \MongoDB\BSON\ObjectID($ConsumerID)];
        $query = new MongoDB\Driver\Query($filter);
        $cursor = $GoNGetzDatabase->executeQuery('GoNGetz.Consumer',$query);

        foreach ($cursor as $document1)
        {
          $Email = $document1->ConsumerEmail;
          if($Email !== "")
          {
            array_push($Emails, $Email);
          }
        }
      }
    }
    elseif ($Bcc == 'parent')
    {
      $filter = ['Schools_id'=>$_SESSION["loggeduser_schoolID"]];
      $query = new MongoDB\Driver\Query($filter);
      $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Parents',$query);
      foreach ($cursor as $document)
      {
        $ConsumerID = $document->ConsumerID;
        $filter = ['_id'=>new \MongoDB\BSON\ObjectID($ConsumerID)];
        $query = new MongoDB\Driver\Query($filter);
        $cursor = $GoNGetzDatabase->executeQuery('GoNGetz.Consumer',$query);

        foreach ($cursor as $document1)
        {
          $Email = $document1->ConsumerEmail;
          if($Email == "")
          {
            array_push($Emails, $Email);
          }
        }
      }
    }
    else
    {
      $filter = ['SchoolID'=>$_SESSION["loggeduser_schoolID"]];
      $query = new MongoDB\Driver\Query($filter);
      $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Staff',$query);
      foreach ($cursor as $document)
      {
        $ConsumerID = $document->ConsumerID;
        $filter = ['_id'=>new \MongoDB\BSON\ObjectID($ConsumerID)];
        $query = new MongoDB\Driver\Query($filter);
        $cursor = $GoNGetzDatabase->executeQuery('GoNGetz.Consumer',$query);

        foreach ($cursor as $document1)
        {
          $Email = $document1->ConsumerEmail;
          if($Email == "")
          {
            array_push($Emails, $Email);
          }
        }
      }
      $filter = ['Schools_id'=>$_SESSION["loggeduser_schoolID"]];
      $query = new MongoDB\Driver\Query($filter);
      $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Parent',$query);
      foreach ($cursor as $document)
      {
        $ConsumerID = $document->ConsumerID;
        $filter = ['_id'=>new \MongoDB\BSON\ObjectID($ConsumerID)];
        $query = new MongoDB\Driver\Query($filter);
        $cursor = $GoNGetzDatabase->executeQuery('GoNGetz.Consumer',$query);

        foreach ($cursor as $document1)
        {
          $Email = $document1->ConsumerEmail;
          if($Email == "")
          {
            $Email = $document1->ConsumerEmail;
            array_push($Emails, $Email);
          }
        }
      }
    }

    //PHPMailer Object
    $mail = new PHPMailer(true);
    $mail->SMTPOptions = array(
        'ssl' => array(
            'verify_peer' => false,
            'verify_peer_name' => false,
            'allow_self_signed' => true
        )
    );

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
    $mail->addAddress($SchoolEmail,$SchoolName);

    //Address to which recipient will reply
    $mail->addReplyTo($SchoolEmail,$SchoolName);

    //CC and BCC
    $mail->addCC("gngsoftech@gmail.com");
    
    foreach($Emails as $staff)
    {
        $mail->addBCC($staff);
    }
    //Send HTML or Plain Text email
    $mail->isHTML(true);
    $mail->Subject = "$SchoolName  - $subject";
    $mail->Body ="<i> $message </i><p>Thanks,<br />".$FromName."</p>

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
      <span class='preheader' style='color: transparent; display: none; height: 0; max-height: 0; max-width: 0; opacity: 0; overflow: hidden; mso-hide: all; visibility: hidden; width: 0;'> ".$message.".. </span>
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
                          <p style='font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; Margin-bottom: 15px;'> $message. </p>
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
                          <p style='font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; Margin-bottom: 15px;'>Thank you, $FromName .</p>
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
  try { $mail->send(); echo "Message has been sent successfully";} 
  catch (Exception $e) { echo "Mailer Error: " . $mail->ErrorInfo;}
}

if (isset($_POST['teacher_mail']))
{
    $subject = $_POST['compose_subject'];
    $message = $_POST['message'];
    $FromName = $_SESSION["loggeduser_consumerFName"];
    $SchoolName = $_SESSION["loggeduser_schoolName"];
    $SchoolEmail = $_SESSION["loggeduser_SchoolsEmail"];
    $Bcc = $_POST['compose_Bcc'];

    $Emails = array();
    if ($Bcc == 'all')
    {
      $filter = ['Schools_id'=>$_SESSION["loggeduser_schoolID"],'Class_id'=>$_SESSION["loggeduser_ClassID"]];
      $query = new MongoDB\Driver\Query($filter);
      $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Students',$query);
      foreach ($cursor as $document)
      {
        $student_id = strval($document->_id);
        $Class_id = $document->Class_id;

        $filter = ['StudentID'=>$student_id];
        $query = new MongoDB\Driver\Query($filter);
        $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.ParentStudentRel',$query);
        foreach ($cursor as $document)
        {
          $ParentID = $document->ParentID;

          $filter = ['_id'=>new \MongoDB\BSON\ObjectId($ParentID)];
          $query = new MongoDB\Driver\Query($filter);
          $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Parents',$query);
          foreach ($cursor as $document)
          {
            $ConsumerID = $document->ConsumerID;

            $filter = ['_id'=>new \MongoDB\BSON\ObjectID($ConsumerID)];
            $query = new MongoDB\Driver\Query($filter);
            $cursor = $GoNGetzDatabase->executeQuery('GoNGetz.Consumer',$query);
            foreach ($cursor as $document1)
            {
              $Email = $document1->ConsumerEmail;
              if($Email !== "")
              {
                array_push($Emails, $Email);
              }
            }
          }
        }
      }
    }
    else
    {
      array_push($Emails, $Bcc);
    }
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
    $mail->SMTPDebug = 2;
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
    $mail->addAddress('azaharmyra95@gmail.com',$SchoolName);

    //Address to which recipient will reply
    $mail->addReplyTo('azaharmyra95@gmail.com',$SchoolName);

    //CC and BCC
    $mail->addCC("gngsoftech@gmail.com");
    
    foreach($Emails as $staff)
    {
      $mail->addBCC($staff);
    }
    //Send HTML or Plain Text email
    $mail->isHTML(true);

    $mail->Subject = "$SchoolName  - $subject";
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
      <span class='preheader' style='color: transparent; display: none; height: 0; max-height: 0; max-width: 0; opacity: 0; overflow: hidden; mso-hide: all; visibility: hidden; width: 0;'> ".$message.".. </span>
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
                          <p style='font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; Margin-bottom: 15px;'> $message. </p>
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
                          <p style='font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; Margin-bottom: 15px;'>Thank you, $FromName .</p>
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
  try { $mail->send(); echo "Message has been sent successfully";} 
  catch (Exception $e) { echo "Mailer Error: ".$mail->ErrorInfo;}
}