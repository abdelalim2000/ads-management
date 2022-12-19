<?php

use App\Http\Controllers\Api\AdsApiController;
use App\Http\Controllers\Api\AdvertiserApiController;
use App\Http\Controllers\Api\CategoryApiController;
use App\Http\Controllers\Api\TagApiController;
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

Route::apiResources([
    'categories' => CategoryApiController::class,
    'tags' => TagApiController::class
]);

Route::apiResource('ads',AdsApiController::class)->only(['index']);
Route::apiResource('advertisers',AdvertiserApiController::class)->only(['show']);
