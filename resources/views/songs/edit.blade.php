<x-app-layout>
    <div class="min-h-screen bg-cover bg-center bg-no-repeat" style="background-image: url('/images/background.jpg');">
        <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
            <div class="bg-white bg-opacity-90 rounded-xl shadow-2xl p-8 animate-fade-in">
                <h2 class="text-3xl font-bold text-gray-900 mb-6 text-center">Chỉnh Sửa Bài Hát</h2>
                <form method="POST" action="{{ route('songs.update', $song) }}" enctype="multipart/form-data" class="space-y-6">
                    @csrf
                    @method('PUT')

                    <!-- Title -->
                    <div>
                        <label for="title" class="block text-sm font-medium text-gray-700">Tiêu Đề</label>
                        <input id="title" name="title" type="text" value="{{ old('title', $song->title) }}" required class="mt-1 block w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                        @error('title')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Artist -->
                    <div>
                        <label for="artist_id" class="block text-sm font-medium text-gray-700">Nghệ Sĩ</label>
                        <select id="artist_id" name="artist_id" required class="mt-1 block w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                            <option value="">Chọn nghệ sĩ</option>
                            @foreach(\App\Models\Artist::where('user_id', Auth::id())->get() as $artist)
                                <option value="{{ $artist->id }}" {{ old('artist_id', $song->artist_id) == $artist->id ? 'selected' : '' }}>{{ $artist->name }}</option>
                            @endforeach
                        </select>
                        @error('artist_id')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Genre -->
                    <div>
                        <label for="genre_id" class="block text-sm font-medium text-gray-700">Thể Loại</label>
                        <select id="genre_id" name="genre_id" required class="mt-1 block w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                            <option value="">Chọn thể loại</option>
                            @foreach(\App\Models\Genre::where('user_id', Auth::id())->get() as $genre)
                                <option value="{{ $genre->id }}" {{ old('genre_id', $song->genre_id) == $genre->id ? 'selected' : '' }}>{{ $genre->name }}</option>
                            @endforeach
                        </select>
                        @error('genre_id')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Image -->
                    <div>
                        <label for="image" class="block text-sm font-medium text-gray-700">Ảnh Bài Hát (Tùy Chọn)</label>
                        @if ($song->image_path)
                            <img src="{{ asset('storage/' . $song->image_path) }}" alt="{{ $song->title }}" class="mt-2 mb-2 w-32 h-32 object-cover rounded">
                        @else
                            <p class="mt-2 mb-2 text-gray-500">Chưa có ảnh</p>
                        @endif
                        <input id="image" name="image" type="file" accept="image/*" class="mt-1 block w-full text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none">
                        @error('image')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <button type="submit" class="w-full bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 text-white font-semibold py-3 rounded-lg transition duration-200">
                            Cập Nhật Bài Hát
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>