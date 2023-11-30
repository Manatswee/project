// เรียกใช้งานอิเลเมนต์แบบ Audio
const audioA = document.getElementById('audioA');
const buttonA = document.getElementById('positionA');
const audioB = document.getElementById('audioB');
const buttonB = document.getElementById('positionB');

let isPlaying = false;

// กำหนดการฟังก์ชันเมื่อคลิกที่ตำแหน่ง A
buttonA.addEventListener('click', () => {
    if (!isPlaying) {
        // เล่นเสียง
        audioA.play();
        isPlaying = true;
    } else {
        // หยุดเสียงถ้ากำลังเล่นอยู่
        audioA.pause();
        audioA.currentTime = 0;
        isPlaying = false;
    }
});

// กำหนดการฟังก์ชันเมื่อคลิกที่ตำแหน่ง B
buttonB.addEventListener('click', () => {
    if (!isPlaying) {
        // เล่นเสียง
        audioB.play();
        isPlaying = true;
    } else {
        // หยุดเสียงถ้ากำลังเล่นอยู่
        audioB.pause();
        audioB.currentTime = 0;
        isPlaying = false;
    }
});