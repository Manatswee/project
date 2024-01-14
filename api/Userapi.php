<?php
// ตัวอย่าง PHP RESTful API
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

// Database connection 
$con = new mysqli("localhost", "root", "", "web");

if ($con->connect_error) {
    die("Failed to connect: " . $con->connect_error);
} else {
    // Prepare SQL statement to retrieve user data based on the logged-in email
    $stmt = $con->prepare("SELECT * FROM user");
    $stmt->execute();
    $user_result = $stmt->get_result();

    // ปิดการเชื่อมต่อกับฐานข้อมูล
    $con->close();

    // สร้าง array เพื่อเก็บข้อมูลที่จะส่งออกเป็น JSON
    $data = array();

    // ถ้ามีข้อมูลผู้ใช้
    if ($user_result->num_rows > 0) {
        while ($row = $user_result->fetch_assoc()) {
            // เพิ่มข้อมูลผู้ใช้ลงใน array
            $data[] = $row;
        }
    }

    // แปลงข้อมูลเป็น JSON และส่งออก
    echo json_encode($data);
}
?>

