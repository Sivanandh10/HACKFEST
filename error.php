<?php

if (isset($_GET['error'])) {

    $error = $_GET['error'];

    if ($error == "invalidTeamID") {
        echo "<span class='message error'>Please enter a valid email</span>";
    }

    if ($error == "AreadyUploaded") {
        echo "<span class='message error'>You have already uploaded the payment details</span>";
    }

    if ($error == "uploaderror") {
        echo "<span class='message error'>There was an error uploading the file</span>";
    }

    if ($error == "InvalidRequest") {
        echo "<span class='message error'>Invalid Request</span>";
    }

    if ($error == "paymentSuccess") {
        echo "<span class='message success'>Payment Details Uploaded Successfully</span>";
    }

    if ($error == "paymentFailed") {
        echo "<span class='message error'>Payment Details Upload Failed</span>";
    }

    if ($error == "invalidFile") {
        echo "<span class='message error'>Invalid File Type</span>";
    }

    if ($error == "fileSizeExceeded") {
        echo "<span class='message error'>File Size Exceeded</span>";
    }

    if ($error == "fileUploadError") {
        echo "<span class='message error'>File Upload Error</span>";
    }

    if ($error == "fileNotFound") {
        echo "<span class='message error'>File Not Found</span>";
    }

    if ($error == "fileDownloadError") {
        echo "<span class='message error'>File Download Error</span>";
    }
}
?>