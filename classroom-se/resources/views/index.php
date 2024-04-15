<?php
session_start();
require_once('config.php');
// require_once('core/controller.Class.php');
error_reporting(E_ERROR | E_PARSE);
?>
<!DOCTYPE html>
<html lang="en">
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <style>
        .container {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        .card-container {
    display: flex;
    justify-content: flex-end; /* จัดวางทางขวา */
    max-width: 45rem;
    margin: auto;
}

.card {
    order: 1;
    left: 200px;
}
        .card-header {
            text-align: center;
        }

        .card-img img {
            display: block;
            margin: auto;
            height: 150px;
            width: 400px;
        }

        .card-body {
            text-align: center;
        }

        .login-container {
            margin-top: 100px;
            text-align: center;
        }

        .login-btn {
            margin-left: 14.5%;
        }

        .contact-us {
            color: white;
            margin: 15px;
        }

        .admin-links {
            margin-left: -250px;
            text-align: left;
        }

        .gear-img {
            margin-left: 34%;
            margin-top: -60%;
            display: table;
            height: 100px;
            width: 150px;
        }
    </style>
</head>
<body background="asset/background.jpg" style="background-size: cover;">
    <div class="container">
        <div class="card-container">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">ข่าวสารสนเทศ</h5>
                </div>
                <div class="card-img">
                    <img src="asset/ku src.png">
                </div>
                <div class="card-body">
                    <h5 class="card-title">ปีการศึกษา</h5>
                    <p class="card-text">ตารางสอบ ประจำปลายภาค สำหรับอาจารย์หลักสูตรภาษาไทย</p>
                    <p class="card-text">ประชาสัมพันธ์ หมู่ Walk-in Examination ปลายภาค</p>
                </div>
            </div>

            <div class="login-container">
                <?php if(isset($_COOKIE['id']) && isset($_COOKIE['sess'])){
                    $Controller = new Controller;
                    if($Controller->checkUserStatus($_COOKIE['id'], $_COOKIE['sess'])){
                        echo $Controller->printData(intval($_COOKIE['id']));
                        echo '<a href="logout.php">Log Out</a>';
                    }
                } else { ?>
                    <img src="asset/eng-ku-logo.png" alt="logo" style="margin-top: -5cm; margin-left: -200px;">
                    <h3 style="color:white; margin: 15px; margin-left: -200px;">ระบบจัดตารางสอน</h3>
                    <h3 style="color:white; margin: 15px; margin-left: -200px;"><?php echo $_SESSION["email"]?></h3>
                    <h3 style="color:white; margin: 15px; margin-left: -200px;"><?php echo $_SESSION["Role"]?></h3>
                    
                    <?php if($_SESSION["email"] == "" ){ ?>
                        <button onclick="window.location='<?php echo $login_url; ?>'" type="button" class="btn btn-danger login-btn" style="margin-left: -220px;">Login with Google</button>
                    <?php } else  {?>
                        <button onclick="window.location='logout.php' " type="button" class="btn btn-danger login-btn" style="margin-left: -220px;">Logout</button>
                    <?php } ?>
                    <h6 class="contact-us" style="margin-left: -200px;">Continue another way</h6>
                    <h6 class="contact-us" style="margin-left: -200px;">ติดต่อเรา</h6><br>

                    <div class="admin-links">
                        <!-- //ใส่ลิ้งของปาล์มได้เลย -->
                        <a href="Info_blog">แอดมิน</a><br>
                        <!-- //ของหญิงใส่แล้ว -->
                        <a href="addroom">ฝ่ายทะเบียน</a><br>
                        <!-- //ใส่ลิ้งของนิวได้เลย -->
                        <a href="registerclass">อาจารย์</a> 
                    </div>

                    <img src="asset/gear.png" alt="gear" class="gear-img">
                <?php } ?>
            </div>
        </div>
    </div>
</body>
</html>
