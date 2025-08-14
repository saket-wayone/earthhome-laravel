<?php

use App\Http\Controllers\admin\DashboardController;
use App\Http\Controllers\admin\doctor\DoctorController;
use App\Http\Controllers\CommonController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\AuthenticateMiddleware;

// login routes
require  __DIR__ .'/auth.php';

require __DIR__ .'/books.php';

// require mr roiutes
require __DIR__ .'/mr.php';
// require prices roiutes
require __DIR__ .'/prices.php';


// require manager roiutes
require __DIR__ .'/manager.php';


// require coupens routes
require __DIR__ .'/coupen.php';



// require coupens routes
require __DIR__ .'/plantypes.php';

// require risk routes
require __DIR__ .'/risk.php';



// require leads routes
require __DIR__ .'/leads.php';
require __DIR__ .'/task.php';




// require status routes
require __DIR__ .'/status.php';



// require source routes
require __DIR__ .'/source.php';



// require banners routes
require __DIR__ .'/banners.php';




// require risk routes
require __DIR__ .'/risk.php';


// require serviceagreement routes
require __DIR__ .'/serviceagreement.php';




// require sales routes
require __DIR__ .'/sales.php';




//require projects 

require __DIR__.'/projects.php';



//require invoices 

require __DIR__.'/invoice.php';




// require risk routes
require __DIR__ .'/firms.php';




// require risk routes
require __DIR__ .'/withdraw.php';



// dashboard routes
Route::middleware([AuthenticateMiddleware::class])->group(function(){
    Route::get('admin/dashboard',[DashboardController::class,'index'])->name('dashboard');
    Route::get('admin/logout',[DashboardController::class,'logout']);
    // uuser  routes
Route::get('/common',[CommonController::class,'index'])->name('comman.all');
Route::get('/feedback',[DashboardController::class, 'feedback'])->name('users.feedbacks');
Route::post('/common/store',[CommonController::class,'store'])->name('comman.store');

    Route::group(['prefix' => '/doctor'], function () {
        Route::get('', [DoctorController::class, 'index']);
        Route::get('/add', [DoctorController::class, 'add']);
        Route::post('/store', [DoctorController::class, 'store']);
        Route::get('/edit/{id}', [DoctorController::class, 'edit']);
        Route::post('/update', [DoctorController::class, 'update']);
        Route::post('/delete/{id}', [DoctorController::class, 'delete']);
        Route::post('/importexcel', [DoctorController::class, 'importexcel']);
    });
});


