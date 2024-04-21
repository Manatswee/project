<?php
session_start();

$loggedInEmail = "";

if (isset($_SESSION['email'])) {
    $loggedInEmail = $_SESSION['email'];

    // Database connection 
    $con = new mysqli("localhost", "root", "", "web");

    if ($con->connect_error) {
        die("Failed to connect: " . $con->connect_error);
    } else {
        // Prepare SQL statement to retrieve user data based on the logged-in email
        $stmt = $con->prepare("SELECT * FROM admin1 WHERE Email = ?");
        $stmt->bind_param("s", $loggedInEmail);
        $stmt->execute();
        $user_result = $stmt->get_result();
        if ($user_result->num_rows > 0) {
            $userData = $user_result->fetch_assoc();
           
        } 
        // Add a check for the user role or any other criteria if necessary
        else {
            // Redirect to the login page if the user is not authorized
            header("Location: ../home/login.html");
            exit();
        }
    }
} else {
    // Redirect to the login page if the user is not logged in
    header("Location: ../home/login.html");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Web Application for Developing English Language Skills.</title>
    <link rel="stylesheet" href="loginadmin.css">
</head>

<body>


    <div class="background"></div>
    <div class="container">
        <div class="item">
            <h1>Web Application for Developing English Language Skills.</h1>
            <div class="text-item">
                <h2>WELCOME!!!! <br><span>
                To ......        
                </span></h2>
                <p>Attractions in Chumphon</p>
            </div>
        </div>

        <div class="login-section">
            <div class="form-box login">
                <form action="connectloginadmin.php" method="post">
                    <h2>Sign in ADMIN</h2>
                    <div class="input-box">
                        <input type="text" name="email" required>
                        <label>E - mail</label>
                    </div>
                    <div class="input-box">
                        <input type="password" name="passwords" required>
                        <label>Passwords</label>
                    </div>

                    <!-- <form method="post" action="home.php"> -->
                    <br><button class="btn">Login</button>


                    <!-- <div class="creater-account"></div>
                        <p><br><br>Create A New Account?
                            <a href="register.html" class="register-link">Sign Up</a>
                        </p>

                        <div class="remember-password">
                            
                            <a href="forget_password.html"><br><br><br>Forget Password</a>
                            
                        </div>

                    <script src="login.js"></script> -->

                </form>

                </form>

            </div>
        </div>
    </div>

</body>

</html>