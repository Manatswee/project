<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Web Application for Developing English Language Skills.</title>
    <link rel="stylesheet" href="about.css">
</head>

<body>
    <h1><br>About</h1>
    <form action="connectlogin.php" method="post">
        <div class="centering">
            <div class="articles">
                <article>
                <figure style="background-color: #fce4ec;"></figure>
                    <div class="article-preview">

                        <?php
                        session_start();
                    
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
                                    // Display user profile data
                                    
                                    echo "<br><p><span style='font-weight: bold; margin-left: 150px;'>Name : </span>" . $userData['Name'] . "</p>";
                                    echo "<br><p><span style='font-weight: bold; margin-left: 150px;'>Surname : </span>" . $userData['Last_Name'] . "</p>";
                                    echo "<br><p><span style='font-weight: bold; margin-left: 150px;'>E-mail Address : </span>" . $userData['Email'] . "</p>";
                                    echo "<br><p><span style='font-weight: bold; margin-left: 150px;'>Passwords : </span>" . $userData['Passwords'] . "</p>";
                                    echo "<br><p><span style='font-weight: bold; margin-left: 150px;'>Degree/Occupation : </span>" . $userData['Status'] . "</p>";

                                    // You can display other user data as needed

                                    
                                } else {
                                    // echo "<h2>ไม่พบข้อมูลผู้ใช้</h2>";
                                }

                                
                                    // Prepare SQL statement to retrieve admin1 data based on the logged-in email
                                    $stmt = $con->prepare("SELECT * FROM admin1 WHERE email = ?");
                                    $stmt->bind_param("s", $loggedInEmail);
                                    $stmt->execute();
                                    $admin1_result = $stmt->get_result();
                        
                                    if ($admin1_result->num_rows > 0) {
                                        $admin1Data = $admin1_result->fetch_assoc();
                                        // Display admin1 profile data
                                        
                                        echo "<p><span style='font-weight: bold; margin-left: 150px;'>Name :</span><br><br> " . $admin1Data['Name'] . "</p>";
                                        echo "<p><span style='font-weight: bold; margin-left: 150px;'>Surname :</span><br><br> " . $admin1Data['Last_Name'] . "</p>";
                                        echo "<p><span style='font-weight: bold; margin-left: 150px;'>E-mail Address :</span><br><br> " . $admin1Data['Email'] . "</p>";
                                        echo "<p><span style='font-weight: bold; margin-left: 150px;'>Passwords :</span><br><br> " . $admin1Data['Passwords'] . "</p>";
                                        echo "<p><span style='font-weight: bold; margin-left: 150px;'>Degree/Occupation :</span><br><br> " . $admin1Data['Status'] . "</p>";
    
                                        // You can display other admin1 data as needed
                                    } else {
                                        // echo "<h2>ไม่พบข้อมูลผู้ใช้</h2>";
                                    }

                                
                    
                                // Close the statement and database connection
                                $stmt->close();
                                $con->close();
                            }
                        } else {
                            header("Location: ../home/login.html");
                            exit();
                        }
                        ?>
                </article>


                </div>
            </div>

    </form>

    <form action="../home/home.php">
        <br><button>Back</button><br><br>
    </form>
</body>

</html>