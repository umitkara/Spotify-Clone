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

$(document).click(function (e) {
    let target = $(e.target);
    if(!target.hasClass("option") && e.target.id !== "optionsButton") {
        hide_options_menu();
    }
});

$(window).scroll(function() {
    hide_options_menu();
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

function create_playlist() {
    let playlist_name = prompt("Enter a name for your playlist:");
    
    if(playlist_name != null || playlist_name != "") {
        $.post("includes/handlers/ajax/create_playlist.php", {username: user_logged_in, playlist_name: playlist_name}).done(function(error) {
            if(error) {
                alert(error);
                return;
            }
            open_page("your_music.php");
        });
        
    }
}

function delete_playlist(playlist_id) {
    let cfr = confirm("Are you sure you want to delete this playlist?");
    if(cfr) {
        $.post("includes/handlers/ajax/delete_playlist.php", {username: user_logged_in, playlist_id: playlist_id}).done(function(error) {
            if(error != 1) {
                alert(error);
                return;
            }
            open_page("your_music.php");
        });
    }
}

function show_options_menu(element) {
    let menu = $(".optionsMenu")
    let menu_width = menu.width();
    let scroll_top = $(window).scrollTop();
    let element_offset = $(element).offset().top;
    let top = element_offset - scroll_top;
    let left = $(element).offset().left;
    menu.css({'top': top + "px", 'left': left - menu_width + "px", 'display': "inline"});
    $(".menuSongId").val($(element).siblings(".songId").val());
}

function hide_options_menu() {
    $(".optionsMenu").hide();
}

function play_from_menu() {
    setTrack($(".menuSongId").val(), temp_playlist, true);
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