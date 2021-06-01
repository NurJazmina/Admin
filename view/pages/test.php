$bulk = new MongoDB\Driver\BulkWrite(['ordered' => TRUE]);
  $bulk->update(['_id'=>  new \MongoDB\BSON\ObjectID($varclassid)],
                ['$set' => ['ClassName'=>$varclassname , 'ClassCategory'=>$varclasscategory]],
                ['upsert' => TRUE]
               );
  $writeConcern = new MongoDB\Driver\WriteConcern(MongoDB\Driver\WriteConcern::MAJORITY, 1000);

  try
  {
    $result = $GoNGetzDatabase->executeBulkWrite('GoNGetzSmartSchool.Classrooms', $bulk, $writeConcern);
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