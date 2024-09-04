<?php
include "../../config.php";

if (!isset($_GET['email'])) {
    header("Location: ./index.php");
} else {
    $email = $_GET['email'];
    $res = mysqli_query($conn, "SELECT * FROM admin WHERE EMAIL='$email' AND OTP=0");
    if (mysqli_num_rows($res) > 0) {
        header("Location: ../index.php?error=invalid-request");
    }

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HACKFEST - 2k24 - Reset Password</title>
    <?php include "../includes.php"; ?>
</head>
<body style="display: block;">
    <?php include "../error.php"; ?>
    <div class="form-container">
        <form method="post" id="form" onsubmit="validateForm(event)">
            <h2>Reset Password</h2>
            <div class="input-group">
                <label for="password">New Password:</label>
                <div style="position: relative;">
                    <input type="password" name="password" id="password" placeholder="Enter New Password" required>
                    <span id="show-pass">
                        <i class="fa-solid fa-eye"></i>
                    </span>
                </div>
                <span class="error password"></span>
            </div>
            <div class="input-group">
                <label for="cpassword">Confirm Password:</label>
                <input type="password" name="cpassword" id="cpassword" placeholder="Confirm Password" required>
                <span class="error cpassword"></span>
            </div>
            <div class="btn-group">
                <button type="submit" name="resetPassword">Reset Password</button>
            </div>
        </form>
    </div>
    <script>
        $("#show-pass").click(function() {
            var pass = $("#password");
            if(pass.attr("type") == "password"){
                pass.attr("type", "text");
                $("#show-pass i").removeClass("fa-eye").addClass("fa-eye-slash");
            } else {
                pass.attr("type", "password");
                $("#show-pass i").removeClass("fa-eye-slash").addClass("fa-eye");
            }
        });

        function validateForm(ev) {
            ev.preventDefault();
            var email = "<?php echo $email; ?>";
            var password = $("#password").val();
            var cpassword = $("#cpassword").val();
            var passRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;
            
            if(password == ""){
                $(".error.password").text("Password is required");
                return;
            } else {
                $(".error.password").text("");
            }
            
            if(cpassword == ""){
                $(".error.cpassword").text("Confirm Password is required");
                return;
            } else {
                $(".error.cpassword").text("");
            }
            
            if(!passRegex.test(password)){
                $(".error.password").text("Password must contain at least 8 characters, including UPPER/lowercase, numbers and special characters");
                return;
            } else {
                $(".error.password").text("");
            }
            
            if(password != cpassword){
                $(".error.cpassword").text("Passwords do not match");
                return;
            } else {
                $(".error.cpassword").text("");
            }

            $.ajax({
                url: "./resetPassword.php",
                type: "POST",
                data: {
                    resetPassword: 1,
                    email: email,
                    password: password,
                    cpassword: cpassword
                },
                success: function(data) {
                    if(data == "success"){
                        window.location.href = "../index.php?success=pwd-reset";
                    } else {
                        $(".form-container").prepend(data);                        
                    }
                }
            });
        }
    </script>
</body>
</html>