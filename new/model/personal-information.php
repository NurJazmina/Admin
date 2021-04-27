<?php 
if (isset($_POST['EditPersonalInformation'])){

    $varConsumerEmail = $_POST['txtConsumerEmail'];
    $varConsumerPhone = $_POST['txtConsumerPhone'];
    $varConsumerAddress = $_POST['txtConsumerAddress'];
    $varConsumerPostcode = $_POST['txtConsumerPostcode'];
    $varConsumercity = $_POST['txtConsumerCity'];
    $varConsumerstate = $_POST['txtConsumerState'];
    $varconsumerid = $_SESSION["loggeduser_id"];
    $bulk = new MongoDB\Driver\BulkWrite(['ordered' => TRUE]);
    $bulk->update(['_id' => new \MongoDB\BSON\ObjectID($varconsumerid)],
                  ['$set' => [
                  'ConsumerEmail'=>$varConsumerEmail,
                  'ConsumerPhone'=>$varConsumerPhone,
                  'ConsumerAddress'=>$varConsumerAddress,
                  'ConsumerPostcode'=>$varConsumerPostcode,
                  'Consumercity'=>$varConsumercity,
                  'Consumerstate'=>$varConsumerstate
                  ]],
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
  printf("Matched: %d\n", $result->getMatchedCount());
  printf("Updated  %d document(s)\n", $result->getModifiedCount());
  }
?>