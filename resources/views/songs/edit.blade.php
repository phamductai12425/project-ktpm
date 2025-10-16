<x-app-layout>
    <div class="min-h-screen bg-gradient-to-br from-blue-600 via-purple-700 to-pink-600 flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
        <div class="w-full max-w-2xl bg-white/10 backdrop-blur-lg border border-white/20 rounded-3xl shadow-2xl p-8 text-white animate-fade-in">

            <!-- Nút quay lại -->
            <div class="mb-6">
                <a href="{{ route('songs.index') }}" 
                   class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl text-sm font-semibold text-gray-100 bg-gradient-to-r from-pink-500/40 to-purple-500/40 hover:from-pink-500/60 hover:to-purple-600/60 transition duration-300 transform hover:-translate-y-0.5 hover:shadow-lg">
                    <i class="fas fa-arrow-left"></i> Trở về Trang Chủ
                </a>
            </div>

            <!-- Tiêu đề -->
            <h2 class="text-4xl font-extrabold text-center mb-8 bg-gradient-to-r from-pink-400 via-purple-400 to-blue-400 bg-clip-text text-transparent animate-glow">
                🎧 Chỉnh Sửa Bài Hát
            </h2>

            <!-- Form -->
            <form method="POST" action="{{ route('songs.update', $song) }}" enctype="multipart/form-data" class="space-y-6">
                @csrf
                @method('PUT')

                <!-- Tiêu đề -->
                <div>
                    <label for="title" class="block text-sm font-semibold text-pink-200 mb-1">Tiêu đề</label>
                    <input id="title" name="title" type="text" value="{{ old('title', $song->title) }}" 
                           class="block w-full rounded-lg bg-white/20 border border-white/30 text-white placeholder-gray-300 
                                  focus:ring-2 focus:ring-pink-400 focus:border-transparent px-3 py-2" 
                           placeholder="Nhập tên bài hát..." required>
                    @error('title')
                        <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Nghệ sĩ -->
                <div>
                    <label for="artist_name" class="block text-sm font-semibold text-pink-200 mb-1">Nghệ sĩ</label>
                    <input id="artist_name" name="artist_name" type="text" 
                           value="{{ old('artist_name', $song->artist->name ?? '') }}"
                           placeholder="Nhập hoặc thay đổi tên nghệ sĩ..."
                           class="block w-full rounded-lg bg-white/20 border border-white/30 text-white placeholder-gray-300 
                                  focus:ring-2 focus:ring-pink-400 focus:border-transparent px-3 py-2" required>
                    @error('artist_name')
                        <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Thể loại -->
                <div>
                    <label for="genre_name" class="block text-sm font-semibold text-pink-200 mb-1">Thể loại</label>
                    <input id="genre_name" name="genre_name" type="text" 
                           value="{{ old('genre_name', $song->genre->name ?? '') }}"
                           placeholder="Nhập hoặc thay đổi thể loại..."
                           class="block w-full rounded-lg bg-white/20 border border-white/30 text-white placeholder-gray-300 
                                  focus:ring-2 focus:ring-pink-400 focus:border-transparent px-3 py-2" required>
                    @error('genre_name')
                        <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Ảnh -->
                <div>
                    <label for="image" class="block text-sm font-semibold text-pink-200 mb-2">Ảnh bài hát (tùy chọn)</label>
                    @if ($song->image_path)
                        <img src="{{ asset('storage/' . $song->image_path) }}" alt="{{ $song->title }}" 
                             class="mb-3 w-32 h-32 object-cover rounded-lg shadow-lg border border-white/20">
                    @else
                        <p class="text-gray-300 mb-2">Chưa có ảnh</p>
                    @endif
                    <input id="image" name="image" type="file" accept="image/*"
                           class="block w-full text-sm text-white file:mr-4 file:py-2 file:px-4 
                                  file:rounded-full file:border-0 file:text-sm 
                                  file:font-semibold file:bg-gradient-to-r file:from-pink-500 file:to-purple-600
                                  file:text-white hover:file:from-pink-600 hover:file:to-purple-700 cursor-pointer">
                    @error('image')
                        <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Nút cập nhật -->
                <div class="pt-6 flex justify-center">
                    <button type="submit"
                        class="bg-gradient-to-r from-pink-500 via-purple-500 to-blue-500 
                               hover:from-pink-600 hover:to-blue-600 font-bold text-white py-3 px-8 rounded-xl shadow-lg 
                               transition-all duration-300 transform hover:-translate-y-1 hover:shadow-2xl animate-pulse">
                        <i class="fas fa-save mr-2"></i> Cập Nhật Bài Hát
                    </button>
                </div>
            </form>
        </div>
    </div>

    <style>
        @keyframes fadeIn { from { opacity: 0; transform: translateY(20px); } to { opacity: 1; transform: translateY(0); } }
        @keyframes glow {
            0%, 100% { text-shadow: 0 0 5px rgba(255, 255, 255, 0.5); }
            50% { text-shadow: 0 0 20px rgba(255, 255, 255, 0.8), 0 0 30px rgba(236, 72, 153, 0.5); }
        }
        .animate-fade-in { animation: fadeIn 0.6s ease-out forwards; }
        .animate-glow { animation: glow 3s infinite; }
    </style>
</x-app-layout>
