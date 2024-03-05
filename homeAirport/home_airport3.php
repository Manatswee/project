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
            // Send user data to JavaScript using echo
            echo '<script>';
            echo 'const userData = ' . json_encode($userData['Name']) . ';';
            echo 'const userEmail = ' . json_encode($userData['Email']) . ';';
            echo '</script>';
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
    <link rel="stylesheet" href="home_airport3.css">
    <title>Web Application for Developing English Language Skills.</title>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const quizForm = document.getElementById('quiz-form');
            const nextButton = document.getElementById('button2'); // รับปุ่ม Next

            // กำหนดคำตอบที่ถูกต้อง
            const correctAnswers = ['3', '3', '2', '3'];

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

                // URL ของ API
                const apiUrl_saveData = 'http://localhost/Projesct12/api/unittest1.php';

                // ข้อมูลที่ต้องการบันทึก
                const postData = {
                    user_name: userData,
                    unit_test1: score,
                };

                // ใช้ fetch() เพื่อทำการ POST ข้อมูล
                fetch(apiUrl_saveData, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                        },
                        body: JSON.stringify(postData),
                    })
                    .then(response => {
                        if (response.status === 201) {
                            // กระบวนการบันทึกข้อมูลสำเร็จ
                            console.log('Data saved successfully');
                            return response.json();
                        } else {
                            // กระบวนการบันทึกข้อมูลไม่สำเร็จ
                            throw new Error('Data not saved');
                        }
                    })
                    .then(data => {
                        // แสดงผลลัพธ์คะแนน
                        const resultContainer = document.getElementById('result');
                        resultContainer.innerHTML = `<p>คะแนนของคุณ: ${score} / ${correctAnswers.length}</p>`;

                        // แสดงปุ่ม "Next"
                        nextButton.style.display = 'block';

                        // กำหนดให้มีการกด submit แล้ว
                        isSubmitted = true;
                    })
                    .catch(error => {
                        // หากเกิดข้อผิดพลาดในการบันทึก
                        console.error('Error saving data:', error);
                    });
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
        });
    </script>
</head>

<body>
    <br><br>
    <form id="quiz-form" action="#" method="post">
        <div class="quiz-container">
            <h2>Comprehension Question <br>(4 questions 4 multiple choices)</h2>
            <div class="audio-container">
                <audio id="myAudio" controls>
                    <source src="../sound/PresentationU1.mp3" type="audio/mpeg">
                    <!-- Your browser does not support the audio element. -->
                </audio>
            </div>

            <p>Question 1: Where does the tourist need help with?</p>
            <!-- ตัวเลือกข้อที่ 1 -->
            <label>
                <input type="radio" name="q1" value="1"> 1) He looks for his backages.
            </label>
            <!-- ตัวเลือกข้อที่ 2 -->
            <label>
                <input type="radio" name="q1" value="2"> 2) He looks for a van or bus to the city.
            </label>
            <!-- ตัวเลือกข้อที่ 3 -->
            <label>
                <input type="radio" name="q1" value="3"> 3) He wants to know how to get to the city center.
            </label>
            <!-- ตัวเลือกข้อที่ 4 -->
            <label>
                <input type="radio" name="q1" value="4"> 4) He wants to know what he can do in the city center.
            </label>

            <!-- เพิ่มคำถามและตัวเลือกที่เหลือในส่วนนี้ -->
            <!-- คำถาม 2 -->
            <p>Question 2: What are the recommendations from the customer service for getting to the city?</p>
            <!-- ตัวเลือกข้อที่ 1 -->
            <label>
                <input type="radio" name="q2" value="1"> 1) The tourist can take a public bus.
            </label>
            <!-- ตัวเลือกข้อที่ 2 -->
            <label>
                <input type="radio" name="q2" value="2"> 2) The tourist can take a public minivan.
            </label>
            <!-- ตัวเลือกข้อที่ 3 -->
            <label>
                <input type="radio" name="q2" value="3"> 3) The tourist can take a public bus or public minivan.
            </label>
            <!-- ตัวเลือกข้อที่ 4 -->
            <label>
                <input type="radio" name="q2" value="4"> 4) The tourist can either walk or take a bus.
            </label>

            <!-- เพิ่มคำถามและตัวเลือกที่เหลือในส่วนนี้ -->
            <!-- คำถาม 3 -->
            <p>Question 3: Where is the ticket booth for the minivan to the city center?</p>
            <!-- ตัวเลือกข้อที่ 1 -->
            <label>
                <input type="radio" name="q3" value="1"> 1) Next to the baggage claim area.
            </label>
            <!-- ตัวเลือกข้อที่ 2 -->
            <label>
                <input type="radio" name="q3" value="2"> 2) In front of the exit from the baggage claim area.
            </label>
            <!-- ตัวเลือกข้อที่ 3 -->
            <label>
                <input type="radio" name="q3" value="3"> 3) Next to the information counter.
            </label>
            <!-- ตัวเลือกข้อที่ 4 -->
            <label>
                <input type="radio" name="q3" value="4"> 4) Infront of the information counter.
            </label>

            <!-- เพิ่มคำถามและตัวเลือกที่เหลือในส่วนนี้ -->
            <!-- คำถาม 4 -->
            <p>Question 4: Which choice does the tourist take to get to the city center?</p>
            <!-- ตัวเลือกข้อที่ 1 -->
            <label>
                <input type="radio" name="q4" value="1"> 1) train
            </label>
            <!-- ตัวเลือกข้อที่ 2 -->
            <label>
                <input type="radio" name="q4" value="2"> 2) bus
            </label>
            <!-- ตัวเลือกข้อที่ 3 -->
            <label>
                <input type="radio" name="q4" value="3"> 3) minivan
            </label>
            <!-- ตัวเลือกข้อที่ 4 -->
            <label>
                <input type="radio" name="q4" value="4"> 4) motorcycle taxi
            </label>

            <br>
            <button type="submit">Submit</button>
            <button onclick="refreshPage()" type="button3">do it again</button>
            <div id="result"></div>
        </div>

        <!-- เพิ่มปุ่ม Back และ Next ในส่วนนี้ -->
        <div class="button-container">
            <a href="home_airport2.php" id="button1">Back</a>
            <button id="button2" style="display: none;">Next</button>
        </div>
    </form>

    <br>
</body>

</html>
