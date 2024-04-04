<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
header("Access-Control-Allow-Headers: X-Requested-With");
header("Content-Type: application/json");

require_once("../db.php");
$production4 = new Production4();

$api = $_SERVER["REQUEST_METHOD"];
if ($api == "GET"){
    $data = $production4->fetchAll();
    echo json_encode($data);
}

if ($api == "POST") {
    $raw_data = file_get_contents("php://input");
    $decode_data = json_decode($raw_data, true);

    error_log(print_r($decode_data, true));
    if (isset($decode_data['user_name']) && isset($decode_data['production_4']) && isset($decode_data['score_4'])) {
        $user_name = $production4->test_input($decode_data['user_name']);
        $production_4 = $production4->test_input($decode_data['production_4']);
        $production_4_2 = $production4->test_input($decode_data['production_4_2']);
        $production_4_3 = $production4->test_input($decode_data['production_4_3']);
        $production_4_4 = $production4->test_input($decode_data['production_4_4']);
        $score_4 = $production4->test_input($decode_data['score_4']);

        $production4->inSert($user_name, $production_4, $production_4_2, $production_4_3, $production_4_4, $score_4);
        echo json_encode(array("success" => "Data inserted successfully"));
    } else {
        echo json_encode(array("error" => "Incomplete"));
    }
}
?>

