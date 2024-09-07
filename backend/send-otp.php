<?php

if ($_SERVER["REQUEST_METHOD"] != "POST") {
    header("Location: ../register.php");
    exit();
}

include "../config.php";
include "./mail.php";

function sendOTP($email, $otp) {
    $subject = "OTP for Registration";
    $body = file_get_contents("../assets/mails/otp.html");

    $body = str_replace("{{otp}}", $otp, $body);

    try {
        if (sendMail($email, $subject, $body)) {
            echo "success";
        } else {
            echo "failed";
        }
    } catch (Exception $e) {
        echo "failed";
    }
}

// Send OTP
if (isset($_POST['email']) && isset($_POST['sendOTP'])) {
    $email = $_POST['email'];

    $sql = "SELECT * FROM registration WHERE EMAIL='$email'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        echo "exists";
        exit();
    }


    $otp = rand(100000, 999999);

    $query = "INSERT INTO otp (EMAIL, OTP) VALUES ('$email', '$otp')";
    if (mysqli_query($conn, $query)) {
        sendOTP($email, $otp);
    } else {
        echo "failed";
    }
}

// Resend OTP
if (isset($_POST['email']) && isset($_POST['resendOTP'])) {
    $email = $_POST['email'];

    $query = "SELECT * FROM otp WHERE EMAIL = '$email'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        $otp = rand(100000, 999999);
        $query = "UPDATE otp SET OTP = '$otp' WHERE EMAIL = '$email'";
        if (mysqli_query($conn, $query)) {
            sendOTP($email, $otp);
        } else {
            echo "failed";
        }
    } else {
        echo "failed";
    }
}

// Verify OTP
if (isset($_POST['otp']) && isset($_POST['verifyOTP'])) {
    $otp = $_POST['otp'];
    $email = $_POST['email'];

    $query = "SELECT * FROM otp WHERE EMAIL = '$email' AND created_at > DATE_SUB(NOW(), INTERVAL 10 MINUTE) AND OTP = '$otp'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        echo "success";
    } else {
        echo "failed";
    }
}