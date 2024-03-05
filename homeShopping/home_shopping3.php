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
            // ส่งข้อมูลไปยัง JavaScript โดยใช้ echo
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
        <link rel="stylesheet" href="home_shopping3.css">
        <title>Web Application for Developing English Language Skills.</title>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const quizForm = document.getElementById('quiz-form');
                const nextButton = document.getElementById('button2'); // รับปุ่ม Next

                // กำหนดคำตอบที่ถูกต้อง
                const correctAnswers = ['1', '3', '2', '4'];

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

                    // URL ของ API
                    const apiUrl_saveData = 'http://localhost/Projesct12/api/unittest4.php';

                    // ข้อมูลที่ต้องการบันทึก
                    const postData = {
                        user_name: userData,
                        unit_test4: score,
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
                            // ดึงข้อมูลจากการบันทึกสำเร็จ
                            console.log('Data:', data);
                        })
                        .catch(error => {
                            // หากเกิดข้อผิดพลาดในการบันทึก
                            console.error('Error saving data:', error);
                        });

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
                    window.location.href = "home_shopping4.php";
                });
            });
            //รีเพื่อทำอีกครั้ง
            function refreshPage()
            {
                window.location.reload();
            }
        </script>
    </head>

    <body>
        <br><br>
        <!-- <h1>Practice</h1> -->

        <div class="quiz-container">
            <h2>Comprehension Question <br>(4 questions 4 multiple choices)</h2>
            <div class="audio-container">
                <audio id="myAudio" controls>
                            <source src="../sound/PresentationU4.mp3" type="audio/mpeg">
                            <!-- Your browser does not support the audio element. -->
                    </audio>
            </div>
            <form id="quiz-form">
                <p>Question 1: Where does this conversation take place?</p>
                <label>
                <input type="radio" name="q1" value="1"> 1) At a souvenir shop.
            </label>
                <label>
                <input type="radio" name="q1" value="2"> 2) At the tourist information.
            </label>
                <label>
                <input type="radio" name="q1" value="3"> 3) At a restaurant.
            </label>
                <label>
                <input type="radio" name="q1" value="4"> 4) At a Batik shop.
            </label>

                <p>Question 2: What does the tourist need?</p>
                <label>
                <input type="radio" name="q2" value="1"> 1) recreational activities
            </label>
                <label>
                <input type="radio" name="q2" value="2"> 2) recommended food
            </label>
                <label>
                <input type="radio" name="q2" value="3"> 3) souvenirs to bring home
            </label>
                <label>
                <input type="radio" name="q2" value="4"> 4) a new T-shirt
            </label>

                <p>Question 3: What are the souvenirs the tourist looking for?</p>
                <label>
                <input type="radio" name="q3" value="1"> 1) Batik painting and seashell jewelry
            </label>
                <label>
                <input type="radio" name="q3" value="2"> 2) Batik painting and local snacks
            </label>
                <label>
                <input type="radio" name="q3" value="3"> 3) Local snacks and handicraft
            </label>
                <label>
                <input type="radio" name="q3" value="4"> 4) Local snacks and seashell jewelry
            </label>

                <p>Question 4: How much does the souvenirs cost in total?</p>
                <label>
                <input type="radio" name="q4" value="1"> 1) 600 Baht
            </label>
                <label>
                <input type="radio" name="q4" value="2"> 2) 700 Baht
            </label>
                <label>
                <input type="radio" name="q4" value="3"> 3) 800 Baht
            </label>
                <label>
                <input type="radio" name="q4" value="4"> 4) 900 Baht
            </label>

                <br>
                <button type="submit">Submit</button>
                <button onclick="refreshPage()" type="button3">do it again</button>
                <div id="result"></div>
        </div>

        
        </div>
        <div class="button-container">
            <a href="home_shopping2.php" id="button1">Back</a>
            <button formaction="home_shopping4.php" id="button2">Next</button>
        </div>

        </form>

        </div>

        <br>


    </body>

    </html>