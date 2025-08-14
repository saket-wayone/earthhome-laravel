<?php

use App\Http\Controllers\admin\mr\MedicalRepresentativeController;
use App\Http\Controllers\admin\TaskController;
use App\Http\Middleware\AuthenticateMiddleware;
use App\Http\Middleware\CheckPurchasedCredit;
use Illuminate\Support\Facades\Route;




Route::prefix('admin/task')->middleware([AuthenticateMiddleware::class])->group(function () {

    Route::get('/{id}', [TaskController::class, 'index']);
    Route::get('/create/{id}', [TaskController::class, 'create']);
    Route::post('/store', [TaskController::class, 'store'])->name('task.store');
    Route::post('/delete/{id}', [TaskController::class, 'delete']);


});



?>