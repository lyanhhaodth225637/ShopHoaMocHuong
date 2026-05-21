<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController as AdminDashboard;
use App\Http\Controllers\Admin\CategoryController as AdminCategory;
use App\Http\Controllers\Frontend\HomeController as FrontendHome;

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

    Route::get('/danh-muc', [AdminCategory::class, 'index'])->name('category.index');
    Route::get('/danh-muc/xem/{id}-{slug}', [AdminCategory::class, 'show'])->name('category.show');
    Route::post('/danh-muc/them-moi', [AdminCategory::class, 'store'])->name('category.store');
    Route::put('/danh-muc/cap-nhat/{id}-{slug}', [AdminCategory::class, 'update'])->name('category.update');
    Route::delete('/danh-muc/xoa/{id}', [AdminCategory::class, 'destroy'])->name('category.destroy');
});

Route::prefix('/')->name('frontend.')->group(function () {
    Route::get('/', [FrontendHome::class, 'index'])->name('home.index');
    Route::get('danh-muc/{id}-{slug}', [FrontendHome::class, 'show'])->name('category.show');


});