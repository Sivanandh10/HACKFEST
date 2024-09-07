<?php
$url = "http" . (isset($_SERVER["HTTPS"]) && $_SERVER["HTTPS"] === "on" ? "s" : "") . "://" . $_SERVER["HTTP_HOST"] . "/hackfest";
?>

<!-- Font Awesome CDN -->
<script src="https://kit.fontawesome.com/ef6be5e094.js" crossorigin="anonymous"></script>

<!-- JQuery CDN -->
<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>

<!-- CSS -->
<link rel="stylesheet" href="<?php echo $url; ?>/admin/css/style.css?<?php echo time();?>">

<!-- TiTle Icon -->
<link rel="icon favicon" href="<?php echo $url; ?>/assets/img/logo.png">