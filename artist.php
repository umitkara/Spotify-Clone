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
                    <button class="button green">PLAY</button>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="trackListContainer">
    <h2>
        Popular Songs
    </h2>
    <ul class="trackList">
        <?php
            $songs_arr = $artist->get_pupular_songs();
            $i = 1;
            foreach($songs_arr as $song_id) {
                $song = new Song($connection, $song_id);
                echo "<li class='trackListRow'>
                        <div class='trackCount'>
                            <span role='link' tabindex='0' class='fa-regular fa-play' onclick='setTrack(\"" . $song->get_id() . "\", temp_playlist, true)'></span>
                            <span class='trackNumber'>$i</span>
                        </div>
                        <div class='trackInfo' role='link' tabindex='0' onclick='setTrack(\"" . $song->get_id() . "\", temp_playlist, true)'>
                            <span class='trackName'>" . $song->get_title() . "</span>
                            <span class='artistName'>" . $song->get_artist()->get_name() . "</span>
                        </div>
                        <div class='trackDuration'>
                            <span class='duration'>" . $song->get_duration() . "</span>
                        </div>
                        <div class='trackOptions'>
                            <input type='hidden' class='songId' value='" . $song->get_id() . "'>
                            <span role='link' tabindex='0' class='fa-regular fa-ellipsis-v' onclick='showOptionsMenu(this)'></i>
                        </div>
                    </li>";
                $i++;
            }
        ?>
    </ul>
</div>
<div class="gridViewContainer">
    <h2>
        Albums
    </h2>
    <?php
    $album_query = mysqli_query($connection, "SELECT * FROM albums WHERE artist = $artist_id");

    while ($row = mysqli_fetch_array($album_query)) {
        echo "<div class='gridViewItem'>
                        <span role='link' tabindex='0' onclick='open_page(\"album.php?id=" . $row['id'] . "\")'>
                            <img src='" . $row['albumArt'] . "'>
                            <div class='gridViewInfo'>"
            . $row['title'] .
            "</div>
                        </span>
                    </div>";
    }

    ?>
</div>

<script>
    temp_playlist = <?php echo json_encode($songs_arr); ?>;
    $(".button.green").click(function() {
        setTrack(temp_playlist[0], temp_playlist, true);
    });
</script>   