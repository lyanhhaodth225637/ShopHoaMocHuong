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
use App\Http\Controllers\Admin\HomeHeroController as AdminHomeHero;
use App\Http\Controllers\Admin\PostCategoryController as AdminPostCategory;
use App\Http\Controllers\Admin\PostController as AdminPost;



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


Route::prefix('hoagomochuong-admin-6364')->middleware(['auth', 'single_session', 'role:super-admin|admin'])->name('admin.')->group(function () {
    //2FA
    Route::get('/2fa/setup', [TwoFactorController::class, 'setup'])->name('2fa.setup');
    Route::post('/2fa/enable', [TwoFactorController::class, 'enable'])->name('2fa.enable');
    Route::post('/2fa/disable', [TwoFactorController::class, 'disable'])->name('2fa.disable');
    Route::get('/2fa/challenge', [TwoFactorController::class, 'challenge'])->name('2fa.challenge');
    Route::post('/2fa/verify', [TwoFactorController::class, 'verify'])->name('2fa.verify');

    Route::middleware('')->group(function () {
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

        //post category
        // Route::get('/bai-viet', [AdminPostCategory::class, 'index'])->name('post_category.index');
        // Route::get('/bai-viet/xem/{id}-{slug}', [AdminPostCategory::class, 'show'])->name('post_category.show');
        // Route::post('/bai-viet/them-moi', [AdminPostCategory::class, 'store'])->name('post_category.store');
        // Route::put('/bai-viet/cap-nhat/{id}-{slug}', [AdminPostCategory::class, 'update'])->name('post_category.update');
        // Route::delete('/bai-viet/xoa/{id}', [AdminPostCategory::class, 'destroy'])->name('post_category.destroy');

        //post
        Route::get('/bai-viet', [AdminPost::class, 'indexCategory'])->name('post.index_category');
        Route::patch('/chu-de/{id}', [AdminPost::class, 'toggleCategoryStatus'])->name('post.category.toggle-status');
        Route::post('/chu-de/them', [AdminPost::class, 'storeCategory'])->name('post.store_category');
        Route::put('/chu-de/cap-nhat/{id}-{slug}', [AdminPost::class, 'updateCategory'])->name('post.update_category');
        Route::delete('/chu-de/xoa/{id}', [AdminPost::class, 'destroyCategory'])->name('post.destroy_category');
        Route::post('/bai-viet/them', [AdminPost::class, 'storePost'])->name('post.store');
        Route::put('/bai-viet/cap-nhat/{id}-{slug}', [AdminPost::class, 'updatePost'])->name('post.update');
        Route::delete('/bai-viet/xoa/{id}', [AdminPost::class, 'destroyPost'])->name('post.destroy');


        // Route::get('/bai-viet', [AdminPost::class, 'index'])->name('post.index');




        //customer
        Route::get('/khach-hang', [AdminProduct::class, 'khachHang'])->name('product.khachhang');

        //icon
        Route::get('/icons', [AdminIcon::class, 'index'])->name('icon.index');


        // setting trang chủ
        Route::get('/settings', [AdminHomeHero::class, 'index'])
            ->name('setting.index');

        // hero
        Route::post('/home-hero/update', [AdminHomeHero::class, 'updateHero'])
            ->name('home-hero.update');

        Route::post('/home-hero/slides', [AdminHomeHero::class, 'storeSlide'])
            ->name('home-hero.slides.store');

        Route::put('/home-hero/slides/{slide}', [AdminHomeHero::class, 'updateSlide'])
            ->name('home-hero.slides.update');

        Route::delete('/home-hero/slides/{slide}', [AdminHomeHero::class, 'destroySlide'])
            ->name('home-hero.slides.destroy');

        Route::post('/home-hero/stats', [AdminHomeHero::class, 'storeStat'])
            ->name('home-hero.stats.store');

        Route::put('/home-hero/stats/{stat}', [AdminHomeHero::class, 'updateStat'])
            ->name('home-hero.stats.update');

        Route::delete('/home-hero/stats/{stat}', [AdminHomeHero::class, 'destroyStat'])
            ->name('home-hero.stats.destroy');

        // feature box
        Route::post('/home-feature-boxes', [AdminHomeHero::class, 'storeFeatureBox'])
            ->name('home-feature-boxes.store');

        Route::put('/home-feature-boxes/{homeFeatureBox}', [AdminHomeHero::class, 'updateFeatureBox'])
            ->name('home-feature-boxes.update');

        Route::delete('/home-feature-boxes/{homeFeatureBox}', [AdminHomeHero::class, 'destroyFeatureBox'])
            ->name('home-feature-boxes.destroy');

        // occasion category
        Route::post('/home-occasion-categories', [AdminHomeHero::class, 'storeOccasionCategory'])
            ->name('home-occasion-categories.store');

        Route::put('/home-occasion-categories/{homeOccasionCategory}', [AdminHomeHero::class, 'updateOccasionCategory'])
            ->name('home-occasion-categories.update');

        Route::delete('/home-occasion-categories/{homeOccasionCategory}', [AdminHomeHero::class, 'destroyOccasionCategory'])
            ->name('home-occasion-categories.destroy');

        // promo banner
        Route::post('/home-promo-banners', [AdminHomeHero::class, 'storePromoBanner'])
            ->name('home-promo-banners.store');

        Route::put('/home-promo-banners/{homePromoBanner}', [AdminHomeHero::class, 'updatePromoBanner'])
            ->name('home-promo-banners.update');

        Route::delete('/home-promo-banners/{homePromoBanner}', [AdminHomeHero::class, 'destroyPromoBanner'])
            ->name('home-promo-banners.destroy');
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
    Route::get('/tin-tuc&cam-nang/{slug}', [FrontendBlog::class, 'show'])->name('blog.show');



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



Route::prefix('hoagomochuong-super-admin-6364')
    ->middleware(['auth', 'single_session', 'role:super-admin'])
    ->name('admin.')
    ->group(function () {

        // 2FA
        Route::get('/2fa/setup', [TwoFactorController::class, 'setup'])->name('2fa.setup');
        Route::post('/2fa/enable', [TwoFactorController::class, 'enable'])->name('2fa.enable');
        Route::post('/2fa/disable', [TwoFactorController::class, 'disable'])->name('2fa.disable');
        Route::get('/2fa/challenge', [TwoFactorController::class, 'challenge'])->name('2fa.challenge');
        Route::post('/2fa/verify', [TwoFactorController::class, 'verify'])->name('2fa.verify');

        Route::middleware('')->group(function () {
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
