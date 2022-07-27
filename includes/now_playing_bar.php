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
    let new_playlist = JSON.parse('<?php echo $json; ?>');
    audio_element = new Audio();
    setTrack(new_playlist[0], new_playlist, false);

    // Temp
    setTrack(current_playlist[0], current_playlist, false);
    //
    $("#nowPlayingBar").on("mousedown touchstart mousemove touchmove", function(e) {
        e.preventDefault();
    });
    $(".playbackBar .progressBar").mousedown(function() {
        mouse_down = true;
    });
    $(".playbackBar .progressBar").mouseup(function() {
        timeFromOffset(event, this);
        mouse_down = false;
    });
    $(".playbackBar .progressBar").mousemove(function(event) {
        if(mouse_down) {
            timeFromOffset(event, this);
        }
    });
    $(".volumeBar .progressBar").mousedown(function() {
        mouse_down = true;
    });
    $(".volumeBar .progressBar").mouseup(function() {
        let percentage = event.offsetX / $(this).width();
        if(percentage >= 0 && percentage <= 1) {
            audio_element.audio.volume = percentage;
        }
        mouse_down = false;
    });
    $(document).mouseup(function() {
        mouse_down = false;
    });
    $(".volumeBar .progressBar").mousemove(function(event) {
        if(mouse_down) {
            let percentage = event.offsetX / $(this).width();
            if(percentage >= 0 && percentage <= 1) {
                audio_element.audio.volume = percentage;
            }
        }
    });
    $(".volumeBar").mouseover(function() {
        $(this).on('wheel', function(event){
            if(event.originalEvent.deltaY < 0 && audio_element.audio.volume < 1) {
                audio_element.audio.volume += 0.005;
            };
            if(event.originalEvent.deltaY > 0 && audio_element.audio.volume > 0) {
                if (audio_element.audio.volume > 0.01) {
                    audio_element.audio.volume -= 0.005;
                } else {
                    audio_element.audio.volume = 0;
                }
            };
        });
    });
});

function timeFromOffset(mouse, progressBar) {
    let percentage = (mouse.offsetX / $(progressBar).width()) * 100;
    let seconds = audio_element.audio.duration * (percentage / 100);
    audio_element.setTime(seconds);
}

function play_playlist(playlist_id) {
    $.post("includes/handlers/ajax/get_playlist_songs.php", {playlist_id: playlist_id}).done(function(song_json) {
        current_playlist = JSON.parse(song_json);
        if(current_playlist.length == 0)
        {
            return;
        }
        current_index = 0;
        setTrack(current_playlist[current_index], current_playlist, true);
    });
}

function setTrack(track_id, new_playlist, is_play) {

    if(new_playlist != current_playlist)
    {
        current_playlist = new_playlist;
        shuffle_playlist = current_playlist.slice();
        shuffle_array(shuffle_playlist);
    }

    if (shuffle) {
        current_index = shuffle_playlist.indexOf(track_id);
    } else {
        current_index = current_playlist.indexOf(track_id);
    }


    $.post("includes/handlers/ajax/get_song_json.php", { song_id: track_id }, function(data) {
        let track = JSON.parse(data);
        audio_element.setTrack(track);
        // current_index = current_playlist.indexOf(track_id);
        $(".trackName span").text(track.title);
        $.post("includes/handlers/ajax/get_artist_json.php", { artist_id: track.artist }, function(data) {
            let artist = JSON.parse(data);
            $(".artistName span").text(artist.name);
            $(".artistName span").attr("onclick", "open_page('artist.php?id=" + artist.id + "')");
        });
        $.post("includes/handlers/ajax/get_album_json.php", { album_id: track.album }, function(data) {
            let album = JSON.parse(data);
            $(".albumLink img").attr("src", album.albumArt);
            $(".albumLink img").attr("onclick", "open_page('album.php?id=" + album.id + "')");
            $(".trackName span").attr("onclick", "open_page('album.php?id=" + album.id + "')");
        });
        if(is_play == true) {
            audio_element.play();
        }
    });
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

function next() {
    if(repeat == true)
    {
        audio_element.setTime(0);
        audio_element.play();
        return
    }
    if(current_index == current_playlist.length-1)
    {
        // End of playlist. Maybe repeat the playlist function could be implemented later.
        return
        // current_index = 0;
    }
    else {
        current_index++;
    }
    let track = shuffle ? shuffle_playlist[current_index] : current_playlist[current_index];
    setTrack(track, current_playlist, true);
}

function previous() {
    if(current_index == 0)
    {
        current_index = current_playlist.length-1;
    }
    else {
        current_index--;
    }
    let track = current_playlist[current_index];
    setTrack(track, current_playlist, true);
}

function set_repeat() {
    repeat = !repeat;
    if(repeat)
    {
        $(".controlButton.repeat").addClass("media-playback-active");
    }
    else {
        $(".controlButton.repeat").removeClass("media-playback-active");
    }
}

function set_mute() {
    audio_element.audio.muted = !audio_element.audio.muted;
    if(audio_element.audio.muted) {
        $(".controlButton.volume").html('<i class="fa-regular fa-volume-mute"></i>');
    }
    else {
        $(".controlButton.volume").html('<i class="fa-regular fa-volume-up"></i>');
    }
}

function set_shuffle() {
    shuffle = !shuffle;
    if(shuffle) {
        $(".controlButton.shuffle").addClass("media-playback-active");
        shuffle_array(shuffle_playlist);
        current_index = shuffle_playlist.indexOf(audio_element.current_playing.id);

    }
    else {
        $(".controlButton.shuffle").removeClass("media-playback-active");
        current_index = current_playlist.indexOf(audio_element.current_playing.id);
    }
}

function shuffle_array(a) {
    var j, x, i;
    for (i = a.length - 1; i > 0; i--) {
        j = Math.floor(Math.random() * (i + 1));
        x = a[i];
        a[i] = a[j];
        a[j] = x;
    }
    return a;
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
                <button class="controlButton shuffle" title="Shuffle" onclick="set_shuffle()">
                    <i class="fa-regular fa-shuffle"></i>
                </button>
                <button class="controlButton previous" title="Previous" onclick="previous()">
                    <i class="fa-regular fa-step-backward"></i>
                </button>
                <button class="controlButton play" title="Play" onclick="play()">
                    <i class="fa-regular fa-circle-play"></i>
                </button>
                <button class="controlButton pause" title="Pause" style="display: none;" onclick="pause()">
                    <i class="fa-regular fa-pause-circle"></i>
                </button>
                <button class="controlButton next" title="Next" onclick="next()">
                    <i class="fa-regular fa-step-forward"></i>
                </button>
                <button class="controlButton repeat" title="Repeat" onclick="set_repeat()">
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
            <button class="controlButton volume" title="Volume" onclick="set_mute()">
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