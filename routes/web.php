<?php

use Illuminate\Support\Facades\Route;

require __DIR__ . '/user.php';
require __DIR__ . '/panel.php';
require __DIR__ . '/account.php';

Route::get('/', function () {
    return view('welcome');
});
