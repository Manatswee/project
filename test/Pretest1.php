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
    <link rel="stylesheet" href="Posttest1.css">
    <title>Web Application for Developing English Language Skills.</title>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const quizForm = document.getElementById('quiz-form2');
            const finishButton = document.getElementById('button1');
            const correctAnswers = ['4', '1', '2', '2', '2', '4', '2', '3', '3', '1', '2', '4', '4', '3', '4', '2', '2', '2', '2', '2'];

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
                const apiUrl_saveData = 'http://localhost/Projesct12/api/pretest.php';

                // ข้อมูลที่ต้องการบันทึก
                const postData = {
                user_name : userData,  
                email : userEmail,
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
            <p>Question 1: I need to buy a _________ to get to the city center.</p>
            <label>
                <input type="radio" name="q1" value="1"> 1) souvenir
            </label>
            <label>
                <input type="radio" name="q1" value="2"> 2) bus
            </label>
            <label>
                <input type="radio" name="q1" value="3"> 3) trip
            </label>
            <label>
                <input type="radio" name="q1" value="4"> 4) ticket
            </label>

            <p>Question 2: When I visit another place, I like to buy a(n) _________ from that area as my memorable gifts.</p>
            <label>
                <input type="radio" name="q2" value="1"> 1) souvenir
            </label>
            <label>
                <input type="radio" name="q2" value="2"> 2) shop
            </label>
            <label>
                <input type="radio" name="q2" value="3"> 3) coffee
            </label>
            <label>
                <input type="radio" name="q2" value="4"> 4) food
            </label>

            <p>Question 3: A person who travels or visits a place for pleasure is called a(n) ________.</p>
            <label>
                <input type="radio" name="q3" value="1"> 1) tourism
            </label>
            <label>
                <input type="radio" name="q3" value="2"> 2) tourist
            </label>
            <label>
                <input type="radio" name="q3" value="3"> 3) tour agent
            </label>
            <label>
                <input type="radio" name="q3" value="4"> 4) Tour operator
            </label>

            <p>Question 4: When you arrive at the airport, you need to collect your belongings at ___________.</p>
            <label>
                <input type="radio" name="q4" value="1"> 1) customer service center
            </label>
            <label>
                <input type="radio" name="q4" value="2"> 2) baggage claim area
            </label>
            <label>
                <input type="radio" name="q4" value="3"> 3) tour agent
            </label>
            <label>
                <input type="radio" name="q4" value="4"> 4) lost and found counter
            </label>

            <p>Question 5: The restaurant will be very busy on the weekend, so we need to have a(n) ________ in advance.</p>
            <label>
                <input type="radio" name="q5" value="1"> 1) ticket
            </label>
            <label>
                <input type="radio" name="q5" value="2"> 2) reservation
            </label>
            <label>
                <input type="radio" name="q5" value="3"> 3) observation
            </label>
            <label>
                <input type="radio" name="q5" value="4"> 4) recommendations
            </label>

            <p>Question 6: _______________ does it take to get to the city?</p>
            <label>
                <input type="radio" name="q6" value="1"> 1) When 
            </label>
            <label>
                <input type="radio" name="q6" value="2"> 2) Where
            </label>
            <label>
                <input type="radio" name="q6" value="3"> 3) How
            </label>
            <label>
                <input type="radio" name="q6" value="4"> 4) How long
            </label>

            <p>Question 7: ________ can I get the ticket for the minivan?</p>
            <label>
                <input type="radio" name="q7" value="1"> 1) When
            </label>
            <label>
                <input type="radio" name="q7" value="2"> 2) Where
            </label>
            <label>
                <input type="radio" name="q7" value="3"> 3) How much
            </label>
            <label>
                <input type="radio" name="q7" value="4"> 4) What
            </label>

            <p>Question 8: ____________ does a ticket cost?</p>
            <label>
                <input type="radio" name="q8" value="1"> 1) What
            </label>
            <label>
                <input type="radio" name="q8" value="2"> 2) Where
            </label>
            <label>
                <input type="radio" name="q8" value="3"> 3) How much
            </label>
            <label>
                <input type="radio" name="q8" value="4"> 4) How many
            </label>

            <p>Question 9: __________ hotel do you recommend, Hotel A or Hotel B?</p>
            <label>
                <input type="radio" name="q9" value="1"> 1) When
            </label>
            <label>
                <input type="radio" name="q9" value="2"> 2) Where
            </label>
            <label>
                <input type="radio" name="q9" value="3"> 3) Which
            </label>
            <label>
                <input type="radio" name="q9" value="4"> 4) What
            </label>

            <p>Question 10. ________ does the bus leave from the airport?</p>
            <label>
                <input type="radio" name="q10" value="1"> 1) When
            </label>
            <label>
                <input type="radio" name="q10" value="2"> 2) Where
            </label>
            <label>
                <input type="radio" name="q10" value="3"> 3) How much
            </label>
            <label>
                <input type="radio" name="q10" value="4"> 4) What
            </label>

            <p>Question 11: 
            <br><br>Tourist: Could you please tell me how to get to the market? 
                   <br>Response: ____________________________________ 
            </p>
            <label>
                <input type="radio" name="q11" value="1"> 1) The market is not far from here.
            </label>
            <label>
                <input type="radio" name="q11" value="2"> 2) You can walk for 10 minutes from here.
            </label>
            <label>
                <input type="radio" name="q11" value="3"> 3) I don’t know where the market is.
            </label>
            <label>
                <input type="radio" name="q11" value="4"> 4) I am not sure.
            </label>

            <p>Question 12: 
            <br><br>Tourist: Where can I stay around this area? 
                   <br>Response: ____________________________________ 
            </p>
            <label>
                <input type="radio" name="q12" value="1"> 1) The hotel is very close to here, you can walk.
            </label>
            <label>
                <input type="radio" name="q12" value="2"> 2) Please take the map to look for the hotel around here.
            </label>
            <label>
                <input type="radio" name="q12" value="3"> 3) The hotel number is 662-558-2215, you can call from here.
            </label>
            <label>
                <input type="radio" name="q12" value="4"> 4) Here are the lists of the hotel starting from standard to luxurious.
            </label>

            <p>Question 13: 
            <br><br>Tourist: Hello, I would like to know more about what I can do in this area. 
                   <br>Response: ____________________________________ 
            </p>
            <label>
                <input type="radio" name="q13" value="1"> 1) I will give you more information.
            </label>
            <label>
                <input type="radio" name="q13" value="2"> 2) Sure, we have more information about it.
            </label>
            <label>
                <input type="radio" name="q13" value="3"> 3) This area offers lots of food that you can enjoy it.
            </label>
            <label>
                <input type="radio" name="q13" value="4"> 4) You can explore the night market or have a body massage.
            </label>

            <p>Question 14: 
            <br><br>Tourist: Are there any good places to eat around this area?  
                   <br>Response: ____________________________________ 
            </p>
            <label>
                <input type="radio" name="q14" value="1"> 1) I would like you to eat around here.
            </label>
            <label>
                <input type="radio" name="q14" value="2"> 2) There are good restaurants.
            </label>
            <label>
                <input type="radio" name="q14" value="3"> 3) There are restaurants next to this building that offer a variety of meals.
            </label>
            <label>
                <input type="radio" name="q14" value="4"> 4) The restaurant is not far from here and the food is good. 
            </label>

            <p>Question 15: 
            <br><br>Customer Service: How long would you like to stay here?  
                   <br>Response: ____________________________________ 
            </p>
            <label>
                <input type="radio" name="q15" value="1"> 1) I am not sure.
            </label>
            <label>
                <input type="radio" name="q15" value="2"> 2) I am not sure, probably not long.
            </label>
            <label>
                <input type="radio" name="q15" value="3"> 3) I would be here for fun.
            </label>
            <label>
                <input type="radio" name="q15" value="4"> 4) I will be here for 2 weeks.
            </label>

            <p>Question 16: 
            <br><br>Tourist: Excuse me, do you have a table for two?
                   <br>Response: ____________________________________ 
            </p>
            <label>
                <input type="radio" name="q16" value="1"> 1) I am sorry.
            </label>
            <label>
                <input type="radio" name="q16" value="2"> 2) Sure, this way please.
            </label>
            <label>
                <input type="radio" name="q16" value="3"> 3) We only have a table for more people.
            </label>
            <label>
                <input type="radio" name="q16" value="4"> 4) Are you sure that you come only two?
            </label>

            <p>Question 17: 
            <br><br>Tourist: Can I have more information about this place?
                   <br>Response: ____________________________________ 
            </p>
            <label>
                <input type="radio" name="q17" value="1"> 1) Here is the brochure that you can view all information.
            </label>
            <label>
                <input type="radio" name="q17" value="2"> 2) Here is my name card that you can call if you have any questions.
            </label>
            <label>
                <input type="radio" name="q17" value="3"> 3) You can look at our website.
            </label>
            <label>
                <input type="radio" name="q17" value="4"> 4) I don’t have any information right now.
            </label>

            <p>Question 18: 
            <br><br>Tourist: Are there any cultural attractions?
                   <br>Response: ____________________________________ 
            </p>
            <label>
                <input type="radio" name="q18" value="1"> 1) You can visit a night restaurant that open until 2 am.
            </label>
            <label>
                <input type="radio" name="q18" value="2"> 2) There is a city museum that you can visit.
            </label>
            <label>
                <input type="radio" name="q18" value="3"> 3) I don’t have any information.
            </label>
            <label>
                <input type="radio" name="q18" value="4"> 4) There isn’t any cultural site.
            </label>

            <p>Question 19: 
            <br><br>Tourist: I would like to buy a t-shirt for my friends.
                   <br>Response: ____________________________________ 
            </p>
            <label>
                <input type="radio" name="q19" value="1"> 1) What kind of thing would you like? 
            </label>
            <label>
                <input type="radio" name="q19" value="2"> 2) What sizes do you want?
            </label>
            <label>
                <input type="radio" name="q19" value="3"> 3) Would you be interested in walking around?
            </label>
            <label>
                <input type="radio" name="q19" value="4"> 4) Please wait and I will look.
            </label>

            <p>Question 20: 
            <br><br>Tourist: Thank you very much for your information.
                   <br>Response: ____________________________________ 
            </p>
            <label>
                <input type="radio" name="q20" value="1"> 1) Thank you.
            </label>
            <label>
                <input type="radio" name="q20" value="2"> 2) With pleasure.
            </label>
            <label>
                <input type="radio" name="q20" value="3"> 3) Please come back here again.
            </label>
            <label>
                <input type="radio" name="q20" value="4"> 4) I can give you information if you want. 
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
