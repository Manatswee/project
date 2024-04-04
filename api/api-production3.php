<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
header("Access-Control-Allow-Headers: X-Requested-With");
header("Content-Type: application/json");

require_once("../db.php");
$production3 = new Production3();

$api = $_SERVER["REQUEST_METHOD"];
if ($api == "GET"){
    $data = $production3->fetchAll();
    echo json_encode($data);
}

if ($api == "POST") {
    $raw_data = file_get_contents("php://input");
    $decode_data = json_decode($raw_data, true);

    error_log(print_r($decode_data, true));
    if (isset($decode_data['user_name']) && isset($decode_data['production_3']) && isset($decode_data['production_3_2']) && isset($decode_data['production_3_3']) && isset($decode_data['production_3_4']) && isset($decode_data['score_3'])) {
        $user_name = $production3->test_input($decode_data['user_name']);
        $production_3 = $production3->test_input($decode_data['production_3']);
        $production_3_2 = $production3->test_input($decode_data['production_3_2']);
        $production_3_3 = $production3->test_input($decode_data['production_3_3']);
        $production_3_4 = $production3->test_input($decode_data['production_3_4']);
        $score_3 = $production3->test_input($decode_data['score_3']);

        $production3->inSert($user_name, $production_3, $production_3_2, $production_3_3, $production_3_4, $score_3);
        echo json_encode(array("success" => "Data inserted successfully"));
    } else {
        echo json_encode(array("error" => "Incomplete"));
    }
}
?>

