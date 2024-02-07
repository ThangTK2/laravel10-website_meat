<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\HomeController;
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


Route::group(['prefix' => '/account'], function () {
    Route::get('/login', [AccountController::class, 'login'])->name('account.login');
    Route::post('/login', [AccountController::class, 'check_login'])->name('account.check_login');
    Route::get('/verify-account/{mail}', [AccountController::class, 'verify'])->name('account.verify');
    Route::get('/logout', [AccountController::class, 'logout'])->name('account.logout');

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

// ADMIN
Route::get('/admin/login', [AdminController::class, 'login'])->name('admin.login');
Route::post('/admin/login', [AdminController::class, 'check_login'])->name('admin.check_login');

Route::group(['prefix' => '/admin', 'middleware' => 'auth'], function () {
    Route::get('/', [AdminController::class, 'index'])->name('admin.index');
    Route::get('/logout', [AdminController::class, 'logout'])->name('admin.logout');

    Route::resource('/category', CategoryController::class);
    Route::resource('/product', ProductController::class);
    Route::get('/product-delete-image/{image}', [ProductController::class, 'destroyImage'])->name('admin.product.destroyImage');
});

