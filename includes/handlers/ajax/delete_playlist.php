<?php 
    include("../../dbconfig.php");
    include("../../config.php");

    if(isset($_POST["username"]) && isset($_POST["playlist_id"]))
    {
        // delete playlist
        $playlist_id = $_POST["playlist_id"];
        $username = $_POST["username"];
        $user_query = mysqli_query($connection, "SELECT id FROM users WHERE username = '$username'");
        $user_id = mysqli_fetch_assoc($user_query)['id'];
        $query = mysqli_query($connection, "DELETE FROM playlists WHERE id = '$playlist_id' AND owner = '$user_id'");
        echo 1;
    } else {
        echo -1;
    }
?>