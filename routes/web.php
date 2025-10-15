<?php

use App\Http\Controllers\Admin\NewsletterController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\HeroBannerController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PlanController;
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
Route::post('/newsletter/subscribe', [NewsletterController::class, 'store'])->name('newsletter.subscribe');

// مسیر سمت ادمین
Route::prefix('admin')->group(function () {
    Route::resource('newsletters',NewsletterController::class)->only(['index', 'destroy']);
});


//plans

Route::get('/pricing', [PlanController::class, 'index'])->name('plans.index');
Route::get('/pricing/create', [PlanController::class, 'create'])->name('plans.create');
Route::post('/pricing', [PlanController::class, 'store'])->name('plans.store');
Route::get('/contact-us', [ContactController::class, 'index'])->name('contact.index');
Route::post('/contact-us', [ContactController::class, 'store'])->name('contact.store');
Route::prefix('admin')->group(function () {
    Route::get('/hero', [HeroBannerController::class, 'adminIndex'])->name('admin.hero.index');
    Route::post('/hero/update/{id}', [HeroBannerController::class, 'update'])->name('admin.hero.update');
});