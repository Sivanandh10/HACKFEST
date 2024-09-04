<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HACKFEST - 2k24 - Forget Password</title>
    <?php include "../includes.php"; ?>
</head>

<body style="display: block;">

    <!-- Error Messages -->
    <?php include "../error.php"; ?>
    <div class="form-container">
        <form action="sendOTP.php" method="post" onsubmit="validateForm(ev)">
            <h1>Forget Password</h1>
            <div class="input-group">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" placeholder="Enter Email" required>
                <span class="error email"></span>
            </div>
            <a href="../login.php">Remember Password?</a>
            <div class="btn-group">
                <button type="submit" name="sendOTP">Send OTP</button>
            </div>
        </form>
    </div>

    <script>
        function validateForm(ev) {
            ev.preventDefault();
            const email = $("#email").val();
            if (email === "") {
                $(".error.email").text("Email is required");
            } else {
                ev.target.submit();
            }
        }
    </script>
</body>

</html>