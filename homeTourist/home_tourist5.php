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
        <title>Web Application for Developing English Language Skills.</title>
        <link rel="stylesheet" href="home_tourist5.css">
    </head>

    <body>
        <h1><br>Production</h1>
        <!-- <form action="../home/home.php"> -->
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
                                            <audio id="audioA" src="../sound/ProductionU3Q1.mp3"></audio>
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
                                            <audio id="audioB" src="../sound/ProductionU3Q2.mp3"></audio>
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
                                            <audio id="audioC" src="../sound/ProductionU4Q3.mp3"></audio>
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
                                            <audio id="audioD" src="../sound/ProductionU3Q4.mp3"></audio>
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

                            <!-- <script src="home_tourist5.js"></script> -->
                        </div>
                    </article>


                </div>
            </div>
            <div class="button-container">
                <button form action="home_tourist4.php" id="button1">Back</button>
                <button form action="../home/home.php" id="button">Finish</button>
            </div>

            <script>
                // เรียกใช้งานอิเลเมนต์แบบ Audio
                const audioA = document.getElementById('audioA');
                const buttonA = document.getElementById('positionA');
                const audioB = document.getElementById('audioB');
                const buttonB = document.getElementById('positionB');
                const audioAC = document.getElementById('audioC');
                const buttonC = document.getElementById('positionC');
                const audioD = document.getElementById('audioD');
                const buttonD = document.getElementById('positionD');

                let isPlaying = false;

                // กำหนดการฟังก์ชันเมื่อคลิกที่ตำแหน่ง A
                buttonA.addEventListener('click', () => {
                    if (!isPlaying) {
                        // เล่นเสียง
                        audioA.play();
                        isPlaying = true;
                        buttonA.textContent = 'Pause'; // ปรับเปลี่ยนข้อความเป็น Pause
                    } else {
                        // หยุดเสียงถ้ากำลังเล่นอยู่
                        audioA.pause();
                        audioA.currentTime = 0;
                        isPlaying = false;
                        buttonA.textContent = 'Play'; // ปรับเปลี่ยนข้อความเป็น Play
                    }
                });

                // กำหนดการฟังก์ชันเมื่อคลิกที่ตำแหน่ง B
                buttonB.addEventListener('click', () => {
                    if (!isPlaying) {
                        // เล่นเสียง
                        audioB.play();
                        isPlaying = true;
                        buttonB.textContent = 'Pause'; // ปรับเปลี่ยนข้อความเป็น Pause
                    } else {
                        // หยุดเสียงถ้ากำลังเล่นอยู่
                        audioB.pause();
                        audioB.currentTime = 0;
                        isPlaying = false;
                        buttonB.textContent = 'Play'; // ปรับเปลี่ยนข้อความเป็น Play
                    }
                });

                // กำหนดการฟังก์ชันเมื่อคลิกที่ตำแหน่ง C
                buttonC.addEventListener('click', () => {
                    if (!isPlaying) {
                        // เล่นเสียง
                        audioC.play();
                        isPlaying = true;
                        buttonC.textContent = 'Pause'; // ปรับเปลี่ยนข้อความเป็น Pause
                    } else {
                        // หยุดเสียงถ้ากำลังเล่นอยู่
                        audioC.pause();
                        audioC.currentTime = 0;
                        isPlaying = false;
                        buttonC.textContent = 'Play'; // ปรับเปลี่ยนข้อความเป็น Play
                    }
                });

                // กำหนดการฟังก์ชันเมื่อคลิกที่ตำแหน่ง D
                buttonD.addEventListener('click', () => {
                    if (!isPlaying) {
                        // เล่นเสียง
                        audioD.play();
                        isPlaying = true;
                        buttonD.textContent = 'Pause'; // ปรับเปลี่ยนข้อความเป็น Pause
                    } else {
                        // หยุดเสียงถ้ากำลังเล่นอยู่
                        audioD.pause();
                        audioD.currentTime = 0;
                        isPlaying = false;
                        buttonD.textContent = 'Play'; // ปรับเปลี่ยนข้อความเป็น Play
                    }
                });






                // เชื่อมต่อกับบริการ Speech-to-Text API
                const SpeechRecognition = window.SpeechRecognition || window.webkitSpeechRecognition;
                const recognition1 = new SpeechRecognition();
                const recognition2 = new SpeechRecognition();
                const recognition3 = new SpeechRecognition();
                const recognition4 = new SpeechRecognition();
                const output1 = document.getElementById('output1');
                const output2 = document.getElementById('output2');
                const output3 = document.getElementById('output3');
                const output4 = document.getElementById('output4');
                const recordButton1 = document.getElementById('recordButton1');
                const recordButton2 = document.getElementById('recordButton2');
                const recordButton3 = document.getElementById('recordButton3');
                const recordButton4 = document.getElementById('recordButton4');

                recognition1.lang = 'en-US';
                recognition2.lang = 'en-US';
                recognition3.lang = 'en-US';
                recognition4.lang = 'en-US';

                recognition1.interimResults = true;
                recognition2.interimResults = true;
                recognition3.interimResults = true;
                recognition4.interimResults = true;

                // ...

                function setupRecognition(recognition, output, recordButton) {
                    let isRecording = false;
                    let countdown = 10; // เริ่มนับถอยหลังที่ 20

                    function updateCountdown() {
                        recordButton.innerText = `กำลังบันทึก (${countdown})`;
                    }

                    function startCountdown() {
                        countdown = 10;
                        updateCountdown();
                        const countdownInterval = setInterval(() => {
                            countdown--;
                            updateCountdown();
                            if (countdown === 0) {
                                clearInterval(countdownInterval);
                                recognition.stop();
                                // นี่คือตำแหน่งที่คุณสามารถเรียกฟังก์ชันแปลงเสียงเป็นข้อความได้
                                // ตัวอย่างเช่น convertSpeechToText(output);
                                recordButton.disabled = false;
                                recordButton.innerText = 'บันทึกเสียง';
                            }
                        }, 1000); // นับถอยหลังทุก 1 วินาที
                    }

                    recognition.onstart = function() {
                        isRecording = true;
                        recordButton.disabled = true;
                        startCountdown();
                    };

                    recognition.onresult = function(event) {
                        const result = event.results[event.results.length - 1];
                        const transcript = result[0].transcript;
                        output.innerHTML = transcript;
                    };

                    recognition.onend = function() {
                        isRecording = false;
                    };

                    recordButton.addEventListener('click', () => {
                        if (!isRecording) {
                            recognition.start();
                        }
                    });
                }

                // ...


                setupRecognition(recognition1, output1, recordButton1);
                setupRecognition(recognition2, output2, recordButton2);
                setupRecognition(recognition3, output3, recordButton3);
                setupRecognition(recognition4, output4, recordButton4);




                /// แปรและส่วนแสดงคะแนน
                let score = 0;
                const scoreDisplay = document.getElementById('scoreDisplay');
                const maxScore = 4; // คะแนนเต็ม


                // รหัสอื่น ๆ ที่มีอยู่

                // เพิ่มฟังก์ชันเพื่อเช็คคีย์เวิร์ด
                function checkKeywords(transcript) {
                    const keywords = ["tourist information counter", "Tourist information counter", "at the tourist information counter", "At the tourist information counter", "at the tourist information", "At the tourist information", "at the Tourist Information", "Tourist information", "tourist information", "hiking", "Hiking", "bird watching", "Bird watching", "enjoying panoramic view", "Enjoying view", "enjoying view", "Enjoying panoramic view", "Yes", "yes", "Maybe", "maybe", "tuk-tuk", "Tuk-Tuk", "motorcycle", "Motorcycle"];

                    let foundKeywords = 0; // ตัวแปรเพื่อเก็บจำนวนคีย์เวิร์ดที่พบ

                    for (const keyword of keywords) {
                        if (transcript.includes(keyword)) {
                            foundKeywords++;
                        }
                    }

                    return foundKeywords; // คืนค่าจำนวนคำหรือประโยคที่ถูกตอบถูก
                }


                // ...

                // เพิ่มการเช็คคีย์เวิร์ดเมื่อกดปุ่ม "Submit" และแสดงคะแนน
                submitButton.addEventListener('click', () => {
                    const foundKeywords1 = checkKeywords(output1.innerHTML); // ตรวจสอบคีย์เวิร์ดจากผลลัพธ์ของ recognition1 (output1)
                    const foundKeywords2 = checkKeywords(output2.innerHTML); // ตรวจสอบคีย์เวิร์ดจากผลลัพธ์ของ recognition2 (output2)
                    const foundKeywords3 = checkKeywords(output3.innerHTML); // ตรวจสอบคีย์เวิร์ดจากผลลัพธ์ของ recognition3 (output3)
                    const foundKeywords4 = checkKeywords(output4.innerHTML); // ตรวจสอบคีย์เวิร์ดจากผลลัพธ์ของ recognition4 (output4)

                    const totalScore = foundKeywords1 + foundKeywords2 + foundKeywords3 + foundKeywords4;

                    if (totalScore > 0) {
                        // แสดงคะแนนเมื่อพบคำหรือประโยคที่ต้องการตรวจสอบและตอบถูก
                        scoreDisplay.innerText = `คะแนน: ${totalScore} คะแนน`;
                        alert(`คะแนนที่คุณได้คือ: ${totalScore} คะแนน`);
                    } else {
                        // แสดงข้อความเมื่อไม่พบคำหรือประโยคที่ต้องการตรวจสอบหรือตอบถูก
                        scoreDisplay.innerText = 'คะแนน: 0 คะแนน';
                        alert('คุณไม่ได้รับคะแนน');
                    }
                    // URL ของ API
                    const apiUrl_saveData = 'http://localhost/Projesct12/api/api-productiontourist.php';

                    // ข้อมูลที่ต้องการบันทึก
                    const postData = {
                        username: userData,
                        word_1: output1.innerHTML,
                        word_2: output2.innerHTML,
                        word_3: output3.innerHTML,
                        word_4: output4.innerHTML,
                        score: totalScore,
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

                });
                // รับอ้างอิงไปยังปุ่ม
                const backButton = document.getElementById('button1');
                const finishButton = document.getElementById('button');

                // เพิ่มการฟังก์ชันเพื่อจัดการคลิกปุ่ม
                backButton.addEventListener('click', function() {
                    window.location.href = 'home_tourist4.php';
                });

                finishButton.addEventListener('click', function() {
                    window.location.href = '../home/home.php';
                });
            </script>
            <!-- </form> -->
    </body>

    </html>