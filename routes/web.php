<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserContoller;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


//User Routes

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('loginPage');
Route::post('/login',[AuthController::class,'logining'])->name('login');
Route::get('/registration', [AuthController::class, 'showRegistrationForm'])->name('registerPage');
Route::post('/registration',[AuthController::class, 'registration'])->name('register');
Route::get('/logout',[AuthController::class,'logout'])->name('logout');

//User Routes

Route::get('/settings', [UserContoller::class, 'showSettings'])->name('user.settings')->middleware('auth');


//Articles Routes

Route::get('/articles', [ArticleController::class, 'index'])->name('articles.index')->middleware('auth');
Route::get('/articles/create',[ArticleController::class,'create'])->name('articles.create')->middleware('auth');
Route::post('/articles', [ArticleController::class,'store'])->name('articles.store')->middleware('auth');
Route::get('/articles{article}' ,[ArticleController::class,'show'])->name('articles.show')->middleware('auth');
Route::get('/articles{article}/edit',[ArticleController::class, 'edit'])->name('articles.edit')->middleware('auth');
Route::put('/articles/{article}', [ArticleController::class, 'update'])->name('articles.update')->middleware('auth');
Route::delete('/articles/{article}', [ArticleController::class, 'destroy'])->name('articles.destroy')->middleware('auth');



