<?php
include "../config.php";
include "./mail.php";

function validate($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

// Track Link and Contact Mail
$trackingLink =  "http" . (isset($_SERVER["HTTPS"]) && $_SERVER["HTTPS"] === "on" ? "s" : "") . "://" . $_SERVER["HTTP_HOST"] . "/hackfest/track-status";
$contactMail = "hackfest@esec.ac.in";

if ( isset($_POST['t_id']) && isset($_POST['upload'])) {

    $teamID = validate($_POST['t_id']);
    $file = $_FILES['abstract'];

    // Check User Id exist in the database
    $sql = "SELECT T_ID FROM teams WHERE T_ID='$teamID'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) < 0) {
        header("Location: ../uploadPaperForm.php?error=InvalidTeamID");
        exit();
    }

    // Check if the team has already uploaded the paper
    if (file_exists("./assets/uploads/" . $teamID . ".pdf")) {
        header("Location: ../uploadPaperForm.php?error=AlreadyUploaded");
        exit();
    }

    // Check if file exist
    if (empty($file)) {
        header("Location: ../uploadPaperForm.php?error=NoFile");
        exit();
    }

    // Check the file size and file type
    $fileName = $file['name'];
    $fileSize = $file['size'];
    $fileType = $file['type'];

    $fileExt = explode('.', $fileName);
    $fileActualExt = strtolower(end($fileExt));

    $allowed = array('pdf');

    if (in_array($fileActualExt, $allowed)) {
        if ($fileSize < 5242880) {
            $newFileName = $teamID . "." . $fileActualExt;
            $fileDestination = "../assets/uploads/" . $newFileName;

            try {
                if (!file_exists('../assets/uploads')) {
                    mkdir('../assets/uploads', 0777, true);
                }

                move_uploaded_file($file['tmp_name'], $fileDestination);

                $sql = "UPDATE teams SET STATUS='UPLOADED' WHERE T_ID='$teamID'";
                mysqli_query($conn, $sql);

                $sql = "SELECT NAME,EMAIL FROM registration WHERE T_ID='$teamID' LIMIT 1";
                $result = mysqli_query($conn, $sql);
                $row = mysqli_fetch_assoc($result);
                $name = $row['NAME'];
                $email = $row['EMAIL'];

                $mailvars = array(
                    "participant_name" => $name,
                    "team_id" => $teamId,
                    "track_status" => $trackingLink,
                    "contact_mail" => $contactMail
                );

                $body = file_get_contents('../assets/mails/uploadFile.html');
                foreach($mailvars as $key => $value) {
                    $body = str_replace('{{' . $key . '}}', $value, $body);
                }

                $mail->addAddress($email);
                $mail->Subject = 'Abstract Uploaded Successfully - HACKFEST 2024';
                $mail->isHTML(true);
                $mail->msgHTML($body);

                $mail->send();
                $mail->clearAddresses();

                header("Location: ../uploadPaperForm.php?success=uploadSuccess");
                exit();
            }
            catch (Exception $e) {
                header("Location: ../uploadPaperForm.php?error=uploaderror");
                exit();
            }
        }
    }

} else {
    header("Location: ../uploadPaperForm.php?error=InvalidRequest");
    exit();
}