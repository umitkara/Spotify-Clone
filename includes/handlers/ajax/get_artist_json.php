<?php
include("../../../includes/dbconfig.php");
include("../../../includes/config.php");

if(isset($_POST['artist_id'])) {
    $artist_id = $_POST['artist_id'];
    $query = mysqli_query($connection, "SELECT * FROM artists WHERE id='$artist_id'");
    $result_array = mysqli_fetch_array($query);
    echo json_encode($result_array);
}
?>