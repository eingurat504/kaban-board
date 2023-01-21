<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;

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
Route::group(['prefix' => 'auth', 'as' => 'auth.'],function() {   
    Route::post('/login',[UserController::class,'authenticate']);
    Route::post('/register',[UserController::class,'register']);
});

Route::group(['prefix' => 'categories', 'as' => 'categories.'],function() {   
    Route::get('/',[CategoryController::class,'index']);
    Route::get('/{category}',[CategoryController::class,'show']);
    Route::get('/{category}/tasks',[CategoryController::class,'tasks']);
});

Route::group(['prefix' => 'tasks', 'as' => 'tasks.'],function() {   
    Route::get('/',[TaskController::class,'index']);
    Route::get('/{task}',[TaskController::class,'show']);
    Route::put('/{task}',[TaskController::class,'update']);
    Route::post('/',[TaskController::class,'store']);
});
