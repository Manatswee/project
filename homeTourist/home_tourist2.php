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
    <link rel="stylesheet" href="home_tourist2.css">
</head>

<body>
    <h1><br>Presentation</h1>
    <form action="home_tourist3.php">
        <div class="centering">
            <div class="articles">
                <article>
                    <figure>
                        <img src="tourist attractions.jpg" alt="Preview">
                    </figure>
                    <div class="article-preview">
                        <h2>2 : Presentation of Key Vocabulary</h2>
                        <h3>Conversation: At a tourist information counter</h3><br>
                        <h5>ลากเมาส์ไปยังคำศัพท์ที่ต้องการเพื่อดูความหมาย <br>(Drag mouse to the vocabulary you prefer to check for its definition.)</h5><br>
                        <!-- <p> -->
                        <table>
                            <tr>
                                <td class="left">Tourist : </td>
                                <td>Excuse me. Can you speak English?</td>
                            </tr>
                            <tr>
                                <td class="left1">Tourist Information Staff : </td>
                                <td>Yes. How can I help you today?</td>
                            </tr>
                            <tr>
                                <td class="left">Tourist : </td>
                                <td>Hello, I am Richard. I've just arrived. I would like some
                                    <a class="read-more" title="คำแนะนำ">
                                    recommendations</a> for
                                    <a class="read-more" title="สถานที่">
                                    places</a> to visit in Chumphon.
                                </td>
                            </tr>
                            <tr>
                                <td class="left1">Tourist Information Staff : </td>
                                <td>There are many places that you can visit. Are you interested in
                                    <a class="read-more" title="สถานที่ท่องเที่ยวทางธรรมชาติ">
                                    natural attractions</a>,
                                    <a class="read-more" title="สถานที่ท่องเที่ยวทางวัฒนธรรม">
                                    cultural sites</a> or
                                    <a class="read-more" title="สิ่งอื่นๆ นอกเหนือจากนี้ ใช้เมื่อกล่าวถึงสิ่งอื่นมาก่อนหน้านี้">
                                    something else?</a>
                                </td>
                            </tr>
                            <tr>
                                <td class="left">Tourist : </td>
                                <td> I am interested in both natural and cultural attractions. What would you recommend?</td>
                            </tr>
                            <tr>
                                <td class="left1">Tourist Information Staff : </td>
                                <td> Well, for natural attractions, you can visit Thung Wua Laen beach. It is
                                    <a class="read-more" title="มีชื่อเสียง">
                                    well-known</a>for its clear waters and peaceful atmosphere. There is also Khao Dinsor
                                    <a class="read-more" title="จุดชมวิว">
                                    viewpoint</a> where you can enjoy
                                    <a class="read-more" title="การเดินป่า">
                                    hiking</a>,
                                    <a class="read-more" title="การส่องนก">
                                    bird watching</a> or enjoy the incredible
                                    <a class="read-more" title="ภาพมุมกว้างแบบพาราโนมา">
                                    panoramic views</a> of the areas including the beach areas.
                                </td>
                            </tr>
                            <tr>
                                <td class="left">Tourist : </td>
                                <td>That sounds
                                    <a class="read-more" title="น่าสนใจ">
                                    interesting.</a> I also heard about Prince of Chumphon shrine. Where is it?
                                </td>
                            </tr>
                            <tr>
                                <td class="left1">Tourist Information Staff : </td>
                                <td>Ok. That is at Had Sai Ri beach which is in a different direction of Thung Wualaen beach. It is
                                    <a class="read-more" title="ตั้งอยู่">
                                    situated</a> on the east of the city center.
                                </td>
                            </tr>
                            <tr>
                                <td class="left">Tourist : </td>
                                <td>Are there any cultural <a class="read-more" title="แหล่งท่องเที่ยว">
                                    attractions</a>?
                                </td>
                            </tr>
                            <tr>
                                <td class="left1">Tourist Information Staff : </td>
                                <td>Yes, there is Chumphon National Museum where you can learn about the history and
                                    <a class="read-more" title="ภูมิปัญญาท้องถิ่น">
                                    local wisdom</a> of the province.</td>
                            </tr>
                            <tr>
                                <td class="left">Tourist : </td>
                                <td>Thank you very much for your recommendations. How can I get to these places from here? </td>
                            </tr>
                            <tr>
                                <td class="left1">Tourist Information Staff : </td>
                                <td>Most of these attractions are easily
                                    <a class="read-more" title="สามารถไปถึงได้">
                                    accessible </a> by tuk-tuk (a local two row minibus) from the city center. If you can ride a motorcycle, you can also rent a motorcycle for more flexibility. How long would you like to
                                    stay there?
                                </td>
                            </tr>
                            <tr>
                                <td class="left">Tourist : </td>
                                <td>Maybe around one month. Thank you very much. I am excited to explore Chumphon now.</td>
                            </tr>
                            <tr>
                                <td class="left1">Tourist Information Staff : </td>
                                <td>You are welcome! Enjoy your visit. If you have any questions or need any assistance, please feel free to contact us. Have a wonderful day.</td>
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

        <br><button>Next</button><br><br>
    </form>
</body>

</html>