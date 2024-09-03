<?php
session_start();
include "../config.php";

// Fetch User Details along with Paper Details
if (isset($_POST['fetchUser'])) {
    $uid = $_POST['id'];
    $sql = "SELECT * FROM users WHERE UID='$uid'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $sql1 = "SELECT * FROM papers WHERE UID='$uid'";
        $result1 = $conn->query($sql1);
        if ($result1->num_rows > 0) {
            $row1 = $result1->fetch_assoc();
            $data = array(
                "status" => "success",
                "data" => array(
                    "user" => $row,
                    "paper" => $row1
                )
            );
            echo json_encode($data);
        } else {
            $data = array(
                "status" => "success",
                "data" => array(
                    "user" => $row,
                    "paper" => "No Paper Submitted"
                )
            );
            echo json_encode($data);
        }
    } else {
        $data = array(
            "status" => "error",
            "message" => "User Not Found"
        );
        echo json_encode($data);
    }
}