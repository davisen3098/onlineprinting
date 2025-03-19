<?php

require 'includes/PHPMailer.php';
require 'includes/SMTP.php';
require 'includes/Exception.php';
//Define name spaces
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

function sendMail($email, $otp)
{
    $mail = new PHPMailer();
    //Set mailer to use smtp
    $mail->isSMTP();
    //Define smtp host
    $mail->Host = "smtp.gmail.com";
    //Enable smtp authentication
    $mail->SMTPAuth = true;
    //Set smtp encryption type (ssl/tls)
    $mail->SMTPSecure = "tls";
    //Port to connect smtp
    $mail->Port = "587";
    //Set gmail username
    $mail->Username = "titifab7@gmail.com";
    //Set gmail password
    $mail->Password = "q n x n p v n e t j m a c c o j";
    //Email subject
    $mail->Subject = "Test email using PHPMailer";
    //Set sender email
    $mail->setFrom('titifab7@gmail.com');
    //Enable HTML
    $mail->isHTML(true);
    // //Attachment
    // 	$mail->addAttachment('img/attachment.png');
    //Email body
    $mail->Body = "Your otp is" . $otp;
    //Add recipient
    $mail->addAddress($email);
    //Finally send email
    if ($mail->send()) {
        return true;
    } else {
        return false;
    }
    //Closing smtp connection
    $mail->smtpClose();
}


function sendOrderMail($email)
{
    $mail = new PHPMailer();
    //Set mailer to use smtp
    $mail->isSMTP();
    //Define smtp host
    $mail->Host = "smtp.gmail.com";
    //Enable smtp authentication
    $mail->SMTPAuth = true;
    //Set smtp encryption type (ssl/tls)
    $mail->SMTPSecure = "tls";
    //Port to connect smtp
    $mail->Port = "587";
    //Set gmail username
    $mail->Username = "titifab7@gmail.com";
    //Set gmail password
    $mail->Password = "q n x n p v n e t j m a c c o j";
    //Email subject
    $mail->Subject = "Test email using PHPMailer";
    //Set sender email
    $mail->setFrom('titifab7@gmail.com');
    //Enable HTML
    $mail->isHTML(true);
    // //Attachment
    // 	$mail->addAttachment('img/attachment.png');
    //Email body
    $mail->Body = "Your order has been confirmed";
    //Add recipient
    $mail->addAddress($email);
    //Finally send email
    if ($mail->send()) {
        return true;
    } else {
        return false;
    }
    //Closing smtp connection
    $mail->smtpClose();
}
