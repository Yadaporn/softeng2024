<?php
require_once('config.php');
require_once('controller.php'); // สมมติว่าไฟล์ controller อยู่ที่นี่

// ตรวจสอบว่ามีการเข้าสู่ระบบแล้วหรือไม่

if(isset($_COOKIE['id']) && isset($_COOKIE['sess'])){
    $Controller = new Controller;


    // ตรวจสอบสถานะผู้ใช้
    if($Controller->checkUserStatus($_COOKIE['id'], $_COOKIE['sess'])){
        // ตรวจสอบว่ามีอีเมลในฐานข้อมูลหรือไม่
        $email = $Controller->getEmail($_COOKIE['id']);
        
        if($email) {
            // ถ้ามีอีเมลในฐานข้อมูล ให้เปลี่ยนเส้นทางไปยังหน้า homepage.php
            header("Location: controller.php");
            exit; // จบการทำงานของสคริปต์ที่นี่เพื่อหลีกเลี่ยงการดำเนินการต่อ
        } else {
            // ถ้าไม่มีอีเมลในฐานข้อมูล
            echo "No email found in the database.";
        }
    } else {
        // ถ้าสถานะผู้ใช้ไม่ถูกต้อง ให้ทำอะไรบางอย่าง เช่น ลบคุกกี้และให้ผู้ใช้เข้าสู่ระบบใหม่
        echo "Invalid user status. Please login again.";
        // ตัวอย่าง: ลบคุกกี้
        setcookie('id', '', time() - 3600, '/');
        setcookie('sess', '', time() - 3600, '/');
        // หรืออื่น ๆ ตามที่คุณต้องการ
    }
}
// } else {
//     require_once('index.php'); 
//     echo '<script>alert("ไม่พบรายชื่อผู้ใช้งาน")</script>'; 
//     exit; // จบการทำงานของสคริปต์ที่นี่เพื่อหลีกเลี่ยงข้อผิดพลาด "Cannot modify header information"
// }
?>
