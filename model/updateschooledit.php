<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include '/var/www/html/smartschool.gongetz.com/connections/db.php';

if (isset($_POST['EditSchoolFormSubmit']))
{
  session_start();
  $varSchoolsPhoneNo = $_POST['txtSchoolsPhoneNo'];
  $varschoolid = $_SESSION["loggeduser_schoolID"];
  $bulk = new MongoDB\Driver\BulkWrite(['ordered' => TRUE]);
  $bulk->update(['_id' => new \MongoDB\BSON\ObjectID($varschoolid)],
                ['$set' => ['SchoolsPhoneNo'=>$varSchoolsPhoneNo]],
                ['upsert' => TRUE]
               );
  $writeConcern = new MongoDB\Driver\WriteConcern(MongoDB\Driver\WriteConcern::MAJORITY, 1000);
  try
  {
    $result = $GoNGetzDatabase->executeBulkWrite('GoNGetzSmartSchool.Schools', $bulk, $writeConcern);
  }
  catch (MongoDB\Driver\Exception\BulkWriteException $e)
  {
    $result = $e->getWriteResult();
    $_SESSION["loggeduser_schoolName"] = $varschoolname;
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
printf("nMatched: %d\n", $result->getMatchedCount());
printf("Updated  %d document(s)\n", $result->getModifiedCount());
header ('location: ../index.php?page=schooledit'); 
}
?>
