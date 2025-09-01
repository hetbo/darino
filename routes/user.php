<?php

use App\Http\Controllers\AuthController;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/** @todo add throttle  before deploy * */

Route::middleware('guest')->group(function () {

    Route::post('/login', [AuthController::class, 'login'])->name('login');
    Route::view('/login', 'auth.login')->name('login');

    Route::post('/register', [AuthController::class, 'register'])->name('register');
    Route::view('/register', 'auth.register')->name('register');

    Route::get('/email/verify', [AuthController::class, 'verifyEmailNotice'])->middleware(['signed'])->name('verification.notice');
    Route::post('/email/verification-notification', [AuthController::class, 'resendVerificationEmail'])->name('verification.send');

    Route::view('/forgot-password', 'auth.forgot-password')->name('password.request');
    Route::post('/forgot-password', [AuthController::class, 'sendPasswordResetLink'])->name('password.email');

    Route::get('/reset-password/{token}', [AuthController::class, 'showResetPasswordForm'])->name('password.reset');
    Route::post('/reset-password', [AuthController::class, 'resetPassword'])->name('password.update');

});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    /** @todo remove this in production * */
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::view('/dashboard', 'user.dashboard')->name('dashboard');

    Route::get('/profile')->name('user-profile-information.update');

});

Route::get('/email/verify/{id}/{hash}', [AuthController::class, 'verifyEmail'])
    ->middleware(['signed'])
    ->name('verification.verify');

/** @todo remove for production - quick login for testing **/
Route::get('/ql/{i}', function ($i) {
    if (auth()->user()) {
        Auth::logout();
        return ['logged out'];
    }
    Auth::loginUsingId($i);
    return ['logged in as ' . auth()->user()->name];
})->withoutMiddleware(VerifyCsrfToken::class);
Route::get('/user', function () {
    return Auth::user();
});
