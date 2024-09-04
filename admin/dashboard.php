<?php
session_start();
include "../config.php";

if (!isset($_SESSION['id']) || !isset($_SESSION['role'])) {
    header("Location: ./index.php");
    exit();
}

?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Admin Dashboard | HackFest - 24</title>
        <?php include "./includes.php"; ?>
    </head>

    <body>
        <?php include "./error.php"; ?>


        <?php include "./header.php"; ?>

        <!-- Analytics -->
        <div class="container">
            <div class="header">
                <h2>Admin Dashboard</h2>
            </div>
            <div class="table">
                <table>
                    <tr>
                        <th>Context</th>
                        <th>Count</th>
                    </tr>
                    <tr>
                        <td>Total Registrations</td>
                        <td>0</td>
                    </tr>
                    <tr>
                        <td>Total Ideas</td>
                        <td>0</td>
                    </tr>
                    <tr>
                        <td>Ideas Under Review</td>
                        <td>0</td>
                    </tr>
                    <tr>
                        <td>Ideas Accepted</td>
                        <td>0</td>
                    </tr>
                    <tr>
                        <td>Ideas Rejected</td>
                        <td>0</td>
                    </tr>
                    <tr>
                        <td>Total Payment Count</td>
                        <td>0</td>
                    </tr>
                    <tr>
                        <td>Payment Verified</td>
                        <td>0</td>
                    </tr>
                    <tr>
                        <td>Payment Pending</td>
                        <td>0</td>
                    </tr>
                </table>
            </div>
        </div>

        <script>
            $(document).ready(function() {
                $.ajax({
                    url: "./analyticsData.php",
                    type: "GET",
                    success: function(data) {
                        var response = JSON.parse(data);
                        $("table tr:nth-child(2) td:nth-child(2)").html(response.totalUser);
                        $("table tr:nth-child(3) td:nth-child(2)").html(response.totalIdeas);
                        $("table tr:nth-child(4) td:nth-child(2)").html(response.ideasUnderReview);
                        $("table tr:nth-child(5) td:nth-child(2)").html(response.ideasAccepted);
                        $("table tr:nth-child(6) td:nth-child(2)").html(response.ideasRejected);
                        $("table tr:nth-child(7) td:nth-child(2)").html(response.totalPayment);
                        $("table tr:nth-child(8) td:nth-child(2)").html(response.paymentVerified);
                        $("table tr:nth-child(9) td:nth-child(2)").html(response.paymentPending);
                    }
                });
            });
        </script>

    </body>

    </html>