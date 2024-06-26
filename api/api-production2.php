<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
header("Access-Control-Allow-Headers: X-Requested-With");
header("Content-Type: application/json");

require_once("../db.php");
$production2 = new Production2();

$api = $_SERVER["REQUEST_METHOD"];
if ($api == "GET"){
    $data = $production2->fetchAll();
    echo json_encode($data);
}

if ($api == "POST") {
    $raw_data = file_get_contents("php://input");
    $decode_data = json_decode($raw_data, true);

    error_log(print_r($decode_data, true));
    if (isset($decode_data['user_name']) && isset($decode_data['production_2']) && isset($decode_data['production_2_2']) && isset($decode_data['production_2_3']) && isset($decode_data['production_2_4']) && isset($decode_data['score_2'])) {
        $user_name = $production2->test_input($decode_data['user_name']);
        $production_2 = $production2->test_input($decode_data['production_2']);
        $production_2_2 = $production2->test_input($decode_data['production_2_2']);
        $production_2_3 = $production2->test_input($decode_data['production_2_3']);
        $production_2_4 = $production2->test_input($decode_data['production_2_4']);
        $score_2 = $production2->test_input($decode_data['score_2']);

        $production2->inSert($user_name, $production_2, $production_2_2, $production_2_3, $production_2_4, $score_2);
        echo json_encode(array("success" => "Data inserted successfully"));
    } else {
        echo json_encode(array("error" => "Incomplete"));
    }
}
?>

