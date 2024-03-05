<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
header("Access-Control-Allow-Headers: X-Requested-With");
header("Content-Type: application/json");

require_once("../db.php");
$unittest1 = new ScoreUnittest1();

$api = $_SERVER["REQUEST_METHOD"];
if ($api == "GET"){
    $data = $unittest1->fetchAll();
    echo json_encode($data);
}

if ($api == "POST") {
    $raw_data = file_get_contents("php://input");
    $decode_data = json_decode($raw_data, true);

    error_log(print_r($decode_data, true));
    if (isset($decode_data['user_name']) && isset($decode_data['unit_test1'])) {
        $user_name = $unittest1->test_input($decode_data['user_name']);
        $unit_test1 = $unittest1->test_input($decode_data['unit_test1']);

        $unittest1->inSert($user_name, $unit_test1);
        echo json_encode(array("success" => "Data inserted successfully"));
    } else {
        echo json_encode(array("error" => "Incomplete"));
    }
}
?>

