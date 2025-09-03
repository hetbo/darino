<?php

use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');
    Route::get('/dashboard/{account}', [DashboardController::class, 'index'])->name('dashboard.account');

    Route::get('/new-account', [DashboardController::class, 'newAccount'])->name('create-new-account');

    Route::get('/dashboard/{account}/wallets', [DashboardController::class, 'viewWallets'])->name('panel.wallets');

});
