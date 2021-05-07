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
            $_SESSION["Staffdepartment"] = strval($document1->Staffdepartment);
            $schoolid = new \MongoDB\BSON\ObjectId($_SESSION["loggeduser_schoolID"]);
            $filter2 = ['_id'=>$schoolid];
            $query2 = new MongoDB\Driver\Query($filter2);
            $cursor2 = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Schools',$query2);

            foreach ($cursor2 as $document2)
            {
              $_SESSION["loggeduser_schoolName"] = strval($document2->SchoolsName);
              $_SESSION["loggeduser_schoolsPhoneNo"] = ($document2->SchoolsPhoneNo);
              $_SESSION["loggeduser_schoolsAddress"] = ($document2->SchoolsAddress);
              $_SESSION["loggeduser_SchoolsEmail"] = ($document2->SchoolsEmail);
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
         $_SESSION["loggeduser_teacherid"] = ($document1->_id);
         $_SESSION["loggeduser_StaffLevel"] = strval($document1->StaffLevel);
         $_SESSION["loggeduser_ConsumerID"] = ($document1->ConsumerID);
         $_SESSION["loggeduser_ClassID"] = strval($document1->ClassID);
         $_SESSION["loggeduser_Staffdepartment"] = strval($document1->Staffdepartment);
       }
       else
       {
       header ('location: index.php?action=invalidlogin');
       }
      }
    }
  }
?>
