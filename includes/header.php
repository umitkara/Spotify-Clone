<?php

include("includes/dbconfig.php");
include("includes/config.php");
include("includes/classes/Artist.php");
include("includes/classes/Album.php");
include("includes/classes/Song.php");
include("includes/classes/User.php");
include("includes/classes/Playlist.php");

if(isset($_SESSION['user_id']))
{
    $user_id = $_SESSION['user_id'];
    echo "<script>var user_logged_in = '$user_id';</script>";
}
else {
    header("Location: register.php");
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Spotify Clone</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/fontawesome/css/all.css">
    <link rel="icon" href="assets/images/favicon.svg" type="image/svg+xml">
    <script src="assets/js/jquery.min.js"></script> 
    <script src="assets/js/main.js"></script>
</head>
<body>
    <div id="mainContainer">
        <div id="topContainer">
            <?php include("includes/navbar_container.php") ?>
            <div class="mainViewContainer">
                <div class="mainContent">