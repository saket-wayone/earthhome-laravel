<?php

use App\Http\Controllers\plantype\PlanTypeController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\AuthenticateMiddleware;



Route::prefix('admin/roles')->middleware([AuthenticateMiddleware::class])->group(function () {
    Route::get('/', [PlanTypeController::class, 'index'])->name('plans.all');
    Route::get('/create', [PlanTypeController::class, 'create'])->name('plans.create');
    Route::post('/store', [PlanTypeController::class, 'store'])->name('plans.store');
    Route::get('/edit/{id}', [PlanTypeController::class, 'edit']);
    Route::post('/update', [PlanTypeController::class, 'update'])->name('plans.update');
    Route::post('/delete/{id}', [PlanTypeController::class, 'delete']);
});
