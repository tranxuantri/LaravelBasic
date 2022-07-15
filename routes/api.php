<?php

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

Route::apiResource('companies', App\Http\Controllers\API\ApiCompanyController::class);

Route::post('login', [App\Http\Controllers\API\ApiAdminLoginController::class, 'login']);
Route::post('logout',[App\Http\Controllers\API\ApiAdminLoginController::class, 'logout']);
Route::post('register', [App\Http\Controllers\API\ApiAdminLoginController::class, 'register']);
