<?php
if (isset($_POST['EditDetailFormSubmit'])) 
{
  $varConsumerFName = $_POST['txtConsumerFName'];
  $varConsumerLName = $_POST['txtConsumerLName'];
  $varConsumerIDType = $_POST['txtConsumerIDType'];
  $varConsumerIDNo = $_POST['txtConsumerIDNo'];
  $varConsumerPhone = $_POST['txtConsumerPhone'];
  $varConsumerAddress = $_POST['txtConsumerAddress'];
  $varConsumerEmail = $_POST['txtConsumerEmail'];
  $varconsumerid = $_POST['txtconsumerid'];
  $bulk = new MongoDB\Driver\BulkWrite(['ordered' => TRUE]);
  $bulk->update(['_id' => new \MongoDB\BSON\ObjectID($varconsumerid)],
                ['$set' => ['ConsumerFName'=>$varConsumerFName, 'ConsumerLName'=>$varConsumerLName,  'ConsumerIDType'=>$varConsumerIDType, 'ConsumerIDNo'=>$varConsumerIDNo, 'ConsumerPhone'=>$varConsumerPhone,'ConsumerAddress'=>$varConsumerAddress, 'ConsumerEmail'=>$varConsumerEmail]],
                ['upsert' => TRUE]
               );

  $writeConcern = new MongoDB\Driver\WriteConcern(MongoDB\Driver\WriteConcern::MAJORITY, 1000);
  try 
  {
    $result = $GoNGetzDatabase->executeBulkWrite('GoNGetz.Consumer', $bulk, $writeConcern);
  } 
  catch (MongoDB\Driver\Exception\BulkWriteException $e) 
  {
    $result = $e->getWriteResult();
    $_SESSION["loggeduser_schoolName"] = $varschoolname;
    // Check if the write concern could not be fulfilled
    if ($writeConcernError = $result->getWriteConcernError()) 
    {
        
        printf("%s (%d): %s\n",
            $writeConcernError->getMessage(),
            $writeConcernError->getCode(),
            var_export($writeConcernError->getInfo(), true)
        );
    }
    // Check if any write operations did not complete at all
    foreach ($result->getWriteErrors() as $writeError) 
    {
        printf("Operation#%d: %s (%d)\n",
            $writeError->getIndex(),
            $writeError->getMessage(),
            $writeError->getCode()
        );
    }
  } 
  catch (MongoDB\Driver\Exception\Exception $e) 
  {
    printf("Other error: %s\n", $e->getMessage());
    exit;
  }
printf("nMatched: %d\n", $result->getMatchedCount());
printf("Updated  %d document(s)\n", $result->getModifiedCount());
header ('location: ../index.php?page=aboutme');
}
?>