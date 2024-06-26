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
    <meta charset="UTF-8">
    <title>Web Application for Developing English Language Skills.</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="homeAdmin.css">

    <header class="header">
        <nav class="navbar">
            <br><br>
            <a href="homeAdmin.php">Home</a>
            <a href="../linkAdmin/link.php">Link</a>
            <a href="../testAdmin/test.php">Test</a>
            <a href="loginadmin.php">Admin</a>

        </nav>

        <nav class="navbar1">
            <br><br>
            <a href="../about/aboutAdmin.php">About</a>
            <a href="logout.php">Log out</a>

        </nav>
    </header>

</head>

<body>
    <div class="background">
        <div class="centering">
            <br><br>
            <div class="articles">

                <article>
                    <figure>
                        <img src="../homeAirport/airport.jpg" alt="Preview">
                    </figure>
                    <div class="article-preview">
                        <h2>At the <br> Airport</h2>
                        <p>
                            Transportation to Chumphon city center <br><br><br>
                            <center>
                                <a href="../homeAdmin/homeAirport/home_airport.html" class="read-more" title="เรียนรู้เพิ่มเติม">
                                    <form action="../homeAdmin/homeAirport/home_airport.php">
                                        <button id="button1">Learn more</button>
                                    </form>
                                </a>
                            </center>
                        </p>
                    </div>
                </article>
                <article>
                    <figure>
                        <img src="../homeRecreational/recreational activities.jpg" alt="Preview">
                    </figure>
                    <div class="article-preview">
                        <h2>Recreational Activities</h2>
                        <p>
                            Recommend outdoor activities<br><br><br>
                            <center>
                                <a href="../homeAdmin/homeRecreational/home_recreational.html" class="read-more" title="เรียนรู้เพิ่มเติม">
                                    <form action="../homeAdmin/homeRecreational/home_recreational.php">
                                        <button id="button1">Learn more</button>
                                    </form>
                                </a>
                            </center>
                        </p>
                    </div>
                </article>
                <article>
                    <figure>
                        <img src="../homeTourist/tourist attractions.jpg" alt="Preview">
                    </figure>
                    <div class="article-preview">
                        <h2>Tourist Attractions</h2>
                        <p>
                            Recommend places<br><br><br><br>
                            <center>
                                <a href="../homeAdmin/homeTourist/home_tourist.html" class="read-more" title="เรียนรู้เพิ่มเติม">
                                    <form action="../homeAdmin/homeTourist/home_tourist.php">
                                        <button id="button1">Learn more</button>
                                    </form>
                                </a>
                            </center>
                        </p>
                    </div>
                </article>
                <article>
                    <figure>
                        <img src="../homeShopping/shopping.jpg" alt="Preview">
                    </figure>
                    <div class="article-preview">
                        <h2>Shopping for Souvenirs</h2>
                        <p>
                            Recommend souvenirs<br><br><br><br>
                            <center>
                                <a href="../homeAdmin/homeShopping/home_shopping.html" class="read-more" title="เรียนรู้เพิ่มเติม">
                                    <form action="../homeAdmin/homeShopping/home_shopping.php">
                                        <button id="button1">Learn more</button>
                                    </form>
                                </a>
                            </center>
                        </p>
                    </div>
                </article>
                <article>
                    <figure>
                        <img src="../homeRestaurant/restaurant.jpg" alt="Preview">
                    </figure>
                    <div class="article-preview">
                        <h2>At the Restaurant</h2>
                        <p>
                            Recommend food and Beverages<br><br><br>
                            <center>
                                <a href="../homeAdmin/homeRestaurant/home_restaurant.html" class="read-more" title="เรียนรู้เพิ่มเติม">
                                    <form action="../homeAdmin/homeRestaurant/home_restaurant.php">
                                        <button id="button1">Learn more</button>
                                    </form>
                                </a>
                            </center>
                        </p>
                    </div>
                </article>

            </div>
        </div>
        </nav>

        <!-- <nav class="navbar1">
            <br><br>
            <a href="../about/aboutAdmin.php">About</a>
            <a href="loginadmin.html">Admin</a>
            <a href="logout.php">Logout</a>

        </nav> -->
    </div>


</body>

</html>