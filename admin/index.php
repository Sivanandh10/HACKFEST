<?php
session_start();
if (isset($_SESSION['id'])) {
    header("Location: ./dashboard.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include "./includes.php"; ?>
    <title>HACKFEST - 2k24 - Admin Login</title>
</head>
<body style="display: block;">
    <?php include "./error.php"; ?>

    <div class="form-container">
        <form action="./login.php" method="post" onsubmit="validateForm(ev)">
            <h2>Admin Login</h2>
            <div class="input-group">
                <label for="username">Username:</label>
                <input type="text" name="username" id="username" placeholder="Enter Username" required>
                <span class="error username"></span>
            </div>
            <div class="input-group">
                <label for="password">Password:</label>
                <div style="position: relative;">
                    <input type="password" name="password" id="password" placeholder="Enter Password" required>
                    <span id="show-pass">
                        <i class="fa-solid fa-eye"></i>
                    </span>
                </div>
                    <span class="error password"></span>
            </div>
            <a href="./forgetPassword/">
                Forgotten Password?
            </a>
            <div class="btn-group">
                <button type="submit" name="login">Sign In</button>
            </div>
        </form>
    </div>

    <script>
        $("#show-pass").click(function(){
            var pass = $("#password");
            if(pass.attr("type") == "password"){
                pass.attr("type", "text");
                $("#show-pass i").removeClass("fa-eye").addClass("fa-eye-slash");
            } else {
                pass.attr("type", "password");
                $("#show-pass i").removeClass("fa-eye-slash").addClass("fa-eye");
            }
        });

        function validateForm(ev){
            ev.preventDefault();
            var username = $("#username").val();
            var password = $("#password").val();
            
            if(username == ""){
                $(".error.username").text("Username is required");
            } else {
                $(".error.username").text("");
            } 

            if(password == ""){
                $(".error.password").text("Password is required");
            } else {
                $(".error.password").text("");
            }

            if(username != "" && password != ""){
                ev.target.submit();
            }
        }
    </script>
</body>
</html>