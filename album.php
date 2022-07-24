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
    $album = new Album($connection, $album_id);
?>

<div class="entitiyInfo">
    <div class="leftSection">
        <img src="<?php echo $album->get_artwork_path(); ?>">
    </div>
    <div class="rightSection">
        <h2><?php echo $album->get_title(); ?></h2>
        <p>By <?php echo $album->get_artist()->get_name(); ?></p>
        <p><?php echo $album->song_count(); ?> Songs</p>
    </div>
</div>

<?php include("includes/footer.php") ?>