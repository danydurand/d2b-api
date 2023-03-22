<?php

namespace App\Http\Controllers\Api\V1;

use App\Filter\V1\PriceListFilter;
use App\Http\Controllers\Controller;
use App\Http\Requests\V1\PriceListStoreRequest;
use App\Http\Requests\V1\PriceListUpdateRequest;
use App\Http\Resources\V1\PriceListCollection;
use App\Http\Resources\V1\PriceListResource;
use App\Models\PriceList;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PriceListController extends Controller
{
    public function index(Request $request): PriceListCollection
    {

        $filter = new PriceListFilter();
        $filterItems = $filter->transform($request);

        $includeCustomerTypes = $request->query('includeCustomerTypes');

        $priceLists = PriceList::where($filterItems);

        if ($includeCustomerTypes) {
            $priceLists->with('customerTypes');
        }
        return new PriceListCollection($priceLists->paginate()->appends($request->query()));

        // $priceLists = PriceList::paginate();
        // return new PriceListCollection($priceLists);
    }

    public function store(PriceListStoreRequest $request): PriceListResource
    {
        $priceList = PriceList::create($request->validated());

        return new PriceListResource($priceList);
    }

    public function show(Request $request, PriceList $priceList): PriceListResource
    {
        return new PriceListResource($priceList);
    }

    public function update(PriceListUpdateRequest $request, PriceList $priceList): PriceListResource
    {
        $priceList->update($request->validated());

        return new PriceListResource($priceList);
    }

    public function destroy(Request $request, PriceList $priceList): Response
    {
        $priceList->delete();

        return response()->noContent();
    }
}
