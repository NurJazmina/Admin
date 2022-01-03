<?php
if (isset($_POST['LoginFormSubmit']))
{
  $filter = ['user_id' => $_POST['txtID']];
  $option = ['limit' => 1];
  $query = new MongoDB\Driver\Query($filter,$option);
  $cursor = $GnGBazzar->executeQuery('gngbazzar.user', $query);
  foreach ($cursor as $document)
  {
    //ConsumerPassword using password_hash method
    $password_hash = $document->password;
    //convert password using password_verify
    // if (password_verify($_POST['txtPassword'], $password_hash))
    // {
      if ($document->status=='success')
      {
        $_SESSION["loggeduser_id"] = strval($document->_id);
        $_SESSION["loggeduser_user_id"] = $document->user_id;
        $_SESSION["loggeduser_username"] = $document->username;
        $_SESSION["loggeduser_email"] = $document->email;
        header ('location: index.php?page=dashboard&action=loginsuccesful');
      }
      else
      {
        header ('location: index.php?action=invalidlogin');
      }
    // }
  }
}
?>