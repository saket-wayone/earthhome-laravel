<?php

use App\Http\Controllers\admin\mr\MedicalRepresentativeController;
use App\Http\Middleware\AuthenticateMiddleware;
use App\Http\Middleware\CheckPurchasedCredit;
use Illuminate\Support\Facades\Route;




Route::prefix('admin/mr')->middleware([AuthenticateMiddleware::class])->group(function(){
        Route::get('/',[MedicalRepresentativeController::class,'index'])->name('mr.all');
        Route::get('/create',[MedicalRepresentativeController::class,'create'])->name('mr.create');
        Route::get('/license',[MedicalRepresentativeController::class,'license'])->name('mr.license');
        Route::get('/notused',[MedicalRepresentativeController::class,'notused'])->name('mr.license.notused');
        Route::get('/history',[MedicalRepresentativeController::class,'history'])->name('mr.history');
        Route::post('/purchasecredit',[MedicalRepresentativeController::class,'purchasecredit'])->name('mr.purchasecredit');
        Route::post('/renewupdate',[MedicalRepresentativeController::class,'renewupdate'])->name('mr.renewupdate');
        Route::post('update/{id}',[MedicalRepresentativeController::class,'update'])->name('mr.update');
        Route::post('/chhosedplan',[MedicalRepresentativeController::class,'chhosedplan'])->name('coupen.applied');
        // when  company chooses the plan
        Route::get('/choosedplan/{id}',[MedicalRepresentativeController::class,'companychhosedplan'])->name('choosedplan');


        Route::get('pasued/{id}',[MedicalRepresentativeController::class,'paused'])->name('mr.pause');
        Route::get('edit/{id}',[MedicalRepresentativeController::class,'edit'])->name('mr.edit');
        Route::post('pausedmr',[MedicalRepresentativeController::class,'pausedmr'])->name('pausedmr');
        Route::get('renew2',[MedicalRepresentativeController::class,'renew2'])->name('renew2');
        Route::post('renew',[MedicalRepresentativeController::class,'renew'])->name('renew');
        // Route::post('/choosedrenewplan',[MedicalRepresentativeController::class,'choosedrenewplan'])->name('choosedrenewplan');

});

?>