<?php
include("../../../includes/dbconfig.php");
include("../../../includes/config.php");

if(isset($_POST['song_id'])) {
    $song_id = $_POST['song_id'];
    // update play count
    $query = mysqli_query($connection, "UPDATE songs SET plays=plays+1 WHERE id='$song_id'");
}