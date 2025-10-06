<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-blue-600 via-indigo-700 to-purple-800">
        <div class="backdrop-blur-lg bg-white/20 border border-white/30 p-8 rounded-2xl shadow-2xl w-full max-w-md transform transition duration-500 hover:scale-[1.02]">
            
            <!-- Logo + Title -->
            <div class="text-center mb-8">
                <img src="{{ asset('images/custom-logo.jpg') }}" 
                     alt="Logo"
                     class="h-20 mx-auto rounded-xl border border-gray-200 shadow-lg transform transition duration-500 hover:rotate-3 hover:scale-105">
                <h2 class="text-3xl font-extrabold text-white mt-6 tracking-wide">Đăng Nhập</h2>
                <p class="text-indigo-100 mt-2">Chào mừng bạn quay lại với WebMusic 🎵</p>
            </div>

            <!-- Form -->
            <form method="POST" action="{{ route('login') }}" class="space-y-6">
                @csrf

                <!-- Email -->
                <div>
                    <x-input-label for="email" :value="__('Email')" class="text-white font-medium" />
                    <x-text-input id="email" 
                                  class="block mt-2 w-full rounded-xl border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 shadow-sm" 
                                  type="email" 
                                  name="email" 
                                  :value="old('email')" 
                                  required 
                                  autofocus 
                                  autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-400" />
                </div>

                <!-- Password -->
                <div>
                    <x-input-label for="password" :value="__('Mật khẩu')" class="text-white font-medium" />
                    <x-text-input id="password" 
                                  class="block mt-2 w-full rounded-xl border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 shadow-sm" 
                                  type="password" 
                                  name="password" 
                                  required 
                                  autocomplete="current-password" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-400" />
                </div>

                <!-- Remember + Forgot -->
                <div class="flex items-center justify-between text-sm">
                    <label for="remember_me" class="flex items-center text-white/90">
                        <input id="remember_me" type="checkbox" 
                               class="rounded border-gray-300 text-indigo-600 focus:ring-indigo-500" 
                               name="remember">
                        <span class="ml-2">Ghi nhớ tôi</span>
                    </label>

                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" 
                           class="text-indigo-200 hover:text-white transition">Quên mật khẩu?</a>
                    @endif
                </div>

                <!-- Submit -->
                <div>
                    <button type="submit"
                        class="w-full py-3 rounded-xl bg-gradient-to-r from-indigo-500 via-purple-600 to-pink-500 text-white font-bold shadow-lg hover:shadow-2xl hover:scale-[1.02] transition duration-300">
                        {{ __('Đăng Nhập') }}
                    </button>
                </div>
            </form>

            <!-- Register link -->
            <p class="text-center text-indigo-100 mt-6">
                Chưa có tài khoản?
                <a href="{{ route('register') }}" 
                   class="font-semibold text-white hover:text-yellow-300 transition">Đăng ký ngay</a>
            </p>
        </div>
    </div>
</x-guest-layout>
