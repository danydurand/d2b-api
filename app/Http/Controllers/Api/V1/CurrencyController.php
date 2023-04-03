<?php

namespace App\Http\Controllers\Api\V1;

use App\Filter\V1\CurrencyFilter;
use App\Http\Controllers\Controller;
use App\Http\Requests\V1\CurrencyStoreRequest;
use App\Http\Requests\V1\CurrencyUpdateRequest;
use App\Http\Resources\V1\CurrencyCollection;
use App\Http\Resources\V1\CurrencyResource;
use App\Models\Currency;
use App\Models\Line;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CurrencyController extends Controller
{
    public function index(Request $request): CurrencyCollection
    {

        $filter = new CurrencyFilter();
        $filterItems = $filter->transform($request);

        // $includeLines = $request->query('includeLines');

        $currencys = Currency::where($filterItems);

        // if ($includeLines) {
        //     $currencys->with('lines');
        // }
        return new CurrencyCollection($currencys->paginate()->appends($request->query()));

        // $currencys = Currency::paginate();
        // return new CurrencyCollection($currencys);
    }

    public function store(CurrencyStoreRequest $request): CurrencyResource
    {
        $currency = Currency::create($request->validated());

        return new CurrencyResource($currency);
    }

    public function show(Request $request, Currency $currency): CurrencyResource
    {
        // $includeLines = $request->query('includeLines');

        // if ($includeLines) {
        //     $currency->loadMissing('lines');
        // }

        return new CurrencyResource($currency);
    }

    public function update(CurrencyUpdateRequest $request, Currency $currency): CurrencyResource
    {
        $currency->update($request->validated());

        return new CurrencyResource($currency);
    }

    public function destroy(Request $request, Currency $currency)
    {
        // $intRelaQnty = Line::where('Currency_id', $currency->id)->get()->count();
        // if ($intRelaQnty == 0) {
            $currency->delete();
            return response()->noContent();
        // } else {
        //     return response()->json(['errors' => 'There are ('. $intRelaQnty. ') Lines assigned to this Currency.'], 400);
        // }
    }
}
