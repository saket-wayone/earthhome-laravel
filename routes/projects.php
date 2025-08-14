<?php

use App\Http\Controllers\admin\project\ProjectController;
use App\Http\Middleware\AuthenticateMiddleware;
use Illuminate\Support\Facades\Route;

Route::prefix('admin/projects/')->middleware([AuthenticateMiddleware::class])->group(function(){
    Route::get('/all',[ProjectController::class,'index'])->name('projects.all');
    Route::get('/project-detail/{id}',[ProjectController::class,'detail'])->name('project.detail');
    Route::post('/getbalance',[ProjectController::class,'getbalance']);
    Route::post('/updatepayment',[ProjectController::class,'updatepayment'])->name('project.payment.update');

});


?>