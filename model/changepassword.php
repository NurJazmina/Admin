<? ob_start(); ?>
<?php
if (isset($_POST['ChangePasswordFormSubmit'])) {
  $options = ['cost' => 4,];
  $varstaffpassword = password_hash($_POST['txtPassword'], PASSWORD_DEFAULT, $options);
  
  $loggedinid = $_POST['txtid'];
  $id = new \MongoDB\BSON\ObjectId($loggedinid);
  $bulk = new MongoDB\Driver\BulkWrite;
  $bulk->update(
    ['_id' => $id],
    ['$set' => ['ConsumerPassword' => $varstaffpassword]],
    ['multi' => false, 'upsert' => false]
  );
  
  $GoNGetzSmartSchoolFrontEndConnectionString="mongodb://admin:TempPassword@124.217.235.244:27017/gngoffice?authSource=admin";
  $GoNGetzSmartSchoolFrontEnd= new MongoDB\Driver\Manager($GoNGetzSmartSchoolFrontEndConnectionString);
  
   try {
    $result = $GoNGetzSmartSchoolFrontEnd->executeBulkWrite('GoNGetz.Consumer',$bulk);
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


  
header ('location: ../index.php?page=home&action=passwordchanged&id='.$_POST['txtid'].'&pass='.$varstaffpassword);

}
?>
<? ob_flush(); ?>