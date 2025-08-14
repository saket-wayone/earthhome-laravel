<?php

use App\Http\Controllers\admin\books\BooksController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\AuthenticateMiddleware;



Route::prefix('admin/books')->middleware([AuthenticateMiddleware::class])->group(function(){
        Route::get('/',[BooksController::class,'index'])->name('books.all');
        Route::get('/create',[BooksController::class,'create'])->name('books.create');
        Route::get('/page/create/{id}',[BooksController::class,'createpage'])->name('books.page.create');
        Route::get('/page/all/{id}',[BooksController::class,'showpage'])->name('books.page.all');
        Route::get('/page/edit/{id}',[BooksController::class,'pagedit'])->name('page.edit');
        Route::get('/page/addnew/{id}',[BooksController::class,'addnew'])->name('page.addnew');
        Route::post('/updateinnerpage/{id}',[BooksController::class,'updateinnerpage'])->name('page.updateinnerpage');
        Route::post('/updateinnerpagestore/{id}',[BooksController::class,'updateinnerpagestore'])->name('page.updateinnerpagestore');
        Route::get('/edit/{id}',[BooksController::class,'edit'])->name('book.edit');
        Route::post('/store',[BooksController::class,'store'])->name('books.addbooks');
        Route::post('/update',[BooksController::class,'update'])->name('books.updatebook');
        Route::post('/delete/{id}',[BooksController::class,'delete']);
        Route::post('/deletepage/{id}',[BooksController::class,'deletepage']);
        Route::post('/uploadpages',[BooksController::class,'uploadimages'])->name('uploadpages');
        Route::get('/notify',[BooksController::class,'notify'])->name('books.notify');
        Route::post('/move',[BooksController::class,'move'])->name('page.move');

});






?>