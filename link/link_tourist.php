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
        $stmt = $con->prepare("SELECT * FROM user WHERE Email = ?");
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
        <link rel="stylesheet" href="link_tourist.css">
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
                                            <img src="../homeTourist/tourist attractions.jpg" alt="" class="card-img">
                                        </div>
                                    </div>

                                    <div class="card-content">
                                        <!-- <form action="link.php"> -->
                                        <h2 class="name">Tourist Attractions</h2>
                                        <div class="description">
                                            <div class="container">
                                                <div class="image1"><img src="../linkAdmin/Website3.jpg" alt="รูปภาพ 1">
                                                    <div class="overlay1"><a href="https://th.readme.me/p/38220">Website</a></div>
                                                </div>

                                                <br>
                                                <div class="image1"><img src="../linkAdmin/Facebook3.jpg" alt="รูปภาพ 2">
                                                    <div class="overlay1"><a href="https://www.facebook.com/p/%E0%B8%88%E0%B8%B8%E0%B8%94%E0%B8%8A%E0%B8%A1%E0%B8%A7%E0%B8%B4%E0%B8%A7%E0%B9%81%E0%B8%AB%E0%B8%A5%E0%B8%A1%E0%B9%81%E0%B8%97%E0%B9%88%E0%B8%99%E0%B9%81%E0%B8%94%E0%B8%99%E0%B8%AA%E0%B8%AD%E0%B8%87%E0%B8%95%E0%B8%B0%E0%B8%A7%E0%B8%B1%E0%B8%99-100064543458684/?paipv=0&eav=AfYsNfgtqXJLONrpCjb8pQALMzqe2IRyu88EHz8dhuaFrhkB0d3ffwJ4uhPdQ0lu3zs&_rdr">Facebook</a></div>
                                                </div>
                                            </div>
                                            <br>

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