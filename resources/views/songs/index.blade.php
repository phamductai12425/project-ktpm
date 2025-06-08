<x-app-layout>
    <div class="min-h-screen bg-cover bg-center bg-no-repeat relative" style="background-image: url('/images/background.jpg');">
        <!-- Header -->
        <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <img src="/images/logo1.jpg" alt="Logo" class="h-20 w-auto mx-auto mb-6 transition-transform duration-300 hover:scale-105 object-contain rounded-lg shadow-md">
                <h1 class="text-4xl sm:text-5xl md:text-6xl font-extrabold bg-gradient-to-r from-purple-500 via-pink-500 to-indigo-500 bg-clip-text text-transparent drop-shadow-lg animate-fade-in">
                    Your Music Library
                </h1>
                <p class="mt-4 text-lg sm:text-xl text-gray-600 dark:text-gray-400 font-medium">
                    Quản lý và thưởng thức âm nhạc của bạn !
                </p>
            </div>

            <!-- Add New Song Button -->
            <div class="text-right mb-8">
                <a href="{{ route('songs.create') }}"
                   class="inline-flex items-center bg-gradient-to-r from-indigo-600 to-purple-600 
                          text-blue text-xl font-bold tracking-wide drop-shadow-lg
                          py-3 px-6 rounded-xl shadow-lg 
                          hover:from-indigo-700 hover:to-purple-700 
                          transition-all duration-300 transform hover:scale-105 
                          focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    <i class="fas fa-plus mr-2"></i> Thêm Bài Hát Mới
                </a>
            </div>

            <!-- Songs List -->
            @if (session('success'))
                <div class="mb-6 bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded-xl shadow-md animate-fade-in">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white bg-opacity-95 rounded-2xl shadow-xl overflow-hidden animate-fade-in-up">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gradient-to-r from-indigo-600 to-purple-600">
                            <tr>
                                <th class="px-4 py-3 text-left text-xs font-semibold text-white uppercase tracking-wider">Ảnh</th>
                                <th class="px-4 py-3 text-left text-xs font-semibold text-white uppercase tracking-wider">Tiêu Đề</th>
                                <th class="px-4 py-3 text-left text-xs font-semibold text-white uppercase tracking-wider">Nghệ Sĩ</th>
                                <th class="px-4 py-3 text-left text-xs font-semibold text-white uppercase tracking-wider">Thể Loại</th>
                                <th class="px-4 py-3 text-left text-xs font-semibold text-white uppercase tracking-wider">Thời Lượng</th>
                                <th class="px-4 py-3 text-left text-xs font-semibold text-white uppercase tracking-wider">Hành Động</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-100">
                            @forelse ($songs as $index => $song)
                                <tr class="hover:bg-gray-50 transition-all duration-200 cursor-pointer group" data-index="{{ $index }}">
                                    <td class="px-4 py-3 whitespace-nowrap">
                                        <img src="{{ $song->image_path ? asset('storage/' . $song->image_path) : '/images/logo.png' }}" alt="{{ $song->title }}" class="w-12 h-12 rounded-lg object-cover shadow-sm group-hover:shadow-md transition-shadow duration-200">
                                    </td>
                                    <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-900 font-medium">{{ $song->title }}</td>
                                    <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-700">{{ $song->artist->name ?? 'Unknown Artist' }}</td>
                                    <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-700">{{ $song->genre->name ?? 'Unknown Genre' }}</td>
                                    <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-700">{{ gmdate('i:s', $song->duration ?? 0) }}</td>
                                    <td class="px-4 py-3 whitespace-nowrap text-sm font-medium">
                                        <a href="{{ route('songs.edit', $song) }}" class="text-indigo-600 hover:text-indigo-800 mr-4 transition-colors duration-200">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('songs.destroy', $song) }}" method="POST" class="inline" onsubmit="return confirm('Bạn có chắc muốn xóa?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-800 transition-colors duration-200">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-4 py-6 text-center text-gray-500 bg-gray-50">Không có bài hát nào.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Music Player -->
        <div id="music-player" class="fixed bottom-0 left-0 right-0 w-full bg-gray-900 bg-opacity-90 text-white p-4 shadow-2xl z-50" style="min-width:320px; max-width:100vw; width:100vw;">
            <div class="max-w-7xl mx-auto flex flex-col sm:flex-row items-center justify-between gap-4">
                <div class="flex items-center space-x-4">
                    <img id="player-album-art" src="/images/logo.png" alt="Album Art" class="w-14 h-14 rounded-lg object-cover shadow-md">
                    <div class="flex-1">
                        <div id="player-title" class="font-semibold text-lg truncate max-w-xs">Chọn bài hát để phát</div>
                        <div id="player-artist" class="text-sm text-gray-400 truncate max-w-xs">Nghệ sĩ</div>
                        <div id="player-genre" class="text-xs text-gray-500 truncate max-w-xs">Thể loại</div>
                    </div>
                </div>
                <div class="flex items-center w-full sm:w-auto space-x-4">
                    <button id="prev-btn" class="text-gray-400 hover:text-white transition-colors duration-200 p-2 rounded-full hover:bg-gray-700">
                        <i class="fas fa-step-backward"></i>
                    </button>
                    <button id="play-pause-btn" class="text-gray-400 hover:text-white transition-colors duration-200 p-2 rounded-full hover:bg-gray-700">
                        <i class="fas fa-play"></i>
                    </button>
                    <button id="next-btn" class="text-gray-400 hover:text-white transition-colors duration-200 p-2 rounded-full hover:bg-gray-700">
                        <i class="fas fa-step-forward"></i>
                    </button>
                    <div class="flex-1 flex items-center space-x-2">
                        <span id="current-time" class="text-sm text-gray-300">0:00</span>
                        <input type="range" id="progress-bar" class="w-full h-1 bg-gray-600 rounded-full cursor-pointer accent-indigo-500" min="0" max="0" value="0">
                        <span id="duration" class="text-sm text-gray-300">0:00</span>
                    </div>
                    <div class="flex items-center space-x-2">
                        <i class="fas fa-volume-up text-gray-400"></i>
                        <input type="range" id="volume-bar" class="w-20 h-1 bg-gray-600 rounded-full cursor-pointer accent-indigo-500" min="0" max="1" step="0.01" value="1">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Truyền dữ liệu vào JavaScript -->
    <script>
        const songsData = [
            @foreach ($songs as $index => $song)
                {
                    src: "{{ route('song.file', basename($song->file_path)) }}",
                    title: "{{ $song->title }}",
                    artist: "{{ $song->artist->name ?? 'Unknown Artist' }}",
                    genre: "{{ $song->genre->name ?? 'Unknown Genre' }}",
                    duration: {{ $song->duration ?? 0 }},
                    image: "{{ $song->image_path ? asset('storage/' . $song->image_path) : '/images/logo.png' }}"
                }{{ $loop->last ? '' : ',' }}
            @endforeach
        ];

        let audio = new Audio();
        let isPlaying = false;
        let currentSongIndex = -1;
        const progressBar = document.getElementById('progress-bar');

        const rows = document.querySelectorAll('tr[data-index]');
        rows.forEach(row => {
            row.addEventListener('click', () => {
                const index = parseInt(row.getAttribute('data-index'));
                playSong(songsData[index].src, songsData[index].title, songsData[index].artist, songsData[index].genre, songsData[index].image, index);
            });
        });

        function playSong(src, title, artist, genre, image, index) {
            if (audio.src === src && !audio.paused) {
                audio.pause();
                isPlaying = false;
                document.getElementById('play-pause-btn').innerHTML = '<i class="fas fa-play"></i>';
                return;
            }

            audio.src = src;
            audio.play();
            isPlaying = true;
            currentSongIndex = index;
            document.getElementById('play-pause-btn').innerHTML = '<i class="fas fa-pause"></i>';
            document.getElementById('player-title').textContent = title;
            document.getElementById('player-artist').textContent = artist;
            document.getElementById('player-genre').textContent = genre;
            document.getElementById('player-album-art').src = image;

            audio.onloadedmetadata = function() {
                progressBar.max = audio.duration;
                document.getElementById('duration').textContent = formatTime(audio.duration);
                updateProgress();
            };

            audio.onended = function() {
                playNext();
            };
        }

        function updateProgress() {
            const currentTime = document.getElementById('current-time');
            progressBar.value = audio.currentTime;
            currentTime.textContent = formatTime(audio.currentTime);

            if (!audio.paused && !audio.ended) {
                requestAnimationFrame(updateProgress);
            }
        }

        progressBar.addEventListener('input', function() {
            audio.currentTime = parseFloat(this.value);
        });

        const volumeBar = document.getElementById('volume-bar');
        volumeBar.addEventListener('input', function() {
            audio.volume = this.value;
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
            if (currentSongIndex > 0) {
                currentSongIndex--;
            } else {
                currentSongIndex = songsData.length - 1;
            }
            playSong(songsData[currentSongIndex].src, songsData[currentSongIndex].title, songsData[currentSongIndex].artist, songsData[currentSongIndex].genre, songsData[currentSongIndex].image, currentSongIndex);
        }

        function playNext() {
            if (currentSongIndex < songsData.length - 1) {
                currentSongIndex++;
            } else {
                currentSongIndex = 0;
            }
            playSong(songsData[currentSongIndex].src, songsData[currentSongIndex].title, songsData[currentSongIndex].artist, songsData[currentSongIndex].genre, songsData[currentSongIndex].image, currentSongIndex);
        }

        function formatTime(seconds) {
            const minutes = Math.floor(seconds / 60);
            const secs = Math.floor(seconds % 60);
            return `${minutes}:${secs < 10 ? '0' : ''}${secs}`;
        }
    </script>
</x-app-layout>