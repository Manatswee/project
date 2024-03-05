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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Web Application for Developing English Language Skills.</title>
    <link rel="stylesheet" href="Posttest.css">
</head>

<body>
    <h1><br>Test</h1>
    <form action="../home/home.php">
        <div class="centering">
            <div class="articles">
                <!-- <article>
                    <figure>
                        <img src="test.jpg" alt="Preview">
                    </figure>
                    <div class="article-preview">
                        <h2>Pre-Test</h2>
                        <p>
                            Start taking tests before class.

                            <br><br>(เริ่มทำแบบทดสอบก่อนเรียน)

                            <br><br>
                            <a href="test2.html" class="read-more" title="แบบทดสอบก่อนเรียน">
                                <h1>Test</h1>
                            </a>
                        </p>
                    </div>
                </article> -->
                <article>
                    <figure>
                        <img src="../test/test.jpg" alt="Preview">
                    </figure>
                    <div class="article-preview">
                        <h2>Post-Test</h2>
                        <p>
                            Start taking the test after class.

                            <br><br>(เริ่มทำแบบทดสอบหลังเรียน)


                            <br><br>
                            <a href="Posttest1.php" class="read-more" title="แบบทดสอบหลังเรียน">
                                <h1>Test</h1>
                            </a>
                        </p>
                    </div>
                </article>

            </div>
        </div>
        <br><button>Back</button>
    </form>
</body>

</html>