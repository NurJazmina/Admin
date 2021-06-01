<?php
if (isset($_POST['AddImage']))
{
        $varimage = $_POST['txtimage'];
        $Date = new MongoDB\BSON\UTCDateTime((new DateTime('now'))->getTimestamp()*1000);
        $bulk = new MongoDB\Driver\BulkWrite(['ordered' => TRUE]);
        $bulk->insert(['Date'=>$Date,'Image'=> $varimage]);
        $writeConcern = new MongoDB\Driver\WriteConcern(MongoDB\Driver\WriteConcern::MAJORITY, 1000);
        try
        {
        $result =$GoNGetzDatabase->executeBulkWrite('GoNGetzSmartSchool.testing', $bulk, $writeConcern);
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
?>