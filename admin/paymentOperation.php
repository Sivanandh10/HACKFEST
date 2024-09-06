<?php
include "../config.php";

if (isset($_SESSION['id']) && isset($_SESSION['role'])) {
    
    // Verify payment status
    if (isset($_POST['action']) && $_POST['action'] == 'verify') {
        $teamID = $_POST['teamID'];
        $sql = "UPDATE payment SET STATUS='VERIFIED' WHERE T_ID='$teamID'";
        $result = $conn->query($sql);
        if ($result) {
            echo json_encode(array("status" => "success", "message" => "Payment Verified Successfully!"));
        } else {
            echo json_encode(array("status" => "error", "message" => "Something went wrong!"));
        }
    }

}