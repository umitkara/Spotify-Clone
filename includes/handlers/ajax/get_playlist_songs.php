<?php
include("../../../includes/dbconfig.php");
include("../../../includes/config.php");

if(isset($_POST['playlist_id'])) {
    $playlist_id = $_POST['playlist_id'];
    $result_array = array();
    $query = mysqli_query($connection, "SELECT * FROM playlistsongs WHERE playlistID='$playlist_id'");
    while($row = mysqli_fetch_array($query)) {
        array_push($result_array, $row['songID']);
    }
    echo json_encode($result_array);
}
?>