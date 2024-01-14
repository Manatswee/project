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
        $stmt = $con->prepare("SELECT * FROM user WHERE email = ?");
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
    <meta charset="UTF-8">
    <title>Web Application for Developing English Language Skills.</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="homepage.css">

    <header class="header">
        <nav class="navbar">
            <br><br>
            <!-- <form action="session.php" method="post"> -->

            <!-- <a href="home.html">Home</a> -->
            <!-- <a href="test1_1.html">Test</a> -->
            <a href="../homepageNewUser/link.php">Link</a>
            <a href="../homepageNewUser/about.php">About</a>
            <a href="logout.php">Logout</a>
            <!-- <a href="loginadmin.html">Admin</a> -->

            <!-- </form> -->
        </nav>
    </header>

</head>

<body>
    <div class="homepage">
        <div class="topic">
            <h1>Web Application for Developing <br>English Language Skills</h1>
        </div>
        <div class="test">
            <button>
                <span><a href="../test/Pretest.php">Test</a></span>
            </button>
        </div>
    </div>

</body>

</html>