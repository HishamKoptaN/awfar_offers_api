<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\CheckAuthController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ChangePassController;
use Illuminate\Support\Facades\Route;

Route::post('/check', [CheckAuthController::class, 'check']);
Route::post('/login', [LoginController::class, 'login']);
Route::post('/login', [LoginController::class, 'login']);
Route::post('/register', [RegisterController::class, 'register']);
Route::post('/edit-pass', [ChangePassController::class, 'edit']);
Route::get(
    '/test',
    function () {
        return "test auth";
    },
);
