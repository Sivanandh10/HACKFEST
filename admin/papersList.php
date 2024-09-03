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
        <title>Papers List | HACKFEST - 24</title>
        <?php include "./includes.php"; ?>
    </head>

    <body>
        <?php include "./error.php"; ?>


        <?php include "./header.php"; ?>

        <!-- Papers -->
        <div class="container">
            <div class="header">
                <h2>Paper List</h2>
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
                        <th>Paper Title</th>
                        <th>Status</th>
                        <th>Send Mail</th>
                        <th>Action</th>
                    </tr>
                    <?php
                    $sql = "SELECT * FROM papers";
                    $result = $conn->query($sql);
                    if ($result->num_rows > 0) {
                        $i = 1;
                        while ($row = $result->fetch_assoc()) {
                    ?>
                            <tr id="row-<?php echo $row['UID']; ?>">
                                <td><?php echo $i; ?></td>
                                <td><?php echo $row['UID']; ?></td>
                                <td><?php echo $row['PAPER_TITLE']; ?></td>

                                <td style="font-weight: 700;">
                                    <?php echo $row['STATUS']; ?>
                                </td>
                                <td>
                                    <button title="Send mail" onclick="paperOperation( 'send mail', '<?php echo $row['UID']; ?>')" style="background-color: var(--success);">
                                        Send Mail
                                    </button>
                                </td>
                                <td>
                                    <button title="View" onclick="openFile('<?php echo $row['FILE_PATH']; ?>', '<?php echo $row['UID']; ?>')">
                                        <i class="fa-solid fa-eye"></i>
                                    </button>
                                    <button title="Download" onclick="paperOperation( 'download', '<?php echo $row['UID']; ?>')">
                                        <i class="fa-solid fa-download"></i>
                                    </button>
                                    <button title="Select" onclick="paperOperation( 'select', '<?php echo $row['UID']; ?>')">
                                        <i class="fa-solid fa-check"></i>
                                    </button>
                                    <button title="Reject" onclick="paperOperation( 'reject', '<?php echo $row['UID']; ?>')">
                                        <i class="fa fa-ban"></i>
                                    </button>
                                    <button title="Delete" onclick="paperOperation( 'delete', '<?php echo $row['UID']; ?>')">
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
                            <td colspan="6">No Papers Found</td>
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
                    "REJECTED": "var(--danger)"
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

            function openFile(filePath, uid) {
                var fileType = filePath.split('.').pop().toLowerCase();

                if (fileType == 'pdf') {
                    filePath = filePath.replace('./', '../');
                } else if (fileType == 'doc' || fileType == 'docx') {
                    filePath = filePath.replace('./', window.location.origin + '/hackfest/');

                    filePath = 'https://docs.google.com/gview?url=' + filePath + '&embedded=true';
                }

                $(".fileViewerContainer").css('display', 'flex');
                $("#fileViewer").attr('src', filePath);

                paperOperation('view', uid);
            }

            function paperOperation(operation, uid) {
                if (operation == 'view')
                    var confirmation = true;
                else
                    var confirmation = confirm("Are you sure you want to " + operation + " this paper?");

                if (confirmation) {
                    $.ajax({
                        type: "POST",
                        url: "./papersOperation.php",
                        data: {
                            operation: operation,
                            uid: uid,
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

                                    $("body").append(`<a href='${filePath}' download='paper_${uid}' id='dn_${uid}' style='visibility: hidden'></a>`);

                                    $(`#dn_${uid}`)[0].click();
                                    $(`#dn_${uid}`).remove();
                                }

                                if (operation == 'delete') {
                                    $(`#row-${uid}`).remove();
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
