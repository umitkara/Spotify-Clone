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
    // Temp
    setTrack(current_playlist[0], current_playlist, false);
    //
    $("#nowPlayingBar").on("mousedown touchstart mousemove touchmove", function(e) {
        e.preventDefault();
    });
    $(".playbackBar .progressBar").mousedown(function() {
        mouseDown = true;
    });
    $(".playbackBar .progressBar").mouseup(function() {
        timeFromOffset(event, this);
        mouseDown = false;
    });
    $(".playbackBar .progressBar").mousemove(function(event) {
        if(mouseDown) {
            timeFromOffset(event, this);
        }
    });
    $(".volumeBar .progressBar").mousedown(function() {
        mouseDown = true;
    });
    $(".volumeBar .progressBar").mouseup(function() {
        let percentage = event.offsetX / $(this).width();
        if(percentage >= 0 && percentage <= 1) {
            audio_element.audio.volume = percentage;
        }
        mouseDown = false;
    });
    $(".volumeBar .progressBar").mousemove(function(event) {
        if(mouseDown) {
            let percentage = event.offsetX / $(this).width();
            if(percentage >= 0 && percentage <= 1) {
                audio_element.audio.volume = percentage;
            }
        }
    });
});

function timeFromOffset(mouse, progressBar) {
    let percentage = (mouse.offsetX / $(progressBar).width()) * 100;
    let seconds = audio_element.audio.duration * (percentage / 100);
    audio_element.setTime(seconds);
}

function setTrack(track_id, new_playlist, play) {
    $.post("includes/handlers/ajax/get_song_json.php", { song_id: track_id }, function(data) {
        let track = JSON.parse(data);
        audio_element.setTrack(track);
        $(".trackName span").text(track.title);
        $.post("includes/handlers/ajax/get_artist_json.php", { artist_id: track.artist }, function(data) {
            let artist = JSON.parse(data);
            $(".artistName span").text(artist.name);
        });
        $.post("includes/handlers/ajax/get_album_json.php", { album_id: track.album }, function(data) {
            let album = JSON.parse(data);
            $(".albumLink img").attr("src", album.albumArt);
        });
    });
    if(play) {
        audio_element.play();
    }
}



function play() {
    if(audio_element.audio.currentTime == 0) {
        $.post("includes/handlers/ajax/update_plays.php", { song_id: audio_element.current_playing.id });
    }
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