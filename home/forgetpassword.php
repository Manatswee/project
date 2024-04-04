<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['email'])) {
        $email = $_POST['email'];

        // URL ของ API
        $url = 'http://localhost/Projesct12/api/api-user';

        // รับข้อมูล JSON จาก API
        $data = file_get_contents($url);

        // แปลงข้อมูล JSON เป็น array
        $array = json_decode($data, true);

        // แสดงข้อมูล
        print_r($array);
        echo "Email: " . $email;
    } else {
        echo "Email not provided";
    }
}
?>
