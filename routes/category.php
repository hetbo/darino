<?php

use App\Http\Controllers\CategoryController;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')
    ->controller(CategoryController::class)
    ->withoutMiddleware(VerifyCsrfToken::class) /** @todo remove this line for production **/
    ->prefix('categories')
    ->name('categories.')
    ->group(function () {
        Route::get('/', 'index')->name('index');
        Route::post('/', 'store')->name('store');
        Route::get('/{category}', 'show')->name('show');
        Route::put('/{category}', 'update')->name('update');
        Route::patch('/{category}', 'update')->name('patch');
        Route::delete('/{category}', 'destroy')->name('destroy');
        Route::get('/type/{type}', 'getByType')->name('by-type');
    });
Route::get('/categories-colors', [CategoryController::class, 'getAvailableColors'])->name('categories.colors');
