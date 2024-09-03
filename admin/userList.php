<?php
session_start();
include "../config.php";

if (isset($_SESSION['id']) && isset($_SESSION['role'])) {


?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Participant List | HACKFEST - 24</title>
        <?php include "./includes.php"; ?>
    </head>

    <body>
        <?php include "./error.php"; ?>


        <?php include "./header.php"; ?>

        <!-- User List -->
        <div class="container">
            <div class="header">
                <h2>Participant List</h2>
            </div>

            <div class="search-form">
                <div class="input-group">
                    <input type="text" id="search-field" placeholder="Enter User ID">
                </div>
            </div>

            <div class="table">
                <table>
                    <tr>
                        <th>S.NO</th>
                        <th>User ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Paper</th>
                        <th>Action</th>
                    </tr>
                    <?php
                    $sql = "SELECT * FROM users";
                    $result = $conn->query($sql);
                    if ($result->num_rows > 0) {
                        $i = 1;
                        while ($row = $result->fetch_assoc()) {
                    ?>
                            <tr>
                                <td><?php echo $i; ?></td>
                                <td><?php echo $row['UID']; ?></td>
                                <td><?php echo $row['NAME']; ?></td>
                                <td><?php echo $row['EMAIL']; ?></td>
                                <td><?php echo $row['PHONE']; ?></td>
                                <td>
                                    <?php
                                    $sql1 = "SELECT * FROM papers WHERE UID='{$row['UID']}'";
                                    $result1 = $conn->query($sql1);
                                    if ($result1->num_rows > 0) {
                                        while ($row1 = $result1->fetch_assoc()) {
                                            echo $row1['PAPER_TITLE'];
                                        }
                                    } else {
                                        echo "No Paper Submitted";
                                    }
                                    ?>
                                </td>
                                <td>
                                    <!-- View User Details -->
                                    <button onclick="fetchUser('<?php echo $row['UID']; ?>')">
                                        <i class="fa-solid fa-eye"></i>
                                    </button>
                                </td>
                            </tr>
                    <?php
                            $i++;
                        }
                    }
                    ?>

                </table>
            </div>
        </div>
        <div id="modal"></div>
        <script>
            // View User Details AJAX
            function fetchUser(id) {
                $.ajax({
                    url: "./userOperation.php",
                    type: "POST",
                    data: {
                        id: id,
                        fetchUser: 1
                    },

                    success: function(data) {
                        data = JSON.parse(data);
                        if (data.status == "error") {
                            $("body").prepend(`<span class='message error'>${data.message}</span>`);
                            return;
                        }

                        data = data.data;
                        //data  JSON format to HTML
                        var user = `
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h2>User Details</h2>
                                        <span onclick='closeModal()'>
                                            <i class="fa-solid fa-xmark"></i>
                                        </span>
                                    </div>
                                    <div class="modal-body">
                                        <div class="user-details">
                                            <div class="content-row">
                                                <h3>Name</h3>
                                                <p>${data.user.NAME}</p>
                                            </div>
                                            <div class="content-row">
                                                <h3>Email</h3>
                                                <p>${data.user.EMAIL}</p>
                                            </div>
                                            <div class="content-row">
                                                <h3>Phone</h3>
                                                <p>${data.user.PHONE}</p>
                                            </div>
                                            <div class="content-row">
                                                <h3>Designation</h3>
                                                <p>${data.user.DESIGNATION}</p>
                                            </div>
                                            <div class="content-row">
                                                <h3>Organisation</h3>
                                                <p>${data.user.ORGANISATION}</p>
                                            </div>
                                            <div class="content-row">
                                                <h3>Address</h3>
                                                <p>${data.user.ADDRESS}</p>
                                            </div>
                                            <div class="content-row">
                                                <h3>Paper Title</h3>
                                                <p>${data.paper.PAPER_TITLE}</p>
                                                <a href=".${data.paper.FILE_PATH}" download>
                                                    <button>
                                                        <i class="fa-solid fa-download"></i>
                                                        Download
                                                    </button>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    `;

                        $("#modal").html(user);
                        $("#modal").css("display", "flex");
                    }
                });
            }

            function closeModal() {
                $("#modal").html("");
                $("#modal").css("display", "none");
            }

            // Close modal if the user clicks outside the modal content
            window.onclick = function(event) {
                if (event.target == modal) {
                    $("#modal").html("");
                    $("#modal").css("display", "none");
                }
            }

            // Search User
            $("#search-field").on("keyup", function() {
                var value = $(this).val().toLowerCase();
                $("table tr:not(:first-child)").filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });
        </script>
    </body>

    </html>
<?php } else {
    header("Location: ./index.php");
}
