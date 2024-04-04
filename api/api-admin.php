<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Headers: X-Requested-With");
header("Content-Type: application/json");

require_once("../db.php");
$admin = new Admin();

$api = $_SERVER["REQUEST_METHOD"];
if ($api == "GET"){
    $data = $admin->fetchAll();
    echo json_encode($data);
}