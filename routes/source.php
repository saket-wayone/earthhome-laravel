<?php

use App\Http\Controllers\admin\Source\SourceController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\AuthenticateMiddleware;



Route::prefix('admin/source')->middleware([AuthenticateMiddleware::class])->group(function () {
    Route::get('/', [SourceController::class, 'index'])->name('source.all');
    Route::get('/create', [SourceController::class, 'create'])->name('source.create');
    Route::post('/store', [SourceController::class, 'store'])->name('source.store');
    Route::get('/edit/{id}', [SourceController::class, 'edit']);
    Route::post('/update', [SourceController::class, 'update'])->name('source.update');
    Route::post('/delete/{id}', [SourceController::class, 'delete']);
});
