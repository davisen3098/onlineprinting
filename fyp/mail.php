<?php

require 'includes/PHPMailer.php';
require 'includes/SMTP.php';
require 'includes/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;



// include Function  file
include_once('connection.php');
// Object creation
$db = new DB_con();


if (isset($_POST['submit'])) {
    $mail = new PHPMailer();

    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = 'true';
    $mail->SMTPSecure = 'tls';
    $mail->Port = '587';
    $mail->username = 'jq@esokia-webagency.com';
    $mail->password = 'Nathan270601Uchiha';
    $mail->subject = 'Test Email Using PHPMailer';
    $mail->setFrom('jq@esokia-webagency.com');
    $mail->Body = 'Nathan la 1 malade sa ';
    $mail->addAddress('jq@esokia-webagency.com');
    $mail->Send();

    $mail->smtpClose();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <title>Document</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" />

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" />
    <script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="../login.css" />
</head>

<body>
    <div class="backdrop">
        <div class="col-md-4 mx-auto forms">
            <h4 class="text-center">SIGN UP</h4>
            <br />
            <form action="" method="post">
                <div class="form-group col-md-12">
                    <input type="submit" class="btn btn-warning form-control" value="submit" name="submit" />
                </div>
            </form>
        </div>
    </div>
</body>

</html>