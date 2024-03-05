<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
header("Access-Control-Allow-Headers: X-Requested-With");
header("Content-Type: application/json");

require_once("../db.php");
$production1 = new Production1();

$api = $_SERVER["REQUEST_METHOD"];
if ($api == "GET"){
    $data = $production1->fetchAll();
    echo json_encode($data);
}

if ($api == "POST") {
    $raw_data = file_get_contents("php://input");
    $decode_data = json_decode($raw_data, true);
    

    error_log("Raw Data: " . print_r($raw_data, true));
    error_log("Decoded Data: " . print_r($decode_data, true));
    if (isset($decode_data['user_name']) && isset($decode_data['production_1']) && isset($decode_data['production_1_2']) && isset($decode_data['production_1_3']) && isset($decode_data['production_1_4']) && isset($decode_data['score_1'])) {
        $user_name = $production1->test_input($decode_data['user_name']);
        $production_1 = $production1->test_input($decode_data['production_1']);
        $production_1_2 = $production1->test_input($decode_data['production_1_2']);
        $production_1_3 = $production1->test_input($decode_data['production_1_3']);
        $production_1_4 = $production1->test_input($decode_data['production_1_4']);
        $score_1 = $production1->test_input($decode_data['score_1']);

        $production1->inSert($user_name, $production_1, $production_1_2, $production_1_3, $production_1_4, $score_1);
        echo json_encode(array("success" => "Data inserted successfully"));
    } else {
        echo json_encode(array("error" => "Incomplete"));
    }
}
?>

