<?php

include("includes/dbconfig.php");
include("includes/config.php");
include("includes/classes/Artist.php");

if(isset($_SESSION['user_id']))
{
    $user_id = $_SESSION['user_id'];
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
</head>
<body>
    <div id="mainContainer">
        <div id="topContainer">
            <?php include("includes/navbar_container.php") ?>
            <div class="mainViewContainer">
                <div class="mainContent">