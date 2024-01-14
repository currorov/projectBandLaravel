<?php

use App\Http\Controllers\IndexController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\RegistrationController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () { return view('index'); })->name('login');

Route::post('/login', [IndexController::class, "checkLogin"])->name('login');
Route::post('/register', [IndexController::class, "checkRegister"])->name('register');
Route::post('/recoverPassword', [IndexController::class, "checkRecoverPass"])->name('recoverPassword');

Route::get('/main', [MainController::class, "viewMain"])->name('main');

Route::get('/registration', [RegistrationController::class, "viewRegistration"])->name('registration');

