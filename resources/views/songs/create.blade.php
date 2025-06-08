<x-app-layout>
    <div class="min-h-screen bg-cover bg-center bg-no-repeat" style="background-image: url('/images/background.jpg');">
        <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
            <div class="bg-white bg-opacity-90 rounded-xl shadow-2xl p-8 animate-fade-in">
                <h2 class="text-3xl font-bold text-gray-900 mb-6 text-center">Thêm Bài Hát Mới</h2>
                <form method="POST" action="{{ route('songs.store') }}" enctype="multipart/form-data" class="space-y-6">
                    @csrf

                    <!-- Title -->
                    <div>
                        <label for="title" class="block text-sm font-medium text-gray-700">Tiêu Đề</label>
                        <input id="title" name="title" type="text" value="{{ old('title') }}" required class="mt-1 block w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                        @error('title')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Artist -->
                    <div>
                        <label for="artist_name" class="block text-sm font-medium text-gray-700">Nghệ Sĩ</label>
                        <input id="artist_name" name="artist_name" type="text" value="{{ old('artist_name') }}" required class="mt-1 block w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                        @error('artist_name')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Genre -->
                    <div>
                        <label for="genre_name" class="block text-sm font-medium text-gray-700">Thể Loại</label>
                        <input id="genre_name" name="genre_name" type="text" value="{{ old('genre_name') }}" required class="mt-1 block w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                        @error('genre_name')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- File -->
                    <div>
                        <label for="file" class="block text-sm font-medium text-gray-700">File Nhạc (MP3)</label>
                        <input id="file" name="file" type="file" accept=".mp3" required class="mt-1 block w-full text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none">
                        @error('file')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Image -->
                    <div>
                        <label for="image" class="block text-sm font-medium text-gray-700">Ảnh Bài Hát (Tùy Chọn)</label>
                        <input id="image" name="image" type="file" accept="image/*" class="mt-1 block w-full text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none">
                        @error('image')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <button type="submit" class="w-full bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 text-white font-semibold py-3 rounded-lg transition duration-200">
                            Thêm Bài Hát
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>