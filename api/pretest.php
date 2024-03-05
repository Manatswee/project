<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
header("Access-Control-Allow-Headers: X-Requested-With");
header("Content-Type: application/json");

require_once("../db.php");
$pretest = new ScorePretest();

$api = $_SERVER["REQUEST_METHOD"];
if ($api == "GET"){
    $data = $pretest->fetchAll();
    echo json_encode($data);
}

if ($api == "POST") {
    $raw_data = file_get_contents("php://input");
    $decode_data = json_decode($raw_data, true);

    error_log(print_r($decode_data, true));
    if (isset($decode_data['user_name']) && isset($decode_data['score_pretest'])) {
        $user_name = $pretest->test_input($decode_data['user_name']);
        $score_pretest = $pretest->test_input($decode_data['score_pretest']);
        $email = $pretest->test_input($decode_data['email']);

        $pretest->inSert($user_name, $score_pretest, $email );
        echo json_encode(array("success" => "Data inserted successfully"));
    } else {
        echo json_encode(array("error" => "Incomplete"));
    }
}
?>

