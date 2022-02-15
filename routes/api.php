<?php

use App\Http\Controllers\IngredientsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\AuthController;
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
Route::group(["middleware" => ["auth:sanctum"]], function () {
    Route::post('/logout', [AuthController::class, "signOut"]);

    Route::post('/products', [ProductsController::class, 'create']);
    Route::put('/products/{product}', [ProductsController::class, 'update']);
    Route::delete('/products/{product}', [ProductsController::class, 'delete']);

    Route::post('/ingredients', [IngredientsController::class, 'create']);
    Route::put('/ingredients/{ingredient}', [IngredientsController::class, 'update']);
    Route::delete('/ingredients/{ingredient}', [IngredientsController::class, 'delete']);
});
Route::post('/login', [AuthController::class, "signIn"]);
Route::post('/register', [AuthController::class, "signUp"]);

Route::get('/products', [ProductsController::class, 'index']);
Route::get('/products/{product}', [ProductsController::class, 'show']);
Route::post('/products/search/{product}', [ProductsController::class, 'search']);

Route::get('/ingredients', [IngredientsController::class, 'index']);
Route::get('/ingredients/{ingredient}', [IngredientsController::class, 'show']);


Route::post('/ingredients/search/{ingredient}', [IngredientsController::class, 'search']);
