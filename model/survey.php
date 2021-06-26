<?php
//Add Quiz
if (isset($_POST['addsurvey']))
{
  $School_id = strval($_SESSION["loggeduser_schoolID"]);
  $Subject_id = $_POST['Subject_id'];
  $Created_by = strval($_SESSION["loggeduser_id"]);
  $Created_date = new MongoDB\BSON\UTCDateTime((new DateTime('now'))->getTimestamp()*1000);
  $Edit_by = strval($_SESSION["loggeduser_id"]);
  $Edit_date = new MongoDB\BSON\UTCDateTime((new DateTime('now'))->getTimestamp()*1000);

  $Description = '';
  $idnumber = '';
  $view = '';
  $expectcompleted = '';

  $title = $_POST['title'];
  $type = $_POST['type'];
  $Description = $_POST['description'];
  $availability = $_POST['availability'];
  $idnumber = $_POST['idnumber'];

  $tracking = $_POST['tracking'];
  if($tracking == 'MANUALMARK')
  {
    $expectcompleted = $_POST['expectcompleted'];
  }
  elseif($tracking == 'AUTOMARK')
  {
    $view = $_POST['view'];
    $expectcompleted = $_POST['expectcompleted'];
  }

    $bulk = new MongoDB\Driver\BulkWrite(['ordered' => TRUE]);
    $bulk->insert([
                    'School_id'=>$School_id,
                    'Subject_id' => $Subject_id,
                    'Created_by'=>$Created_by,
                    'Created_date'=>$Created_date,
                    'Edit_by'=>$Edit_by,
                    'Edit_date'=>$Edit_date,
                    'Title'=>$title,
                    'type'=>$type,
                    'Description'=>$Description,
                    'Availability'=>$availability,
                    'Idnumber'=>$idnumber,
                    'Tracking'=>$tracking,
                    'View'=>$view,
                    'Expectcompleted'=>$expectcompleted
                  ]);
    
    $writeConcern = new MongoDB\Driver\WriteConcern(MongoDB\Driver\WriteConcern::MAJORITY, 1000);
    try
    {
      $result =$GoNGetzDatabase->executeBulkWrite('GoNGetzSmartSchool.OL_Survey', $bulk, $writeConcern);
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
  printf("Inserted %d document(s)\n", $result->getInsertedCount());
}
