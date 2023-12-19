<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Category\CategoryController;
use App\Http\Controllers\Product\ProductController;
use App\Http\Controllers\User\UserController;
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

Route::post('login',[AuthController::class,'login']);
Route::post('register',[AuthController::class,'register']);

Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('logout', [AuthController::class, 'logout']);
    Route::get('getMe',[UserController::class,'getMe']);

    //category
    Route::prefix('categories')->group(function () {
        Route::get('/', [CategoryController::class, 'index']); // Get all categories
        Route::post('/', [CategoryController::class, 'store']); // Create a new category
        Route::get('/{id}', [CategoryController::class, 'show']); // Get a single category by ID
        Route::put('/{id}', [CategoryController::class, 'update']); // Update a category by ID
        Route::delete('/{id}', [CategoryController::class, 'destroy']); // Delete a category by ID
    });
    //product
    Route::prefix('products')->group(function () {
        Route::get('/', [ProductController::class, 'index']); // Get all products
        Route::post('/', [ProductController::class, 'store']); // Create a new product
        Route::get('/{id}', [ProductController::class, 'show']); // Get a single product by ID
        Route::put('/{id}', [ProductController::class, 'update']); // Update a product by ID
        Route::delete('/{id}', [ProductController::class, 'destroy']); // Delete a product by ID
    });
});
