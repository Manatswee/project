<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
header("Access-Control-Allow-Headers: X-Requested-With");
header("Content-Type: application/json");

require_once("../db.php");
$scorepractice = new ScorePractice();

$api = $_SERVER["REQUEST_METHOD"];
if ($api == "GET"){
    $data = $scorepractice->fetchAll();
    echo json_encode($data);
}