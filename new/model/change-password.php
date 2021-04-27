<? ob_start(); ?>
<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include '../connections/db.php';
if (isset($_POST['ChangePasswordFormSubmit'])) {

  if($_POST['password']==$_POST['confirm_password'])
  {
    $options = ['cost' => 4,];
    $varstaffpassword = password_hash($_POST['password'], PASSWORD_DEFAULT, $options);
    
    $loggedinid = $_POST['txtid'];
    $id = new \MongoDB\BSON\ObjectId($loggedinid);
    $bulk = new MongoDB\Driver\BulkWrite;
    $bulk->update(
      ['_id' => $id],
      ['$set' => ['ConsumerPassword' => $varstaffpassword]],
      ['multi' => false, 'upsert' => false]
    );
    
    
    try {
      $result = $GoNGetzDatabase->executeBulkWrite('GoNGetz.Consumer',$bulk);
    } catch (MongoDB\Driver\Exception\BulkWriteException $e) {
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
    header ('location: ../index.php?page=change-password&password='.$varstaffpassword);
  }
  else
  header ('location: ../index.php?page=change-password&ERROR=NOTMATCHING');
}
?>
<? ob_flush(); ?>