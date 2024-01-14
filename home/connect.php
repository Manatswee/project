<?php
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $email = $_POST['email'];
    $passwords = $_POST['passwords'];
    $confirm_passwords = $_POST['confirm_passwords'];
    $status = $_POST['status'];

    // Database connection
    $conn = new mysqli('localhost', 'root', '', 'web');
    if ($conn->connect_error) {
        die('Connection Failed: ' . $conn->connect_error);
    } else {
        // Check if there is duplicate data in the database
        $checkDuplicateQuery = $conn->prepare("SELECT * FROM user WHERE Email = ?");
        $checkDuplicateQuery->bind_param("s", $email);
        $checkDuplicateQuery->execute();
        $result = $checkDuplicateQuery->get_result();

        if ($result->num_rows > 0) {
            // If duplicate data found
            echo '<script>alert("Register Duplicate entry  (ลงทะเบียนรายการซ้ำ)  ......."); window.location.href = "register.html";</script>';
        } else {
            // If no duplicate data in the database
            $stmt = $conn->prepare("INSERT INTO user (Name, Last_Name, Email, Passwords, Confirm_Passwords, Status) VALUES (?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("ssssss", $firstName, $lastName, $email, $passwords, $confirm_passwords, $status);
            $stmt->execute();
            echo '<script>alert("Register Successfully..."); window.location.href = "register.html";</script>';
            $stmt->close();
        }

        // Close the database connection and statement
        $checkDuplicateQuery->close();
        $conn->close();
    }
?>
