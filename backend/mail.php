<?php

use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';


$mail = new PHPMailer(true);

$mail->isSMTP();
$mail->Host = "smtp.gmail.com";
$mail->SMTPAuth = true;
$mail->Username = "hackfest@esec.ac.in";
$mail->Password = "knyyxdbjdsvxguhl";
$mail->SMTPSecure = "ssl";
$mail->Port = 465;

$fromAddress = "hackfest@esec.ac.in";
$fromName = "Hackfest - Erode Sengunthar Engineering College";

$mail->setFrom($fromAddress, $fromName);

function sendMail( $email, $subject, $msg, $name='')
{
    global $mail;
    $mail->addAddress($email, $name);
    $mail->isHTML(true);
    $mail->Subject = $subject;
    $mail->Body = $msg;

    if ($mail->send()) {
        $mail->clearAddresses();
        return true;
    } else {
        $mail->clearAddresses();
        return false;
    }
}