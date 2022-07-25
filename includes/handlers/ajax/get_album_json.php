<?php
include("../../../includes/dbconfig.php");
include("../../../includes/config.php");

if(isset($_POST['album_id'])) {
    $album_id = $_POST['album_id'];
    $query = mysqli_query($connection, "SELECT * FROM albums WHERE id='$album_id'");
    $result_array = mysqli_fetch_array($query);
    echo json_encode($result_array);
}
?>