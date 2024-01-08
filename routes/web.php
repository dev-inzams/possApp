<?php

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

Route::get('/', function () {
    return view('welcome');
});







// backend route
Route::post('/user-register',[UserController::class,'UserRegister'])->name('user-register');
Route::post('/user-login',[UserController::class,'UserLogin'])->name('user-login');
Route::post('/user-send-otp',[UserController::class,'SendOTPCode'])->name('user-send-otp');
Route::post('/user-verify-otp',[UserController::class,'VerifyOTPCode'])->name('user-verify-otp');
Route::post('/user-reset-password',[UserController::class,'ResetPassword'])->name('user-reset-password');
