<?php

if (isset($_GET['error'])) {
    $error = $_GET['error'];

    if ($error == "invalidEmail") {
        echo "<span class='message error'>Please enter a valid email</span>";
    }
    if ($error == "invalidCreadential") {
        echo "<span class='message error'>Invalid Username or Password</span>";
    }
    if ($error == "mailError") {
        echo "<span class='message error'>Error sending mail. Please try again later.</span>";
    }
    if ($error == "invalidOTP") {
        echo "<span class='message error'>Invalid OTP</span>";
    }
    if ($error == "invalid-request") {
        echo "<span class='message error'>Invalid request</span>";
    }
}

if (isset($_GET['success'])) {
    $success = $_GET['success'];

    if ($success == "mailSent") {
        echo "<span class='message success'>Mail sent successfully</span>";
    }
    if ($success == "pwd-reset") {
        echo "<span class='message success'>Password reset successfully</span>";
    }
    if ($success == "added") {
        echo "<span class='message success'>Member Added Successfully</span>";
    }
}