<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Api\Controllers\ProductApiController;
use \App\Api\Controllers\CategoryApiController;

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

Route::middleware('auth.basic')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('products', [ProductApiController::class, 'index']);
Route::get('/products/{id}', [ProductApiController::class, 'show']);
Route::post('/products', [ProductApiController::class, 'store'])->middleware('auth.basic');
Route::put('/products/{id}', [ProductApiController::class, 'update'])->middleware('auth.basic');
Route::delete('/products/{id}', [ProductApiController::class, 'destroy']);

Route::get('/categories', [CategoryApiController::class, 'index']);
Route::post('/categories', [CategoryApiController::class, 'store'])->middleware('auth.basic');
Route::delete('/categories/{id}', [CategoryApiController::class, 'destroy'])->middleware('auth.basic');
