<?php

if(isset($_SERVER['HTTP_X_REQUESTED_WITH'])) {
    include("includes/dbconfig.php");
    include("includes/config.php");
    include("includes/classes/Artist.php");
    include("includes/classes/Album.php");
    include("includes/classes/Song.php");
    include("includes/classes/User.php");
    include("includes/classes/Playlist.php");
} else {
    include("includes/header.php");
    include("includes/footer.php");

    $url = $_SERVER['REQUEST_URI'];
    echo "<script>open_page('$url');</script>";
    exit();
}

?>