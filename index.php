<?php

include("includes/dbconfig.php");
include("includes/config.php");


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
    <title>Spotify</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/fontawesome/css/all.css">
</head>
<body>
    <div id="nowPlaying" class="nowPlayingContainer">
        <div id="nowPlayingBar" class="nowPlayingBar">
            <div class="nowPlayingLeft"></div>
            <div class="nowPlayingCenter">
                <div class="content playerControls">
                    <div class="buttons">
                        <button class="controlButton shuffle" title="Shuffle">
                            <i class="fa-regular fa-shuffle"></i>
                        </button>
                        <button class="controlButton previous" title="Previous">
                            <i class="fa-regular fa-step-backward"></i>
                        </button>
                        <button class="controlButton play" title="Play">
                            <i class="fa-regular fa-circle-play"></i>
                        </button>
                        <button class="controlButton pause" title="Pause" style="display: none;">
                            <i class="fa-regular fa-pause-circle"></i>
                        </button>
                        <button class="controlButton next" title="Next">
                            <i class="fa-regular fa-step-forward"></i>
                        </button>
                        <button class="controlButton repeat" title="Repeat">
                            <i class="fa-regular fa-repeat"></i>
                        </button>
                    </div>
                    <div class="playbackBar">
                        <span class="progressTime current">0:00</span>
                        <div class="progressBar">
                            <div class="progressBarBg">
                                <div class="progress"></div>
                            </div>
                        </div>
                        <span class="progressTime remaining">0:00</span>
                    </div>
                </div>
            </div>
            <div class="nowPlayingRight"></div>
        </div>
    </div>
</body>
</html>