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
    <link rel="stylesheet" href="home_recreational2.css">
</head>

<body>
    <h1><br>Listen & Learn</h1>
    <form action="home_recreational3.php">
        <div class="centering">
            <div class="articles">
                <article>
                    <figure>
                        <img src="recreational activities.jpg" alt="Preview">
                    </figure>
                    <div class="article-preview">
                        <h2>2 : Presentation of Key Vocabulary</h2>
                        <h3>Conversation : At a tour agent office</h3><br>
                        <h5>ลากเมาส์ไปยังคำศัพท์ที่ต้องการเพื่อดูความหมาย <br>(Drag mouse to the vocabulary you prefer to check for its definition.)</h5><br>
                        <!-- <p> -->
                        <table>
                            <tr>
                                <td class="left">Tour agent : </td>
                                <td>Good morning.
                                    <a class="read-more" title="มีอะไรให้ฉันช่วยไหม">
                                    How can I help you?</a>
                                </td>
                            </tr>
                            <tr>
                                <td class="left1">Tourist : </td>
                                <td>I would like to know more about what I can do in Chumphon.</td>
                            </tr>
                            <tr>
                                <td class="left">Tour agent :</td>
                                <td>What kind of activities would you like to do?</td>
                            </tr>
                            <tr>
                                <td class="left1">Tourist : </td>
                                <td>I prefer
                                    <a class="read-more" title="กิจกรรมกลางแจ้ง">
                                    outdoor activities.</a> Do you have any
                                    <a class="read-more" title="คำแนะนำ">
                                    recommendations?</a>
                                </td>
                            </tr>
                            <tr>
                                <td class="left">Tour agent :</td>
                                <td>There are many activities you can do. If you like
                                    <a class="read-more" title="กิจกรรมชายหาด">
                                    beach activities</a>, you can visit Thung Wua Laen beach or Sai-ri beach. You can go swimming,
                                    <a class="read-more" title="อาบแดด">
                                    sunbathing</a>, or
                                    <a class="read-more" title="พายคายัค">
                                    kayaking.</a>
                                </td>
                            </tr>
                            <tr>
                                <td class="left1">Tourist : </td>
                                <td>Wow! Are there any hotels
                                    <a class="read-more" title="ละแวกนี้">
                                    around there?</a>
                                </td>
                            </tr>
                            <tr>
                                <td class="left">Tour agent :</td>
                                <td>Yes, there are many that you can choose from, a
                                    <a class="read-more" title="มาตรฐาน">
                                    standard</a> one or a
                                    <a class="read-more" title="หรูหรา">
                                    luxurious</a> one. It depends on what you would like.
                                </td>
                            </tr>
                            <tr>
                                <td class="left1">Tourist : </td>
                                <td>That's great. I am also
                                    <a class="read-more" title="สนใจ">
                                    interested in</a> kayaking.
                                </td>
                            </tr>
                            <tr>
                                <td class="left">Tour agent :</td>
                                <td>Our tour
                                    <a class="read-more" title="เสนอ/แนะนำ">
                                    offers</a>
                                    <a class="read-more" title="โปรแกรม 1 วัน">
                                    one-day package</a> of kayaking or a
                                    <a class="read-more" title="ซัพบอร์ด">
                                    SUP (stand-up paddle boarding)</a> package at Koh Prao which is known for its beautiful coastline, crystal-clear water, and coral reef. The package includes
                                    <a class="read-more" title="ค่าเช่าอุปกรณ์">
                                    equipment rental prices</a> such as a kayak, a paddle, and a lifejacket. If you are not experienced or prefer a guided experience, we also have this option available.
                                </td>
                            </tr>
                            <tr>
                                <td class="left1">Tourist : </td>
                                <td>How much does the kayaking package cost?</td>
                            </tr>
                            <tr>
                                <td class="left">Tour agent : </td>
                                <td>It starts from 1,000 Baht per person. It depends on what activities you want in the package. We also have a package for additional activities like
                                    <a class="read-more" title="ดำน้ำตื้น">
                                    15. snorkeling</a> or exploring nearby islands with our speedboat.
                                </td>
                            </tr>
                            <tr>
                                <td class="left1">Tourist : </td>
                                <td>Ok. This sounds interesting. Are there any other activities?</td>
                            </tr>
                            <tr>
                                <td class="left">Tour agent :</td>
                                <td>Thung Wualaen beach is a good place for windsurfing. Lessons and equipment rentals are often available at the beachfront restaurant there.</td>
                            </tr>
                            <tr>
                                <td class="left1">Tourist : </td>
                                <td>Are there any good places to eat around the beaches?</td>
                            </tr>
                            <tr>
                                <td class="left1">Tourist : </td>
                                <td>Yes, there are beach front bars and restaurants that you can enjoy fresh seafood and Thai cuisine with local flavors.</td>
                            </tr>
                            <tr>
                                <td class="left">Tour agent :</td>
                                <td>Wow! There are many things I can do. As I have just arrived, I will relax and think about the activities that I want to do. I will get back to you later if I decide.</td>
                            </tr>
                            <tr>
                                <td class="left1">Tourist : </td>
                                <td>No problem. Here is our business card and a brochure. You can call us for more information. Have a good day.</td>
                            </tr>
                            <tr>
                                <td class="left">Tour agent : </td>
                                <td>You too. Good bye.</td>
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

                        <script src="home_recreationa1.js"></script> -->
                    </div>
                </article>


            </div>
        </div>

        <br>
        <div class="button-container">
            <button formaction="home_recreational1.php" id="button1">Back</button>
            <button>Next</button>
        </div>
    </form>
</body>

</html>