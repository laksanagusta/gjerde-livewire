<?php

use App\Http\Controllers\API\ApiTransactionController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ResellerController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\TransactionTypeController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return redirect()->route('dashboard');
});

Route::prefix('dashboard')
    ->middleware(['auth:sanctum', 'CheckPermission:admin'])
    ->group(function() {
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    });

Route::middleware(['auth:sanctum', 'CheckPermission:admin'])->group(function () {
    Route::resource('locations', LocationController::class);
    Route::resource('resellers', ResellerController::class);
    Route::resource('transactions', TransactionController::class);
    Route::resource('transaction-types', TransactionTypeController::class);
    Route::resource('users', UserController::class);
    Route::resource('products', ProductController::class);
});

Route::post('dashboard/filter-report', [ApiTransactionController::class, 'fetchReport']);



