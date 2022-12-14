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


Route::get('/v1/users/search', [\App\Http\Controllers\Api\V1\UserController::class,'search'])
    ->name('api.users.search');

Route::get('/v1/tasks', [\App\Http\Controllers\Api\V1\TaskController::class,'index'])
    ->name('api.tasks.index');
