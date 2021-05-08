<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

  if (isset($_POST['LoginFormSubmit']))
  {
    $filter = ['ConsumerIDNo' => $_POST["txtID"]];
    $option = ['limit' => 1];
    $query = new MongoDB\Driver\Query($filter,$option);
    $cursor = $GoNGetzDatabase->executeQuery('GoNGetz.Consumer', $query);

    /* $cursor now contains an object that wraps around the document set.
    use foreach() to iterate over all the document */
    foreach ($cursor as $document)
    {
      //ConsumerPassword using password_hash method
      $password_hash = ($document->ConsumerPassword);
      //convert password using password_verify
      if (password_verify($_POST["txtPassword"], $password_hash))
      {
       if ($document->ConsumerStatus=='ACTIVE')
       {
         $_SESSION["loggeduser_id"] = strval($document->_id);
         $_SESSION["loggeduser_consumerFName"] = strval($document->ConsumerFName);
         $_SESSION["loggeduser_consumerLName"] = strval($document->ConsumerLName);
         $_SESSION["loggeduser_consumerIDType"] = strval($document->ConsumerIDType);
         $_SESSION["loggeduser_consumerIDNo"] = strval($document->ConsumerIDNo);
         $_SESSION["loggeduser_consumerEmail"] = strval($document->ConsumerEmail);
         $_SESSION["loggeduser_consumerPhone"] = strval($document->ConsumerPhone);
         $_SESSION["loggeduser_consumerAddress"] = strval($document->ConsumerAddress);
         $_SESSION["loggeduser_consumerPostcode"] = strval($document->ConsumerPostcode);
         $_SESSION["loggeduser_consumerCity"] = strval($document->ConsumerCity);
         $_SESSION["loggeduser_consumerState"] = strval($document->ConsumerState);
         $_SESSION["loggeduser_consumerStatus"] = strval($document->ConsumerStatus);
         $_SESSION["loggeduser_ConsumerGroup_id"] = strval($document->ConsumerGroup_id);

         if($_SESSION["loggeduser_ConsumerGroup_id"] == '601b4f1697728c027c01f188')
         {
          header ('location: index.php?page=gongetz&action=loginsuccesful');
         }
         elseif($_SESSION["loggeduser_ConsumerGroup_id"] == '601b4cfd97728c027c01f187')
         {
            $filter1 = ['ConsumerID'=>$_SESSION["loggeduser_id"]];
            $query1 = new MongoDB\Driver\Query($filter1);
            $cursor1 = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Staff',$query1);
            foreach ($cursor1 as $document1)
            {
              $_SESSION["loggeduser_schoolID"] = strval($document1->SchoolID);
              $_SESSION["Staffdepartment"] = strval($document1->Staffdepartment);
              $schoolid = new \MongoDB\BSON\ObjectId($_SESSION["loggeduser_schoolID"]);
              $filter2 = ['_id'=>$schoolid];
              $query2 = new MongoDB\Driver\Query($filter2);
              $cursor2 = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Schools',$query2);
  
              foreach ($cursor2 as $document2)
              {
                $_SESSION["loggeduser_schoolName"] = strval($document2->SchoolsName);
                $_SESSION["loggeduser_schoolsPhoneNo"] = strval($document2->SchoolsPhoneNo);
                $_SESSION["loggeduser_schoolsAddress"] = strval($document2->SchoolsAddress);
                $_SESSION["loggeduser_SchoolsEmail"] = strval($document2->SchoolsEmail);
                header ('location: index.php?page=dashboard&action=loginsuccesful');
              }

              $departmentid = new \MongoDB\BSON\ObjectId($_SESSION["Staffdepartment"]);
              $filter3 = ['_id'=>$departmentid];
              $query3 = new MongoDB\Driver\Query($filter3);
              $cursor3 = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.SchoolsDepartment',$query3);
              foreach ($cursor3 as $document3)
              {
                $_SESSION["loggeduser_DepartmentName"] = strval($document3->DepartmentName);
              }
            }
         }
            $_SESSION["loggeduser_teacherid"] = strval($document1->_id);
            $_SESSION["loggeduser_StaffLevel"] = strval($document1->StaffLevel);
            $_SESSION["loggeduser_ConsumerID"] = strval($document1->ConsumerID);
            $_SESSION["loggeduser_ClassID"] = strval($document1->ClassID);
            $_SESSION["loggeduser_Staffdepartment"] = strval($document1->Staffdepartment);

            if ($_SESSION["loggeduser_StaffLevel"] == '1')
            {
              $_SESSION["loggeduser_Staff"] = "STAFF";
            }
            else
            {
              $_SESSION["loggeduser_Staff"] = "TEACHER";
            }
       }
       else
       {
       header ('location: index.php?action=invalidlogin');
       }
      }
    }
  }
?>
