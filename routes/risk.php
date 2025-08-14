<?php

use App\Http\Controllers\admin\risk\RiskAssementController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\AuthenticateMiddleware;


Route::prefix('admin/risk-assement')->middleware([AuthenticateMiddleware::class])->group(function(){
    Route::get('/',[RiskAssementController::class,'index'])->name('risk.all');
    Route::get('/create',[RiskAssementController::class,'create'])->name('risk.create');
    Route::post('/checkmobile',[RiskAssementController::class,'checkmobile']);
    Route::post('/store',[RiskAssementController::class,'store'])->name('risk.store');
    Route::post('/filter',[RiskAssementController::class,'filter'])->name('filter.riskassesment');
    Route::get('/edit/{id}',[RiskAssementController::class,'edit']);
    Route::post('/update',[RiskAssementController::class,'update'])->name('risk.update');
    Route::post('/delete/{id}',[RiskAssementController::class,'delete']);
    Route::get('/download/{id}',[RiskAssementController::class,'download'])->name('risk-assement-download');
    Route::get('/view/{id}',[RiskAssementController::class,'download2'])->name('riskassementview');
    Route::get('/testmail',[RiskAssementController::class,'testmail']);

});





?>