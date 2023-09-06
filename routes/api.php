<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DivisionController;
use App\Http\Controllers\UnitController;
use App\Http\Controllers\SellerController;
use App\Http\Controllers\SaleController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('/auth/tokens', [AuthController::class, 'login']);

Route::middleware(['auth:sanctum'])->group(function () {
    Route::get(
        '/divisions',
        [DivisionController::class, 'retrieveAll']
    )->middleware('ability:read-divisions');

    Route::get(
        '/divisions/{id}/units',
        [UnitController::class, 'retrieveAll']
    )->whereNumber('id')->middleware('ability:read-units');

    Route::get(
        '/divisions/{divisionID}/units/{unitID}/sellers',
        [SellerController::class, 'retrieveAll']
    )->whereNumber([
        'divisionID',
        'unitID'
    ])->middleware('ability:read-sellers');

    Route::post(
        '/sales',
        [SaleController::class, 'register']
    )->middleware('ability:create-sales');
    Route::get(
        '/sales',
        [SaleController::class, 'retrieveAll']
    )->middleware('ability:read-sales');
    Route::get(
        '/sales/{id}',
        [SaleController::class, 'retrieve']
    )->whereNumber('id')->middleware('ability:read-sales');
});
