<?php 
// 10 random songs from the database
$query = mysqli_query($connection, "SELECT * FROM songs ORDER BY RAND() LIMIT 10");
$result_arr = array();
while($row = mysqli_fetch_array($query)) {
    array_push($result_arr, $row['id']);
}

$json = json_encode($result_arr);
?>

<script>
$(document).ready(function() {
    current_playlist = JSON.parse('<?php echo $json; ?>');
    audio_element = new AudioElm();
    setTrack(current_playlist[0], current_playlist, true);
});

function setTrack(track_id, new_playlist, play) {
    $.post("includes/handlers/ajax/get_song_json.php", { song_id: track_id }, function(data) {
        console.log(data);
        /*var track = JSON.parse(data);
        audio_element.set_track(track);
        if(play) {
            audio_element.play();
        }*/
    });
    if(play) {
        audio_element.play();
    }
}



function play() {
    audio_element.play();
    $(".play").hide();
    $(".pause").show();
}

function pause() {
    audio_element.pause();
    $(".play").show();
    $(".pause").hide();
}
</script>

<div id="nowPlayingBar" class="nowPlayingBar">
    <div class="nowPlayingLeft">
        <div class="content">
            <span class="albumLink">
                <img id="albumArt" src="assets/images/album_default.jpg" draggable="FALSE">
            </span>
            <div class="trackInfo">
                <span class="trackName">
                    <span>Track Name</span>
                </span>
                <span class="artistName">
                    <span>Artist Name</span>
                </span>
            </div>
        </div>
    </div>
    <div class="nowPlayingCenter">
        <div class="content playerControls">
            <div class="buttons">
                <button class="controlButton shuffle" title="Shuffle">
                    <i class="fa-regular fa-shuffle"></i>
                </button>
                <button class="controlButton previous" title="Previous">
                    <i class="fa-regular fa-step-backward"></i>
                </button>
                <button class="controlButton play" title="Play" onclick="play()">
                    <i class="fa-regular fa-circle-play"></i>
                </button>
                <button class="controlButton pause" title="Pause" style="display: none;" onclick="pause()">
                    <i class="fa-regular fa-pause-circle"></i>
                </button>
                <button class="controlButton next" title="Next">
                    <i class="fa-regular fa-step-forward"></i>
                </button>
                <button class="controlButton repeat" title="Repeat">
                    <i class="fa-regular fa-repeat"></i>
                </button>
            </div>
            <div class="playbackBar">
                <span class="progressTime current">0:00</span>
                <div class="progressBar">
                    <div class="progressBarBg">
                        <div class="progress"></div>
                    </div>
                </div>
                <span class="progressTime remaining">0:00</span>
            </div>
        </div>
    </div>
    <div class="nowPlayingRight">
        <div class="volumeBar">
            <button class="controlButton volume" title="Volume">
                <i class="fa-regular fa-volume-up"></i>
            </button>
            <div class="progressBar">
                <div class="progressBarBg">
                    <div class="progress"></div>
                </div>
            </div>
        </div>
    </div>
</div>