<?php

use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\RestaurantController;
use App\Http\Controllers\Admin\DishController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\BraintreeController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [WelcomeController::class, 'index'])->name('welcome');

Route::get('/generate-client-token',[BraintreeController::class, 'generateClientToken'])->name('braintree.token');
Route::post('/process-payment', [BraintreeController::class, 'processPayment'])->name('braintree.payments');


Route::middleware(['auth'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
        Route::resource('restaurants', RestaurantController::class);
        Route::resource('dishes', DishController::class);
        Route::resource('orders', OrderController::class);
    });

require __DIR__ . '/auth.php';
