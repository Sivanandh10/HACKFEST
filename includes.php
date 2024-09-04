<?php
$url = "http" . (isset($_SERVER["HTTPS"]) && $_SERVER["HTTPS"] === "on" ? "s" : "") . "://" . $_SERVER["HTTP_HOST"] . "/hackfest";
?>

<!-- Font Awesome CDN -->
<script src="https://kit.fontawesome.com/ef6be5e094.js" crossorigin="anonymous"></script>

<!-- JQuery CDN -->
<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>

<!-- CSS -->
<link rel="stylesheet" href="<?php echo $url; ?>/assets/css/new-style.css?<?php echo time();?>">
<link rel="stylesheet" href="<?php echo $url; ?>/assets/css/style.css?<?php echo time();?>">

<!-- TiTle Icon -->
<link rel="icon favicon" href="<?php echo $url; ?>/assets/img/logo.png">

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>