<?php
  if (isset($_POST['LoginFormSubmit'])) //(isset($_GET['api_session']))
  {
    // header("Access-Control-Allow-Origin: *");
    // header("Content-Type: application/json; charset=UTF-8");
    // header("Access-Control-Allow-Methods: POST");
    // header("Access-Control-Max-Age: 3600");
    // header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    
    // $json = json_decode($_POST['json']);
    // $nric = $json['nric'];
    // $password = $json['password'];

    $filter = ['ConsumerIDNo' => $_POST['txtID']];
    $option = ['limit' => 1];
    $query = new MongoDB\Driver\Query($filter,$option);
    $cursor = $GoNGetzDatabase->executeQuery('GoNGetz.Consumer', $query);

    foreach ($cursor as $document)
    {
      //ConsumerPassword using password_hash method
      $password_hash = ($document->ConsumerPassword);
      //convert password using password_verify
      if (password_verify($_POST['txtPassword'], $password_hash))
      {
       if ($document->ConsumerStatus=='ACTIVE')
       {

         //$_SESSION["api_session"] = $_GET['api_session'];
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


          $Groupid = new \MongoDB\BSON\ObjectId($_SESSION["loggeduser_ConsumerGroup_id"]);
          $filter = ['_id'=>$Groupid];
          $query = new MongoDB\Driver\Query($filter);
          $cursor = $GoNGetzDatabase->executeQuery('GoNGetz.ConsumerGroup',$query);
          foreach ($cursor as $document)
          {
            $_SESSION["loggeduser_ConsumerGroupName"] = strval($document->ConsumerGroupName);
          }

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
              }
    
              $departmentid = new \MongoDB\BSON\ObjectId($_SESSION["loggeduser_Staffdepartment"] );
              $filter3 = ['_id'=>$departmentid];
              $query3 = new MongoDB\Driver\Query($filter3);
              $cursor3 = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.SchoolsDepartment',$query3);
    
              foreach ($cursor3 as $document3)
              {
                $_SESSION["loggeduser_DepartmentName"] = strval($document3->DepartmentName);
              }
          }

          if($_SESSION["loggeduser_ConsumerGroupName"] == 'SCHOOL')
          {
            if($_SESSION["loggeduser_StaffLevel"] == '1')
            {
              $_SESSION["loggeduser_ACCESS"] = "STAFF";
            }
            elseif ($_SESSION["loggeduser_StaffLevel"] == '0')
            {
              $_SESSION["loggeduser_ACCESS"] = "TEACHER";
            }
          }
          elseif ($_SESSION["loggeduser_ConsumerGroupName"] == 'GONGETZ')
          {
            $_SESSION["loggeduser_ACCESS"] = "STAFF";
            $_SESSION["loggeduser_schoolID"] = '';
            $_SESSION["loggeduser_teacherid"] = '';
            $_SESSION["loggeduser_StaffLevel"] = '';
            $_SESSION["loggeduser_ConsumerID"] = '';
            $_SESSION["loggeduser_ClassID"] = '';
            $_SESSION["loggeduser_Staffdepartment"] = '';
            $_SESSION["loggeduser_schoolName"] = '';
            $_SESSION["loggeduser_schoolsPhoneNo"] = '';
            $_SESSION["loggeduser_schoolsAddress"] = '';
            $_SESSION["loggeduser_SchoolsEmail"] = '';
            $_SESSION["loggeduser_DepartmentName"] = '';
          }
          // this function coming soon!
          //elseif ($_SESSION["loggeduser_ConsumerGroupName"] == 'PARENT')
          //{
          // $_SESSION["loggeduser_ACCESS"] = "PARENT";
          //}
          //else
          //{
          // $_SESSION["loggeduser_ACCESS"] = "STUDENT";
          //}
          header ('location: index.php?page=dashboard&action=loginsuccesful');
        
       }
       else
       {
       header ('location: index.php?action=invalidlogin');
       }
      }
    }
  }
    
?>