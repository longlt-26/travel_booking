<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TourController;
use App\Models\Tour;
use Illuminate\Support\Facades\Route;

// ==========================================================
// 1. DÀNH CHO KHÁCH HÀNG (Bên ngoài - Ai cũng xem được)
// ==========================================================

// Trang chủ hiển thị danh sách tour
Route::get('/', [TourController::class, 'index'])->name('tours.index');

// Trang xem chi tiết 1 tour
Route::get('/tour/{id}', [TourController::class, 'show'])->name('tours.show');


// ==========================================================
// 2. DÀNH CHO ADMIN / USER (Bên trong - Bắt buộc đăng nhập)
// ==========================================================
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    // Quản lý Profile mặc định của Breeze
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';