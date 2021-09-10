<?php
if (isset($_POST['editnotes']))
{
    $notes_id = $_POST['notes_id'];
    $topic = $_POST['topic'];
    $detail = $_POST['detail'];

    $bulk = new MongoDB\Driver\BulkWrite(['ordered' => TRUE]);
    $bulk->update(['_id' => new \MongoDB\BSON\ObjectID($notes_id)],
                  ['$set' => ['Title'=>$topic, 'Detail'=>$detail]]
                 );
    $writeConcern = new MongoDB\Driver\WriteConcern(MongoDB\Driver\WriteConcern::MAJORITY, 1000);
    try
    {
      $result = $GoNGetzDatabase->executeBulkWrite('GoNGetzSmartSchool.OL_Notes', $bulk, $writeConcern);
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
if (isset($_POST['hidenotes']))
{
    $notes_id = $_POST['notes_id'];
    $bulk = new MongoDB\Driver\BulkWrite(['ordered' => TRUE]);
    $bulk->update(['_id' => new \MongoDB\BSON\ObjectID($notes_id)],
                  ['$set' => ['status'=>'hide']]
                 );
    $writeConcern = new MongoDB\Driver\WriteConcern(MongoDB\Driver\WriteConcern::MAJORITY, 1000);
    try
    {
      $result = $GoNGetzDatabase->executeBulkWrite('GoNGetzSmartSchool.OL_Notes', $bulk, $writeConcern);
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
if (isset($_POST['deletenotes']))
{
  $notes_id = $_POST['notes_id'];
  $bulk = new MongoDB\Driver\BulkWrite;
  $bulk->delete(['_id'=>new \MongoDB\BSON\ObjectID($notes_id)], ['limit' => 1]);
  $writeConcern = new MongoDB\Driver\WriteConcern(MongoDB\Driver\WriteConcern::MAJORITY, 1000);
  try
  {
    $result =$GoNGetzDatabase->executeBulkWrite('GoNGetzSmartSchool.OL_Notes', $bulk, $writeConcern);
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
}
