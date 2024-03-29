<?php

use App\Http\Controllers\API\DishAPIController;
use App\Http\Controllers\API\OrderAPIController;
use App\Http\Controllers\API\TypeAPIController;
use App\Http\Controllers\API\RestaurantAPIController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\BraintreeController;

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

Route::get('/restaurants', [RestaurantAPIController::class, 'index']);
Route::get('/restaurants/{id}', [RestaurantAPIController::class, 'show']);

Route::get('/types', [TypeAPIController::class, 'index']);
Route::get('/types/{id}', [TypeAPIController::class, 'show']);

Route::get('/dishes', [DishAPIController::class, 'index']);
Route::get('/dishes/{id}', [DishAPIController::class, 'show']);

Route::get('/orders', [OrderAPIController::class, 'index']);
Route::get('/orders/{id}', [OrderAPIController::class, 'show']);

// Rotte per Braintree
Route::get('/braintree/client-token', [BraintreeController::class, 'generateClientToken']);
Route::post('/braintree/process-payment', [BraintreeController::class, 'processPayment']);

Route::get('/users', function () {
    $users = User::with(['restaurant'])->get();
    return response()->json(['users' => $users]);
});

Route::post('/orders', [OrderAPIController::class, "store"]);
Route::post('/orders/{id}', [OrderAPIController::class, "update"]);

Route::get('/generate-client-token', [BraintreeController::class, 'generateClientToken'])->name('braintree.token');
Route::post('/process-payment', [BraintreeController::class, 'processPayment'])->name('braintree.payments');
