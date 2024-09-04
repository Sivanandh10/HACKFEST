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
                        <th>Team ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Action</th>
                    </tr>
                    <?php
                    $sql = "SELECT * FROM registration ORDER BY T_ID";
                    $result = $conn->query($sql);
                    if ($result->num_rows > 0) {
                        $i = 1;
                        while ($row = $result->fetch_assoc()) {
                    ?>
                            <tr>
                                <td><?php echo $i; ?></td>
                                <td><?php echo $row['T_ID']; ?></td>
                                <td><?php echo $row['NAME']; ?></td>
                                <td><?php echo $row['EMAIL']; ?></td>
                                <td><?php echo $row['MOBILE']; ?></td>
                                <td>
                                    <!-- View User Details -->
                                    <button onclick="fetchUser('<?php echo $row['ID']; ?>')">
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

                        var teamMembers = "";
                        if (data.user.teamMembers.length > 0) {
                            teamMembers = "<div class='content-row'><h3>Team Members</h3><ul>";
                            data.user.teamMembers.forEach(member => {
                                teamMembers += `<li>
                                        ${member.NAME} - ${member.EMAIL} &nbsp;
                                        <button onclick="fetchUser('${member.ID}')"><i class="fa-solid fa-eye"></i></button>
                                    </li>`;
                            });
                            teamMembers += "</ul></div>";
                        }

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
                                                <h3>Team ID</h3>
                                                <p>${data.user.T_ID}</p>
                                            </div>
                                            <div class="content-row">
                                                <h3>Name</h3>
                                                <p>${data.user.NAME}</p>
                                            </div>
                                            <div class="content-row">
                                                <h3>Gender</h3>
                                                <p>${data.user.GENDER}</p>
                                            </div>
                                            <div class="content-row">
                                                <h3>Email</h3>
                                                <p>${data.user.EMAIL}</p>
                                            </div>
                                            <div class="content-row">
                                                <h3>Phone</h3>
                                                <p>${data.user.MOBILE}</p>
                                            </div>
                                            <div class="content-row">
                                                <h3>Branch</h3>
                                                <p>${ data.user.YEAR + " - " + data.user.DEPARTMENT}</p>
                                            </div>
                                            <div class="content-row">
                                                <h3>College</h3>
                                                <p>${data.user.COLLEGE}</p>
                                            </div>
                                            <div class="content-row">
                                                <h3>Team Title</h3>
                                                <p>${data.user.team.TITLE}</p>
                                            </div>
                                            <div class="content-row">
                                                <h3>Status</h3>
                                                <p>${data.user.team.STATUS}</p>
                                            </div>
                                            <div class="content-row">
                                                <h3>Abstract</h3>
                                                <p><a href="../assets/uploads/${data.user.T_ID}.pdf" target="_blank">View</a></p>
                                            </div>
                                            ${teamMembers}
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
