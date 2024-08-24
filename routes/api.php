<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CarController;
use App\Http\Controllers\RentalController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/cars', [CarController::class, 'index']);
Route::apiResource('/cars',CarController::class )->only(['store', 'update', 'destroy'])->middleware('auth:sanctum');
Route::get('/find-by-brand', [CarController::class, 'findByBrand']);
Route::get('/paginacija', [CarController::class, 'paginacija']);
// Brand routes
Route::get('/brands', [BrandController::class, 'index']);

// Rental routes
Route::get('/rentals', [RentalController::class, 'index']);
Route::post('/rentals', [RentalController::class, 'store'])->middleware('auth:sanctum');;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
