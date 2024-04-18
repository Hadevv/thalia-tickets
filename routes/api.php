<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\ShowController;

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

Route::get('/show', [ShowController::class, 'index']);
Route::get('/show/{id}', [ShowController::class, 'show'])->where('id', '[0-9]+');
Route::get('/show/search', [ShowController::class, 'search'])->name('show.search');
// très importante de mettre un name à la route car elle exste en api et web
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
