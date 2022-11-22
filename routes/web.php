<?php

use App\Http\Controllers\admin\AdminController;
use App\Http\Controllers\admin\BrandController;
use App\Http\Controllers\admin\CategoryController;
use App\Http\Controllers\admin\CustomerController;
use App\Http\Controllers\admin\GalleryController;
use App\Http\Controllers\admin\LoginController;
use App\Http\Controllers\admin\OrderController;
use App\Http\Controllers\admin\ProductController;
use App\Http\Controllers\admin\SliderController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\frontend\CartController;
use App\Http\Controllers\frontend\CheckoutController;
use App\Http\Controllers\frontend\DetailController;
use App\Http\Controllers\frontend\IndexController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\PayPalPaymentController;
use Illuminate\Support\Facades\Route;

Route::get('admin/login', [LoginController::class, 'getLogin'])->name('login');
Route::get('admin/quen-mat-khau', [MailController::class, 'admin_forget_password']);
Route::get('admin/update-new-password', [MailController::class, 'admin_update_new_password']);

Route::post('admin/postLogin', [LoginController::class, 'postLogin']);
Route::post('admin/recover-password', [MailController::class, 'admin_recover_password']);
Route::post('admin/reset-new-password', [MailController::class, 'admin_reset_new_password']);

Route::group(['middleware' => 'auth', 'prefix' => 'admin'], function () {

    Route::get('/logout', [LoginController::class, 'getLogout']);
    Route::get('/home', [AdminController::class, 'getHome']);
    Route::get('/order', [OrderController::class, 'view_order']);
    Route::get('/print-order/{id}', [OrderController::class, 'print_order']);
    Route::get('/order-detail/{id}', [OrderController::class, 'view_order_detail']);
    Route::get('/customer', [CustomerController::class, 'show_customer']);
    Route::get('/comment', [CommentController::class, 'show_comment']);
    Route::get('/profile-admin', [AdminController::class, 'profile_admin']);

    Route::resource('/brand', BrandController::class);
    Route::resource('/category', CategoryController::class);
    Route::resource('/product', ProductController::class);
    Route::resource('/slider', SliderController::class);

    Route::post('/update-status-order', [OrderController::class, 'update_status_order']);
    Route::post('/allow-comment', [CommentController::class, 'allow_comment']);
    Route::post('/reply-comment', [CommentController::class, 'reply_comment']);
    Route::post('/delete-comment', [CommentController::class, 'delete_comment']);
    Route::post('/delete-reply-comment', [CommentController::class, 'delete_reply_comment']);
    Route::post('/update-status-brand', [BrandController::class, 'update_Status_Brand']);
    Route::post('/update-status-category', [CategoryController::class, 'update_Status_Category']);
    Route::post('/change-password-admin/{id}', [AdminController::class, 'change_password_admin']);

    //gallery
    Route::get('/add-gallery/{id}', [GalleryController::class, 'gallery_index']);
    Route::post('/select-gallery', [GalleryController::class, 'select_gallery']);
    Route::post('/insert-gallery/{id}', [GalleryController::class, 'insert_gallery']);
    Route::post('/update-gallery-name', [GalleryController::class, 'update_gallery_name']);
    Route::post('/delete-gallery', [GalleryController::class, 'delete_gallery']);
    Route::post('/update-gallery', [GalleryController::class, 'update_gallery']);

});

Route::get('/', [IndexController::class, 'index']);
Route::get('/detail/{id}', [DetailController::class, 'index'])->name('detail');
Route::get('/brand/{id}', [IndexController::class, 'brand'])->name('brand');

//search
Route::get('/category/{id}', [IndexController::class, 'category'])->name('category');
Route::get('/price/{value}', [IndexController::class, 'price'])->name('price');
Route::get('/ram/{value}', [IndexController::class, 'ram'])->name('ram');
Route::get('/dung-luong/{value}', [IndexController::class, 'dung_luong'])->name('dung-luong');
Route::get('/pin-sac/{value}', [IndexController::class, 'pin_sac'])->name('pin-sac');
Route::get('/tinh-nang/{value}', [IndexController::class, 'tinh_nang'])->name('tinh-nang');

Route::post('/search', [IndexController::class, 'search'])->name('search');
Route::post('/search-ajax', [IndexController::class, 'search_ajax']);
Route::post('/loc', [IndexController::class, 'product_loc']);

//Cart
Route::get('/show-cart', [CartController::class, 'show_cart']);
Route::get('/delete-to-cart/{rowId}', [CartController::class, 'delete_to_cart']);

Route::post('/update-cart-quantity', [CartController::class, 'update_cart_quantity']);
Route::post('/save-cart', [CartController::class, 'save_cart']);

//Profile
Route::get('/dang-nhap', [CustomerController::class, 'dangnhap']);
Route::get('/dang-ki', [CustomerController::class, 'dangki']);
Route::get('/profile', [CustomerController::class, 'profile']);

Route::get('/forgot-password', [MailController::class, 'user_forgot_password']);
Route::get('/update-new-password', [MailController::class, 'user_update_new_password']);

Route::post('/change-password-user', [CustomerController::class, 'change_password_user']);
Route::post('/chi-tiet-don-hang', [CustomerController::class, 'profile_order_detail']);
Route::post('/huy-don-hang', [CustomerController::class, 'cancel_order']);
Route::post('/login-customer', [CustomerController::class, 'login_customer']);
Route::post('/add-customer', [CustomerController::class, 'add_customer']);
Route::post('/dang-xuat', [CustomerController::class, 'logout']);
Route::post('/update-profile', [CustomerController::class, 'update_profile']);

Route::post('/recover-password', [MailController::class, 'user_recover_password']);
Route::post('/reset-new-password', [MailController::class, 'user_reset_new_password']);

//facebook
Route::get('/login-facebook', [CustomerController::class, 'login_facebook']);
Route::get('/fb-callback', [CustomerController::class, 'callback_facebook']);

//google
Route::get('/login-google', [CustomerController::class, 'login_google']);
Route::get('/google-callback', [CustomerController::class, 'callback_google']);

//paypal
Route::get('create-transaction', [PayPalPaymentController::class, 'createTransaction'])->name('createTransaction');
Route::get('process-transaction', [PayPalPaymentController::class, 'processTransaction'])->name('processTransaction');
Route::get('success-transaction', [PayPalPaymentController::class, 'successTransaction'])->name('successTransaction');
Route::get('cancel-transaction', [PayPalPaymentController::class, 'cancelTransaction'])->name('cancelTransaction');

//Checkout
Route::get('/checkout', [CheckoutController::class, 'checkout'])->name('checkout');
Route::get('/hand-cash', [CheckoutController::class, 'handcash'])->name('handcash');

Route::post('/confirm-order', [CheckoutController::class, 'confirm_order']);

//comment
Route::post('/load-comment', [CommentController::class, 'load_comment']);
Route::post('/send-comment', [CommentController::class, 'send_comment']);

