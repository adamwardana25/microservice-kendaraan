<?php

use App\Http\Controllers\TransactionController;
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

Route::post('transactions', [TransactionController::class, 'create']);
Route::get('transactions', [TransactionController::class, 'index']);
Route::put('transactions/{id}', [TransactionController::class, 'update']);
