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

