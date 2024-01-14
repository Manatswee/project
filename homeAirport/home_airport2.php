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
    <link rel="stylesheet" href="home_airport2.css">
</head>

<body>
    <h1><br>Presentation</h1>
    <form action="home_airport3.php">
        <div class="centering">
            <div class="articles">
                <article>
                    <figure>
                        <img src="airport.jpg" alt="Preview">
                    </figure>
                    <div class="article-preview">
                        <h2>2 : Presentation of Key Vocabulary</h2>
                        <h3>Conversation : At the airport information desk</h3><br>
                        <h5>ลากเมาส์ไปยังคำศัพท์ที่ต้องการเพื่อดูความหมาย <br>(Drag mouse to the vocabulary you prefer to check for its definition.)</h5><br>
                        <table>
                            <tr>
                                <td class="left">Customer Service :</td>
                                <td>Hello. How can I help you?</td>
                            </tr>
                            <tr>
                                <td class="left1">Tourist :</td>
                                <td>
                                    <a class="read-more" title="ตอบรับเพื่อขอความช่วยเหลืออย่างสุภาพ">
                                    Yes, please.</a> I would like to know how I can get to Chumphon
                                    <a class="read-more" title="ตัวเมือง">
                                    city center.</a>
                                </td>
                            </tr>
                            <tr>
                                <td class="left">Customer Service :</td>
                                <td>Well, you can take the
                                    <a class="read-more" title="รถบัสสาธารณะ">
                                    public bus</a> or
                                    <a class="read-more" title="รถตู้สาธารณะ">
                                    public minivan</a> to the city.
                                </td>
                            </tr>
                            <tr>
                                <td class="left1">Tourist :</td>
                                <td>Ok.
                                    <a class="read-more" title="ใช้เวลานานเท่าไหร่ ถามระยะเวลา">
                                    How long</a> does it take to get to the city?</td>
                            </tr>
                            <tr>
                                <td class="left">Customer Service :</td>
                                <td>The bus takes
                                    <a class="read-more" title="ประมาณ บอกระยะเวลาคร่าวๆ">
                                    about</a>
                                    <a class="read-more" title="1 ชั่วโมง">
                                    an hour</a> and a half, and the minivan takes about 40
                                    <a class="read-more" title="นาที">
                                    minutes.</a></td>
                            </tr>
                            <tr>
                                <td class="left1">Tourist :</td>
                                <td>
                                    <a class="read-more" title="ถามสิ่งที่นับไม่ได้ เช่น ราคาเท่าไหร่">
                                    How much</a> does a ticket cost?</td>
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
                                <td>There are
                                    <a class="read-more" title="จุดจำหน่ายตั๋ว">
                                    ticket booths</a> in front of the
                                    <a class="read-more" title="ทางออก">
                                    exit</a> from the
                                    <a class="read-more" title="จุดรับสัมภาระจากสายพาน">
                                    baggage claim area.</a>
                                </td>
                            </tr>
                            <tr>
                                <td class="left1">Tourist :</td>
                                <td>Which one do you
                                    <a class="read-more" title="แนะนำ">
                                    recommend?</a>
                                </td>
                            </tr>
                            <tr>
                                <td class="left">Customer Service :</td>
                                <td>The 
                                    <a class="read-more" title="ราคา">
                                    prices</a> are
                                    <a class="read-more" title="เท่ากัน">
                                    the same</a>, and they offer good services.
                                </td>
                            </tr>
                            <tr>
                                <td class="left1">Tourist :</td>
                                <td>Thank you very much. </td>
                            </tr>
                            <tr>
                                <td class="left">Customer Service :</td>
                                <td>You’re welcome.
                                    <a class="read-more" title="ขอให้มีวันที่ดี เป็นการพูดจบสนทนาด้วยมิตรภาพที่ดี">
                                    Have a good day.</a>
                                </td>
                            </tr>
                            <!-- เพิ่มประโยคสนทนาและข้อมูลคนพูดตามที่คุณต้องการ -->
                        </table>

                        <script src="home_airport2.js"></script>

                    </div>
                </article>


            </div>
        </div>
        <br><button>Next</button><br><br>
    </form>
</body>

</html>