<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
header("Access-Control-Allow-Headers: X-Requested-With");
header("Content-Type: application/json");

require_once("../db.php");
$unit_airport = new ScoreUnittestAirport();

$api = $_SERVER["REQUEST_METHOD"];
if ($api == "GET"){
    $data = $unit_airport->fetchAll();
    echo json_encode($data);
}

if ($api == "POST") {
    $raw_data = file_get_contents("php://input");
    $decode_data = json_decode($raw_data, true);

    error_log(print_r($decode_data, true));
    if (isset($decode_data['username']) && isset($decode_data['score'])) {
        $username = $unit_airport->test_input($decode_data['username']);
        $score_airport = $unit_airport->test_input($decode_data['score']);

        $unit_airport->inSert($username, $score_airport);
        echo json_encode(array("success" => "Data inserted successfully"));
    } else {
        echo json_encode(array("error" => "Incomplete"));
    }
}
?>

