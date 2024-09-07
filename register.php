<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="./assets/img/logo.png">
    <title>Register - HackFest | Erode Sengunthar Engineering College</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

    <style>
        :root {
            /* --primary: #5f27cd; */
            --primary: #ff6969;
            --secondary: #222327;
            --light: #ffffff;
            --danger: #d63031;
            --success: #00b894;
            --warning: #f1c40f;
        }

        .message {
            background-color: var(--light);
            color: var(--secondary);
            padding: 10px 12px;
            border-radius: 10px;
            font-size: 1rem;
            position: fixed;
            top: 100px;
            right: 20px;
            overflow: hidden;
            box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;
            transition: all .5s ease-in-out;
            animation: message 5s forwards;
        }

        @keyframes message {
            0% {
                transform: translateY(-200%);
                opacity: 0;
            }

            10% {
                transform: translateY(0);
                opacity: 1;
            }

            90% {
                transform: translateY(0);
                opacity: 1;
            }

            100% {
                transform: translateY(-200%);
                opacity: 0;
            }
        }

        .message::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 2px;
            animation: message-after 5s ease-in-out forwards;
        }

        .message.error::after {
            background-color: var(--danger);
        }

        .message.success::after {
            background-color: var(--success);
        }

        @keyframes message-after {
            0% {
                width: 100%;
            }

            100% {
                width: 0;
            }
        }
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>

    <?php
    include "./loader.php";

    include "./nav.php";

    if (isset($_GET['error'])) {
        $error = $_GET['error'];
        if ($error == "emptyfields") {
            echo '<div class="message error">Fill in all fields</div>';
        } else if ($error == "mailExists") {
            echo '<div class="message error">Email already exists</div>';
        } else if ($error == "uploadFailed") {
            
        }
    }

    if (isset($_GET['success'])) {
        if ($_GET['success'] == "registered") {
            echo '<div class="message success">Registered Successfully</div>';
        }
    }

    ?>

    <div class="container d-flex justify-content-center my-3">
        <form action="./backend/register.php" class="bg-white" style="width: min(500px, 90%);" method="POST" enctype="multipart/form-data">
            <h2>Registration</h2>

            <div class="alert alert-warning d-flex column-gap-3" role="alert">
                <i class="fa-solid fa-triangle-exclamation" aria-hidden="true"></i>
                <div>
                    <h6>Kindly Read the Instructions Before Filling the Form</h6>
                    <ul>
                        <li>Enter your <b>email</b> and verify it with an <b>OTP</b> before submitting the form.</li>
                        <li>Ensure that you have entered the details of all the <b>team members</b>.</li>
                        <li><b>Team members</b> can be from different departments within the same college.</li>
                        <li><b>Team members</b> from different colleges should not be combined.</li>
                        <li>Once the form is submitted, you will not be able to change the <b>team members</b>.</li>
                        <li>The project abstract should be in <b>PDF</b> format and less than <b>5 MB</b>.</li>
                        <li>Verify all the details before submitting the form.</li>
                    </ul>
                </div>
            </div>

            <div class="mb-3">
                <label for="tl-name" class="form-label">Team Leader Name</label>
                <input type="text" name="tl-name" id="tl-name" placeholder="Enter Team Leader Name" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="tl-email" class="form-label">Team Leader Email</label>
                <div class="input-group">
                    <input type="hidden" name="emailStatus" value="false" id="emailStatus" required>
                    <input type="email" name="tl-email" id="tl-email" placeholder="Enter Team Leader Email" class="form-control" required>
                    <button class="btn btn-outline-primary" type="button" onclick="sendOTP()">Verify</button>
                </div>
                <div class="input-group" id="otp-field"></div>
            </div>

            <div class="mb-3">
                <label for="tl-phone" class="form-label">Team Leader Phone</label>
                <input type="tel" name="tl-phone" id="tl-phone" placeholder="Enter Team Leader Phone" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="tl-gender" class="form-label">Team Leader Gender</label>
                <select name="tl-gender" id="tl-gender" class="form-control" required>
                    <option value="">Select Gender</option>
                    <option value="MALE">Male</option>
                    <option value="FEMALE">Female</option>
                    <option value="OTHER">Other</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="tl-dept" class="form-label">Team Leader Department</label>
                <input type="text" name="tl-dept" id="tl-dept" placeholder="Enter Team Leader Department" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="tl-year" class="form-label">Team Leader Year</label>
                <select name="tl-year" id="tl-year" class="form-control" required>
                    <option value="">Select Year</option>
                    <option value="I">I</option>
                    <option value="II">II</option>
                    <option value="III">III</option>
                    <option value="IV">IV</option>
                    <option value="V">V</option>
                </select>
            </div>

            <div id="team-members" class="my-3"></div>

            <button class="btn btn-warning my-3 d-block w-auto ms-auto" onclick="addNewMember()" type="button">Add Team Member</button>

            <div class="mb-3">
                <label for="college" class="form-label">College</label>
                <input type="text" name="college" id="college" placeholder="Enter College Name" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="t_title" class="form-label">Title</label>
                <input type="text" name="t_title" id="t_title" placeholder="Enter Project Title" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="abstract-file">Abstract</label>
                <input type="file" name="abstract-file" id="abstract-file" class="form-control" accept="application/pdf" required>
                <span class="small text-danger">Doc Type Supported: PDF. Max File Size: 2MB</span>
            </div>

            <div class="btn-group">
                <button class="btn btn-success" name="register" disabled>Submit</button>
            </div>
        </form>
    </div>

    <script>
        // Add new member
        function addNewMember() {
            var teamMemberCount = $("#team-members").children().length;

            var member = `<div class="team-member">
                    <h3>Team Member ${teamMemberCount + 1}</h3>
                    <div class="mb-3">
                        <label for="tm-name" class="form-label">Team Member ${teamMemberCount + 1} Name</label>
                        <input type="text" name="tm-name-${teamMemberCount}" id="tm-name" placeholder="Enter Team Member Name" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="tm-phone" class="form-label">Team Member ${teamMemberCount + 1} Phone</label>
                        <input type="tel" name="tm-phone-${teamMemberCount}" id="tm-phone" placeholder="Enter Team Member Phone" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="tm-gender" class="form-label">Team Member ${teamMemberCount + 1} Gender</label>
                        <select name="tm-gender-${teamMemberCount}" id="tm-gender" class="form-control" required>
                            <option value="">Select Gender</option>
                            <option value="MALE">Male</option>
                            <option value="FEMALE">Female</option>
                            <option value="OTHER">Other</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="tm-dept" class="form-label">Team Member ${teamMemberCount + 1} Department</label>
                        <input type="text" name="tm-dept-${teamMemberCount}" id="tm-dept" placeholder="Enter Team Member Department" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="tm-year" class="form-label">Team Member ${teamMemberCount + 1} Year</label>
                        <select name="tm-year-${teamMemberCount}" id="tm-year" class="form-control" required>
                            <option value="">Select Year</option>
                            <option value="I">I</option>
                            <option value="II">II</option>
                            <option value="III">III</option>
                            <option value="IV">IV</option>
                            <option value="V">V</option>
                        </select>
                    </div>
                </div>`;

            if ($("#team-members").children().length < 4) {
                $("#team-members").append(member);
            } else {
                $("body").append(`<span class="message error">You can add upto 3 members</span>`);
            }

        }

        // Send OTP and add field to verify
        function sendOTP() {
            var email = $("#tl-email").val();
            if (email) {

                // Show Loader
                showLoader();

                $.ajax({
                    url: "./backend/send-otp.php",
                    type: "POST",
                    data: {
                        email: email,
                        sendOTP: true
                    },
                    success: function(data) {
                        if (data == "success") {

                            // Append OTP field
                            var otpField = `<div class="input-group mt-3">
                                <input type="text" name="otp" id="otp" placeholder="Enter OTP" class="form-control" required>
                                <button class="btn btn-outline-primary" type="button" onclick="verifyOTP()">Verify</button>
                            </div>
                            <button class="btn d-block w-auto ms-auto rounded" onclick="resendOTP()" type="button">Resend OTP</button>
                            `;

                            $("#tl-email").attr("readonly", true);

                            // Change button text to change email and assign change email function
                            $("#tl-email").parent().find("button").text("Change Email");
                            $("#tl-email").parent().find("button").attr("onclick", "changeEmail()");

                            // Remove OTP field if already exists
                            $("#otp-field").html("");

                            // Add OTP field
                            $("#otp-field").html(otpField);

                            $("body").append(`<span class="message success">OTP sent to your mail id.</span>`);
                        } else if (data == "exists") {
                            $("body").append(`<span class="message error">Email already exists</span>`);
                        } else {
                            $("body").append(`<span class="message error">Failed to send OTP</span>`);
                        }

                        // Hide Loader
                        hideLoader();
                    }
                });
            } else if ($("#emailStatus").val() == "true") {
                $("body").append(`<span class="message error">Email already verified</span>`);
            } else {
                $("body").append(`<span class="message error">Enter Email to send OTP</span>`);
                $("#tl-email").focus();
            }
        }

        function resendOTP() {
            var email = $("#tl-email").val();
            if (email) {

                // Show Loader
                showLoader();

                $.ajax({
                    url: "./backend/send-otp.php",
                    type: "POST",
                    data: {
                        email: email,
                        resendOTP: true
                    },
                    success: function(data) {
                        if (data == "success") {
                            $("body").append(`<span class="message success">OTP sent to your mail id.</span>`);

                            // reset entered OTP
                            $("#otp").val("");
                        } else {
                            $("body").append(`<span class="message error">Failed to resend OTP</span>`);
                        }
                    }
                });
            } else {
                $("body").append(`<span class="message error">Enter Email to resend OTP</span>`);
                $("#tl-email").focus();
            }

            // Hide Loader
            hideLoader();

        }

        // Verify OTP
        function verifyOTP() {
            var otp = $("#otp").val();
            var email = $("#tl-email").val();
            if (otp) {

                // Show Loader
                showLoader();

                $.ajax({
                    url: "./backend/send-otp.php",
                    type: "POST",
                    data: {
                        otp: otp,
                        email: email,
                        verifyOTP: true
                    },
                    success: function(data) {
                        if (data == "success") {
                            $("body").append(`<span class="message success">Email Verified Successfully.</span>`);

                            $("#otp-field").html("");
                            $("#tl-email").attr("readonly", true);

                            // Change Email status to true
                            $("#emailStatus").val("true");

                            // Change submit button to enabled
                            $("button[name='register']").attr("disabled", false);

                            $("#tl-email").parent().find("button").text("Email Verified");
                            $("#tl-email").parent().find("button").attr("disabled", true);
                        } else if (data == "exists") {
                            $("body").append(`<span class="message error">Email already exists</span>`);
                        } else {
                            $("body").append(`<span class="message error">Invalid OTP</span>`);
                        }

                        // Hide Loader
                        hideLoader();
                    }
                });
            } else {
                $("body").append(`<span class="message error">Enter OTP to verify</span>`);
                $("#otp").focus();
            }
        }

        // Change email and remove OTP field
        function changeEmail() {
            $("#tl-email").attr("readonly", false);
            $("#tl-email").parent().find("button").text("Verify");
            $("#tl-email").parent().find("button").attr("onclick", "sendOTP");
            $("#otp-field").html("");
        }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>

</html>