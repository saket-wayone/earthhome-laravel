<?php

use App\Http\Controllers\admin\Source\SourceController;
use App\Http\Controllers\WithdrawelController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\AuthenticateMiddleware;



Route::prefix('admin/withdraw')->middleware([AuthenticateMiddleware::class])->group(function () {
    Route::get('/', [\App\Http\Controllers\admin\WithdrawelController::class, 'index'])->name('withdraw.all');
    Route::get(uri :'/updatestatus/{id}',action :[\App\Http\Controllers\admin\WithdrawelController::class,'getCurrentStatus']);
    Route::post(uri :'/updatestatus',action :[\App\Http\Controllers\admin\WithdrawelController::class,'UpdateCurrentStatus']);
    Route::post('/delete/{id}',[\App\Http\Controllers\admin\WithdrawelController::class,'delete']);

});
