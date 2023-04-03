<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\CurrencyStoreRequest;
use App\Http\Requests\Api\CurrencyUpdateRequest;
use App\Http\Resources\Api\CurrencyCollection;
use App\Http\Resources\Api\CurrencyResource;
use App\Models\Currency;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CurrencyController extends Controller
{
    public function index(Request $request): Response
    {
        $currencies = Currency::all();

        return new CurrencyCollection($currencies);
    }

    public function store(CurrencyStoreRequest $request): Response
    {
        $currency = Currency::create($request->validated());

        return new CurrencyResource($currency);
    }

    public function show(Request $request, Currency $currency): Response
    {
        return new CurrencyResource($currency);
    }

    public function update(CurrencyUpdateRequest $request, Currency $currency): Response
    {
        $currency->update($request->validated());

        return new CurrencyResource($currency);
    }

    public function destroy(Request $request, Currency $currency): Response
    {
        $currency->delete();

        return response()->noContent();
    }
}
