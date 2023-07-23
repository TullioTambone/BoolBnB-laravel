<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\LeadController;
use App\Http\Controllers\Admin\SubscriptionController;
use App\Http\Controllers\Api\ApartmentController;
use App\Http\Controllers\Api\ServiceController;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

// contacts - Emails
Route::post('/contacts', [LeadController::class, 'store']);

// apartments
Route::get( '/apartments', [ApartmentController::class, 'index'] );

// apartments show
Route::get( '/apartments/{slug}', [ApartmentController::class, 'show'] );

// services
Route::get( '/services', [ServiceController::class, 'index'] );
// Route::get('/subscription', [SubscriptionController::class, 'token']);