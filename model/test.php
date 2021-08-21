<?php
if (isset($_POST['login']))
{
    $filter = ['ConsumerIDNo' => $_POST['txtID']];
    $option = ['limit' => 1];
    $query = new MongoDB\Driver\Query($filter,$option);
    $cursor = $GoNGetzDatabase->executeQuery('GoNGetz.Consumer', $query);
    foreach ($cursor as $document)
    {
        $password_hash = ($document->ConsumerPassword);
        $ConsumerStatus = ($document->ConsumerStatus);
        if (password_verify($_POST['txtPassword'], $password_hash))
        {
            if($ConsumerStatus == 'ACTIVE')
            {
                $_SESSION["loggeduser_id"] = strval($document->_id);
                $_SESSION["loggeduser_consumerFName"] = ($document->ConsumerFName);
                $_SESSION["loggeduser_consumerLName"] = ($document->ConsumerLName);
                $_SESSION["loggeduser_consumerIDType"] = ($document->ConsumerIDType);
                $_SESSION["loggeduser_consumerIDNo"] = ($document->ConsumerIDNo);
                $_SESSION["loggeduser_consumerEmail"] = ($document->ConsumerEmail);
                $_SESSION["loggeduser_consumerPhone"] = ($document->ConsumerPhone);
                $_SESSION["loggeduser_consumerAddress"] = ($document->ConsumerAddress);
                $_SESSION["loggeduser_consumerPostcode"] = ($document->ConsumerPostcode);
                $_SESSION["loggeduser_consumerCity"] = ($document->ConsumerCity);
                $_SESSION["loggeduser_consumerState"] = ($document->ConsumerState);
                $_SESSION["loggeduser_consumerStatus"] = ($document->ConsumerStatus);
                $_SESSION["loggeduser_ConsumerGroup_id"] = ($document->ConsumerGroup_id);

                $filter1 = ['ConsumerID'=>$_SESSION["loggeduser_id"]];
                $query1 = new MongoDB\Driver\Query($filter1);
                $cursor1 = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Staff',$query1);
                foreach ($cursor1 as $document1)
                {
                    $_SESSION["loggeduser_schoolID"] = strval($document1->SchoolID);
                    $_SESSION["loggeduser_teacherid"] = strval($document1->_id);
                    $_SESSION["loggeduser_StaffLevel"] = strval($document1->StaffLevel);
                    $_SESSION["loggeduser_ConsumerID"] = ($document1->ConsumerID);
                    $_SESSION["loggeduser_ClassID"] = strval($document1->ClassID);
                    $_SESSION["loggeduser_Staffdepartment"] = strval($document1->Staffdepartment);
                }
            }
            else
            {
                echo "tak active";
            }
        }
        else
        {
            echo "tak sama";
        }
    }
}

if (isset($_POST['Adddata']))
{
    $txtID = $_POST['txtID'];
    $txtPassword = $_POST['txtPassword'];
    $SchoolID = $_SESSION["loggeduser_schoolID"];

    $bulk = new MongoDB\Driver\BulkWrite(['ordered' => TRUE]);
    $bulk->insert(['ID'=>$txtID,'Password'=> $txtPassword,'School_id'=> $SchoolID]);

    $writeConcern = new MongoDB\Driver\WriteConcern(MongoDB\Driver\WriteConcern::MAJORITY, 1000);
    $result =$GoNGetzDatabase->executeBulkWrite('GoNGetzSmartSchool.Test', $bulk, $writeConcern);
}
?>