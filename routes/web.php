<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DashboardController;
use App\Http\Middleware\TokenVerificatinMiddleware;

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

    Route::view('/reset-password', 'pages.resetPassword')->name('resetPassword');

    Route::view('/categories', 'auth.category')->name('categories');
    Route::view('/customers', 'auth.customers')->name('customers');
    Route::view('/products', 'auth.products')->name('products');

    Route::view('/invoice', 'auth.invoice')->name('invoice');
    Route::view('/sales', 'auth.sales')->name('sales');

});



// pages route
Route::view('/login', 'pages.login')->name('login');
Route::view('/register', 'pages.registration')->name('register');
Route::view('/forgot-password', 'pages.forgotPassword')->name('forgotPassword');
Route::view('/verify-otp', 'pages.verifyOTP')->name('otp');




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


    // customer related api route
    Route::post('/get-customers',[CustomerController::class,'getCustomers'])->name('get-customers');
    Route::post('/get-customer',[CustomerController::class,'getCustomer'])->name('get-customer');
    Route::post('/update-customer',[CustomerController::class,'updateCustomer'])->name('update-customer');
    Route::post('/delete-customer',[CustomerController::class,'deleteCustomer'])->name('delete-customer');
    Route::post('/add-customer',[CustomerController::class,'addCustomer'])->name('create-customer');


    // product related api route
    Route::post('/get-products',[ProductController::class,'getProducts'])->name('get-products');
    Route::post('/add-product',[ProductController::class,'create'])->name('add-product');
    Route::post('/delete-product',[ProductController::class,'delete'])->name('delete-product');
    Route::post('/get-product',[ProductController::class,'getProduct'])->name('get-product');
    Route::post('/update-product',[ProductController::class,'update'])->name('update-product');

    // invoice related api route
    Route::post('/create-invoice',[InvoiceController::class,'invoiceCreate'])->name('create-invoice');
    Route::post('/select-invoice',[InvoiceController::class,'invoiceSelect'])->name('select-invoice');
    Route::post('/invoice-details',[InvoiceController::class,'invoiceDetails'])->name('invoice-details');
    Route::post('/delete-invoice',[InvoiceController::class,'invoiceDelete'])->name('delete-invoice');


    // dashboard api route
    Route::post('/total-payed',[DashboardController::class,'totalPaid'])->name('total-payed');
    Route::post('/total-order',[DashboardController::class,'totalOrder'])->name('total-order');
    Route::post('/recent-order',[DashboardController::class,'recentOrder'])->name('recent-order');

});
