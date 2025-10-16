<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WebMusic 🎵</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body { font-family: 'Poppins', sans-serif; }
        @keyframes fadeIn { from { opacity: 0; transform: translateY(20px); } to { opacity: 1; transform: translateY(0); } }
        .animate-fade-in { animation: fadeIn 0.6s ease-out forwards; }
        .song-card:hover .play-icon { opacity: 1; transform: scale(1.1); }
        .progress-bar::-webkit-slider-thumb {
            -webkit-appearance: none; width: 14px; height: 14px; border-radius: 50%;
            background: #ec4899; cursor: pointer;
        }
        .volume-bar::-webkit-slider-thumb {
            -webkit-appearance: none; width: 12px; height: 12px; border-radius: 50%;
            background: #ec4899; cursor: pointer;
        }
        .blur-bg { backdrop-filter: blur(12px); background-color: rgba(17, 24, 39, 0.85); }
        .visualizer-bar {
            width: 4px; height: 8px; margin: 0 2px;
            background: linear-gradient(to top, #ec4899, #8b5cf6);
            border-radius: 2px; animation: bounce 1s infinite ease-in-out;
        }
        @keyframes bounce {
            0%,100% { height: 8px; } 50% { height: 24px; }
        }

        /* ✅ FIX: đảm bảo nút hiện trên ảnh */
        .song-card {
            position: relative;
            overflow: hidden;
        }
        .song-card img {
            position: relative;
            z-index: 0;
        }
        .song-card .absolute.top-3.right-3 {
            z-index: 20; /* Giúp nút nổi lên trên ảnh */
        }
    </style>
</head>

<body class="bg-gradient-to-br from-blue-700 via-purple-800 to-pink-600 min-h-screen text-gray-100">
    <div class="container mx-auto px-4 py-10">
        <!-- HEADER -->
        <header class="mb-12 text-center animate-fade-in">
            <div class="flex justify-center mb-6">
                <div class="w-24 h-24 rounded-full bg-gradient-to-r from-pink-500 via-purple-500 to-indigo-500 flex items-center justify-center shadow-xl">
                    <i class="fas fa-music text-4xl text-white"></i>
                </div>
            </div>
            <h1 class="text-5xl font-bold bg-gradient-to-r from-pink-400 via-purple-400 to-blue-400 bg-clip-text text-transparent mb-3">
                WebMusic - Thư Viện Âm Nhạc 🎶
            </h1>
            <p class="text-lg text-gray-200 max-w-2xl mx-auto">
                Quản lý, phát và tận hưởng âm nhạc mọi lúc, mọi nơi.
            </p>
        </header>

        <!-- CONTROL BAR -->
        <div class="flex flex-col md:flex-row justify-between items-center mb-8 gap-4 animate-fade-in">
            <div class="relative w-full md:w-auto">
                <input type="text" placeholder="🔍 Tìm kiếm bài hát..." 
                       class="w-full md:w-72 px-4 py-3 rounded-xl bg-gray-900/50 border border-gray-700 focus:ring-2 focus:ring-pink-500 text-gray-200 placeholder-gray-500">
                <i class="fas fa-search absolute right-3 top-3.5 text-gray-500"></i>
            </div>

            <a href="{{ route('songs.create') }}" 
               class="bg-gradient-to-r from-pink-600 via-purple-600 to-indigo-600 hover:from-pink-700 hover:to-indigo-700 text-white font-semibold py-3 px-6 rounded-xl flex items-center justify-center gap-2 transition-all duration-300 transform hover:scale-105 shadow-lg">
                <i class="fas fa-plus"></i> Thêm Bài Hát
            </a>
        </div>

        <!-- SONG LIST -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 mb-24 animate-fade-in">
            @foreach ($songs as $index => $song)
                <div class="song-card bg-gray-800/60 rounded-2xl p-4 cursor-pointer relative overflow-hidden hover:bg-gray-700/70 transition group" data-index="{{ $index }}">
                    <!-- ✅ Nút chỉnh sửa & xóa (đã thêm z-20) -->
                    <div class="absolute top-3 right-3 flex gap-2 opacity-0 group-hover:opacity-100 transition z-20">
                        <a href="{{ route('songs.edit', $song->id) }}" 
                           class="bg-white/20 hover:bg-pink-500 text-white p-2 rounded-full transition" 
                           title="Chỉnh sửa">
                            <i class="fas fa-edit"></i>
                        </a>

                        <form action="{{ route('songs.destroy', $song->id) }}" method="POST" 
                              onsubmit="return confirm('Bạn có chắc chắn muốn xóa bài hát này không?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" 
                                    class="bg-white/20 hover:bg-red-500 text-white p-2 rounded-full transition" 
                                    title="Xóa bài hát">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </div>

                    <div class="relative">
                        <img src="{{ $song->image_path ? asset('storage/' . $song->image_path) : asset('images/logo.png') }}"
                             class="w-full h-48 object-cover rounded-xl mb-4 shadow-md">
                        <div class="play-icon absolute inset-0 flex items-center justify-center opacity-0 transition-all duration-300">
                            <div class="w-14 h-14 bg-gradient-to-r from-pink-500 to-purple-500 rounded-full flex items-center justify-center shadow-lg">
                                <i class="fas fa-play text-xl text-white"></i>
                            </div>
                        </div>
                    </div>
                    <h3 class="font-bold text-lg truncate text-white">{{ $song->title }}</h3>
                    <p class="text-gray-300 text-sm">{{ $song->artist->name ?? 'Không rõ nghệ sĩ' }}</p>
                </div>
            @endforeach
        </div>
    </div>

    <!-- PLAYER -->
    <div id="music-player" class="fixed bottom-0 left-0 right-0 blur-bg border-t border-gray-800/50 z-50">
        <div class="container mx-auto px-4 py-3 flex flex-col md:flex-row items-center gap-4">
            <div class="flex items-center gap-3">
                <img id="player-album-art" src="{{ asset('images/logo.png') }}" class="w-12 h-12 rounded-lg object-cover">
                <div>
                    <h4 id="player-title" class="font-semibold text-white">Chọn bài hát để phát</h4>
                    <p id="player-artist" class="text-xs text-gray-400">Nghệ sĩ</p>
                </div>
            </div>

            <div class="flex items-center gap-4">
                <button id="shuffle-btn" class="text-gray-400 hover:text-cyan-400"><i class="fas fa-random"></i></button>
                <button id="prev-btn" class="text-xl hover:text-pink-400"><i class="fas fa-step-backward"></i></button>
                <button id="play-pause-btn" class="bg-pink-600 hover:bg-pink-700 text-white w-10 h-10 rounded-full flex items-center justify-center transition"><i class="fas fa-play"></i></button>
                <button id="next-btn" class="text-xl hover:text-pink-400"><i class="fas fa-step-forward"></i></button>
                <button id="repeat-btn" class="text-gray-400 hover:text-pink-400"><i class="fas fa-redo"></i></button>
            </div>

            <div class="flex-1 mx-6 flex items-center gap-3">
                <span id="current-time" class="text-xs text-gray-400 w-10">0:00</span>
                <input type="range" id="progress-bar" class="progress-bar flex-1 h-1 bg-gray-700 rounded-full cursor-pointer" min="0" max="0" value="0">
                <span id="duration" class="text-xs text-gray-400 w-10">0:00</span>
                <div id="visualizer" class="hidden md:flex items-end ml-3">
                    <div class="visualizer-bar" style="animation-delay: 0s"></div>
                    <div class="visualizer-bar" style="animation-delay: .2s"></div>
                    <div class="visualizer-bar" style="animation-delay: .4s"></div>
                    <div class="visualizer-bar" style="animation-delay: .6s"></div>
                    <div class="visualizer-bar" style="animation-delay: .8s"></div>
                </div>
            </div>

            <div class="flex items-center gap-3">
                <i id="volume-icon" class="fas fa-volume-up text-gray-400"></i>
                <input type="range" id="volume-bar" class="volume-bar w-20 h-1 bg-gray-700 rounded-full cursor-pointer" min="0" max="1" step="0.01" value="1">
            </div>
        </div>
    </div>

    <!-- SCRIPT -->
    <script>
    const songsData = [
        @foreach ($songs as $song)
            {
                src: "{{ route('song.file', basename($song->file_path)) }}",
                title: "{{ $song->title }}",
                artist: "{{ $song->artist->name ?? 'Không rõ nghệ sĩ' }}",
                image: "{{ $song->image_path ? asset('storage/' . $song->image_path) : asset('images/logo.png') }}"
            }{{ !$loop->last ? ',' : '' }}
        @endforeach
    ];

    const audio = new Audio();
    let isPlaying = false, isRepeat = false, isShuffle = false, currentSong = 0;

    const pb = document.getElementById('progress-bar');
    const vb = document.getElementById('volume-bar');
    const playBtn = document.getElementById('play-pause-btn');
    const visualizer = document.getElementById('visualizer');

    const format = s => `${Math.floor(s/60)}:${String(Math.floor(s%60)).padStart(2,'0')}`;

    const loadSong = (i) => {
        const s = songsData[i];
        audio.src = s.src;
        document.getElementById('player-title').textContent = s.title;
        document.getElementById('player-artist').textContent = s.artist;
        document.getElementById('player-album-art').src = s.image;
        audio.load();
    };

    const playSong = (i) => {
        currentSong = i;
        loadSong(i);
        audio.play();
        isPlaying = true;
        playBtn.innerHTML = '<i class="fas fa-pause"></i>';
        visualizer.style.display = 'flex';
    };

    const togglePlay = () => {
        if (!audio.src) return;
        isPlaying ? audio.pause() : audio.play();
    };

    const next = () => {
        currentSong = isShuffle ? Math.floor(Math.random() * songsData.length) : (currentSong + 1) % songsData.length;
        playSong(currentSong);
    };

    const prev = () => {
        currentSong = (currentSong - 1 + songsData.length) % songsData.length;
        playSong(currentSong);
    };

    // Update UI
    audio.addEventListener('play', () => {
        isPlaying = true;
        playBtn.innerHTML = '<i class="fas fa-pause"></i>';
        visualizer.style.display = 'flex';
    });
    audio.addEventListener('pause', () => {
        isPlaying = false;
        playBtn.innerHTML = '<i class="fas fa-play"></i>';
        visualizer.style.display = 'none';
    });

    // Progress
    audio.addEventListener('loadedmetadata', () => {
        pb.max = audio.duration;
        document.getElementById('duration').textContent = format(audio.duration);
    });
    audio.addEventListener('timeupdate', () => {
        pb.value = audio.currentTime;
        document.getElementById('current-time').textContent = format(audio.currentTime);
    });
    pb.addEventListener('input', e => { audio.currentTime = e.target.value; });

    // Volume
    vb.addEventListener('input', e => { audio.volume = e.target.value; });

    // Ended
    audio.addEventListener('ended', () => { isRepeat ? playSong(currentSong) : next(); });

    // Controls
    playBtn.onclick = togglePlay;
    document.getElementById('next-btn').onclick = next;
    document.getElementById('prev-btn').onclick = prev;
    document.getElementById('repeat-btn').onclick = e => { isRepeat = !isRepeat; e.target.classList.toggle('text-pink-400'); };
    document.getElementById('shuffle-btn').onclick = e => { isShuffle = !isShuffle; e.target.classList.toggle('text-cyan-400'); };

    document.querySelectorAll('.song-card').forEach((c,i)=>c.onclick=()=>playSong(i));
    </script>
</body>
</html>
