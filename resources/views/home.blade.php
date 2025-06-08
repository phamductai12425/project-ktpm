<x-app-layout>
    <div class="min-h-screen bg-gray-900 text-white p-6">
        <h1 class="text-3xl font-bold mb-6">Trang Chủ - Phát Nhạc</h1>
        <div class="bg-gray-800 p-6 rounded-lg shadow-lg">
            <audio id="audioPlayer" src="{{ asset('audio/sample.mp3') }}" controls class="w-full mb-4 hidden"></audio>
            <div class="flex items-center justify-between mb-4">
                <button id="playPauseBtn" class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">Phát</button>
                <button id="prevBtn" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mx-2">Trước</button>
                <button id="nextBtn" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Tiếp</button>
            </div>
            <div class="flex items-center">
                <label for="volume" class="mr-2">Âm lượng:</label>
                <input type="range" id="volume" min="0" max="1" step="0.1" value="1" class="w-32">
            </div>
        </div>
    </div>

    @section('scripts')
        <script>
            const audioPlayer = document.getElementById('audioPlayer');
            const playPauseBtn = document.getElementById('playPauseBtn');
            const prevBtn = document.getElementById('prevBtn');
            const nextBtn = document.getElementById('nextBtn');
            const volumeControl = document.getElementById('volume');

            let isPlaying = false;

            playPauseBtn.addEventListener('click', () => {
                if (isPlaying) {
                    audioPlayer.pause();
                    playPauseBtn.textContent = 'Phát';
                } else {
                    audioPlayer.play();
                    playPauseBtn.textContent = 'Tạm Dừng';
                }
                isPlaying = !isPlaying;
            });

            prevBtn.addEventListener('click', () => {
                // Logic chuyển bài trước (chưa có danh sách, sẽ cập nhật sau)
                alert('Chuyển bài trước (chưa triển khai)');
            });

            nextBtn.addEventListener('click', () => {
                // Logic chuyển bài tiếp (chưa có danh sách, sẽ cập nhật sau)
                alert('Chuyển bài tiếp (chưa triển khai)');
            });

            volumeControl.addEventListener('input', () => {
                audioPlayer.volume = volumeControl.value;
            });
        </script>
    @endsection
</x-app-layout>