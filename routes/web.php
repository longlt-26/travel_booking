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

Route::middleware('auth')->group(function () {
    Route::post('/bookings', [\App\Http\Controllers\BookingController::class, 'store'])->name('bookings.store');
    Route::match(['get', 'post'], '/bookings/{booking}/pay', [\App\Http\Controllers\BookingController::class, 'pay'])->name('bookings.pay');

});

Route::post('/payment/vnpay/callback', [\App\Http\Controllers\BookingController::class, 'vnpayCallback'])->name('payment.vnpay.callback');
Route::post('/payment/momo/callback', [\App\Http\Controllers\BookingController::class, 'momoCallback'])->name('payment.momo.callback');


// ==========================================================
// 2. DÀNH CHO ADMIN / USER (Bên trong - Bắt buộc đăng nhập)
// ==========================================================
Route::get('/dashboard', function () {
    // Tách trang dashboard theo role
    return auth()->user()->role === 'admin'
        ? redirect()->route('admin.dashboard')
        : redirect()->route('client.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/client/dashboard', function () {
        abort_unless(auth()->user()->role === 'user', 403);
        return view('client.dashboard');
    })->name('client.dashboard');
});


// ===== Admin routes (role=admin) =====
Route::middleware(['auth', 'verified'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [\App\Http\Controllers\Admin\AdminController::class, 'dashboard'])
        ->name('admin.dashboard');
});

Route::middleware('auth')->group(function () {
    // Quản lý Profile mặc định của Breeze
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


require __DIR__.'/auth.php';

