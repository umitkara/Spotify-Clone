function openPage(page_url) {
    window.location.href = page_url;
}

let current_playlist = [];
var audio_element;

class AudioElm {

    constructor(src) {
        this.current_playing = null;
        this.src = src;
        this.audio = document.createElement('audio');
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