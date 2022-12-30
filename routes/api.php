<?php

use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\CollectionAPIController;
use App\Http\Controllers\CollectionController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your appliNcation. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('registered', [RegisteredUserController::class, 'registered']);
Route::post('login', [RegisteredUserController::class, 'login']);

Route::get('getUserAPI', [RegisteredUserController::class, 'getUserAPI']);
Route::get('getCollectionsAPI', [CollectionController::class, 'getCollectionsAPI']);

Route::middleware('auth:sanctum')->group(function () {
    Route::resource('collections', CollectionAPIController::class);
});
