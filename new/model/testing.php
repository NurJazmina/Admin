<?php
//Add parent
if (isset($_POST['AddParent']))
{
  $var_id = $_POST['txtid'];
  $varconsumer_id = $_POST['txtconsumer_id'];
  $varconsumerfname = $_POST['txtconsumerfname'];

  $var_id = new \MongoDB\BSON\ObjectId($var_id);
  $filter = ['_id'=>$var_id];
  $query = new MongoDB\Driver\Query($filter);
  $cursor = $GoNGetzDatabase->executeQuery('GoNGetz.testing',$query);

  foreach ($cursor as $document)
  {
      $varid = $document->_id;
      $vartotalparent = $document->totalparent;
      $vartotalstudent = $document->totalstudent;
      $i = $vartotalparent +1;

      $array =
      [
        'consumer_id'=>$varconsumer_id,
        'consumerfname'=>$varconsumerfname
      ];

      $bulk = new MongoDB\Driver\BulkWrite(['ordered' => TRUE]);
      $bulk->update(
                    ['_id' => new \MongoDB\BSON\ObjectID('6088cbc2ac580554e852df22')],
                    ['$set' => 
                      [
                        'parent'=> [$i=>$array]
                      ],
                    ],
                    ['upsert' => TRUE]
                    );
                    
      $writeConcern = new MongoDB\Driver\WriteConcern(MongoDB\Driver\WriteConcern::MAJORITY, 1000);
      try
      {
        $result=$GoNGetzDatabase->executeBulkWrite('GoNGetz.testing', $bulk, $writeConcern);
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
      printf("Modified %d document(s)\n",$result->getModifiedCount());
    }
}
?>

<?php
//Edit parent
if (isset($_POST['EditParent']))
{
  //$var_id = $_POST['txtid'];
  $varobject = $_POST['txtobject'];
  $varconsumer_id = $_POST['txtconsumer_id'];
  $varconsumerfname = $_POST['txtconsumerfname'];

  $var_id = new \MongoDB\BSON\ObjectId('608904ce41812f1a245c5078');
  $filter = ['_id'=>$var_id];
  $query = new MongoDB\Driver\Query($filter);
  $cursor = $GoNGetzDatabase->executeQuery('GoNGetz.testing',$query);

  foreach ($cursor as $document)
  {
      $varid = $document->_id;
      $vartotalparent = $document->totalparent;
      $vartotalstudent = $document->totalstudent;
      $i = $vartotalparent +1;

      $array =
      [
        'consumer_id'=>$varconsumer_id,
        'consumerfname'=>$varconsumerfname
      ];

      $bulk = new MongoDB\Driver\BulkWrite(['ordered' => TRUE]);
      $bulk->update(
        ['_id' => new \MongoDB\BSON\ObjectID('608904ce41812f1a245c5078')],
        ['$set' =>
          [
            'parent'=> [$varobject=>$array]
          ],
        ],
        ['upsert' => TRUE]
        );
                    
      $writeConcern = new MongoDB\Driver\WriteConcern(MongoDB\Driver\WriteConcern::MAJORITY, 1000);
      try
      {
        $result=$GoNGetzDatabase->executeBulkWrite('GoNGetz.testing', $bulk, $writeConcern);
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
      printf("Modified %d document(s)\n",$result->getModifiedCount());
    }
}
?>

<?php
//Add Student
if (isset($_POST['AddStudent']))
{
  $var_id = $_POST['txtid'];
  $varconsumer_id = $_POST['txtconsumer_id'];
  $varconsumerfname = $_POST['txtconsumerfname'];

  $var_id = new \MongoDB\BSON\ObjectId($var_id);
  $filter = ['_id'=>$var_id];
  $query = new MongoDB\Driver\Query($filter);
  $cursor = $GoNGetzDatabase->executeQuery('GoNGetz.testing',$query);

  foreach ($cursor as $document)
  {
      $varid = $document->_id;
      $vartotalparent = $document->totalparent;
      $vartotalstudent = $document->totalstudent;
      $i = $vartotalstudent +1;

      $array =
      [
        'consumer_id'=>$varconsumer_id,
        'consumerfname'=>$varconsumerfname
      ];

      $bulk = new MongoDB\Driver\BulkWrite(['ordered' => TRUE]);
      $bulk->update(
                    ['_id' => new \MongoDB\BSON\ObjectID('6088cbc2ac580554e852df22')],
                    ['$set' => 
                      [
                        'parent'=> [$i=>$array]
                      ],
                    ],
                    ['upsert' => TRUE]
                    );
                    
      $writeConcern = new MongoDB\Driver\WriteConcern(MongoDB\Driver\WriteConcern::MAJORITY, 1000);
      try
      {
        $result=$GoNGetzDatabase->executeBulkWrite('GoNGetz.testing', $bulk, $writeConcern);
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
      printf("Modified %d document(s)\n",$result->getModifiedCount());
    }
}
?>

<?php
//Edit Student
if (isset($_POST['EditStudent']))
{
  $var_id = $_POST['txtid'];
  $varconsumer_id = $_POST['txtconsumer_id'];
  $varconsumerfname = $_POST['txtconsumerfname'];

  $var_id = new \MongoDB\BSON\ObjectId($var_id);
  $filter = ['_id'=>$var_id];
  $query = new MongoDB\Driver\Query($filter);
  $cursor = $GoNGetzDatabase->executeQuery('GoNGetz.testing',$query);

  foreach ($cursor as $document)
  {
      $varid = $document->_id;
      $vartotalparent = $document->totalparent;
      $vartotalstudent = $document->totalstudent;
      $i = $vartotalstudent +1;

      $array =
      [
        'consumer_id'=>$varconsumer_id,
        'consumerfname'=>$varconsumerfname
      ];

      $bulk = new MongoDB\Driver\BulkWrite(['ordered' => TRUE]);
      $bulk->update(
                    ['_id' => new \MongoDB\BSON\ObjectID($var_id)],
                    ['$set' => 
                      [
                        'parent'=> [$i=>$array]
                      ],
                    ],
                    ['upsert' => TRUE]
                    );
                    
      $writeConcern = new MongoDB\Driver\WriteConcern(MongoDB\Driver\WriteConcern::MAJORITY, 1000);
      try
      {
        $result=$GoNGetzDatabase->executeBulkWrite('GoNGetz.testing', $bulk, $writeConcern);
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
      printf("Modified %d document(s)\n",$result->getModifiedCount());
    }
}
?>