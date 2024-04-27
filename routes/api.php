<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\ShowApiController;
use App\Http\Controllers\Api\HttpShowController;
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
Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/show', [ShowApiController::class, 'index']);
Route::get('/show/{id}', [ShowApiController::class, 'show'])->where('id', '[0-9]+');
Route::get('/show/search', [ShowApiController::class, 'search'])->name('show.search');

Route::get('/http-get-shows/{objectId}', [HttpShowController::class, 'getShows'])->where('objectId', '[0-9]+');



