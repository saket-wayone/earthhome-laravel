<?php

use App\Http\Controllers\admin\Manager\ManagerController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\AuthenticateMiddleware;

Route::prefix('admin/users')->middleware([AuthenticateMiddleware::class])->group(function () {
    Route::get('/second/{status}',[ManagerController::class,'index']);
    Route::get('/manager/create',[ManagerController::class,'create'])->name('manager.create');
    Route::post('/manager/store',[ManagerController::class,'store'])->name('manageradd');
    Route::post('manager/delete/{id}',[ManagerController::class,'delete']);
    Route::get('/manager/edit/{id}',[ManagerController::class,'edit']);
    Route::post('/manager/update',[ManagerController::class,'update'])->name('manageredit');
    Route::post('/uploadlogo',[ManagerController::class,'uploadlogo'])->name('uploadlogo');


});
