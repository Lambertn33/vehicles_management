<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\Api\Vehicles\VehiclesController;

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

Route::prefix('v1')->middleware('json')->group(function(){
    Route::post('/auth/login',[AuthController::class,'login']);
    Route::middleware('auth:api')->group(function(){
        Route::post('/auth/logout', [AuthController::class, 'logout']);
        //vehicle Types
         Route::prefix('vehicles')->group(function(){
             Route::prefix('drivers')->group(function(){
                 Route::get('/',[VehiclesController::class,'getAllDrivers']);
                 Route::post('/',[VehiclesController::class,'addNewDriver']);
             });
             Route::prefix('types')->group(function(){
                Route::get('/',[VehiclesController::class,'getVehicleTypes']);
                Route::post('/',[VehiclesController::class,'addNewVehicleType']);
                Route::prefix('/{typeId}')->group(function(){
                    Route::get('/',[VehiclesController::class,'getSingleVehicleType']);
                    //categories
                    Route::prefix('categories')->group(function(){
                        Route::get('/',[VehiclesController::class,'getSingleVehicleTypeCategories']);
                        Route::post('/',[VehiclesController::class,'createNewVehicheTypeCategory']);
                        //single category
                        Route::prefix('/{categoryId}')->group(function(){
                            Route::get('/',[VehiclesController::class,'getSingleCategoryVehicles']);
                        });
                    });
                });
            });
         });
    });
});
