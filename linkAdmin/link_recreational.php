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
    <link rel="stylesheet" href="link_recreational.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</head>

<body>


    <br>
    <!-- <form action="link.html"> -->
    <div id="carouselExampleControlsNoTouching" class="carousel slide" data-bs-touch="false" data-bs-interval="false">
        <div class="carousel-inner">

            <div class="carousel-item active">
                <form action="link.php">
                    <div class="slide-content">
                        <div class="card-wrapper">
                            <div class="card">
                                <div class="image-content">
                                    <span class="overlay"></span>
                                    <div class="card-image">
                                        <img src="../homeRecreational/recreational activities.jpg" alt="" class="card-img">
                                    </div>
                                </div>

                                <div class="card-content">
                                    <!-- <form action="link.php"> -->
                                    <h2 class="name">Recreational Activities</h2>
                                    <div class="description">
                                        <div class="container">
                                            <div class="image1"><img src="Website2.jpg" alt="รูปภาพ 1">
                                                <div class="overlay1"><a href="https://travel.kapook.com/view59280.html">Website</a></div>
                                            </div>

                                            <br>
                                            <div class="image1"><img src="Facebook2.jpg" alt="รูปภาพ 2">
                                                <div class="overlay1"><a href="https://www.facebook.com/ChangwatChumphon/?locale=th_TH">Facebook</a></div>
                                            </div>
                                        </div>

                                    </div>
                                    <!-- <br><button>Back</button> -->
                                    <!-- </form> -->
                                </div>

                            </div>
                        </div>
                    </div>
                    <br><button>Back</button>
                </form>
            </div>

        </div>

    </div>
    <!-- <button>Back</button>
    </form> -->
</body>



</html>