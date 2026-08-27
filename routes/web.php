<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', [\App\Http\Controllers\Customer\HomeController::class, 'index'])->name('home');
Route::get('/iphone/{id}', [\App\Http\Controllers\Customer\HomeController::class, 'show'])->name('iphone.show');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [\App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');
    Route::resource('iphones', \App\Http\Controllers\Admin\IphoneController::class);
    Route::resource('bookings', \App\Http\Controllers\Admin\BookingController::class)->only(['index', 'show']);
    Route::post('bookings/{booking}/verify', [\App\Http\Controllers\Admin\BookingController::class, 'verifyPayment'])->name('bookings.verify');
    Route::post('bookings/{booking}/reject', [\App\Http\Controllers\Admin\BookingController::class, 'rejectPayment'])->name('bookings.reject');
    Route::resource('users', \App\Http\Controllers\Admin\UserController::class);
    Route::post('bookings/{booking}/active', [\App\Http\Controllers\Admin\BookingController::class, 'markActive'])->name('bookings.active');
    Route::post('bookings/{booking}/return', [\App\Http\Controllers\Admin\BookingController::class, 'processReturn'])->name('bookings.return');
});

Route::post('/cart/dates', [\App\Http\Controllers\Customer\CartController::class, 'updateDates'])->name('cart.dates');
Route::get('/cart', [\App\Http\Controllers\Customer\CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add/{iphone}', [\App\Http\Controllers\Customer\CartController::class, 'add'])->name('cart.add');
Route::post('/cart/remove/{id}', [\App\Http\Controllers\Customer\CartController::class, 'remove'])->name('cart.remove');

Route::middleware(['auth', 'role:customer'])->name('customer.')->group(function () {
    Route::post('/checkout', [\App\Http\Controllers\Customer\CheckoutController::class, 'store'])->name('checkout');
    Route::get('/bookings', [\App\Http\Controllers\Customer\CustomerBookingController::class, 'index'])->name('bookings.index');
    Route::post('/bookings/{booking}/payment', [\App\Http\Controllers\Customer\CustomerBookingController::class, 'uploadPayment'])->name('bookings.payment');
    Route::post('/bookings/{booking}/review', [\App\Http\Controllers\Customer\CustomerBookingController::class, 'review'])->name('bookings.review');
});