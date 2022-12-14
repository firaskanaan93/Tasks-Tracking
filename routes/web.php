<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect(route('tasks.create'));
});

Route::get('/tasks/create',[App\Http\Controllers\TaskController::class,'create'])
    ->name('tasks.create');

Route::post('/tasks',[App\Http\Controllers\TaskController::class,'store'])
    ->name('tasks.store');

Route::get('/tasks',[App\Http\Controllers\TaskController::class,'index'])
    ->name('tasks.index');

Route::get('/tasks/statistics',[App\Http\Controllers\TaskController::class,'statistics'])
    ->name('tasks.statistics');
