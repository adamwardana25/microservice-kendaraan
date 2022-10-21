<?php

use App\Http\Controllers\OwnerController;
use App\Http\Controllers\VehicleController;
use App\Http\Controllers\ImageVehicleController;
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

Route::get('owners', [OwnerController::class, 'index']);
Route::get('owners/{id}', [OwnerController::class, 'show']);
Route::post('owners', [OwnerController::class, 'create']);
Route::put('owners/{id}', [OwnerController::class, 'update']);
Route::delete('owners/{id}', [OwnerController::class, 'destroy']);

Route::post('vehicles', [VehicleController::class, 'create']);
Route::put('vehicles/{id}', [VehicleController::class, 'update']);
Route::get('vehicles', [VehicleController::class, 'index']);
Route::get('vehicles/{id}', [VehicleController::class, 'show']);
Route::delete('vehicles/{id}', [VehicleController::class, 'destroy']);

Route::post('image-vehicles', [ImageVehicleController::class, 'create']);
Route::delete('image-vehicles/{id}', [ImageVehicleController::class, 'destroy']);
