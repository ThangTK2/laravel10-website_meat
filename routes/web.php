<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\Admin\OrderPdfController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [HomeController::class, 'index'])->name('home.index');
Route::get('/about-us', [HomeController::class, 'about'])->name('home.about');
Route::get('/category/{cat}', [HomeController::class, 'category'])->name('home.category');
Route::get('/product/{product}', [HomeController::class, 'product'])->name('home.product');
Route::get('/favorite/{product}', [HomeController::class, 'favorite'])->name('home.favorite');

// Route::get('/products/search', [ProductController::class, 'search'])->name('products.search');



Route::group(['prefix' => '/account'], function () {
    Route::get('/login', [AccountController::class, 'login'])->name('account.login');
    Route::post('/login', [AccountController::class, 'check_login'])->name('account.check_login');
    Route::get('/verify-account/{mail}', [AccountController::class, 'verify'])->name('account.verify');
    Route::get('/logout', [AccountController::class, 'logout'])->name('account.logout');

    Route::get('/favorite', [AccountController::class, 'favorite'])->name('account.favorite');

    Route::get('/register', [AccountController::class, 'register'])->name('account.register');
    Route::post('/register', [AccountController::class, 'check_register'])->name('account.check_register');

    Route::group(['middleware' => 'customer'], function () {
        Route::get('/profile', [AccountController::class, 'profile'])->name('account.profile');
        Route::post('/profile', [AccountController::class, 'check_profile'])->name('account.check_profile');

        Route::get('/change-password', [AccountController::class, 'change_password'])->name('account.change_password');
        Route::post('/change-password', [AccountController::class, 'check_change_password'])->name('account.check_change_password');
    });

    Route::get('/forgot-password', [AccountController::class, 'forgot_password'])->name('account.forgot_password');
    Route::post('/forgot-password', [AccountController::class, 'check_forgot_password'])->name('account.check_forgot_password');

    Route::get('/reset-password/{token}', [AccountController::class, 'reset_password'])->name('account.reset_password');
    Route::post('/reset-password/{token}', [AccountController::class, 'check_reset_password'])->name('account.check_reset_password');
});


Route::group(['prefix' => '/cart', 'middleware' => 'customer'], function () {
    Route::get('/', [CartController::class, 'index'])->name('cart.index');
    Route::get('/add/{product}', [CartController::class, 'add'])->name('cart.add');
    Route::get('/delete/{product}', [CartController::class, 'delete'])->name('cart.delete');
    Route::get('/update/{product}', [CartController::class, 'update'])->name('cart.update');
    Route::get('/clear', [CartController::class, 'clear'])->name('cart.clear');
});

Route::group(['prefix' => '/order', 'middleware' => 'customer'], function () {
    Route::get('/checkout', [CheckoutController::class, 'checkout'])->name('order.checkout');
    Route::post('/checkout', [CheckoutController::class, 'post_checkout'])->name('order.post_checkout');

    Route::get('/verify/{token}', [CheckoutController::class, 'verify'])->name('order.verify');
    Route::get('/history', [CheckoutController::class, 'history'])->name('order.history');
    Route::get('/history/{order}', [CheckoutController::class, 'detail'])->name('order.detail');
});


// ADMIN
Route::get('/admin/login', [AdminController::class, 'login'])->name('admin.login');
Route::post('/admin/login', [AdminController::class, 'check_login'])->name('admin.check_login');

Route::group(['prefix' => '/admin', 'middleware' => 'auth'], function () {
    Route::get('/', [AdminController::class, 'index'])->name('admin.index');
    Route::get('/logout', [AdminController::class, 'logout'])->name('admin.logout');

    Route::resource('/category', CategoryController::class);
    Route::get('/category/search', [CategoryController::class, 'search'])->name('category.search');

    Route::resource('/product', ProductController::class);
    Route::get('/product-delete-image/{image}', [ProductController::class, 'destroyImage'])->name('admin.product.destroyImage');

    Route::get('/order', [OrderController::class, 'index'])->name('order.index');
    Route::get('/order/detail/{order}', [OrderController::class, 'show'])->name('order.show');
    Route::get('/order/update-status/{order}', [OrderController::class, 'update'])->name('order.update');

    Route::get('/order/pdf/{id}', [OrderController::class, 'print_order'])->name('order.pdf');
});

