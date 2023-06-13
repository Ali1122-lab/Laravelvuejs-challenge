<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\CustomerController;
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
    return $request->user();
});

Route::group(['prefix' => 'customers'], function () {
    Route::get('/', [CustomerController::class, 'index']); 
    Route::put('/{customer}/promote', [CustomerController::class, 'promote']);
    Route::put('/{customer}/demote', [CustomerController::class, 'demote']);
});

// Route::group(['prefix' => 'api'], function () {
    Route::post('login', [AuthController::class, 'login']);
    Route::post('register', [AuthController::class, 'register']);
// });