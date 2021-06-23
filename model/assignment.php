<?php
//Add Quiz
if (isset($_POST['addassignment']))
{
  $School_id = strval($_SESSION["loggeduser_schoolID"]);
  $Subject_id = $_POST['Subject_id'];
  $Created_by = strval($_SESSION["loggeduser_id"]);
  $Created_date = new MongoDB\BSON\UTCDateTime((new DateTime('now'))->getTimestamp()*1000);
  $Edit_by = strval($_SESSION["loggeduser_id"]);
  $Edit_date = new MongoDB\BSON\UTCDateTime((new DateTime('now'))->getTimestamp()*1000);

  $Description = '';
  $Submitfrom = '';
  $Duedate = '';
  $Cutoffdate = '';
  $reminder = '';

  $wordlimit = 'none';
  $filetypes = 'none';

  $feedback100 = '';
  $grade = 50;
  $feedback0 = '';
  $idnumber = '';
  $group = '';

  $title = $_POST['title'];
  $Description = $_POST['description'];

  $Submitfrom = $_POST['Submitfrom'];
  $Duedate = $_POST['Duedate'];
  $Cutoffdate = $_POST['Cutoffdate'];
  $reminder = $_POST['reminder'];

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

  $array = [];
  $totalquiz = $_POST['totalquiz'];

  for ($i=1; $i<=$totalquiz; $i++)
  {
    $arraycount =
    [
      'Type'=>$_POST['Type'.$i],
      'Question'=>$_POST['Question'.$i],
      'Option_A'=>$_POST['Option_A'.$i],
      'Option_B'=>$_POST['Option_B'.$i],
      'Option_C'=>$_POST['Option_C'.$i],
      'Option_D'=>$_POST['Option_D'.$i],
      'Answer'=>$_POST['Answer'.$i],
      'Mark'=> $_POST['Mark'.$i]
    ];
    array_push($array, $arraycount);
  }
    $bulk = new MongoDB\Driver\BulkWrite(['ordered' => TRUE]);
    $bulk->insert([
                    'School_id'=>$School_id,
                    'Subject_id'=>$Subject_id,
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
                    'Quiz'=>$array
                  ]);
    
    $writeConcern = new MongoDB\Driver\WriteConcern(MongoDB\Driver\WriteConcern::MAJORITY, 1000);
    try
    {
      $result =$GoNGetzDatabase->executeBulkWrite('GoNGetzSmartSchool.OnlineLearningAssignment', $bulk, $writeConcern);
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
