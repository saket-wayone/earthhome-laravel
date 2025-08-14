<?php

use App\Http\Controllers\admin\Invoice\InvoiceController;
use App\Http\Controllers\admin\mr\MedicalRepresentativeController;
use App\Http\Middleware\AuthenticateMiddleware;
use Illuminate\Support\Facades\Route;




Route::prefix('admin/invoices')->middleware([AuthenticateMiddleware::class])->group(function(){
    Route::get('/all',[InvoiceController::class,'index'])->name('invoices.all'); 
    Route::get('/create',[InvoiceController::class,'create'])->name('invoices.create'); 
    Route::post('/store',[InvoiceController::class,'store'])->name('invoices.store'); 
    Route::post('/update',[InvoiceController::class,'update'])->name('invoices.update'); 
    Route::get('/view/{id}',[InvoiceController::class,'view'])->name('invoice'); 
    Route::post('/delete/{id}',[InvoiceController::class,'delete']);
    Route::get('/edit/{id}',[InvoiceController::class,'edit'])->name('invoices.edit');
    Route::post('/filter',[InvoiceController::class,'filter'])->name('invoices.filter');

});

?>