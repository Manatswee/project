<?php
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $email = $_POST['email'];
    $passwords = $_POST['passwords'];
    $confirm_passwords = $_POST['confirm_passwords'];
    $status = $_POST['status'];
    
    



    //Database commection

    $conn = new mysqli('localhost', 'root', '','web');
    if($conn->connect_error){
        die('Connevtion Failed : '.$conn->connect_error);
        
    }else{
        // ตรวจสอบว่ามีข้อมูลซ้ำในฐานข้อมูลหรือไม่
        $checkDuplicateQuery = $conn->prepare("SELECT * FROM user WHERE Email = ?");
        $checkDuplicateQuery->bind_param("s", $email);
        $checkDuplicateQuery->execute();
        $result = $checkDuplicateQuery->get_result();
    
        if($result->num_rows > 0) {
            // ถ้ามีข้อมูลซ้ำ
            echo "Register Duplicate entry  (ลงทะเบียนรายการซ้ำ)  .......";
            
        } else {
            // ถ้าไม่มีข้อมูลซ้ำในฐานข้อมูล
            $stmt = $conn->prepare("INSERT INTO user (Name, Last_Name, Email, Passwords, Confirm_Passwords, Status) VALUES (?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("ssssss", $firstName, $lastName, $email, $passwords, $confirm_passwords, $status );
            $stmt->execute();
            // echo "Register Successfully...";
            header("Location: login.html");
            $stmt->close();
        }
        
        // ปิดการเชื่อมต่อและสร้าง statement
        $checkDuplicateQuery->close();
        $conn->close();
    }
    
?>