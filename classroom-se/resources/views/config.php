<?php
require_once "google-api/vendor/autoload.php";
$gClient = new Google_Client();
$gClient->setClientId("clientId");//ใส่ClientId
$gClient->setClientSecret("ClientSecret");//ใส่ClientSecret
$gClient->setApplicationName("Vicode Media Login");
$gClient->setRedirectUri("http://localhost/Login/controller.php");
$gClient->addScope("https://www.googleapis.com/auth/plus.login https://www.googleapis.com/auth/userinfo.email");

// login URL
$login_url = $gClient->createAuthUrl();
?>