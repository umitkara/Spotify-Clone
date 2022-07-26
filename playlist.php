<?php
    include("includes/include_files.php");
    
    if(isset($_GET['id'])) {
        $playlist_id = $_GET['id'];
        if(!is_numeric($playlist_id)) {
            echo "<script>open_page('index.php');</script>";
            //header("Location: index.php");
        }
    } else {
        echo "<script>open_page('index.php');</script>";
        //header("Location: index.php");
    }
    $playlist = new Playlist($connection, $playlist_id);
?>

<div class="entitiyInfo">
    <div class="leftSection">
        <div class="playPlaylist">
            <img src="assets\images\album_default.jpg" draggable="false">
            <div class="playPlaylistOverlay">
                <div class="playPlaylistButton">
                    <i class="fa-regular fa-play"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="rightSection">
        <h2><?php echo $playlist->get_name(); ?></h2>
        <p>
            By 
            <span role="link" tabindex="0" onclick="open_page('user.php?id=<?php echo $playlist->get_owner_id(); ?>')">
                <?php echo $playlist->get_owner(); ?>
            </span>
        </p>
        <p><?php echo $playlist->song_count(); ?> Songs</p>
        <div class="playlistOptions">
            <button class="button red" onclick="delete_playlist(<?php echo $playlist_id; ?>)">Delete</button>
        </div>
    </div>
</div>

<div class="trackListContainer">
    <ul class="trackList">
        <?php
            $songs_arr = $playlist->get_songs();
            if(count($songs_arr) == 0)
            {
                echo "<h2>No songs in playlist</h2>";
                exit();
            }
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
                            <i class='fa-regular fa-ellipsis-h'></i>
                            <div class='trackDropdown'>
                                <div class='trackDropdownItem'>Play</div>
                                <div class='trackDropdownItem'>Add to Playlist</div>
                                <div class='trackDropdownItem'>Add to Queue</div>
                                <div class='trackDropdownItem'>Delete from Playlist</div>
                            </div>
                        </div>
                    </li>";
                $i++;
            }
        ?>
    </ul>
</div>

<script>
    temp_playlist = <?php echo json_encode($songs_arr); ?>;
    $(".playPlaylist").click(function() {
        setTrack(temp_playlist[0], temp_playlist, true);
    });
</script>   