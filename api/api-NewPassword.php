<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
header("Access-Control-Allow-Headers: X-Requested-With");
header("Content-Type: application/json");

require_once("../db.php");
$new_password = new NewPassword();

$api = $_SERVER["REQUEST_METHOD"];
if ($api == "GET"){
    $email = isset($_GET['email']) ? $_GET['email'] : null;
    if ($email) {
        $data = $new_password->fetchAll($email);
        echo json_encode($data);
    } else {
        echo json_encode(array("message" => "Email parameter is missing"));
    }
}

if ($api == "PUT"){
    if (isset($_GET['email']) && isset($_POST['passwords'])) {
        $email = $_GET['email'];
        $passwords = $_POST['passwords'];

        $result = $new_password->update($passwords, $email);
    
        if ($result) {
            echo "Password updated successfully.";
        } else {
            echo "Failed to update password.";
        }
    } else {
        echo "Missing email or passwords parameters.";
    }

}
// // Delete an user from database
// if ($api == "DELETE") {
//     if ($email != null){
//         if ($user->delete($email)) {
//             echo $user->message("User deleted successfully", false);
//         }else {
//             echo $user->message("Failed to delete an user", true);
//         }
//     }else {
//         echo $user->message("User not found!", true);
//     }
// }
?>

