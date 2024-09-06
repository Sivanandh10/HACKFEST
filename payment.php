<?php
include './config.php';

// Upload Payment Details to the Database
if (isset($_POST['payment'])) {
    $teamID = $_POST['teamID'];
    $paymentDate = $_POST['payment-date'];
    $transactionId = $_POST['transaction-id'];
    $paymentScreenshot = $_FILES['payment-screenshot'];

    $paymentScreenshotName = $paymentScreenshot['name'];
    $paymentScreenshotTmpName = $paymentScreenshot['tmp_name'];

    $paymentScreenshotExt = explode('.', $paymentScreenshotName);
    $paymentScreenshotActualExt = strtolower(end($paymentScreenshotExt));

    $allowed = array('jpg', 'jpeg', 'png', 'pdf');

    // Check if the user has already registered
    $sql = "SELECT * FROM teams WHERE T_ID = '$teamID'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {

        // Check if the user has already uploaded the payment details
        $sql = "SELECT * FROM payment WHERE T_ID='$teamID'";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
            header("Location: ./paymentScreenshot.php?error=AreadyUploaded");
            exit();
        }

        if (!file)

        $paymentScreenshotNameNew = $teamID . "." . $paymentScreenshotActualExt;
        $paymentScreenshotDestination = './uploads/payments/' . $paymentScreenshotNameNew;

        $sql = "INSERT INTO payment ( UID, PAYMENT_DATE, TRANSACTION_ID, SCREENSHOT) VALUES ('$teamID', '$paymentDate', '$transactionId', '$paymentScreenshotDestination')";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            move_uploaded_file($paymentScreenshotTmpName, $paymentScreenshotDestination);
            header("Location: ./paymentScreenshot.php?success=paymentSuccess");
        } else {
            header("Location: ./paymentScreenshot.php?error=uploaderror");
        }
    } else {
        header("Location: ./paymentScreenshot.php?error=invalidTeamID");
    }
} else {
    header("Location: ./paymentScreenshot.php?error=InvalidRequest");
}
