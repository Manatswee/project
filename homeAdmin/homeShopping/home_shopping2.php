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
    <link rel="stylesheet" href="home_shopping2.css">
</head>

<body>
    <h1><br>Listen & Learn</h1>
    <form action="home_shopping3.php">
        <div class="centering">
            <div class="articles">
                <article>
                    <figure>
                        <img src="shopping.jpg" alt="Preview">
                    </figure>
                    <div class="article-preview">
                        <h2>2 : Presentation of Key Vocabulary</h2>
                        <h3>Conversation: At a souvenir shop</h3><br>
                        <h5>ลากเมาส์ไปยังคำศัพท์ที่ต้องการเพื่อดูความหมาย <br>(Drag mouse to the vocabulary you prefer to check for its definition.)</h5><br>
                        <!-- <p> -->
                        <table>
                            <tr>
                                <td class="left">
                                    <a class="read-more" title="แม่ค้า/พ่อค้า">
                                    Shopkeeper :</a>
                                </td>
                                <td>Hello! Welcome to our
                                    <a class="read-more" title="ร้านขายของที่ระลึก">
                                    souvenir shop.</a> How can I
                                    <a class="read-more" title="ช่วยเหลือ สามารถแทนที่ด้วยคำว่า help แปลว่ามีอะไรให้ช่วยมั้ย">
                                    assist</a> you today?
                                </td>
                            </tr>
                            <tr>
                                <td class="left1">Tourist : </td>
                                <td> I am
                                    <a class="read-more" title="หา">
                                    looking for</a> some souvenirs to take back home. What do you have that's
                                    <a class="read-more" title="พิเศษ">
                                    unique</a> for Chumphon?</td>
                            </tr>
                            <tr>
                                <td class="left">Shopkeeper : </td>
                                <td>We have a variety of Chumphon souvenirs. We have
                                    <a class="read-more" title="ดั้งเดิม ประเพณีพื้นบ้าน">
                                    traditional</a>
                                    <a class="read-more" title="งานหัตถกรรม">
                                    handicrafts</a>,
                                    <a class="read-more" title="ภาพวาดจากผ้าบาติก">
                                    Batik painting</a>, T-shirts,
                                    <a class="read-more" title="ของกินเล่นประจำท้องถิ่น">
                                    local snacks</a>, and some beautiful
                                    <a class="read-more" title="เครื่องประดับจากเปลือกหอย">
                                    seashell jewelry.</a> Is there anything specific you are interested in?
                                </td>
                            </tr>
                            <tr>
                                <td class="left1">Tourist : </td>
                                <td> I would like to see the Batik painting and maybe some local snacks.</td>
                            </tr>
                            <tr>
                                <td class="left">Shopkeeper : </td>
                                <td>
                                    <a class="read-more" title="แน่นอน สามารถแทนที่ด้วยคำว่า sure">
                                    Certainly.</a> Please
                                    <a class="read-more" title="เดินดูรอบๆ">
                                    have a look around </a> and if you see anything you like, you can call me.
                                </td>
                            </tr>
                            <tr>
                                <td class="left1">Tourist : </td>
                                <td> I will take Batik T-shirts. What
                                    <a class="read-more" title="ไซต์">
                                    sizes</a> do you have? Do you have XXL?
                                </td>
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
                                <td> Is there
                                    <a class="read-more" title="อื่นๆ ใช้ในประโยคคำถาม">
                                    anything else</a> you would like?
                                </td>
                            </tr>
                            <tr>
                                <td class="left1">Tourist : </td>
                                <td>Yes, I will take 2 boxes of dried durian chips. How much is it
                                    <a class="read-more" title="รวมกัน">
                                    altogether?</a>
                                </td>
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
                                <td>Thank you. Here's your
                                    <a class="read-more" title="เงินทอน">
                                    change </a> and your items. Have a wonderful day and please visit us again.
                                </td>
                            </tr>
                            <tr>
                                <td class="left1">Tourist : </td>
                                <td>Goodbye!</td>
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

                        <script src="home_shopping1.js"></script> -->
                    </div>
                </article>


            </div>
        </div>

        <br>
        <div class="button-container">
            <button formaction="home_shopping1.php" id="button1">Back</button>
            <button>Next</button>
        </div>
    </form>
</body>

</html>