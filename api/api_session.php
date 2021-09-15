<?php
session_start();
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

$apiSession = $_GET['api_session'];
$_SESSION['api_session'] = $apiSession;

if(isset($_GET['is_mobile']) && !is_null($_GET['is_mobile']))
{
    $_SESSION['is_mobile'] = true;
}