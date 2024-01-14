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
            echo "<p><span style='font-weight: bold;'>Name :</span><br><br> " . $userData['Name'] . "</p>";
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
    <link rel="stylesheet" href="home_recreational3.css">
    <title>Web Application for Developing English Language Skills.</title>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const quizForm = document.getElementById('quiz-form');
            const nextButton = document.getElementById('button1'); // รับปุ่ม Next

            // กำหนดคำตอบที่ถูกต้อง
            const correctAnswers = ['3', '2', '2', '2'];

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
                window.location.href = "home_recreational4.php";
            });
        });
    </script>
</head>

<body>
    <br><br>
    <h1>Practice</h1>

    <div class="quiz-container">
        <h2>Comprehension Question <br>(4 questions 4 multiple choices)</h2>
        <form id="quiz-form">

            <p>Question 1: What does the tourist need help with?</p>
            <label>
                <input type="radio" name="q1" value="1"> 1) He needs a tour-guide.
            </label>
            <label>
                <input type="radio" name="q1" value="2"> 2) He wants to rent a kayak and a SUP.
            </label>
            <label>
                <input type="radio" name="q1" value="3"> 3) He wants to know about activities he can do in Chumphon.
            </label>
            <label>
                <input type="radio" name="q1" value="4"> 4) He wants to know about the prices of tour packages.
            </label>

            <p>Question 2: What does the tourist want to do?</p>
            <label>
                <input type="radio" name="q2" value="1"> 1) He want to play sport.
            </label>
            <label>
                <input type="radio" name="q2" value="2"> 2) He want to ask for tourist information.
            </label>
            <label>
                <input type="radio" name="q2" value="3"> 3) He want to ask for directions.
            </label>
            <label>
                <input type="radio" name="q2" value="4"> 4) He want to buy a kayak ticket.
            </label>

            <p>Question 3: What kind of outdoor activities does the tour agent offer?</p>
            <label>
                <input type="radio" name="q3" value="1"> 1) Bird watching
            </label>
            <label>
                <input type="radio" name="q3" value="2"> 2) Kayaking and SUB board
            </label>
            <label>
                <input type="radio" name="q3" value="3"> 3) Sightseeing
            </label>
            <label>
                <input type="radio" name="q3" value="4"> 4) Massage.
            </label>

            <p>Question 4: What does the tourist want to do first?</p>
            <label>
                <input type="radio" name="q4" value="1"> 1) to do bird watching.
            </label>
            <label>
                <input type="radio" name="q4" value="2"> 2) to relax and think about the choice he want to do.
            </label>
            <label>
                <input type="radio" name="q4" value="3"> 3) to do sightseeing.
            </label>
            <label>
                <input type="radio" name="q4" value="4"> 4) to do a massage.
            </label>

            <br>
            <button type="submit">Submit</button>

            <button id="button1">Next</button>

        </form>
        <div id="result"></div>
    </div>

    <br>

</body>

</html>
