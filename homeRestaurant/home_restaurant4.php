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
        <link rel="stylesheet" href="home_restaurant4.css">
    </head>

    <body>
        <h1><br>Practice</h1>
        <!-- <form action="home_airport5.html"> -->
        <div class="centering">
            <div class="articles">
                <article>
                    <figure>
                        <img src="restaurant.jpg" alt="Preview">
                    </figure>
                    <div class="article-preview">
                        <h2>Choose your practice partner.</h2>
                        <h3>Conversation : At the airport information desk</h3><br>
                        <!-- <button onclick="เลือกตำแหน่ง('Customer')">Customer</button><br><br>
                    <button onclick="เลือกตำแหน่ง('Staff')">Staff</button><br> -->

                        <button id="positionA">Customer</button><br><br>
                        <button id="positionB">Staff</button>

                        <br><br>
                        <h>Direction : Please speak after the tone.</h>

                        <audio id="audioA" src="../sound/U5Customer.mp3"></audio>
                        <audio id="audioB" src="../sound/U5Staff.mp3"></audio>
                        <script>
                            // JavaScript code for controlling audio playback
                            const audioA = document.getElementById("audioA");
                            const audioB = document.getElementById("audioB");

                            document.getElementById("positionA").addEventListener("click", function() {
                                audioB.pause();
                                audioA.currentTime = 0;
                                audioA.play();
                            });

                            document.getElementById("positionB").addEventListener("click", function() {
                                audioA.pause();
                                audioB.currentTime = 0;
                                audioB.play();
                            });
                        </script>

                        <br>
                        <table id="conversationTable">

                            <!-- แสดงเนื้อหาสนทนาและข้อมูลตามตำแหน่งที่เลือก -->
                            <br>
                            <tr>
                                <td class="left">Customer : </td>
                                <td>Hello.</td>
                            </tr>
                            <tr>
                                <td class="left1">Staff : </td>
                                <td> Hello. Welcome to our restaurant. Do you have a reservation?</td>
                            </tr>
                            <tr>
                                <td class="left">Customer : </td>
                                <td>No. Do you have a table available?</td>
                            </tr>
                            <tr>
                                <td class="left1">Staff : </td>
                                <td>For how many people?</td>
                            </tr>
                            <tr>
                                <td class="left">Customer : </td>
                                <td>Only two.</td>
                            </tr>
                            <tr>
                                <td class="left1">Staff : </td>
                                <td> Sure, right this way. Please have a seat. Here is the menu. Can I get you somnething to drink? </td>
                            </tr>
                            <tr>
                                <td class="left">Customer : </td>
                                <td>I'd like a bottle of water and a glass of ice, and a Thai iced tea for my friend.</td>
                            </tr>
                            <tr>
                                <td class="left1">Staff : </td>
                                <td>Thai iced tea and a bottle of water with ice. I'll be right back with your drinks.</td>
                            </tr>
                            <tr>
                                <td class="left">Customer : </td>
                                <td>Thank you.</td>
                            </tr>
                            <tr>
                                <td class="left1">Staff : </td>
                                <td>(One moment later.) Here are your drinks. Are you ready to order, or would you like some more time with the menu?</td>
                            </tr>
                            <tr>
                                <td class="left">Customer : </td>
                                <td> We are ready to order. I'll have Pad Thai with shrimp, and green curry with rice and Chicken.
                                </td>
                            </tr>
                            <tr>
                                <td class="left1">Staff : </td>
                                <td>Noted. Is there anything else you'd like, like appetizers or dessert?</td>
                            </tr>
                            <tr>
                                <td class="left">Customer : </td>
                                <td> No, that should be all for now.</td>
                            </tr>
                            <tr>
                                <td class="left1">Staff : </td>
                                <td>Alright, your order will be out shortly. Enjoy your drinks and if you need anything, please let us know.</td>
                            </tr>
                            <tr>
                                <td class="left1">Staff : </td>
                                <td> (One moment later.) Here are your dishes, Pad Thai and green curry with rice and Chicken. Here are the condiment, just in case you need more flovour in your food.</td>
                            </tr>
                            <tr>
                                <td class="left">Customer : </td>
                                <td>Thank you. They look delicious. After a moment, a customer call staff for bill checking.</td>
                            </tr>
                            <tr>
                                <td class="left">Customer : </td>
                                <td>Bill please?</td>
                            </tr>
                            <tr>
                                <td class="left1">Staff : </td>
                                <td>How was your meal?</td>
                            </tr>
                            <tr>
                                <td class="left">Customer : </td>
                                <td>It was fantastic.</td>
                            </tr>
                            <tr>
                                <td class="left1">Staff : </td>
                                <td>Thank you very much. Here's your bill. How do you want to pay?</td>
                            </tr>
                            <tr>
                                <td class="left">Customer : </td>
                                <td>Cash please. Here you are.</td>
                            </tr>
                            <tr>
                                <td class="left1">Staff : </td>
                                <td>Here is your change. Thank you for dinning with us. Have a wonderful day.</td>
                            </tr>
                            <tr>
                                <td class="left">Customer : </td>
                                <td>You too. Goodbye.</td>
                            </tr>

                        </table>



                    </div>
                </article>

            </div>
        </div>
        <br>
        <form action="home_restaurant5.php">
            <div class="button-container">
                <button formaction="home_restaurant3.php" id="button1">Back</button>
                <button>Next</button>
            </div>
        </form>
    </body>

    </html>