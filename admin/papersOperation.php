<?php
session_start();
include "../config.php";
include "../backend/mail.php";

function deleteTeam($teamID)
{
    global $conn;

    $query = "SELECT * FROM teams WHERE T_ID = '$teamID'";
    $result = mysqli_query($conn, $query);

    $row = mysqli_fetch_assoc($result);

    $file = "../assets/uploads/" . $row['T_ID'] . ".pdf";

    if (file_exists($file)) {
        unlink($file);
    }
}

$contactMail = "hackfest@esec.ac.in";
$paymentLink = "http" . (isset($_SERVER["HTTPS"]) && $_SERVER["HTTPS"] === "on" ? "s" : "") . "://" . $_SERVER["HTTP_HOST"] . "/hackfest/paymentScreenshot.php";

if (isset($_POST['performOperation']) && isset($_POST['operation']) && isset($_POST['t_id'])) {
    $operation = $_POST['operation'];
    $teamID = $_POST['t_id'];

    switch (strtolower($operation)) {
        case 'view':

            $query = "SELECT * FROM teams WHERE T_ID = '$teamID'";
            $result = mysqli_query($conn, $query);
            $row = mysqli_fetch_assoc($result);
            $status = $row['STATUS'];
            if ($status == 'ACCEPTED') {
                echo json_encode(array('status' => 'success', 'message' => 'Team has been reviewed already'));
                break;
            }

            $query = "UPDATE teams SET STATUS='UNDER REVIEW' WHERE T_ID='$teamID'";
            $result = mysqli_query($conn, $query);

            if ($result) {
                echo json_encode(array('status' => 'success', 'message' => 'Team is under review now'));
            } else {
                echo json_encode(array('status' => 'error', 'message' => 'Team could not be updated'));
            }
            break;

        case 'download':

            $query = "SELECT * FROM teams WHERE T_ID = '$teamID'";
            $result = mysqli_query($conn, $query);
            $row = mysqli_fetch_assoc($result);
            $status = $row['STATUS'];
            if ($status != 'ACCEPTED') {
                $query = "UPDATE teams SET STATUS='UNDER REVIEW' WHERE T_ID='$teamID'";
                $result = mysqli_query($conn, $query);
            }

            $query = "SELECT * FROM teams WHERE T_ID = '$teamID'";
            $result = mysqli_query($conn, $query);
            $row = mysqli_fetch_assoc($result);
            $file = "../assets/uploads/" . $row['T_ID'] . ".pdf";

            if (file_exists($file)) {
                echo json_encode(array('status' => 'success', 'message' => 'Download started', 'file' => $file));
            } else {
                echo json_encode(array('status' => 'error', 'message' => 'File not found'));
            }
            break;

        case 'select':
            $query = "UPDATE teams SET STATUS='ACCEPTED' WHERE T_ID = '$teamID'";
            $result = mysqli_query($conn, $query);

            if ($result) {
                echo json_encode(array('status' => 'success', 'message' => 'Team status updated successfully'));
            } else {
                echo json_encode(array('status' => 'error', 'message' => 'Team could not be updated'));
            }
            break;

        case 'reject':
            $query = "UPDATE teams SET STATUS='REJECTED' WHERE T_ID = '$teamID'";
            $result = mysqli_query($conn, $query);

            if ($result) {
                echo json_encode(array('status' => 'success', 'message' => 'Team status updated successfully'));
            } else {
                echo json_encode(array('status' => 'error', 'message' => 'Team could not be updated'));
            }
            break;

        case 'delete':
            deleteTeam($teamID);

            $query = "DELETE FROM teams WHERE T_ID = '$teamID'";
            $result = mysqli_query($conn, $query);

            if ($result) {
                echo json_encode(array('status' => 'success', 'message' => 'Team deleted successfully'));
            } else {
                echo json_encode(array('status' => 'error', 'message' => 'Team could not be deleted'));
            }
            break;

        case 'send mail':

            $query = "SELECT * FROM teams WHERE T_ID = '$teamID'";
            $result = mysqli_query($conn, $query);
            $row = mysqli_fetch_assoc($result);
            $status = $row['STATUS'];
            if ($status != 'ACCEPTED') {
                $query = "UPDATE teams SET STATUS='UNDER REVIEW' WHERE T_ID='$teamID'";
                $result = mysqli_query($conn, $query);
            }

            $query = "SELECT * FROM registration JOIN teams ON registration.T_ID=teams.T_ID WHERE registration.T_ID = '$teamID' LIMIT 1";
            $result = mysqli_query($conn, $query);
            $row = mysqli_fetch_assoc($result);

            $name = $row['NAME'];
            $email = $row['EMAIL'];
            $teamTitle = $row['TITLE'];

            $body = file_get_contents('../assets/mails/acceptanceMail.html');

            $mailvars = array(
                "participant_name" => $name,
                "contact_mail" => $contactMail,
                "abstract_title" => $teamTitle,
                "registration_fee" => "Rs. 350 /- per Head",
                "account_holder_name" => "The Principal",
                "account_number" => "500101012422890",
                "ifsc_code" => "CIUB0000059",
                "bank_name" => "City Union Bank",
                "branch" => "Erode Branch",
                "payment_proof_link" => $paymentLink,
            );

            foreach ($mailvars as $key => $value) {
                $body = str_replace('{{' . $key . '}}', $value, $body);
            }

            $mail->addAddress($email);
            $mail->Subject = 'Congratulations! Abstract Accepted for HACKFEST - 24 | ESEC';
            $mail->isHTML(true);
            $mail->msgHTML($body);

            $mail->send();
            $mail->clearAddresses();

            echo json_encode(array('status' => 'success', 'message' => 'Mail sent successfully'));
            break;

    }
}
