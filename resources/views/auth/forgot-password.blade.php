<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center bg-cover bg-center bg-no-repeat" style="background-image: linear-gradient(rgba(0, 0, 0, 0.3), rgba(0, 0, 0, 0.3)), url('/images/custom-background.jpg');">
        <div class="bg-white bg-opacity-90 p-8 rounded-xl shadow-2xl w-full max-w-md transform transition duration-300 hover:scale-105">
            <div class="text-center mb-6">
                <img src="{{ asset('images/custom-logo.jpg') }}" alt="Logo"
     class="h-20 mx-auto rounded-xl border border-gray-300 shadow-md transform transition duration-300 hover:scale-110">


                <h2 class="text-3xl font-bold text-gray-900 mt-4">Quên Mật Khẩu</h2>
                <p class="text-gray-600 mt-2">Nhập email của bạn để nhận liên kết khôi phục mật khẩu.</p>
            </div>
            @if (session('status'))
                <div class="mb-4 font-medium text-sm text-green-600">
                    {{ session('status') }}
                </div>
            @endif
            <form method="POST" action="{{ route('password.email') }}" class="space-y-6">
                @csrf

                <!-- Email Address -->
                <div>
                    <x-input-label for="email" :value="__('Email')" class="text-gray-700" />
                    <x-text-input id="email" class="block mt-1 w-full rounded-lg border-gray-300 focus:border-green-500 focus:ring-green-500" type="email" name="email" :value="old('email')" required autofocus autocomplete="email" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-600" />
                </div>

                <div>
                    <x-primary-button class="w-full bg-gradient-to-r from-blue-600 to-green-600 hover:from-blue-700 hover:to-green-700 text-white font-semibold py-3 rounded-lg transition duration-200">
                        {{ __('Gửi Liên Kết Khôi Phục') }}
                    </x-primary-button>
                </div>
            </form>
            <p class="text-center text-gray-600 mt-4">Nhớ mật khẩu? <a href="{{ route('login') }}" class="text-emerald-600 hover:text-emerald-800 font-medium">Đăng nhập ngay</a></p>
        </div>
    </div>
</x-guest-layout>