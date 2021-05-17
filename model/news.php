<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require_once "vendor/autoload.php";

if (isset($_POST['AddNews'])) 
{
    $varaccess = $_POST['access'];
    $vartitle = $_POST['txttitle'];
    $vardetail = $_POST['txtdetail'];
    $varstaffid = strval($_SESSION["loggeduser_id"]);
    $varschoolid = strval($_SESSION["loggeduser_schoolID"]);
    $SchoolNewsDate = new MongoDB\BSON\UTCDateTime((new DateTime('now'))->getTimestamp()*1000);

    $bulk = new MongoDB\Driver\BulkWrite(['ordered'=>true]);
    $bulk->insert([
      'school_id'=>$varschoolid,
      'NewsStaff_id'=>$varstaffid,
      'NewsTitle'=>$vartitle,
      'NewsDetails'=>$vardetail,
      'NewsAccess'=>$varaccess,
      'NewsStatus'=>'ACTIVE',
      'NewsDate'=>$SchoolNewsDate]);
    $writeConcern = new MongoDB\Driver\WriteConcern(MongoDB\Driver\WriteConcern::MAJORITY, 1000);
    try
    {
      $result =$GoNGetzDatabase->executeBulkWrite('GoNGetzSmartSchool.SchoolNews', $bulk, $writeConcern);
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
    printf("Inserted %d document(s)\n", $result->getInsertedCount());
    printf("Updated  %d document(s)\n", $result->getModifiedCount());

    $filter = ['NewsDate'=>$SchoolNewsDate];
    $query = new MongoDB\Driver\Query($filter);
    $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.SchoolNews',$query);
    foreach ($cursor as $document)
    {
      $NewsDate = ($document->NewsDate);
      $utcdatetime = new MongoDB\BSON\UTCDateTime(strval($NewsDate));
      $datetime = $utcdatetime->toDateTime()->setTimezone(new \DateTimeZone(date_default_timezone_get()));
    }
    $date = date_format($datetime,"d/M/Y");

    $Bcc = $_POST['access'];
    $FromNameF = strval($_SESSION["loggeduser_consumerFName"]);
    $FromNameL = strval($_SESSION["loggeduser_consumerLName"]);
    $SchoolName = strval($_SESSION["loggeduser_schoolName"]);
    $SchoolEmail = strval($_SESSION["loggeduser_SchoolsEmail"]);

    $Emails = array();

    if ($Bcc == 'STAFF')
    {
        $filter = ['SchoolID'=>$_SESSION["loggeduser_schoolID"]];
        $query = new MongoDB\Driver\Query($filter);
        $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Staff',$query);
        foreach ($cursor as $document)
        {
            $staffid = strval($document->ConsumerID);
            $StaffLevel = strval($document->StaffLevel);
    
            if ($StaffLevel == 1)
            {
                $filter1 = ['_id'=>new \MongoDB\BSON\ObjectID($staffid)];
                $query1 = new MongoDB\Driver\Query($filter1);
                $cursor1 = $GoNGetzDatabase->executeQuery('GoNGetz.Consumer',$query1);
    
                foreach ($cursor1 as $document1)
                {
                    $ConsumerFName = strval($document1->ConsumerFName);
                    $ConsumerLName = strval($document1->ConsumerLName);
                    $Email = strval($document1->ConsumerEmail);
                    if($Email != "")
                    {
                      $Email = strval($document1->ConsumerEmail);
                        array_push($Emails, $Email);
                    }
    
                }
            }
        }
    }
    elseif ($Bcc == 'TEACHER')
    {
        $filter = ['SchoolID'=>$_SESSION["loggeduser_schoolID"]];
        $query = new MongoDB\Driver\Query($filter);
        $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Staff',$query);
        foreach ($cursor as $document)
        {
            $staffid = strval($document->ConsumerID);
            $StaffLevel = strval($document->StaffLevel);
    
            if ($StaffLevel == 0)
            {
                $filter1 = ['_id'=>new \MongoDB\BSON\ObjectID($staffid)];
                $query1 = new MongoDB\Driver\Query($filter1);
                $cursor1 = $GoNGetzDatabase->executeQuery('GoNGetz.Consumer',$query1);
    
                foreach ($cursor1 as $document1)
                {
                    $ConsumerFName = strval($document1->ConsumerFName);
                    $ConsumerLName = strval($document1->ConsumerLName);
                    $Email = strval($document1->ConsumerEmail);
                    if($Email != "")
                    {
                      $Email = strval($document1->ConsumerEmail);
                        array_push($Emails, $Email);
                    }
    
                }
            }
        }
    }
    elseif ($Bcc == 'VIP')
    {
        $filter = ['Schools_id'=>$_SESSION["loggeduser_schoolID"]];
        $query = new MongoDB\Driver\Query($filter);
        $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Parents',$query);
        foreach ($cursor as $document)
        {
            $ConsumerID = strval($document->ConsumerID);
            $filter1 = ['_id'=>new \MongoDB\BSON\ObjectID($ConsumerID)];
            $query1 = new MongoDB\Driver\Query($filter1);
            $cursor1 = $GoNGetzDatabase->executeQuery('GoNGetz.Consumer',$query1);

            foreach ($cursor1 as $document1)
            {
                $ConsumerFName = strval($document1->ConsumerFName);
                $ConsumerLName = strval($document1->ConsumerLName);
                $Email = strval($document1->ConsumerEmail);
                if($Email != "")
                {
                  $Email = strval($document1->ConsumerEmail);
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
            $staffid = strval($document->ConsumerID);
            $filter1 = ['_id'=>new \MongoDB\BSON\ObjectID($staffid)];
            $query1 = new MongoDB\Driver\Query($filter1);
            $cursor1 = $GoNGetzDatabase->executeQuery('GoNGetz.Consumer',$query1);

            foreach ($cursor1 as $document1)
            {
                $ConsumerFName = strval($document1->ConsumerFName);
                $ConsumerLName = strval($document1->ConsumerLName);
                $Email = strval($document1->ConsumerEmail);
                if($Email != "")
                {
                  $Email = strval($document1->ConsumerEmail);
                    array_push($Emails, $Email);
                }
            }
        }
        $filter = ['Schools_id'=>$_SESSION["loggeduser_schoolID"]];
        $query = new MongoDB\Driver\Query($filter);
        $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Parent',$query);
        foreach ($cursor as $document)
        {
            $ConsumerID = strval($document->ConsumerID);
            $filter1 = ['_id'=>new \MongoDB\BSON\ObjectID($ConsumerID)];
            $query1 = new MongoDB\Driver\Query($filter1);
            $cursor1 = $GoNGetzDatabase->executeQuery('GoNGetz.Consumer',$query1);

            foreach ($cursor1 as $document1)
            {
                $ConsumerFName = strval($document1->ConsumerFName);
                $ConsumerLName = strval($document1->ConsumerLName);
                $Email = strval($document1->ConsumerEmail);
                if($Email != "")
                {
                  $Email = strval($document1->ConsumerEmail);
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

    $mail->Subject = "$SchoolName  - $vartitle";
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
                            <p>You got this email because you're a member of $SchoolName</p>
                            <p>There is a latest <a href='index.php?page=news'> $vartitle </a> from $FromNameF $FromNameL on $date and we tought it might need your attention.</p>
                            <p>Thanks,<br/>
                            <p>Go N Getz</p>
                            <p><small>Please don't reply to this email, it wont go anyway except to our great black hole.</small></p>
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

  try { $mail->send(); echo "Message has been sent successfully";} 

  catch (Exception $e) { echo "Mailer Error: " . $mail->ErrorInfo;}

}