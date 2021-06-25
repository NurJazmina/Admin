<?php
//Add Quiz
if (isset($_POST['addurl']))
{
  $School_id = strval($_SESSION["loggeduser_schoolID"]);
  $Subject_id = $_POST['Subject_id'];
  $Notes_id = $_POST['Notes_id'];
  $Created_by = strval($_SESSION["loggeduser_id"]);
  $Created_date = new MongoDB\BSON\UTCDateTime((new DateTime('now'))->getTimestamp()*1000);
  $Edit_by = strval($_SESSION["loggeduser_id"]);
  $Edit_date = new MongoDB\BSON\UTCDateTime((new DateTime('now'))->getTimestamp()*1000);

  $Description ='';
  $parameter_0 ='';
  $parameter_1 = '';
  $parameter_2 = '';
  $variable_0 ='';
  $variable_1 ='';
  $variable_2 ='';
  $idnumber = '';
  $view = '';
  $expectcompleted = '';

  $title = $_POST['title'];
  $url = $_POST['url'];
  $Description = $_POST['description'];

  $display = $_POST['display'];

  $parameter_0 = $_POST['parameter_0'];
  $parameter_1 = $_POST['parameter_1'];
  $parameter_2 = $_POST['parameter_2'];
  $variable_0 = $_POST['variable_0'];
  $variable_1 = $_POST['variable_1'];
  $variable_2 = $_POST['variable_2'];

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
                    'Subject_id'=>$Subject_id,
                    'Notes_id' => '$Notes_id',
                    'Created_by'=>$Created_by,
                    'Created_date'=>$Created_date,
                    'Edit_by'=>$Edit_by,
                    'Edit_date'=>$Edit_date,
                    'Title'=>$title,
                    'Url'=>$url,
                    'Description'=>$Description,
                    'Display'=>$display,
                    'Parameter_0'=>$parameter_0,
                    'Parameter_1'=>$parameter_1,
                    'Parameter_2'=>$parameter_2,
                    'Variable_0'=>$variable_0,
                    'Variable_1'=>$variable_1,
                    'Variable_2'=>$variable_2,
                    'Availability'=>$availability,
                    'Idnumber'=>$idnumber,
                    'Tracking'=>$tracking,
                    'View'=>$view,
                    'Expectcompleted'=>$expectcompleted
                  ]);
    
    $writeConcern = new MongoDB\Driver\WriteConcern(MongoDB\Driver\WriteConcern::MAJORITY, 1000);
    try
    {
      $result =$GoNGetzDatabase->executeBulkWrite('GoNGetzSmartSchool.OL_URL', $bulk, $writeConcern);
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
