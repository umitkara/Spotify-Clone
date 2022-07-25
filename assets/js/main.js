function openPage(page_url) {
    window.location.href = page_url;
}

let current_playlist = [];
var audio_element;

function time_format(secs) {
    // return mm:ss format
    return Math.floor(secs / 60) + ":" + (secs % 60 < 10 ? "0" : "") + Math.floor(secs % 60);
}

class AudioElm {

    constructor(src) {
        this.current_playing = null;
        this.src = src;
        this.audio = document.createElement('audio');

        this.audio.addEventListener('canplay', () => {
            $('.progressTime.remaining').text(time_format(this.audio.duration));
        });
        
        this.audio.addEventListener('timeupdate', () => {
            $('.progressTime.current').text(time_format(this.audio.currentTime));
            $('.progressBar .progress').css('width', (this.audio.currentTime / this.audio.duration) * 100 + '%');
        });
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
}