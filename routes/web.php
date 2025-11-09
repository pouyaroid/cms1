<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\NewsletterController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ContactNumberController;
use App\Http\Controllers\HeroBannerController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\OpinionController;
use App\Http\Controllers\PlanController;
use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SiteSettingController;
use App\Http\Controllers\WhyUsController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BuilderController;


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
    Route::get('/hero/create', [HeroBannerController::class, 'create'])->name('admin.hero.create');
    Route::post('/hero/store', [HeroBannerController::class, 'store'])->name('admin.hero.store');
    Route::get('/hero/{id}/edit', [HeroBannerController::class, 'edit'])->name('admin.hero.edit');
    Route::post('/hero/{id}/update', [HeroBannerController::class, 'update'])->name('admin.hero.update');
    Route::delete('/hero/{id}', [HeroBannerController::class, 'destroy'])->name('admin.hero.destroy');


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

Route::prefix('menus')->name('menus.')->group(function () {
    Route::get('/', [MenuController::class, 'index'])->name('index');
    Route::get('/create', [MenuController::class, 'create'])->name('create');
    Route::post('/store', [MenuController::class, 'store'])->name('store');
    Route::get('/{menu}/edit', [MenuController::class, 'edit'])->name('edit');
    Route::put('/{menu}', [MenuController::class, 'update'])->name('update');
    Route::delete('/{menu}', [MenuController::class, 'destroy'])->name('destroy');
});
Route::resource('categories', CategoryController::class);
Route::get('/builder', [BuilderController::class, 'index'])->name('builder.index');
Route::post('/builder/save', [BuilderController::class, 'save'])->name('builder.save');
Route::get('/admin',[AdminController::class,'index']);
Route::get('/about', [AboutController::class, 'index'])->name('about.index');
Route::get('/about/create', [AboutController::class, 'create'])->name('about.create');
Route::post('/about', [AboutController::class, 'store'])->name('about.store');
Route::get('/about/{about}/edit', [AboutController::class, 'edit'])->name('about.edit');
Route::put('/about/{about}', [AboutController::class, 'update'])->name('about.update');
Route::delete('/about/{about}', [AboutController::class, 'destroy'])->name('about.destroy');
Route::prefix('admin')->group(function () {
    Route::get('/contact', [ContactNumberController::class, 'index'])->name('contact.index');
    Route::post('/contact', [ContactNumberController::class, 'updateOrCreate'])->name('contact.updateOrCreate');
});

Route::prefix('admin')->name('admin.')->group(function () {
    Route::resource('contacts', ContactNumberController::class);
});
Route::get('/contact-messages', [ContactController::class, 'index'])->name('admin.contact.index');
Route::delete('/contact-messages/{contactMessage}', [ContactController::class, 'destroy'])->name('admin.contact.destroy');