<?php 
    include("../../dbconfig.php");
    include("../../config.php");

    if(isset($_POST["username"]) && isset($_POST["playlist_name"]))
    {
        $playlist_name = $_POST["playlist_name"];
        $username = $_POST["username"];
        $user_query = mysqli_query($connection, "SELECT id FROM users WHERE username = '$username'");
        $user_id = mysqli_fetch_assoc($user_query)['id'];
        $date = date("Y-m-d H:i:s");
        
        $query = mysqli_query($connection, "INSERT INTO playlists VALUES (NULL, '$playlist_name', '$user_id', '$date')");
    } else {
        echo "Error";
    }
?>