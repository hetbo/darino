<?php

use Illuminate\Support\Facades\Route;

require __DIR__ . '/user.php';
require __DIR__ . '/panel.php';
require __DIR__ . '/account.php';
require __DIR__ . '/category.php';
require __DIR__ . '/wallet.php';
require __DIR__ . '/transaction.php';

Route::get('/', function () {
    return view('welcome');
});
