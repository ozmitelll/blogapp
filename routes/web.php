<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');


//User Routes

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('loginPage');
Route::post('/login',[AuthController::class,'logining'])->name('login');
Route::get('/registration', [AuthController::class, 'showRegistrationForm'])->name('registerPage');
Route::post('/registration',[AuthController::class, 'registration'])->name('register');
Route::get('/logout',[AuthController::class,'logout'])->name('logout');

//User Routes

Route::get('/settings', [UserController::class, 'showSettings'])->name('user.settings')->middleware('auth');
Route::put('/settings/edit', [UserController::class, 'editUser'])->name('user.update')->middleware('auth');
//Articles Routes

Route::get('/articles', [ArticleController::class, 'index'])->name('articles.index')->middleware('auth');
Route::get('/articles/create',[ArticleController::class,'create'])->name('articles.create')->middleware('auth');
Route::post('/articles', [ArticleController::class,'store'])->name('articles.store')->middleware('auth');
Route::get('/articles{article}' ,[ArticleController::class,'show'])->name('articles.show')->middleware('auth');
Route::get('/articles{article}/edit',[ArticleController::class, 'edit'])->name('articles.edit')->middleware('auth');
Route::put('/articles/{article}', [ArticleController::class, 'update'])->name('articles.update')->middleware('auth');
Route::delete('/articles/{article}', [ArticleController::class, 'destroy'])->name('articles.destroy')->middleware('auth');

//Comments Routes
Route::post('/articles{article}/comments', [ArticleController::class, 'storeComment'])->name('articles.comment.store')->middleware('auth');
Route::delete('/articles/{article}/comments/{comment}',[ArticleController::class,'destroyComment'])->name('articles.comment.destroy')->middleware('auth');
Route::post('/articles/{article}/comments/{comment}/reply', [ArticleController::class, 'storeReply'])->name('articles.comment.reply')->middleware('auth');





