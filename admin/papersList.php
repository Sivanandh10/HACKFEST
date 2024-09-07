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
        <title>Teams List | HACKFEST - 24</title>
        <?php include "./includes.php"; ?>
    </head>

    <body>
        <?php include "./error.php"; ?>


        <?php include "./header.php"; ?>

        <!-- Teams -->
        <div class="container">
            <div class="header">
                <h2>Team List</h2>
            </div>

            <!-- Search Field -->
            <div class="search-form">
                <div class="input-group">
                    <input type="text" id="search-field" placeholder="Enter User ID">
                </div>
                <div class="input-group">
                    <select id="status">
                        <option value="all">All</option>
                        <option value="UPLOADED">UPLOADED</option>
                        <option value="UNDER REVIEW">UNDER REVIEW</option>
                        <option value="ACCEPTED">ACCEPTED</option>
                        <option value="REJECTED">REJECTED</option>
                    </select>
                </div>
            </div>

            <div class="table">
                <table>
                    <tr>
                        <th>S.NO</th>
                        <th>Participant ID</th>
                        <th>Team Title</th>
                        <th>Status</th>
                        <th>Send Mail</th>
                        <th>Action</th>
                    </tr>
                    <?php
                    $sql = "SELECT * FROM teams";
                    $result = mysqli_query($conn, $sql);
                    if ($result->num_rows > 0) {
                        $i = 1;
                        while ($row = $result->fetch_assoc()) {
                            $class = ($row['STATUS'] == 'REJECTED') ? 'rejected' : (($row['STATUS'] == 'DELETED') ? 'deleted' : '');
                    ?>
                            <tr id="row-<?php echo $row['T_ID']; ?>" class="<?php echo $class; ?>">
                                <td><?php echo $i; ?></td>
                                <td><?php echo $row['T_ID']; ?></td>
                                <td><?php echo $row['TITLE']; ?></td>

                                <td style="font-weight: 700;">
                                    <?php echo $row['STATUS']; ?>
                                </td>
                                <td>
                                    <button title="Send mail" onclick="teamOperation( 'send mail', '<?php echo $row['T_ID']; ?>')" style="background-color: var(--success);">
                                        Send Mail
                                    </button>
                                </td>
                                <td>
                                    <button title="View" onclick="openFile('../assets/uploads/<?php echo $row['T_ID']; ?>.pdf', '<?php echo $row['T_ID']; ?>')">
                                        <i class="fa-solid fa-eye"></i>
                                    </button>
                                    <button title="Download" onclick="teamOperation( 'download', '<?php echo $row['T_ID']; ?>')">
                                        <i class="fa-solid fa-download"></i>
                                    </button>
                                    <button title="Select" onclick="teamOperation( 'select', '<?php echo $row['T_ID']; ?>')">
                                        <i class="fa-solid fa-check"></i>
                                    </button>
                                    <button title="Reject" onclick="teamOperation( 'reject', '<?php echo $row['T_ID']; ?>')">
                                        <i class="fa fa-ban"></i>
                                    </button>
                                    <button title="Delete" onclick="teamOperation( 'delete', '<?php echo $row['T_ID']; ?>')">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                        <?php
                            $i++;
                        }
                    } else {
                        ?>
                        <tr>
                            <td colspan="6">No Teams Found</td>
                        </tr>
                    <?php
                    }
                    ?>
                </table>
            </div>
        </div>

        <div class="fileViewerContainer">
            <iframe src="" id="fileViewer">

            </iframe>
        </div>

        <script>
            $(document).ready(function() {
                // Change color of status column
                var colors = {
                    "UPLOADED": "var(--secondary)",
                    "UNDER REVIEW": "var(--warning)",
                    "ACCEPTED": "var(--success)",
                    "REJECTED": "var(--danger)",
                    "DELETED": "#808080"
                }

                $("td:contains('UPLOADED')").css('color', colors['UPLOADED']);
                $("td:contains('UNDER REVIEW')").css('color', colors['UNDER REVIEW']);
                $("td:contains('ACCEPTED')").css('color', colors['ACCEPTED']);
                $("td:contains('REJECTED')").css('color', colors['REJECTED']);
            });

            $(".fileViewerContainer").click(function(event) {
                if (event.target == this) {
                    $(".fileViewerContainer").css('display', 'none');
                    $("#fileViewer").attr('src', '');
                }
            });

            function openFile(filePath, t_id) {
                var fileType = filePath.split('.').pop().toLowerCase();

                $(".fileViewerContainer").css('display', 'flex');
                $("#fileViewer").attr('src', filePath);

                teamOperation('view', t_id);
            }

            function teamOperation(operation, t_id) {
                if (operation == 'view')
                    var confirmation = true;
                else
                    var confirmation = confirm("Are you sure you want to " + operation + " this team?");

                if (confirmation) {
                    $.ajax({
                        type: "POST",
                        url: "./papersOperation.php",
                        data: {
                            operation: operation,
                            t_id: t_id,
                            performOperation: 1
                        },
                        success: function(response) {
                            console.log()
                            response = JSON.parse(response);

                            if (response.status == 'success') {
                                $("body").append(`<span class='message success'>${response.message}</span>`)

                                if (operation == 'download') {
                                    filePath = response.file;
                                    filePath.replace('./', '../')

                                    $("body").append(`<a href='${filePath}' download='team_${t_id}' id='dn_${t_id}' style='visibility: hidden'></a>`);

                                    $(`#dn_${t_id}`)[0].click();
                                    $(`#dn_${t_id}`).remove();
                                }

                                if (operation == 'delete') {
                                    $(`#row-${t_id}`).addClass('deleted');
                                }

                                // Update status in table
                                if (response.team_status) {
                                    $(`#row-${t_id} td:nth-child(4)`).text(response.team_status);
                                    $(`#row-${t_id} td:nth-child(4)`).css('color', colors[response.team_status]);

                                    if (response.team_status == 'REJECTED') {
                                        $(`#row-${t_id}`).addClass('rejected');
                                    }

                                    if (response.team_status == 'ACCEPTED') {
                                        $(`#row-${t_id}`).removeClass('rejected');
                                    }

                                    if (response.team_status == 'DELETED') {
                                        $(`#row-${t_id}`).addClass('deleted');
                                    }
                                }

                            } else {
                                $("body").append(`<span class='message error'>${response.message}</span>`);
                            }
                        }
                    });
                }
            }

            $("#search-field").on('keyup', function() {
                var value = $(this).val().toLowerCase();
                $("table tr:not(:first-child)").filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });

            $("#status").on('change', function() {
                var value = $(this).val().toLowerCase();
                $("table tr:not(:first-child)").filter(function() {
                    if (value == 'all') {
                        $(this).toggle(true);
                    } else {
                        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                    }
                });
            });
        </script>

    </body>

    </html>
<?php } else {
    header("Location: ./index.php");
}
