<?php

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


Route::group([
    'prefix' => 'v1',
    'namespace' => 'App\Http\Controllers\Api\V1',
    // 'middleware' => 'auth:sanctum'
], function () {
    Route::apiResource('business', BusinessController::class);
    Route::apiResource('sale-unit', SaleUnitController::class);
    Route::apiResource('article-type', ArticleTypeController::class);
    Route::apiResource('provider', ProviderController::class);
    Route::apiResource('origin', OriginController::class);
    Route::apiResource('colour', ColourController::class);
    Route::apiResource('sub-line', SubLineController::class);
    Route::apiResource('line', LineController::class);
    Route::apiResource('category', CategoryController::class);
    Route::apiResource('customer', CustomerController::class);
    Route::apiResource('seller', SellerController::class);
    Route::apiResource('customer-type', CustomerTypeController::class);
    Route::apiResource('price-list', PriceListController::class);
});
