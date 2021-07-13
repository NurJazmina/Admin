<?php
  $URL = "$_SERVER[REQUEST_URI]";
  $url = "";

	if (!isset($_SESSION[$URL]) && empty($_SESSION[$URL]))
	{
    $filter = ['url'=>$URL];
    $query = new MongoDB\Driver\Query($filter);
    $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Views',$query);
    foreach ($cursor as $document)
    {
        $url = strval($document->url);
        $count = strval($document->count);
    }

    if ($url == "")
    {
      $filter = ['url'=>$URL];
      $query = new MongoDB\Driver\Query($filter);
      $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Views',$query);
      foreach ($cursor as $document)
      {
          $url = strval($document->url);
          $count = strval($document->count);
      }
        $bulk = new MongoDB\Driver\BulkWrite(['ordered' => TRUE]);
        $bulk->insert(['url'=>$URL,
                      'count'=>1]);
        $writeConcern = new MongoDB\Driver\WriteConcern(MongoDB\Driver\WriteConcern::MAJORITY, 1000);
        try
        {
          $result =$GoNGetzDatabase->executeBulkWrite('GoNGetzSmartSchool.Views', $bulk, $writeConcern);
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
        $_SESSION[$URL] = $URL;
    }
    else
    {
        $filter = ['url'=>$URL];
        $query = new MongoDB\Driver\Query($filter);
        $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Views',$query);
        foreach ($cursor as $document)
        {
            $url = strval($document->url);
            $count = strval($document->count);
        }

        $varcount = 1 + $count;
        $bulk = new MongoDB\Driver\BulkWrite(['ordered' => TRUE]);
        $bulk->update(['url' => $URL],
                      ['$set' => ['count'=>$varcount]],
                      ['upsert' => TRUE]
                    );
        $writeConcern = new MongoDB\Driver\WriteConcern(MongoDB\Driver\WriteConcern::MAJORITY, 1000);
        try
        {
          $result =$GoNGetzDatabase->executeBulkWrite('GoNGetzSmartSchool.Views', $bulk, $writeConcern);
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
        $_SESSION[$URL] = $URL;
    }
	}

?>