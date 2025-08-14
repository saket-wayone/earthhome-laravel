<?php

use App\Http\Controllers\admin\status\StatusController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\AuthenticateMiddleware;



Route::prefix('admin/status')->middleware([AuthenticateMiddleware::class])->group(function () {
    Route::get('/', [StatusController::class, 'index'])->name('status.all');
    Route::get('/create', [StatusController::class, 'create'])->name('status.create');
    Route::post('/store', [StatusController::class, 'store'])->name('status.store');
    Route::get('/edit/{id}', [StatusController::class, 'edit']);
    Route::post('/update', [StatusController::class, 'update'])->name('status.update');
    Route::post('/delete/{id}', [StatusController::class, 'delete']);
});
