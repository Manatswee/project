<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
header("Access-Control-Allow-Headers: X-Requested-With");
header("Content-Type: application/json");

require_once("../db.php");
$unit_tourist = new ScoreUnittestTourist();

$api = $_SERVER["REQUEST_METHOD"];
if ($api == "GET"){
    $data = $unit_tourist->fetchAll();
    echo json_encode($data);
}

if ($api == "POST") {
    $raw_data = file_get_contents("php://input");
    $decode_data = json_decode($raw_data, true);

    error_log(print_r($decode_data, true));
    if (isset($decode_data['username']) && isset($decode_data['score'])) {
        $username = $unit_tourist->test_input($decode_data['username']);
        $score_tourist = $unit_tourist->test_input($decode_data['score']);

        $unit_tourist->inSert($username, $score_tourist);
        echo json_encode(array("success" => "Data inserted successfully"));
    } else {
        echo json_encode(array("error" => "Incomplete"));
    }
}
?>

