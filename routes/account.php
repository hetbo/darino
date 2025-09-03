<?php

use App\Http\Controllers\AccountController;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')
    ->controller(AccountController::class)
    ->prefix('accounts')
    ->name('accounts.')
    ->group(function () {

    Route::get('/', 'index')->name('index');
    Route::post('/', 'store')->name('store');
    Route::get('/{account}', 'show')->name('show');
    Route::put('/{account}', 'update')->name('update');
    Route::delete('/{account}', 'destroy')->name('destroy');

});
