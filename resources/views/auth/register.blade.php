<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center bg-cover bg-center bg-no-repeat" style="background-image: linear-gradient(rgba(0, 0, 0, 0.3), rgba(0, 0, 0, 0.3)), url('/images/custom-background.jpg');">
        <div class="bg-white bg-opacity-90 p-8 rounded-xl shadow-2xl w-full max-w-md transform transition duration-300 hover:scale-105">
            <div class="text-center mb-6">
              <img src="{{ asset('images/custom-logo.jpg') }}" alt="Logo"
     class="h-20 mx-auto rounded-xl border border-gray-300 shadow-md transform transition duration-300 hover:scale-110">

                <h2 class="text-3xl font-bold text-gray-900 mt-4">Đăng Ký Tài Khoản</h2>
                <p class="text-gray-600 mt-2">Tạo tài khoản để bắt đầu thưởng thức âm nhạc!</p>
            </div>
            <form method="POST" action="{{ route('register') }}" class="space-y-6">
                @csrf

                <!-- Name -->
                <div>
                    <x-input-label for="name" :value="__('Họ và Tên')" class="text-gray-700" />
                    <x-text-input id="name" class="block mt-1 w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                    <x-input-error :messages="$errors->get('name')" class="mt-2 text-red-600" />
                </div>

                <!-- Email Address -->
                <div>
                    <x-input-label for="email" :value="__('Email')" class="text-gray-700" />
                    <x-text-input id="email" class="block mt-1 w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500" type="email" name="email" :value="old('email')" required autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-600" />
                </div>

                <!-- Password -->
                <div>
                    <x-input-label for="password" :value="__('Mật Khẩu')" class="text-gray-700" />
                    <x-text-input id="password" class="block mt-1 w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500" type="password" name="password" required autocomplete="new-password" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-600" />
                </div>

                <!-- Confirm Password -->
                <div>
                    <x-input-label for="password_confirmation" :value="__('Xác Nhận Mật Khẩu')" class="text-gray-700" />
                    <x-text-input id="password_confirmation" class="block mt-1 w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500" type="password" name="password_confirmation" required autocomplete="new-password" />
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-red-600" />
                </div>

                <div>
                    <x-primary-button class="w-full bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 text-white font-semibold py-3 rounded-lg transition duration-200">
                        {{ __('Đăng Ký') }}
                    </x-primary-button>
                </div>
            </form>
            <p class="text-center text-gray-600 mt-4">Đã có tài khoản? <a href="{{ route('login') }}" class="text-indigo-600 hover:text-indigo-800 font-medium">Đăng nhập ngay</a></p>
        </div>
    </div>
</x-guest-layout>