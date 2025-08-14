<?php

use App\Http\Controllers\ApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::post('client-login',[ApiController::class,'login']);
Route::post('verify',[ApiController::class,'veriyotp']);
Route::get('get-categories',[ApiController::class, 'getCategorires']);
Route::post('client-projects',[ApiController::class, 'projects']);

// getallProjects
Route::post('getallprojects',[ApiController::class, 'getallProjects']);

Route::get('client-project2',[ApiController::class, 'projects2']);
Route::post('get-today-task',[ApiController::class, 'getTodayTask']);


Route::post('get-category-wise-task',[ApiController::class, 'getCategoryWiseTask']);
Route::post('get-client-info',[ApiController::class, 'getCustomerProfile']);
Route::post('feedback',[ApiController::class, 'feedback']);

Route::post('get-banners',[ApiController::class, 'banners']);

Route::post('update-profile-image',[ApiController::class, 'profileImage']);

Route::post('get-user-info',[ApiController::class, 'getUserInfo']);



