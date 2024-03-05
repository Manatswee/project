<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
header("Access-Control-Allow-Headers: X-Requested-With");
header("Content-Type: application/json");

require_once("../db.php");
$user = new User();

$api = $_SERVER["REQUEST_METHOD"];
if ($api == "GET"){
    $data = $user->fetchAll();
    echo json_encode($data);
}

if ($api == "POST") {
    $raw_data = file_get_contents("php://input");
    $decode_data = json_decode($raw_data, true);

    error_log(print_r($decode_data, true));
    if (isset($decode_data['Name']) && isset($decode_data['Email']) && isset($decode_data['Passwords'])) {
        $Name = $user->test_input($decode_data['Name']);
        $Email = $user->test_input($decode_data['Email']);
        $Passwords = $user->test_input($decode_data['Passwords']);

        $user->inSert($Name, $Email, $Passwords);
        echo json_encode(array("success" => "Data inserted successfully"));
    } else {
        echo json_encode(array("error" => "Incomplete"));
    }
}
?>

