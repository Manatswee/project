document.addEventListener("DOMContentLoaded", function() {
    const audio = document.getElementById("myAudio");
    const playButton = document.getElementById("playButton");
    const pauseButton = document.getElementById("pauseButton");
    const replayButton = document.getElementById("replayButton");

    playButton.addEventListener("click", function() {
        audio.play();
    });

    pauseButton.addEventListener("click", function() {
        audio.pause();
    });

    replayButton.addEventListener("click", function() {
        audio.currentTime = 0;
        audio.play();
    });
});