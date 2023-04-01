<?php

namespace App\Http\Controllers\Api\V1;

use App\Filter\V1\SaleUnitFilter;
use App\Http\Controllers\Controller;
use App\Http\Requests\V1\SaleUnitStoreRequest;
use App\Http\Requests\V1\SaleUnitUpdateRequest;
use App\Http\Resources\V1\SaleUnitCollection;
use App\Http\Resources\V1\SaleUnitResource;
use App\Models\SaleUnit;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class SaleUnitController extends Controller
{
    public function index(Request $request): SaleUnitCollection
    {

        $filter = new SaleUnitFilter();
        $filterItems = $filter->transform($request);

        $saleUnits = SaleUnit::where($filterItems);

        return new SaleUnitCollection($saleUnits->paginate()->appends($request->query()));

        // $saleUnits = Line::paginate();
        // return new LineCollection($saleUnits);
    }

    public function store(SaleUnitStoreRequest $request): SaleUnitResource
    {
        $saleUnit = SaleUnit::create($request->validated());

        return new SaleUnitResource($saleUnit);
    }

    public function show(Request $request, SaleUnit $saleUnit): SaleUnitResource
    {
        return new SaleUnitResource($saleUnit);
    }

    public function update(SaleUnitUpdateRequest $request, SaleUnit $saleUnit): SaleUnitResource
    {
        $saleUnit->update($request->validated());

        return new SaleUnitResource($saleUnit);
    }

    public function destroy(Request $request, SaleUnit $saleUnit)
    {
        $saleUnit->delete();
        return response()->noContent();
    }
}
