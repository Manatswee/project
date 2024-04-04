<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
header("Access-Control-Allow-Headers: X-Requested-With");
header("Content-Type: application/json");

require_once("../db.php");
$production5 = new Production5();

$api = $_SERVER["REQUEST_METHOD"];
if ($api == "GET"){
    $data = $production5->fetchAll();
    echo json_encode($data);
}

if ($api == "POST") {
    $raw_data = file_get_contents("php://input");
    $decode_data = json_decode($raw_data, true);

    error_log(print_r($decode_data, true));
    if (isset($decode_data['user_name']) && isset($decode_data['production_5']) && isset($decode_data['production_5_2']) && isset($decode_data['production_5_3']) && isset($decode_data['production_5_4']) && isset($decode_data['score_5'])) {
        $user_name = $production5->test_input($decode_data['user_name']);
        $production_5 = $production5->test_input($decode_data['production_5']);
        $production_5_2 = $production5->test_input($decode_data['production_5_2']);
        $production_5_3 = $production5->test_input($decode_data['production_5_3']);
        $production_5_4 = $production5->test_input($decode_data['production_5_4']);
        $score_5 = $production5->test_input($decode_data['score_5']);

        $production5->inSert($user_name, $production_5, $production_5_2, $production_5_3, $production_5_4, $score_5);
        echo json_encode(array("success" => "Data inserted successfully"));
    } else {
        echo json_encode(array("error" => "Incomplete"));
    }
}
?>

