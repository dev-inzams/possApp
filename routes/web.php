<?php

use App\Http\Controllers\CategoryController;
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

// auth page route with token verification
Route::group(['middleware' => [TokenVerificatinMiddleware::class]], function () {
    Route::view('/', 'auth.dashboard')->name('dashboard');
    Route::get('/profile', [UserController::class, 'ProfileView'])->name('profile');
    //Route::view('/categories', 'auth.category')->name('categories');
});



// pages route
Route::view('/login', 'pages.login')->name('login');
Route::view('/register', 'pages.registration')->name('register');
Route::view('/forgot-password', 'pages.forgotPassword')->name('forgotPassword');
Route::view('/verify-otp', 'pages.verifyOTP')->name('otp');
Route::view('/reset-password', 'pages.resetPassword')->name('resetPassword')->middleware([TokenVerificatinMiddleware::class]);
Route::view('/categories', 'auth.category')->name('categories');







// backend api route
Route::post('/user-register',[UserController::class,'UserRegister'])->name('user-register');
Route::post('/user-login',[UserController::class,'UserLogin'])->name('user-login');
Route::post('/user-send-otp',[UserController::class,'SendOTPCode'])->name('user-send-otp');
Route::post('/user-verify-otp',[UserController::class,'VerifyOTPCode'])->name('user-verify-otp');



// group backend route for token verification
Route::group(['middleware' => [TokenVerificatinMiddleware::class]], function () {
    // user related route
    Route::post('/user-reset-password',[UserController::class,'ResetPassword'])->name('user-reset-password');
    Route::get('/user-logout',[UserController::class,'UserLogout'])->name('logout');
    Route::post('/user-profile',[UserController::class,'UserProfile'])->name('user-profile');
    Route::post('/update-profile',[UserController::class,'UpdateProfile'])->name('update-profile');

    // category related api route
    Route::post('/get-categories',[CategoryController::class,'getCategories'])->name('get-categories');
    Route::post('/add-category',[CategoryController::class,'addCategory'])->name('create-category');
    Route::post('/get-category',[CategoryController::class,'getCategory'])->name('get-category');
    Route::post('/update-category',[CategoryController::class,'updateCategory'])->name('update-category');
    Route::post('/delete-category',[CategoryController::class,'deleteCategory'])->name('delete-category');
});
