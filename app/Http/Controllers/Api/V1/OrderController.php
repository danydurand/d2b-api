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
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class OrderController extends Controller
{
    public function index(Request $request): OrderCollection
    {

        $filter = new OrderFilter();
        $filterItems = $filter->transform($request);

        // $includeCustomers = $request->query('includeCustomers');

        $orders = Order::where($filterItems);

        // if ($includeCustomers) {
        //     $orders->with('customers');
        // }
        return new OrderCollection($orders->paginate()->appends($request->query()));

        // $orders = Order::paginate();
        // return new OrderCollection($orders);
    }

    public function store(OrderStoreRequest $request): OrderResource
    {
        info('Store');
        $order = Order::create($request->validated());
        info('Created');
        return new OrderResource($order);
    }

    public function show(Request $request, Order $order): OrderResource
    {
        $includeCustomers = $request->query('includeCustomers');

        if ($includeCustomers) {
            $order->loadMissing('customers');
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
        // $intCustQnty = Customer::where('Order_id', $order->id)->get()->count();
        // if ($intCustQnty == 0) {
            $order->delete();
            return response()->noContent();
        // } else {
        //     return response()->json(['errors' => 'There are ('. $intCustQnty. ') customers assigned to this Order.'], 400);
        // }
    }
}
