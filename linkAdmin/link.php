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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Web Application for Developing English Language Skills.</title>
    <link rel="stylesheet" href="link.css">

</head>

<body>

    <!-- <h1><br>Ways to contact the place in the lesson</h1> -->
    <h1><br>Link</h1>
    <form action="../home/homeAdmin.php">

        <div class="centering">


            <div class="articles">
                <article>
                    <figure>
                        <img src="../homeAirport/airport.jpg" alt="Preview">
                    </figure>
                    <div class="article-preview">
                        <h2>At the <br> Airport</h2>
                        <p>
                            Transportation to Chumphon city center
                            <a href="link_airport.php" class="read-more" title="อ่านเพิ่มเติม">
                                Read More
                                </a>
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
                            Recommend outdoor activities
                            <a href="link_recreational.php" class="read-more" title="อ่านเพิ่มเติม">
                                Read More
                                </a>
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
                            Recommend places
                            <a href="link_tourist.php" class="read-more" title="อ่านเพิ่มเติม">
                                Read More
                                </a>
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
                            Recommend souvenirs
                            <a href="link_shopping.php" class="read-more" title="อ่านเพิ่มเติม">
                                Read More
                                </a>
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
                            Recommend food and Beverages
                            <a href="link_restaurant.php" class="read-more" title="อ่านเพิ่มเติม">
                                Read More
                                </a>
                        </p>
                    </div>
                </article>
            </div>


        </div>

        <!-- </div> -->

        <br><button>Back</button>
    </form>
</body>

</html>