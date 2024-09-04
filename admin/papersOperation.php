<?php
session_start();
include "../config.php";
include "../mail.php";

function deletePaper($userID)
{
    global $conn;

    $query = "SELECT * FROM papers WHERE UID = '$userID'";
    $result = mysqli_query($conn, $query);
    
    $row = mysqli_fetch_assoc($result);
    
    $file = $row['FILE_PATH'];
    $file = str_replace('./', '../', $file);

    if (file_exists($file)) {
        unlink($file);
    }
}

$contactMail = "hodads@esec.ac.in";
$paymentLink = "http" . (isset($_SERVER["HTTPS"]) && $_SERVER["HTTPS"] === "on" ? "s" : "") . "://" . $_SERVER["HTTP_HOST"] . "/hackfest/paymentScreenshot.php";

if (isset($_POST['performOperation']) && isset($_POST['operation']) && isset($_POST['uid'])) {
    $operation = $_POST['operation'];
    $userID = $_POST['uid'];

    switch (strtolower($operation)) {
        case 'view':

            $query = "SELECT * FROM papers WHERE UID = '$userID'";
            $result = mysqli_query($conn, $query);
            $row = mysqli_fetch_assoc($result);
            $status = $row['STATUS'];
            if ($status == 'ACCEPTED') {
                echo json_encode(array('status' => 'success', 'message' => 'Paper has been reviewed already'));
                break;
            }

            $query = "UPDATE papers SET STATUS='UNDER REVIEW' WHERE UID='$userID'";
            $result = mysqli_query($conn, $query);

            if ($result) {
                echo json_encode(array('status' => 'success', 'message' => 'Paper is under review now'));
            } else {
                echo json_encode(array('status' => 'error', 'message' => 'Paper could not be updated'));
            }
            break;

        case 'download':

            $query = "SELECT * FROM papers WHERE UID = '$userID'";
            $result = mysqli_query($conn, $query);
            $row = mysqli_fetch_assoc($result);
            $status = $row['STATUS'];
            if ($status != 'ACCEPTED') {
                $query = "UPDATE papers SET STATUS='UNDER REVIEW' WHERE UID='$userID'";
                $result = mysqli_query($conn, $query);
            }

            $query = "SELECT * FROM papers WHERE UID = '$userID'";
            $result = mysqli_query($conn, $query);
            $row = mysqli_fetch_assoc($result);
            $file = $row['FILE_PATH'];
            $file = str_replace('./', '../', $file);

            if (file_exists($file)) {
                echo json_encode(array('status' => 'success', 'message' => 'Download started', 'file' => $file));
            } else {
                echo json_encode(array('status' => 'error', 'message' => 'File not found'));
            }
            break;

        case 'select':
            $query = "UPDATE papers SET STATUS='ACCEPTED' WHERE UID = '$userID'";
            $result = mysqli_query($conn, $query);

            if ($result) {
                echo json_encode(array('status' => 'success', 'message' => 'Paper status updated successfully'));
            } else {
                echo json_encode(array('status' => 'error', 'message' => 'Paper could not be updated'));
            }
            break;

        case 'reject':
            $query = "UPDATE papers SET STATUS='REJECTED' WHERE UID = '$userID'";
            $result = mysqli_query($conn, $query);

            if ($result) {
                echo json_encode(array('status' => 'success', 'message' => 'Paper status updated successfully'));
            } else {
                echo json_encode(array('status' => 'error', 'message' => 'Paper could not be updated'));
            }
            break;

        case 'delete':
            deletePaper($userID);

            $query = "DELETE FROM papers WHERE UID = '$userID'";
            $result = mysqli_query($conn, $query);

            if ($result) {
                echo json_encode(array('status' => 'success', 'message' => 'Paper deleted successfully'));
            } else {
                echo json_encode(array('status' => 'error', 'message' => 'Paper could not be deleted'));
            }
            break;

        case 'send mail':

            $query = "SELECT * FROM papers WHERE UID = '$userID'";
            $result = mysqli_query($conn, $query);
            $row = mysqli_fetch_assoc($result);
            $status = $row['STATUS'];
            if ($status != 'ACCEPTED') {
                $query = "UPDATE papers SET STATUS='UNDER REVIEW' WHERE UID='$userID'";
                $result = mysqli_query($conn, $query);
            }

            $query = "SELECT * FROM users JOIN papers ON users.UID=papers.UID WHERE users.UID = '$userID'";
            $result = mysqli_query($conn, $query);
            $row = mysqli_fetch_assoc($result);
            
            $name = $row['NAME'];
            $email = $row['EMAIL'];
            $paperTitle = $row['PAPER_TITLE'];
            $category = $row['CATEGORY'];

            $amount = array(
                "Academician" => "INR 1500",
                "Industrialist" => "INR 1500",
                "Research Scholar" => "INR 1200",
                "UG & PG Student" => "INR 1000",
            );

            $mailvars = array(
                "participant_name" => $name,
                "contact_mail" => $contactMail,
                "paper_title" => $paperTitle,
                "registration_fee" => $amount[$category],
                "account_holder_name" => "The Principal",
                "account_number" => "500101012422890",
                "ifsc_code" => "CIUB0000059",
                "bank_name" => "City Union Bank",
                "branch" => "Erode Branch",
                "payment_proof_link" => $paymentLink
            );

            $body = file_get_contents('../assets/mails/acceptanceMail.html');
            foreach($mailvars as $key => $value) {
                $body = str_replace('{{' . $key . '}}', $value, $body);
            }

            $mail->addAddress($email);
            $mail->Subject = 'Congratulations! Idea Accepted for HACKFEST - 24 | ESEC';
            $mail->isHTML(true);
            $mail->msgHTML($body);

            $mail->send();
            $mail->clearAddresses();

            echo json_encode(array('status' => 'success', 'message' => 'Mail sent successfully'));
            break;

    }
}
