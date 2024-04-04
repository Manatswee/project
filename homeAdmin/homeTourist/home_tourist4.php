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
    <link rel="stylesheet" href="home_tourist4.css">
</head>

<body>
    <h1><br>Practice</h1>
    <!-- <form action="home_airport5.html"> -->
    <div class="centering">
        <div class="articles">
            <article>
                <figure>
                    <img src="tourist attractions.jpg" alt="Preview">
                </figure>
                <div class="article-preview">
                    <h2>Choose your practice partner.</h2>
                    <h3>Conversation : At the airport information desk</h3><br>
                    <!-- <button onclick="เลือกตำแหน่ง('Tourist')">Tourist</button><br><br>
                    <button onclick="เลือกตำแหน่ง('Tourist Information Staff')">Tourist Information Staff</button><br> -->

                    <button id="positionA">Tourist</button><br><br>
                    <button id="positionB">Tourist Information Staff</button>

                    <br><br>
                    <h>*กดปุ่มครั้งที่ 1 เพื่อฟังเสียงคู่สนทนา กดปุ่มเดิม ครั้งที่ 2 เพื่อหยุดเสียงคู่สนทนา</h>

                    <audio id="audioA" src="../../sound/U3TouristInfo.mp3"></audio>
                    <audio id="audioB" src="../../sound/U3Tourist.mp3"></audio>

                    <script src="home_tourist4.js"></script>

                    <br>
                    <table id="conversationTable">

                        <!-- แสดงเนื้อหาสนทนาและข้อมูลตามตำแหน่งที่เลือก -->
                        <br>
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
                            <td>Hello, I am Richard. I've just arrived. I would like some recommendations for places to visit in Chumphon.</td>
                        </tr>
                        <tr>
                            <td class="left1">Tourist Information Staff : </td>
                            <td>There are many places that you can visit. Are you interested in natural attractions, cultural sites or something else?</td>
                        </tr>
                        <tr>
                            <td class="left">Tourist : </td>
                            <td> I am interested in both natural and cultural attractions. What would you recommend?</td>
                        </tr>
                        <tr>
                            <td class="left1">Tourist Information Staff : </td>
                            <td> Well, for natural attractions, you can visit Thung Wua Laen beach. It is well-known for its clear waters and peaceful atmosphere. There is also Khao Dinsor viewpoint where you can enjoy hiking, bird watching or enjoy the incredible
                                panoramic views of the areas including the beach areas.</td>
                        </tr>
                        <tr>
                            <td class="left">Tourist : </td>
                            <td>That sounds interesting. I also heard about Prince of Chumphon shrine. Where is it?</td>
                        </tr>
                        <tr>
                            <td class="left1">Tourist Information Staff : </td>
                            <td>Ok. That is at Had Sai Ri beach which is in a different direction of Thung Wualaen beach. It is situated on the east of the city center.</td>
                        </tr>
                        <tr>
                            <td class="left">Tourist : </td>
                            <td>Are there any cultural attractions?</td>
                        </tr>
                        <tr>
                            <td class="left1">Tourist Information Staff : </td>
                            <td>Yes, there is Chumphon National Museum where you can learn about history and local wisdom of the province.</td>
                        </tr>
                        <tr>
                            <td class="left">Tourist : </td>
                            <td>Thank you very much for your recommendations. How can I get to these places from here? </td>
                        </tr>
                        <tr>
                            <td class="left1">Tourist Information Staff : </td>
                            <td>Most of these attractions are easily accessible by tuk-tuk (a local two row minibus) from the city center. If you can ride a motorcycle, you can also rent a motorcycle for more flexibility. How long would you like to stay there?</td>
                        </tr>
                        <tr>
                            <td class="left">Tourist : </td>
                            <td>Maybe around one month. Thank you very much. I am excited to explore Chumphon now.</td>
                        </tr>
                        <tr>
                            <td class="left1">Tourist Information Staff : </td>
                            <td>You are welcome! Enjoy your visit. If you have any questions or need any assistance, please come back here. Have a wonderful day.</td>
                        </tr>

                    </table>

                    <script src="home_airport4.js"></script>

                </div>
            </article>

        </div>
    </div>
    <br>
    <form action="home_tourist5.php">
        <div class="button-container">
            <button formaction="home_tourist3.php" id="button1">Back</button>
            <button>Next</button>
        </div>
    </form>
    <!-- </form> -->
</body>

</html>