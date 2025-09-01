<?php

use App\Http\Controllers\WalletController;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')
    ->controller(WalletController::class)
    ->withoutMiddleware(VerifyCsrfToken::class) /** @todo remove this line for production **/
    ->prefix('wallets')
    ->name('wallets.')
    ->group(function () {

        Route::get('/', 'index')->name('index');
        Route::post('/', 'store')->name('store');
        Route::get('/{wallet}', 'show')->name('show');
        Route::put('/{wallet}', 'update')->name('update');
        Route::delete('/{wallet}', 'destroy')->name('destroy');


    });
