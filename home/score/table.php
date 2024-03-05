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
    <title>Web Application for Developing English Language Skills.</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="table.css">
</head>

<body>
    <div class="background">
        <h1><br>Score</h1>
        <div class="table-widget">

            <table>
                <!-- <caption>
                Score
                <span class="table-row-count"></span>
            </caption> -->
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Surname</th>
                        <th>Status</th>
                        <th>Email address</th>
                        <th>Pre-Test</th>
                        <th>Post-Test</th>
                        <th>Score Prtcentage Increase</th>
                        <th>Practice</th>
                        <th>Speaking Test</th>
                    </tr>
                </thead>
                <tbody id="tableData">
                    <!-- ข้อมูลจะถูกเติมที่นี่โดย JavaScript -->
                </tbody>

                <script>
                    const apiUrl_saveData = 'http://localhost/Projesct12/api/api-adminscore.php';
                    // ใช้ fetch() เพื่อทำการ GET ข้อมูล
                    fetch(apiUrl_saveData)
                        .then(response => {
                            if (response.status === 200) {
                                // กระบวนการ GET ข้อมูลสำเร็จ
                                console.log('get data successfully');
                                return response.json(); // อ่านข้อมูล JSON จาก response
                            } else {
                                // กระบวนการ GET ข้อมูลไม่สำเร็จ
                                throw new Error('get data failed');
                            }
                        })
                        .then(data => {
                            // เรียกใช้ฟังก์ชันเพื่อสร้างแถวข้อมูลในตาราง
                            displayDataInTable(data);
                        })
                        .catch(error => {
                            console.error('Error:', error);
                        });

                    const apiUrl_score_practice = 'http://localhost/Projesct12/api/api-scorepractice.php';
                    // ใช้ fetch() เพื่อทำการ GET ข้อมูล
                    fetch(apiUrl_score_practice)
                        .then(response => {
                            if (response.status === 200) {
                                // กระบวนการ GET ข้อมูลสำเร็จ
                                console.log('get data successfully');
                                return response.json(); // อ่านข้อมูล JSON จาก response
                            } else {
                                // กระบวนการ GET ข้อมูลไม่สำเร็จ
                                throw new Error('get data failed');
                            }
                        })
                        .then(data => {
                            score_practice = data;
                        })
                        .catch(error => {
                            console.error('Error:', error);
                        });

                    // เพิ่มตัวแปรเพื่อติดตามสถานะการคลิก
                    let click = 0;

                    function displayDataInTable(data) {
                        const tableBody = document.getElementById('tableData');
                        // เริ่มต้นใส่ข้อมูลลงในตาราง
                        data.forEach(rowData => {
                            const row = document.createElement('tr');
                            row.innerHTML = `
                                <td>${rowData.Name}</td>
                                <td>${rowData.Last_Name}</td>
                                <td>${rowData.Status}</td>
                                <td>${rowData.Email}</td>
                                <td>${rowData.score_pretest}</td>
                                <td>${rowData.score_posttest}</td>
                                <td>${rowData.score_difference}</td>
                                <td><a id="practice_link" href="table1.html">click</a></td>
                                <td><a id="speaking_link" href="table2.html">click</a></td>
                            `;
                            tableBody.appendChild(row);

                            // เพิ่ม Event Listener เมื่อคลิกที่ลิงก์ Practice
                            const practiceLink = row.querySelector('#practice_link');
                            practiceLink.addEventListener('click', function() {
                                if (click === 0) {
                                    practiceLink.href = 'table1.html';
                                    click = 1;
                                } else {
                                    practiceLink.href = 'table1.html';
                                    click = 0;
                                }
                            });

                            // เพิ่ม Event Listener เมื่อคลิกที่ลิงก์ Speaking Test
                            const speakingLink = row.querySelector('#speaking_link');
                            speakingLink.addEventListener('click', function() {
                                if (click === 0) {
                                    speakingLink.href = 'table2.html';
                                    click = 1;
                                } else {
                                    speakingLink.href = 'table2.html';
                                    click = 0;
                                }
                            });
                        });
                    }
                </script>

                <tfoot>
                    <tr>
                        <td colspan="4">
                            <ul class="pagination">
                                <!--? generated pages -->

                            </ul>
                        </td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
    <script src="table.css"></script>
</body>

</html>