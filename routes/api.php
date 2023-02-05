<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\Project\ProjectController;
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

Route::controller(AuthController::class)->group(function () {
    Route::post('login', 'login');
    Route::post('register', 'register');
    Route::post('logout', 'logout');
    Route::post('refresh', 'refresh');

});

Route::controller(ProjectController::class)->group(function (){
    Route::get('projects', 'index');
    Route::get('projects/show/{id}', 'show');
    Route::post('projects/create', 'store');
    Route::post('projects/update/{id}', 'update');
    Route::post('projects/destroy/{id}', 'destroy');
    Route::get('projects/listProjectUser', 'listProjectUser');
});
