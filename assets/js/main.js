function openPage(page_url) {
    window.location.href = page_url;
}

let current_playlist = [];
let audio_element;
let mouse_down = false;

function time_format(secs) {
    // return mm:ss format
    return Math.floor(secs / 60) + ":" + (secs % 60 < 10 ? "0" : "") + Math.floor(secs % 60);
}

function update_volume_progress(audio) {
    $('.volumeBar .progress').css('width', audio.volume * 100 + '%');
}

class AudioElm {

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
    }

    setTrack(track) {
        this.current_playing = track;
        this.audio.src = track.path;
    }

    play() {
        this.audio.play();
    }

    pause() {
        this.audio.pause();
    }

    setTime(time) {
        this.audio.currentTime = time;
    }
}