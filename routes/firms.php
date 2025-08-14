<?php

use App\Http\Controllers\admin\firms\FirmController;
use App\Http\Controllers\admin\status\StatusController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\AuthenticateMiddleware;


Route::prefix('admin')->middleware(['auth'])->group(function () {
    Route::resource('firms', FirmController::class);
    Route::post('firms/data-update', [FirmController::class, 'updatefirm'])->name('firms.newupdate');
});



