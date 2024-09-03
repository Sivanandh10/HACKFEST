<?php
include "../config.php";

if (isset($_POST['committee']) && $_POST['committee'] == "ORGANIZING") {
    $name = $_POST['oname'];
    $desig = $_POST['odesignation'];
    $role = $_POST['orole'];
    $committee = $_POST['committee'];

    $sql = "INSERT INTO coordinators ( NAME, DESIGNATION, ROLE, COMMITTEE) VALUES ('$name', '$desig', '$role', '$committee')";
    mysqli_query( $conn, $sql);

    header("Location: ./coordinatorList.php?success=added");
}
else if (isset($_POST['committee']) && $_POST['committee'] == "ADVISORY") {
    $name = $_POST['name'];
    $desig = $_POST['organization'];
    $committee = $_POST['committee'];

    $sql = "INSERT INTO coordinators ( NAME, DESIGNATION, ROLE, COMMITTEE) VALUES ('$name', '$desig', '$role', '$committee')";
    mysqli_query( $conn, $sql);

    header("Location: ./coordinatorList.php?success=added");
}
else if (isset($_POST['uid'])) {
    $id = $_POST['uid'];
    $sql = "DELETE FROM coordinators WHERE ID='$id'";
    mysqli_query($conn, $sql);
    header("Location: ./coordinatorList.php?success=deleted");
}
else {
    header("Location: ./coordinatorList.php?error=invalid-request");
}