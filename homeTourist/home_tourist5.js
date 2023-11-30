// เรียกใช้งานอิเลเมนต์แบบ Audio
const audioA = document.getElementById('audioA');
const buttonA = document.getElementById('positionA');
const audioB = document.getElementById('audioB');
const buttonB = document.getElementById('positionB');
const audioAC = document.getElementById('audioC');
const buttonC = document.getElementById('positionC');
const audioD = document.getElementById('audioD');
const buttonD = document.getElementById('positionD');

let isPlaying = false;

// กำหนดการฟังก์ชันเมื่อคลิกที่ตำแหน่ง A
buttonA.addEventListener('click', () => {
    if (!isPlaying) {
        // เล่นเสียง
        audioA.play();
        isPlaying = true;
        buttonA.textContent = 'Pause'; // ปรับเปลี่ยนข้อความเป็น Pause
    } else {
        // หยุดเสียงถ้ากำลังเล่นอยู่
        audioA.pause();
        audioA.currentTime = 0;
        isPlaying = false;
        buttonA.textContent = 'Play'; // ปรับเปลี่ยนข้อความเป็น Play
    }
});

// กำหนดการฟังก์ชันเมื่อคลิกที่ตำแหน่ง B
buttonB.addEventListener('click', () => {
    if (!isPlaying) {
        // เล่นเสียง
        audioB.play();
        isPlaying = true;
        buttonB.textContent = 'Pause'; // ปรับเปลี่ยนข้อความเป็น Pause
    } else {
        // หยุดเสียงถ้ากำลังเล่นอยู่
        audioB.pause();
        audioB.currentTime = 0;
        isPlaying = false;
        buttonB.textContent = 'Play'; // ปรับเปลี่ยนข้อความเป็น Play
    }
});

// กำหนดการฟังก์ชันเมื่อคลิกที่ตำแหน่ง C
buttonC.addEventListener('click', () => {
    if (!isPlaying) {
        // เล่นเสียง
        audioC.play();
        isPlaying = true;
        buttonC.textContent = 'Pause'; // ปรับเปลี่ยนข้อความเป็น Pause
    } else {
        // หยุดเสียงถ้ากำลังเล่นอยู่
        audioC.pause();
        audioC.currentTime = 0;
        isPlaying = false;
        buttonC.textContent = 'Play'; // ปรับเปลี่ยนข้อความเป็น Play
    }
});

// กำหนดการฟังก์ชันเมื่อคลิกที่ตำแหน่ง D
buttonD.addEventListener('click', () => {
    if (!isPlaying) {
        // เล่นเสียง
        audioD.play();
        isPlaying = true;
        buttonD.textContent = 'Pause'; // ปรับเปลี่ยนข้อความเป็น Pause
    } else {
        // หยุดเสียงถ้ากำลังเล่นอยู่
        audioD.pause();
        audioD.currentTime = 0;
        isPlaying = false;
        buttonD.textContent = 'Play'; // ปรับเปลี่ยนข้อความเป็น Play
    }
});






// เชื่อมต่อกับบริการ Speech-to-Text API
const SpeechRecognition = window.SpeechRecognition || window.webkitSpeechRecognition;
const recognition1 = new SpeechRecognition();
const recognition2 = new SpeechRecognition();
const recognition3 = new SpeechRecognition();
const recognition4 = new SpeechRecognition();
const output1 = document.getElementById('output1');
const output2 = document.getElementById('output2');
const output3 = document.getElementById('output3');
const output4 = document.getElementById('output4');
const recordButton1 = document.getElementById('recordButton1');
const recordButton2 = document.getElementById('recordButton2');
const recordButton3 = document.getElementById('recordButton3');
const recordButton4 = document.getElementById('recordButton4');

recognition1.lang = 'en-US';
recognition2.lang = 'en-US';
recognition3.lang = 'en-US';
recognition4.lang = 'en-US';

recognition1.interimResults = true;
recognition2.interimResults = true;
recognition3.interimResults = true;
recognition4.interimResults = true;

// ...

function setupRecognition(recognition, output, recordButton) {
    let isRecording = false;
    let countdown = 20; // เริ่มนับถอยหลังที่ 20

    function updateCountdown() {
        recordButton.innerText = `กำลังบันทึก (${countdown})`;
    }

    function startCountdown() {
        countdown = 20;
        updateCountdown();
        const countdownInterval = setInterval(() => {
            countdown--;
            updateCountdown();
            if (countdown === 0) {
                clearInterval(countdownInterval);
                recognition.stop();
                // นี่คือตำแหน่งที่คุณสามารถเรียกฟังก์ชันแปลงเสียงเป็นข้อความได้
                // ตัวอย่างเช่น convertSpeechToText(output);
                recordButton.disabled = false;
                recordButton.innerText = 'บันทึกเสียง';
            }
        }, 1000); // นับถอยหลังทุก 1 วินาที
    }

    recognition.onstart = function() {
        isRecording = true;
        recordButton.disabled = true;
        startCountdown();
    };

    recognition.onresult = function(event) {
        const result = event.results[event.results.length - 1];
        const transcript = result[0].transcript;
        output.innerHTML = transcript;
    };

    recognition.onend = function() {
        isRecording = false;
    };

    recordButton.addEventListener('click', () => {
        if (!isRecording) {
            recognition.start();
        }
    });
}

// ...


setupRecognition(recognition1, output1, recordButton1);
setupRecognition(recognition2, output2, recordButton2);
setupRecognition(recognition3, output3, recordButton3);
setupRecognition(recognition4, output4, recordButton4);




/// แปรและส่วนแสดงคะแนน
let score = 0;
const scoreDisplay = document.getElementById('scoreDisplay');
const maxScore = 4; // คะแนนเต็ม


// รหัสอื่น ๆ ที่มีอยู่

// เพิ่มฟังก์ชันเพื่อเช็คคีย์เวิร์ด
function checkKeywords(transcript) {
    const keywords = ["tourist information counter", "Tourist information counter", "at the tourist information counter", "At the tourist information counter", "at the tourist information", "At the tourist information", "at the Tourist Information", "trekking", "Trekking", "bird watching", "Bird watching", "enjoying panoramic view", "Enjoying panoramic view", "Yes", "yes", "Maybe", "maybe", "tuk-tuk", "Tuk-Tuk", "motorcycle", "Motorcycle"];

    let foundKeywords = 0; // ตัวแปรเพื่อเก็บจำนวนคีย์เวิร์ดที่พบ

    for (const keyword of keywords) {
        if (transcript.includes(keyword)) {
            foundKeywords++;
        }
    }

    return foundKeywords; // คืนค่าจำนวนคำหรือประโยคที่ถูกตอบถูก
}


// ...

// เพิ่มการเช็คคีย์เวิร์ดเมื่อกดปุ่ม "Submit" และแสดงคะแนน
submitButton.addEventListener('click', () => {
    const foundKeywords1 = checkKeywords(output1.innerHTML); // ตรวจสอบคีย์เวิร์ดจากผลลัพธ์ของ recognition1 (output1)
    const foundKeywords2 = checkKeywords(output2.innerHTML); // ตรวจสอบคีย์เวิร์ดจากผลลัพธ์ของ recognition2 (output2)
    const foundKeywords3 = checkKeywords(output3.innerHTML); // ตรวจสอบคีย์เวิร์ดจากผลลัพธ์ของ recognition3 (output3)
    const foundKeywords4 = checkKeywords(output4.innerHTML); // ตรวจสอบคีย์เวิร์ดจากผลลัพธ์ของ recognition4 (output4)

    const totalScore = foundKeywords1 + foundKeywords2 + foundKeywords3 + foundKeywords4;

    if (totalScore > 0) {
        // แสดงคะแนนเมื่อพบคำหรือประโยคที่ต้องการตรวจสอบและตอบถูก
        scoreDisplay.innerText = `คะแนน: ${totalScore} คะแนน`;
        alert(`คะแนนที่คุณได้คือ: ${totalScore} คะแนน`);
    } else {
        // แสดงข้อความเมื่อไม่พบคำหรือประโยคที่ต้องการตรวจสอบหรือตอบถูก
        scoreDisplay.innerText = 'คะแนน: 0 คะแนน';
        alert('คุณไม่ได้รับคะแนน');
    }
});