<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
header("Access-Control-Allow-Headers: X-Requested-With");
header("Content-Type: application/json");

require_once("../db.php");
$production_shopping = new ScoreProductionShopping();

$api = $_SERVER["REQUEST_METHOD"];
if ($api == "GET"){
    $data = $production_airport->fetchAll();
    echo json_encode($data);
}

if ($api == "POST") {
    $raw_data = file_get_contents("php://input");
    $decode_data = json_decode($raw_data, true);
    

    error_log("Raw Data: " . print_r($raw_data, true));
    error_log("Decoded Data: " . print_r($decode_data, true));
    if (isset($decode_data['username']) && isset($decode_data['word_1']) && isset($decode_data['word_2']) && isset($decode_data['word_3']) && isset($decode_data['word_4']) && isset($decode_data['score'])) {
        $username = $production_shopping->test_input($decode_data['username']);
        $word_1 = $production_shopping->test_input($decode_data['word_1']);
        $word_2 = $production_shopping->test_input($decode_data['word_2']);
        $word_3 = $production_shopping->test_input($decode_data['word_3']);
        $word_4 = $production_shopping->test_input($decode_data['word_4']);
        $score = $production_shopping->test_input($decode_data['score']);

        $production_shopping->inSert($username, $word_1, $word_2, $word_3, $word_4, $score);
        echo json_encode(array("success" => "Data inserted successfully"));
    } else {
        echo json_encode(array("error" => "Incomplete"));
    }
}
?>

