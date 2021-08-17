<?php
//Add Quiz
if (isset($_POST['add_assignment_return_notes']))
{
  $School_id = strval($_SESSION["loggeduser_schoolID"]);
  $Subject_id = $_POST['Subject_id'];
  $Notes_id = $_POST['Notes_id'];
  $Created_by = strval($_SESSION["loggeduser_id"]);
  $Created_date = new MongoDB\BSON\UTCDateTime((new DateTime('now'))->getTimestamp()*1000);
  $Edit_by = strval($_SESSION["loggeduser_id"]);
  $Edit_date = new MongoDB\BSON\UTCDateTime((new DateTime('now'))->getTimestamp()*1000);

  $Description = '';

  $wordlimit = 'none';
  $filetypes = 'none';

  $feedback100 = '';
  $grade = 50;
  $feedback0 = '';
  $idnumber = '';
  $group = '';

  $title = $_POST['title'];
  $Description = $_POST['description'];

  $Submitfrom = new MongoDB\BSON\UTCDateTime((new DateTime($_POST['Submitfrom']))->getTimestamp()*1000);
  $Duedate = new MongoDB\BSON\UTCDateTime((new DateTime($_POST['Duedate']))->getTimestamp()*1000);
  $Cutoffdate = new MongoDB\BSON\UTCDateTime((new DateTime($_POST['Cutoffdate']))->getTimestamp()*1000);
  $reminder = new MongoDB\BSON\UTCDateTime((new DateTime($_POST['reminder']))->getTimestamp()*1000);

  $wordlimit = $_POST['wordlimit'];
  $maxnumberfile = $_POST['maxnumberfile'];
  $maxsizebytes = $_POST['maxsizebytes'];
  $filetypes = $_POST['filetypes'];
  
  $feedback100 = $_POST['feedback100'];
  $grade = $_POST['grade'];
  $feedback0 = $_POST['feedback0'];

  $availability = $_POST['availability'];
  $idnumber = $_POST['idnumber'];
  $groupmode = $_POST['groupmode'];
  $group = $_POST['group'];


    $bulk = new MongoDB\Driver\BulkWrite(['ordered' => TRUE]);
    $bulk->insert([
                    'School_id'=>$School_id,
                    'Notes_id' =>$Notes_id,
                    'Subject_id' =>$Subject_id,
                    'Created_by'=>$Created_by,
                    'Created_date'=>$Created_date,
                    'Edit_by'=>$Edit_by,
                    'Edit_date'=>$Edit_date,
                    'Title'=>$title,
                    'Description'=>$Description,
                   
                    'Submitfrom'=>$Submitfrom,
                    'Duedate'=>$Duedate,
                    'Cutoffdate'=>$Cutoffdate,
                    'reminder'=>$reminder,

                    'wordlimit'=>$wordlimit,
                    'maxnumberfile'=>$maxnumberfile,
                    'maxsizebytes'=>$maxsizebytes,
                    'filetypes'=>$filetypes,

                    'Feedback100'=>$feedback100,
                    'Grade'=>$grade,
                    'Feedback0'=>$feedback0,

                    'Availability'=>$availability,
                    'Idnumber'=>$idnumber,
                    'Groupmode'=>$groupmode,
                    'Group'=>$group,
                  ]);
    
    $writeConcern = new MongoDB\Driver\WriteConcern(MongoDB\Driver\WriteConcern::MAJORITY, 1000);
    try
    {
      $result =$GoNGetzDatabase->executeBulkWrite('GoNGetzSmartSchool.OL_Assignment', $bulk, $writeConcern);
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

if (isset($_POST['assignment_answer']))
{
  $Assignment_id = $_POST['id'];
  $Answer = $_POST['answer'];
  $School_id = strval($_SESSION["loggeduser_schoolID"]);
  $Created_by = strval($_SESSION["loggeduser_id"]);
  $Created_date = new MongoDB\BSON\UTCDateTime((new DateTime('now'))->getTimestamp()*1000);

  $bulk = new MongoDB\Driver\BulkWrite(['ordered' => TRUE]);
  $bulk->insert([
                  'School_id'=>$School_id,
                  'Assignment_id' => $Assignment_id,
                  'Created_by'=>$Created_by,
                  'Created_date'=>$Created_date,
                  'Answer'=>$Answer,
                  'File_submission'=>'',
                  'Mark'=>'0',
                  'comment'=>''
                ]);

  $writeConcern = new MongoDB\Driver\WriteConcern(MongoDB\Driver\WriteConcern::MAJORITY, 1000);
  $result =$GoNGetzDatabase->executeBulkWrite('GoNGetzSmartSchool.OL_Assignment_Answer', $bulk, $writeConcern);
}

if (isset($_POST['EditGrade']))
{
  $answer_id = $_POST['answer_id'];
  $Mark = $_POST['Mark'];
  $comment = $_POST['comment'];

  $bulk = new MongoDB\Driver\BulkWrite(['ordered' => TRUE]);
  $bulk->update(['_id' => new \MongoDB\BSON\ObjectID($answer_id)],
                ['$set' => ['Mark'=>$Mark , 'comment'=>$comment]],
                ['multi'=> TRUE]
                );
  $writeConcern = new MongoDB\Driver\WriteConcern(MongoDB\Driver\WriteConcern::MAJORITY, 1000);
  try
  {
    $result =$GoNGetzDatabase->executeBulkWrite('GoNGetzSmartSchool.OL_Assignment_Answer', $bulk, $writeConcern);
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