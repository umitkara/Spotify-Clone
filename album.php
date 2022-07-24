<?php include("includes/header.php") ?>

<?php
    if(isset($_GET['id'])) {
        $album_id = $_GET['id'];
        if(!is_numeric($album_id)) {
            header("Location: index.php");
        }
    } else {
        header("Location: index.php");
    }

    $album_query = mysqli_query($connection, "SELECT * FROM albums WHERE id = $album_id");
    $album = mysqli_fetch_assoc($album_query);
    $artist = new Artist($connection, $album['artist']);
    echo $album['title'];
    echo $artist->get_name();
    
?>

<?php include("includes/footer.php") ?>