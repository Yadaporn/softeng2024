<?php
session_start();
require_once("controller.Class.php");
require_once("config.php");

$db_host = 'localhost';
$db_user = 'root';
$db_pass = '';
$db_name = 'google_login';


try {
    // เชื่อมต่อกับฐานข้อมูล MySQL โดยใช้ PDO
    // Create connection
    $conn = new mysqli($db_host, $db_user, $db_pass, $db_name);
    // Check connection
    if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
    }
    
    // ตรวจสอบว่ามีการส่งรหัส Authorization Code มาหรือไม่
    if (isset($_GET['code'])) {
        echo '<script>alert('. $_GET['code'].')</script>'; 
        // นำรหัส Authorization Code ไปแลก Access Token กับ Google
        $token = $gClient->fetchAccessTokenWithAuthCode($_GET['code']);
    } else {
        // ถ้าไม่มี ให้ redirect กลับไปยังหน้า index.php
        header('Location: error.php');
        exit();
    }
    
    
    
    // // ตรวจสอบว่ามีข้อผิดพลาดในการแลกเปลี่ยน Access Token หรือไม่
    if(!isset($token["error"])) {
        // เรียกใช้งาน Google OAuth เพื่อเข้าถึงข้อมูลผู้ใช้
        $oAuth = new Google_Service_Oauth2($gClient);
        $userData = $oAuth->userinfo_v2_me->get();
        $email = $userData['email'];
        $array_name = explode(" ", $userData['name']);



        // insert into DB
        $sql = "SELECT email FROM user where email = '$email' ";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {


            $sql = "SELECT info_duty FROM information where info_email = '$email' ";
            //get info_duty
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                $info_duty = $result->fetch_assoc()['info_duty'];
            } else {
                $info_duty = "";
            }            
            $_SESSION["email"] = $email;
            $_SESSION["Role"] = $info_duty;
            header('Location: homepage.php');
        }else {
            $sql = "INSERT INTO user (f_name, l_name, email)
            VALUES ('$array_name[0]', '$array_name[1]', '$email')";

            if ($conn->query($sql) === TRUE) {
            echo "New record created successfully";
            } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }
        $conn->close();
    }else{
        echo '<script>alert("Login google error")</script>'; 
    }
}
catch (Exception $e) {
    echo '<script>alert("Error Exception")</script>'; 
}
?>