<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\Admin\NewsletterController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ContactNumberController;
use App\Http\Controllers\HeroBannerController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OpinionController;
use App\Http\Controllers\PlanController;
use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SiteSettingController;
use App\Http\Controllers\WhyUsController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('index');
// });
Route::get('/',[HomeController::class,'index']);
Route::prefix('admin')->name('footer-links.')->group(function () {
    Route::resource('footer-links', \App\Http\Controllers\Admin\FooterLinkController::class);
});
Route::prefix('admin')->name('social-links.')->group(function () {
    Route::resource('social-links', \App\Http\Controllers\Admin\SocialLinkController::class);
});
Route::prefix('admin')->group(function () {
    Route::get('company-info/edit', [\App\Http\Controllers\Admin\CompanyInfoController::class, 'edit'])->name('company-info.edit');
    Route::post('company-info/update', [\App\Http\Controllers\Admin\CompanyInfoController::class, 'update'])->name('company-info.update');
});

// مسیر سمت کاربر
// Route::post('/newsletter/subscribe', [NewsletterController::class, 'store'])->name('newsletter.subscribe');

// // مسیر سمت ادمین
// Route::prefix('admin')->group(function () {
//     Route::resource('newsletters',NewsletterController::class)->only(['index', 'destroy']);
// });


//plans

Route::get('/pricing', [PlanController::class, 'index'])->name('plans.index');
Route::get('/pricing/create', [PlanController::class, 'create'])->name('plans.create');
Route::post('/pricing', [PlanController::class, 'store'])->name('plans.store');
Route::get('/contact-us', [ContactController::class, 'index'])->name('contact.index');
Route::post('/contact-us', [ContactController::class, 'store'])->name('contact.store');
Route::prefix('admin')->group(function () {
    Route::get('/hero', [HeroBannerController::class, 'adminIndex'])->name('admin.hero.index');
    Route::post('/hero/update/{id}', [HeroBannerController::class, 'update'])->name('admin.hero.update');
    Route::get('/products', [ProductController::class, 'index'])->name('products.index');
    Route::post('/products', [ProductController::class, 'store'])->name('products.store');
    Route::put('/products/{product}', [ProductController::class, 'update'])->name('products.update');
    Route::delete('/products/{product}', [ProductController::class, 'destroy'])->name('products.destroy');
    Route::resource('portfolio', PortfolioController::class);
    Route::get('/opinions', [OpinionController::class, 'index'])->name('opinions.index');
Route::post('/opinions', [OpinionController::class, 'store'])->name('opinions.store');
Route::get('/whyus', [WhyUsController::class, 'index'])->name('whyus.index');
Route::resource('posts', PostController::class);
Route::resource('about', AboutController::class);
});
Route::get('/admin/settings', [SiteSettingController::class, 'index'])->name('settings.index');
Route::post('/admin/settings', [SiteSettingController::class, 'update'])->name('settings.update');
Route::get('/contact', [ContactNumberController::class, 'index']);
Route::post('/contact', [ContactNumberController::class, 'updateOrCreate']);