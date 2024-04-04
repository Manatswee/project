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
    <link rel="stylesheet" href="home_tourist5.css">
</head>

<body>
    <h1><br>Production</h1>
    <!-- <form action="#"> -->
    <div class="centering">
        <div class="articles">
            <article>
                <figure>
                    <img src="tourist attractions.jpg" alt="Preview">
                </figure>
                <div class="article-preview">
                    <h2>Listen and respond to the questions.</h2>
                    <!-- <h3>Record speech immediate response to check confidence.</h3><br> -->
                    <table>

                        <tr>
                            <td class="left">
                                <h4>Question1:</h4>
                                <!-- Where does this conversation take place? -->
                                <br><br>
                                <div class="controls">
                                    <button id="positionA">Play</button>
                                    <audio id="audioA" src="../../sound/ProductionU3Q1.mp3"></audio>
                                </div>
                            </td>
                        </tr>

                        <tr>
                            <td class="left1">Answer1 :
                                <div class="controls">
                                    <button id="recordButton1">
                                        Record</button>
                                    <div id="output1"></div><br>
                                    <!-- <button class="" id="startRecord1">บันทึก 1</button>
                                    <button class="stopButton" id="stopRecord1" disabled>หยุด 1</button> -->
                                </div>

                            </td>

                        </tr>

                        <tr>
                            <td class="left">
                                <h4>Question2:</h4>
                                <!-- What are the activities a tourist information staff mentioned about <br>Khao Dinsor viewpoint? -->
                                <br><br>
                                <div class="controls">
                                    <button id="positionB">Play</button>
                                    <audio id="audioB" src="../../sound/ProductionU3Q2.mp3"></audio>
                                </div>
                            </td>
                        </tr>

                        <tr>
                            <td class="left1">Answer2 :
                                <div class="controls">
                                    <button id="recordButton2">
                                        Record</button>
                                    <div id="output2"></div><br>
                                    <!-- <button class="recordButton" id="startRecord2">บันทึก 2</button>
                                    <button class="stopButton" id="stopRecord2" disabled>หยุด 2</button> -->
                                </div>
                            </td>
                        </tr>

                        <tr>
                            <td class="left">
                                <h4>Question3:</h4>
                                <!-- Does he interested in going to Khao Dinsor? -->
                                <br><br>
                                <div class="controls">
                                    <button id="positionC">Play</button>
                                    <audio id="audioC" src="../../sound/ProductionU4Q3.mp3"></audio>
                                </div>
                            </td>
                        </tr>

                        <tr>
                            <td class="left1">Answer3 :
                                <div class="controls">
                                    <button id="recordButton3">
                                        Record</button>
                                    <div id="output3"></div><br>
                                    <!-- <button class="recordButton" id="startRecord3">บันทึก 3</button>
                                    <button class="stopButton" id="stopRecord3" disabled>หยุด 3</button> -->
                                </div>
                            </td>

                        </tr>

                        <tr>
                            <td class="left">
                                <h4>Question4:</h4>
                                <!-- What are the public transportation mentioned by the staff? -->
                                <br><br>
                                <div class="controls">
                                    <button id="positionD">Play</button>
                                    <audio id="audioD" src="../../sound/ProductionU3Q4.mp3"></audio>
                                </div>
                            </td>
                        </tr>

                        <tr>
                            <td class="left1">Answer4 :
                                <div class="controls">
                                    <button id="recordButton4">
                                        Record</button>
                                    <div id="output4"></div><br>
                                    <!-- <button class="recordButton" id="startRecord4">บันทึก 4</button>
                                    <button class="stopButton" id="stopRecord4" disabled>หยุด 4</button> -->
                                </div>
                            </td>

                        </tr>


                        <!-- เพิ่มประโยคสนทนาและข้อมูลคนพูดตามที่คุณต้องการ -->
                    </table>

                    <!-- เพิ่มปุ่ม "Submit" -->
                    <br><button id="submitButton">Submit</button>

                    <!-- ส่วนที่จะแสดงคะแนน -->
                    <div id="scoreDisplay">คะแนน: </div>

                    <script src="home_tourist5.js"></script>
                </div>
            </article>


        </div>
    </div>
    <div class="button-container">
        <form action="home_tourist4.php" method="get">
            <button type="submit" id="button1">Back</button>
        </form>
        <form action="../../home/homeAdmin.php" method="get">
            <button type="submit" id="button">Finish</button>
        </form>
    </div>

</body>

</html>