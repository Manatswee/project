<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
header("Access-Control-Allow-Headers: X-Requested-With");
header("Content-Type: application/json");

require_once("../db.php");
$user_session = new UserSession();

$api = $_SERVER["REQUEST_METHOD"];
if ($api == "GET"){
    $data = $user_session->fetchAll();
    echo json_encode($data);
}


?>

