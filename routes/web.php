<?php

use App\Http\Controllers\Admin\NewsletterController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
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
