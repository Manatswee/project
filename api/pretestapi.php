<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Origin: GET, POST, PUT, DELETE");
header("Access-Control-Allow-Origin: X-Requestes-With");
header("Content-Type: application/json");

// Database connection 
$con = new mysqli("localhost", "root", "", "web");

if ($con->connect_error) {
    die("Failed to connect: " . $con->connect_error);
} else {
    // Prepare SQL statement to retrieve user data based on the logged-in email
    $stmt = $con->prepare("SELECT * FROM score_pretest");
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




<?php
header("Content-Type: application/json");

// ตรวจสอบ HTTP method
$method = $_SERVER['REQUEST_METHOD'];

// ตรวจสอบ endpoint
$url = $_SERVER['REQUEST_URI'];
$urlSegments = explode('/', $url);

// ตัวอย่างการจัดการ GET request ที่ /api/users
if ($method === 'GET' && $urlSegments[2] === 'users') {
    // ดึงข้อมูลจากฐานข้อมูลหรือแหล่งข้อมูล
    $data = array(
        array('id' => 1, 'name' => 'John'),
        array('id' => 2, 'name' => 'Jane'),
    );

    // แปลงข้อมูลเป็น JSON และส่งออก
    echo json_encode($data);
} else {
    // 404 Not Found
    http_response_code(404);
    echo json_encode(array("message" => "Endpoint not found"));
}
?>


