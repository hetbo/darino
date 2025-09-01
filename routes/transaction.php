<?php

use App\Http\Controllers\TransactionController;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')
    ->controller(TransactionController::class)
    ->withoutMiddleware(VerifyCsrfToken::class) /** @todo remove this line for production **/
    ->prefix('transactions')
    ->name('transactions.')
    ->group(function () {

        Route::get('/', 'index')->name('index');
        Route::post('/', 'store')->name('store');
        Route::get('/{transaction}', 'show')->name('show');
        Route::put('/{transaction}', 'update')->name('update');
        Route::delete('/{transaction}', 'destroy')->name('destroy');


    });
