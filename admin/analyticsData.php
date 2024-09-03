<?php
session_start();
include "../config.php";

if (isset($_SESSION['id']) && isset($_SESSION['role'])) {
    $data = array();
    
    // Total Registration Count
    $sql = "SELECT ID FROM registration";
    $result = mysqli_query($conn, $sql);
    $data["totalUser"] = mysqli_num_rows($result);

    // Total Ideas Count
    $sql = "SELECT ID FROM teams";
    $result = mysqli_query($conn, $sql);
    $data["totalIdeas"] = mysqli_num_rows($result);

    // Total Ideas Under Review
    $sql = "SELECT ID FROM teams WHERE STATUS='UNDER REVIEW'";
    $result = mysqli_query($conn, $sql);
    $data["ideasUnderReview"] = mysqli_num_rows($result);

    // Total Ideas Accepted
    $sql = "SELECT ID FROM teams WHERE STATUS='ACCEPTED'";
    $result = mysqli_query($conn, $sql);
    $data["ideasAccepted"] = mysqli_num_rows($result);

    // Total Ideas Rejected
    $sql = "SELECT ID FROM teams WHERE STATUS='REJECTED'";
    $result = mysqli_query($conn, $sql);
    $data["ideasRejected"] = mysqli_num_rows($result);

    // Total Payment Count  
    $sql = "SELECT ID FROM payment";
    $result = mysqli_query($conn, $sql);
    $data["totalPayment"] = mysqli_num_rows($result);

    // Total Payment in Verified Status
    $sql = "SELECT ID FROM payment WHERE STATUS='VERIFIED'";
    $result = mysqli_query($conn, $sql);
    $data["paymentVerified"] = mysqli_num_rows($result);

    // Total Payment in Pending Status
    $sql = "SELECT ID FROM payment WHERE STATUS='NOT VERIFIED'";
    $result = mysqli_query($conn, $sql);
    $data["paymentPending"] = mysqli_num_rows($result);

    echo json_encode($data);
}