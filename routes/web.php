<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SongController;
use App\Http\Controllers\ProfileController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
});

// Dashboard (nếu có dùng Laravel Breeze)
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// ✅ Các route chỉ dành cho người đăng nhập
Route::middleware('auth')->group(function () {
    // Trang chính của ứng dụng
    Route::get('/home', [HomeController::class, 'index'])->name('home');

    // CRUD bài hát
    Route::resource('songs', SongController::class);

    // Hồ sơ cá nhân
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Truy xuất file nhạc
    Route::get('/storage/songs/{filename}', function ($filename) {
        $path = storage_path('app/public/songs/' . $filename);
        if (!file_exists($path)) {
            abort(404);
        }
        return response()->file($path);
    })->name('song.file');

    // ✅ Đăng xuất (dành cho nút trong navbar)
    Route::post('/logout', function () {
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
        return redirect('/');
    })->name('logout');
});

// Gọi các route xác thực mặc định (login, register, forgot password, v.v.)
require __DIR__ . '/auth.php';
