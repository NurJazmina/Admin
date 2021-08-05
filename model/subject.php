<?php
if (isset($_POST['addtopic']))
{
    $Title = $_POST['Title'];
    $Detail = $_POST['Detail'];
    $Created_date = new MongoDB\BSON\UTCDateTime((new DateTime('now'))->getTimestamp()*1000);

    $filter = ['Subject_id'=>$Subject_id];
    $option = ['sort' => ['_id' => 1]];
    $query = new MongoDB\Driver\Query($filter,$option);
    $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.OL_Notes',$query);
    foreach ($cursor as $document)
    {
        $Note_sort = $document->Note_sort;
    }
    $Note_sort = $Note_sort + 1;
    $bulk = new MongoDB\Driver\BulkWrite(['ordered' => TRUE]);
    $bulk->insert([
                    'School_id'=>$_SESSION["loggeduser_schoolID"],
                    'Subject_id'=> $Subject_id,
                    'Created_by'=> $_SESSION["loggeduser_id"],
                    'Created_date'=>$Created_date,
                    'Edited_by'=>$_SESSION["loggeduser_id"],
                    'Edited_date'=> $Created_date,
                    'Title'=> $Title,
                    'Detail'=>$Detail,
                    'Note_sort'=>$Note_sort
                ]);
    $writeConcern = new MongoDB\Driver\WriteConcern(MongoDB\Driver\WriteConcern::MAJORITY, 1000);
    try
    {
        $result = $GoNGetzDatabase->executeBulkWrite('GoNGetzSmartSchool.OL_Notes', $bulk, $writeConcern);
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
