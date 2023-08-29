<?php

use Illuminate\Support\Facades\Route;

//User Custom Login...
Route::get('/user/login', [App\Http\Controllers\AuthController::class, 'showLoginForm']);
Route::post('/user/login', [App\Http\Controllers\AuthController::class, 'userLogin']);

Route::get('/user/registration', [App\Http\Controllers\AuthController::class, 'showRegistrationForm']);
Route::post('/user/registration', [App\Http\Controllers\AuthController::class, 'userRegistration']);
//User Custom Login...
Route::get('/', [App\Http\Controllers\HomePageController::class, 'index']);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::post('/upload', [App\Http\Controllers\DocumentController::class, 'upload'])->name('upload');
Route::post('/user/edited-content', [App\Http\Controllers\DocumentController::class, 'editedContent']);

