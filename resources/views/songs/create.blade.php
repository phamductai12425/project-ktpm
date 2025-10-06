<x-app-layout>
    <div class="min-h-screen bg-gradient-to-br from-cyan-500 via-purple-600 to-pink-500 bg-cover bg-center relative overflow-hidden">
        <div class="absolute inset-0 pointer-events-none">
            <div class="absolute w-96 h-96 bg-pink-400 rounded-full mix-blend-multiply filter blur-3xl opacity-30 animate-blob"></div>
            <div class="absolute w-96 h-96 bg-cyan-400 rounded-full mix-blend-multiply filter blur-3xl opacity-30 animate-blob animation-delay-2000"></div>
        </div>
        <div class="max-w-3xl mx-auto py-16 px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="bg-white bg-opacity-90 rounded-3xl shadow-2xl p-10 animate-slide-up backdrop-blur-xl border border-white/20">
                <h2 class="text-4xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-cyan-500 to-pink-500 mb-8 text-center animate-glow">
                    Thêm Bài Hát Mới
                </h2>
                <form id="song-form" method="POST" action="{{ route('songs.store') }}" enctype="multipart/form-data" class="space-y-8" onsubmit="return validateForm(event)">
                    @csrf
                    <!-- Tiêu đề -->
                    <div class="relative">
                        <label for="title" class="block text-sm font-semibold text-gray-800">Tiêu Đề</label>
                        <input id="title" name="title" type="text" value="{{ old('title') }}" required
                            class="mt-2 block w-full rounded-xl border border-gray-200 bg-gray-50/50 py-3 px-4 text-gray-900 focus:ring-4 focus:ring-cyan-300 focus:border-cyan-500 transition duration-300 ease-in-out placeholder-gray-400">
                        @error('title')
                            <p class="mt-2 text-sm text-red-400 font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Nghệ sĩ -->
                    <div class="relative">
                        <label for="artist_name" class="block text-sm font-semibold text-gray-800">Nghệ Sĩ</label>
                        <input id="artist_name" name="artist_name" type="text" value="{{ old('artist_name') }}" required
                            class="mt-2 block w-full rounded-xl border border-gray-200 bg-gray-50/50 py-3 px-4 text-gray-900 focus:ring-4 focus:ring-cyan-300 focus:border-cyan-500 transition duration-300 ease-in-out placeholder-gray-400">
                        @error('artist_name')
                            <p class="mt-2 text-sm text-red-400 font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Thể loại -->
                    <div class="relative">
                        <label for="genre_name" class="block text-sm font-semibold text-gray-800">Thể Loại</label>
                        <input id="genre_name" name="genre_name" type="text" value="{{ old('genre_name') }}" required
                            class="mt-2 block w-full rounded-xl border border-gray-200 bg-gray-50/50 py-3 px-4 text-gray-900 focus:ring-4 focus:ring-cyan-300 focus:border-cyan-500 transition duration-300 ease-in-out placeholder-gray-400">
                        @error('genre_name')
                            <p class="mt-2 text-sm text-red-400 font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- File nhạc -->
                    <div class="relative">
                        <label for="file" class="block text-sm font-semibold text-gray-800">File Nhạc (MP3)</label>
                        <input id="file" name="file" type="file" accept=".mp3" required
                            class="mt-2 block w-full rounded-xl border border-gray-200 bg-gray-50/50 py-3 px-4 text-gray-900 file:bg-gradient-to-r file:from-cyan-500 file:to-pink-500 file:text-white file:rounded-lg file:border-0 file:py-2 file:px-4 file:cursor-pointer focus:outline-none transition duration-300 ease-in-out">
                        @error('file')
                            <p class="mt-2 text-sm text-red-400 font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Ảnh bài hát -->
                    <div class="relative">
                        <label for="image" class="block text-sm font-semibold text-gray-800">Ảnh Bài Hát (Tùy Chọn)</label>
                        <input id="image" name="image" type="file" accept="image/*"
                            class="mt-2 block w-full rounded-xl border border-gray-200 bg-gray-50/50 py-3 px-4 text-gray-900 file:bg-gradient-to-r file:from-cyan-500 file:to-pink-500 file:text-white file:rounded-lg file:border-0 file:py-2 file:px-4 file:cursor-pointer focus:outline-none transition duration-300 ease-in-out">
                        @error('image')
                            <p class="mt-2 text-sm text-red-400 font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Nút Thêm Bài Hát -->
                    <div class="flex justify-center">
                        <button type="submit"
    class="bg-gradient-to-r from-cyan-500 to-purple-600 hover:from-cyan-600 hover:to-purple-700 text-black font-bold py-4 px-8 rounded-xl shadow-lg transition duration-300 ease-in-out transform hover:-translate-y-1 hover:shadow-xl animate-pulse">
    Thêm Bài Hát
</button>

                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function validateForm(event) {
            const title = document.getElementById('title').value.trim();
            const artist = document.getElementById('artist_name').value.trim();
            const genre = document.getElementById('genre_name').value.trim();
            const file = document.getElementById('file').files[0];

            if (!title || !artist || !genre || !file) {
                event.preventDefault();
                alert('Vui lòng điền đầy đủ thông tin và chọn file MP3!');
                return false;
            }
            return true;
        }
    </script>

    <style>
        @keyframes slide-up {
            from { transform: translateY(50px); opacity: 0; }
            to { transform: translateY(0); opacity: 1; }
        }
        @keyframes blob {
            0% { transform: translate(0, 0) scale(1); }
            33% { transform: translate(30px, -50px) scale(1.1); }
            66% { transform: translate(-20px, 20px) scale(0.9); }
            100% { transform: translate(0, 0) scale(1); }
        }
        @keyframes glow {
            0%, 100% { text-shadow: 0 0 5px rgba(255, 255, 255, 0.5); }
            50% { text-shadow: 0 0 20px rgba(255, 255, 255, 0.8), 0 0 30px rgba(236, 72, 153, 0.5); }
        }

        .animate-slide-up { animation: slide-up 0.8s ease-out; }
        .animate-blob { animation: blob 7s infinite; }
        .animate-glow { animation: glow 3s infinite; }
        .animation-delay-2000 { animation-delay: 2s; }
    </style>
</x-app-layout>
