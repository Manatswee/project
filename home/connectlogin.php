<?php
session_start(); // เริ่มต้นเซสชั่น

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $passwords = $_POST['passwords'];

    // Database connection
    $con = new mysqli("localhost", "root", "", "web");

    if ($con->connect_error) {
        die("Failed to connect: " . $con->connect_error);
    } else {
        // Check if the email is admin or not
        if ($email === "admin@gmail.com") {
            // If admin, search in the admin1 table
            $stmt = $con->prepare("SELECT * FROM admin1 WHERE email = ?");
        } else {
            // If not admin, search in the user table
            $stmt = $con->prepare("SELECT * FROM user WHERE email = ?");
        }

        $stmt->bind_param("s", $email);
        $stmt->execute();
        $user_result = $stmt->get_result();

        if ($user_result->num_rows > 0) {
            $data = $user_result->fetch_assoc();
            if ($data['Passwords'] == $passwords) {
                $_SESSION['email'] = $email;
                $_SESSION['expire_time'] = time() + 600; // เซสชั่นจะหมดอายุใน 10 นาที (600 วินาที)

                // Check if there is a score for the user
                $stmt_score = $con->prepare("SELECT email FROM score_pretest WHERE email = ?");
                $stmt_score->bind_param("s", $email);
                $stmt_score->execute();
                $score_login = $stmt_score->get_result();

                // If there is a score for the user, redirect to home.php
                if ($score_login->num_rows > 0) {
                    header("Location: home.php");
                    exit();
                }
                else if ($email === "admin@gmail.com") {
                    // If admin, redirect to homeAdmin.php
                    header("Location: homeAdmin.html");
                    exit();
                }
                 else {
                    header("Location: homepage.php");
                    exit();
                }
            } else {
                // Show an alert if email or password is incorrect using JavaScript
                echo '<script>alert("E-mail หรือ Password ไม่ถูกต้อง"); window.location.href = "login.html";</script>';
            }
        } else {
            // Show an alert if email or password is incorrect using JavaScript
            echo '<script>alert("E-mail หรือ Password ไม่ถูกต้อง"); window.location.href = "login.html";</script>';
        }

        // Close the statements and database connection
        $stmt->close();
        $stmt_score->close();
        $con->close();
    }
} else {
    // Redirect to an error page or handle the error accordingly
    header("Location: error.html");
    exit();
}
?>
