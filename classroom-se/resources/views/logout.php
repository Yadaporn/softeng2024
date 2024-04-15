<?php
session_start();
//clear session
session_destroy();
header('Location: index.php');
?>