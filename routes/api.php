<?php

use App\Http\Controllers\Api\ApartmentController;
use App\Http\Controllers\Api\MessageController;
use App\Http\Controllers\Api\ServiceController;
use App\Http\Controllers\Api\ViewController;
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

Route::get('apartments', [ApartmentController::class, 'index']);
Route::get('apartments/{slug}', [ApartmentController::class, 'show']);
Route::get('services', [ServiceController::class, 'index']);
Route::post('messages', [MessageController::class, 'store']);
Route::get('views/{apartment_id}', [ViewController::class, 'index']);
Route::post('views', [ViewController::class, 'store']);
