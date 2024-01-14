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
            // ส่งข้อมูลไปยัง JavaScript โดยใช้ echo
            echo '<script>';
            echo 'const userData = ' . json_encode($userData['Name']) . ';';
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
    <link rel="stylesheet" href="Posttest1.css">
    <title>Web Application for Developing English Language Skills.</title>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const quizForm = document.getElementById('quiz-form2');
            const finishButton = document.getElementById('button1');
            const correctAnswers = ['2', '3', '1', '1', '3', '1', '2', '3', '3', '2', '3', '1', '1', '1', '2', '1', '3', '1', '2', '1'];

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
                const apiUrl_score_prepost = 'http://localhost/Projesct8/api/preposttestapi.php';
                console.log(userData);

                const apiUrl_saveData = 'http://localhost/Projesct8/api/pretest.php';

                // ข้อมูลที่ต้องการบันทึก
                const postData = {
                user_name : userData,  
                score_pretest : score,
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



                



                // // ใช้ fetch() เพื่อดึงข้อมูล
                // fetch(apiUrl_score_prepost)
                // .then(response => response.json())
                // .then(data => {
                //     // ดึงข้อมูลสำเร็จ, ใช้ข้อมูลตามต้อง
                //     console.log(data);

                //     data.forEach(item =>{
                //         console.log(item.Name)
                //     })
                // })


                // แสดงปุ่ม "Finish"
                finishButton.style.display = 'block';

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
                    quizForm.q4.value,
                    quizForm.q5.value,
                    quizForm.q6.value,
                    quizForm.q7.value,
                    quizForm.q8.value,
                    quizForm.q9.value,
                    quizForm.q10.value,
                    quizForm.q11.value,
                    quizForm.q12.value,
                    quizForm.q13.value,
                    quizForm.q14.value,
                    quizForm.q15.value,
                    quizForm.q16.value,
                    quizForm.q17.value,
                    quizForm.q18.value,
                    quizForm.q19.value,
                    quizForm.q20.value
                ];
            }

            // ฟังก์ชันเพื่อตรวจสอบว่ามีการกด submit และแสดงผลคะแนนแล้วหรือไม่
            finishButton.addEventListener('click', function() {
                if (!isSubmitted) {
                    alert("กรุณากด submit ก่อนที่จะกด Finish");
                    return;
                }

                // ทำการ redirect หรือทำการปิดแบบทดสอบ (ตามที่คุณต้องการ)
                // ตัวอย่างเช่น redirect ไปที่หน้าถัดไป
                window.location.href = "../home/home.php";
            });
        });
    </script>
</head>

<body>
    <br><br>
    <h1>Test</h1>
    <div class="quiz-container">
        <h2>Pre-Test</h2>
        <form id="quiz-form2">
            <!-- ปรับปรุงคำถามและตัวเลือกของคุณตามต้องการ -->
            <!-- ... (คำถามและตัวเลือก) ... -->
            <p>Question 1: How long will it take us to travel to the center of Chumphon?</p>
            <label>
                <input type="radio" name="q1" value="1"> 1) 1 hour
            </label>
            <label>
                <input type="radio" name="q1" value="2"> 2) 1.5 hours
            </label>
            <label>
                <input type="radio" name="q1" value="3"> 3) 40 minutes
            </label>
            <label>
                <input type="radio" name="q1" value="4"> 4) 2 hours
            </label>

            <p>Question 2: What is the price of a minivan ticket?</p>
            <label>
                <input type="radio" name="q2" value="1"> 1) 50 baht
            </label>
            <label>
                <input type="radio" name="q2" value="2"> 2) 100 baht
            </label>
            <label>
                <input type="radio" name="q2" value="3"> 3) 150 baht
            </label>
            <label>
                <input type="radio" name="q2" value="4"> 4) 200 baht
            </label>

            <p>Question 3: Where is the minivan ticket booth located?</p>
            <label>
                <input type="radio" name="q3" value="1"> 1) In front of the door leading out of the baggage storage area.
            </label>
            <label>
                <input type="radio" name="q3" value="2"> 2) In front of the door leaving the receiving area.
            </label>
            <label>
                <input type="radio" name="q3" value="3"> 3) in airport chat rooms
            </label>
            <label>
                <input type="radio" name="q3" value="4"> 4) outside the airport
            </label>

            <p>Question 4: Where are the minivan stations available?</p>
            <label>
                <input type="radio" name="q4" value="1"> 1) In front of the door leading out of the baggage storage area.
            </label>
            <label>
                <input type="radio" name="q4" value="2"> 2) In front of the door leaving the receiving area.
            </label>
            <label>
                <input type="radio" name="q4" value="3"> 3) n front of the door exiting the station building
            </label>
            <label>
                <input type="radio" name="q4" value="4"> 4) Parking
            </label>

            <p>Question 5: Tourists are interested in finding luxury accommodation. <br>Where are you thinking of going?</p>
            <label>
                <input type="radio" name="q5" value="1"> 1) 3 star hotel
            </label>
            <label>
                <input type="radio" name="q5" value="2"> 2) Top resorts with private pools
            </label>
            <label>
                <input type="radio" name="q5" value="3"> 3) Villa on a hill with sea view
            </label>
            <label>
                <input type="radio" name="q5" value="4"> 4) Private residences away from tourist attractions
            </label>

            <p>Question 6: When traveling in Chumphon, what activities are tourists interested in?</p>
            <label>
                <input type="radio" name="q6" value="1"> 1) doing outdoor activities
            </label>
            <label>
                <input type="radio" name="q6" value="2"> 2) Viewing at tourist attractions
            </label>
            <label>
                <input type="radio" name="q6" value="3"> 3) Chill and rest
            </label>
            <label>
                <input type="radio" name="q6" value="4"> 4) cultural tourism
            </label>

            <p>Question 7: Tourists are interested in waterfall activities. What do you think the costs are?</p>
            <label>
                <input type="radio" name="q7" value="1"> 1) 500 baht
            </label>
            <label>
                <input type="radio" name="q7" value="2"> 2) 1,000 baht
            </label>
            <label>
                <input type="radio" name="q7" value="3"> 3) 1,500 baht
            </label>
            <label>
                <input type="radio" name="q7" value="4"> 4) 2,000 baht
            </label>

            <p>Question 8: Tourists are interested in canoeing activities. Where are you going?</p>
            <label>
                <input type="radio" name="q8" value="1"> 1) swimming pool
            </label>
            <label>
                <input type="radio" name="q8" value="2"> 2) white sand beach
            </label>
            <label>
                <input type="radio" name="q8" value="3"> 3) Chumphon Village
            </label>
            <label>
                <input type="radio" name="q8" value="4"> 4) Chumphon tourist attractions
            </label>

            <p>Question 9: What activities is this tourist interested in?</p>
            <label>
                <input type="radio" name="q9" value="1"> 1) nature tourism
            </label>
            <label>
                <input type="radio" name="q9" value="2"> 2) cultural tourism
            </label>
            <label>
                <input type="radio" name="q9" value="3"> 3) travel both nature and culture
            </label>
            <label>
                <input type="radio" name="q9" value="4"> 4) religious tourism
            </label>

            <p>Question 10: Where is the tourist attraction "Thung Wua Laen beach"?</p>
            <label>
                <input type="radio" name="q10" value="1"> 1) in Chumphon city
            </label>
            <label>
                <input type="radio" name="q10" value="2"> 2) west of the city
            </label>
            <label>
                <input type="radio" name="q10" value="3"> 3) east of the city
            </label>
            <label>
                <input type="radio" name="q10" value="4"> 4) south of the city
            </label>

            <p>Question 11: The tourist attraction "Khao Dinsor viewpoint" is suitable for what activities?</p>
            <label>
                <input type="radio" name="q11" value="1"> 1) Touching the bird glass
            </label>
            <label>
                <input type="radio" name="q11" value="2"> 2) fishing
            </label>
            <label>
                <input type="radio" name="q11" value="3"> 3) doing forest trekking tours
            </label>
            <label>
                <input type="radio" name="q11" value="4"> 4) Hiking on concrete trails
            </label>

            <p>Question 12: If tourists want to visit "Chumphon National Museum", what should they do?</p>
            <label>
                <input type="radio" name="q12" value="1"> 1) Take a songthaew (tuk-tuk) from the city.
            </label>
            <label>
                <input type="radio" name="q12" value="2"> 2) walk there
            </label>
            <label>
                <input type="radio" name="q12" value="3"> 3) rent a bicycle
            </label>
            <label>
                <input type="radio" name="q12" value="4"> 4) use a rental car
            </label>

            <p>Question 13: What types of souvenirs are customers interested in purchasing?</p>
            <label>
                <input type="radio" name="q13" value="1"> 1) Local handicraft products
            </label>
            <label>
                <input type="radio" name="q13" value="2"> 2) sand molding
            </label>
            <label>
                <input type="radio" name="q13" value="3"> 3) T-shirt
            </label>
            <label>
                <input type="radio" name="q13" value="4"> 4) local snacks
            </label>

            <p>Question 14: What types of products are customers interested in purchasing from the store?</p>
            <label>
                <input type="radio" name="q14" value="1"> 1) Batik T-shirt
            </label>
            <label>
                <input type="radio" name="q14" value="2"> 2) local snacks
            </label>
            <label>
                <input type="radio" name="q14" value="3"> 3) Oyster shell jewelry
            </label>
            <label>
                <input type="radio" name="q14" value="4"> 4) Items made of wood
            </label>

            <p>Question 15: What size t-shirt do customers buy?</p>
            <label>
                <input type="radio" name="q15" value="1"> 1) S, M, L
            </label>
            <label>
                <input type="radio" name="q15" value="2"> 2) L, XL, XXL
            </label>
            <label>
                <input type="radio" name="q15" value="3"> 3) M, XL, XXL
            </label>
            <label>
                <input type="radio" name="q15" value="4"> 4) S, L, XL
            </label>

            <p>Question 16: How do customers buy more products?</p>
            <label>
                <input type="radio" name="q16" value="1"> 1) local snacks
            </label>
            <label>
                <input type="radio" name="q16" value="2"> 2) Jewelry made from oyster shells
            </label>
            <label>
                <input type="radio" name="q16" value="3"> 3) Batik T-shirt
            </label>
            <label>
                <input type="radio" name="q16" value="4"> 4) Items made of wood
            </label>

            <p>Question 17: What do customers order for drinks? </p>
            <label>
                <input type="radio" name="q17" value="1"> 1) ice
            </label>
            <label>
                <input type="radio" name="q17" value="2"> 2) ASoft drinks and ice
            </label>
            <label>
                <input type="radio" name="q17" value="3"> 3) Ice and Iced Thai Tea
            </label>
            <label>
                <input type="radio" name="q17" value="4"> 4) ice and coffee
            </label>

            <p>Question 18: What type of food does the customer order?</p>
            <label>
                <input type="radio" name="q18" value="1"> 1) Pad Thai with shrimp
            </label>
            <label>
                <input type="radio" name="q18" value="2"> 2) Pork Pad Thai
            </label>
            <label>
                <input type="radio" name="q18" value="3"> 3) Stir-fried chicken with basil
            </label>
            <label>
                <input type="radio" name="q18" value="4"> 4) Stir-fried shrimp with basil
            </label>

            <p>Question 19: How do customers pay?</p>
            <label>
                <input type="radio" name="q19" value="1"> 1) credit card
            </label>
            <label>
                <input type="radio" name="q19" value="2"> 2) cash
            </label>
            <label>
                <input type="radio" name="q19" value="3"> 3) mobile phone
            </label>
            <label>
                <input type="radio" name="q19" value="4"> 4) Membership card
            </label>

            <p>Question 20: How do employees eat customers after they finish eating?</p>
            <label>
                <input type="radio" name="q20" value="1"> 1) Bring the bill.
            </label>
            <label>
                <input type="radio" name="q20" value="2"> 2) said the food was delicious
            </label>
            <label>
                <input type="radio" name="q20" value="3"> 3) Bring it to the customer when they finish eating.
            </label>
            <label>
                <input type="radio" name="q20" value="4"> 4) Ask the customer to try more spices.
            </label>

            <br>
            <button type="submit">Submit</button>
            <button id="button1" style="display: none;">Finish</button>
        </form>
        <div id="result"></div>
    </div>
    <br>
</body>

</html>
