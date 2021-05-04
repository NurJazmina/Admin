<?php 
$Emails = array();
$filter = ['Schools_id'=>$_SESSION["loggeduser_schoolID"],'Class_id'=>$_SESSION["loggeduser_ClassID"]];
$query = new MongoDB\Driver\Query($filter);
$cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Students',$query);
foreach ($cursor as $document)
{
    $studentid = strval($document->_id);
    $Class_id = strval($document->Class_id);

    $filter = ['StudentID'=>$studentid];
    $query = new MongoDB\Driver\Query($filter);
    $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.ParentStudentRel',$query);
    foreach ($cursor as $document)
    {
        $ParentID = strval($document->ParentID);

        $filter = ['_id'=>new \MongoDB\BSON\ObjectId($ParentID)];
        $query = new MongoDB\Driver\Query($filter);
        $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Parents',$query);
        foreach ($cursor as $document)
        {
            $ConsumerID = strval($document->ConsumerID);

            $filter1 = ['_id'=>new \MongoDB\BSON\ObjectID($ConsumerID)];
            $query1 = new MongoDB\Driver\Query($filter1);
            $cursor1 = $GoNGetzDatabase->executeQuery('GoNGetz.Consumer',$query1);

            foreach ($cursor1 as $document1)
            {
                $Email = strval($document1->ConsumerEmail);

                if($Email == "")
                {

                }
                else
                {
                    $ConsumerFName = strval($document1->ConsumerFName);
                    echo $ConsumerFName;
                }
        
            }
        }
    }
}

    