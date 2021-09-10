<?php
ob_start();
include '../connections/db.php';
if (isset($_POST['change_password'])) 
{
  if($_POST['password']==$_POST['confirm_password'])
  {
    $options = ['cost' => 4,];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT, $options);

    $bulk = new MongoDB\Driver\BulkWrite;
    $bulk->update(
      ['_id' => new \MongoDB\BSON\ObjectId($_SESSION["loggeduser_id"])],
      ['$set' => ['ConsumerPassword' => $password]],
      ['multi' => false, 'upsert' => false]
    );
    
    try 
    {
      $result = $GoNGetzDatabase->executeBulkWrite('GoNGetz.Consumer',$bulk);
    } 
    catch (MongoDB\Driver\Exception\BulkWriteException $e) 
    {
      $result = $e->getWriteResult();

      // Check if the write concern could not be fulfilled
      if ($writeConcernError = $result->getWriteConcernError()) {
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
    } catch (MongoDB\Driver\Exception\Exception $e) {
      printf("Other error: %s\n", $e->getMessage());
      exit;
    }
    header ('location: ../index.php?page=change-password&password='.$password);
  }
  else
  {
    header ('location: ../index.php?page=change-password&ERROR=NOTMATCHING');
  }
}
ob_flush();