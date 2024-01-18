<?php

use App\Http\Controllers\IndexController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\PdfController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () { return view('index'); })->name('index');

Route::post('/login', [IndexController::class, "checkLogin"])->name('login');
Route::post('/register', [IndexController::class, "checkRegister"])->name('register');
Route::post('/recoverPassword', [IndexController::class, "checkRecoverPass"])->name('recoverPassword');

Route::get('/main', [MainController::class, "viewMain"])->name('main')->middleware('auth');

Route::get('/registration', [RegistrationController::class, "viewRegistration"])->name('registration');
Route::get('/generatepdf', [PdfController::class, "generarPDF"])->name('generatePDF');
Route::get('/logout', [MainController::class, "logout"])->name('logout');

Route::post('/filter', [MainController::class, "filterInstruments"])->name('filter');

Route::post('/insertInstrument', [RegistrationController::class, "insertInstrument"])->name('insertInstrument');



