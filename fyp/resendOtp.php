<?php
session_start();
// include connection  file
include_once('connection.php');
include_once('phpMailer.php');
// Object creation;
$db = new DB_con();

$email = $db->getEmail($_SESSION['uid']);

// generate OTP
$otp = rand(100000, 999999);

$mailStatus = sendMail($email, $otp);

if ($mailStatus = true) {
    $result = $db->updateOtp($_SESSION['uid'], $otp);
    echo "<script>window.location.href='otp.php'</script>";
}
