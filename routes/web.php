<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('loginPage');
Route::post('/login',[AuthController::class,'logining'])->name('login');
Route::get('/registration', [AuthController::class, 'showRegistrationForm'])->name('registerPage');
Route::post('/registration',[AuthController::class, 'registration'])->name('register');
Route::get('/logout',[AuthController::class,'logout'])->name('logout');





