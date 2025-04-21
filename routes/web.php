<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('Json');
});

Route::post('login', [UserController::class, 'login'])->name('login');

