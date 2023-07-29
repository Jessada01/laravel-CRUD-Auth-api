<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\AuthController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::controller(StudentController::class)->group(function()
{
    Route::post('student/add','Create');
    Route::put('student/update/{id}','UpdataData');
    Route::delete('student/delete/{id}','Delete');
    //Route::get('student/read/{id}','Read');
    Route::get('student/read','Read');
    
});

Route::controller(AuthController::class)->group(function()
{
    Route::post('register','register');
    Route::post('login','login');

});
Route::group(['middleware' => ['auth:sanctum']], function()
{
    Route::post('logout',[AuthController::class,'logout']);
}

);
