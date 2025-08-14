<?php

use App\Http\Controllers\admin\coupen\CoupenController ;
use App\Http\Controllers\admin\prices\PriceController;
use App\Http\Middleware\AuthenticateMiddleware;
use Illuminate\Support\Facades\Route;



Route::prefix('admin/coupen')->middleware([AuthenticateMiddleware::class])->group(function(){
        Route::get('/',[CoupenController::class,'index'])->name('coupen.all');
        Route::get('/create',[CoupenController::class,'create'])->name('coupen.create');
        Route::post('/store',[CoupenController::class,'store'])->name('coupen.store');
        Route::get('/edit/{id}',[CoupenController::class,'edit']);
        Route::post('/update',[CoupenController::class,'update'])->name('coupen.update');
        Route::post('/delete/{id}',[CoupenController::class,'delete']);

});

?>