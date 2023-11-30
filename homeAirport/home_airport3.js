// รับองค์ประกอบของฟอร์ม
const quizForm = document.getElementById('quiz-form');
const nextButton = document.getElementById('button1'); // รับปุ่ม Next

// กำหนดคำตอบที่ถูกต้อง
const correctAnswers = ['3', '3', '2', '3'];

// ตรวจสอบว่ามีการกด submit และแสดงผลคะแนนแล้วหรือไม่
let isSubmitted = false;

// จัดการการส่งฟอร์มแบบทดสอบ
quizForm.addEventListener('submit', function(e) {
    e.preventDefault(); // ป้องกันการรีโหลดหน้า

    // ตรวจสอบว่าทุกข้อถูกต้อง
    const allQuestionsAnswered = validateAllQuestions();

    if (!allQuestionsAnswered) {
        alert("กรุณาตอบทุกข้อก่อนที่จะส่ง");
        return;
    }

    let score = 0;
    const userAnswers = getUserAnswers();

    // ตรวจสอบคำตอบและคำนวณคะแนน
    userAnswers.forEach((answer, index) => {
        if (answer === correctAnswers[index]) {
            score += 1;
        }
    });

    // แสดงผลลัพธ์
    const resultContainer = document.getElementById('result');
    resultContainer.innerHTML = `<p>คะแนนของคุณ: ${score} / ${correctAnswers.length}</p>`;

    // แสดงปุ่ม "Next"
    nextButton.style.display = 'block';

    // กำหนดให้มีการกด submit แล้ว
    isSubmitted = true;
});

// ฟังก์ชันเพื่อตรวจสอบว่าทุกข้อถูกต้อง
function validateAllQuestions() {
    const userAnswers = getUserAnswers();

    // ตรวจสอบว่ามีข้อคำถามใดๆที่ยังไม่ได้ตอบหรือไม่
    return userAnswers.every(answer => answer !== '');
}

// ฟังก์ชันเพื่อรับคำตอบจากผู้ใช้
function getUserAnswers() {
    return [
        quizForm.q1.value,
        quizForm.q2.value,
        quizForm.q3.value,
        quizForm.q4.value
    ];
}

// ฟังก์ชันเพื่อตรวจสอบว่ามีการกด submit และแสดงผลคะแนนแล้วหรือไม่
nextButton.addEventListener('click', function() {
    if (!isSubmitted) {
        alert("กรุณากด submit ก่อนที่จะกด Next");
        return;
    }

    // ทำการ redirect หรือทำการปิดแบบทดสอบ (ตามที่คุณต้องการ)
    // ตัวอย่างเช่น redirect ไปที่หน้าถัดไป
    window.location.href = "home_airport4.html";
});