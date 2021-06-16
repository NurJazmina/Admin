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
  $Name = $_POST['name'];
  $Description = $_POST['description'];

  $DateOpen = $_POST['DateOpen'];
  $DateClose = $_POST['DateClose'];
  $timeunit = $_POST['timeunit'];
  $timelimit = $_POST['timelimit[timeunit]'];
  $timeexpired = $_POST['timeexpired'];
  $attempt = $_POST['attempt'];
  $shuffle = $_POST['shuffle'];
  $feedback100 = $_POST['feedback100'];
  $grade = $_POST['grade'];
  $availability = $_POST['availability'];
  $idnumber = $_POST['idnumber'];
  $groupmode = $_POST['groupmode'];
  $group = $_POST['group'];
  
  $Total_question = $_POST['Total_question'];
  $Questions = $_POST['Questions'];
  $Type = $_POST['Type'];
  $Option_A = $_POST['Option_A'];
  $Option_B = $_POST['Option_B'];
  $Option_C = $_POST['Option_C'];
  $Option_D = $_POST['Option_D'];
  $Answer = $_POST['Answer'];

  $bulk = new MongoDB\Driver\BulkWrite(['ordered' => TRUE]);
  $bulk->insert([
      'School_id'=>$varschoolID,
      'DepartmentName'=> $vardepartment,
      'School_id'=>$varschoolID,
      'DepartmentName'=> $vardepartment
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
