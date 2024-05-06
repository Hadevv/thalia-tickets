<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\ShowApiController;
use App\Http\Controllers\Api\HttpShowController;
use App\Http\Controllers\Api\AuthApiController;
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

Route::middleware('auth:sanctum')->group(function () {
    // api user sanctum auth
    Route::post('/login', [AuthApiController::class, 'login']);
    Route::post('/logout', [AuthApiController::class, 'logout']);
    Route::get('/user', [AuthApiController::class, 'user']);
    Route::post('/register', [AuthApiController::class, 'register']);
    // api show une fois authentifié
    Route::get('/show', [ShowApiController::class, 'index']);
    Route::get('/show/{id}', [ShowApiController::class, 'show'])->where('id', '[0-9]+');
    Route::get('/show/search', [ShowApiController::class, 'search'])->name('show.search');
});
// web scraping routes show
Route::get('/http-get-shows/{objectId}', [HttpShowController::class, 'getShows'])->where('objectId', '[0-9]+');



