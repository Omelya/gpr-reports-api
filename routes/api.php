<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InvolvementController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\UsersController;

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
Route::post('/user/create', [UsersController::class, 'create']);
Route::post('/login', [UsersController::class, 'auth']);

Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/user', [UsersController::class, 'get']);
    Route::get('/all-involvement', [InvolvementController::class, 'getAll']);
    Route::post('/involvement', [InvolvementController::class, 'create']);
    Route::delete('/involvement/{id}', [InvolvementController::class, 'remove']);
    Route::patch('/involvement/{id}', [InvolvementController::class, 'edit']);
    Route::get('/involvement/{id}', [InvolvementController::class, 'get']);
    Route::get('/report', [ReportController::class, 'get']);
});

