<?php
include '../connections/db.php';
if (isset($_POST['like']))
{
    $url = "";
    $like = $_POST['like'];
    $Consumer_id = $_POST['Consumer_id'];
    $URL_LIKES = $_POST['url_likes'];

    $filter = ['url'=>$URL_LIKES];
    $query = new MongoDB\Driver\Query($filter);
    $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Likes',$query);
    foreach ($cursor as $document)
    {
        $url = strval($document->url);
        $Consumer = $document->Consumer;
        $total_likes = count((array)$Consumer);
        //echo $total_likes;
    }

    if ($like == 1)
    {
        if ($url == "")
        {
            echo '1';
            $array = [];
            $arraycount =[ 'Consumer_id'=>$Consumer_id];
            array_push($array, $arraycount);
            $bulk = new MongoDB\Driver\BulkWrite(['ordered' => TRUE]);
            $bulk->insert(['url'=>$URL_LIKES,
                            'Consumer'=>$array
                          ]);
            $writeConcern = new MongoDB\Driver\WriteConcern(MongoDB\Driver\WriteConcern::MAJORITY, 1000);
            $result =$GoNGetzDatabase->executeBulkWrite('GoNGetzSmartSchool.Likes', $bulk, $writeConcern);
        }
        elseif ($url == $URL_LIKES)
        {
            $check = 0;
            $filter = ['url'=> $URL_LIKES, 'Consumer.Consumer_id'=> $Consumer_id];
            $query = new MongoDB\Driver\Query($filter);
            $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Likes',$query);
            foreach ($cursor as $document)
            {
                $check = 1;
                echo $total_likes;
            }
            if ($check == 0)
            {
                echo $total_likes + 1;
                $bulk = new MongoDB\Driver\BulkWrite(['ordered' => TRUE]);
                $bulk->update(
                                ['url' => $URL_LIKES],
                                [
                                    '$push'=>
                                    [
                                        'Consumer'=>
                                        [
                                            'Consumer_id' => $Consumer_id
                                        ]
                                    ],
                                ],
                                ['upsert' => TRUE]
                            );
                $writeConcern = new MongoDB\Driver\WriteConcern(MongoDB\Driver\WriteConcern::MAJORITY, 1000);
                $result =$GoNGetzDatabase->executeBulkWrite('GoNGetzSmartSchool.Likes', $bulk, $writeConcern);
            }
        }
    }
    elseif($like == 0)
    {
        $total_likes = $total_likes-1;
        echo $total_likes;
        $bulk = new MongoDB\Driver\BulkWrite(['ordered' => TRUE]);
        $bulk->update(
                        ['url' => $URL_LIKES],
                        [
                            '$pull'=>
                            [
                                'Consumer'=>
                                [
                                    'Consumer_id' => $Consumer_id
                                ]
                            ],
                        ],
                        ['upsert' => TRUE]
                        );
        $writeConcern = new MongoDB\Driver\WriteConcern(MongoDB\Driver\WriteConcern::MAJORITY, 1000);
        $result =$GoNGetzDatabase->executeBulkWrite('GoNGetzSmartSchool.Likes', $bulk, $writeConcern);
    }
}
?>