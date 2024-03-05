<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
header("Access-Control-Allow-Headers: X-Requested-With");
header("Content-Type: application/json");

require_once("../db.php");
$unittest2 = new ScoreUnittest2();

$api = $_SERVER["REQUEST_METHOD"];
if ($api == "GET"){
    $data = $unittest2->fetchAll();
    echo json_encode($data);
}

if ($api == "POST") {
    $raw_data = file_get_contents("php://input");
    $decode_data = json_decode($raw_data, true);

    error_log(print_r($decode_data, true));
    if (isset($decode_data['user_name']) && isset($decode_data['unit_test2'])) {
        $user_name = $unittest2->test_input($decode_data['user_name']);
        $unit_test2 = $unittest2->test_input($decode_data['unit_test2']);

        $unittest2->inSert($user_name, $unit_test2);
        echo json_encode(array("success" => "Data inserted successfully"));
    } else {
        echo json_encode(array("error" => "Incomplete"));
    }
}
?>

