<?php

use App\Http\Controllers\admin\AdminController;
use App\Http\Controllers\admin\BrandController;
use App\Http\Controllers\admin\CategoryController;
use App\Http\Controllers\admin\CustomerController;
use App\Http\Controllers\admin\LoginController;
use App\Http\Controllers\admin\OrderController;
use App\Http\Controllers\admin\ProductController;
use App\Http\Controllers\admin\SliderController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\frontend\CartController;
use App\Http\Controllers\frontend\CheckoutController;
use App\Http\Controllers\frontend\DetailController;
use App\Http\Controllers\frontend\IndexController;
use Illuminate\Support\Facades\Route;

Route::prefix("admin")->group(function () {

    Route::get('/login', [LoginController::class, 'getLogin'])->name('login');

    Route::post('/postLogin', [LoginController::class, 'postLogin']);

    Route::get('/logout', [LoginController::class, 'getLogout'])->middleware('auth');

    Route::get('/home', [AdminController::class, 'getHome'])->middleware('auth');

    Route::post('/update-status-brand', [BrandController::class, 'update_Status_Brand'])->middleware('auth');

    Route::resource('/brand', BrandController::class)->middleware('auth');

    Route::resource('/category', CategoryController::class)->middleware('auth');

    Route::resource('/product', ProductController::class)->middleware('auth');

    Route::resource('/slider', SliderController::class)->middleware('auth');

    Route::get('/order', [OrderController::class, 'view_order'])->middleware('auth');

    Route::post('/update-status-order', [OrderController::class, 'update_status_order'])->middleware('auth');

    Route::get('/print-order/{id}', [OrderController::class, 'print_order'])->middleware('auth');

    Route::get('/order-detail/{id}', [OrderController::class, 'view_order_detail'])->middleware('auth');

    Route::get('/customer', [CustomerController::class, 'show_customer'])->middleware('auth');

    Route::get('/comment', [CommentController::class, 'show_comment'])->middleware('auth');

});

Route::get('/', [IndexController::class, 'index']);

Route::get('/detail/{id}', [DetailController::class, 'index'])->name('detail');

Route::get('/brand/{id}', [IndexController::class, 'brand'])->name('brand');

Route::get('/category/{id}', [IndexController::class, 'category'])->name('category');

//Cart
Route::post('/update-cart-quantity', [CartController::class, 'update_cart_quantity']);

Route::post('/save-cart', [CartController::class, 'save_cart']);

Route::get('/show-cart', [CartController::class, 'show_cart']);

Route::get('/delete-to-cart/{rowId}', [CartController::class, 'delete_to_cart']);

//Profile
Route::post('/login-customer', [CustomerController::class, 'login_customer']);

Route::post('/add-customer', [CustomerController::class, 'add_customer']);

Route::get('/dang-nhap', [CustomerController::class, 'dangnhap']);

Route::post('/dang-xuat', [CustomerController::class, 'logout']);

//facebook
Route::get('/login-facebook', [CustomerController::class, 'login_facebook']);

Route::get('/fb-callback', [CustomerController::class, 'callback_facebook']);

//google
Route::get('/login-google', [CustomerController::class, 'login_google']);

Route::get('/google-callback', [CustomerController::class, 'callback_google']);

//Checkout
Route::get('/checkout', [CheckoutController::class, 'checkout']);

Route::post('/confirm-order', [CheckoutController::class, 'confirm_order']);
