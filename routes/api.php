<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TaskController;

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

Route::group(['prefix' => 'categories', 'as' => 'categories.'],function() {   
    Route::get('/',[CategoryController::class,'index']);
    Route::get('/{category}',[CategoryController::class,'show']);
    Route::get('/{category}/tasks',[CategoryController::class,'tasks']);
});

Route::group(['prefix' => 'tasks', 'as' => 'tasks.'],function() {   
    Route::get('/',[TaskController::class,'index']);
    Route::post('/',[TaskController::class,'store']);
});
