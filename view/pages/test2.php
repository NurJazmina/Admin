<?php
require_once "vendor/autoload.php";
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

$data = json_decode(file_get_contents("php://input"));
echo $data;
// To manipulate data in future
//$data_arr = get_object_vars($data);

$payment_endpoint = "/hwMltpu6/directPays";
$url = "http://localhost/smartschool.gongetz.com/index.php?page=test" . $payment_endpoint;


$headers = ['Accept' => 'application/json', 'Content-type' => 'application/json', 'Authorization' => 'Bearer AGqaAg9sEhw_snaZRg2bZTbkUdwfTqG6'];
$body = file_get_contents("php://input");
$client = new Client([
    'base_uri' => $url,
    'timeout'  => 60.0,
]);
$response = $client->request('POST', $url, [
    'headers' => $headers,
    'body' => $body
]);
$rawBytes = $response->getBody();
$body = $rawBytes->getContents();
echo($body);
?>