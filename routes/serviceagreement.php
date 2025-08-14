<?php

use App\Http\Controllers\admin\service\ServiceController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\AuthenticateMiddleware;


Route::prefix('admin/serviceagreement')->middleware([AuthenticateMiddleware::class])->group(function(){
    Route::get('/',[ServiceController::class,'index'])->name('serviceagreement.all');
    Route::get('/expired',[ServiceController::class,'expired'])->name('serviceagreement.expired');
    Route::get('/create/{id}',[ServiceController::class,'create'])->name('serviceagreement.create');
    Route::post('/store',[ServiceController::class,'store'])->name('serviceagreement.store');
    Route::get('/edit/{id}',[ServiceController::class,'edit'])->name('serviceaggrement.edit');
    Route::post('/update',[ServiceController::class,'update'])->name('serviceagreement.update');
    Route::post('/delete/{id}',[ServiceController::class,'delete']);
    Route::post('/aggrement/{id}',[ServiceController::class,'deleteserviceagreement']);
    Route::get('/downloadscore/{id}',[ServiceController::class,'viewscore'])->name('downloadscore');
    Route::get('/score/{id}',[ServiceController::class,'score']);
    Route::get('/viewserviceaggrement/{id}',[ServiceController::class,'viewserviceaggrement'])->name('viewserviceaggrement');
    Route::get('/sendmail',[ServiceController::class,'sendmail']);

});





?>