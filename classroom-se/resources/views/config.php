<?php
require_once "google-api/vendor/autoload.php";
$gClient = new Google_Client();
$gClient->setClientId("639026804890-htq2om2hfqbp51t9s3le81lk7sbdn2fn.apps.googleusercontent.com");
$gClient->setClientSecret("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");
$gClient->setApplicationName("Vicode Media Login");
$gClient->setRedirectUri("http://localhost/Login/controller.php");
$gClient->addScope("https://www.googleapis.com/auth/plus.login https://www.googleapis.com/auth/userinfo.email");

// login URL
$login_url = $gClient->createAuthUrl();
?>