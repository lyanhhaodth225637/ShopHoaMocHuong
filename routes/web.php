<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController as AdminDashboard;
use App\Http\Controllers\Admin\CategoryController as AdminCategory;
use App\Http\Controllers\Admin\ProductController as AdminProduct;

use App\Http\Controllers\Frontend\HomeController as FrontendHome;
use App\Http\Controllers\Frontend\ProductController as FrontendProduct;
use App\Http\Controllers\Frontend\CartController as FrontendCart;

// Route::get('/', function () {
//     return view('welcome');
// });

require __DIR__ . '/auth.php';

Route::get('/home', [\App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('auth');

// Route::prefix('admin')->name('admin.')->group(function () {
//     Route::get('/', function () {
//         return view('admin.dashboard');
//     })->name('dashboard');
// });


Route::prefix('admin')->middleware(['auth', 'role:super-admin'])->name('admin.')->group(function () {
    Route::get('/', [AdminDashboard::class, 'index'])->name('index');

    //category
    Route::get('/danh-muc', [AdminCategory::class, 'index'])->name('category.index');
    Route::get('/danh-muc/xem/{id}-{slug}', [AdminCategory::class, 'show'])->name('category.show');
    Route::post('/danh-muc/them-moi', [AdminCategory::class, 'store'])->name('category.store');
    Route::put('/danh-muc/cap-nhat/{id}-{slug}', [AdminCategory::class, 'update'])->name('category.update');
    Route::delete('/danh-muc/xoa/{id}', [AdminCategory::class, 'destroy'])->name('category.destroy');

    //product
    Route::get('/san-pham', [AdminProduct::class, 'index'])->name('product.index');
    Route::get('/san-pham/xem/{id}-{slug}', [AdminProduct::class, 'show'])->name('product.show');
    Route::post('/san-pham/them-moi', [AdminProduct::class, 'store'])->name('product.store');
    Route::put('/san-pham/cap-nhat/{id}-{slug}', [AdminProduct::class, 'update'])->name('product.update');
    Route::delete('/san-pham/xoa/{id}', [AdminProduct::class, 'destroy'])->name('product.destroy');

    Route::get('/khach-hang', [AdminProduct::class, 'khach Hang'])->name('product.khachhang');



});

Route::prefix('/')->name('frontend.')->group(function () {
    Route::get('/', [FrontendHome::class, 'index'])->name('home.index');
    Route::get('danh-muc/{id}-{slug}', [FrontendHome::class, 'show'])->name('category.show');

    Route::get('san-pham/xem-tat-ca', [FrontendProduct::class, 'index'])->name('product.index');

    Route::get('san-pham/xem-chi-tiet/{id}-{slug}', [FrontendProduct::class, 'show'])->name('product.show');


});

Route::prefix('/user')->middleware(['auth'])->name('user.')->group(function () {

    //giỏ hàng
    Route::get('gio-hang/', [FrontendCart::class, 'index'])->name('cart.index');
    Route::post('gio-hang/them/{id}-{slug}', [FrontendCart::class, 'add'])->name('cart.add');
    Route::patch('gio-hang/tang/{id}-{slug}', [FrontendCart::class, 'increase'])->name('cart.increase');
    Route::patch('gio-hang/giam/{id}-{slug}', [FrontendCart::class, 'decrease'])->name('cart.decrease');
    Route::delete('gio-hang/xoa/{id}-{slug}', [FrontendCart::class, 'remove'])->name('cart.remove');
    Route::delete('gio-hang/xoa-tat-ca', [FrontendCart::class, 'clear'])->name('cart.clear');
    Route::get('gio-hang/du-lieu', [FrontendCart::class, 'summary'])->name('cart.summary');
});