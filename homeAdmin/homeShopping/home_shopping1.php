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
    <link rel="stylesheet" href="home_shopping1.css">
</head>

<body>
    <h1><br>Listen & Learn</h1>
    <form action="home_shopping2.php">
        <div class="centering">
            <div class="articles">
                <article>
                    <figure>
                        <img src="shopping.jpg" alt="Preview">
                    </figure>
                    <div class="article-preview">
                        <h2>1 : Presentation of conversation</h2>
                        <h3>Conversation: At a souvenir shop</h3><br>

                        <!-- <p> -->
                        <table>
                            <tr>
                                <td class="left">Shopkeeper : </td>
                                <td>Hello! Welcome to our souvenir shop. How can I assist you today?</td>
                            </tr>
                            <tr>
                                <td class="left1">Tourist : </td>
                                <td> I am looking for some souvenirs to take back home. What do you have that's unique for Chumphon?</td>
                            </tr>
                            <tr>
                                <td class="left">Shopkeeper : </td>
                                <td>We have a variety of Chumphon souvenirs. We have traditional handicrafts, Batik painting, T-shirts, local snacks, and some beautiful seashell jewelry. Is there anything specific you are interested in?</td>
                            </tr>
                            <tr>
                                <td class="left1">Tourist : </td>
                                <td> I would like to see the Batik painting and maybe some local snacks.</td>
                            </tr>
                            <tr>
                                <td class="left">Shopkeeper : </td>
                                <td> Certainly. Please have a look around and if you see anything you like, you can call me.</td>
                            </tr>
                            <tr>
                                <td class="left1">Tourist : </td>
                                <td> I will take Batik T-shirts. What sizes do you have? Do you have XXL?</td>
                            </tr>
                            <tr>
                                <td class="left">Shopkeeper : </td>
                                <td> Sorry, we have only XL, L and S. They are only 200 Baht each.</td>
                            </tr>
                            <tr>
                                <td class="left1">Tourist : </td>
                                <td>Well, I will take 2 of XL and 1 of L.</td>
                            </tr>
                            <tr>
                                <td class="left">Shopkeeper : </td>
                                <td> Is there anything else you would like?</td>
                            </tr>
                            <tr>
                                <td class="left1">Tourist : </td>
                                <td>Yes, I will take 2 boxes of dried durian chips. How much is it altogether?</td>
                            </tr>
                            <tr>
                                <td class="left">Shopkeeper : </td>
                                <td>OK. That will be 900 Baht in total. How would you like to pay?</td>
                            </tr>
                            <tr>
                                <td class="left1">Tourist : </td>
                                <td> I will pay in cash please.</td>
                            </tr>
                            <tr>
                                <td class="left">Shopkeeper : </td>
                                <td>Thank you. Here's your change and your items. Have a wonderful day and please visit us again.</td>
                            </tr>
                            <tr>
                                <td class="left1">Tourist : </td>
                                <td>Goodbye!</td>
                            </tr>

                            <!-- เพิ่มประโยคสนทนาและข้อมูลคนพูดตามที่คุณต้องการ -->
                        </table>
                        <!-- </p> -->
                        <audio id="myAudio" controls>
                            <source src="../../sound/PresentationU4.mp3" type="audio/mpeg">
                            Your browser does not support the audio element.
                        </audio>

                        <div class="controls">
                            <button id="playButton">เล่น</button>
                            <button id="pauseButton">หยุด</button>
                            <button id="replayButton">เล่นซ้ำ</button>
                        </div>

                        <script src="home_shopping1.js"></script>
                    </div>
                </article>


            </div>
        </div>

        <br><button>Next</button><br><br>
    </form>
</body>

</html>