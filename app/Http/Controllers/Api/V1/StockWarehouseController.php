<?php

namespace App\Http\Controllers\Api\V1;

use App\Filter\V1\StockWarehouseFilter;
use App\Http\Controllers\Controller;
use App\Http\Requests\V1\StockWarehouseStoreRequest;
use App\Http\Requests\V1\StockWarehouseUpdateRequest;
use App\Http\Resources\V1\StockWarehouseCollection;
use App\Http\Resources\V1\StockWarehouseResource;
use App\Models\StockWarehouse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class StockWarehouseController extends Controller
{
    public function index(Request $request): StockWarehouseCollection
    {

        $filter = new StockWarehouseFilter();
        $filterItems = $filter->transform($request);

        $stockWarehouses = StockWarehouse::where($filterItems);

        return new StockWarehouseCollection($stockWarehouses->paginate()->appends($request->query()));

        // $stockWarehouses = StockWarehouse::paginate();
        // return new StockWarehouseCollection($stockWarehouses);
    }

    public function store(StockWarehouseStoreRequest $request): StockWarehouseResource
    {
        $stockWarehouse = StockWarehouse::create($request->validated());

        return new StockWarehouseResource($stockWarehouse);
    }

    public function show(Request $request, StockWarehouse $stockWarehouse): StockWarehouseResource
    {
        return new StockWarehouseResource($stockWarehouse);
    }

    public function update(StockWarehouseUpdateRequest $request, StockWarehouse $stockWarehouse): StockWarehouseResource
    {
        $stockWarehouse->update($request->validated());

        return new StockWarehouseResource($stockWarehouse);
    }

    public function destroy(Request $request, StockWarehouse $stockWarehouse)
    {
        // $intCustQnty = StockWarehouse::where('StockWarehouse_id', $stockWarehouse->id)->get()->count();
        // if ($intCustQnty == 0) {
            $stockWarehouse->delete();
            return response()->noContent();
        // } else {
        //     return response()->json(['errors' => 'There are ('. $intCustQnty. ') StockWarehouses assigned to this StockWarehouse.'], 400);
        // }
    }
}
