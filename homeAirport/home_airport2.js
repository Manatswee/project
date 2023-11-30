// Worker หรือส่วนที่สร้างข้อความ
const channel = new MessageChannel();
channel.port1.onmessage = function(event) {
    // ดำเนินการแบบ asynchronous
    doSomethingAsync().then(result => {
        // ส่งข้อมูลที่ได้รับผลลัพธ์ไปยัง port2
        channel.port2.postMessage(result);
        // ปิด message port เพื่อป้องกันการส่งข้อมูลเพิ่มเติม
        channel.port1.close();
        channel.port2.close();
    });
    return true; // บอกให้ message channel ทำงานแบบ asynchronous
};