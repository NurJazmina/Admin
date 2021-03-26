<?php
  if (isset($_POST['LoginFormSubmit']))
  {

    $filter = ['ConsumerIDNo' => $_POST["txtID"]];
    $option = ['limit' => 1];
    /* Query for all the items in the collection */
    $query = new MongoDB\Driver\Query($filter,$option);
    /* Query the "consumer" collection of the "gongetz" database */
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
         /* kita selesaikan dulu session user sebelumm kita query data lain.
         Ini untuk memudahkan kita nanti nak buat log. Contoh log orang cuba login,
         tapi dia bukan staff sekolah atau cikgu */
         $_SESSION["loggeduser_id"] = strval($document->_id);
         /* di atas, kita convert id kepada string. sebab tu ada strval.
         Kalau tak ianya dianggap sebagai object dan susah nak buat cross search dengan collection lain */
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

         /* sekarang kita dah ada $_SESSION["loggeduser_id"], so kita query GoNGetzSmartSchool.Staff ada tak id tu */
         $filter1 = ['ConsumerID'=>$_SESSION["loggeduser_id"]];
         $query1 = new MongoDB\Driver\Query($filter1);
         $cursor1 = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Staff',$query1);

          foreach ($cursor1 as $document1)
          {
            /*dah tak perlu if sebab kalau data tak wujud, foreach tak akan jalan
            if ($document->_id == $document1->ConsumerID),
            school id pun kita convert kepada string */
            $_SESSION["loggeduser_schoolID"] = strval($document1->SchoolID);

            /* sekarang kita dapatkan pula info sekolah */
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
            }
           // $_SESSION["loggeduser_consumerID"] = strval($document1->ConsumerID);
            header ('location: index.php?page=home&action=loginsuccesful');
          }
         //bypass detail staff
         $_SESSION["loggeduser_teacherid"] = ($document1->_id);
         $_SESSION["loggeduser_StaffLevel"] = ($document1->StaffLevel);
         $_SESSION["loggeduser_ConsumerID"] = ($document1->ConsumerID);
         $_SESSION["loggeduser_ClassID"] = strval($document1->ClassID);
         $_SESSION["Staffdepartment"] = strval($document1->Staffdepartment);
       }
       else
       {
       header ('location: index.php?action=invalidlogin');
       }
      }
    }
  }
?>
<?php include ('model/editschool.php'); ?>
