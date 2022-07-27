<?php 
    include("../../dbconfig.php");
    include("../../config.php");

    if(isset($_POST["playlist_id"]) && isset($_POST["song_id"]))
    {
        $playlist_id = $_POST["playlist_id"];
        $song_id = $_POST["song_id"];
        $remove_query = mysqli_query($connection, "DELETE FROM playlistsongs WHERE playlistID = '$playlist_id' AND songID = '$song_id'");
        return true;
    } else {
        echo "Error: Missing playlist_id or song_id";
    }
?>