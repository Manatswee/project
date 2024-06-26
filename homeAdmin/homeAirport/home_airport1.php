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
    <link rel="stylesheet" href="home_airport1.css">
</head>

<body>
    <h1><br>Listen & Learn</h1>
    <form action="home_airport2.php">
        <div class="centering">
            <div class="articles">
                <article>
                    <figure>
                        <img src="airport.jpg" alt="Preview">
                    </figure>
                    <div class="article-preview">
                        <h2>1 : Presentation of conversation</h2>
                        <h3>Conversation : At the airport information desk</h3><br>
                        <table>
                            <tr>
                                <td class="left">Customer Service :</td>
                                <td>Hello. How can I help you?</td>
                            </tr>
                            <tr>
                                <td class="left1">Tourist :</td>
                                <td>Yes, please. I would like to know how I can get to Chumphon city center.</td>
                            </tr>
                            <tr>
                                <td class="left">Customer Service :</td>
                                <td>Well, you can take the public bus or public minivan to the city.</td>
                            </tr>
                            <tr>
                                <td class="left1">Tourist :</td>
                                <td>Ok. How long does it take to get to the city?</td>
                            </tr>
                            <tr>
                                <td class="left">Customer Service :</td>
                                <td>The bus takes about an hour and a half, and the minivan takes about 40 minutes.</td>
                            </tr>
                            <tr>
                                <td class="left1">Tourist :</td>
                                <td>How much does a ticket cost?</td>
                            </tr>
                            <tr>
                                <td class="left">Customer Service :</td>
                                <td>The bus costs 100 Baht per person and the minivan costs 150 Baht per person.</td>
                            </tr>
                            <tr>
                                <td class="left1">Tourist :</td>
                                <td>Ok. Where can I get the ticket for the minivan?</td>
                            </tr>
                            <tr>
                                <td class="left">Customer Service :</td>
                                <td>There are ticket booths in front of the exit from the baggage claim area.</td>
                            </tr>
                            <tr>
                                <td class="left1">Tourist :</td>
                                <td>Which one do you recommend?</td>
                            </tr>
                            <tr>
                                <td class="left">Customer Service :</td>
                                <td>The prices are the same, and they offer good services.</td>
                            </tr>
                            <tr>
                                <td class="left1">Tourist :</td>
                                <td>Thank you very much. </td>
                            </tr>
                            <tr>
                                <td class="left">Customer Service :</td>
                                <td>You’re welcome. Have a good day.</td>
                            </tr>
                            <!-- เพิ่มประโยคสนทนาและข้อมูลคนพูดตามที่คุณต้องการ -->
                        </table>
                        <audio id="myAudio" controls>
                            <source src="../../sound/PresentationU1.mp3" type="audio/mpeg">
                            Your browser does not support the audio element.
                        </audio>

                        <div class="controls">
                            <button id="playButton">เล่น</button>
                            <button id="pauseButton">หยุด</button>
                            <button id="replayButton">เล่นซ้ำ</button>
                        </div>

                        <script src="home_airport1.js"></script>
                    </div>
                </article>


            </div>
        </div>

        <br><button>Next</button><br><br>
    </form>
</body>

</html>