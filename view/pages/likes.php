<?php
include '../../connections/db.php';

if (isset($_POST['like']))
{
    $URL_LIKES = "$_SERVER[REQUEST_URI]";
    $url = "";

    $like = $_POST['like'];
    $Consumer_id = $_POST['Consumer_id'];
    echo $like ;

    if ($like == 1)
    {
        $filter = ['url'=>$URL_LIKES];
        $query = new MongoDB\Driver\Query($filter);
        $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Likes',$query);
        foreach ($cursor as $document)
        {
            $url = strval($document->url);
            $Consumer = $document->Consumer;
            $total_likes = count((array)$Consumer);
        }
        if ($url == "")
        {
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
            }
            if ($check == 0)
            {
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