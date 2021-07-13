<?php
//Add Staff
if (isset($_POST['AddStaff']))
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
      $vartotalstaff = $document->totalstaff;
      $totalstaff = $vartotalstaff +1;

      $array =
      [
        'consumer_id'=>$varconsumer_id,
        'consumerfname'=>$varconsumerfname
      ];

      $bulk = new MongoDB\Driver\BulkWrite(['ordered' => TRUE]);
      $bulk->update(
                    ['_id' => new \MongoDB\BSON\ObjectID($var_id)],
                    ['$push' => 
                      [
                        'staff'=> $array
                      ],
                      '$set' => ['totalstaff'=>$totalstaff]
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
      $vartotalparent = $document->totalparent;
      $totalparent = $vartotalparent +1;

      $array =
      [
        'consumer_id'=>$varconsumer_id,
        'consumerfname'=>$varconsumerfname
      ];

      $bulk = new MongoDB\Driver\BulkWrite(['ordered' => TRUE]);
      $bulk->update(
                    ['_id' => new \MongoDB\BSON\ObjectID($var_id)],
                    ['$push' => 
                      ['parent'=> $array],
                      '$set' => ['totalparent'=>$totalparent]
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
      $vartotalstudent = $document->totalstudent;
      $totalstudent = $vartotalstudent +1;

      $array =
      [
        'consumer_id'=>$varconsumer_id,
        'consumerfname'=>$varconsumerfname
      ];

      $bulk = new MongoDB\Driver\BulkWrite(['ordered' => TRUE]);
      $bulk->update(
                    ['_id' => new \MongoDB\BSON\ObjectID($var_id)],
                    ['$push' => 
                      [
                        'student'=> $array
                      ],
                      '$set' => ['totalstudent'=>$totalstudent]
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
//Edit Staff
if (isset($_POST['EditStaff']))
{
      $varschool_id =  strval($_SESSION["loggeduser_schoolID"]);
      $varobject = intval($_POST['txtobject']);
      $varconsumer_id = $_POST['txtconsumer_id'];
      $varconsumerfname = $_POST['txtconsumerfname'];

      $bulk = new MongoDB\Driver\BulkWrite(['ordered' => TRUE]);
      $bulk->update(
                    ['school_id' => $varschool_id],
                    ['$set' => 
                      ['staff.'.$varobject.'.consumer_id'=>$varconsumer_id ,
                      'staff.'.$varobject.'.consumerfname'=>$varconsumerfname],
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
?>

<?php
//Edit Parent
if (isset($_POST['EditParent']))
{
      $varschool_id =  strval($_SESSION["loggeduser_schoolID"]);
      $varobject = $_POST['txtobject'];
      $varconsumer_id = $_POST['txtconsumer_id'];
      $varconsumerfname = $_POST['txtconsumerfname'];

      $bulk = new MongoDB\Driver\BulkWrite(['ordered' => TRUE]);
      $bulk->update(
                    ['school_id' => $varschool_id],
                    ['$set' => 
                      ['parent.'.$varobject.'.consumer_id'=>$varconsumer_id,
                      'parent.'.$varobject.'.consumerfname'=>$varconsumerfname],
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
?>

<?php
//Edit Student
if (isset($_POST['EditStudent']))
{
      $varschool_id =  strval($_SESSION["loggeduser_schoolID"]);
      $varobject = $_POST['txtobject'];
      $varconsumer_id = $_POST['txtconsumer_id'];
      $varconsumerfname = $_POST['txtconsumerfname'];

      $bulk = new MongoDB\Driver\BulkWrite(['ordered' => TRUE]);
      $bulk->update(
                    ['school_id' => $varschool_id],
                    ['$set' => 
                      ['student.'.$varobject.'.consumer_id'=>$varconsumer_id,
                       'student.'.$varobject.'.consumerfname'=>$varconsumerfname],
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
?>