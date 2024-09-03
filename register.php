<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="./assets/img/logo.png">
    <title>Register - HackFest | Erode Sengunthar Engineering College</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <link rel="stylesheet"href="./assets/css/nav-style.css">
</head>

<body>

    <?php include "./nav.php"; ?>

    <div class="container d-flex justify-content-center mt-3">
        <form action="./backend/register.php" method="post" class="bg-white" style="width: min(500px, 90%);">
            <h2>Registration</h2>
            <div class="mb-3">
                <label for="team-name" class="form-label">Team Name</label>
                <input type="text" name="teamname" id="team-name" placeholder="Enter your team name"
                    class="form-control" required>
            </div>
        </form>
    </div>

    <script>

        $("#team-name").on("keyup", function () {
            $.ajax({
                url: './backend/register.php',
                method: 'post',
                data: {
                    op: 'check',
                    team_name: $(this).val(),
                },
                success: function (data) {
                    data = JSON.parse(data);

                    if (data.status == 'success') {
                        var message = ``;
                    }
                }
            })
        })

    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>

</html>