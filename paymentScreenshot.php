<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Verification - ICIT - 24 | Erode Sengunthar Engineering College</title>
    <?php include "./includes.php"; ?>

    <style>
        footer {
            position: relative;
        }
    </style>
</head>
<body>
    <?php 
    include "./nav.php"; 

    include "./error.php";
    ?>

    <section class="form">
        <form action="./payment.php" method="POST" enctype="multipart/form-data">
            <h2>Payment Verification</h2>
            <div class="input-group">
                <label for="userid">Team ID:</label>
                <input type="text" name="teamID" id="teamID" placeholder="Enter Team ID" required>
            </div>
            <div class="input-group">
                <label for="payment-date">Payment Date:</label>
                <input type="date" name="payment-date" id="payment-date" placeholder="Enter Payment Date" required>
            </div>
            <div class="input-group">
                <label for="transaction-id">Transaction ID:</label>
                <input type="text" name="transaction-id" id="transaction-id" placeholder="Enter Transaction ID" required>
            </div>
            <div class="input-group">
                <label for="payment-screenshot">Payment Screenshot:</label>
                <input type="file" name="payment-screenshot" id="payment-screenshot" placeholder="Upload Payment Screenshot" accept="image/*" required>
            </div>
            <div class="btn-group">
                <button type="submit" name="payment">Submit</button>
            </div>
        </form>
    </section>

    <?php include "./footer.php"; ?>
</body>
</html>