<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Restaurant;
use App\Models\Type;
use App\Models\Dish;
use App\Models\Order;

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

Route::get('/restaurants', function () {
    return response()->json([
        'success' => true,
        'data' => Restaurant::with(['user', 'types'])->get()
    ]);
});

Route::get('/types', function () {
    return response()->json([
        'success' => true,
        'data' => Type::with(['restaurants'])->get()
    ]);
});

Route::get('/dishes', function () {
    return response()->json([
        'success' => true,
        'data' => Dish::with(['restaurant', 'orders'])->get()
    ]);
});
