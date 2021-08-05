<?php
$filter = ['_id'=>new \MongoDB\BSON\ObjectId("60f7c21072e18b66b3c616b0")];
$query = new MongoDB\Driver\Query($filter);
$cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.OL_Quiz',$query);
foreach ($cursor as $document)
{
    $Quiz_id = $document->_id;
    $Quiz = $document->Quiz;
    $Created_by = $document->Created_by;
    $Total_Question = count((array)$Quiz);
}
echo "total question :".$Total_Question."<br>";
$totalmark = 0;
for ($i = 0; $i < $Total_Question; $i++)
{
    $id = $Quiz[$i]->id;
    $Type = $Quiz[$i]->Type;
    $Question = $Quiz[$i]->Question;
    $Option_A = $Quiz[$i]->Option_A;
    $Option_B = $Quiz[$i]->Option_B;
    $Option_C = $Quiz[$i]->Option_C;
    $Option_D = $Quiz[$i]->Option_D;
    $Answer = $Quiz[$i]->Answer;
    $Mark = $Quiz[$i]->Mark;
    echo $Mark."<br>";

    if ($Type == "OBJECTIVE")
    {
        $filter2 = ['Created_by'=>$Created_by];
        $query2 = new MongoDB\Driver\Query($filter2);
        $cursor2 = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.OL_Quiz_Answer',$query2);

        foreach ($cursor2 as $document2)
        {
            $Answer_id = strval($document2->_id);
            $Quiz = $document->Quiz;
            $Total_Question = count((array)$Quiz);

            for ($i = 0; $i < $Total_Question; $i++)
            {
                $Answer_by_student = $Quiz[$i]->Answer;
                if ($Answer_by_student == $Answer)
                {
                    $totalmark += $Mark ;
                }
                
            }
        }
    }
}
$filter2 = ['Created_by'=>$Created_by];
$query2 = new MongoDB\Driver\Query($filter2);
$cursor2 = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.OL_Quiz_Answer',$query2);

foreach ($cursor2 as $document2)
{
    $Answer_id = strval($document2->_id);
}
$mark = $totalmark;
?>
<form name="answer" action="" method="post">
    <div class="modal-body">
        <input type="text" name="mark" value="<?php echo $mark; ?>">
        <div class="row mb-5" align="right">
            <div class="col-sm-12">
                <button type="reset" class="btn btn-secondary btn-sm">Reset</button>
                <button type="submit" name="answer" class="btn btn-success btn-sm">Submit</button>
            </div>
        </div>
    </div>
</form>
<?php
if (isset($_POST['answer']))
{
    $mark = $_POST['mark'];
    $bulk = new MongoDB\Driver\BulkWrite(['ordered' => TRUE]);
    $bulk->update(['_id' => new \MongoDB\BSON\ObjectID("60f7c3a872e18b66b3c616b1")],
                ['$set' => ['Mark'=>$mark]],
                ['multi'=> TRUE]
                );
    $writeConcern = new MongoDB\Driver\WriteConcern(MongoDB\Driver\WriteConcern::MAJORITY, 1000);
    $result =$GoNGetzDatabase->executeBulkWrite('GoNGetzSmartSchool.OL_Quiz_Answer', $bulk, $writeConcern);
}