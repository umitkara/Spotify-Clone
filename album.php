<?php
    include("includes/include_files.php");
    
    if(isset($_GET['id'])) {
        $album_id = $_GET['id'];
        if(!is_numeric($album_id)) {
            echo "<script>open_page('index.php');</script>";
            //header("Location: index.php");
        }
    } else {
        echo "<script>open_page('index.php');</script>";
        //header("Location: index.php");
    }
    $album = new Album($connection, $album_id);
    $username = $_SESSION['user_id'];
    $user = new User($connection, $username);
    $playlists = $user->get_playlists();
?>

<div class="entitiyInfo">
    <div class="leftSection">
        <div class="playAlbum">
            <img src="<?php echo $album->get_artwork_path(); ?>" draggable="false">
            <div class="playAlbumOverlay">
                <div class="playAlbumButton">
                    <i class="fa-regular fa-play"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="rightSection">
        <h2><?php echo $album->get_title(); ?></h2>
        <p>
            By 
            <span role="link" tabindex="0" onclick="open_page('artist.php?id=<?php echo $album->get_artist_id(); ?>')">
                <?php echo $album->get_artist()->get_name(); ?>
            </span>
        </p>
        <p><?php echo $album->song_count(); ?> Songs</p>
    </div>
</div>

<div class="trackListContainer">
    <ul class="trackList">
        <?php
            $songs_arr = $album->get_songs();
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
                            <span id='optionsButton' role='link' tabindex='0' class='fa-regular fa-ellipsis-v' onclick='show_options_menu(this)'></span>
                        </div>
                    </li>";
                $i++;
            }
        ?>
    </ul>
</div>

<nav class="optionsMenu">
    <input type="hidden" class="menuSongId">
    <div class="option" onclick="play_from_menu()">
        Play
    </div>  
    <select class="option" name="playlist" onchange="add_to_playlist(this)">
        <option value="" disabled selected>Add to Playlist</option>
        <?php
            foreach($playlists as $playlist) {
                $p = new Playlist($connection, $playlist);
                echo "<option value='" . $p->get_id() . "'>" . $p->get_name() . "</option>";
            }
        ?>
    </select>
</nav>

<script>
    temp_playlist = <?php echo json_encode($songs_arr); ?>;
    $(".playAlbum").click(function() {
        setTrack(temp_playlist[0], temp_playlist, true);
    });
</script>   