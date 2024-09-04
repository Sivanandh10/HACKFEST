<?php
session_start();
include "../config.php";

// Fetch User Details along with Team Member Details with Team ID
if (isset($_POST['fetchUser'])) {
    $id = $_POST['id'];
    $sql = "SELECT * FROM registration WHERE ID='$id'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);

        // Fetch Team Member Details
        $teamID = $row['T_ID'];
        $sql = "SELECT * FROM registration WHERE T_ID='$teamID' AND ID!='$id'";
        $result = mysqli_query($conn, $sql);
        $teamMembers = array();
        if (mysqli_num_rows($result) > 0) {
            while ($member = mysqli_fetch_assoc($result)) {
                array_push($teamMembers, $member);
            }
        }

        $row['teamMembers'] = $teamMembers;

        // Team Details
        $sql = "SELECT * FROM teams WHERE T_ID='$teamID'";
        $result = mysqli_query($conn, $sql);
        $team = mysqli_fetch_assoc($result);
        $row['team'] = $team;

        $data = array(
            "status" => "success",
            "user" => $row
        );
    } else {
        $data = array(
            "status" => "error",
            "message" => "User Not Found"
        );
    }
    echo json_encode($data);
}