<x-app-layout>
    <div class="min-h-screen bg-cover bg-center bg-no-repeat" style="background-image: url('/images/background.jpg');">
        <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h1 class="text-5xl font-extrabold bg-gradient-to-r from-purple-500 via-pink-500 to-indigo-500 bg-clip-text text-transparent drop-shadow-md">
                    Sửa Thông Tin Nghệ Sĩ
                </h1>
            </div>

            <div class="bg-white bg-opacity-90 rounded-xl shadow-2xl p-6">
                <form action="{{ route('artists.update', $artist) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="mb-4">
                        <label for="name" class="block text-sm font-medium text-gray-700">Tên Nghệ Sĩ</label>
                        <input type="text" name="name" id="name" value="{{ old('name', $artist->name) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" required>
                        @error('name') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="mb-4">
                        <label for="bio" class="block text-sm font-medium text-gray-700">Tiểu Sử</label>
                        <textarea name="bio" id="bio" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">{{ old('bio', $artist->bio) }}</textarea>
                        @error('bio') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="mb-4">
                        <label for="image" class="block text-sm font-medium text-gray-700">Ảnh Nghệ Sĩ</label>
                        @if($artist->image_path)
                            <img src="{{ asset('storage/' . $artist->image_path) }}" alt="{{ $artist->name }}" class="w-24 h-24 rounded mb-2">
                        @endif
                        <input type="file" name="image" id="image" class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100">
                        @error('image') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="text-right">
                        <button type="submit" class="bg-gradient-to-r from-indigo-600 to-purple-600 text-white font-semibold py-2 px-4 rounded-lg shadow-md hover:from-indigo-700 hover:to-purple-700 transition duration-300">
                            Cập Nhật Nghệ Sĩ
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>