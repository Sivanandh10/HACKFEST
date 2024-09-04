<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Verification - ICIT - 24 | Erode Sengunthar Engineering College</title>
    <?php include "./includes.php"; ?>
</head>
<body>
    <?php 
    
    include "./header.php"; 
    include "./error.php";
    ?>

    <section class="form">
        <div class="illustration">
            <img src="./img/transaction.png" alt="Transaction Illutration">
        </div>
        <form action="./payment.php" method="POST" enctype="multipart/form-data">
            <h2>Payment Verification</h2>
            <div class="input-group">
                <label for="userid">User ID:</label>
                <input type="text" name="userid" id="userid" placeholder="Enter User ID" required>
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
                <input type="file" name="payment-screenshot" id="payment-screenshot" placeholder="Upload Payment Screenshot" required>
            </div>
            <div class="btn-group">
                <button type="submit" name="payment">Submit</button>
            </div>
        </form>
    </section>
    <?php include "./footer.php"; ?>
</body>
</html>