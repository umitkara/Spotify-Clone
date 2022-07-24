<div id="nowPlayingBar" class="nowPlayingBar">
    <div class="nowPlayingLeft">
        <div class="content">
            <span class="albumLink">
                <img id="albumArt" src="assets/images/album_default.jpg">
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
                <button class="controlButton play" title="Play">
                    <i class="fa-regular fa-circle-play"></i>
                </button>
                <button class="controlButton pause" title="Pause" style="display: none;">
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