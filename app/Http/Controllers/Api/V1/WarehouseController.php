<?php

namespace App\Http\Controllers\Api\V1;

use App\Filter\V1\WarehouseFilter;
use App\Http\Controllers\Controller;
use App\Http\Requests\V1\WarehouseStoreRequest;
use App\Http\Requests\V1\WarehouseUpdateRequest;
use App\Http\Resources\V1\WarehouseCollection;
use App\Http\Resources\V1\WarehouseResource;
use App\Models\Warehouse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class WarehouseController extends Controller
{
    public function index(Request $request): WarehouseCollection
    {

        $filter = new WarehouseFilter();
        $filterItems = $filter->transform($request);

        // $includeWarehouseTypes = $request->query('includeWarehouses');

        $warehouses = Warehouse::where($filterItems);

        // if ($includeWarehouseTypes) {
        //     $warehouses->with('Warehouses');
        // }
        return new WarehouseCollection($warehouses->paginate()->appends($request->query()));

        // $warehouses = Warehouse::paginate();
        // return new WarehouseCollection($warehouses);
    }

    public function store(WarehouseStoreRequest $request): WarehouseResource
    {
        $warehouse = Warehouse::create($request->validated());

        return new WarehouseResource($warehouse);
    }

    public function show(Request $request, Warehouse $warehouse): WarehouseResource
    {
        // $includeWarehouseTypes = $request->query('includeWarehouses');

        // if ($includeWarehouseTypes) {
        //     $warehouse->loadMissing('Warehouses');
        // }

        return new WarehouseResource($warehouse);
    }

    public function update(WarehouseUpdateRequest $request, Warehouse $warehouse): WarehouseResource
    {
        $warehouse->update($request->validated());

        return new WarehouseResource($warehouse);
    }

    public function destroy(Request $request, Warehouse $warehouse)
    {
        // $intCustQnty = Warehouse::where('Warehouse_id', $warehouse->id)->get()->count();
        // if ($intCustQnty == 0) {
            $warehouse->delete();
            return response()->noContent();
        // } else {
        //     return response()->json(['errors' => 'There are ('. $intCustQnty. ') Warehouses assigned to this Warehouse.'], 400);
        // }
    }
}
