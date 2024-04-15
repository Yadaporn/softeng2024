<?php
session_start();

?>
<!DOCTYPE html>
    <body>
        <h1 style="size:20;">ยินดีต้อนรับ</h1>
        <h1 style="size:20;"><?php echo $_SESSION["email"]?></h1>
        <h1 style="size:20;"><?php echo $_SESSION["Role"]?></h1>
    </body>
</html>