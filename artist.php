<?php include("includes/include_files.php"); 
    if(isset($_GET['id'])) {
        $artist_id = $_GET['id'];
        if(!is_numeric($artist_id)) {
            echo "<script>open_page('index.php');</script>";
            //header("Location: index.php");
        }
    } else {
        echo "<script>open_page('index.php');</script>";
        //header("Location: index.php");
    }
    $artist = new Artist($connection, $artist_id);
?>

<script>
    // add backgoudn image to artistInfo
    $(".artistInfo").css("background-image", "url('assets/images/artist_pics/" + "<?php echo $artist->get_name(); ?>" + ".jpg')");
</script>

<div class="entitiyInfo">
    <div class="centerSection">
        <div class="artistInfo">
            <div class="overlay">
                <h1><?php echo $artist->get_name(); ?></h1>
                <p>
                    <?php echo $artist->get_number_of_albums(); ?> Albums
                    -
                    <?php echo $artist->get_number_of_songs(); ?> Songs
                </p>
                <div class="headerButton">
                    <button class="button">PLAY</button>
                </div>
            </div>
        </div>
    </div>
</div>