<?php
include './config.php';

// Upload Payment Details to the Database
if (isset($_POST['payment'])) {
    $userid = $_POST['userid'];
    $paymentDate = $_POST['payment-date'];
    $transactionId = $_POST['transaction-id'];
    $paymentScreenshot = $_FILES['payment-screenshot'];

    $paymentScreenshotName = $paymentScreenshot['name'];
    $paymentScreenshotTmpName = $paymentScreenshot['tmp_name'];

    $paymentScreenshotExt = explode('.', $paymentScreenshotName);
    $paymentScreenshotActualExt = strtolower(end($paymentScreenshotExt));

    $allowed = array('jpg', 'jpeg', 'png', 'pdf');

    // Check if the user has already registered
    $sql = "SELECT * FROM users WHERE UID = '$userid'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {

        // Check if the user has already uploaded the payment details
        $sql = "SELECT * FROM payment WHERE UID='$userid'";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
            header("Location: ./paymentScreenshot.php?error=AreadyUploaded");
            exit();
        }


        $paymentScreenshotNameNew = $userid . "." . $paymentScreenshotActualExt;
        $paymentScreenshotDestination = './uploads/payments/' . $paymentScreenshotNameNew;

        $sql = "INSERT INTO payment ( UID, PAYMENT_DATE, TRANSACTION_ID, SCREENSHOT) VALUES ('$userid', '$paymentDate', '$transactionId', '$paymentScreenshotDestination')";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            move_uploaded_file($paymentScreenshotTmpName, $paymentScreenshotDestination);
            header("Location: ./paymentScreenshot.php?success=paymentSuccess");
        } else {
            header("Location: ./paymentScreenshot.php?error=uploaderror");
        }
    } else {
        header("Location: ./paymentScreenshot.php?error=notregistered");
    }
} else {
    header("Location: ./paymentScreenshot.php?error=InvalidRequest");
}
