// ตรวจสอบว่า URL มี query string "message" หรือไม่
const urlParams = new URLSearchParams(window.location.search);
const message = urlParams.get('message');

// ถ้ามีข้อความใน query string ให้แสดงในหน้า login
if (message) {
    alert(message);
    // ทำการ redirect ไปยังหน้า login.html
    window.location.href = "login.html";
}