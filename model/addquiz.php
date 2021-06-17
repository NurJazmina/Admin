<?php
//Add Quiz
if (isset($_POST['addquiz']))
{
  $School_id = strval($_SESSION["loggeduser_schoolID"]);
  $Subject_id = $_POST['Subject_id'];
  $Created_by = strval($_SESSION["loggeduser_id"]);
  $Created_date = new MongoDB\BSON\UTCDateTime((new DateTime('now'))->getTimestamp()*1000);
  $Edit_by = strval($_SESSION["loggeduser_id"]);
  $Edit_date = new MongoDB\BSON\UTCDateTime((new DateTime('now'))->getTimestamp()*1000);

  $Description = '';
  $DateOpen = '';
  $DateClose = '';
  $timeunit = '';
  $timelimit = '';
  $feedback100 = '';
  $grade = 50;
  $feedback0 = '';
  $idnumber = '';
  $group = '';
  $Total_question = 0;

  $Type1 = '';
  $Question1 = '';
  $Option_A1 = '';
  $Option_B1 = '';
  $Option_C1 = '';
  $Option_D1 = '';
  $Answer1 = '';
  $Mark1 = '';

  $title = $_POST['title'];
  $Description = $_POST['description'];

  $DateOpen = $_POST['DateOpen'];
  $DateClose = $_POST['DateClose'];
  $timeunit = $_POST['timeunit'];
  $timelimit = $_POST['timelimit'];
  $timeexpired = $_POST['timeexpired'];

  $attempt = $_POST['attempt'];

  $shuffle = $_POST['shuffle'];

  $feedback100 = $_POST['feedback100'];
  $grade = $_POST['grade'];
  $feedback0 = $_POST['feedback0'];

  $availability = $_POST['availability'];
  $idnumber = $_POST['idnumber'];
  $groupmode = $_POST['groupmode'];
  $group = $_POST['group'];
  
  $Total_question = $_POST['Total_question'];

  for ($i=1; $i<=$Total_question; $i++)
  {
    $array[$i] =
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
                  'DateOpen'=>$DateOpen,
                  'DateClose'=>$DateClose,
                  'Timeunit'=>$timeunit,
                  'Timelimit'=>$timelimit,
                  'Timeexpired'=>$timeexpired,
                  'Attempt'=>$attempt,
                  'Shuffle'=>$shuffle,
                  'Feedback100'=>$feedback100,
                  'Grade'=>$grade,
                  'Feedback0'=>$feedback0,
                  'Availability'=>$availability,
                  'Idnumber'=>$idnumber,
                  'Groupmode'=>$groupmode,
                  'Group'=>$group,
                  'Total_Question'=>$Total_question,
                  'Quiz'=>$array
                ]);
  $writeConcern = new MongoDB\Driver\WriteConcern(MongoDB\Driver\WriteConcern::MAJORITY, 1000);
  try
  {
    $result =$GoNGetzDatabase->executeBulkWrite('GoNGetzSmartSchool.OnlineLearningQuestions', $bulk, $writeConcern);
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
