<?php
include "../config.php";

function validate($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

if (isset($_POST['login'])) {
    $username = validate($_POST['username']);
    $password = validate($_POST['password']);

    $user = mysqli_query($conn, "SELECT * FROM admin WHERE EMAIL='$username'");

    if (mysqli_num_rows($user) > 0) {

        $row = mysqli_fetch_assoc($user);

        if ($username === $row['EMAIL']) {

            if (password_verify($password, $row['PASSWORD'])) {
                
                session_start();
                
                $_SESSION['username'] = $row['EMAIL'];
                $_SESSION['name'] = $row['NAME'];
                $_SESSION['id'] = $row['ID'];
                $_SESSION['role'] = $row['ROLE'];

                header("Location: ./dashboard.php");
            } else {
                header("Location: ./index.php?error=invalidCreadential");
            }
        } else {
            header("Location: ./index.php?error=invalidCreadential");
        }
    } else {
        header("Location: ./index.php?error=invalidCreadential");
    }
}
header("Location: ./index.php?error=invalidCreadential");
