<?php

use App\Http\Controllers\sales\SalesController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\AuthenticateMiddleware;


Route::prefix('admin/sales')->middleware([AuthenticateMiddleware::class])->group(function(){
    Route::get('/',[SalesController::class,'index'])->name('admin.sales');
    Route::post('/filterdata', [SalesController::class, 'filter'])->name('filter.sales');
    Route::get('/{userid}/{month}/{year}', [SalesController::class, 'getsales']);
    Route::get('agent/date/{userid}/{from}/{to?}', [SalesController::class, 'getsalesfromto']);

    // Route::get('/create',[SalesController::class,'create'])->name('risk.create');
    // Route::post('/checkmobile',[SalesController::class,'checkmobile']);
    // Route::post('/store',[SalesController::class,'store'])->name('risk.store');
    // Route::post('/filter',[SalesController::class,'filter'])->name('filter.riskassesment');
    // Route::get('/edit/{id}',[SalesController::class,'edit']);
    // Route::post('/update',[SalesController::class,'update'])->name('risk.update');
    // Route::post('/delete/{id}',[SalesController::class,'delete']);
    // Route::get('/download/{id}',[SalesController::class,'download'])->name('risk-assement-download');
    // Route::get('/view/{id}',[SalesController::class,'download2'])->name('riskassementview');
    // Route::get('/testmail',[SalesController::class,'testmail']);

});





?>