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
        <title>Web Application for Developing English Language Skills.</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="table.css">
    </head>

    <body>
        <div class="background">
            <h1><br>Score</h1>
            <div class="table-widget">

                <table>
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Surname</th>
                            <th>Degree/Occupation</th>
                            <th>Email address</th>
                            <th>Pre-Test</th>
                            <th>Post-Test</th>
                            <th>Performance</th>
                            <th>Practice</th>
                            <th>Speaking Test</th>

                        </tr>

                    </thead>
                    <tbody id="tableData">
                        <!-- ข้อมูลจะถูกเติมที่นี่โดย JavaScript -->
                    </tbody>

                    <script>
                        const apiUrl_userdata = 'http://localhost/Projesct15/api/api-adminscore';
                        fetch(apiUrl_userdata)
                            .then(response => {
                                if (response.status === 200) {
                                    console.log('get data apiUrl_userdata successfully');
                                    return response.json();
                                } else {
                                    throw new Error('get data apiUrl_userdata successfully failed');
                                }
                            })
                            .then(data => {
                                displayDataInTable(data);
                            })
                            .catch(error => {
                                console.error('Error:', error);
                            });

                        // เพิ่มตัวแปรเพื่อติดตามสถานะการคลิก
                        let click_pratice = 0;
                        let click_speaking = 0;

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
                                <td ${rowData.score_difference != null ? `style="color: ${rowData.score_pretest > rowData.score_posttest ? 'red' : (rowData.score_pretest < rowData.score_posttest ? 'green' : 'blue')}"` : ''}>
                                    ${rowData.score_pretest > rowData.score_posttest ? '-' : ''}${rowData.score_difference}
                                </td>
                                <td><a id="practice_link">show more</a></td>
                                <td><a id="speaking_link">show more</a></td>
                            `;


                            tableBody.appendChild(row);

                            const practiceLink = row.querySelector('#practice_link');
                            practiceLink.addEventListener('click', function() {

                                if (click_pratice === 0) {
                                    var name = rowData.Name;
                                    practiceLink.href = 'table1.php?name=' + encodeURIComponent(name);
                                }
                            });

                            const speakingLink = row.querySelector('#speaking_link');
                            speakingLink.addEventListener('click', function() {

                                if (click_pratice === 0) {
                                    var name = rowData.Name;
                                    speakingLink.href = 'table2.php?name=' + encodeURIComponent(name);
                                }
                            });
                        });
                    }
                    </script>


                </table>
            </div>
        </div>
        <script src="table.css"></script>
    </body>

    </html>