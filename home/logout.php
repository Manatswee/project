<?php
session_start();

// ลบข้อมูล session
session_unset();

// ทำลาย session
session_destroy();

// ข้อความที่จะแสดงหลังจากออกจากระบบ
$message = "คุณได้ทำการออกจากระบบเรียบร้อยแล้ว";

// ทำการ redirect ไปยังหน้า login พร้อมส่งข้อความไปด้วย
header("Location: login.html?message=" . urlencode($message));
exit();
?>
