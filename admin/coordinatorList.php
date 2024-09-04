<?php
include "../config.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Coordinator List | HackFest - 24 | Erode Sengunthar Engineering College</title>
    <?php include "./includes.php"; ?>
</head>

<body>

    <?php include "./error.php"; ?>


    <?php include "./header.php"; ?>

    <div class="container">
        <div class="header">
            <h2>Coordinator List</h2>
            <button onclick="openForm()">Add Member</button>
        </div>
        <div class="table">
            <h3>Organizing Committee</h3>
            <table>
                <tr>
                    <th>S.NO</th>
                    <th>NAME</th>
                    <th>DESIGNATION</th>
                    <th>ROLE</th>
                    <th>ACTION</th>
                </tr>
                <?php
                $sql = "SELECT * FROM coordinators WHERE COMMITTEE='ORGANIZING'";
                $result = mysqli_query($conn, $sql);
                $i = 0;
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        $i++;
                ?>
                        <tr>
                            <td><?php echo $i; ?></td>
                            <td><?php echo $row['NAME']; ?></td>
                            <td><?php echo $row['DESIGNATION']; ?></td>
                            <td><?php echo $row['ROLE']; ?></td>
                            <td>
                                <button title="Delete" onclick="coordinatorDelete('<?php echo $row['ID']; ?>')">
                                    <i class="fa fa-trash" aria-hidden="true"></i>
                                </button>
                            </td>
                        </tr>

                <?php  }
                } else {
                    echo "<tr?> <td colspan='5'>No Coordinator Found</td> </tr>";
                } ?>
            </table>

            <br><br>
            <h3>Advisory Committee</h3>
            <table>
                <tr>
                    <th>S.NO</th>
                    <th>NAME</th>
                    <th>ORGANISATION</th>
                    <th>ACTION</th>
                </tr>
                <?php
                $sql = "SELECT * FROM coordinators WHERE COMMITTEE='ADVISORY'";
                $result = mysqli_query($conn, $sql);
                $i = 0;
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        $i++;
                ?>
                        <tr>
                            <td><?php echo $i; ?></td>
                            <td><?php echo $row['NAME']; ?></td>
                            <td><?php echo $row['DESIGNATION']; ?></td>
                            <td>
                                <button title="Delete" onclick="coordinatorDelete('<?php echo $row['ID']; ?>')">
                                    <i class="fa fa-trash" aria-hidden="true"></i>
                                </button>
                            </td>
                        </tr>

                <?php  }
                } else {
                    echo "<tr?> <td colspan='4'>No Coordinator Found</td> </tr>";
                } ?>
            </table>
        </div>
    </div>

    <!-- Committee Member Form -->
    <section class="committee-form">
        <form action="./coordinatorOperation.php" method="POST">
            <h2>Add Member</h2>

            <div class="input-group">
                <label for="committee">Committee: <span>*</span></label>
                <select name="committee" id="committee">
                    <option value="" selected disabled>Select Committee</option>
                    <option value="ORGANIZING">Organizing Committee</option>
                    <option value="ADVISORY">Advisory Committee</option>
                </select>
            </div>

            <div class="committee-group" id="ORGANIZING" style="display: none;">
                <div class="input-group">
                    <label for="name">Name: <span>*</span></label>
                    <input type="text" name="oname" id="name" placeholder="Enter Name" >
                </div>
                <div class="input-group">
                    <label for="designation">Designation: <span>*</span></label>
                    <input type="text" name="odesignation" id="designation" placeholder="Enter Designation" >
                </div>
                <div class="input-group">
                    <label for="role">Role: <span>*</span></label>
                    <input type="text" name="orole" id="role" placeholder="Enter Role" >
                </div>
                
            </div>
            
            <div class="committee-group" id="ADVISORY" style="display: none;">
                <div class="input-group">
                    <label for="name">Name: <span>*</span></label>
                    <input type="text" name="name" id="name" placeholder="Enter Name" >
                </div>
                <div class="input-group">
                    <label for="organization">Organization: <span>*</span></label>
                    <input type="text" name="organization" id="organization" placeholder="Enter Organization" >
                </div>
            </div>

            <div class="btn-group">
                <button type="submit" id="committee-btn" name="committee-btn">SUBMIT</button>
            </div>
        </form>
    </section>

    <script>
        // Open Committee Form
        function openForm() {
            $('.committee-form').css("display", "flex");
        }
        
        // Close Form
        $('.committee-form').click(function(event){
            if( event.target == this) {
                $('.committee-form').css("display", "none");
                $(".committee-form select").val("");
                $(".committee-form input").each(function(){
                    this.value = '';
                })
            }
        });

        // Change Committee
        $("#committee").change(function(){
            $(".committee-group").css("display", "none");
            var committee = $("#committee").val();

            $(`#${committee}`).css("display", "block");
            $(`#${committee}`).css("width", "100%");

            $("#committee-btn").attr("value", $("#committee").val());

            $(`#${committee} input`).attr("required", true);
            
            var notCommittee = committee == "ORGANISING" ? committee : "ADVISORY";
            $(`#${notCommittee} input`).attr("required", false);


        });

        function coordinatorDelete(id) {
            $.ajax({
                url: "./coordinatorOperation.php",
                type: "POST",
                data: {
                    "uid": id,
                    "operation" : "DELETE"
                },
                success: function(data) {
                    location.reload();
                }
            });
        }
    </script>

</body>

</html>