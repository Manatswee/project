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
    <link rel="stylesheet" href="home_restaurant3.css">
    <title>Web Application for Developing English Language Skills.</title>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const quizForm = document.getElementById('quiz-form');
            const nextButton = document.getElementById('button2'); // รับปุ่ม Next

            // กำหนดคำตอบที่ถูกต้อง
            const correctAnswers = ['4', '1', '3', '1'];

            // ตรวจสอบว่ามีการกด submit และแสดงผลคะแนนแล้วหรือไม่
            let isSubmitted = false;

            // จัดการการส่งฟอร์มแบบทดสอบ
            quizForm.addEventListener('submit', function(e) {
                e.preventDefault(); // ป้องกันการรีโหลดหน้า

                // ตรวจสอบว่าทุกข้อถูกต้อง
                const allQuestionsAnswered = validateAllQuestions();

                if (!allQuestionsAnswered) {
                    alert("กรุณาตอบทุกข้อก่อนที่จะส่ง");
                    return;
                }

                let score = 0;
                const userAnswers = getUserAnswers();

                // ตรวจสอบคำตอบและคำนวณคะแนน
                userAnswers.forEach((answer, index) => {
                    if (answer === correctAnswers[index]) {
                        score += 1;
                    }
                });

                // แสดงผลลัพธ์
                const resultContainer = document.getElementById('result');
                resultContainer.innerHTML = `<p>คะแนนของคุณ: ${score} / ${correctAnswers.length}</p>`;

                // แสดงปุ่ม "Next"
                nextButton.style.display = 'block';

                // กำหนดให้มีการกด submit แล้ว
                isSubmitted = true;
            });

            // ฟังก์ชันเพื่อตรวจสอบว่าทุกข้อถูกต้อง
            function validateAllQuestions() {
                const userAnswers = getUserAnswers();

                // ตรวจสอบว่ามีข้อคำถามใดๆที่ยังไม่ได้ตอบหรือไม่
                return userAnswers.every(answer => answer !== '');
            }

            // ฟังก์ชันเพื่อรับคำตอบจากผู้ใช้
            function getUserAnswers() {
                return [
                    quizForm.q1.value,
                    quizForm.q2.value,
                    quizForm.q3.value,
                    quizForm.q4.value
                ];
            }

            // ฟังก์ชันเพื่อตรวจสอบว่ามีการกด submit และแสดงผลคะแนนแล้วหรือไม่
            nextButton.addEventListener('click', function() {
                if (!isSubmitted) {
                    alert("กรุณากด submit ก่อนที่จะกด Next");
                    return;
                }

                // ทำการ redirect หรือทำการปิดแบบทดสอบ (ตามที่คุณต้องการ)
                // ตัวอย่างเช่น redirect ไปที่หน้าถัดไป
                window.location.href = "home_restaurant4.php";
            });
        });
    </script>
</head>

<body>
    <br><br>
    <!-- <h1>Practice</h1> -->

    <div class="quiz-container">
        <h2>Comprehension Question <br>(4 questions 4 multiple choices)</h2>

        <div class="audio-container">
            <audio id="myAudio" controls>
                    <source src="../../sound/PresentationU5.mp3" type="audio/mpeg">
                    <!-- Your browser does not support the audio element. -->
            </audio>
        </div>

        <form id="quiz-form">
            <p>Question 1: Where does this conversation take place?</p>
            <label>
                <input type="radio" name="q1" value="1"> 1) At the train station
            </label>
            <label>
                <input type="radio" name="q1" value="2"> 2) At the airport
            </label>
            <label>
                <input type="radio" name="q1" value="3"> 3) At a restaurant
            </label>
            <label>
                <input type="radio" name="q1" value="4"> 4) At a souvenir shop
            </label>

            <p>Question 2: What does the customer get for drinks?</p>
            <label>
                <input type="radio" name="q2" value="1"> 1) a bottle of water, a glass of ice, and  Thai iced tea.
            </label>
            <label>
                <input type="radio" name="q2" value="2"> 2) two bottles of water, a glass of ice, and  Thai iced tea.
            </label>
            <label>
                <input type="radio" name="q2" value="3"> 3) a bottle of water, a glass of ice, and a glass of wine.
            </label>
            <label>
                <input type="radio" name="q2" value="4"> 4) a bottle of wine, and  Thai icad tea.
            </label>

            <p>Question 3: What does the customer get for meals?</p>
            <label>
                <input type="radio" name="q3" value="1"> 1) Pad Thai with shrimp, and chicken soup with rice.
            </label>
            <label>
                <input type="radio" name="q3" value="2"> 2) Pad Thai with chicken, and Chicken soup with rice.
            </label>
            <label>
                <input type="radio" name="q3" value="3"> 3) Pad Thai with shrimp, and green curry with rice and chicken.
            </label>
            <label>
                <input type="radio" name="q3" value="4"> 4) Pad Thai with chicken, and green curry with rice and chicken.
            </label>

            <p>Question 4: How does the customer pay?</p>
            <label>
                <input type="radio" name="q4" value="1"> 1) cash
            </label>
            <label>
                <input type="radio" name="q4" value="2"> 2) credit card
            </label>
            <label>
                <input type="radio" name="q4" value="3"> 3) QR code
            </label>
            <label>
                <input type="radio" name="q4" value="4"> 4) bill
            </label>

            <br>
            <button type="submit">Submit</button>
            <button onclick="refreshPage()" type="button3">do it again</button>
            <div id="result"></div>
    </div>


    <div class="button-container">
        <a href="home_restaurant2.php" id="button1">Back</a>
        <button formaction="home_restaurant4.php" id="button2">Next</button>
    </div>

    </div>

    <br>


</body>

</html>