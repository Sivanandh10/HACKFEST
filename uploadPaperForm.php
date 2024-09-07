<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload File | ICIT - 24 | Erode Sengunthar Engineering College</title>
    <?php include './includes.php'; ?>

    <style>
        footer {
            position: relative;
        }
    </style>
</head>
<body>
    <?php 
    include './nav.php'; 
    include './error.php';
    ?>

    <section class="form">
        <form method="POST" action="./backend/uploadPaper.php" enctype="multipart/form-data">
            <h2>UPLOAD ABSTRACT</h2>
            <div class="input-group">
                <label for="t_id">Team ID: <span>*</span></label>
                <input type="text" name="t_id" id="t_id" placeholder="Enter Team ID" required/>
            </div>
            <div class="input-group">
                <label for="abstract">Upload Abstract: <span>*</span></label>
                <input type="file" name="abstract" id="abstract" accept="application/pdf" required />

            </div>
            <div class="btn-group">
                <button type="submit" name="upload">Upload File</button>
            </div>
        </form>
    </section>

    <?php include './footer.php'; ?>

    <script>
        $("#abstract").change(function() {
            var file = this.files[0];
            var fileType = file.type;
            var fileSize = file.size;
            var validExtensions = ['application/pdf'];
            var maxFileSize = 5242880;

            if (validExtensions.indexOf(fileType) == -1) {
                alert('Invalid File Type');
                this.value = '';
            } else if (fileSize > maxFileSize) {
                alert('File Size Exceeded');
                this.value = '';
            }
        });
    </script>
</body>
</html>