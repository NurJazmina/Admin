<?php
if (isset($_POST['savequiz'])) {

  $URL = $_POST['URL'];
  $Consumer_id = strval($_SESSION["loggeduser_id"]);
  $School_id = strval($_SESSION["loggeduser_school_id"]);

  $varconsumerremarkdate = new MongoDB\BSON\UTCDateTime((new DateTime('now'))->getTimestamp()*1000);
  $bulk = new MongoDB\Driver\BulkWrite(['ordered'=>true]);
  $bulk->insert([
                  'School_id'=>$School_id,
                  'Consumer_id'=>$Consumer_id,
                  'url'=>$URL
                ]);
  $writeConcern = new MongoDB\Driver\WriteConcern(MongoDB\Driver\WriteConcern::MAJORITY, 1000);

  try
  {
    $result =$GoNGetzDatabase->executeBulkWrite('GoNGetzSmartSchool.OL_Collections', $bulk, $writeConcern);
  }
  catch (MongoDB\Driver\Exception\BulkWriteException $e)
  {
    $result = $e->getWriteResult();
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
    foreach ($result->getWriteErrors() as $writeError) {
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

printf("Inserted %d document(s)\n", $result->getInsertedCount());
}
?>
