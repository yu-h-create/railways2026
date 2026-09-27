<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;

Route::get('/', function () {
    return view('welcome');
});

Route::view('/railway','railway');

Route::get('/login',[LoginController::class,'showLoginForm'])
   ->name('login');

Route::post('/login', [LoginController::class, 'login']);

Route::view('/dashboard','dashboard')
   ->middleware('auth')
   ->name('dashboard');

Route::view('/railway', 'railway')
    ->middleware('auth')
    ->name('railway');

Route::post('/logout',[LoginController::class,'logout'])
    ->name('logout');