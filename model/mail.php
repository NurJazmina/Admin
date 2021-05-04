<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require_once "vendor/autoload.php";

if (isset($_POST['Staffmail']))
{
    $subject = $_POST['compose_subject'];
    $message = $_POST['message'];
    $FromName = strval($_SESSION["loggeduser_consumerFName"]);
    $SchoolName = strval($_SESSION["loggeduser_schoolName"]);
    $SchoolEmail = strval($_SESSION["loggeduser_SchoolsEmail"]);
    $Bcc = $_POST['compose_Bcc'];

    $Emails = array();

    if ($Bcc == 'staff')
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
                    $Email = strval($document1->ConsumerEmail);
                    if($Email == "")
                    {
                      
                    }
                    else
                    {
                        $Email = strval($document1->ConsumerEmail);
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
            $staffid = strval($document->ConsumerID);
            $StaffLevel = strval($document->StaffLevel);
    
            if ($StaffLevel == 0)
            {
                $filter1 = ['_id'=>new \MongoDB\BSON\ObjectID($staffid)];
                $query1 = new MongoDB\Driver\Query($filter1);
                $cursor1 = $GoNGetzDatabase->executeQuery('GoNGetz.Consumer',$query1);
    
                foreach ($cursor1 as $document1)
                {
                    $Email = strval($document1->ConsumerEmail);
                    if($Email == "")
                    {
                      
                    }
                    else
                    {
                        $Email = strval($document1->ConsumerEmail);
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
            $staffid = strval($document->ConsumerID);
            $StaffLevel = strval($document->StaffLevel);
    
                $filter1 = ['_id'=>new \MongoDB\BSON\ObjectID($staffid)];
                $query1 = new MongoDB\Driver\Query($filter1);
                $cursor1 = $GoNGetzDatabase->executeQuery('GoNGetz.Consumer',$query1);

                foreach ($cursor1 as $document1)
                {
                    $Email = strval($document1->ConsumerEmail);
                    if($Email == "")
                    {
                      
                    }
                    else
                    {
                        $Email = strval($document1->ConsumerEmail);
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
            $ConsumerID = strval($document->ConsumerID);
            $filter1 = ['_id'=>new \MongoDB\BSON\ObjectID($ConsumerID)];
            $query1 = new MongoDB\Driver\Query($filter1);
            $cursor1 = $GoNGetzDatabase->executeQuery('GoNGetz.Consumer',$query1);

            foreach ($cursor1 as $document1)
            {
                $Email = strval($document1->ConsumerEmail);
                if($Email == "")
                {
                  
                }
                else
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
                $Email = strval($document1->ConsumerEmail);
                if($Email == "")
                {
                  
                }
                else
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
                $Email = strval($document1->ConsumerEmail);
                if($Email == "")
                {
                  
                }
                else
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
        $mail->Body ="<i> $message </i><p>Thanks,<br />".$FromName."</p>
        <html>
        <body>                
        <div class='footer' style='clear: both; Margin-top: 10px; text-align: center; width: 100%;'>
        <table border='0' cellpadding='0 cellspacing='0' style='border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%;'>
            <tr>
            <td class='content-block' style='font-family: sans-serif; vertical-align: top; padding-bottom: 10px; padding-top: 10px; font-size: 12px; color: #999999; text-align: center;'>
                <span class='apple-link' style='color: #999999; font-size: 12px; text-align: center;'>G&G Softech Sdn Bhd, 75-1, jalan pudu lama, 50200, wilayah persekutuan, kuala lumpur</span>
                <br>gongetz.com<br> Don't like these emails? <a href='mailto:care@gongetz.com' class='btn btn-danger btn-sm'>Report Spam</a>.
            </td>
            </tr>
        </table>
        </div>             
        </body>
        </html>
        ";
        $mail->AltBody = "This is the plain text version of the email content";

        try { $mail->send(); echo "Message has been sent successfully";} 

        catch (Exception $e) { echo "Mailer Error: " . $mail->ErrorInfo;}

}

if (isset($_POST['Teachermail']))
{
    $subject = $_POST['compose_subject'];
    $message = $_POST['message'];
    $FromName = strval($_SESSION["loggeduser_consumerFName"]);
    $SchoolName = strval($_SESSION["loggeduser_schoolName"]);
    $SchoolEmail = strval($_SESSION["loggeduser_SchoolsEmail"]);
    $Bcc = $_POST['compose_Bcc'];

    $Emails = array();
    if ($Bcc == 'all')
    {
        //
        $filter = ['Schools_id'=>$_SESSION["loggeduser_schoolID"],'Class_id'=>$_SESSION["loggeduser_ClassID"]];
        $query = new MongoDB\Driver\Query($filter);
        $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Students',$query);
        foreach ($cursor as $document)
        {
            $studentid = strval($document->_id);
            $Class_id = strval($document->Class_id);

            $filter = ['StudentID'=>$studentid];
            $query = new MongoDB\Driver\Query($filter);
            $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.ParentStudentRel',$query);
            foreach ($cursor as $document)
            {
                $ParentID = strval($document->ParentID);

                $filter = ['_id'=>new \MongoDB\BSON\ObjectId($ParentID)];
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
                        $Email = strval($document1->ConsumerEmail);
                        if($Email == "")
                        {
                          
                        }
                        else
                        {
                            $Email = strval($document1->ConsumerEmail);
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
        <body>                
        <div class='footer' style='clear: both; Margin-top: 10px; text-align: center; width: 100%;'>
        <table border='0' cellpadding='0 cellspacing='0' style='border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%;'>
            <tr>
            <td class='content-block' style='font-family: sans-serif; vertical-align: top; padding-bottom: 10px; padding-top: 10px; font-size: 12px; color: #999999; text-align: center;'>
                <span class='apple-link' style='color: #999999; font-size: 12px; text-align: center;'>G&G Softech Sdn Bhd, 75-1, jalan pudu lama, 50200, wilayah persekutuan, kuala lumpur</span>
                <br>gongetz.com<br> Don't like these emails? <a href='mailto:care@gongetz.com' class='btn btn-danger btn-sm'>Report Spam</a>.
            </td>
            </tr>
        </table>
        </div>             
        </body>
        </html>
        ";
        $mail->AltBody = "This is the plain text version of the email content";

        try { $mail->send(); echo "Message has been sent successfully";} 

        catch (Exception $e) { echo "Mailer Error: " . $mail->ErrorInfo;}

}