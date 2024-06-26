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
    <link rel="stylesheet" href="home_restaurant2.css">
</head>

<body>
    <h1><br>Listen & Learn</h1>
    <form action="home_restaurant3.php">
        <div class="centering">
            <div class="articles">
                <article>
                    <figure>
                        <img src="restaurant.jpg" alt="Preview">
                    </figure>
                    <div class="article-preview">
                        <h2>2 : Presentation of Key Vocabulary</h2>
                        <h3>Conversation : At a restaurant</h3><br>
                        <h5>ลากเมาส์ไปยังคำศัพท์ที่ต้องการเพื่อดูความหมาย <br>(Drag mouse to the vocabulary you prefer to check for its definition.)</h5><br>
                        <!-- <p> -->
                        <table>
                            <tr>
                                <td class="left">
                                    <a class="read-more" title="ลูกค้า">
                                    Customer : </a>
                                </td>
                                <td>Hello.</td>
                            </tr>
                            <tr>
                                <td class="left1">Staff : </td>
                                <td> Hello. Welcome to our restaurant. Do you have a reservation?</td>
                            </tr>
                            <tr>
                                <td class="left">Customer : </td>
                                <td>No. Do you have
                                    <a class="read-more" title="โต๊ะว่าง">
                                    a table available? </a>
                                </td>
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
                                <td> Sure, right
                                    <a class="read-more" title="ทางนี้">
                                    this way.</a> Please
                                    <a class="read-more" title="นั่งก่อน">
                                    have a seat.</a> Here is the menu. Can I get you somnething to drink? </td>
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
                                <td>(One moment later.) Here are your
                                    <a class="read-more" title="เครื่งดื่ม">
                                    drinks.</a> Are you
                                    <a class="read-more" title="พร้อมที่จะสั่ง">
                                    ready to order</a>, or would you like some more time with the menu?
                                </td>
                            </tr>
                            <tr>
                                <td class="left">Customer : </td>
                                <td> We are ready to order. I'll have Pad Thai with shrimp,and
                                    <a class="read-more" title="แกงเขียวหวาน">
                                    green curry</a> with rice and Chicken.
                                </td>
                            </tr>
                            <tr>
                                <td class="left1">Staff : </td>
                                <td>Noted. Is there anything else you'd like, like
                                    <a class="read-more" title="ของกินเล่น/รองท้อง">
                                    appetizers</a> or
                                    <a class="read-more" title="ของหวาน">
                                    dessert?</a>
                                </td>
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
                                <td> (One moment later.) Here are your
                                    <a class="read-more" title="ในบริบทหมายถึง อาหารที่สั่ง">
                                    dishes</a>, Pad Thai and green curry with rice and Chicken. Here are the
                                    <a class="read-more" title="เครื่องปรุง">
                                    condiment</a>, just in case you need more
                                    <a class="read-more" title="รสชาติ">
                                    flovour</a> in your food.
                                </td>
                            </tr>
                            <tr>
                                <td class="left">Customer : </td>
                                <td>Thank you. They
                                    <a class="read-more" title="ดูหน้าอร่อย">
                                    look delicious.</a> After a moment, a customer call staff for bill checking.
                                </td>
                            </tr>
                            <tr>
                                <td class="left">Customer : </td>
                                <td>
                                    <a class="read-more" title="กรุณาเก็บเงินด้วย หรือพูดอีกอย่างว่า check please">
                                    Bill please?</a>
                                </td>
                            </tr>
                            <tr>
                                <td class="left1">Staff : </td>
                                <td>
                                    <a class="read-more" title="อาหารมื้อนี้เป็นอย่างไร">
                                    How was your meal?</a>
                                </td>
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


                            <!-- เพิ่มประโยคสนทนาและข้อมูลคนพูดตามที่คุณต้องการ -->
                        </table>
                        <!-- </p> -->
                        <!-- <audio id="myAudio" controls>
                            <source src="your-audio-file.mp3" type="audio/mpeg">
                            Your browser does not support the audio element.
                        </audio>

                        <div class="controls">
                            <button id="playButton">เล่น</button>
                            <button id="pauseButton">หยุด</button>
                            <button id="replayButton">เล่นซ้ำ</button>
                        </div>

                        <script src="home_tourist1.js"></script> -->
                    </div>
                </article>


            </div>
        </div>

        <br>
        <div class="button-container">
            <button formaction="home_restaurant1.php" id="button1">Back</button>
            <button>Next</button>
        </div>
    </form>
</body>

</html>