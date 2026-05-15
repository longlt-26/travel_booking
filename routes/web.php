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
    Route::get('/my-bookings', [\App\Http\Controllers\BookingController::class, 'index'])->name('bookings.index');
    Route::get('/my-bookings/{booking}', [\App\Http\Controllers\BookingController::class, 'show'])->name('bookings.show');
    Route::post('/bookings', [\App\Http\Controllers\BookingController::class, 'store'])->name('bookings.store');
    Route::match(['get', 'post'], '/bookings/{booking}/pay', [\App\Http\Controllers\BookingController::class, 'pay'])->name('bookings.pay');
});

Route::post('/payment/vnpay/callback', [\App\Http\Controllers\BookingController::class, 'vnpayCallback'])->name('payment.vnpay.callback');
Route::post('/payment/momo/callback', [\App\Http\Controllers\BookingController::class, 'momoCallback'])->name('payment.momo.callback');


// ==========================================================
// 2. DÀNH CHO ADMIN / USER (Bên trong - Bắt buộc đăng nhập)
// ==========================================================
// Dashboard cho user đã được xóa theo yêu cầu: chỉ admin mới có trang quản trị.



// ===== Admin routes (role=admin) =====
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [\App\Http\Controllers\Admin\AdminController::class, 'dashboard'])->name('dashboard');
    Route::resource('tours', \App\Http\Controllers\Admin\TourAdminController::class);
    
    // Quản lý đơn hàng
    Route::get('bookings', [\App\Http\Controllers\Admin\BookingController::class, 'index'])->name('bookings.index');
    Route::patch('bookings/{booking}/status', [\App\Http\Controllers\Admin\BookingController::class, 'updateStatus'])->name('bookings.updateStatus');
    Route::delete('bookings/{booking}', [\App\Http\Controllers\Admin\BookingController::class, 'destroy'])->name('bookings.destroy');
});

// Trang sau khi login (Breeze redirect về route('dashboard'))
Route::middleware(['auth'])->get('/dashboard', function () {
    $user = auth()->user();

    return $user && $user->role === 'admin'
        ? redirect()->route('admin.dashboard')
        : redirect()->route('tours.index');
})->name('dashboard');


Route::middleware('auth')->group(function () {
    // Quản lý Profile mặc định của Breeze
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


require __DIR__.'/auth.php';

