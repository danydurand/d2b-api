<?php

use App\Http\Controllers\Api\V1\ArticleController;
use App\Http\Controllers\Api\V1\ArticleTypeController;
use App\Http\Controllers\Api\V1\BranchController;
use App\Http\Controllers\Api\V1\BrandController;
use App\Http\Controllers\Api\V1\BusinessController;
use App\Http\Controllers\Api\V1\CategoryController;
use App\Http\Controllers\Api\V1\ColourController;
use App\Http\Controllers\Api\V1\ConditionPaymentController;
use App\Http\Controllers\Api\V1\CurrencyController;
use App\Http\Controllers\Api\V1\CustomerController;
use App\Http\Controllers\Api\V1\CustomerTypeController;
use App\Http\Controllers\Api\V1\DocumentCxcController;
use App\Http\Controllers\Api\V1\DocumentTypeController;
use App\Http\Controllers\Api\V1\InvoiceController;
use App\Http\Controllers\Api\V1\InvoiceLineController;
use App\Http\Controllers\Api\V1\LineController;
use App\Http\Controllers\Api\V1\OrderController;
use App\Http\Controllers\Api\V1\OriginController;
use App\Http\Controllers\Api\V1\PaymentConditionController;
use App\Http\Controllers\Api\V1\PriceListController;
use App\Http\Controllers\Api\V1\ProviderController;
use App\Http\Controllers\Api\V1\SaleUnitController;
use App\Http\Controllers\Api\V1\SellerController;
use App\Http\Controllers\Api\V1\StockWarehouseController;
use App\Http\Controllers\Api\V1\SubBrandController;
use App\Http\Controllers\Api\V1\SubLineController;
use App\Http\Controllers\Api\V1\TransportController;
use App\Http\Controllers\Api\V1\WarehouseController;
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

    Route::apiResource('article', ArticleController::class);
    Route::post('article/bulk', [ArticleController::class,'bulkStore']);

    Route::apiResource('customer', CustomerController::class);
    Route::post('customer/multiple', [CustomerController::class,'storeMultiple']);

    Route::apiResource('seller', SellerController::class);
    Route::post('seller/multiple', [SellerController::class,'storeMultiple']);

    Route::apiResource('document-cxc', DocumentCxcController::class);
    Route::post('document-cxc/bulk', [DocumentCxcController::class,'bulkStore']);

    Route::apiResource('order', OrderController::class);
    Route::apiResource('invoice', InvoiceController::class);

    Route::apiResource('document-type', DocumentTypeController::class);
    Route::apiResource('stock-warehouse', StockWarehouseController::class);
    Route::apiResource('invoice-line', InvoiceLineController::class);
    Route::apiResource('condition-payment', ConditionPaymentController::class);
    Route::apiResource('warehouse', WarehouseController::class);
    Route::apiResource('branch', BranchController::class);
    Route::apiResource('transport', TransportController::class);
    Route::apiResource('currency', CurrencyController::class);
    Route::apiResource('payment-condition', PaymentConditionController::class);

    Route::apiResource('sub-brand', SubBrandController::class);

    Route::apiResource('brand', BrandController::class);
    Route::post('brand/bulk', [BrandController::class,'bulkStore']);

    Route::apiResource('business', BusinessController::class);
    Route::apiResource('sale-unit', SaleUnitController::class);
    Route::apiResource('article-type', ArticleTypeController::class);
    Route::apiResource('provider', ProviderController::class);
    Route::apiResource('origin', OriginController::class);
    Route::apiResource('colour', ColourController::class);
    Route::apiResource('sub-line', SubLineController::class);
    Route::apiResource('line', LineController::class);
    Route::apiResource('category', CategoryController::class);

    Route::apiResource('customer-type', CustomerTypeController::class);
    Route::apiResource('price-list', PriceListController::class);
});
