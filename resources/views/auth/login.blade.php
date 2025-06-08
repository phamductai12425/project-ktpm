<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center bg-cover bg-center bg-no-repeat" style="background-image: linear-gradient(rgba(0, 0, 0, 0.3), rgba(0, 0, 0, 0.3)), url('/images/custom-background.jpg');">
        <div class="bg-white bg-opacity-80 p-8 rounded-xl shadow-2xl w-full max-w-md transform transition duration-300 hover:scale-105">
            <div class="text-center mb-6">
                <img src="{{ asset('images/custom-logo.jpg') }}" alt="Logo"
     class="h-20 mx-auto rounded-xl border border-gray-300 shadow-md transform transition duration-300 hover:scale-110">

                <h2 class="text-3xl font-bold text-gray-900 mt-4">Đăng Nhập</h2>
                <p class="text-gray-600 mt-2">Chào mừng bạn quay lại!</p>
            </div>
            <form method="POST" action="{{ route('login') }}" class="space-y-6">
                @csrf

                <!-- Email Address -->
                <div>
                    <x-input-label for="email" :value="__('Email')" class="text-gray-700" />
                    <x-text-input id="email" class="block mt-1 w-full rounded-lg border-gray-300 focus:border-green-500 focus:ring-green-500" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-600" />
                </div>

                <!-- Password -->
                <div>
                    <x-input-label for="password" :value="__('Mật Khẩu')" class="text-gray-700" />
                    <x-text-input id="password" class="block mt-1 w-full rounded-lg border-gray-300 focus:border-green-500 focus:ring-green-500" type="password" name="password" required autocomplete="current-password" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-600" />
                </div>

                <div class="flex items-center justify-between">
                    <label for="remember_me" class="flex items-center text-gray-700">
                        <input type="checkbox" name="remember" id="remember_me" class="rounded border-gray-300 text-indigo-600 focus:ring-indigo-500" />
                        <span class="ml-2 text-sm">Ghi nhớ tôi</span>
                    </label>
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="text-sm text-emerald-600 hover:text-emerald-800 font-medium">Quên mật khẩu?</a>
                    @endif
                </div>

                <div>
                    <x-primary-button class="w-full bg-gradient-to-r from-blue-600 to-green-600 hover:from-blue-700 hover:to-green-700 text-white font-semibold py-3 rounded-lg transition duration-200">
                        {{ __('Đăng Nhập') }}
                    </x-primary-button>
                </div>
            </form>
            <p class="text-center text-gray-600 mt-4">Chưa có tài khoản? <a href="{{ route('register') }}" class="text-emerald-600 hover:text-emerald-800 font-medium">Đăng ký ngay</a></p>
        </div>
    </div>
</x-guest-layout>