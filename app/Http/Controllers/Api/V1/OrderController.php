<?php

namespace App\Http\Controllers\Api\V1;

use App\Filter\V1\OrderFilter;
use App\Http\Controllers\Controller;
use App\Http\Requests\V1\OrderStoreRequest;
use App\Http\Requests\V1\OrderUpdateRequest;
use App\Http\Resources\V1\OrderCollection;
use App\Http\Resources\V1\OrderResource;
use App\Models\Customer;
use App\Models\Order;
use App\Models\OrderLine;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class OrderController extends Controller
{
    public function index(Request $request): OrderCollection
    {

        $filter = new OrderFilter();
        $filterItems = $filter->transform($request);

        $includeLines = $request->query('includeLines');

        $orders = Order::where($filterItems);

        if ($includeLines) {
            $orders->with('orderLines');
        }
        return new OrderCollection($orders->paginate()->appends($request->query()));

        // $orders = Order::paginate();
        // return new OrderCollection($orders);
    }

    public function store(OrderStoreRequest $request): OrderResource
    {
        $order = Order::create($request->validated());

        return new OrderResource($order);
    }

    public function show(Request $request, Order $order): OrderResource
    {
        $includeLines = $request->query('includeLines');

        if ($includeLines) {
            $order->loadMissing('orderLines');
        }

        return new OrderResource($order);
    }

    public function update(OrderUpdateRequest $request, Order $order): OrderResource
    {
        $order->update($request->validated());

        return new OrderResource($order);
    }

    public function destroy(Request $request, Order $order)
    {
        $intLineQnty = OrderLine::where('order_id', $order->id)->get()->count();
        if ($intLineQnty == 0) {
            $order->delete();
            return response()->noContent();
        } else {
            return response()->json(['errors' => 'There are ('. $intLineQnty. ') order lines assigned to this Order.'], 400);
        }
    }
}
