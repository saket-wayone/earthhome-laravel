<?php

use App\Http\Controllers\admin\prices\PriceController;
use App\Http\Middleware\AuthenticateMiddleware;
use Illuminate\Support\Facades\Route;



Route::prefix('admin/prices')->middleware([AuthenticateMiddleware::class])->group(function(){
        Route::get('/',[PriceController::class,'index'])->name('prices.all');
        Route::get('/create',[PriceController::class,'create'])->name('prices.create');
        Route::post('/store',[PriceController::class,'store'])->name('prices.store');
        Route::get('/edit/{id}',[PriceController::class,'edit']);
        Route::post('/update',[PriceController::class,'update'])->name('prices.update');
        Route::post('/delete/{id}',[PriceController::class,'delete']);

});

?>