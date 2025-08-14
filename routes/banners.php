<?php

use App\Http\Controllers\BannerModelController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\AuthenticateMiddleware;



Route::prefix('admin/banners')->middleware([AuthenticateMiddleware::class])->group(function () {
    Route::get('/', [BannerModelController::class,'index'])->name('banners.all');
    Route::get('/create', [BannerModelController::class, 'create'])->name('banners.create');
    Route::post('/store', [BannerModelController::class, 'store'])->name('banners.store');
    Route::get('/edit/{id}', [BannerModelController::class, 'edit']);
    Route::post('/update', [BannerModelController::class, 'update'])->name('banners.update');
    Route::post('/delete/{id}', [BannerModelController::class, 'delete']);
});
