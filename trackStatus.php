<!DOCTYPE html>
<html lang="en">

<head>
    <link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Lato&display=swap" rel="stylesheet">
    <title>Track - HackFest 2K24 - An National Level Hackathon | Erode Sengunthar Engineering College   </title>
    <?php include "./includes.php"; ?>
</head>

<body>
    <?php include "nav.php" ?>
    <section class="track">
        <form method="post" id="searchForm">
            <div class="input-group">
                <label for="search">User ID:</label>
                <div class="ip-grp">

                    <input type="text" name="search" id="search" placeholder="Enter Your User ID">
                    <button>
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </button>
                </div>
            </div>
        </form>

        <div class="track-card" style="display: none;">
        </div>
    </section>

    <script>
        $("#searchForm").submit((ev) => {
            ev.preventDefault();

            var userID = $("#search").val();
            if (userID == "") {
                document.append("<span class='message error'>Please enter a valid User ID</span>");
                return;
            }

            const icons = {
                "UPLOADED": {
                    "icon": "fa-regular fa-clock",
                    "color": "var(--secondary)"
                },
                "UNDER REVIEW": {
                    "icon": "fa-regular fa-eye",
                    "color": "var(--warning)"
                },
                "ACCEPTED": {
                    "icon": "fa-solid fa-check",
                    "color": "var(--success)"
                },
                "REJECTED": {
                    "icon": "fa-solid fa-times",
                    "color": "var(--danger)"
                }
            };

            $.ajax({
                url: "trackPaper.php",
                method: "POST",
                data: {
                    userID: userID
                },
                success: (data) => {
                    if (data == "error") {
                        document.append(`<span class='message error'>No data found for the given User ID</span>`);
                        return;
                    }

                    console.log(data)
                    var res = JSON.parse(data);
                    var trackCard = `<div class="track-icon" style="--clr: ${icons[res.STATUS].color}">
                                        <i class="${icons[res.STATUS].icon}"></i>
                                    </div>
                                    <div class="track-content">
                                        <h2>${res.NAME}</h2>
                                        <p>${res.PAPER_TITLE}</p>
                                        <span>Status: <span style="--clr: ${icons[res.STATUS].color}">${res.STATUS}</span></span>
                                    </div>`;
                    $(".track-card").html(trackCard);
                    $(".track-card").show();
                }
            });
        });
    </script>
    <?php include "./footer.php"; ?>
</body>

</html>