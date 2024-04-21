<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['email'])) {
        $email = $_POST['email'];

        // Connect to MySQL database
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "web";

        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $newPassword = $_POST['password'];
        $confirmPassword = $_POST['confirmPassword'];

        if ($newPassword == $confirmPassword) {
            // Prepare SQL statement to update password
            $sql = "UPDATE user SET Passwords = ? WHERE Email = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ss", $newPassword, $email);

            if ($stmt->execute()) {
                header('Location: ../home/login.html');
                echo "Password updated successfully";
                exit; // สิ้นสุดการทำงานของสคริปต์หลังจากทำการ Redirect
            } else {
                echo "Error updating password: " . $conn->error;
            }
        } else {
            echo "Passwords do not match";
        }
        

        
        $conn->close();
    } else {
        echo "Email not provided";
    }
}
?>
