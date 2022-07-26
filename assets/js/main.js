function openPage(page_url) {
    window.location.href = page_url;
}

var current_playlist = [];
var shuffle_playlist = [];
var temp_playlist = [];
var audio_element;
var mouse_down = false;
var current_index = 0;
var repeat = false;
var shuffle = false;
var page_title = "";
var user_logged_in;
var timer;

$(document).ready(function () {
    page_title = document.title;
    $(window).on('popstate', function() {
        open_page(location.pathname);
    });
});

function open_page(url) {
    if (timer != null) {
        clearTimeout(timer);
    }
    if (url.indexOf("?") > 0) {
        url += "&";
    }
    let encoded_url = encodeURI(url + "?user_logged_in=" + user_logged_in);
    $(".mainContent").load(encoded_url);
    $("body").scrollTop(0);
    history.pushState(null, null, url);
}

function time_format(secs) {
    // return mm:ss format
    return Math.floor(secs / 60) + ":" + (secs % 60 < 10 ? "0" : "") + Math.floor(secs % 60);
}

function update_volume_progress(audio) {
    $('.volumeBar .progress').css('width', audio.volume * 100 + '%');
}

class Audio {

    constructor(src) {
        this.current_playing = null;
        this.src = src;
        this.audio = document.createElement('audio');

        this.audio.addEventListener('canplay', () => {
            $('.progressTime.remaining').text(time_format(this.audio.duration));
            update_volume_progress(this.audio);
        });
        
        this.audio.addEventListener('timeupdate', () => {
            $('.progressTime.current').text(time_format(this.audio.currentTime));
            $('.playbackBar .progress').css('width', (this.audio.currentTime / this.audio.duration) * 100 + '%');
        });

        this.audio.addEventListener('volumechange', () => {
            update_volume_progress(this.audio);
        }
        , false);

        this.audio.addEventListener('ended', () => {
            next();
        });

        this.audio.addEventListener('play', () => {
            $(".play").hide();
            $(".pause").show();
        });

        this.audio.addEventListener('pause', () => {
            $(".play").show();
            $(".pause").hide();
            document.title = page_title;
        }
        , false);
    }

    setTrack(track) {
        this.current_playing = track;
        this.audio.src = track.path;
    }

    play() {
        this.audio.play();
        document.title = this.current_playing.title + " | " + page_title;
    }

    pause() {
        this.audio.pause();
        document.title = page_title;
    }

    setTime(time) {
        this.audio.currentTime = time;
    }
}