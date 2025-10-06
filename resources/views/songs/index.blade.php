<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Music Library</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .animate-fade-in { animation: fadeIn 0.6s ease-out forwards; }
        .animate-fade-in-up { animation: fadeIn 0.8s ease-out forwards; }
        .song-card:hover .play-icon { opacity: 1; transform: scale(1.1); }
        .progress-bar::-webkit-slider-thumb {
            -webkit-appearance: none; width: 16px; height: 16px; border-radius: 50%;
            background: #8b5cf6; cursor: pointer;
        }
        .volume-bar::-webkit-slider-thumb {
            -webkit-appearance: none; width: 12px; height: 12px; border-radius: 50%;
            background: #8b5cf6; cursor: pointer;
        }
        .blur-bg { backdrop-filter: blur(10px); background-color: rgba(15, 23, 42, 0.8); }
    </style>
</head>
<body class="bg-gradient-to-br from-indigo-900 via-purple-900 to-gray-900 min-h-screen text-gray-100">
    <div class="container mx-auto px-4 py-8">
        <!-- Header -->
        <header class="mb-12 text-center animate-fade-in">
            <div class="flex justify-center mb-6">
                <div class="w-24 h-24 rounded-full bg-gradient-to-r from-purple-500 to-indigo-600 flex items-center justify-center shadow-xl">
                    <i class="fas fa-music text-4xl text-white"></i>
                </div>
            </div>
            <h1 class="text-4xl md:text-5xl font-bold bg-gradient-to-r from-purple-400 via-pink-400 to-indigo-400 bg-clip-text text-transparent mb-3">
                Your Music Library
            </h1>
            <p class="text-lg text-gray-300 max-w-2xl mx-auto">
                Quản lý và thưởng thức âm nhạc của bạn một cách dễ dàng
            </p>
        </header>

        <!-- Controls -->
        <div class="flex flex-col md:flex-row justify-between items-center mb-8 gap-4 animate-fade-in-up">
            <div class="relative w-full md:w-auto">
                <input type="text" placeholder="Tìm kiếm bài hát..." 
                    class="w-full md:w-64 px-4 py-3 rounded-xl bg-gray-800 border border-gray-700 focus:outline-none focus:ring-2 focus:ring-purple-500 text-gray-200 placeholder-gray-500">
                <i class="fas fa-search absolute right-3 top-3.5 text-gray-500"></i>
            </div>
            <a href="{{ route('songs.create') }}" class="w-full md:w-auto bg-gradient-to-r from-purple-600 to-indigo-600 hover:from-purple-700 hover:to-indigo-700 text-white font-semibold py-3 px-6 rounded-xl flex items-center justify-center gap-2 transition-all duration-300 transform hover:scale-105 shadow-lg">
                <i class="fas fa-plus"></i>
                <span>Thêm Bài Hát Mới</span>
            </a>
        </div>

        <!-- Playlist Section -->
        <div class="mb-12 animate-fade-in-up">
            <h2 class="text-2xl font-bold mb-4">Playlists</h2>
            <div id="playlists" class="flex flex-wrap gap-4">
                <!-- Playlist sẽ render bằng JS -->
            </div>
            <div class="mt-4 flex gap-2">
                <input id="new-playlist-name" type="text" placeholder="Tên playlist..."
                    class="px-4 py-2 rounded-lg bg-gray-800 border border-gray-700 text-gray-200 placeholder-gray-500 focus:ring-2 focus:ring-purple-500">
                <button id="add-playlist-btn"
                    class="bg-purple-600 hover:bg-purple-700 text-white px-4 py-2 rounded-lg transition">
                    + Tạo Playlist
                </button>
            </div>
        </div>

        <!-- Success Message -->
        @if (session('success'))
            <div class="bg-green-500/20 border-l-4 border-green-400 text-green-100 p-4 rounded-lg mb-8 flex items-center gap-3 animate-fade-in">
                <i class="fas fa-check-circle text-green-300"></i>
                <p>{{ session('success') }}</p>
            </div>
        @endif

        <!-- Music Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 mb-24 animate-fade-in-up">
            @forelse ($songs as $index => $song)
                <div class="song-card bg-gray-800/50 hover:bg-gray-800/70 rounded-2xl p-4 transition-all duration-300 cursor-pointer group relative overflow-hidden" data-index="{{ $index }}">
                    <div class="relative">
                        <img src="{{ $song->image_path ? asset('storage/' . $song->image_path) : 'https://source.unsplash.com/random/300x300/?music,album' }}" 
                             alt="{{ $song->title }}" 
                             class="w-full h-48 object-cover rounded-xl mb-4">

                        <div class="play-icon absolute inset-0 flex items-center justify-center opacity-0 transition-all duration-300">
                            <div class="w-14 h-14 bg-purple-600 rounded-full flex items-center justify-center shadow-lg transform group-hover:scale-110 transition-transform duration-300">
                                <i class="fas fa-play text-xl"></i>
                            </div>
                        </div>

                        <!-- Nút thêm vào Playlist -->
                        <button onclick="addToPlaylist({{ $index }})"
                                class="absolute top-2 right-2 bg-purple-600/80 hover:bg-purple-700 text-white text-xs px-2 py-1 rounded shadow">
                            + Playlist
                        </button>
                    </div>

                    <div class="flex justify-between items-start">
                        <div>
                            <h3 class="font-bold text-lg truncate">{{ $song->title }}</h3>
                            <p class="text-gray-400 text-sm">{{ $song->artist->name ?? 'Unknown Artist' }}</p>
                        </div>
                        <span class="text-gray-500 text-sm">{{ gmdate('i:s', $song->duration ?? 0) }}</span>
                    </div>

                    <div class="mt-3 flex justify-between items-center">
                        <span class="text-xs bg-purple-900/50 text-purple-300 px-2 py-1 rounded">{{ $song->genre->name ?? 'Unknown Genre' }}</span>
                        <div class="flex gap-2">
                            <a href="{{ route('songs.edit', $song) }}" class="text-gray-400 hover:text-purple-400 transition-colors">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('songs.destroy', $song) }}" method="POST" class="inline" onsubmit="return confirm('Bạn có chắc muốn xóa?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-gray-400 hover:text-red-400 transition-colors">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full text-center text-gray-300 py-12">
                    Không có bài hát nào.
                </div>
            @endforelse
        </div>
    </div>

    <!-- Music Player -->
    <div id="music-player" class="fixed bottom-0 left-0 right-0 blur-bg border-t border-gray-800/50 z-50">
        <div class="container mx-auto px-4 py-3">
            <div class="flex flex-col md:flex-row items-center gap-4">
                <!-- Song Info -->
                <div class="flex items-center gap-3 w-full md:w-auto">
                    <img id="player-album-art" src="{{ asset('images/logo.png') }}" alt="Album Art" class="w-12 h-12 rounded-lg object-cover">
                    <div class="flex-1 min-w-0">
                        <h4 id="player-title" class="font-semibold truncate">Chọn bài hát để phát</h4>
                        <p id="player-artist" class="text-xs text-gray-400 truncate">Nghệ sĩ</p>
                        <p id="player-genre" class="text-xs text-gray-500 truncate">Thể loại</p>
                    </div>
                    <button class="text-gray-400 hover:text-white p-2">
                        <i class="far fa-heart"></i>
                    </button>
                </div>

                <!-- Player Controls -->
                <div class="flex-1 w-full max-w-2xl">
                    <div class="flex items-center justify-center gap-4 mb-2">
                        <button id="prev-btn" class="text-gray-400 hover:text-white p-2">
                            <i class="fas fa-step-backward"></i>
                        </button>
                        <button id="play-pause-btn" class="bg-purple-600 hover:bg-purple-700 text-white w-10 h-10 rounded-full flex items-center justify-center transition-colors duration-200">
                            <i class="fas fa-play"></i>
                        </button>
                        <button id="next-btn" class="text-gray-400 hover:text-white p-2">
                            <i class="fas fa-step-forward"></i>
                        </button>
                    </div>
                    <div class="flex items-center gap-2">
                        <span id="current-time" class="text-xs text-gray-400 w-10">0:00</span>
                        <input type="range" id="progress-bar" class="progress-bar flex-1 h-1 bg-gray-700 rounded-full appearance-none cursor-pointer" min="0" max="0" value="0">
                        <span id="duration" class="text-xs text-gray-400 w-10">0:00</span>
                    </div>
                </div>

                <!-- Volume & Settings -->
                <div class="flex items-center gap-3 w-full md:w-auto">
                    <div class="flex items-center gap-2">
                        <i id="volume-icon" class="fas fa-volume-up text-gray-400"></i>
                        <input type="range" id="volume-bar" class="volume-bar w-20 h-1 bg-gray-700 rounded-full appearance-none cursor-pointer" min="0" max="1" step="0.01" value="1">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script>
        const songsData = [
            @foreach ($songs as $index => $song)
                {
                    src: "{{ route('song.file', basename($song->file_path)) }}",
                    title: "{{ $song->title }}",
                    artist: "{{ $song->artist->name ?? 'Unknown Artist' }}",
                    genre: "{{ $song->genre->name ?? 'Unknown Genre' }}",
                    duration: {{ $song->duration ?? 0 }},
                    image: "{{ $song->image_path ? asset('storage/' . $song->image_path) : asset('images/logo.png') }}"
                }{{ $loop->last ? '' : ',' }}
            @endforeach
        ];

        let audio = new Audio();
        let isPlaying = false;
        let currentSongIndex = -1;
        let playlists = [];
        let currentPlaylist = null;
        const progressBar = document.getElementById('progress-bar');

        // Xử lý click card
        const songCards = document.querySelectorAll('.song-card');
        songCards.forEach(card => {
            card.addEventListener('click', function(e) {
                if (e.target.closest('a') || e.target.closest('button')) return;
                const index = parseInt(this.getAttribute('data-index'));
                playSong(songsData[index], index);
            });
        });

        // Play 1 bài hát
        function playSong(song, index) {
            if (audio.src === song.src && !audio.paused) {
                audio.pause();
                isPlaying = false;
                document.getElementById('play-pause-btn').innerHTML = '<i class="fas fa-play"></i>';
                return;
            }
            audio.src = song.src;
            audio.play();
            isPlaying = true;
            currentSongIndex = index;
            document.getElementById('play-pause-btn').innerHTML = '<i class="fas fa-pause"></i>';
            document.getElementById('player-title').textContent = song.title;
            document.getElementById('player-artist').textContent = song.artist;
            document.getElementById('player-genre').textContent = song.genre;
            document.getElementById('player-album-art').src = song.image;

            audio.onloadedmetadata = function() {
                progressBar.max = audio.duration;
                document.getElementById('duration').textContent = formatTime(audio.duration);
                updateProgress();
            };
            audio.onended = playNext;
        }

        function updateProgress() {
            const currentTime = document.getElementById('current-time');
            progressBar.value = audio.currentTime;
            currentTime.textContent = formatTime(audio.currentTime);
            if (!audio.paused && !audio.ended) requestAnimationFrame(updateProgress);
        }

        progressBar.addEventListener('input', function() {
            audio.currentTime = parseFloat(this.value);
        });

        const volumeBar = document.getElementById('volume-bar');
        volumeBar.addEventListener('input', function() {
            audio.volume = this.value;
            const volumeIcon = document.getElementById('volume-icon');
            if (this.value == 0) volumeIcon.className = 'fas fa-volume-mute text-gray-400';
            else if (this.value < 0.5) volumeIcon.className = 'fas fa-volume-down text-gray-400';
            else volumeIcon.className = 'fas fa-volume-up text-gray-400';
        });

        document.getElementById('play-pause-btn').addEventListener('click', function() {
            if (isPlaying) {
                audio.pause();
                this.innerHTML = '<i class="fas fa-play"></i>';
            } else {
                audio.play();
                this.innerHTML = '<i class="fas fa-pause"></i>';
            }
            isPlaying = !isPlaying;
        });

        document.getElementById('prev-btn').addEventListener('click', playPrev);
        document.getElementById('next-btn').addEventListener('click', playNext);

        function playPrev() {
            if (currentPlaylist !== null) {
                const pl = playlists[currentPlaylist];
                let pos = pl.songs.indexOf(currentSongIndex);
                pos = (pos > 0) ? pos - 1 : pl.songs.length - 1;
                const idx = pl.songs[pos];
                playSong(songsData[idx], idx);
            } else {
                currentSongIndex = (currentSongIndex > 0) ? currentSongIndex - 1 : songsData.length - 1;
                playSong(songsData[currentSongIndex], currentSongIndex);
            }
        }

        function playNext() {
            if (currentPlaylist !== null) {
                const pl = playlists[currentPlaylist];
                let pos = pl.songs.indexOf(currentSongIndex);
                pos = (pos < pl.songs.length - 1) ? pos + 1 : 0;
                const idx = pl.songs[pos];
                playSong(songsData[idx], idx);
            } else {
                currentSongIndex = (currentSongIndex < songsData.length - 1) ? currentSongIndex + 1 : 0;
                playSong(songsData[currentSongIndex], currentSongIndex);
            }
        }

        function formatTime(seconds) {
            const minutes = Math.floor(seconds / 60);
            const secs = Math.floor(seconds % 60);
            return `${minutes}:${secs < 10 ? '0' : ''}${secs}`;
        }

        // Playlist
        document.getElementById('add-playlist-btn').addEventListener('click', () => {
            const name = document.getElementById('new-playlist-name').value.trim();
            if (!name) return alert("Nhập tên playlist!");
            playlists.push({ name, songs: [] });
            renderPlaylists();
            document.getElementById('new-playlist-name').value = '';
        });

        function renderPlaylists() {
            const container = document.getElementById('playlists');
            container.innerHTML = '';
            playlists.forEach((pl, i) => {
                const div = document.createElement('div');
                div.className = "bg-gray-800/50 px-4 py-3 rounded-xl cursor-pointer hover:bg-gray-700 transition";
                div.innerHTML = `<strong>${pl.name}</strong> <span class="text-sm text-gray-400">(${pl.songs.length} bài)</span>`;
                div.addEventListener('click', () => {
                    currentPlaylist = i;
                    if (pl.songs.length > 0) {
                        const firstIndex = pl.songs[0];
                        playSong(songsData[firstIndex], firstIndex);
                    } else {
                        alert("Playlist trống!");
                    }
                });
                container.appendChild(div);
            });
        }

        function addToPlaylist(songIndex) {
            if (playlists.length === 0) return alert("Chưa có playlist! Tạo trước đã.");
            const choice = prompt("Chọn playlist (theo số):\n" + playlists.map((p, i) => `${i+1}. ${p.name}`).join("\n"));
            const idx = parseInt(choice) - 1;
            if (idx >= 0 && idx < playlists.length) {
                playlists[idx].songs.push(songIndex);
                renderPlaylists();
                alert("Đã thêm vào " + playlists[idx].name);
            }
        }
    </script>
</body>
</html>
