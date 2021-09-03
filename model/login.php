<?php
  if (isset($_POST['LoginFormSubmit'])) //(isset($_GET['api_session']))
  {
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
         $_SESSION["loggeduser_consumerFName"] = $document->ConsumerFName;
         $_SESSION["loggeduser_consumerLName"] = $document->ConsumerLName;
         $_SESSION["loggeduser_consumerIDType"] = $document->ConsumerIDType;
         $_SESSION["loggeduser_consumerIDNo"] = $document->ConsumerIDNo;
         $_SESSION["loggeduser_consumerEmail"] = $document->ConsumerEmail;
         $_SESSION["loggeduser_consumerPhone"] = $document->ConsumerPhone;
         $_SESSION["loggeduser_consumerAddress"] = $document->ConsumerAddress;
         $_SESSION["loggeduser_consumerPostcode"] = $document->ConsumerPostcode;
         $_SESSION["loggeduser_consumerCity"] = $document->ConsumerCit;
         $_SESSION["loggeduser_consumerState"] = $document->ConsumerState;
         $_SESSION["loggeduser_consumerStatus"] = $document->ConsumerStatus;
         $_SESSION["loggeduser_ConsumerGroup_id"] = $document->ConsumerGroup_id;
         $_SESSION["loggeduser_ConsumerPassword"] = $document->ConsumerPassword;

          $Groupid = new \MongoDB\BSON\ObjectId($_SESSION["loggeduser_ConsumerGroup_id"]);
          $filter = ['_id'=>$Groupid];
          $query = new MongoDB\Driver\Query($filter);
          $cursor = $GoNGetzDatabase->executeQuery('GoNGetz.ConsumerGroup',$query);
          foreach ($cursor as $document)
          {
            $_SESSION["loggeduser_ConsumerGroupName"] = strval($document->ConsumerGroupName);
          }

          $filter = ['ConsumerID'=>$_SESSION["loggeduser_id"]];
          $query = new MongoDB\Driver\Query($filter);
          $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Staff',$query);
          foreach ($cursor as $document)
          {
            $_SESSION["loggeduser_teacherid"] = strval($document->_id);
            $_SESSION["loggeduser_school_id"] = $document->SchoolID;
            $_SESSION["loggeduser_StaffLevel"] = $document->StaffLevel;
            $_SESSION["loggeduser_ConsumerID"] = $document->ConsumerID;
            $_SESSION["loggeduser_ClassID"] = $document->ClassID;
            $_SESSION["loggeduser_Staffdepartment"] = $document->Staffdepartment;
            
            $filter = ['_id'=>new \MongoDB\BSON\ObjectId($_SESSION["loggeduser_school_id"])];
            $query = new MongoDB\Driver\Query($filter);
            $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Schools',$query);
            foreach ($cursor as $document)
            {
              $_SESSION["loggeduser_school_id"] = strval($document->_id);
              $_SESSION["loggeduser_schoolName"] = $document->SchoolsName;
              $_SESSION["loggeduser_schoolsPhoneNo"] = $document->SchoolsPhoneNo;
              $_SESSION["loggeduser_schoolsAddress"] = $document->SchoolsAddress;
              $_SESSION["loggeduser_SchoolsEmail"] = $document->SchoolsEmail;
            }

            $filter = ['_id'=>new \MongoDB\BSON\ObjectId($_SESSION["loggeduser_Staffdepartment"])];
            $query = new MongoDB\Driver\Query($filter);
            $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.SchoolsDepartment',$query);
            foreach ($cursor as $document)
            {
              $_SESSION["loggeduser_DepartmentName"] = $document->DepartmentName;
            }
          }

          $filter = ['Consumer_id'=>$_SESSION["loggeduser_id"]];
          $query = new MongoDB\Driver\Query($filter);
          $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Students',$query);
          foreach ($cursor as $document)
          {
            $_SESSION["loggeduser_studentid"] = strval($document->_id);
            $_SESSION["loggeduser_Schools_id"] = $document->Schools_id;
            $_SESSION["loggeduser_Class_id"] = $document->Class_id;

            $filter = ['_id'=>new \MongoDB\BSON\ObjectId($_SESSION["loggeduser_Schools_id"])];
            $query = new MongoDB\Driver\Query($filter);
            $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Schools',$query);
            foreach ($cursor as $document)
            {
              $_SESSION["loggeduser_school_id"] = strval($document->_id);
              $_SESSION["loggeduser_schoolName"] = $document->SchoolsName;
              $_SESSION["loggeduser_schoolsPhoneNo"] = $document->SchoolsPhoneNo;
              $_SESSION["loggeduser_schoolsAddress"] = $document->SchoolsAddress;
              $_SESSION["loggeduser_SchoolsEmail"] = $document->SchoolsEmail;
            }
            
            $filter = ['_id'=>new \MongoDB\BSON\ObjectId($_SESSION["loggeduser_Class_id"])];
            $query = new MongoDB\Driver\Query($filter);
            $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Classrooms',$query);
            foreach ($cursor as $document)
            {
              $_SESSION["loggeduser_class_id"] = $document->_id;
              $_SESSION["loggeduser_ClassCategory"] = $document->ClassCategory;
              $_SESSION["loggeduser_ClassName"] = $document->ClassName;
            }

            $filter = ['_id'=>new \MongoDB\BSON\ObjectId($_SESSION["loggeduser_class_id"])];
            $query = new MongoDB\Driver\Query($filter);
            $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.ClassroomSubjectRel',$query);
            foreach ($cursor as $document)
            {
              $_SESSION["loggeduser_Subject_id"] = $document->Subject_id;
            }

            $filter = ['_id'=>new \MongoDB\BSON\ObjectId($_SESSION["loggeduser_Subject_id"])];
            $query = new MongoDB\Driver\Query($filter);
            $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.SchoolsSubject',$query);
            foreach ($cursor as $document)
            {
              $_SESSION["loggeduser_SubjectName"] = $document->SubjectName;
              $_SESSION["loggeduser_Class_category"] = $document->Class_category;
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
            $_SESSION["loggeduser_school_id"] = '';
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
          elseif (($_SESSION["loggeduser_ConsumerGroupName"] == 'STUDENT'))
          {
            $_SESSION["loggeduser_ACCESS"] = "STUDENT";
          }
          // this function coming soon!
          //elseif ($_SESSION["loggeduser_ConsumerGroupName"] == 'PARENT')
          //{
          // $_SESSION["loggeduser_ACCESS"] = "PARENT";
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