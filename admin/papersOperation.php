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

    try {
        if (file_exists($file)) {
            unlink($file);
        }
    } catch (Exception $e) {
        echo json_encode(array('status' => 'error', 'message' => 'File could not be deleted'));
        exit();
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
                break;
            }

            if ($status == 'DELETED') {
                echo json_encode(array('status' => 'error', 'message' => 'Abstract is deleted'));
                break;
            }

            $query = "UPDATE teams SET STATUS='UNDER REVIEW' WHERE T_ID='$teamID'";
            $result = mysqli_query($conn, $query);

            if ($result) {
                echo json_encode(array(
                    'status' => 'success',
                    'message' => 'Team is under review now',
                    'team_status' => 'UNDER REVIEW'
                ));
            } else {
                echo json_encode(array('status' => 'error', 'message' => 'Team could not be updated'));
            }
            break;

        case 'download':

            $query = "SELECT * FROM teams WHERE T_ID = '$teamID'";
            $result = mysqli_query($conn, $query);
            $row = mysqli_fetch_assoc($result);
            $status = $row['STATUS'];
            if ($status != 'ACCEPTED' && $status != 'REJECTED') {
                $query = "UPDATE teams SET STATUS='UNDER REVIEW' WHERE T_ID='$teamID'";
                $result = mysqli_query($conn, $query);
            }

            if ($status == 'DELETED') {
                echo json_encode(array('status' => 'error', 'message' => 'Abstract is deleted'));
                break;
            }

            $query = "SELECT * FROM teams WHERE T_ID = '$teamID'";
            $result = mysqli_query($conn, $query);
            $row = mysqli_fetch_assoc($result);
            $file = "../assets/uploads/" . $row['T_ID'] . ".pdf";

            if (file_exists($file)) {
                echo json_encode(array(
                    'status' => 'success',
                    'message' => 'Download started',
                    'file' => $file,
                    'team_status' => $row['STATUS']
                ));
            } else {
                echo json_encode(array('status' => 'error', 'message' => 'File not found'));
            }
            break;

        case 'select':

            $query = "SELECT * FROM teams WHERE T_ID = '$teamID'";
            $result = mysqli_query($conn, $query);
            $row = mysqli_fetch_assoc($result);
            $status = $row['STATUS'];

            if ($status == 'ACCEPTED') {
                echo json_encode(array('status' => 'error', 'message' => 'Abstract is already selected'));
                break;
            }

            if ($status == 'DELETED') {
                echo json_encode(array('status' => 'error', 'message' => 'Abstract is deleted.'));
                break;
            }

            $query = "UPDATE teams SET STATUS='ACCEPTED' WHERE T_ID = '$teamID'";
            $result = mysqli_query($conn, $query);

            if ($result) {
                echo json_encode(array(
                    'status' => 'success',
                    'message' => 'Team status updated successfully',
                    'team_status' => 'ACCEPTED'
                ));
            } else {
                echo json_encode(array('status' => 'error', 'message' => 'Team could not be updated'));
            }
            break;

        case 'reject':

            $query = "SELECT * FROM teams WHERE T_ID = '$teamID'";
            $result = mysqli_query($conn, $query);
            $row = mysqli_fetch_assoc($result);
            $status = $row['STATUS'];

            if ($status == 'REJECTED') {
                echo json_encode(array('status' => 'error', 'message' => 'Abstract is already rejected'));
                break;
            }

            if ($status == 'DELETED') {
                echo json_encode(array('status' => 'error', 'message' => 'Abstract is deleted.'));
                break;
            }
            
            $query = "UPDATE teams SET STATUS='REJECTED' WHERE T_ID = '$teamID'";
            $result = mysqli_query($conn, $query);

            if ($result) {
                echo json_encode(array(
                    'status' => 'success',
                    'message' => 'Team status updated successfully',
                    'team_status' => 'REJECTED'
                ));
            } else {
                echo json_encode(array('status' => 'error', 'message' => 'Team could not be updated'));
            }
            break;

        case 'delete':
            deleteTeam($teamID);

            $query = "UPDATE teams SET STATUS='DELETED' WHERE T_ID = '$teamID'";
            $result = mysqli_query($conn, $query);

            if ($result) {
                echo json_encode(array(
                    'status' => 'success',
                    'message' => 'Team deleted successfully',
                    'team_status' => 'DELETED'
            ));
            } else {
                echo json_encode(array('status' => 'error', 'message' => 'Team could not be deleted'));
            }
            break;

        case 'send mail':

            $query = "SELECT * FROM teams WHERE T_ID = '$teamID'";
            $result = mysqli_query($conn, $query);
            $row = mysqli_fetch_assoc($result);
            $status = $row['STATUS'];

            if ($status == 'UPLOADED') {
                echo json_encode(array('status' => 'error', 'message' => 'Team is not reviewed yet. Please review the team first'));
                break;
            } else if ($status == 'REJECTED') {
                echo json_encode(array('status' => 'error', 'message' => 'Team is rejected. Please select the team first'));
                break;
            } else if ($status == 'UNDER REVIEW') {
                // Update status to ACCEPTED
                $query = "UPDATE teams SET STATUS='ACCEPTED' WHERE T_ID = '$teamID'";
                $result = mysqli_query($conn, $query);
            }

            $query = "SELECT * FROM registration JOIN teams ON registration.T_ID=teams.T_ID WHERE registration.T_ID = '$teamID' LIMIT 1";
            $result = mysqli_query($conn, $query);
            $row = mysqli_fetch_assoc($result);

            // Team mates count
            $query = "SELECT COUNT(*) AS TM_COUNT FROM registration WHERE T_ID = '$teamID'";
            $result = mysqli_query($conn, $query);
            $team = mysqli_fetch_assoc($result);
            $teamCount = $team['TM_COUNT'];

            $name = $row['NAME'];
            $email = $row['EMAIL'];
            $teamTitle = $row['TITLE'];

            $body = file_get_contents('../assets/mails/acceptanceMail.html');

            $mailvars = array(
                "participant_name" => $name,
                "team_id" => $teamID,
                "contact_mail" => $contactMail,
                "abstract_title" => $teamTitle,
                "total_fee" => "Rs. " . ($teamCount * 350) . " /-",
                "registration_fee" => "Rs. 350 /- per Head",
                "account_holder_name" => "The Principal",
                "account_number" => "500101012422890",
                "ifsc_code" => "CIUB0000059",
                "bank_name" => "City Union Bank",
                "branch" => "Erode Branch",
                "payment_qr" => "cid:payment_qr",
                "payment_proof_link" => $paymentLink,
            );

            foreach ($mailvars as $key => $value) {
                $body = str_replace('{{' . $key . '}}', $value, $body);
            }

            $mail->addEmbeddedImage(dirname(__DIR__) . '/assets/img/payment_qr.png', 'payment_qr', 'Payment QR Code.png');

            $mail->addAddress($email);
            $mail->Subject = 'Congratulations! Abstract Accepted for HACKFEST - 24 | ESEC';
            $mail->isHTML(true);
            $mail->msgHTML($body);


            $mail->send();
            $mail->clearAddresses();

            echo json_encode(array(
                'status' => 'success',
                'message' => 'Mail sent successfully',
                'team_status' => 'ACCEPTED'
            ));
            break;
    }
}
