document.addEventListener("DOMContentLoaded", () => {
    const songs = Array.from(document.querySelectorAll(".song-item"));
    const audio = document.getElementById("audio-player");
    const playBtn = document.getElementById("play-btn");
    const prevBtn = document.getElementById("prev-btn");
    const nextBtn = document.getElementById("next-btn");
    const repeatBtn = document.getElementById("repeat-btn");
    const progressBar = document.getElementById("progress-bar");
    const playerImage = document.getElementById("player-image");
    const playerTitle = document.getElementById("player-title");
    const playerArtist = document.getElementById("player-artist");

    let currentIndex = 0;
    let repeatMode = false;
    let isPlaying = false;

    // Khi bấm chọn bài
    songs.forEach((song, index) => {
        song.addEventListener("click", () => loadSong(index, true));
    });

    function loadSong(index, autoplay = false) {
        const song = songs[index];
        if (!song) return;

        currentIndex = index;
        const file = song.dataset.file;
        const title = song.dataset.title;
        const artist = song.dataset.artist;
        const image = song.dataset.image;

        playerTitle.textContent = title;
        playerArtist.textContent = artist;
        playerImage.src = image;
        audio.src = file;

        document.title = `${title} - ${artist} 🎵`;

        if (autoplay) playAudio();
    }

    function playAudio() {
        audio.play();
        isPlaying = true;
        playBtn.innerHTML = `<i class="fas fa-pause"></i>`;
    }

    function pauseAudio() {
        audio.pause();
        isPlaying = false;
        playBtn.innerHTML = `<i class="fas fa-play"></i>`;
    }

    playBtn.addEventListener("click", () => {
        if (!audio.src) return;
        isPlaying ? pauseAudio() : playAudio();
    });

    prevBtn.addEventListener("click", () => {
        currentIndex = (currentIndex - 1 + songs.length) % songs.length;
        loadSong(currentIndex, true);
    });

    nextBtn.addEventListener("click", () => {
        currentIndex = (currentIndex + 1) % songs.length;
        loadSong(currentIndex, true);
    });

    repeatBtn.addEventListener("click", () => {
        repeatMode = !repeatMode;
        repeatBtn.classList.toggle("text-pink-400", repeatMode);
    });

    // Thanh tua nhạc
    audio.addEventListener("timeupdate", () => {
        if (!isNaN(audio.duration)) {
            const progress = (audio.currentTime / audio.duration) * 100;
            progressBar.value = progress;
        }
    });

    progressBar.addEventListener("input", () => {
        if (!isNaN(audio.duration)) {
            audio.currentTime = (progressBar.value / 100) * audio.duration;
        }
    });

    // Tự phát bài kế
    audio.addEventListener("ended", () => {
        if (repeatMode) {
            playAudio();
        } else {
            nextBtn.click();
        }
    });
});
