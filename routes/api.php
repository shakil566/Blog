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
Route::get('/blogPost', [App\Http\Controllers\Api\BlogApiController::class, 'index']);
Route::post('/blogPost/store', [App\Http\Controllers\Api\BlogApiController::class, 'store']);
Route::get('/blogPost/show/{id}', [App\Http\Controllers\Api\BlogApiController::class, 'show']);
Route::post('/blogPost/update/{id}', [App\Http\Controllers\Api\BlogApiController::class, 'update']);
Route::delete('/blogPost/delete/{id}', [App\Http\Controllers\Api\BlogApiController::class, 'destroy']);
