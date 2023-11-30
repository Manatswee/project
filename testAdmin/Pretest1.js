// เลือกฟอร์มแบบทดสอบ
const quizForm = document.getElementById('quiz-form2');

// กำหนดคำตอบที่ถูกต้อง
const correctAnswers = ['2', '3', '1', '1', '3', '1', '2', '3', '3', '2', '3', '1', '1', '1', '2', '1', '3', '1', '2', '1'];

// จัดการการส่งฟอร์มแบบทดสอบ
quizForm.addEventListener('submit', function(e) {
    e.preventDefault(); // ป้องกันการรีโหลดหน้า

    let score = 0;
    const userAnswers = [
        quizForm.q1.value,
        quizForm.q2.value,
        quizForm.q3.value,
        quizForm.q4.value,
        quizForm.q5.value,
        quizForm.q6.value,
        quizForm.q7.value,
        quizForm.q8.value,
        quizForm.q9.value,
        quizForm.q10.value,
        quizForm.q11.value,
        quizForm.q12.value,
        quizForm.q13.value,
        quizForm.q14.value,
        quizForm.q15.value,
        quizForm.q16.value,
        quizForm.q17.value,
        quizForm.q18.value,
        quizForm.q19.value,
        quizForm.q20.value
    ];

    // ตรวจสอบคำตอบและคำนวณคะแนน
    userAnswers.forEach((answer, index) => {
        if (answer === correctAnswers[index]) {
            score += 1;
        }
    });

    // แสดงผลลัพธ์
    const resultContainer = document.getElementById('result');
    resultContainer.innerHTML = `<p>คะแนนของคุณ: ${score} / ${correctAnswers.length}</p>`;
});