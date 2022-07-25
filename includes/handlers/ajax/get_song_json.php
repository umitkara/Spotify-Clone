<?php

include("../../../includes/dbconfig.php");
include("../../../includes/config.php");

if(isset($_POST['song_id'])) {
    $song_id = $_POST['song_id'];
    $query = mysqli_query($connection, "SELECT * FROM songs WHERE id='$song_id'");
    $result_array = mysqli_fetch_array($query);
    echo json_encode($result_array);
}

?>