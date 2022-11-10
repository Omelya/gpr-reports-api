<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InvolvementController;
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

Route::post('/involvement', [InvolvementController::class, 'create']);
Route::get('/all-involvement', [InvolvementController::class, 'getAllInvolvement']);
Route::delete('/remove-involvement/{id}', [InvolvementController::class, 'removeInvolvement']);
