<x-app-layout>
    <div class="min-h-screen bg-cover bg-center bg-no-repeat" style="background-image: url('/images/background.jpg');">
        <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <img src="/images/logo_new.png" alt="Logo" class="h-24 mx-auto mb-4 transition-transform duration-300 hover:scale-110">
                <h1 class="text-5xl font-extrabold bg-gradient-to-r from-purple-500 via-pink-500 to-indigo-500 bg-clip-text text-transparent drop-shadow-md">
                    Your Artists
                </h1>
                <p class="mt-3 text-lg text-gray-500 dark:text-gray-300 font-medium">
                    Quản lý nghệ sĩ của bạn!
                </p>
            </div>

            <div class="text-right mb-6">
                <a href="{{ route('artists.create') }}" class="bg-gradient-to-r from-indigo-600 to-purple-600 text-white font-semibold py-3 px-6 rounded-lg shadow-md hover:from-indigo-700 hover:to-purple-700 transition duration-300 transform hover:scale-105">
                    <i class="fas fa-plus mr-2"></i> Thêm Nghệ Sĩ Mới
                </a>
            </div>

            @if (session('success'))
                <div class="mb-6 bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded-lg">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white bg-opacity-90 rounded-xl shadow-2xl overflow-hidden animate-fade-in">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gradient-to-r from-indigo-600 to-purple-600">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-white uppercase tracking-wider">Ảnh</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-white uppercase tracking-wider">Tên</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-white uppercase tracking-wider">Tiểu Sử</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-white uppercase tracking-wider">Hành Động</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse ($artists as $artist)
                                <tr class="hover:bg-gray-50 transition duration-200">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <img src="{{ $artist->image_path ? asset('storage/' . $artist->image_path) : '/images/logo_new.png' }}" alt="{{ $artist->name }}" class="w-12 h-12 rounded">
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $artist->name }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $artist->bio ?? 'N/A' }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <a href="{{ route('artists.edit', $artist) }}" class="text-indigo-600 hover:text-indigo-900 mr-4 transition duration-200">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('artists.destroy', $artist) }}" method="POST" class="inline" onsubmit="return confirm('Bạn có chắc muốn xóa?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-700 transition duration-200">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-6 py-4 text-center text-gray-500">Không có nghệ sĩ nào.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>