<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\OrderLineStoreRequest;
use App\Http\Requests\Api\OrderLineUpdateRequest;
use App\Http\Resources\Api\OrderLineCollection;
use App\Http\Resources\Api\OrderLineResource;
use App\Models\OrderLine;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class OrderLineController extends Controller
{
    public function index(Request $request): Response
    {
        $orderLines = OrderLine::all();

        return new OrderLineCollection($orderLines);
    }

    public function store(OrderLineStoreRequest $request): Response
    {
        $orderLine = OrderLine::create($request->validated());

        return new OrderLineResource($orderLine);
    }

    public function show(Request $request, OrderLine $orderLine): Response
    {
        return new OrderLineResource($orderLine);
    }

    public function update(OrderLineUpdateRequest $request, OrderLine $orderLine): Response
    {
        $orderLine->update($request->validated());

        return new OrderLineResource($orderLine);
    }

    public function destroy(Request $request, OrderLine $orderLine): Response
    {
        $orderLine->delete();

        return response()->noContent();
    }
}
