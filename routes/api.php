<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SubscriptionController;

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

Route::middleware('auth:sanctum')->post('subscribe/monthly', [SubscriptionController::class, 'monthly'])->name('subscribe.monthly');
Route::middleware('auth:sanctum')->post('subscribe/yearly', [SubscriptionController::class, 'yearly'])->name('subscribe.yearly');
