<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SuperAdmin\Homecontroler as SPAdminHome;
use App\Http\Controllers\SuperAdmin\Warehouse\UnitController;
use App\Http\Controllers\SuperAdmin\Warehouse\SupplierController;
use App\Http\Controllers\SuperAdmin\Warehouse\CustomerController;
use App\Http\Controllers\SuperAdmin\Warehouse\SkuController;
use App\Http\Controllers\SuperAdmin\Warehouse\InputSlipController;
use App\Http\Controllers\SuperAdmin\Warehouse\OutputSlipController;

use App\Http\Controllers\Admin\DashboardController as AdminDashboard;
use App\Http\Controllers\Admin\CategoryController as AdminCategory;
use App\Http\Controllers\Admin\ProductController as AdminProduct;
use App\Http\Controllers\Admin\IconController as AdminIcon;
use App\Http\Controllers\Admin\SettingController as AdminSetting;
use App\Http\Controllers\Admin\HomeHeroController;

use App\Http\Controllers\Frontend\HomeController as FrontendHome;
use App\Http\Controllers\Frontend\ProductController as FrontendProduct;
use App\Http\Controllers\Frontend\CartController as FrontendCart;
use App\Http\Controllers\Frontend\ContactController as FrontendContact;
use App\Http\Controllers\Frontend\BlogController as FrontendBlog;

use App\Http\Controllers\Auth\TwoFactorController;

// Route::get('/', function () {
//     return view('welcome');
// });

require __DIR__ . '/auth.php';

Route::get('/home', [\App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware(['auth', 'single_session']);

// Route::prefix('admin')->name('admin.')->group(function () {
//     Route::get('/', function () {
//         return view('admin.dashboard');
//     })->name('dashboard');
// });


Route::prefix('admin')->middleware(['auth', 'single_session', 'role:super-admin|admin'])->name('admin.')->group(function () {
    //2FA
    Route::get('/2fa/setup', [TwoFactorController::class, 'setup'])->name('2fa.setup');
    Route::post('/2fa/enable', [TwoFactorController::class, 'enable'])->name('2fa.enable');
    Route::post('/2fa/disable', [TwoFactorController::class, 'disable'])->name('2fa.disable');
    Route::get('/2fa/challenge', [TwoFactorController::class, 'challenge'])->name('2fa.challenge');
    Route::post('/2fa/verify', [TwoFactorController::class, 'verify'])->name('2fa.verify');

    Route::middleware('2fa')->group(function () {
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

        Route::get('/khach-hang', [AdminProduct::class, 'khachHang'])->name('product.khachhang');

        //icon
        Route::get('/icons', [AdminIcon::class, 'index'])->name('icon.index');


        //setting
        Route::get('/settings', [AdminSetting::class, 'index'])->name('setting.index');

        Route::get('home-hero', [HomeHeroController::class, 'index'])->name('home-hero.index');
        Route::post('home-hero/update', [HomeHeroController::class, 'updateHero'])->name('home-hero.update');
        Route::post('home-hero/slides', [HomeHeroController::class, 'storeSlide'])->name('home-hero.slides.store');
        Route::put('home-hero/slides/{slide}', [HomeHeroController::class, 'updateSlide'])->name('home-hero.slides.update');
        Route::delete('home-hero/slides/{slide}', [HomeHeroController::class, 'destroySlide'])->name('home-hero.slides.destroy');
        Route::post('home-hero/stats', [HomeHeroController::class, 'storeStat'])->name('home-hero.stats.store');
        Route::put('home-hero/stats/{stat}', [HomeHeroController::class, 'updateStat'])
            ->name('home-hero.stats.update');

        Route::delete('home-hero/stats/{stat}', [HomeHeroController::class, 'destroyStat'])
            ->name('home-hero.stats.destroy');


        Route::get('quan-ly-kho', [HomeHeroController::class, 'index'])->name('home-hero.index');


    });

});

Route::prefix('/')->name('frontend.')->group(function () {
    Route::get('/', [FrontendHome::class, 'index'])->name('home.index');
    //làm
    Route::get('danh-muc/{id}-{slug}', [FrontendHome::class, 'show'])->name('category.show');

    Route::get('san-pham/xem-tat-ca', [FrontendProduct::class, 'index'])->name('product.index');
    Route::get('san-pham/{id}-{slug}', [FrontendProduct::class, 'show'])->name('product.show');

    Route::get('/lien-he', [FrontendContact::class, 'index'])->name('contact.index');

    Route::get('/tin-tuc&cam-nang', [FrontendBlog::class, 'index'])->name('blog.index');



});


Route::prefix('/user')->name('user.')->group(function () {

    //giỏ hàng
    Route::get('gio-hang/', [FrontendCart::class, 'index'])->name('cart.index');
    Route::post('gio-hang/them/{id}-{slug}', [FrontendCart::class, 'add'])->name('cart.add');
    Route::patch('gio-hang/tang/{id}-{slug}', [FrontendCart::class, 'increase'])->name('cart.increase');
    Route::patch('gio-hang/giam/{id}-{slug}', [FrontendCart::class, 'decrease'])->name('cart.decrease');
    Route::delete('gio-hang/xoa/{id}-{slug}', [FrontendCart::class, 'remove'])->name('cart.remove');
    Route::delete('gio-hang/xoa-tat-ca', [FrontendCart::class, 'clear'])->name('cart.clear');
    Route::get('gio-hang/du-lieu', [FrontendCart::class, 'summary'])->name('cart.summary');
});



Route::prefix('super-admin')
    ->middleware(['auth', 'single_session', 'role:super-admin'])
    ->name('admin.')
    ->group(function () {

        // 2FA
        Route::get('/2fa/setup', [TwoFactorController::class, 'setup'])->name('2fa.setup');
        Route::post('/2fa/enable', [TwoFactorController::class, 'enable'])->name('2fa.enable');
        Route::post('/2fa/disable', [TwoFactorController::class, 'disable'])->name('2fa.disable');
        Route::get('/2fa/challenge', [TwoFactorController::class, 'challenge'])->name('2fa.challenge');
        Route::post('/2fa/verify', [TwoFactorController::class, 'verify'])->name('2fa.verify');

        Route::middleware('2fa')->group(function () {
            Route::get('/', [SPAdminHome::class, 'index'])->name('dashboard');

            Route::prefix('warehouse')->name('warehouse.')->group(function () {
                Route::resource('units', UnitController::class);
                Route::resource('suppliers', SupplierController::class);
                Route::resource('customers', CustomerController::class);
                Route::resource('skus', SkuController::class);

                Route::resource('input-slips', InputSlipController::class);
                Route::post('input-slips/{inputSlip}/complete', [InputSlipController::class, 'complete'])
                    ->name('input-slips.complete');

                Route::post('input-slips/{inputSlip}/cancel', [InputSlipController::class, 'cancel'])
                    ->name('input-slips.cancel');

                Route::resource('output-slips', OutputSlipController::class);
                Route::post('output-slips/{outputSlip}/complete', [OutputSlipController::class, 'complete'])
                    ->name('output-slips.complete');

                Route::post('output-slips/{outputSlip}/cancel', [OutputSlipController::class, 'cancel'])
                    ->name('output-slips.cancel');
            });
        });
    });
