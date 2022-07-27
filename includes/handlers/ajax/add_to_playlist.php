<?php 
    include("../../dbconfig.php");
    include("../../config.php");

    if(isset($_POST["playlist_id"]) && isset($_POST["song_id"]))
    {
        $playlist_id = $_POST["playlist_id"];
        $song_id = $_POST["song_id"];
        $number_of_songs_query = mysqli_query($connection, "SELECT * FROM playlistsongs WHERE playlistID = '$playlist_id'");
        $song_order = mysqli_num_rows($number_of_songs_query) + 1;
        $insert_query = mysqli_query($connection, "INSERT INTO playlistsongs (playlistID, songID, playlistOrder) VALUES ('$playlist_id', '$song_id', '$song_order')");
        return true;
    } else {
        echo "Error: Missing playlist_id or song_id";
    }
?>