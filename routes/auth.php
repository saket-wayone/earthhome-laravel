<?php

use App\Http\Controllers\admin\Manager\ManagerController;
use App\Http\Controllers\admin\user\UserController;
use App\Http\Controllers\admin\validate\AuthController;
use App\Http\Middleware\AuthenticateMiddleware;

Route::get('/',[AuthController::class,'index']);
Route::get('/policy',function(){
    return view('admin.policies.policy');
});
Route::get('/forgot',[AuthController::class,'forgot']);
Route::get('/sign-up',[AuthController::class,'signup']);

// validate user auth 
// post 
Route::post('user/validate',[AuthController::class,'validateuser'])->middleware('throttle:login')->name('validateUser');
Route::post('user/forgotpassword',[AuthController::class,'forgotpassword'])->name('emailforgot');
Route::post('user/resetpassword',[AuthController::class,'resetpassword'])->name('reset-password');
Route::post('user/registercompanyadmin',[AuthController::class,'registercompanyadmin'])->name('companyadminregisteration');

// valid user routes
Route::prefix('admin/users')->middleware([AuthenticateMiddleware::class])->group(function(){
    Route::get('/role/{status}',[UserController::class,'index']);
    Route::get('login/{id}',[AuthController::class,'loggedIn']);

    Route::get('/all',[UserController::class,'all']);
    Route::get('/manager/team',[UserController::class,'team'])->name('manager.team');
    Route::get('/change-password',[UserController::class,'changepassword']);
    Route::post('/update-password',[UserController::class,'update_password']);
    Route::get('/status/{status}',[UserController::class,'status']);
    Route::get('/create',[UserController::class,'create'])->name('createuser');
    Route::post('/store',[UserController::class,'store'])->name('useradd');
    Route::post('/update',[UserController::class,'update'])->name('useredit');
    Route::post('/delete/{id}',[UserController::class,'delete']);
    Route::get('/edit/{id}',[UserController::class,'edit']);
    Route::get('/company-admin/mr/{id}',[UserController::class,'viewmr']);

    Route::get('/changepassworddiv/{id}/{table}', [UserController::class, 'changepassworddiv']);
    Route::post('/updatepassword', [UserController::class, 'updatepassword']);



    
    



});