<?php

use App\Http\Middleware\TokenVerificatinMiddleware;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// auth page route
Route::view('/', 'auth.dashboard')->name('dashboard')->middleware([TokenVerificatinMiddleware::class]);
Route::view('/profile', 'auth.profile')->name('profile')->middleware([TokenVerificatinMiddleware::class]);

// pages route
Route::view('/login', 'pages.login')->name('login');
Route::view('/register', 'pages.registration')->name('register');
Route::view('/forgot-password', 'pages.forgotPassword')->name('forgotPassword');
Route::view('/verify-otp', 'pages.verifyOTP')->name('otp');
Route::view('/reset-password', 'pages.resetPassword')->name('resetPassword')->middleware([TokenVerificatinMiddleware::class]);








// backend api route
Route::post('/user-register',[UserController::class,'UserRegister'])->name('user-register');
Route::post('/user-login',[UserController::class,'UserLogin'])->name('user-login');
Route::post('/user-send-otp',[UserController::class,'SendOTPCode'])->name('user-send-otp');
Route::post('/user-verify-otp',[UserController::class,'VerifyOTPCode'])->name('user-verify-otp');
Route::post('/user-reset-password',[UserController::class,'ResetPassword'])->name('user-reset-password');
Route::get('/user-logout',[UserController::class,'UserLogout'])->name('logout');
