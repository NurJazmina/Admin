<?php
if (isset($_POST['add_subject']))
{
  $school_id = strval($_SESSION["loggeduser_school_id"]);
  $subject_name = $_POST['subject_name'];
  $class_category = $_POST['class_category'];

  $bulk = new MongoDB\Driver\BulkWrite(['ordered' => TRUE]);
  $bulk->insert([
      'School_id'=>$school_id,
      'SubjectName'=> $subject_name,
      'Class_category'=>$class_category
    ]);
  $writeConcern = new MongoDB\Driver\WriteConcern(MongoDB\Driver\WriteConcern::MAJORITY, 1000);
  try
  {
    $result=$GoNGetzDatabase->executeBulkWrite('GoNGetzSmartSchool.SchoolsSubject', $bulk, $writeConcern);
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

if (isset($_POST['edit_subject']))
{
  $subject_id = $_POST['subject_id'];
  $subject_name = $_POST['subject_name'];
  $bulk = new MongoDB\Driver\BulkWrite(['ordered' => TRUE]);
  $bulk->update(['_id' => new \MongoDB\BSON\ObjectID($subject_id)],
                ['$set' => ['SubjectName'=>$subject_name]]
               );
  $writeConcern = new MongoDB\Driver\WriteConcern(MongoDB\Driver\WriteConcern::MAJORITY, 1000);
  try
  {
    $result=$GoNGetzDatabase->executeBulkWrite('GoNGetzSmartSchool.SchoolsSubject', $bulk, $writeConcern);
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

if (isset($_POST['delete_subject']))
{
  $subject_id = $_POST['subject_id'];
  $password = $_POST['password'];
  $password_hash = $_SESSION["loggeduser_ConsumerPassword"];

  if (password_verify($password, $password_hash))
  {
    //database subject
    $bulk = new MongoDB\Driver\BulkWrite;
    $bulk->delete(['_id'=>new \MongoDB\BSON\ObjectID($subject_id)], ['limit' => 1]);
    $writeConcern = new MongoDB\Driver\WriteConcern(MongoDB\Driver\WriteConcern::MAJORITY, 1000);
    $result=$GoNGetzDatabase->executeBulkWrite('GoNGetzSmartSchool.SchoolsSubject', $bulk, $writeConcern);

    //database class and subject relation
    $bulk = new MongoDB\Driver\BulkWrite;
    $bulk->delete(['Subject_id'=>$subject_id]);
    $writeConcern = new MongoDB\Driver\WriteConcern(MongoDB\Driver\WriteConcern::MAJORITY, 1000);
    $result=$GoNGetzDatabase->executeBulkWrite('GoNGetzSmartSchool.ClassroomSubjectRel', $bulk, $writeConcern);

    //database notes
    $bulk = new MongoDB\Driver\BulkWrite;
    $bulk->delete(['Subject_id'=>$subject_id]);
    $writeConcern = new MongoDB\Driver\WriteConcern(MongoDB\Driver\WriteConcern::MAJORITY, 1000);
    $result=$GoNGetzDatabase->executeBulkWrite('GoNGetzSmartSchool.OL_Notes', $bulk, $writeConcern);

    $filter = ['Subject_id'=>$subject_id];
    $query = new MongoDB\Driver\Query($filter);
    $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.OL_Assignment',$query);
    foreach ($cursor as $document)
    {
      $assignment_id = strval($document->_id);

      //database assignmnet answer
      $bulk = new MongoDB\Driver\BulkWrite;
      $bulk->delete(['Assignment_id'=>$assignment_id]);
      $writeConcern = new MongoDB\Driver\WriteConcern(MongoDB\Driver\WriteConcern::MAJORITY, 1000);
      $result=$GoNGetzDatabase->executeBulkWrite('GoNGetzSmartSchool.OL_Assignment_Answer', $bulk, $writeConcern);
    }
    //database assignment
    $bulk = new MongoDB\Driver\BulkWrite;
    $bulk->delete(['Subject_id'=>$subject_id]);
    $writeConcern = new MongoDB\Driver\WriteConcern(MongoDB\Driver\WriteConcern::MAJORITY, 1000);
    $result=$GoNGetzDatabase->executeBulkWrite('GoNGetzSmartSchool.OL_Assignment', $bulk, $writeConcern);


    $filter = ['Subject_id'=>$subject_id];
    $query = new MongoDB\Driver\Query($filter);
    $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.OL_Quiz',$query);
    foreach ($cursor as $document)
    {
      $quiz_id = strval($document->_id);

      //database quiz answer
      $bulk = new MongoDB\Driver\BulkWrite;
      $bulk->delete(['Quiz_id'=>$quiz_id]);
      $writeConcern = new MongoDB\Driver\WriteConcern(MongoDB\Driver\WriteConcern::MAJORITY, 1000);
      $result=$GoNGetzDatabase->executeBulkWrite('GoNGetzSmartSchool.OL_Quiz_Answer', $bulk, $writeConcern);
    }
    //database quiz
    $bulk = new MongoDB\Driver\BulkWrite;
    $bulk->delete(['Subject_id'=>$subject_id]);
    $writeConcern = new MongoDB\Driver\WriteConcern(MongoDB\Driver\WriteConcern::MAJORITY, 1000);
    $result=$GoNGetzDatabase->executeBulkWrite('GoNGetzSmartSchool.OL_Quiz', $bulk, $writeConcern);

    $filter = ['Subject_id'=>$subject_id];
    $query = new MongoDB\Driver\Query($filter);
    $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.OL_Survey',$query);
    foreach ($cursor as $document)
    {
      $survey_id = strval($document->_id);

      //database survey answer
      $bulk = new MongoDB\Driver\BulkWrite;
      $bulk->delete(['Survey_id'=>$survey_id]);
      $writeConcern = new MongoDB\Driver\WriteConcern(MongoDB\Driver\WriteConcern::MAJORITY, 1000);
      $result=$GoNGetzDatabase->executeBulkWrite('GoNGetzSmartSchool.OL_Survey_Answer', $bulk, $writeConcern);
    }
    //database survey
    $bulk = new MongoDB\Driver\BulkWrite;
    $bulk->delete(['Subject_id'=>$subject_id]);
    $writeConcern = new MongoDB\Driver\WriteConcern(MongoDB\Driver\WriteConcern::MAJORITY, 1000);
    $result=$GoNGetzDatabase->executeBulkWrite('GoNGetzSmartSchool.OL_Survey', $bulk, $writeConcern);

    //database remarks
    $bulk = new MongoDB\Driver\BulkWrite;
    $bulk->delete(['Subject_id'=>$subject_id]);
    $writeConcern = new MongoDB\Driver\WriteConcern(MongoDB\Driver\WriteConcern::MAJORITY, 1000);
    $result=$GoNGetzDatabase->executeBulkWrite('GoNGetzSmartSchool.Subject_Remarks', $bulk, $writeConcern);

    

  }
}
?>