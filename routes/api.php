<?php

use App\Http\Controllers\Api\AirlinesController;
use App\Http\Controllers\Api\AirportsController;
use App\Http\Controllers\Api\FlightsController;
use App\Http\Controllers\Api\LoginController;
use App\Http\Controllers\Api\RemarkController;
use App\Http\Controllers\TestController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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
    $user = $request->user();
    $permissions = $user->getPermissionsViaRoles();
    $user->setAttribute('permissions',$permissions);
    return $user;
});

Route::post('/login', [LoginController::class,'login']);

Route::middleware('auth:sanctum')->group(function(){

    Route::resource('airports',AirportsController::class);
    Route::resource('airlines',AirlinesController::class);
    Route::resource('flights',FlightsController::class);


    Route::get('remarks/{id}/{type}',[RemarkController::class,'getRemarks']);
    Route::post('remarks/{id}/{type}',[RemarkController::class,'create']);
    Route::put('remarks/{remark}',[RemarkController::class,'update']);
    Route::delete('remarks/{remark}',[RemarkController::class,'delete']);


    Route::post('/logout', [LoginController::class,'logOut']);

});