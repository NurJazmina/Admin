<?php
$_SESSION["title"] = "News";
include 'view/partials/_subheader/subheader-v1.php'; 
include 'model/likes.php';

$URL_LIKES = "$_SERVER[REQUEST_URI]";
$url = "";

if (!isset($_SESSION[$URL_LIKES]) && empty($_SESSION[$URL_LIKES]))
{
    $total_likes = 0;
    $filter = ['url'=>$URL_LIKES];
    $query = new MongoDB\Driver\Query($filter);
    $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Likes',$query);
    foreach ($cursor as $document)
    {
        $url = strval($document->url);
        $count = strval($document->count);
        $Consumer = $document->Consumer;
        $total_likes = count((array)$Consumer);
    }

    if ($url == "")
    {
        $bulk = new MongoDB\Driver\BulkWrite(['ordered' => TRUE]);
        $bulk->insert(['url'=>$URL_LIKES,
                        'Consumer'=>[],
                        'count'=>$total_likes]);
        $writeConcern = new MongoDB\Driver\WriteConcern(MongoDB\Driver\WriteConcern::MAJORITY, 1000);
        $result =$GoNGetzDatabase->executeBulkWrite('GoNGetzSmartSchool.Likes', $bulk, $writeConcern);
    }
}

$like = 0;
$_SESSION["like"] = 0;
if(!empty($_POST['like']))
$like = $_POST['like'];

$_SESSION["like"] = $like;

if($_SESSION["like"]== 1)
{
    // $array = [];
    // $array =['Consumer_id'=>''];
    // $bulk = new MongoDB\Driver\BulkWrite(['ordered' => TRUE]);
    // $bulk->update(
    //     ['url' =>$URL_LIKES],
    //     ['$push' => 
    //     [
    //         'Consumer'=> $array
    //     ],
    //     '$set' => ['count'=>$total_likes + 1]
    //     ],
    //     ['upsert' => TRUE]
    //     );
    // $writeConcern = new MongoDB\Driver\WriteConcern(MongoDB\Driver\WriteConcern::MAJORITY, 1000);
    // try
    // {
    //   $result =$GoNGetzDatabase->executeBulkWrite('GoNGetzSmartSchool.Likes', $bulk, $writeConcern);
    // }
    // catch (MongoDB\Driver\Exception\BulkWriteException $e)
    // {
    //   $result = $e->getWriteResult();
    //   // Check if the write concern could not be fulfilled
    //   if ($writeConcernError = $result->getWriteConcernError())
    //   {
    //     printf("%s (%d): %s\n",
    //     $writeConcernError->getMessage(),
    //     $writeConcernError->getCode(),
    //     var_export($writeConcernError->getInfo(), true)
    //     );
    //   }
    //   // Check if any write operations did not complete at all
    //   foreach ($result->getWriteErrors() as $writeError)
    //   {
    //     printf("Operation#%d: %s (%d)\n",
    //     $writeError->getIndex(),
    //     $writeError->getMessage(),
    //     $writeError->getCode()
    //     );
    //   }
    // }
    // catch (MongoDB\Driver\Exception\Exception $e)
    // {
    //   printf("Other error: %s\n", $e->getMessage());
    //   exit;
    // }
}
elseif ($_SESSION["like"] == 0)
{
    // $array = [];
    // $array =['Consumer_id'=>'abc'];
    // $bulk = new MongoDB\Driver\BulkWrite(['ordered' => TRUE]);
    // $bulk->update(
    //     ['url' =>$URL_LIKES],
    //     ['$pull' => 
    //         [
    //         'Consumer'=> $array
    //         ],
    //         '$set' => ['count'=>$total_likes]
    //     ],
    //     ['upsert' => TRUE]
    //     );
    // $writeConcern = new MongoDB\Driver\WriteConcern(MongoDB\Driver\WriteConcern::MAJORITY, 1000);
    // try
    // {
    //   $result =$GoNGetzDatabase->executeBulkWrite('GoNGetzSmartSchool.Likes', $bulk, $writeConcern);
    // }
    // catch (MongoDB\Driver\Exception\BulkWriteException $e)
    // {
    //   $result = $e->getWriteResult();
    //   // Check if the write concern could not be fulfilled
    //   if ($writeConcernError = $result->getWriteConcernError())
    //   {
    //     printf("%s (%d): %s\n",
    //     $writeConcernError->getMessage(),
    //     $writeConcernError->getCode(),
    //     var_export($writeConcernError->getInfo(), true)
    //     );
    //   }
    //   // Check if any write operations did not complete at all
    //   foreach ($result->getWriteErrors() as $writeError)
    //   {
    //     printf("Operation#%d: %s (%d)\n",
    //     $writeError->getIndex(),
    //     $writeError->getMessage(),
    //     $writeError->getCode()
    //     );
    //   }
    // }
    // catch (MongoDB\Driver\Exception\Exception $e)
    // {
    //   printf("Other error: %s\n", $e->getMessage());
    //   exit;
    // }
}
?>
<form  action="" method="post">
    LIKE : 
    <input type="checkbox" name="like" value="1" onchange="this.form.submit()" 
    <?php 
        if ( !empty($_SESSION["like"]) )
        {
            echo "checked";
        } 
    ?>
    >
</form>

