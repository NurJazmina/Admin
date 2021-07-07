<?php

session_start();

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");


$apiSession = $_GET['api_session'];
$_SESSION['api_session'] = $apiSession;

$json = json_decode($_POST['json']);
$nric = $json['nric'];
$password = $json['password'];

header ('http://localhost:80/smartschool.gongetz.com/index.php?page=dashboard&action=loginsuccesful');